<?php
class History extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('getapi_model');
		$this->load->library('backend/backend_library');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();
	}

	public function index()
	{

		echo ' History';
		die();
	}
	public function history_gift()
	{
		$time = time();
		$day_ago = time() - 3 * 24 * 60 * 60;

		$data['gift'] = $this->db->select('tb_user.user,tb_gift.gift_name,log_gift_voucher.time_receive,log_gift_voucher.admin')
			->join('tb_user', 'log_gift_voucher.user_id = tb_user.id', 'left')
			->join('tb_gift', 'log_gift_voucher.gift_id = tb_gift.id', 'left')
			->where('time_receive >', $day_ago)
			->where('time_receive <', $time)
			->where('log_gift_voucher.receive', 1)
			->get('log_gift_voucher')
			->result_array();

		$this->load->view('history_gift', $data);
	}
	public function select_log_gift()
	{

		$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));


		if ($this->input->post('user') != null && $this->input->post('user') != '') {

			$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
			$user_id = $this->db->where('user', $user)->get('tb_user');

			if ($user_id->num_rows() == 1) {

				$data['gift'] = $this->db->select('tb_user.user,tb_gift.gift_name,log_gift_voucher.time_receive,log_gift_voucher.admin')
					->join('tb_user', 'log_gift_voucher.user_id = tb_user.id', 'left')
					->join('tb_gift', 'log_gift_voucher.gift_id = tb_gift.id', 'left')
					->where('user_id', $user_id->row()->id)
					->where('time_receive >', $dt1)
					->where('time_receive <', $dt2)
					->where('log_gift_voucher.receive', 1)
					->get('log_gift_voucher');
				if ($data['gift']->num_rows() > 0) {
					$re = array('code' => 1, 'msg' => 'ค้นหาสำเร็จ', 'data' => $data['gift']->result_array());
				} else {
					$re = array('code' => 0, 'msg' => 'ไม่มีข้อมูลการรับ Gift Voucher');
				}
			} else {
				$re = array('code' => 0, 'msg' => 'ไม่มีข้อมูลใน database');
			}
		} else {

			$data['gift'] = $this->db->select('tb_user.user,tb_gift.gift_name,log_gift_voucher.time_receive,log_gift_voucher.admin')
				->join('tb_user', 'log_gift_voucher.user_id = tb_user.id', 'left')
				->join('tb_gift', 'log_gift_voucher.gift_id = tb_gift.id', 'left')
				->where('time_receive >', $dt1)
				->where('time_receive <', $dt2)
				->where('log_gift_voucher.receive', 1)
				->get('log_gift_voucher');

			if ($data['gift']->num_rows() > 0) {
				$re = array('code' => 1, 'msg' => 'ค้นหาสำเร็จ', 'data' => $data['gift']->result_array());
			} else {
				$re = array('code' => 0, 'msg' => 'ไม่มีข้อมูลการรับ Gift Voucher');
			}
		}

		echo json_encode($re);
		die;
	}
	public function history_transaction()
	{
		$data['auto'] = $this->db->order_by('id', 'DESC')->limit(1000)->get('transactionauto')->result_array();
		$this->load->view('history_transaction', $data);
	}
	public function history_addcredit()
	{

		$this->load->view('history_addcredit');
	}
	public function history_bankuser()
	{
		$data['edit_bank'] = $this->db->select('log_bank.*,tb_login.name as admin_name')
			->join('tb_login', 'tb_login.id = log_bank.admin_id', 'left')
			->order_by('log_bank.id', 'DESC')
			->get('log_bank')
			->result_array();
		//		print_r($data);
		//		die();
		$this->load->view('history_bankuser', $data);
	}
	public function history_state()
	{
		//		$this->sum_state->sum_data_state();
		$data['bw'] = $this->db->select('tb_bank_web.id,tb_bank_web.name,tb_bank_web.account,tb_bank.bank_short')->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id')->get('tb_bank_web')->result_array();
		$this->load->view('history_state', $data);
	}
	public function sel_state()
	{

		$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
		$tset	= $this->input->post('typeset');
		$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));


		if ($this->input->post('type') == 'reject') {
			$wit = $this->db->select('
					tb_withdraw.*,tb_user.user,tb_user.username,tb_login.name as admin')
				->join('tb_user', 'tb_user.id = tb_withdraw.user_id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_withdraw.bank_api', 'left')
				->join('tb_login', 'tb_login.id = tb_withdraw.admin_check', 'left')
				->where('tb_withdraw.status', 3)
				->where('tb_withdraw.time >', $dt1)
				->where('tb_withdraw.time <', $dt2)
				->order_by('tb_withdraw.id', 'DESC')->get('tb_withdraw')->result_array();
			$k = 0;
			foreach ($wit as $wt) {
				$wit[$k]['newtime'] = date('m-d-y H:i:s', $wt['time']);
				$wit[$k]['amount1'] = number_format($wt['amount'], 2);

				$k++;
			}
			$re = array('code' => 2, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $wit);
		} else {
			$state = $this->db->select('
			tb_statement.*,tb_user.user,tb_user.username,tb_user_bank.account,tb_bank.bank_short,tb_login.name as admin_name,tb_bank_web.name as bw_name,tb_bank_web.account as bw_acc')
				->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
				->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
				->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
				->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
				->where('tb_statement.dateCreate >', $dt1)
				->where('tb_statement.dateCreate <', $dt2);

			if ($tset == 2) {
				$this->db->where('tb_statement.user_id !=', 0);
			} else if ($tset == 3) {
				$this->db->where('tb_statement.status', 3);
			} else {
			}
			if ($this->input->post('type') == '' && $this->input->post('bank_id') == '' && $this->input->post('user') == '') { //ไม่เลือก

			} else if ($this->input->post('bank_id') == '' && $this->input->post('user') == '') { //เลือกประเภท
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			} else if ($this->input->post('type') == ''  && $this->input->post('user') == '') { //เลือกแบงค์
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
			} else if ($this->input->post('type') == '' && $this->input->post('bank_id') == '') { //เลือกยูเซอร์

				$this->db->where('tb_user.user', $user);
			} else if ($this->input->post('type') == '') { //เลือกแบงค์ //เลือกยูเซอร์

				$this->db->where('tb_user.user', $user);
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
			} else if ($this->input->post('bank_id') == '') { //เลือกประเภท เลือกยูเซอร์

				$this->db->where('tb_user.user', $user);
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			} else if ($this->input->post('user') == '') { //เลือกประเภท เลือกแบงค์ .
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			} else {

				$this->db->where('tb_user.user', $user);
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			}

			$state = $this->db->where('tb_statement.status !=', 5)->order_by('tb_statement.id', 'DESC')->get('tb_statement')->result_array();
			$i = 0;
			foreach ($state as $st) {
				$state[$i]['newTime1'] = date('m-d-y H:i:s', $st['datetime']);
				$state[$i]['newTime2'] = date('m-d-y H:i:s', $st['dateCreate']);
				$state[$i]['deposit1'] = number_format($st['deposit'], 2);
				$state[$i]['withdraw1'] = number_format($st['withdraw'], 2);

				$i++;
			}
			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $state);
		}
		echo json_encode($re);
		die();
	}

	public function sel_user()
	{
		if ($this->input->post('user')) {
			$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
			$dt1 	= $this->input->post('dt1');
			$dt2 	= $this->input->post('dt2');
			$arr_depAPI = array(
				'AgentName' 	=> $this->getapi_model->agent(),
				'PlayerName' 	=> $user,
				'From' 			=> date('m/d/Y', strtotime($dt1) - (1 * 24 * 60 * 60)), //01/01/2020
				'To' 			=> $dt2, //01/01/2020
				'TransferType' 	=> -1, //(2:Deposit/3:Withdraw)
				'PageSize' 		=> 50,
				'PageIndex' 	=> 1,
				'TimeStamp' 	=> time()
			);
			$dataAPI = array(
				'type'		=> 'D',
				'agent' 	=> $this->getapi_model->agent(),
				'member' 	=> $user,
			);
			$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/transferlogs';
			$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
			//			echo '<pre>';
			//			print_r($arr_depAPI);
			//			print_r($cre_userAPI);
			//			die();
			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $cre_userAPI->Result->Records);
		} else {
			$re = array('code' => 0, 'title' => 'สำเร็จ', 'msg' => 'กรุณากรอกรหัสลูกค้า', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}
	// public function log_transfer()
	// {
	// 	if ($this->input->post()) {
	// 		$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
	// 		$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
	// 		$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
	// 		$log_transfer = $this->db->select('
	// 		log_credit.*,tb_user.user,tb_user.username,tb_login.name as admin_name')
	// 			->join('tb_user', 'tb_user.id = log_credit.user_id', 'left')
	// 			->join('tb_login', 'tb_login.id = log_credit.admin_id', 'left')
	// 			->where('log_credit.create_time >', $dt1)
	// 			->where('log_credit.create_time <', $dt2);
	// 		if ($this->input->post('user') != '') {
	// 			$this->db->where('tb_user.user', $user);
	// 		}

	// 		$log_transfer = $this->db->order_by('log_credit.id', 'DESC')
	// 			->get('log_credit')
	// 			->result_array();
	// 		echo json_encode(array('data' => $log_transfer, 'code' => 1));
	// 		die();
	// 	} else {
	// 		$data['log_transfer'] = $this->db->select('
	// 		log_credit.*,tb_user.user,tb_user.username,tb_login.name as admin_name')
	// 			->join('tb_user', 'tb_user.id = log_credit.user_id', 'left')
	// 			->join('tb_login', 'tb_login.id = log_credit.admin_id', 'left')
	// 			//				->where('log_credit.create_time >=',strtotime(date('d-m-Y 00:00:00')))
	// 			->order_by('log_credit.id', 'DESC')
	// 			->limit(250)
	// 			->get('log_credit')
	// 			->result_array();
	// 		$this->load->view('log_transfer', $data);
	// 	}
	// }


	public function log_transfer()
	{
		if ($this->input->post()) {
			$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
			$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
			
			$log_transfer = $this->db->select('
			log_credit.*,tb_user.user,tb_user.username,tb_login.name as admin_name')
				->join('tb_user', 'tb_user.id = log_credit.user_id', 'left')
				->join('tb_login', 'tb_login.id = log_credit.admin_id', 'left')
				->where('log_credit.create_time >', $dt1)
				->where('log_credit.create_time <', $dt2);
			if ($this->input->post('user') != '') {
				// $this->db->where('tb_user.user', substr($user,-6));
				$this->db->where('log_credit.user_id',substr($user,-6));
			}

			$log_transfer = $this->db->order_by('log_credit.id', 'DESC')
				->get('log_credit')
				->result_array();
			echo json_encode(array('data' => $log_transfer, 'code' => 1));
			die();
		} else {
			$dt1 	= strtotime(date('d-m-Y 00:00:00'));
			$dt2 	= strtotime(date('d-m-Y 23:59:59'));
			$data['log_transfer'] = $this->db->select('
			log_credit.*,tb_user.user,tb_user.username,tb_login.name as admin_name')
				->join('tb_user', 'tb_user.id = log_credit.user_id', 'left')
				->join('tb_login', 'tb_login.id = log_credit.admin_id', 'left')
				->where('log_credit.create_time >=',$dt1)
				->where('log_credit.create_time <=',$dt2)
				->order_by('log_credit.id', 'DESC')
				->limit(250)
				->get('log_credit')
				->result_array();
			
			$this->load->view('log_transfer', $data);
		}
	}


	public function history_logpass()
	{
		if ($this->input->post()) {
			$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$date_end 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
			$sh_all  = $this->db->where('create_time >=', $date_start)->where('create_time <=', $date_end)->get('log_pass')->result_array();
			$k = 0;
			foreach ($sh_all as $r) {
				$sh_all[$k]['create_time'] = date('d/m/Y H:i:s', $r['create_time']);
				$k++;
			}
			$re = array('code' => 1, 'data' => $sh_all);
			echo json_encode($re);
			die();
		} else {
			$data['lg_pass'] = $this->db->where('create_time >=', strtotime(date('Y-m-d 00:00:00')))->where('create_time<=', strtotime(date('Y-m-d 23:59:59')))
				->get('log_pass')->result_array();
			$this->load->view('history_pw', $data);
		}
	}

	//ประวัติการเพิ่มคะแนนพ้อย
	public function history_score()
	{
		if ($this->input->post()) {
			$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$date_end 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
			// 0 แสดงข้อมูลทั้งหมด  3 แสดงข้อมูลการเพิ่ม point  4 แสดงข้อมูลการลบ Point
			if ($this->input->post('type') == 0) {
				$all = $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
					->where_in('type', array(0, 1))
					->where('create_time >=', $date_start)
					->where('create_time <=', $date_end)
					->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
					->get('log_poin_and_spin')
					->result_array();
				$k = 0;
				foreach ($all as $wt) {
					$all[$k]['create_time'] = date('d-M-Y H:i:s', $wt['create_time']);
					$k++;
				}
				$re = array('code' => 1, 'data' => $all);
				echo json_encode($re);
				die();
			} else if ($this->input->post('type') == 3) {
				$all =  $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
					->where_in('type', 0)
					->where('create_time >=', $date_start)
					->where('create_time <=', $date_end)
					->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
					->get('log_poin_and_spin')
					->result_array();
				$k = 0;
				foreach ($all as $wt) {
					$all[$k]['create_time'] = date('d-M-Y H:i:s', $wt['create_time']);
					$k++;
				}
				$re = array('code' => 1, 'data' => $all);
				echo json_encode($re);
				die();
			} else {
				$all = $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
					->where_in('type', 1)
					->where('create_time >=', $date_start)
					->where('create_time <=', $date_end)
					->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
					->get('log_poin_and_spin')
					->result_array();
				$k = 0;
				foreach ($all as $wt) {
					$all[$k]['create_time'] = date('d-M-Y H:i:s', $wt['create_time']);
					$k++;
				}
				$re = array('code' => 1, 'data' => $all);
				echo json_encode($re);
				die();
			}
		} else {
			$data['log_poin'] =  $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
				->where_in('type', array(0, 1))
				->where('create_time >=', strtotime(date('Y-m-d 00:00:00')))
				->where('create_time <=', strtotime(date('Y-m-d 23:59:59')))
				->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
				->get('log_poin_and_spin')
				->result_array();
			$this->load->view('history_score', $data);
		}
	}
	// ประวัติการเพิ่ม spin 
	public function history_spin()
	{
		if ($this->input->post()) {
			$type = $this->input->post('type');
			if (isset($type)) {
				$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
				$date_end 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
				if ($type == 0) { //ทั้งหมด
					$all = $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
						->where_in('type', array(3, 4))
						->where('create_time >=', $date_start)
						->where('create_time <=', $date_end)
						->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
						->get('log_poin_and_spin')
						->result_array();
					$k = 0;
					foreach ($all as $wt) {
						$all[$k]['create_time'] = date('d-M-Y H:i:s', $wt['create_time']);
						$k++;
					}
					$re = array('code' => 1, 'data' => $all);
				}
				if ($type == 'add') { //เพิ่ม
					$all = $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
						->where_in('type', 3)
						->where('create_time >=', $date_start)
						->where('create_time <=', $date_end)
						->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
						->get('log_poin_and_spin')
						->result_array();
					$k = 0;
					foreach ($all as $wt) {
						$all[$k]['create_time'] = date('d-M-Y H:i:s', $wt['create_time']);
						$k++;
					}
					$re = array('code' => 1, 'data' => $all);
				}
				if ($type == 'down') { //ลบ
					$all = $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
						->where_in('type', 4)
						->where('create_time >=', $date_start)
						->where('create_time <=', $date_end)
						->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
						->get('log_poin_and_spin')
						->result_array();
					$k = 0;
					foreach ($all as $wt) {
						$all[$k]['create_time'] = date('d-M-Y H:i:s', $wt['create_time']);
						$k++;
					}
					$re = array('code' => 1, 'data' => $all);
				}
				echo json_encode($re);
				die();
			}
		} else {
			$data['all'] = $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
				->where_in('type', array(3, 4))
				->where('create_time >=', strtotime(date('Y/m/d 00:00:00')))
				->where('create_time <=', strtotime(date('Y/m/d 23:59:59')))
				->join('tb_login', 'tb_login.id = log_poin_and_spin.admin_id', 'left')
				->get('log_poin_and_spin')
				->result_array();
			$this->load->view('history_spin', $data);
		}
	}



	public function history_safecode()
	{
		$this->load->view('log_safecode');
	}
	public function  select_logsafecode()
	{
		$n = $this->input->post('n');
		if (isset($n)) {
			$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$date_end 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
			if ($n == 0) { //ทั้งหมด
				$all = $this->db->select('log_safecode.*,tb_login.name')
					->join('tb_login', 'tb_login.id = log_safecode.admin_id', 'left')
					->get('log_safecode')
					->result_array();
				$k = 0;
				foreach ($all as $wt) {
					$all[$k]['time_log'] = date('d-M-Y H:i:s', $wt['time_log']);
					$k++;
				}
				$re = array('code' => 1, 'data' => $all);
			}
			if ($n == 1) {
				$all = $this->db->select('log_safecode.*,tb_login.name')
					->where('time_log >=', $date_start)
					->where('time_log <=', $date_end)
					->join('tb_login', 'tb_login.id = log_safecode.admin_id', 'left')
					->get('log_safecode')
					->result_array();
				$k = 0;
				foreach ($all as $wt) {
					$all[$k]['time_log'] = date('d-M-Y H:i:s', $wt['time_log']);
					$k++;
				}
				$re = array('code' => 1, 'data' => $all);
			}
		}
		echo json_encode($re);
		die();
	}
	/* -------------------- log ตัดเทิร์น ----------------------------------------- */
	public function history_reset_turn()
	{
		$this->load->view('history_turn');
	}
	public function select_reset_turn()
	{
		$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));

		$data['reset'] = $this->db->select('tb_user.user,tb_login.username,log_reset_turn.before_reset,log_reset_turn.time_reset')
			->join('tb_user', 'log_reset_turn.user_id = tb_user.id', 'left')
			->join('tb_login', 'log_reset_turn.admin_id = tb_login.id', 'left')
			->where('time_reset > ', $dt1)
			->where('time_reset < ', $dt2)
			->get('log_reset_turn')->result_array();

		$re = array('code' => 1, 'data' => $data);
		echo json_encode($re);
		die;
	}
	/* -------------------- end----------------------------------------- */
}

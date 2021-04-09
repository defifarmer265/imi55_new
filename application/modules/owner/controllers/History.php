<?php
class History extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->_init();
		$this->load->library('users/users_library');
		$this->load->model('backend/getapi_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();
	}

	private function _init()
	{
		$this->output->set_template('tem_owner/tem_owner');
	}

	public function index()
	{

		echo ' History';
		die();
	}
	public function history_salelogin()
	{
		if ($this->input->post()) {
			$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
			$sale   =     $this->db->select('log_sale.*,tb_sale.name as sale_name')
				->join('tb_sale', 'tb_sale.id = log_sale.sale_id', 'left')
				->where('log_sale.datetime >=', $date_start)
				->where('log_sale.datetime <=', $date_end)
				->get('log_sale')->result_array();
			$k = 0;
			foreach ($sale as $sa) {
				$sale[$k]['datetime'] = date('d-m-Y H:i:s', $sa['datetime']);
				$k++;
			}
			$re = array('code' => 1, 'data' => $sale);
			echo json_encode($re);
			die();
		} else {
			$data['sale'] = $this->db
				->select('log_sale.*,tb_sale.name as sale_name')
				->join('tb_sale', 'tb_sale.id = log_sale.sale_id', 'left')
				->order_by('id', 'DESC')->limit(1000)->get('log_sale')->result_array();
			$this->load->view('history_salelogin', $data);
		}
	}
	public function history_adminlogin()
	{
		if ($this->input->post()) {
			$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
			$admin = $this->db->select('log_login.*,tb_login.name,tb_login.username')
				->join('tb_login', 'tb_login.id = log_login.admin_id', 'left')
				->where('log_login.time_login >=', $date_start)
				->where('log_login.time_login <=', $date_end)
				->order_by('log_login.id', 'DESC')
				->get('log_login')->result_array();
			$k = 0;
			foreach ($admin as $r) {
				$admin[$k]['time_login'] =  date('d-m-Y H:i:s', $r['time_login']);
				$admin[$k]['time_logout'] = date('d-m-Y H:i:s', $r['time_logout']);
				$k++;
			}
			$re = array('code' => 1, 'data' => $admin);
			echo json_encode($re);
			die();
		} else {
			$data['admin'] = $this->db->select('log_login.*,tb_login.name,tb_login.username')
				->join('tb_login', 'tb_login.id = log_login.admin_id', 'left')
				->order_by('log_login.id', 'DESC')->limit(1000)->get('log_login')->result_array();
			$this->load->view('history_adminlogin', $data);
		}
	}

	public function history_usersLogin()
	{
		if ($this->input->post()) {
			$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));

			$user  = $this->db->select('id,user_id,ip,platform, COUNT(platform)as countPlatform,create_time')
				->where('create_time >=', $date_start)
				->where('create_time <=', $date_end)
				->group_by('user_id')
				->group_by('ip')
				->order_by('id', 'DESC')
				->get('log_user_login')->result_array();
			$k = 0;
			foreach ($user as $u) {
				$user[$k]['user'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
				// $user[$k]['user'] = $u['user_id'];
				$user[$k]['createtime'] = date('d-m-Y H:i:s', $u['create_time']);
				$k++;
			}
			$re = array('code' => 1, 'data' => $user);
			echo json_encode($re);
			die();
		} else {
			$data['user'] = $this->db->select('id,user_id,ip,create_time,platform, COUNT(platform)as countPlatform,create_time')
				->where('create_time >=', strtotime(date('Y-m-d 00:00:00')))
				->where('create_time <=', strtotime(date('Y-m-d 23:59:59')))
				->group_by('user_id')
				->group_by('ip')
				->order_by('id', 'DESC')->limit(1000)
				->get('log_user_login')->result_array();
			$this->load->view('history_userslogin', $data);
		}
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

			$state = $this->db->order_by('tb_statement.id', 'DESC')->get('tb_statement')->result_array();
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
	public function log_transfer()
	{

		$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		// $user = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);

		if ($this->input->post('user')) {
			$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);

			$data['log_transfer'] = $this->db->select('
			log_credit.*,tb_user.user,tb_user.username,tb_login.name as admin_name')
				->join('tb_user', 'tb_user.id = log_credit.user_id', 'left')
				->join('tb_login', 'tb_login.id = log_credit.admin_id', 'left')
				->where('log_credit.create_time >', $dt1)
				->where('log_credit.create_time <', $dt2)
				->where('tb_user.user', $user)
				->order_by('log_credit.id', 'DESC')
				->get('log_credit')
				->result_array();
			echo json_encode(array('data' => $data['log_transfer'], 'code' => 1));
			die();
		} else {
			$data['log_transfer'] = $this->db->select('
			log_credit.*,tb_user.user,tb_user.username,tb_login.name as admin_name')
				->join('tb_user', 'tb_user.id = log_credit.user_id', 'left')
				->join('tb_login', 'tb_login.id = log_credit.admin_id', 'left')
				->order_by('log_credit.id', 'DESC')
				->limit(250)
				->get('log_credit')
				->result_array();
		}
		$this->load->view('log_transfer', $data);
	}

	public function select_point()
	{
		$type = $this->input->post('type');
		if (isset($type)) {
			$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$date_end 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
			if ($type == 0) { //ทั้งหมด
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
			}
			if ($type == 3) { //เพิ่ม
				$all = $this->db->select('log_poin_and_spin.*,tb_login.id,tb_login.name')
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
			}
			if ($type == 4) { //ลบ
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
			}
		}
		echo json_encode($re);
		die();
	}

	public function  select_spin()
	{

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
		}
		echo json_encode($re);
		die();
	}

	public function history_score()
	{
		$this->load->view('history_score');
	}

	public function history_spin()
	{
		$this->load->view('history_spin');
	}


	public function select_ip()
	{
		$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$date_end 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$day7        = strtotime(date('d-m-Y 00:00:00')) - (7 * 24 * 60 * 60);
		$data['log_ip'] = $this->db->select('id,user_id,action,ip,create_time,COUNT(DISTINCT(user_id))as c_user_id')
			->where('create_time >', $day7)
			// ->where('create_time <',$date_end)
			->where('action', 1)
			->group_by('ip')
			->order_by('create_time', 'DESC')
			->having('COUNT(user_id) >', 2)
			->get('log_user_login')
			->result_array();
		$this->load->view('log_ip', $data);
	}
	public function v_log_ip()
	{
		$ip  = $this->input->post('ip');
		$day7        = strtotime(date('d-m-Y 00:00:00')) - (7 * 24 * 60 * 60);
		$query =  $this->db->select('ip,user_id,action,create_time,COUNT(user_id)as c_user_id')
			->where('create_time >', $day7)
			->where('action', 1)
			->where('ip', $ip)
			->group_by('user_id')
			// ->having('COUNT(user_id) >',1)
			->order_by('create_time', 'DESC')
			->get('log_user_login')
			->result_array();
		$k = 0;
		foreach ($query as $lg_ip) {
			$query[$k]['c_user_id']   = $lg_ip['c_user_id'];
			$query[$k]['user_id'] = $user = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($lg_ip['user_id']))), -6);
			$query[$k]['user'] = $lg_ip['user_id'];
			$query[$k]['create_time'] = date('d/m/Y H:i:s', $lg_ip['create_time']);
			$k++;
		}
		$re = array('code' => 1, 'data' => $query);
		echo json_encode($re);
		die();
	}
	public function showall()
	{
		$ip   =  $this->input->post('ip');
		$user = $this->input->post('user');
		$day7        = strtotime(date('d-m-Y 00:00:00')) - (7 * 24 * 60 * 60);

		$query = $this->db->select('*')
			->where('ip', $ip)
			->where('create_time >', $day7)
			->where('action', 1)
			->where('user_id', $user)
			->order_by('create_time', 'DESC')
			->get('log_user_login')
			->result_array();
		$k = 0;
		foreach ($query as $lg_all) {
			//   $query[$k]['c_user_id'] = $lg_all['c_user_id'];
			$query[$k]['user_id'] = $uslg_aller = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($lg_all['user_id']))), -6);
			$query[$k]['user'] = $lg_all['user_id'];
			$query[$k]['create_time'] = date('d/m/Y  H:i:s', $lg_all['create_time']);
			$k++;
		}
		$re = array('code' => 1, 'data' => $query);
		echo json_encode($re);
		die();
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


	//-----------------------------------------------------------------------------ส่วนของ log ------------------------------------------------

	// ส่วนนี้สำหรับเรียกหน้า log all เพื่อดูเมนูที่มี
	public function all_log()
	{
		$this->load->view('history_log');
	}



	// log admin
	public function search_admin()
	{
		$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$admin = $this->db->select('log_login.*,tb_login.name,tb_login.username')
			->join('tb_login', 'tb_login.id = log_login.admin_id', 'left')

			->where('log_login.time_login >=', $date_start)
			->where('log_login.time_login <=', $date_end)
			->order_by('log_login.id', 'DESC')
			->get('log_login')->result_array();
		$k = 0;
		foreach ($admin as $r) {
			// echo '<pre>';
			// print_r($r);
			// die;
			if ($r['name'] == '') {
				$admin[$k]['name'] = '-';
			} else {
				$admin[$k]['name'] = $r['name'];
			}

			$admin[$k]['time_login'] =  date('d/m/Y H:i:s', $r['time_login']);


			if ($r['time_logout'] == '') {
				$admin[$k]['time_logout'] = '-';
			} else {
				$admin[$k]['time_logout'] = date('d/m/Y H:i:s', ((int)$r['time_logout']));
			}



			$k++;
		}


		$re = array('code' => 1, 'data' => $admin);
		echo json_encode($re);
		die();
	}
	// end admin



	// log sale
	public function search_sale()
	{
		$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$sale   =     $this->db->select('log_sale.*,tb_sale.name as sale_name')
			->join('tb_sale', 'tb_sale.id = log_sale.sale_id', 'left')
			->where('log_sale.datetime >=', $date_start)
			->where('log_sale.datetime <=', $date_end)
			->get('log_sale')->result_array();
		$k = 0;
		foreach ($sale as $sa) {
			$sale[$k]['datetime'] = date('d-m-Y H:i:s', $sa['datetime']);
			$k++;
		}
		$re = array('code' => 1, 'data' => $sale);
		echo json_encode($re);
		die();
	}
	// end log sale



	// log นี้ใช้สำหรับแสดงการ login ของ user 
	public function search_user()
	{
		$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$user  = $this->db->select('id,user_id,ip,platform, COUNT(platform)as countPlatform,create_time')
			->where('create_time >=', $date_start)
			->where('create_time <=', $date_end)
			->group_by('user_id')
			->group_by('ip')
			->order_by('id', 'DESC')
			->get('log_user_login')->result_array();
		$k = 0;
		foreach ($user as $u) {
			// $user[$k]['user'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
			$user[$k]['user_id'] = $u['user_id'];
			$user[$k]['createtime'] = date('d-m-Y H:i:s', $u['create_time']);

			$k++;
		}
		$re = array('code' => 1, 'data' => $user);
		echo json_encode($re);
		die();
	}
	//  end log user





	// log นี้ใช้สำหรับแสดง การ add turn ที่ table   log_add_turn  tb_login 


	public function search_addtrun()
	{
		$date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$log_edit_user_turn = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'DESC')->get('log_edit_user_turn')->result_array();
		$k = 0;
		foreach ($log_edit_user_turn as $b) {
			if ($b['detail'] == '') {
				$log_edit_user_turn[$k]['detail'] = '-';
			} else {
				$log_edit_user_turn[$k]['detail'] = $b['detail'];
			}
			$log_edit_user_turn[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
			$k++;
		}
		$re = array('code' => 1, 'data' => $log_edit_user_turn);
		echo json_encode($re);
		die();
	}
}
<?php
class Bank extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('getapi_model');
		$this->load->model('withdraw_bbl_model');
		$this->load->model('Bbl_wd_model');
		$this->load->model('True_model');
		$this->load->model('True_wd_model');
		$this->load->library('backend/backend_library');
		$this->_init();
		$this->load->helper('file');
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();
		$this->output->set_template('tem_admin/tem_admin');
	}

	public function index()
	{
		$status_true = array('2', '3');
		$data['bank_web'] = $this->db
			->select('tb_bank_web.*,tb_bank.bank_short,tb_bank.bank_th')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
			//			->join('acc_account','acc_account.bank_id = tb_bank_web.id','left')
			->order_by('tb_bank_web.status', 'DESC')
			->where('tb_bank_web.status', 3)->or_where('tb_bank_web.status', 1)
			->get('tb_bank_web')
			->result_array();
		$i = 0;
		foreach ($data['bank_web'] as $bnk) {
			$row_ste = $this->db->select('SUM(deposit) as sum_dps , SUM(withdraw) as sum_wd')->where_in('status', $status_true)->where('bank_id', $bnk['id'])->get('tb_statement')->row();
			$data['bank_web'][$i]['sum_dps'] = $row_ste->sum_dps;
			$data['bank_web'][$i]['sum_wd'] = $row_ste->sum_wd;
			$i++;
		}
		$data['bank'] = $this->db->get('tb_bank')->result_array();
		//		echo '<pre>';
		//		print_r($data);die();
		$this->load->view('bank', $data);
	}

	public function install_true(){
		$idbabnk = ($this->input->post('id'));

		$req_otp = $this->True_model->RequestLoginOTP($idbabnk);
	
		if($req_otp['code'] == 'MAS-200'){
			echo json_encode(array('code' => 1,'data'=> $req_otp['data'],'idbank'=>$idbabnk));
		}else{
			echo json_encode(array('code' => 0,'data'=> $req_otp['title'],'idbank'=>$idbabnk));
		}
		die();
	}
	public function install_true_wd(){
		$req_otp = $this->True_wd_model->RequestLoginOTP();
		if($req_otp['code'] == 'MAS-200'){
			echo json_encode(array('code' => 1,'data'=> $req_otp['data']));
		}else{
			echo json_encode(array('code' => 0,'data'=> $req_otp));
		}
		die();
	}
	public function submit_otp_true(){
		
		$otp = $this->input->post('otp');
		$tell = $this->input->post('tell');
		$ref = $this->input->post('ref');
		$idbabnk = ($this->input->post('idbank'));
		
		$submit_otp = $this->True_model->SubmitLoginOTP($otp,$tell,$ref,$idbabnk);
		
		if($submit_otp['code'] == 'MAS-200'){
			echo json_encode(array('code' => 1,'data'=> $submit_otp['data']));
		}else{
			echo json_encode(array('code' => 0,'data'=> $submit_otp['title']));
		}
		die();
	}
	public function submit_otp_true_wd(){
		
		$otp = $this->input->post('otp');
		$tell = $this->input->post('tell');
		$ref = $this->input->post('ref');
		$submit_otp = $this->True_wd_model->SubmitLoginOTP($otp,$tell,$ref);
		
		if($submit_otp['code'] == 'MAS-200'){
			echo json_encode(array('code' => 1,'data'=> $submit_otp['data']));
		}else{
			echo json_encode(array('code' => 0,'data'=> $submit_otp['title']));
		}
		die();
	}
	public function bank_auto()
	{
		$data['bank'] 		= $this->db->get('tb_bank')->result_array();
		$data['bankAuto'] =  $this->db
			->select('
							acc_account.username,acc_account.password,acc_account.status,acc_account.id,acc_account.type,
							tb_bank.bank_short,tb_bank.bank_th,
							tb_bank_web.account,tb_bank_web.name,tb_bank_web.id as bank_web_id,
							tb_withdraw_limit.limit_amount
							')
			->join('tb_bank_web', 'tb_bank_web.id = acc_account.bank_id', 'left')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
			->join('tb_withdraw_limit', 'tb_withdraw_limit.bank_id = acc_account.id', 'left')
			->where('tb_bank_web.status !=', 4)
			->where('acc_account.status !=', 4)
			->get('acc_account')
			->result_array();
		$data['menu'] = 'bank_auto';
		$this->load->view('bank_auto', $data);
	}
	public function bank_setting()
	{
		$data['group_r']	= $this->db->get('tb_group')->result_array();
		$data['bank'] 		= $this->db->get('tb_bank')->result_array();
		$data['bank_web'] 	= $this->db
			->select('tb_bank_web.*,tb_bank.bank_short,tb_bank.bank_th')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id')
			->where('tb_bank_web.status !=', 4)
			->order_by('tb_bank_web.status', 'DESC')
			->get('tb_bank_web')
			->result_array();

		$i = 0;
		foreach ($data['bank_web'] as $bnk) {
			$data['bank_web'][$i]['bgu'] = $this->db->select('tb_bank_group.*,tb_group.name')
				->join('tb_group', 'tb_group.id = tb_bank_group.group_id', 'left')
				->where('tb_bank_group.bank_id', $bnk['id'])
				->where('tb_bank_group.status', 1)
				->get('tb_bank_group')
				->result_array();
			$i++;
		}

		$this->load->view('bank_setting', $data);
	}
	//ตั้งค่ายอดถอนขั้นต่ำ
	public function bank_setWD()
	{
		$wd = $this->db->get('tb_withdraw_min')->result_array();
		foreach ($wd as $w) {
			if ($w['name'] == 'wd_min') {

				$wd_min = $w['amount'];
			} else if ($w['name'] == 'turn_min') {

				$turn_min = $w['amount'];
			} else if ($w['name'] == 'count_wd') {

				$count_wd = $w['amount'];
			} else if ($w['name'] == 'wd_max') {

				$wd_max = $w['amount'];
			}
		}
		$data['wd_min'] 	= $wd_min;
		$data['turn_min'] 	= $turn_min;
		$data['wd_count'] 	= $count_wd;
		$data['wd_max'] 	= $wd_max;
		$this->load->view('bank_setWD', $data);
	}
	public function get_stm_bbl()
	{
		
		// $data = 'My Text here';

		// if ( !write_file('public/token/file.txt', $data)){
		// 	echo 'Unable to write the file';
		// }else{
		// 	echo "1234";
		// }
		// die();
		$bankweb_id = $this->input->post('id');
		$tran = json_decode($this->withdraw_bbl_model->GetTransaction($bankweb_id));
		if ($tran) {
			$arr = array('data' => $tran, 'code' => 1);
		} else {
			$arr = array('data' => $tran, 'code' => 1);
		}
		echo json_encode($arr);
		//print_r($tran);
		die();
	}
	// สร้าง /แก้ไข ธนาคาร
	public function bank_create()
	{
		// print_r($this->input->post());

		//แก้ไข
		if ($this->input->post('name') && $this->input->post('account') && $this->input->post('bank_id') && $this->input->post('type') && $this->input->post('id') != '') {
			$name 		= $this->input->post('name');
			$account 	= $this->input->post('account');
			$bank_id 	= $this->input->post('bank_id');
			$type 		= $this->input->post('type');
			$id 		= $this->input->post('id');

			$name_bank  =  $this->db->where('id', $bank_id)->get('tb_bank')->row()->bank_short;
			$type_new = ($type == 1) ? 'ฝาก' : 'ถอน';
			$data_bank_new = 'ชื่อ : ' . $name . ' บัญชี : ' . $account . $name_bank . ' รายการ : ' . $type_new;
			$bank_old = $this->db->select('tb_bank_web.*,tb_bank.bank_short')->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id')->where('tb_bank_web.id', $id)->get('tb_bank_web')->row();
			$type_old = ($type == 1) ? 'ฝาก' : 'ถอน';
			$data_bank_old = 'ชื่อ : ' . $bank_old->name . ' บัญชี : ' . $bank_old->account . $bank_old->bank_short . ' รายการ : ' . $type_old;

			$arrBankW = array(
				'name'		=> $name,
				'account'	=> $account,
				'bank_id'	=> $bank_id,
				'type'		=> $type
			);
			if ($this->db->where('id', $id)->update('tb_bank_web', $arrBankW)) {

				/*--------------------------log_bank_edit----------------------------------- */
				$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

				$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$hostname = $hostname[0]['hostname'];

				$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$dbname = $dbname[0]['database_name'];
				$time = time();

				$sql = "INSERT INTO log_bank_edit (admin,detail,datetime) 
				VALUES ('" . $this->session->userdata['admin']['username'] . "','" . 'old : ' . $data_bank_old . ' new : ' . $data_bank_new . "','" . $time . "')";
				if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
				} else {

					$sql = "CREATE TABLE log_bank_edit (
						 id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						 admin VARCHAR(20) NOT NULL,
						 detail VARCHAR(255) NOT NULL,
						 datetime INT(20) NOT NULL
						 ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
					$sql = "INSERT INTO log_bank_edit (admin,detail,datetime) 
					 VALUES ('" . $this->session->userdata['admin']['username'] . "','" . 'old : ' . $data_bank_old . ' new : ' . $data_bank_new . "','" . $time . "')";


					$this->backend_library->query_sql($hostname, $dbname, $sql);
				}
				/*--------------------------end log_bank_edit----------------------------------- */


				$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
			} else {
				$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
			}
			//สร้างใหม่	
		} else if ($this->input->post('name') && $this->input->post('account') && $this->input->post('bank_id') && $this->input->post('type')) {
			$name 		= $this->input->post('name');
			$account 	= $this->input->post('account');
			$bank_id 	= $this->input->post('bank_id');
			$type 		= $this->input->post('type');
			$arrBankW = array(
				'name'		=> $name,
				'account'	=> $account,
				'bank_id'	=> $bank_id,
				'type'		=> $type,
				'account_check'		=> substr($account, -6),
				'create_time' => time(),
				'status'	=> 1
			);
			if ($this->db->insert('tb_bank_web', $arrBankW)) {
				$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
			} else {
				$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}

	//เปิด/เปิดธนาคาร
	public function bank_status()
	{
		if ($this->input->post('id')) {
			$id 	= $this->input->post('id');
			$status = $this->input->post('status');
			if ($this->db->set('status', $status)->where('id', $id)->update('tb_bank_web')) {
				$this->log_bank($id, 'แก้ไขสถานะ');
				$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
			} else {
				$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}


	//เรียกดูรายการแบงค์
	public function bank_statement()
	{

		if ($this->uri->segment(4) != '') {
			$bank_id = $this->uri->segment(4);
			$data['state'] = $this->db
				->select('tb_statement.*,tb_login.name as admin_name,tb_user.user')
				->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
				->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
				->where('tb_statement.bank_id', $bank_id)
				->order_by('tb_statement.id', 'DESC')
				->limit(500)
				->get('tb_statement')
				->result_array();
			$data['bankWeb'] 	= $this->db->where('id', $bank_id)->get('tb_bank_web')->row();
			$data['menu'] 		= 'bank';
			$this->load->view('bank_state', $data);
		} else {
			redirect('backend/bank', 'refresh');
		}
	}

	//สร้าง statement 
	public function bank_statement_create()
	{
		//Array ( [type] => 2 [state_date] => 04/12/2020 [state_time] => 15:24 [amount] => 500000 [note] => TTB 6510 )
		// print_r($this->input->post());
		// die;
		if ($this->input->post('bank_id') && $this->input->post('type') && $this->input->post('state_date') && $this->input->post('state_time') && $this->input->post('amount') && $type = $this->input->post('note')) {
			//			echo 'adsf';
			//			print_r($this->input->post());die();
			$state_bank_id	= $this->input->post('bank_id');
			$state_type		= $this->input->post('type'); //1ฝาก 2ถอน
			$datetime 		= $this->input->post('state_date') . " " . $this->input->post('state_time');
			$state_datetime = strtotime($datetime);
			$state_amount	= $this->input->post('amount');
			$status			= $this->input->post('status');
			$state_note 	= $this->input->post('note');


			if ($state_type == 1) {
				$state_deposit = $state_amount;
				$state_withdraw = 0;
			} else if ($state_type == 2) {
				$state_deposit = 0;
				$state_withdraw = $state_amount;
			} else {
				$state_deposit = 0;
				$state_withdraw = 0;
			}
			$arrState = array(
				'bank_id' 	=> $state_bank_id,
				'datetime' => $state_datetime,
				'deposit' => $state_deposit,
				'withdraw' => $state_withdraw,
				'fee' => 0,
				'note' => $state_note,
				'dateCreate' => time(),
				'from_name' => '',
				'from_account' => '',
				'from_bank' => '',
				'admin_id' => $this->session->userdata['users']['id'],
				'status' => $status,
			);
			if ($inState = $this->db->insert('tb_statement', $arrState)) {

				if ($status == 1) {
					$type = 'user';
				}
				if ($status == 3) {
					$type = 'system';
				}
				if ($state_type == 1) {
					$detail = 'deposit : ' . $state_amount;
				}
				if ($state_type == 2) {
					$detail = 'withdraw : ' . $state_amount;
				}

				/*--------------------------log_bank_addlist----------------------------------- */
				$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

				$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$hostname = $hostname[0]['hostname'];

				$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$dbname = $dbname[0]['database_name'];
				$time = time();

				$sql = "INSERT INTO log_bank_addlist (admin, type,detail,datetime) 
				VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $type . "','" . $detail . "','" . $time . "')";
				if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
				} else {

					$sql = "CREATE TABLE log_bank_addlist (
						 id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						 admin VARCHAR(20) NOT NULL,
						 type VARCHAR(10) NOT NULL,
						 detail VARCHAR(100) NOT NULL,
						 datetime INT(20) NOT NULL
						 ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
					$sql = "INSERT INTO log_bank_addlist (admin, type,detail,datetime) 
					 VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $type . "','" . $detail . "','" . $time . "')";


					$this->backend_library->query_sql($hostname, $dbname, $sql);
				}
				/*--------------------------end log_bank_addlist----------------------------------- */

				$re = array('msg' => 'บันทึกสำเร็จ', 'code' => 1, 'title' => 'สำเร็จ'); //Error
			} else {
				$re = array('msg' => 'บันทึกข้อมูลไม่สำเร็จ กรุณาลองใหม่อีกครั้งค่ะ', 'code' => 0, 'title' => 'ไม่สำเร็จ'); //Error
			}
		} else {
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน', 'code' => 0, 'title' => 'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
		die();
	}

	public function Del_state()
	{
		$state_id = $this->input->post('state_id');
		$Arr_state = array(
			'status' => 4
		);
		if ($this->db->where('id', $state_id)->update('tb_statement', $Arr_state)) {

			$re = array('code' => 1, 'msg' => 'ปิดการใช้งานเรียบร้อยแล้วคะ');
		} else {
			$re = array('code' => 0, 'msg' => 'ปิดการใช้ไม่สำเร็จคะ ติดต่อมะพร้าว');
		}

		echo json_encode($re);
		die();
	}

	public function bank_auto_create()
	{
		if ($this->input->post('name') && $this->input->post('account') && $this->input->post('bank_id') && $this->input->post('type') && $this->input->post('username') && $this->input->post('password')) {
			$name 		= $this->input->post('name');
			$account 	= $this->input->post('account');
			$bank_id 	= $this->input->post('bank_id');
			$type 		= $this->input->post('type');
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');
			$bank_short = $this->db->where('id', $bank_id)->get('tb_bank')->row()->bank_short;
			$arrBankW = array(
				'name'		=> $name,
				'account'	=> $account,
				'bank_id'	=> $bank_id, //bank_id = tb_bank
				'type'		=> $type,
				'account_check'		=> substr($account, -6),
				'create_time' => time(),
				'status'	=> 3
			);

			if ($this->db->insert('tb_bank_web', $arrBankW)) {
				$arrBankAuto = array(
					'username'	=> $username,
					'password'	=> $password,
					'bank_short' => $bank_short,
					'bank_id'	=> $this->db->insert_id(), //bank_id = bank_web_id
					'type'		=> $type,
					'status'	=> 0
				);
				if ($this->db->insert('acc_account', $arrBankAuto)) {
					$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
				} else {
					$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
				}
			} else {
				$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}

	public function bank_auto_status()
	{

		if ($this->input->post('id') && $this->input->post('bank_web_id')) {
			$id 		= $this->input->post('id');
			$status 	= $this->input->post('status');
			$bank_web_id = $this->input->post('bank_web_id');
			$krusri = $this->db->select('id')->where('type', 1)->where('bank_id', 4)->where('status !=', 4)->get('tb_bank_web')->row();
			if ($krusri->id == $bank_web_id) {
				$url_ = explode(".", base_url());
				$url2 = explode("/", $url_[2]);
				$this->krusri_status($url_[1] . '.' . $url2[0], $status);
			}

			if ($status == 0) {
				if ($this->db->set('status', 0)->where('id', $bank_web_id)->update('tb_bank_web')) {
					if ($this->db->set('status', 0)->where('id', $id)->update('acc_account')) {
						$this->log_bank($bank_web_id, 'แก้ไขสถานะ');
						$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
					} else {
						$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
					}
				} else {
					$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
				}
			} else if ($status == 1) {
				if ($this->db->set('status', 3)->where('id', $bank_web_id)->update('tb_bank_web')) {
					if ($this->db->set('status', 1)->where('id', $id)->update('acc_account')) {
						$this->log_bank($bank_web_id, 'แก้ไขสถานะ');
						$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
					} else {
						$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
					}
				} else {
					$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
				}
			} else if ($status == 4) {
				if ($this->db->set('status', 4)->where('id', $bank_web_id)->update('tb_bank_web')) {
					if ($this->db->set('status', 4)->where('id', $id)->update('acc_account')) {
						$this->log_bank($bank_web_id, 'แก้ไขสถานะ');
						$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
					} else {
						$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
					}
				} else {
					$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
				}
			} else {
				$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
			}

			$data_bank_name = $this->db->select('tb_bank_web.name,tb_bank.bank_short')->join('tb_bank', 'tb_bank_web.bank_id = tb_bank.id')->where('tb_bank_web.id', $bank_web_id)->get('tb_bank_web')->row();
			$account = $data_bank_name->name . '  ' . $data_bank_name->bank_short;
			if ($status == 4) {
				$detail = 'hide';
			}
			if ($status == 0) {
				$detail = 'old : active  new : no_active';
			}
			if ($status == 1) {
				$detail = 'old : no_active  new : active';
			}
			/*--------------------------log_bank_status----------------------------------- */
			$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

			$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
			$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
			$hostname = $hostname[0]['hostname'];

			$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
			$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
			$dbname = $dbname[0]['database_name'];
			$time = time();

			$sql = "INSERT INTO log_bank_status (admin,account, detail,datetime) 
				 VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $account . "','" . $detail . "','" . $time . "')";
			if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
			} else {

				$sql = "CREATE TABLE log_bank_status (
					 id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					 admin VARCHAR(20) NOT NULL,
					 account VARCHAR(50) NOT NULL,
					 detail VARCHAR(100) NOT NULL,
					 datetime INT(20) NOT NULL
					 ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
				$this->backend_library->query_sql($hostname, $dbname, $sql);
				$sql = "INSERT INTO log_bank_status (admin,account, detail,datetime) 
				 VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $account . "','" . $detail . "','" . $time . "')";

				$this->backend_library->query_sql($hostname, $dbname, $sql);
			}
			/*--------------------------end log_bank_status----------------------------------- */
		} else {
			$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}


		echo json_encode($re);
		die();
	}

	// Add Group
	public function groupByuser()
	{

		//Array ( [bank_id] => 2 [1] => on [2] => on )

		//Run ดูว่ามี Group ที่อัน อันไหนกด on มาบ้าง
		$bank_id = $this->input->post('bank_id');
		$Group_r = $this->db->get('tb_group')->result_array();

		$data_bank_name = $this->db->select('tb_bank_web.name,tb_bank.bank_short')->join('tb_bank', 'tb_bank_web.bank_id = tb_bank.id')->where('tb_bank_web.id', $bank_id)->get('tb_bank_web')->row();
		$group_old = [];
		$checkGroup = $this->db->select('tb_bank_group.*,tb_group.name')
			->join('tb_group', 'tb_bank_group.group_id = tb_group.id  ')
			->where('tb_bank_group.bank_id', $bank_id)
			->where('tb_bank_group.status', 1)
			->get('tb_bank_group')->result_array();
		foreach ($checkGroup as $chgr) {
			array_push($group_old, $chgr['name']);
		}
		$group_new = [];

		foreach ($Group_r as $gr) {
			$chkGroup 		= $this->db->select('tb_bank_group.*,tb_group.name')->join('tb_group', 'tb_group.id = tb_bank_group.group_id')->where('tb_bank_group.group_id', $gr['id'])->where('tb_bank_group.bank_id', $bank_id)->get('tb_bank_group');
			$bGroup_r		= $chkGroup->row();

			if ($this->input->post($gr['id']) == 'on') {
				if ($chkGroup->num_rows() == 0) {
					array_push($group_new, $gr['name']);
					$arrbankGroup 	= array(
						'group_id' => $gr['id'],
						'bank_id' => $bank_id,
						'status' => 1
					);
					$this->db->insert('tb_bank_group', $arrbankGroup);
				} else {
					if ($bGroup_r->status == 0) {
						array_push($group_new, $bGroup_r->name);
						$this->db->set('status', 1)->where('id', $bGroup_r->id)->update('tb_bank_group');
					}
				}
			} else {
				if ($chkGroup->num_rows() == 1) {
					if ($bGroup_r->status == 1) {
						$this->db->set('status', 0)->where('id', $bGroup_r->id)->update('tb_bank_group');
					}
				}
			}
		}
		$i = 0;
		$bank_group_new = '';
		foreach ($group_new as $key => $value) {
			if ($i + 1 == sizeof($group_new)) {
				$bank_group_new .= $value;
			} else {
				$bank_group_new .= $value . ',';
			}
			$i++;
		}

		$j = 0;
		$bank_group_old = '';
		foreach ($group_old as $key => $value) {
			if ($j + 1 == sizeof($group_old)) {
				$bank_group_old .= $value;
			} else {
				$bank_group_old .= $value . ',';
			}
			$i++;
		}

		$account = $data_bank_name->name . '  ' . $data_bank_name->bank_short;
		/*--------------------------log_bank_edit_group----------------------------------- */
		$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

		$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
		$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
		$hostname = $hostname[0]['hostname'];

		$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
		$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
		$dbname = $dbname[0]['database_name'];
		$time = time();

		$sql = "INSERT INTO log_bank_edit_group (admin, account,detail,datetime) 
			  VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $account . "','" . 'old : ' . $bank_group_old . ' new : ' . $bank_group_new . "','" . $time . "')";
		if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
		} else {

			$sql = "CREATE TABLE log_bank_edit_group (
				  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				  admin VARCHAR(20) NOT NULL,
				  account VARCHAR(50) NOT NULL,
				  detail VARCHAR(255) NOT NULL,
				  datetime INT(20) NOT NULL
				  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
			$this->backend_library->query_sql($hostname, $dbname, $sql);
			$sql = "INSERT INTO log_bank_edit_group (admin, account,detail,datetime) 
			 VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $account . "','" . 'old : ' . $bank_group_old . ' new : ' . $bank_group_new . "','" . $time . "')";

			$this->backend_library->query_sql($hostname, $dbname, $sql);
		}
		/*--------------------------end log_bank_edit_group----------------------------------- */

		$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
		echo json_encode($re);
		die();
	}



	public function bank_auto_edit_limit()
	{
		if ($this->input->post('auto_id')) {
			$acc_id 		= $this->input->post('auto_id');
			$limit_amoun	= $this->input->post('limit_amount');
			$limit = $this->db->where('bank_id', $acc_id)->get('tb_withdraw_limit');
			if ($limit->num_rows() == 1) {
				if ($this->db->set('limit_amount', $limit_amoun)->where('bank_id', $acc_id)->update('tb_withdraw_limit')) {
					$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
				} else {
					$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
				}
			} else {
				$arr_limit = array('limit_amount' => $limit_amoun, 'bank_id' => $acc_id, 'status' => 1);
				if ($this->db->insert('tb_withdraw_limit', $arr_limit)) {
					$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
				} else {
					$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
				}
			}
		} else {
			$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}
	public function setWD()
	{
	
		if ($this->input->post()) {
			$amount = str_replace(',', '', $this->input->post('amount'));
			$type 	= $this->input->post('type');
			$amount_old = (int)$this->db->where('name', $type)->get('tb_withdraw_min')->row()->amount;
			if ($this->db->set('amount', $amount)->where('name', $type)->update('tb_withdraw_min')) {

				/*--------------------------log_set_withdraw----------------------------------- */
				$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

				$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$hostname = $hostname[0]['hostname'];

				$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$dbname = $dbname[0]['database_name'];
				$time = time();

				$sql = "INSERT INTO log_set_withdraw (admin,type, detail,datetime) 
				VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $type . "','" . 'old : ' . $amount_old . ' new : ' . $amount . "','" . $time . "')";
				if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
				} else {

					$sql = "CREATE TABLE log_set_withdraw (
					 id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					 admin VARCHAR(20) NOT NULL,
					 type VARCHAR(50) NOT NULL,
					 detail VARCHAR(100) NOT NULL,
					 datetime INT(20) NOT NULL
					 ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
					$sql = "INSERT INTO log_set_withdraw (admin,type, detail,datetime) 
				 VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $type . "','" . 'old : ' . $amount_old . ' new : ' . $amount . "','" . $time . "')";

					$this->backend_library->query_sql($hostname, $dbname, $sql);
				}
				/*--------------------------end log_set_withdraw----------------------------------- */

				$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
			} else {
				$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}
	/// Start >>> LOG <<<

	public function log_bank($bank_id, $action)
	{
		$arr_logState = array(
			'bank_id' 	=> $bank_id,
			'action' 	=> $action,
			'admin_id' 	=> $this->session->userdata['users']['id'],
			'create_time' => time(),
		);
		$this->db->insert('log_bank', $arr_logState);
	}
	/// Start >>> GET <<<
	public function get_bank()
	{
		$r_bank = $this->db->where('id', $this->input->post('id'))->get('tb_bank_web')->row();
		echo json_encode($r_bank);
		die();
	}
	public function get_statement()
	{
		$last3day = time() - (15 * 24 * 60 * 60);
		$r_bank = $this->db
			->select('tb_statement.*,tb_bank.bank_short,tb_login.name')
			->join('tb_bank', 'tb_bank.id = tb_statement.bank_id', 'left')
			->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
			->where('tb_statement.bank_id', $this->input->post('bank_id'))
			->where('tb_statement.datetime >', $last3day)
			->where_in('tb_statement.status', array(1, 2, 3, 4))
			->order_by('tb_statement.datetime', 'DESC')
			->get('tb_statement')
			->result_array();

		$i = 0;
		foreach ($r_bank as $state) {
			$r_bank[$i]['state_date'] = date('d-m-Y', $state['datetime']);
			$r_bank[$i]['state_time'] = date('H:i', $state['datetime']);
			$r_bank[$i]['state_deposit'] = number_format($state['deposit'], 2);
			$r_bank[$i]['state_withdraw'] = number_format($state['withdraw'], 2);
			$i++;
		}
		echo json_encode($r_bank);
		die();
	}
	function krusri_status($url, $status)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://103.233.193.128:5555/transaction/io-account",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "web_dns=" . $url . "&action=" . $status,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded"
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	}
}

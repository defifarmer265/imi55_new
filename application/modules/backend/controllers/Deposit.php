<?php
class Deposit extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('getapi_model');
		$this->load->model('check_turn');
		$this->load->library('backend/backend_library');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();
	}

	public function home()
	{
	
		$statement = $this->db->select('tb_statement.*,tb_user.user,tb_user.username,tb_user.id as user_id,tb_bank.bank_short,tb_user_bank.account as usbk')
			->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
			->join('tb_user_bank', 'tb_user_bank.user_id = tb_statement.user_id', 'left')
			->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
			->where('tb_statement.deposit >', 0)
			->where('tb_statement.status', 1)
			
			->order_by('tb_statement.status', 'ASC')
			->order_by('tb_statement.dateCreate', 'DESC')

			->limit(50)
			->get('tb_statement')->result_array();
		$user = $this->db->where('status', '1')->get('tb_user')->result_array();
		$data = array(
			'menu' => 'deposit_cf',
			'statement' => $statement,
			'user' => $user,
		);



		// echo '<pre>';
		// print_r($data);
		// die();
		$this->load->view('deposit', $data);
	}

	public function index()
	{
		
		
		$state_wcf = $this->db->select('
		tb_statement.id,tb_statement.datetime,tb_statement.deposit,tb_statement.from_bank,
		tb_statement.note,tb_statement.user_id,tb_statement.admin_id,tb_statement.from_name,
		tb_bank_web.name,
		tb_bank.api_id as bnkapi_web,tb_bank.bank_short as bnkshort_web,
		')
			->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
			->where('tb_statement.deposit >', 0)
			
			->where('tb_statement.status', 1)
			->order_by('tb_statement.id', 'DESC')

			->get('tb_statement')->result_array();

		$state_cf = $this->db->select('
		tb_statement.id,tb_statement.datetime,tb_statement.deposit,tb_statement.from_bank,tb_statement.note,
		tb_statement.user_id,tb_statement.admin_id,tb_statement.from_name,tb_statement.dateCreate,
		tb_user.user,tb_user.username,
		tb_login.name as admin_name,
		tb_bank_web.name,
		tb_bank.api_id as bnkapi_web,tb_bank.bank_short as bnkshort_web,
		')
			->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
			->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
			->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
			->where('tb_statement.deposit >', 0)
			
			->where_in('tb_statement.status', array(2, 4))
			->where('tb_statement.admin_id !=', 0)
			->order_by('tb_statement.dateCreate', 'DESC')
			->limit(20)
			->get('tb_statement')->result_array();
		$i = 0;

		$data = array(
			'state_wcf' => $state_wcf,
			'state_cf' => $state_cf,
		);

		//		echo '<pre>';print_r($data);die();
		$this->load->view('deposit_home', $data);
	}

	public function addcredit()
	{
		$state_id = $this->input->post('state_id'); // id ของ tb_statment
		$user = $this->input->post('user');
		$user_q = $this->db->where('user', $user)->get('tb_user');
		$chcutTurn = $this->input->post('chcutTurn');
		$admin_id = $this->session->userdata['users']['id'];
		

		//เช็คยูเซอร์ที่พิมพ์มา ต้องมี 1 แถวเท่านั้น
		if ($user_q->num_rows() == 1) {
			$user_detail = $user_q->row();
			$bank_detail = $this->db->where('user_id', $user_detail->id)->get('tb_user_bank')->row();
			$state_q = $this->db->where('id', $state_id)->get('tb_statement');
			if ($state_q->num_rows() == 1) {
				$state_detail = $state_q->row();
				$bank_web_detail = $this->db->where('id', $state_detail->bank_id)->get('tb_bank_web')->row();
				if($state_detail->admin_id == $admin_id){
					//เริ่มต้น API Deposit สำหรับ Agent Betclic
					$arr_depAPI = array(
							'AgentName' => $this->getapi_model->agent(),
							'PlayerName' => $user_detail->user,
							'Amount' => $state_detail->deposit,
							'TimeStamp' => time()
					);
					$dataAPI = array(
						'type'		=> 'D',
						'agent' 	=> $this->getapi_model->agent(),
						'member' 	=> $user_detail->user,
					);
					$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
					$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
					if ($cre_userAPI->Success == 1) {
						$state_array = array(
							'user_id'	=> $user_detail->id,
							'admin_id'	=> $this->session->userdata['users']['id'],
							'status'	=> 2,
						);
						// =============  clear promotion ======================
						($chcutTurn) ? $this->db->where('user_id', $user_detail->id)->update('tb_turnover', array('promotion_id' => 0, 'code_id' => 0, 'sport' => '0', 'casino' => '0', 'game' => '0', 'checkturn' => '0', 'check_time' => time())) : true;
						if ($this->db->where('id', $state_id)->update('tb_statement', $state_array)) {
							$this->notify_line($user_detail->user, $state_detail->deposit);
	
							/*--------------------------log deposit----------------------------------- */
	
							$webname = $this->db->where('name', 'web')->get('setting')->row()->code;
	
							$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_dbname_imicenter'), $sql);
							$hostname = $hostname[0]['hostname'];
	
							$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_dbname_imicenter'), $sql);
							$dbname = $dbname[0]['database_name'];
							$time = time();
							$sql = "SELECT * FROM log_deposit";
							if ($this->backend_library->select_sql($hostname, $dbname, $sql)) {
	
								$sql = "INSERT INTO log_deposit (admin, user_id, credit,action,datetime)
								VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $user_detail->user . "', '" . $state_detail->deposit . "',1,'" . $time . "')";
								$this->backend_library->query_sql($hostname, $dbname, $sql);
							} else {
	
								$sql = "CREATE TABLE log_deposit (
									id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
									admin VARCHAR(20) NOT NULL,
									user_id VARCHAR(20) NULL,
									credit INT(10) NOT NULL,
									action INT(1) NOT NULL COMMENT '1:เพิ่ม 2:ซ่อน 3:ยกเลิก', 
									datetime INT(20) NOT NULL
									) CHARACTER SET utf8 COLLATE utf8_general_ci";
								$this->backend_library->query_sql($hostname, $dbname, $sql);
								$sql = "INSERT INTO log_deposit (admin, user_id, credit,action,datetime)
								VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $user_detail->user . "', '" . $state_detail->deposit . "',1,'" . $time . "')";
								$this->backend_library->query_sql($hostname, $dbname, $sql);
							}
							/*--------------------------end log deposit----------------------------------- */
							$this->first_deposit($user_detail->id,$user_detail->user, $state_detail->deposit);
							$re = array('status' => 1, 'msg' => 'Success', 'data' => '');
							// =============  check turn ======================
							$this->check_turn->checkturn($user_detail->id, $state_detail->deposit);
						} else {
							$re = array('status' => 1, 'msg' => 'แอดเครดิตสำเร็จแต่ ฐานข้อมูลไม่บันทึก', 'data' => '');
							// =============  check turn ======================
							$this->check_turn->checkturn($user_detail->id, $state_detail->deposit);
						}
					} else {
						// API Betclic สร้าง Deposit Fail
						$re = array('status' => 0, 'msg' => $cre_userAPI->msg . 'เช็คยอดฝากว่าค้างอยู่หรือป่าว', 'data' => '');
					}
				}
				else
				{
					$re = array('status' => 0, 'msg' => 'มีแอดมินกำลังคอนเฟิร์มอยู่โปรดรอหรือทำรายใหม่', 'data' => '');
				}

			} else {
				$re = array('status' => 0, 'msg' => 'State ที่ส่งมามีค่าซ้ำกัน แจ้งโปรแกรมเมอร์', 'data' => '');
			}
		} else {
			$re = array('status' => 0, 'msg' => 'User ที่ส่งมามีค่าซ้ำกัน แจ้งโปรแกรมเมอร์', 'data' => '');
		}

		echo json_encode($re);
		die();
	}
	function get_wd()
	{
		if ($user = $this->input->post('user')) {
			$user_r = $this->db->where('user', $user)->get('tb_user')->row();
			$arr_depAPI = array(
				'AgentName' 	=> $this->getapi_model->agent(),
				'PlayerName' 	=> $user_r->user,
				'From' 			=> date('m/d/Y', time() - (1 * 24 * 60 * 60)), //01/01/2020
				'To' 			=> date('m/d/Y'), //01/01/2020
				'TransferType' 	=> 3, //(2:Deposit/3:Withdraw)
				'PageSize' 		=> 50,
				'PageIndex' 	=> 1,
				'TimeStamp' 	=> time()
			);
			$dataAPI = array(
				'type'		=> 'D',
				'agent' 	=> $this->getapi_model->agent(),
				'member' 	=> $user_r->user,
			);
			$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/transferlogs';
			$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
			//			print_r($arr_depAPI);
			$re = array('status' => 1, 'msg' => '5', 'data' => $cre_userAPI->Result->Records);
		} else {
			$re = array('status' => 0, 'msg' => '5', 'data' => '');
		}

		echo json_encode($re);
		die();
	}




	//ลบ
	public function editDPS()
	{
		if ($this->input->post('dps_id') && $this->input->post('status')) {
			$dps_id = $this->input->post('dps_id');
			$status = $this->input->post('status');
			$state_q = $this->db->select('note')->where('id', $dps_id)->get('tb_statement');
			if ($state_q->num_rows() == 1) {
				$state_r = $state_q->row();

				$update_dps = array(

					'admin_id'	=> $this->session->userdata['users']['id'],
					'status' => 3
				);
				if ($this->db->where('id', $dps_id)->update('tb_statement', $update_dps)) {
					$re = array('status' => 1, 'msg' => 'success', 'data' => '');
				} else {
					$re = array('status' => 0, 'msg' => 'code 1023', 'data' => '');
				}
			} else {
				$re = array('status' => 0, 'msg' => 'code 1022', 'data' => '');
			}
		} else {
			$re = array('status' => 0, 'msg' => 'code 1021', 'data' => '');
		}

		echo json_encode($re);
		die();
	}
	// จบการลบ

	public function add_credit_check_user()
	{
	

		if ($this->input->post('user') && $stm_id = $this->input->post('stm_id')) {
			$user = $this->input->post('user');
			$stm_id = $this->input->post('stm_id');

			$numrow = '';
			if (strlen($user) == 10) { //user = tel

				$user_q = $this->db->select('tb_user.user,tb_user.username,tb_user.name,tb_user.point,tb_user.spin')->where('username', $user)->get('tb_user');
				$numrow = $user_q->num_rows();
			} else if (strlen($user) > 0 && strlen($user) < 7) {

				$user = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($user))), -6);
				$user_q = $this->db->select('tb_user.user,tb_user.username,tb_user.name,,tb_user.point,,tb_user.spin')->where('user', $user)->get('tb_user');
				$numrow = $user_q->num_rows();
			
			}
			$stm_r = $this->db->select('tb_statement.note,tb_statement.id as stm_id,
			tb_statement.deposit as amount,tb_bank_web.name as webName,
			tb_bank.bank_short as webBank,tb_bank.api_id as webApi')
				->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
				->where('tb_statement.id', $stm_id)
				->get('tb_statement')->row();
			
			// อัพเดท tb_statement ในส่วนของ admin_id ว่าใครกด
			$update_tb_statement = array(
				'admin_id'	=> $this->session->userdata['users']['id']
			);
			$confirm_statement = $this->db->where('id', $stm_id)->update('tb_statement', $update_tb_statement);
			// จบ
			if ($numrow == 1) {
				if ($user_r = $user_q->row()) {
					$user_r->credit 	= $this->get_credit($user_r->user);
					$user_r->webName 	= $stm_r->webName;
					$user_r->webBank 	= $stm_r->webBank;
					$user_r->webApi 	= $stm_r->webApi;
					$user_r->amount 	= $stm_r->amount;
					$user_r->note 		= $stm_r->note;
					$user_r->stm_id 	= $stm_r->stm_id;
					$user_r->promo      = ($promo = $this->db->join('tb_promotion', 'tb_promotion.id = tb_turnover.promotion_id')->where('user_id', intval(substr($user_r->user, -6)))->get('tb_turnover')->row()) ? array('id' => $promo->promotion_id, 'name' => $promo->name) : array('id' => 0, 'name' => 'ไม่ติดโปร', 'user' => intval(substr($user_r->user, -6)));
					$user_r->outstanding  = $this->check_turn->get_outstanding($user_r->user);
					$re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ', 'title' => 'สำเร็จ', 'data' => $user_r);
					// $this->chekpoinspin($stm_r->amount,$user,$user_r->point,$user_r->spin);

				} else {
					$re = array('code' => 0, 'msg' => 'ไม่มียูเซอร์ดังกล่าว', 'title' => 'ไม่สำเร็จ', 'data' => '');
				}
			} else {
				$re = array('code' => 0, 'msg' => 'ไม่มียูเซอร์ดังกล่าว', 'title' => 'ไม่สำเร็จ', 'data' => '');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'ข้อมูลที่กรอกมาไม่ครบถ้วน', 'title' => 'ไม่สำเร็จ', 'data' => '');
		}

		echo json_encode($re);
		die();
	}



	public function edit_status_dps()
	{
		if ($this->input->post('dps_id') && $this->input->post('status')) {
			$dps_id = $this->input->post('dps_id');
			$status = $this->input->post('status');

			$state_q = $this->db->where('id', $dps_id)->get('tb_statement');
			$state_detail = $state_q->row();

			$update_dps = array(
				'admin_id'	=> $this->session->userdata['users']['id'],
				'status'	=> $status
			);

			if ($this->db->where('id', $dps_id)->update('tb_statement', $update_dps)) {


				/* ------------------------------log depoist ------------------------ */
				$webname = $this->db->where('name', 'web')->get('setting')->row()->code;
				$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_dbname_imicenter'), $sql);
				$hostname = $hostname[0]['hostname'];

				$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_dbname_imicenter'), $sql);
				$dbname = $dbname[0]['database_name'];
				$time = time();
				$sql = "SELECT * FROM log_deposit";
				if ($status == 4) {
					$action = 2;
				} else {
					$action = 3;
				}
				$sql = "INSERT INTO log_deposit (admin, user_id, credit,action,datetime)
					VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $state_detail->deposit . "','" . $action . "','" . $time . "')";
				if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
				} else {

					$sql = "CREATE TABLE log_deposit (
								id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
								admin VARCHAR(20) NOT NULL,
								user_id VARCHAR(20) NULL,
								credit INT(10) NOT NULL,
								action INT(1) NOT NULL COMMENT '1:เพิ่ม 2:ซ่อน 3:ยกเลิก',  
								datetime INT(20) NOT NULL
								) CHARACTER SET utf8 COLLATE utf8_general_ci";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
					$sql = "INSERT INTO log_deposit (admin, user_id, credit,action,datetime)
					VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $state_detail->deposit . "','" . $action . "','" . $time . "')";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
				}
				/* ------------------------------log depoist ------------------------ */

				$re = array('code' => 1, 'msg' => 'ดำเนินการแก้ไขสำเร็จค่ะ', 'title' => 'สำเร็จ');
			} else {
				$re = array('code' => 0, 'msg' => 'code 1023', 'title' => '');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'code 1021', 'title' => '');
		}

		echo json_encode($re);
		die();
	}
	function get_stm()
	{
		$stm_id = $this->input->post('stm_id');
		$stm_q	= $this->db->select('
	tb_statement.dateCreate,tb_statement.datetime,tb_statement.deposit,tb_statement.bank_id,tb_statement.note,tb_statement.status,tb_statement.id,tb_statement.user_id,
	tb_bank.api_id as webApi,tb_bank.bank_short as webBank,tb_bank_web.name as webName,tb_login.name as adminName
	')
			->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
			->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
			->where('tb_statement.id', $stm_id)
			->get('tb_statement');
		if ($stm_q->num_rows() == 1) {
			$stm_r 	= $stm_q->row();
			$user_r = $this->db->select('tb_user.user,tb_user.username,tb_bank.bank_short,tb_bank.api_id,tb_user.name')
				->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
				->where('tb_user.id', $stm_r->user_id)
				->get('tb_user')
				->row();
			$stm_r->user 		= $user_r->user;
			$stm_r->userTel 	= $user_r->username;
			$stm_r->userBank 	= $user_r->bank_short;
			$stm_r->userApi 	= $user_r->api_id;
			$stm_r->userName	= $user_r->name;
			$stm_r->dateIn		= date('d-m-Y H:i:s', $stm_r->datetime);
			$stm_r->dateFirm	= date('d-m-Y H:i:s', $stm_r->dateCreate);

			$re = array('code' => 1, 'msg' => '', 'title' => 'สำเร็จ', 'data' => $stm_r);
		} else {
			$re = array('code' => 0, 'msg' => 'ไม่มีข้อมูลรายการดังกล่าว', 'title' => 'ไม่สำเร็จ', 'data' => '');
		}
		echo json_encode($re);
		die();
	}
	function notify_line($user, $amount)
	{
		if ($lnfy = $this->db->where('type', 'deposit')->get('tb_linenotify')->row()) {
			if ($lnfy->token != '') {
				$date = date('d-m-Y  H:i:s', time());
				$messageNofity = 'พนักงานเฟิร์ม' . PHP_EOL . 'วันที่: ' . $date . PHP_EOL .
					'ชื่อ :' . $this->session->userdata['users']['name'] . PHP_EOL .
					'จำนวนเงิน: ' . $amount . ' บาท' . PHP_EOL .
					'ID: ' . $user . PHP_EOL;
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://notify-api.line.me/api/notify",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => "message=" . $messageNofity,
					CURLOPT_HTTPHEADER => array(
						"Content-Type: application/x-www-form-urlencoded",
						"Authorization: Bearer " . $lnfy->token
					),
				));

				$response = curl_exec($curl);
				curl_close($curl);
			}
		}
	}
	function get_credit($user)
	{
		$arr_userAPI = array(
			'AgentName'	=> $this->getapi_model->agent(),
			'PlayerName' => $user,
			'TimeStamp'	=> time(),
		);
		$dataAPI = array(
			'type'		=> 'D',
			'agent' 	=> $this->getapi_model->agent(),
			'member' 	=> $user,
		);
		$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
		$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
		if ($cre_userAPI->Error == 0) {
			$amount = $cre_userAPI->Balance;
		} else {
			$amount = $cre_userAPI->Message;
		}
		return $amount;
	}
	public function get_type_stm()
	{
		if ($this->input->post('status')) {
			$status =  $this->input->post('status');
			$state_wcf = $this->db->select('
				tb_statement.id,tb_statement.datetime,tb_statement.deposit,tb_statement.from_bank,
				tb_statement.note,tb_statement.user_id,tb_statement.admin_id,tb_statement.from_name,
				tb_bank_web.name,
				tb_bank.api_id as bnkapi_web,tb_bank.bank_short as bnkshort_web,
				')
				->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
				->where('tb_statement.deposit >', 0)
				->where('tb_statement.from_bank !=', 'TRUEW')
				->where('tb_statement.status', $status)
				->order_by('tb_statement.id', 'DESC')
				->limit(50)
				->get('tb_statement')->result_array();

			$re = array('code' => 1, 'msg' => '', 'title' => 'สำเร็จ', 'data' => $state_wcf);
		} else {
			$re = array('code' => 0, 'msg' => 'ไม่มีข้อมูลรายการดังกล่าว', 'title' => 'ไม่สำเร็จ', 'data' => '');
		}
		echo json_encode($re);
		die();
	}
	public function first_deposit($user_id,$user,$deposit)
	{
		$setting_deposit = $this->db->select('*')->where_in('name', array('spin_amount','deposit_day'))->get('setting')->result_array();
		$rank = $this->db->select('spin')->join('tb_user_rank', 'tb_user_rank.id_rank = tb_rank.id', 'left')->where('tb_user_rank.user',$user)->get('tb_rank')->row();
		

		$spin_amount = $setting_deposit[0]['code'];
		$spinadd = $spin_amount*$rank->spin;


		$deposit_day = $setting_deposit[1]['code'];
		$dateStart =  strtotime(date('Y-m-d 00:00:00'));
		$dateEnd   =  strtotime(date('Y-m-d 23:59:59'));
		$last_stm = $this->db->select('*')->where('user_id',$user_id)->where('status !=',1)->where('dateCreate >=',$dateStart)->where('dateCreate <=',$dateEnd)->get('tb_statement')->result_array();	
		$date_now = date('d/m/Y',time());
		if($last_stm)
		{
			$date_deposit =  date('d/m/Y',$last_stm[0]['dateCreate']);
			if(sizeof($last_stm) == 1 && $date_now == $date_deposit) //ยอดแรกของวันและเป็นวันปัจจุบัน
			{
				if($deposit >= $deposit_day)
				{
					$this->db->set('spin', 'spin + ' . $spinadd, FALSE)->where('id', $user_id)->update('tb_user');
				}
				else
				{
					//ยอดน้อยกว่ากำหนด
				}
			}
			else
			{
				//ไม่ใช่ยอดแรกของวัน
			}
		}
	}




}

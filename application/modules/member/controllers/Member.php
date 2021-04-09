<?php
class Member extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->model('backend/getapi_model');
		$this->load->library('Member_libraray');
		$this->load->model('api/api_model');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_web/tem_mapraw1');
		$this->member_libraray->login();
	}
	public function test()
	{

		$user_r = $this->session->member->id;
		echo '<pre>';
		print_r($user_r);
		die;
	}
	public function getdata()
	{
		$data['maintenance'] = $this->db->select('status,name')->where('id', 6)->get('maintenance')->row();

		//		session_destroy();
		$user_r = $this->session->member;
		//controler

		//check credit user
		$credit = $this->api_cradit($user_r->user);

		// check bank user
		$user_id = $user_r->id;

		$bankUser_q = $this->db->select('tb_user_bank.*,tb_bank.bank_short,tb_bank.api_id')
			->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
			->where('tb_user_bank.user_id', $user_r->id)
			->where('tb_user_bank.status', 1)
			->limit(1)
			->get('tb_user_bank');
		if ($bankUser_q->num_rows() == 1) {
			$bankUser_r = $bankUser_q->row();

			$data['bankUser'] = 'x-xxx-' . substr($bankUser_r->account, -5) .
				' <img src="' . $this->config->item('tem_frontend') . '/img/mapraw_icon/bank/' . $bankUser_r->api_id . '.png" width="20px">';
		} else {
			$data['bankUser'] = '';
		}
		$gift_q = $this->db->select('log_gift_voucher.id')
			->join('tb_gift', 'tb_gift.id = gift_id', 'left')
			->where('tb_gift.time_end >=', time())
			->where('log_gift_voucher.user_id', $user_r->id)
			->where('log_gift_voucher.receive', 0)
			->get('log_gift_voucher');
		if ($gift_q->num_rows() >= 1) {
			$data['giftvoucher'] = 1;
		} else {
			$data['giftvoucher'] = 0;
		}
		$check_rank = $this->db->select('tb_rank.name,tb_user_rank.total_turnover,tb_rank.img_link')
			->join('tb_rank', 'tb_rank.id = tb_user_rank.id_rank')
			->where('user', $this->session->userdata['member']->user)
			->get('tb_user_rank');
		if ($check_rank->num_rows() == 1) {
			$data['rank'] = $check_rank->row()->img_link;
			$data['trunover'] = $check_rank->row()->total_turnover;
		} else {
			$data['trunover'] = 0;
			$data['rank'] = 'BRONZA.png';
		}
		$data['bank']	= $this->db->get('tb_bank')->result_array();
		$data['credit'] = $credit;
		$data['datarank'] = $this->db->get('tb_rank')->result_array();
		return $data;
	}

	public function index()
	{

		$data = $this->getdata();
		$this->load->view('member', $data);
	}

	public function Allgames()
	{
		$data = $this->getdata();
		$this->load->view('allgames', $data);
	}

	public function createbankUser()
	{
		if ($this->input->post('bank_id') && $this->input->post('account')) {
			$bank_id = $this->input->post('bank_id');
			$account = $this->input->post('account');
			$chk_bank = $this->db->where('account', $account)->where_not_in('status', '0')->get('tb_user_bank');
			if ($chk_bank->num_rows() == 0) {
				$arr_bankUsDB = array(
					'user_id'	=> $this->session->member->id,
					'bank_id'	=> $bank_id,
					'account'	=> $account,
					'create_time' => time(),
					'status'	=> 1
				);
				if ($this->db->insert('tb_user_bank', $arr_bankUsDB)) {
					$re = array('title' => 'บันทึกรายการธนาคารสำเร็จ', 'msg' => 'คุณสามารถเรือกทำรายการฝากได้แล้วค่ะ', 'code' => 1);
				} else {
					$re = array('title' => 'ผิดพลาด', 'msg' => 'กรุณาทำรายการใหม่อีกครั้งค่ะ', 'code' => 0);
				}
			} else {
				$re = array('title' => 'ผิดพลาด', 'msg' => 'กรุณาทำรายการใหม่อีกครั้งค่ะ', 'code' => 0);
			}
		} else {
			$re = array('title' => 'ผิดพลาด', 'msg' => 'กรุณาทำรายการใหม่อีกครั้งค่ะ', 'code' => 0);
		}
		echo json_encode($re);
		die();
	}
	public function deposit()
	{


		$bankWeb_q = $this->db->select('tb_bank_web.*,tb_bank.bank_short,tb_bank.api_id,tb_bank.bank_th')
			->join('tb_bank_group', 'tb_bank_group.bank_id = tb_bank_web.id', 'left')
			->join('tb_user_group', 'tb_user_group.group_id = tb_bank_group.group_id', 'left')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
			->where('tb_user_group.user_id', $this->session->member->id)
			->where('tb_bank_web.type', 1)
			->where('tb_user_group.status', 1)
			->where('tb_bank_web.status', 3)
			->where('tb_bank_group.status', 1)
			// ->group_by('tb_bank_web.id')
			->group_by('tb_bank_web.id, tb_bank_web.account')
			->order_by('tb_bank_web.account', 'ASC') //ส่วนที่เพิ่มมา//
			->get('tb_bank_web');
		if ($bankWeb_q->num_rows() >= 1) {
			$data['bankWeb'] = $bankWeb_q->result_array();
		} else {
			$data['bankWeb'] = '';
		}
		$bankUser_r = $this->db->select('tb_user_bank.*,tb_bank.bank_short,tb_bank.api_id')
			->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
			->where('tb_user_bank.user_id', $this->session->member->id)
			->where('tb_user_bank.status', 1)
			->get('tb_user_bank')->row();
		$data['bankUser'] = 'x-xxx-' . substr($bankUser_r->account, -6) .
			'<img src="' . $this->config->item('tem_frontend') . '/img/mapraw_icon/bank/' . $bankUser_r->api_id . '.png" width="20px">';
		$data['menu'] = 'deposit';

		$data['bank_main'] = $this->db->select('status')->where('id', 7)->get('maintenance')->row();
		$this->load->view('deposit', $data);
	}
	public function withdraw()
	{
		$date1 = date('Y-m-d 00:00:00');
		$date2 = date('Y-m-d 23:59:59'); //วันที่ปัจจุบัน
		$dateE =  strtotime(date('Y-m-d H:i:s', strtotime($date2)));   //ลบ1วัน โดยกำหนดเป็นเช่นวันนี้19  เวลา 10.59
		$dateF =  strtotime(date('Y-m-d H:i:s', strtotime($date1)));

		$user_r = $this->db->where('id', $this->session->member->id)->get('tb_user')->row();
		$user = $user_r->user;
		$userid = $user_r->id;
		//$count_wd = $this->db->select('')->where('user_id',$user_r->id)->where('')->get('tb_withdraw');
		$bankUser_q = $this->db->select('tb_user_bank.*,tb_bank.bank_short,tb_bank.api_id,')
			->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
			->where('tb_user_bank.user_id', $user_r->id)
			->where('tb_user_bank.status', 1)
			->get('tb_user_bank');

		$count_wd = $this->db->select('count(tb_withdraw.user_id) as count_wd')
			->where('status', 3)
			->where('time >', strtotime(date('00:00:00')) - (60 * 60 * 24))
			->where('user_id', $user_r->id)
			->get('tb_withdraw')
			->row()->count_wd;

		if ($bankUser_q->num_rows() == 1) {
			$bankUser_r = $bankUser_q->row();

			$data['bankUser'] = 'x-xxx-' . substr($bankUser_r->account, 6) .
				'<img src="' . $this->config->item('tem_frontend') . '/img/mapraw_icon/bank/' . $bankUser_r->api_id . '.png" width="20px">';
		} else {
			$data['bankUser'] = '';
		}
		$data['credit'] = $this->api_cradit($user_r->user);
		$data['WD_min'] = $this->db->where('name', 'wd_min')->get('tb_withdraw_min')->row()->amount;
		$data['WD_max'] = $this->db->where('name', 'wd_max')->get('tb_withdraw_min')->row()->amount;
		$data['WD_count'] = $this->db->where('name', 'count_wd')->get('tb_withdraw_min')->row()->amount;
		$data['menu'] = 'withdraw';
		$data['bank_main'] = $this->db->select('status')->where('id', 7)->get('maintenance')->row();

		$turn =  $this->get_ch_turn($userid);
		if ($turn != null) {
			$data['checkturn'] = $turn;
		} else {
			$data['checkturn'] = 0;
		}
		//ดึง turn เรียกใช้ function get_ticket
		// $data['stake'] = array('data'=> $this->get_ticket($user,$dateF,$dateE));
		$this->load->view('withdraw', $data);
	}
	public function get_ch_turn($user)
	{
		return $this->db->select('*')->where('user_id', $user)->get('tb_turnover')->row();
	}
	public function get_ticket($ch)
	{
		$date1 = date('Y-m-d 00:00:00');
		$date2 = date('Y-m-d 23:59:59'); //วันที่ปัจจุบัน
		$dateE =  strtotime(date('Y-m-d H:i:s', strtotime($date2)));   //ลบ1วัน โดยกำหนดเป็นเช่นวันนี้19  เวลา 10.59
		$dateF =  strtotime(date('Y-m-d H:i:s', strtotime($date1)));
		$user = $this->session->member->id;
		$turn =  $this->get_ch_turn($user);

		if ($turn) {
			if ($turn->checkturn == 0 || $turn->checkturn == '0') {
				if ($ch == '1') {
					echo  json_encode(array('totalTurnover' => 'ไม่ติดเทิร์น..'));
					die;
				} else {
					return json_encode(array('totalTurnover' => 0));
				}
			} else {
				$dateF =  $turn->check_time;
				$data_sent = json_encode(array(
					"from" => (string)$dateF,  //วันที่
					"to" => (string)$dateE    //วันที่
				));
				if ($ch == '1') {
					// echo  $this->getapi_model->call_API_mongo('turnover/user/' . $this->session->member->user  . '/date', $data_sent, "POST");
					echo json_encode(array('totalTurnover' => $this->checkTurnover((string)$dateF, (string)$dateE)));
					die;
				} else {
					// return $this->getapi_model->call_API_mongo('turnover/user/' . $this->session->member->user  . '/date', $data_sent, "POST");
					return json_encode(array('totalTurnover' => $this->checkTurnover((string)$dateF, (string)$dateE)));
				}
			}
		} else {
			if ($ch == '1') {
				echo  json_encode(array('totalTurnover' => 'ไม่ติดเทิร์น.'));
				die;
			} else {
				return json_encode(array('totalTurnover' => 0));
			}
		}
	}

	public function profile()
	{
		$data['menu'] = 'profile';
		$this->load->view('profile', $data);
	}
	public function report_state()
	{
		$data['statement'] = $this->db->where('user_id', $this->session->member->id)->order_by('datetime', 'DESC')->limit(3)->get('tb_statement')->result_array();
		$data['withdraw'] = $this->db->where('user_id', $this->session->member->id)->order_by('time', 'DESC')->limit(3)->get('tb_withdraw')->result_array();
		$this->load->view('report_state', $data);
	}

	public function contact_web()
	{
		$this->load->view('contact_web');
	}
	public function api_cradit($user)
	{
		//array api
		$arr_userAPI = array(
			'AgentName'	=> $this->getapi_model->agent(),
			'PlayerName' => $user,
			'TimeStamp'	=> time(),
		);
		$dataAPI = array(
			'type'		=> 'D',
			'agent' 	=> $this->getapi_model->agent(),
			'member' 	=> $user
		);

		$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
		$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
		if ($cre_userAPI->Error == 0) {
			$credit = number_format($cre_userAPI->Balance, 2);
		} else {
			$credit = number_format($cre_userAPI->Balance, 2);
			//			$credit = "Error";
		}
		return $credit;
	}
	public function checkWD()
	{

		$date1 = date('Y-m-d 00:00:00');
		$date2 = date('Y-m-d 23:59:59'); //วันที่ปัจจุบัน
		$dateE =  strtotime(date('Y-m-d H:i:s', strtotime($date2)));
		$dateF =  strtotime(date('Y-m-d H:i:s', strtotime($date1)));


		if ($this->input->post('amount')) {
			$amount 	= $this->input->post('amount');
			$user_r 	= $this->db->select('id,user')->where('id', $this->session->member->id)->get('tb_user')->row();

			//เช็คยอดว่ามีรายการถอน ค้างอยู่มั้ย
			$wd_status 	= array(2, 3);
			$checkWD 	= $this->db->where('user_id', $user_r->id)->where_not_in('status', $wd_status)->get('tb_withdraw');
			if ($checkWD->num_rows() >= 1) {
				$re = array('code' => 0, 'title' => 'มียอดค้างทำรายการอยู่', 'msg' => 'กรุณารอสักครู่หรือแจ้งพนักงานค่ะ');
				echo json_encode($re);
				die();
			}
			//ยอดถอนขั้นต่ำ ต้องมากกว่า wd_min
			$wd_min 	= $this->db->select('amount')->where('name', 'wd_min')->get('tb_withdraw_min')->row()->amount;
			if ($wd_min  > $amount) {
				$re = array('code' => 0, 'title' => 'จำนวนเงินน้อยเกินไป', 'msg' => 'กรุณาทำรายการถอนขั้นต่ำ' . $wd_min . ' บาท หรือมากกว่า');
				echo json_encode($re);
				die();
			}
			//ถอนเงินได้สูงสุดต่อครั้ง ต้องต่ำกว่า wd_max
			$wd_max 	= $this->db->select('amount')->where('name', 'wd_max')->get('tb_withdraw_min')->row()->amount;
			if ($amount > $wd_max) {
				$re = array('code' => 0, 'title' => 'ถอนเกินยอดที่ตั้งไว้', 'msg' => 'กรุณาทำรายการถอนยอดไม่เกิน' . number_format($wd_max));
				echo json_encode($re);
				die();
			}


			// เช็คเทิรนืกอนถอน
			$checkturn = $this->get_ch_turn($this->session->member->id);
			if ($checkturn) {
				$stake = $this->get_ticket(0);
				$dataG = json_decode($stake);
				if ((float)$dataG->totalTurnover < (float)$checkturn->checkturn) {
					$checkturn = (float)$checkturn->checkturn;
					if ((float)$dataG->totalTurnover < (float)$checkturn) {
						$re = array('code' => 0, 'title' => 'ไม่ถึงยอดเทิร์น', 'msg' => 'กรุณาเล่นให้ถึงยอดเทิร์น' . number_format(($checkturn), 2));
						echo json_encode($re);
						die();
					}
				}
			}


			//จำนวนรายการถอนต่อวันที่อนุมัติแล้วต้องไม่เกิน wd_count 
			$wd_count 	= $this->db->select('amount')->where('name', 'count_wd')->get('tb_withdraw_min')->row()->amount;
			$wd_us_cout	= $this->db->select('COUNT(id) as count_user')
				->where('time >=', strtotime(date('d-m-Y 00:00')))
				->where('time <=', strtotime(date('d-m-Y 23:59')))
				->where('user_id', $user_r->id)
				->where('status', 2)
				->get('tb_withdraw')->row()->count_user;
			if ($wd_count <= $wd_us_cout) {
				$re = array('code' => 0, 'title' => 'ถอนเกินจำนวนต่อวัน', 'msg' => 'กรุณาทำรายการถอนไม่เกิน' . $wd_count . ' ครั้ง/ต่อวัน');
				echo json_encode($re);
				die();
			}

			$re = array('code' => 1, 'title' => '', 'msg' => '');
		} else {
			$re = array('code' => 0, 'title' => 'ยอดเงินไม่พอ', 'msg' => 'กรุณาทำรายการใหม่');
		}
		echo json_encode($re);
		die();
	}


	public function WD()
	{
		if ($this->input->post('amount')) {
			$amount = $this->input->post('amount');
			$user_r = $this->db->select('tb_user.id,tb_user.user,tb_user_bank.account,tb_user_bank.bank_id')
				->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
				->where('tb_user.id', $this->session->member->id)
				->get('tb_user')
				->row();

			$arr_userAPI = array(
				'AgentName'	=> $this->getapi_model->agent(),
				'PlayerName' => $user_r->user,
				'Amount'	=> $amount,
				'TimeStamp'	=> time()
			);
			$dataAPI = array(
				'type'		=> 'D',
				'agent' 	=> $this->getapi_model->agent(),
				'member' 	=> $user_r->user,
			);

			$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/withdraw';
			$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);

			if ($cre_userAPI->Success == 1) {

				$bank_api = $this->db->where('id', $user_r->bank_id)->get('tb_bank')->row();
				$arr_wdDB = array(
					'time'			=> time(),
					'user_id'		=> $user_r->id,
					'account'		=> $user_r->account,
					'amount'		=> $amount,
					'bank_api'		=> $bank_api->api_id,
					'status'		=> 1,
					'admin_cf'		=> 0,
					'admin_check'	=> 0,
					'admin_cfTime'	=> 0,
					'bank_web_id'	=> 0,
				);
				if ($this->db->insert('tb_withdraw', $arr_wdDB)) {
					$this->notify_line(time(), $user_r->user, $amount);
					$re = array('code' => 1, 'title' => 'ทำรายการสำเร็จ', 'msg' => 'กรุณารอสักครู่ระบบกำลังดำเนินการ');
					$this->db->where('user_id', $user_r->id)->update('tb_turnover', array('promotion_id' => 0, 'code_id' => 0, 'sport' => '0', 'casino' => '0', 'game' => '0', 'checkturn' => '0', 'check_time' => time()));
				} else {
					$re = array('code' => 0, 'title' => 'ไม่สามารถบันทึกได้', 'msg' => 'กรุณาแจ้งพนักงาน');
				}
			} else {
				$re = array('code' => 0, 'title' => 'ยอดเครดิตลูกค้าไม่พอ', 'msg' => 'กรุณาทำรายการใหม่');
			}
		} else {
			$re = array('code' => 0, 'title' => 'ยอดเงินไม่พอ', 'msg' => 'กรุณาทำรายการใหม่');
		}
		echo json_encode($re);
		die();
	}
	public function logout()
	{
		$user_id = $this->session->member->id;
		if (session_destroy()) {
			$iPod    = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
			$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
			$iPad    = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
			$Android = stripos($_SERVER['HTTP_USER_AGENT'], "mobile");
			$webOS   = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

			//do something with this information
			// 1:Iphone 2:Ipad 3:webOS 4:Android 5:PC
			// 1:login 2:logout
			if ($iPod || $iPhone) {
				$platform = 1;
			} else if ($iPad) {
				$platform = 2;
			} else if ($webOS) {
				$platform = 3;
			} else if ($Android) {
				$platform = 4;
			} else {
				$platform = 5;
			}

			$arr_log = array(
				'user_id' 	=> $user_id,
				'action' 	=> 2,
				'ip' 		=> $this->get_client_ip(),
				'platform'  => $platform,
				'create_time'  => time()
			);

			if ($this->db->insert('log_user_login', $arr_log)) {
				$re = array('code' => 1, 'title' => 'Logout', 'msg' => $this->getapi_model->nameweb() . ' ยินดีต้อนรับและพร้อมให้บริการทุกเวลาค่ะ');
			} else {
				$re = array('code' => 1, 'titel' => 'สำเร็จ', 'msg' => 'ระบบ Log ไม่สามารถบันทึกได้');
			}
		} else {
			$re = array('code' => 0, 'title' => 'Logout', 'msg' => 'ไม่สำเร็จกรุณา Logout ใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}
	public function check_login_imi()
	{


		$user = $this->db->select('user,password')->where('user', $this->session->member->user)->where('status', 1)->get('tb_user')->row();
		$username = $user->user;
		$password = $user->password;
		$lang = 'en';
		if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
			$res = $this->api_model->api_login_mobile($username, $password, $lang);
		} else {
			$res = $this->api_model->api_login($username, $password, $lang);
		}


		$res = json_decode($res);
		if ($res->ErrorCode >= 0) {
			echo json_encode(array('code' => 1, 'msg' => $res->ErrorMessage, 'data' => $res));
			die();
		} else {
			echo json_encode(array('code' => 0, 'msg' => $res->ErrorMessage));
			die();
		}
	}

	public function gen_link()
	{

		if ($username = $this->input->post('username')) {
			$token = $this->gen_token($username);
			$check_token = $this->db->select('token')->where('token', $token)->get('tb_sale');
			if ($check_token->num_rows() <= 0) {
				echo $res = json_encode(array('token' => $token));
				// print_r($res);
				die();
			}
		}
	}

	public function gen_token($username)
	{


		$token = '';

		$token = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($username));

		return $token;
	}
	function get_client_ip()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if (getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if (getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if (getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if (getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if (getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	function notify_line($wd_time, $user, $amount)
	{
		if ($lnfy = $this->db->where('type', 'withdraw')->get('tb_linenotify')->row()) {
			if ($lnfy->token != '') {
				$wd_delay 	= time() - $wd_time;
				$delay		= $lnfy->delay * 60;
				if ($amount >= $lnfy->balance || $wd_delay > $delay) {

					//					$messageNofity = 'ถอนสำเร็จ รหัส:'.substr($user,-6).' จำนวน:'.$amount.' ใช้เวลา:'.(number_format($wd_delay/60)).'นาที';
					$messageNofity = 'Withdraw: รหัส:' . substr($user, -6) . ' แจ้งถอน จำนวน: ' . $amount . ' บาท';
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
	}
	function close_maintenance()
	{
		$this->session->maintenance = 1;
		echo json_encode(1);
		die();
	}

	function close_bankmain()
	{
		$id = $this->input->post('id');

		if ($id == '1') {
			$this->session->kbank = 1;
		} else if ($id == '2') {
			$this->session->scb = 1;
		} else if ($id == '3') {
			$this->session->ktb = 1;
		} else if ($id == '4') {
			$this->session->scb_w = 1;
		}

		echo json_encode(1);
		die();
	}



	// ================== bulldog call gameplay ===============
	public function call_gameplay()
	{
		$token = $this->session->member->token;
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://mem.imiwin.com/play/cq9?game=184",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Cookie: _lang=en-us; _auth=" . $token . "; "
			),
		));

		$response = curl_exec($curl);

		print_r($curl);

		curl_close($curl);
		// echo  $response;
		die;
		// echo "<script>window.open('about:blank','','titlebar=yes,toolbar=yes,location=yes,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=700,Height=800,left=200,top=50');
		// </script>";

	}
	// ================== END bulldog call gameplay ===============


	// ========================= fun getturn by vendor=============================
	public function checkTurnover($d1, $d2)
	{

		$user = $this->session->member->user;
		// $d1 = strtotime($this->input->post('d1')." 00:00:01");
		// $d2 = strtotime($this->input->post('d2')." 23:59:59");
		$vender =  $this->db->where('check_turn', 1)->get('tb_vendor')->result_array();
		$game = [];
		$casino = [];
		$sport = [];
		foreach ($vender as $k => $v) {
			switch ($v['type']) {
				case 1: //game
					array_push($game, array('id' => $v['vendor_id'], 'name' => $v['VendorName']));
					break;
				case 2: //casino
					array_push($casino, array('id' => $v['vendor_id'], 'name' => $v['VendorName']));
					break;
				case 3: //sport
					array_push($sport, array('id' => $v['vendor_id'], 'name' => $v['VendorName']));
					break;
				default:
					break;
			}
		}

		$dgame =  json_decode($this->getTurnoverByUserVendorDate($user, $game, $d1, $d2));
		$dcasino = json_decode($this->getTurnoverByUserVendorDate($user, $casino, $d1, $d2));
		$dsport = json_decode($this->getTurnoverByUserVendorDate($user, $sport, $d1, $d2));

		return (float)$dgame->totalTurnover +  (float)$dcasino->totalTurnover + (float)$dsport->totalTurnover;
	}
	public function getTurnoverByUserVendorDate($user, $venderArr, $dateF, $dateE)
	{
		$arrV = [];
		foreach ($venderArr as $k => $v) {
			array_push($arrV, $v['id']);
		}
		$data_sent = json_encode(array(
			"venders" =>  $arrV,
			"from" => $dateF,
			"to" => $dateE
		));

		return $this->getapi_model->call_API_mongo('turnover/venders/user/' . $user . '/date', $data_sent, "POST");
	}

	public function check_alert()
	{

		$user_id = $this->input->post('user_id');
		$bankWeb_q = $this->db->select('tb_bank_web.*,tb_bank.bank_short,tb_bank.api_id,tb_bank.bank_th')
			->join('tb_bank_group', 'tb_bank_group.bank_id = tb_bank_web.id', 'left')
			->join('tb_user_group', 'tb_user_group.group_id = tb_bank_group.group_id', 'left')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
			->where('tb_user_group.user_id', $this->session->member->id)
			->where('tb_bank_web.type', 1)
			->where('tb_user_group.status', 1)
			->where('tb_bank_web.status', 3)
			->where('tb_bank_group.status', 1)
			->group_by('tb_bank_web.id')
			->get('tb_bank_web');
		if ($bankWeb_q->num_rows() >= 1) {
			$data['bankWeb'] = $bankWeb_q->result_array();
		} else {
			$data['bankWeb'] = '';
		}

		$i = 0;
		foreach ($data['bankWeb'] as $bnkW) {

			$bank_alert = $this->db->where('bank_id', $bnkW['bank_id'])
				->get('tb_bank_maintenance')
				->result_array();
			$alert[$i]['bank_alert'] = $bank_alert;
			$i++;
		}

		$depo = $this->db->where('bank_id', 5)->get('tb_bank_maintenance')->row();


		$re = array('code' => 1, 'data' => $alert, 'depo' => $depo);
		echo json_encode($re);
		die();
	}
}

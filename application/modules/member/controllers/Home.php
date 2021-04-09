<?php
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->library('Member_libraray');
		$this->load->model('api/api_model');
		$this->_init();
	}
	private function _init()
	{	
		$close_sysmember = $this->db->select('*')->where('id',3)->get('maintenance')->row();
		if($close_sysmember->status == 1){	
			$this->output->set_template('tem_web/tem_mapraw');
		}else{
			
		}
	}

	public function index()
	{
		$close_sysmember = $this->db->select('*')->where('id',3)->get('maintenance')->row();
		if($close_sysmember->status == 1){
			if(!empty($this->session->member->user)){redirect(base_url().'users/member');}
			$data['bank'] = $this->db->get('tb_bank')->result_array();
			$data['maintenance'] = $this->db->select('status,name')->where('id',6)->get('maintenance')->row();
			$this->load->view('home',$data);
		}else{
			$this->session->member = '';
			$this->load->view('405');
		}
	}
	public function login()
	{
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
		Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
		Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
		if($this->input->post('username') && $this->input->post('password')){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user_q = $this->db->where('status', 1)->where('username',$username)->or_where('user',$username)->get('tb_user');


			if($user_q->num_rows() == 1){
				$user_r = $user_q->row();
				$agent 	= $this->getapi_model->agent();
				
				

				//do something with this information
				// 1:Iphone 2:Ipad 3:webOS 4:Android 5:PC
				// 1:login 2:logout
				$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
				$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
				$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
				$Android = stripos($_SERVER['HTTP_USER_AGENT'],"mobile");
				$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
				
				if( $iPod || $iPhone ){
					$platform = 1;
					$IsMobile = 'true';
				}else if($iPad){
					$platform = 2;
					$IsMobile = 'true';
				}else if($webOS){
					$platform = 3;
					$IsMobile = 'false';
				}else if($Android){
					$platform = 4;
					$IsMobile = 'true';
				}else{
					$platform = 5;
					$IsMobile = 'false';
				} 
				
				//array api
				$arr_userAPI = array( 
					'Username'	=> $user_r->user,    
					'Partner'	=> $agent,
					'TimeStamp'	=> time(),    
					'Domain'	=> base_url().'users/member', 
					'Lang' 		=> 'en-us',
 					'IsMobile'	=> false, 
				);
				// echo'<pre>1';
				// print_r($arr_userAPI);
				$dataAPI = array(
					'type'		=> 'L',
					'agent' 	=> $agent,
					'member' 	=> $user_r->user,
					'password' 	=> $password,
				);

				$url_api = 'https://cauthapi.linkv2.com/api/credit-auth/login';
				$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);


				if($cre_userAPI->Error == 0){ //Sucess
					$user_log = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($user_r->id))), -6);
					$arr_log = array(
						'user_id' 	=> substr($user_log,-6),
						'action' 	=> 1,
						'ip' 		=> $this->get_client_ip(),
						'platform'  => $platform,
						'create_time'  => time()
					);

					if($this->db->insert('log_user_login',$arr_log)){
						$re = array('code'=>1,'titel'=>'สำเร็จ','msg'=>'ยินดีต้อนรับเข้าสู่เว็บไซต์ '.$this->getapi_model->nameweb());
					}else{
						$re = array('code'=>1,'titel'=>'สำเร็จ','msg'=>'ระบบ Log ไม่สามารถบันทึกได้');
					}
					$this->session->member = $user_r;
					$this->session->member->RedirectUrl = $cre_userAPI->RedirectUrl;
					$this->session->member->token = $cre_userAPI->Token;

				} else if($cre_userAPI->Error == -2){ //Password fail
					$re = array('code'=>2,'titel'=>'พาสเวิร์ดผิด','msg'=>'กรุณาติกรอกพาสเวิร์ดใหม่อีกครั้งค่ะ');
				}else if($cre_userAPI->Error == -3){ //Username fail
					$re = array('code'=>0,'titel'=>'ยูเซอร์ในระบบไม่ถูกต้อง','msg'=>'กรุณาติดต่อพนักงานค่ะ');
				}else{
					$re = array('code'=>0,'titel'=>'Usernae or password fail.','msg'=>'กรุณาสมัครใหม่ชิกหรือติดต่อพนักงานค่ะ');
				}
			}else{	

					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$lang = 'en';
					if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
						$re = $this->api_model->api_login_mobile($username, $password, $lang);
					} else {
						$re = $this->api_model->api_login($username, $password, $lang);
					}


					$re = json_decode($re);
					if ($re->ErrorCode >= 0) {
						$re = array('code'=>6,'titel'=>'สำเร็จ ยินดีต้อนรับเข้าสู่เว็บไซต์ IMI55','msg' => $re->ErrorMessage, 'data' => $re);
					} else {
						$re = array('code'=>2,'titel'=>'พาสเวิร์ดผิด','msg'=>'กรุณาติกรอกพาสเวิร์ดใหม่อีกครั้งค่ะ');
						
					}


				}
			}else{

				$re = array('code'=>0,'titel'=>'Usernae or password fail.','msg'=>'กรุณากรอกใหม่อีกครั้งค่ะ');
			}
		echo json_encode($re);
		die();
	
			
		
	}

	public function register()
	{	
		$tel = $this->input->post('tel'); 
		
		if(strlen($tel) == '10'){
			
			$user_q = $this->db->select('tb_user.username,tb_user.password,tb_bank.id, tb_user_bank.account,tb_bank.bank_th,tb_bank.bank_short ,tb_user.user')
				->join('tb_user_bank', 'tb_user.id = tb_user_bank.user_id', 'left')
				->join('tb_bank', 'tb_user_bank.bank_id = tb_bank.id', 'left') //select ธนาคารมา
				->where('tb_user.username', $tel)
				->get('tb_user');

			$user_r = $user_q->row();

			if($user_q->num_rows() == 0){
				$ref  	= $this->generateRandomString(4);
				$otp  	= rand(6,999999);
				$cTime 	= time();
				
				//เช็กว่าเคยยืนยัน OTP สำเร็จแล้วหรือยัง
				$otpSuccess = $this->db->where('tel',$tel)->where('status',2)->order_by('create_time','DESC')->limit(1)->get('tb_otp');
				if($otpSuccess->num_rows() == 0){
					//เช็กว่าส่ง OTP เกิน 5 ครั้งหรือป่าว
					$otp_q 	= $this->db->where('tel',$tel)->where('status',1)->get('tb_otp');
					if($otp_q->num_rows() <= 5){
						$arrOtp = array(
							'tel' => $tel,
							'ref' => $ref,
							'otp' => $otp,
							'create_time'=> $cTime,
							'status'=> 1
						);
						if($this->db->insert('tb_otp',$arrOtp)){
							$messag = 'IMI REF['.$ref.']'.' OTP['.$otp.']';
							 $this->getapi_model->send_sms($tel,$messag);
							 $re = array('code'=>1,'titel'=>'ลงทะเบียนสำเร็จ','msg'=>'','ref'=>$ref);
						}else{
							$re = array('code'=>0,'titel'=>'ทำรายการไม่ถูกต้อง','msg'=>'กรุณากรอกเบอร์โทรใหม่ค่ะ 1.1','ref'=>'0');
						}
					}else{
						$re = array('code'=>0,'titel'=>'ส่ง OTP มากเกินต่อ 1 วัน','msg'=>'กรุณาติดต่อพนักงาน 1.2','ref'=>'0');
					}
				}else{
					$re = array('code'=>3,'titel'=>'เบอร์โทรถูกยืนยันแล้ว','msg'=>'กรุณากรอกรายละเอียดเพิ่มเติม 1.3','ref'=>'0');
				}
			}else{
				if ($user_r->user != '') {
					$re = array('titel' => 'เบอร์โทรถูกใช้งานแล้ว', 'msg' => 'กรุณาติดต่อพนักงานหรือทำการเข้าระบบได้เลยค่ะ 1.4', 'code' => 2);
				} else {
					$re = array('code' => 4,'user' => $user_r);
				}
			}
		}else{
			$re = array('code'=>0,'titel'=>'เบอร์โทรไม่ถูกต้อง','msg'=>'กรุณากรอกเบอร์โทรใหม่ค่ะ 1.5','ref'=>'1');
		}
		
		echo json_encode($re);
		die();
	}
	public function otp()
	{
		
		if($this->input->post('otp') && $this->input->post('ref') && $this->input->post('tel')){
			$ref  = $this->input->post('ref');
			$otp  = $this->input->post('otp');
			$tel2 = $this->input->post('tel'); 
			$otp_q = $this->db->where('tel',$tel2)->where('ref',$ref)->where('otp',$otp)->order_by('create_time','DESC')->limit(1)->get('tb_otp');
			if($otp_q->num_rows() == 1){
				$otp_r = $otp_q->row();
				$timeNow = strtotime('-5 minutes');
				if($otp_r->create_time >= $timeNow){
					$this->db->where('id',$otp_r->id)->set('status',2)->update('tb_otp');
					$re = array('code'=>1,'titel'=>'ลงทะเบียนสำเร็จ','msg'=>'ยินดีต้อนรับสู่ระบบอัตโนมัติ','ref'=>'0');
					
				}else{
					$re = array('code'=>2,'titel'=>'OTP หมดเวลา','msg'=>'กรุณากรอกกดส่งใหม่อีกครั้งค่ะ','ref'=>'0');
				}
			}else{
				$re = array('code'=>2,'titel'=>'ข้อมูล OTP ผิด','msg'=>'กรุณากรอก OTP ใหม่อีกครั้งค่ะ','ref'=>'0');
			}
		}else{
			$re = array('code'=>0,'titel'=>'ข้อมูลไม่ถูก','msg'=>'กรุณาลงทะเบียนใหม่ค่ะ','ref'=>'0');
		}
		echo json_encode($re);
		die();
	}

	function generateRandomString($length = 4) 
	{
//		print_r($this->input->get) ;die();
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function createUser()
	{
		if (preg_match("/^[a-z0-9]+$/", $this->input->post('newpass')) != 1) {
			$re = array('titel' => 'พาสเวิร์ดผิดพลาด', 'msg' => 'เช่น aa123654', 'code' => 2);
			echo json_encode($re);
			die();
		}
		if (strlen($this->input->post('newpass')) < 8) {
			$re = array('titel' => 'พาสเวิร์ดผิดพลาด', 'msg' => 'เช่น aa123654', 'code' => 2);
			echo json_encode($re);
			die();
		}
		if ($this->input->post('tel')  && $this->input->post('newpass')  && $this->input->post('bank_id') && $this->input->post('account')) {

			//    [tel] => 0900430436
			//    [newpass] => Aa123654
			//    [account] => 1235456654
			//    [bank_id] => 2
			//    [s_id] => home
			//set value
			$username 	= $this->input->post('tel');
			$password 	= $this->input->post('newpass');
			$bank_id 	= $this->input->post('bank_id');
			$account 	= $this->input->post('account');
			$sale_token	= $this->input->post('s_id', TRUE);

			//check username / bank_id & account
			$chk_user 	= $this->db->where('username', $username)->where_not_in('status', '0')->get('tb_user');
			$chk_bank	= $this->db->where('account', $account)->where_not_in('status', '0')->get('tb_user_bank');
			$chk_u = $chk_user->row();
			if ($chk_user->num_rows() <= 0) {
				if ($chk_bank->num_rows() <= 0) {
					// in tb_user
					$arr_userDB = array(
						'username'	=> $username,
						'password'	=> $password,
						'user' 		=> '',
						'name' 		=> '',
						'create_time' => time(),
						'comefrom'  => 2,
						'status' 	=> 1
					);
					//START
					if ($this->db->insert('tb_user', $arr_userDB)) {
						$user_id = $this->db->insert_id();
						$user_new = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($user_id))), -6); //gen user
						$arr_bankUsDB = array(
							'user_id'	=> $user_id,
							'bank_id'	=> $bank_id,
							'account'	=> $account,
							'create_time' => time(),
							'status'	=> 1
						);
						if ($this->db->set('user', $user_new)->where('id', $user_id)->update('tb_user')) {
							if ($this->db->insert('tb_user_bank', $arr_bankUsDB)) {
								// in tb group
								$this->insert_groupuser($bank_id, $user_id);
								// in tb API
								$arr_userAPI = array(
									'Username'	=> $user_new,
									'Agentname'	=> $this->getapi_model->agent(),
									'Fullname'	=> 'auto register',
									'Password'	=> $password,
									'Currency'	=> 'THB',
									'Dob'		=> '2020-01-01',
									'Gender'	=> 0,
									'Email'		=> "auto@email.com",
									'Mobile'	=> $username,
									'Ip'		=> $this->get_client_ip(),
									'TimeStamp'	=> time(),
								);
								$dataAPI = array(
									'type'		=> 'R',
									'agent' 	=> $this->getapi_model->agent(),
									'member' 	=> $user_new,
								);
								$url_api = 'https://cauthapi.linkv2.com/api/credit-auth/xregister';
								$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
								if ($cre_userAPI->Success == 1) {
									// In sale
									if (!empty($sale_token)) {
										$sale_q = $this->db->select('*')->where('token', $sale_token)->get('tb_sale');
										if ($sale_q->num_rows() == 1) {
											$sale_r = $sale_q->row();
											$arr_idSale = array(
												'user_id' 	=> $user_id,
												'sale_id' 	=> $sale_r->id,
												'status' 	=> 1,
											);
											$this->db->insert('tb_sale_user', $arr_idSale);
											$turn = $this->db->select('code')->where('name','set_newusersale_turn')->get('setting')->row();
											$this->check_tb_turnover($user_id,$turn->code);

										} else {
											// user suggest
											$sale_q = base64_decode($sale_token);
											$user_s = $this->db->select('*')->where('username', $sale_q)->where('status', 1)->get('tb_user');
											if ($user_s->num_rows() == 1) {
												$user_d = $user_s->row();
												$arr_idSale = array(
													'user_id' => $user_id,
													'sale_userid' => $user_d->id,
													'status' => 1,
												);
												$this->db->insert('tb_user_sale', $arr_idSale);
												$turn = $this->db->select('code')->where('name','set_newuser_turn')->get('setting')->row();
												$this->check_tb_turnover($user_id,$turn->code);
											}
										}
									}
									// in API sms
									$messag = 'imi ชื่อผู้ใช้ : ' . $username . ' รหัสผ่าน : ' . $password;
									$this->getapi_model->send_sms($username, $messag);
									$user_q  = $this->db->where('id', $user_id)->get('tb_user');

									//Line Nofity
									if ($lnfy = $this->db->where('type', 'register')->get('tb_linenotify')->row()) {
										if ($lnfy->token != '') {
											$date = date('d-m-Y เวลา: H:i:s', time());
											$count_u	= $this->db->select('COUNT(username) as num_user')
												->where('create_time >=', strtotime(date('Y-m-d 00:01')))
												->where('create_time <=', strtotime(date('Y-m-d 23:59')))
												->get('tb_user')->row()->num_user;
											// $messageNofity = 'สมัครใหม่ รหัส:'.$user_new.' โทร:'.$username;
											$messageNofity = 'วันที่' . $date . PHP_EOL .
												'รหัส:' . $user_new . PHP_EOL .
												'Username:' . $username . PHP_EOL .
												'========================' . PHP_EOL .
												'เว็บของเราได้สมาชิกใหม่ในวันนี้: ' . $count_u . ' คน(สู้ต่อไป)';
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
									 // telegram notify
									 $date = date('d-m-Y',time());
									 $time = date('H:i:s',time());
									 $nameweb = $this->getapi_model->nameweb();
									 $count_u	= $this->db->select('COUNT(username) as num_user')
															 ->where('create_time >=',strtotime(date('Y-m-d 00:01')))
															 ->where('create_time <=',strtotime(date('Y-m-d 23:59')))
															 ->get('tb_user')->row()->num_user;
													  $curl = curl_init();
  
													  curl_setopt_array($curl, array(
														CURLOPT_URL => "http://imi55.com:9999/webhook/message/register/chat",
														CURLOPT_RETURNTRANSFER => true,
														CURLOPT_ENCODING => "",
														CURLOPT_MAXREDIRS => 10,
														CURLOPT_TIMEOUT => 0,
														CURLOPT_FOLLOWLOCATION => true,
														CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
														CURLOPT_CUSTOMREQUEST => "POST",
														CURLOPT_POSTFIELDS =>"{\r\n    \"date\": \"$date\",\r\n    \"time\": \"$time\",\r\n    \"playerName\": \"$user_new\",\r\n    \"username\": \"$username\",\r\n    \"domainName\": \"$nameweb\",\r\n    \"count\": \"$count_u\"\r\n \"type\":2\r\n}",
														CURLOPT_HTTPHEADER => array(
														  "Content-Type: application/json"
														),
													  ));
													  
													  $response = curl_exec($curl);
													  
													  curl_close($curl);
													 //  echo $response;

									if ($user_q->num_rows() == 1) {
										$user_r = $user_q->row();
										$this->session->member = $user_r;
										$re = array('titel' => 'ยินดีต้อนรับสู่ระบบ ' . $this->getapi_model->nameweb(), 'msg' => '', 'code' => 1);
									} else {
										$re = array('titel' => 'กรุณาล็อกอิน', 'msg' => 'ยินดีต้อนรับสมาชิกใหม่ ' . $this->getapi_model->nameweb(), 'code' => 1);
									}
								} else {
									$this->db->set('status', 0)->where('id', $user_id)->update('tb_user');
									$this->db->set('status', 0)->where('user_id', $user_id)->update('tb_user_bank');
									$re = array('titel' => 'บันทึกยูเซอร์ไม่สำเร็จ', 'msg' => 'เกิดปัญหาการอัพเดท กรุณาสมัครใหม่อีกครั้งค่ะ', 'code' => 0);
								}
							} else {
								$this->db->set('status', 0)->where('id', $user_id)->update('tb_user');
								$re = array('titel' => 'บันทึกยูเซอร์ไม่สำเร็จ', 'msg' => 'เกิดปัญหาการอัพเดท กรุณาสมัครใหม่อีกครั้งค่ะ', 'code' => 0);
							}
						} else {
							$this->db->set('status', 0)->where('id', $user_id)->update('tb_user');
							$re = array('titel' => 'บันทึกยูเซอร์ไม่สำเร็จ', 'msg' => 'เกิดปัญหาการอัพเดท กรุณาสมัครใหม่อีกครั้งค่ะ Code : set user tb user', 'code' => 0);
						}
					} else {
						$re = array('titel' => 'บันทึกยูเซอร์ไม่สำเร็จ', 'msg' => 'Erorr code : in tb user', 'code' => 0);
					}
					// END
				} else {
					$re = array('titel' => 'บัญชีธนาคารซ้ำ', 'msg' => 'กรุณากรอกบัญชีธนาคารใหม่', 'code' => 2);
				}
			} else {
				if ($chk_u->user != '') {
					$re = array('titel' => 'เบอร์โทรซ้ำ', 'msg' => 'กรุณากรอกเบอร์โทรใหม่', 'code' => 2);
					// print_r($chk_u->user);
				} else {
					$user_id = $chk_u->id;
					$this->regis_again($user_id, $password, $username);
					$re = array('titel' => 'ยินดีต้อนรับสู่ระบบ ' . $this->getapi_model->nameweb(), 'msg' => '', 'code' => 1);
				}
			}
		} else {
			$re = array('titel' => 'ข้อมูลไม่ครบ', 'msg' => 'ข้อมูไม่ครบ', 'code' => 0);
		}
		echo json_encode($re);
		die();
	}
	public function mb_login()
	{
		if($this->input->post('mb_username') && $this->input->post('mb_password') ){
			
			$mb_username 	= $this->input->post('mb_username');
			$mb_password 	= $this->input->post('mb_password');
	
			$agent 	= $this->getapi_model->agent();
			 
			//array api
			$arr_userAPI = array( 
				'Username'	=> $mb_username,    
				'Partner'	=> $agent,
				'TimeStamp'	=> time(),    
			);
			$dataAPI = array(
				'type'		=> 'L',
				'agent' 	=> $agent,
				'member' 	=> $mb_username,
				'password' 	=> $mb_password,
			);
			$url_api = 'https://cauthapi.linkv2.com/api/credit-auth/login';
			$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);

			
			if($cre_userAPI->Error == 0){ //Sucess
				$re = array('code'=>1,'titel'=>'สำเร็จ','msg'=>'','pass'=>$mb_password,'mbuser'=>$mb_username);
			}else if($cre_userAPI->Error == -2){ //Password fail
				$re = array('code'=>2,'titel'=>'พาสเวิร์ดผิด','msg'=>'กรุณาติกรอกพาสเวิร์ดใหม่อีกครั้งค่ะ');
			}else if($cre_userAPI->Error == -3){ //Username fail
				$re = array('code'=>0,'titel'=>'ยูเซอร์ในระบบไม่ถูกต้อง','msg'=>'กรุณาติดต่อพนักงานค่ะ');
			}else{
				$re = array('code'=>0,'titel'=>'Usernae or password fail.','msg'=>'กรุณาสมัครใหม่ชิกหรือติดต่อพนักงานค่ะ');
			}
		}else{
			$re = array('titel'=>'ข้อมูลไม่ครบ','msg' =>'ข้อมูไม่ครบ','code'=> 0 );
		}
		echo json_encode($re);
		die();
	}
	public function members()
	{
//		Array ( [phone] => 0000002054 [user] => 45645646 [pass] => 4564564564 [bank_id] => 2 [account] => 12345321312313 )
		if($this->input->post('user') && $this->input->post('phone') && $this->input->post('pass') && $account = $this->input->post('account')){
			
			$phone 		= $this->input->post('phone');
			$user 		= $this->input->post('user');
			$pass 		= $this->input->post('pass');
			$bank_id 	= $this->input->post('bank_id');
			$account 	= $this->input->post('account');
			$chk_user 	= $this->db->where('username',$phone)->where_not_in('status','0')->get('tb_user');
			$chk_userAPI= $this->db->where('user',$user)->where_not_in('status','0')->get('tb_user');
			$chk_bank	= $this->db->where('account',$account)->where_not_in('status','0')->get('tb_user_bank');
			if($chk_user->num_rows() == 0 ){
				if($chk_userAPI->num_rows() == 0 ){
					if($chk_bank->num_rows() == 0 ){
						$arr_mem 	= array(
										'username'	=> $phone,
										'password'	=> $pass,
										'user' 		=> $user,
										'name' 		=> '',
										'create_time' => time(),
										'comefrom'	=> 1,
										'status' 	=> 1
									);
						
						if($this->db->insert('tb_user',$arr_mem)){
							$user_id = $this->db->insert_id();
							$sale_id = $this->input->get('sale', TRUE);
							// เพิ่ม id เซลล์
							if($sale_id != ''){
								
								$arr_idSale = array(
									'user_id' => $user_id,
									'sale_id' => $sale_id,
								);
							$this->db->insert('tb_user_sale',$arr_idSale);
							}

							// in tb group
							$this->insert_groupuser($bank_id,$user_id);
							
							$arr_mbBank = array(
										'user_id'	=> $user_id,
										'bank_id'	=> $bank_id,
										'account'	=> $account,
										'create_time'=> time(),
										'status'	=> 1 
									);
							if($this->db->insert('tb_user_bank',$arr_mbBank)){
								$messag 	= 'imi U: '.$phone.' P: '.$pass;
								$this->getapi_model->send_sms($phone,$messag);
								$user_q  	= $this->db->where('id',$user_id)->get('tb_user');
								$user_r 	= $user_q->row();
								$this->session->member = $user_r;
								$re = array('titel'=>'ยินดีต้อนรับสู่ระบบ '.$this->getapi_model->nameweb(),'msg' =>'คุณสามารถเรียกใช้บริการพนักงานได้ตลอด 24ชั่วโมง' ,'code'=> 1 );
							}else{
								$re = array('titel'=>'บันทึกข้อมูลไม่สำเร็จ','msg' =>'กรุณาทำรายการใหม่อีกครั้งค่ะ','code'=> 0 );
							}
						}else{
							$re = array('titel'=>'บันทึกข้อมูลไม่สำเร็จ','msg' =>'กรุณาทำรายการใหม่อีกครั้งค่ะ','code'=> 0 );
						}
					}else{
						$re = array('titel'=>'ธนาคารซ้ำค่ะ','msg' =>'กรอกข้อมูลใหม่ค่ะ','code'=> 0 );
					}
				}else{
					$re = array('titel'=>'ยูเซอร์นี้ ลงทะเบียนไว้แล้วค่ะ','msg' =>'กรุณาติดต่อพนักงาน','code'=> 0 );
				}
			}else{
				$re = array('titel'=>'เบอร์ซ้ำ','msg' =>'กรอกข้อมูลใหม่ค่ะ','code'=> 0 );
			}	
		}else{
			$re = array('titel'=>'ข้อมูลไม่ครบ','msg' =>'ข้อมูไม่ครบ','code'=> 0 );
		}
		echo json_encode($re);
		die();
	}
	public function forget()
	{
		if($this->input->post('phone')){
			$phone 	= $this->input->post('phone');
			$user_q	= $this->db->where('username',$phone)->where('status',1)->get('tb_user');
			if($user_q->num_rows() == 1){
				$user_r = $user_q->row();
				$pass 	= $user_r->password;
				$messag = 'imi U: '.$phone.' P: '.$pass;
				$this->getapi_model->send_sms($phone,$messag);
				$re = array('titel'=>'รอขอสำเร็จ','msg' =>'' ,'code'=> 1 );
			}else{
				$re = array('titel'=>'ไม่มีเบอร์โทรศัพท์นี้ในระบบ','msg' =>'','code'=> 0 );
			}
		}else{
			$re = array('titel'=>'ข้อมูลไม่ครบ','msg' =>'ข้อมูไม่ครบ','code'=> 0 );
		}
		echo json_encode($re);
		die();
	}
	function insert_groupuser($bank_id,$user_id){
		//type = 2 คือเงื่อนไขที่ไม่เข้า default ลูกค้าสมัครใหม่
		$usgp2_q = $this->db->where('status',1)->where('type',2)->where('group_id',$bank_id)->get('tb_user_group_default');
		if($usgp2_q->num_rows()){
			$arr_usgp21 = array(
					'user_id' 	=> $user_id,
					'group_id' 	=> $bank_id,
					'status' 	=> 1,
				);
				
			$arr_usgp22 = array(
					'user_id' 	=> $user_id,
					'group_id' 	=> 1,
					'status' 	=> 1,
				);
			$this->db->insert('tb_user_group',$arr_usgp21);
			$this->db->insert('tb_user_group',$arr_usgp22);
		}else{
			$group_df = $this->db->where('status',1)->where('type',1)->get('tb_user_group_default')->result_array();
			foreach ($group_df as $gdf){
				$arr_gdf = array(
					'user_id' => $user_id,
					'group_id' => $gdf['group_id'],
					'status' => 1,
				);
				$this->db->insert('tb_user_group',$arr_gdf);
			}
		}

	}
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function regis_again($user_id, $password, $username)
	{

		$user_new = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($user_id))), -6); //gen user

		if ($this->db->set('user', $user_new)->where('id', $user_id)->update('tb_user')) {

			// in tb API
			$arr_userAPI = array(
				'Username'	=> $user_new,
				'Agentname'	=> $this->getapi_model->agent(),
				'Fullname'	=> 'auto register',
				'Password'	=> $password,
				'Currency'	=> 'THB',
				'Dob'		=> '2020-01-01',
				'Gender'	=> 0,
				'Email'		=> "auto@email.com",
				'Mobile'	=> $username,
				'Ip'		=> $this->get_client_ip(),
				'TimeStamp'	=> time(),
			);
			$dataAPI = array(
				'type'		=> 'R',
				'agent' 	=> $this->getapi_model->agent(),
				'member' 	=> $user_new,
			);
			$url_api = 'https://cauthapi.linkv2.com/api/credit-auth/xregister';
			$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
			if ($cre_userAPI->Success == 1) {
		
			}
		}
	}

	public function check_tb_turnover($id,$turn)
	{
		$check_data_tb_turnover = $this->db->where('user_id', $id)->where('status', 1)->get('tb_turnover');
			$arr_insert = array(
				'user_id' => $id,
				'promotion_id' => 0,
				'code_id' => 0,
				'sport' => '0',
				'casino' => '0',
				'game' => '0',
				'checkturn' => $turn,
				'check_time' => time(),
				'status' => 1
			);
		if ($check_data_tb_turnover->num_rows() == 1) {
			return $this->db->where('user_id',$id)->update('tb_turnover', $arr_insert);  // update	
		} else {
			return $this->db->insert('tb_turnover', $arr_insert);  // insert				
		}
	}

}


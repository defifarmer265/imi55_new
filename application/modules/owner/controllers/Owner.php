<?php
class Owner extends MY_Controller
{
	public function __construct()
	{
			parent::__construct();
			$this->load->model('backend/getapi_model');
			$this->load->model('owner_model');
			$this->load->library('owner_libraray');
			$this->load->library('backend/google_authenticator');
	}
	public function index()
	{
		$query = $this->db->where('id','1')->get('tb_service_charge')->row();
		if($query->confirm_web != 1){
			if(!empty($this->session->owner)){
				redirect('owner/home/dashboard','refresh');
			}else{
				
				

				// $oneCode = '';
				// echo "Checking Code '$oneCode'<br> and Secret: '$secret'<br>";
				
				// $checkResult = $this->google_authenticator->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
				// if ($checkResult) {
				// 	echo 'OK';
				// } else {
				// 	echo 'FAILED';
				// }


				$this->load->view('login');
			}
		}else{
			$this->load->view('close');
		}

	 }
	 
	public function login_check()
	{
		if($this->input->post('pin')){
			$pin = $this->input->post('pin');
		}else{
			$pin = null;
		}
		
		if($this->input->post('username')&& $this->input->post('password')){
			$username = $this->input->post('username');
			$password     = $this->input->post('password');
			$owner_q  = $this->db->where('username',$username)->get('tb_owner');
			if($owner_q->num_rows() == 1){
				$owner_r = $owner_q->row();
				if($owner_r->two_factor == null || $owner_r->two_factor == '' || $owner_r->two_factor == 'null'){
					$this->db->set('two_factor', '{"key":"","linkQr":"","status":"off"}')->where('id',$this->session->owner->id)->update('tb_owner');
				}
				$owner_r = $owner_q->row();
				if($owner_r->status ==1){
					if($this->owner_libraray->hash_password($password)== $owner_r->password){
						
						$ch_ft = json_decode($owner_r->two_factor);
						

						if($pin==null && $ch_ft->status=="on"){
							$re = array('code'=>3,'title'=>'กรุณากรอกรหัสชั้นที่2','msg'=>'กรุณากรอกรหัสชั้นที่2');
							echo json_encode($re);
							die();
						}elseif($pin!=null){
								$checkResult = $this->google_authenticator->verifyCode($ch_ft->key, $pin, 2);    // 2 = 2*30sec clock tolerance
								if ($checkResult) {
									$re = $this->set_session($owner_r,$username);
									echo json_encode($re);
									die();
								} else {
									$re = array('code'=>0,'title'=>'พาสเวิร์ดผิด','msg'=>'กรุณาลองใหม่ค่ะ');
									echo json_encode($re);
									die();
								}

						}


						$re = $this->set_session($owner_r,$username);
						



					}
					else{
						$re = array('code'=>0,'title'=>'พาสเวิร์ดผิด','msg'=>'กรุณาล็อกอินใหม่ค่ะ');
					}

				}else{
				$re = array('code'=>0,'title'=>'ยูเซอร์ของท่านถูกปิดใช้งานกรุณาติดต่อเจ้าหน้าที่','msg'=>'กรุณาล็อกอินใหม่ค่ะ');

				}
				
			}else{
				$re = array('code'=>0,'title'=>'ยูเซอร์หรือพาสเวิร์ดผิด','msg'=>'กรุณาล็อกอินใหม่ค่ะ');
			}
		}else{
			$re = array('code'=>0,'title'=>'ผิดพลาด','msg'=>'กรุณาล็อกอินใหม่ค่ะ');
		}

		echo json_encode($re);
		die();
	
	}
	public function set_session($owner_r,$username)
	{
		$token_login = md5(uniqid($owner_r->username,true));
						$last_login  = time();
						$lastip_login	= $this->owner_libraray->get_client_ip();
						$data_log    = array(
								'token_login'=>$token_login,
								'last_login' =>$last_login,
								'lastip_login'=>$lastip_login
						);
						$data_log2 = array(
							'owner_id'=>$username,
							'ip'=>$lastip_login,
							'action'=>'1',
							'datetime'=>time(),
						);
						$this->db->insert('log_owner_login',$data_log2);
						$this->db->where('id',$owner_r->id)->update('tb_owner',$data_log);
						$ownerid    = $owner_r->id;
						$owner_r->token_login = $token_login;
						$this->session->owner = $owner_r;
						$re = array('code'=>1,'title'=>'สำเร็จ','msg'=>'ยินดีต้อนรับ');
						return  $re;
	}
}



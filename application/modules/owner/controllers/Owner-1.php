<?php
class Owner extends MY_Controller
{
	public function __construct()
	{
			parent::__construct();
			$this->load->model('backend/getapi_model');
			$this->load->model('owner_model');
			$this->load->library('owner_libraray');
	}
	public function index()
	{
		if(!empty($this->session->owner)){
			redirect('owner/home/dashboard','refresh');
		}else{
			$this->load->view('login');
		}
 	}
	public function login_check()
	{
		if($this->input->post('username')&& $this->input->post('password')){
			$username = $this->input->post('username');
			$password     = $this->input->post('password');
			$owner_q  = $this->db->where('username',$username)->get('tb_owner');
			if($owner_q->num_rows() == 1){
				$owner_r = $owner_q->row();
				if($owner_r->status ==1){
					if($this->owner_libraray->hash_password($password)== $owner_r->password){
						$token_login = md5(uniqid($owner_r->username,true));
						$last_login  = time();
						$lastip_login	= $this->owner_libraray->get_client_ip();
						$data_log    = array(
								'token_login'=>$token_login,
								'last_login' =>$last_login,
								'lastip_login'=>$lastip_login
						);
						$this->db->where('id',$owner_r->id)->update('tb_owner',$data_log);
						$ownerid    = $owner_r->id;
						$owner_r->token_login = $token_login;
						$this->session->owner = $owner_r;
						$re = array('code'=>1,'title'=>'สำเร็จ','msg'=>'ยินดีต้อนรับ');
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
}



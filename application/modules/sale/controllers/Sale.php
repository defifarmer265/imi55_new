<?php
class Sale extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		
		$this->load->model('backend/getapi_model');
		$this->load->model('sale/sale_model');
		$this->load->library('Sale_libraray');
		
		
	}
	public function index()
	{
		$query = $this->db->where('id','1')->get('tb_service_charge')->row();
		$query_b = $this->db->where('id',2)->get('tb_service_charge')->row();
		// query คือสำหรับกรณีเว็บที่ไม่จ่ายเงินเราจะทำการปิดไม่ให้เข้าใช้งานได้ โปรแกรมเมอร์เท่านั้นที่สามารถเปิด ปิดได้
		if($query->confirm_web != 1){
			// query_b เป็นสำหรับกรณีที่ต้องการปิดเว็บเฉยๆ owner สามารถที่จะเปิด หรือปิดก็ได้
			if($query_b->confirm_web ==1){
				$this->load->view('close');

			}else{
				// ถ้าไม่ตรงกับเงือนไขใดเลยให้ redirect ไปหน้า sale เพื่อ login ได้
				if(!empty($this->session->sale)){
					redirect('sale/home/dashboard');
				}else{
					$this->load->view('login');
				}

			}
			
		}else{

			$this->load->view('close');
		}

	}

	function logout()
	{	
		$this->session->sale = '';
		$this->sale_libraray->login();
	}
	public function login_check()
	{
		
		if($this->input->post('username') && $this->input->post('password')){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$safecode = $this->input->post('safecode');
			$sale_q   = $this->db->select('*')->where('username',$username)->get('tb_sale');
			if($sale_q->num_rows() == 1){
				$sale_r = $sale_q->row();
				if($this->sale_libraray->hash_password($password,$sale_r->salt) == $sale_r->password){
					// Save Token/LastTime/LastIp Login Sale
					$token_login 	= md5(uniqid($sale_r->username, true));
					$last_login 	= time();
					$lastip_login	= $this->sale_libraray->get_client_ip();
					$arr_loglogin	= array('token_login' 	=> $token_login,
											'last_login' 	=> $last_login,
											'lastip_login' 	=> $lastip_login,);	
					$this->db->where('id',$sale_r->id)->update('tb_sale',$arr_loglogin);
					
					
					
					// Save Session sale
					$sale_r->token_login = $token_login;
					$this->session->sale = $sale_r;
					
					//save Log type Login
					$log_detail = '(login),id:'.$sale_r->id.',username:'.$sale_r->username.',name:'.$sale_r->name.',ip:'.$lastip_login.'),';
					$log_type 	= 'login';
					$this->sale_libraray->log_sale($log_type,$log_detail);
					
					$re = array('code'=>1,'title'=>'สำเร็จ','msg'=>'ยินดีต้อนรับ');
				}else{
					$re = array('code'=>2,'title'=>'พาสเวิร์ดผิด','msg'=>'กรุณาล็อกอินใหม่ค่ะ');
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



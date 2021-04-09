<?php

class Home extends MY_Controller {

  public function __construct() {

	parent::__construct();
    $this->load->model('getapi_model');
	$this->load->library('backend/backend_library');
  }
  public function index() {

	  $query = $this->db->where('id','1')->get('tb_service_charge')->row();
	  $query_b = $this->db->where('id',3)->get('tb_service_charge')->row();
	  if($query->status == 1){ //เงือนไขที่ 1 เช็ค status เท่ากับ 1 หรือไม่ ถ้าเท่ากับ 1 ให้ วิ่งไปหน้า service 
		     $data['service'] = $this->db->where('status','1')->where('id','1')->get('tb_service_charge')->row();
			 $this->load->view('servicech',$data);
	  }
	  else if($query->confirm_web == 1 ){
		    $this->load->view('close');
	  }
	  else if($query_b->confirm_web == 1){
		   $this->load->view('close');
	  }
	  else{ //ถ้าไม่เท่ากับ 1 ให้วิ่งไปหน้า login
		    if(empty($this->session->admin['token'])){
		  		$this->load->view('login');
			}else{
				$token = $this->session->admin['token'];
				$chekclogin = $this->backend_library->check_login($token);
				redirect(base_url().'backend/');
			}
	  }
  }
  

  public function showservice(){
	$result = $this->db->where('id',$this->input->post('id'))->get('tb_service_charge')->row();
	echo json_encode($result);
	die;
  }
  
  public function ch(){
	$query = $this->db->where('id','1')->get('tb_service_charge')->row();
	$query_b = $this->db->where('id',3)->get('tb_service_charge')->row();

    if($query->confirm_web == 1){
		$this->load->view('close');
	}else{
		if($query_b->confirm_web == 1){
			$this->load->view('close');
		}else{
			if(empty($this->session->admin['token'])){
				$this->load->view('login');
			}else{
				$token = $this->session->admin['token'];
				$chekclogin = $this->backend_library->check_login($token);
				redirect(base_url().'backend/');
			}
		}
	}
	
  }

  public function login()
  {
	  //รับค่า Login
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$safecode = $this->input->post('safecode');
	if($this->input->post('pin')){
		$pin = $this->input->post('pin');
	}else{
		$pin = null;
	}
	$login = $this->backend_library->login($username,$password,$safecode,$pin);
	if($login){
	  $re = array('code' => $login['status'], 'msg'=>$login['message']);

	}else{
	   $re = array('code' => 0, 'msg'=>'ไม่สามารถ Login ได้');
	}
	echo json_encode($re);
	die();
  }



}
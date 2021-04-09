<?php
class Profile extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		
		$this->load->model('backend/getapi_model');
		$this->load->model('sale/sale_model');
		$this->load->library('Sale_libraray');
		$this->sale_libraray->login();
		$this->output->set_template('tem_sale/tem_sale');
	}
	public function index()
	{
		$data['sale'] 	= $this->db->select('*')->where('id',$this->session->sale->id)->get('tb_sale')->row();
		$data['cresale_num'] = $this->db->select('id')->where('sale_id',$this->session->sale->id)->get('tb_sale')->num_rows();
		$sale_cre_q 	= $this->db->select('name,id')->where('id',$data['sale']->sale_id)->get('tb_sale');
		if($sale_cre_q->num_rows() == 1){
			$sale_cre_r 	= $sale_cre_q->row();
			$sale_cre_name 	= $sale_cre_r->name;
			$sale_cre_id 	= $sale_cre_r->id;
		}else{
			$sale_cre_name 	= 'ไม่มีผู้สร้าง';
			$sale_cre_id 	= 0;
		}
		$data['sale']->sale_cre_name = $sale_cre_name;
		$data['sale']->sale_cre_id = $sale_cre_id;
		$data['log_login'] = $this->db->where('type','login')->where('sale_id',$this->session->sale->id)->limit(20)->get('log_sale')->result_array();
//		echo '<pre>';print_r($data);die();
		$this->load->view('profile',$data);

	}
	public function edit_pass()
	{
		if($this->input->post('pass')){
			$id = $this->session->sale->id;
			$pass = $this->input->post('pass');
			$salt = $this->sale_libraray->salt();
			$password = $this->sale_libraray->hash_password($pass,$salt);
			if($this->db->set('salt',$salt)->set('password',$password)->where('id',$id)->update('tb_sale')){
				$re = array('code' => 1,'title'=>'สำเร็จ','msg'=>'ทำรายการสำเร็จกรุณาตรวจสอบรายการ');
				
				//save Log type Login
				$log_detail = '(editpass),('.$id.'),('.$this->session->sale->name.'),('.$pass.'),';
				$log_type 	= 'editpass';
				$this->sale_libraray->log_sale($log_type,$log_detail);
			}else{
				$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		}else{
			$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}
	
}



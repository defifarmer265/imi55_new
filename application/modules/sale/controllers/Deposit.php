<?php
class Deposit extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('sale/sale_model');
		$this->load->library('Sale_libraray');
		$this->sale_libraray->login();
		$this->output->set_template('tem_sale/tem_sale');
		
	}
	public function index()
	{
		
		 
	}
	public function deposit()
	{
		$data['bw'] = $this->db->select('tb_bank_web.id,tb_bank_web.name,tb_bank_web.account,tb_bank.bank_short')->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id')->get('tb_bank_web')->result_array();
		$this->load->view('deposit',$data);
	}
	public function waitfirm()
	{
		$state_wcf = $this->db->select('
		tb_statement.id,tb_statement.datetime,tb_statement.deposit,tb_statement.from_bank,
		tb_statement.note,tb_statement.user_id,tb_statement.admin_id,tb_statement.from_name,
		tb_bank_web.name,
		tb_bank.api_id as bnkapi_web,tb_bank.bank_short as bnkshort_web,
		')
		->join('tb_bank_web','tb_bank_web.id = tb_statement.bank_id','left')
		->join('tb_bank','tb_bank.id = tb_bank_web.bank_id','left')
		->where('tb_statement.deposit >',0)
		->where('tb_statement.from_bank !=','TRUEW')
		->where('tb_statement.status',1)
		->order_by('tb_statement.id','DESC')
		->limit(40)
		->get('tb_statement')->result_array();

		$state_cf = $this->db->select('
		tb_statement.id,tb_statement.datetime,tb_statement.deposit,tb_statement.from_bank,tb_statement.note,
		tb_statement.user_id,tb_statement.admin_id,tb_statement.from_name,tb_statement.dateCreate,
		tb_user.user,tb_user.username,
		tb_login.name as admin_name,
		tb_bank_web.name,
		tb_bank.api_id as bnkapi_web,tb_bank.bank_short as bnkshort_web,
		')
		->join('tb_bank_web','tb_bank_web.id = tb_statement.bank_id','left')
		->join('tb_bank','tb_bank.id = tb_bank_web.bank_id','left')
		->join('tb_user','tb_user.id = tb_statement.user_id','left')
		->join('tb_login','tb_login.id = tb_statement.admin_id','left')
		->where('tb_statement.deposit >',0)
		->where('tb_statement.from_bank !=','TRUEW')
		->where_in('tb_statement.status',array(2,4))
		->where('tb_statement.admin_id !=',0)
		->order_by('tb_statement.dateCreate','DESC')
		->limit(20)
		->get('tb_statement')->result_array();
		$i=0;
		
		$data = array(
			'state_wcf' => $state_wcf,
			'state_cf' => $state_cf,
		);
		
//		echo '<pre>';print_r($data);die();
		$this->load->view('deposit_waitCF',$data);
	}
	public function transaction()
	{
		$data['auto'] = $this->db->order_by('id', 'DESC')->limit(500)->get('transactionauto')->result_array();
		$this->load->view('transaction', $data);
	}
	public function sel_state()
	{
	
		if($this->input->post('dt1') && $this->input->post('dt2')){
			$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
			$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		
			if($this->input->post('user') != ''){
				$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
				$check_u = $this->db->where('user', $user)->where('create_time >=', $dt1)->where('create_time <=', $dt2)->get('tb_user')->num_rows();
				// $check_u = $this->db->where('user', $user)->where('create_time >=' $dt1)->where('create_time <=', $dt2)->get('tb_user')->num_rows();
				if($check_u >= 1){
					$state = $this->db->select('
						tb_statement.*,tb_user.user,tb_user.username,tb_user_bank.account,tb_bank.bank_short,tb_login.name as admin_name,tb_bank_web.name as bw_name,tb_bank_web.account as bw_acc
					')			
					->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
					->join('tb_sale_user', 'tb_sale_user.user_id = tb_statement.user_id', 'left')
					->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
					->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
					->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
					->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
					->where('tb_sale_user.sale_id', $this->session->sale->id)
					->where('tb_user.user', $user)
					->where('tb_statement.datetime >=',$dt1)
					// ->where('tb_statement.datetime <=',$d2)
					->order_by('tb_statement.id', 'DESC')->get('tb_statement')->result_array();
				}else{
					$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'กรุณากรอกยูสเซอร์ ที่สมัครในช่วงที่ต้องการทำรายการ', 'data' => '');
					echo json_encode($re);
					die();
				}
			}else{
					$state = $this->db->select('
						tb_statement.*,tb_user.user,tb_user.username,tb_user_bank.account,tb_bank.bank_short,tb_login.name as admin_name,tb_bank_web.name as bw_name,tb_bank_web.account as bw_acc
					')			
					->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
					->join('tb_sale_user', 'tb_sale_user.user_id = tb_statement.user_id', 'left')
					->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
					->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
					->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
					->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
					->where('tb_sale_user.sale_id', $this->session->sale->id)
					->where('tb_user.create_time >=',$dt1)
					->where('tb_user.create_time <=',$dt2)
					->where('tb_statement.dateCreate >', $dt1)
					// ->where('tb_statement.dateCreate <', $dt2)
					->order_by('tb_statement.id', 'DESC')->get('tb_statement')->result_array();
			}
			

			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $state);
		}else{
			$re = array('code' => 0, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => '');
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
			->join('tb_bank_web','tb_bank_web.id = tb_statement.bank_id','left')
			->join('tb_bank','tb_bank.id = tb_bank_web.bank_id','left')
			->join('tb_login','tb_login.id = tb_statement.admin_id','left')
			->where('tb_statement.id',$stm_id)
			->get('tb_statement');
		if($stm_q->num_rows() == 1){
			$stm_r 	= $stm_q->row();
			$user_r = $this->db->select('tb_user.user,tb_user.username,tb_bank.bank_short,tb_bank.api_id,tb_user.name')
				->join('tb_user_bank','tb_user_bank.user_id = tb_user.id','left')
				->join('tb_bank','tb_bank.id = tb_user_bank.bank_id','left')
				->where('tb_user.id',$stm_r->user_id)
				->get('tb_user')
				->row();
			$stm_r->user 		= $user_r->user; 
			$stm_r->userTel 	= $user_r->username;
			$stm_r->userBank 	= $user_r->bank_short;
			$stm_r->userApi 	= $user_r->api_id;
			$stm_r->userName	= $user_r->name;
			$stm_r->dateIn		= date('d-m-Y H:i:s',$stm_r->datetime);
			$stm_r->dateFirm	= date('d-m-Y H:i:s',$stm_r->dateCreate);

			$re = array('code'=>1,'msg'=>'','title'=>'สำเร็จ','data'=> $stm_r);
		}else{
			$re = array('code'=>0,'msg'=>'ไม่มีข้อมูลรายการดังกล่าว','title'=>'ไม่สำเร็จ','data'=> '');
		}
		echo json_encode($re);
		die();
	}
	public function get_type_stm()
	{
		if($this->input->post('status')){
			$status =  $this->input->post('status');
			$state_wcf = $this->db->select('
				tb_statement.id,tb_statement.datetime,tb_statement.deposit,tb_statement.from_bank,
				tb_statement.note,tb_statement.user_id,tb_statement.admin_id,tb_statement.from_name,
				tb_bank_web.name,
				tb_bank.api_id as bnkapi_web,tb_bank.bank_short as bnkshort_web,
				')
				->join('tb_bank_web','tb_bank_web.id = tb_statement.bank_id','left')
				->join('tb_bank','tb_bank.id = tb_bank_web.bank_id','left')
				->where('tb_statement.deposit >',0)
				->where('tb_statement.from_bank !=','TRUEW')
				->where('tb_statement.status',$status)
				->order_by('tb_statement.id','DESC')
				->limit(50)
				->get('tb_statement')->result_array();
			
			$re = array('code'=>1,'msg'=>'','title'=>'สำเร็จ','data'=> $state_wcf);
		}else{
			$re = array('code'=>0,'msg'=>'ไม่มีข้อมูลรายการดังกล่าว','title'=>'ไม่สำเร็จ','data'=> '');
		}
		echo json_encode($re);
		die();
		
	}
}



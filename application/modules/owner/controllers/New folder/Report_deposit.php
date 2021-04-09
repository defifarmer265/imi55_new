<?php

/**
* 
*/
class Report_deposit extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->library('users/users_library');
		$this->load->library('tripledes');
		$this->load->model('user_model');
		$this->load->model('getapi_model');
		$this->load->model('bank_model');
		$this->load->model('deposit_model');


	}
	private function _init()
	{		
		$this->output->set_template('tem_admin/tem_admin');
	}

	public function index()
	{
		$data = array(
			'menu' 		=> 'report',
			'deposit_data' => $this->deposit_model->get_deposit(),
		);	
		$this->load->view('report_deposit',$data);
	}
	public function get_deposit(){
		$start_date = strtotime($this->input->post('start_date'));
		$end_date = strtotime($this->input->post('end_date'));
		$username = $this->input->post('username');
		if($username != ''){
			$deposit_data = $this->db
			->select('tb_deposit.*,tb_bank.bank_short,tb_bank.bank_th,tb_user.username,tb_user.account,tb_login.username as admin_cf')
			->join('tb_bank', 'tb_bank.id = tb_deposit.bank_id')
			->join('tb_user', 'tb_user.id = tb_deposit.user_id', 'left')
			->join('tb_login', 'tb_login.id = tb_deposit.admin_cf', 'left')
			->where('tb_deposit.createTime >=',$start_date)
			->where('tb_deposit.createTime <=',$end_date)
			->where('tb_user.username','bc61'.$username)
			->order_by("tb_deposit.id", "DESC")
			->get('tb_deposit')
				->result_array();
		}else{
			$deposit_data = $this->deposit_model->get_deposit_schedule($start_date,$end_date);
		}
		if (count($deposit_data) == 0) {
			echo json_encode(array('code' => 2,'msg'=>'No data','data'=>$deposit_data));
		}elseif (count($deposit_data)> 0 ) {
			echo json_encode(array('code' => 1,'msg'=>'success','data'=>$deposit_data));
		}else{
			echo json_encode(array('code' => 0,'msg'=>'Error'));
		}
		die();
	}
	
	



}


<?php

/**
* 
*/
class Report_withdraw extends MY_Controller
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
		$this->load->model('withdraw_model');

	}
	private function _init()
	{		
		$this->output->set_template('tem_admin/tem_admin');
	}

	public function index()
	{
		$data = array(
			'menu' 		=> 'report',
		);	
		$this->load->view('report_withdraw',$data);
	}
	public function get_reportwd(){
		$start_date = strtotime($this->input->post('start_date'));
		$end_date = strtotime($this->input->post('end_date'));
		$wd_data = $this->withdraw_model->get_reportwd_schedule($start_date,$end_date);
		if (count($wd_data) == 0) {
			echo json_encode(array('code' => 2,'msg'=>'No data','data'=>$wd_data));
		}elseif (count($wd_data)> 0 ) {
			echo json_encode(array('code' => 1,'msg'=>'success','data'=>$wd_data));
		}else{
			echo json_encode(array('code' => 0,'msg'=>'Error'));
		}
		die();
	}
	
	
	



}


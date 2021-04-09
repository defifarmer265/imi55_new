<?php
class Contact extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->model('bank_model');
		$this->load->model('user_model');
		$this->load->model('deposit_model');
		$this->load->library('backend/tripledes');
		$this->load->model('backend/getapi_model');
		$this->load->library('session');
		$this->load->model('user_detail_all');
	}

	private function _init()
	{		
		$this->output->set_template('tem_web/tem_web');
	}

	public function index()
	{
		
		$data = array(
			'menu' => 0
		);
		
		$this->load->view('contact',$data);
		
	}


	

	

}


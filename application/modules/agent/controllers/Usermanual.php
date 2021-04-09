<?php
class Usermanual extends MY_Controller
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
		$this->load->model('backend/getapi_model');

	}


	private function _init()
	{		
		$this->output->set_template('tem_web/tem_web');
	}

	public function index()
	{
		
		$this->load->view('Usermanual');
		
	}
	
	public function edit_password()
	{
		$this->load->view('edit_password');
	}


	

	

}


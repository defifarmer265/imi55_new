<?php
class Report extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();		
		$this->load->model('backend/getapi_model');
		$this->load->library('Member_libraray');
		$this->load->model('api/api_model');
		$this->_init();
	}
	private function _init()
	{		
		$this->output->set_template('tem_web/tem_mapraw');
		$this->member_libraray->login();
		
	}
	public function index()
	{
		echo 'report';
	}
	public function games()
	{
		

		$this->load->view('report_game');
	}


	public function getTicket()
	{
		$data_sent = json_encode(array(
			"from"=> time()-3600,
			"to"=> time()
		));
		echo ($this->getapi_model->call_API_mongo('turnover/user/'.$this->session->member->user.'/games/date', $data_sent, "POST"));
		die;
	}
	
	
	
	
	
	
}


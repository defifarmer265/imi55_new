<?php
class Announce extends MY_Controller
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

	}
	public function announce()
	{
		$data['announce'] = $this->db->order_by('id','DESC')->limit(5)->get('tb_announce')->result_array();
		$data['menu'] = 'announce';
//		print_r($data);
//		die();
		$this->load->view('announce',$data);
	}

}


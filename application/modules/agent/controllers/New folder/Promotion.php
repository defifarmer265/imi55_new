<?php
class Promotion extends MY_Controller
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

		$bank = $this->bank_model->get_bank();
	$data = array(
		'menu' => 0,
		'bank' => $bank ,
		'url' => $this->config->base_url()
	);
	$this->load->model('Promotion_model');
	if (empty($this->session->userdata['username'])) {

		$data['promotion'] = $promotion = $this->db
							->select('*')
							->where('class',1)
							->or_where('class',2)
							->where('date_end >=',time())
							->get('tb_promotion')
							->result_array();
		$this->load->view('promotion',$data);
	}else {

		$user = $this->user_model->get_userByUsername($this->session->userdata['username']);
		$data['promotion'] = $this->Promotion_model->get_promoByClass($user->class);
		$this->load->view('promotion',$data);
	}


	
	// print_r($data);
	// die();
	
	}










	

	

}


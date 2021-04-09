<?php

class Ticked extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->library('users/users_library');
		$this->load->model('backend/backend_model');
		$this->load->model('backend/getapi_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();
	}
	private function _init()
	{		
		$this->output->set_template('tem_owner/tem_owner');
	}

	public function index()
	{
		$statement = $this->db->select('tb_statement.*,tb_user.user,tb_user.username,tb_user.id as user_id,tb_bank.bank_short,tb_user_bank.account as usbk')
			->join('tb_user','tb_user.id = tb_statement.user_id','left')
			->join('tb_user_bank','tb_user_bank.user_id = tb_statement.user_id','left')
			->join('tb_bank','tb_bank.id = tb_user_bank.bank_id','left')
			->where('tb_statement.deposit >',0)
			->where('tb_statement.status',1)
			->order_by('tb_statement.status','ASC')
			->order_by('tb_statement.dateCreate','DESC')
			
			->limit(50)
			->get('tb_statement')->result_array();
		$user = $this->db->where('status','1')->get('tb_user')->result_array();
		$data = array(
			'user' => $user,
		);	
		$this->load->view('ticked',$data);
	}

	public function get_tickeds(){
		// print_r($this->input->get());
		// die();
		$arr_depAPI = array(
			'StartTime' => $this->input->get('sdate'),
			'EndTime' => $this->input->get('edate'),
			'PlayerName' =>'ztiai001151',
			'Partner'=> $this->getapi_model->agent(),
			'TimeStamp' => time(),
			"PageSize"=> 100,
		);
		$dataAPI = array(
			'type'		=> 'GT',
			'agent' 	=> $this->getapi_model->agent(),
		);
		$url_api = 'https://pwlapi.linkv2.com/api/tickets/xfind';
		$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI,$url_api,$dataAPI);
		if($cre_userAPI->Success == true){
			$arr =  array('code' =>1 ,'data'=>$cre_userAPI->Result->Tickets,'msg'=>'success' );
		}else{
			$arr =  array('code' =>0 ,'msg'=>'false api' );
		}
		echo json_encode($arr);
		die();
	}

	
	
}
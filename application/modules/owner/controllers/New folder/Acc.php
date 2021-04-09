<?php
class Acc extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->library('users/users_library');
		$this->load->model('getapi_model');

	}
	private function _init()
	{		
		$this->output->set_template('tem_admin/tem_admin');
	}

	public function index()
	{
		$this->load->view('acc_state');
	}
	public function rp_us()
	{
		$user	= $this->input->post('user');
		$dt1 	= strtotime(date('d-m-Y 00:00:00',strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('d-m-Y 23:59:59',strtotime($this->input->post('dt2'))));
		
		if($this->input->post('user') != ''){
			$user 	= $this->getapi_model->agent().'i'.substr(("000000".(intval($user))),-6);
			$state = $this->db->select('
				tb_user.user,
				FORMAT (getdate(tb_statement.dateCreate), `dd/MM/yyyy, hh:mm `) as username,
				tb_statement.deposit,
				tb_statement.withdraw,
				tb_statement.deposit as deposit1,
				tb_statement.withdraw as withdraw1,
				0 as num_deposit,
				0 as num_withdraw,
				')
//						->group_by('tb_statement.user_id')
						->join('tb_user','tb_user.id = tb_statement.user_id','left')
						->where('tb_statement.status',2)
						->where('tb_user.user',$user)
						->where('tb_statement.dateCreate >',$dt1)
						->where('tb_statement.dateCreate <',$dt2)
						->order_by('tb_statement.id','ASC')
						->get('tb_statement')->result_array();
		}else{
			$state = $this->db->select('
				tb_user.user,tb_user.username,
				CONCAT(FORMAT(SUM(tb_statement.deposit), 2)) as deposit,
				CONCAT(FORMAT(SUM(tb_statement.withdraw), 2)) as withdraw,
				SUM(tb_statement.deposit) as deposit1,
				SUM(tb_statement.withdraw) as withdraw1,
				SUM(CASE WHEN tb_statement.deposit > 0 THEN 1 ELSE 0 END)as num_deposit,
				SUM(CASE WHEN tb_statement.withdraw > 0 THEN 1 ELSE 0 END)as num_withdraw,
				')
						->group_by('tb_statement.user_id')
						->join('tb_user','tb_user.id = tb_statement.user_id','left')
						->where('tb_statement.status',2)
						->where('tb_statement.dateCreate >',$dt1)
						->where('tb_statement.dateCreate <',$dt2)
						->order_by('tb_statement.id','ASC')
						->get('tb_statement')->result_array();
		}
		
//		echo '<pre>';
//		print_r($a);
//		die()
		$re = array('code'=>1,'title'=>'สำเร็จ','msg'=>'5','data'=> $state );

		echo json_encode($re);
		die();
	}
	public function rp_staff()
	{
		$arr_userAPI = array( 
			'AgentName'	=> $this->getapi_model->agent(),    
			'TimeStamp'	=> time(),
		);
		$dataAPI = array(
			'type'		=> 'GT',
			'agent' 	=> $this->getapi_model->agent(),
			
		);
		$url_api = 'https://cauthapi.linkv2.com/api/credit-auth/current-credit';
		$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
//		if($cre_userAPI->Error == 0){
//			$amount = $cre_userAPI->Balance;
//		}else{
//			$amount = $cre_userAPI->Message;
//		}
		echo '<pre>';
		print_r($cre_userAPI);
		die();
	}
}



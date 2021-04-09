<?php
class Period extends MY_Controller
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
		$this->load->view('report_period');
	}

	
	public function rp_us()
	{
		$dt1 	= strtotime(date('d-m-Y 00:00:00',strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('d-m-Y 23:59:59',strtotime($this->input->post('dt2'))));
		
			
			$st = $this->db->select('tb_statement.*')
						->where('tb_statement.status',2)
						->where('tb_statement.dateCreate >',$dt1)
						->where('tb_statement.dateCreate <',$dt2)
						// ->where('tb_statement.deposit <=',300)
						// ->where('tb_statement.withdraw',0)

						->get('tb_statement')->result_array();
						$dp = [];
						$dp['num_dep300'] = 0;
						$dp['sum_dep300'] = 0;
						$dp['num_wd300'] = 0 ;
						$dp['sum_wd300'] = 0 ;
						$dp['num_dep1000'] = 0;
						$dp['sum_dep1000'] = 0;
						$dp['num_wd1000'] = 0 ;
						$dp['sum_wd1000'] = 0 ;

						$dp['num_dep5000'] = 0;
						$dp['sum_dep5000'] = 0;
						$dp['num_wd5000'] = 0 ;
						$dp['sum_wd5000'] = 0 ;

						$dp['num_dep10000'] = 0;
						$dp['sum_dep10000'] = 0;
						$dp['num_wd10000'] = 0 ;
						$dp['sum_wd10000'] = 0 ;

						$dp['num_dep50000'] = 0;
						$dp['sum_dep50000'] = 0;
						$dp['num_wd50000'] = 0 ;
						$dp['sum_wd50000'] = 0 ;

						$dp['num_dep100000'] = 0;
						$dp['sum_dep100000'] = 0;
						$dp['num_wd100000'] = 0 ;
						$dp['sum_wd100000'] = 0 ;

						$dp['num_dep100000+'] = 0;
						$dp['sum_dep100000+'] = 0;
						$dp['num_wd100000+'] = 0 ;
						$dp['sum_wd100000+'] = 0 ;
						foreach ($st as $as){
							if($as['deposit'] > 0 && $as['deposit'] <= 300  ){
								$dp['num_dep300'] = $dp['num_dep300'] + 1;
								$dp['sum_dep300'] = $dp['sum_dep300'] +$as['deposit'];
							}else if( $as['withdraw'] > 0 && $as['withdraw'] <= 300 ){
								$dp['num_wd300'] = $dp['num_wd300'] + 1;
								$dp['sum_wd300'] = $dp['sum_wd300'] + $as['withdraw'];

							}else if($as['deposit'] >= 301 && $as['deposit'] <= 1000){
								$dp['num_dep1000'] = $dp['num_dep1000'] + 1;
								$dp['sum_dep1000'] = $dp['sum_dep1000'] +$as['deposit'];
							}else if($as['withdraw'] >= 301 && $as['withdraw'] <= 1000){
								$dp['num_wd1000'] = $dp['num_wd1000'] + 1;
								$dp['sum_wd1000'] = $dp['sum_wd1000'] + $as['withdraw'];

							}else if($as['deposit'] >= 1001 && $as['deposit'] <= 5000){
								$dp['num_dep5000'] = $dp['num_dep5000'] + 1;
								$dp['sum_dep5000'] = $dp['sum_dep5000'] +$as['deposit'];
							}else if($as['withdraw'] >= 1001 && $as['withdraw'] <= 5000){
								$dp['num_wd5000'] = $dp['num_wd5000'] + 1;
								$dp['sum_wd5000'] = $dp['sum_wd5000'] + $as['withdraw'];

							}else if($as['deposit'] >= 5001 && $as['deposit'] <= 10000){
								$dp['num_dep10000'] = $dp['num_dep10000'] + 1;
								$dp['sum_dep10000'] = $dp['sum_dep10000'] +$as['deposit'];
							}else if($as['withdraw'] >= 5001 && $as['withdraw'] <= 10000){
								$dp['num_wd10000'] = $dp['num_wd10000'] + 1;
								$dp['sum_wd10000'] = $dp['sum_wd10000'] + $as['withdraw'];

							}else if($as['deposit'] >= 10001 && $as['deposit'] <= 50000){
								$dp['num_dep50000'] = $dp['num_dep50000'] + 1;
								$dp['sum_dep50000'] = $dp['sum_dep50000'] +$as['deposit'];
							}else if($as['withdraw'] >= 10001 && $as['withdraw'] <= 50000){
								$dp['num_wd50000'] = $dp['num_wd50000'] + 1;
								$dp['sum_wd50000'] = $dp['sum_wd50000'] + $as['withdraw'];

							}else if($as['deposit'] >= 50001 && $as['deposit'] <= 100000){
								$dp['num_dep100000'] = $dp['num_dep100000'] + 1;
								$dp['sum_dep100000'] = $dp['sum_dep100000'] +$as['deposit'];
							}else if($as['withdraw'] >= 50001 && $as['withdraw'] <= 100000){
								$dp['num_wd100000'] = $dp['num_wd100000'] + 1;
								$dp['sum_wd100000'] = $dp['sum_wd100000'] + $as['withdraw'];

							}else if($as['deposit'] > 100000 && $as['deposit'] > 100000){
								$dp['num_dep100000+'] = $dp['num_dep100000+'] + 1;
								$dp['sum_dep100000+'] = $dp['sum_dep100000+'] +$as['deposit'];
							}else if($as['withdraw'] > 100000 && $as['withdraw'] > 100000){
								$dp['num_wd100000+'] = $dp['num_wd100000+'] + 1;
								$dp['sum_wd100000+'] = $dp['sum_wd100000+'] + $as['withdraw'];
							}
						}

					
		$data = array($dp);

		$re = array('code'=> 1 ,'title'=>'สำเร็จ','msg'=>'5','data'=> $data );

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



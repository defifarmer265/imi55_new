<?php
class Report_time_period_wt extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->model('backend/getapi_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();

	}
	private function _init()
	{		
		$this->output->set_template('tem_owner/tem_owner');
	}

	public function time_period_wt()
	{
		$this->load->view('report_t_period_wt');
	}


	
    public function time_pd_wt()
	{

	
		$dt1 		= strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt2'))));


		$st = $this->db->select('tb_statement.*,tb_statement.dateCreate as time')
						->where('tb_statement.withdraw !=', 0)
						->where('tb_statement.dateCreate >=',$dt1)
						->where('tb_statement.dateCreate <=',$dt2)
						->where('tb_statement.status', 2)
						->get('tb_statement')->result_array();
	

                        $k=0;
						foreach ($st as $wt) {
							$st[$k]['time'] = date('H:i:s ', $wt['time']);
							$k++;
						}

						$dp =[];
						$sum_num=[];	
						$sum_dp=[];

						$dp['num_wt01'] = 0;
						$dp['sum_wt01'] = 0;

						$dp['num_wt02'] = 0;
						$dp['sum_wt02'] = 0;

						$dp['num_wt03'] = 0;
						$dp['sum_wt03'] = 0;

						$dp['num_wt04'] = 0;
						$dp['sum_wt04'] = 0;

						$dp['num_wt05'] = 0;
						$dp['sum_wt05'] = 0;

						$dp['num_wt06'] = 0;
						$dp['sum_wt06'] = 0;

						$dp['num_wt07'] = 0;
						$dp['sum_wt07'] = 0;

						$dp['num_wt08'] = 0;
						$dp['sum_wt08'] = 0;

						$dp['num_wt09'] = 0;
						$dp['sum_wt09'] = 0;

						$dp['num_wt10'] = 0;
						$dp['sum_wt10'] = 0;

						$dp['num_wt11'] = 0;
						$dp['sum_wt11'] = 0;

						$dp['num_wt12'] = 0;
						$dp['sum_wt12'] = 0;

						$dp['num_wt13'] = 0;
						$dp['sum_wt13'] = 0;

						$dp['num_wt14'] = 0;
						$dp['sum_wt14'] = 0;

						$dp['num_wt15'] = 0;
						$dp['sum_wt15'] = 0;

						$dp['num_wt16'] = 0;
						$dp['sum_wt16'] = 0;

						$dp['num_wt17'] = 0;
						$dp['sum_wt17'] = 0;

						$dp['num_wt18'] = 0;
						$dp['sum_wt18'] = 0;

						$dp['num_wt19'] = 0;
						$dp['sum_wt19'] = 0;

						$dp['num_wt20'] = 0;
						$dp['sum_wt20'] = 0;

						$dp['num_wt21'] = 0;
						$dp['sum_wt21'] = 0;
						
						$dp['num_wt22'] = 0;
						$dp['sum_wt22'] = 0;

						$dp['num_wt23'] = 0;
						$dp['sum_wt23'] = 0;

						$dp['num_wt24'] = 0;
						$dp['sum_wt24'] = 0;
						foreach ($st as $as){
							if($as['time']>='00:00:00' && $as['time']<='01:00:00'){
								$dp['num_wt01'] = $dp['num_wt01'] + 1;
								$dp['sum_wt01'] = $dp['sum_wt01'] +$as['withdraw'];
							}else if($as['time']>='01:00:00' && $as['time']<='02:00:00'){
								$dp['num_wt02'] = $dp['num_wt02'] + 1;
								$dp['sum_wt02'] = $dp['sum_wt02'] +$as['withdraw'];
							}
							else if($as['time']>='02:00:00' && $as['time']<='03:00:00'){
								$dp['num_wt03'] = $dp['num_wt03'] + 1;
								$dp['sum_wt03'] = $dp['sum_wt03'] +$as['withdraw'];
							}
							else if($as['time']>='03:00:00' && $as['time']<='04:00:00'){
								$dp['num_wt04'] = $dp['num_wt04'] + 1;
								$dp['sum_wt04'] = $dp['sum_wt04'] +$as['withdraw'];
							}
							else if($as['time']>='04:00:00' && $as['time']<='05:00:00'){
								$dp['num_wt05'] = $dp['num_wt05'] + 1;
								$dp['sum_wt05'] = $dp['sum_wt05'] +$as['withdraw'];
							}
							else if($as['time']>='05:00:00' && $as['time']<='06:00:00'){
								$dp['num_wt06'] = $dp['num_wt06'] + 1;
								$dp['sum_wt06'] = $dp['sum_wt06'] +$as['withdraw'];
							}
							else if($as['time']>='06:00:00' && $as['time']<='07:00:00'){
								$dp['num_wt07'] = $dp['num_wt07'] + 1;
								$dp['sum_wt07'] = $dp['sum_wt07'] +$as['withdraw'];
							}
							else if($as['time']>='07:00:00' && $as['time']<='08:00:00'){
								$dp['num_wt08'] = $dp['num_wt08'] + 1;
								$dp['sum_wt08'] = $dp['sum_wt08'] +$as['withdraw'];
							}
							else if($as['time']>='08:00:00' && $as['time']<='09:00:00'){
								$dp['num_wt09'] = $dp['num_wt09'] + 1;
								$dp['sum_wt09'] = $dp['sum_wt09'] +$as['withdraw'];
							}
							else if($as['time']>='09:00:00' && $as['time']<='10:00:00'){
								$dp['num_wt10'] = $dp['num_wt10'] + 1;
								$dp['sum_wt10'] = $dp['sum_wt10'] +$as['withdraw'];
							}
							else if($as['time']>='10:00:00' && $as['time']<='11:00:00'){
								$dp['num_wt11'] = $dp['num_wt11'] + 1;
								$dp['sum_wt11'] = $dp['sum_wt11'] +$as['withdraw'];
							}
							else if($as['time']>='11:00:00' && $as['time']<='12:00:00'){
								$dp['num_wt12'] = $dp['num_wt12'] + 1;
								$dp['sum_wt12'] = $dp['sum_wt12'] +$as['withdraw'];
							}
							else if($as['time']>='12:00:00' && $as['time']<='13:00:00'){
								$dp['num_wt13'] = $dp['num_wt13'] + 1;
								$dp['sum_wt13'] = $dp['sum_wt13'] +$as['withdraw'];
							}
							else if($as['time']>='13:00:00' && $as['time']<='14:00:00'){
								$dp['num_wt14'] = $dp['num_wt14'] + 1;
								$dp['sum_wt14'] = $dp['sum_wt14'] +$as['withdraw'];
							}
							else if($as['time']>='14:00:00' && $as['time']<='15:00:00'){
								$dp['num_wt15'] = $dp['num_wt15'] + 1;
								$dp['sum_wt15'] = $dp['sum_wt15'] +$as['withdraw'];
							}
							else if($as['time']>='15:00:00' && $as['time']<='16:00:00'){
								$dp['num_wt16'] = $dp['num_wt16'] + 1;
								$dp['sum_wt16'] = $dp['sum_wt16'] +$as['withdraw'];
							}
							else if($as['time']>='16:00:00' && $as['time']<='17:00:00'){
								$dp['num_wt17'] = $dp['num_wt17'] + 1;
								$dp['sum_wt17'] = $dp['sum_wt17'] +$as['withdraw'];
							}
							else if($as['time']>='17:00:00' && $as['time']<='18:00:00'){
								$dp['num_wt18'] = $dp['num_wt18'] + 1;
								$dp['sum_wt18'] = $dp['sum_wt18'] +$as['withdraw'];
							}
							else if($as['time']>='18:00:00' && $as['time']<='19:00:00'){
								$dp['num_wt19'] = $dp['num_wt19'] + 1;
								$dp['sum_wt19'] = $dp['sum_wt19'] +$as['withdraw'];
							}
							else if($as['time']>='19:00:00' && $as['time']<='20:00:00'){
								$dp['num_wt20'] = $dp['num_wt20'] + 1;
								$dp['sum_wt20'] = $dp['sum_wt20'] +$as['withdraw'];
							}
							else if($as['time']>='20:00:00' && $as['time']<='21:00:00'){
								$dp['num_wt21'] = $dp['num_wt21'] + 1;
								$dp['sum_wt21'] = $dp['sum_wt21'] +$as['withdraw'];
							}
							else if($as['time']>='21:00:00' && $as['time']<='22:00:00'){
								$dp['num_wt22'] = $dp['num_wt22'] + 1;
								$dp['sum_wt22'] = $dp['sum_wt22'] +$as['withdraw'];
							}
							else if($as['time']>='22:00:00' && $as['time']<='23:00:00'){
								$dp['num_wt23'] = $dp['num_wt23'] + 1;
								$dp['sum_wt23'] = $dp['sum_wt23'] +$as['withdraw'];
							}
							else if($as['time']>='23:00:00' && $as['time']>='00:00:00'){
								$dp['num_wt24'] = $dp['num_wt24'] + 1;
								$dp['sum_wt24'] = $dp['sum_wt24'] +$as['withdraw'];
							}
							
						}
						$data = array($dp);
						
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $data);
		echo json_encode($re);
		die();
	}
	
	public function list_pdtest(){
		// print_r($_POST);
		// die;
		
		$dt1   = strtotime(date('Y-m-d 11:00:00',strtotime($this->input->post('dt1'))));
		$dt2   = strtotime(date('Y-m-d 11:00:00',strtotime($this->input->post('dt2'))));
		// $dt1 	= strtotime(date($this->input->post('dt1')." ".$this->input->post('timefirt')));
		// $dt2 	= strtotime(date($this->input->post('dt2')." ".$this->input->post('timelast')));
		$timefirt	= $this->input->post('timefirt');
		$timelast	= $this->input->post('timelast');
		$st = $this->db->select('tb_user.user as user,tb_statement.withdraw as withdraw ,tb_statement.dateCreate as dateCreate')
							->from('tb_user')
							->where('tb_statement.status',2)
							->where('tb_statement.withdraw >',0)
							->where('tb_statement.dateCreate >=',$dt1)
							->where('tb_statement.dateCreate <=',$dt2)
							->join('tb_statement','tb_statement.user_id = tb_user.id')
						     
						   ->get()->result_array();
						   
						   $pd=[];
						   $i = 0;
						   foreach ($st as $as){
						   if(date('H:i:s',$as['dateCreate'])>= $timefirt && date('H:i:s',$as['dateCreate']) <=$timelast ){
							$pd[$i]['user1'] = $as['user'];
							$pd[$i]['withdraw1'] = $as['withdraw']; 
							$pd[$i]['dateCreate1'] = $as['dateCreate'];  
							$i++;         
						   }
						}
			$data['user'] = $pd;
			// print_r($data);
			// die;
		$re = array('code'=> 1 ,'title'=>'สำเร็จ','msg'=>'5','data'=> $data );
		echo json_encode($re);
		die();
		
	}
}
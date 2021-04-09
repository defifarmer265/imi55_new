<?php
class Report_time_period extends MY_Controller
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

	public function time_period()
	{
		$this->load->view('report_t_period');
	}


	
    public function time_pd()
	{

	
		$dt1 		= strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt2'))));


		$st = $this->db->select('tb_statement.*,tb_statement.dateCreate as time')
						->where('tb_statement.deposit !=', 0)
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

						$dp['num_dep01'] = 0;
						$dp['sum_dep01'] = 0;

						$dp['num_dep02'] = 0;
						$dp['sum_dep02'] = 0;

						$dp['num_dep03'] = 0;
						$dp['sum_dep03'] = 0;

						$dp['num_dep04'] = 0;
						$dp['sum_dep04'] = 0;

						$dp['num_dep05'] = 0;
						$dp['sum_dep05'] = 0;

						$dp['num_dep06'] = 0;
						$dp['sum_dep06'] = 0;

						$dp['num_dep07'] = 0;
						$dp['sum_dep07'] = 0;

						$dp['num_dep08'] = 0;
						$dp['sum_dep08'] = 0;

						$dp['num_dep09'] = 0;
						$dp['sum_dep09'] = 0;

						$dp['num_dep10'] = 0;
						$dp['sum_dep10'] = 0;

						$dp['num_dep11'] = 0;
						$dp['sum_dep11'] = 0;

						$dp['num_dep12'] = 0;
						$dp['sum_dep12'] = 0;

						$dp['num_dep13'] = 0;
						$dp['sum_dep13'] = 0;

						$dp['num_dep14'] = 0;
						$dp['sum_dep14'] = 0;

						$dp['num_dep15'] = 0;
						$dp['sum_dep15'] = 0;

						$dp['num_dep16'] = 0;
						$dp['sum_dep16'] = 0;

						$dp['num_dep17'] = 0;
						$dp['sum_dep17'] = 0;

						$dp['num_dep18'] = 0;
						$dp['sum_dep18'] = 0;

						$dp['num_dep19'] = 0;
						$dp['sum_dep19'] = 0;

						$dp['num_dep20'] = 0;
						$dp['sum_dep20'] = 0;

						$dp['num_dep21'] = 0;
						$dp['sum_dep21'] = 0;
						
						$dp['num_dep22'] = 0;
						$dp['sum_dep22'] = 0;

						$dp['num_dep23'] = 0;
						$dp['sum_dep23'] = 0;

						$dp['num_dep24'] = 0;
						$dp['sum_dep24'] = 0;


						foreach ($st as $as){
							
							if($as['time']>='00:00:00' && $as['time']<='01:00:00'){
								$dp['num_dep01'] = $dp['num_dep01'] + 1;
								$dp['sum_dep01'] = $dp['sum_dep01'] +$as['deposit'];
							}else if($as['time']>='01:00:00' && $as['time']<='02:00:00'){
								$dp['num_dep02'] = $dp['num_dep02'] + 1;
								$dp['sum_dep02'] = $dp['sum_dep02'] +$as['deposit'];
							}
							else if($as['time']>='02:00:00' && $as['time']<='03:00:00'){
								$dp['num_dep03'] = $dp['num_dep03'] + 1;
								$dp['sum_dep03'] = $dp['sum_dep03'] +$as['deposit'];
							}
							else if($as['time']>='03:00:00' && $as['time']<='04:00:00'){
								$dp['num_dep04'] = $dp['num_dep04'] + 1;
								$dp['sum_dep04'] = $dp['sum_dep04'] +$as['deposit'];
							}
							else if($as['time']>='04:00:00' && $as['time']<='05:00:00'){
								$dp['num_dep05'] = $dp['num_dep05'] + 1;
								$dp['sum_dep05'] = $dp['sum_dep05'] +$as['deposit'];
							}
							else if($as['time']>='05:00:00' && $as['time']<='06:00:00'){
								$dp['num_dep06'] = $dp['num_dep06'] + 1;
								$dp['sum_dep06'] = $dp['sum_dep06'] +$as['deposit'];
							}
							else if($as['time']>='06:00:00' && $as['time']<='07:00:00'){
								$dp['num_dep07'] = $dp['num_dep07'] + 1;
								$dp['sum_dep07'] = $dp['sum_dep07'] +$as['deposit'];
							}
							else if($as['time']>='07:00:00' && $as['time']<='08:00:00'){
								$dp['num_dep08'] = $dp['num_dep08'] + 1;
								$dp['sum_dep08'] = $dp['sum_dep08'] +$as['deposit'];
							}
							else if($as['time']>='08:00:00' && $as['time']<='09:00:00'){
								$dp['num_dep09'] = $dp['num_dep09'] + 1;
								$dp['sum_dep09'] = $dp['sum_dep09'] +$as['deposit'];
							}
							else if($as['time']>='09:00:00' && $as['time']<='10:00:00'){
								$dp['num_dep10'] = $dp['num_dep10'] + 1;
								$dp['sum_dep10'] = $dp['sum_dep10'] +$as['deposit'];
							}
							else if($as['time']>='10:00:00' && $as['time']<='11:00:00'){
								$dp['num_dep11'] = $dp['num_dep11'] + 1;
								$dp['sum_dep11'] = $dp['sum_dep11'] +$as['deposit'];
							}
							else if($as['time']>='11:00:00' && $as['time']<='12:00:00'){
								$dp['num_dep12'] = $dp['num_dep12'] + 1;
								$dp['sum_dep12'] = $dp['sum_dep12'] +$as['deposit'];
							}
							else if($as['time']>='12:00:00' && $as['time']<='13:00:00'){
								$dp['num_dep13'] = $dp['num_dep13'] + 1;
								$dp['sum_dep13'] = $dp['sum_dep13'] +$as['deposit'];
							}
							else if($as['time']>='13:00:00' && $as['time']<='14:00:00'){
								$dp['num_dep14'] = $dp['num_dep14'] + 1;
								$dp['sum_dep14'] = $dp['sum_dep14'] +$as['deposit'];
							}
							else if($as['time']>='14:00:00' && $as['time']<='15:00:00'){
								$dp['num_dep15'] = $dp['num_dep15'] + 1;
								$dp['sum_dep15'] = $dp['sum_dep15'] +$as['deposit'];
							}
							else if($as['time']>='15:00:00' && $as['time']<='16:00:00'){
								$dp['num_dep16'] = $dp['num_dep16'] + 1;
								$dp['sum_dep16'] = $dp['sum_dep16'] +$as['deposit'];
							}
							else if($as['time']>='16:00:00' && $as['time']<='17:00:00'){
								$dp['num_dep17'] = $dp['num_dep17'] + 1;
								$dp['sum_dep17'] = $dp['sum_dep17'] +$as['deposit'];
							}
							else if($as['time']>='17:00:00' && $as['time']<='18:00:00'){
								$dp['num_dep18'] = $dp['num_dep18'] + 1;
								$dp['sum_dep18'] = $dp['sum_dep18'] +$as['deposit'];
							}
							else if($as['time']>='18:00:00' && $as['time']<='19:00:00'){
								$dp['num_dep19'] = $dp['num_dep19'] + 1;
								$dp['sum_dep19'] = $dp['sum_dep19'] +$as['deposit'];
							}
							else if($as['time']>='19:00:00' && $as['time']<='20:00:00'){
								$dp['num_dep20'] = $dp['num_dep20'] + 1;
								$dp['sum_dep20'] = $dp['sum_dep20'] +$as['deposit'];
							}
							else if($as['time']>='20:00:00' && $as['time']<='21:00:00'){
								$dp['num_dep21'] = $dp['num_dep21'] + 1;
								$dp['sum_dep21'] = $dp['sum_dep21'] +$as['deposit'];
							}
							else if($as['time']>='21:00:00' && $as['time']<='22:00:00'){
								$dp['num_dep22'] = $dp['num_dep22'] + 1;
								$dp['sum_dep22'] = $dp['sum_dep22'] +$as['deposit'];
							}
							else if($as['time']>='22:00:00' && $as['time']<='23:00:00'){
								$dp['num_dep23'] = $dp['num_dep23'] + 1;
								$dp['sum_dep23'] = $dp['sum_dep23'] +$as['deposit'];
							}
							else if($as['time']>='23:00:00' && $as['time']>='00:00:00'){
								$dp['num_dep24'] = $dp['num_dep24'] + 1;
								$dp['sum_dep24'] = $dp['sum_dep24'] +$as['deposit'];
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
		$st = $this->db->select('tb_user.user as user,tb_statement.deposit as deposit ,tb_statement.dateCreate as dateCreate')
							->from('tb_user')
							->where('tb_statement.status',2)
							->where('tb_statement.deposit >',0)
							->where('tb_statement.dateCreate >=',$dt1)
							->where('tb_statement.dateCreate <=',$dt2)
							->join('tb_statement','tb_statement.user_id = tb_user.id')
						     
						   ->get()->result_array();
						   
						   $pd=[];
						   $i = 0;
						   foreach ($st as $as){
						   if(date('H:i:s',$as['dateCreate'])>= $timefirt && date('H:i:s',$as['dateCreate']) <=$timelast ){
							$pd[$i]['user1'] = $as['user'];
							$pd[$i]['deposit1'] = $as['deposit']; 
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
<?php

class Report_period extends MY_Controller
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
	//รายการ ฝาก - ถอน ช่วงจำนวนเงิน
	public function index()
	{
		$this->load->view('report_d_w_a');
	}
	public function rp_us()
	{
		    $dt1 	= strtotime(date('Y-m-d 11:00:00',strtotime($this->input->post('dt1'))));
			$dt2 	= strtotime(date('Y-m-d 11:00:00',strtotime($this->input->post('dt2'))));
		

			$st = $this->db->select('*')
						->where('dateCreate >=', $dt1)
						->where('dateCreate <=', $dt2)
						->where('status', 2)
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
							//รายการฝาก
							if((float)$as['deposit'] > 0 && (float)$as['deposit'] <= 299  ){
								$dp['num_dep300'] = $dp['num_dep300'] + 1;
								$dp['sum_dep300'] = $dp['sum_dep300'] +$as['deposit'];
						
							}if((float)$as['withdraw'] > 0 && (float)$as['withdraw'] <= 299 ){
								$dp['num_wd300'] = $dp['num_wd300'] + 1;
								$dp['sum_wd300'] = $dp['sum_wd300'] + $as['withdraw'];
								
							}if((float)$as['deposit'] >= 300 && (float)$as['deposit'] <= 999){
								$dp['num_dep1000'] = $dp['num_dep1000'] + 1;
								$dp['sum_dep1000'] = $dp['sum_dep1000'] +$as['deposit'];

							}if((float)$as['withdraw'] >= 300 && (float)$as['withdraw'] <= 999){
								$dp['num_wd1000'] = $dp['num_wd1000'] + 1;
								$dp['sum_wd1000'] = $dp['sum_wd1000'] + $as['withdraw'];

							}if((float)$as['deposit'] >= 1000 && (float)$as['deposit'] <= 4999){
								$dp['num_dep5000'] = $dp['num_dep5000'] + 1;
								$dp['sum_dep5000'] = $dp['sum_dep5000'] +$as['deposit'];

							}if((float)$as['withdraw'] >= 1000 && (float)$as['withdraw'] <= 4999){
								$dp['num_wd5000'] = $dp['num_wd5000'] + 1;
								$dp['sum_wd5000'] = $dp['sum_wd5000'] + $as['withdraw'];

							}if((float)$as['deposit'] >= 5000 && (float)$as['deposit'] <= 9999){
								$dp['num_dep10000'] = $dp['num_dep10000'] + 1;
								$dp['sum_dep10000'] = $dp['sum_dep10000'] +$as['deposit'];

							}if((float)$as['withdraw'] >= 5000 && (float)$as['withdraw'] <= 9999){
								$dp['num_wd10000'] = $dp['num_wd10000'] + 1;
								$dp['sum_wd10000'] = $dp['sum_wd10000'] + $as['withdraw'];


							}if((float)$as['deposit'] >= 10000 && (float)$as['deposit'] <= 49999){
								$dp['num_dep50000'] = $dp['num_dep50000'] + 1;
								$dp['sum_dep50000'] = $dp['sum_dep50000'] +$as['deposit'];

							}else if((float)$as['withdraw'] >= 10000 && (float)$as['withdraw'] <= 49999){
								$dp['num_wd50000'] = $dp['num_wd50000'] + 1;
								$dp['sum_wd50000'] = $dp['sum_wd50000'] + $as['withdraw'];

							}if((float)$as['deposit'] >= 50000 && (float)$as['deposit'] <= 99999){
								$dp['num_dep100000'] = $dp['num_dep100000'] + 1;
								$dp['sum_dep100000'] = $dp['sum_dep100000'] +$as['deposit'];

							}if((float)$as['withdraw'] >= 50000 && (float)$as['withdraw'] <= 99999){
								$dp['num_wd100000'] = $dp['num_wd100000'] + 1;
								$dp['sum_wd100000'] = $dp['sum_wd100000'] + $as['withdraw'];

							}if((float)$as['deposit'] >= 100000 && (float)$as['deposit'] <= 999999999){
								$dp['num_dep100000+'] = $dp['num_dep100000+'] + 1;
								$dp['sum_dep100000+'] = $dp['sum_dep100000+'] +$as['deposit'];

							}if((float)$as['withdraw'] >= 100000 && (float)$as['withdraw'] >= 999999999){
								$dp['num_wd100000+'] = $dp['num_wd100000+'] + 1;
								$dp['sum_wd100000+'] = $dp['sum_wd100000+'] + $as['withdraw'];
							}
							
				
						}

					
		$data = array($dp);

		$re = array('code'=> 1 ,'title'=>'สำเร็จ','msg'=>'5','data'=> $data );

		echo json_encode($re);
		die();
	}
	
}
// if((float)$as['deposit'] > 0 && (float)$as['deposit'] <= 299  ){
// 	$dp['num_dep300'] = $dp['num_dep300'] + 1;
// 	$dp['sum_dep300'] = $dp['sum_dep300'] +$as['deposit'];
// }
// if((float)$as['deposit'] >= 300 && (float)$as['deposit']<= 999){
// 	$dp['num_dep1000'] = $dp['num_dep1000'] + 1;
// 	$dp['sum_dep1000'] = $dp['sum_dep1000'] +$as['deposit'];
// }

// if((float)$as['deposit'] >= 1000 && (float)$as['deposit']<= 4999){
// 	$dp['num_dep5000'] = $dp['num_dep5000'] + 1;
// 	$dp['sum_dep5000'] = $dp['sum_dep5000'] +$as['deposit'];
// }

// if((float)$as['deposit'] >=5000  && (float)$as['deposit']<= 9999){
// 	$dp['num_dep10000'] = $dp['num_dep10000'] + 1;
// 	$dp['sum_dep10000'] = $dp['sum_dep10000'] +$as['deposit'];
// }

// if((float)$as['deposit'] >= 10000 && (float)$as['deposit'] <= 49999){
// 	$dp['num_dep50000'] = $dp['num_dep50000'] + 1;
// 	$dp['sum_dep50000'] = $dp['sum_dep50000'] +$as['deposit'];
// }
// if((float)$as['deposit'] >= 50000 && (float)$as['deposit'] <= 99999){
// 	$dp['num_dep100000'] = $dp['num_dep100000'] + 1;
// 	$dp['sum_dep100000'] = $dp['sum_dep100000'] +$as['deposit'];
// }


// if((float)$as['deposit'] > 100000){
// 	$dp['num_dep100000+'] = $dp['num_dep100000+'] + 1;
// 	$dp['sum_dep100000+'] = $dp['sum_dep100000+'] +$as['deposit'];
// }
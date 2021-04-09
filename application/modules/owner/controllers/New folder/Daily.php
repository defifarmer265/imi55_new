<?php
class Daily extends MY_Controller
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
		$this->load->view('report_daily');
	}
	public function rp_us()
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$today1 	= strtotime(date('d-m-Y 00:00:00'));
		$today2 	= strtotime(date('d-m-Y 23:59:59'));
		$count_day 	= ((($dt2 - $dt1)+1)/(24*60*60))-1;
		$state 		= [];
		$dend		= $dt1 + (24*60*60)-1;
		$total      = 0;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {

			$state = $this->db->select('
						SUM(CASE WHEN tb_statement.deposit > 0 THEN 1 ELSE 0 END)as num_dep,
						SUM(tb_statement.deposit) as sum_dep,
						SUM(CASE WHEN tb_statement.withdraw > 0 THEN 1 ELSE 0 END)as num_wit,
						SUM(tb_statement.withdraw) as sum_wit,	
							')
						->where('tb_statement.status', 2)
						->where('tb_statement.dateCreate >', $dt1)
						->where('tb_statement.dateCreate <', $dend)
						->get('tb_statement')->row();
			$user 	 = $this->db->select('COUNT(tb_user.id) as num_user')
					   ->where('tb_user.create_time >=', $dt1 )
						->where('tb_user.create_time <=', $dend )
						->get('tb_user')->row();
			$deposit = $this->db->select('COUNT(tb_statement.id)as num_dep, SUM(tb_statement.deposit) as sum_dep')
						->join('acc_account', 'acc_account.bank_id = tb_statement.bank_id')
						->where('acc_account.type', 1)
						->where('tb_statement.status', 2)
						->where('tb_statement.deposit_id !=', 0)
						->where('tb_statement.datetime >=', $dt1)
						->where('tb_statement.datetime <=',$dend)
						->get('tb_statement')->row();			
	
			$ste[$i]['num_deposit'] = (intval($deposit->num_dep));
			$ste[$i]['sum_deposit'] = (floatval($deposit->sum_dep));
			$ste[$i]['num_withdraw'] = (intval($state->num_wit));
			$ste[$i]['sum_withdraw'] = (floatval($state->sum_wit));
			$ste[$i]['num_user'] = (intval($user->num_user));
			$total = $state->sum_dep -  $state->sum_wit;
			$ste[$i]['total'] = (floatval($total));
			$ste[$i]['date'] = date("d-m-Y",$dt1);
			

			
			$dt1 	= $dt1 + (24*60*60);
			$dend 	= $dend + (24*60*60);
		}
				// echo '<pre>';
				// print_r($ste);
				// print_r($state);

				//  die();

		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);

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



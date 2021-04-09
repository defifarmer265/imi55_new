<?php
class Report_payment extends MY_Controller
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
		$this->load->view('report_payment');
	}
	public function sel_report()
	{
		if($this->input->post('dt1') && $this->input->post('dt2')){
			$dt1 	= strtotime(date('d-m-Y 00:00:00',strtotime($this->input->post('dt1'))));
			$dt2 	= strtotime(date('d-m-Y 23:59:59',strtotime($this->input->post('dt2'))));
			
			$depositauto = $this->db->select('COUNT(tb_statement.id)as num_dps, SUM(tb_statement.deposit) as sum_dps')
				->join('acc_account','acc_account.bank_id = tb_statement.bank_id')
				->where('acc_account.type',1)
				->where('tb_statement.status',2)
				->where('tb_statement.deposit_id !=',0)
				->where('tb_statement.datetime >=',$dt1)
				->where('tb_statement.datetime <=',$dt2) 
				->get('tb_statement')->row();
			
			$withdrawauto = $this->db->select('COUNT(tb_statement.id)as num_wit, SUM(tb_statement.withdraw) as sum_wit')
				->join('acc_account','acc_account.bank_id = tb_statement.bank_id')
				->where('acc_account.type',2)
				->where('tb_statement.status',2)
				->where('tb_statement.datetime >=',$dt1)
				->where('tb_statement.datetime <=',$dt2) 
				->get('tb_statement')->row();
			
			$deposit = $this->db->select('COUNT(tb_statement.id)as num_dps, SUM(tb_statement.deposit) as sum_dps')
				->where('tb_statement.admin_id !=',0)
				->where('tb_statement.withdraw',0)
				->where('tb_statement.datetime >=',$dt1)
				->where('tb_statement.datetime <=',$dt2) 
				->get('tb_statement')->row();
			
			$withdraw = $this->db->select('COUNT(tb_statement.id)as num_wit, SUM(tb_statement.withdraw) as sum_wit')
				->join('tb_bank_web','tb_bank_web.id = tb_statement.bank_id')
				->where('tb_bank_web.status',1)
				->where('tb_statement.status',2)
				->where('tb_statement.datetime >=',$dt1)
				->where('tb_statement.datetime <=',$dt2) 
				->get('tb_statement')->row();
			$otp = $this->db->select('COUNT(tb_otp.id)as num_otp')
				->where('tb_otp.create_time >=',$dt1)
				->where('tb_otp.create_time <=',$dt2)
				->get('tb_otp')->row();
			$user = $this->db->select('COUNT(tb_user.id)as num_user')
				->where('tb_user.create_time >=',$dt1)
				->where('tb_user.create_time <=',$dt2)
				->get('tb_user')->row();
			$state = array(
					'num_dpsauto' => number_format($depositauto->num_dps,2),
					'sum_dpsauto' => number_format($depositauto->sum_dps,2),
					'num_witauto' => number_format($withdrawauto->num_wit,2),
					'sum_witauto' => number_format($withdrawauto->sum_wit,2),
					
					'num_dps' => number_format($deposit->num_dps,2),
					'sum_dps' => number_format($deposit->sum_dps,2),
					'num_wit' => number_format($withdraw->num_wit,2),
					'sum_wit' => number_format($withdraw->sum_wit,2),
					'num_user'=> number_format($user->num_user,2),
					'num_otp' => number_format($otp->num_otp,2),
					
					're_dpsauto' => number_format($depositauto->num_dps*0.25,2),
					're_witauto' => number_format($withdrawauto->num_wit*0.25,2),
					're_otp' => number_format($otp->num_otp*0.4,2),
					're_all' => number_format(($depositauto->num_dps*0.25)+($withdrawauto->num_wit*0.25)+($otp->num_otp*0.4),2),
				);
			
			$re = array('code'=>1,'title'=>'สำเร็จ','msg'=>'success','data'=> $state );
			
			
		}else{
			$re = array('code'=>0,'title'=>'Error','msg'=>'error','data'=> '' );
		}
		echo json_encode($re);
		die();
	}
	public function paymentDetail()
	{
		print_r($this->input->post());die();
	}
	

}


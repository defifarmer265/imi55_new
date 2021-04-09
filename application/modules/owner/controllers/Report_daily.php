<?php

class Report_daily extends MY_Controller
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
    //รายการฝากถอน รายวัน
    public function report_deposit_withdraw_daily()
    {
         $this->load->view('report_daily');
    }

		public function rp_us()
	{
		$dt1 		= strtotime(date('d-m-Y 10:59:59', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('d-m-Y 10:59:59', strtotime($this->input->post('dt2'))));
		
		$count_day 	= ((($dt2 - $dt1)+1)/(24*60*60))-1;
		$state 		= [];
		$dend		= $dt1 + (24*60*60)-1;
		$total      = 0;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {

			$dps = $this->db->select('COUNT(tb_statement.id)as num_dep, SUM(tb_statement.deposit) as sum_dep')
							->where('tb_statement.status', 2)
							->where('tb_statement.dateCreate >=', $dt1)
							->where('tb_statement.dateCreate <', $dend)
							->where('tb_statement.deposit >', 0)
							->get('tb_statement')->row();		


			$wid  = $this->db->select('COUNT(tb_statement.id)as num_wit, SUM(tb_statement.withdraw) as sum_wit')
						->where('tb_statement.status', 2)
						->where('tb_statement.dateCreate >', $dt1)
						->where('tb_statement.dateCreate <', $dend)
						->where('tb_statement.withdraw >', 0)
						->get('tb_statement')->row();

			$user 	 = $this->db->select('COUNT(tb_user.id) as num_user')
					   ->where('tb_user.create_time >=', $dt1 )
						->where('tb_user.create_time <=', $dend )
						->get('tb_user')->row();

			//รายการฝากยูสเซอร์ยอดแรก
			$us_dpsfirst = $this->db->select('tb_user.id, tb_user.create_time')
							->join('tb_statement','tb_statement.user_id = tb_user.id','right')
							->group_by('tb_user.user')
							->where('tb_user.create_time >=',$dt1)
							->where('tb_user.create_time <=',$dend)
							->where('tb_statement.status', 2)
							->where('tb_statement.deposit >', 0)
							->where('tb_statement.dateCreate >=', $dt1)
							->where('tb_statement.dateCreate <=', $dend)
							->get('tb_user')->num_rows();

						
			$deposit = $this->db->select('COUNT(tb_statement.id)as num_dep, SUM(tb_statement.deposit) as sum_dep')
						->join('acc_account', 'acc_account.bank_id = tb_statement.bank_id')
						->where('acc_account.type', 1)
						->where('tb_statement.status', 2)
						->where('tb_statement.deposit_id !=', 0)
						->where('tb_statement.dateCreate >=', $dt1)
						->where('tb_statement.dateCreate <=',$dend)
						->get('tb_statement')->row();			
	
			$ste[$i]['num_deposit'] = (intval($dps->num_dep));
			$ste[$i]['nus_dpsfirst'] = (intval($us_dpsfirst));
			$ste[$i]['sum_deposit'] = (floatval($dps->sum_dep));
			$ste[$i]['num_withdraw'] = (intval($wid->num_wit));
			$ste[$i]['sum_withdraw'] = (floatval($wid->sum_wit));
			$ste[$i]['num_user'] = (intval($user->num_user));
			$total = $dps->sum_dep -  $wid->sum_wit;
			$ste[$i]['total'] = (floatval($total));
			$ste[$i]['date'] = date("d-m-Y",$dt1);
			
			
			$dt1 	= $dt1 + (24*60*60);
			$dend 	= $dend + (24*60*60);
		}
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);
		echo json_encode($re);
		die();
	}

	

}
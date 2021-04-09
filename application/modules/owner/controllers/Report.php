<?php

class Report extends MY_Controller
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

	// รายการยอดชำระ
	public function report_payment()
	{
		$this->load->view('report_payment');
	}
	public function sel_report()
	{

		$s_day = strtotime(date('Y-m-d 00:00:00', strtotime($this->input->post('dt1'))));
		$e_day = strtotime(date('Y-m-d 23:59:59', strtotime($this->input->post('dt2'))));

		//รายการฝากอัตโนมัติ
		$depositauto = $this->db->select('COUNT(tb_statement.id)as num_dps, SUM(tb_statement.deposit) as sum_dps')
			->where('tb_statement.status', 2)
			->where('tb_statement.deposit >', 0)
			->where('tb_statement.dateCreate >=', $s_day)
			->where('tb_statement.dateCreate <=', $e_day)
			->get('tb_statement')->row();


		// รายการฝากมือสำหรับกรณีที่มีการแอดมือ
		$deposit = $this->db->select('COUNT(tb_statement.id)as num_dps, SUM(tb_statement.deposit) as sum_dps')
			->where('tb_statement.admin_id !=', 0)
			->where('tb_statement.status', 2)
			->where('tb_statement.deposit >', 0)
			->where('tb_statement.dateCreate >=', $s_day)
			->where('tb_statement.dateCreate <=', $e_day)
			->get('tb_statement')->row();


		//รายการถอน auto
		$withdrawauto = $this->db->select('COUNT(tb_statement.id)as num_wit, SUM(tb_statement.withdraw) as sum_wit')
			->join('acc_account', 'acc_account.bank_id = tb_statement.bank_id')
			->where('acc_account.type', 2)
			->where('tb_statement.withdraw >', 0)
			->where('tb_statement.status', 2)
			->where('tb_statement.dateCreate >=', $s_day)
			->where('tb_statement.dateCreate <=', $e_day)
			->get('tb_statement')->row();


		//รายการถอนมือ
		$withdraw = $this->db->select('COUNT(tb_statement.id)as num_wit, SUM(tb_statement.withdraw) as sum_wit')
			->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id')
			->where('tb_bank_web.status', 1)
			->where('tb_statement.status', 2)
			->where('tb_statement.dateCreate >=', $s_day)
			->where('tb_statement.dateCreate <=', $e_day)
			->get('tb_statement')->row();

		//รายการใช้ sms OTP	ต่อวัน
		$otp = $this->db->select('COUNT(tb_otp.id)as num_otp')
			->where('tb_otp.create_time >=', $s_day)
			->where('tb_otp.create_time <=', $e_day)
			->get('tb_otp')->row();
		//จำนวนยูสเซอร์ต่อวัน
		$user = $this->db->select('COUNT(tb_user.id)as num_user')
			->where('tb_user.create_time >=', $s_day)
			->where('tb_user.create_time <=', $e_day)
			->get('tb_user')->row();

		$state = array(
			'num_dpsauto' => $depositauto->num_dps,
			'sum_dpsauto' => number_format($depositauto->sum_dps, 2),
			'num_witauto' => $withdrawauto->num_wit,
			'sum_witauto' => number_format($withdrawauto->sum_wit, 2),

			'num_dps' => $deposit->num_dps,
			'sum_dps' => number_format($deposit->sum_dps, 2),
			'num_wit' => $withdraw->num_wit,
			'sum_wit' => number_format($withdraw->sum_wit, 2),
			'num_user' => $user->num_user,
			'num_otp' => $otp->num_otp,

			're_dpsauto' => number_format($depositauto->num_dps * 0.25, 2),
			're_witauto' => number_format($withdrawauto->num_wit * 0.25, 2),
			're_otp' => number_format($otp->num_otp * 0.4, 2),
			're_all' => number_format(($depositauto->num_dps * 0.25) + ($withdrawauto->num_wit * 0.25) + ($otp->num_otp * 0.4), 2),
		);

		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => 'success', 'data' => $state);

		echo json_encode($re);
		die();
	}


	// //รายการที่เข้าบัญชีฝากทั้งหมด
	public function report_deposit_all()
	{
		$this->load->view('report_deposit_all');
	}

	public function rp_us()
	{

		if ($this->input->post('user') != null) {
			$s_day = strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt1'))));
			$e_day = strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt2')))); //+เพิ่ม7 ชม

			$state = $this->db->select('
				tb_user.user,tb_user.username,tb_statement.datetime,
				CONCAT(FORMAT(SUM(tb_statement.deposit), 2)) as deposit,
				CONCAT(FORMAT(SUM(tb_statement.withdraw), 2)) as withdraw,
				SUM(tb_statement.deposit) as deposit1,
				SUM(tb_statement.withdraw) as withdraw1,
				SUM(CASE WHEN tb_statement.deposit > 0 THEN 1 ELSE 0 END)as num_deposit,
				SUM(CASE WHEN tb_statement.withdraw > 0 THEN 1 ELSE 0 END)as num_withdraw,
			')
				->group_by('tb_statement.user_id')
				->join('tb_user', 'tb_user.id = tb_statement.user_id')
				->where('tb_user.id', $this->input->post('user'))
				->where('tb_statement.status', 2)
				->where('tb_statement.dateCreate >=', $s_day)
				->where('tb_statement.dateCreate <=', $e_day)
				->order_by('tb_statement.id', 'ASC')
				->get('tb_statement')->result_array();
			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $state);
			echo json_encode($re);
			die();
		} else {


			$s_day = strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt1'))));
			$e_day = strtotime(date('Y-m-d 11:00:00', strtotime($this->input->post('dt2')))); //+เพิ่ม7 ชม

			$state = $this->db->select('
					tb_user.user,tb_user.username,tb_statement.datetime,
					CONCAT(FORMAT(SUM(tb_statement.deposit), 2)) as deposit,
					CONCAT(FORMAT(SUM(tb_statement.withdraw), 2)) as withdraw,
					SUM(tb_statement.deposit) as deposit1,
					SUM(tb_statement.withdraw) as withdraw1,
					SUM(CASE WHEN tb_statement.deposit > 0 THEN 1 ELSE 0 END)as num_deposit,
					SUM(CASE WHEN tb_statement.withdraw > 0 THEN 1 ELSE 0 END)as num_withdraw,
				')
				->group_by('tb_statement.user_id')
				->join('tb_user', 'tb_user.id = tb_statement.user_id')
				->where('tb_statement.status', 2)
				->where('tb_statement.dateCreate >=', $s_day)
				->where('tb_statement.dateCreate <=', $e_day)
				->order_by('tb_statement.id', 'ASC')
				->get('tb_statement')->result_array();





			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $state);
			echo json_encode($re);
			die();
		}
	}


	public function report_reset_turn()
	{
		$this->load->view('report_reset_turn');
	}
	public function select_reset_turn()
	{
		$dt1 	= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));

		$data['reset'] = $this->db->select('tb_user.user,tb_login.username,log_reset_turn.before_reset,log_reset_turn.time_reset')
			->join('tb_user', 'log_reset_turn.user_id = tb_user.id', 'left')
			->join('tb_login', 'log_reset_turn.admin_id = tb_login.id', 'left')
			->where('time_reset > ', $dt1)
			->where('time_reset < ', $dt2)
			->get('log_reset_turn')->result_array();

		$re = array('code' => 1, 'data' => $data);
		echo json_encode($re);
		die;
	}
}
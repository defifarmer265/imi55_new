<?php
class History_test extends MY_Controller
{
	public function __construct()
	{
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();
		$this->output->set_template('tem_owner/tem_owner');
	}

	public function index()
	{
		echo ' History';
		die();
	}
	// ข้อมูลย้อนหลังฝากถอน
	public function history_state()
	{
		//		$this->sum_state->sum_data_state();
		$data['bw'] = $this->db->select('tb_bank_web.id,tb_bank_web.name,tb_bank_web.account,tb_bank.bank_short')->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id')->get('tb_bank_web')->result_array();
		$this->load->view('history_state_test', $data);

	}
	//ค้นหา
	public function sel_state()
	{
		$user 	= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
		$tset	= $this->input->post('typeset');
		$dt1 	= strtotime(date('Y-m-d 10:59:59',strtotime($this->input->post('dt1'))));
		$dt2 	= strtotime(date('Y-m-d 10:59:59',strtotime($this->input->post('dt2'))));

		if ($this->input->post('type') == 'reject') {  //ยกเลิกการถอน
			$wit = $this->db->select('
					tb_withdraw.*,tb_user.user,tb_user.username,tb_login.name as admin')
				->join('tb_user', 'tb_user.id = tb_withdraw.user_id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_withdraw.bank_api', 'left')
				->join('tb_login', 'tb_login.id = tb_withdraw.admin_check', 'left')
				->where('tb_withdraw.status', 3)
				->where('tb_withdraw.time >=', $dt1)
				->where('tb_withdraw.time <=', $dt2)
				->order_by('tb_withdraw.id', 'DESC')->get('tb_withdraw')->result_array();
			$k = 0;
			foreach ($wit as $wt) {
				$wit[$k]['newtime'] = date('m-d-y H:i:s', $wt['time']);
				$wit[$k]['amount1'] = number_format($wt['amount'], 2);

				$k++;
			}
			$re = array('code' => 2, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $wit);

		} else {

			$state = $this->db->select('
			tb_statement.*,tb_user.user,tb_user.username,tb_user_bank.account,tb_bank.bank_short,tb_login.name as admin_name,tb_bank_web.name as bw_name,tb_bank_web.account as bw_acc')
				->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
				->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
				->join('tb_bank_web', 'tb_bank_web.id = tb_statement.bank_id', 'left')
				->join('tb_login', 'tb_login.id = tb_statement.admin_id', 'left')
				->where('tb_statement.dateCreate >=', $dt1)
				->where('tb_statement.dateCreate <=', $dt2);

			if ($tset == 2) { //ลูกค้าทั้งหมด
				$this->db->where('tb_statement.user_id !=', 0);
			} else if ($tset == 3) { //พนักงาน
				$this->db->where('tb_statement.status', 3);
			} else {

			}
			// เงือนไขเลือกทั้งหมด
			if ($this->input->post('type') == '' && $this->input->post('bank_id') == '' && $this->input->post('user') == '') { //ไม่เลือก

			} else if ($this->input->post('bank_id') == '' && $this->input->post('user') == '') { //เลือกประเภท
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			} else if ($this->input->post('type') == ''  && $this->input->post('user') == '') { //เลือกแบงค์
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
			} else if ($this->input->post('type') == '' && $this->input->post('bank_id') == '') { //เลือกยูเซอร์

				$this->db->where('tb_user.user', $user);
			} else if ($this->input->post('type') == '') { //เลือกแบงค์ //เลือกยูเซอร์

				$this->db->where('tb_user.user', $user);
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
			} else if ($this->input->post('bank_id') == '') { //เลือกประเภท เลือกยูเซอร์

				$this->db->where('tb_user.user', $user);
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			} else if ($this->input->post('user') == '') { //เลือกประเภท เลือกแบงค์ .
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			} else {

				$this->db->where('tb_user.user', $user);
				$this->db->where('tb_bank_web.id', $this->input->post('bank_id'));
				if ($this->input->post('type') == 'deposit') {
					$this->db->where('tb_statement.deposit !=', 0);
				} else if ($this->input->post('type') == 'withdraw') {
					$this->db->where('tb_statement.withdraw !=', 0);
				}
			}

			$state = $this->db->where('tb_statement.status !=', 5)->order_by('tb_statement.id', 'DESC')->get('tb_statement')->result_array();
			
			$i = 0;
			foreach ($state as $st) {
				$state[$i]['newTime1'] = date('m-d-y H:i:s', $st['datetime']);
				$state[$i]['newTime2'] = date('m-d-y H:i:s', $st['dateCreate']);
				$state[$i]['deposit1'] = number_format($st['deposit'], 2);
				$state[$i]['withdraw1'] = number_format($st['withdraw'], 2);

				$i++;
			}
			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $state);
		}
		echo json_encode($re);
		die();
	}

}

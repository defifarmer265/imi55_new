<?php
class Home extends MY_Controller
{
	public function __construct()
	{
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('backend/statement_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->load->library('backend/backend_library');
		$this->load->library('backend/google_authenticator');
		$this->owner_libraray->login();
		$this->output->set_template('tem_owner/tem_owner');
	}

	public function dashboard()
	{
		if (date('Hi') > 1059) {

			$s_today = strtotime(date('Y-m-d 10:59:59'));
		} else {

			$s_today = strtotime(date('Y-m-d 10:59:59', strtotime('-1 days')));
		}

		//ยูสเซอร์ทั้งหมด
		$us_all 	= $this->db->select('COUNT(tb_user.id) as num_user')->get('tb_user')->row();
		//ยูสเซอร์สมัครวันนี้
		$us_today	= $this->db->select('COUNT(tb_user.id) as num_user')
			->where('tb_user.create_time >=', $s_today)
			->get('tb_user')->row();

		//รายการฝากวันนี้
		$dps_today = $this->db->select('COUNT(tb_statement.id)as num_dps, SUM(tb_statement.deposit) as sum_dps')
			->where('tb_statement.deposit >', 0)
			->where('tb_statement.dateCreate >=', $s_today)
			->where('tb_statement.status', 2)
			->get('tb_statement')->row();
		//รายการถอนวันนี้
		$wid_today  = $this->db->select('COUNT(tb_statement.id)as num_wit, SUM(tb_statement.withdraw) as sum_wit')
			->where('tb_statement.status', 2)
			->where('tb_statement.dateCreate >=', $s_today)
			->where('tb_statement.withdraw >', 0)
			->get('tb_statement')->row();

		//รายการฝากยูสเซอร์ยอดแรก
		$us_dpsfirst = $this->db->select('tb_user.id, tb_user.create_time')
			->join('tb_statement', 'tb_statement.user_id = tb_user.id', 'right')
			->group_by('tb_user.user')
			->where('tb_user.create_time >=', $s_today)
			->where('tb_statement.status', 2)
			->where('tb_statement.deposit >', 0)
			->where('tb_statement.dateCreate >=', $s_today)
			->get('tb_user')->num_rows();


		//การใช้งานลูกค้า / ต่อวัน
		$platform_count = $this->db->select('COUNT(platform)as  countPlatform ,platform ,create_time ,action ')
			->where('create_time >=', $s_today)
			->where('action =', 1)
			->group_by('platform')
			->get('log_user_login')
			->result_array();

		//รายการฝากต่อธนาคาร / ต่อวัน
		$bank_web = $this->db->select('COUNT(tb_statement.id) as st  ,SUM(tb_statement.deposit) as sm,tb_bank_web.name, tb_bank.bank_short, tb_bank.api_id')
			->join('tb_statement', 'tb_statement.bank_id = tb_bank_web.id', 'left')
			->join('tb_bank', 'tb_bank.id =tb_bank_web.bank_id', 'left')
			->group_by('tb_bank_web.id')
			->where('tb_bank_web.type', 1)
			->where('tb_bank_web.status', 3)
			->where('tb_statement.status', 2)
			->where('tb_statement.dateCreate >=', $s_today)
			->get('tb_bank_web')
			->result_array();


		$DW = $this->statement_model->get_DW();
		$data = array(
			'DW' => $DW,
			'us_all' => $us_all->num_user,  //ยูสเซอร์ทั้งหมด
			'us_td' => $us_today->num_user, //ยูสเซอร์สมัครวันนี้
			'us_td_dp' => $us_dpsfirst, //รายการฝากยูสเซอร์ยอดแรก
			'dp_td' => $dps_today->num_dps, //รายการฝากวันนี้
			'wd_td' => $wid_today->num_wit, //รายการถอนวันนี้
			'dp_sum_td' => $dps_today->sum_dps, //ยอดรวมรายการฝาก
			'wd_sum_td' => $wid_today->sum_wit, //ยอดรวมรายการถอน
			'count_device'  => $platform_count, //จำนวนการใช้งานลูกค้า
			'bank_web'  => $bank_web //รายการฝากต่อธนาคารต่อวัน
		);
		$this->load->view('dashboard', $data);
	}

	public function get_DW()
	{
		echo json_encode($this->statement_model->get_DW());
		die;
	}



	public function chart()
	{
		//ข้อมูลกราฟ เริ่ม
		$dayStart = time() - (15 * 24 * 60 * 60);
		$dayEnd   = strtotime(date('d-m-Y'));
		$withdrawJS = '';
		$depositJS = '';
		$sumPerDay = 0;

		if (empty($this->input->post('dt1')) || empty($this->input->post('dt2'))) {
			for ($i = 1; $dayStart < $dayEnd; $i++) {

				$dayStart = strtotime(date('m/d/y', $dayStart) . "+1 days");
				$row_withdraw = $this->db->select('SUM(withdraw) as sumPerDay')
					->where('dateCreate >=', strtotime(date('d-m-Y 00:00:00', $dayStart)))
					->where('dateCreate <=', strtotime(date('d-m-Y 23:59:59', $dayStart)))
					->where('withdraw_id != ', 0)
					->where('status', 2)
					->get('tb_statement')
					->row();
				$row_deposit = $this->db->select('SUM(deposit) as sumPerDay')
					->where('dateCreate >=', strtotime(date('d-m-Y 00:00:00', $dayStart)))
					->where('dateCreate <=', strtotime(date('d-m-Y 23:59:59', $dayStart)))
					->where('deposit_id !=', 0)
					->where('status', 2)
					->get('tb_statement')
					->row();
				if ($row_withdraw->sumPerDay != '') {
					$wd_sumPerDay = ($row_withdraw->sumPerDay / 1000);
				} else {
					$wd_sumPerDay = 0;
				}
				if ($row_deposit->sumPerDay != '') {
					$ds_sumPerDay = ($row_deposit->sumPerDay / 1000);
				} else {
					$ds_sumPerDay = 0;
				}
				$wdJS = '[gd(' . date('Y, m, d', $dayStart) . '),' . $wd_sumPerDay . '],';
				$withdrawJS = $withdrawJS . $wdJS;
				$dsJS = '[gd(' . date('Y, m, d', $dayStart) . '),' . $ds_sumPerDay . '],';
				$depositJS = $depositJS . $dsJS;
			}
			$data["withdrawJS"] = $withdrawJS;
			$data["depositJS"] = $depositJS;
		} else {
			$dd = $this->searchChart($this->input->post('dt1'), $this->input->post('dt2'));
			$data["withdrawJS"] = $dd['withdrawJS'];
			$data["depositJS"] = $dd['depositJS'];
			$this->load->view('chart_v', $data);
		}
		$this->load->view('chart_v', $data);
	}

	public function searchChart($d1, $d2)
	{

		$start = date('Y-m-d', strtotime($d1));
		$end   = date('Y-m-d', strtotime($d2));
		$calculate = round(abs(strtotime($start) - strtotime($end)) / 60 / 60 / 24); // คำนวณจำนวนวันเพื่อเอาไปใช้ใน daystarts 
		$calculate += 1; //บวกเพิ่มไปอีก1 เพราะ ถ้าเราหาวันที่ 13 ถึงวันที่ 15 มันจะลบกันได้ 2 มันจะนับแค่่ 14 กับ 15 ดั้งนั้นต้อง+1 มันจะนับถึง 13ถึง15
		$dayStart = time() - ($calculate * 24 * 60 * 60); //ย้อนหลัง
		$dateEnd   = strtotime(date('d-m-Y', strtotime($this->input->post($d2))));
		$withdrawJS = '';
		$depositJS = '';
		$sumPerDay = 0;

		for ($i = 1; $dayStart < $dateEnd; $i++) {
			$dayStart = strtotime(date('m/d/y', $dayStart) . "+1 days");
			$row_withdraw = $this->db->select('SUM(withdraw) as sumPerDay')
				->where('dateCreate >=', strtotime(date('d-m-Y 00:00:00', $dayStart)))
				->where('dateCreate <=', strtotime(date('d-m-Y 23:59:59', $dayStart)))
				->where('withdraw_id != ', 0)
				->where('status', 2)
				->get('tb_statement')
				->row();

			$row_deposit = $this->db->select('SUM(deposit) as sumPerDay')
				->where('dateCreate >=', strtotime(date('d-m-Y 00:00:00', $dayStart)))
				->where('dateCreate <=', strtotime(date('d-m-Y 23:59:59', $dayStart)))
				->where('deposit_id !=', 0)
				->where('status', 2)
				->get('tb_statement')
				->row();

			if ($row_withdraw->sumPerDay != '') {
				$wd_sumPerDay = ($row_withdraw->sumPerDay / 1000);
			} else {
				$wd_sumPerDay = 0;
			}
			if ($row_deposit->sumPerDay != '') {
				$ds_sumPerDay = ($row_deposit->sumPerDay / 1000);
			} else {
				$ds_sumPerDay = 0;
			}
			$wdJS = '[gd(' . date('Y, m, d', $dayStart) . '),' . $wd_sumPerDay . '],';
			$withdrawJS = $withdrawJS . $wdJS;
			$dsJS = '[gd(' . date('Y, m, d', $dayStart) . '),' . $ds_sumPerDay . '],';
			$depositJS = $depositJS . $dsJS;
		}
		$data = array(
			'withdrawJS' => $withdrawJS,
			'depositJS' => $depositJS
		);
		return $data;
	}


	public function charttoday()
	{
		$withdrawJS = '';
		$depositJS = '';
		$sumPerDay = 0;
		$time = array(
			["s" => strtotime(date('d-m-Y 00:00:00')), "e" => strtotime(date('d-m-Y 00:59:59'))],
			["s" => strtotime(date('d-m-Y 01:00:00')), "e" => strtotime(date('d-m-Y 01:59:59'))],
			["s" => strtotime(date('d-m-Y 02:00:00')), "e" => strtotime(date('d-m-Y 02:59:59'))],
			["s" => strtotime(date('d-m-Y 03:00:00')), "e" => strtotime(date('d-m-Y 03:59:59'))],
			["s" => strtotime(date('d-m-Y 04:00:00')), "e" => strtotime(date('d-m-Y 04:59:59'))],
			["s" => strtotime(date('d-m-Y 05:00:00')), "e" => strtotime(date('d-m-Y 05:59:59'))],
			["s" => strtotime(date('d-m-Y 06:00:00')), "e" => strtotime(date('d-m-Y 06:59:59'))],
			["s" => strtotime(date('d-m-Y 07:00:00')), "e" => strtotime(date('d-m-Y 07:59:59'))],
			["s" => strtotime(date('d-m-Y 08:00:00')), "e" => strtotime(date('d-m-Y 08:59:59'))],
			["s" => strtotime(date('d-m-Y 09:00:00')), "e" => strtotime(date('d-m-Y 09:59:59'))],
			["s" => strtotime(date('d-m-Y 10:00:00')), "e" => strtotime(date('d-m-Y 10:59:59'))],
			["s" => strtotime(date('d-m-Y 11:00:00')), "e" => strtotime(date('d-m-Y 11:59:59'))],
			["s" => strtotime(date('d-m-Y 12:00:00')), "e" => strtotime(date('d-m-Y 12:59:59'))],
			["s" => strtotime(date('d-m-Y 13:00:00')), "e" => strtotime(date('d-m-Y 13:59:59'))],
			["s" => strtotime(date('d-m-Y 14:00:00')), "e" => strtotime(date('d-m-Y 14:59:59'))],
			["s" => strtotime(date('d-m-Y 15:00:00')), "e" => strtotime(date('d-m-Y 15:59:59'))],
			["s" => strtotime(date('d-m-Y 16:00:00')), "e" => strtotime(date('d-m-Y 16:59:59'))],
			["s" => strtotime(date('d-m-Y 17:00:00')), "e" => strtotime(date('d-m-Y 17:59:59'))],
			["s" => strtotime(date('d-m-Y 18:00:00')), "e" => strtotime(date('d-m-Y 18:59:59'))],
			["s" => strtotime(date('d-m-Y 19:00:00')), "e" => strtotime(date('d-m-Y 19:59:59'))],
			["s" => strtotime(date('d-m-Y 20:00:00')), "e" => strtotime(date('d-m-Y 20:59:59'))],
			["s" => strtotime(date('d-m-Y 21:00:00')), "e" => strtotime(date('d-m-Y 21:59:59'))],
			["s" => strtotime(date('d-m-Y 22:00:00')), "e" => strtotime(date('d-m-Y 22:59:59'))],
			["s" => strtotime(date('d-m-Y 23:00:00')), "e" => strtotime(date('d-m-Y 23:59:59'))],
		);

		$wdJS = "";
		$dsJS = "";
		foreach ($time as $ti) {

			$row_deposit = $this->db->select('SUM(deposit) as sumPerDay ,datetime')
				->where('dateCreate >=', $ti['s'])
				->where('dateCreate <=', $ti['e'])
				->where('deposit_id !=', 0)
				->where('status', 2)
				->get('tb_statement')
				->row();
			$row_withdraw = $this->db->select('SUM(withdraw) as sumPerDay,datetime')
				->where('dateCreate >=', $ti['s'])
				->where('dateCreate <=', $ti['e'])
				->where('withdraw_id != ', 0)
				->where('status', 2)
				->get('tb_statement')
				->row();
			if ($row_deposit->sumPerDay != '' || $row_deposit->sumPerDay != null) {
				$dsJS .= "'" . $row_deposit->sumPerDay . "',";
			} else {
				$dsJS .= "'0',";
			}
			if ($row_withdraw->sumPerDay != '' || $row_withdraw->sumPerDay != null) {
				$wdJS .= "'" . $row_withdraw->sumPerDay . "',";
			} else {
				$wdJS .= "'0',";
			}
		}

		// echo "<pre>";
		$data["withdrawJS"] = $wdJS;
		$data["depositJS"] = $dsJS;
		// print_r($data);
		// die;
		$this->load->view('chart_v_today', $data);
	}

	// เมนูค้นหากราฟรายวัน
	public function search_chart_today(){

		$day = $this->input->post('dt1');
		$withdrawJS = '';
		$depositJS = '';
		$sumPerDay = 0;
		$time = array(
			["s" => strtotime(date($day.'00:00:00')), "e" => strtotime(date($day.'00:59:59'))],
			["s" => strtotime(date($day.' 01:00:00')), "e" => strtotime(date($day.' 01:59:59'))],
			["s" => strtotime(date($day.' 02:00:00')), "e" => strtotime(date($day.' 02:59:59'))],
			["s" => strtotime(date($day.' 03:00:00')), "e" => strtotime(date($day.' 03:59:59'))],
			["s" => strtotime(date($day.' 04:00:00')), "e" => strtotime(date($day.' 04:59:59'))],
			["s" => strtotime(date($day.' 05:00:00')), "e" => strtotime(date($day.' 05:59:59'))],
			["s" => strtotime(date($day.' 06:00:00')), "e" => strtotime(date($day.' 06:59:59'))],
			["s" => strtotime(date($day.' 07:00:00')), "e" => strtotime(date($day.' 07:59:59'))],
			["s" => strtotime(date($day.' 08:00:00')), "e" => strtotime(date($day.' 08:59:59'))],
			["s" => strtotime(date($day.' 09:00:00')), "e" => strtotime(date($day.' 09:59:59'))],
			["s" => strtotime(date($day.' 10:00:00')), "e" => strtotime(date($day.' 10:59:59'))],
			["s" => strtotime(date($day.' 11:00:00')), "e" => strtotime(date($day.' 11:59:59'))],
			["s" => strtotime(date($day.' 12:00:00')), "e" => strtotime(date($day.' 12:59:59'))],
			["s" => strtotime(date($day.' 13:00:00')), "e" => strtotime(date($day.' 13:59:59'))],
			["s" => strtotime(date($day.' 14:00:00')), "e" => strtotime(date($day.' 14:59:59'))],
			["s" => strtotime(date($day.' 15:00:00')), "e" => strtotime(date($day.' 15:59:59'))],
			["s" => strtotime(date($day.' 16:00:00')), "e" => strtotime(date($day.' 16:59:59'))],
			["s" => strtotime(date($day.' 17:00:00')), "e" => strtotime(date($day.' 17:59:59'))],
			["s" => strtotime(date($day.' 18:00:00')), "e" => strtotime(date($day.' 18:59:59'))],
			["s" => strtotime(date($day.' 19:00:00')), "e" => strtotime(date($day.' 19:59:59'))],
			["s" => strtotime(date($day.' 20:00:00')), "e" => strtotime(date($day.' 20:59:59'))],
			["s" => strtotime(date($day.' 21:00:00')), "e" => strtotime(date($day.' 21:59:59'))],
			["s" => strtotime(date($day.' 22:00:00')), "e" => strtotime(date($day.' 22:59:59'))],
			["s" => strtotime(date($day.' 23:00:00')), "e" => strtotime(date($day.' 23:59:59'))],
		);

		$wdJS = "";
		$dsJS = "";
		foreach ($time as $ti) {

			$row_deposit = $this->db->select('SUM(deposit) as sumPerDay ,datetime')
				->where('dateCreate >=', $ti['s'])
				->where('dateCreate <=', $ti['e'])
				->where('deposit_id !=', 0)
				->where('status', 2)
				->get('tb_statement')
				->row();
			$row_withdraw = $this->db->select('SUM(withdraw) as sumPerDay,datetime')
				->where('dateCreate >=', $ti['s'])
				->where('dateCreate <=', $ti['e'])
				->where('withdraw_id != ', 0)
				->where('status', 2)
				->get('tb_statement')
				->row();
			if ($row_deposit->sumPerDay != '' || $row_deposit->sumPerDay != null) {
				$dsJS .= "'" . $row_deposit->sumPerDay . "',";
			} else {
				$dsJS .= "'0',";
			}
			if ($row_withdraw->sumPerDay != '' || $row_withdraw->sumPerDay != null) {
				$wdJS .= "'" . $row_withdraw->sumPerDay . "',";
			} else {
				$wdJS .= "'0',";
			}
		}

		// echo "<pre>";
		$data["withdrawJS"] = $wdJS;
		$data["depositJS"] = $dsJS;
		$data["day"] = date('d/m/Y',strtotime($this->input->post('dt1')));
		// print_r($data);
		// die;
		$this->load->view('result_chart', $data);
	}
	//เมนูเพิ่มบัญชี
	public function owner_list()
	{

		$data['owner_list'] = $this->db->select('id,username,name,tel,status,last_login,lastip_login,class')
			->where('id !=', 1)->get('tb_owner');
		$this->load->view('owner_list', $data);
	}

	public function cre_owner()
	{
		if ($this->input->post('username')) {
			$username = $this->input->post('username');
			$password = sha1($this->input->post('password'));
			$name     = $this->input->post('name');
			$tel      = $this->input->post('tel');
			$class    = $this->input->post('class');
			if ($check_username = $this->db->select('username')->where('username', $username)->get('tb_owner')->num_rows() === 0) {
				$data = array(
					"username" => $username,
					"password" => $password,
					"name" => $name,
					'tel' => $tel,
					'status' => '1',
					'class' => $class
				);
				if ($this->db->insert('tb_owner', $data)) {
					$re = array('msg' => 'สร้างบัญชีผู้ใช้งานสำเร็จ', 'code' => 1);
				} else {
					$re = array('msg' => 'ระบบเกิดปัญหาโปรดติดต่อเจ้าหน้าที่ หรือ F5 เพื่อทำการใหม่', 'code' => 0);
				}
			} else {
				$re = array('msg' => 'ยูเซอร์ซ้ำ', 'code' => 0);
			}
		} else {
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบทุกช่องด้วย', 'code' => 0);
		}
		echo json_encode($re);
		die();
	}


	public function edit_pass_owner()
	{
		if ($this->input->post('admin_id')) {
			$id = $this->input->post('admin_id');
			$pass = sha1($this->input->post('password'));
			if ($this->db->select('id,password')->where('id', $id)->set('password', $pass)->update('tb_owner')) {
				$re = array('msg' => 'เปลี่ยนรหัสการใช้งานบัญชีนี้สำเร็จ', 'code' => 1);
			} else {
				$re = array('msg' => 'เปลี่ยนรหัสการใช้งานบัญชีนี้ไม่สำเร็จ โปรดติดต่อเจ้าหน้าที่', 'code' => 0);
			}
		} else {
			$re = array('msg' => 'ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่ หรือ f5 แล้วทำรายการใหม่', 'code' => 0);
		}
		echo json_encode($re);
		die();
	}

	public function edit_status()
	{
		if ($id = $this->input->post('id')) {
			$check = $this->db->select('id,status')->where('id', $id)->get('tb_owner')->row();
			if ($check->status == 0) {
				if ($this->db->where('id', $id)->set('status', 1)->update('tb_owner')) {
					$re = array('msg' => 'เปิดการใช้งานบัญชีนี้สำเร็จ', 'code' => 1);
				} else {
					$re = array('msg' => 'เปิดการใช้งานบัญชีนี้ไม่สำเร็จ โปรดติดต่อเจ้าหน้าที่', 'code' => 0);
				}
			} else {
				if ($this->db->where('id', $id)->set('status', 0)->update('tb_owner')) {
					$re = array('msg' => 'ปิดการใช้งานบัญชีนี้สำเร็จ', 'code' => 1);
				} else {
					$re = array('msg' => 'ปิดการใช้งานบัญชีนี้ไม่สำเร็จ โปรดติดต่อเจ้าหน้าที่', 'code' => 1);
				}
			}
		} else {
			$re = array('msg' => 'ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่ หรือ f5 แล้วทำรายการใหม่', 'code' => 0);
		}
		echo json_encode($re);
		die();
	}



	public function edit_class()
	{
		$result = $this->db->where('id', $this->input->post('id'))->get('tb_owner')->row();
		echo json_encode($result);
		die;
	}

	public function update_class()
	{

		if ($this->input->post()) {
			if ($this->input->post('c_id') != null) {
				if ($this->input->post('class') != null) {
					$query = $this->db->set('class', $this->input->post('class'))->where('id', $this->input->post('c_id'))->update('tb_owner');
					if ($query) {
						$re = array('msg' => 'เรียบร้อย', 'code' => 1, 'title' => 'ทำรายการสำเร็จ');
					} else {
						$re = array('msg' => 'เรียบร้อย', 'code' => 0, 'title' => 'ทำรายการไม่สำเร็จ');
					}
				} else {
					$re = array('msg' => 'เรียบร้อย', 'code' => 0, 'title' => 'ทำรายการไม่สำเร็จ  class ไม่มี');
				}
			} else {
				$re = array('msg' => 'เรียบร้อย', 'code' => 0, 'title' => 'ทำรายการไม่สำเร็จ c_id ไม่มี');
			}
		} else {
			$re = array('msg' => 'เรียบร้อย', 'code' => 0, 'title' => 'ทำรายการไม่สำเร็จ 3');
		}
		echo json_encode($re);
		die();
	}






	public function profile()
	{
		$chtb = $this->db->where('id', $this->session->owner->id)->get('tb_owner')->row();

		if($chtb->two_factor == null || $chtb->two_factor == '' || $chtb->two_factor == 'null'){
			$this->db->set('two_factor', '{"key":"","linkQr":"","status":"off"}')->where('id',$this->session->owner->id)->update('tb_owner');
		}
		$data['owner'] = $this->db->where('id', $this->session->owner->id)->get('tb_owner')->row();
		$this->load->view('profile', $data);
	}



	public function edit_pass()
	{
		if ($this->input->post('pass')) {
			$id  = $this->session->owner->id;
			$pass = $this->input->post('pass');
			$password = sha1($pass);

			if ($this->db->set('password', $password)->where('id', $id)->update('tb_owner')) {
				$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => 'ทำรายการสำเร็จกรุณาตรวจสอบรายการ');
			} else {
				$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		} else {
			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}


	public function logout()
	{
		$lastip_login	= $this->owner_libraray->get_client_ip();
		$data_log = array(
			'owner_id' => $this->session->userdata['owner']->username,
			'ip' => $lastip_login,
			'action' => 2,
			'datetime' => time()
		);
		$this->db->insert('log_owner_login', $data_log);

		$this->session->sess_destroy();
		redirect('owner');
	}



	public function change_status_tf()
    {
        $adminid = $this->session->owner->id;
        $user =  ($this->db->select('two_factor')
        ->where('id', $adminid)
        ->get('tb_owner')
        ->result_array())[0];
        $status_tf =  $this->input->post('status_tf');
        $tf = json_decode($user['two_factor']);
            if($status_tf=="on"){ // เปิดใช้ two-factor
                if($tf->key == "" ||   $tf->linkQr ==  ""  ){
                    if($arr_update = $this->newKeyTwoFactor()){
                        $re = array('code' => 1, 'msg' => "เพิ่มใหม่เรียบร้อย",'data'=>$arr_update);
                    }else{
                        $re = array('code' => 1, 'msg' => "ผิดพลาดเพิ่มไม่ได้",'data'=>[]);
                    }
                    
                }else{
                    $arr_update =  array(
                        'two_factor' => json_encode(
                            [
                                "key"=> $tf->key,
                                "linkQr"=> $tf->linkQr,
                                "status"=> "on"
                            ])
                    
                    );
                    if ($this->db->where('id', $adminid)->update('tb_owner', $arr_update)) {
                        $re = array('code' => 1, 'msg' => "เปิดใช้",'data'=>[]);
                    }
                }
                
            }else{ // ปิด  two-factor
                $arr_update =  array(
                        'two_factor' => json_encode(
                            [
                                "key"=>$tf->key,
                                "linkQr"=> $tf->linkQr,
                                "status"=> "off"
                            ])
                    
                    );
                    if ($this->db->where('id', $adminid)->update('tb_owner', $arr_update)) {
                        $re = array('code' => 1, 'msg' => "ปิดใช้",'data'=>[]);
                    }
            }


        echo json_encode($re);
        die();
    }

        public function confrimTwofactor(){
            $pin = $this->input->post('pin');
            $adminid = $this->session->owner->id;
            $user =  $this->db->select('two_factor')
                        ->where('id', $adminid)
                        ->get('tb_owner')
                        ->row();
            $ch_ft = json_decode($user->two_factor);
            $checkResult = $this->google_authenticator->verifyCode($ch_ft->key, $pin, 2);    
                    if ($checkResult) {
                        $arr_update =  array(
                            'two_factor' => json_encode(
                                [
                                    "key"=> $ch_ft->key,
                                    "linkQr"=> $ch_ft->linkQr,
                                    "status"=> "on"
                                ])
                        
                        );
                        if ($this->db->where('id', $adminid)->update('tb_owner', $arr_update)) {
                            $re = array('code' => 1, 'msg' => "บันทึก");
                        }
                    } else {
                            $re = array('code' => 0, 'msg' => "ผิด");
                    }
                    echo json_encode($re);
                    die;
        }
    public function newKeyTwoFactor()
    {
        $adminid = $this->session->owner->id;
        $user =  ($this->db->select('id,username')
                    ->where('id', $adminid)
                    ->get('tb_owner')
                    ->result_array())[0];
        $ST =  ($this->db->select('code')
                    ->where('name', 'web')
                    ->get('setting')
                    ->result_array())[0];
       
            $secret = $this->google_authenticator->createSecret();
			$qrCodeUrl = $this->google_authenticator->getQRCodeGoogleUrl($ST['code'].'/'.$user['username'], $secret);
			
            $arr_update =  array(
                'two_factor' =>  json_encode(
                    [
                        "key"=> $secret,
                        "linkQr"=> $qrCodeUrl,
                        "status"=> "wait"
                    ])
            );  
            if ( $this->db->where('id', $user['id'])->update('tb_owner', $arr_update) ){

                if($this->input->post('new')){
                    $re = array('code' => 1, 'msg' => "เพิ่มใหม่เรียบร้อย กรุณาลงทะเบียนก่อนออกจากหน้านี้" ,'data'=>$arr_update);
                    echo json_encode($re);
                    die();
                }
                return $arr_update;
            }else{
                if($this->input->post('new')){
                    $re = array('code' => 1, 'msg' => "ผิดพลาดเพิ่มไม่ได้");
                    echo json_encode($re);
                    die();
                }
                return false;
            }
            
    }

    public function setHtmlTwoFac()
    {
        $adminid = $this->session->owner->id;
        $againPass = $this->input->post('againPass');
        $code = $this->input->post('code');
        
        $tf = ($this->db->select('*')
                        ->where('id', $adminid)
                        ->get('tb_owner')
                        ->row());
                        $two_factor=  json_decode($tf->two_factor);
        $checkResult = $this->google_authenticator->verifyCode($two_factor->key, $code, 2);
        
       if ($this->owner_libraray->hash_password($againPass) == $tf->password  ) {
                    if ($checkResult) {
                        $resp['status'] = 1;
                        $resp['msg'] = 'ผ่าน';
                        $resp['data'] = $two_factor;
                        
                    } else {
                        $resp['status'] = 0;
                        $resp['msg'] = 'codeผิด';
                        $resp['data'] = '';
                    }
       }else{
        $resp['status'] = 0;
        $resp['msg'] = 'รหัสผ่านผิด';
        $resp['data'] = '';
       }

            echo json_encode($resp) ;
            die;
    }

}

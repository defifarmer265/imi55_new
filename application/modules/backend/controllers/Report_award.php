<?php
class Report_award extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->model('getapi_model');
		$this->load->library('backend/backend_library');
		$this->load->helper('url');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();
	}

	//รายงานการแลกเครดิต
	public function report_aw()
	{
		$this->load->view('report_aw');
	}

	//รายงานการหมุนสปิน
	public function rs_s_c()
	{
		$this->load->view('rs_s_c');
	}

	//รายงานการปรับเคดิตมือ
	public function rs_c_m()
	{
		$this->load->view('report_creditday');
	}
	//หน้า เทริน์
	public function view_turn()
	{
		$this->load->view('view_turn');
	}

	public function call_af(){
		$this->load->view('view_callaf');
	}
	public function report_result()
	{
		$this->load->view('report_total');
	}

	public function sel_report()
	{


		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($this->input->post('dt2'))));

		
		// แลกรางวัล
		$exchang = $this->db->select('SUM(point)as sumpoint ,SUM(cost) as sum_cost ,create_time')
			->where('create_time >=', $dt1)
			->where('create_time <=', $dt2)
			->get('tb_exchange')->row();


		// หมุนวงล้อ
		$spin    = $this->db->select('COUNT(user_id) as count_spin , SUM(point) as sumpoint ,type,create_time')
			->where('type', 'spin')
			->where('create_time >=', $dt1)
			->where('create_time <=', $dt2)
			->get('tb_point')->row();

		//ปรับมือเพิม่
		$credit_in = $this->db->select('COUNT(action) AS count_detail,admin, user_id, detail, datetime, detail, action')
			->where('action', 'up')
			->where('datetime >=', $dt1)
			->where('datetime <=', $dt2)
			->get('log_edit_user_credit')->row();


		$credit_rs    = $this->db->select('log_edit_user_credit.*')
			->where('log_edit_user_credit.datetime >=', $dt1)
			->where('log_edit_user_credit.datetime <=', $dt2)
			->where('log_edit_user_credit.action', 'up')
			->order_by('log_edit_user_credit.datetime', 'DESC')
			->get('log_edit_user_credit')->result_array();

		$k = 0;
		$sum = 0;
		foreach ($credit_rs as $u) {
			// $addturn[$k]['user_id'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
			$e[] = explode(":", $u['detail']);
			foreach ($e as $r) {
				$old = substr($r[1], 0, -4);
				$new = substr($r[2], 0, -7);
				$amount = $sum+$r[3];
			}
			$credit_rs[$k]['sum'] =  (floatval($amount));
			
			$k++;
		}
		//ปรับมือถอน
		$credit_out = $this->db->select('COUNT(action) AS count_detail,admin, user_id, detail, datetime, detail, action')
			->where('action', 'down')
			->where('datetime >=', $dt1)
			->where('datetime <=', $dt2)
			->get('log_edit_user_credit')->row();

		$creditout_rs    = $this->db->select('log_edit_user_credit.*')
			->where('log_edit_user_credit.datetime >=', $dt1)
			->where('log_edit_user_credit.datetime <=', $dt2)
			->where('log_edit_user_credit.action', 'down')
			->get('log_edit_user_credit')->result_array();

		$k = 0;
		$sum = 0;
		foreach ($creditout_rs as $u) {
			// $addturn[$k]['user_id'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
			$e[] = explode(":", $u['detail']);
			foreach ($e as $r) {
				$old = substr($r[1], 0, -4);
				$new = substr($r[2], 0, -7);
				$amount = $sum+$r[3];
			}
			$creditout_rs[$k]['rs'] = (floatval($amount));
			$k++;
		}
		// ฝากถอน
		$state = $this->db->select('
						SUM(CASE WHEN tb_statement.deposit > 0 THEN 1 ELSE 0 END)as num_dep,
						SUM(tb_statement.deposit) as sum_dep,
						SUM(CASE WHEN tb_statement.withdraw > 0 THEN 1 ELSE 0 END)as num_wit,
						SUM(tb_statement.withdraw) as sum_wit,	
							')

			->from('tb_statement')
			->where('tb_statement.status', 2)
			->where('tb_statement.dateCreate >=', $dt1)
			->where('tb_statement.dateCreate <=', $dt2)
			->get()->row();


		$call_af = $this->db->select('COUNT(id) as num_id , SUM(aff_turn) as sum_aff ,date_from')
					->where('date_to  >=' ,$dt1)
					->where('date_to  <=' ,$dt2)
					->get('log_cal_affiliate')->row();
		
					
		
		$data = [
			// แลกรางวัล
			'sum_point_ex' => 'จำนวนพ้อยที่ใช้แลก ' . number_format($exchang->sum_cost),
			'sum_cost'  => 'จำนวนเครดิตที่ได้: ' . number_format($exchang->sumpoint),

			// หมุนวงล้อ
			'num_spin' => 'จำนวนการหมุน: ' . $spin->count_spin . ' (ครั้ง)',
			'sum_point' => 'จำนวนพ้อย: ' . number_format($spin->sumpoint),

			// รายการเครดิตปรับมือเพิ่ม

			'num_credit_in' => 'จำนวนครดิตที่ปรับเพิ่ม: ' . $credit_in->count_detail,
			'sum_credit' =>  $credit_rs,



			// รายการเคดิสปรับมือลบ
			'num_credit_out' => 'จำนวนเครดิตที่ปรับลบ: ' . $credit_out->count_detail,
			'sum_credit_out' => $creditout_rs,

			//รายการฝาก-ถอน
			'sum_dep' => 'ยอดฝาก ' . number_format($state->sum_dep),

			'sum_wit' => 'ยอดถอน ' . number_format($state->sum_wit),


			//รายการกดรับ af

			'num_af' =>$call_af->num_id,
			'sum_af' => number_format($call_af->sum_aff,2),

		


		];
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $data);
		echo json_encode($re);
		die();


	}




	// function การค้นหาหน้าแลกรางวัล
	public function rs_aw()
	{
		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;

		$dend		= $dt1 + (24 * 60 * 60) + 1;
		$total      = 0;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {
			$exchange = $this->db->select('SUM(point) as sum_point, SUM(cost) as sum_cost ,create_time')
				->where('tb_exchange.create_time >=', $dt1)
				->where('tb_exchange.create_time <=', $dend)
				->get('tb_exchange')->row();

			$ste[$i]['sum_point'] = (intval($exchange->sum_point));
			$ste[$i]['sum_cost'] =  (intval($exchange->sum_cost));
			$ste[$i]['date'] = date("d-m-Y", $dt1);
			$dt1 	= $dt1 + (24 * 60 * 60);
			$dend 	= $dend + (24 * 60 * 60);
		}
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);
		echo json_encode($re);
		die();
	}

	//รายงานการกดรับ aff
	public function rs_callaf()
	{
		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$dend		= $dt1 + (24 * 60 * 60) + 1;
		$ste        = [];
		$sum_total_af = 0;
		$sum_total_count = 0;
		for ($i = 0; $i <= $count_day; $i++) {
			$aff = $this->db->select('COUNT(id) as COUNT_ROW,  SUM(aff_turn) as SUMAFF ,date_to')
				->where(' log_cal_affiliate.date_to  >=', $dt1)
				->where(' log_cal_affiliate.date_to  <=', $dend)
				->get(' log_cal_affiliate')->row();
			
			$ste[$i]['countaf'] = number_format($aff->COUNT_ROW);
			$ste[$i]['sum_af'] =  number_format($aff->SUMAFF,2);

			$ste[$i]['rs_countaf'] =  number_format($sum_total_count += $aff->COUNT_ROW); 
			$ste[$i]['rs_sum'] =  number_format($sum_total_af += $aff->SUMAFF,2); 
 			$ste[$i]['date'] = date("d-m-Y", $dt1);
			$dt1 	= $dt1 + (24 * 60 * 60);
			$dend 	= $dend + (24 * 60 * 60);
		}
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);
		echo json_encode($re);
		die();
	}

	public function rs_aff_detail($day)
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($day)));
		$dt2        = strtotime(date('d-m-Y 23:59:59', strtotime($day)));
		$aff = $this->db->select(' aff_turn,user_id, date_to')
				->where(' log_cal_affiliate.date_to  >=', $dt1)
				->where(' log_cal_affiliate.date_to  <=', $dt2)
				->order_by('log_cal_affiliate.date_to','DESC')
				->get(' log_cal_affiliate')->result_array();

		$data=[
			 'aff' => $aff
		];

		$this->load->view('report_cllaff_day',$data);


	}



	//function ผลลัพธ์การแลก
	public function rs_w($day)
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($day)));
		$dt2        = strtotime(date('d-m-Y 23:59:59', strtotime($day)));
		$data['ste'] = $this->db->select('*')->where('tb_exchange.create_time >=', $dt1)
			->where('tb_exchange.create_time <=', $dt2)
			->order_by('tb_exchange.create_time', 'desc')
			->get('tb_exchange')->result_array();

		$this->load->view('report_w', $data);
	}



	// function ค้นหาการหมุน spin
	public function rs_s()
	{

		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($this->input->post('dt2'))));


		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$dend		= $dt1 + (24 * 60 * 60) + 1;
		$total      = 0;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {
			$rs_sp = $this->db->select('COUNT(user_id) as num_user  , SUM(point) as sum_point , type,create_time')
				->where('type', 'spin')->where('create_time >=', $dt1)->where('create_time <=', $dend)->get('tb_point')
				->row();

			$ste[$i]['num_user'] = (intval($rs_sp->num_user));
			$ste[$i]['num_point'] = (intval($rs_sp->sum_point));
			$ste[$i]['date'] = date("d-m-Y", $dt1);
			$dt1 	= $dt1 + (24 * 60 * 60);
			$dend 	= $dend + (24 * 60 * 60);
		}
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);
		echo json_encode($re);
		die();
	}

	// function การแสดงข้อมูลการหมุนวงล้อ
	public function rssp_detail($day)
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($day)));
		$dt2        = strtotime(date('d-m-Y 23:59:59', strtotime($day)));
		$data['sp'] = $this->db->select('*')
			->where('type', 'spin')
			->where('status', 1)
			->where('create_time >=', $dt1)
			->where('create_time <=', $dt2)
			->order_by('create_time', 'DESC')
			->get('tb_point')
			->result_array();

		$this->load->view('report_sp', $data);
	}




	// function การค้าหาเพิ่มลบเคดิต ปรับมือ
	public function rs_cm()
	{

		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($this->input->post('dt2'))));
		$type = $this->input->post('type');
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$result_day = $count_day + 1;

		$dend		= $dt1 + (24 * 60 * 60) + 1;
		$total      = 0;
		$old     	= 0;
		$new        = 0;
		$amount     = 0;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {
			$rs_sp = $this->db->select('COUNT(detail) AS count_detail,admin, user_id, detail, datetime, action')
				->where('action', $type)
				->where('datetime >=', $dt1)
				->where('datetime <=', $dend)
				->get('log_edit_user_credit')->row();

			$ste[$i]['count_detail'] = (intval($rs_sp->count_detail));
			$ste[$i]['date'] = date("d-m-Y", $dt1);
			$dt1 	= $dt1 + (24 * 60 * 60);
			$dend 	= $dend + (24 * 60 * 60);
		}

		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste, 'type' => $type);
		echo json_encode($re);
		die();
	}

	// function การปรับเคดิตด้วยมือ
	public function rs_credit($day, $type)
	{
		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($day)));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($day)));

		if ($type == "up") {
			$title = 'การเพิ่มเครดิตด้วยมือ';
			$head  = 'จำนวนเครดิตที่เพิ่ม';
		} else {
			$title = 'การลบเครดิตด้วยมือ';
			$head  = 'จำนวนเครดิตที่ลบ';
		}

		$point    = $this->db->select('log_edit_user_credit.*')
			->where('log_edit_user_credit.datetime >=', $dt1)
			->where('log_edit_user_credit.datetime <=', $dt2)
			->where('log_edit_user_credit.action', $type)
			->order_by('log_edit_user_credit.datetime', 'DESC')
			->get('log_edit_user_credit')->result_array();

		$k = 0;
		$sum = 0;
		foreach ($point as $u) {
			// $addturn[$k]['user_id'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
			$e[] = explode(":", $u['detail']);
			foreach ($e as $r) {
				$old = substr($r[1], 0, -4);
				$new = substr($r[2], 0, -7);
				$amount = $r[3];
			}
			$point[$k]['old'] = $old;
			$point[$k]['new'] = $new;
			$point[$k]['sum'] = $sum + $amount;
			$point[$k]['rs'] = $amount;

			$point[$k]['time'] = date('d-m-Y H:i:s', $u['datetime']);
			$k++;
		}
		$data = [
			'point' => $point,
			'title' => $title,
			'head' => $head
		];
		$this->load->view('report_credit_day', $data);
	}


	public function rs_turn()
	{
		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$dend		= $dt1 + (24 * 60 * 60) + 1;
		$turn        = [];
		for ($i = 0; $i <= $count_day; $i++) {
			$tb_turn = $this->db->select('SUM(valid_amount) as sum_turn , SUM(payout) as sum_amount , SUM(company) as sum_company ,username,  created_time')
				->where('created_time >=', $dt1)
				->where('created_time <=', $dt2)
				->get('tb_turn')->row();

			$turn[$i]['sum_turn'] = (intval($tb_turn->sum_turn));
			$turn[$i]['sum_amount'] = (intval($tb_turn->sum_amount));
			$turn[$i]['sum_company'] = (intval($tb_turn->sum_company));
			$turn[$i]['date'] = date("d-m-Y", $dt1);
			$dt1 	= $dt1 + (24 * 60 * 60);
			$dend 	= $dend + (24 * 60 * 60);
		}
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $turn);
		echo json_encode($re);
		die();
	}


	public function rs_turn_d($day)
	{
		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($day)));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($day)));
		$turn = $this->db->select('valid_amount,  payout, company, username,created_time')
			->where('created_time >=', $dt1)
			->where('created_time <=', $dt2)
			->get('tb_turn')
			->result_array();

		$data = [
			'turn' => $turn,
			'title' => 'รายงานเทิร์น'
		];

		$this->load->view('viewrs_turn', $data);
	}

	//ฝาก ถอน
	public function report_aw_dw()
	{
		$this->load->view('report_aw_dw');
	}
	public function rp_us()
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$state 		= [];
		$dend		= $dt1 + (24 * 60 * 60) - 1;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {

			$state = $this->db->select('
						SUM(CASE WHEN tb_statement.deposit > 0 THEN 1 ELSE 0 END)as num_dep,
						SUM(tb_statement.deposit) as sum_dep,
						SUM(CASE WHEN tb_statement.withdraw > 0 THEN 1 ELSE 0 END)as num_wit,
						SUM(tb_statement.withdraw) as sum_wit,	
							')
				->from('tb_statement')
				->where('tb_statement.status', 2)
				->where('tb_statement.dateCreate >', $dt1)
				->where('tb_statement.dateCreate <', $dend)
				->get()->row();

			$ste[$i]['num_deposit'] = (intval($state->num_dep));
			$ste[$i]['sum_deposit'] = (floatval($state->sum_dep));
			$ste[$i]['num_withdraw'] = (intval($state->num_wit));
			$ste[$i]['sum_withdraw'] = (floatval($state->sum_wit));

			$ste[$i]['date'] = date("d-m-Y", $dt1);

			$dt1 	= $dt1 + (24 * 60 * 60);
			$dend 	= $dend + (24 * 60 * 60);
		}
		// print_r($ste); 
		// die;
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);

		echo json_encode($re);
		die();
	}

	public function report_rs($day, $type)
	{

		$dt1 = strtotime(date('Y-m-d 00:00:00', strtotime($day)));
		$dt2 = strtotime(date('Y-m-d 23:59:59', strtotime($day)));
		if ($type != 'withdraw') {


			$sql_dp = $this->db->select('tb_user.id,tb_statement.user_id,tb_statement.from_bank,tb_statement.deposit,tb_statement.dateCreate')
				->from('tb_user')
				->where('tb_statement.status', 2)
				->where('tb_statement.deposit >', 0)
				->where('tb_statement.dateCreate >=', $dt1)
				->where('tb_statement.dateCreate <=', $dt2)
				->order_by('tb_statement.dateCreate', 'DESC')
				->join('tb_statement', 'tb_statement.user_id = tb_user.id')
				->get()->result_array();

			$data = [
				'head' => 'รายการฝาก',
				'title' => 'ลำดับ',
				'user'  => 'ยูสเซอร์',
				'bank_short' => 'ธนาคาร',
				'money' => 'รายการฝาก',
				'date' => 'วัน เวลา',
				'sql2' => $sql_dp,
				'type_b' => 'deposit'
			];
			$this->load->view('report_rs_dw', $data);
		} else {
			$sql_wt = $this->db->select('tb_user.id,tb_statement.user_id,tb_statement.from_bank,tb_statement.withdraw,tb_statement.dateCreate')
				->from('tb_user')
				->where('tb_statement.status', 2)
				->where('tb_statement.withdraw >', 0)
				->where('tb_statement.dateCreate >=', $dt1)
				->where('tb_statement.dateCreate <=', $dt2)
				->order_by('tb_statement.dateCreate', 'DESC')
				->join('tb_statement', 'tb_statement.user_id = tb_user.id')
				->get()->result_array();
			$data = [
				'head' => 'รายการถอน',
				'title' => 'ลำดับ',
				'user'  => 'ยูสเซอร์',
				'bank_short' => 'ธนาคาร',
				'money' => 'รายการถอน',
				'date' => 'วัน เวลา',
				'sql1' => $sql_wt,
				'type_b' => 'widthdraw'
			];
			$this->load->view('report_rs_dw', $data);
		}
	}
}

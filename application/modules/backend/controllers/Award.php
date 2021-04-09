<?php
class Award extends MY_Controller
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

	public function index()
	{
		$this->load->view('report_award');
	}
	public function report_spin()
	{
		$data['point'] = $this->db->select('*')
			->where('type', 'spin')
			->where('status', 1)
			->order_by('create_time', 'DESC')
			->limit(500)
			->get('tb_point')
			->result_array();
		$this->load->view('report_spin', $data);
	}
	public function rp_us()
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$state 		= [];
		$dend		= $dt1 + (24 * 60 * 60) - 1;
		$total      = 0;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {

			$state = $this->db->select('
                        COUNT(tb_exchange.id) as num_id,
                        SUM(tb_exchange.point) as sum_point
							')
				->where('tb_exchange.status', 2)
				->where('tb_exchange.create_time >', $dt1)
				->where('tb_exchange.create_time <', $dend)
				->get('tb_exchange')->row();

			$ste[$i]['num_id'] = (intval($state->num_id));
			$ste[$i]['sum_point'] = (floatval($state->sum_point));
			$ste[$i]['date'] = date("d-m-Y", $dt1);

			$dt1 	= $dt1 + (24 * 60 * 60);
			$dend 	= $dend + (24 * 60 * 60);
		}
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);

		echo json_encode($re);
		die();
	}
	public function report_award()
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$state 		= [];
		$ste        = [];

		for ($i = 0; $i <= $count_day; $i++) {
			$state = $this->db->select('	
					tb_exchange.id_user as user,
					tb_exchange.point as price,
					tb_exchange.cost as cost,
					tb_exchange.create_time as admin_datetime,
					tb_login.name as nameadmin')
				->join('tb_login', 'tb_login.id = tb_exchange.admin_id', 'left')
				->where('tb_exchange.status', 2)
				->where('tb_exchange.create_time >=', $dt1)
				->where('tb_exchange.create_time <=', $dt2)
				->get('tb_exchange')->result_array();
			//						 echo "<pre>";
			//						 print_r($state);
			//						 die();
			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $state);
			// echo "<pre>";
			// 				print_r($re);
			// 				die();

		}
		if (empty($state)) {

			for ($i = 0; $i <= $count_day; $i++) {
				$ste = $this->db->select('	
					tb_exchange.id_user as user,
					tb_exchange.point as price,
					tb_exchange.cost as cost,
					tb_exchange.admin_datetime as admin_datetime,
					tb_exchange.admin_id as nameadmin')
					->where('tb_exchange.status', 2)
					->where('tb_exchange.admin_datetime >=', $dt1)
					->where('tb_exchange.admin_datetime <=', $dt2)
					->get('tb_exchange')->result_array();
				$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);
			}
		}



		echo json_encode($re);
		die();
	}

	public function report_findspin()
	{


		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$user 		= $this->input->post('user');
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$state 		= [];
		if (empty($user)) {
			for ($i = 0; $i <= $count_day; $i++) {
				$state = $this->db->where('type ', 'spin')
					->where('create_time >', $dt1)
					->where('create_time <', $dt2)
					->order_by('create_time', 'DESC')
					->get('tb_point')->result_array();
			}
		} else {
			for ($i = 0; $i <= $count_day; $i++) {
				$state = $this->db->where('user_id', $user)
					->where('type ', 'spin')
					->where('create_time >', $dt1)
					->where('create_time <', $dt2)
					->order_by('create_time', 'DESC')
					->get('tb_point')->result_array();
			}
		}

		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $state);


		echo json_encode($re);
		die();
	}

	public function report_aw()
	{
		$this->load->view('report_aw');
	}

	public function rs_aw()
	{
		$dt1 = strtotime(date('Y-m-d 00:00:00',strtotime($this->input->post('dt1'))));
		$dt2 = strtotime(date('Y-m-d 23:59:59',strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1) + 1) / (24 * 60 * 60)) - 1;
		$result_day = $count_day + 1;

		$dend		= $dt1 + (24*60*60)+1;
		$total      = 0;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {
			$exchange = $this->db->select('SUM(point) as sum_point, SUM(cost) as sum_cost ,create_time')
							->where('tb_exchange.create_time >=', $dt1)
							->where('tb_exchange.create_time <=', $dend)
							->get('tb_exchange')->row();
			$ste[$i]['sum_point'] = (intval($exchange->sum_point));
			$ste[$i]['sum_cost'] =  (intval($exchange->sum_cost));			
			$ste[$i]['date'] = date("d-m-Y",$dt1);
			$dt1 	= $dt1 + (24*60*60);
			$dend 	= $dend + (24*60*60);
		}
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);
		echo json_encode($re);
		die();

	}

	public function rs_w($day){
		
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($day)));
		$dt2        = strtotime(date('d-m-Y 23:59:59',strtotime($day)));
		// print_r($dt1).'<br>';
		// print_r($dt2).'<br>';

		$data['ste'] = $this->db->select('*')->where('tb_exchange.create_time >=' ,$dt1)
					   ->where('tb_exchange.create_time <=' ,$dt2)
					   ->order_by('tb_exchange.create_time','desc')
					   ->get('tb_exchange')->result_array();
	
		// print_r($data['ste']);
		$this->load->view('report_w',$data);


		
	}
}

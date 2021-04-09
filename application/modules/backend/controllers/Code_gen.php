<?php

use function PHPSTORM_META\type;

class Code_gen extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('getapi_model');
		$this->load->model('backend_model');
		$this->load->library('backend/backend_library');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();
	}
	public function index()
	{
		$data['code'] = $this->db->order_by('id', 'DESC')->get('tb_code')->result_array();
		/* echo '<pre>';
		print_r($data);
		die; */
		$this->load->view('code', $data);
	}

	public function save_code()
	{
		$code = $this->input->post('code');
		$bonus = $this->input->post('bounus');
		$percent = $this->input->post('percent');
		$turnover = $this->input->post('turnover');
		$first_deposit = $this->input->post('first_dep');
		$time_start = $this->input->post('time_start');
		$time_end = $this->input->post('time_end');
		$user = $this->input->post('user');


		$check_code = $this->db->where('code', $code)->get('tb_code');
		if ($check_code->num_rows() == 1) {
			$re = array('code' => 2, 'title' => 'Code ถูกใช้งานแล้ว', 'msg' => 'กรุณา generate ใหม่');
		} else {
			$arr_insert = array(
				'code' => $code,
				'credit_bonus' => $bonus,
				'credit_percent' => $percent,
				'user' => $user,
				'first_deposit' => $first_deposit,
				'turnover' => $turnover,
				'admin_create' => $this->session->userdata['admin']['username'],
				'time_start' => strtotime($time_start),
				'time_end' => strtotime($time_end),
				'status' => 1
			);
			if ($this->db->insert('tb_code', $arr_insert)) {
				$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย', 'data' => $arr_insert);
			} else {
				$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่');
			}
		}
		echo json_encode($re);
		die;
	}
}

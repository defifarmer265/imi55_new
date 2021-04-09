<?php

use function PHPSTORM_META\type;

class Events_back extends MY_Controller
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
		$data['groupuser'] = $this->getgroupuser();
		$data['event'] = $this->load_event();
		$this->load->view('setevents', $data);
	}

	public function save_event()
	{
		$file = $_FILES['file'];

		$user_group = '';
		$i = 0;
		foreach ($this->input->post('user_group') as $key => $value) {
			if ($i + 1 == sizeof($this->input->post('user_group'))) {
				$user_group .= $value;
			} else {
				$user_group .= $value . ',';
			}
			$i++;
		}

		$data = [
			'name' => $this->input->post('name'),
			'type_turnover' => $this->input->post('type_turn'),
			'turnover' => $this->input->post('turn'),
			'credit' => $this->input->post('credit'),
			'percent'=> $this->input->post('percent'),
			'amount_max' => $this->input->post('amount_max'),
			'point' => $this->input->post('point'),
			'time_start' => strtotime($this->input->post('time_start')),
			'time_end' => strtotime($this->input->post('time_end')),
			'user' => $this->input->post('user'),
			'user_group' =>  $user_group,
			'deposit' => $this->input->post('deposit'),
			'count' => $this->input->post('count'),
			'count_max' => $this->input->post('count'),
			'detail_event' => $this->input->post('detail'),
			'link_img' => $file['name'],
			'status' => 1
		];

		$save = $this->db->insert('tb_event', $data);

		/* ------------------------------log_event_create ------------------------ */
		$webname = $this->db->where('name', 'web')->get('setting')->row()->code;
		$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
		$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
		$hostname = $hostname[0]['hostname'];

		$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
		$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
		$dbname = $dbname[0]['database_name'];
		$time = time();
		$sql = "INSERT INTO log_event_create (admin, event_name,datetime)
		VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $this->input->post('name') . "','" . $time . "')";
		if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
		} else {

			$sql = "CREATE TABLE log_event_create (
			id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			admin VARCHAR(20) NOT NULL,
			event_name VARCHAR(100) NULL,
			datetime INT(20) NOT NULL
			) CHARACTER SET utf8 COLLATE utf8_general_ci;";
			$this->backend_library->query_sql($hostname, $dbname, $sql);

			$sql = "INSERT INTO log_event_create (admin, event_name,datetime)
			VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $this->input->post('name') . "','" . $time . "')";
			$this->backend_library->query_sql($hostname, $dbname, $sql);
		}
		/* ------------------------------ end log_event_create ------------------------ */

		if ($save) {
			$config['upload_path']          = realpath(APPPATH . '../public/event/');
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
			$config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
			$config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
			$config['file_name'] =  $file['name'];
			$this->upload->initialize($config);
			$this->upload->do_upload('file');
			echo json_encode(array('status' => true, 'data' => $data));
		} else {
			echo json_encode(array('status' => false, 'data' => ''));
		}

		die;
	}

	public function load_event()
	{
		return json_encode($this->db->get('tb_event')->result_array());
	}
	public function getgroupuser()
	{
		return json_encode($this->db->get('tb_group')->result_array());
	}

	public function delpro()
	{
		if ($this->db->where('id', $this->input->post('id'))->delete('tb_event')) {
			echo json_encode(array('status' => true));
		} else {
			echo json_encode(array('status' => false));
		}
		die;
	}
	public function updataStatus()
	{
		if ($this->db->where('id', $this->input->post('id'))->update('tb_event', array('status' => ($this->input->post('ch') == "true") ? 1 : 0))) {
			echo json_encode(array('status' => true));
		} else {
			echo json_encode(array('status' => false));
		}
		die;
	}

	public function report()
	{
		$data['event'] = $this->db->select('tb_event.*')->get('tb_event')->result_array();
		$this->load->view('report_event',$data);

	}
}

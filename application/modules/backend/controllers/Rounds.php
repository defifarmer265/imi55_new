<?php
class Rounds extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('getapi_model');
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
		$query = $this->db->get('tb_admin_rounds');
		$data['rounds'] = $query->result_array();
		$data['menu']  = 'admin_rounds';
		$this->load->view('rounds', $data);
	}
	public function cre_rounds()
	{
		$check_rounds =  $this->db->where('rounds_desc', $this->input->post('rounds_desc'))->get('tb_admin_rounds');
		if ($check_rounds->num_rows() <= 0) {
			if ($rounds_desc = $this->input->post('rounds_desc')) {
				$dataCreate = array(
					'rounds_desc' 	=> $rounds_desc,
					'time_start' 	=> $this->input->post('rounds_start'),
					'time_end' 	=> $this->input->post('rounds_end')
				);

				if ($this->db->insert('tb_admin_rounds', $dataCreate)) {
					$re = array('msg' => 'สำเร็จ', 'code' => 1);
				}
			} else {
				$re = array('msg' => 'มีปัญหา ข้อมูลไม่ครบ', 'code' => 0);
			}
		} else {
			$re = array('msg' => 'รอบซ้ำ', 'code' => 0);
		}

		echo json_encode($re);
		die();
	}
	public function update_Rounds()
	{
		// print_r($this->input->post());
		// die;
		if ($this->input->post('id')) {
			$id   = $this->input->post('id');
			$rounds_desc = $this->input->post('rounds_desc');
			$time_start = $this->input->post('time_start');
			$time_end = $this->input->post('time_end');
			$old = 'old : ' . $rounds_desc . ' เริ่มเวลา : ' . $time_start . 'น. ถึงเวลา : ' . $time_end . 'น.';

			if ($rounds_desc != "" && $time_start != "" &&  $time_end != "") {
				$arr = array(
					'rounds_desc' => $rounds_desc,
					'time_start' => $time_start,
					'time_end' => $time_end
				);
				$this->db->where('id', $id)->update('tb_admin_rounds', $arr);
				$round_new = $this->db->where('id', $id)->get('tb_admin_rounds')->row();
				$new = 'new : ' . $round_new->rounds_desc . ' เริ่มเวลา : ' . $round_new->time_start . 'น. ถึงเวลา : ' . $round_new->time_end . 'น.';

				/*-------------------------- log_round_edit----------------------------------- */
				$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

				$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$hostname = $hostname[0]['hostname'];

				$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$dbname = $dbname[0]['database_name'];
				$time = time();

				$sql = "INSERT INTO log_round_edit (admin,detail,datetime) 
							VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $old . $new . "','" . $time . "')";
				if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
				} else {

					$sql = "CREATE TABLE log_round_edit (
						id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						admin VARCHAR(20) NOT NULL,
						detail VARCHAR(255) NOT NULL,
						datetime INT(20) NOT NULL
						) CHARACTER SET utf8 COLLATE utf8_general_ci;";
						
					$this->backend_library->query_sql($hostname, $dbname, $sql);
					$sql = "INSERT INTO log_round_edit (admin,detail,datetime) 
							VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $old . $new . "','" . $time . "')";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
				}
				/*--------------------------end  log_round_edit----------------------------------- */

				$re = array('msg' => 'เรียบร้อย', 'code' => 1, 'title' => 'สำเร็จ');
			} else {
				$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบ', 'code' => 0, 'title' => 'ไม่สำเร็จ');
			}
		} else {
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน', 'code' => 0, 'title' => 'ไม่สำเร็จ');
		}
		echo json_encode($re);
		die();
	}
	function delete_rounds()
	{
		if ($this->input->post('id')) {
			$id 	= $this->input->post('id');
			$sql	= $this->db->where('id', $id)->get('tb_admin_rounds');
			$name_round = $sql->row()->rounds_desc;
			if ($sql->num_rows() == 1) {
				// if (true) {
				if ($this->db->where('id', $id)->delete('tb_admin_rounds')) {

					/*-------------------------- log_round_delete----------------------------------- */
					$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

					$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
					$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
					$hostname = $hostname[0]['hostname'];

					$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
					$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
					$dbname = $dbname[0]['database_name'];
					$time = time();

					$sql = "INSERT INTO log_round_delete (admin,round,datetime) 
							VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $name_round . "','" . $time . "')";
					if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
					} else {

						$sql = "CREATE TABLE log_round_delete (
							id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							admin VARCHAR(20) NOT NULL,
							round VARCHAR(20) NOT NULL,
							datetime INT(20) NOT NULL
							) CHARACTER SET utf8 COLLATE utf8_general_ci;";

						$this->backend_library->query_sql($hostname, $dbname, $sql);
						$sql = "INSERT INTO log_round_delete (admin,round,datetime) 
							    VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $name_round . "','" . $time . "')";
						$this->backend_library->query_sql($hostname, $dbname, $sql);
					}
					/*--------------------------end  log_round_delete----------------------------------- */

					$re = array('code' => 1, 'msg' => '', 'title' => 'ลบสำเร็จ');
				} else {
					$re = array('code' => 0, 'msg' => 'ไม่สำเร็จ', 'title' => 'ลบไม่สำเร็จ');
				}
			} else {
				$re = array('titel' => 'ไม่มีข้อมูล', 'msg' => 'ไม่มีกะนี้นี้', 'code' => 0);
			}
		} else {
			$re = array('titel' => 'ไม่มีข้อมูล', 'msg' => 'ไม่มี', 'code' => 0);
		}
		echo json_encode($re);
		die();
	}
	public function read_checking()
	{
		$id = $this->input->post('id');
		$result = $this->db->where('id', $id)->get('tb_admin_rounds')->row();
		echo json_encode($result);
		die;
	}
}

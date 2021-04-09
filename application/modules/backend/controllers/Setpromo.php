<?php

use function PHPSTORM_META\type;

class Setpromo extends MY_Controller
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
		$data['promo'] = $this->loadpromo();
		$this->load->view('setpromotion', $data);
	}

	public function savepro()
	{
		// echo '<pre>';
		// print_r($this->input->post());
		// die;
		$file = $_FILES['img'];
		$user_group = '';
		$day_show = '';
		$i = 0;
		foreach ($this->input->post('user_group') as $key => $value) {
			if ($i + 1 == sizeof($this->input->post('user_group'))) {
				$user_group .= $value;
			} else {
				$user_group .= $value . ',';
			}
			$i++;
		}
		$j = 0;
		foreach ($this->input->post('day_show') as $key => $value) {
			if ($j + 1 == sizeof($this->input->post('day_show'))) {
				$day_show .= $value;
			} else {
				$day_show .= $value . ',';
			}
			$j++;
		}
		$typegame = $this->input->post('typegame');
		switch ($typegame) {
			case '0':
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = $this->input->post('num');
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;
			case '1':
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = 0;
					$game =  $this->input->post('num');
					$sum_turn = 0;
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;
			case '2':
				if ($this->input->post('num') != 0) {
					$casino = $this->input->post('num');
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}

				break;
			case '3':
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = $this->input->post('num');
					$game = 0;
					$sum_turn = 0;
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;

			default:
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = $this->input->post('num');
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;
		}
		$data = [
			'name' => $this->input->post('name'),
			'casino' => $casino,
			'sport' => $sport,
			'game' => $game,
			'sum_turn' => $sum_turn,
			'amount_turn' => $amount_turn,
			'time_start' => strtotime($this->input->post('time_start')),
			'time_end' => strtotime($this->input->post('time_end')),
			'day_show' => $day_show,
			'time_start_show' =>  date('Hi', strtotime($this->input->post('time_start_show'))),
			'time_end_show' => date('Hi', strtotime($this->input->post('time_end_show'))),
			'count_pro' => $this->input->post('count_pro'),
			'detail_pro' => $this->input->post('detail_pro'),
			'percent' => $this->input->post('percent'),
			'bonus' => $this->input->post('bonus'),
			'min_creadit' => $this->input->post('min_creadit'),
			'type' => $this->input->post('type'),
			'amount_max' => $this->input->post('amount_max'),
			'user_group' =>  $user_group,
			'link_img' => $file['name'],
			'status' => '1'
		];
		// echo '<pre>';
		// print_r($data);
		// die;
		$save = $this->db->insert('tb_promotion', $data);

		/* ------------------------------log_promotion_create ------------------------ */
		$webname = $this->db->where('name', 'web')->get('setting')->row()->code;
		$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
		$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
		$hostname = $hostname[0]['hostname'];

		$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
		$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
		$dbname = $dbname[0]['database_name'];
		$time = time();
		$sql = "INSERT INTO log_promotion_create (admin, promotion_name,datetime)
		VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $this->input->post('name') . "','" . $time . "')";
		if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
		} else {

			$sql = "CREATE TABLE log_promotion_create (
						id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						admin VARCHAR(20) NOT NULL,
						promotion_name VARCHAR(100) NULL,
						datetime INT(20) NOT NULL
						) CHARACTER SET utf8 COLLATE utf8_general_ci;";
			$this->backend_library->query_sql($hostname, $dbname, $sql);

			$sql = "INSERT INTO log_promotion_create (admin, promotion_name,datetime)
			VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $this->input->post('name') . "','" . $time . "')";
			$this->backend_library->query_sql($hostname, $dbname, $sql);
		}
		/* ------------------------------ end log_promotion_create ------------------------ */

		$data['groupuser'] = $this->getgroupuser();
		if ($save) {
			$config['upload_path']          = realpath(APPPATH . '../public/promotion/');
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
			$config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
			$config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
			$config['file_name'] =  $file['name'];
			$this->upload->initialize($config);
			$this->upload->do_upload('img');
			redirect(base_url('backend/setpromo'), 'refresh');
		} else {
			echo '<script> alert(ERROR) </script>';
		}


		die;
	}

	public function updatepro()
	{
		// echo '<pre>';
		// print_r($this->input->post());
		// die;
		$user_group = '';
		$day_show = '';
		$i = 0;
		foreach ($this->input->post('user_group') as $key => $value) {
			if ($i + 1 == sizeof($this->input->post('user_group'))) {
				$user_group .= $value;
			} else {
				$user_group .= $value . ',';
			}
			$i++;
		}
		$j = 0;
		foreach ($this->input->post('day_show') as $key => $value) {
			if ($j + 1 == sizeof($this->input->post('day_show'))) {
				$day_show .= $value;
			} else {
				$day_show .= $value . ',';
			}
			$j++;
		}
		$typegame = $this->input->post('typegame');
		switch ($typegame) {
			case '0':
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = $this->input->post('num');
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;
			case '1':
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = 0;
					$game =  $this->input->post('num');
					$sum_turn = 0;
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;
			case '2':
				if ($this->input->post('num') != 0) {
					$casino = $this->input->post('num');
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}

				break;
			case '3':
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = $this->input->post('num');
					$game = 0;
					$sum_turn = 0;
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;

			default:
				if ($this->input->post('num') != 0) {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = $this->input->post('num');
					$amount_turn = 0;
				} else {
					$casino = 0;
					$sport = 0;
					$game = 0;
					$sum_turn = 0;
					$amount_turn = $this->input->post('credit_turn');
				}
				break;
		}
		$data = [
			'name' => $this->input->post('name'),
			'casino' => $casino,
			'sport' => $sport,
			'game' => $game,
			'sum_turn' => $sum_turn,
			'amount_turn' => $amount_turn,
			'day_show' => $day_show,
			'time_start_show' =>  date('Hi', strtotime($this->input->post('time_start_show'))),
			'time_end_show' => date('Hi', strtotime($this->input->post('time_end_show'))),
			'time_start' => strtotime($this->input->post('time_start')),
			'time_end' => strtotime($this->input->post('time_end')),
			'count_pro' => $this->input->post('count_pro'),
			'detail_pro' => $this->input->post('detail_pro'),
			'percent' => $this->input->post('percent'),
			'bonus' => $this->input->post('bonus'),
			'min_creadit' => $this->input->post('min_creadit'),
			'type' => $this->input->post('type'),
			'amount_max' => $this->input->post('amount_max'),
			'user_group' =>  $user_group,
		];
		if (isset($_FILES['img']) && $_FILES['img']['name'] != '') {
			$file = $_FILES['img'];
			$data['link_img'] = $file['name'];
		}


		$save = $this->db->where('id', $this->input->post('idedit'))->update('tb_promotion', $data);
		$data['groupuser'] = $this->getgroupuser();
		if ($save) {
			if (isset($_FILES['img']) && $_FILES['img']['name'] != '') {
				$config['upload_path']          = realpath(APPPATH . '../public/promotion/');
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
				$config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
				$config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
				$config['file_name'] =  $file['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('img');
			}
			redirect(base_url('backend/setpromo'), 'refresh');
		} else {
			echo '<script> alert(ERROR) </script>';
		}

		die;
	}
	public function loadpromo()
	{
		// return json_encode($this->db->where('status',1)->get('tb_promotion')->result_array());
		return json_encode($this->db->get('tb_promotion')->result_array());
	}
	public function getgroupuser()
	{
		return json_encode($this->db->get('tb_group')->result_array());
	}

	public function delpro()
	{

		if ($this->db->where('id', $this->input->post('id'))->delete('tb_promotion')) {
			echo json_encode(array('status' => true));
		} else {
			echo json_encode(array('status' => false));
		}
		die;
	}
	public function updataStatus()
	{

		if ($this->db->where('id', $this->input->post('id'))->update('tb_promotion', array('status' => ($this->input->post('ch') == "true") ? 1 : 0))) {
			echo json_encode(array('status' => true));
		} else {
			echo json_encode(array('status' => false));
		}
		die;
	}

	// ============ report promotion

	public function report_promo()
	{
		$data['promotion'] = $this->db
			->get('tb_promotion')
			->result_array();
		$i = 0;
		foreach ($data['promotion'] as $dt) {
			$data['promotion'][$i]['count_log'] = $this->db->select('COUNT(promotion_id) as count')->where('promotion_id', $dt['id'])->get('log_promotion')->row()->count;
			$i++;
		}
		$this->load->view('report_promotion', $data);
	}
}

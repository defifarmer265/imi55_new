<?php

use function PHPSTORM_META\type;

class Ranking extends MY_Controller
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
		$data['rank'] = $this->db->select('*')->get('tb_rank')->result_array();
		$data['user'] = $this->get_member();
		$this->load->view('ranking_view', $data);
	}

	// ============ report 

	public function get_member()
	{

		if (empty($this->input->post('Per_Page'))) {
			$chf = true;
			$Page = 1;
			$Per_Page = 10;
			// $Search = '';
			$rank = 1;
		} else {
			$chf = false;
			$Page = $this->input->post('Page');
			$Per_Page = $this->input->post('Per_Page');
			// $Search = $this->input->post('Search');
			$rank = $this->input->post('rank');
		}

		$getNum_Rows = $this->db
			->select('*')
			->join('tb_rank', 'tb_rank.id = tb_user_rank.id_rank')
			->where('tb_rank.id', $rank)
			->get('tb_user_rank');
		$Num_Rows = $getNum_Rows->num_rows();


		if ($Page == 1) {
			$skip = 0;
		} else {
			$skip = $Per_Page * ($Page - 1);
		}
		$user = $this->db
			->select('*')
			->join('tb_rank', 'tb_rank.id = tb_user_rank.id_rank')
			->where('tb_rank.id', $rank)
			->limit($Per_Page, $skip)
			->order_by('tb_user_rank.id', 'ASC')
			->get('tb_user_rank');

		$d_user = $user->result_array();

		if ($Num_Rows <= $Per_Page) {
			$Num_Pages = 1;
		} else if (($Num_Rows % $Per_Page) == 0) {
			$Num_Pages = ($Num_Rows / $Per_Page);
		} else {
			$Num_Pages = ($Num_Rows / $Per_Page) + 1;
			$Num_Pages = (int)$Num_Pages;
		}
		$data = array(
			'user' => $d_user,
			'Num_Rows' => $Num_Rows,
			'Num_Pages' => $Num_Pages,
			'Page' => $Page,
			'Per_Page' => $Per_Page
		);

		if ($chf) {
			return json_encode($data);
		} else {
			echo json_encode($data);
			die;
		}
	}

	public function editrank()
	{

		$rank = $this->db->where('id', $this->input->post('idedit'))->get('tb_rank')->row();
		$old = 'ชื่อ : ' . $rank->name . ' เทิร์น : ' . $rank->trunover . ' พ้อย : ' . $rank->point . ' สปิน : ' . $rank->spin . ' sale : ' . $rank->sale . ' พรีเมี่ยม : ' . $rank->reward_premium . ' exclusive : ' . $rank->reward_exclusive . ' รูป : ' . $rank->img_link;

		$data = [
			'name' => $this->input->post('nameRank'),
			'trunover' => $this->input->post('trunoverRank'),
			'point' => $this->input->post('pointRank'),
			'spin' => $this->input->post('spinRank'),
			'sale' => $this->input->post('saleRank'),
			'reward_premium' => $this->input->post('reward_premiumRank'),
			'reward_exclusive' => $this->input->post('reward_exclusiveRank'),
		];
		if (isset($_FILES['file'])) {
			$file = $_FILES['file'];
			$data['img_link'] = $file['name'];
		}
		$save = $this->db->where('id', $this->input->post('idedit'))->update('tb_rank', $data);
		if ($save) {
			if (isset($_FILES['file'])) {
				$config['upload_path']          = realpath(APPPATH . '../public/rank/');
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
				$config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
				$config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
				$config['file_name'] =  $file['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('file');
			}
			if(!isset($_FILES['file'])){
				$data['img_link'] =  $rank->img_link;
			}
			$new = 'ชื่อ : ' . $data['name'] . ' เทิร์น : ' . $data['trunover'] . ' พ้อย : ' . $data['point'] . ' สปิน : ' . $data['spin'] . ' sale : ' . $data['sale'] . ' พรีเมี่ยม : ' . $data['reward_premium'] . ' exclusive : ' . $data['reward_exclusive'] . ' รูป : ' . $data['img_link'];

			/*-------------------------- log_ranking----------------------------------- */
			$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

			$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
			$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
			$hostname = $hostname[0]['hostname'];

			$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
			$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
			$dbname = $dbname[0]['database_name'];
			$time = time();

			$sql = "INSERT INTO log_ranking (admin,old_detail,new_detail,datetime)  
									VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $old . "','" . $new . "','" . $time . "')";
			if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
			} else {

				$sql = "CREATE TABLE log_ranking (
									 id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
									 admin VARCHAR(20) NOT NULL,
									 old_detail VARCHAR(255) NOT NULL,
									 new_detail VARCHAR(255) NOT NULL,
									 datetime INT(20) NOT NULL
									 ) CHARACTER SET utf8 COLLATE utf8_general_ci";
				$this->backend_library->query_sql($hostname, $dbname, $sql);

				$sql = "INSERT INTO log_ranking (admin,old_detail,new_detail,datetime)  
									VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $old . "','" . $new . "','" . $time . "')";

				$this->backend_library->query_sql($hostname, $dbname, $sql);
			}
			/*--------------------------end  log_ranking----------------------------------- */

			echo json_encode(array('status' => true, 'data' => $data));
		} else {
			echo json_encode(array('status' => false, 'data' => ''));
		}

		die;
	}

	public function addrank()
	{
		$file = $_FILES['file'];
		$data = [
			'name' => $this->input->post('nameRank'),
			'trunover' => $this->input->post('trunoverRank'),
			'point' => $this->input->post('pointRank'),
			'spin' => $this->input->post('spinRank'),
			'sale' => $this->input->post('saleRank'),
			'reward_premium' => $this->input->post('reward_premiumRank'),
			'reward_exclusive' => $this->input->post('reward_exclusiveRank'),
			'img_link' => $file['name']
		];
		$save = $this->db->insert('tb_rank', $data);
		if ($save) {
			if (isset($_FILES['file'])) {
				$config['upload_path']          = realpath(APPPATH . '../public/rank/');
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
				$config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
				$config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
				$config['file_name'] =  $file['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('file');
			}
			echo json_encode(array('status' => true, 'data' => $data));
		} else {
			echo json_encode(array('status' => false, 'data' => ''));
		}

		die;
	}



	public function delrank()
	{

		$save = $this->db->where('id', $this->input->post('id'))->delete('tb_rank');
		if ($save) {
			echo json_encode(array('status' => true));
		} else {
			echo json_encode(array('status' => false));
		}

		die;
	}
}

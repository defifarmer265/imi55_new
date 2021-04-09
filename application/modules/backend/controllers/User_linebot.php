<?php
class User_linebot extends MY_Controller
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
		$user = $this->db->distinct()
							->select('line,username')
							->where('line !=','')
							->get('tb_user')->result_array();

		$line_id = $this->db->distinct()
							->select('line_id,tel,create_time')
							->where('status !=',0)
							->where('line_id !=','')
							->where('create_time !=','')
							->get('tb_line')->result_array();

						$data = array(
								'user' => $user,
								'line_id' =>$line_id
									);
		// print_r($user); echo '<pre>';
		// die;
		$this->load->view('report_user_linebot',$data);
	}
}

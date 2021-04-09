<?php
class Log_line extends MY_Controller
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
		$this->load->view('report_num_log_line');
	}
	public function rp_us()
	{
		$dt1 		= strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
		$dt2 		= strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
		$count_day 	= ((($dt2 - $dt1)+1)/(24*60*60))-1;
		$state 		= [];
		$dend		= $dt1 + (24*60*60)-1;
		$ste        = [];
		for ($i = 0; $i <= $count_day; $i++) {

            $state = $this->db->select('COUNT(username) as num_user')
                                    ->where('log_line.actionType=','user auth login successfully')
                                    ->where('log_line.create_time >', $dt1)
                                    ->where('log_line.create_time <', $dend)
                                    ->get('log_line')->row();

			$ste[$i]['num_user'] = (intval($state->num_user));
			// $ste[$i]['username'] = $state->name;
			$ste[$i]['date'] = date("d-m-Y",$dt1);
			
			$dt1 	= $dt1 + (24*60*60);
			$dend 	= $dend + (24*60*60);
		}
            // print_r($ste);
            // die;

		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $ste);

		echo json_encode($re);
		die();
	}
}



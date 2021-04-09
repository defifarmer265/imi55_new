<?php
class Dw_linebot extends MY_Controller
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
		$this->load->view('report_dw_linebot');
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

			$state = $this->db->select('
						SUM(CASE WHEN tb_statement.deposit > 0 THEN 1 ELSE 0 END)as num_dep,
						SUM(tb_statement.deposit) as sum_dep,
						SUM(CASE WHEN tb_statement.withdraw > 0 THEN 1 ELSE 0 END)as num_wit,
						SUM(tb_statement.withdraw) as sum_wit,	
							')
						->from('tb_statement')
						->join('tb_user','tb_user.id = tb_statement.user_id')
						->where('tb_user.line !=','')
						->where('tb_statement.status', 2)
						->where('tb_statement.dateCreate >', $dt1)
						->where('tb_statement.dateCreate <', $dend)
						->get()->row();

						$ste[$i]['num_deposit'] = (intval($state->num_dep));
						$ste[$i]['sum_deposit'] = (floatval($state->sum_dep));
						$ste[$i]['num_withdraw'] = (intval($state->num_wit));
						$ste[$i]['sum_withdraw'] = (floatval($state->sum_wit));
					
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



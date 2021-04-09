<?php

class Ticked extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('getapi_model');
		$this->load->library('backend_library');
		$this->load->model('api/api_model');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();
	}

	public function index()
	{	
		$this->load->view('ticked');
	}

	public function get_tickeds()
	{
		$vendor = $this->backend_library->vendor();

		$start_date	= strtotime($this->input->post('sdate'));
		$end_date = strtotime($this->input->post('edate'));

		$us = $this->input->post('user');
		// echo'<pre>';print_r($us);die;
		$user_r = $this->db->where('id', $us)->get('tb_user')->row(); //เอาข้อมูล turnovers ของไอดีนี้มา

		$data_sent = json_encode(array(
			'query' => (array(
				'tb_name' => 'turnovers', //$this->getapi_model->agent() //Turnovers //ztzz361
				'where' => array(
					"Operators" => array(
						"and" => array("data" => [
							array(                 //  >=               <
								"imiTime" => array('$gte' => $start_date, '$lt' => $end_date),
								"MemberName" => $user_r->user
							)
						]),
					),
				),
				"skip" => 0,
				"limit" => 0,
				"sort" => array("_id" => -1), //-1 DESC   1 ASC        // ปิด  _id
				'de_selector' => array("_id" => 0, "__v" => 0,)
			)),
			'data' => null
		));

		$ticket =  json_decode($this->getapi_model->call_API_mongo('api', $data_sent, "GET"));

		$ven = [];
		$i = 0;
		foreach ($ticket as $key => $tc) {
			foreach ($vendor as $vd) {

				if ($tc->Vendor == $vd['id']) {

					array_push($ven, array(
						"Vendor" => $tc->Vendor,
						"Product" => $tc->Product,
						"TicketSessionID" => $tc->TicketSessionID,
						"TicketID" => $tc->TicketID,
						"MemberName" => $tc->MemberName,
						"GameType" => $tc->GameType,
						"RoundID" => $tc->RoundID,
						"Stake" => $tc->Stake,
						"StakeMoney" => $tc->StakeMoney,
						"Result" => $tc->Result,
						"Currency" => $tc->Currency,
						"VendorTicketDateUTC" => $tc->VendorTicketDateUTC,
						"VendorTicketDate" => $tc->VendorTicketDate,
						"StatementDate" => $tc->StatementDate,
						"PlayerWinLoss" => $tc->PlayerWinLoss,
						"PlayerCommissionAmount" => $tc->PlayerCommissionAmount,
						"ProcessedTime" => $tc->ProcessedTime,
						"imiTime" => $tc->imiTime,
						"CreatedTime" => $tc->CreatedTime,
						"Ip" => $tc->Ip,
						"ValidAmount" => $tc->ValidAmount,
						"Type" => $tc->Type,
						'VendorName' => $vd['VendorName']
					));
					
				}
			}
			$i++;
		}
		
		$data = $ven;

		$sum_StakeMoney = 0;
		$sum_PlayerWinLoss = 0;
		foreach ($ticket as $key => $value) {
			$sum_StakeMoney += $value->StakeMoney;
			$sum_PlayerWinLoss += $value->PlayerWinLoss;
		}

		$stakemoney = $sum_StakeMoney;
		$winloss = $sum_PlayerWinLoss;
		$re = array('code' => 1, 'msg' => 'ค้นหาสำเร็จ', 'data' => $data, 'stake' => $stakemoney, 'winloss' => $winloss);

		echo json_encode($re);
		die();
	}

	//ประวัติการเล่นรวม
	public function ticket_vendor()
	{
		$data['vendor'] = $this->db->where('status', 1)->get('tb_vendor')->result_array();
		$this->load->view('ticket_vendor', $data);
	}

	public function get_vendor()
	{
		die;
	}
	//ประวัติการเล่นรวม


	//turn_vendor
	public function turn_vendor()
	{
		$this->load->view('turn_vendor');
	}
	public function get_tr_vd()
	{
		
		die();
	}
}

<?php
class Turnover extends MY_Controller
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
	
	public function setturnover()
	{

		$data['vender'] =  json_encode($this->db->get('tb_vendor')->result_array());
		// =====ตั้งค่าสมัครใหม่
		$set_newuser_turn = $this->db->where('name', 'set_newuser_turn')->get('setting')->row();
		$set_newusersale_turn = $this->db->where('name', 'set_newusersale_turn')->get('setting')->row();
		(!($set_newuser_turn)) ?
			$this->db->insert('setting', array('name' => 'set_newuser_turn',	'code' => '0')) :
			$data['set_newuser_turn'] = $set_newuser_turn->code;
		(!($set_newusersale_turn)) ?
			$this->db->insert('setting', array('name' => 'set_newusersale_turn',	'code' => '0')) :
			$data['set_newusersale_turn'] = $set_newusersale_turn->code;
		// =====ตั้งค่ารายการฝาก			
		$set_deposit_turnover = $this->db->where('id', 1)->get('set_deposit_turnover')->row();
		if ($set_deposit_turnover->equal == 0 || $set_deposit_turnover->equal == '0') {
			$data['set_deposit_turnover'] = $set_deposit_turnover->num;
			$data['type_set_deposit_turnover'] = 'จำนวน';
		} else {
			$data['set_deposit_turnover'] = $set_deposit_turnover->equal;
			$data['type_set_deposit_turnover'] = 'เท่า';
		}
		$data['max_set_deposit_turnover'] = $set_deposit_turnover->max;
		
		 // เช็ค ฐานข้อมูล มีข้อมูลหรือไม่
		 if(!($this->db->where('name', 'maxTurnPoint')->get('setting')->row())){
            $this->db->insert('setting', ['name'=> 'maxTurnPoint','code' => '9999999','status'=>1]);
        }
        if(!($this->db->where('name', 'minTurnPoint')->get('setting')->row())){
            $this->db->insert('setting', ['name'=> 'minTurnPoint','code' => '500','status'=>1]);
        }
        if(!($this->db->where('name', 'perPoint')->get('setting')->row())){
            $this->db->insert('setting', ['name'=> 'perPoint','code' => '0.1','status'=>1]);
        }
		// =====ตั้งค่าได้พ้อยจากเทิร์น 
		$data['minTurnPoint']  = $this->db->where('name', 'minTurnPoint')->get('setting')->row()->code;
		$data['maxTurnPoint']  = $this->db->where('name', 'maxTurnPoint')->get('setting')->row()->code;
		$data['perPoint']  = $this->db->where('name', 'perPoint')->get('setting')->row()->code;

		$this->load->view('setturnover', $data);
	}
	public function updates_setdeposit_turn()
	{
		$q = $this->db
			->where("id", 1)
			->update('set_deposit_turnover', array('num' => $this->input->post('num'), 'equal' => $this->input->post('equal'), 'max' => $this->input->post('max')));
		if ($q) {
			echo json_encode('success');
		} else {
			echo json_encode('error');
		}
		die;
	}
	public function updatesetuserturn()
	{

		$q = $this->db->set('code', $this->input->post('value'))
			->where("name", $this->input->post('name'))
			->update('setting');
		if ($q) {
			echo json_encode('success');
		} else {
			echo json_encode('error');
		}
		die;
	}
	public function updateturntopoint()
	{
		$minTurnPoint = $this->input->post('minTurnPoint');
		$maxTurnPoint = $this->input->post('maxTurnPoint');
		$perPoint = $this->input->post('perPoint');
		$data = [];
		if ($minTurnPoint != '' || $minTurnPoint != null) {
			$this->db->set('code', $minTurnPoint)->where("name", 'minTurnPoint')->update('setting');
			$data['minTurnPoint'] = 'success';
		} else {
			$data['minTurnPoint'] = 'error';
		}
		if ($maxTurnPoint != '' || $maxTurnPoint != null) {
			$this->db->set('code', $maxTurnPoint)->where("name", 'maxTurnPoint')->update('setting');
			$data['maxTurnPoint'] = 'success';
		} else {
			$data['maxTurnPoint'] = 'error';
		}
		if ($perPoint != '' || $perPoint != null) {
			$this->db->set('code', $perPoint)->where("name", 'perPoint')->update('setting');
			$data['perPoint'] = 'success';
		} else {
			$data['perPoint'] = 'error';
		}
		echo json_encode($data);
		die;
	}
	public function checkTurnover()
	{
		if (!empty($this->input->post('user'))) {
			$user = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);

			$d1 = strtotime($this->input->post('d1') . " 00:00:01");
			$d2 = strtotime($this->input->post('d2') . " 23:59:59");
			$vender =  $this->db->where('check_turn', 1)->get('tb_vendor')->result_array();
			$game = [];
			$casino = [];
			$sport = [];
			foreach ($vender as $k => $v) {
				switch ($v['type']) {
					case 1: //game
						array_push($game, array('id' => $v['vendor_id'], 'name' => $v['VendorName']));
						break;
					case 2: //casino
						array_push($casino, array('id' => $v['vendor_id'], 'name' => $v['VendorName']));
						break;
					case 3: //sport
						array_push($sport, array('id' => $v['vendor_id'], 'name' => $v['VendorName']));
						break;
					default:
						break;
				}
			}
			$data['game'] = array('vender' => $game, 'data' => $this->getTurnoverByUserVendorDate($user, $game, $d1, $d2));
			$data['casino'] = array('vender' => $casino, 'data' => $this->getTurnoverByUserVendorDate($user, $casino, $d1, $d2));
			$data['sport'] = array('vender' => $sport, 'data' => $this->getTurnoverByUserVendorDate($user, $sport, $d1, $d2));
			$data['data'] = array('user' => $user, 'dateF' => $this->input->post('d1'), 'dateE' => $this->input->post('d2'));
		} else {
			$data['data'] = array('user' => '', 'dateF' => date("Y-m-d"), 'dateE' => date("Y-m-d"));
		}

		$this->load->view('checkturnover', ($data));
	}
	public function getTurnoverByUserVendorDate($user, $venderArr, $dateF, $dateE)
	{
		$arrV = [];
		foreach ($venderArr as $k => $v) {
			array_push($arrV, $v['id']);
		}
		$data_sent = json_encode(array(
			"venders" =>  $arrV,
			"from" => $dateF,
			"to" => $dateE
		));
		// echo 'turnover/venders/user/'.$user.'/date';
		// print_r($data_sent);
		// die;
		return $this->getapi_model->call_API_mongo('turnover/venders/user/' . $user . '/date', $data_sent, "POST");
	}

	public function UpdateSatusCheckTurn()
	{
		$data = array(
			'check_turn' => $this->input->post('status'),

		);

		if ($this->db->where('id', $this->input->post('id'))->update('tb_vendor', $data)) {
			echo json_encode('success');
		} else {
			echo json_encode('error');
		}
		die;
	}

	// showlog turn topoint

	public function log_turntopoint()
	{
			$dateS = time()*1000;
			$dateE = time()*1000;
		if($this->input->post('dateS') && $this->input->post('dateE')){
			$dateS = (strtotime($this->input->post('dateS')))*1000;
			$dateE = (strtotime($this->input->post('dateE')))*1000;
		}


		$data_sent =json_encode(array(
			"from"=> $dateS,
			"to"=> $dateE
		));
		$data['logturntopoint'] = json_decode($this->getapi_model->call_API_mongo('log/point/date', $data_sent, "POST"));
		$this->load->view('log_turntopoint',$data);
	}

	public function ReportTurnover()
	{
		
		$this->load->view('report_turnover');
	}
}

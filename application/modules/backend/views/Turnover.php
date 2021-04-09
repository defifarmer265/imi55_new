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

		$this->load->view('setturnover',$data);
	}
	public function checkTurnover(){
		if(!empty($this->input->post('user'))){
			$user = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('user')))), -6);
			
			$d1 = strtotime($this->input->post('d1')." 00:00:01");
			$d2 = strtotime($this->input->post('d2')." 23:59:59");
			$vender =  $this->db->where('check_turn',1)->get('tb_vendor')->result_array();
			$game=[];
			$casino=[];	
			$sport=[];
			foreach ($vender as $k => $v) {
				switch ($v['type']) {
					case 1://game
						array_push($game,array('id'=>$v['vendor_id'],'name'=>$v['VendorName']));
						break;
					case 2://casino
						array_push($casino,array('id'=>$v['vendor_id'],'name'=>$v['VendorName']));
						break;
					case 3://sport
						array_push($sport,array('id'=>$v['vendor_id'],'name'=>$v['VendorName']));
						break;							
					default:						
						break;
				}
				
			}
			$data['game']= array('vender' =>$game , 'data'=> $this->getTurnoverByUserVendorDate($user,$game,$d1,$d2)); 
			$data['casino']=array('vender' =>$casino , 'data'=> $this->getTurnoverByUserVendorDate($user,$casino,$d1,$d2));
			$data['sport']=array('vender' =>$sport , 'data'=> $this->getTurnoverByUserVendorDate($user,$sport,$d1,$d2));
			$data['data']= array('user'=>$user,'dateF'=>$this->input->post('d1'),'dateE'=>$this->input->post('d2'));
		}else{
			$data['data'] = array('user'=>'','dateF'=>date("Y-m-d"),'dateE'=>date("Y-m-d"));
		}
		
		$this->load->view('checkturnover',($data));
	}
	public function getTurnoverByUserVendorDate($user,$venderArr,$dateF,$dateE)
	{
		$arrV = [];
		foreach ($venderArr as $k => $v) {
			array_push($arrV,$v['id']);
		}
		$data_sent = json_encode(array(
			"venders" =>  $arrV,
			"from"=> $dateF,
			"to"=> $dateE
		));
		return $this->getapi_model->call_API_mongo('http://'.$_SERVER['HTTP_HOST'].':5678/turnover/venders/user/'.$user.'/date', $data_sent, "POST");
	}
	
	public function UpdateSatusCheckTurn(){
		$data = array(
			'check_turn' => $this->input->post('status'),

	);
	
	if($this->db->where('id', $this->input->post('id'))->update('tb_vendor', $data)){
		echo json_encode('success');
	}else{
		echo json_encode('error');
	}
	die;
	}
	
}

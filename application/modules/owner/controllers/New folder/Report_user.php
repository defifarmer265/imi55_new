<?php

/**
* 
*/
class Report_user extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->library('users/users_library');
		$this->load->library('tripledes');
		$this->load->model('user_model');
		$this->load->model('getapi_model');
		$this->load->model('bank_model');
		$this->load->model('withdraw_model');

	}
	private function _init()
	{		
		$this->output->set_template('tem_admin/tem_admin');
	}

	public function index()
	{
		
		
		if(!empty($this->input->post())){
		$dateStart  = strtotime($this->input->post('begin_date'));
		$dateEnd	= strtotime($this->input->post('end_date'));;
		}else{
			$dateStart = strtotime(date('d-m-Y'));
			$dateEnd = strtotime(date('d-m-Y'));
		}
		$i=0;
		
		$user = $this->db->select('tb_user.id,tb_user.username')->where('tb_user.status',2)->get('tb_user')->result_array();
		$total_winloseSC 	= 0;
		$total_winloseCN 	= 0;
		$total_turnSC 		= 0;
		$total_turnCN 		= 0;
		$total_deposit 		= 0;
		$total_withdraw 	= 0;
		$total_promotion 	= 0;
		$total_tt_7 		= 0;
		$total_tt_7_num 	= 0;
		$total_tt_20 		= 0;
		$total_tt_20new 	= 0;
		
		foreach($user as $_u=>$us){
			$winlose = $this->db->select('tb_winlose.*')
			->where('tb_winlose.datetime >=',$dateStart)
			->where('tb_winlose.datetime <=',$dateEnd)
			->where('tb_winlose.user_id',$us['id'])
			->where('tb_winlose.status',2)
			->get('tb_winlose')->result_array();
			
			$winloseSC 	= 0;
			$winloseCN 	= 0;
			$turnSC 	= 0;
			$turnCN 	= 0;
			$deposit 	= 0;
			$withdraw 	= 0;
			$promotion 	= 0;

			foreach($winlose as $_w => $wl){
				$winloseSC 	= $winloseSC + $wl['winloseSC'];
				$winloseCN 	= $winloseCN + $wl['winloseCN'];
				$turnSC 	= $turnSC + $wl['turnSC'];
				$turnCN 	= $turnCN + $wl['turnCN'];
				$deposit 	= $deposit + $wl['deposit'];
				$withdraw 	= $withdraw + $wl['withdraw'];
				$promotion 	= $promotion + $wl['promotion'];
			}
			$user[$i]['tt_winloseSC'] 	= $winloseSC;
			$user[$i]['tt_winloseCN'] 	= $winloseCN;
			$user[$i]['tt_turnSC'] 		= $turnSC;
			$user[$i]['tt_turnCN'] 		= $turnCN;
			$user[$i]['tt_deposit'] 	= $deposit;
			$user[$i]['tt_withdraw'] 	= $withdraw;
			$user[$i]['tt_promotion'] 	= $promotion;
			$total_winloseSC 	= $total_winloseSC + $winloseSC;
			$total_winloseCN 	= $total_winloseCN + $winloseCN;
			$total_turnSC 		= $total_turnSC + $turnSC;
			$total_turnCN 		= $total_turnCN + $turnCN;
			$total_deposit 		= $total_deposit + $deposit;
			$total_withdraw 	= $total_withdraw + $withdraw;
			$total_promotion 	= $total_promotion + $promotion;
			$i++;
		}
		$total['tt_winloseSC'] 	= $total_winloseSC;
		$total['tt_winloseCN'] 	= $total_winloseCN;
		$total['tt_turnSC'] 	= $total_turnSC;
		$total['tt_turnCN'] 	= $total_turnCN;
		$total['tt_deposit'] 	= $total_deposit;
		$total['tt_withdraw'] 	= $total_withdraw;
		$total['tt_promotion'] 	= $total_promotion*-1;

		$datetime['dateStart'] 	= $dateStart;
		$datetime['dateEnd'] 	= $dateEnd;
		
		//โปรโมชั่นที่กำลังใช้งาน
		$promotion_detail = $this->db->select('tb_promotion.id,tb_promotion.name')
			->where('tb_promotion.date_start <',$dateEnd)
			->where('tb_promotion.date_end >',$dateStart)
			->get('tb_promotion')
			->result_array();
		$data = array(
			'menu' 		=> 'report',
			'user' 		=> $user,
			'total'		=> $total,
			'datetime'	=> $datetime,
			'promotion_list'	=> $promotion_detail
		);	
//		echo '<pre>';
//		print_r($data);
//		die();
		$this->load->view('report_user',$data);
	}
	
	
	 
	public function upload_winlose(){

		//ดึงรายการวันเวลาล่าสุดที่ถูกบันทึก winlose
		$row_lastday = $this->db->select('datetime')->order_by('datetime','DESC')->limit(1)->get('tb_winlose')->row();
		if($row_lastday != ''){ //กรณีมีวันเวลาล่าสุด

			$lastday = date('d-m-Y',$row_lastday->datetime);
			$lastday = strtotime('-1 day',strtotime($lastday));
			
		}else{ 					//กรณีไม่มีวันเวลาล่าสุด
			$fristDepo = $this->db->select('time')->order_by('time','ACE')->limit(1)->get('tb_deposit')->row();
			$lastday = strtotime(date('d-m-Y',$fristDepo->time));
		}
		//ค้าหา User ทั้งหมดในระบบ ที่ออนไลน์ในเวลาที่ยังไม่ถูกบันทึก winlose
		$user = $this->db->select('id,username')->get('tb_user')->result_array();
		//วันปัจจุบัน
		$today = strtotime(date('d-m-Y'));
		
		if($today >= $lastday){
			//นับจำนวนวันล่าสุดกับวันปัจจุบันห่างกันกี่วัน
			$datediff =  $today - $lastday;
			$countDay =  round($datediff / (60 * 60 * 24));
			
			//วนลูปตามจำนวน $countDay เพื่อดึงรายงานในแต่ละวัน
			for($x=0; $x <= $countDay; $x++){
				$dayStart 	= strtotime(date('d-m-Y 00:00:00',$lastday));
				$dayEnd 	= strtotime(date('d-m-Y 23:59:59',$lastday));
				echo '<br>';
				echo date('d m y H i s',$dayStart);
				echo date('d m y H i s',$dayEnd);
				echo '<br>';
				 //วนลูปจำนวน user ที่มีความเคลื่อนไหวหลังจากวันบันทึก winlose ล่าสุด
				foreach($user as $_u=>$us){
					$deposit = $this->db->select('SUM(tb_deposit.amount) as sum_deposit ,SUM(tb_deposit.credit_add) as sum_credit_add')
						->where('tb_deposit.status',2)
						->where('tb_deposit.time >',$dayStart)
						->where('tb_deposit.time <',$dayEnd)
						->where('tb_deposit.user_id',$us['id'])
						->get('tb_deposit')
						->row();
					$withdraw = $this->db->select('SUM(amount) as sum_withdraw')
						->where('status',2)
						->where('time >',$dayStart)
						->where('time <',$dayEnd)
						->where('user_id',$us['id'])
						->get('tb_withdraw')
						->row();
					if($deposit->sum_deposit != '' || $withdraw->sum_withdraw != ''){
						if($deposit->sum_deposit != ''){
							$tt_promoiton = $deposit->sum_credit_add - $deposit->sum_deposit;
						}else{
							$tt_promoiton = 0;
						} 
						if($deposit->sum_deposit != ''){
							$tt_deposit = $deposit->sum_deposit;
						}else{
							$tt_deposit = 0;
						}
						if($withdraw->sum_withdraw != ''){
							$tt_withdraw = $withdraw->sum_withdraw;
						}else{
							$tt_withdraw = 0;
						}
						
						//ตั้งค่า array สำหรับส่งข้อมูล API
						$Arr_winlose = array( 
							'username'  	=> $us['username'], 
							'begin_date'    => date('Y-m-d',$lastday), 
							'end_date'   	=> date('Y-m-d',$lastday),
							'agent'         => $this->getapi_model->agent(),
							'date'          => date('Y-m-d H:i:s')
						);
						//ส่งข้อมูล API เพื่อเรียกใช้งานข้อมูล winlose
						$data_winlose = $this->getapi_model->getapi($Arr_winlose,'winloss');
						if($data_winlose->sflag == 1){
							$tt_winloseSC 	= 0;
							$tt_winloseCN	= 0;
							$tt_turnSC		= 0;
							$tt_turnCN		= 0;
							foreach($data_winlose->data as $_w=>$wl){
								if($wl->wl_type == 'sc' || $wl->wl_type == 'st' ||  $wl->wl_type == 'sp'){
									$tt_winloseSC 	= $tt_winloseSC + $wl->wl_winloss;
									$tt_turnSC		= $tt_turnSC + $wl->wl_turnover;
								}else if($wl->wl_type == 'gm' || $wl->wl_type == 'cn'){
									$tt_winloseCN 	= $tt_winloseCN + $wl->wl_winloss;
									$tt_turnCN		= $tt_turnCN + $wl->wl_turnover;
								}else{
									
								}
							}
						}else{			//ไม่มีข้อมูล API
							$tt_winloseSC 	= 0;
							$tt_winloseCN	= 0;
							$tt_turnSC		= 0;
							$tt_turnCN		= 0;
						}
						$winlose = $this->db->select('id')->where('user_id',$us['id'])->where('datetime',$lastday)->get('tb_winlose')->row();
						if($winlose == null){
							//insert winlose
							$Arr_winlose = array(
									'user_id' 	=> $us['id'],
									'datetime' 	=> $lastday,
									'winloseSC' => $tt_winloseSC,
									'winloseCN' => $tt_winloseCN,
									'turnSC' 	=> $tt_turnSC,
									'turnCN' 	=> $tt_turnCN,
									'deposit' 	=> $tt_deposit,
									'withdraw' 	=> $tt_withdraw,
									'promotion' => $tt_promoiton,
									'status'	=> 2
							);
							
							if($this->db->insert('tb_winlose', $Arr_winlose) == true){
								echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';
							}else{
								//Insert ไม่สำเร็จ
							}
						}else{
							//Update winlose
							$Arr_winlose = array(
									'datetime' 	=> $lastday,
									'winloseSC' => $tt_winloseSC,
									'winloseCN' => $tt_winloseCN,
									'turnSC' 	=> $tt_turnSC,
									'turnCN' 	=> $tt_turnCN,
									'deposit' 	=> $tt_deposit,
									'withdraw' 	=> $tt_withdraw,
									'promotion' => $tt_promoiton,
									'status'	=> 2
							);
							if($this->db->where('id', $winlose->id)->update('tb_winlose', $Arr_winlose) == true){
								echo '55555555';
							}else{
								//update ไม่สำเร็จ
							}
						}
						
					}else{
						// No update
					}
					
				}
				//เพิ่มจำนวนวัน
				$lastday =  strtotime('+1 day', $lastday);
			}
		}else{
			
		}

		die();
	}
	
	
	



}


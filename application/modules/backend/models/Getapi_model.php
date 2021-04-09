<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getapi_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function token_(){
		$token_q = $this->db->select('code')->where('name','token')->where('status',1)->get('setting');
		if($token_q->num_rows() == 1){
			$token = $token_q->row()->code;
		}else{
			$token = '';
		}
		return $token;
	}
	public function agent(){
		$agent_q = $this->db->select('code')->where('name','agent')->where('status',1)->get('setting');
		if($agent_q->num_rows() == 1){
			$agent = $agent_q->row()->code;
		}else{
			$agent = '';
		}
		return $agent;
	}
	public function nameweb(){
		$nameweb_q = $this->db->select('code')->where('name','web')->where('status',1)->get('setting');
		if($nameweb_q->num_rows() == 1){
			$nameweb = $nameweb_q->row()->code;
		}else{
			$nameweb = '';
		}
		return $nameweb;
	}
	public function getapi($arr_userAPI,$url,$dataAPI)
	{
		$sign = $this->sign($dataAPI);
		$arr_userAPI['sign'] = $sign;
		
		//$arr_sent = http_build_query($arr_userAPI);
		$arr_sent = json_encode($arr_userAPI);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $arr_sent,
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);
///////////////

	}

	public function sign($dataAPI)
	{

		$time1 = time();
		//type L:login D:deposit W:withdraw R:register
		if($dataAPI['type'] == 'L'){
			$data1 = strtolower($dataAPI['agent'].$dataAPI['member'].$dataAPI['password']);
		}else if($dataAPI['type'] == 'D' || $dataAPI['type'] == 'W' || $dataAPI['type'] == 'R'){
			$data1 = strtolower($dataAPI['agent'].$dataAPI['member']);
		}else if($dataAPI['type'] == 'GT'){ //get tikget
			$data1 = strtolower($dataAPI['agent']);
		}

		$key1 = strtolower($this->token_());
		$word = $data1.$time1.$key1;
		$word_hash = hash('sha256', $word);

		return($word_hash);
	}
		public function send_sms($tel,$msg)
	{
			$Username	= getenv('OTP_USER');
			$Password	= getenv('OTP_pass');
			$PhoneList	= $tel;//"xxxxxxx;xxxxxxx;xxxxxx;"
			$Message	= urlencode(iconv("UTF-8","TIS-620",$msg));
			$Sender		= "IMI";
			$Parameter	= "User=$Username&Password=$Password&Msnlist=$PhoneList&Msg=$Message&Sender=$Sender";
			$API_URL	= "http://member.smsmkt.com/SMSLink/SendMsg/index.php";
			
			$ch = curl_init();   
			curl_setopt($ch,CURLOPT_URL,$API_URL);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
			curl_setopt($ch,CURLOPT_POST,1); 
			curl_setopt($ch,CURLOPT_POSTFIELDS,$Parameter);
			
			$Result = curl_exec($ch);
			$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
			curl_close($ch);
			//Status=0,Detail=31081910/20691.
			$d1 = explode(',', $Result);
			//Status=-101,
			// Detail=Parameter not complete.
			$new_res = [];
			for($i=0;$i < count($d1) ; $i++){
				$d2 = explode('=', $d1[$i]);
				$new_res[$d2[0]] = $d2[1];
			}

			return json_encode($new_res);
	}

//	public function delete_reward($id)
//	{
//		$this->db->select('img');
//		$this->db->from('reward');
//		$this->db->where('id_reward',$id);
//			$query = $this->db->get();
//			$result = $query->row();
//			$img_file = 'public/tem_frontend/img/reward/'.$result->img;
//
//			if (unlink($img_file))
//				{
//					$this->db->where('id_reward', $id)->delete('reward');
//				}else{
//						echo ("error");
//				}
//
//	}
	public function get_ticket($user)
	{
		$arr_gameAPI = array(
			'StartTime' => date('Y-m-d',time() - (7*24*60*60)), //"2020-01-14 10:00"
			'EndTime'	=> date('Y-m-d',time()),
			'PlayerName'=> $user,
			'Partner'	=> $this->getapi_model->agent(),
			'TimeStamp' => time(),
			'PageSize' 	=> 20,
			'PageIndex' => 1,
		);
		$dataAPI = array(
			'type'		=> 'GT',
			'agent' 	=> $this->getapi_model->agent(),
		);
			$url_apiticket = 'https://pwlapi.linkv2.com/api/tickets/xfind';
			$cre_userAPI =  $this->getapi($arr_gameAPI,$url_apiticket,$dataAPI);
			$sumStake = 0;
			$count = count($cre_userAPI->Result->Tickets);
			for ($i = 0; $i < $count; $i++) {
				$stakeMoney = $cre_userAPI->Result->Tickets[$i]->StakeMoney;
				$sumStake  = $sumStake + $stakeMoney;
			}
		return $sumStake;
	}
		//  ==================== mommam trun over kub =================================
		
}
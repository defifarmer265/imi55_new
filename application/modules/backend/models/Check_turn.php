<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Check_turn extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function get_credit($user)
	{
		$arr_userAPI = array( 
			'AgentName'	=> $this->getapi_model->agent(),    
			'PlayerName'=> $user,
			'TimeStamp'	=> time(),
		);
		$dataAPI = array(
			'type'		=> 'D',
			'agent' 	=> $this->getapi_model->agent(),
			'member' 	=> $user,
		);
		$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
		$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
		if($cre_userAPI->Error == 0){
			$amount = $cre_userAPI->Balance;
		}else{
			$amount = $cre_userAPI->Message;
		}
		return $amount;
    }
    public function get_outstanding($user)
	{
		$arr_userAPI = array( 
            "Partner"=>$this->getapi_model->agent(), 
            "TimeStamp"=> time(),
            "Playername"=>$user,
            "Vendor"=>"",
		);
		$dataAPI = array(
			'type'		=> 'GT',
			'agent' 	=> $this->getapi_model->agent(),
            'member' 	=> $user,
		);
		$url_api = 'https://pwlapi.linkv2.com/api/tickets/findPlayerTickets';
		$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
		return sizeof($cre_userAPI->Result->Tickets);
		 
	}
	public function checkturn($userid, $deposit)
    {
		
    }


}

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_user_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('backend/getapi_model');
        $this->load->model('backend/create_table_model');
	}
    public function getbalance($user)
    {
        //array api
		$arr_userAPI = array(
			'AgentName'	=> $this->getapi_model->agent(),
			'PlayerName' => $user,
			'TimeStamp'	=> time(),
		);
		$dataAPI = array(
			'type'		=> 'D',
			'agent' 	=> $this->getapi_model->agent(),
			'member' 	=> $user
		);

		$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
		$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
		if ($cre_userAPI->Error == 0) {
			$credit = number_format($cre_userAPI->Balance, 2);
		} else {
			$credit = number_format($cre_userAPI->Balance, 2);
			//			$credit = "Error";
		}
		return $credit;
    }
    public function addcredit($user,$credit,$note)
    {
        
        $arr_depAPI = array(
            'AgentName' => $this->getapi_model->agent(),
            'PlayerName' => $user,
            'Amount' => $credit,
            'TimeStamp' => time(),
        );
        $dataAPI = array(
            'type' => 'D',
            'agent' => $this->getapi_model->agent(),
            'member' => $user,
        );
        $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
        $cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
        if($cre_userAPI->Success == 1){
            // addcredit success
            $arr_addcredit = array(
                'time' => time(),
                'note' => 'สถานะ:Success,ยอดเงิน:'.$credit.',เพิ่มให้กับUser:'.$user.',รายละเอียด:'.$note,
                'status'=>1
                    );
        }else{
            // addcredit fail
            $arr_addcredit = array(
                'time' => time(),
                'note' => 'สถานะ:Error,ยอดเงิน:'.$credit.',เพิ่มให้กับUser:'.$user.',รายละเอียด:'.$note,
                'status'=>1
                    );
        }
        
        //log_addcreditall
        if($this->db->table_exists('log_addcredit') != 1 )
        {
            $this->create_table_model->tb_log_addcredit();
        }
        if($this->db->insert('log_addcredit',$arr_addcredit)){
            
        }
        return($cre_userAPI);
    }
    public function wd_history($user)
    {
        //array api
		$arr_depAPI = array(
            'AgentName' => $this->getapi_model->agent(),
            'PlayerName' => $user,
            'From' => date('m/d/Y', time() - (7 * 24 * 60 * 60)), //01/01/2020
            'To' => date('m/d/Y'), //01/01/2020
            'TransferType' => -1, //(2:Deposit/3:Withdraw)
            'PageSize' => 10,
            'PageIndex' => 1,
            'TimeStamp' => time(),
        );
        $dataAPI = array(
            'type' => 'D',
            'agent' => $this->getapi_model->agent(),
            'member' => $user,
        );
        
        $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/transferlogs';
        $cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
		
        return($cre_userAPI);
    }
}
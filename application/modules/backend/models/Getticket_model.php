<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Getticket_model extends CI_Model
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('getapi_model');
        
    }
    public function get_ticket($user){
        //วันที่ปัจจุบัน
        
        $date = date('Y-m-d 11:00:00');
        $date2 = date('Y-m-d 10:59:59'); 
        //ย้อนหลัง1วัน
        $retrospective_date = strtotime(date('Y-m-d H:i:s',strtotime($date . "-1days")));
        //วันที่ปจจุบันเวลา 11.00
        $s_day = strtotime(date('Y-m-d H:i:s',strtotime($date2)));
        $data_sent = json_encode(array(
            'query' => (array(
                'tb_name' =>    $this->getapi_model->agent(), //'ztzz361',
                'where' => array(
                    "Operators" => array(
                        "and" => array(
                            "data" => [array(
                                "imiTime" => array('$gte' => (string)$retrospective_date,'$lte'=>(string)$s_day),
                                "MemberName" =>  $user   
                            )]
                        ),
                    ),
                ),
                "skip" => 0,
                "limit" => 0,
                "sort" => array("_id" => -1),
                'de_selector' => null
            )),
            'data' => null
        ));
       
        return ($this->getapi_model->call_API_mongo($data_sent, "GET"));
    }

}
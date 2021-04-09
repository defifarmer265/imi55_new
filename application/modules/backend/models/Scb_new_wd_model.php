<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scb_new_wd_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->accnum = $this->account();

    }
    public function account()
    {
        
        $acc_q = $this->db->select('account')->where('id',32)->where('status',3)->get('tb_bank_web');
        if($acc_q->num_rows() == 1){
            $account = $acc_q->row()->account;
        }else{
            $account = '';
        }
        return $account;
    }

    public function login()
    {
        error_reporting(0);

        $row_q = $this->db->select('deviceId, pin_app')->where('status',3)->where('type',2)->where('id',32)->get('tb_bank_web');
        // echo "<pre>";
        // print_r($row_q->row());
        // die();
        $pin = $row_q->row()->pin_app;
        $deviceId = $row_q->row()->deviceId;

         // print_r($pin);
         // print_r($deviceId);
         // print_r($this->accnum);
        //die();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fasteasy.scbeasy.com:8443/v3/login/preloadandresumecheck',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HEADER=> 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"deviceId":"'.$deviceId.'","jailbreak":"0","tilesVersion":"39","userMode":"INDIVIDUAL"}',
            CURLOPT_HTTPHEADER => array(
                'Accept-Language:      th',
                'scb-channel:  APP',
                'user-agent:        Android/10;FastEasy/3.36.0/4024',
                'Content-Type:  application/json; charset=UTF-8',
                'Hos:  fasteasy.scbeasy.com:8443',
                'Connection:  close',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        preg_match_all('/(?<=Api-Auth: ).+/', $response, $Auth);

        if ($Auth=="") {
            return"Auth error";
            exit();
        }

        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => 'https://fasteasy.scbeasy.com/isprint/soap/preAuth',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"loginModuleId":"PseudoFE"}',
            CURLOPT_HTTPHEADER => array(
                'Api-Auth: '.$Auth,
                'Content-Type: application/json',
            ),
        ));

        $Auth=$Auth[0][0];

        $response1 = curl_exec($curl1);

        curl_close($curl1);


        $data = json_decode($response1,true);

        $hashType=$data['e2ee']['pseudoOaepHashAlgo'];
        $Sid=$data['e2ee']['pseudoSid'];
        $ServerRandom=$data['e2ee']['pseudoRandom'];
        $pubKey=$data['e2ee']['pseudoPubKey'];




        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:3000/pin/encrypt",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "Sid=".$Sid."&ServerRandom=".$ServerRandom."&pubKey=".$pubKey."&pin=".$pin."&hashType=".$hashType,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);



        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fasteasy.scbeasy.com/v3/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HEADER=> 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"deviceId":"'.$deviceId.'","pseudoPin":"'.$response.'","pseudoSid":"'.$Sid.'"}',
            CURLOPT_HTTPHEADER => array(
                'Api-Auth:  '.$Auth,
                'Content-Type: application/json'
            ),
        ));

        $response_auth = curl_exec($curl);



        preg_match_all('/(?<=Api-Auth:).+/', $response_auth, $Auth_result);
        $Auth1=$Auth_result[0][0];

        if ($Auth1=="") {
            return false;
        }
        return $Auth1;

    }
    public function getVerify($Auth1,$accountTo, $accountToBankCode, $amount)
    {

        $transferType="ORFT";

        if ($accountToBankCode=='014') {
            $transferType="3RD";
        }

        $GLOBALS["accountFrom"]=$this->accnum; 

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fasteasy.scbeasy.com/v2/transfer/verification",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>'{"accountFrom":"'.$GLOBALS["accountFrom"].'","accountFromType":"2","accountTo":"'.$accountTo.'","accountToBankCode":"'.$accountToBankCode.'","amount":"'.$amount.'","annotation":null,"transferType":"'.$transferType.'"}',
            CURLOPT_HTTPHEADER => array(
                'Api-Auth: '.$Auth1,
                'Content-Type:  application/json;charset=UTF-8'
            ),
        ));

        $response = curl_exec($curl);
        
        return json_decode($response, true);

    }
    public function Transfer($Auth1,$accountTo, $accountToBankCode, $amount)
    {

        $transferType="ORFT";

        if ($accountToBankCode=='014') {
            $transferType="3RD";
        }

        $GLOBALS["accountFrom"]= $this->accnum; 

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fasteasy.scbeasy.com/v2/transfer/verification",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>'{"accountFrom":"'.$GLOBALS["accountFrom"].'","accountFromType":"2","accountTo":"'.$accountTo.'","accountToBankCode":"'.$accountToBankCode.'","amount":"'.$amount.'","annotation":null,"transferType":"'.$transferType.'"}',
            CURLOPT_HTTPHEADER => array(
                'Api-Auth: '.$Auth1,
                'Content-Type:  application/json;charset=UTF-8'
            ),
        ));

        $response = curl_exec($curl);



        $data = json_decode($response,true);
        // print_r($data);
        // die();

        $check=$data['status']['description'];

        if ($check=="จำนวนเงินในบัญชีไม่เพียงพอ กรุณาเลือกบัญชีอื่น") {
            $data = array ('msg'=>'จำนวนเงินในบัญชีไม่เพียงพอ กรุณาเลือกบัญชีอื่น','status'=>500);
            echo json_encode($data);
            exit();
        }




        $totalFee=$data['data']['totalFee'];
        $scbFee=$data['data']['scbFee'];
        $botFee=$data['data']['botFee'];
        $channelFee= $data['data']['channelFee'];
        $accountFromName= $data['data']['accountFromName'];
        $accountTo= $data['data']['accountTo'];
        $accountToName= $data['data']['accountToName'];
        $accountToType= $data['data']['accountToType'];
        $accountToDisplayName= $data['data']['accountToDisplayName'];
        $accountToBankCode= $data['data']['accountToBankCode'];
        $pccTraceNo= $data['data']['pccTraceNo'];
        $transferType= $data['data']['transferType'];
        $feeType= $data['data']['feeType'];
        $terminalNo= $data['data']['terminalNo'];
        $sequence= $data['data']['sequence'];
        $transactionToken= $data['data']['transactionToken'];
        $bankRouting= $data['data']['bankRouting'];
        $fastpayFlag= $data['data']['fastpayFlag'];
        $ctReference= $data['data']['ctReference'];




        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fasteasy.scbeasy.com/v3/transfer/confirmation",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"accountFrom\":\"$accountTo\",\"accountFromName\":\"" .$accountFromName. "\",\"accountFromType\":\"2\",\"accountTo\":\"" .$accountTo. "\",\"accountToBankCode\":\"" .$accountToBankCode. "\",\"accountToName\":\"" . $accountToName . "\",\"amount\":\"" . $amount . "\",\"botFee\":0.0,\"channelFee\":0.0,\"fee\":0.0,\"feeType\":\"\",\"pccTraceNo\":\"" . $pccTraceNo . "\",\"scbFee\":0.0,\"sequence\":\"" . $sequence. "\",\"terminalNo\":\"" . $terminalNo . "\",\"transactionToken\":\"" . $transactionToken. "\",\"transferType\":\"" . $transferType. "\"}",
            CURLOPT_HTTPHEADER => array(
                'Api-Auth: '.$Auth1,
                'Content-Type:  application/json;charset=UTF-8'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        if ($data['status']['description'] != "สำเร็จ") {
            return ['status' => false, 'msg' => $data['status']['description']];
        }

        return ['status' => true];
    }

    public function getTransaction($Auth1)
    {
        date_default_timezone_set("Asia/Bangkok");
        
        $date_now=date("Y-m-d");

        $startDate=$date_now;
        $endDate=$date_now;

        $acc_num = $this->accnum;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fasteasy.scbeasy.com/v2/deposits/casa/transactions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"accountNo\":\"".$acc_num."\",\"endDate\":\"".$endDate."\",\"pageNumber\":\"1\",\"pageSize\":20,\"productType\":\"2\",\"startDate\":\"".$startDate."\"}",
            CURLOPT_HTTPHEADER => array(
                'Api-Auth: '.$Auth1,
                'Accept-Language: th',
                'Content-Type: application/json; charset=UTF-8'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);



        $result=json_decode($response,true);
        $check=$result['status']['description'];


        if ($check=='ไม่สามารถทำรายการทางการเงินได้ในขณะนี้') {
            $data = array ('result'=>'ไม่สามารถทำรายการทางการเงินได้ในขณะนี้');
            return $data;
        }else{
            $data = array ('result'=>$result['data']['txnList']);
            return $data;
        }
    }
}
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bbl_wd_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->pin = $this->pin();
		$this->deviceToken =$this->deviceToken();
		$this->uniqueId = $this->uniqueId();
        $this->load->helper('file');
	}

	private $pin;
    private $deviceToken;
    private $uniqueId;
    private $api = "https://modernb.bangkokbank.com/";
    
    /**
     *@param string $deviceId device Id ที่เก้บมาจากการลงทะเบียน proxy
     *@param string $ApiRefresh Api Refresh ที่เก้บมาจากการลงทะเบียน proxy
     *@return void no return data
     */
	public function pin()
	{
		$pin_q = $this->db->select('pin_app')->where('bank_id',3)->where('status',3)->get('tb_bank_web');
		if($pin_q->num_rows() == 1){
			$pin_app = $pin_q->row()->pin_app;
		}else{
			$pin_app = '';
		}
		return $pin_app;
	}
	public function deviceToken()
	{
		$deviceToken_q = $this->db->select('deviceId')->where('bank_id',3)->where('status',3)->get('tb_bank_web');
		if($deviceToken_q->num_rows() == 1){
			$deviceToken = $deviceToken_q->row()->deviceId;
		}else{
			$deviceToken = '';
		}
		return $deviceToken;
	}
	public function uniqueId()
	{
		$uniqueId_q = $this->db->select('ApiRefresh')->where('bank_id',3)->where('status',3)->get('tb_bank_web');
		if($uniqueId_q->num_rows() == 1){
			$uniqueId = $uniqueId_q->row()->ApiRefresh;
		}else{
			$uniqueId = '';
		}
		return $uniqueId;
	}
   private function Curl_cookie($method, $url, $header, $data, $cookie)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36');
            //curl_setopt($ch, CURLOPT_USERAGENT, 'okhttp/3.8.0');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            if ($cookie) {
                curl_setopt($ch, CURLOPT_COOKIESESSION, true);
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
            }
            $result = curl_exec($ch);
            return $result;
        }
        public function Auth($deviceToken,$uniqueId,$pin){
            
            if(strlen($pin) == 6 || $deviceToken != '' || $uniqueId != ''){
                $this->pin = $pin;
                $this->deviceToken = $deviceToken;
                $this->uniqueId = $uniqueId;
                }else{
                echo 'invaid pin deviceToken uniqueId !';
                exit;
            }
            
        }
        private function Curl($method, $url, $header, $data, $cookie)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36');
            //curl_setopt($ch, CURLOPT_USERAGENT, 'okhttp/3.8.0');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            if ($cookie) {
                curl_setopt($ch, CURLOPT_COOKIESESSION, true);
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
            }
            $res = curl_exec($ch);
            $statusCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            if($statusCode != 200){
                //die('ปิดปรับปรุง...');    
            }
            return $res;
        }
        private function PreAuth(){
            $header = [
            "Content-Type: application/json"
            ];
            $data = '{ "deviceInfo": { "deviceCustomInputMethod": "0", "phoneNumber": "", "deviceInputMethod": "com.google.android.inputmethod.latin/com.android.inputmethod.latin.LatinIME", "screenWidth": 1080, "type": "M2003J15SC", "notificationAddress": "", "uniqueId": "'.$this->uniqueId.'", "userAgent": "", "deviceIntegrity": 0, "os": "Android", "screenHeight": 2116, "osVersion": "9", "name": "merlin_global" }, "geolocation": { "latitude": 0.0, "longitude": 0.0 }, "applicationPushInfo": { "pushAppId": "com.bbl.mobilebanking", "pushProvider": "GCM" }, "deviceToken": "'.$this->deviceToken.'", "locale": "th-TH", "applicationInfo": { "protocolVersion": "3.2.1", "versionNumber": "3.2.1", "clientVersion": "3.2.1", "brandingVersion": "3.2.1", "clientType": "android" } }';

            $res = $this->Curl_cookie('POST',$this->api."api/users/app-config",$header,$data,false);

            preg_match_all('/^preauth-token:\s*([^\n]*)/mi', $res, $matches);
            
            return $matches[1][0];
        }
        public function Auth_Pin(){
            $header =  array(
            "Preauth-Token: ".trim($this->PreAuth()),
            "Content-Type: application/json",
            
            );
            
            $data = '{
            "password": "'.$this->pin.'",
            "deviceToken": "'.$this->deviceToken.'",
            "locale": "th-TH"
            }';
            $res = $this->Curl_cookie('POST',$this->api."api/authentication/pin",$header,$data,false);
            // print_r($res);
            // die();
            if((strpos($res, 'MA15') == true)){
                return json_encode(['status'=>false,"message"=>"พินผิด"]);
                exit;
                }else{

                preg_match_all('/^bearer-token:\s*([^\n]*)/mi', $res, $matches);

                $bearer_token = base64_decode(trim($matches[1][0]));
               
                if(isset($bearer_token)){
                
                    $bearer_token = json_decode($bearer_token,true);

                    $strFileName = "public/token/token.txt";
                    // $objFopen = fopen($strFileName, 'w');
                    // fwrite($objFopen, $bearer_token['token']);
                    write_file('public/token/token.txt', $bearer_token['token']);
                    // die();
                   
                    return ($bearer_token['token']);
                    }else{
                    return json_encode(['status'=>false,"message"=>"เกิดข้อผิดพลาด"]);
                }
            }
            
        }
        private function Token(){
            return file_get_contents('public/token/token.txt');

        }
        public function GetBalance(){
            $Authorization = trim($this->Token());
            $header =  array(
            "Authorization: Mobiliti ".$Authorization,
            "Content-Type: application/json"
            );
            $res =  $this->Curl('GET',$this->api."api/v1/accounts/?forceRefresh=true",$header,false,false);
            $json = json_decode($res,true);
            
            if(isset($json['accounts'])){
                return json_encode(($json['accounts'][0]['balances'][0]));
                }else{
                if(isset($json['error'])){
                    if($json['error']['code'] == "900000"){
                        $this->Auth_Pin();
                        return $this->GetBalance();
                    }
                }
            }
            
        }
        public function Check($accnum,$bankcode,$amount){
            $Authorization = trim($this->Token());
            $header =  array(
            "Authorization: Mobiliti ".$Authorization,
            "Content-Type: application/json"
            
            );
            $data = '{
            "memo": "",
            "toAccountNumber": "'.$accnum.'",
            "fromAccountNumber": "1",
            "amount": '.$amount.',
            "bankId": '.$bankcode.',
            "transferType": "one-off"
            }';
            
            $res = $this->Curl('POST',$this->api."api/transfers/verify",$header,$data,false);
            //exit;
            $json = json_decode($res,true);
           
            if(isset($json['error'])){
                if($json['error']['code'] == "900000"){
                    $this->Auth_Pin();
                    return $this->Check($accnum,$bankcode,$amount);
                    }else if($json['error']['code'] == "AC05"){
                    return json_encode(['status'=>false,"message"=>"ยอดเงินไม่เพียงพอ"]);   
                    }else if($json['error']['code'] == "AC07"){
                    return json_encode(['status'=>false,"message"=>"เลขบัญชีผิดพลาด"]); 
                }else{
                return json_encode(['status'=>false,"message"=>"เกิดข้อผิดพลาดไม่ทราบสาเหตุ"]); 
                }
                }else{
                //  print_r($json['toAccount']);
                // die();
                return json_encode(['status'=>true,"message"=> array('name' => $json['toAccount']['displayAccountName'],'accnum'=>$json['toAccount']['displayAccountNumber'])]);   
            }
            
            
            
        }
        public function Verify($accnum,$bankcode,$amount){
            $Authorization = trim($this->Token());
            $header =  array(
            "Authorization: Mobiliti ".$Authorization,
            "Content-Type: application/json"
            
            );
            $data = '{
            "memo": "",
            "toAccountNumber": "'.$accnum.'",
            "fromAccountNumber": "1",
            "amount": '.$amount.',
            "bankId": '.$bankcode.',
            "transferType": "one-off"
            }';
            
            $res = $this->Curl('POST',$this->api."api/transfers/verify",$header,$data,false);
            //exit;
            $json = json_decode($res,true);
            if(isset($json['error'])){
                if($json['error']['code'] == "900000"){
                    $this->Auth_Pin();
                    return $this->Verify($accnum,$bankcode,$amount);
                    }else if($json['error']['code'] == "AC05"){
                    return json_encode(['status'=>false,"message"=>"ยอดเงินไม่เพียงพอ"]);   
                    }else if($json['error']['code'] == "AC07"){
                    return json_encode(['status'=>false,"message"=>"เลขบัญชีผิดพลาด"]); 
                }else{
                return json_encode(['status'=>false,"message"=>"เกิดข้อผิดพลาดไม่ทราบสาเหตุ"]); 
                }
                }else{
                $header =  array(
                "Authorization: Mobiliti ".$Authorization,
                "Content-Type: application/x-www-form-urlencoded"
                
                );
                $this->Curl('POST',$this->api."api/transfers",$header,true,false);
                return json_encode(['status'=>true,"message"=>"โอนเงินสำเร็จ"]);    
            }
            
            
            
        }
        public function GetTransaction(){
            $start_date = date('Y-m-d');
            $end_date =  date('Y-m-d');
            $Authorization = trim($this->Token());
            $header =  array(
            "Authorization: Mobiliti ".$Authorization,
            "Content-Type: application/json"
            );
            $res =  $this->Curl('GET',$this->api."api/accounts/1/transactions?fromDate=".$start_date."&accountType=SA&toDate=".$end_date,$header,false,false);
            $json = json_decode($res,true);
            if(isset($json['error'])){
                if($json['error']['code'] == "900000"){
                    $this->Auth_Pin();
                    return $this->GetTransaction();
                }}else{
                return $res;
            }
            //echo $detail = $this->Curl('GET',$this->api."api/accounts/1/transactions/2020092819194024005083208?transactiondt=28%20Sep%202020%2C%2019%3A19",$header,false,false);
            
        }

	
	
}
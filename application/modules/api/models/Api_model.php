<?php
class Api_model extends CI_Model{

    public $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = "site_config";
    }
    public function find_api_key($domain)
    {
        if(!empty($domain)){
            $result = $this->db->where('domain',$domain)->get($this->table);
            return $result->row();
        }else{
            return false;
        }
        
    }
    //api login desktop
    public function api_login($username,$password,$lang){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://authapi.linkv2.com/api/player/login",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>"{\r\n\"UserName\": \"".$username."\",\r\n\"Password\": \"".$password."\",\r\n\"Lang\": \"".$lang."\",\r\n\"Com\": \"IMIBET\"\r\n}\r\n",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
        ),
      ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    //api login mobile
    public function api_login_mobile($username,$password,$lang){
      $curl = curl_init();		
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://authapi.linkv2.com/api/player/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{\r\n\"UserName\": \"".$username."\",\r\n\"Password\": \"".$password."\",\r\n\"Lang\": \"".$lang."\",\r\n\"Com\": \"IMIBET\",\r\n\"IsMobile\" : \"True\"\r\n}\r\n",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;
    }


}
<?php

if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

class Withdraw_bbl_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->helper( 'file' );
    }

    private $api = "https://modernb.bangkokbank.com/";

    private function Token() {

        return file_get_contents( 'public/token/token.txt' );

    }
    private function Curl( $method, $url, $header, $data, $cookie ) {
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36' );
        //curl_setopt($ch, CURLOPT_USERAGENT, 'okhttp/3.8.0');
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        if ( $data ) {
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        }
        if ( $cookie ) {
            curl_setopt( $ch, CURLOPT_COOKIESESSION, true );
            curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
            curl_setopt( $ch, CURLOPT_COOKIEFILE, $cookie );
        }
        $res = curl_exec( $ch );
        $statusCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        if ( $statusCode != 200 ) {
            //die('ปิดปรับปรุง...');    
        }
        return $res;
    }

    /////  [1]
    public function Check( $accnum, $bankcode, $amount, $bankweb_id ) 
	{
        $bankweb_q = $this->db->where( 'id', $bankweb_id )->where( 'status', 3 )->get( 'tb_bank_web' );
        if ( $bankweb_q->num_rows() == 1 ) {
            $bankweb_r = $bankweb_q->row();
            $Authorization = trim( $this->Token() );

            $header = array(
                "Authorization: Mobiliti " . $Authorization,
                "Content-Type: application/json"

            );
            $data = '{
                        "memo": "",
                        "toAccountNumber": "' . $accnum . '",
                        "fromAccountNumber": "1",
                        "amount": ' . $amount . ',
                        "bankId": ' . $bankcode . ',
                        "transferType": "one-off"
                        }';

            $res = $this->Curl( 'POST', $this->api . "api/transfers/verify", $header, $data, false );
            $json = json_decode( $res, true );

            if ( isset( $json[ 'error' ] ) ) {
                if ( $json[ 'error' ][ 'code' ] == "900000" ) {
                    $this->Auth_Pin( $bankweb_r );
                    return $this->Check( $accnum, $bankcode, $amount, $bankweb_id );
                } else if ( $json[ 'error' ][ 'code' ] == "AC05" ) {
                    return json_encode( [ 'status' => false, "message" => "ยอดเงินไม่เพียงพอ" ] );
                } else if ( $json[ 'error' ][ 'code' ] == "AC07" ) {
                    return json_encode( [ 'status' => false, "message" => "เลขบัญชีผิดพลาด" ] );
                } else {
                    return json_encode( [ 'status' => false, "message" => "เกิดข้อผิดพลาดไม่ทราบสาเหตุ" ] );
                }
            } else if(isset($json[ 'toAccount' ][ 'displayAccountName' ] )){
                  
                return json_encode( [ 'status' => true, "message" => array( 'name' => $json[ 'toAccount' ][ 'displayAccountName' ], 'accnum' => $json[ 'toAccount' ][ 'displayAccountNumber' ] ) ] );
            }else{
                return json_encode( [ 'status' => false, "message" => "ระบบไม่สามารถเชื่อต่อกับธนาคารได้" ] );
            }
        }
    }

    /////  [2]
    public function Auth_Pin( $bankweb_r ) 
	{
        $header = array(
            "Preauth-Token: " . trim( $this->PreAuth( $bankweb_r ) ),
            "Content-Type: application/json",

        );

        $data = '{
            "password": "' . $bankweb_r->pin_app . '",
            "deviceToken": "' . $bankweb_r->deviceId . '",
            "locale": "th-TH"
            }';
        $res = $this->Curl_cookie( 'POST', $this->api . "api/authentication/pin", $header, $data, false );
        // print_r($res);
        // die();
        if ( ( strpos( $res, 'MA15' ) == true ) ) {
            return json_encode( [ 'status' => false, "message" => "พินผิด" ] );
            exit;
        } else {

            preg_match_all( '/^bearer-token:\s*([^\n]*)/mi', $res, $matches );

            $bearer_token = base64_decode( trim( $matches[ 1 ][ 0 ] ) );

            if ( isset( $bearer_token ) ) {

                $bearer_token = json_decode( $bearer_token, true );

                $strFileName = "public/token/token.txt";
                // $objFopen = fopen($strFileName, 'w');
                // fwrite($objFopen, $bearer_token['token']);
                write_file( 'public/token/token.txt', $bearer_token[ 'token' ] );
                // die();

                return ( $bearer_token[ 'token' ] );
            } else {
                return json_encode( [ 'status' => false, "message" => "เกิดข้อผิดพลาด" ] );
            }
        }

    }
    /////  [3]
    private function PreAuth( $bankweb_r ) 
	{
        $header = [
            "Content-Type: application/json"
        ];
        $data = '{ "deviceInfo": { "deviceCustomInputMethod": "0", "phoneNumber": "", "deviceInputMethod": "com.google.android.inputmethod.latin/com.android.inputmethod.latin.LatinIME", "screenWidth": 1080, "type": "M2003J15SC", "notificationAddress": "", "uniqueId": "' . $bankweb_r->ApiRefresh . '", "userAgent": "", "deviceIntegrity": 0, "os": "Android", "screenHeight": 2116, "osVersion": "9", "name": "merlin_global" }, "geolocation": { "latitude": 0.0, "longitude": 0.0 }, "applicationPushInfo": { "pushAppId": "com.bbl.mobilebanking", "pushProvider": "GCM" }, "deviceToken": "' . $bankweb_r->deviceId . '", "locale": "th-TH", "applicationInfo": { "protocolVersion": "3.2.1", "versionNumber": "3.2.1", "clientVersion": "3.2.1", "brandingVersion": "3.2.1", "clientType": "android" } }';

        $res = $this->Curl_cookie( 'POST', $this->api . "api/users/app-config", $header, $data, false );

        preg_match_all( '/^preauth-token:\s*([^\n]*)/mi', $res, $matches );

        return $matches[ 1 ][ 0 ];
    }
    /////  [4]
    private function Curl_cookie( $method, $url, $header, $data, $cookie ) 
	{
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36' );
        //curl_setopt($ch, CURLOPT_USERAGENT, 'okhttp/3.8.0');
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_HEADER, 1 );
        if ( $data ) {
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        }
        if ( $cookie ) {
            curl_setopt( $ch, CURLOPT_COOKIESESSION, true );
            curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
            curl_setopt( $ch, CURLOPT_COOKIEFILE, $cookie );
        }
        $result = curl_exec( $ch );
        return $result;
    }

    ////////////////// end ดึงข้อมูลมาตรวจสอบ


    ///// frim auto [1]
    public function Verify( $accnum, $bankcode, $amount, $bankweb_id ) 
	{
        $bankweb_q = $this->db->where( 'id', $bankweb_id )->where( 'status', 3 )->get( 'tb_bank_web' );
        if ( $bankweb_q->num_rows() == 1 ) {
            $bankweb_r = $bankweb_q->row();
            $Authorization = trim( $this->Token() );
            $header = array(
                "Authorization: Mobiliti " . $Authorization,
                "Content-Type: application/json"

            );
            $data = '{
            "memo": "",
            "toAccountNumber": "' . $accnum . '",
            "fromAccountNumber": "1",
            "amount": ' . $amount . ',
            "bankId": ' . $bankcode . ',
            "transferType": "one-off"
            }';

            $res = $this->Curl( 'POST', $this->api . "api/transfers/verify", $header, $data, false );
            //exit;
            $json = json_decode( $res, true );
            if ( isset( $json[ 'error' ] ) ) {
                if ( $json[ 'error' ][ 'code' ] == "900000" ) {
                    $this->Auth_Pin($bankweb_r);
                    return $this->Verify( $accnum, $bankcode, $amount );
                } else if ( $json[ 'error' ][ 'code' ] == "AC05" ) {
                    return json_encode( [ 'status' => false, "message" => "ยอดเงินไม่เพียงพอ" ] );
                } else if ( $json[ 'error' ][ 'code' ] == "AC07" ) {
                    return json_encode( [ 'status' => false, "message" => "เลขบัญชีผิดพลาด" ] );
                } else {
                    return json_encode( [ 'status' => false, "message" => "เกิดข้อผิดพลาดไม่ทราบสาเหตุ" ] );
                }
            } else {
                $header = array(
                    "Authorization: Mobiliti " . $Authorization,
                    "Content-Type: application/x-www-form-urlencoded"

                );
                $this->Curl( 'POST', $this->api . "api/transfers", $header, true, false );
                return json_encode( [ 'status' => true, "message" => "โอนเงินสำเร็จ" ] );
            }
        } else {
            return json_encode( [ 'status' => false, "message" => "โอนเงินไม่สำเร็จ" ] );
        }
    }

    //////end  frim auto
    
    
    
    
    public function Auth( $deviceToken, $uniqueId, $pin ) {

        if ( strlen( $pin ) == 6 || $deviceToken != '' || $uniqueId != '' ) {
            $this->pin = $pin;
            $this->deviceToken = $deviceToken;
            $this->uniqueId = $uniqueId;
        } else {
            echo 'invaid pin deviceToken uniqueId !';
            exit;
        }

    }

	public function GetTransaction($bankweb_id) {
		$bankweb_q = $this->db->where( 'id', $bankweb_id )->where( 'status', 3 )->get( 'tb_bank_web' );
		
        if ( $bankweb_q->num_rows() == 1 ) {
			
			$bankweb_r= $bankweb_q->row();
			
			$start_date 	= date( 'Y-m-d' );
			$end_date 		= date( 'Y-m-d' );
			$Authorization 	= trim( $this->Token() );
			$header = array(
				"Authorization: Mobiliti " . $Authorization,
				"Content-Type: application/json"
			);
			$res = $this->Curl( 'GET', $this->api . "api/accounts/1/transactions?fromDate=" . $start_date . "&accountType=SA&toDate=" . $end_date, $header, false, false );
			$json = json_decode( $res, true );
			if ( isset( $json[ 'error' ] ) ) {
				if ( $json[ 'error' ][ 'code' ] == "900000" ) {
					$this->Auth_Pin($bankweb_r);
					return $this->GetTransaction($bankweb_r->id);
				}
			} else {
				return $res;
			}
		}else{
			return false;
		}
       

    }

    public function GetBalance() {
        $Authorization = trim( $this->Token() );
        $header = array(
            "Authorization: Mobiliti " . $Authorization,
            "Content-Type: application/json"
        );
        $res = $this->Curl( 'GET', $this->api . "api/v1/accounts/?forceRefresh=true", $header, false, false );
        $json = json_decode( $res, true );

        if ( isset( $json[ 'accounts' ] ) ) {
            return json_encode( ( $json[ 'accounts' ][ 0 ][ 'balances' ][ 0 ] ) );
        } else {
            if ( isset( $json[ 'error' ] ) ) {
                if ( $json[ 'error' ][ 'code' ] == "900000" ) {
                    $this->Auth_Pin();
                    return $this->GetBalance();
                }
            }
        }

    }


    


}
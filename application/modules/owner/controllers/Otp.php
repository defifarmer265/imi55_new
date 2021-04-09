<?php
class Otp extends MY_Controller
{
	 public function __construct()
    {
        $this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();
		$this->output->set_template('tem_owner/tem_owner');
        
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }

	public function index()
	{
		$data['otp'] = $this->db->select('tb_otp.*')->group_by('tb_otp.id')->order_by('tb_otp.id','DESC')->limit(500)->get('tb_otp')->result_array();
		$this->load->view('otp',$data);
	}
	public function confrim()
	{
		if($id = $this->input->post('id')){
			if($this->db->set('status',2)->where('id',$id)->update('tb_otp')){
				$re = array('code'=>1,'msg'=>'','title'=>'');
			}else{
				$re = array('code'=>0,'msg'=>'บันทึกข้อมูลไม่สำเร็จ','title'=>'ข้อมูลไม่ครบถ้วน');
			}
		}else{
			$re = array('code'=>0,'msg'=>'กรุณาทำรายการใหม่','title'=>'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}
	public function make_sign(){
		
		
	}
	public function sign()
	{

		
		$time1  = time();
		$data1 	= strtolower('ztq12892'.'ztq1289201');
		$key1 	= strtolower("A644E6C2-EE42-401C-8EC5-C3A55BED20B1");
		$word 	= $data1.$time1.$key1;
		$word_hash = hash('sha256', $word);
		$arr_userAPI = array( 
						'AgentName'	=> 'ztq12892',    
						'PlayerName'=> 'ztq1289201',  
						'TimeStamp'	=> time()  ,
						'sign'=>$word_hash
						);

		$arr_sent = http_build_query($arr_userAPI);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://ctransferapi.linkv2.com/api/credit-transfer/balance',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $arr_sent,
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/x-www-form-urlencoded",
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		echo '<pre>';
		print_r(json_decode($response));
		die();
	}
		public function edit__()
	{
		
//		$arr_userAPI = array( 
//							'AgentName'	=> $this->getapi_model->agent(),    
//							'PlayerName'=> 'ztzz361i000745',
//							'Amount'	=> 200.00,    
//							'TimeStamp'	=> time()  
//						);
//						$dataAPI = array(
//							'type'		=> 'D',
//							'agent' 	=> $this->getapi_model->agent(),
//							'member' 	=> 'ztzz361i000745',
//						);
//
//						$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/withdraw';
//						$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
//					$arr_depAPI = array(
//							'AgentName' 	=> $this->getapi_model->agent(),
//							'PlayerName' 	=> 'zt4040i000018',
//							'Amount' 		=> 100.00,
//							'TimeStamp' 	=> time()
//						);
//					$dataAPI = array(
//							'type'		=> 'D',
//							'agent' 	=> $this->getapi_model->agent(),
//							'member' 	=> 'zt4040i000018',
//						);
//					$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
//					$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI,$url_api,$dataAPI);
//					$cre_userAPI =  $this->getapi_model->sign($dataAPI);

//					$arr_depAPI = array(
//							'StartTime' 	=> '2020-09-01 09:00:00',
//							'EndTime' 		=> '2020-09-01 09:00:30',
//							'Partner' 		=> 'ztzz361',
//							'TimeStamp' 	=> time()
//						);
//					$dataAPI = array(
//							'type'		=> 'GT',
//							'agent' 	=> 'ztzz361',
//							'member' 	=> 'ztzz3610000',
//						);
//					$url_api = 'https://pwlapi.linkv2.com/api/tickets/fetch';
//					$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI,$url_api,$dataAPI);
//					$cre_userAPI =  $this->getapi_model->sign($dataAPI);	
			
			
			echo '<pre>';
		print_r($cre_userAPI);
//			echo '<br>';
//			echo time();
//			echo '<br>';
//			echo $dataAPI['member'];
		die();
	}
	public function test_run(){
		$ss = $this->db->where('status',0)->get('tb_even')->result_array();
		echo '<pre>';
		print_r($ss);
		foreach ($ss as $s){
			$user = $this->db->select('id')->where('user',$s['user'])->get('tb_user');
			if($user->num_rows() == 1 ){
				$arr_depAPI = array(
						'AgentName' 	=> $this->getapi_model->agent(),
						'PlayerName' 	=> $s['user'],
						'Amount' 		=> 100.00,
						'TimeStamp' 	=> time()
					);
				$dataAPI = array(
						'type'		=> 'D',
						'agent' 	=> $this->getapi_model->agent(),
						'member' 	=> $s['user'],
					);
				$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
				$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI,$url_api,$dataAPI);
				$this->db->set('status',1)->where('user',$s['user'])->update('tb_even');
				echo $s['user'];
			}
		}
		die();
	}

	public function sel_tel(){
		$tel = $this->input->post('tel');
		$query  = $this->db->select('*')->where('tel',$tel)->get('tb_otp')->result_array();
		
		$k = 0 ;
		foreach($query as $row){
			$query[$k]['create_time'] = date('d-m-Y H:i:s',$row['create_time']);
			$k++;
		}
		$re = array('code'=>1,'data'=>$query);
		echo json_encode($re);
		die();

	}
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function test_otp(){
		$tel = '0867533379';
		$msg = 'test 0000';
		$Username	= "myalon";
		$Password	= "maprow";
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
		print_r($new_res);
		die();
		return json_encode($new_res);
	}
	function add_point_even()
	{
		$q_even = $this->db->where('status',0)->get('tb_even');
		if($q_even->num_rows() > 0){
			$r_even = $q_even->result_array();
			foreach($r_even as $ev){
				
				$this->db->set('point', '`point`+'.$ev['point'], FALSE);
				$this->db->where('user',$ev['user']);
				$this->db->update('tb_user');
				
				$this->db->set('status',1);
				$this->db->where('user',$ev['user']);
				$this->db->update('tb_even');
				
				echo 'Edit : '.$ev['user'].' Point+'.$ev['point'];
				
			}
			
		}else{
			echo 'ใส่หมดแล้ว';
		}
		die();
	}
}


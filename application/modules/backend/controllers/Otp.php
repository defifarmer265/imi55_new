<?php
class Otp extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('getapi_model');
		$this->load->library('backend/backend_library');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();
	}

	public function index()
	{
		$data['otp'] = $this->db->select('tb_otp.*')->group_by('tb_otp.id')->order_by('tb_otp.id', 'DESC')->limit(500)->get('tb_otp')->result_array();
		$this->load->view('otp', $data);
	}
	public function confrim()
	{
		if ($id = $this->input->post('id')) {
			if ($this->db->set('status', 2)->where('id', $id)->update('tb_otp')) {

				$tel = $this->db->where('id', $id)->get('tb_otp')->row()->tel;
				/*--------------------------log_otp----------------------------------- */
				$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

				$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$hostname = $hostname[0]['hostname'];

				$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
				$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
				$dbname = $dbname[0]['database_name'];
				$time = time();
				$sql = "INSERT INTO log_otp (admin, tel,datetime) 
                VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $tel . "','" . $time . "')";
				if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
				} else {

					$sql = "CREATE TABLE log_otp (
								id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
								admin VARCHAR(20) NOT NULL,
								tel VARCHAR(10) NOT NULL,
								datetime INT(20) NOT NULL
								) CHARACTER SET utf8 COLLATE utf8_general_ci;";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
					$sql = "INSERT INTO log_otp (admin, tel,datetime) 
                    VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $tel . "','" . $time . "')";
					$this->backend_library->query_sql($hostname, $dbname, $sql);
				}
				/*--------------------------end log_otp----------------------------------- */
				$re = array('code' => 1, 'msg' => '', 'title' => '');
			} else {
				$re = array('code' => 0, 'msg' => 'บันทึกข้อมูลไม่สำเร็จ', 'title' => 'ข้อมูลไม่ครบถ้วน');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}
	public function make_sign()
	{
        $user = $this->db->where('status',0)->limit(50)->get('tb_even')->result_array();
        foreach($user as $us){
            $point = $us['point'] * 0.002;
            
            $arr_userAPI = array( 
                'AgentName'	=> $this->getapi_model->agent(),    
                'PlayerName'=> $us['user'],
                'Amount'	=> (int) $point,    
                'TimeStamp'	=> time()  
            );
            $dataAPI = array(
                'type'		=> 'D',
                'agent' 	=> $this->getapi_model->agent(),
                'member' 	=> $us['user'],
            );

            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
            $cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
            
            echo '<pre>';
            echo $us['user'] .' - '.(int) $point.' - '.$us['point'];
            $this->db->set('status',1)->where('user',$us['user'])->update('tb_even');
            $this->db->set('point',0)->where('user',$us['user'])->update('tb_user');
        }
        die();
	}

	public function edit__()
	{
//        $user = $this->db->where('status',0)->get('tb_even')->result_array();
//        foreach ($user as $us=>$u){
//            $arr_userAPI = array( 
//									'AgentName'	=> $this->getapi_model->agent(),    
//									'PlayerName'=> $u['user'],
//									'Amount'	=> $u['point'],    
//									'TimeStamp'	=> time()  
//								);
//								$dataAPI = array(
//									'type'		=> 'D',
//									'agent' 	=> $this->getapi_model->agent(),
//									'member' 	=> $u['user'],
//								);
//		
//								$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
//								$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
//            
//            echo '<pre>';
//            echo $u['user'] .' - '. $u['point'];
//            $this->db->set('status',1)->where('id',$u['id'])->update('tb_even');
//            die();
//        }
//        die();
//				$arr_userAPI = array( 
//									'AgentName'	=> $this->getapi_model->agent(),    
//									'PlayerName'=> 'ztzz361i000745',
//									'Amount'	=> 200.00,    
//									'TimeStamp'	=> time()  
//								);
//								$dataAPI = array(
//									'type'		=> 'D',
//									'agent' 	=> $this->getapi_model->agent(),
//									'member' 	=> 'ztzz361i000745',
//								);
//		
//								$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/withdraw';
//								$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
        
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
	public function test_run()
	{
		$ss = $this->db->where('status', 0)->get('tb_even')->result_array();
		echo '<pre>';
		print_r($ss);
		foreach ($ss as $s) {
			$user = $this->db->select('id')->where('user', $s['user'])->get('tb_user');
			if ($user->num_rows() == 1) {
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
				$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
				$this->db->set('status', 1)->where('user', $s['user'])->update('tb_even');
				echo $s['user'];
			}
		}
		die();
	}

	public function sel_tel()
	{
		$tel = $this->input->post('tel');
		$query  = $this->db->select('*')->where('tel', $tel)->get('tb_otp')->result_array();

		$k = 0;
		foreach ($query as $row) {
			$query[$k]['create_time'] = date('d-m-Y H:i:s', $row['create_time']);
			$k++;
		}
		$re = array('code' => 1, 'data' => $query);
		echo json_encode($re);
		die();
	}
	function get_client_ip()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if (getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if (getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if (getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if (getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if (getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function test_otp()
	{
		$tel = '0867533379';
		$msg = 'test 0000';
		$Username	= "myalon";
		$Password	= "maprow";
		$PhoneList	= $tel; //"xxxxxxx;xxxxxxx;xxxxxx;"
		$Message	= urlencode(iconv("UTF-8", "TIS-620", $msg));
		$Sender		= "IMI";
		$Parameter	= "User=$Username&Password=$Password&Msnlist=$PhoneList&Msg=$Message&Sender=$Sender";
		$API_URL	= "http://member.smsmkt.com/SMSLink/SendMsg/index.php";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $Parameter);

		$Result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		//Status=0,Detail=31081910/20691.
		$d1 = explode(',', $Result);
		//Status=-101,
		// Detail=Parameter not complete.
		$new_res = [];
		for ($i = 0; $i < count($d1); $i++) {
			$d2 = explode('=', $d1[$i]);
			$new_res[$d2[0]] = $d2[1];
		}
		print_r($new_res);
		die();
		return json_encode($new_res);
	}
	function add_point_even()
	{
		$q_even = $this->db->where('status', 0)->get('tb_even');
		if ($q_even->num_rows() > 0) {
			$r_even = $q_even->result_array();
			foreach ($r_even as $ev) {

				$this->db->set('point', '`point`+' . $ev['point'], FALSE);
				$this->db->where('user', $ev['user']);
				$this->db->update('tb_user');

				$this->db->set('status', 1);
				$this->db->where('user', $ev['user']);
				$this->db->update('tb_even');

				echo 'Edit : ' . $ev['user'] . ' Point+' . $ev['point'];
			}
		} else {
			echo 'ใส่หมดแล้ว';
		}
		die();
	}
}

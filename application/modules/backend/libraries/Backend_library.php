<?php
class backend_library
{
	public $CI;
	public $class;
	public $method;
	function __construct()
	{

		$this->CI = &get_instance();
		$this->class = $this->CI->router->fetch_class();
		$this->method = $this->CI->router->fetch_method();
		$this->CI->load->library('backend/google_authenticator');
		$this->username = "imicenter";
		$this->password = "aa123654";
	}
	function checkLoginAdmin()
	{
		// comment พอ อย่าลบขอบคุณครับ
		$query = $this->CI->db->where('id', '1')->get('tb_service_charge')->row();
		if ($query->confirm_web == 1) { //เงือนไขนี้สำหรับกรณีที่โปรแกรมปิด หลังบ้าน ต่อให้ owner กดเปิดก็ไม่ได้ต้องให้ โปรแกรมเมอร์เป็นคนเปิดเท่านั้น
			redirect('backend/home');
		} else {
			//ใช้สำหรับกรณี owner ปิด backend 
			$query_b = $this->CI->db->where('id', '3')->get('tb_service_charge')->row();
			if ($query_b->confirm_web == 1) {
				redirect('backend/home');
			} else {

				if ($this->CI->session->admin == '') {
					redirect(base_url() . 'backend/home/');
				}
				$token = $this->CI->session->admin['token'];
				($this->CI->session->admin);
				$users = $this->CI->db->where('token', $token)->get('tb_login')->num_rows();
				//  die();
				// 
				if (!$users) {
					$this->CI->session->unset_userdata('admin');
					redirect(base_url());
				}
				if ($users != 1) {
					echo "<script> alert('มียูสเข้าระบบ')</script>";
					$this->CI->session->unset_userdata('admin');
					redirect(base_url());
				}
				return true;
			}
		}
	}
	public function select_sql($servername, $dbname, $sql)
	{
		$conn = mysqli_connect($servername, $this->username, $this->password, $dbname); //(host,username_imicenter,password_imicenter,dbname)
		mysqli_set_charset($conn, "utf8");
		if ($conn) {
			$result = mysqli_query($conn, $sql);
			$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
			mysqli_close($conn);
			return $data;
		} else {
			return false;
		}
	}
	public function query_sql($servername, $dbname, $sql)
	{
		$conn = mysqli_connect($servername, $this->username, $this->password, $dbname);
		mysqli_set_charset($conn, "utf8");
		if ($conn) {
			$q = mysqli_query($conn, $sql);
			mysqli_close($conn);
			return $q;
		} else {
			return false;
		}
	}

	
	public function check_login($token)
	{
		$users = $this->CI->db->where('token', $token)->get('tb_login')->num_rows();
		if (!$users) {
			$this->CI->session->unset_userdata('admin');
			redirect(base_url());
		}
		if ($users != 1) {
			$this->CI->session->unset_userdata('admin');
			redirect(base_url());
		}
		return true;
	}

	public function login($username, $password, $safecode = FALSE,$pin)
	{
		// ค่ารีเทิร์นกลับ [status] [message]

		$resp = array();
		if ($_POST['username']) {
			$check_user = $this->CI->db->where('username', $username)->get('tb_login')->row();
			if ($check_user) {

				if (empty($password) && empty($safecode)) {
					$resp['status'] = '0';
					$resp['message'] = 'Username และ Password ไม่ถูกต้อง';
					return $resp;
				} else {
					$safecodes = $_POST['safecode'];
					$users  = $this->CI->db->where('username', $username)->get('tb_login')->row();
					$update = $this->CI->db->set('status_login', 1)->where('id', $users->id)->update('tb_login');

					if ($users) {
						if ($this->hash_password($password, $users->salt) != $users->password) {
							$resp['status'] = '0';
							$resp['message'] = 'ชื่อผู้ใช้และรหัสผ่านไม่ถูกต้อง!';
							return $resp;
						}

						if ($users->status == 0) {
							//รหัสผ่านผิดพลาด!
							$resp['status'] = '0';
							$resp['message'] = 'Lock admin';
							return $resp;
						}

						if ($users->safestatus == 1) {

							if ($safecodes != $users->safecode) {
								//เซฟโค้ดผิดไม่ตรง กรุณาแจ้งหัวหน้ารอบ
								$resp['status'] = '0';
								$resp['message'] = 'เซฟโค้ดผิดไม่ตรง กรุณาแจ้งหัวหน้ารอบ !';
								return $resp;
							}
							//check Time Safe code 5 min (60*5)
							$exptime = (int)$users->safetime + 300;


							if ($users->safetime == '' || time() > $exptime) {
								//เซฟโค้ดผิดไม่ตรง กรุณาแจ้งหัวหน้ารอบ
								$resp['status'] = '0';
								$resp['message'] = 'เซฟโค้ดหมดเวลา กรุณาแจ้งหัวหน้ารอบ !';
								return $resp;
							}
						}
						// Log Login
						$arr_log = array(
							'admin_id' 	=> $users->username,
							'time_login' => time(),
							'time_logout' => '',
							'ip_login'  => $users->last_ip
						);
						$log_login = $this->CI->db->insert('log_login', $arr_log);

						if (!$log_login) {
							$resp['status'] = '0';
							$resp['message'] = 'Log Loing Error!';
							return $resp;
						}

						// Last Login
						$last_login = array(
							'last_login' => time(),
							'last_ip' => $this->CI->input->ip_address()
						);
						$hasUpdate = $this->CI->db->where('id', $users->id)->update('tb_login', $last_login);
						if (!$hasUpdate) {
							$resp['status'] = '0!';
							$resp['message'] = 'Last Loing Error!';
							return $resp;
						}

						//Set session

						$ch_ft = json_decode($users->two_factor);
						if($pin==null && $ch_ft->status=="on"){
							$resp['status'] = '3';
							$resp['message'] = 'กรุณากรอกรหัสชั้นที่2';
							return $resp;
						}elseif($pin!=null){
								$checkResult = $this->CI->google_authenticator->verifyCode($ch_ft->key, $pin, 2);    // 2 = 2*30sec clock tolerance
								if ($checkResult) {
									$Set_session = $this->_setSettion($users);
									$resp['status'] = $Set_session['status'];
									$resp['message'] = $Set_session['message'];
									return $resp;
								} else {
									$resp['status'] = '0';
									$resp['message'] = 'รหัสไม่ถูกต้อง.';
									return $resp;
								}

						}
						$Set_session = $this->_setSettion($users);
						$resp['status'] = $Set_session['status'];
						$resp['message'] = $Set_session['message'];
						return $resp;
					}
				}
			} else {
				$resp['status'] = '0';
				$resp['message'] = 'ไม่พบข้อมูลผู้ใช้งานในระบบนี้';
				return $resp;
			}
		} else {
			$resp['status'] = '0';
			$resp['message'] = 'กรุณากรอกข้อมูล';
			return $resp;
		}
		return $resp;
	}


	public function _setSettion($users)
	{
		$bytes = random_bytes(25);
		$token = bin2hex($bytes);
		$tokenUpdate = $this->CI->db->set('token', $token)->where('id', $users->id)->update('tb_login');
		if (!$tokenUpdate) {
			$resp['status'] = '0!';
			$resp['message'] = 'Last Token Error!';
			return $resp;
		}
		$set_session = array(
			'id' 		=> $users->id,
			'name' 		=> $users->name,
			'username' 	=> $users->username,
			'agent' 	=> $users->agent,
			'tel' 		=> $users->tel,
			'class'		=> $users->class,
			'safecode'	=> $users->safecode,
			'status_login' => $users->status_login,
			'rounds' 	=> $users->rounds,
			'token'		=> $token
		);
		$this->CI->session->set_userdata('admin', $set_session);
		$this->CI->session->set_userdata('users', $set_session);
		return ['status'=>'1','message' => 'ยินดีต้อนรับคุณ ' . $users->username . ' เข้าสู่ระบบ'];
	}

	//เข้ารหัส
	public function salt()
	{
		$raw_salt_len = 16;
		$buffer = '';

		$bl = strlen($buffer);
		for ($i = 0; $i < $raw_salt_len; $i++) {
			if ($i < $bl) {
				$buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
			} else {
				$buffer .= chr(mt_rand(0, 255));
			}
		}

		$salt = $buffer;

		$base64_digits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
		$bcrypt64_digits = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$base64_string = base64_encode($salt);
		$salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);

		$salt = substr($salt, 0, 31);

		return $salt;
	}
	//เข้ารหัส
	public function hash_password($password, $salt)
	{
		if (empty($password)) {
			return false;
		}

		return sha1($password . $salt);
	}

	// -
	public function vendor()
	{

		return array(
			["id" => "1", "VendorCode" => "M8", "VendorName" => "M-Sports"],
			["id" => "2", "VendorCode" => "SSport", "VendorName" => "S-Sports"],
			["id" => "5", "VendorCode" => "AB", "VendorName" => "AllBet"],
			["id" => "7", "VendorCode" => "AG", "VendorName" => "AG Deluxe Suite"],
			["id" => "9", "VendorCode" => "PT", "VendorName" => "SkyWind"],
			["id" => "15", "VendorCode" => "MX", "VendorName" => "Pragmatic"],
			["id" => "16", "VendorCode" => "ACE333", "VendorName" => "ACE333"],
			["id" => "17", "VendorCode" => "CF", "VendorName" => "CockFight"],
			["id" => "20", "VendorCode" => "CQ9", "VendorName" => "CQ9"],
			["id" => "21", "VendorCode" => "GG", "VendorName" => "Global Gaming"],
			["id" => "22", "VendorCode" => "WM", "VendorName" => "WM"],
			["id" => "23", "VendorCode" => "LS", "VendorName" => "Lucky Streak"],
			["id" => "25", "VendorCode" => "KN", "VendorName" => "Keno Lottery"],
			["id" => "26", "VendorCode" => "ML", "VendorName" => "ML lottery"],
			["id" => "29", "VendorCode" => "DG", "VendorName" => "Dream Gamming"],
			["id" => "31", "VendorCode" => "GD", "VendorName" => "Gold Deluxe Casino"],
			["id" => "32", "VendorCode" => "SB", "VendorName" => "Sexy Baccarat"],
			["id" => "33", "VendorCode" => "VT", "VendorName" => "Virtual Tech"],
			["id" => "35", "VendorCode" => "CT855", "VendorName" => "CT855"],
			["id" => "36", "VendorCode" => "SA", "VendorName" => "SA Gaming"],
			["id" => "37", "VendorCode" => "OG", "VendorName" => "OG Poker"],
			["id" => "38", "VendorCode" => "LEG", "VendorName" => "LE Gaming"],
			["id" => "39", "VendorCode" => "SAE", "VendorName" => "SA Gaming EGames"],
			["id" => "40", "VendorCode" => "FGG", "VendorName" => "Fair Guaranted Gaming"],
			["id" => "41", "VendorCode" => "IA", "VendorName" => "IA E-Sports"],
			["id" => "43", "VendorCode" => "EVO", "VendorName" => "Evolution Live Casino"],
			["id" => "44", "VendorCode" => "JOKER", "VendorName" => "JOKER"],
			["id" => "45", "VendorCode" => "DPT", "VendorName" => "PlayTech Digital"],
			["id" => "46", "VendorCode" => "BG", "VendorName" => "BG Live Casino"],
			["id" => "47", "VendorCode" => "BGE", "VendorName" => "BG E-Game"],
			["id" => "48", "VendorCode" => "C93", "VendorName" => "93 Connect"],
			["id" => "49", "VendorCode" => "BS", "VendorName" => "BetSoft"],
			["id" => "50", "VendorCode" => "DT", "VendorName" => "DreamTech"],
			["id" => "51", "VendorCode" => "MaxBet", "VendorName" => "Max Bet"],
			["id" => "52", "VendorCode" => "SBO", "VendorName" => "SBO Sport"],
			["id" => "54", "VendorCode" => "SBOVS", "VendorName" => "SBO Virtual Sport"],
			["id" => "4", "VendorCode" => "EZUGI", "VendorName" => "EZUGI"],
			["id" => "56", "VendorCode" => "PPL", "VendorName" => "Pragmatic Play Live"],
			["id" => "53", "VendorCode" => "IG", "VendorName" => "IG E-games"],
			["id" => "57", "VendorCode" => "QQ", "VendorName" => "QQLottery"]

		);
	}
}

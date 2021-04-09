<?php
class Backend_libraries
{
	public $CI;
	public $class;
	public $method;
	function __construct()
	{
		$this->CI = &get_instance();
		$this->class = $this->CI->router->fetch_class();
		$this->method = $this->CI->router->fetch_method();
		$this->username = "imicenter";
		$this->password = "aa123654";
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
	public function logout()
	{
		$this->CI->session->unset_userdata('admin');
		redirect(base_url() . 'backend/home');
	}
	public function login($username, $password, $safecode = FALSE)
	{
		// ค่ารีเทิร์นกลับ [status] [message]
		$resp = array();

		if (empty($username) && empty($password) && empty($safecode)) {
			$resp['status'] = '0';
			$resp['message'] = 'ข้อมูลไม่ครบถ้วน';
			return $resp;
		}

		$users = $this->CI->db->where('username', $username)->get('tb_login')->row();
		if ($users) {

			if ($this->hash_password($password, $users->salt) != $users->password) {
				//รหัสผ่านผิดพลาด!
				$resp['status'] = '0';
				$resp['message'] = 'รหัสผ่านผิดพลาด!';
				return $resp;
			}
			if ($users->status == 0) {
				//รหัสผ่านผิดพลาด!
				$resp['status'] = '0';
				$resp['message'] = 'Lock admin';
				return $resp;
			}

			//check Safe code [ 0=close , 1=open ]
			if ($users->safestatus == 1) {

				if ($safecode != $users->safecode) {
					//เซฟโค้ดผิดไม่ตรง กรุณาแจ้งหัวหน้ารอบ
					$resp['status'] = '0';
					$resp['message'] = 'เซฟโค้ดผิดไม่ตรง กรุณาแจ้งหัวหน้ารอบ !';
					return $resp;
				}

				//check Time Safe code 5 min (60*5)
				$exptime = $users->safetime + 300;
				if ($users->safetime == '' || time() > $exptime) {
					//เซฟโค้ดผิดไม่ตรง กรุณาแจ้งหัวหน้ารอบ
					$resp['status'] = '0';
					$resp['message'] = 'เซฟโค้ดหมดเวลา กรุณาแจ้งหัวหน้ารอบ !';
					return $resp;
				}
			}

			// Log Login
			$arr_log = array(
				'admin_id' 	=> $users->id,
				'time_login' => time(),
				'time_logout' => '',
				'ip_login'  => $users->last_ip
			);
			$log_login = $this->CI->db->insert('log_login', $arr_log);
			if (!$log_login) {
				$resp['status'] = '0!';
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
				'rounds' 	=> $users->rounds,
				'token'		=> $token
			);
			$this->CI->session->set_userdata('admin', $set_session);

			$this->CI->session->set_userdata('users', $set_session);
			$resp['status'] = '1';
			$resp['message'] = 'สำเร็จ !!';
		} else {
			$resp['status'] = '0';
			$resp['message'] = 'ไม่มียูเซอร์ !!';
		}
		return $resp;
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
}

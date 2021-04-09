<?php

/**
 *
 */
class Users_library
{

	public $CI;
	public $class;
	public $method;


	public function __construct()
	{
		$this->CI = &get_instance();
		$this->class = $this->CI->router->fetch_class();
		$this->method = $this->CI->router->fetch_method();
		$this->CI->load->model('users/users_model');
	}

	/* ----------------------encrypt_data----------------------------------------- */
	public function encrypt_data($action,$string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'This is my secret key';
		$secret_iv = 'This is my secret iv';

		// hash
		$key = substr(hash('sha256', $secret_key), 0, 32);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a
		// warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if ($action == 'encrypt') {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else {
			if ($action == 'decrypt') {
				$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
			}
		}
		return $output;
	}
	/*----------------------------end--------------------------------------------- */
	public function _is_logged_in()
	{

		return (bool) $this->CI->session->userdata('users');
	}


	public function login($username, $password, $safecode, $remember = FALSE)
	{
		$resp = array();
		if (empty($username) && empty($password) && empty($safecode)) {
			$resp['status'] = 'error';
			$resp['message'] = 'no input your password or  safecode!!';
			return $resp;
		}

		$users = $this->CI->users_model->find_users_by_user($username);

		if ($users) {

			if ($this->hash_password($password, $users->salt) != $users->password) {
				$resp['status'] = 'warning';
				$resp['message'] = 'incorrect password !';
				return $resp;
			}

			if ($safecode != $users->safecode) {
				$resp['status'] = 'warning';
				$resp['message'] = 'incorrect safecode !';
				return $resp;
			}
			if ($users->class != 0) {
				$timenow = time();
				$timesafe = $users->safetime;
				$safetime = date("d-m-Y H:i:s", $timesafe);
				$safetimech = date("Y-m-d H:i:s", strtotime($safetime . "+5 minutes"));
				if ($timenow >  strtotime($safetimech)) {
					$resp['status'] = 'warning';
					$resp['message'] = 'safecode expire !';
					return $resp;
				}
				// if($users->status_safe == 1){
				// 	$resp['status'] = 'warning';
				// 	$resp['message'] = 'safecode has been used !';
				// 	return $resp;
				// }
			}

			if ($users->status == 2) {
				$resp['status'] = 'danger';
				$resp['message'] = 'User Admin Close !!';
				return $resp;
			}
			// set session
			$arr_log = array(
				'admin_id' 	=> $users->id,
				'time_login' => time(),
				'time_logout' => '',
				'ip_login'  => $users->last_ip
			);
			$log_login = $this->CI->users_model->insert_log($arr_log);
			$this->_set_session($users);

			if ($remember) {
				$this->_set_session($users);
			}

			$hasUpdate = $this->CI->users_model->update_last_login($users->id, 'LoginPage');

			if ($hasUpdate) {
				$resp['status'] = 'Success!';
				$resp['message'] = 'login completed !';
				return $resp;
			} else {
				$resp['status'] = 'error';
				$resp['message'] = 'system error !!';
				return $resp;
			}
		} else {
			$resp['status'] = 'warning';
			$resp['message'] = 'password undefind !!';
			return $resp;
		}
	}



	private function _set_session($users)
	{
		$set_session = array(

			'id' 		=> $users->id,
			'name' 		=> $users->name,
			'username' 	=> $users->username,
			'agent' 	=> $users->agent,
			'tel' 		=> $users->tel,
			'class'		=> $users->class,
			'safecode'	=> $users->safecode,
			'rounds' => $users->rounds
		);

		$this->CI->session->set_userdata('users', $set_session);
	}


	// Hash pass

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

	public function hash_password($password, $salt)
	{
		if (empty($password)) {
			return false;
		}

		return sha1($password . $salt);
	}
}

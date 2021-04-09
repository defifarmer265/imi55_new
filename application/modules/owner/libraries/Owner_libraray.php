<?php
class Owner_libraray
{
	public $CI;
	public $class;
	public $method;
	 function __construct()
	{
		$this->CI =& get_instance();
		$this->class = $this->CI->router->fetch_class();
		$this->method = $this->CI->router->fetch_method(); 

	}
	public function login()
	{
		$query = $this->CI->db->where('id','1')->get('tb_service_charge')->row();
		if($query->confirm_web != 1){
			if($this->CI->session->owner != ''){
			
				$owner_session = $this->CI->session->owner;
			
				if($owner_session->id != '' && $owner_session->username != ''){
					$owner_q 	= $this->CI->db
						->where('id',$owner_session->id)
						->where('username',$owner_session->username)
						->where('token_login',$owner_session->token_login)
						->where('status',1)
						->get('tb_owner');
					if($owner_q->num_rows() == 1){
						
					}else{
						$this->CI->session->owner = '';
						redirect(base_url().'owner/');
					}
				}else{
					$this->CI->session->owner = '';
					redirect(base_url().'owner/');
				}
			}else{
				
				$this->CI->session->owner = '';
				redirect(base_url().'owner/');
			}
		
		}else{
			redirect(base_url().'owner/');
		}
		
	 
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
	public function salt()
	{
		$raw_salt_len = 16;
		$buffer = '';

		$bl = strlen($buffer);
		for($i = 0; $i < $raw_salt_len; $i++){
			if($i < $bl){
				$buffer[$i] = $buffer[$i] ^ chr(mt_rand(0,255));
			}else{
				$buffer .= chr(mt_rand(0,255));
			}
		}

		$salt = $buffer;

		$base64_digits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
		$bcrypt64_digits ='./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$base64_string = base64_encode($salt);
		$salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);

		$salt = substr($salt, 0, 31);
         
		return $salt;
	}

	public function hash_password($password)
	{

		if(empty($password)){
			return false;
		}

		return sha1($password);
	} 

}

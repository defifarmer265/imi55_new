<?php
class Sale_libraray
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
		$query_b = $this->CI->db->where('id',2)->get('tb_service_charge')->row();

		if($query->confirm_web != 1){ // ถ้าเงือนไขแรก ไม่มีการปิด ให้วิ่งไปหน้า login
			if($query_b->confirm_web ==1){ //ถ้าเงือนไขสอง ไม่มีการปิด ให้วิ่งไปหน้า sale
				redirect(base_url().'sale/');

			}else{
				if($this->CI->session->sale != ''){
				
					$sale_session = $this->CI->session->sale;
				
					if($sale_session->id != '' && $sale_session->username != ''){
						$sale_q 	= $this->CI->db
							->where('id',$sale_session->id)
							->where('username',$sale_session->username)
							->where('token_login',$sale_session->token_login)
							->where('status',1)
							->get('tb_sale');
						if($sale_q->num_rows() == 1){
							
						}else{
							$this->CI->session->sale = '';
							redirect(base_url().'sale/');
						}
					}else{
						$this->CI->session->sale = '';
						redirect(base_url().'sale/');
					}
				}else{
					$this->CI->session->sale = '';
					redirect(base_url().'sale/');
				}
			}
		}else{
			redirect(base_url().'sale/');
		}
	}
	function log_sale($type,$detail){
		$log_arr = array(
				"sale_id" 	=> $this->CI->session->sale->id,
				"type" 	    => 'login',
				"detail" 	=> $detail,
				"datetime" 	=> time(),
				"status" 	=>1, 
			  );
       $log_save = $this->CI->db->insert('log_sale',$log_arr);
//			$log_save = $this->CI->getapi_model->call_API_mongo($log_arr, "POST");
		return $log_save;
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

	public function hash_password($password,$salt)
	{

		if(empty($password)){
			return false;
		}

		return sha1($password.$salt);
	} 

}

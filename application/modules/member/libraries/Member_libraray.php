<?php
class Member_libraray
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
		$maintenance  = $this->CI->db->select('status')->where('id',3)->get('maintenance')->row();
		if($maintenance->status == 1){
			if($this->CI->session->member != ''){
				$member = $this->CI->session->member;
				if($member->id != '' && $member->user != ''){
					$user_id = $member->id ;
					$user = $member->user;
					$user_q = $this->CI->db->where('id',$user_id)->where('user',$user)->where('status',1)->get('tb_user');
					if($user_q->num_rows() == 1){

					}else{
						$this->CI->session->member = '';
						redirect(base_url().'users/home');

					}
				}else{
					$this->CI->session->member = '';
					redirect(base_url().'users/home');
				}
			}else{
				$this->CI->session->member = '';
				redirect(base_url().'users/home');
			}
		}else{
			$this->CI->session->member = '';
			redirect(base_url().'users/home');
		}
		
	}


}

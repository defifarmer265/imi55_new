<?php

class Admin extends MY_Controller
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

	public function index()
	{
		if($this->session->owner->class == 0){ //หัวหน้าใหญ่
			$admin_r = $this->db->where('id !=',1)->where('id !=',156)->where('id !=',155)->get('tb_login');
		}else if($this->session->owner->class == 1){ //หัวหน้า
			$admin_r = $this->db->where('class !=',0)->where('id !=',1)->where('id !=',156)->where('id !=',155)->get('tb_login');
		}else{ 
			$admin_r = $this->db->where('class !=',0)->where('class !=',1)->where('id !=',1)->where('id !=',156)->where('id !=',155)->get('tb_login');
		}

		$q_rounds = $this->db->get('tb_admin_rounds');
		$data['admin'] = $admin_r->result_array();
		$data['menu']  = 'admin';
		$data['rounds'] = $q_rounds->result_array();
		$data['menu']  = 'rounds';
		

		$this->load->view('admin',$data);	


	}
	public function cre_admin(){
		$check_admin =  $this->db->where('username',$this->input->post('username').'@'.$this->getapi_model->agent())->get('tb_login');
		if($check_admin->num_rows() <= 0){
		if($pwd = $this->input->post('password')){
			if($username = $this->input->post('username')){
				if($name = $this->input->post('name')){
						$salt = $this->salt();
						$password =  $this->hash_password($pwd,$salt);
						$dataCreate = array(
							'username' 	=> $username.'@'.$this->getapi_model->agent(),
							'agent' 	=> $this->getapi_model->agent(),
							'password' 	=> $password,
							'salt' 		=> $salt,
							'name' 		=> $name,
							'rounds'	=> $this->input->post('rounds'),
							'last_login'=> 0,
							'last_ip'	=> 0,
							'class'		=> $this->input->post('type'),
							'status'	=> '1',
							'creator_id'=> $this->session->userdata['users']['id']
						);
						
						if($this->db->insert('tb_login',$dataCreate) == 1){
							if(!empty($this->input->post('register'))){$register = 1;}else{$register = 0;}
							if(!empty($this->input->post('deposit'))){$deposit = 1;}else{$deposit = 0;}
							if(!empty($this->input->post('withdraw'))){$withdraw = 1;}else{$withdraw = 0;}
							if(!empty($this->input->post('promotion'))){$promotion = 1;}else{$promotion = 0;}
							if(!empty($this->input->post('bank'))){$bank = 1;}else{$bank = 0;}
							if(!empty($this->input->post('bank_user'))){$bank_user = 1;}else{$bank_user = 0;}
							if(!empty($this->input->post('admin'))){$admin = 1;}else{$admin = 0;}
							if(!empty($this->input->post('user'))){$user = 1;}else{$user = 0;}
							if(!empty($this->input->post('winlose'))){$winlose = 1;}else{$winlose = 0;}
							if(!empty($this->input->post('report'))){$report = 1;}else{$report = 0;}
							if(!empty($this->input->post('systems'))){$systems = 1;}else{$systems = 0;}
							$licenseArray = array(
								'admin_id' 	=> $this->db->insert_id(),
								'register' 	=> $register,
								'deposit' 	=> $deposit,
								'withdraw' 	=> $withdraw,
								'promotion' => $promotion,
								'bank' 		=> $bank,
								'bank_user' => $bank_user,
								'admin' 	=> $admin,
								'user' 		=> $user,
								'winlose' 	=> $winlose,
								'report' 	=> $report,
								'systems' 	=> $systems,
								'status' 	=> 1
							);
							if($this->db->insert('tb_class_admin', $licenseArray)){
								$re = array('msg' =>'ยูเซอร์ซ้ำ','code'=> 1 );
								
							}else{
								$re = array('msg' =>'ยูเซอร์ซ้ำ','code'=> 0 );
							}
						}else{
							$re = array('msg' =>'ยูเซอร์ซ้ำ','code'=> 0 );
						}
				}else{
					$re = array('msg' =>'มีปัญหา ข้อมูลไม่ครบ','code'=> 0 );
				}
			}else{
				$re = array('msg' =>'มีปัญหา ข้อมูลไม่ครบ','code'=> 0 );
			}
		}else{
			$re = array('msg' =>'มีปัญหา ข้อมูลไม่ครบ','code'=> 0 );
		}
		}else{
			$re = array('msg' =>'ยูเซอร์ซ้ำ','code'=> 0 );
		}
		echo json_encode($re);
		die();
		
	}
	public function edit_type()
	{
		// $a = $this->input->post('admin_id');
		// print_r($a);die();
		if( $this->input->post('admin_id')){
			$type 		= $this->input->post('type');
			$admin_id 	= $this->input->post('admin_id');
			if($this->db->set('class',$type)->where('id',$admin_id)->update('tb_login')){
				$re = array('title'=>'Success','msg' =>'Sucess : 001','code'=> 1 );
			}else{
				$re = array('title'=>'Error','msg' =>'Error : 002','code'=> 0 );
			}
		}else{
			$re = array('title'=>'Error','msg' =>'Error : 001','code'=> 0 );
		}
		echo json_encode($re);
		die();
	}
	

	public function edit_rounds()
	{		
		if( $this->input->post('admin_id')){
			$rounds 		= $this->input->post('edit_rounds');
			$admin_id 	= $this->input->post('admin_id');
			if($this->db->set('rounds',$rounds)->where('id',$admin_id)->update('tb_login')){
				$re = array('title'=>'Success','msg' =>'Sucess : 001','code'=> 1 );
			}else{
				$re = array('title'=>'Error','msg' =>'Error : 002','code'=> 0 );
			}
		}else{
			$re = array('title'=>'Error','msg' =>'Error : 001','code'=> 0 );
		}
		echo json_encode($re);
		die();
	}

	public function get_license(){
		$license = $this->db->where('admin_id',$this->input->post('admin_id'))->get('tb_class_admin')->row();
		echo json_encode($license);
		die();
	}
	
	public function get_class(){
		$class = $this->db->where('id',$this->input->post('id'))->get('tb_login')->row();
		// print_r($class);
		echo json_encode($class);
		die();
	}
	public function get_rounds(){
		$rounds = $this->db->where('id',$this->input->post('id'))->get('tb_login')->row();
		echo json_encode($rounds);
		die();
	}
	
	public function edit_license(){
//		echo '<pre>' ;print_r($this->input->post());die();
		$q_class = $this->db->where('admin_id',$this->input->post('admin_id'))->get('tb_class_admin');
		
		if(!empty($this->input->post('register'))){$register = 1;}else{$register = 0;}
		if(!empty($this->input->post('deposit'))){$deposit = 1;}else{$deposit = 0;}
		if(!empty($this->input->post('withdraw'))){$withdraw = 1;}else{$withdraw = 0;}
		if(!empty($this->input->post('promotion'))){$promotion = 1;}else{$promotion = 0;}
		if(!empty($this->input->post('bank'))){$bank = 1;}else{$bank = 0;}
		if(!empty($this->input->post('bank_user'))){$bank_user = 1;}else{$bank_user = 0;}
		if(!empty($this->input->post('admin'))){$admin = 1;}else{$admin = 0;}
		if(!empty($this->input->post('user'))){$user = 1;}else{$user = 0;}
		if(!empty($this->input->post('winlose'))){$winlose = 1;}else{$winlose = 0;}
		if(!empty($this->input->post('report'))){$report = 1;}else{$report = 0;}
		if(!empty($this->input->post('systems'))){$systems = 1;}else{$systems = 0;}
		$licenseArray = array(
			'admin_id'	=> $this->input->post('admin_id'),
			'register' 	=> $register,
			'deposit' 	=> $deposit,
			'withdraw' 	=> $withdraw,
			'promotion' => $promotion,
			'bank' 		=> $bank,
			'bank_user' => $bank_user,
			'admin' 	=> $admin,
			'user' 		=> $user,	
			'winlose' 	=> $winlose,
			'report' 	=> $report,
			'systems' 	=> $systems,
			'status' 	=> 1
		);

		if($q_class->num_rows() <= 0){
			if($this->db->insert('tb_class_admin', $licenseArray)){
				$re = array('code'=>1,'msg'=>'Success ');
			}else{
				$re = array('code'=>0,'msg'=>'Error : No data');
			}
		}else{
			if($this->db->where('admin_id',$this->input->post('admin_id'))->update('tb_class_admin', $licenseArray)){		 
				$re = array('code'=>1,'msg'=>'Success ');
			}else{
				$re = array('code'=>0,'msg'=>'Error : No data');
			}
		}
		echo json_encode($re);
		die();
	}
	public function edit_pass(){
	
		if($admin_id = $this->input->post('admin_id')){
			if($pwd = $this->input->post('password')){
				$salt = $this->salt();
				$password =  $this->hash_password($pwd,$salt);
				
				$dataUpdate = array(
					'password' 	=> $password,
					'salt' 		=> $salt,
					'safecode'  => '',
					'safetime'  => '',
					'token'     => ''
				);
				if($this->db->where('id',$admin_id)->update('tb_login',$dataUpdate)){
					$re = array('code'=>1,'msg'=>'Success ');
				}else{
					$re = array('code'=>0,'msg'=>'Error : No data 003');
				}
			}else{
				$re = array('code'=>0,'msg'=>'Error : No data 002');
			}
		}else{
			$re = array('code'=>0,'msg'=>'Error : No data 001');
		}
		echo json_encode($re);
		die();
	}
	public function edit_status()
	{
		if($admin_id = $this->input->post('id')){
			$get_status = $this->db->select('status')->where('id',$admin_id)->get('tb_login')->row();
			if($get_status->status == 1){
				$status = '0';
			}else{
				$status = '1';
			}
			if($this->db->set('status',$status)->where('id',$admin_id)->update('tb_login')){
				$re = array('code'=>1,'msg'=>'Success');
			}else{
				$re = array('msg' =>'อัพเดตสถานะไม่สำเร็จ','code'=> 0 );
			}
		}else{
			$re = array('msg' =>'ไม่มียูเซอร์ดังกล่าว','code'=> 0 );
		}
		echo json_encode($re);
		die();
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

	public function hash_password($password, $salt)
	{
		if(empty($password)){
			return false;
		}

		return sha1($password.$salt);
	}
	public function editProfile()
	{
		$arrAdmin = array(
			'name'=>$this->input->post('name'),
			'tel' =>$this->input->post('tel')
		);
		$admin_id = $this->input->post('id');
		
		if($this->db->where('id',$admin_id)->update('tb_login',$arrAdmin) == true){
			$re = array( 'status'=>1);
			echo json_encode($re);
			die();
		}
	}
	public function notification(){
		
		$dp_count = $this->db->where('status',1)->where('deposit >', 0)->where_not_in('from_bank', 'TRUEW')->get('tb_statement')->num_rows(); //มีรายการจับคู่ไม่ได้
		$wd_count = $this->db->where('status',1)->get('tb_withdraw')->num_rows();
		$tw_count = $this->db->where('status',1)->where('from_bank', 'TRUEW')->get('tb_statement')->num_rows();
		$af_count = $this->db->where('status',1)->get('tb_user_sale_credit')->num_rows();
		$exchange_count = $this->db->where('status',1)->get('tb_exchange')->num_rows(); //มีรายการจับคู่ไม่ได้
		if($dp_count == 0 && $wd_count == 0 && $exchange_count == 0 && $tw_count == 0 && $af_count == 0){
			echo json_encode(array('code' => 0,'dp_count'=>0,'wd_count'=>0,'exchange_count'=>0, 'tw_count'=>0));
		}else{
			echo json_encode(array('code' => 1,'dp_count'=>$dp_count,'wd_count'=>$wd_count,'exchange_count'=>$exchange_count, 'tw_count'=>$tw_count , 'af_count' => $af_count));
		}
		die();
	}
	public function notify_deposit_auto()
	{
		$q = $this->db->where('status',0)->order_by("id", "DESC")->get('tb_alert');
		echo json_encode(array('code' => 1, 'data'=>$q->result_array()));
		die();
	}
	public function update_notify()
	{
		$this->db->set('status',1)->where('id',$this->input->post('id'))->update('tb_alert');
		die();
	}

	public function profile_admin(){
		
		$adminid = $this->session->users['id'];
		$profile = $this->db->select('username, agent, name, remark, tel, rounds, class')
				   ->where('id', $adminid)
				   ->get('tb_login')
				   ->result_array();
		
		$admin = array(
			'profile' => $profile
		);
		
		$this->load->view('admin_profile', $admin);

	}


	public function edit_admin(){

			$adminid = $this->session->users['id'];
			$name =  $this->input->post('name');
			$tel = $this->input->post('tel');
			$rounds = $this->input->post('rounds');
			
				$arr_update_admin =  array(
					'name' => $name,
					'tel' => $tel,
					'rounds' => $rounds
			
				);
				// print_r($arr_update_admin);
				// die();
				if($this->db->where('id',$adminid)->update('tb_login',$arr_update_admin)){
					$re = array('code'=> 1,'msg'=>'อัพเดตข้อมูลสำเร็จ');
				}else{
					$re = array('code'=> 0,'msg' =>'อัพเดตข้อมูลไม่สำเร็จ');
				}
				
			echo json_encode($re);
			die();

		
	}

	public function edit_password(){

		$adminid = $this->session->users['id'];
		$new_pass = $this->input->post('new_pass');
		
		if(!empty($new_pass)){
			$salt = $this->salt();
			$password =  $this->hash_password($new_pass,$salt);
			$passUpdate = array(
				'password' 	=> $password,
				'salt' 		=> $salt
			);
		$this->db->where('id',$adminid)->update('tb_login',$passUpdate);
				$re = array('code'=>1,'msg'=>'อัพเดตข้อมูลสำเร็จ');

		}else{
			$re = array('code'=>0,'msg'=>'อัพเดตข้อมูลไม่สำเร็จ');
		}
		
		echo json_encode($re);
		die();

	
}

public function session_alert(){
	
		$dep_alert = $this->input->post('dep_alert');

		$this->session->dp_alert = 1;
		$this->session->dep_alert = $dep_alert;
		echo json_encode();
		die();
}

	
}


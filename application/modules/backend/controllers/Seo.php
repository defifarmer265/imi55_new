<?php

class Seo extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();		
		$this->load->model('getapi_model');
		$this->load->model('Article_model');
		$this->load->library('backend/backend_library');
		$this->load->helper('url');
		$this->_init();


	}
	private function _init()
	{		
		$this->output->set_template('tem_admin/tem_admin');
		$this->backend_library->checkLoginAdmin();

	}

	public function index()
	{
		
		// $check_lic = $this->db->select('*')->where('admin_id',$this->session->userdata['users']['id'])->where('status',1)->get('tb_class_admin')->row();
		// if($check_lic->admin != 0){
		// 	$data['admin'] = $this->db->get('tb_login')->result_array();
		// 	$data['menu'] = 'admin';
			
			$this->load->view('seo');	
		// }else{
		// 	redirect('backend');
		// }


	}
	public function Football_agent()
	{
		$data = array(

			'menu' => 'Football_agent',
			'tb_article' => $this->db->select('*')->get('tb_article')->result_array(),

		);	
		$this->load->view('Football_agent',$data);	
	}
	public function Casino_Agent()
	{
		$this->load->view('Casino_Agent');	
	}
	public function football()
	{
		$this->load->view('football');	
	}


	public function createArticle(){
//		echo '<pre>';
//		print_r($this->input->post());
//		print_r($_FILES['img']);
//		die();
		
					if($_FILES['img']['name']){
						$typeImg 	= explode(".", $_FILES['img']['name']);
						$filename 	= time();
						$upload = array(	
							'allowed_types'	=> 'jpg|jpeg|png',
							'upload_path'	=> realpath(APPPATH.'../public/tem_frontend/img/seo/'),
							'max_size'		=> 5000,
							'file_name'		=> $filename,
							'file_ext_tolower' => TRUE,
							'overwrite' 	=> TRUE
						);
						$this->load->library('upload',$upload);
						if($this->upload->initialize($upload)){

							 if($this->upload->do_upload('img')){

							 }else{

								 $this->session->set_flashdata('msgError', $this->upload->display_errors());
								 redirect('backend/seo/Football_agent');
							 }

						}else{
							$this->session->set_flashdata('msgError', 'Function initialize upload slip error');

							redirect('backend/seo/Football_agent');
						}


						$data = array(
							'topic' 		=> $this->input->post('topic'),
							'detail' 		=> $this->input->post('detail'),
							'img' 			=> $filename.".".$typeImg[1],
							'category' 		=> $this->input->post('category'),
							'status' 		=> 1,
						);
						if($this->Article_model->insertArticle($data)){
							$this->session->set_flashdata('msgSuccess', 'Success');
						}else{
							$this->session->set_flashdata('msgError', 'insert error');
						}
					}else{
						$this->session->set_flashdata('msgError', 'No img error');
					}

			
		redirect('backend/seo/Football_agent');
	}

			public function close_Article(){
			$id = $this->input->post('id');
			$close_css = array(
				'status' 		=> $this->input->post('status'),
			);
			if($this->Article_model->close_css($id,$close_css)){
				$this->session->set_flashdata('msgSuccess', 'Success');
			}else{
				$this->session->set_flashdata('msgError', 'insert error');
			}
			redirect('backend/seo/Football_agent');
		}

				public function Drope_css(){
			$id = $this->input->post('id');
			
			if($this->Article_model->Drope_css($id)){
				$this->session->set_flashdata('msgSuccess', 'Success');
			}else{
				$this->session->set_flashdata('msgError', 'insert error');
			}
			redirect('backend/seo/Football_agent');
		}


		public function editArticle(){

		$id = $this->input->post('id');

					if($_FILES['img']['name']){
						$typeImg 	= explode(".", $_FILES['img']['name']);
						$filename 	= time();
						$upload = array(	
							'allowed_types'	=> 'jpg|jpeg|png',
							'upload_path'	=> realpath(APPPATH.'../public/tem_frontend/img/seo/'),
							'max_size'		=> 5000,
							'file_name'		=> $filename,
							'file_ext_tolower' => TRUE,
							'overwrite' 	=> TRUE
						);
						$this->load->library('upload',$upload);
						if($this->upload->initialize($upload)){

							 if($this->upload->do_upload('img')){

							 }else{

								 $this->session->set_flashdata('msgError', $this->upload->display_errors());
								 redirect('backend/seo/Football_agent');
							 }

						}else{
							$this->session->set_flashdata('msgError', 'Function initialize upload slip error');

							redirect('backend/seo/Football_agent');
						}


						$editArticle = array(

							'topic' 			=> $this->input->post('topic'),
							'detail' 		=> $this->input->post('detail'),
							'img' 			=> $filename.".".$typeImg[1]
							
						);
						if($this->Article_model->editArticle($id,$editArticle)){
							$this->session->set_flashdata('msgSuccess', 'Success');
						}else{
							$this->session->set_flashdata('msgError', 'insert error');
						}
					}else{
						$this->session->set_flashdata('msgError', 'No img error');
					}

			
		redirect('backend/seo/Football_agent');
	}



	public function cre_admin(){
		$check_admin =  $this->db->where('username',$this->getapi_model->agent().'@'.$this->input->post('username'))->get('tb_login');
		if($check_admin->num_rows() <= 0){
		if($pwd = $this->input->post('password')){
			if($username = $this->input->post('username')){
				if($name = $this->input->post('name')){
						$salt = $this->salt();
						$password =  $this->hash_password($pwd,$salt);
						
						
						$dataCreate = array(
							'username' 	=> $this->getapi_model->agent().'@'.$username,
							'agent' 	=> $this->getapi_model->agent(),
							'password' 	=> $password,
							'salt' 		=> $salt,
							'name' 		=> $name,
							'last_login'=> 0,
							'last_ip'	=> 0,
							'class'		=> 1,
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
								$this->session->set_flashdata('msgSuccess', 'Success');
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
	public function get_license(){
		$license = $this->db->where('admin_id',$this->input->post('admin_id'))->get('tb_class_admin')->row();
		echo json_encode($license);
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
					'salt' 		=> $salt
				);
				$this->db->where('id',$admin_id)->update('tb_login',$dataUpdate);
					$re = array('code'=>1,'msg'=>'Success ');
	
			}else{
				$re = array('code'=>0,'msg'=>'Error : No data');
			}
		}else{
			$re = array('code'=>0,'msg'=>'Error : No data');
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
	public function notification_depocf(){
		$rowcount = $this->db->where('status',0)->get('transactionauto')->num_rows(); //ค้นหารายการที่ยังไม่ได้ load มาไว้ใน statement
		$notification_count = $this->db->where('status',1)->get('tb_statement')->num_rows(); //มีรายการจับคู่ไม่ได้
		echo json_encode(array('code' => 1,'count'=>$rowcount,'notifi_count'=>$notification_count,'msg'=>'success','type'=>1));
		//type 1:deposit  2:withdraw
		die();
	}

}


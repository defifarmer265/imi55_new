<?php

class Safe_code extends MY_Controller
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
		if($this->session->users['class'] == 0){
			$query = $this->db->join('tb_admin_rounds','tb_admin_rounds.id = tb_login.rounds','left')
				->select('tb_login.id,tb_login.username,tb_login.agent,tb_login.name,tb_login.class,tb_login.rounds,tb_login.safecode,tb_login.safetime,tb_login.safestatus,tb_login.status_login,tb_admin_rounds.rounds_desc')
				->where('tb_login.id !=',1)
				->where('tb_login.class !=',0)
				->get('tb_login')
				->result_array();
			
		}else if($this->session->users['class'] == 1){
			$query = $this->db->select('tb_login.id,tb_login.username,tb_login.agent,tb_login.name,tb_login.class,tb_login.rounds,tb_login.safecode,tb_login.safetime,tb_login.safestatus,tb_login.status_login,tb_admin_rounds.rounds_desc')
				->join('tb_admin_rounds','tb_admin_rounds.id = tb_login.rounds','left')
				->group_by('tb_login.id')
				->where('tb_login.class !=',0)
				->where('tb_login.class !=',1)
				->where('tb_login.id !=',1)
				->get('tb_login')
				->result_array();
		}else{
			$query = $this->db->select('tb_login.id,tb_login.username,tb_login.agent,tb_login.name,tb_login.class,tb_login.rounds,tb_login.safecode,tb_login.safetime,tb_login.safestatus,tb_admin_rounds.rounds_desc')
				->join('tb_admin_rounds','tb_admin_rounds.id = tb_login.rounds','left')
				->group_by('tb_login.id')
				->where('tb_login.class !=',0)
				->where('tb_login.class !=',1)
				->where('tb_login.class !=',2)
				->where('tb_login.id !=',1)
				->get('tb_login')
				->result_array();
		}
		$check_status_online    = $this->db->select('status_login,class')->where('class !=',0)->where('status_login',1)->get('tb_login')->num_rows();
		$check_status_offline   = $this->db->select('status_login,class')->where('class !=',0)->where('status_login',0)->get('tb_login')->num_rows();
		$online = $check_status_online;
		$offline = $check_status_offline;
		$q_rounds = $this->db->get('tb_admin_rounds')->result_array();
		$data = array(
			'admin' =>  $query,
			'rounds' =>  $q_rounds,
			'online' => $online,
			'offline'=> $offline
			);
			
		$this->load->view('safe_code',$data);

	}

	function gen_safecode($length = 4) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	

	function save_safecode (){
		
		if($this->input->post('id')){
			$id 	= $this->input->post('id');
			$user_q	= $this->db->where('id',$id)->where('status',1)->get('tb_login');
			if($user_q->num_rows() == 1){
				$safecode  	= $this->gen_safecode(4);
				$safetime 	= time();				
				if ($this->db->set('safecode',$safecode)->set('safetime',$safetime)->where('id',$id)->update('tb_login')){
					$user_name = $this->db->where('id',$id)->select('name')->get('tb_login')->row();
					$data_log = "สร้าง safecode ให้: " . $user_name->name . " คือ: ". $safecode;
					$arr_log = array(
						'admin_id' 	=> $this->session->userdata['admin']['username'],
						'data_log' => $data_log,
						'time_log' =>  time(),
					);
					$this->db->insert('log_safecode',$arr_log);	
									
					$re = array('code'=>1,'msg'=>$safecode,'title'=>'safecode คือ');


				}else{
					$re = array('code'=>0,'msg'=>'gen safecode ไม่สำเร็จ','title'=>'บันทึกไม่สำเร็จ');
				}	
			}else{
				$re = array('titel'=>'ไม่มีข้อมูล','msg' =>'ไม่มีผู้ใช้นี้','code'=> 0 );
			}
		}else{
			$re = array('titel'=>'ไม่มีข้อมูล','msg' =>'ไม่มีผู้ใช้รายนี้','code'=> 0 );
		}
		echo json_encode($re);
		die();
		
	}	

	function delete_safecode (){
		
		if($this->input->post('id')){
			$id 	= $this->input->post('id');
			$user_q	= $this->db->where('id',$id)->where('status',1)->get('tb_login');
			if($user_q->num_rows() == 1){				
				if($this->db->set('safecode',"")->set('safetime',"")->set('token',"")->set('status_login',0)->where('id',$id)->update('tb_login')){
					$user_name = $this->db->where('id',$id)->select('name')->select('safecode')->get('tb_login')->row();
					$data_log = "ลบ safecode ให้: " . $user_name->name;
					$arr_log = array(
						'admin_id' 	=> $this->session->userdata['admin']['username'],
						'data_log' => $data_log,
						'time_log' =>  time(),
					);
					$this->db->insert('log_safecode',$arr_log);	

					$re = array('code'=>1,'msg'=>'','title'=>'ลบสำเร็จ');
				}else{
					$re = array('code'=>0,'msg'=>'ไม่สำเร็จ','title'=>'ลบไม่สำเร็จ');
				}
			}else{
				$re = array('titel'=>'ไม่มีข้อมูล','msg' =>'ไม่มีผู้ใช้นี้','code'=> 0 );
			}
		}else{
			$re = array('titel'=>'ไม่มีข้อมูล','msg' =>'ไม่มีผู้ใช้รายนี้','code'=> 0 );
		}		
		echo json_encode($re);
		die();
	}


	function delete_select(){
		$id = $this->input->post('id');
		if($id != ""){
			if($id == "0"){
				$user_q	= $this->db->where('class !=',0)->select('rounds')->select('name')->get('tb_login')->result_array();
				$data_ = "";
				$i = 0;
					foreach ($user_q as $wt) {
						// อัพเดท token ทั้งหมดให้แตะออกทั้งหมดไม่่าจะเป็น
						$this->db->set('safecode',"")->set('safetime',"")->set('token',"")->set('status_login',0)->where('class !=',3)->update('tb_login');
						$this->db->set('token_login',"")->set('lastip_login',"")->set('last_login',"")->where('class !=',3)->update('tb_owner');
						$data_ = $data_ . $wt['name'] ;
						$i++;
						if($i < count($user_q))	{
							$data_ = $data_ . " ,";
						}					
					}

					$data_log = "ลบ safecode ให้ทุกคน ได้แก่: " . $data_;
					$arr_log = array(
						'admin_id' 	=> $this->session->userdata['admin']['username'],
						'data_log' => $data_log,
						'time_log' =>  time(),
					);
					$this->db->insert('log_safecode',$arr_log);	
					$re = array('code'=>1,'msg'=>'สำเร็จ','title'=>'');
					
			}else {
					$user_q	= $this->db->where('class !=',0)->where('rounds',$id)->get('tb_login')->result_array();
					$data_ = "";
					$i = 0;
					foreach ($user_q as $wt) {
						$this->db->set('safecode',"")->set('safetime',"")->where('id',$wt['id'])->update('tb_login');	
						$data_ = $data_ . $wt['name'];	
						$i++;
						if($i < count($user_q))	{
							$data_ = $data_ . " ,";
						}				
					}
					$rounds_desc	= $this->db->where('id',$id)->get('tb_admin_rounds')->row();
					$data_log = "ลบ safecode ให้". $rounds_desc->rounds_desc . "ได้แก่: " . $data_;
					$arr_log = array(
						'admin_id' 	=> $this->session->userdata['admin']['username'],
						'data_log' => $data_log,
						'time_log' =>  time(),
					);
					$this->db->insert('log_safecode',$arr_log);	

					$re = array('code'=>1,'msg'=>'สำเร็จแล้ว','title'=>'');
			}
		}else{
			$re = array('code'=>0,'msg'=>'ไม่มีข้อมูล','title'=>'');
		}
		echo json_encode($re);
		die();
	}
	function gen_select(){
		$id = $this->input->post('id');
		if($id != ""){
			if($id == "0"){
				$user_q	= $this->db->where('class !=',0)->get('tb_login')->result_array();
				$data_name = "";
				$data_safecode = "";
				$i = 0;
					foreach ($user_q as $wt) {
						$safecode  	= $this->gen_safecode(4);
						$safetime 	= time();
						$this->db->set('safecode',$safecode)->set('safetime',$safetime)->where('class !=',0)->where('id',$wt['id'])->update('tb_login');
						$data_name = $data_name . $wt['name'];
						$data_safecode = $data_safecode . $safecode;
						$i++;
						if($i < count($user_q))	{
							$data_name = $data_name . " ,";
							$data_safecode = $data_safecode . " ,";
						}	
					
						
					}
					$data_log = "สร้าง safecode ให้ทุกคนได้แก่:" . $data_name . " คือ: " . $data_safecode;
					$arr_log = array(
						'admin_id' 	=> $this->session->userdata['admin']['username'],
						'data_log' => $data_log,
						'time_log' =>  time(),
					);
					$this->db->insert('log_safecode',$arr_log);	

					$re = array('code'=>1,'msg'=>'สำเร็จ','title'=>'');
			}else {
					$user_q	= $this->db->where('class !=',0)->where('rounds',$id)->get('tb_login')->result_array();
					$data_name = "";
					$data_safecode = "";
					$i = 0;
					foreach ($user_q as $wt) {
						$safecode  	= $this->gen_safecode(4);
						$safetime 	= time();
						$this->db->set('safecode',$safecode)->set('safetime',$safetime)->where('class !=',0)->where('id',$wt['id'])->update('tb_login');					
						$data_name = $data_name . $wt['name'] ;
						$data_safecode = $data_safecode . $safecode ;
						$i++;
						if($i < count($user_q))	{
							$data_name = $data_name . " ,";
							$data_safecode = $data_safecode . " ,";
						}	
					
					}
					$rounds_desc	= $this->db->where('id',$id)->get('tb_admin_rounds')->row();
					$data_log = "สร้าง safecode ให้" . $rounds_desc->rounds_desc . "ได้แก่:" . $data_name . " คือ: " . $data_safecode;
					$arr_log = array(
						'admin_id' 	=> $this->session->userdata['admin']['username'],
						'data_log' => $data_log,
						'time_log' =>  time(),
					);
					$this->db->insert('log_safecode',$arr_log);	

					$re = array('code'=>1,'msg'=>'สำเร็จแล้ว','title'=>'');
			}
		}else{
			$re = array('code'=>0,'msg'=>'ไม่มีข้อมูล','title'=>'');
		}
		echo json_encode($re);
		die();

	}

	function open_statussafe(){
		$id = $this->input->post('id');
		if (isset($id)) {
			$query = $this->db->set('safestatus',1)->where('id', $id)->update('tb_login');
			if ($query) {
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
			} else {
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
			}
		} else {
			$re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
		}
		echo json_encode($re);
		die();
	}
  
	function close_statussafe(){
		$id = $this->input->post('id');
		if (isset($id)) {
			$query = $this->db->set('safestatus',0)->where('id', $id)->update('tb_login');
			if ($query) {
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
			} else {
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
			}
		} else {
			$re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
		}
		echo json_encode($re);
		die();
	}

}


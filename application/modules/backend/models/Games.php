<?php
class Games extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->model('getapi_model');
		$this->load->library('backend/backend_library');

	}
	private function _init()
	{		
		$this->output->set_template('tem_admin/tem_admin');
	}



	public function index()
	{
		$this->load->view('games');
	}
	public function fetch_user(){
		$this->load->model('member_game_model');
		$fetch_data = $this->member_game_model->make_datatables();
		$i = $_POST['start'];
		foreach($fetch_data as $row){
            $i++;	
			$id = $row->id;
			$username= $row->username;
			$user = $row->user;
			$name = $row->name;
			$point = $row->point;
			$spin = $row->spin; 
			if($row->comefrom ==1){
				$comefrom = '<span class="badge badge-secondary text-white">ลูกค้าเก่า</span>';
			}
			if($row->comefrom ==2)
			{
				$comefrom = '<span class="badge badge-info text-white">ลูกค้าใหม่</span>';
			}
			$link_page = "<a href='".base_url('backend/games/report_point/'.$row->id)."' title='เรียกดูพอยท์'><i class='fa fa-info-circle' aria-hidden='true'title='รายละเอียด'></i></a> " ;
			$data[] = array($i,$username,$user,$name,$point,$spin,$comefrom,$link_page);
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->member_model->get_all_data(),
			"recordsFiltered" => $this->member_model->get_filtered_data(),
			"data" => $data
		);
		echo json_encode($output);
		die;
	}
	
	//เรียกดูคะแนน point
	public function report_point($id)
	{
		$this->db->select("tb_user.id,tb_user.user, tb_user.username,tb_point.*");
		$this->db->from('tb_user');
		$this->db->join('tb_point','tb_point.user_id = tb_user.id  ','left');
		$this->db->where('tb_user.id',$id);
		$this->db->order_by('create_time','DESC');
		$query['rspoint'] = $this->db->get()->result_array();
		$this->load->view('report_point',$query);
	}


	public function reward()
	{
		$data['reward'] = $this->db->order_by('reward','ASC')->get('reward')->result_array();
		// $data2['tb_point'] = $this->db->where('type','reward')->get('tb_point')->result_array();
		$this->load->view('reward',$data);
		// $this->load->view('reward',$data2);
	}
	public function reward_delete()
		{
			$result = $this->getapi_model->delete_reward($this->input->post('id'));
	    	echo json_encode($result);
	    	die;
		}
	public function reward_adds()
    {
    

    
      $config['upload_path'] = realpath(APPPATH.'../public/tem_frontend/img/reward/');
       //$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'public/img/promotion/';//ที่จัดเก็บ
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '2000';
      $config['max_width'] = '4000';
      $config['max_hight'] = '3000';
      $config['encrypt_name']  = true;

      $this->load->library('upload',$config);
      $this->upload->initialize($config);

        if (!$this->upload->do_upload('img')) {

            echo $this->upload->display_errors();

        }else {

          $data = array('upload_data' => $this->upload->data());
          $filename = $data['upload_data']['file_name'];
          $image = $filename;
          $prize =  $this->input->post('prize');
          $reward =  $this->input->post('reward');
 

          $data = array(
						'prize' => $prize,
						'reward' => $reward,
						'img' => $image,
						'status'=>'1'
						
					);
 
        
		$this->db->insert('reward', $data);
      }
      
    }




	// function สำหรับจัดการหน้า Spin
	public function spin()
	{
		$data['spin'] = $this->db->order_by('status','DESC')->get('tb_spin')->result_array();
		$this->load->view('spin',$data);
	}
	
    // function insert ข้อมูล
	public function cre_spin()
	{
		// echo '<pre>';
		// print_r($_FILES);
		// die();
		if($_FILES['spin']['name']){
			$typeImg 	= explode(".", $_FILES['spin']['name']);
			$typeImg2 	= explode(".", $_FILES['alert']['name']);
			$filename 	= time();
			$filename2 	= rand(3,999).time();
			$upload1 = array(	
				'allowed_types'	=> 'jpg|jpeg|png',
				'upload_path'	=> realpath(APPPATH.'../public/tem_frontend/img/wheel/'),
				'max_size'		=> 1000,
				'file_name'		=> $filename,
				'file_ext_tolower' => TRUE,
				'overwrite' 	=> TRUE
			);
			$upload2 = array(	
				'allowed_types'	=> 'jpg|jpeg|png',
				'upload_path'	=> realpath(APPPATH.'../public/tem_frontend/img/wheel/'),
				'max_size'		=> 1000,
				'file_name'		=> $filename2,
				'file_ext_tolower' => TRUE,
				'overwrite' 	=> TRUE
			);
			$this->load->library('upload',$upload1);
			$this->load->library('upload',$upload2);
			if($this->upload->initialize($upload1)){
				if($this->upload->do_upload('spin')){
					$this->upload->initialize($upload2);
					$this->upload->do_upload('alert');
					$data = array(
						'name' 		=> $this->input->post('name'),
						'spin' 		=> $filename.".".$typeImg[1],
						'alert' 	=> $filename2.".".$typeImg2[1],
						'percent'	=> $this->input->post('percent'),
						'point' 	=> $this->input->post('point'),
						'status' 	=> 1,
					);
					if($this->db->insert('tb_spin',$data)){
						$re = array('msg' => 'Success' ,'code'=> 1 ,'title'=>'สำเร็จ'); //Error
					}else{
						$re = array('msg' => 'Save to DB Error' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
					}
				}else{
					$re = array('msg' => 'Upload img Error2' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
				}
			}else{
				$re = array('msg' => 'Upload img Error1' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
			}
		}else{
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
        die();
	}









	
	// function สำหรับ
	public function edit_spin()
	{

		if($this->input->post('id')){
			$id = $this->input->post('id');
			$st = $this->input->post('status');
			$this->db->set('status',$st)->where('id',$id)->update('tb_spin');
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
		}else{
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
        die();
	}
	// function สำหรับ
	public function edit_reward()
	{

		if($this->input->post('id')){
			$id = $this->input->post('id');
			$st = $this->input->post('status');
			$this->db->set('status',$st)->where('id_reward',$id)->update('reward');
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
		}else{
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
        die();
	}

	public function reject_ctrl_reward()

	{		
				
		
			$id_user = $this->input->post('id_user');
			$point = $this->input->post('cost');
			$id_admin = $this->session->users['id'];
			$date =  strtotime(date('Y-m-d H:i:s'));	
			$id = $this->input->post('id');
			$res = $this->db->set('admin_id',$id_admin)->set('status','0')->set('admin_datetime',$date)->where('id',$id)->update('tb_exchange');
			if($res){
		$this->db->set('point','point +'.$point, FALSE)->where('user',$id_user)->update('tb_user');
			}
			$re = array('code'=> 1);
		
		echo json_encode($re);
        die();
	}
	public function submit_ctrl_reward()
	{

		$id_admin = $this->session->users['id'];
			$date =  strtotime(date('Y-m-d H:i:s'));	
			$id = $this->input->post('id');
			$id_user = $this->input->post('id_user');
			$point = $this->input->post('point');
			
			$res = $this->db->set('admin_id',$id_admin)->set('status','2')->set('admin_datetime',$date)->where('id',$id)->update('tb_exchange');
			if($res){
						  	$arr_depAPI = array(
							'AgentName' 	=> $this->getapi_model->agent(),
							'PlayerName' 	=> $id_user,
							'Amount' 		=> $point,
							'TimeStamp' 	=> time()
							
								);
								$dataAPI = array(
										'type'		=> 'D',
										'agent' 	=> $this->getapi_model->agent(),
										'member' 	=> $id_user,
									);

						

							$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
							$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI,$url_api,$dataAPI);
						
						
							$re = array('code'=> 1 );
						} else
							  {
								  $re = array('code'=>0);
							  }
			
			
		
		echo json_encode($re);
        die();
	}
	public function reward_editFrm()
	{
			//   print_r($_POST);
			//   die();
		  	  $id = $this->input->post('id');
		      $result = $this->db->where('id_reward',$id)->get('reward')->row();
		      echo json_encode($result);
		      die;
	}
	public function spinsetting_editFrm()
	{
		  	  $id = $this->input->post('id');
		      $result = $this->db->where('id',$id)->get('setting')->row();
		      echo json_encode($result);
		      die;
	}
	

	public function pointsetting_editFrm()
	{
		  	  $id = $this->input->post('id');
		      $result = $this->db->where('id',$id)->get('setting')->row();
		      echo json_encode($result);
		      die;
	}

	public function edit_pointsetting()
	{
		
				$id =  $this->input->post('id_point');
				$point =  $this->input->post('point_p');
					
				$result = $this->db->set('code', $point)->where('id', $id)->update('setting');

				echo json_encode($result);
							
			
	}













		public function edit_reward_ctrl()
		{
		
			$config['upload_path'] = realpath(APPPATH.'../public/tem_frontend/img/reward/');
			//$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'public/img/slide/';//ที่จัดเก็บ
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '4000';
							$config['max_width'] = '4000';
			$config['max_hight'] = '3000';
			$config['encrypt_name']  = true;

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

				if (!$this->upload->do_upload('e_img')) {
				// echo $this->upload->display_errors();

					$id =  $this->input->post('eid_reward');
					$prize =  $this->input->post('eprize');
					$reward =  $this->input->post('ereward');
					$image =  $this->input->post('image');
					$type =  $this->input->post('etype_reward');
					$result = $this->db->set('prize', $prize)->set('reward', $reward)->set('type', $type)->where('id_reward', $id)->update('reward');
											echo json_encode($result);
				}else{

					$data = array('upload_data' => $this->upload->data());
					$filename = $data['upload_data']['file_name'];
					$image = $filename;
					$id =  $this->input->post('eid_reward');
					$prize =  $this->input->post('eprize');
					$reward =  $this->input->post('ereward');
					$type =  $this->input->post('etype_reward');
					$result = $this->db->set('prize', $prize)->set('reward', $reward)->set('type', $type)->set('img', $image)->where('id_reward', $id)->update('reward');
					echo json_encode($result);
		      die;
			}

		}



public function edit_spinsetting()
		{
		
					$id =  $this->input->post('id_spin');
					$point =  $this->input->post('point_spin');
					
					$result = $this->db->set('code', $point)->where('id', $id)->update('setting');

					echo json_encode($result);
							
			
		}


		


	//function สำหรับจัดการ
	public function spin_editFrm()
	{
			//   print_r($_POST);
			//   die();
		  	  $id = $this->input->post('id');
		      $result = $this->db->where('id',$id)->get('tb_spin')->row();
		      echo json_encode($result);
		      die;
	}
	public function user_editpoint()
	{
			//   print_r($_POST);
			//   die();
		  	  $id = $this->input->post('id');
		      $result = $this->db->where('id',$id)->get('tb_user')->row();
		      echo json_encode($result);
		      die;
	}
	
	// อัพเดทข้อมูล spin
	public function up_spin()
	{
		if($this->input->post('id')){
			
		

        $config['upload_path'] = realpath(APPPATH.'../public/tem_frontend/img/wheel/');
			//$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'public/img/slide/';//ที่จัดเก็บ
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '4000';
			$config['max_width'] = '4000';
			$config['max_hight'] = '3000';
			$config['encrypt_name']  = true;

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

				if (!$this->upload->do_upload('e_img')) {
				// echo $this->upload->display_errors();

					$id =  $this->input->post('id');
					$name =  $this->input->post('editname');
					$percent =  $this->input->post('editpercent');
					$point =  $this->input->post('editpoint');
				
					$result = $this->db->set('name', $name)->set('percent', $percent)->set('point', $point)->where('id', $id)->update('tb_spin');
											echo json_encode($result);
				}else{

					$data = array('upload_data' => $this->upload->data());
					$filename = $data['upload_data']['file_name'];
					$image = $filename;
					$id =  $this->input->post('id');
					$name =  $this->input->post('editname');
					$percent =  $this->input->post('editpercent');
					$point =  $this->input->post('editpoint');
					$result = $this->db->set('name', $name)->set('percent', $percent)->set('point', $point)->set('spin', $image)->where('id', $id)->update('tb_spin');
					echo json_encode($result);
		    
			}
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
		}else{
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
	}
	public function up_userpoint()
	{		
		
			
					$id =  $this->input->post('id');
					$point =  $this->input->post('point');
					$spin =  $this->input->post('spin');
				
					$result = $this->db->set('point', $point)->set('spin', $spin)->where('id', $id)->update('tb_user');
					echo json_encode($result);							
		 //   if($result){		
			// $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			// echo json_encode($re);
			// }else{
			// $re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
			// echo json_encode($re);
			// }
		
		
	}

	//  function สำหรับจัดการหน้า checkin

	public function read_checking()
	{
		$id = $this->input->post('id');
		$result = $this->db->where('id',$id)->get('tb_checkin')->row();
		echo json_encode($result);
		die;
	}

	public function checkin()
	{
		$data['checkin'] = $this->db->where('status',1)->get('tb_checkin')->result_array();
		$data['setting'] = $this->db->where('name','spin_amount')->or_where('name','spin_num')->get('setting')->result_array();
		$data['setting2'] = $this->db->where('name','point_amount')->or_where('name','point_num')->get('setting')->result_array();
		$data['setting3'] = $this->db->where('name','switch_exchange')->get('setting')->result_array();
		
		$this->load->view('checkin',$data);
		
	}

	public function cre_checkin()
	{
		if($this->input->post('name')){
			$name = $this->input->post('name');
			$point = $this->input->post('point');
			$spins = $this->input->post('num_spins');
			$arr_checkin = array('name'=>$name,'point'=>$point,'status'=>1);
			$this->db->set('status',0)->where('status',1)->update('tb_checkin');
			$this->db->insert('tb_checkin',$arr_checkin);
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
		}else{
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
        die();
	}

	// แสดงข้อมูลแก้ไขผ่านทางmodal
	public function edit_checkin()
	{
		  if($this->input->post('id')){
			  $id = $this->input->post('id');
			  $status = $this->input->post('status');
			  $data = $this->db->set('status',$status)->where('id',$id)->update('tb_checkin');
			  $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
		  }else{
			  $re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		  }
		echo json_encode($re);
        die();
	}


	// function สำหรับอัพเดท checkin

	public function up_checkin_frm(){

		if($this->input->post('id')){
			$id   = $this->input->post('id');
			$name = $this->input->post('name');
			$point = $this->input->post('point');
			$spins = $this->input->post('spins');
			$arr = array(
						  'point'=>$point,
						  'spin'=>$spins
						  
			  );
			$this->db->where('id',$id)->update('tb_checkin',$arr);
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
		  }else{
			  $re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		  }
		  echo json_encode($re);
		  die();
	}





	 public function enable_credit()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('setting');
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
    public function disable_credit()
    {
        // 0 ปิด 1 เปิด
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('setting');
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











	//function checkin v2
	//แสดงข้อมูลการอัพรูปภาพ

	public function r_img_ck(){
		$id = $this->input->post('id');
		$result = $this->db->where('id',$id)->get('tb_checkin')->row();
		echo json_encode($result);
		die;
	}

	public function r_img_ck2(){
		$id = $this->input->post('id');
		$result = $this->db->where('id',$id)->get('tb_checkin')->row();
		echo json_encode($result);
		die;
	}

	public function r_img_ck3(){
		$id = $this->input->post('id');
		$result = $this->db->where('id',$id)->get('tb_checkin')->row();
		echo json_encode($result);
		die;
	}



	public function update_img_ck(){
		$id = $this->input->post('e_img_id');
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); //ตัดชื่อไฟล์ออกเอาเฉพาะนามสกุล
		$newname   = 't'.$id; //ชื่อไฟล์์ใหม่
		$result_file= $newname.'.'.$extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์
		$query  = $this->db->select('*')->where('id', $id)->get('tb_checkin');
		foreach ($query->result() as $row) {
			$file_img = $row->img_check_in;
            $path = realpath(APPPATH.'../public/tem_frontend/img/checkin/true/').'/'.$file_img;

            // $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/').'/'.$file_img;

			
            if (file_exists($path)) {
			
                //กรณีมีไฟล์อยู่ ทำการลบไฟล์แล้ว insertใหม่
                if (unlink($path)) {
                    $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/checkin/true/');
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                             $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                             $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                             $config['file_name'] = $result_file ; // อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                             $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die();
                    } else {
                        $update = $this->db->set('img_check_in', $result_file)->where('id', $id)->update('tb_checkin');
                        $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                    }
                } else {
                    $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ไม่สามารถลบรูปได้คะ สาเหตุมาจาก ไฟล์นั้นไม่มี หรือ ระบบเกิดผิดพลาด คะ');
				}
				
            } else {
                // กรณีไม่มีไฟล์รูป ให้ทำการ insert ทันที
				$config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/checkin/true/');
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                 $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                 $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                 $config['file_name'] = $result_file ; //อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                 $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die();
                } else {
                    $update = $this->db->set('img_check_in', $result_file)->where('id', $id)->update('tb_checkin');
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                }
            }
            echo json_encode($re);
            die();
        }
	}




	public function update_img_ck2(){
		$id = $this->input->post('e_img_id');
	
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); //ตัดชื่อไฟล์ออกเอาเฉพาะนามสกุล
		$newname   = 'f'.$id; //ชื่อไฟล์์ใหม่
		$result_file= $newname.'.'.$extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์
		$query  = $this->db->select('*')->where('id', $id)->get('tb_checkin');
		foreach ($query->result() as $row) {
			$file_img = $row->img_no_check_in;
            $path = realpath(APPPATH.'../public/tem_frontend/img/checkin/flase/').'/'.$file_img;

            // $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/').'/'.$file_img;

			
            if (file_exists($path)) {
			
                //กรณีมีไฟล์อยู่ ทำการลบไฟล์แล้ว insertใหม่
                if (unlink($path)) {
                    $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/checkin/flase/');
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                             $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                             $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                             $config['file_name'] = $result_file ; // อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                             $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die();
                    } else {
                        $update = $this->db->set('img_no_check_in', $result_file)->where('id', $id)->update('tb_checkin');
                        $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                    }
                } else {
                    $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ไม่สามารถลบรูปได้คะ สาเหตุมาจาก ไฟล์นั้นไม่มี หรือ ระบบเกิดผิดพลาด คะ');
				}
				
            } else {
                // กรณีไม่มีไฟล์รูป ให้ทำการ insert ทันที
				$config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/checkin/flase/');
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                 $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                 $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                 $config['file_name'] = $result_file ; //อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                 $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die();
                } else {
                    $update = $this->db->set('img_no_check_in', $result_file)->where('id', $id)->update('tb_checkin');
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                }
            }
            echo json_encode($re);
            die();
        }
    }
	
	public function update_img_ck3(){
		$id = $this->input->post('e_img_id');
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); //ตัดชื่อไฟล์ออกเอาเฉพาะนามสกุล
		$newname   = 'c'.$id; //ชื่อไฟล์์ใหม่
		$result_file= $newname.'.'.$extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์
		$query  = $this->db->select('*')->where('id', $id)->get('tb_checkin');
		foreach ($query->result() as $row) {
			$file_img = $row->img_true_check_in;
            $path = realpath(APPPATH.'../public/tem_frontend/img/checkin/ck/').'/'.$file_img;

            // $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/').'/'.$file_img;

			
            if (file_exists($path)) {
			
                //กรณีมีไฟล์อยู่ ทำการลบไฟล์แล้ว insertใหม่
                if (unlink($path)) {
                    $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/checkin/ck/');
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                             $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                             $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                             $config['file_name'] = $result_file ; // อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                             $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die();
                    } else {
                        $update = $this->db->set('img_true_check_in', $result_file)->where('id', $id)->update('tb_checkin');
                        $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                    }
                } else {
                    $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ไม่สามารถลบรูปได้คะ สาเหตุมาจาก ไฟล์นั้นไม่มี หรือ ระบบเกิดผิดพลาด คะ');
				}
				
            } else {
                // กรณีไม่มีไฟล์รูป ให้ทำการ insert ทันที
				$config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/checkin/ck/');
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                 $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                 $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                 $config['file_name'] = $result_file ; //อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                 $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die();
                } else {
                    $update = $this->db->set('img_true_check_in', $result_file)->where('id', $id)->update('tb_checkin');
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                }
            }
            echo json_encode($re);
            die();
        }
    }
}


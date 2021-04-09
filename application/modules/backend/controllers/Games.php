<?php
class Games extends MY_Controller
{
	 public function __construct()
    {
        parent::__construct();
		$this->load->model('getapi_model');
         $this->load->model('api/api_user_model');
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

		$data['point'] = $this->db->select('*')
							->where('status',1)
							->order_by('point','DESC')
							->get('tb_user')
						->result_array();
	
		
		$this->load->view('games',$data);
	}
	public function reset_point()
	{
		// error_reporting(E_ERROR | E_PARSE);
		$query = $this->db->query('SELECT tb_user.id as id, tb_user.spin - COUNT(tb_spin_store.spin) *300 as newspin FROM tb_user INNER JOIN tb_spin_store ON tb_spin_store.user_id = tb_user.id WHERE tb_spin_store.spin = 300 GROUP BY tb_user.id ORDER BY tb_user.id');
		$result = $query->result_array();
		$i = 0;
		
		foreach ($result as $key ) {
			if($key['newspin'] < 0){

				$dataupdate[$i] = array(
						'spin' => 0,
						'id' => $key['id']
					 );
			}else{
				$dataupdate[$i] = array(
						'spin' => $key['newspin'],
						'id' => $key['id']
					 );
			}
			
			$i++;
		}
		for($i=0;$i<$query->num_rows();$i++){

			 $this->db->set('spin',$dataupdate[$i]['spin'])->where('id',$dataupdate[$i]['id'])->update('tb_user');
		}
		
		
		

		die();
		
		
	}
	public function fetch_user(){
		$this->load->model('game_model');
		$fetch_data = $this->game_model->make_datatables();
		$i = $_POST['start'];
		foreach($fetch_data as $row){
            $i++;	
			$id = $row->id;
			$username= $row->username;
			$user = $row->user;
			if($row->name == ''){
				$name = '-';
			}else{
				$name = $row->name;
			}
			$point = $row->point;
			$spin = $row->spin; 
			// if($row->comefrom ==1){
			// 	$comefrom = '<span class="badge badge-secondary text-white">ลูกค้าเก่า</span>';
			// }
			// if($row->comefrom ==2)
			// {
			// 	$comefrom = '<span class="badge badge-info text-white">ลูกค้าใหม่</span>';
			// }
			$phone = $row->username;
			$link_page = "<a href='".base_url('backend/games/report_point/'.$row->id)."' title='เรียกดูพอยท์'><i class='fa fa-info-circle' aria-hidden='true'title='รายละเอียด'></i></a> " ;
			$data[] = array($i,$username,$user,$name,$point,$spin,$phone,$link_page);
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->game_model->get_all_data(),
			"recordsFiltered" => $this->game_model->get_filtered_data(),
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
        $data['data2'] = $this->db->where('status','1')->limit(100)->get('tb_exchange')->result_array();
        $data['data3'] = $this->db->where('status','0')->or_where('status','2')->limit(100)->order_by('id','DESC')->get('tb_exchange')->result_array();
		$this->load->view('reward',$data);

		
	}
	public function edit_dateadmin()
	{	
		$count = $this->db->select('COUNT(id)')->get('tb_exchange')->result_array();
		$sql = $this->db->select('id,create_time')->get('tb_exchange')->result_array();
		$i = 0;

	

		foreach ($sql as $key ) {
			$dataupdate[$i] = array(
						'id' => $key['id'] ,
						'create_time' => $key['create_time']
					 );
			$i++;
		}
		// echo "<pre>";
		// print_r($dataupdate);
		// die();
		for($i=0;$i<$count;$i++){

			 $this->db->set('admin_datetime',$dataupdate[$i]['create_time'])->where('id',$dataupdate[$i]['id'])->update('tb_exchange');
		}

		 

		
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

		$query = $this->db->query('SELECT COUNT(tb_spin_reward.id) as eiei,tb_spin_reward.status as tus ,tb_spin.* FROM tb_spin_reward Left JOIN tb_spin on tb_spin_reward.id_spin = tb_spin.id WHERE tb_spin_reward.id_spin IN (SELECT id FROM tb_spin )  GROUP BY id_spin');
		$count_rs =  $this->db->query('SELECT COUNT(tb_spin_reward.id) as eiei2,tb_spin_reward.status as tus ,tb_spin.* FROM tb_spin_reward Left JOIN tb_spin on tb_spin_reward.id_spin = tb_spin.id WHERE tb_spin_reward.id_spin IN (SELECT id FROM tb_spin ) and  tb_spin_reward.status = 1 GROUP BY id_spin');
		$data['spin'] = $query->result_array();
		$data['count_rs'] = $count_rs->result_array();

	

		$data['setting3'] = $this->db->where('name','switch_exchange')->get('setting')->result_array();
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

        if($this->input->post('id')){
            $reward_q = $this->db->where('id',$this->input->post('id'))->get('tb_exchange');
            if($reward_q->num_rows() == 1){
                $reward_r = $reward_q->row();
                $user_q = $this->db->where('user',$reward_r->id_user)->get('tb_user');
                if($user_q->num_rows() == 1){
                    $user_r = $user_q->row();
                    // Line Notify
                    $messageNotify = "แลกรางวัล \n รหัส : " . $user_r->user . "\n จำนวน เครดิต : " . $reward_r->point ."\n โดยใช้ คะแนน : ".$reward_r->cost."\n สถานะ : เฟริม \n พนักงาน : ".$this->session->admin['username'];
                    $this->notify_exchange($messageNotify);
                    
                    // update data
                    $array_updatereward = array(
                        'admin_id' => $this->session->admin['id'],
                        'admin_datetime' => time(),
                        'status'=>2
                    );
                    $updatereward = $this->db->where('id',$this->input->post('id'))->update('tb_exchange',$array_updatereward);
                    if($updatereward){
                        // Turn Over start 
                            $switch_exchange_r = $this->db->where('status',1)->get('setting_exchange')->row();
                            $turnuser_q = $this->db->where('user_id',$user_r->id)->get('tb_turnover');
                            $turnusernum   = 0;
                            if($switch_exchange_r->turn ==1){
                                $turnusernum = $reward_r->point * $switch_exchange_r->turn_num;
                            }
                            if($turnuser_q->num_rows() == 1){
                                $this->db->set('checkturn','checkturn +'.$turnusernum, FALSE)->where('user_id',$user_r->id)->update('tb_turnover');
                            }else{
                                $arrturnuser = array(
                                    'user_id' => $user_r->id,
                                    'promotion_id' => 0,
                                    'code_id' => 0,
                                    'sport' => 0,
                                    'casino' => 0,
                                    'game'=>0,
                                    'checkturn' => $turnusernum,
                                    'check_time' =>time(),
                                    'status'=> 1
                                );
                                $this->db->insert('tb_turnover',$arrturnuser);
                            }
                            // Turn Over end 
                            
                        $addcredit = $this->api_user_model->addcredit($user_r->user,$reward_r->point,'แลกพ้อย,point:'.$reward_r->cost.',credit:'.$reward_r->point.',admin:'.$this->session->admin['username']);
                        
                        $re = array('code'=>1);
                    }else{
                        $re = array('code'=>0);
                    }
                }
            }
        }
		echo json_encode($re);
        die();
	}
    function notify_exchange($messageNofity)
    {
        $lnfy_q = $this->db->where('type', 'reward')->get('tb_linenotify');
        if($lnfy_q->num_rows() == 1){
            $lnfy_r = $lnfy_q->row();
            $curl   = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://notify-api.line.me/api/notify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded",
                    "Authorization: Bearer " . $lnfy_r->token,
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
        }
    
        
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
		
		     $query = $this->db->query('SELECT COUNT(tb_spin_reward.id) as eiei,tb_spin_reward.status as tus ,tb_spin.* FROM tb_spin_reward JOIN tb_spin on tb_spin_reward.id_spin = tb_spin.id WHERE tb_spin_reward.id_spin IN (SELECT id FROM tb_spin )  GROUP BY id_spin ORDER BY tb_spin_reward.id_spin  ');
				$result = $query->result_array();
		      // echo '<pre>';
		      // print_r($result);
		      // die();
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
	// public function up_spin()
	// {
	// 	if($this->input->post('id')){
			
		

 //        $config['upload_path'] = realpath(APPPATH.'../public/tem_frontend/img/wheel/');
	// 		//$config['upload_path'] =  $_SERVER['DOCUMENT_ROOT'].'public/img/slide/';//ที่จัดเก็บ
	// 		$config['allowed_types'] = 'gif|jpg|png';
	// 		$config['max_size'] = '4000';
	// 		$config['max_width'] = '4000';
	// 		$config['max_hight'] = '3000';
	// 		$config['encrypt_name']  = true;

	// 		$this->load->library('upload',$config);
	// 		$this->upload->initialize($config);

	// 			if (!$this->upload->do_upload('e_img')) {
	// 			// echo $this->upload->display_errors();

	// 				$id =  $this->input->post('id');
	// 				$name =  $this->input->post('editname');
	// 				$percent =  $this->input->post('editpercent');
	// 				$point =  $this->input->post('editpoint');
				
	// 				$result = $this->db->set('name', $name)->set('percent', $percent)->set('point', $point)->where('id', $id)->update('tb_spin');
	// 										echo json_encode($result);
	// 			}else{

	// 				$data = array('upload_data' => $this->upload->data());
	// 				$filename = $data['upload_data']['file_name'];
	// 				$image = $filename;
	// 				$id =  $this->input->post('id');
	// 				$name =  $this->input->post('editname');
	// 				$percent =  $this->input->post('editpercent');
	// 				$point =  $this->input->post('editpoint');
	// 				$result = $this->db->set('name', $name)->set('percent', $percent)->set('point', $point)->set('spin', $image)->where('id', $id)->update('tb_spin');
	// 				echo json_encode($result);
		    
	// 		}
	// 		$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
	// 	}else{
	// 		$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
	// 	}
	// 	echo json_encode($re);
	// }
	public function up_spin()
	{	
		
		$percent = [];
		for($i=0;$i<=7;$i++){
			 $percent[$i] = (float)$this->input->post('editpercent'.$i);
		}
		$cnt_percent = COUNT($percent);				
		$drop = $this->db->empty_table('tb_spin_reward');
		if($drop){
		$reset_autoincrement = $this->db->query("ALTER TABLE tb_spin_reward AUTO_INCREMENT 1");
		
		}
		if($reset_autoincrement){
			for($i=0;$i<$cnt_percent;$i++){
				
				
				if($percent[$i]==0){
					$item0 = array(
							'id_spin' => $i+1 ,
							'status' => 2
						 );
				$rs =  $this->db->insert('tb_spin_reward',$item0);
					
				}else{}
			}
					for($i=1;$i<=$percent[0];$i++){

						$item1 = array(
							'id_spin' => 1 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item1);
					}
					for($i=1;$i<=$percent[1];$i++){
						$item2 = array(
							'id_spin' => 2 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item2);
					}
					for($i=1;$i<=$percent[2];$i++){
						$item3 = array(
							'id_spin' => 3 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item3);
					}
					for($i=1;$i<=$percent[3];$i++){
						$item4 = array(
							'id_spin' => 4 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item4);
					}
					for($i=1;$i<=$percent[4];$i++){
						$item5 = array(
							'id_spin' => 5 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item5);
					}
					for($i=1;$i<=$percent[5];$i++){
						$item6 = array(
							'id_spin' => 6 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item6);
					}
					for($i=1;$i<=$percent[6];$i++){
						$item7 = array(
							'id_spin' => 7 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item7);
					}
					for($i=1;$i<=$percent[7];$i++){
						$item8 = array(
							'id_spin' => 8 ,
							'status' => 1
						 );
						$this->db->insert('tb_spin_reward',$item8);
					}
					$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
		}else{
			$re = array('msg' => 'ไม่สำเร็จ กรุณาติดต่อโปรแกรมเมอร์' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ');
		}
		
		echo json_encode($re);
		die();

	}

	public function up_userpoint()
	{		
				
					$id =  $this->input->post('id');
					$point =  $this->input->post('point');
					$spin =  $this->input->post('spin');				
					$result = $this->db->set('point', $point)->set('spin', $spin)->where('id', $id)->update('tb_user');
					echo json_encode($result);												
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
		$data['checkin'] = $this->db->where('status', 1)->get('tb_checkin')->result_array();
		$data['setting'] = $this->db->where('name', 'spin_amount')->or_where('name', 'deposit_day')->get('setting')->result_array();
        
		// สร้าง table ใหม่ กรณีไม่มี
        if($this->db->table_exists('setting_exchange') != 1 )
        {
            $this->create_table_model->tb_setting_exchange();
        }
        if($this->db->table_exists('tb_turnover') != 1 )
        {
            $this->create_table_model->tb_tb_turnover();
        }
        $data['setting3'] = $this->db->where('id',1)->get('setting_exchange')->row();
		$this->load->view('checkin', $data);
		
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

	public function edit_first_deposit()
	{

		  if($this->input->post('id')){
			  $id = $this->input->post('id');
			  $status = $this->input->post('status');
			  $data = $this->db->set('status',$status)->where('id',$id)->update('setting');
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

            $query = $this->db->set('auto', 1)->where('id', 1)->update('setting_exchange');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }

        echo json_encode($re);
        die();
    }
    public function disable_credit()
    {
        // 0 ปิด 1 เปิด

            $query = $this->db->set('auto', 0)->where('id', 1)->update('setting_exchange');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }

        echo json_encode($re);
        die();
    }
     public function enable_spin()
    {
        $id = $this->input->post('id');

        if (isset($id)) {
            $query = $this->db->set('code', 1)->where('id', $id)->update('setting');
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
    public function disable_spin()
    {
        // 0 ปิด 1 เปิด
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('code', 0)->where('id', $id)->update('setting');
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


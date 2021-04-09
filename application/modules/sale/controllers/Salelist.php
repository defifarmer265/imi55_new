<?php
class Salelist extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('sale/sale_model');
		$this->load->library('Sale_libraray');
		$this->sale_libraray->login();
		$this->output->set_template('tem_sale/tem_sale');
		
	}
	public function index()
	{
		$sale = $this->db->select('tb_sale.token,tb_sale.id,tb_sale.username,tb_sale.name,tb_sale.status,COUNT(tb_sale_user.id) as num_user')
			->join('tb_sale_user','tb_sale_user.sale_id = tb_sale.id','left')
			->group_by('tb_sale.id')
			->where('tb_sale.status',1)
			->where('tb_sale.sale_id',$this->session->sale->id)
			->order_by('COUNT(tb_sale_user.id)', 'DESC')
			->get('tb_sale')
			->result_array();
		$i=0;
		foreach($sale as $sl){
			$sale[$i]['num_userM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userM')
				->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
				->where('tb_user.create_time >=',strtotime(date('1-m-Y 00:00:00')))
				->where('tb_sale_user.sale_id',$sl['id'])
				->get('tb_sale_user')
				->row()->num_userM;
			$sale[$i]['num_userD'] = $this->db->select('COUNT(tb_sale_user.id) as num_userD')
				->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
				->where('tb_user.create_time >=',strtotime(date('d-m-Y 00:00:00')))
				->where('tb_sale_user.sale_id',$sl['id'])
				->get('tb_sale_user')
				->row()->num_userD;
			$sale[$i]['num_userLM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userLM')
				->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
				->where('tb_user.create_time >=',strtotime('-1 month', strtotime(date('F') . '1')) )
				->where('tb_user.create_time <',strtotime(date('1-m-Y 00:00:00')) )
				->where('tb_sale_user.sale_id',$sl['id'])
				->get('tb_sale_user')
				->row()->num_userLM;
			$i++;
		}
		$data = array(
			'sale' =>  $sale,
			);
		$this->load->view('sale_home',$data);
		 
	}
	
	//ค้นหาจากสถานะ เซลล์ทั้งหมด เซลล์ที่เปิด เซลล์ที่ปิด
	public function get_sale()
	{
		if($this->input->post('status') != null){
			$status = $this->input->post('status');
			$sale = $this->db->select('tb_sale.token,tb_sale.id,tb_sale.username,tb_sale.name,tb_sale.status,COUNT(tb_sale_user.id) as num_user')
				->join('tb_sale_user','tb_sale_user.sale_id = tb_sale.id','left')
				->where('tb_sale.sale_id',$this->session->sale->id)
				->group_by('tb_sale.id');
			$i=0;
		
			if($status != 'a'){
				$this->db->where('tb_sale.status',$status);
			}
			$sale = $this->db->order_by('tb_sale.id', 'DESC')
							->get('tb_sale')
							->result_array();
			foreach($sale as $sl){
				$sale[$i]['num_userM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userM')
					->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
					->where('tb_user.create_time >=',strtotime(date('1-m-Y 00:00:00')))
					->where('tb_sale_user.sale_id',$sl['id'])
					->get('tb_sale_user')
					->row()->num_userM;
				$sale[$i]['num_userD'] = $this->db->select('COUNT(tb_sale_user.id) as num_userD')
					->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
					->where('tb_user.create_time >=',strtotime(date('d-m-Y 00:00:00')))
					->where('tb_sale_user.sale_id',$sl['id'])
					->get('tb_sale_user')
					->row()->num_userD;
				$sale[$i]['num_userLM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userLM')
					->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
					->where('tb_user.create_time >=',strtotime('-1 month', strtotime(date('F') . '1')) )
				->where('tb_user.create_time <',strtotime(date('1-m-Y 00:00:00')) )
					->where('tb_sale_user.sale_id',$sl['id'])
					->get('tb_sale_user')
					->row()->num_userLM;
				$i++;
			}
			if($sale){
				$re = array('code' => 1,'title'=>'สำเร็จ','msg'=>'ทำรายการสำเร็จกรุณาตรวจสอบรายการ','data'=>$sale);
			}else{
				$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}

		}else{
			$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}

	//หน้าคำนวณ หน้าในงบประมาณ
	public function calsale()
	{
		if($this->uri->segment(4)){
			$id = $this->uri->segment(4);
			$data['sale'] = $this->db->select('tb_sale.name,tb_sale.username,tb_sale.id')->where('id',$id)->get('tb_sale')->row();
			$data['setting'] = $this->db->select('*')->get('tb_sale_setting')->row();

			$this->load->view('sale_calsale',$data);
		}else{
			redirect(base_url().'backend/sale');
		}
		
		
	}
	
	//ใช้สำหรับเมื่อใส่งบประมาณจะคำนวณค่าเฉลี่ยออกมา
	function calculate_()
	{
		
		if($this->input->post('d1') && $this->input->post('d2') && $this->input->post('cost')){
			$setting = $this->db->select('*')->get('tb_sale_setting')->row();
			$d1 = strtotime($this->input->post('d1').'00:00:00');
			$d2 = strtotime($this->input->post('d2').'23:59:59');
			$id = $this->input->post('id');
			$uf = $this->input->post('uf');
			$cost = $this->input->post('cost');
			$user_sd= $this->db->select('tb_sale_user.user_id,tb_statement.deposit,tb_user.create_time,tb_statement.datetime')
						->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
						->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
						->group_by('tb_sale_user.user_id')
						->where('tb_sale_user.sale_id', $id)
						->where('tb_user.create_time >=',$d1)
						->where('tb_user.create_time <=',$d2)
						->where('tb_statement.datetime >=',$d1)
//						->where('tb_statement.datetime <=',$d2)
						->order_by('tb_statement.id','ASC')
						->get('tb_sale_user')
						->result_array();
			$sdall= $this->db->select('SUM(tb_statement.deposit) as sumall')
						->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
						->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
						->where('tb_sale_user.sale_id', $id)
						->where('tb_user.create_time >=',$d1)
						->where('tb_user.create_time <=',$d2)
						->where('tb_statement.datetime >=',$d1)
//						->where('tb_statement.datetime <=',$d2)
						->order_by('tb_statement.id','ASC')
						->get('tb_sale_user')
						->row()->sumall;
			$swall= $this->db->select('SUM(tb_statement.withdraw) as swall')
						->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
						->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
						->where('tb_sale_user.sale_id', $id)
						->where('tb_user.create_time >=',$d1)
						->where('tb_user.create_time <=',$d2)
						->where('tb_statement.datetime >=',$d1)
//						->where('tb_statement.datetime <=',$d2)
						->order_by('tb_statement.id','ASC')
						->get('tb_sale_user')
						->row()->swall;
			
			$numf0 = 0;
			$numf1 = 0;
			$numf2 = 0;
			$sumtt = 0;
			$numf = 0;
			$sumft = 0;
			foreach ($user_sd as $usd){
				if($usd['deposit'] > 0 && $usd['deposit'] < $setting->f_amt0){
					$numf0++;
				}else if($usd['deposit'] >=  $setting->f_amt0 && $usd['deposit'] < $setting->f_amt1){
					$numf1++;
					$sumft = $sumft + $usd['deposit'];
				}else if($usd['deposit'] >=  $setting->f_amt1 ){
					$numf2++;
				}
				$numf++;
				$sumtt = $sumtt + $usd['deposit'];
			}
			$numall	= $this->db->select('COUNT(tb_sale_user.id) as numall')
									->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
									->where('tb_sale_user.sale_id',$id)
									->where('tb_user.create_time >=',$d1)
									->where('tb_user.create_time <=',$d2)
									->get('tb_sale_user')
									->row()->numall;
			$data['numf0'] 	= number_format($numf0);
			$data['numf1'] 	= number_format($numf1);
			$data['numf2'] 	= number_format($numf2);
			$data['sumtt']	= number_format($sumtt);
			$data['sdall']	= number_format($sdall);
			$data['swall']	= number_format($swall);
			$data['numf']	= number_format($numf);
			$data['numall']	= number_format($numall);
			$data['sumft']	= number_format($sumft);
			if($numf <= 0){
				$numf = 1;
			}
			$average = ($cost / $numf);
			$data['average']= number_format($average);
			
			if($average <= $setting->ave1){
				$pay1 = $setting->ave1_pay1;
				$pay2 = $setting->ave1_pay2;
				$typepay = 'ave1';
			}else if($average >= $setting->ave1 && $average < $setting->ave2){
				$pay1 = $setting->ave2_pay1;
				$pay2 = $setting->ave2_pay2;
				$typepay = 'ave2';
			}else if($average >= $setting->ave2 && $average < $setting->ave3){
				$pay1 = $setting->ave3_pay1;
				$pay2 = $setting->ave3_pay2;
				$typepay = 'ave3';
			}else if($average >= $setting->ave3 && $average < $setting->ave4){
				$pay1 = $setting->ave4_pay1;
				$pay2 = $setting->ave4_pay2;
				$typepay = 'ave4';
			}else if($average >= $setting->ave4 && $average < $setting->ave5){
				$pay1 = $setting->ave5_pay1;
				$pay2 = $setting->ave5_pay2;
				$typepay = 'ave5';
			}else{
				$pay1 = 0;
				$pay2 = 0;
				$typepay = 'ave6';
			}
			$sumf1 = $numf1 * $pay1;
			$sumf2 = $numf2 * $pay2;
			$comtt = $sumf1 + $sumf2;
			$data['comtt'] = $comtt;
			$tt = $sumtt - ($comtt + $cost);
			$data['tt'] = number_format($tt);
			$data['typepay'] = $typepay;
			$data['pay1'] = $pay1;
			$data['pay2'] = $pay2;
			$re = array('code' => 1,'title'=>'สำเร็จ','msg'=>'','data'=>$data);
		}else{
			$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ','date'=>'');
		}
		echo json_encode($re);
		die();
	}
	
	//รายการยูเซอร์
	public function report_sale()
	{
		if($this->input->post('d1') && $this->input->post('d2')){
			$d1 = strtotime($this->input->post('d1').'00:00:00');
			$d2 = strtotime($this->input->post('d2').'23:59:59');
			$id = $this->input->post('id');
			$user_sd = $this->db->select('
			tb_sale_user.user_id,tb_statement.deposit,
			tb_user.create_time,
			tb_user.user,tb_user.username,
			tb_statement.datetime')
							->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
							->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
							->group_by('tb_sale_user.user_id')
							->where('tb_sale_user.sale_id', $id)
							->where('tb_user.create_time >=',$d1)
							->where('tb_user.create_time <=',$d2)
							->order_by('tb_statement.id','ASC')
							->get('tb_sale_user')
							->result_array();

			if($user_sd){
				$re = array('code' => 1,'title'=>'สำเร็จ','msg'=>'ทำรายการสำเร็จกรุณาตรวจสอบรายการ','data'=>$user_sd);
			}else{
				$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		}else{
			$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
		
	}
	
	//เปิดปิดเซลล์
	public function edit_status()
	{
	
		//Array ( [id] => 9 [status] => 0 )
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			$sale_q = $this->db->select('name,id')->where('id',$id)->where('sale_id',$this->session->sale->id)->get('tb_sale');
			if($sale_q->num_rows() == 1){
				$sale_r = $sale_q->row();
				if($this->db->set('status',$status)->where('id',$id)->update('tb_sale')){
				
					$re = array('code' => 1,'title'=>'สำเร็จ','msg'=>'ทำรายการสำเร็จกรุณาตรวจสอบรายการ');
							
					//save Log type Login
					if($status == 0){$statuscode = 'close';}else{$statuscode = 'open';}
					$log_detail = '(openclose),('.$this->session->sale->id.'),('.$this->session->sale->name.'),('.$statuscode.'/'.$sale_r->id.'/'.$sale_r->name.'),';
					$log_type 	= 'openclose';
					$this->sale_libraray->log_sale($log_type,$log_detail);
				}else{
					$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
				}
			}else{
				$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
			
		}else{
			$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}
	public function cre_sale()
	{	
		// print_r($this->input->post()); die();
		$check_sale = $this->db->where('username', $this->input->post('username'))->get('tb_sale');
		if($check_sale->num_rows() <= 0){
			if($pwd = $this->input->post('password')){
				if($username = $this->input->post('username')){
					if($name = $this->input->post('name')){
						$salt = $this->sale_libraray->salt();
						$password = $this->sale_libraray->hash_password($pwd,$salt);
						$token = $this->gen_token($username);
						$check_token = $this->db->select('token')->where('token', $token)->get('tb_sale');
						if($check_token->num_rows() <= 0){
						$dataCreate = array(
							'username' 	=> $username,
							'name' 		=> $name,
							'password' 	=> $password,
							'salt' 		=> $salt,
							'token' 	=> $token,
							'sale_id' 	=> $this->session->sale->id,
							'status' 	=> 1

						);
						if($this->db->insert('tb_sale',$dataCreate) == 1){
							
							$re = array('msg' =>'Success','code'=> 1 );
							
							//save Log type Login
							$log_detail = '(createsale),('.$this->session->sale->id.'),('.$this->session->sale->name.'),('.$username.'/'.$name.'/'.$pwd.'/'.$token.'),';
							$log_type 	= 'createsale';
							$this->sale_libraray->log_sale($log_type,$log_detail);
						}else{
							$re = array('msg' =>'ยูเซอร์ซ้ำ','code'=> 0 );
						}
						
					}else{
						$re = array('msg' => 'Tokenซ้ำ', 'code'=> 0);
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
	public function edit_pass()
	{//Array ( [id] => 3 [pass] => asdfsadf )
		if($this->input->post('id')){
			$id 	= $this->input->post('id');
			$pwd 	= $this->input->post('pass');
			$salt 	= $this->sale_libraray->salt();
			$password = $this->sale_libraray->hash_password($pwd,$salt);
			$sale_q = $this->db->select('id,name,username')->where('id',$id)->get('tb_sale');
			if($sale_q->num_rows() == 1){
				$sale_r = $sale_q->row();
				if($this->db->set('salt',$salt)->set('password',$password)->where('id',$id)->update('tb_sale')){
					$re = array('code' => 1,'title'=>'สำเร็จ','msg'=>'ทำรายการสำเร็จกรุณาตรวจสอบรายการ');
					
					//save Log type Login
					$log_detail = '(editpass),('.$this->session->sale->id.'),('.$this->session->sale->name.'),('.$sale_r->id.'/'.$sale_r->username.'/'.$sale_r->name.'/'.$pwd.'),';
					$log_type 	= 'editpass';
					$this->sale_libraray->log_sale($log_type,$log_detail);
				}else{
					$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
				}
			}else{
				$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		}else{
			$re = array('code' => 0,'title'=>'ไม่สำเร็จ','msg'=>'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}
	public function gen_token($username){
		$token = '';
			$token = str_replace(['+', '/', '='], ['-', '_', ''],base64_encode($username));
		return $token;
	}
}



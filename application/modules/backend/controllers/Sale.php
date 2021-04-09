<?php
class Sale extends MY_Controller
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

	public function home()
	{
		$sale = $this->db->select('tb_sale.token,tb_sale.id,tb_sale.username,tb_sale.name,tb_sale.status,COUNT(tb_sale_user.id) as num_user')
			->join('tb_sale_user', 'tb_sale_user.sale_id = tb_sale.id', 'left')
			->group_by('tb_sale.id')
			->where('tb_sale.status', 1)
			->order_by('COUNT(tb_sale_user.id)', 'DESC')
			->get('tb_sale')
			->result_array();
		$i = 0;
		foreach ($sale as $sl) {
			$sale[$i]['num_userM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userM')
				->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
				->where('tb_user.create_time >=', strtotime(date('1-m-Y 00:00:00')))
				->where('tb_sale_user.sale_id', $sl['id'])
				->get('tb_sale_user')
				->row()->num_userM;
			$sale[$i]['num_userD'] = $this->db->select('COUNT(tb_sale_user.id) as num_userD')
				->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
				->where('tb_user.create_time >=', strtotime(date('d-m-Y 00:00:00')))
				->where('tb_sale_user.sale_id', $sl['id'])
				->get('tb_sale_user')
				->row()->num_userD;
			$sale[$i]['num_userLM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userLM')
				->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
				->where('tb_user.create_time >=', strtotime('-1 month', strtotime(date('F') . '1')))
				->where('tb_user.create_time <', strtotime(date('1-m-Y 00:00:00')))
				->where('tb_sale_user.sale_id', $sl['id'])
				->get('tb_sale_user')
				->row()->num_userLM;
			$i++;
		}
		$data = array(
			'sale' =>  $sale,
		);
		$this->load->view('sale_home', $data);
	}

	public function edit_pass()
	{
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$pass = $this->input->post('pass');
			$salt = $this->salt();
			$password = $this->hash_password($pass, $salt);
			if ($this->db->set('salt', $salt)->set('password', $password)->where('id', $id)->update('tb_sale')) {
				$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => 'ทำรายการสำเร็จกรุณาตรวจสอบรายการ');
			} else {
				$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		} else {
			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}
	public function detail($id)
	{
		if (isset($id)) {
			$data['sale'] = $this->db->select('tb_sale.name,tb_sale.username,tb_sale.id')->where('id', $id)->get('tb_sale')->row();
			$this->load->view('sale_detail', $data);
		} else {
			$this->load->view('login');
		}
	}
	public function calsale($id)
	{
		if (isset($id)) {
			$data['sale'] = $this->db->select('tb_sale.name,tb_sale.username,tb_sale.id')->where('id', $id)->get('tb_sale')->row();
			$data['setting'] = $this->db->select('*')->get('tb_sale_setting')->row();
			$this->load->view('sale_calsale', $data);
		} else {
			$this->load->view('login');
		}
	}

	function calculate_()
	{
		if ($this->input->post('d1') && $this->input->post('d2') && $this->input->post('id')) {
            $cost       = $this->input->post('cost') != null ? $this->input->post('cost') : 1;
			$setting    = $this->db->select('*')->get('tb_sale_setting')->row();
			$date_start = strtotime($this->input->post('d1') . '00:00:00');
			$date_end   = strtotime($this->input->post('d2') . '23:59:59');
			$sale_id    = $this->input->post('id');
            $user_q 	= $this->db->select('
                            group_concat(tb_statement.deposit SEPARATOR ",") as deposit,
                            tb_user.id,tb_user.username,tb_user.user,tb_user.create_time,
                                
                            ')
                            ->join('tb_user','tb_user.id = tb_sale_user.user_id')
							->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
                            ->group_by('tb_sale_user.user_id')
                            ->where('tb_sale_user.sale_id',$sale_id)
                            ->where('tb_user.create_time >=',$date_start)
                            ->where('tb_user.create_time <=',$date_end)
                            ->where('tb_statement.status',2)
                            ->order_by('tb_statement.id','ASC')
                            ->get('tb_sale_user');
            
//            $count_user = $user_q->num_rows();
//            if(!empty($count_user) && $count_user  !=0) {
//                $user_r = $user_q->result_array(); // หาค่ายูสเซอร์เพื่อทำการวนลูป
//                $i      = 0;
//                $dpsi1  = 0;
//                $dpsi2  = 0;
//                foreach($user_r as $user=>$us){  
//                    
//                    if(!empty($us['deposit']) && $us['deposit'] != ''){
//                        //แยกรายการยอดฝากเป็น array
//                        $deposit = explode(",",$us['deposit']);
//                        
//                        //แทนค่ายอดฝาก 1 และ 2
//                        $user_r[$i]['dps1'] = empty($deposit[0]) ?  0 : $deposit[0];
//                        $user_r[$i]['dps2'] = empty($deposit[1]) ?  0 : $deposit[1];
//                        
//                        //นับจำนวนยอดฝาก 1 และ 2
//                        empty($deposit[0]) ?   : $dpsi1++;
//                        empty($deposit[1]) ?   : $dpsi2++;
//
//                       //ระบบคำนวณเรทยอดฝากลูกค้า
//                        if($deposit[0] < $setting->f_amt0){
//                            $numf1++;
//                            $sum_famt12 = $sum_famt12 + $deposit[0];
//                        }else if($deposit[0] < $setting->f_amt1){
//                            $numf2++;
//                            $sum_famt12 = $sum_famt12 + $deposit[0];
//                        }else{
//                            $numf3++;
//                        }
//                        
//                        //รวมยอดฝากสมาชิกคนนึ้
//                        $dps_sum_peruser = array_sum($deposit);
//                        $user_r[$i]['dpssum'] = $dps_sum_peruser;
//                    }else{
//                        //รวมยอดฝากสมาชิกคนนึ้
//                        $user_r[$i]['dpssum'] = 0;   
//                    }
//                    
//                }
//			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '', 'data' => $data);
//		} else {
//			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ', 'date' => '');
//		}
        
		echo json_encode($user_q->result_array());
		die();
	   }
    }

	public function setting()
	{
		$data['setting'] = $this->db->select('*')->get('tb_sale_setting')->row();
		$this->load->view('sale_setting', $data);
	}

	public function edit_setting()
	{
		if ($this->db->update('tb_sale_setting', $this->input->post())) {

			$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '');
		} else {
			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}

	public function eidt_pass()
	{
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$pass = $this->input->post('pass');
			$salt = $this->salt();
			$password = $this->hash_password($pass, $salt);
			if ($this->db->set('salt', $salt)->set('password', $password)->where('id', $id)->update('tb_sale')) {
				$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => 'ทำรายการสำเร็จกรุณาตรวจสอบรายการ');
			} else {
				$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		} else {
			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}

	public function edit_status()
	{
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			if ($this->db->set('status', $status)->where('id', $id)->update('tb_sale')) {
				$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => 'ทำรายการสำเร็จกรุณาตรวจสอบรายการ');
			} else {
				$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		} else {
			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}

	public function get_sale()
	{
		if ($this->input->post('status') != null) {
			$status = $this->input->post('status');
			$sale = $this->db->select('tb_sale.token,tb_sale.id,tb_sale.username,tb_sale.name,tb_sale.status,COUNT(tb_sale_user.id) as num_user')
				->join('tb_sale_user', 'tb_sale_user.sale_id = tb_sale.id', 'left')
				->group_by('tb_sale.id');
			$i = 0;

			if ($status != 'a') {
				$this->db->where('tb_sale.status', $status);
			}
			$sale = $this->db->order_by('tb_sale.id', 'DESC')
				->get('tb_sale')
				->result_array();
			foreach ($sale as $sl) {
				$sale[$i]['num_userM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userM')
					->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
					->where('tb_user.create_time >=', strtotime(date('1-m-Y 00:00:00')))
					->where('tb_sale_user.sale_id', $sl['id'])
					->get('tb_sale_user')
					->row()->num_userM;
				$sale[$i]['num_userD'] = $this->db->select('COUNT(tb_sale_user.id) as num_userD')
					->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
					->where('tb_user.create_time >=', strtotime(date('d-m-Y 00:00:00')))
					->where('tb_sale_user.sale_id', $sl['id'])
					->get('tb_sale_user')
					->row()->num_userD;
				$sale[$i]['num_userLM'] = $this->db->select('COUNT(tb_sale_user.id) as num_userLM')
					->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
					->where('tb_user.create_time >=', strtotime('-1 month', strtotime(date('F') . '1')))
					->where('tb_user.create_time <', strtotime(date('1-m-Y 00:00:00')))
					->where('tb_sale_user.sale_id', $sl['id'])
					->get('tb_sale_user')
					->row()->num_userLM;
				$i++;
			}
			if ($sale) {
				$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => 'ทำรายการสำเร็จกรุณาตรวจสอบรายการ', 'data' => $sale);
			} else {
				$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
			}
		} else {
			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}

	public function report_sale()
	{
		if ( $this->input->post( 'd1' ) && $this->input->post( 'd2' ) ) {
            $d1 = strtotime( $this->input->post( 'd1' ) . '00:00:00' );
            $d2 = strtotime( $this->input->post( 'd2' ) . '23:59:59' );
            $sale_id = $this->input->post( 'id' );

            $user_nodps = $this->db->select( '
                            tb_user.id,tb_user.username,tb_user.user,tb_user.create_time,
                            ' )->join( 'tb_user', 'tb_user.id = tb_sale_user.user_id' )->join( 'tb_statement', 'tb_statement.user_id = tb_sale_user.user_id', 'left' )->where( 'tb_statement.id IS NULL', null, false )->where( 'tb_sale_user.sale_id', $sale_id )->where( 'tb_user.create_time >=', $d1 )->where( 'tb_user.create_time <=', $d2 )

            ->get( 'tb_sale_user' )->result_array();
            $re = array( 'code' => 1, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ', 'data' => $user_nodps );
        } else {
            $re = array( 'code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ' );
        }
        echo json_encode( $re );
        die();
	}


	public function get_rp_sale()
	{
		$d1 = strtotime($this->input->post('d1') . '00:00:00');
		$d2 = strtotime($this->input->post('d2') . '23:59:59');
		// print_r($this->input->post());

		// die();
		if ($this->input->post('id_sale') != '') {
			$sale_id = $this->input->post('id_sale');
			$sale = $this->db->select('name')
				->where('id', $sale_id)
				->get('tb_sale')
				->result_array();

			$user_id = $this->db->select('tb_sale_user.user_id,tb_user.create_time,tb_sale.name')
				->from('tb_sale_user')
				->join('tb_user', 'tb_user.id=tb_sale_user.user_id', 'left')
				->join('tb_sale', 'tb_sale.id=tb_sale_user.sale_id', 'left')
				->where('tb_sale_user.sale_id', $sale_id)
				->where('create_time >=', $d1)
				->where('create_time <=', $d2)
				->get()
				->result_array();
			$i = 0;
			foreach ($user_id as $uid) {
				$dt_user = $this->db->select('id, username, user, create_time')
					->where('id', $uid['user_id'])
					->get('tb_user')
					->result_array();
				$user_id[$i]['dt_user'] = $dt_user;
				$dt_bank = $this->db->select('tb_user_bank.account, tb_bank.bank_short, tb_user_bank.status')
					->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
					->where('tb_user_bank.user_id', $uid['user_id'])
					->get('tb_user_bank')
					->result_array();
				$user_id[$i]['dt_bank'] = $dt_bank;
				$dt_fsale = $this->db->select('id as id_statement ,deposit')
					->where('user_id', $uid['user_id'])
					->order_by('id', 'asc')
					->limit(3)
					->get('tb_statement')
					->result_array();
				$user_id[$i]['dt_fsale'] = $dt_fsale;
				$i++;
			}
		}
		//print_r($user_id);
		//die();
		echo json_encode(array('code' => 1, 'msg' => 'Success', 'data' => $user_id));
		die();
	}

	public function cre_sale()
	{

		// print_r($this->input->post()); die();
		$check_sale = $this->db->where('username', $this->input->post('username'))->get('tb_sale');
		if ($check_sale->num_rows() <= 0) {
			if ($pwd = $this->input->post('password')) {
				if ($username = $this->input->post('username')) {
					if ($name = $this->input->post('name')) {
						$salt = $this->salt();
						$password = $this->hash_password($pwd, $salt);
						$token = $this->gen_token($username);
						$check_token = $this->db->select('token')->where('token', $token)->get('tb_sale');
						if ($check_token->num_rows() <= 0) {
							$dataCreate = array(
								'username' => $username,
								'name' => $name,
								'password' => $password,
								'salt' => $salt,
								'token' => $token,
								'status' => 1

							);
							if ($this->db->insert('tb_sale', $dataCreate) == 1) {
								$re = array('msg' => 'Success', 'code' => 1);
							} else {
								$re = array('msg' => 'ยูเซอร์ซ้ำ', 'code' => 0);
							}
						} else {
							$re = array('msg' => 'Tokenซ้ำ', 'code' => 0);
						}
					} else {
						$re = array('msg' => 'มีปัญหา ข้อมูลไม่ครบ', 'code' => 0);
					}
				} else {
					$re = array('msg' => 'มีปัญหา ข้อมูลไม่ครบ', 'code' => 0);
				}
			} else {
				$re = array('msg' => 'มีปัญหา ข้อมูลไม่ครบ', 'code' => 0);
			}
		} else {
			$re = array('msg' => 'ยูเซอร์ซ้ำ', 'code' => 0);
		}

		echo json_encode($re);
		die();
	}

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


	///////////////////////////////////////////////////////////////////// token
	public function gen_token($username)
	{
		$token = '';
		$token = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($username));
		return $token;
	}

	public function update_token()
	{


		$token = $this->token();
		$saleid = $this->input->post('sale_id');


		$check_token = $this->db->where('token', $token)->get('tb_sale');

		if ($check_token->num_rows() > 0) {

			$token = $this->update_token();
		} else {

			if ($up_token = $this->db->set('token', $token)->where('id', $saleid)->update('tb_sale')) {

				$get_token = $this->db->select('token')->where('id', $saleid)->get('tb_sale')->row();

				$re = array('code' => 1, 'msg' => 'อัพเดตลิ้งค์ใหม่สำเร็จ', 'token' => $get_token);
			}
		}

		echo json_encode($re);
		die();
	}
	public function token()
	{

		$length = 10;
		$token = '';
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$max = strlen($codeAlphabet);

		for ($i = 0; $i < $length; $i++) {
			$token .= $codeAlphabet[random_int(0, $max - 1)];
		}

		return $token;
	}

	public function rp_sale()
	{

		$this->load->view('report_sale');
	}

	public function first_depo()
	{

		$dayO = $this->input->post('d1');
		$dayT = $this->input->post('d2');
		$d1 = strtotime($dayO . '00:00:00'); //start_date
		$d2 = strtotime($dayT . '23:59:59'); //end_date

		$all_user = $this->db->where('tb_user.create_time >=', $d1)->where('tb_user.create_time <=', $d2)
			->get('tb_user')
			->num_rows();

		$sale = $this->db->select('id, username, name')->where('status', 1)->get('tb_sale')->result_array();
		$i = 0;
		foreach ($sale as $sl) {
			$count_user = $this->db->select('COUNT(tb_sale_user.user_id) as user')
				->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
				->where('tb_user.create_time >=', $d1)
				->where('tb_user.create_time <=', $d2)
				->where('tb_sale_user.sale_id', $sl['id'])
				->get('tb_sale_user')
				->row();
			$sale[$i]['count_user'] = $count_user;

			// first statement deposit
			$first = $this->db->select('tb_sale_user.user_id,tb_statement.deposit as deposit, tb_user.user')
				->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
				->join('tb_statement', 'tb_statement.user_id = tb_sale_user.user_id', 'left')
				->where('tb_user.create_time >=', $d1)
				->where('tb_user.create_time <=', $d2)
				->where('tb_statement.deposit >', 0)
				->where('tb_sale_user.sale_id', $sl['id'])
				->order_by('tb_statement.id', 'ASC')
				->group_by('tb_sale_user.user_id')
				->get('tb_sale_user');
			$count_first =	$first->num_rows();
			$depo_first = $first->result_array();

			$sale[$i]['count_first'] = $count_first;

			$more = 0;
			$less = 0;
			$moreee = 0;
			$j = 0;
			foreach ($depo_first as $de) {
				if ($de['deposit'] >= 300) {
					$more += 1;
				} else if ($de['deposit'] < 100) {
					$moreee += 1;
				} else {
					$less += 1;
				}

				$j++;
			}
			$sale[$i]['more'] = $more;
			$sale[$i]['less'] = $less;
			$sale[$i]['moreee'] = $moreee;
			$i++;
		}

		$re = array('code' => 1, 'sale' => $sale, 'all_user' => $all_user, 'dayO' => $dayO, 'dayT' => $dayT);

		echo json_encode($re);
		die();
	}


	public function getturn()
	{
		$dayO = $this->input->post('d1');
		$dayT = $this->input->post('d2');
		$d1 = strtotime($dayO . '00:00:00'); //start_date
		$d2 = strtotime($dayT . '23:59:59'); //end_date
		$data_sent = json_encode(array(
			"from"=> $d1,
			"to"=> $d2
		));
		$d = json_decode($this->getapi_model->call_API_mongo('turnover/user/'.$this->input->post('user').'/date', $data_sent, "POST"));
		 echo json_encode(array('sum'=>$d->totalTurnover));
		 die;
	}
}

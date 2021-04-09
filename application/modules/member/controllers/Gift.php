<?php
class Gift extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
		$this->load->model('backend/getapi_model');
        $this->load->model('backend/create_table_model');
		$this->load->library('Member_libraray');
		$this->load->library('users/users_library');
		$this->load->model('api/api_model');
        $this->load->model('api/api_user_model');
		$this->_init();
    }
    private function _init()
    {
        $this->output->set_template('tem_web/tem_mapraw');
        $this->member_libraray->login();
    }
    public function index()
    {
    }
    public function hash_data()
    {
        $user_id = $this->input->post('user_id');
        $webname = $this->input->post('webname');
        $data = json_encode(array(
            'user_id' => $user_id,
            'webname' => $webname,
        ));
        $encrypted_user_id = $this->users_library->encrypt_data('encrypt', $data);
        header("Location:https://www.imicontrol.com/?encrypted_user_id=" . $encrypted_user_id);
    }

	/* ------------------------------- gift_voucher----------------------------------------------- */
	public function gift_voucher()
	{
		$user_id = $this->session->userdata['member']->id;

		$data['gift'] = $this->db->select('log_gift_voucher.user_id,log_gift_voucher.gift_id,log_gift_voucher.receive,tb_gift.*')
			->join('tb_gift', 'tb_gift.id=log_gift_voucher.gift_id', 'left')
			->where('user_id', $user_id)
            ->order_by('log_gift_voucher.id','DESC')
			->get('log_gift_voucher')->result_array();
		$this->load->view('gift_voucher', $data);
	}
	public function gift_code()
	{
		if ($this->input->post('code')) {
			$code = $this->input->post('code');
			$tb_gift = $this->db->where('code', $code)->get('tb_gift');
			$user_id = $this->session->userdata['member']->id;

			if ($tb_gift->num_rows() == 1) {
				$tb_gift = $tb_gift->row();
				$gift_id = $tb_gift->id;

				$turn = $tb_gift->turnover;

				$time_start = $tb_gift->time_start;
				$time_end = $tb_gift->time_end;

				$type_user = $tb_gift->user;

				if ($type_user == 0) {

					if ($this->old_user($user_id, $time_start) == false) {
						$re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
						echo json_encode($re);
						die;
					}
				} else if ($type_user == 1) {
					if ($this->new_user($user_id, $time_start) == false) {
						$re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
						echo json_encode($re);
						die;
					}
				} else {
					if ($this->all_user($user_id, $time_start) == false) {
						$re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
						echo json_encode($re);
						die;
					}
				}

				//เช็คว่าเคยรับโค้ดไปแล้วหรือเปล่า
				if ($this->db->where('user_id', $user_id)->where('gift_id', $gift_id)->get('log_gift_voucher')->num_rows() == 0) {

					//เช็คเวลาโปรโมชั่น
					if (time() >= $time_start && time() <= $time_end) {

						$limit_user = $tb_gift->limit_user;

						//เช็คว่ายอดรับไม่เกินจำนวนที่ต้องการ
						if ($this->db->where('gift_id', $tb_gift->id)->get('log_gift_voucher')->num_rows() <= $limit_user) {

							//กรณี gift ติดเทิร์น Over
							if ($turn > 0) {

								// $uto_q = user trunover
								$tb_turnover = $this->db->select('sport,casino,game,checkturn')->where('user_id', $user_id)->get('tb_turnover');

								if ($tb_turnover->num_rows() == 1) {

									// อัพเดทเทิร์นเก่า ยังไม่อัพเดทแยก sport casino game
									$turn_older = $tb_turnover->row()->checkturn;

									$this->db->set('checkturn',	$turn_older + $tb_gift->turnover)->where('user_id', $user_id)->update('tb_turnover');

									//เสร็จ
								} else {
									// สร้าง trunover ใหม่
									$turnover = array(
										'user_id'       => $this->session->userdata['member']->id,
										'promotion_id'  => 0,
										'code_id'       => $tb_gift->id,
										'sport'         => 0,
										'casino'        => 0,
										'game'          => 0,
										'checkturn'     => $tb_gift->turnover,
										'check_time'    => time(),
										'status'        => 1,
									);
									$this->db->insert('tb_turnover', $turnover);

									//เสร็จ
								}
							}
							//แอดเครดิตหรือพ้อยให้ลุกค้า
							if ($tb_gift->point == 0) {

								if ($this->deposit($this->session->userdata['member']->user, $tb_gift->credit)) {	//แอดเครดิต

									$log_gift = array(
										'gift_id' => $tb_gift->id,
										'user_id' => $this->session->userdata['member']->id,
										'time_give' => time(),
										'admin' => $tb_gift->admin,
										'receive' => 1,
										'time_receive' => time(),
									);
									$this->db->insert('log_gift_voucher', $log_gift);
								} else {
									$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้ กรุณาติดต่อพนักงาน');
								}
							} else {
								//แอดพ้อย
								$point = $this->db->where('id', $user_id)->get('tb_user')->row()->point;
								$this->db->set('point', $point + $tb_gift->point)->where('id', $user_id)->update('tb_user');

								$log_gift = array(
									'gift_id' => $tb_gift->id,
									'user_id' => $this->session->userdata['member']->id,
									'time_give' => time(),
									'admin' => $tb_gift->admin,
									'receive' => 1,
									'time_receive' => time(),
								);
								$this->db->insert('log_gift_voucher', $log_gift);
							}
							$re = array('code' => 1, 'msg' => 'สำเร็จ');
						} else {
							// โค้ดเต็ม
							$re = array('code' => 0, 'msg' => 'สิทธ์การรับหมดมแล้ว');
						}
					} else {
						// โค้ดหมดเวลา
						$re = array('code' => 0, 'msg' => 'โค้ดหมดเวลา');
					}
				} else {
					//เคยรับโค้ดไปแล้ว
					$re = array('code' => 0, 'msg' => 'โค้ดถูกใช้งานแล้ว');
				}
			} else {
				// ไม่มีโค้ดนี้
				$re = array('code' => 0, 'msg' => 'โค้ดไม่ถูกต้อง');
			}
		} else {
			// ไม่ได้รับรหัสโค้ด
			$re = array('code' => 0, 'msg' => 'กรุณาใส่โค้ด');
		}
		echo json_encode($re);
		die;
	}
	public function receive_gift()
	{
		$user_id = $this->input->post('user_id');
		$gift_id = $this->input->post('gift_id');
		$user_api = $this->db->where('id', $user_id)->get('tb_user')->row()->user;

		$check_log_gift = $this->db->where('gift_id', $gift_id)->where('user_id', $user_id)->where('receive', 0)->get('log_gift_voucher');

		if ($check_log_gift->num_rows() == 1) { //เช็ค user กับ gift  ใน log

			$tb_gift = $this->db->where('id', $gift_id)->where('status', 1)->get('tb_gift'); //ดึงข้อมูล gift


			if ($tb_gift->num_rows() == 1) { //เช็คgift

				$time_start = $tb_gift->row()->time_start; //เวลเริ่ม
				$time_end = $tb_gift->row()->time_end; //เวลาจบ

				if (time() > $time_start && time() < $time_end) { //เช้ค give หมดอายุ

					$tb_turnover =  $this->db->where('user_id', $user_id)->where('status', 1)->get('tb_turnover')->row();
					$sport = $tb_turnover->sport;
					$casino =  $tb_turnover->casino;
					$game =  $tb_turnover->game;
					$checkturn =  $tb_turnover->checkturn;

					$turn  = $tb_gift->row()->turnover;
					$point_before = $this->db->where('id', $user_id)->get('tb_user')->row()->point; //point เดิม user 
					$point  = $tb_gift->row()->point; //พ้อยจาก tb_gift
					$credit = $tb_gift->row()->credit; // credit tb_gift


					if ($point != 0 && $credit == 0) { //มีพ้อย ไม่มีเครดิต

						if ($sport != '0' && $casino == '0' && $game == '0' && $checkturn == '0') {
							$checkturn_before = $tb_turnover->sport; // sport ก่อนนเพิ่ม
							$update_where = 'sport';

							if ($this->update_data_point($point, $point_before, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						} elseif ($sport == '0' && $casino != '0' && $game == '0' && $checkturn == '0') {

							$checkturn_before = $tb_turnover->casino; //casino ก่อนเพิ่ม
							$update_where = 'casino';

							if ($this->update_data_point($point, $point_before, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						} elseif ($sport == '0' && $casino == '0' && $game != '0' && $checkturn == '0') {

							$checkturn_before = $tb_turnover->game; //game ก่อนเพิ่ม
							$update_where = 'game';

							if ($this->update_data_point($point, $point_before, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						} else {
							$checkturn_before = $tb_turnover->checkturn; // เทิร์นก่อนเพิ่ม
							$update_where = 'checkturn';

							if ($this->update_data_point($point, $point_before, $user_api, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						}
					} else { //มีเครดิต ไม่มีพ้อย
						if ($sport != '0' && $casino == '0' && $game == '0' && $checkturn == '0') {

							$checkturn_before = $tb_turnover->sport; // sport ก่อนนเพิ่ม
							$update_where = 'sport';

							if ($this->update_data_credit($credit, $user_api, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						} elseif ($sport == '0' && $casino != '0' && $game == '0' && $checkturn == '0') {

							$checkturn_before = $tb_turnover->casino; //casino ก่อนเพิ่ม
							$update_where = 'casino';

							if ($this->update_data_credit($credit, $user_api, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						} elseif ($sport == '0' && $casino == '0' && $game != '0' && $checkturn == '0') {

							$checkturn_before = $tb_turnover->game; //game ก่อนเพิ่ม
							$update_where = 'game';

							if ($this->update_data_credit($credit, $user_api, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						} else {
							$checkturn_before = $tb_turnover->checkturn; // เทิร์นก่อนเพิ่ม
							$update_where = 'checkturn';

							if ($this->update_data_credit($credit, $user_api, $user_id, $checkturn_before, $gift_id, $update_where, $turn)) {
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else {
								$re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
							}
						}
					}
				} else {
					$re = array('code' => 0, 'msg' => 'Gift Voucher หมดอายุแล้ว');
				}
			} else {
				$re = array('code' => 0, 'msg' => 'ไม่สามารถรับ Gift Voucher ได้');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'Gift Voucher ถูกใช้งานแล้ว');
		}

		echo json_encode($re);
		die;
	}

	public function update_data_point($point, $point_before, $user_id, $checkturn_before, $gift_id, $update_where, $turn)
	{
		$data_point = array(
			'point' => $point + $point_before
		);
		$this->db->where('id', $user_id)->update('tb_user', $data_point); //update point 

		if ($turn != 0) {
			$data_turn = array(
				'' . $update_where . '' => (int)($checkturn_before + $turn)
			);
			$this->db->where('user_id', $user_id)->update('tb_turnover', $data_turn); //update ติดเทิร์น
		}

		$data_receive = array(
			'receive' => 1,
			'time_receive' => time()
		);
		$this->db->where('user_id', $user_id)->where('gift_id', $gift_id)->update('log_gift_voucher', $data_receive); //update receive

		return true;
	}

	public function update_data_credit($credit, $user_api, $user_id, $checkturn_before, $gift_id, $update_where, $turn)
	{
		if ($this->deposit($user_api, $credit)) { //add credit
			if ($turn != 0) {
				$data_turn = array(
					'' . $update_where . '' => (int)($checkturn_before + $turn)
				);
				$this->db->where('user_id', $user_id)->update('tb_turnover', $data_turn); //update ติดเทิร์น
			}

			$data_receive = array(
				'receive' => 1,
				'time_receive' => time()
			);
			$this->db->where('user_id', $user_id)->where('gift_id', $gift_id)->update('log_gift_voucher', $data_receive); //update receive


			return true;
		} else {
			return false;
		}
	}

	public function new_user($user_id, $time_start)
	{
		if ($this->db->where('id', $user_id)->where('create_time >', $time_start)->get('tb_user')->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function old_user($user_id, $time_start)
	{
		if ($this->db->where('id', $user_id)->where('create_time <', $time_start)->get('tb_user')->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function all_user($user_id)
	{
		if ($this->db->where('id', $user_id)->get('tb_user')->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	/* ------------------------------- end ----------------------------------------------- */


    public function gift()
    {

        $web_name = $this->db->where('name', 'web')->where('status', 1)->get('setting')->row()->code;
        $data_user = $this->session->member->user;
        $data = array(
            'user_id' => $data_user,
            'webname' => $web_name,
        );
        $this->load->view('gift', $data);
    }

    // exchange_rewards Start มะพร้าว ติดต่อด้วยจะแก้
	public function exchange_rewards()
	{

        if($this->db->table_exists('setting_exchange') != 1 )
        {
            $this->create_table_model->tb_setting_exchange();
        }
        if($this->db->table_exists('tb_turnover') != 1 )
        {
            $this->create_table_model->tb_tb_turnover();
        }
        
        
		$close_rewards = $this->db->select('*')->where('id', 9)->get('maintenance')->row();
		if ($close_rewards->status == 1) {
			$data['reward'] = $this->db->where('status', '1')->order_by('reward', 'ASC')->get('reward')->result_array();
			$data['user'] = $this->db->select('*')->where('id', $this->session->member->id)->get('tb_user')->row();
            $data['user']->credit = $this->api_user_model->getbalance($data['user']->user);
			$this->load->view('exchange_rewards', $data);
		} else {
			$this->load->view('403');
		}
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
	function exchange_pointocredit()
	{
        
        if($this->input->post('id_reward'))
        {
            $reward_q   = $this->db->where('id_reward',$this->input->post('id_reward'))->get('reward');
            $user_q     = $this->db->where('id',$this->session->member->id)->where('status',1)->get('tb_user');
            
            if($reward_q->num_rows() == 1 && $user_q->num_rows() == 1)
            {
                $reward_r   = $reward_q->row();
                $user_r     = $user_q->row();
                
                if($user_r->point >= $reward_r->prize)
                {
                    //ตรวจสอบว่าระบบแลกอัตโนมัติหรือต้องเฟริม
                    $switch_exchange_q = $this->db->where('status',1)->get('setting_exchange');
                    
                    if($switch_exchange_q->num_rows() == 1){
                        $switch_exchange_r = $switch_exchange_q->row();
                        $array_exchange = array(
                            'id_user'   => $user_r->user,
                            'point'     => $reward_r->reward,
                            'cost'      => $reward_r->prize,
                            'type'      => 'credit',
                            'create_time'       => time(),
                            'admin_id'          => 0,
                            'admin_datetime'    => 0,
                        );
                        // Delect Point start
                        $this->db->set('point','point -'.$reward_r->prize, FALSE)->where('id',$user_r->id)->update('tb_user');
                        // Delect Point end
                        
                        //แลกเครดิตอัตโนมัติ 
                        if($switch_exchange_r->auto == 1){
                            // Line Notify start
                            // status 2 สำเร็จเลย
                            $array_exchange['status'] = 2;
                            $messageNotify = "แลกรางวัล \n รหัส : " . $user_r->user . "\n จำนวน เครดิต : " . $reward_r->reward ."\n โดยใช้ คะแนน : ".$reward_r->prize."\n สถานะ : อัตโนมัติ";
                            // Line Notify End  
                            
                            // Turn Over start 
                            $turnuser_q = $this->db->where('user_id',$user_r->id)->get('tb_turnover');
                            $turnusernum   = 0;
                            if($switch_exchange_r->turn ==1){
                                $turnusernum = $reward_r->reward * $switch_exchange_r->turn_num;
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
                            
                            // Add credit start 
                            $addcredit = $this->api_user_model->addcredit($user_r->user,$reward_r->reward,'แลกพ้อย,point:'.$reward_r->prize.',credit:'.$reward_r->reward);
                            // Add credit end 
                            
                            // ลักษณะข้อมูลที่แจ้งกลับ
                            $title_ = "แลกรางวัลสำเร็จ กรุณาตรวจสอบเครดิตของท่าน";   

                        //แลกเครดิต ต้องเฟริมมือ
                        }else if($switch_exchange_r->auto == 0){
                            // Line Notify
                            // status 1 รอแอดมินเฟริม
                             $array_exchange['status'] = 1;
                            $messageNotify = "แลกรางวัล \n รหัส : " . $user_r->user . "\n จำนวน เครดิต : " . $reward_r->reward ."\n โดยใช้ คะแนน : ".$reward_r->prize."\n สถานะ : รอการยืนยัน";
                            // Line Notify End  
                            
                            // ลักษณะข้อมูลที่แจ้งกลับ
                            $title_ = "แลกรางวัลสำเร็จ รอพนักงานตอบรับ";
                            
                        }else{
                            // Line Notify
                            // status 0 ระบบมีปัญหา
                             $array_exchange['status'] = 0;
                            $messageNotify = "แลกรางวัล \n เกิดปัญหา แจ้งโปรแกรมเมอร์ \n ตาราง setting_exchang.auto != 1 หรือ 0";
                            // ลักษณะข้อมูลที่แจ้งกลับ
                            $title_ = "แลกรางวัล เกิดปัญหา กรุณาติดต่อพนักงาน";
                        }
                        // Line Notify
                        $this->notify_exchange($messageNotify);
                        
                        // เก็บข้อมูลเข้า tb_exchange 
                        $this->db->insert('tb_exchange', $array_exchange);
                        // ส่งค่ากลับ
                        $re = array( 'code' =>1 ,'title' => $title_);
                        echo json_encode($re);
		                die();
                    }  
                }
            }
        }
        $re = array( 'code' => 0 ,'title' => 'กรุณาตรวจสอบเงื่อนไขให้ถูกต้อง');
        echo json_encode($re);
		die();

	}
     // exchange_rewards End
}

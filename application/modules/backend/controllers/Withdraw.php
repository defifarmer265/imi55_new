<?php
class Withdraw extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('api/Api_model');
		$this->load->model('api/Api_user_model');
        
		$this->load->model('getapi_model');
		//$this->load->model('Scb_wd_model');
		$this->load->model('Bbl_wd_model');
		$this->load->model('scb_new_wd_model');
		$this->load->model('True_wd_model');
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
		$data['withdraw'] = $this->db
			->select('tb_withdraw.*,tb_user.user,tb_user.username,tb_bank.bank_short')
			->join('tb_user', 'tb_user.id = tb_withdraw.user_id')
			->join('tb_bank', 'tb_bank.api_id = tb_withdraw.bank_api')
			->order_by('tb_withdraw.id', 'DESC')
			->limit(500)
			->get('tb_withdraw')
			->result_array();
		$i = 0;
		foreach ($data['withdraw'] as $wd) {
			if ($wd['admin_cf'] != 0) {
				$data['withdraw'][$i]['admin_Fname'] = $this->db->select('tb_login.username')
					->where('id', $wd['admin_cf'])
					->get('tb_login')
					->row()
					->username;
			} else {
				$data['withdraw'][$i]['admin_Fname'] = '';
			}

			if ($wd['admin_check'] != 0) {
				$data['withdraw'][$i]['admin_Cname'] = $this->db->select('tb_login.username')->where('id', $wd['admin_check'])->get('tb_login')->row()->username;
			} else {
				$data['withdraw'][$i]['admin_Cname'] = '';
			}

			if ($wd['bank_web_id'] != 0) {
				$data['withdraw'][$i]['bw'] = $this->db->select('tb_bank_web.name')
					->where('id', $wd['bank_web_id'])
					//														->where('status !=',0)
					->get('tb_bank_web')
					->row()
					->name;
			} else {
				$data['withdraw'][$i]['bw'] = '';
			}

			$i++;
		}

		$statusBW = array(1, 3); //1 open 3 auto
		$data['bankweb'] = $this->db
			->select('tb_bank_web.*,tb_bank.bank_short')
			->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id')
			->where('tb_bank_web.type', 2)
			->where('tb_bank_web.id !=', 26)
			->where('tb_bank_web.id !=', 27)
			->where('status !=', 0)
			->where_in('tb_bank_web.status', $statusBW)
			->get('tb_bank_web')->result_array();
		$k = 0;
		$status_true = array('1', '2', '3');
		$sum = 0;
		foreach ($data['bankweb'] as $b) {

			$row_ste = $this->db->select('SUM(deposit) as sum_dps , SUM(withdraw) as sum_wd')->where_in('status', $status_true)->where('bank_id', $b['id'])->get('tb_statement')->row();
			$sum = $row_ste->sum_dps - $row_ste->sum_wd;
			$data['bankweb'][$k]['sum'] = $sum;
			$k++;
		}
		//		echo '<pre>';
		//		print_r($data['withdraw']);die();
		$this->load->view('withdraw', $data);
	}
	public function Verify()
	{
        
		if ($this->input->post('type') && $this->input->post('id')) {
			$type 	= $this->input->post('type');
			$id		= $this->input->post('id');
			$chk_bw_id		= $this->input->post('bw_id');

			$wd_r 	= $this->db->where('id', $id)->get('tb_withdraw')->row();

			$chk_bw_id_r 	= $this->db->select('id,bank_id')->from('tb_bank_web')->where('id', $chk_bw_id)->get()->row(); //ดึงข้อมูลธนาคารเว็บ

			$us_r = $this->db->select('tb_user.*,tb_user_bank.bank_id,tb_user_bank.account,tb_bank.api_id,tb_bank.bank_short')->from('tb_user')->join('tb_user_bank', 'tb_user.id=tb_user_bank.user_id', 'left')->join('tb_bank', 'tb_user_bank.bank_id =tb_bank.id', 'left')->where('tb_user.id', $wd_r->user_id)->get()->row();
			if ($type == 'check') {
				if ($wd_r->status == 1 && $chk_bw_id_r->bank_id == 5) { //check Verify scb bank
					if ($this->input->post('bw_id')) {
						$bw_id  = $this->input->post('bw_id');
						$bw_r 	= $this->db->where('id', $bw_id)->get('tb_bank_web')->row();
						$login_scb = $this->scb_new_wd_model->login();
						if ($login_scb !='') {
							$vertify = $this->scb_new_wd_model->getVerify($login_scb,$wd_r->account, $us_r->api_id, $wd_r->amount);

							$check_name = $this->db->select('name')->from('tb_user')->where('id', $wd_r->user_id)->get()->row();
							if ($check_name->name == '') {
								$data_up_name = array(
									'name'	=> $vertify['data']['accountToName']
								);
								$this->db->where('id', $wd_r->user_id);
								$this->db->update('tb_user', $data_up_name);
							}
                                          
                            $arr_wd = array( //เซฟว่าแอดมินคนไหนทำงาน
                                'admin_cf' => $this->session->userdata['users']['id'],
                                'admin_cfTime' => time(),
                                'bank_web_id' => $bw_r->id,
                                
                            );
                            $this->db->where('id', $wd_r->id)->update('tb_withdraw', $arr_wd);
                            
							echo json_encode(array('data' => $vertify, 'amt' => $wd_r->amount, 'code' => '014'));
							die();
						}
					}
				}else if($wd_r->status == 1 && $chk_bw_id_r->bank_id == 3) { //check Verify bbl bank
					$bw_id  = $this->input->post('bw_id');
					$bw_r 	= $this->db->where('id', $bw_id)->get('tb_bank_web')->row();
					$vertify = json_decode($this->Bbl_wd_model->Check($wd_r->account, intval($us_r->api_id), 1));
					$vertify->accountToBankCode = $us_r->api_id;
                    
					if ($vertify->status == true) {
                        $arr_wd = array(
									'admin_cf' => $this->session->userdata['users']['id'],
									'admin_cfTime' => time(),
									'bank_web_id' => $bw_r->id,
									
								);
						$this->db->where('id', $wd_r->id)->update('tb_withdraw', $arr_wd); // update status tb_withdraw

						echo json_encode(array('data' => $vertify, 'amt' => $wd_r->amount, 'code' => '002'));
						//die();
					} else {
						echo json_encode(array('data' => $vertify, 'code' => '000'));
					}
					die();
				}else if($wd_r->status == 1 && $chk_bw_id_r->bank_id == 21 ){ //check Verify True wallet
						
						$bw_id  = $this->input->post('bw_id');

						$bw_r 	= $this->db->select('account, name,user')->where('id',$bw_id)->get('tb_bank_web')->row();
						
						$ver_true = $this->True_wd_model->DraftTransferP2P($wd_r->account,$wd_r->amount);
						$check_name = $this->db->select('name')->from('tb_user')->where('id',$wd_r->user_id)->get()->row();
						
						if($check_name->name == ''){
							$data_up_name = array( 
								'name'	=> $ver_true['data']['recipient_name']
							);
							$this->db->where('id', $wd_r->user_id);
							$this->db->update('tb_user', $data_up_name);
						}

						 if($ver_true['code'] == 'TRC-200'){
						 	echo json_encode(array('data' =>$ver_true,'amt'=>$wd_r->amount,'code' =>'999', 'data_bank_web' => $bw_r));
						}else{
							echo json_encode(array('data' =>$ver_true['data'],'code' =>'000'));
						}
						die();
				}
			}
		}
	}

	public function line_push_wd($token_line, $amt)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://imi55.com:3031/push_withdraw",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "line_id=" . $token_line . "&message= ถอนเงิน " . $amt . " บาท สำเร็จ",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded"
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
	}

	public function confirm_withdraw()
	{
        
	

		if ($this->input->post('type') && $this->input->post('id')) {
			$type 	= $this->input->post('type');
			$id		= $this->input->post('id');
			$chk_bw_id		= $this->input->post('bw_id');

			$wd_r 	= $this->db->where('id', $id)->get('tb_withdraw')->row();
            
            
			// $us_r 	= $this->db->where('id',$wd_r->user_id)->get('tb_user')->row();
			$chk_bw_id_r 	= $this->db->select('id,bank_id')->from('tb_bank_web')->where('id', $chk_bw_id)->get()->row(); //ดึงข้อมูลธนาคารเว็บ


			$us_r = $this->db->select('tb_user.*,tb_user_bank.bank_id,tb_user_bank.account,tb_bank.api_id,tb_bank.bank_short')->from('tb_user')->join('tb_user_bank', 'tb_user.id=tb_user_bank.user_id', 'left')->join('tb_bank', 'tb_user_bank.bank_id =tb_bank.id', 'left')->where('tb_user.id', $wd_r->user_id)->get()->row();


			if ($type == 'check') {
//
				if ($wd_r->status == 1) {
                    
					if ($this->input->post('bw_id')) {
						$bw_id  = $this->input->post('bw_id');
						$bw_r 	= $this->db->where('id', $bw_id)->get('tb_bank_web')->row();
						// print_r($bw_r);
						// print_r($wd_r);
						// print_r($chk_bw_id_r->bank_id);
						// die();
						// เข้า bw_r แบงเว็บสถานะ อัตโนมัติ และ ประเภทรายการถอน
						if ($bw_r->status == '3' && $bw_r->type == '2' &&  $chk_bw_id_r->bank_id == 5) 
                        { 
                            //check status auto, type withdraw, bank scb
                            if($wd_r->admin_cf == $this->session->userdata['users']['id']){
                                
                                
							/*-------------------------- log_withdraw----------------------------------- */
                            
							$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

							$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
							$hostname = $hostname[0]['hostname'];

							$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
							$dbname = $dbname[0]['database_name'];
							$time = time();
							$sql = "INSERT INTO log_withdraw (admin,user_id,credit,bank, action,datetime) 
							   VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $us_r->user . "','" . $wd_r->amount . "','" . $us_r->bank_short . "',1,'" . $time . "')";
							if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
							} else {

								$sql = "CREATE TABLE log_withdraw (
								id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
								admin VARCHAR(20) NOT NULL,
								user_id VARCHAR(20) NOT NULL,
								credit INT(10) NOT NULL,
								bank VARCHAR(10) NULL,
								action INT(1) NOT NULL,
								datetime INT(20) NOT NULL
								) CHARACTER SET utf8 COLLATE utf8_general_ci;";
								$this->backend_library->query_sql($hostname, $dbname, $sql);

								$sql = "INSERT INTO log_withdraw (admin,user_id,credit,bank, action,datetime) 
							   VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $us_r->user . "','" . $wd_r->amount . "','" . $us_r->bank_short . "',1,'" . $time . "')";
								$this->backend_library->query_sql($hostname, $dbname, $sql);
							}

							/*--------------------------end  log_withdraw----------------------------------- */

							$login_scb = $this->scb_new_wd_model->login();
							if ($login_scb != '') {
								$wd_scb_auto = $this->scb_new_wd_model->Transfer($login_scb,$wd_r->account, $us_r->api_id, $wd_r->amount);
								if ($wd_scb_auto) {

									$arr_state_wd = array(
										'bank_id' => $bw_r->id,
										'datetime' => $wd_r->time,
										'deposit' => '0.00',
										'withdraw' => $wd_r->amount,
										'fee' => '0.00',
										'note' => 'withdraw auto @' . $bw_r->account,
										'dateCreate' => time(),
										'from_name' => $us_r->user,
										'from_account' => $us_r->account,
										'from_bank' => $us_r->bank_short,
										'user_id' => $us_r->id,
										'deposit_id' => 0,
										'withdraw_id' => $wd_r->id,
										'admin_id' => $this->session->userdata['users']['id'],
										'status' => 2,
									);



									//  ============
									$this->db->insert('tb_statement', $arr_state_wd);
									// sent data to mongodb
									//											$this->savetomongodb($bw_r->id,$us_r->id,$wd_r->id);


									//Line Nofity
									$this->notify_line($wd_r->time, $us_r->user, $wd_r->amount);
									$arr_wd = array(
										
										'status' => 2
									);
									$this->db->where('id', $wd_r->id)->update('tb_withdraw', $arr_wd);

									$token_line_id = $this->db->select('line_id')->from('tb_line')->where('tb_line.tel', $us_r->username)->get()->row();
									if (!empty($token_line_id)) {
										$this->line_push_wd($token_line_id->line_id, $wd_r->amount); //push line bot withdraw
									} else {
									}



									$re = array('code' => 1, 'msg' => '');
								} else {

									$re = array('code' => 0, 'msg' => 'ถอน auto false');
								}
							}
                            }else{
                                $re = array('code' => 0, 'msg' => 'แอดมินคอนเฟริมซ้ำกัน');
                            }
						} 
                        else if ($bw_r->status == '3' && $bw_r->type == '2' &&  $chk_bw_id_r->bank_id == 3) 
                        { //check status auto, type withdraw, bank bbl
                            if($wd_r->admin_cf == $this->session->userdata['users']['id']){
							/*-------------------------- log_withdraw----------------------------------- */
                            
							$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

							$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
							$hostname = $hostname[0]['hostname'];

							$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
							$dbname = $dbname[0]['database_name'];
							$time = time();
							$sql = "INSERT INTO log_withdraw (admin,user_id,credit,bank, action,datetime) 
							VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $us_r->user . "','" . $wd_r->amount . "','" . $us_r->bank_short . "',1,'" . $time . "')";
							if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
							} else {

								$sql = "CREATE TABLE log_withdraw (
									id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
									admin VARCHAR(20) NOT NULL,
									user_id VARCHAR(20) NOT NULL,
									credit INT(10) NOT NULL,
									bank VARCHAR(10) NULL,
									action INT(1) NOT NULL,
									datetime INT(20) NOT NULL
									) CHARACTER SET utf8 COLLATE utf8_general_ci";
								$this->backend_library->query_sql($hostname, $dbname, $sql);

								$sql = "INSERT INTO log_withdraw (admin,user_id,credit,bank, action,datetime) 
								   VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $us_r->user . "','" . $wd_r->amount . "','" . $us_r->bank_short . "',1,'" . $time . "')";
								$this->backend_library->query_sql($hostname, $dbname, $sql);
							}
							/*--------------------------end  log_withdraw----------------------------------- */


							$wd_bbl_auto = json_decode($this->Bbl_wd_model->Verify($wd_r->account, intval($us_r->api_id), $wd_r->amount)); // send withdraw bbl

							if ($wd_bbl_auto->status == true) {

								$arr_state_wd = array(
									'bank_id' => $bw_r->id,
									'datetime' => $wd_r->time,
									'deposit' => '0.00',
									'withdraw' => $wd_r->amount,
									'fee' => '0.00',
									'note' => 'withdraw auto @' . $bw_r->account,
									'dateCreate' => time(),
									'from_name' => $us_r->user,
									'from_account' => $us_r->account,
									'from_bank' => $us_r->bank_short,
									'user_id' => $us_r->id,
									'deposit_id' => 0,
									'withdraw_id' => $wd_r->id,
									'admin_id' => $this->session->userdata['users']['id'],
									'status' => 2,
								);
								$this->db->insert('tb_statement', $arr_state_wd); // insert to sb_statement 

								$this->notify_line($wd_r->time, $us_r->user, $wd_r->amount);

								$arr_wd = array(
									'status' => 2
								);
								$this->db->where('id', $wd_r->id)->update('tb_withdraw', $arr_wd); // update status tb_withdraw

								$token_line_id = $this->db->select('line_id')->from('tb_line')->where('tb_line.tel', $us_r->username)->get()->row();
								if (!empty($token_line_id)) {
									$this->line_push_wd($token_line_id->line_id, $wd_r->amount); //push line bot withdraw
								} else {
								}


								$re = array('code' => 1, 'msg' => $wd_bbl_auto->message);
							} else {
								$re = array('code' => 0, 'msg' => 'ถอน auto false');
							}
                            
                            }else{
                                $re = array('code' => 0, 'msg' => 'แอดมินคอนเฟริมซ้ำกัน');
                            }
						}else if($bw_r->status == '3' && $bw_r->type == '2' &&  $chk_bw_id_r->bank_id == 21){//check status auto, type withdraw, Truewallet
								 $ver_true = $this->True_wd_model->DraftTransferP2P($wd_r->account,$wd_r->amount);
								 if($ver_true['code'] == 'TRC-200'){
								 	$cf_true = $this->True_wd_model->ConfirmTransferP2P(); // confirm withdraw
								 	if($cf_true['code'] == 'TRC-200'){
								 			$arr_state_wd = array(
												'bank_id' => $bw_r->id,
												'datetime'=> $wd_r->time,
												'deposit'=> '0.00',
												'withdraw'=>$wd_r->amount,
												'fee'=> '0.00',
												'note'=> 'withdraw auto @'.$bw_r->account,
												'dateCreate'=> time(),
												'from_name'=> $us_r->user,
												'from_account'=> $us_r->account,
												'from_bank'=>$us_r->bank_short,
												'user_id'=>$us_r->id,
												'deposit_id'=>0,
												'withdraw_id'=>$wd_r->id,
												'admin_id'=>$this->session->userdata['users']['id'],
												'status'=>2, 
											);
											
											//  ============
											$this->db->insert('tb_statement', $arr_state_wd); //save statement
			
										

											//Line Nofity
											$this->notify_line($wd_r->time, $us_r->user, $wd_r->amount);

											
											$arr_wd = array(
												'admin_cf'=>$this->session->userdata['users']['id'],
												'admin_cfTime'=>time(),
												'bank_web_id'=>$bw_r->id,
												'status'=>2
												);
											$this->db->where('id',$wd_r->id)->update('tb_withdraw',$arr_wd);
												
											$re = array('code'=>1,'msg'=>'');
								 	}else{
								 		$re = array('code'=>0,'msg'=>'ถอน auto false');
								 	}
								 }else{
								 	$re = array('code'=>0,'msg'=>'ถอน auto false');
								 }
									
						} else {
								if ($this->db->set('status', 4)->where('id', $id)->update('tb_withdraw')) 
	                            {

									$this->db->set('admin_check', $this->session->users['id'])->set('bank_web_id', $bw_id)->where('id', $id)->update('tb_withdraw');
									$re = array('code' => 1, 'msg' => '');
								} else {
									$re = array('code' => 0, 'msg' => '1.1');
								}
						}
					} else {
						$re = array('code' => 0, 'msg' => '1.2');
					}
				} else {
					$re = array('code' => 0, 'msg' => '1.3');
				}
			//
            
            
            } 
                else if ($type == 'reject') 
            {
				if ($wd_r->status == 1) {
					if ($this->db->set('status', 3)->where('id', $id)->update('tb_withdraw')) {
						$arr_userAPI = array(
							'AgentName'	=> $this->getapi_model->agent(),
							'PlayerName' => $us_r->user,
							'Amount'	=> $wd_r->amount,
							'TimeStamp'	=> time()

						);
						$dataAPI = array(
							'type'		=> 'D',
							'agent' 	=> $this->getapi_model->agent(),
							'member' 	=> $us_r->user,
						);
						$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
						$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
						if ($cre_userAPI->Success == 1) {
							$this->db->set('admin_check', $this->session->users['id'])->where('id', $id)->update('tb_withdraw');
							$re = array('code' => 1, 'msg' => '');
						} else {
							$re = array('code' => 0, 'msg' => '2.0');
						}
					} else {
						$re = array('code' => 0, 'msg' => '2.1');
					}
				} else {
					$re = array('code' => 0, 'msg' => '2.2');
				}
			} else if ($type == 'confrim') 
            {

				if ($wd_r->status == 4) {
					$arr_upwd = array('status' => 2, 'admin_cf' => $this->session->users['id'], 'admin_cfTime' => time());
					if ($this->db->where('id', $id)->update('tb_withdraw', $arr_upwd)) {

						$arr_ste = array(
							'bank_id' 		=> $wd_r->bank_web_id,
							'datetime' 		=> time(),
							'deposit' 		=> 0.00,
							'withdraw' 		=> $wd_r->amount,
							'fee' 			=> 0.00,
							'note' 			=> 'Confirm' . $this->session->users['username'],
							'dateCreate' 	=> time(),
							'from_name' 	=> $us_r->user,
							'from_account' 	=> $wd_r->account,
							'from_bank' 	=> '',
							'user_id' 		=> $us_r->id,
							'deposit_id' 	=> 0,
							'withdraw_id' 	=> $wd_r->id,
							'admin_id' 		=> $this->session->users['id'],
							'status' 		=> 2,
						);


						//						echo '<pre>';
						//						print_r($arr_ste);
						//						die();
						if ($this->db->insert('tb_statement', $arr_ste)) {
							// // sent data to mongodb
			
							//  ============
							$line_q = $this->db->where('tel', $us_r->username)->get('tb_line');
							if ($line_q->num_rows() == 1) {
								$line_r = $line_q->row();
								$message = 'ทำรายการถอนสำเร็จ จำนวนเงิน ' . $wd_r->amount . ' บาทค่ะ';
								$line_id = $line_r->line_id;
								$this->line($line_id, $message);
							}
							//Line Nofity
							$this->notify_line($wd_r->time, $us_r->user, $wd_r->amount);
							/*-------------------------- log_withdraw----------------------------------- */
							$webname = $this->db->where('name', 'web')->get('setting')->row()->code;

							$sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
							$hostname = $hostname[0]['hostname'];

							$sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
							$dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
							$dbname = $dbname[0]['database_name'];
							$time = time();
							$sql = "INSERT INTO log_withdraw (admin,user_id,credit, action,datetime) 
							VALUES('" . $this->session->userdata['admin']['username'] . "', '" . $us_r->user . "', '" . $wd_r->amount . "', 2, '" . $time . "')";
							if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
							} else {

								$sql = "CREATE TABLE log_withdraw (
									id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
									admin VARCHAR(20) NOT NULL,
									user_id VARCHAR(20) NOT NULL,
									credit INT(10) NOT NULL,
									bank VARCHAR(10) NULL,
									action INT(1) NOT NULL,
									datetime INT(20) NOT NULL
									) CHARACTER SET utf8 COLLATE utf8_general_ci";
								$this->backend_library->query_sql($hostname, $dbname, $sql);

								$sql = "INSERT INTO log_withdraw (admin,user_id,credit, action,datetime) 
							VALUES('" . $this->session->userdata['admin']['username'] . "', '" . $us_r->user . "', '" . $wd_r->amount . "', 2, '" . $time . "')";

								$this->backend_library->query_sql($hostname, $dbname, $sql);
							}
							/*--------------------------end  log_withdraw----------------------------------- */


							$re = array('code' => 1, 'msg' => '');
						} else {
							$re = array('code' => 0, 'msg' => '3.2');
						}
					} else {
						$re = array('code' => 0, 'msg' => '3.3');
					}
				} else {
					$re = array('code' => 0, 'msg' => '3.4');
				}
			} else 
            {
				$re = array('code' => 0, 'msg' => '4.4');
			}
                
		} else {
			$re = array('code' => 0, 'msg' => 'ข้อมูลไม่ครบถ้วน');
		}
		echo json_encode($re);
		die();
	}
		public function see_wd()
	{
		$wit_id = $this->input->post('id');
		$user_id = $this->db->select('user_id')->where('id', $wit_id)->get('tb_withdraw')->row()->user_id;
		if ($user_id) {
			$user_q = $this->db->select('user,id')->where('id', $user_id)->where('status', 1)->get('tb_user');

			if ($user_q->num_rows() == 1) {
				$user_r = $user_q->row();
				$sta_r = $this->db->select('datetime,deposit,withdraw')
								->where('user_id', $user_r->id)
								->where('status', 2)
								->order_by('id', 'DESC')
								->limit('10')
								->get('tb_statement')
								->result_array();
			
				$wd_history = $this->Api_user_model->wd_history($user_r->user)->Result->Records;
				$i = 0;
				foreach($wd_history as $key=> $value){
					$datetime = strtotime($value->CreationTime)-3600;
					$wd_history[$i]->datetime = $datetime;
					if($value->Amount > 0){
					$wd_history[$i]->success = $this->db->select('id')->where('user_id',$user_id)->where('deposit',$value->Amount)->where('datetime <=',$datetime)->where('datetime >',$datetime-600)->order_by('id','DESC')->limit(1)->get('tb_statement')->num_rows();
					}else{
						$wd_history[$i]->success = 2;
					}
					$i++;
				}

				$re = array('code' => 0, 'sta_r' => $sta_r,'api_wdhistory' => $wd_history, 'msg' => '0022');
			} else {
				$re = array('code' => 0, 'data' => '', 'msg' => '0022');
			}
		} else {
			$re = array('code' => 0, 'data' => '', 'msg' => '0011');
		}
		echo json_encode($re);
		die();
	}
	// Log withdraw
	public function log_withdraw($action, $detail, $withdraw_db_id, $withdraw_api_id)
	{
		$arr_logState = array(
			'action' => $action,
			'detail' => $detail,
			'withdraw_db_id' => $withdraw_db_id,
			'withdraw_api_id' => $withdraw_api_id,
			'datetime' => time(),
			'admin_id' => $this->session->userdata['users']['id'],
		);
		$this->db->insert('log_withdraw', $arr_logState);
	}
     public function cancel_withdraw()
	{
        
		$arr_wd = array(
                'admin_cf' => '',
                'admin_cfTime' => '',
                'bank_web_id' =>'',

            );
         $this->db->where('id', $this->input->post('id'))->update('tb_withdraw', $arr_wd); // update status tb_withdraw
         $re = array('code' => 0, 'data' => '', 'msg' => 'ดำเนินการถอนไม่สำเร็จ');
		
	}
	public function line($line_id, $message)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://imi55.com:3031/push_withdraw",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "line_id=" . $line_id . "&message=" . $message,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded"
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	/////////////////////////////////
	function get_dw($user)
	{
		$user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
		
		if ($user_q->num_rows() == 1) {
			$user_r = $user_q->row();
			$sta_q = $this->db->select('datetime,deposit,withdraw,note')
				->where('user_id', $user_r->id)->where('status', 2)->order_by('id', 'DESC')->limit('10')->get('tb_statement');

			if ($sta_q->num_rows() != 0) {
				$sta_r = $sta_q->result_array();
				$i = 0;
				foreach ($sta_r as $st) {
					$sta_r[$i]['date_tim'] = date('d-m-Y H:i:s', $st['datetime']);
					$i++;
				}

				$re = array('code' => 1, 'data' => $sta_r, 'msg' => '002');
			} else {
				$re = array('code' => 0, 'data' => '', 'msg' => '002');
			}
		} else {
			$re = array('code' => 0, 'data' => '', 'msg' => '001');
		}
		return $re;
	}
	public function get_BW()
	{
		
	
			if ($bw_id = $this->input->post('bw_id')) {
				$id = $this->input->post('id');
				$status_true = array('1', '2', '3');
				$bw = $this->db->select('SUM(tb_statement.deposit) as sum_dps , SUM(tb_statement.withdraw) as sum_wd,tb_bank_web.*,tb_withdraw.amount')
					->join('tb_statement', 'tb_statement.bank_id = tb_bank_web.id', 'left')
					->join('tb_withdraw', 'tb_withdraw.id =' . $id)
					->where('tb_bank_web.id', $bw_id)
					->where_in('tb_statement.status', $status_true)
					->get('tb_bank_web')
					->row();
				//			print_r($bw);
				//			die();
				$sum = $bw->sum_dps - $bw->sum_wd;
				if ($sum > $bw->amount) {
					if ($bw->status == 3) {
						$re = array('code' => 1, 'title' => 'ถอนด้วย AUTO', 'msg' => 'ห้ามทำรายการเอง');
					} else {
						$re = array('code' => 2, 'title' => 'ยืนยันการถอน', 'msg' => 'กรุณาโอนออกตามบัญชีที่ระบุ');
					}
				} else {
					$re = array('code' => 0, 'title' => 'ยอดเงินหมด', 'msg' => 'ยอดเงินไม่เพียงพอต่อการถอน');
				}
	
			} else {
				$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ข้อมูลไม่ครบถ้วน');
			}
		
		

		echo json_encode($re);
		die();


	}
	function notify_line($wd_time, $user, $amount)
	{
		if ($lnfy = $this->db->where('type', 'withdraw')->get('tb_linenotify')->row()) {
			if ($lnfy->token != '') {
				$wd_delay 	= time() - $wd_time;
				$delay		= $lnfy->delay * 60;
				if ($amount >= $lnfy->balance || $wd_delay > $delay) {

					$messageNofity = 'ถอนสำเร็จ รหัส:' . substr($user, -6) . ' จำนวน:' . $amount . ' ใช้เวลา:' . (number_format($wd_delay / 60)) . 'นาที';
					$curl = curl_init();
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
							"Authorization: Bearer " . $lnfy->token
						),
					));

					$response = curl_exec($curl);
					curl_close($curl);
				}
			}
		}
	}
	public function re_widthdraw()
	{

		if ($this->input->post('id')) {
			$name_admin = $this->session->userdata['users']['name'];
			$id = $this->input->post('id');
			$text = $name_admin . ' รีรายการถอนที่ ' . $id;
			$res = $this->db->set('status', 4)->where('withdraw_id', $id)->update('tb_statement');

			if ($res) {
				$res_stm = $this->db->set('status', 1)->where('id', $id)->update('tb_withdraw');
				if ($res_stm) {
					$array_log_rewithdraw = array(
						'admin_id'		=> $this->session->userdata['users']['id'],
						'data_log'		=> $text,
						'time_log' => strtotime(date('Y-m-d H:i:s')),

					);
					$this->db->insert('log_safecode', $array_log_rewithdraw);
					$re = array('msg' => 'เรียบร้อย', 'code' => 1, 'title' => 'สำเร็จ');
				}
			}
		} else {
			$re = array('msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน', 'code' => 0, 'title' => 'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
		die();
	}



	//   save to mongo db state wihtdraw
	public function savetomongodb($bank_web_id, $userid, $wd_r_id)
	{


		$bw_r = $this->db->where('id', $bank_web_id)->get('tb_bank_web')->row();
		$us_r = $this->db->select('tb_user.*,tb_user_bank.account,tb_user_bank.bank_id')->join('tb_user_bank', 'tb_user.id=tb_user_bank.user_id')->where('tb_user.id', $userid)->get('tb_user')->row();
		$us_b = $this->db->where('id', $us_r->bank_id)->get('tb_bank')->row();
		$wd_r = $this->db->where('id', $wd_r_id)->get('tb_withdraw')->row();
		$b 	  = $this->db->where('id', $bw_r->bank_id)->get('tb_bank')->row();

		$data_sent = json_encode(array(
			"query" => array(
				"tb_name" => "tb_statements",
				"where" => array(
					"Operators" => array(
						"and" => array(
							"data" => null
						)
					),
				),
				"skip" => 0,
				"limit" => 0,
				"sort" => array("_id" => -1), //-1 DESC   1 ASC
				"de_selector" => null,
			),
			"data" =>  array(
				"bw_account" =>  $bw_r->account,
				"bw_name" => $bw_r->name,
				"bw_bankshort" => $b->bank_short,
				"deposit_id" => "0",
				"withdraw_id" => $wd_r->id,
				"ste_detetime" => $wd_r->time,
				"ste_deposit" => "0.00",
				"ste_withdraw" => $wd_r->amount,
				"ste_fee" => "0",
				"ste_note" => "withdraw auto @ " . $bw_r->account . " Confirm" . $this->session->users['username'],
				"from_name" => "0",
				"from_account" => "0",
				"from_bank" => "0",
				"us_id" => $us_r->id,
				"us_user" => $us_r->user,
				"us_tel" => $us_r->username,
				"us_name" => $us_r->name,
				"us_account" => $us_r->account,
				"us_bankshort" => $us_b->bank_short,
				"ad_id" => $this->session->users['id'],
				"ad_name" => $this->session->users['name'],
				"ad_user" => $this->session->users['username'],
				"ad_detetime" => "" . time() . "",
				"type" => "withdraw",
				"status" => "2"
			)
		));
		return $this->getapi_model->call_API_mongo($data_sent, "POST");
	}
}

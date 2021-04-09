<?php
class Promotion extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();
		$this->load->model('backend/getapi_model');
		$this->load->library('Member_libraray');
		$this->load->model('api/api_model');
		$this->load->model('backend/check_turn');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('tem_web/tem_mapraw');
		$this->member_libraray->login();
	}
	public function index()
	{
		$pro = $this->db->where('status', 1)->get('tb_promotion')->result_array();

		$day_now = date('w', time());
		$time_now = date('Hi', time());
		$pro_load = [];
		foreach ($pro  as $dt) {
			$day = explode(',', $dt['day_show']);

			foreach ($day as $d) {

				if ($day_now == $d) {
					if ($time_now >= $dt['time_start_show'] && $time_now <= $dt['time_end_show']) {

						array_push($pro_load, $dt);
						// echo '<pre>';
						// print_r($data);
						// die;

					}
				} else {

				}
			}
		}
		$data['dt'] = $pro_load;
		$this->load->view('promotion_all',$data);
	}

	public function detail($id)
	{

		$user_id = $this->session->userdata['member']->id;

		$tb_tunrover = $this->db->where('user_id', $user_id)->get('tb_turnover');

		$promotion_id = $tb_tunrover->row()->promotion_id;

		$pro_q  = $this->db->where('id', $id)->where('status', 1)->get('tb_promotion');
		($pro_q->num_rows() != 1) ? redirect(base_url('users/promotion'), 'refresh') : true;
		$data = $pro_q->row();
		$data_all = array(
			'id' => $data->id,
			'name' => $data->name,
			'casino' => $data->casino,
			'sport' => $data->sport,
			'game' => $data->game,
			'sum_turn' => $data->sum_turn,
			'percent' => $data->percent,
			'amount_max' => $data->amount_max,
			'bonus' => $data->bonus,
			'time_start' => $data->time_start,
			'time_end' => $data->time_end,
			'type' => $data->type,
			'min_creadit' => $data->min_creadit,
			'count_pro' => $data->count_pro,
			'detail_pro' => $data->detail_pro,
			'link_img' => $data->link_img,
			'status' => $data->status,
			'check_have_pro' => $promotion_id,
		);


		$this->load->view('promotion_detail', $data_all);
	}

	public function check_promotion()
	{
		$id = $this->input->post('id');

		if ($id != '' || $id != null) {

			$tb_tunrover = $this->db->where('user_id', $id)->get('tb_turnover');

			if ($tb_tunrover->num_rows() == 1) { //เช็คใน tb_turnover

				$promotion_id = $tb_tunrover->row()->promotion_id; // id

				if ($promotion_id != 0) {

					$re = array('code' => 1, 'promotion' => $promotion_id);
				} else {

					$re = array('code' => 0, 'promotion' => 'ไม่ได้สมัครโปรโมชั่น');
				}
			} else {
				$data = array(
					'user_id' => $id,
					'promotion_id' => 0,
					'code_id' => 0,
					'sport' => '0',
					'casino' => '0',
					'game' => '0',
					'checkturn' => '0',
					'check_time' => time(),
					'status' => 1
				);
				$this->db->insert('tb_turnover', $data);
				$re = array('code' => 2);
			}
		}
		echo json_encode($re);
		die;
	}

	public function test()
	{
		$user = $this->session->userdata['member']->user;

		if ($this->check_turn->get_outstanding($user) == 0) { /* checkoutstanding */
			echo 1;
		} else {
			echo 2;
		}
		die;
	}
	public function test1()
	{
		echo $dayofweek = date('w', time());
		die;
	}

	public function select_pro()
	{
		$user_id = $this->session->userdata['member']->id;
		$user = $this->session->userdata['member']->user;
		$promotion_id = $this->input->post('id');

		$tb_promotion =  $this->db->where('status', 1)->where('id', $promotion_id)->get('tb_promotion');

		$data_turn = array(
			'casino' => $tb_promotion->row()->casino,
			'sport' => $tb_promotion->row()->sport,
			'game' => $tb_promotion->row()->game,
			'sum_turn' => $tb_promotion->row()->sum_turn,
			'amount_turn' => $tb_promotion->row()->amount_turn
		);

		$user_credit_before =  $this->get_credit($user); //เครดิตก่อนเพิ่ม

		$tb_tunrover = $this->db->where('user_id', $user_id)->get('tb_turnover')->row();

		if (time() >= $tb_promotion->row()->time_start && time() <= $tb_promotion->row()->time_end) { //อยู่ในช่วงเวลา
			if ($tb_tunrover->promotion_id == 0) { // ไม่มีโปรค้าง

				if ($tb_promotion->row()->count_pro > 0) { //สิทการรับ > 0

					if ($tb_promotion->row()->user == 0) {

						if ($this->old_user($user_id, $tb_promotion->row()->time_start) == false) {
							$re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
							echo json_encode($re);
							die;
						}
					} else if ($tb_promotion->row()->user == 1) {
						if ($this->new_user($user_id, $tb_promotion->row()->time_start) == false) {
							$re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
							echo json_encode($re);
							die;
						}
					} else {
						if ($this->all_user($user_id, $tb_promotion->row()->time_start) == false) {
							$re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
							echo json_encode($re);
							die;
						}
					}

					if ($user_credit_before >= $tb_promotion->row()->min_creadit) { //เช็คเครดิตต่ำสุด

						$log_promotion = $this->db->where('user_id', $user_id)->where('promotion_id', $promotion_id)->order_by('id', 'DESC')->get('log_promotion'); //log_promotion

						if ($this->check_turn->get_outstanding($user) == 0) { // out standing ไม่มี

							if ($log_promotion->num_rows() == 0) { // ยังไม่เคยรับ

								if ($tb_promotion->row()->percent != '0') { //เปอร์เซ็นต์

									$bonus_creadit = $user_credit_before * ((($tb_promotion->row()->percent) * 1) / 100); //ทำเป็นเปอร์เซ็นต์

									if ($bonus_creadit >= $tb_promotion->row()->amount_max) { //เช็คโบนัสสูงสุด

										$bonus_creadit = $tb_promotion->row()->amount_max; //กำหนดโบนัสสูงสุด

										if ($this->deposit($user, $bonus_creadit)) { //add creadit 
											// if (true) { //add creadit 

											$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร

											$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
											if ($check) {
												$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
											}
										} else {
											$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
											echo json_encode($re);
											die;
										}
									} else {
										if ($this->deposit($user, $bonus_creadit)) { //add creadit 
											// if (true) {

											$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
											$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
											if ($check) {
												$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
											}
										} else {
											$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
											echo json_encode($re);
											die;
										}
									}
								} else { //bonus

									$bonus_creadit = $tb_promotion->row()->bonus;
									if ($this->deposit($user, $bonus_creadit)) { //add creadit 
										// if (true) {

										$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
										$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
										if ($check) {
											$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
										}
									} else {
										$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
										echo json_encode($re);
										die;
									}
								}
								$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
							} else { //เคบรับแล้ว

								switch ($tb_promotion->row()->type) { //เช็คเงื่อนไไขโปร

									case 1: //รับได้ครั้งเดียว
										$re = array('code' => 0, 'msg' => 'ใช้โปรโมชั่นไปแล้ว');
										break;

									case 2: //วันละครั้ง
										if (date('d:m', time()) != date('d:m', $log_promotion->row()->time)) {

											if ($tb_promotion->row()->percent != '0') { //เปอร์เซ็นต์

												$bonus_creadit = $user_credit_before * ((($tb_promotion->row()->percent) * 1) / 100); //ทำเป็นเปอร์เซ็นต์

												if ($bonus_creadit >= $tb_promotion->row()->amount_max) { //เช็คโบนัสสูงสุด

													$bonus_creadit = $tb_promotion->row()->amount_max; //กำหนดโบนัสสูงสุด

													if ($this->deposit($user, $bonus_creadit)) { //add creadit 
														// if (true) { //add creadit 

														$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร

														$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
														if ($check) {
															$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
														}
													} else {
														$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
														echo json_encode($re);
														die;
													}
												} else {
													if ($this->deposit($user, $bonus_creadit)) { //add creadit 
														// if (true) {

														$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
														$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
														if ($check) {
															$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
														}
													} else {
														$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
														echo json_encode($re);
														die;
													}
												}
											} else { //bonus

												$bonus_creadit = $tb_promotion->row()->bonus;
												if ($this->deposit($user, $bonus_creadit)) { //add creadit 
													// if (true) {

													$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
													$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
													if ($check) {
														$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
													}
												} else {
													$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
													echo json_encode($re);
													die;
												}
											}

											$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
										} else {
											$re = array('code' => 0, 'msg' => 'ใช้โปรโมชั่นไปแล้ว');
										}
										break;

									case 3:

										$time_ago = time() - 7 * 24 * 60 * 60; //สัปดาห์ละครั้ง

										if ($log_promotion->row()->time < $time_ago) {

											if ($tb_promotion->row()->percent != '0') { //เปอร์เซ็นต์

												$bonus_creadit = $user_credit_before * ((($tb_promotion->row()->percent) * 1) / 100); //ทำเป็นเปอร์เซ็นต์

												if ($bonus_creadit >= $tb_promotion->row()->amount_max) { //เช็คโบนัสสูงสุด

													$bonus_creadit = $tb_promotion->row()->amount_max; //กำหนดโบนัสสูงสุด

													if ($this->deposit($user, $bonus_creadit)) { //add creadit 
														// if (true) { //add creadit 

														$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
														$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
														if ($check) {
															$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
														}
													} else {
														$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
														echo json_encode($re);
														die;
													}
												} else {
													if ($this->deposit($user, $bonus_creadit)) { //add creadit 
														// if (true) {

														$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
														$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
														if ($check) {
															$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
														}
													} else {
														$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
														echo json_encode($re);
														die;
													}
												}
											} else { //bonus

												$bonus_creadit = $tb_promotion->row()->bonus;
												if ($this->deposit($user, $bonus_creadit)) { //add creadit 
													// if (true) {

													$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
													$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
													if ($check) {
														$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
													}
												} else {
													$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
													echo json_encode($re);
													die;
												}
											}

											$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
										} else {
											$re = array('code' => 0, 'msg' => 'ใช้โปรโมชั่นไปแล้ว');
										}
										break;

									default:
										if (date('m:y', time()) != date('m:y', $log_promotion->row()->time)) { //เดือนละครั้ง
											if ($tb_promotion->row()->percent != '0') { //เปอร์เซ็นต์

												$bonus_creadit = $user_credit_before * ((($tb_promotion->row()->percent) * 1) / 100); //ทำเป็นเปอร์เซ็นต์

												if ($bonus_creadit >= $tb_promotion->row()->amount_max) { //เช็คโบนัสสูงสุด

													$bonus_creadit = $tb_promotion->row()->amount_max; //กำหนดโบนัสสูงสุด

													if ($this->deposit($user, $bonus_creadit)) { //add creadit 

														// if (true) { //add creadit 

														$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
														$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
														if ($check) {
															$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
														}
													} else {
														$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
														echo json_encode($re);
														die;
													}
												} else {
													if ($this->deposit($user, $bonus_creadit)) { //add creadit 
														// if (true) {

														$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
														$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
														if ($check) {
															$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
														}
													} else {
														$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
														echo json_encode($re);
														die;
													}
												}
											} else { //bonus

												$bonus_creadit = $tb_promotion->row()->bonus;
												if ($this->deposit($user, $bonus_creadit)) { //add creadit 
													// if (true) {

													$user_credit_after =  $this->get_credit($user); //ดึงเครดิตหลังรับโปร
													$check = $this->arr_data($promotion_id, $user_id, $data_turn, $user_credit_after, $user_credit_before);
													if ($check) {
														$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
													}
												} else {
													$re = array('code' => 0, 'msg' => 'ไม่สารถเพิ่มเครดิตได้');
													echo json_encode($re);
													die;
												}
											}

											$re = array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
										} else {
											$re = array('code' => 0, 'msg' => 'ใช้โปรโมชั่นไปแล้ว');
										}
										break;
								}
							}
						} else {
							$re = array('code' => 0, 'msg' => 'คุณมียอดกำลังเล่นอยู่');
						}
					} else {
						$re = array('code' => 0, 'msg' => 'เครดิตต้องมากกว่า' . $tb_promotion->row()->min_creadit . ' เครดิต');
					}
				} else {
					$re = array('code' => 0, 'msg' => 'สิทธิ์ในการรับหมดแล้ว');
				}
			} else {
				$re = array('code' => 0, 'msg' => 'ติดโปรโมชั่น' . $tb_promotion->row()->name . 'อยู่');
			}
		} else {
			$re = array('code' => 0, 'msg' => 'ไม่อยู่ในช่วงเวลาจัดโปร');
		}
		echo json_encode($re);
		die;
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

	public function arr_data($promotion_id, $user_id, $data_turn,  $user_credit_after, $user_credit_before)
	{
		$casino = $user_credit_after * ($data_turn['casino']) * 1;
		$sport = $user_credit_after * ($data_turn['sport']) * 1;
		$game = $user_credit_after * ($data_turn['game']) * 1;
		$sum_turn = $user_credit_after * ($data_turn['sum_turn']) * 1;
		$amount_turn = $data_turn['amount_turn'] * 1;
		$tb_turnover = $this->db->where('user_id', $user_id)->get('tb_turnover');

		if ($tb_turnover->row()->sport != 0) {
			if ($amount_turn != 0) {
				$data = array(
					'promotion_id' => $promotion_id,
					'sport' => floor($tb_turnover->row()->sport + $amount_turn),
					'check_time' => time(),
					'status' => 1
				);
			} else {
				$data = array(
					'promotion_id' => $promotion_id,
					'sport' => floor($sport),
					'casino' => floor($casino),
					'game' => floor($game),
					'checkturn' => floor($sum_turn),
					'check_time' => time(),
					'status' => 1
				);
			}
			$this->db->where('user_id', $user_id)->update('tb_turnover', $data); //update tb_turnover 
		} else if ($tb_turnover->row()->casino != 0) {
			if ($amount_turn != 0) {
				$data = array(
					'promotion_id' => $promotion_id,
					'casino' => floor($tb_turnover->row()->casino + $amount_turn),
					'check_time' => time(),
					'status' => 1
				);
			} else {
				$data = array(
					'promotion_id' => $promotion_id,
					'sport' => floor($sport),
					'casino' => floor($casino),
					'game' => floor($game),
					'checkturn' => floor($sum_turn),
					'check_time' => time(),
					'status' => 1
				);
			}
			$this->db->where('user_id', $user_id)->update('tb_turnover', $data); //update tb_turnover 
		} else if ($tb_turnover->row()->game != 0) {
			if ($amount_turn != 0) {
				$data = array(
					'promotion_id' => $promotion_id,
					'game' => floor($tb_turnover->row()->game + $amount_turn),
					'check_time' => time(),
					'status' => 1
				);
			} else {
				$data = array(
					'promotion_id' => $promotion_id,
					'sport' => floor($sport),
					'casino' => floor($casino),
					'game' => floor($game),
					'checkturn' => floor($sum_turn),
					'check_time' => time(),
					'status' => 1
				);
			}
			$this->db->where('user_id', $user_id)->update('tb_turnover', $data); //update tb_turnover 
		} else {
			if ($amount_turn != 0) {
				$data = array(
					'promotion_id' => $promotion_id,
					'checkturn' => floor($tb_turnover->row()->checkturn + $amount_turn),
					'check_time' => time(),
					'status' => 1
				);
			} else {
				$data = array(
					'promotion_id' => $promotion_id,
					'sport' => floor($sport),
					'casino' => floor($casino),
					'game' => floor($game),
					'checkturn' => floor($sum_turn),
					'check_time' => time(),
					'status' => 1
				);
			}
			$this->db->where('user_id', $user_id)->update('tb_turnover', $data); //update tb_turnover 
		}

		$tb_promotion = $this->db->where('id', $promotion_id)->get('tb_promotion')->row();
		$arr_count = array(
			'count_pro' => $tb_promotion->count_pro - 1
		);
		$this->db->where('id', $promotion_id)->update('tb_promotion', $arr_count); // จำนวน -1

		$arr_log = array(
			'user_id' => $this->session->userdata['member']->id,
			'promotion_id' => 	$promotion_id,
			'before_creadit' => $user_credit_before,
			'after_creadit' => $user_credit_after,
			'time' => time()
		);
		$this->db->insert('log_promotion', $arr_log); //insert log

		return true;
	}

	public function deposit($user, $amount)
	{
		$user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
		if ($user_q->num_rows() == 1) {
			$user_r = $user_q->row();
			$arr_depAPI = array(
				'AgentName' => $this->getapi_model->agent(),
				'PlayerName' => $user,
				'Amount' => $amount,
				'TimeStamp' => time(),
			);
			$dataAPI = array(
				'type' => 'D',
				'agent' => $this->getapi_model->agent(),
				'member' => $user,
			);
			$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
			$cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
			if ($cre_userAPI->Success == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function get_credit($user)
	{
		$arr_userAPI = array(
			'AgentName' => $this->getapi_model->agent(),
			'PlayerName' => $user,
			'TimeStamp' => time(),
		);
		$dataAPI = array(
			'type' => 'D',
			'agent' => $this->getapi_model->agent(),
			'member' => $user,
		);
		$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
		$cre_userAPI = $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
		if ($cre_userAPI->Error == 0) {
			$amount = $cre_userAPI->Balance;
		} else {
			$amount = $cre_userAPI->Message;
		}
		return $amount;
	}
}

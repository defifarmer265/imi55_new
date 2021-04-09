<?php
class Checkin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('backend/getapi_model');
		$this->load->library('Member_libraray');
		$this->load->model('api/api_model');
		$this->_init();
	}
	private function _init()
	{		
		$this->output->set_template('tem_web/tem_mapraw');
	}
	public function index()
	{
		$close_checkin = $this->db->select('*')->where('id',8)->get('maintenance')->row();
			if($close_checkin->status == 0){
				$datenow  = strtotime(date('Y-m-d 00:00:00'));//วันที่ปัจจุบัน
				$check_day = $this->db->where('user_id',$this->session->member->id)->where('DATE(FROM_UNIXTIME(tb_point.create_time+25200))',date('Y-m-d'))->where('type','checkin')->get('tb_point');
				if($check_day->num_rows() > 0){
					// เช็คอินไปแล้ว
					$data['checkin'] = 0;
				}else{
		
					// ยังไม่เช็ํคตอิน
					$data['checkin'] = 1;
				}
				$data['query']=$this->db->select('status')->where('id','1')->get('tb_checkin')->result_array();
				$this->load->view('check',$data);
			}else{
				$this->load->view('403');
			
			}
	}
	
	public function checkin(){
		if($this->input->post('id') != null){
			$checkdate = date('d');
			$time_s  = strtotime(date('Y-m-d 00:00:00'));
			$time_e  = strtotime(date('Y-m-d 23:59:59'));
			$user_id = $this->input->post('id');
			$check_q = $this->db->select('user_id, count(user_id) as id, create_time,type')
						->where('user_id',$user_id)
						->where('type','checkin')
						->where('create_time >=',$time_s)
						->where('create_time <=',$time_e)
						->get('tb_point')->row();
			if($check_q->id == 0){
				$check_in = $this->db->where('status', 1)->where('id',$checkdate)->get('tb_checkin')->row();
				$point = $check_in->point;
				$spin  = $check_in->spin;
				$data_a = array(
								'user_id'	=> $this->session->member->id,
								'type'		=> 'checkin',
								'point' 	=> $point,
								'reward_id' => $check_in->id,
								'create_time'=> time(),
								'status'=>'1'
							);
				if($this->db->insert('tb_point',$data_a)){
					if($spin != 0){
						$this->db->set('point','point +'.$point, FALSE)->set('spin','spin+'.$spin,FALSE)->where('id',$user_id)->update('tb_user');
						$re = array('code'=>1,'title'=>'ยินดีด้วย','smg'=>'คุณได้พอยท์ '.$point.' พอยท์ และฟรีสปรินทร์ '.$spin.' ครั้ง');
					}else{
					    $this->db->set('point','point +'.$point, FALSE)->where('id',$user_id)->update('tb_user');
						$re = array('code'=>1,'title'=>'ยินดีด้วย','smg'=>'คุณได้พอยท์ '.$point.' พอยท์  ');
					}
				}
			}else{
				$re = array('code'=>0,'title'=>'','smg'=>'ไม่สามารถเช็คอินได้แล้วเนื่องจากคุณได้ทำการแล้ว');
			}
		}else{
			redirect('users/home');
		}
		echo json_encode($re);
		die();
	}

}
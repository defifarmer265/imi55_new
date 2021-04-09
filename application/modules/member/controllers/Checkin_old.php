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
		$datenow  = strtotime(date('Y-m-d 00:00:00'));//วันที่ปัจจุบัน
		$check_day = $this->db->where('user_id',$this->session->member->id)->where('create_time >=',$datenow)->where('type','checkin')->get('tb_point');
		if($check_day->num_rows() > 0){
			// เช็คอินไปแล้ว
			$data['checkin'] = 0;
		}else{

			// ยังไม่เช็ํคตอิน
		    $data['checkin'] = 1;
		}
		$data['query']=$this->db->select('status')->get('tb_checkin')->result_array();
		 
		$this->load->view('check',$data);
	}

	
	public function checkin()
	{

		$checkdate = date('d');
		$user_r = $this->input->post('id');

		$check_q = $this->db->where('user_id',$user_r)->where('DATE(FROM_UNIXTIME(tb_point.create_time))',date('Y-m-d'))->get('tb_point');
			//ถ้าเช็คอินตรงกับวันที่ 7 14 21 28 จะได้รับ พ้อย *2 
			if(($checkdate == 7 || $checkdate ==14 || $checkdate ==21 || $checkdate == 28 )){
                if ($check_q->num_rows() == 0) {
                    $checkin_r = $this->db->where('status', 1)->get('tb_checkin')->row();
					$point = $checkin_r->point*2;
					$nspint = $checkin_r->Number_of_spins;

                    $arr_point = array(
                        'user_id'	=> $this->session->member->id,
                        'type'		=> 'checkin',
                        'point' 	=> $point,
                        'reward_id' => $checkin_r->id,
                        'create_time'=> strtotime(date('Y-m-d H:i:s')),
                        'status'=>'1'
					);
					$this->db->insert('tb_point',$arr_point);
					// $this->db->set('point','point +'.$point, FALSE)->set('spin','spin +'.$nspint,FALSE)->where('id',$user_r)->update('tb_user');
					$this->db->set('point','point +'.$point, FALSE)->where('id',$user_r)->update('tb_user');
					//$re = array('code'=>1,'title'=>'ยินดีด้วย','smg'=>'คุณได้พอยท์ '.$point.' พอยท์ และ ฟรีจำนวนสปิน '.$nspint.' ครั้ง' );
					$re = array('code'=>1,'title'=>'ยินดีด้วย','smg'=>'คุณได้พอยท์ '.$point.' พอยท์  ');
                }else{
					$re = array('code'=>0 );
				}
			// หรือถ้าไม่ตรงก็ได้พ้อยแค่10
			}else{
				if ($check_q->num_rows() == 0) {
                    $checkin_r = $this->db->where('status', 1)->get('tb_checkin')->row();
					$point = $checkin_r->point;
					$nspint = $checkin_r->Number_of_spins;
                    $arr_point = array(
                        'user_id'	=> $this->session->member->id,
                        'type'		=> 'checkin',
                        'point' 	=> $point,
                        'reward_id' => $checkin_r->id,
						'create_time'=> strtotime(date('Y-m-d H:i:s')),
						'status'=>'1'
					);
					$this->db->insert('tb_point',$arr_point);
					// $this->db->set('point','point +'.$point, FALSE)->where('id',$user_r)->update('tb_user');
					$this->db->set('point','point +'.$point, FALSE)->where('id',$user_r)->update('tb_user');
					$re = array('code'=>1,'title'=>'ยินดีด้วย','smg'=>'คุณได้พอยท์ '.$point.' พอยท์  ');
                }else{
					$re = array('code'=>0 );
				}
			}
			echo json_encode($re);
			die();
		
	}

}


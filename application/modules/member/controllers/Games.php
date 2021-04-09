<?php
class Games extends MY_Controller
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
		$this->member_libraray->login();

	}
	public function index()
	{

	}
	public function point()
	{
		$user_r = $this->session->member;
		$data['point'] = $this->db->select('tb_point.*')
							->where('tb_point.user_id',$user_r->id)
							->order_by('tb_point.create_time','DESC')
							->limit(10)
							->get('tb_point')
							->result_array();
		$data['user'] = $this->db->where('id',$this->session->member->id)->get('tb_user')->row();
		$this->load->view('games_point',$data);
	}
	public function spin()
	{
		
		// echo '<pre>';
		// $count_reward = $this->db->select('id , max')->where('get_reward != max')->get('tb_spin_reward')->row();
		// $rand = rand(1,$count_reward->id);
		// echo '<br>';
		// print_r($rand);
		// $this->db->set('get_reward','get_reward + 1', FALSE)->where('id',$count_reward->id)->update('tb_spin_reward');
		// echo '<br>';
		// print_r($count_reward);
		// die();

		// $random = rand(100,700);
		// $hans = $random / 100;
		// echo $random;
		// echo '<br>';
		// echo $hans;
		// echo '<br>';
		// // $result = 0;
		// switch($random) {
		// 	case 2:
		// 	case 3:
		// 	case 4:
		// 		$result = $random;
		// 		break;
		// 	default:
		// 		$result = 1;
		// }

		// echo $result;
		// die();


		$user_r = $this->session->member;
		$user 	= $this->db->where('id',$user_r->id)->get('tb_user')->row();
		$check_onoff = $this->db->select('code')->where('name', 'switch_exchange')->get('setting')->result_array();
		$spin_q = $this->db->select('*')->where('status',1)->get('tb_spin');
		$i 		= 0 ;
		$spin 	= [];
		$max 	= -1;
		foreach($spin_q->result_array() as $_a=> $sp){
			$spin[$i]['id']		= $sp['id'];
			$spin[$i]['percent']= $sp['percent'];
			$spin[$i]['min']	= $max+1;
			$min				= $max+1;
			$spin[$i]['max']	= ($sp['percent']*100)+ $min;
			$max				= ($sp['percent']*100)+ $min;
			$spin[$i]['point'] 	= $sp['point'];
			$spin[$i]['img_spin']	= $this->config->item('tem_frontend_img').'wheel/'.$sp['spin'];
			$spin[$i]['img_alert']	= $this->config->item('tem_frontend_img').'wheel/'.$sp['alert'];
			$spin[$i]['text']	= $sp['name'];
			$spin[$i]['location_min'] = $sp['location_min'];
			$spin[$i]['location_max'] = $sp['location_max'];
			$i++;
		}
		// echo '<pre>';
		// print_r($spin);
		// die();
		$data = array('menu' => 'games' ,'user' => $user ,'spin'=>$spin,'check_onoff'=>$check_onoff);
		$this->load->view('games',$data);
	}
	public function userSpin()
	{	

		$id =  $this->session->member->id;
		$user_r = $this->db->where('id',$id)->get('tb_user')->row();
		$spin = $user_r->spin;
			  if($user_r->spin >= 1)
			  {
			  	  $spin = $spin-1;
			  	  $leng = $this->db->select('id')->where('status',1)->get('tb_spin_reward')->result_array();
			  	 
			  	  if(empty($leng)){
			  	  	$this->db->set('status',1)->where('status',0)->update('tb_spin_reward');
			  	  	$leng = $this->db->select('id')->where('status',1)->get('tb_spin_reward')->result_array();
			  	  }

			  	  $rand = array_rand($leng,1);
			  	  $id_prize = $leng[$rand];
			  	
			  	  $spin_num = $this->db->where('id',$id_prize['id'])->get('tb_spin_reward')->row();
			  	  
//				  $this->db->set('spin','spin -1', FALSE)->where('id',$id)->update('tb_user');
				  $re = array('code'=>1,'spin'=>$spin , 'spin_number'=>$spin_num->id_spin, 'row_spin'=>$spin_num->id);
			  }  
			  else
			  {
				  $re = array('code'=>0);
			  }
		echo json_encode($re);
		die();
	}

	public function add_prize(){ 
		
		if($this->input->post('reward_id')){
		
			$user_id	= $this->session->member->id;
			$point 		= $this->input->post('prize');
			$id_row 	= $this->input->post('row_spin');
			$reward_id 	= $this->input->post('reward_id');
			if($this->input->post('prize')==0){
			$point = 0;
				
		}


			$settatus = $this->db->set('status',0)->where('id',$id_row)->update('tb_spin_reward');
			if($reward_id==7){
				// $this->db->set('spin','spin + 1', FALSE)->where('id',$user_id)->update('tb_user');
				$re = array('code' => 7,'msg'=>'ได้รับสปิน 1 สปิน');

			}
			else{
				$arr_point = array(
				'user_id'	=> $this->session->member->id,
				'type'		=> 'spin',
				'point' 	=> $point,
				'reward_id' => $reward_id,
				'create_time'=> time(),
				'status'=>'1'
			);
	   		$this->db->insert('tb_point',$arr_point);
			$this->db->set('spin','spin - 1', FALSE)->where('id',$user_id)->update('tb_user');
			if($point==0){

			}else{
				$this->db->set('point','point +'.$point, FALSE)->where('id',$user_id)->update('tb_user');
			}
		    $user_r = $this->db->where('id',$user_id)->get('tb_user')->row();
		    $pointtotal=$user_r->point;
		   $re = array('code' => 1,'msg'=>$pointtotal,'msg2'=>$point);
			}
		   
			
			
		}else{
			$re = array('code' =>0);
		}
		echo json_encode($re);
	    die();
	}
	

}


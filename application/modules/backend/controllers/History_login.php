<?php



class History_login extends MY_Controller
{
	 public function __construct()
    {
        parent::__construct();
		$this->load->model('getapi_model');
        $this->load->library('backend/backend_library');
		 $this->load->model('backend_model');
		$this->_init();
        
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }
	public function index()
	{ 

		$this->load->view('history_login');
	}


	public function Tperiod(){

		$con = $this->input->post('data');
	
		// 7วัน ที่แล้ว
		if($this->input->post('data') == "7 วัน"){

			$one = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (7*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (14*24*60*60))))

						->order_by('log_user_login.create_time','DESC')                                               
						->get('tb_user')
						->result_array();

		
			$re = array('code'=> 1,'data'=>$one, 'con'=> $con);	


		// 15วัน ที่แล้ว
		}else if($this->input->post('data') == "15 วัน") {

			$fif = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (15*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (29*24*60*60))))
						->order_by('log_user_login.create_time','DESC')
						->get('tb_user')
						->result_array();


			$re = array('code'=> 1,'data'=>$fif, 'con'=> $con);

		// 30 วัน ที่แล้ว
		}else if($this->input->post('data') == "30 วัน") {

			$onemonth = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (30*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (59*24*60*60))))
						->order_by('log_user_login.create_time','DESC')
						->get('tb_user')
						->result_array();


			
			$re = array('code'=> 1,'data'=>$onemonth, 'con'=> $con);

		}else if($this->input->post('data') == "นานกว่า 60 วัน") {
		
		// นานกว่า 60 วัน
			$tmonth = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (60*24*60*60))))
						->order_by('log_user_login.create_time','DESC')
						->get('tb_user')
						->result_array();


			$re = array('code'=> 1,'data'=>$tmonth, 'con'=> $con);

		}else{

			// สมาชิกทั้งหมด
			$all = $this->db->select('tb_user.user,tb_user.username,from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						
						->order_by('tb_user.user','ASC')
						->get('tb_user')
						->result_array();


			$re = array('code'=> 1,'data'=>$all, 'con'=> $con);


		}

		echo json_encode($re);
		die();
	}

}
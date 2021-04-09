<?php



class History_login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->library('users/users_library');
		$this->load->model('backend/backend_model');
		$this->load->model('backend/getapi_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();

	}
	private function _init()
	{		
		$this->output->set_template('tem_owner/tem_owner');
	}

	public function index()
	{ 

		$this->load->view('history_login');
	}




	public function Tperiod(){

		$con = $this->input->post('data');
				
			if (empty($this->input->post('Per_Page'))) {
				$chf = true;
				$Page = 1;
				$Per_Page = 10;
				$Search = '';
				
			} else {
				$chf = false;
				$Page = $this->input->post('Page');
				$Per_Page = $this->input->post('Per_Page');
				$Search = $this->input->post('Search');
				
			}
			
			if ($Page == 1) {
				$skip = 0;
			} else {
				$skip = $Per_Page * ($Page - 1);
			}
		// 7วัน ที่แล้ว
		if($this->input->post('data') == "7 วัน"){

			
			$Num_Rows = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (7*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (14*24*60*60))))                                           
						->get('tb_user')
						->num_rows();
			
			

			$one = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (7*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (14*24*60*60))))
						->limit($Per_Page,$skip) 
						->order_by('log_user_login.create_time','DESC')                                  
						->get('tb_user')
						->result_array();
			
			$i=0;
			foreach($one as $on){
				$amount = $this->get_credit($on['user']);
				$one[$i]['credit'] = $amount;

				$i++;
			}
			// print_r($one);
			// die();

			if ($Num_Rows <= $Per_Page) {
				$Num_Pages = 1;
			} else if (($Num_Rows % $Per_Page) == 0) {
				$Num_Pages = ($Num_Rows / $Per_Page);
			} else {
				$Num_Pages = ($Num_Rows / $Per_Page) + 1;
				$Num_Pages = (int)$Num_Pages;
			}

			$re = array(
				'code'=> 1,
				'data' => $one,
				'Num_Rows' => $Num_Rows,
				'Num_Pages' => $Num_Pages,
				'Page' => $Page,
				'Per_Page' => $Per_Page,
				'con'=> $con
			);
		

		
			// $re = array('code'=> 1,'data'=>$one, 'con'=> $con);	


		// 15วัน ที่แล้ว
		}else if($this->input->post('data') == "15 วัน") {

			$Num_Rows = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (15*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (29*24*60*60))))
						->get('tb_user')
						->num_rows();

			$fif = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (15*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (29*24*60*60))))
						->limit($Per_Page,$skip) 
						->order_by('log_user_login.create_time','DESC')
						->get('tb_user')
						->result_array();

			$i=0;
			foreach($fif as $fi){
				$amount = $this->get_credit($fi['user']);
				$fif[$i]['credit'] = $amount;

				$i++;
			}

			// $re = array('code'=> 1,'data'=>$fif, 'con'=> $con);
			if ($Num_Rows <= $Per_Page) {
				$Num_Pages = 1;
			} else if (($Num_Rows % $Per_Page) == 0) {
				$Num_Pages = ($Num_Rows / $Per_Page);
			} else {
				$Num_Pages = ($Num_Rows / $Per_Page) + 1;
				$Num_Pages = (int)$Num_Pages;
			}

			$re = array(
				'code'=> 1,
				'data' => $fif,
				'Num_Rows' => $Num_Rows,
				'Num_Pages' => $Num_Pages,
				'Page' => $Page,
				'Per_Page' => $Per_Page,
				'con'=> $con
			);

		// 30 วัน ที่แล้ว
		}else if($this->input->post('data') == "30 วัน") {

			$Num_Rows = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (30*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (59*24*60*60))))
						->get('tb_user')
						->num_rows();

			$onemonth = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (30*24*60*60))))
						->where('log_user_login.create_time > ', strtotime(date('Y-m-d',time() - (59*24*60*60))))
						->limit($Per_Page,$skip) 
						->order_by('log_user_login.create_time','DESC')
						->get('tb_user')
						->result_array();

			$i=0;
			foreach($onemonth as $om){
				$amount = $this->get_credit($om['user']);
				$onemonth[$i]['credit'] = $amount;
				
				$i++;
			}
			
			// $re = array('code'=> 1,'data'=>$onemonth, 'con'=> $con);
			if ($Num_Rows <= $Per_Page) {
				$Num_Pages = 1;
			} else if (($Num_Rows % $Per_Page) == 0) {
				$Num_Pages = ($Num_Rows / $Per_Page);
			} else {
				$Num_Pages = ($Num_Rows / $Per_Page) + 1;
				$Num_Pages = (int)$Num_Pages;
			}

			$re = array(
				'code'=> 1,
				'data' => $onemonth,
				'Num_Rows' => $Num_Rows,
				'Num_Pages' => $Num_Pages,
				'Page' => $Page,
				'Per_Page' => $Per_Page,
				'con'=> $con
			);

		}else if($this->input->post('data') == "นานกว่า 60 วัน") {
		
			$Num_Rows = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (60*24*60*60))))
						->get('tb_user')
						->num_rows();
		// นานกว่า 60 วัน
			$tmonth = $this->db->select('tb_user.user,tb_user.username,from_unixtime(log_user_login.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->where('log_user_login.create_time <= ', strtotime(date('Y-m-d',time() - (60*24*60*60))))
						->limit($Per_Page,$skip)
						->order_by('log_user_login.create_time','DESC')
						->get('tb_user')
						->result_array();
			$i=0;
			foreach($tmonth as $tm){
				$amount = $this->get_credit($tm['user']);
				$tmonth[$i]['credit'] = $amount;
				
				$i++;
			}

			// $re = array('code'=> 1,'data'=>$tmonth, 'con'=> $con);
			if ($Num_Rows <= $Per_Page) {
				$Num_Pages = 1;
			} else if (($Num_Rows % $Per_Page) == 0) {
				$Num_Pages = ($Num_Rows / $Per_Page);
			} else {
				$Num_Pages = ($Num_Rows / $Per_Page) + 1;
				$Num_Pages = (int)$Num_Pages;
			}

			$re = array(
				'code'=> 1,
				'data' => $tmonth,
				'Num_Rows' => $Num_Rows,
				'Num_Pages' => $Num_Pages,
				'Page' => $Page,
				'Per_Page' => $Per_Page,
				'con'=> $con
			);

		}else{

			// สมาชิกทั้งหมด
			$Num_Rows = $this->db->select('tb_user.user,tb_user.username,from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->get('tb_user')
						->num_rows();

			$all = $this->db->select('tb_user.user,tb_user.username,from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as login_time, from_unixtime(tb_user.create_time , "%d-%m-%Y" ) as create_time')
						->join('log_user_login','log_user_login.user_id = tb_user.id','left')
						->where('log_user_login.id IN( SELECT MAX(id) FROM log_user_login GROUP BY user_id)')
						->limit($Per_Page,$skip)
						->order_by('tb_user.user','ASC')
						->get('tb_user')
						->result_array();

			$i=0;
			foreach($all as $al){
				$amount = $this->get_credit($al['user']);
				$all[$i]['credit'] = $amount;
				
				$i++;
			}

			// $re = array('code'=> 1,'data'=>$all, 'con'=> $con);
			if ($Num_Rows <= $Per_Page) {
				$Num_Pages = 1;
			} else if (($Num_Rows % $Per_Page) == 0) {
				$Num_Pages = ($Num_Rows / $Per_Page);
			} else {
				$Num_Pages = ($Num_Rows / $Per_Page) + 1;
				$Num_Pages = (int)$Num_Pages;
			}

			$re = array(
				'code'=> 1,
				'data' => $all,
				'Num_Rows' => $Num_Rows,
				'Num_Pages' => $Num_Pages,
				'Page' => $Page,
				'Per_Page' => $Per_Page,
				'con'=> $con
			);


		}

		if ($chf) {
			echo json_encode($re);
			die;
		} else {
			echo json_encode($re);
			die;
		}
	}

	function get_credit($user)
	{
		$arr_userAPI = array(
			'AgentName'	=> $this->getapi_model->agent(),
			'PlayerName' => $user,
			'TimeStamp'	=> time(),
		);
		$dataAPI = array(
			'type'		=> 'D',
			'agent' 	=> $this->getapi_model->agent(),
			'member' 	=> $user,
		);
		$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
		$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
		if ($cre_userAPI->Error == 0) {
			$amount = $cre_userAPI->Balance;
		} else {
			$amount = $cre_userAPI->Message;
		}
		return $amount;
	}

}
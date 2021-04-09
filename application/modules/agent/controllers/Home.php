<?php
class Home extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		// $this->load->model('bank_model');
		// $this->load->model('user_model');
		// $this->load->helper('captcha');
		// $this->load->library('image_lib');
		// $this->load->model('deposit_model');
		// $this->load->library('backend/tripledes');
		// $this->load->model('backend/getapi_model');
		// $this->load->library('session');
		// $this->load->model('user_detail_all');
		// $this->load->model('promotion_model');
	}
	private function _init()
	{		
		//$this->output->set_template('tem_web/tem_web');
	}

	public function index()
	{
		$this->load->view('home');
	}
	

	public function first_time()
	{	
		
		$this->load->view('first_time');
		
	}
	public function frontend_withdraw()
	{	
		$data = array(
			'menu' => 0
		);
		$this->load->view('frontend_withdraw',$data);
		
	}
	public function profile()
	{	
		$this->load->view('profile');
		
	}public function turnover()
	{	
		$this->load->view('turnover');
		
	}

	public function home()
	{
		if (!$this->session->userdata('username')) {
			return redirect('');
		}

		$user = $this->user_model->get_userByUsername($this->session->userdata['username']);


		$wlData = array( 
			'username'  	=> $this->session->userdata['username'],
			'begin_date'    => date('Y-m-d',strtotime("first day of this month")), 
			'end_date'   	=> date('Y-m-d'),
			'agent'         => $this->getapi_model->agent(),
			'date'          => date('Y-m-d H:i:s')
		);
		//deposit data
		$depoData = array( 
			'username'      => $this->session->userdata['username'], 
			'status'        => 'A', 
			'page'          => '1',
			'limit'         => '50',
			'agent'         => $this->getapi_model->agent(),
			'date'          => date('Y-m-d H:i:s')
		);
		//withdraw data
		$wdData = array( 
			'username'      => $this->session->userdata['username'], 
			'status'        => 'A', 
			'page'          => '1',
			'limit'         => '50',
			'agent'         => $this->getapi_model->agent(),
			'date'          => date('Y-m-d H:i:s')
		);
		//credit user data
		$credit_user = array( 
			'username'      => $this->session->userdata['username'], 
			'agent'         => $this->getapi_model->agent(),
			'date'          => date('Y-m-d H:i:s')
		);
		// database
		
		if($user->status_promotion !=0){
			$lastDeposit = $this->db->select('*')
                         ->where('user_id',$user->id)
                         ->where('status',2)
                         ->order_by('time','DESC')
                         ->limit(1)
                         ->get('tb_deposit')
                         ->row();
			$promotionNow = $this->db->select('*')
						->where('id',$user->status_promotion)
						->get('tb_promotion')
						->row();
			$arrWL = array( 
				'username'  	=> $user->username, 
				'begin_date'    => date('Y-m-d',$lastDeposit->createTime - (1 * 24 * 60 * 60)), 
				'end_date'   	=> date('Y-m-d'),
				'agent'         => $this->getapi_model->agent(),
				'date'          => date('Y-m-d H:i:s')
			);
			$winlose =  $this->getapi_model->getapi($arrWL,'winloss');
			$score = 0 ;
			$casino = 0 ;
			if($winlose->sflag == 1){
				foreach($winlose->data as $_w=>$wl){
					if($wl->wl_type == 'sc' || $wl->wl_type == 'st'){
						$score = $score + $wl->wl_turnover;
					}elseif($wl->wl_type == 'cn' || $wl->wl_type == 'gm' ){
						$casino = $casino + $wl->wl_turnover;
					}
				}
			}
			
			$totalAmount = ($lastDeposit->amount * ($promotionNow->bonus/100))+$lastDeposit->amount;
			$promotionNow->amount 		= $lastDeposit->amount;
			$promotionNow->totalAmount	= $totalAmount;
			$promotionNow->proTurnSC 	= $user->TurnOverSC;
			$promotionNow->proTurnCN 	= $user->TurnOverCN;
			$promotionNow->turnOverSC 	= $score - $user->lastTurnOverSC;
			$promotionNow->turnOverCN 	= $casino - $user->lastTurnOverCN;
		}else{
			$promotionNow = '';
		}

		if($deposit = $this->deposit_model->get_depositByUserid($user->id)){//รายการฝาก

		}else{
			$deposit = '';
			//Deposit_model Error
		}
		if($promotion = $this->promotion_model->get_promoByClass($user->class)){

		}else{
			$promotion = '';
			//Promotion_model Error 
		}

		$timeStart = strtotime(date('Y-m-d 00:00:00'));
				$depositPerDay = $this->db->select('tb_deposit.*,tb_promotion.bonus')
					->where('tb_deposit.user_id',$user->id)
					->where('tb_deposit.status',2)
					->where('tb_deposit.createTime >',$timeStart)
					->where('tb_deposit.promotion_id >',0)
					->join('tb_promotion','tb_promotion.id = tb_deposit.promotion_id','left')
					->join('tb_user','tb_user.id = tb_deposit.user_id','left')
					->where('tb_promotion.date_turnover',1)
					->order_by("tb_deposit.id", "DESC")
					->limit(10)
					->get('tb_deposit')
					->result_array();
				$proPerDay = 0;
				
				foreach($depositPerDay as $_a=>$perDay){
					$amount = 0;
					if($perDay['promotion_id'] != 0){
						$amount = $perDay['amount'] * ($perDay['bonus'] / 100);
						$proPerDay = $proPerDay + $amount;
					}
				}

				//  ถอน
		if($deposit_last = $this->db->select('*')
			->where('user_id',$user->id)
			->where('status',2)
			->order_by('createTime','DESC')
			->limit(1)
			->get('tb_deposit')
			->row()){
			$begin_date = $deposit_last->createTime;
		}else{
			$deposit_last = '';
			$begin_date = $user->deposit_CreateTime;
		}



		
//		
//		echo '<pre>';
//		print_r($promotionNow);
//		print_r($lastDeposit);
//		print_r($user);
//		die();
		$data = array(
			'promotionNow'	=> $promotionNow,
			'promotion'		=> $promotion,
			'depositPerDay'	=> $proPerDay,
			'deposit_last'		=> $deposit_last,
			'win_los'		=> $this->getapi_model->getapi($wlData,'winloss'),
			'data_deposit'	=> $this->getapi_model->getapi($depoData,'deposit'),
			'withdrawal'	=> $this->getapi_model->getapi($wdData,'withdrawal'),
			'credit_user'	=> $this->getapi_model->getapi($credit_user,'credit_user'),
			'user'  => $user
		);
		

		$this->load->view('home',$data);
		
	}
	
	public function logout()
	{
		//echo "<pre>";
		//print_r($this->session->userdata());
		//$this->session->unset_userdata('username');
		// echo base_url();
		// die();
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('agent');
		echo "<script>window.location.href = '".base_url()."'; </script>";
		//redirect(base_url(),'refresh');
		//redirect(base_url(), 'refresh');
		//header("Location:".base_url());
		//die();
		//$this->session->sess_destroy();
		//redirect(base_url().'web',refresh);
	}
	public function register()
	{
		
		$data = array(
			'menu' => 0,
			
		);
		
		$this->load->view('register',$data);
		
	}
	public function check_login()
	{	
		if ($this->input->post('cap_login') == $this->session->userdata['captcha']['word'] ){
		
		$check_user_database = $this->user_model->get_userByUsername($this->input->post('username'));
		
		//check user indatabase

		if (empty($check_user_database)) {
			$data = array('code' => 1, 'msg'=>'success in database',);
			echo json_encode($data);
			die();
		}else{
		
			$arrData = array( 
				'username'    => trim($this->input->post('username')), 
				'password'    => trim($this->input->post('password')),
				'agent'       => $this->getapi_model->agent(),
				'date'        => date('Y-m-d H:i:s')
			);
		$data =  $this->getapi_model->getapi($arrData,'check_user'); //check_login user in api
		
		if ($data->msg == 'success') {
			
			$data1 = $this->user_model->get_userByUsername($this->input->post('username'));
			if ($data1->lastLogin =='' && $data1->last_ip =='') {
				$this->session->set_userdata('user_first',$this->input->post('username'));
				$data = array('code' => 3, 'msg'=>'success login first');
				echo json_encode($data);
				die();
			}
			$newdata = array(
				'username'  => $this->input->post('username'),
				'password'     => $this->input->post('password'),
				'agent' => $this->getapi_model->agent() 
			);
			$this->session->set_userdata($newdata);
			$this->db->where('id',$data1->id)->update('tb_user',array('last_ip'=>$this->input->ip_address(),'lastLogin'=>time()));
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
		die();
	}

		}else{
			$data = array('code' => 9, 'msg'=>'success login first');
				echo json_encode($data);
				die();
		}





}
public function products()
{

	$data = array(
		'menu' => 0,
	
	);

	$this->load->view('products',$data);

}

public function contact()
{
	$data = array(
		'menu' => 0,
	
	);

	$this->load->view('contact',$data);

}public function promotion()
{
	
	$data = array(
		'menu' => 0,
		
	);
	
	$this->load->view('promotion',$data);

}





public function comfirm(){

	$olduser = $this->user_model->get_userbyId($this->input->post('id_user'));	
	if(count($olduser) != 0){

			if($olduser[0]['check_comfirm'] == '0'){  // กรณีไม่มียูส รอยืนยัน

				$data = array(
					'date' => $this->input->post('date'), 
					'time' => $this->input->post('time'), 
					'amount' => $this->input->post('amount'), 
					'link_slip' => $_FILES['slip']['name'],
					'status' => '0', 
					'id_user' => $this->input->post('id_user')

				);
				$newuser = $this->deposit_model->insert_deposit($data);
				echo json_encode($newuser);
				die;

			}else if($olduser[0]['check_comfirm'] == '1'){  // กรณีมียูสแล้ว  

			}else{	}
			

		}
		
		
	}

	public function getstatusdeposit(){
		$de = $this->deposit_model->get_status_deposit($this->input->post('id'));
		if( $de[0]['status'] == 1){	

			echo json_encode( 1);
			die();
		}
		echo json_encode(0);
		die();
		
	}

	public function Vdo_Register(){

		$this->load->view('Vdo_Register');
		
	}
	public function Vdo_Firstdeposit(){

		$this->load->view('Vdo_Firstdeposit');
		
	}
	public function Vdo_Deposit(){

		$this->load->view('Vdo_Deposit');
		
	}
	public function Vdo_Withdraw(){

		$this->load->view('Vdo_Withdraw');
		
	}
	
	public function Vdo_Profile(){

		$this->load->view('Vdo_Profile');
		
	}

	public function captcha(){
		$vals = array(
			'img_path'      =>'./captcha/',
			'img_url'       => base_url().'captcha/',
			'img_width'     => '100',
			'img_height'    => 30,
			'expiration'    => 7200,
			'word_length'   => 4,
			'font_size'     => 16,
			'pool'          => '0123456789',
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 143, 80)
			)
		);
		if ($cap = create_captcha($vals)) {
			$ses_cap = array('captcha'=>$cap);
			$this->session->set_userdata($ses_cap);//set session captcha
			$data_cap = array('code' =>1 ,'data'=>$cap);
			echo json_encode($data_cap);	
		}else{
			$data_cap = array('code' =>0 ,'msg'=>'not get captcha');	
			echo json_encode($data_cap);
		}
		die();
	}

	

}


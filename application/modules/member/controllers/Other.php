<?php
class Other extends MY_Controller
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
		
		$this->load->view('other');
	}
	public function edit_pass()
	{	
//		print_r($this->input->post());die();
		if($this->input->post('old_pass') && $this->input->post('new_pass')){
			$old_pass = $this->input->post('old_pass');
			$new_pass = $this->input->post('new_pass');
			$user_q = $this->db->where('id',$this->session->member->id)->where('password',$old_pass)->get('tb_user');
			if($user_q->num_rows() == 1){
				$user_r = $user_q->row();
				$arr_userAPI = array( 
					'Playername'	=> $user_r->user,    
					'Partner'		=> $this->getapi_model->agent(),
					'Newpassword'	=> $new_pass,
					'TimeStamp'		=> time(),
				);
				$dataAPI = array(
					'type'		=> 'L',
					'agent' 	=> $this->getapi_model->agent(),
					'member' 	=> $user_r->user,
					'password' 	=> $new_pass,
				);
				$url_api = 'https://cauthapi.linkv2.com/api/credit-auth/changepassword';
				$cre_userAPI =  $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);

				if($cre_userAPI->Status == 1){
					if($this->db->set('password',$new_pass)->where('id',$user_r->id)->update('tb_user')){
						$re = array('code'=>1,'msg'=>'Success');
					}else{
						$re = array('msg' =>'0','code'=> 0 );
					}
				}else{
					$re = array('msg' =>'1','code'=> 0 );
				}
			}else{
				$re = array('msg' =>'2','code'=> 0 );
			}
		}else{
			$re = array('msg' =>'3','code'=> 0 );
		}
		echo json_encode($re);
		die();
	}


}


<?php
/**
 *
 */
class Users extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('users_library');
    $this->load->model('users_model');

  }


  public function index()
  {
    redirect(base_url().'users/member');
    // $this->load->view('login');
    // $close_sysmember = $this->db->select('*')->where('id',3)->get('maintenance')->row();
		// if($close_sysmember->status == 1){
		// 	if(!empty($this->session->member->user)){redirect(base_url().'users/member');}
		// 	$data['bank'] = $this->db->get('tb_bank')->result_array();
		// 	$data['maintenance'] = $this->db->select('status,name')->where('id',6)->get('maintenance')->row();
		// 	$this->load->view('home',$data);
		// }else{
		// 	$this->session->member = '';
		// 	$this->load->view('405');
		// }
    
  }

  public function test(){
    $agent = $this->session->users['username'];
    echo $agent;
    die;
  }
  public function line_encryp()
  {
    Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
    Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
    Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    $data = json_encode(array(
      'user_id' => $this->input->post('user_id'),
      'webname' => $this->input->post('webname')
    ));
    echo json_encode($data = array('data' =>$this->users_library->encrypt_data('encrypt', $data)));
    die;
  }
  public function login()
  {
	  
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('password','Password','required');
    if ($this->form_validation->run() === TRUE) {

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember = (bool)$this->input->post('remember');

        $users = $this->users_library->login(
              $username,
              $password,
              $remember
            );

            if($users['status']=='Success!'){
              header('Location:'.base_url('backend'));
            }else if($users['status']=='warning'){
              $this->session->set_flashdata('status', $users['status']);
              $this->session->set_flashdata('message', $users['message']);
              header('Location:'.base_url('users/login'));

            }else{
              $this->session->set_flashdata('status', $users['status']);
              $this->session->set_flashdata('message', $users['message']);
              header('Location:'.base_url('users/login'));

            }

      } else{
             $this->load->view('login');
      }


  }
  public function check_login()
  {


    $result = $this->users_model->can_login($this->input->post('username'), $this->input->post('password'));
    if($result == '')
    {
      $this->users_model->update_last_login($_SESSION['id'], $_SESSION['type']);
      redirect('backend');
    }
    else
    {
      $this->session->set_flashdata('message',$result);
      redirect('users/login');
    }
  


  }




}

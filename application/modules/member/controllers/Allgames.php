<?php
class Allgames extends MY_Controller
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
        $this->load->view('allgames');
    }
    // =======  menuu game ===========
    public function sport()
	{
        $this->load->view('games/sport');
    }
    public function casino()
	{
        $this->load->view('games/casino');
    }
  
    public function cockfight()
	{
        $this->load->view('games/cockfight');
    }
    public function lottery()
	{
        $this->load->view('games/lottery');
    }  
    public function slot()
	{
        switch ($this->input->get('id')) {
            
            case 'cq9'://CQ9  ไม่มี
                $this->load->view('games/submenu_slot/cq9');
                break;

            case 'iconic'://IG  มี
                $this->load->view('games/submenu_slot/iconic');
                break;

            case 'dream_tech':// DT มี
                $this->load->view('games/submenu_slot/dream_tech');                   
                break;

            case 'pt_gaming'://DPT มี
                $this->load->view('games/submenu_slot/pt_gaming');
                break; 

            case 'pragmatic'://MX ไม่มี
                $this->load->view('games/submenu_slot/pragmatic');
                break; 

            case 'betsoft'://BS มี
                $this->load->view('games/submenu_slot/betsoft');
                break;     

            case 'big_gaming'://BGE ไม่มี
                $this->load->view('games/submenu_slot/big_gaming');
                break;    

            case 'virtual_tech'://VT ไม่มี
                $this->load->view('games/submenu_slot/virtual_tech');
                break;
                        
            case 'skywind'://PT ไม่มี
                $this->load->view('games/submenu_slot/skywind');
                break;
                
            case 'ace_game'://ACE333 ไม่มี
                $this->load->view('games/submenu_slot/ace_game');
                break;
                
            case 'joker'://JOKER มี
                $this->load->view('games/submenu_slot/joker');
                break;
                
            case 'sa_egames'://SEA ไม่มี
                $this->load->view('games/submenu_slot/sa_egames');
                break;


            default:
            $this->load->view('games/slot');
                break;
        }
        
    }




    
	// ================== bulldog call gameplay ===============

	public function open_game()
	{
			$Vendor = $this->input->post('Vendor');
			$GameCode =  $this->input->post('GameCode');
			// $Vendor = 'AB';
			// $GameCode =  '';
			$data = array("Vendor" => $Vendor, "Lang" => "en-us", "Browser" => "chrome");
			if ($GameCode !== '') {
				$data['GameCode'] = $this->input->post('GameCode');
			}
			$data = json_encode($data);
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://opengameapi.linkv2.com/api/play/login/",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_HTTPHEADER => array(
					"Referer: " . base_url(),
					"Authorization: Bearer " . $this->session->member->token,
					"Content-Type: application/json"
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			echo ($response);
			die;
	}
	//=========== END bulldog call gameplay ===============

    
}


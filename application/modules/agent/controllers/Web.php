<?php
class Web extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();		
		$this->load->model('api/api_model');
		
	}
	private function _init()
	{	
		
		$this->output->set_template('tem_agent/tem_web');
	}

	public function index()
	{
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('frontend',$data);
	}

	public function contact()
	{
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('contact',$data);
	}
	
	public function frontend_withdraw()
	{	
		
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('frontend_withdraw',$data);		
	}


	public function win()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('win',$data);	
	}

	public function winsports()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('winsports',$data);	
	}

	public function wincasino()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('wincasino',$data);	
	}

	public function wingame()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('wingame',$data);	
	}

	public function wincockfight()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('wincockfight',$data);	
	}

	public function winlotto()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('winlotto',$data);	
	}

	public function imiplus()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('imiplus',$data);	
	}

	public function text_agent()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('text_agent',$data);	
	}

	public function hackcasino()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('hackcasino',$data);	
	}

	public function hackgame()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('hackgame',$data);	
	}

	public function sexybaccarat()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('sexybaccarat',$data);	
	}


	public function hackcasino2u()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('hackcasino2u',$data);	
	}	

	public function auto()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('auto',$data);	
	}	

	public function api()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('api',$data);	
	}

	public function apisport()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('apisport',$data);	
	}

	public function apicasino()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('apicasino',$data);	
	}

	public function apigame()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('apigame',$data);	
	}

	public function apipackage()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('apipackage',$data);	
	}



	public function casino()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('casino',$data);	
	}

	public function fb()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('fb',$data);	
	}

	public function youtube()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('youtube',$data);	
	}

	public function imiwin()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('imiwin',$data);	
	}
	public function google()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('google',$data);	
	}

	public function imi()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('imi',$data);	
	}

	public function register()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('register',$data);	
	}

	public function user_manual()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('user_manual',$data);	
	}

	public function manual_marketing()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('manual_marketing',$data);	
	}

	public function hack()
	{
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('hack',$data);	
	}

	public function formula()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('formula',$data);	
	}

	public function imiwin2()
	{
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('imiwin2',$data);	
	}

	public function betclic()
	{
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('betclic',$data);	
	}

	public function sa36()
	{
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('sa36',$data);	
	}

	public function lotto57()
	{
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('lotto57',$data);	
	}

	public function sbobet()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('sbobet',$data);		
	}

	public function m168()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('m168',$data);		
	}

	public function isc888()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('isc888',$data);		
	}

	public function nova88()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('nova88',$data);		
	}

	public function ufabet()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('ufabet',$data);		
	}

	public function gclub()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('gclub',$data);		
	}

	public function siri365()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('siri365',$data);		
	}

	public function bet928()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('bet928',$data);		
	}

	public function holiday()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('holiday',$data);		
	}

	public function kiss()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('kiss',$data);		
	}

	public function wm()
	{	
		$data['maintenance'] = $this->db->select('*')->where('id',5)->get('maintenance')->result_array();
		$this->load->view('wm',$data);		
	}
}


<?php
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('sale/sale_model');
		$this->load->library('Sale_libraray');
		$this->sale_libraray->login();
		$this->output->set_template('tem_sale/tem_sale');
		
	}
	public function index()
	{
		
		$data = array(
			'sale' =>  $sale,
			);
		$this->load->view('home',$data);
		
	}
	public function dashboard(){

		if(!empty($this->session->sale_dash)){
			$sale_dash = json_decode($this->session->sale_dash);
			$data['us_all'] 		= $sale_dash->us_all; //ลูกค้าทั้งหมด
			$data['us_day'] 		= $sale_dash->us_day; //ลูกค้าวันนี้
			$data['us_month'] 		= $sale_dash->us_month; // ลูกค้าเดือนนี้
			$data['us_dps_day'] 	= $sale_dash->us_dps_day; //ยอดฝากแรกวันนี้
			$data['us_dps_month'] 	= $sale_dash->us_dps_month; // ยอดฝากแรกเดือนนี้
			$data['us_last5'] 		= $sale_dash->us_last5; // สมาชิก 5 คนล่าสุด
			$data['dps_last5'] 		= $sale_dash->dps_last5; // ยอดฝาก 5 รายบการล่าสุด
			$data['us_dps_300'] 	= $sale_dash->us_dps_300; // ยอดฝาก 5 รายบการล่าสุด
			$data['datetime'] 		= $sale_dash->datetime; // ยอดฝาก 5 รายบการล่าสุด
			$this->load->view('dashboard',$data);
		}else{
			
			$this->sel_dashboard();
			redirect('sale/home/dashboard', 'refresh');
		}
		
	}
	public function sel_dashboard()
	{
		
		$us_day = $this->db->select('tb_user.id')
			->join('tb_sale_user','tb_sale_user.user_id = tb_user.id','left')
			->where('tb_sale_user.sale_id',$this->session->sale->id)
			->where('tb_user.create_time >=',strtotime(date('d-m-Y 00:00:00')))
			->where('tb_user.create_time <=',strtotime(date('d-m-Y 23:59:59')))
			->get('tb_user');
		
		$us_month = $this->db->select('tb_user.id')
			->join('tb_sale_user','tb_sale_user.user_id = tb_user.id','left')
			->where('tb_sale_user.sale_id',$this->session->sale->id)
			->where('tb_user.create_time >=',strtotime(date('1-m-Y 00:00:00')))
			->where('tb_user.create_time <=',strtotime(date('d-m-Y 23:59:59')))
			->get('tb_user');
		
		$us_dps_day = $this->db->select('tb_user.id')
			->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
			->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
			->group_by('tb_sale_user.user_id')
			->where('tb_sale_user.sale_id',$this->session->sale->id)
			->where('tb_user.create_time >=',strtotime(date('d-m-Y 00:00:00')))
			->where('tb_user.create_time <=',strtotime(date('d-m-Y 23:59:59')))
			->where('tb_statement.datetime >=',strtotime(date('d-m-Y 00:00:00')))
			->order_by('tb_statement.id','ASC')
			->get('tb_sale_user');
		
		$us_dps_month = $this->db->select('tb_sale_user.user_id')
			->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
			->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
			->group_by('tb_sale_user.user_id')
			->where('tb_sale_user.sale_id',$this->session->sale->id)
			->where('tb_user.create_time >=',strtotime(date('1-m-Y 00:00:00')))
			->where('tb_user.create_time <=',strtotime(date('d-m-Y 23:59:59')))
			->where('tb_statement.datetime >=',strtotime(date('1-m-Y 00:00:00')))
			->order_by('tb_statement.id','ASC')
			->get('tb_sale_user');
		$us_dps_300 = $this->db->select('tb_sale_user.user_id')
			->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
			->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
			->group_by('tb_sale_user.user_id')
			->where('tb_sale_user.sale_id',$this->session->sale->id)
			->where('tb_user.create_time >=',strtotime(date('1-m-Y 00:00:00')))
			->where('tb_user.create_time <=',strtotime(date('d-m-Y 23:59:59')))
			->where('tb_statement.datetime >=',strtotime(date('1-m-Y 00:00:00')))
			->where('tb_statement.deposit >=',300)
			->order_by('tb_statement.id','ASC')
			->get('tb_sale_user');
		$us_all	= $this->db->select('tb_sale_user.id')
									->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
									->where('tb_sale_user.sale_id',$this->session->sale->id)
									->get('tb_sale_user');
		
		$us_last5 = $this->db->select('tb_user.username,tb_user.user,tb_user.create_time')
									->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
									->where('tb_sale_user.sale_id',$this->session->sale->id)
									->order_by('tb_user.id','DESC')
									->limit(5)
									->get('tb_sale_user');
		
		$dps_last5 = $this->db->select('tb_user.username,tb_user.user,tb_statement.deposit,tb_statement.datetime')
									->join('tb_user','tb_user.id = tb_sale_user.user_id','left')
									->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
									->where('tb_sale_user.sale_id',$this->session->sale->id)
									->where('tb_statement.datetime >=',time()-86400)
									->where('tb_statement.deposit >',0)
									->order_by('tb_user.id','DESC')
									->limit(5)
									->get('tb_sale_user');
		$arr_session_dash = array(
			'us_all' => $us_all->num_rows(), //ลูกค้าทั้งหมด
			'us_day' => $us_day->num_rows(), //ลูกค้าวันนี้
			'us_month' => $us_month->num_rows(), // ลูกค้าเดือนนี้
			'us_dps_day' => $us_dps_day->num_rows(), //ยอดฝากแรกวันนี้
			'us_dps_month' => $us_dps_month->num_rows(), // ยอดฝากแรกเดือนนี้
			'us_last5' => $us_last5->result_array(), // สมาชิก 5 คนล่าสุด
			'dps_last5' => $dps_last5->result_array(), // ยอดฝาก 5 รายบการล่าสุด
			'us_dps_300' => $us_dps_300->num_rows(), // ยอดฝาก 5 รายบการล่าสุด
			'datetime' => time(), // ยอดฝาก 5 รายบการล่าสุด
			);
		
		$this->session->sale_dash =  json_encode($arr_session_dash);
		redirect('sale/home/dashboard', 'refresh');
	}


}



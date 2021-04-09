<?php
class Sale_pay extends MY_Controller
{
	public function __construct()
	{

		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();
		$this->output->set_template('tem_owner/tem_owner');
	}


	public function index()
	{
		$data=[];
		if ($this->input->post('datefrom') && $this->input->post('dateto')){
			$data['datefrom'] = $this->input->post('datefrom');
			$data['dateto'] = $this->input->post('dateto');
			$data['data'] = $this->getdata(strtotime(date($data['datefrom'].' 11:00:00 ').'-1 days'),strtotime(date($data['dateto'].' 10:59:59 ')));
			$data['sumWl'] = 0;
			$data['sumTr'] = 0;
			foreach ($data['data'] as $val) {
				$data['sumWl'] += $val->winlose;
				$data['sumTr'] += $val->turnover;
			}

		}
	
		$this->load->view('report_sale_pay',$data);

	}


	function getdata($datefrom,$dateto)
	{
		return $this->db
					->select('tb_report_winlos.sale_id, tb_report_winlos.datefrom, tb_report_winlos.dateto, sum(tb_report_winlos.winlose) As winlose,sum(tb_report_winlos.turnover) As turnover, tb_sale.username, tb_sale.name')
					->join('tb_sale','tb_sale.id=tb_report_winlos.sale_id')
					->where('datefrom >=',$datefrom)
					->where('dateto <=',$dateto)
					->group_by('tb_report_winlos.sale_id')
					->get('tb_report_winlos')
					->result();
	}


}

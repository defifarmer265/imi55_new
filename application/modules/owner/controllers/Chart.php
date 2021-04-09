<?php
class Chart extends MY_Controller
{
	public function __construct()
	{
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('backend/statement_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();
		$this->output->set_template('tem_owner/tem_owner');	
	}

	public function s_chart(){
		$this->load->view('chart_s');
	}
	
	public function search(){ 
		if($this->input->post('dt1')!=null){
			$withdrawJS = '';
			$depositJS = '';
			$sumPerDay = 0;
			$time = array(
				["s"=> strtotime(date('d-m-Y 00:00:00',strtotime($this->input->post('dt1')))), "e"=>strtotime(date('d-m-Y 00:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 01:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 01:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 02:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 02:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 03:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 03:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 04:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 04:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 05:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 05:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 06:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 06:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 07:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 07:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 08:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 08:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 09:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 09:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 10:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 10:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 11:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 11:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 12:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 12:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 13:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 13:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 14:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 14:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 15:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 15:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 16:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 16:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 17:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 17:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 18:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 18:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 19:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 19:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 20:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 20:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 21:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 21:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 22:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 22:59:59',strtotime($this->input->post('dt1'))))],
				["s"=> strtotime(date('d-m-Y 23:00:00',strtotime($this->input->post('dt1')))), "e"=> strtotime(date('d-m-Y 23:59:59',strtotime($this->input->post('dt1'))))],
			);
	
			$wdJS = "";
			$dsJS = "";
				foreach($time as $ti){
					$row_deposit = $this->db->select('SUM(deposit) as sumPerDay ,datetime')
										->where('datetime >=', $ti['s'])
										->where('datetime <=', $ti['e'])
										->where('deposit_id !=', 0)
										->where('status', 2)
										->get('tb_statement')
										->row();
					$row_withdraw = $this->db->select('SUM(withdraw) as sumPerDay,datetime')
										->where('datetime >=', $ti['s'])
										->where('datetime <=', $ti['e'])
										->where('withdraw_id != ', 0)
										->where('status', 2)
										->get('tb_statement')
										->row();
							if($row_deposit->sumPerDay != '' || $row_deposit->sumPerDay != null){
								$dsJS .= "'".$row_deposit->sumPerDay."',";
							}else{
								$dsJS .= "'0',";
							}
							if($row_withdraw->sumPerDay != '' || $row_withdraw->sumPerDay != null){
								$wdJS .= "'".$row_withdraw->sumPerDay."',";
							}else{
								$wdJS .= "'0',";
							}
				}
			$data['day'] =  $this->input->post('dt1');
			$data['deposit'] = $dsJS;
			$data['withdraw']= $wdJS;
			$this->load->view('chart_rssearch',$data);
		}else{
			redirect('owner/chart/s_chart','refresh');
		}
		
	}
	
    public function search_t(){
		if($this->input->post('dt1')!= null){
				$dayStart = time() - ($this->input->post('dt1')* 24 * 60 * 60);
				$dateEnd   = strtotime(date('d-m-Y'));
				$withdrawJS = '';
				$depositJS = '';
				$sumPerDay = 0;

				for ($i = 1; $dayStart < $dateEnd; $i++) {
					$dayStart = strtotime(date('m/d/y', $dayStart) . "+1 days");
					$row_withdraw = $this->db->select('SUM(withdraw) as sumPerDay')
							->where('datetime >=', strtotime(date('d-m-Y 00:00:00', $dayStart)))
							->where('datetime <=', strtotime(date('d-m-Y 23:59:59', $dayStart)))
							->where('withdraw_id != ', 0)
							->where('status', 2)
							->get('tb_statement')
							->row();
				
					$row_deposit = $this->db->select('SUM(deposit) as sumPerDay')
						->where('datetime >=', strtotime(date('d-m-Y 00:00:00', $dayStart)))
						->where('datetime <=', strtotime(date('d-m-Y 23:59:59', $dayStart)))
						->where('deposit_id !=', 0)
						->where('status', 2)
						->get('tb_statement')
						->row();

						if ($row_withdraw->sumPerDay != '') {
							$wd_sumPerDay = ($row_withdraw->sumPerDay / 1000);
						} else {
							$wd_sumPerDay = 0;
						}
						if ($row_deposit->sumPerDay != '') {
							$ds_sumPerDay = ($row_deposit->sumPerDay / 1000);
						} else {
							$ds_sumPerDay = 0;
						}
						$wdJS = '[gd(' . date('Y, m, d', $dayStart) . '),' . $wd_sumPerDay . '],';
						$withdrawJS = $withdrawJS . $wdJS;
						$dsJS = '[gd(' . date('Y, m, d', $dayStart) . '),' . $ds_sumPerDay . '],';
						$depositJS = $depositJS . $dsJS;
				}
				$data['deposit'] = $depositJS;
				$data['withdraw']= $withdrawJS;
				print_r($data['deposit'], $data['withdraw']);
				$this->load->view('chart_rssearch2',$data);
			}else{
				redirect('owner/home/dashboard','refresh');
			 }
	}
}
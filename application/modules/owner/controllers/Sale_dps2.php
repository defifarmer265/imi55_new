<?php
class Sale_dps2 extends MY_Controller
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

	public function home()
	{
			$data['sale_r'] = $this->db->select('tb_sale.id,tb_sale.username, tb_sale.name,tb_sale.status')
							->where('tb_sale.status',1)
							->get('tb_sale')
							->result_array();
		
		$this->load->view('sale_dps2_home',$data);
//		echo '<pre>';
//		print_r($sale_r);
//		die();
	}
	public function search()
	{
//		print_r($this->input->post());
//		die();
		if($this->input->post('date_start') && $this->input->post('date_end') && $this->input->post('sale_id')){
			$date_start = strtotime($this->input->post('date_start').'00:00:00');
			$date_end 	= strtotime($this->input->post('date_end').'23:59:59');
			$sale_id 	= $this->input->post('sale_id');
			$user_r 	= $this->db->select('
								tb_user.id,tb_user.username,tb_user.user,tb_user.create_time')
								->join('tb_user','tb_user.id = tb_sale_user.user_id')
//								->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
								->group_by('tb_sale_user.user_id')
								->where('tb_sale_user.sale_id',$sale_id)
								->where('tb_user.create_time >=',$date_start)
								->where('tb_user.create_time <=',$date_end)
								->get('tb_sale_user')
								->result_array();
			$sum['dps1'] = 0;
			$sum['dps2'] = 0;
			$sum['dps3'] = 0;
			$sum['dps4'] = 0;
			$sum['dps5'] = 0;
			$i = 0 ;
			$dpsi1 = 0 ;
			$dpsi2 = 0 ;
			$dpsi3 = 0 ;
			$dpsi4 = 0 ;
			$dpsi5 = 0 ;
            $useri = 0;
			foreach($user_r as $user=>$u){
                $useri++;
				$dps_q = $this->db->select('tb_statement.deposit')
						->where('tb_statement.user_id',$u['id'])
						->where('tb_statement.dateCreate >=',$date_start)
						->where('tb_statement.dateCreate <=',$date_end)
						->where('tb_statement.status',2)
						->where('tb_statement.deposit >',0)
						->order_by('id','ASC')
						->limit('5')
						->get('tb_statement');
                
				$dps_row = $dps_q->num_rows();
				$dps_r   = $dps_q->result_array();
				if($dps_row == 1){
					
					$dps1 	= (int) $dps_r[0]['deposit'];
					$dps2 	= 0;
					$dps3 	= 0;
					$dps4 	= 0;
					$dps5 	= 0;
					$dpsi1++;
					
				}else if($dps_row == 2){

					$dps1 	= (int) $dps_r[0]['deposit'];
					$dps2 	= (int) $dps_r[1]['deposit'];
					$dps3 	= 0;
					$dps4 	= 0;
					$dps5 	= 0;
					$dpsi1++;
					$dpsi2++;
					
				}
					else if($dps_row == 3){

					$dps1 	= (int) $dps_r[0]['deposit'];
					$dps2 	= (int) $dps_r[1]['deposit'];
					$dps3 	= (int) $dps_r[2]['deposit'];
					$dps4 	= 0;
					$dps5 	= 0;
					$dpsi1++;
					$dpsi2++;
					$dpsi3++;
						
				}else if($dps_row == 4){

					$dps1 	= (int) $dps_r[0]['deposit'];
					$dps2 	= (int) $dps_r[1]['deposit'];
					$dps3 	= (int) $dps_r[2]['deposit'];
					$dps4 	= (int) $dps_r[3]['deposit'];
					$dps5 	= 0;
					$dpsi1++;
					$dpsi2++;
					$dpsi3++;
					$dpsi4++;

				}else if($dps_row == 5){

					$dps1 	= (int) $dps_r[0]['deposit'];
					$dps2 	= (int) $dps_r[1]['deposit'];
					$dps3 	= (int) $dps_r[2]['deposit'];
					$dps4 	= (int) $dps_r[3]['deposit'];
					$dps5 	= (int) $dps_r[4]['deposit'];
					$dpsi1++;
					$dpsi2++;
					$dpsi3++;
					$dpsi4++;
					$dpsi5++;
				}else{
						
					$dps1 	= 0;
					$dps2 	= 0;
					$dps3 	= 0;
					$dps4 	= 0;
					$dps5 	= 0;
						
				}

				$user_r[$i]['dps1'] = $dps1;
				$user_r[$i]['dps2'] = $dps2;
				$user_r[$i]['dps3'] = $dps3;
				$user_r[$i]['dps4'] = $dps4;
				$user_r[$i]['dps5'] = $dps5;
				$sum['dps1'] = $sum['dps1'] + $dps1;
				$sum['dps2'] = $sum['dps2'] + $dps2;
				$sum['dps3'] = $sum['dps3'] + $dps3;
				$sum['dps4'] = $sum['dps4'] + $dps4;
				$sum['dps5'] = $sum['dps5'] + $dps5;
				
				$i++;
			}
			
			$dpsi['dpsi1'] = $dpsi1;
			$dpsi['dpsi2'] = $dpsi2;
			$dpsi['dpsi3'] = $dpsi3;
			$dpsi['dpsi4'] = $dpsi4;
			$dpsi['dpsi5'] = $dpsi5;

				
		}
		$data['user'] 	= $user_r;
		$data['sum']  	= $sum;
		$data['dpsi']  	= $dpsi;
		$data['useri']  = $useri;
		
		$re = array('code' => 1, 'title' => 'สำเร็จ','msg'=>'', 'data' => $data);
		
		echo json_encode($re);
		die();
		
	}
}

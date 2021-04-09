<?php
class Income extends MY_Controller
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
		$data['sale'] = $this->db->select('tb_sale.name,tb_sale.username,tb_sale.id')->where('id',$this->session->sale->id)->get('tb_sale')->row();
		$data['setting'] = $this->db->select('*')->get('tb_sale_setting')->row();
		$this->load->view('income',$data);
	}

	public function calsale(){
		$id = $this->session->sale->id ;
		if($id !=null)
		{
			$data['sale'] = $this->db->select('tb_sale.name,tb_sale.username,tb_sale.id')->where('id',$id)->get('tb_sale')->row();
			$data['setting'] = $this->db->select('*')->get('tb_sale_setting')->row();
			$this->load->view('sale_calsale', $data);

		}else{
			$this->load->view('login');
		}

	}

	function calculate_()
	{
		if ($this->input->post('d1') && $this->input->post('d2') && $this->input->post('id')) {
            $sum['cost']= $this->input->post('cost') != 0 ? $this->input->post('cost') : 1;
			$setting    = $this->db->select('*')->get('tb_sale_setting')->row();
			$date_start = strtotime($this->input->post('d1') . '00:00:00');
			$date_end   = strtotime($this->input->post('d2') . '23:59:59');
			$sale_id    = $this->input->post('id');
            
           $user_q 	= $this->db->select('
                            group_concat(tb_statement.deposit ORDER BY tb_statement.id ASC) as deposit,
                            tb_user.id,tb_user.username,tb_user.user,tb_user.create_time,
                                
                            ')
                            ->join('tb_user','tb_user.id = tb_sale_user.user_id')
							->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
                            ->group_by('tb_sale_user.user_id')
                            ->where('tb_statement.deposit >',0)
                            ->where('tb_sale_user.sale_id',$sale_id)
                            ->where('tb_statement.datetime >=',$date_start)
                            ->where('tb_user.create_time >=',$date_start)
                            ->where('tb_user.create_time <=',$date_end)
                            ->get('tb_sale_user');;

            if($user_q->num_rows() == 0 ){
                $re = array('code'=>0,'title'=>'ไม่มีข้อมูลลูกค้า','msg'=>'ข้อมูลลูกค้ามีปัญหากรุณาตรวจสอบอีกครั้งค่ะ','data' => '');
                echo json_encode($re);
                die();
            }
            $user_r  = $user_q->result_array();
            $sum['num1r1']  = 0;//(r1) ฝากน้อยกว่า 100
            $sum['num1r2']  = 0;//(r2) ฝาก 100 ถึง 299
            $sum['num1r3']  = 0;//(r3) ฝาก 300 ขึ้นไป
            $sum['ave']     = 0;// ค่าเฉลี่ย [งบประมาณ / ยอดฝากแรก]
            // ค่าคอม [ (r2) x (p1) ] + [ (r3) x (p2) ]
            $sum['dps']     = 0;//รวมยอดฝากทั้งหมด
            $sum['usdps']   = 0;//จำนวนสมัครใหม่มียอดฝาก
            $sum['dps1']    = 0;//จำนวนสมัครใหม่มียอดฝาก
            $sum['sdps1']   = 0;
            $sum['sdps2']   = 0;
            $sum['sdps3']   = 0;
            $sum['sdps4']   = 0;
            $sum['sdps5']   = 0;
            $sum['us']      = $this->db->select('tb_sale_user.id')
                                    ->join('tb_user','tb_user.id = tb_sale_user.user_id')
                                    ->where('tb_user.create_time >=',$date_start)
                                    ->where('tb_user.create_time <=',$date_end)
                                    ->where('tb_sale_user.sale_id',$sale_id)
                                    ->get('tb_sale_user')->num_rows();  //จำนวนสมัครใหม่ทั้งหมด
       
            //pre user ยอดฝาก 1-5
            $dpsi1 = 0;
            $dpsi2 = 0;
            $dpsi3 = 0;
            $dpsi4 = 0;
            $dpsi5 = 0;
            
            //sum
            $num1r1 = 0; //จำนวนฝากยอดแรก เรท 1
            $num1r2 = 0; //จำนวนฝากยอดแรก เรท 2
            $num1r3 = 0; //จำนวนฝากยอดแรก เรท 3
            $dps1r1 = 0; //ยอดฝากรวม เรท 1
            $dps1r2 = 0; //ยอดฝากรวม เรท 2
            $i = 0;
            
            
            foreach($user_r as $user=>$us){
                
                //แยกรายการยอดฝากเป็น array
                $deposit    = explode(",",$us['deposit']);
                $sumdps     = array_sum($deposit); //รวมยอดฝากสมาชิกคนนึ้
                $user_r[$i]['us_sumdps'] = $sumdps; //ยอดฝากรวมต่อยูเซอร์
                $sum['dps'] = $sum['dps'] +  $sumdps; //ยอดฝากรวมทั้งหมด                 
            
                $user_r[$i]['us_countdps']  = count($deposit); //จำนวนยอดฝากต่อยูเซอร์
                
                // ยอดฝาก 1 - 5 
                $user_r[$i]['dps1'] = 0;
                $user_r[$i]['dps2'] = 0;
                $user_r[$i]['dps3'] = 0;
                $user_r[$i]['dps4'] = 0;
                $user_r[$i]['dps5'] = 0;
                if(!empty($deposit[0])){
                    $user_r[$i]['dps1'] =  $deposit[0];
                    $sum['sdps1'] = $sum['sdps1'] + $deposit[0];
                    $dpsi1++;
                }
                if(!empty($deposit[1])){
                    $user_r[$i]['dps2'] =  $deposit[1];
                    $sum['sdps2'] = $sum['sdps2'] + $deposit[1];
                    $dpsi2++;
                }
                if(!empty($deposit[2])){
                    $user_r[$i]['dps3'] =  $deposit[2];
                    $sum['sdps3'] = $sum['sdps3'] + $deposit[2];
                    $dpsi3++;
                }
                if(!empty($deposit[3])){
                    $user_r[$i]['dps4'] =  $deposit[3];
                    $sum['sdps4'] = $sum['sdps4'] + $deposit[3];
                    $dpsi4++;
                }
                if(!empty($deposit[4])){
                    $user_r[$i]['dps5'] =  $deposit[4];
                    $sum['sdps5'] = $sum['sdps5'] + $deposit[4];
                    $dpsi5++;
                }

  
                //ระบบคำนวณเรทยอดฝากลูกค้า
                if($deposit[0] < $setting->f_amt0){
                    $num1r1++;
                    $dps1r1 = $dps1r1 + $deposit[0];
                }else if($deposit[0] < $setting->f_amt1){
                    $num1r2++;
                    $dps1r2 = $dps1r2 + $deposit[0];
                }else{
                    $num1r3++;
                }
                $i++;
                
            }
            $sum['num1r1']  = $num1r1;
            $sum['num1r2']  = $num1r2;
            $sum['num1r3']  = $num1r3;
            $sum['usdps']   = $i;
            $sum['ave']     = (int) ($sum['cost'] / $i) ;
            
            //ตรวจสอบว่า ave อยู่
            if($sum['ave'] <= $setting->ave1){
                $sum['ave_pay1'] = $setting->ave1_pay1;
                $sum['ave_pay2'] = $setting->ave1_pay2;
                $sum['ave_type'] = 'ave1';
            }else if($sum['ave'] <= $setting->ave2){
                $sum['ave_pay1'] = $setting->ave2_pay1;
                $sum['ave_pay2'] = $setting->ave2_pay2;
                $sum['ave_type'] = 'ave2';
            }else if($sum['ave'] <= $setting->ave3){
                $sum['ave_pay1'] = $setting->ave3_pay1;
                $sum['ave_pay2'] = $setting->ave3_pay2;
                $sum['ave_type'] = 'ave3';
            }else if($sum['ave'] <= $setting->ave4){
                $sum['ave_pay1'] = $setting->ave4_pay1;
                $sum['ave_pay2'] = $setting->ave4_pay2;
                $sum['ave_type'] = 'ave4';
            }else if($sum['ave'] <= $setting->ave5){
                $sum['ave_pay1'] = $setting->ave5_pay1;
                $sum['ave_pay2'] = $setting->ave5_pay2;
                $sum['ave_type'] = 'ave5';
            }else{
                $sum['ave_pay1'] = 0;
                $sum['ave_pay2'] = 0;
                $sum['ave_type'] = 'ave6';
            }
            
            $sum['dps1'] = $dpsi1;
            $sum['dps2'] = $dpsi2;
            $sum['dps3'] = $dpsi3;
            $sum['dps4'] = $dpsi4;
            $sum['dps5'] = $dpsi5;
            $sum['cal_r2'] = $sum['num1r2'] * $sum['ave_pay1'];
            $sum['cal_r3'] = $sum['num1r3'] * $sum['ave_pay2'];
            $sum['cal_tt'] = $sum['cal_r2'] + $sum['cal_r3'];

            $data = array(
                'sum' => $sum,
                'user'=> $user_r,
            );
            
           
            $re = array('code'=>1,'title'=>'สำเร็จ','msg'=>'กรุณาตรวจสอบข้อมูล','data' => $data);
		echo json_encode($re);
		die();
	   }
    }
	

	public function report_sale()
	{
		if ($this->input->post('d1') && $this->input->post('d2')) {
			$d1 = strtotime($this->input->post('d1') . '00:00:00');
			$d2 = strtotime($this->input->post('d2') . '23:59:59');
			$sale_id = $this->input->post('id');
			
            $user_nodps 	= $this->db->select('
                            tb_user.id,tb_user.username,tb_user.user,tb_user.create_time,
                            ')
                            ->join('tb_user','tb_user.id = tb_sale_user.user_id')
							->join('tb_statement','tb_statement.user_id = tb_sale_user.user_id','left')
                            ->where('tb_statement.id IS NULL', null, false)
                            ->where('tb_sale_user.sale_id',$sale_id)
                            ->where('tb_user.create_time >=',$d1)
                            ->where('tb_user.create_time <=',$d2)
                            
                            ->get('tb_sale_user')->result_array();
            $re = array('code' => 1, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ','data' => $user_nodps);
		} else {
			$re = array('code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ทำรายการไม่สำเร็จกรุณาทำรายการใหม่อีกครั้งค่ะ');
		}
		echo json_encode($re);
		die();
	}


	public function getturn()
	{
		$dayO = $this->input->post('d1');
		$dayT = $this->input->post('d2');
		$d1 = strtotime($dayO . '00:00:00'); //start_date
		$d2 = strtotime($dayT . '23:59:59'); //end_date
		$data_sent = json_encode(array(
			"from"=> $d1,
			"to"=> $d2
		));
		$d = json_decode($this->getapi_model->call_API_mongo('turnover/user/'.$this->input->post('user').'/date', $data_sent, "POST"));
		 echo json_encode(array('sum'=>$d->totalTurnover));
		 die;
	}

	

}



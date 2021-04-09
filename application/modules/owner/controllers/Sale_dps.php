<?php
class Sale_dps extends MY_Controller
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
		$data['setting'] = $this->db->select('*')->get('tb_sale_setting')->row();
		$this->load->view('sale_dps_home',$data);
//		echo '<pre>';
//		print_r($sale_r);
//		die();
	}
	public function search()
	{
        $date_start = strtotime($this->input->post('date_start').'00:00:00');
        $date_end 	= strtotime($this->input->post('date_end').'23:59:59');
        
        
        $setting    = $this->db->select('*')->get('tb_sale_setting')->row();
        $sale_id 	= $this->input->post('sale_id');
        $sale_r     = $this->db->where('id',$sale_id)->get('tb_sale')->row();
        
        $user_q = $this->db->select( '
                            group_concat(tb_statement.deposit ORDER BY tb_statement.id ASC) as deposit,
                            tb_user.id,tb_user.username,tb_user.user,tb_user.create_time,tb_user_rank.total_turnover
                                
                            ' )
            ->join( 'tb_user', 'tb_user.id = tb_sale_user.user_id' )
            ->join( 'tb_statement', 'tb_statement.user_id = tb_sale_user.user_id', 'left' )
            ->join( 'tb_user_rank', 'tb_user_rank.user = tb_user.user', 'left' )
            ->group_by( 'tb_sale_user.user_id' )
            ->where( 'tb_statement.deposit >', 0 )
            ->where( 'tb_sale_user.sale_id', $sale_id )
            ->where( 'tb_statement.datetime >=', $date_start )
            ->where( 'tb_user.create_time >=', $date_start )
            ->where( 'tb_user.create_time <=', $date_end )
            ->get( 'tb_sale_user' );
        
  
        $user_sale 	= $this->db->select('tb_user.id')
                            ->join('tb_user','tb_user.id = tb_sale_user.user_id')
                            ->where('tb_sale_user.sale_id',$sale_id)
                            ->where('tb_user.create_time >=',$date_start)
                            ->where('tb_user.create_time <=',$date_end)
                            ->get('tb_sale_user');
        $dpsid	= $this->db->select('tb_user.id')
                            ->join('tb_user','tb_user.id = tb_sale_user.user_id')
                            ->where('tb_sale_user.sale_id',$sale_id)
                            ->where('tb_user.create_time >=',strtotime(date('d-m-Y 00:00:00')))
                            ->get('tb_sale_user')->num_rows();
        $dpsim	= $this->db->select('tb_user.id')
                            ->join('tb_user','tb_user.id = tb_sale_user.user_id')
                            ->where('tb_sale_user.sale_id',$sale_id)
                            ->where('tb_user.create_time >=',strtotime(date('01-m-Y 00:00:00')))
                            ->get('tb_sale_user')->num_rows();
        $dpsia	= $this->db->select('tb_sale_user.id')
                            ->where('tb_sale_user.sale_id',$sale_id)
                            ->get('tb_sale_user')->num_rows();
        //ยูสเซอร์ทั้งหมด
        $dpsi = $user_sale->num_rows();
        $numf1  = 0; //จำนวนลูกค้าฝากมาเรท1
        $numf2  = 0; //จำนวนลูกค้าฝากมาเรท2
        $numf3  = 0; //จำนวนลูกค้าฝากมาเรท3
        $average= 0; //ค่าเฉลี่ยลูกค้าจากงบประมาณ
        $sum_famt12 = 0; //รวมยอดฝาก1 ที่อยุ่ในเรทไม่ถึงเรท 3
        $f_amt0 = $setting->f_amt0; //ตั้งค่าแยกขั้นแรก  100
        $f_amt1 = $setting->f_amt1; //ตั้งค่ายอดที่  300
        $dpsi2_cal  = 0;
        $dpsi2_cal2 = 0;
        $sum_samt12 = 0;
        
        $count_user = $user_q->num_rows();
        if($count_user  !=0){
            $user_r = $user_q->result_array();
            $i      = 0;
            $dpsi1  = 0; //รวมจำนวนฝากยอดแรก
            $dpsi2  = 0; //รวมจำนวนฝากยอดที่ 2
            $dpsi3  = 0; //รวมจำนวนฝากยอดที่ 3
            $dpsi4  = 0; //รวมจำนวนฝากยอดที่ 4
            $dpsi5  = 0; //รวมจำนวนฝากยอดที่ 5
            
            $sum['dps']     = 0;
            $sum['dps1']    = 0;
            $sum['dps2']    = 0;
            foreach($user_r as $user=>$us){
                
                //แยกรายการยอดฝากเป็น array
                $deposit = explode(",",$us['deposit']);
                
                //นับจำนวน array
                $count   = count($deposit);
                
                //รวมยอดฝากสมาชิกคนนึ้
                $sumdps = array_sum($deposit);
                $user_r[$i]['dpssum'] = $sumdps;
                $sum['dps'] = $sum['dps'] +  $sumdps;
                
                //มียอดฝากแรกแค่ยอดฝากเดียว
                if($count == 1){
                    $dpsi1++;
                    $sum['dps1'] = $sum['dps1'] + $deposit[0];
                    $user_r[$i]['dps1'] = $deposit[0];
                    $user_r[$i]['dps2'] = 0;

                //มีมากกว่า 1 ยอดฝาก
                }else{
                    $dpsi1++;
                    $dpsi2++;
                    $sum['dps1'] = $sum['dps1'] + $deposit[0];
                    $sum['dps2'] = $sum['dps2'] + $deposit[1];
                    $user_r[$i]['dps1'] = $deposit[0];
                    $user_r[$i]['dps2'] = $deposit[1]; 
                    
                    $user_r[$i]['dps3'] = empty($deposit[2]) ?  0 : $deposit[2];
                    $user_r[$i]['dps4'] = empty($deposit[3]) ?  0 : $deposit[3];
                    $user_r[$i]['dps5'] = empty($deposit[4]) ?  0 : $deposit[4];
                    
                    empty($deposit[2]) ?   : $dpsi3++;
                    empty($deposit[3]) ?   : $dpsi4++;
                    empty($deposit[4]) ?   : $dpsi5++;
                    
                    if($deposit[1] >= $f_amt1){
                        $dpsi2_cal++;
                    }else{
                        $dpsi2_cal2++;
                        $sum_samt12 = $sum_samt12+ $deposit[1];
                    }
                }    
                //ระบบคำนวณเรทยอดฝากลูกค้า
                if($deposit[0] < $f_amt0){
                    $numf1++;
                    $sum_famt12 = $sum_famt12 + $deposit[0];
                }else if($deposit[0] < $f_amt1){
                    $numf2++;
                    $sum_famt12 = $sum_famt12 + $deposit[0];
                }else{
                    $numf3++;
                }
                    
                $i++;
                
            }
            
            //ave จาก cost หารด้วยจำนวนยูเซอร์ที่ฝากเข้ามายอดแรก
            if($this->input->post('cost') == 0 || $this->input->post('cost') == null){
                $average = 1;
            }else{
                $cost    = $this->input->post('cost');
                $average = $cost / $count_user;
            }

            //ตรวจสอบว่า ave อยู่
            if($average <= $setting->ave1){
                $ave_pay2 = $setting->ave1_pay2;
                $typepay = 'ave1';
            }else if($average <= $setting->ave2){
                $ave_pay2 = $setting->ave2_pay2;
                $typepay = 'ave2';
            }else if($average <= $setting->ave3){
                $ave_pay2 = $setting->ave3_pay2;
                $typepay = 'ave3';
            }else if($average <= $setting->ave4){
                $ave_pay2 = $setting->ave4_pay2;
                $typepay = 'ave4';
            }else if($average <= $setting->ave5){
                $ave_pay2 = $setting->ave5_pay2;
                $typepay = 'ave5';
            }else{
                $ave_pay2 = 0;
                $typepay = 'ave6';
            }
            
            //คำนวณ ยูเรท 1 - 2 นำมาหารด้วย จำนวน f_amt1
            if($sum_famt12 > $setting->f_amt1){
                $dpsif12 = $sum_famt12 / $setting->f_amt1;
            }else{
                $dpsif12 = 0;
            }
            
            //คำนวนยอดฝากที่ 2 เรท 1-2 น้ำมาหารด้วยจำนนวน f_amt1
            if($sum_samt12 > $setting->f_amt1){
                $dpsis12 = $sum_samt12 / $setting->f_amt1;
            }else{
                $dpsis12 = 0;
            }
            
            //คำนวณคอม ยอดสอง
            if($dpsi2 != 0 ){
                $sum_com_s1 = $dpsi2_cal * $ave_pay2;
                $sum_com_s2 = $dpsis12 * $ave_pay2;
                $sum_com_s3 = $sum_com_s1 + $sum_com_s2;
            }else{
                $sum_com_s1 = 0;
                $sum_com_s2 = 0;
                $sum_com_s3 = 0;
            }
                
            //คำนวนค่าคอม จากยอดฝาก เรท2 คูณด้วย ยอดจ่ายค่าเฉลีย2
            //จากยอดฝาก เรท1และเรท2 หารด้วยf_amt1 ทั้งหมดคูณด้วย ยอดจ่ายค่าเฉลี่ย2
            $sum_com1 = $numf3 * $ave_pay2;
            $sum_com2 = $dpsif12 * $ave_pay2;
            $sum_com3 = $sum_com1+$sum_com2;
            
            
            
            $data = array(
                'sale'  => $sale_r,
                'user'  => $user_r,
                'sum'   => $sum,
                'dpsi'  => array('dpsi1'=>$dpsi1,'dpsi2'=>$dpsi2,'dpsi3'=>$dpsi3,'dpsi4'=>$dpsi4,'dpsi5'=>$dpsi5,'dpsi'=>$dpsi,'dpsid'=>$dpsid,'dpsim'=>$dpsim,'dpsia'=>$dpsia),
                'calculate' => array(
                    'average' => (int) $average,
                    'numf1' =>$numf1,
                    'numf2' =>$numf2,
                    'numf3' =>$numf3,
                    'ave_pay2' =>$ave_pay2,
                    'sum_famt12' => $sum_famt12,
                    'sum_samt12' => $sum_samt12,
                    'dpsif12'  => (int) $dpsif12,
                    'sum_com1' => (int) $sum_com1,
                    'sum_com2' => (int) $sum_com2,
                    'sum_com3' => (int) $sum_com3,
                    'typepay'  => $typepay,
                    'dpsi2_cal'=> (int) $dpsi2_cal,
                    'dpsi2_cal2'=> (int) $dpsi2_cal2,
                    'dpsis12'=> (int) $dpsis12,
                    'sum_com_s1' => (int) $sum_com_s1,
                    'sum_com_s2' => (int) $sum_com_s2,
                    'sum_com_s3' => (int) $sum_com_s3,
                )
            );
           
            $re = array('code' => 1, 'title' => 'สำเร็จ','msg'=>'', 'data' => $data);
        }else{
            $re = array('code' => 0, 'title' => 'สำเร็จ','msg'=>'', 'data' => '');  
        }
        
		
		echo json_encode($re);
		die();

	}
}

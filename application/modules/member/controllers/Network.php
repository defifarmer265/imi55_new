<?php
class Network extends MY_Controller
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
        
        

    }
 
    public function  network(){
        
        $user_id = $this->uri->segment(4);
        if($user_id == ''){
            
            $userid = $this->session->member->id;
            $credit = $this->db->select('sale_credit')->where('id', $userid)->get('tb_user')->row();
            $g_user = $this->db->select('user_id, last_date')->where('sale_userid', $userid)->get('tb_user_sale');
            $data = $g_user->result_array(); //data
            
            $all = array();
            $i=0;
            foreach($data as $dt){
                $dt_user = $this->db->select('id, user, username, create_time')
                           ->where('id', $dt['user_id'])
						   ->get('tb_user')
                           ->result_array();
                $data[$i]['dt_user'] = $dt_user;
                
                $turnover = $this->db->select('turnover') //1st class
                            ->where('user_id', $dt['user_id'])
                            ->get('tb_user_sale')
                            ->result_array();
                $data[$i]['turnover'] = $turnover;
                
                $s_user = $this->db->select('user_id')
                          ->where('sale_userid', $dt['user_id'])
                          ->get('tb_user_sale')
                          ->result_array();
                $data[$i]['s_user'] = $s_user;

                $i++;
                
            } 
            
            $y=0;
            foreach($data as $ds){
                foreach($ds['s_user'] as $su){
                    $s_turn = $this->db->select('turnover')
                              ->where('user_id', $su['user_id'])
                              ->get('tb_user_sale')
                              ->result_array();
                    $data[$y]['s_turn'] = $s_turn;

                    $t_user = $this->db->select('user_id')
                              ->where('sale_userid', $su['user_id'])
                              ->get('tb_user_sale')
                              ->result_array();
                    $data[$y]['t_user'] = $t_user;
                    $j=0;
                   foreach($t_user as $ts){
                    $t_turn = $this->db->select('turnover')
                              ->where('user_id', $ts['user_id'])
                              ->get('tb_user_sale')
                              ->result_array();
                            //   print_r($t_turn);
                            //   die();
                            $data[$j]['t_turn'] = $t_turn;
                    $j++;
                } 
                    $y++;
                }
                         
            }
            // echo '<pre>';
            // print_r($data);
            // die();
            $arr_data = array(
                'data' => $data,
                'credit' => $credit
            );

            // print_r($arr_data);
            // die();
           
            $this->load->view('network', $arr_data);
        }else{
            
            $user_n = $this->db->select('user')->where('id', $user_id)->get('tb_user')->result_array();
            $user_q = $this->db->select('user_id, last_date')->where('sale_userid', $user_id)->get('tb_user_sale');
            $dt_user = $user_q->result_array();

            $j=0;
            foreach($dt_user as $du){
                $du_user = $this->db->select('id, username, user, create_time')
                            ->where('id', $du['user_id'])
                            ->get('tb_user')
                            ->result_array();
                $dt_user[$j]['du_user'] = $du_user;

                $turnover = $this->db->select('turnover')
                              ->where('user_id', $du['user_id'])
                              ->get('tb_user_sale')
                              ->result_array();
                $dt_user[$j]['turnover'] = $turnover;
                
                $j++;
            }

            $du_data = array(
                'dt_user' => $dt_user,
                'user_n' => $user_n
            );
            
            $this->load->view('network', $du_data);
        }
        
    }
    // 3
    public function get_data(){
    
            $user_id = $this->uri->segment(4);
            $user_n = $this->db->select('user')->where('id', $user_id)->get('tb_user')->result_array();
            $user_q = $this->db->select('user_id, last_date')->where('sale_userid', $user_id)->get('tb_user_sale');
            $data_u = $user_q->result_array();
           
            $j=0;
            foreach($data_u as $du){
                $du_user = $this->db->select('id, username, user, create_time')
                            ->where('id', $du['user_id'])
                            ->get('tb_user')
                            ->result_array();
                $data_u[$j]['du_user'] = $du_user;

                $turnover = $this->db->select('turnover')
                              ->where('user_id', $du['user_id'])
                              ->get('tb_user_sale')
                              ->result_array();
                $data_u[$j]['turnover'] = $turnover;

                $j++;
            }

            $du_data = array(
                'data_u' => $data_u,
                'user_n' => $user_n
            );

            $this->load->view('network', $du_data);

    } 

    public function all_turn(){

        $userid = $this->input->post('user_id');
        // $userid = $this->session->member->id;
        $curtime = time();
        $curdate = strtotime(date("Y-m-d H:i"));

        $class = $this->db->get('tb_affiliate_setting');
       if($class->num_rows() == 1){
           $class_r = $class->row();
       }else{
           $re = array('code'=> 2, 'title'=>'ไม่สามารถทำรายการได้', 'msg'=>'กรุณาติดต่อพนักงานค่ะ');
           echo json_encode($re);
           die();
          
       }

        $count_r = $this->db->select('tb_user.user, tb_user_sale.user_id, tb_user_sale.date_update')
                   ->join('tb_user', 'tb_user.id = tb_user_sale.user_id')
                   ->where('tb_user_sale.sale_userid', $userid)
                   ->get('tb_user_sale');
        $count = $count_r->result_array();
        $count_n = $count_r->num_rows();

        
        
        if($count_n >= 1){
        $i=0;
        foreach($count as $dt){ //1st class

             //id,last_date of 2nd class          
            $dt_r = $this->db->select('tb_user.user, tb_user_sale.user_id')
                    ->join('tb_user', 'tb_user.id = tb_user_sale.user_id')
                    ->where('tb_user_sale.sale_userid', $dt['user_id'])
                    ->get('tb_user_sale');
            $dt_u = $dt_r->result_array();
            $dt_q = $dt_r->num_rows();
          

                $user = $dt['user'];
                $id = $dt['user_id'];
                if($dt['date_update'] == ''){
                    $lastdate = strtotime(date("Y-m-d H:i", strtotime("-7 Days", $curdate)));
                }else{
                    $lastdate = $dt['date_update'];
                }
                
            
            //    print_r($last_d);
            //    die();
                
                if(!empty($lastdate)){
                    $last_d = strtotime(date('Y-m-d', strtotime("+1 Days", $lastdate)));
                    if($curdate >= $last_d){
                        if($curdate < strtotime("11:00 AM")){
                            $re = array('code'=> 2, 'title'=> 'กรุณาทำรายการอีกครั้ง','msg'=>'กรุณาทำรายการอีกครั้ง หลังเวลา 11.00 น.');
                            echo json_encode($re);
                            die();
                        }else{
                            $arr_up = $this->get_trunover($user, $curdate, $lastdate);
                           
                            if($this->db->where('user_id', $id)->update('tb_user_sale', $arr_up)){  
                                if($this->db->set('date_update', $curdate)->set('from_date', $lastdate)->where('sale_userid', $userid)->update('tb_user_sale')){
                                    $f_turn = ($arr_up['turnover']*$class_r->f_class)/100;
                                    $fturn = number_format($f_turn, 2);
                                    $this->db->set('sale_credit', 'sale_credit + ' . $fturn, FALSE)->where('id', $userid)->update('tb_user');
                                    $log = $this->db->where('user_id', $userid)->where('date_to', $curdate)->get('log_cal_affiliate');
                                    if($log->num_rows() >= 1){
                                        $this->db->set('aff_turn', 'aff_turn + ' . $fturn, FALSE)->where('user_id', $userid)->where('date_to', $curdate)->update('log_cal_affiliate');
                                    }else{
                                        $this->db->set('user_id', $userid)->set('aff_turn', 'aff_turn + ' . $fturn, FALSE)->set('date_to', $curdate)->set('date_from', $lastdate)->set('status', 1)->insert('log_cal_affiliate');
                                    }
                                }
                            }
                        }

                    }else{
                        
                        $re = array('code'=> 2, 'title'=> 'กรุณาทำรายการอีกครั้ง','msg'=>'กรุณาทำรายการอีกครั้ง ในวันถัดไป หลังเวลา 11.00 น.');
                        echo json_encode($re);
                        die();
                    }
                }else{

                    $arr_up = $this->get_trunover($user, $curdate, $lastdate);
                    $turn = number_format($arr_up['turnover'],2);
                    if($this->db->where('user_id', $id)->update('tb_user_sale', $arr_up)){
                        if($this->db->set('date_update', $curdate)->set('from_date', $lastdate)->where('sale_userid', $userid)->update('tb_user_sale')){
                            $f_turn = ($arr_up['turnover']*$class_r->f_class)/100;
                            $fturn = number_format($f_turn, 2);
                            $this->db->set('sale_credit', 'sale_credit + ' . $fturn, FALSE)->where('id', $userid)->update('tb_user');
                            $log = $this->db->where('user_id', $userid)->where('date_to', $curdate)->get('log_cal_affiliate');
                            if($log->num_rows() >= 1){
                                $this->db->set('aff_turn', 'aff_turn + ' . $fturn, FALSE)->where('user_id', $userid)->where('date_to', $curdate)->update('log_cal_affiliate');
                            }else{
                                $this->db->set('user_id', $userid)->set('aff_turn', 'aff_turn + ' . $fturn, FALSE)->set('date_to', $curdate)->set('date_from', $lastdate)->set('status', 1)->insert('log_cal_affiliate');
                            }
                        }
                    }
                    
                }
                

      
            if($dt_q >= 1){
            $n=0;
            foreach($dt_u as $du){

                
                $u_class = $this->db->select('tb_user.user, tb_user_sale.user_id')
                            ->join('tb_user', 'tb_user.id = tb_user_sale.user_id')
                            ->where('tb_user_sale.sale_userid', $du['user_id'])
                            ->get('tb_user_sale');
                $s_class = $u_class->result_array();
                $q_class = $u_class->num_rows();
                
                    $user = $du['user'];
                    $id = $du['user_id'];

                    $arr_up = $this->get_trunover($user, $curdate, $lastdate);
                    $turn = number_format($arr_up['turnover'],2);
                    if($this->db->where('user_id', $id)->update('tb_user_sale', $arr_up)){
                            $s_turn = ($arr_up['turnover']*$class_r->s_class)/100;
                            $sturn = number_format($s_turn, 2);
                            $this->db->set('sale_credit', 'sale_credit + ' . $sturn, FALSE)->where('id', $userid)->update('tb_user');
                            $log = $this->db->where('user_id', $userid)->where('date_to', $curdate)->get('log_cal_affiliate');
                            if($log->num_rows() >= 1){
                                $this->db->set('aff_turn', 'aff_turn + ' . $sturn, FALSE)->where('user_id', $userid)->where('date_to', $curdate)->update('log_cal_affiliate');
                            }else{
                                $this->db->set('user_id', $userid)->set('aff_turn', 'aff_turn + ' . $sturn, FALSE)->set('date_to', $curdate)->set('date_from', $lastdate)->set('status', 1)->insert('log_cal_affiliate');
                            } 
                    }
         
                if($q_class >= 1){
                $y=0;
                foreach($s_class as $sc){
                   
//1597622400
                        $user = $sc['user'];
                        $id = $sc['user_id'];

                        $arr_up = $this->get_trunover($user, $curdate, $lastdate);
                        if($this->db->where('user_id', $id)->update('tb_user_sale', $arr_up)){
                                $t_turn = ($arr_up['turnover']*$class_r->t_class)/100;
                                $tturn = number_format($t_turn, 2);
                                $this->db->set('sale_credit', 'sale_credit + ' . $tturn, FALSE)->where('id', $userid)->update('tb_user');
                                $log = $this->db->where('user_id', $userid)->where('date_to', $curdate)->get('log_cal_affiliate');
                                if($log->num_rows() >= 1){
                                    $this->db->set('aff_turn', 'aff_turn + ' . $tturn, FALSE)->where('user_id', $userid)->where('date_to', $curdate)->update('log_cal_affiliate');
                                }else{
                                    $this->db->set('user_id', $userid)->set('aff_turn', 'aff_turn + ' . $tturn, FALSE)->set('date_to', $curdate)->set('date_from', $lastdate)->set('status', 1)->insert('log_cal_affiliate');
                                }  
                        }
                        $re = array('code'=> 1,'msg'=>'อัพเดตล่าสุดแล้ว 4');
                        

                    $y++;
                }
                }else{

                    $re = array('code'=> 1,'msg'=>'อัพเดตล่าสุดแล้ว 2');

                }
                
                
                $n++;
            }
            }else{
                $re = array('code'=> 1,'msg'=>'อัพเดตล่าสุดแล้ว 1');
            }  
            $i++;
        }
        }else{

            $re = array('code'=> 1, 'msg'=> 'ไม่มียูสเซอร์ในเครือข่ายของคุณ');
        }
        

        echo json_encode($re);
        die();
  
    }

        
   
        public function get_trunover($user, $curdate, $lastdate){

            
            $check_ven = $this->db->where('check_turn',1)->get('tb_vendor')->result_array();
            
            // print_r($lastdate);
            // die();
           //ztzz361i00207
                $vendor = [];
               
                    foreach ($check_ven as $k => $cv) {
                        array_push($vendor,$cv['vendor_id']);
                    }   

                $datavenderDate = json_encode(array(
                    "venders"=> $vendor,
                    "to"=> $curdate, 
                    "from"=> $lastdate
                ));
                         
                $turn = json_decode($this->getapi_model->call_API_mongo('turnover/venders/user/'.$user.'/date',$datavenderDate, "POST")) ;//ตัวใหม่ดึงผลรวม
                // echo '<pre>';print_r($turn);
                // die();
                $arr_up = array(
                    'turnover' => $turn->totalTurnover,
                    'winloss' => $turn->totalUserWinLoss,
                    'last_date' => $curdate
                );
                
                return $arr_up;
                   
   

        }
            
        public function affiliate(){

            $userid = $this->input->post('user_id');
            $credit = $this->db->select('user, sale_credit')->where('id', $userid)->get('tb_user')->row();
            $check_sw = $this->db->where('name', 'switch_affiliate')->where('status', '1')->get('setting')->result_array(); //0=close, 1=open auto add credit
            if($credit->sale_credit != 0){
              if($check_sw){  
                $amount_out = $credit->sale_credit;
                $amount = $this->get_credit($credit->user);
                $result = $this->deposit($credit->user,$amount_out,$amount);
                if($result['code'] == 1){
                    $arr_set = array(
                        'date_user' => time(),
                        'user_id' => $userid,
                        'amount' => $credit->sale_credit,
                        'status' => 2
                        
                    );
                    if($this->db->insert('tb_user_sale_credit', $arr_set)){
                        if($this->db->set('sale_credit', '0')->where('id', $userid)->update('tb_user')){
                            $re = array('code'=>1, 'msg'=>'ทำรายการสำเร็จ');
                        }
                    }
                }
              }else{

                $arr_credit = array(
                    'date_user' => time(),
                    'user_id' => $userid,
                    'amount' => $credit->sale_credit,
                    'status' => 1
                );

                if($this->db->insert('tb_user_sale_credit', $arr_credit)){
                    if($this->db->set('sale_credit', '0')->where('id', $userid)->update('tb_user')){
                        $re = array('code' => 1, 'title'=> 'ร้องขอสำเร็จ', 'msg'=> 'กรุณารออนุมัติ');
                    }
                }
             }
            }else{
                $re = array('code' => 2, 'msg'=> 'กรุณาเช็คยอดเงินก่อนทำรายการ');
            }
                
            echo json_encode($re);
            die();    
           
        }

        public function report_aff(){

            $statement = $this->db->select('amount, date_user,status')->where('user_id', $this->session->member->id)->order_by('date_user', 'DESC')->get('tb_user_sale_credit')->result_array();


            $data_st = array(
                'statement' => $statement
            );

            $this->load->view('report_aff', $data_st);
        }

        function deposit($user,$amount,$credit_last){
		
		//เริ่มต้น API Deposit สำหรับ Agent Betclic
		$user_q = $this->db->select('user,id')->where('user',$user)->where('status',1)->get('tb_user');
		if($user_q->num_rows() == 1){
			$user_r = $user_q->row();
			$arr_depAPI = array(
				'AgentName' 	=> $this->getapi_model->agent(),
				'PlayerName' 	=> $user_r->user,
				'Amount' 		=> $amount,
				'TimeStamp' 	=> time()
			);
			$dataAPI = array(
				'type'		=> 'D',
				'agent' 	=> $this->getapi_model->agent(),
				'member' 	=> $user_r->user,
            );
          
			$url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
			$cre_userAPI =  $this->getapi_model->getapi($arr_depAPI,$url_api,$dataAPI);
           
			if($cre_userAPI->Success == 1){
				$arr_log_d = array(
					'user_id'	=> $user_r->id,
					'admin_id'	=> 0,
					'type'		=> 1, // type in
					'amount'	=> $amount,
					'credit_last' 	=> $credit_last,
					'credit_result' => $this->get_credit($user_r->user),
					'create_time'	=> time(),
					'status'		=> 1
				);
				if($this->db->insert('log_credit',$arr_log_d)){
					$re = array('code'=>1,'msg'=>'004');
				}else{
					$re = array('code'=>0 ,'msg'=> '003');
				}
			}else{
				$re = array('code'=>0 ,'msg'=> '002');
			}
		}else{
			$re = array('code'=>0 ,'msg'=> '001');
		}	
		return $re;
    }
    
    public function get_credit($user){

        $arr_userAPI = array(
            'AgentName' => $this->getapi_model->agent(),
            'PlayerName' => $user,
            'TimeStamp' => time() 
        );

        $dataAPI = array(
            'type' => 'D',
            'agent' => $this->getapi_model->agent(),
            'member' => $user
        );
        
        $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
        $cre_userAPI = $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);

        if($cre_userAPI->Error == 0){
			$amount = $cre_userAPI->Balance;
		}else{
			$amount = $cre_userAPI->Message;
		}
		return $amount;
    }

        

        
}
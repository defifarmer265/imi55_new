<?php
class Wd extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model( 'getapi_model' );
        $this->load->model( 'withdraw_bbl_model' );
        $this->load->model( 'withdraw_scb_model' );
        $this->load->model( 'api/Api_user_model' );
//        $this->load->model( 'True_wd_model' );
        $this->load->library( 'backend/backend_library' );
        $this->_init();
    }
    private function _init() {
        $this->output->set_template( 'tem_admin/tem_admin' );
        $this->backend_library->checkLoginAdmin();
    }
    public function index() 
    {
        $data[ 'withdraw' ] = $this->db->select( 'tb_withdraw.*,tb_user.user,tb_user.username,tb_bank.bank_short' )->join( 'tb_user', 'tb_user.id = tb_withdraw.user_id' )->join( 'tb_bank', 'tb_bank.api_id = tb_withdraw.bank_api' )->order_by( 'tb_withdraw.id', 'DESC' )->limit( 500 )->get( 'tb_withdraw' )->result_array();
        $i = 0;

        foreach ( $data[ 'withdraw' ] as $wd ) {
            if ( $wd[ 'admin_cf' ] != 0 ) {
                $data[ 'withdraw' ][ $i ][ 'admin_Fname' ] = $this->db->select( 'tb_login.username' )->where( 'id', $wd[ 'admin_cf' ] )->get( 'tb_login' )->row()->username;
            } else {
                $data[ 'withdraw' ][ $i ][ 'admin_Fname' ] = '';
            }

            if ( $wd[ 'admin_check' ] != 0 ) {
                $data[ 'withdraw' ][ $i ][ 'admin_Cname' ] = $this->db->select( 'tb_login.username' )->where( 'id', $wd[ 'admin_check' ] )->get( 'tb_login' )->row()->username;
            } else {
                $data[ 'withdraw' ][ $i ][ 'admin_Cname' ] = '';
            }

            if ( $wd[ 'bank_web_id' ] != 0 ) {
                $data[ 'withdraw' ][ $i ][ 'bw' ] = $this->db->select( 'tb_bank_web.name' )->where( 'id', $wd[ 'bank_web_id' ] )
                    //														->where('status !=',0)
                    ->get( 'tb_bank_web' )->row()->name;
            } else {
                $data[ 'withdraw' ][ $i ][ 'bw' ] = '';
            }

            $i++;
        }

        $statusBW = array( 1, 3 ); //1 open 3 auto
        $data[ 'bankweb' ] = $this->db->select( 'tb_bank_web.*,tb_bank.bank_short' )->join( 'tb_bank', 'tb_bank.id = tb_bank_web.bank_id' )->where( 'tb_bank_web.type', 2 )->where( 'tb_bank_web.id !=', 26 )->where( 'tb_bank_web.id !=', 27 )->where( 'status !=', 0 )->where_in( 'tb_bank_web.status', $statusBW )->get( 'tb_bank_web' )->result_array();
        $k = 0;
        $status_true = array( '1', '2', '3' );
        $sum = 0;
        foreach ( $data[ 'bankweb' ] as $b ) {

            $row_ste = $this->db->select( 'SUM(deposit) as sum_dps , SUM(withdraw) as sum_wd' )->where_in( 'status', $status_true )->where( 'bank_id', $b[ 'id' ] )->get( 'tb_statement' )->row();
            $sum = $row_ste->sum_dps - $row_ste->sum_wd;
            $data[ 'bankweb' ][ $k ][ 'sum' ] = $sum;
            $k++;
        }
        //		echo '<pre>';
        //		print_r($data['withdraw']);die();
        $this->load->view( 'wd', $data );
    }
    
    // ทำรายการโอน
    // 1
    public function see_wd() 
    {
        $wit_id = $this->input->post( 'id' );
        $user_id = $this->db->select( 'user_id' )->where( 'id', $wit_id )->get( 'tb_withdraw' )->row()->user_id;
        if ( $user_id ) {
            $user_q = $this->db->select( 'user,id' )->where( 'id', $user_id )->where( 'status', 1 )->get( 'tb_user' );

            if ( $user_q->num_rows() == 1 ) {
                $user_r = $user_q->row();
                $sta_r = $this->db->select( 'datetime,deposit,withdraw' )->where( 'user_id', $user_r->id )->where( 'status', 2 )->order_by( 'id', 'DESC' )->limit( '10' )->get( 'tb_statement' )->result_array();

                $wd_history = $this->Api_user_model->wd_history( $user_r->user )->Result->Records;
                $i = 0;
                foreach ( $wd_history as $key => $value ) {
                    $datetime = strtotime( $value->CreationTime ) - 3600;
                    $wd_history[ $i ]->datetime = $datetime;
                    if ( $value->Amount > 0 ) {
                        $wd_history[ $i ]->success = $this->db->select( 'id' )->where( 'user_id', $user_id )->where( 'deposit', $value->Amount )->where( 'datetime <=', $datetime )->where( 'datetime >', $datetime - 600 )->order_by( 'id', 'DESC' )->limit( 1 )->get( 'tb_statement' )->num_rows();
                    } else {
                        $wd_history[ $i ]->success = 2;
                    }
                    $i++;
                }

                $re = array( 'code' => 0, 'sta_r' => $sta_r, 'api_wdhistory' => $wd_history, 'msg' => '0022' );
            } else {
                $re = array( 'code' => 0, 'data' => '', 'msg' => '0022' );
            }
        } else {
            $re = array( 'code' => 0, 'data' => '', 'msg' => '0011' );
        }
        echo json_encode( $re );
        die();
    }
    // 2
    public function get_BW() 
    {
        if ( $bw_id = $this->input->post( 'bw_id' ) ) {
            $id = $this->input->post( 'id' );
            $status_true = array( '1', '2', '3' );
            $bw = $this->db->select( 'SUM(tb_statement.deposit) as sum_dps , SUM(tb_statement.withdraw) as sum_wd,tb_bank_web.*,tb_withdraw.amount' )->join( 'tb_statement', 'tb_statement.bank_id = tb_bank_web.id', 'left' )->join( 'tb_withdraw', 'tb_withdraw.id =' . $id )->where( 'tb_bank_web.id', $bw_id )->where_in( 'tb_statement.status', $status_true )->get( 'tb_bank_web' )->row();
            $bank = $this->db->where( 'id', $bw->bank_id )->get( 'tb_bank' )->row();
            //			print_r($bw);
            //			die();
            $sum = $bw->sum_dps - $bw->sum_wd;
            if ( $sum > $bw->amount ) {
                if ( $bw->status == 3 ) {
                    $re = array( 'code' => 1, 'title' => 'ถอนด้วย AUTO', 'msg' => "โอนออกจาก : " . $bw->name . "\n" . $bw->account . " [" . $bank->bank_short . "]" );
                } else {
                    $re = array( 'code' => 2, 'title' => 'ยืนยันการถอน', 'msg' => 'กรุณาโอนออกตามบัญชีที่ระบุ' );
                }
            } else {
                $re = array( 'code' => 0, 'title' => 'ยอดเงินหมด', 'msg' => 'ยอดเงินไม่เพียงพอต่อการถอน' );
            }
        } else {
            $re = array( 'code' => 0, 'title' => 'ไม่สำเร็จ', 'msg' => 'ข้อมูลไม่ครบถ้วน' );
        }
        echo json_encode( $re );
        die();
    }
    // 3
    public function Verify() 
    {

        if ( $this->input->post( 'type' ) && $this->input->post( 'id' ) ) {
            $type = $this->input->post( 'type' );
            $withdraw_id = $this->input->post( 'id' );
            $bankweb_id = $this->input->post( 'bw_id' );

            $withdraw_r = $this->db->where( 'id', $withdraw_id )->get( 'tb_withdraw' )->row();
            $bankweb_r = $this->db->where( 'id', $bankweb_id )->get( 'tb_bank_web' )->row(); //ดึงข้อมูลธนาคารเว็บ
            $user_r = $this->db->where( 'id', $withdraw_r->user_id )->get( 'tb_user' )->row();
            $arr_wd = array( //เซฟว่าแอดมินคนไหนทำงาน
                'admin_cf' => $this->session->admin[ 'id' ],
                'admin_cfTime' => time(),
                'bank_web_id' => $bankweb_r->id,
            );
            if ( $this->db->where( 'id', $withdraw_r->id )->update( 'tb_withdraw', $arr_wd ) ) {
                if ( $type == 'check' ) {

                    if ( $bankweb_r->bank_id == 5 ) { //SCB  
                        $login_scb = $this->withdraw_scb_model->login( $bankweb_id );
                        if ( $login_scb != '' ) {
                            $vertify = $this->withdraw_scb_model->getVerify( $login_scb, $withdraw_r->account, $withdraw_r->bank_api, $withdraw_r->amount, $bankweb_r->account );
                            
                            if ( $user_r->name == '' ) { //save name user
                                $data_up_name = array(
                                    'name' => $vertify[ 'data' ][ 'accountToName' ]
                                );
                                $this->db->where( 'id', $withdraw_r->user_id );
                                $this->db->update( 'tb_user', $data_up_name );
                            }

                            $data_return = [
                                'toname' => $vertify[ 'data' ][ 'accountToName' ],
                                'toaccount' => $vertify[ 'data' ][ 'accountTo' ],
                                'tobank' => $vertify[ 'data' ][ 'accountToBankCode' ],
                                'amount' => $withdraw_r->amount,
                                'bank_id' => '014',
                            ];
                            echo json_encode( array( 'code' => '1', 'msg' => 'success', 'data' => $data_return ) );

                        } else {
                            echo json_encode( array( 'code' => '000', 'msg' => 'SCB Fail : ระบบไม่สามารถเชื่อมต่อกับระบบธนาคารได้' ) );
                        }

                    } else if ( $bankweb_r->bank_id == 3 ) { //BBL
                        $vertify = json_decode( $this->withdraw_bbl_model->Check( $withdraw_r->account, intval( $withdraw_r->bank_api ), 1, $bankweb_id ) );
                        $vertify->accountToBankCode = $withdraw_r->bank_api;

                        if ( $vertify->status == true ) {
                            $data_return = [
                                'toname' => $vertify->message->name,
                                'toaccount' => $vertify->message->accnum,
                                'tobank' => $vertify->accountToBankCode,
                                'amount' => $withdraw_r->amount,
                                'bank_id' => '002',
                            ];
                            echo json_encode( array( 'code' => '1', 'msg' => 'success', 'data' => $data_return ) );

                        } else {
                            

                            echo json_encode( array( 'code' => '000', 'msg' => 'BBL Fail : ระบบไม่สามารถเชื่อมต่อกับระบบธนาคารได้' ) );
                        }

                    }
                    //                else if($withdraw_r->bank_api == '999' ){ //True wallet
                    //
                    //						$ver_true = $this->True_wd_model->DraftTransferP2P($withdraw_r->account,$withdraw_r->amount);
                    //
                    //						if ($user_r->name == '') {
                    //							$data_up_name = array( 
                    //								'name'	=> $ver_true['data']['recipient_name']
                    //							);
                    //							$this->db->where('id', $withdraw_r->user_id);
                    //							$this->db->update('tb_user', $data_up_name);
                    //						}
                    //
                    //						 if($ver_true['code'] == 'TRC-200'){
                    //						 	echo json_encode(array('data' =>$ver_true,'amt'=>$withdraw_r->amount,'code' =>'999', 'data_bank_web' => $bankweb_r ,'bank_id' => '999'));
                    //						}else{
                    //							echo json_encode(array('data' =>$ver_true['data'],'code' =>'000'));
                    //						}
                    //						die();
                    //				
                } else {
                    echo json_encode( array( 'code' => '000', 'msg' => ' Fail : type != check ติดต่อโปรแกรมเมอร์' ) );
                }
            } else {
                echo json_encode( array( 'code' => '000', 'msg' => ' Fail : ไม่สามารถบันทึกผู้ตรวจสอบได้' ) );
            }


        } else {
            echo json_encode( array( 'code' => '000', 'msg' => ' Fail : inpost == null' ) );
        }
        die();
    }
    // 4
    public function frim_auto() 
    {
        
        if ( $this->input->post( 'bw_id' ) && $this->input->post( 'id' ) ) {

            $withdraw_id    = $this->input->post( 'id' );
            $bankweb_id     = $this->input->post( 'bw_id' );

            $withdraw_r     = $this->db->where( 'id', $withdraw_id )->get( 'tb_withdraw' )->row();
            $bankweb_r      = $this->db->where( 'id', $bankweb_id )->get( 'tb_bank_web' )->row(); //ดึงข้อมูลธนาคารเว็บ
            $user_r         = $this->db->where( 'id', $withdraw_r->user_id )->get( 'tb_user' )->row();
            $bank_r         = $this->db->where( 'api_id', $withdraw_r->bank_api )->get( 'tb_bank' )->row();
            
            if($withdraw_r->admin_cf == $this->session->admin[ 'id' ]){
                
                if($bankweb_r->bank_id == 3){ // BBL
                    
                    $wd_bbl_auto = json_decode( $this->withdraw_bbl_model->Verify( $withdraw_r->account, intval( $withdraw_r->bank_api ), $withdraw_r->amount ,$bankweb_id) ); // send withdraw bbl
                    if ( $wd_bbl_auto->status == true ) {
                        
                        $arr_state_wd = array(
                            'bank_id'       => $bankweb_r->id,
                            'datetime'      => $withdraw_r->time,
                            'deposit'       => '0.00',
                            'withdraw'      => $withdraw_r->amount,
                            'fee'           => '0.00',
                            'note'          => 'withdraw auto @' . $bankweb_r->account,
                            'dateCreate'    => time(),
                            'from_name'     => $user_r->user,
                            'from_account'  => $withdraw_r->account,
                            'from_bank'     => $bank_r->bank_short,
                            'user_id'       => $user_r->id,
                            'deposit_id'    => 0,
                            'withdraw_id'   => $withdraw_r->id,
                            'admin_id'      => $this->session->admin[ 'id' ],
                            'status'        => 2,
                        );
                        $this->db->insert( 'tb_statement', $arr_state_wd ); // insert to sb_statement 
                        $this->notify_line( $withdraw_r->time, $user_r->user, $withdraw_r->amount );
                        $this->db->set('status',2)->set('bank_web_id',$bankweb_id)->where( 'id', $withdraw_r->id )->update( 'tb_withdraw'); // update status tb_withdraw
                        
                        $token_line_id = $this->db->select( 'line_id' )->from( 'tb_line' )->where( 'tb_line.tel', $user_r->username )->get()->row();
                        if ( !empty( $token_line_id ) ) {
                            $this->line_push_wd( $token_line_id->line_id, $withdraw_r->amount ); //push line bot withdraw
                        }
                        $re = array( 'code' => 1, 'msg' => $wd_bbl_auto->message );
                    } else {
                        $re = array( 'code' => 0, 'msg' => 'ถอน auto false' );
                    }
                }else if($bankweb_r->bank_id == 5){ // SCB
                    $login_scb = $this->withdraw_scb_model->login( $bankweb_id );
                    if ( $login_scb != '' ) {
                        $wd_scb_auto = $this->withdraw_scb_model->Transfer( $login_scb, $withdraw_r->account, $withdraw_r->bank_api, $withdraw_r->amount, $bankweb_r->account );
                        if ( $wd_scb_auto ) {

                            $arr_state_wd = array(
                                'bank_id'       => $bankweb_r->id,
                                'datetime'      => $withdraw_r->time,
                                'deposit'       => '0.00',
                                'withdraw'      => $withdraw_r->amount,
                                'fee'           => '0.00',
                                'note'          => 'withdraw auto @' . $bankweb_r->account,
                                'dateCreate'    => time(),
                                'from_name'     => $user_r->user,
                                'from_account'  => $withdraw_r->account,
                                'from_bank'     => $bank_r->bank_short,
                                'user_id'       => $user_r->id,
                                'deposit_id'    => 0,
                                'withdraw_id'   => $withdraw_r->id,
                                'admin_id'      => $this->session->admin[ 'id' ],
                                'status'        => 2,
                            );
                            $this->db->insert( 'tb_statement', $arr_state_wd ); // insert to sb_statement 
                            $this->notify_line( $withdraw_r->time, $user_r->user, $withdraw_r->amount );
                            $this->db->set('status',2)->set('bank_web_id',$bankweb_id)->where( 'id', $withdraw_r->id )->update( 'tb_withdraw'); // update status tb_withdraw

                            $token_line_id = $this->db->select( 'line_id' )->from( 'tb_line' )->where( 'tb_line.tel', $user_r->username )->get()->row();
                            if ( !empty( $token_line_id ) ) {
                                $this->line_push_wd( $token_line_id->line_id, $withdraw_r->amount ); //push line bot withdraw
                            }
                            $re = array( 'code' => 1, 'msg' => 'สำเร็จ' );
                        } else {
                            $re = array( 'code' => 0, 'msg' => 'ถอน ไม่สำเร็จ  SCB model Transfer false' );
                        }
                    }else{
                        $re = array( 'code' => 0, 'msg' => 'ถอน ไม่สำเร็จ  SCB model login false' );
                    }
                }else if ($withdraw_r->bank_api == '999'){ // true wallet
                        //////////////////
                    ///////////////////////
                    /////////////////////////
                    //////////////////////////
                    ///////////////////////////////
                    
                } else{
                    echo json_encode( array( 'code' => '000', 'msg' => ' Fail : Bank_id not BBL or SCB' ) );
                }
            }else{
                $admin_r   = $this->db->where( 'id', $withdraw_r->admin_cf )->get( 'tb_login' )->row();
                $re = array( 'code' => '000', 'msg' => ' Fail : Admin ตรวจสอบเปลี่ยนคนเป็น :'.$admin_r->name ) ;
            }

        }else{
            $re = array( 'code' => '000', 'msg' => ' Fail :input post == null ' ) ;
        }
        echo json_encode($re);
		die();
    }
    public function admin_check() //สำหรับเฟริมทั่วไป ไม่ใช่ออโต้
    { 
        if ( $this->input->post( 'bw_id' ) && $this->input->post( 'id' ) ) {

            $withdraw_id    = $this->input->post( 'id' );
            $bankweb_id     = $this->input->post( 'bw_id' );
            
            $withdraw_r     = $this->db->where( 'id', $withdraw_id )->get( 'tb_withdraw' )->row();
            $bankweb_r      = $this->db->where( 'id', $bankweb_id )->get( 'tb_bank_web' )->row(); //ดึงข้อมูลธนาคารเว็บ
            $user_r         = $this->db->where( 'id', $withdraw_r->user_id )->get( 'tb_user' )->row();
            $bank_r         = $this->db->where( 'api_id', $withdraw_r->bank_api )->get( 'tb_bank' )->row();
            
            if ($this->db->set('status', 4)->where('id', $withdraw_id)->update('tb_withdraw')) {
                $this->db->set('admin_check', $this->session->admin[ 'id' ])->set('bank_web_id',$bankweb_id)->where('id', $withdraw_id)->update('tb_withdraw');
                $arr_state_wd = array(
                    'bank_id'       => $bankweb_r->id,
                    'datetime'      => $withdraw_r->time,
                    'deposit'       => '0.00',
                    'withdraw'      => $withdraw_r->amount,
                    'fee'           => '0.00',
                    'note'          => 'withdraw auto @' . $bankweb_r->account,
                    'dateCreate'    => time(),
                    'from_name'     => $user_r->user,
                    'from_account'  => $withdraw_r->account,
                    'from_bank'     => $bank_r->bank_short,
                    'user_id'       => $user_r->id,
                    'deposit_id'    => 0,
                    'withdraw_id'   => $withdraw_r->id,
                    'admin_id'      => $this->session->admin[ 'id' ],
                    'status'        => 2,
                );
                $this->db->insert( 'tb_statement', $arr_state_wd ); // insert to sb_statement 
                $this->notify_line( $withdraw_r->time, $user_r->user, $withdraw_r->amount );


                $token_line_id = $this->db->select( 'line_id' )->from( 'tb_line' )->where( 'tb_line.tel', $user_r->username )->get()->row();
                if ( !empty( $token_line_id ) ) {
                    $this->line_push_wd( $token_line_id->line_id, $withdraw_r->amount ); //push line bot withdraw
                }
                      
                $re = array('code' => 1, 'msg' => 'สำเร็จ');
            } else {
                $re = array( 'code' => '000', 'msg' => ' Fail : update ' ) ;
            }
        }else{
            $re = array( 'code' => '000', 'msg' => ' Fail :input post == null ' ) ;
        }
        echo json_encode($re);
		die();
        
    }
    public function admin_cf() //สำหรับเฟริมทั่วไป ไม่ใช่ออโต้
    { 
        if ($this->input->post( 'id' ) ) {

            $withdraw_id    = $this->input->post( 'id' );
            if ($this->db->set('status', 2)->where('id', $withdraw_id)->update('tb_withdraw')) {
                $this->db->set('admin_cf', $this->session->admin[ 'id' ])->set('admin_cfTime',time())->where('id', $withdraw_id)->update('tb_withdraw');
                $re = array('code' => 1, 'msg' => 'สำเร็จ');
            } else {
               $re = array( 'code' => '000', 'msg' => ' Fail : update ' ) ;
            }
        }else{
             $re = array( 'code' => '000', 'msg' => ' Fail :input post == null ' ) ;
        }
        echo json_encode($re);
		die();
        
    }
    public function line_push_wd( $token_line, $amt ) {
        $curl = curl_init();
        curl_setopt_array( $curl, array(
            CURLOPT_URL => "https://imi55.com:3031/push_withdraw",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "line_id=" . $token_line . "&message= ถอนเงิน " . $amt . " บาท สำเร็จ",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ) );

        $response = curl_exec( $curl );

        curl_close( $curl );
    }

    public function cancel_withdraw() {
        if($this->input->post( 'id' )){
            $withdraw_id    = $this->input->post( 'id' );

            $withdraw_r     = $this->db->where( 'id', $withdraw_id )->get( 'tb_withdraw' )->row();
            $user_r         = $this->db->where( 'id', $withdraw_r->user_id )->get( 'tb_user' )->row();
            
            $arr_wd = array(
                'admin_check' => $this->session->admin[ 'id' ],
                'admin_cf' => $this->session->admin[ 'id' ],
                'admin_cfTime' => time(),
                'bank_web_id' => 0,
                'status' => 3,

            );
            $arr_userAPI = array(
                'AgentName'	=> $this->getapi_model->agent(),
                'PlayerName' => $user_r->user,
                'Amount'	=> $withdraw_r->amount,
                'TimeStamp'	=> time()

            );
            $dataAPI = array(
                'type'		=> 'D',
                'agent' 	=> $this->getapi_model->agent(),
                'member' 	=> $user_r->user,
            );
            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
            $cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
            if ($cre_userAPI->Success == 1) {
                 if($this->db->where( 'id', $this->input->post( 'id' ) )->update( 'tb_withdraw', $arr_wd )){
                    $re = array('code' => 1, 'msg' => 'สำเร็จ');
                }else{
                    $re = array( 'code' => '000', 'msg' => ' Fail : update ' ) ;
                }
            }else{
                $re = array( 'code' => '000', 'msg' => ' Credit : add to user null' ) ;
            }
        }else{
            $re = array( 'code' => '000', 'msg' => ' Fail :input post == null ' ) ;
        }
        echo json_encode($re);
        die();
        
    }

    function notify_line( $wd_time, $user, $amount ) {
        if ( $lnfy = $this->db->where( 'type', 'withdraw' )->get( 'tb_linenotify' )->row() ) {
            if ( $lnfy->token != '' ) {
                $wd_delay = time() - $wd_time;
                $delay = $lnfy->delay * 60;
                if ( $amount >= $lnfy->balance || $wd_delay > $delay ) {

                    $messageNofity = 'ถอนสำเร็จ รหัส:' . substr( $user, -6 ) . ' จำนวน:' . $amount . ' ใช้เวลา:' . ( number_format( $wd_delay / 60 ) ) . 'นาที';
                    $curl = curl_init();
                    curl_setopt_array( $curl, array(
                        CURLOPT_URL => "https://notify-api.line.me/api/notify",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/x-www-form-urlencoded",
                            "Authorization: Bearer " . $lnfy->token
                        ),
                    ) );

                    $response = curl_exec( $curl );
                    curl_close( $curl );
                }
            }
        }
    }
    public function re_widthdraw() {

        if ( $this->input->post( 'id' ) ) {
            $name_admin = $this->session->userdata[ 'users' ][ 'name' ];
            $id = $this->input->post( 'id' );
            $text = $name_admin . ' รีรายการถอนที่ ' . $id;
            $res = $this->db->set( 'status', 4 )->where( 'withdraw_id', $id )->update( 'tb_statement' );

            if ( $res ) {
                $res_stm = $this->db->set( 'status', 1 )->where( 'id', $id )->update( 'tb_withdraw' );
                if ( $res_stm ) {
                    $array_log_rewithdraw = array(
                        'admin_id' => $this->session->userdata[ 'users' ][ 'id' ],
                        'data_log' => $text,
                        'time_log' => strtotime( date( 'Y-m-d H:i:s' ) ),

                    );
                    $this->db->insert( 'log_safecode', $array_log_rewithdraw );
                    $re = array( 'msg' => 'เรียบร้อย', 'code' => 1, 'title' => 'สำเร็จ' );
                }
            }
        } else {
            $re = array( 'msg' => 'กรุณากรอกข้อมูลให้ครบถ้วน', 'code' => 0, 'title' => 'ไม่สำเร็จ' ); //Error
        }
        echo json_encode( $re );
        die();
    }
    // Log withdraw
    public function log_withdraw( $action, $detail, $withdraw_db_id, $withdraw_api_id ) {
        $arr_logState = array(
            'action' => $action,
            'detail' => $detail,
            'withdraw_db_id' => $withdraw_db_id,
            'withdraw_api_id' => $withdraw_api_id,
            'datetime' => time(),
            'admin_id' => $this->session->userdata[ 'users' ][ 'id' ],
        );
        $this->db->insert( 'log_withdraw', $arr_logState );
    }


}
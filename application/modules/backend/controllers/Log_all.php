<?php
class Log_all extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->model('sum_state');
        $this->load->library('backend/backend_library');
        $this->_init();
    }

    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }
    //-----------------------------------------------------------------------------ส่วนของ log ------------------------------------------------
    // ส่วนนี้สำหรับเรียกหน้า log all เพื่อดูเมนูที่มี
    public function all_log()
    {
        $this->load->view('history_log');
    }

    // log admin
    public function search_admin()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $admin = $this->db->select('log_login.*,tb_login.name,tb_login.username')
            ->join('tb_login', 'tb_login.id = log_login.admin_id', 'left')

            ->where('log_login.time_login >=', $date_start)
            ->where('log_login.time_login <=', $date_end)
            ->order_by('log_login.id', 'DESC')
            ->get('log_login')->result_array();
        $k = 0;
        foreach ($admin as $r) {
            // echo '<pre>';
            // print_r($r);
            // die;
            if ($r['name'] == '') {
                $admin[$k]['name'] = '-';
            } else {
                $admin[$k]['name'] = $r['name'];
            }

            $admin[$k]['time_login'] =  date('d/m/Y H:i:s', $r['time_login']);


            if ($r['time_logout'] == '') {
                $admin[$k]['time_logout'] = '-';
            } else {
                $admin[$k]['time_logout'] = date('d/m/Y H:i:s', ((int)$r['time_logout']));
            }



            $k++;
        }


        $re = array('code' => 1, 'data' => $admin);
        echo json_encode($re);
        die();
    }
    // end admin



    // log sale
    public function search_sale()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $sale   =     $this->db->select('log_sale.*,tb_sale.name as sale_name')
            ->join('tb_sale', 'tb_sale.id = log_sale.sale_id', 'left')
            ->where('log_sale.datetime >=', $date_start)
            ->where('log_sale.datetime <=', $date_end)
            ->get('log_sale')->result_array();
        $k = 0;
        foreach ($sale as $sa) {
            $sale[$k]['datetime'] = date('d-m-Y H:i:s', $sa['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $sale);
        echo json_encode($re);
        die();
    }
    // end log sale



    // log นี้ใช้สำหรับแสดงการ login ของ user 
    public function search_user()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $user  = $this->db->select('id,user_id,ip,platform, COUNT(platform)as countPlatform,create_time')
            ->where('create_time >=', $date_start)
            ->where('create_time <=', $date_end)
            ->group_by('user_id')
            ->group_by('ip')
            ->order_by('id', 'DESC')
            ->get('log_user_login')->result_array();
        $k = 0;
        foreach ($user as $u) {
            // $user[$k]['user'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
            $user[$k]['user_id'] = $u['user_id'];
            $user[$k]['createtime'] = date('d-m-Y H:i:s', $u['create_time']);

            $k++;
        }
        $re = array('code' => 1, 'data' => $user);
        echo json_encode($re);
        die();
    }
    //  end log user





    // log นี้ใช้สำหรับแสดง การ add turn ที่ table   log_add_turn  tb_login 


    public function search_addtrun()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_edit_user_turn = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'DESC')->get('log_edit_user_turn')->result_array();
        $k = 0;
        foreach ($log_edit_user_turn as $b) {
            
            if ($b['detail'] == '') {
                $log_edit_user_turn[$k]['detail'] = '-';
            } else {
                $log_edit_user_turn[$k]['detail'] = $b['detail'];
            }
            $log_edit_user_turn[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_edit_user_turn);
        echo json_encode($re);
        die();
    }


    // end log add_turn


    //  log point tbที่ใช้ log_edit_user_point  แสดงประวัติการเพิ่ม ลบ point
    public function search_point()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $point    = $this->db->select('log_edit_user_point.*')
            ->where('log_edit_user_point.datetime >=', $date_start)
            ->where('log_edit_user_point.datetime <=', $date_end)
            ->order_by('log_edit_user_point.datetime', 'DESC')
            ->get('log_edit_user_point')->result_array();
        $k = 0;
        foreach ($point as $u) {
            // $addturn[$k]['user_id'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
            $point[$k]['time'] = date('d-m-Y H:i:s', $u['datetime']);
            $k++;
        }

        $re = array('code' => 1, 'data' => $point);
        echo json_encode($re);
        die();
    }


    //  log credit  tableที่ใชช้  log_edit_user_credit  แสดงการเพิ่มลบ 
    public function search_credit()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $point    = $this->db->select('log_edit_user_credit.*')
            ->where('log_edit_user_credit.datetime >=', $date_start)
            ->where('log_edit_user_credit.datetime <=', $date_end)
            ->where('log_edit_user_credit.action','up')
            ->order_by('log_edit_user_credit.datetime', 'DESC')
            ->get('log_edit_user_credit')->result_array();
        $k = 0;
        foreach ($point as $u) {
            // $addturn[$k]['user_id'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
            $e[]= explode(":", $u['detail']);
            foreach($e as $r){
               
                $old = substr($r[1],0,-4);
                $new = substr($r[2],0,-7);
                $amount = $r[3];
            }
            $point[$k]['old'] = $old;
            $point[$k]['new'] = $new;
            $point[$k]['rs'] = $amount;
            $point[$k]['time'] = date('d-m-Y H:i:s', $u['datetime']);
            $k++;
        }

        $re = array('code' => 1, 'data' => $point);
        echo json_encode($re);
        die();
    }
    // search_delete_credit
    public function search_delete_credit()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $point    = $this->db->select('log_edit_user_credit.*')
            ->where('log_edit_user_credit.datetime >=', $date_start)
            ->where('log_edit_user_credit.datetime <=', $date_end)
            ->where('log_edit_user_credit.action','down')
            ->order_by('log_edit_user_credit.datetime', 'DESC')
            ->get('log_edit_user_credit')->result_array();
        $k = 0;
        foreach ($point as $u) {
            // $addturn[$k]['user_id'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);
            $e[]= explode(":", $u['detail']);
            foreach($e as $r){
               
                $old = substr($r[1],0,-4);
                $new = substr($r[2],0,-7);
                $amount = $r[3];
            }
            $point[$k]['old'] = $old;
            $point[$k]['new'] = $new;
            $point[$k]['rs'] = $amount;
            $point[$k]['time'] = date('d-m-Y H:i:s', $u['datetime']);
            $k++;
        }

        $re = array('code' => 1, 'data' => $point);
        echo json_encode($re);
        die();
    }

    //  log bank แสดงประวัติการเปลี่ยน เลขบัญชี แก้ไขสถานะ  ใช้  table 4 ตัว ได้แก่้ log_bank  tb_user_bank tb_login  tb_bank
    public function search_logbank()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $tb_bank   = $this->db->select('log_bank.id, log_bank.bank_id,log_bank.action, log_bank.admin_id, log_bank.create_time,
						tb_user_bank.id, tb_user_bank.user_id,  
						tb_user_bank.bank_id, tb_user_bank.name, tb_user_bank.account,
						tb_bank.id, tb_bank.bank_short,
						tb_login.id,tb_login.username
					')
            ->join('tb_user_bank', 'tb_user_bank.id = log_bank.bank_id', 'left')
            ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
            ->join('tb_login', 'tb_login.id = log_bank.admin_id', 'left')
            ->where('log_bank.create_time >=', $date_start)
            ->where('log_bank.create_time <=', $date_end)
            ->order_by('log_bank.create_time', 'desc')
            ->get('log_bank')->result_array();

        $k = 0;
        foreach ($tb_bank as $b) {
            $tb_bank[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['create_time']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $tb_bank);
        echo json_encode($re);
        die();
    }
    //  log edit group เก็บรายละเอียดการแก้ไข group ใช้ table log_bank_edit_group
    public function search_logeditgroup()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_bank_edit = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_bank_edit_group')->result_array();
        $k = 0;
        foreach ($log_bank_edit as $b) {
            $log_bank_edit[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_bank_edit);
        echo json_encode($re);
        die();
    }

    // log การแก้ไข กลุ่ม ธนารคาร users
    public function search_logeditusergroup()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_edit_user_group = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_edit_user_group')->result_array();
        $k = 0;
        foreach ($log_edit_user_group as $b) {
            $log_edit_user_group[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_edit_user_group);
        echo json_encode($re);
        die();
    }

    // log แก้ไขชื่อสมาชิก
    public function search_logeditusername()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_edit_user_name = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_edit_user_name')->result_array();
        $k = 0;
        foreach ($log_edit_user_name as $b) {
            if ($b['detail'] == '') {
                $log_edit_user_name[$k]['detail'] = '-';
            } else {
                $log_edit_user_name[$k]['detail'] = $b['detail'];
            }
            $log_edit_user_name[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_edit_user_name);
        echo json_encode($re);
        die();
    }


    // log edit_user_pass เก็บประวัติการเปลี่ยนรหัสผ่าน
    public function search_edit_user_pass()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_edit_user_name = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_edit_user_pass')->result_array();
        $k = 0;
        foreach ($log_edit_user_name as $b) {
            if ($b['detail'] == '') {
                $log_edit_user_name[$k]['detail'] = '-';
            } else {
                $log_edit_user_name[$k]['detail'] = $b['detail'];
            }
            $log_edit_user_name[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_edit_user_name);
        echo json_encode($re);
        die();
    }

    // log_edit_user_spin
    public function search_edit_user_spin()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_edit_user_name = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_edit_user_spin')->result_array();
        $k = 0;
        foreach ($log_edit_user_name as $b) {
            if ($b['detail'] == '') {
                $log_edit_user_name[$k]['detail'] = '-';
            } else {
                $log_edit_user_name[$k]['detail'] = $b['detail'];
            }
            $log_edit_user_name[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_edit_user_name);
        echo json_encode($re);
        die();
    }

    // log เปิดปิด staus ยูสเซอร
    public function search_log_edit_user_status()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_edit_user_name = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_edit_user_status')->result_array();
        $k = 0;
        foreach ($log_edit_user_name as $b) {
            if ($b['detail'] == '') {
                $log_edit_user_name[$k]['detail'] = '-';
            } else {
                $log_edit_user_name[$k]['detail'] = $b['detail'];
            }
            $log_edit_user_name[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_edit_user_name);
        echo json_encode($re);
        die();
    }
    // log แก้รหัสผ่าน
    public function search_log_edit_user_tel()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_edit_user_name = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_edit_user_username')->result_array();
        $k = 0;
        foreach ($log_edit_user_name as $b) {
            if ($b['detail'] == '') {
                $log_edit_user_name[$k]['detail'] = '-';
            } else {
                $log_edit_user_name[$k]['detail'] = $b['detail'];
            }
            $log_edit_user_name[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_edit_user_name);
        echo json_encode($re);
        die();
    }

    // log bank status
    public function search_log_bank_status()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_bank_status = $this->db->where('datetime >=', $date_start)->where('datetime <=', $date_end)->order_by('datetime', 'desc')->get('log_bank_status')->result_array();
        $k = 0;
        foreach ($log_bank_status as $b) {
            if ($b['detail'] == '') {
                $log_bank_status[$k]['detail'] = '-';
            } else {
                $log_bank_status[$k]['detail'] = $b['detail'];
            }
            $log_bank_status[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_bank_status);
        echo json_encode($re);
        die();
    }


     // log log_checkin
     public function search_logcheckin()
     {
         $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
         $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
         $log_checkin = $this->db->select(' id,user_id,detail,  ,create_time ')
                    ->where('create_time >=', $date_start)
                    ->where('create_time <=', $date_end)
                    ->order_by('create_time', 'desc')
                    ->get('log_checkin')->result_array();
         $k = 0;
         foreach ($log_checkin as $b) {
             $log_checkin[$k]['user'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($b['user_id']))), -6);
             if ($b['detail'] == '') {
                 $log_checkin[$k]['detail'] = '-';
             } else {
                 $log_checkin[$k]['detail'] = $b['detail'];
             }
             $log_checkin[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['create_time']);
             $k++;
         }
         $re = array('code' => 1, 'data' => $log_checkin);
         echo json_encode($re);
         die();
     }


      // log log_owner_login
      public function search_logowner()
      {
          $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
          $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
          $log_owner_login  = $this->db->select('id,owner_id,ip,action,datetime')
                    ->where('datetime >=', $date_start)
                    ->where('datetime <=', $date_end)
                    ->order_by('datetime', 'DESC')
                    ->get('log_owner_login')->result_array();
          $k = 0;
          foreach ($log_owner_login as $b) {

              if($b['action']=='2'){
                $log_owner_login[$k]['detail'] = 'ออจากระบบ โดย ip ::' .$b['ip'];
              }else{
                $log_owner_login[$k]['detail'] = 'การเข้าสู่ระบบ โดย ip ::' .$b['ip'];
              }
             
              $log_owner_login[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
              $k++;
          }
          $re = array('code' => 1, 'data' => $log_owner_login);
          echo json_encode($re);
          die();
      }


    //   Log_deposit
      public function search_Log_deposit()
      {
          $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
          $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
          $log_deposit  = $this->db->select('*')
                    ->where('datetime >=', $date_start)
                    ->where('datetime <=', $date_end)
                    ->order_by('datetime', 'DESC')
                    ->get('log_deposit')->result_array();
          $k = 0;
          foreach ($log_deposit as $b) {

              if($b['action']=='1'){
                $log_deposit[$k]['detail'] = 'เพิ่ม credit'.$b['credit'];
              }
              else if($b['action']=='2'){
                $log_deposit[$k]['detail'] = 'ซ่อน credit '.$b['credit'];
              }
              else{
                $log_deposit[$k]['detail'] = 'ยกเลิก credit ' .$b['credit'];
              }
             
              $log_deposit[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
              $k++;
          }
          $re = array('code' => 1, 'data' => $log_deposit);
          echo json_encode($re);
          die();
      }


        // log_ranking
      public function search_log_ranking()
      {
          $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
          $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
          $log_ranking  = $this->db->select('*')
                    ->where('datetime >=', $date_start)
                    ->where('datetime <=', $date_end)
                    ->order_by('datetime', 'DESC')
                    ->get('log_ranking')->result_array();
          $k = 0;
          foreach ($log_ranking as $b) {
              $log_ranking[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
              $k++;
          }
          $re = array('code' => 1, 'data' => $log_ranking);
          echo json_encode($re);
          die();
      }

    //   log_imimall
      public function search_log_imimall()
      {
          $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
          $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
          $log_imimall  = $this->db->select('*')
                    ->where('datetime >=', $date_start)
                    ->where('datetime <=', $date_end)
                    ->order_by('datetime', 'DESC')
                    ->get('log_imimall')->result_array();
          $k = 0;
          foreach ($log_imimall as $b) {
              if($b['action'] == '2'){
                $log_imimall[$k]['detail'] = 'รายการสินค้าที่ยกเลิก'.$b['pd_name'];  
              }else{
                $log_imimall[$k]['detail'] = 'รายการสินค้า'.$b['pd_name'];
              }
              $log_imimall[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
              $k++;
          }
          $re = array('code' => 1, 'data' => $log_imimall);
          echo json_encode($re);
          die();
      }


    //   log log_withdraw

    public function search_log_withdraw()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_withdraw  = $this->db->select('*')
                  ->where('datetime >=', $date_start)
                  ->where('datetime <=', $date_end)
                  ->order_by('datetime', 'DESC')
                  ->get('log_withdraw')->result_array();
        $k = 0;
        foreach ($log_withdraw as $b) {
            if($b['bank']== ''){
                $log_withdraw[$k]['bank'] = '-'; 
            }else{
                $log_withdraw[$k]['bank'] = $b['bank']; 
            }

            if($b['action'] == '1'){
              $log_withdraw[$k]['action'] = 'ออโต้';  
            }else if($b['action']=='2'){
              $log_withdraw[$k]['action'] = 'แอดมือ';
            }else{
                $log_withdraw[$k]['action'] = 'อื่นๆ';
            }
            $log_withdraw[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_withdraw);
        echo json_encode($re);
        die();
    }


    // search_Log_gift_status
    public function search_Log_gift_status()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_gift_status  = $this->db->select('*')
                  ->where('datetime >=', $date_start)
                  ->where('datetime <=', $date_end)
                  ->order_by('datetime', 'DESC')
                  ->get('log_gift_status')->result_array();
        $k = 0;
        foreach ($log_gift_status as $b) {
            $log_gift_status[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_gift_status);
        echo json_encode($re);
        die();
    }

    // search_log search_log_gift_voucher 

    public function search_log_gift_voucher(){
        // 2 admin add ให้เลย
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_gift_voucher  = $this->db->select('log_gift_voucher.*,tb_gift.id,tb_gift.gift_name')
        ->join('tb_gift','tb_gift.id = log_gift_voucher.gift_id','left')
        ->where('log_gift_voucher.time_receive >=', $date_start)
        ->where('log_gift_voucher.time_receive <=', $date_end)
        ->order_by('log_gift_voucher.time_receive', 'DESC')
        ->get('log_gift_voucher')->result_array();
        $k = 0;
        foreach ($log_gift_voucher as $b) {

            $log_gift_voucher[$k]['user'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($b['user_id']))), -6);

            $log_gift_voucher[$k]['time_give'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['time_give']);

            $log_gift_voucher[$k]['time_receive'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['time_receive']);

            if($b['receive']== '0'){

                $log_gift_voucher[$k]['receive'] = 'ลูกค้าไม่กดรับ';

            }else if($b['receive']=='1'){

                $log_gift_voucher[$k]['receive'] = 'ลูกค้ากดรับ';

            }else{

                $log_gift_voucher[$k]['receive'] = 'Admin ทำรายการให้';
            }

        $k++;
        }
        $re = array('code' => 1, 'data' => $log_gift_voucher);
        echo json_encode($re);
        die();
    }


     // search_Log_gift_status
     public function search_log_gift_create()
     {

        

         $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
         $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
         $log_gift_create  = $this->db->select('*')
                   ->where('datetime >=', $date_start)
                   ->where('datetime <=', $date_end)
                   ->order_by('datetime', 'DESC')
                   ->get('log_gift_create')->result_array();
         $k = 0;
         foreach ($log_gift_create as $b) {
             $log_gift_create[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
             $k++;
         }
         $re = array('code' => 1, 'data' => $log_gift_create);
         echo json_encode($re);
         die();
     }


     //  search_Log_promotion_create
    public function search_promotion()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_promotion  = $this->db->select('tb_promotion.id,tb_promotion.name,log_promotion.*')
                  ->join('tb_promotion','tb_promotion.id = log_promotion.promotion_id','left')
                  ->where('log_promotion.time >=', $date_start)
                  ->where('log_promotion.time <=', $date_end)
                  ->order_by('log_promotion.time', 'DESC')
                  ->get('log_promotion')->result_array();
        $k = 0;
        foreach ($log_promotion as $b) {
            $log_promotion[$k]['user'] = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($b['user_id']))), -6);
            if($b['before_creadit']== '' ){
                    $before = '-';
            }else{
                $before = $b['before_creadit'];
            }

            if($b['after_creadit'] == ''){
                $after_creadit = '-';
            }else{
                $after_creadit = $b['after_creadit'];
            }
            $log_promotion[$k]['detail'] = 'เครดิตก่อนรับโปรโมชั่น ' .$before.' เคดิตหลังรับโปรโมชั่น '.$after_creadit;

            $log_promotion[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['time']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_promotion);
        echo json_encode($re);
        die();
    }



    //  search_Log_promotion_create
    public function search_Log_promotion_create()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_promotion_create  = $this->db->select('*')
                  ->where('datetime >=', $date_start)
                  ->where('datetime <=', $date_end)
                  ->order_by('datetime', 'DESC')
                  ->get('log_promotion_create')->result_array();
        $k = 0;
        foreach ($log_promotion_create as $b) {
            $log_promotion_create[$k]['tim'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_promotion_create);
        echo json_encode($re);
        die();
    }


    //  search_Log_promotion_create
    public function search_Log_event_create()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt1'))));
        $date_end   = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt2'))));
        $log_event_create  = $this->db->select('*')
                  ->where('datetime >=', $date_start)
                  ->where('datetime <=', $date_end)
                  ->order_by('datetime', 'DESC')
                  ->get('log_event_create')->result_array();
        $k = 0;
        foreach ($log_event_create as $b) {
            $log_event_create[$k]['time'] = date('d-m-Y' . ' || ' . 'H:i:s', $b['datetime']);
            $k++;
        }
        $re = array('code' => 1, 'data' => $log_event_create);
        echo json_encode($re);
        die();
    }



    //-----------------------------------------------------------------จบ log

}

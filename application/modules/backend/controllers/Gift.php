<?php

class Gift extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->library('backend/backend_library');
        $this->load->helper(array('form', 'url'));
        $this->_init();
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }
    public function index()
    {
    }
    /* --------------------------------------------------------  page create gift  --------------------------------------------------------------------------------- */
    public function gift()
    {
        $data['gift'] = $this->db->order_by('time_end', 'DESC')->order_by('status', 'DESC')->get('tb_gift')->result_array();
        $this->load->view('gift_create', $data);
    }

    public function insert_gift()
    {
        $type_user  = $this->input->post('user');
        $name       = $this->input->post('name');
        $credit     = $this->input->post('credit');
        $point      = $this->input->post('point');
        $turnover   = $this->input->post('turnover');
        $limit_user = $this->input->post('limit_user');
        $code       = $this->input->post('code');
        $time_start = strtotime($this->input->post('time_start'));
        $time_end   = strtotime($this->input->post('time_end'));

        if ($limit_user != '' && $code != '') {
            if ($credit == null && $credit == '') {
                $credit = 0;
            }
            if ($point == null && $point == '') {
                $point = 0;
            }
            $tb_gift = $this->db->select('id')->where('code', $code)->get('tb_gift');

            if ($tb_gift->num_rows() == 0) {
                $data = array(
                    'gift_name'         => $name,
                    'code'              => $code,
                    'limit_user'        => $limit_user,
                    'point '            => $point,
                    'credit '           => $credit,
                    'turnover '         => $turnover,
                    'user'                => $type_user,
                    'time_start'        => $time_start,
                    'time_end'          => $time_end,
                    'admin'             => $this->session->userdata['admin']['username'],
                    'status '           => 1
                );
                if ($this->db->insert('tb_gift', $data)) {
                    $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); //ตัดชื่อไฟล์ออกเอาเฉพาะนามสกุล
                    // $result_file= $this->db->insert_id().'.'.$extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์
                    $result_file = 'Gift_' . $code . '.' . $extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์

                    $config['upload_path']          = realpath(APPPATH . '../public/promotion/');
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                    $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                    $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                    $config['file_name'] =   $result_file;
                    $this->upload->initialize($config);
                    // $this->upload->do_upload('img');
                    if (!$this->upload->do_upload('img')) {
                        $error = array('error' => $this->upload->display_errors());
                        // print_r($error);
                        // die();
                    }
                    /* ------------------------------log_gift_create ------------------------ */
                    $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
                    $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                    $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                    $hostname = $hostname[0]['hostname'];

                    $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                    $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                    $dbname = $dbname[0]['database_name'];
                    $time = time();
                    $sql = "INSERT INTO log_gift_create (admin, gift_name,datetime)
		            VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $name . "','" . $time . "')";
                    if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
                    } else {

                        $sql = "CREATE TABLE log_gift_create (
						id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						admin VARCHAR(20) NOT NULL,
						gift_name VARCHAR(100) NULL,
						datetime INT(20) NOT NULL
						) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                        $this->backend_library->query_sql($hostname, $dbname, $sql);

                        $sql = "INSERT INTO log_gift_create (admin, gift_name,datetime)
			            VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $name . "','" . $time . "')";
                        $this->backend_library->query_sql($hostname, $dbname, $sql);
                    }
                    /* ------------------------------ end log_gift_create ------------------------ */


                    $re = array('code' => 1, 'msg' => 'สำเร็จ');
                } else {
                    $re = array('code' => 0, 'msg' => 'ไม่สำเร็จ 56481618');
                }
            } else {
                $re = array('code' => 0, 'msg' => 'ไม่สำเร็จ 77861859');
            }
        } else {
            $re = array('code' => 0, 'msg' => 'ไม่สำเร็จ 68761654');
        }
        echo json_encode($re);
        die;
    }

    public function active_gift()
    {

        $gift_id = $this->input->post('gift_id');
        $status = $this->input->post('status');


        if ($status == 1) {
            $detail = 'old : no_active new : active';
        } else {
            $detail = 'old : active new : no_active';
        }
        $giftname = $this->db->where('id', $gift_id)->get('tb_gift')->row()->gift_name;
        $arr_status = array(
            'status' => $status,
        );
        $this->db->where('id', $gift_id)->update('tb_gift', $arr_status);

        /* ------------------------------log_gift_status ------------------------ */
        $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
        $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
        $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
        $hostname = $hostname[0]['hostname'];

        $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
        $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
        $dbname = $dbname[0]['database_name'];
        $time = time();
        $sql = "INSERT INTO log_gift_status (admin, gift_name,detail,datetime)
             VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $giftname . "','" . $detail . "','" . $time . "')";
        if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
        } else {

            $sql = "CREATE TABLE log_gift_status (
             id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             admin VARCHAR(20) NOT NULL,
             gift_name VARCHAR(100) NULL,
             detail VARCHAR(50) NULL,
             datetime INT(20) NOT NULL
             ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
            $this->backend_library->query_sql($hostname, $dbname, $sql);

            $sql = "INSERT INTO log_gift_status (admin, gift_name,detail,datetime)
             VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $giftname . "','" . $detail . "','" . $time . "')";
            $this->backend_library->query_sql($hostname, $dbname, $sql);
        }
        /* ------------------------------ end log_gift_status ------------------------ */


        $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');

        echo json_encode($re);
        die;
    }
    /* --------------------------------------------------------  end page create gift  --------------------------------------------------------------------------------- */

    public function gift_give()
    {
        $data['gift'] = $this->db
            ->where('status', 1)
            ->where('time_end >=', time())
            ->get('tb_gift')
            ->result_array();
        $this->load->view('gift_give', $data);
    }
    public function give_user()
    {
     
        $id = $this->input->post('check_id');

        if ($id != null && $id != '') {


            $data['user'] = $this->input->post('user');

            $log_gift_voucher  = $this->db->where('gift_id', $id)->get('log_gift_voucher')->num_rows();

            $limit = $this->db->where('id', $id)->get('tb_gift')->row()->limit_user; //จำนวน limit

            if ($log_gift_voucher < $limit) {

                if ($this->input->post('addauto') == 1) {

                    foreach ($data['user'] as $dt) {

                        $tb_user = $this->db->where('user', $dt)->where('status', 1)->get('tb_user')->row();

                        $user_id = $tb_user->id;

                        $user_point = $tb_user->point;


                        $tb_log = $this->db->where('gift_id', $id)->where('user_id', $user_id)->get('log_gift_voucher');

                        $tb_gift = $this->db->where('id', $id)->get('tb_gift')->row();

                        $point = $tb_gift->point;
                        $credit = $tb_gift->credit;
                        $turn_gift = $tb_gift->turnover;

                        if ($tb_log->num_rows() == 0) {

                            if ($credit != 0) { //credit
                                if ($this->deposit($dt, $credit)) {
                                    $re  = $this->turnover($user_id, $turn_gift, $credit);
                                }
                            } else { //point
                                $data_point = array(
                                    'point' => $user_point + $point
                                );

                                $this->db->where('id', $user_id)->update('tb_user', $data_point);

                                $re  = $this->turnover($user_id, $turn_gift, $point);
                            }

                            /* ------------------------------log_gift_voucher ------------------------ */
                            $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
                            $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                            $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                            $hostname = $hostname[0]['hostname'];

                            $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                            $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                            $dbname = $dbname[0]['database_name'];
                            $time = time();
                            $sql = "INSERT INTO log_gift_voucher (gift_id, user_id,time_give,admin,receive,time_receive)
                                      VALUES ('" . $id . "','" . $user_id . "','" . $time . "','" . $this->session->userdata['admin']['username'] . "',2,'" . $time . "')";

                            if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
                            } else {

                                $sql = "CREATE TABLE log_gift_voucher (
                                          id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                          gift_id INT(10) NOT NULL,
                                          user_id INT(20) NOT NULL,
                                          time_give INT(25) NOT NULL,
                                          admin VARCHAR(25) NOT NULL,
                                          receive INT(1) NOT NULL COMMENT '0: ยังไม่รับ 1:รับแล้ว 2:ออโต้',
                                          time_receive INT(25) NOT NULL
                                          ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                                $this->backend_library->query_sql($hostname, $dbname, $sql);

                                $sql = "INSERT INTO log_gift_voucher (gift_id, user_id,time_give,admin,receive,time_receive)
                                  VALUES ('" . $id . "','" . $user_id . "','" . $time . "','" . $this->session->userdata['admin']['username'] . "',2,'" . $time . "')";

                                $this->backend_library->query_sql($hostname, $dbname, $sql);
                            }
                            /* ------------------------------ end log_gift_voucher ------------------------ */
                        } else {
                            $re = array('code' => 0, 'msg' => 'ยูสเซอร์ ' . $tb_user->user . ' ได้ทำรายการแล้ว');
                            echo json_encode($re);
                            die;
                        }
                    }
                } else {
                    foreach ($data['user'] as $dt) {

                        $tb_user = $this->db->where('user', $dt)->where('status', 1)->get('tb_user')->row();

                        $user_id = $tb_user->id;

                        $tb_log = $this->db->where('gift_id', $id)->where('user_id', $user_id)->get('log_gift_voucher');

                        if ($tb_log->num_rows() == 0) {

                            /* ------------------------------log_gift_voucher ------------------------ */
                            $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
                            $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                            $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                            $hostname = $hostname[0]['hostname'];

                            $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                            $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                            $dbname = $dbname[0]['database_name'];
                            $time = time();
                            $sql = "INSERT INTO log_gift_voucher (gift_id, user_id,time_give,admin,receive,time_receive)
                                     VALUES ('" . $id . "','" . $user_id . "','" . $time . "','" . $this->session->userdata['admin']['username'] . "',0,0)";

                            if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
                            } else {

                                $sql = "CREATE TABLE log_gift_voucher (
                                         id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                         gift_id INT(10) NOT NULL,
                                         user_id INT(20) NOT NULL,
                                         time_give INT(25) NOT NULL,
                                         admin VARCHAR(25) NOT NULL,
                                         receive INT(1) NOT NULL COMMENT '0: ยังไม่รับ 1:รับแล้ว 2:ออโต้',
                                         time_receive INT(25) NOT NULL
                                         ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                                $this->backend_library->query_sql($hostname, $dbname, $sql);

                                $sql = "INSERT INTO log_gift_voucher (gift_id, user_id,time_give,admin,receive,time_receive)
                                 VALUES ('" . $id . "','" . $user_id . "','" . $time . "','" . $this->session->userdata['admin']['username'] . "',0,0)";

                                $this->backend_library->query_sql($hostname, $dbname, $sql);
                            }
                            /* ------------------------------ end log_gift_voucher ------------------------ */

                            $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
                        } else {
                            $re = array('code' => 0, 'msg' => 'ยูสเซอร์ ' . $tb_user->user . ' ได้ทำรายการแล้ว');
                            echo json_encode($re);
                            die;
                        }
                    }
                }
            } else {

                $re = array('code' => 0, 'msg' => 'สิทธิํโปรโมชั่นเกินจำนวน');
            }
        } else {

            $re = array('code' => 0, 'msg' => 'กรุณาเลือกGift Voucher');
        }
        echo json_encode($re);
        die;
    }

    public function turnover($user_id, $turn_gift, $amount)
    {
        $tb_turnover = $this->db->where('user_id', $user_id)->get('tb_turnover');
        if ($tb_turnover->num_rows() == 0) {
            $data_insert = array(
                'user_id' => $user_id,
                'promotion_id' => 0,
                'code_id' => 0,
                'sport' => '0',
                'casino' => '0',
                'game' => '0',
                'checkturn' => $turn_gift,
                'check_time' => time(),
                'status' => 1
            );
            $this->db->insert('tb_turnover', $data_insert);
            return array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
        } else {
            $turn_old = $tb_turnover->row()->checkturn;
            $data_update = array(
                'checkturn' => $turn_gift + ((int)$turn_old),
                'check_time' => time(),
            );

            $this->db->where('user_id', $user_id)->update('tb_turnover', $data_update);
            return array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
        }
    }

    public function gift_report()
    {
        $data['gift'] = $this->db->get('tb_gift')->result_array();
        $i = 0;
        foreach ($data['gift'] as $dt) {
            // $data['gift'][$i]['count_receive']  = $this->db->select('count(receive) as re')->where('gift_id', $dt['id'])->where('receive ', 1)->get('log_gift_voucher')->row()->re;
            // $data['gift'][$i]['count_no_receive']  = $this->db->select('count(receive) as re')->where('gift_id', $dt['id'])->where('receive ', 0)->get('log_gift_voucher')->row()->re;

            $data['gift'][$i]['status_receive']  = $this->db->select('SUM(case when receive != 0 then 1 else 0 end) as receive,SUM(case when receive = 0 then 1 else 0 end) as no_receive')
            ->where('gift_id', $dt['id'])->get('log_gift_voucher')->row();
            $i++;
        }

        $this->load->view('report_gift', $data);
    }
    public function search_log_gift()
    {

        $data['gift'] = $this->db->get('tb_gift')->result_array();
        $i = 0;
        foreach ($data['gift'] as $dt) {
            // $data['gift'][$i]['count_receive']  = $this->db->select('count(receive) as re')->where('gift_id', $dt['id'])->where('receive ', 1)->get('log_gift_voucher')->row()->re;
            // $data['gift'][$i]['count_no_receive']  = $this->db->select('count(receive) as re')->where('gift_id', $dt['id'])->where('receive ', 0)->get('log_gift_voucher')->row()->re;

            $data['gift'][$i]['status_receive']  = $this->db->select('SUM(case when receive = 1 then 1 else 0 end) as receive,SUM(case when receive = 0 then 1 else 0 end) as no_receive')->where('gift_id', $dt['id'])->get('log_gift_voucher')->row();
            $i++;
        }

        echo '<pre>';
        print_r($data);
        die;
    }


    // public function featch_receive($id){
    //     print_r($_POST);
    //     die;
        
    //     $this->load->model("gift_model");
    //     $fetch_data = $this->gift_model->make_datatables($id);
    //     $data = array();
    //     foreach($fetch_data as $row){
    //         echo "<pre>";
    //         print_r($row);
    //         $sub_array = array();
    //         $sub_array[] = $row->id;
    //         $sub_array[] = $row->user_id;

    //         $data[] = $sub_array;
    //     }
    //     $output = array(
    //         "draw" => intval($_POST["draw"]),
    //         "recordsTotal" => $this->gift_model->get_all_data(),
    //         "recordsFiltered" => $this->gift_model->get_filtered_data(),
    //         "data"=> $data
    //     );
    //     $this->load->view('report_receivegift',$output);
      
    //     // echo json_encode($output);

    // }
    public function receive($id){ 
    
      $data['receive_gift']= json_encode($this->db->select('id, user_id, receive, time_receive , user_id')
                    ->where('gift_id',$id)
                    //->where_in('receive',array(1, 2))
                    ->where('receive',1)
                    ->order_by('time_receive','desc')
                   ->get('log_gift_voucher')->result_array());
        $this->load->view('report_receivegift',$data);
      
    }

    public function no_receive($id){
            $data['receive_gift']= json_encode($this->db->select('id, user_id, receive, time_receive , user_id')
                                    ->where('gift_id',$id)
                                    ->where('receive',0)
                                    ->order_by('time_receive','desc')
                                ->get('log_gift_voucher')->result_array());
       $this->load->view('report_no_receivegift',$data);
    }


    public function deposit($user, $amount)
    {
        $user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
        if ($user_q->num_rows() == 1) {
            $user_r = $user_q->row();
            $arr_depAPI = array(
                'AgentName' => $this->getapi_model->agent(),
                'PlayerName' => $user,
                'Amount' => $amount,
                'TimeStamp' => time(),
            );
            $dataAPI = array(
                'type' => 'D',
                'agent' => $this->getapi_model->agent(),
                'member' => $user,
            );
            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
            $cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
            if ($cre_userAPI->Success == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function get_credit($user)
    {
        $arr_userAPI = array(
            'AgentName' => $this->getapi_model->agent(),
            'PlayerName' => $user,
            'TimeStamp' => time(),
        );
        $dataAPI = array(
            'type' => 'D',
            'agent' => $this->getapi_model->agent(),
            'member' => $user,
        );
        $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
        $cre_userAPI = $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
        if ($cre_userAPI->Error == 0) {
            $amount = $cre_userAPI->Balance;
        } else {
            $amount = $cre_userAPI->Message;
        }
        return $amount;
    }
}

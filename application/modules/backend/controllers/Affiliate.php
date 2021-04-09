<?php
class Affiliate extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();

        $this->load->model('getapi_model');
        $this->load->library('backend/backend_library');

        $this->load->helper('url');
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

    public function statement()
    {


        $this->load->view('affiliate');
    }

    public function detail()
    {

        // $userid = $this->input->post('s_user'); //user id
        // $user_tel = $this->input->post('t_user'); //user tel

        if (($this->input->post('s_user') != null) || ($this->input->post('t_user') != null)) {

            if ($this->input->post('s_user') != null) {
                $user = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('s_user')))), -6);
                $u_detail = $this->db->select('id, user, username')->where('user', $user)->get('tb_user')->row();
                $u_detail->amount = $this->db->select('SUM(amount) AS amount')->where('user_id', $u_detail->id)->where('status', 2)->get('tb_user_sale_credit')->row();
            } else if ($this->input->post('t_user') != null) {

                $u_detail = $this->db->select('id, user, username')->where('username', $this->input->post('t_user'))->get('tb_user')->row();
                $u_detail->amount = $this->db->select('SUM(amount) AS amount')->where('user_id', $u_deatil->id)->where('status', 2)->get('tb_user_sale_credit')->row();
            }

            $f_class = $this->db->select('tb_user.id, tb_user.user, tb_user_sale.turnover, tb_user_sale.last_date')
                ->join('tb_user', 'tb_user.id = tb_user_sale.user_id')
                ->where('tb_user_sale.sale_userid', $u_detail->id)
                ->get('tb_user_sale')
                ->result_array();



            if ($f_class) {

                $i = 0;
                foreach ($f_class as $fc) {

                    $s_class = $this->db->select('tb_user.user, tb_user.id, tb_user.create_time, tb_user_sale.turnover')
                        ->join('tb_user', 'tb_user.id = tb_user_sale.user_id')
                        ->where('tb_user_sale.sale_userid', $fc['id'])
                        ->get('tb_user_sale')
                        ->result_array();
                    $f_class[$i]['s_class'] = $s_class;
                    if ($s_class) {
                        $n = 0;
                        foreach ($s_class as $sc) {

                            $t_class = $this->db->select('tb_user.user, tb_user.id, tb_user.create_time, tb_user_sale.turnover')
                                ->join('tb_user', 'tb_user.id = tb_user_sale.user_id')
                                ->where('tb_user_sale.sale_userid', $sc['id'])
                                ->get('tb_user_sale')
                                ->result_array();
                            $f_class[$n]['t_class'] = $t_class;

                            $n++;
                        }

                        $re = array('code' => 1, 'f_class' => $f_class, 'u_data' => $u_detail);
                    } else {

                        $re = array('code' => 1, 'f_class' => $f_class, 'u_data' => $u_detail);
                    }

                    $i++;
                }
            } else {
            }

            $re = array('code' => 1, 'f_class' => $f_class, 'u_data' => $u_detail);
        } else {

            $re = array('code' => 2, 'msg' => 'กรุณากรอกยูเซอร์ หรือเบอร์โทรที่ต้องการค้นหา');
        }

        echo json_encode($re);
        die();
    }

    public function af_confirm()
    {


        $af_con = $this->db->select('tb_user.id, tb_user.user, tb_user.username, tb_user_sale_credit.amount, tb_user_sale_credit.status, 
                  tb_user_sale_credit.date_user, tb_user_sale_credit.id as credit_id')
            ->join('tb_user', 'tb_user.id = tb_user_sale_credit.user_id')
            ->order_by('tb_user_sale_credit.date_user', 'DESC')
            ->where('tb_user_sale_credit.status', 2)
            ->get('tb_user_sale_credit')
            ->result_array();
        $data = array(
            'af_con' => $af_con
        );

        $this->load->view('af_confirm', $data);
    }

    public function reject()
    {

        $creditid = $this->input->post('credit_id');
        $check_cf = $this->db->where('id', $creditid)->where('status', 1)->get('tb_user_sale_credit');
        $confirm = $check_cf->row();
        $user = $this->db->select('user')->where('id', $confirm->user_id)->get('tb_user')->row();

        $arr_up = array(
            'admin_id' => $this->session->users['id'],
            'date_AdminCf' => time(),
            'admin_id' => 3,
            'status' => 3
        );
        if ($reject = $this->db->where('id', $creditid)->update('tb_user_sale_credit', $arr_up)) {

            $credit = $this->db->select('user_id, amount')->where('id', $creditid)->get('tb_user_sale_credit')->row();
            if ($this->db->set('sale_credit', 'sale_credit + ' . $credit->amount, FALSE)->where('id', $credit->user_id)->update('tb_user')) {

                /*--------------------------log_af_confirm----------------------------------- */
                $webname = $this->db->where('name', 'web')->get('setting')->row()->code;

                $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                $hostname = $hostname[0]['hostname'];

                $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                $dbname = $dbname[0]['database_name'];
                $time = time();

                $sql = "INSERT INTO log_af_confirm (admin,user, status,datetime) 
                     VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $user->user  . "','reject','" . $time . "')";

                if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
                } else {

                    $sql = "CREATE TABLE log_af_confirm (
                         id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                         admin VARCHAR(20) NOT NULL,
                         user VARCHAR(20) NOT NULL,
                         status VARCHAR(10) NOT NULL,
                         detail VARCHAR(100) NULL,
                         datetime INT(20) NOT NULL
                         ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                    $this->backend_library->query_sql($hostname, $dbname, $sql);
                    $sql = "INSERT INTO log_af_confirm (admin,user, status,datetime) 
                     VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $user->user  . "','reject','" . $time . "')";

                    $this->backend_library->query_sql($hostname, $dbname, $sql);
                }
                /*--------------------------end log_af_confirm----------------------------------- */

                $re = array('code' => 1, 'msg' => 'ยกเลิกการทำรายการ');
            }
        }

        echo json_encode($re);
        die();
    }

    public function af_detail()
    {

        if (!empty($this->input->post('credit_id'))) {

            $creditid = $this->input->post('credit_id');
            $af_detail = $this->db->select('id, user_id, amount')
                ->where('id', $creditid)
                ->get('tb_user_sale_credit')
                ->row();

            $user = $this->db->select('user')->where('id', $af_detail->user_id)->get('tb_user')->row();

            $re = array('code' => 1, 'data' => $af_detail, 'user' => $user);
        }
        echo json_encode($re);
        die();
    }

    //add credit
    public function confirm()
    {

        if (!empty($this->input->post('credit_id'))) {

            $creditid = $this->input->post('credit_id');
            $check_cf = $this->db->where('id', $creditid)->where('status', 1)->get('tb_user_sale_credit');
            $confirm = $check_cf->row();

            if ($check_cf->num_rows() != 0) {

                $user = $this->db->select('user')->where('id', $confirm->user_id)->get('tb_user')->row();
                $amount_out = $confirm->amount;
                $amount = $this->get_credit($user->user);

                $result = $this->deposit($user->user, $amount_out, $amount);

                if ($result['code'] == 1) {

                    if ($this->db->set('status', 2)->where('id', $creditid)->update('tb_user_sale_credit')) {

                        $arr_admin = array(
                            'admin_id' => $this->session->users['id'],
                            'date_AdminCf' => time(),

                        );


                        if ($this->db->where('id', $creditid)->update('tb_user_sale_credit', $arr_admin)) {

                            $detail = 'old : ' . $amount . ' new : ' . $this->get_credit($user->user) . ' amount : ' . $amount_out;
                            /*--------------------------log_af_confirm----------------------------------- */
                            $webname = $this->db->where('name', 'web')->get('setting')->row()->code;

                            $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                            $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                            $hostname = $hostname[0]['hostname'];

                            $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                            $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                            $dbname = $dbname[0]['database_name'];
                            $time = time();

                            $sql = "INSERT INTO log_af_confirm (admin,user, status,detail,datetime) 
                                VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $user->user  . "','confirm','" . $detail . "','" . $time . "')";

                            if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
                            } else {

                                $sql = "CREATE TABLE log_af_confirm (
            	                    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            	                    admin VARCHAR(20) NOT NULL,
                                    user VARCHAR(20) NOT NULL,
            	                    status VARCHAR(10) NOT NULL,
                                    detail VARCHAR(100) NOT NULL,
            	                    datetime INT(20) NOT NULL
            	                    ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                                $this->backend_library->query_sql($hostname, $dbname, $sql);
                                $sql = "INSERT INTO log_af_confirm (admin,user, status,detail,datetime) 
                                VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $user->user  . "','confirm','" . $detail . "','" . $time . "')";

                                $this->backend_library->query_sql($hostname, $dbname, $sql);
                            }
                            /*--------------------------end log_af_confirm----------------------------------- */


                            $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
                        }
                    }
                } else {

                    $re = array('code' => 0, 'msg' => 'มีปัญหา 002 เช็คยอดเงินก่อนทำรายการต่อ');
                }
            }
        } else {
            $re = array('code' => 2, 'msg' => 'error');
        }
        echo json_encode($re);
        die();
    }

    function deposit($user, $amount, $credit_last)
    {

        //เริ่มต้น API Deposit สำหรับ Agent Betclic
        $user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
        if ($user_q->num_rows() == 1) {
            $user_r = $user_q->row();
            $arr_depAPI = array(
                'AgentName'     => $this->getapi_model->agent(),
                'PlayerName'     => $user_r->user,
                'Amount'         => $amount,
                'TimeStamp'     => time()
            );
            $dataAPI = array(
                'type'        => 'D',
                'agent'     => $this->getapi_model->agent(),
                'member'     => $user_r->user,
            );

            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
            $cre_userAPI =  $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);

            if ($cre_userAPI->Success == 1) {
                $arr_log_d = array(
                    'user_id'    => $user_r->id,
                    'admin_id'    => $this->session->userdata['users']['id'],
                    'type'        => 1, // type in
                    'amount'    => $amount,
                    'credit_last'     => $credit_last,
                    'credit_result' => $this->get_credit($user_r->user),
                    'create_time'    => time(),
                    'status'        => 1
                );
                if ($this->db->insert('log_credit', $arr_log_d)) {
                    $re = array('code' => 1, 'msg' => '004');
                } else {
                    $re = array('code' => 0, 'msg' => '003');
                }
            } else {
                $re = array('code' => 0, 'msg' => '002');
            }
        } else {
            $re = array('code' => 0, 'msg' => '001');
        }
        return $re;
    }

    public function get_credit($user)
    {

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
        $cre_userAPI = $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);

        if ($cre_userAPI->Error == 0) {
            $amount = $cre_userAPI->Balance;
        } else {
            $amount = $cre_userAPI->Message;
        }
        return $amount;
    }

    public function AfSetting()
    {


        $data['af_class'] = $this->db->select('tb_affiliate_setting.f_class, tb_affiliate_setting.s_class, tb_affiliate_setting.t_class, tb_login.username, tb_affiliate_setting.create_time')
            ->join('tb_login', 'tb_login.id = tb_affiliate_setting.admin_id')
            ->get('tb_affiliate_setting')
            ->row();

        $data['auto'] = $this->db->where('name', 'switch_affiliate')->get('setting')->result_array();

        $this->load->view('affiliate_setting', $data);
    }

    public function af_setting()
    {


        // print_r($this->input->post());
        // die;
        if ($this->input->post('vendor_id')) {
            $vendor_id = $this->input->post('vendor_id');
            $setting = $this->db->where('vendor_id', $vendor_id)->where('status', 1)->get('tb_vendor_setting');


            $setting_r = $setting->num_rows();
            if ($setting_r != 0) {
                $re = array('code' => 2, 'title' => 'ทำรายการไม่สำเร็จ', 'msg' => 'มีรายการอยู่แล้ว');
            } else {
                $data = array(
                    'vendor_id' => $vendor_id,
                    'admin_id' => $this->session->userdata['users']['id'],
                    'create_time' => time(),
                    'status' => 1
                );
                if ($this->db->insert('tb_vendor_setting', $data)) {
                    $this->db->set('status', 0)->where_not_in('vendor_id', $vendor_id)->update('tb_vendor_setting');

                    $re = array('code' => 1, 'title' => 'ทำรายการสำเร็จ', 'msg' => 'ทำการเพิ่มรายการเรียบร้อยแล้ว');
                }
            }
        } else if ($this->input->post('f_class') || $this->input->post('s_class') || $this->input->post('t_class')) {
            $set_class = $this->db->get('tb_affiliate_setting');
            $f_class_old = $set_class->row()->f_class;
            $s_class_old = $set_class->row()->s_class;
            $t_class_old = $set_class->row()->t_class;
            $old = 'first : ' . $f_class_old . ' second : ' . $s_class_old . ' third : ' . $t_class_old;
            $arr_af = array(
                'f_class' => $this->input->post('f_class'),
                's_class' => $this->input->post('s_class'),
                't_class' => $this->input->post('t_class'),
                'admin_id' => $this->session->userdata['users']['id'],
                'create_time' => time(),
                'status' => 1
            );
            $new  = 'first : ' . $arr_af['f_class'] . ' second : ' . $arr_af['s_class'] . ' third : ' . $arr_af['t_class'];



            if ($set_class->num_rows() == 1) {
                $set_r = $set_class->row();
                if ($this->db->where('id', $set_r->id)->update('tb_affiliate_setting', $arr_af)) {

                    /*--------------------------log_af_level----------------------------------- */
                    $webname = $this->db->where('name', 'web')->get('setting')->row()->code;

                    $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                    $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                    $hostname = $hostname[0]['hostname'];

                    $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
                    $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
                    $dbname = $dbname[0]['database_name'];
                    $time = time();

                    $sql = "INSERT INTO log_af_level (admin, old_level,new_level,datetime) 
                    VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $old . "','" . $new . "','" . $time . "')";

                    if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
                    } else {

                        $sql = "CREATE TABLE log_af_level (
                  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  admin VARCHAR(20) NOT NULL,
                  old_level VARCHAR(100) NOT NULL,
                  new_level VARCHAR(100) NOT NULL,
                  datetime INT(20) NOT NULL
                  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                        $this->backend_library->query_sql($hostname, $dbname, $sql);
                        $sql = "INSERT INTO log_af_level (admin, old_level,new_level,datetime) 
                    VALUES ('" . $this->session->userdata['admin']['username'] . "','" . $old . "','" . $new . "','" . $time . "')";

                        $this->backend_library->query_sql($hostname, $dbname, $sql);
                    }
                    /*--------------------------end log_af_level----------------------------------- */

                    $re = array('code' => 1, 'msg' => 'อัพเดตรายการสำเร็จ');
                } else {
                    $re = array('code' => 0, 'title' => 'อัพเดตรายการไม่สำเร็จ', 'msg' => 'กรุณาลองใหม่อีกครั้ง');
                }
            } else {
                if ($this->db->insert('tb_affiliate_setting', $arr_af)) {
                    $re = array('code' => 1, 'msg' => 'เพิ่มรายการสำเร็จ');
                } else {
                    $re = array('code' => 0, 'title' => 'เพิ่มรายการไม่สำเร็จ', 'msg' => 'กรุณาลองใหม่อีกครั้ง');
                }
            }
        } else if ($this->input->post('id')) {
            $status_old = 'off';
            $status_new = 'on';
            $this->db->set('status', 1)->where('code', 3)->update('setting');

            /*--------------------------log_af_auto----------------------------------- */
            $webname = $this->db->where('name', 'web')->get('setting')->row()->code;

            $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
            $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
            $hostname = $hostname[0]['hostname'];

            $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
            $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
            $dbname = $dbname[0]['database_name'];
            $time = time();

            $sql = "INSERT INTO log_af_auto (admin, detail,datetime) 
            VALUES ('" . $this->session->userdata['admin']['username'] . "','" . 'old : ' . $status_old . ' new : ' . $status_new . "','" . $time . "')";

            if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
            } else {

                $sql = "CREATE TABLE log_af_auto (
            	 id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            	 admin VARCHAR(20) NOT NULL,
            	 detail VARCHAR(50) NOT NULL,
            	 datetime INT(20) NOT NULL
            	 ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                $this->backend_library->query_sql($hostname, $dbname, $sql);
                $sql = "INSERT INTO log_af_auto (admin, detail,datetime) 
                VALUES ('" . $this->session->userdata['admin']['username'] . "','" . 'old : ' . $status_old . ' new : ' . $status_new . "','" . $time . "')";

                $this->backend_library->query_sql($hostname, $dbname, $sql);
            }
            /*--------------------------end log_af_auto----------------------------------- */

            $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
        } else if ($this->input->post('off_id')) {
            $status_old = 'on';
            $status_new = 'off';
            $this->db->set('status', 0)->where('code', 3)->update('setting');

            /*--------------------------log_af_auto----------------------------------- */
            $webname = $this->db->where('name', 'web')->get('setting')->row()->code;

            $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
            $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
            $hostname = $hostname[0]['hostname'];

            $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
            $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
            $dbname = $dbname[0]['database_name'];
            $time = time();

            $sql = "INSERT INTO log_af_auto (admin, detail,datetime) 
            VALUES ('" . $this->session->userdata['admin']['username'] . "','" . 'old : ' . $status_old . ' new : ' . $status_new . "','" . $time . "')";

            if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
            } else {

                $sql = "CREATE TABLE log_af_auto (
            	 id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            	 admin VARCHAR(20) NOT NULL,
            	 detail VARCHAR(50) NOT NULL,
            	 datetime INT(20) NOT NULL
            	 ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
                $this->backend_library->query_sql($hostname, $dbname, $sql);
                $sql = "INSERT INTO log_af_auto (admin, detail,datetime) 
                VALUES ('" . $this->session->userdata['admin']['username'] . "','" . 'old : ' . $status_old . ' new : ' . $status_new . "','" . $time . "')";

                $this->backend_library->query_sql($hostname, $dbname, $sql);
            }
            /*--------------------------end log_af_auto----------------------------------- */

            $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ 3');
        }

        echo json_encode($re);
        die();
    }

    public function get_type_af()
    {

        $type = $this->input->post('status');

        if ($type == '1') {
            $data = $this->db->select('tb_user_sale_credit.id as credit_id, tb_user.id, tb_user.user, tb_user.username, tb_user_sale_credit.amount, tb_user_sale_credit.status, 
                    tb_user_sale_credit.date_user, tb_user_sale_credit.id as credit_id')
                ->join('tb_user', 'tb_user.id = tb_user_sale_credit.user_id')
                ->where('tb_user_sale_credit.status', $type)
                ->order_by('tb_user_sale_credit.date_user', 'DESC')
                ->get('tb_user_sale_credit')
                ->result_array();
        } else {
            $data = $this->db->select('tb_user_sale_credit.id as credit_id, tb_user.id, tb_user.user, tb_user.username, tb_user_sale_credit.amount, tb_user_sale_credit.status, 
                    tb_user_sale_credit.date_user, tb_user_sale_credit.id as credit_id, tb_user_sale_credit.date_AdminCf, tb_login.username as ad_username')
                ->join('tb_user', 'tb_user.id = tb_user_sale_credit.user_id')
                ->join('tb_login', 'tb_login.id = tb_user_sale_credit.admin_id')
                ->where('tb_user_sale_credit.status', $type)
                ->order_by('tb_user_sale_credit.date_user', 'DESC')
                ->get('tb_user_sale_credit')
                ->result_array();
        }



        $re = array('data' => $data);
        echo json_encode($re);
        die();
    }


    public function detail_aff()
    {

        $data['aff'] = $this->detail_affi();
        // echo '<pre>';
        // print_r($data);
        // die();
        $this->load->view('aff_cal', $data);
    }
    public function detail_affi()
    {

        if (empty($this->input->post('Per_Page'))) {
            $chf = true;
            $Page = 1;
            $Per_Page = 10;
            $Search = '';
        } else {
            $chf = false;
            $Page = $this->input->post('Page');
            $Per_Page = $this->input->post('Per_Page');
            $Search = $this->input->post('Search');
        }
        $Num_Rows = $this->db->select('tb_user_sale.sale_userid as id,tb_user.user, tb_user_sale.date_update, tb_user_sale.from_date')
            ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
            ->where_not_in('tb_user_sale.sale_userid', 1)
            ->group_by('tb_user_sale.sale_userid')
            ->get('tb_user_sale')
            ->num_rows();
        if ($Page == 1) {
            $skip = 0;
        } else {
            $skip = $Per_Page * ($Page - 1);
        }

        $head = $this->db->select('tb_user_sale.sale_userid as id,tb_user.user, tb_user_sale.date_update, tb_user_sale.from_date')
            ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
            ->where_not_in('tb_user_sale.sale_userid', 1)
            ->group_by('tb_user_sale.sale_userid')
            ->limit($Per_Page, $skip)
            ->get('tb_user_sale')
            ->result_array();
        $i = 0;
        foreach ($head as $hd) {

            $head[$i]['sum'] = 0;
            $first = $this->db->select('tb_user_sale.user_id, tb_user_sale.turnover')
                ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
                ->where('tb_user_sale.sale_userid', $hd['id'])
                ->get('tb_user_sale')
                ->result_array();
            $head[$i]['first'] = $first;

            $x = 0;
            foreach ($first as $fr) {
                $head[$i]['sum'] += (float) $fr['turnover'];

                $second = $this->db->select('tb_user_sale.user_id, tb_user_sale.turnover')
                    ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
                    ->where('tb_user_sale.sale_userid', $fr['user_id'])
                    ->get('tb_user_sale')
                    ->result_array();
                $head[$i]['second'] = $second;

                $y = 0;
                foreach ($second as $sc) {

                    $head[$i]['sum'] += (float) $sc['turnover'];

                    $third = $this->db->select('tb_user_sale.user_id, tb_user_sale.turnover')
                        ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
                        ->where('tb_user_sale.sale_userid', $sc['user_id'])
                        ->get('tb_user_sale')
                        ->result_array();
                    $head[$i]['third'] = $third;

                    $z = 0;
                    foreach ($third as $th) {

                        $head[$i]['sum'] += (float) $th['turnover'];

                        $z++;
                    }

                    $y++;
                }
                $x++;
            }

            $i++;
        }

        if ($Num_Rows <= $Per_Page) {
            $Num_Pages = 1;
        } else if (($Num_Rows % $Per_Page) == 0) {
            $Num_Pages = ($Num_Rows / $Per_Page);
        } else {
            $Num_Pages = ($Num_Rows / $Per_Page) + 1;
            $Num_Pages = (int)$Num_Pages;
        }

        $data = array(
            'code' => 1,
            'aff' => $head,
            'Num_Rows' => $Num_Rows,
            'Num_Pages' => $Num_Pages,
            'Page' => $Page,
            'Per_Page' => $Per_Page
        );

        if ($chf) {
            return $data;
        } else {
            echo json_encode($data);
            die;
        }
    }

    public function detail_class()
    {

        $userid = $this->input->post('userid');
        // $type = $this->input->post('type');
        // print_r($class);


        $first = $this->db->select('tb_user.user, tb_user_sale.user_id, tb_user_sale.turnover, tb_user_sale.last_date, tb_user_sale.from_date, tb_user_sale.date_update	')
            ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
            ->where('tb_user_sale.sale_userid', $userid)
            ->get('tb_user_sale')
            ->result_array();

        $i = 0;
        foreach ($first as $fr) {

            $f_user = $this->db->select('user')->like('user', $fr['user_id'], 'before')->get('tb_user')->row();
            $first[$i]['f_user'] = $f_user;

            $second = $this->db->select('tb_user_sale.user_id, tb_user_sale.turnover')
                ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
                ->where('tb_user_sale.sale_userid', $fr['user_id'])
                ->get('tb_user_sale')
                ->result_array();
            $first[$i]['second'] = $second;

            $x = 0;
            foreach ($second as $sc) {

                $s_user = $this->db->select('user')->like('user', $sc['user_id'], 'before')->get('tb_user')->row();


                $first[$i]['second'][$x]['s_user'] = $s_user;

                $third = $this->db->select('tb_user.user, tb_user_sale.user_id, tb_user_sale.turnover')
                    ->join('tb_user', 'tb_user.id = tb_user_sale.sale_userid')
                    ->where('tb_user_sale.sale_userid', $sc['user_id'])
                    ->get('tb_user_sale')
                    ->result_array();
                $first[$i]['third'] = $third;

                $z = 0;
                foreach ($third as $th) {

                    $t_user = $this->db->select('user')->like('user', $th['user_id'], 'before')->get('tb_user')->row();
                    $first[$i]['third'][$z]['t_user'] = $t_user;

                    $z++;
                }

                $x++;
            }

            $i++;
        }
        // echo '<pre>';
        // print_r($first);
        // die();
        $re = array('code' => 1, 'first' => $first);

        echo json_encode($re);
        die();
    }


    public function af_request()
    {

        $data['confirm'] = $this->db->select('tb_user.user, tb_user.username, tb_user_sale_credit.id, tb_user_sale_credit.user_id, tb_user_sale_credit.amount, tb_user_sale_credit.date_user')
            ->join('tb_user', 'tb_user.id = tb_user_sale_credit.user_id')
            ->where('tb_user_sale_credit.status', 1)
            ->order_by('tb_user_sale_credit.date_user', 'DESC')
            ->get('tb_user_sale_credit')
            ->result_array();

        $this->load->view('af_request', $data);
    }

    public function aff_log()
    {
     
        $this->load->view('aff_log');
    }

    public function search_log()
    {
    
        $u_id = $this->input->post('u_id');
        
        $log_aff = $this->db->select('tb_user.id,tb_user.user, log_cal_affiliate.aff_turn, log_cal_affiliate.date_to, log_cal_affiliate.date_from')
                    ->join('tb_user', 'tb_user.id = log_cal_affiliate.user_id')
                    ->where('log_cal_affiliate.user_id', $u_id)
                    ->get('log_cal_affiliate')
                    ->result_array();
                
       $re = array('code'=> 1, 'log_aff'=> $log_aff);
       echo json_encode($re);
       die();
    }
}

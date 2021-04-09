<?php

class Pd_list extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->library('backend/backend_library');
        $this->_init();
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }
    public function index()
    {
        $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
        $sql = "SELECT * FROM tb_order WHERE webname = '" . $webname . "' AND admin_status = 1 ORDER BY `tb_order`.`id` DESC";
        $data['value'] = $this->backend_library->select_sql(getenv('host_imiwinmall'), getenv('db_imiwinmall'), $sql);
        $this->load->view('product_list', $data);
    }

    public function update_status_checkall()
    {
        $time = time();
        $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
        $data['id'] = $this->input->post('id');
        if ($this->input->post('condition') == 'confirm') {
            $status = 1;
        } else {
            $status = 2;
        }
        foreach ($data['id'] as $dt) {
            $sql = "SELECT user_id FROM tb_order WHERE webname = '" . $webname . "' AND id = '" . $dt . "'";
            $user = $this->backend_library->select_sql(getenv('host_imiwinmall'), getenv('db_imiwinmall'), $sql);
            $user  = $user[0]['user_id'];

            $sql = "SELECT pd_name FROM tb_order WHERE webname = '" . $webname . "' AND id = '" . $dt . "'";
            $pd_name = $this->backend_library->select_sql(getenv('host_imiwinmall'), getenv('db_imiwinmall'), $sql);
            $pd_name =  $pd_name[0]['pd_name'];


            $sql = "SELECT hostname FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
            $hostname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
            $hostname = $hostname[0]['hostname'];

            $sql = "SELECT database_name FROM tb_listhost WHERE webname = '" . $webname . "' AND status = 1";
            $dbname = $this->backend_library->select_sql(getenv('host_imicenter'), getenv('db_user_imicenter'), $sql);
            $dbname = $dbname[0]['database_name'];

            $sql = "INSERT INTO log_imimall (admin,user_id,pd_name,action,datetime)  
            VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $user . "','" . $pd_name . "','" . $status . "','" . $time . "')";
            if ($this->backend_library->query_sql($hostname, $dbname, $sql)) {
            } else {
                $sql = "CREATE TABLE log_imimall (
									id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
									admin VARCHAR(20) NOT NULL,
									user_id VARCHAR(20) NOT NULL,
									pd_name VARCHAR(100) NOT NULL,
									action INT(1) NOT NULL,
									datetime INT(20) NOT NULL
                                    ) CHARACTER SET utf8 COLLATE utf8_general_ci";


                $this->backend_library->query_sql($hostname, $dbname, $sql);
                $sql = "INSERT INTO log_imimall (admin,user_id,pd_name,action,datetime)  
                                   VALUES ('" . $this->session->userdata['admin']['username'] . "', '" . $user . "','" . $pd_name . "','" . $status . "','" . $time . "')";
                $this->backend_library->query_sql($hostname, $dbname, $sql);
            }
            $sql = "UPDATE tb_order SET agent_status = '" . $status . "' WHERE id = '" . $dt . "' ";
            $this->backend_library->query_sql(getenv('host_imiwinmall'), getenv('db_imiwinmall'), $sql);

            if ($status == 2) {
                $user_point = $this->db->where('user', $user)->get('tb_user')->row()->point;
                $sql = "SELECT pd_point FROM tb_order WHERE webname = '" . $webname . "' AND id = '" . $dt . "'";
                $pd_point = $this->backend_library->select_sql(getenv('host_imiwinmall'), getenv('db_imiwinmall'), $sql);
                $pd_point =  $pd_point[0]['pd_point'];
                $this->db->where('user', $user)->update('tb_user', array('point' => $user_point + $pd_point));
            }
        }

        if ($status == 1) {
            $txt = "\nเว็บ " . $webname . " ยืนยันรายการสินค้า";
        } else {
            $txt = "\nเว็บ " . $webname . " ยกเลิกรายการสินค้า";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://notify-api.line.me/api/notify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "message=$txt",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer r1pGsjPDKfgYZeOjA2sJrj6FAF6dzQNOojtL2COLYiF",
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $re = array('msg' => 'ทำรายการเรียบร้อย', 'code' => 1);
        echo json_encode($re);
        die;
    }

    public function report()
    {
        $this->load->view('report_pd');
    }

    public function detail_report()
    {
        $date_start = strtotime(date('d-m-Y 00:00:00', strtotime($this->input->post('dt_start'))));
        $date_end = strtotime(date('d-m-Y 23:59:59', strtotime($this->input->post('dt_end'))));
        $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
        if ($date_start && $date_end) {
            if ($webname != '' || $webname != null) {

                $sql = "SELECT user_id,webname,user_point,pd_name,pd_id,pd_point,remain_point,address,sup_id FROM tb_order
                WHERE webname = '" . $webname . "' AND  time > '" . $date_start . "' AND time < '" . $date_end . "' AND admin_status = 1 AND agent_status = 1";
                $data['dataa'] = $this->backend_library->select_sql(getenv('host_imiwinmall'), getenv('db_imiwinmall'), $sql);
                $i = 0;
                $j = 0;

                $sql = "SELECT COUNT(pd_id) AS count,pd_id,pd_name FROM tb_order
                WHERE webname = '" . $webname . "' AND  time > '" . $date_start . "' AND time < '" . $date_end . "' AND admin_status = 1 AND agent_status = 1 GROUP BY pd_id";
                $data['count'] = $this->backend_library->select_sql(getenv('host_imiwinmall'), getenv('db_imiwinmall'), $sql);
                foreach ($data['count'] as $dt1) {
                    $sql = "SELECT price_id FROM wp_wc_product_meta_lookup WHERE  product_id = '" . $dt1['pd_id'] . "'";
                    $price_pd = $this->backend_library->select_sql(getenv('host_imiwinmall'), 'imiwinmall_wp', $sql);
                    $data['count'][$j]['pd_price'] = $price_pd[0]['price_id'];
                    $j++;
                }

                foreach ($data['dataa'] as $dt) {
                    $sql = "SELECT price_id FROM wp_wc_product_meta_lookup WHERE  product_id = '" . $dt['pd_id'] . "'";
                    $price = $this->backend_library->select_sql(getenv('host_imiwinmall'), 'imiwinmall_wp', $sql);
                    $data['dataa'][$i]['pd_price'] = $price[0]['price_id'];
                    $i++;
                }
            }
            if ($data['dataa']) {
                $re = array('msg' => 'ค้นหาสำเร็จ', 'code' => 1, 'data' => $data);
            } else {
                $re = array('msg' => 'ไม่พบข้อมูลในฐานข้อมูล', 'code' => 0);
            }
        }
        echo json_encode($re);
        die;
    }
}

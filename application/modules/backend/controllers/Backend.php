<?php
class Backend extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->model('sum_state');
        $this->load->library('backend/backend_library');
        $this->load->library('backend/google_authenticator');
        $this->_init();
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }
    public function clear_state()
    {
        $this->sum_state->sum_data_state();
    }
    public function index()
    {
        
        redirect('backend/deposit');
    }
    public function test()
    {
        echo '<pre>';

        print_r($this->session->users['username']);
        die;
    }
    public function logout()
    {
        $this->db->set('status_login', 0)->where('id', $this->session->admin['id'])->update('tb_login');
        $last_logId = $this->db->where('admin_id', $this->session->users['username'])->order_by('id', 'DESC')->limit(1)->get('log_login')->row();
        $this->db->set('time_logout', time())->where('id', $last_logId->id)->update('log_login');
        $this->session->sess_destroy();
        redirect('backend/home');
    }
    public function profile_admin()
    {
        $adminid = $this->session->users['id'];
        $profile = $this->db->select('username, agent, name, remark, tel, rounds, class,two_factor')
            ->where('id', $adminid)
            ->get('tb_login')
            ->result_array();

        $admin = array(
            'profile' => $profile
        );

        $this->load->view('admin_profile', $admin);
    }
    public function edit_admin()
    {
        $adminid = $this->session->users['id'];
        $name =  $this->input->post('name');
        $tel = $this->input->post('tel');
        $rounds = $this->input->post('rounds');

        $arr_update_admin =  array(
            'name' => $name,
            'tel' => $tel,
            'rounds' => $rounds

        );
        // print_r($arr_update_admin);
        // die();
        if ($this->db->where('id', $adminid)->update('tb_login', $arr_update_admin)) {
            $re = array('code' => 1, 'msg' => 'อัพเดตข้อมูลสำเร็จ');
        } else {
            $re = array('code' => 0, 'msg' => 'อัพเดตข้อมูลไม่สำเร็จ');
        }

        echo json_encode($re);
        die();
    }

    public function edit_password()
    {
        $adminid = $this->session->users['id'];
        $new_pass = $this->input->post('new_pass');

        if (!empty($new_pass)) {
            $salt = $this->backend_library->salt();
            $password =  $this->backend_library->hash_password($new_pass, $salt);
            $passUpdate = array(
                'password'     => $password,
                'salt'         => $salt
            );
            $this->db->where('id', $adminid)->update('tb_login', $passUpdate);
            $re = array('code' => 1, 'msg' => 'อัพเดตข้อมูลสำเร็จ');
        } else {
            $re = array('code' => 0, 'msg' => 'อัพเดตข้อมูลไม่สำเร็จ');
        }

        echo json_encode($re);
        die();
    }

    public function change_status_tf()
    {
        $adminid = $this->session->users['id'];
        $user =  ($this->db->select('two_factor')
            ->where('id', $adminid)
            ->get('tb_login')
            ->result_array())[0];
        $status_tf =  $this->input->post('status_tf');
        $tf = json_decode($user['two_factor']);
        if ($status_tf == "on") { // เปิดใช้ two-factor
            if ($tf->key == "" ||   $tf->linkQr ==  "") {
                if ($arr_update = $this->newKeyTwoFactor()) {
                    $re = array('code' => 1, 'msg' => "เพิ่มใหม่เรียบร้อย", 'data' => $arr_update);
                } else {
                    $re = array('code' => 1, 'msg' => "ผิดพลาดเพิ่มไม่ได้", 'data' => []);
                }
            } else {
                $arr_update =  array(
                    'two_factor' => json_encode(
                        [
                            "key" => $tf->key,
                            "linkQr" => $tf->linkQr,
                            "status" => "on"
                        ]
                    )

                );
                if ($this->db->where('id', $adminid)->update('tb_login', $arr_update)) {
                    $re = array('code' => 1, 'msg' => "เปิดใช้", 'data' => []);
                }
            }
        } else { // ปิด  two-factor
            $arr_update =  array(
                'two_factor' => json_encode(
                    [
                        "key" => $tf->key,
                        "linkQr" => $tf->linkQr,
                        "status" => "off"
                    ]
                )

            );
            if ($this->db->where('id', $adminid)->update('tb_login', $arr_update)) {
                $re = array('code' => 1, 'msg' => "ปิดใช้", 'data' => []);
            }
        }


        echo json_encode($re);
        die();
    }

    public function confrimTwofactor()
    {
        $pin = $this->input->post('pin');
        $adminid = $this->session->users['id'];
        $user =  $this->db->select('two_factor')
            ->where('id', $adminid)
            ->get('tb_login')
            ->row();
        $ch_ft = json_decode($user->two_factor);
        $checkResult = $this->google_authenticator->verifyCode($ch_ft->key, $pin, 2);
        if ($checkResult) {
            $arr_update =  array(
                'two_factor' => json_encode(
                    [
                        "key" => $ch_ft->key,
                        "linkQr" => $ch_ft->linkQr,
                        "status" => "on"
                    ]
                )

            );
            if ($this->db->where('id', $adminid)->update('tb_login', $arr_update)) {
                $re = array('code' => 1, 'msg' => "บันทึก");
            }
        } else {
            $re = array('code' => 0, 'msg' => "ผิด");
        }
        echo json_encode($re);
        die;
    }
    public function newKeyTwoFactor()
    {
        $adminid = $this->session->users['id'];
        $user =  ($this->db->select('id,username')
            ->where('id', $adminid)
            ->get('tb_login')
            ->result_array())[0];
        $ST =  ($this->db->select('code')
            ->where('name', 'web')
            ->get('setting')
            ->result_array())[0];

        $secret = $this->google_authenticator->createSecret();
        $qrCodeUrl = $this->google_authenticator->getQRCodeGoogleUrl($ST['code'] . '/' . $user['username'], $secret);

        $arr_update =  array(
            'two_factor' =>  json_encode(
                [
                    "key" => $secret,
                    "linkQr" => $qrCodeUrl,
                    "status" => "wait"
                ]
            )
        );
        if ($this->db->where('id', $user['id'])->update('tb_login', $arr_update)) {

            if ($this->input->post('new')) {
                $re = array('code' => 1, 'msg' => "เพิ่มใหม่เรียบร้อย กรุณาลงทะเบียนก่อนออกจากหน้านี้", 'data' => $arr_update);
                echo json_encode($re);
                die();
            }
            return $arr_update;
        } else {
            if ($this->input->post('new')) {
                $re = array('code' => 1, 'msg' => "ผิดพลาดเพิ่มไม่ได้");
                echo json_encode($re);
                die();
            }
            return false;
        }
    }

    public function setHtmlTwoFac()
    {
        $adminid = $this->session->users['id'];
        $againPass = $this->input->post('againPass');
        $code = $this->input->post('code');

        $tf = ($this->db->select('*')
            ->where('id', $adminid)
            ->get('tb_login')
            ->row());
        $two_factor =  json_decode($tf->two_factor);
        $checkResult = $this->google_authenticator->verifyCode($two_factor->key, $code, 2);

        if ($this->backend_library->hash_password($againPass, $tf->salt) == $tf->password) {
            if ($checkResult) {
                $resp['status'] = 1;
                $resp['msg'] = 'ผ่าน';
                $resp['data'] = $two_factor;
            } else {
                $resp['status'] = 0;
                $resp['msg'] = 'codeผิด';
                $resp['data'] = '';
            }
        } else {
            $resp['status'] = 0;
            $resp['msg'] = 'รหัสผ่านผิด';
            $resp['data'] = '';
        }

        echo json_encode($resp);
        die;
    }

    public function CheckOpenTwofac()
    {
        $user =  json_decode(($this->db->select('two_factor')
            ->where('id', $this->session->admin['id'])
            ->get('tb_login')
            ->result_array())[0]['two_factor']);

        if ($user->key == '') {
            $sent = [
                'code' =>  -1,
                'msg' =>   "ท่านยังไม่ได้ตั้งค่า รหัสสองชั้น"
            ];
        } elseif ($user->status == 'off') {
            $sent = [
                'code' =>  0,
                'msg' => "ท่านปิดการใช้งานระบบ รหัสสองชั้น"
            ];
        } else {
            $sent = [
                'code' =>  1,
                'msg' => "*"
            ];
        }


        echo json_encode($sent);
        die;
    }

    public function clear_twoFac()
    {
        // $user เก็บฟิลด์ two_factor
        $user = ($this->db->select('id,username,name,two_factor')
            ->where('id', $this->session->admin['id'])
            ->get('tb_login')
            ->result_array())[0];
        //check pin two factor 
        $checkResult = $this->google_authenticator->verifyCode(json_decode($user['two_factor'])->key, $this->input->post('pin'), 2);
        if ($checkResult) {
            //ถ้า รหัส two factor ถูกจะล้าง key, linkQR, เปลี่ยน status เป็น off 
            $arr_update =  [
                'two_factor' =>  json_encode(
                    [
                        "key" => "",
                        "linkQr" => "",
                        "status" => "off"
                    ]
                )
            ];
            //update ข้อมูลที่ idนั้น
            $this->db->where('id', $this->input->post('id_operator'))->update('tb_login', $arr_update);
            // save log

            $data = [
                "detail" => json_encode(
                    [
                        "id" => $user['id'],
                        "username" => $user['username'],
                        "name" =>  $user['name'],
                        "list" => "clear 2F id ::" . $this->input->post('id_operator') ." IP :: ".$this->input->ip_address()
                    ]
                ),
                "created_time" => date("Y-m-d H:i:s")
            ];

            $this->load->dbforge();
            if($this->db->table_exists('log_clear2fac') != 1 )
        {
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'int',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'detail' => array(
                    'type' => 'JSON',
                ),
                'created_time' => array(
                   'type' => 'VARCHAR',
                   'constraint' => 100,
    
                ),

            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('log_clear2fac');
            $insert = $this->db->insert('log_clear2fac', $data);
        }else{
            $insert = $this->db->insert('log_clear2fac', $data);
        }


            $sendResult = [
                'status' => 1
                //success 
            ];
        } else {
            $sendResult = [
                'status' => 0
                //error
            ];
        }
        //ส่งค่า status กลับไป view - admin.php
        echo json_encode($sendResult);
        die;
    }
}

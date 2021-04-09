<?php
class PointToCredit extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->model('backend_model');
        $this->load->library('backend/backend_library');
        $this->_init();
    }

    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }

    public function point_to_credit()
    {
        $data['re_point'] = $this->db->select('id,username,user,point')
            ->where('status = ', 1)
            ->order_by('id', 'ASC')
            ->get('tb_user')
            ->result_array();

        $i = 0;

        foreach ($data['re_point'] as $dt) {

            if ($dt['point'] >= 20000) {     // point  >= 20,000

                $amount = $dt['point'] / 200; // พ้อยหาร200

                if ($this->deposit($dt['user'], $amount)) {
                    $set_point = array(
                        'point' => 0,
                        'spin' => 0,
                        'status' => 2,
                    );
                    $this->db->where('user', $dt['user'])->update('tb_user', $set_point);

                    $credit =  $amount;

                    $data['up_turnover'] = $this->db->where('user_id', $dt['id'])->get('tb_turnover')->result_array(); //ดึงข้อมูลใน turnover

                    if (sizeof($data['up_turnover']) == 0) { // ถ้าไม่มีช้อมูลใน tb_turnover
                        $set_data_turn = array(
                            'user_id' => $dt['id'],
                            'promotion_id' => 0,
                            'gift_code' => 0,
                            'sport' => '0',
                            'casino' => '0',
                            'game' => '0',
                            'checkturn' => $credit,
                            'check_time' => time(),
                            'status' => 1,
                        );
                        $this->db->insert('tb_turnover', $set_data_turn);  //insert

                    } else { //ถ้ามีใน tb_turnover

                        $j = 0;

                        foreach ($data['up_turnover'] as $up) { // วน tb_turnover

                            if ($up['user_id'] == $dt['id']) {
                                $set_data_turn = array(
                                    'checkturn' => $credit,
                                    'check_time' => time()
                                );
                                $this->db->where('user_id', $up['user_id'])->update('tb_turnover', $set_data_turn);
                            }

                            $j++;
                        }
                    }
                } else {
                    echo $dt['id'];
                    die;
                }
            } else {         // point  น้อยกว่า 20,000

                if ($dt['point'] > 199) {               // 200 ไปถึง 20,000

                    $amount = $dt['point'] / 200; ///พ้อยหาร 200

                    if ($this->deposit($dt['user'], $amount)) {
                        $set_point = array(
                            'point' => 0,
                            'spin' => 0,
                            'status' => 3
                        );
                        $this->db->where('user', $dt['user'])->update('tb_user', $set_point);
                    } else {
                        echo $dt['id'];
                        die;
                    }
                } else if ($dt['point'] >= 100 && $dt['point'] < 200) {          // 100 ไปถึง 200

                    $amount = 1;

                    if ($this->deposit($dt['user'], $amount)) {
                        $set_point = array(
                            'point' => 0,
                            'spin' => 0,
                            'status' => 3
                        );
                        $this->db->where('user', $dt['user'])->update('tb_user', $set_point);
                    } else {
                        echo $dt['id'];
                        die;
                    }
                } else {        //  point  น้อยกว่า 100
                    $set_point = array(
                        'point' => 0,
                        'spin' => 0,
                        'status' => 3
                    );
                    $this->db->where('user', $dt['user'])->update('tb_user', $set_point);
                }
            }

            $i++;
        }
    }




    public function deposit($user, $amount)
    {
        $user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
        if ($user_q->num_rows() == 1) {
            $user_r = $user_q->row();
            $arr_depAPI = array(
                'AgentName' => $this->getapi_model->agent(),
                'PlayerName' => $user_r->user,
                'Amount' => $amount,
                'TimeStamp' => time(),
            );
            $dataAPI = array(
                'type' => 'D',
                'agent' => $this->getapi_model->agent(),
                'member' => $user_r->user,
            );
            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';
            $cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
            if ($cre_userAPI->Success == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    function withdraw($user, $amount)
    {

        $user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
        if ($user_q->num_rows() == 1) {
            $user_r = $user_q->row();
            $arr_userAPI = array(
                'AgentName'    => $this->getapi_model->agent(),
                'PlayerName' => $user_r->user,
                'Amount'    => $amount,
                'TimeStamp'    => time()
            );

            $dataAPI = array(
                'type'        => 'W',
                'agent'     => $this->getapi_model->agent(),
                'member'     => $user_r->user,
            );

            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/withdraw';
            $cre_userAPI =  $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
            if ($cre_userAPI->Success == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
}

<?php
class Turntopoint extends MY_Controller
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
        // get setting turn to point

        $minturn = (float) $this->db->where('name', 'minTurnPoint')->get('setting')->row()->code;
        $percal = (float) $this->db->where('name', 'perPoint')->get('setting')->row()->code;

        $date = date('Y-m-d', strtotime(date('Y-m-d') . "-1 day"));
        $allturn = $this->getapi_model->get_turnover($date);
        // echo '<pre>';
        // print_r($allturn);
        // die();

        $log = [];

        foreach ($allturn->Result->Records as $key => $value) {
            if (strpos($value->UserName, 'i')) {
                $checkrankpoint = (float) $this->db->select('tb_rank.point')->join('tb_rank', 'tb_rank.id = tb_user_rank.id_rank')->where('tb_user_rank.user', $value->UserName)->get('tb_user_rank')->row()->point;

                ($checkrankpoint) ? $checkrankpoint : 1;

                $point = round($value->ValidAmount * ($percal * $checkrankpoint));

                $before = $this->db->select('point')->where('user', $value->UserName)->get('tb_user')->row()->point;
                $beforeRank = $this->db->select('total_turnover')->where('user', $value->UserName)->get('tb_user_rank')->row()->total_turnover;
                // echo '<pre>';
                // print_r($before);
                // die();
                if ($value->ValidAmount >= $minturn) {
                    // echo "save<br>";
                    $after = $before + $point;
                    array_push($log, array(
                        "user" => $value->UserName,
                        "point" => $point,
                        "before" => $before,
                        "after" => $after
                    ));

                    $this->db->set('point', 'point + ' . $after, FALSE)->where('user', $value->UserName)->update('tb_user');

                    $this->saverank($value->UserName, $beforeRank + $value->ValidAmount);
                } else {
                }
            }
        }
        $this->savelog($log);
    }



    function saverank($playerName, $after)
    {

        $tb_rank = $this->db->get('tb_rank')->result_array();
        $rank = 1;
        foreach ($tb_rank as  $value) {
            if ($after >= $value['trunover']) {
                $rank = $value['id'];
            }
        }

        if ($this->db->select('user')->where('user', $playerName)->get('tb_user_rank')->num_rows() == 0) {
            $this->db->set('user', $playerName)->set('total_turnover', $after)->set('id_rank', $rank)->insert('tb_user_rank');
        } else {
            $this->db->set('total_turnover', $after)->set('id_rank', $rank)->where('user', $playerName)->update('tb_user_rank');
        }
    }

    function savelog($log)
    {
        $log = json_encode($log);
        $this->db->set('created_time', strtotime(date("Y-m-d H:i")))->set('log_turn_point', $log)->insert('log_turn_to_point');
    }
}

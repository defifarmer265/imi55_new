<?php
class ApiTurn extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->dbforge();
        $this->load->model('create_table_model');
        $this->load->library('backend/backend_library');
        $this->load->helper('url');
        $this->_init();
    }

    private function _init()
    {
        // $this->output->set_template('tem_admin/tem_admin');
        // $this->backend_library->checkLoginAdmin();
    }
    public function index()
    {

        $date = date('Y-m-d', strtotime(date('Y-m-d') . "-1 day"));

        $allturn = $this->getapi_model->get_turnover($date);

        $webname = $this->db->where('name', 'web')->get('setting')->row()->code;
        
        

        $minturn = (float) $this->db->where('name', 'minTurnPoint')->get('setting')->row()->code;
        $percal = (float) $this->db->where('name', 'perPoint')->get('setting')->row()->code;

        $turn = [];
        $log = [];
        foreach ($allturn->Result->Records as $key => $value) {


            if (strpos($value->UserName, 'i')) {
                if(!$this->db->field_exists('sale', 'tb_sale_user')){
                    if($this->create_table_model->field_tb_sale_user()){
                        $this->save_sale_user();
                    }

                    if(!$this->db->field_exists('sale_username', 'tb_user_sale')){
                        if($this->create_table_model->field_tb_user_sale()){
                            $this->save_user_sale();
                        }
                    } 
                }
                $sale_user = $this->db->select('sale, username')->where('username', $value->UserName)->get('tb_sale_user');
                if ($sale_user->num_rows() > 0) {
                    $sale = $sale_user->row();
                    $sale = $sale->sale;
                    $user_sale = '';
                } else {
                    $user_sale = $this->db->select('sale_username, user_username')->where('user_username', $value->UserName)->get('tb_user_sale');
                    if ($user_sale->num_rows() > 0) {
                        $user = $user_sale->row();
                        $sale = '';
                        $user_sale = $user->sale_username;
                    } else {
                        $sale = '';
                        $user_sale = '';
                    }
                }


                $turn = array(
                    "comm" => $value->Comm,
                    "win" => $value->Win,
                    "total" => $value->Total,
                    "player_id" => $value->PlayerId,
                    "member_id" => $value->MemberId,
                    "username" => $value->UserName,
                    "sale" => $sale,
                    "user_sale" => $user_sale,
                    "turnover" => $value->TurnOver,
                    "grosscomm" => $value->GrossComm,
                    "payout" => $value->Payout,
                    "valid_amount" => $value->ValidAmount,
                    "company" => $value->Company,
                    "role" => $value->Role,
                    "loyalty" => $value->Loyalty,
                    "created_time" => strtotime($date)
                );


                if ($this->db->table_exists('tb_turn') != 1){
                    $this->create_table_model->tb_tb_turn();
                    $insert = $this->db->insert('tb_turn', $turn);
                }else{
                    $insert = $this->db->insert('tb_turn', $turn);
                }

                
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

                    $this->db->set('point',$after)->where('user', $value->UserName)->update('tb_user');

                    $this->saverank($value->UserName, $beforeRank + $value->ValidAmount);
                } else {
                    $this->saverank($value->UserName, $beforeRank + $value->ValidAmount);
                }
            }
        }

        if ($this->savelog($log)) {
            redirect('backend/deposit');
        }
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

    function save_sale_user(){
      

        $user = $this->db->get('tb_sale_user');
        if($user->num_rows() > 0){
            $user_s = $user->result_array();
            foreach($user_s as $us){
                if($sale_u = $this->db->select('username')->where('id', $us['sale_id'])->get('tb_sale')->row()){
                    $this->db->set('sale', $sale_u->username)->where('sale_id', $us['sale_id'])->update('tb_sale_user');
                    if($user_u = $this->db->select('user')->where('id', $us['user_id'])->get('tb_user')->row()){
                        $this->db->set('username', $user_u->user)->where('user_id', $us['user_id'])->update('tb_sale_user');
                    }
                }
            }
        }

    }

    function save_user_sale(){
        
            $user = $this->db->get('tb_user_sale');
            if($user->num_rows() > 0){
                $user_s = $user->result_array();
                foreach($user_s as $us){
                    if($sale_u = $this->db->select('user')->where('id', $us['sale_userid'])->get('tb_user')->row()){
                        $this->db->set('sale_username', $sale_u->user)->where('sale_userid', $us['sale_userid'])->update('tb_user_sale');
                        if($user_u = $this->db->select('user')->where('id', $us['user_id'])->get('tb_user')->row()){
                            $this->db->set('user_username', $user_u->user)->where('user_id', $us['user_id'])->update('tb_user_sale');
                        }
                    }
                }
            }

    }

}

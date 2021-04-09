<?php
class Testturn extends MY_Controller
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
        $date = date('Y-m-d', strtotime(date('Y-m-d') . "-1 day"));
        $allturn = $this->getdataMongo($date,$date);
  
        foreach($allturn as $key => $value){
            $turn = array(
                "comm" => $value['comm'],
                "win" => $value['win'],
                "total" => $value['total'],
                "player_id" => $value['player_id'],
                "member_id" => $value['member_id'],
                "username" => $value['username'],
                "turnover" => $value['turnover'],
                "grosscomm" => $value['grosscomm'],
                "payout" => $value['payout'],
                "valid_amount" => $value['valid_amount'],
                "company" => $value['company'],
                "role" => $value['role'],
                "loyalty" => $value['loyalty'],
                "created_time" => $value['created_time']
            );
            $insert_turn = $this->db->insert('tb_turn', $turn);
        }
        // if($insert_turn)
        // {
        //     redirect('backend/deposit');
        // }
    }

    function getdataMongo($date)
    {

        $arr_userAPI =    array(
                "StartDate"=>$date,
                "EndDate"=>$date,
                "PageSize"=>9999999,
                "PageIndex"=>1,
                "MemberName"=>$this->getapi_model->agent(),
                "AgentName"=>$this->getapi_model->agent(),
                "PlayerName"=>"", 
                "Products"=>[1, 2, 3, 4, 6, 7],
                "Currency"=>"", 
                "AgentCurrency"=>true,
                "TimeStamp"=> time(),         
        );
        $dataAPI = array(
            'type' => 'GT',
            'agent' => $this->getapi_model->agent()
        );
        $arr_userAPI['sign'] = $this->getapi_model->sign($dataAPI);
    
        $url_api = 'https://ctransferapi.linkv2.com/api/reports/simplewinlose';
        $sent_API = $this->getapi_model->getapi($arr_userAPI,$url_api,$dataAPI);
        // echo '<pre>';
        // print_r($sent_API);
        // die();
            $records = [];
            // $i=0;
            foreach($sent_API->Result->Records as $key => $value){
              if(strpos($value->UserName, 'i')){
                array_push($records, array(
                    "comm" => $value->Comm,
                    "win" => $value->Win,
                    "total" => $value->Total,
                    "player_id" => $value->PlayerId,
                    "member_id" => $value->MemberId,
                    "username" => $value->UserName,
                    "turnover" => $value->TurnOver,
                    "grosscomm" => $value->GrossComm,
                    "payout" => $value->Payout,
                    "valid_amount" => $value->ValidAmount,
                    "company" => $value->Company,
                    "role" => $value->Role,
                    "loyalty" => $value->Loyalty,
                    "created_time" => strtotime($date)
                ));
              }
              
            }

          return $records;
      

    }


   
}

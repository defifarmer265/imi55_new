<?php
class Ss extends MY_Controller
{
    public function __construct()
    {

        $this->load->helper('url');
        $this->load->model('backend/getapi_model');
        $this->load->model('owner_model');
        $this->load->library('owner_libraray');
        $this->owner_libraray->login();
        $this->output->set_template('tem_owner/tem_owner');
    }



    function index()
    {

        // ดึงเทิร์นโอเวอร์ =============================================
        $getuser    = $this->db->select('tb_user.user')
            ->join('tb_user', 'tb_user.id = tb_sale_user.user_id', 'left')
            ->where('tb_sale_user.sale_id', '9')
            ->where('tb_user.create_time >=', '1601744400')
            ->where('tb_user.create_time <=', '1601917199')
            ->get('tb_sale_user')
            ->result_array();

        $sumt = 0;
        $user = [];
        foreach ($getuser as $k => $val) {
            array_push($user,array("MemberName"=>"" . $val['user']));
        }
            $data_sent = json_encode(array(
                'query' => (array(
                    'tb_name' => $this->getapi_model->agent(),
                    'where' => array(
                        "Operators" => array(
                            "and" => array(
                                "data" => [array(
                                    "imiTime" => array('$gte' => "1601744400", '$lte' => "1601917199"),
                                    '$or' => $user
                                )]
                            ),
                        ),
                    ),
                    "skip" => 0,
                    "limit" => 0,
                    "sort" => array("_id" => -1),
                    'de_selector' => array("ValidAmount" => 1,"_id"=>0)
                )),
                'data' => null
            ));

   
            
            $d = json_decode($this->getapi_model->call_API_mongo($data_sent, "GET"));

            	if(sizeof($d)>0){
            		foreach ($d as $key => $v) {
            		$sumt += (float)$v->ValidAmount;

            	}
            }

        $data['sumturnover'] = $sumt;
// =========================================================
        echo json_encode($data);
        die();
    }
}

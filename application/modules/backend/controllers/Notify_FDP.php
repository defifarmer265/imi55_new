<?php
class Notify_FDP extends MY_Controller
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
        // $this->output->set_template('tem_admin/tem_admin');
        // $this->backend_library->checkLoginAdmin();
    }
    public function clear_state()
    {
        $this->sum_state->sum_data_state();
    }
    public function index()
    {
        $date_today = strtotime(date('Y-m-d 10:59:59', time()));
        $date_ago = strtotime(date('Y-m-d 11:00:00', strtotime('-1day')));
        $data['user'] = $this->db->where('create_time >=', $date_ago)->where('create_time <=', $date_today)->where('status', 1)->get('tb_user')->result_array();
        $count_firtdeposit = 0;
        $count_user = 0;
        $sum_firtdeposit = 0;
        foreach ($data['user'] as $data_user) {
            $firt_deposit = $this->db
                ->where('datetime >=', $date_ago)
                ->where('datetime <=', $date_today)
                ->where('user_id', $data_user['id'])
                ->where('deposit >', 0)
                ->where('status', 2)
                ->order_by('id', 'ASC')
                ->group_by('deposit')
                ->get('tb_statement');
            if ($firt_deposit->num_rows() == 1) {
                $count_firtdeposit++;
                $sum_firtdeposit = $sum_firtdeposit + $firt_deposit->row()->deposit;
            }
            $count_user++;
        }
        $data_ = array(
            'count_user' => $count_user,
            'count_first_deposit' => $count_firtdeposit,
            'sum_first_deposit' => $sum_firtdeposit,
        );
        $txt = "\nUser ใหม่ : " . $data_['count_user'];
        $txt .= "\nฝากยอดแรก " . $data_['count_first_deposit'] . " รายการ";
        $txt .= "\nรวม : " . number_format($data_['sum_first_deposit'], 2) . " บาท";
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
                "Authorization: Bearer EGjDOr8RnxRTF3r1Qe7wTRdkTaKvEovJp8z27NwevTO",
                "Content-Type: application/x-www-form-urlencoded",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        redirect('backend/deposit');
        die;
    }

   
}

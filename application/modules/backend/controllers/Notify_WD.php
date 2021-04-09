<?php
class Notify_WD extends MY_Controller
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
        $count_1 = 0;
        $count_2 = 0;
        $count_3 = 0;
        $count_4 = 0;
        $count_5 = 0;
        $count_6 = 0;
        $count_7 = 0;
        $count_8 = 0;
        $count_9 = 0;
        $count_10 = 0;
        $sum = 0;
        $data['statement'] = $this->db->where('datetime >=', $date_ago)->where('datetime <=', $date_today)->where('withdraw >=', 5000)->where('status', 2)->get('tb_statement')->result_array();
        foreach ($data['statement'] as $statement) {
            if ($statement['withdraw'] >= 5000 && $statement['withdraw'] <= 10000) {
                $count_1++;
            } else if ($statement['withdraw'] >= 10001 && $statement['withdraw'] <= 20000) {
                $count_2++;
            } else if ($statement['withdraw'] >= 20001 && $statement['withdraw'] <= 30000) {
                $count_3++;
            } else if ($statement['withdraw'] >= 30001 && $statement['withdraw'] <= 40000) {
                $count_4++;
            } else if ($statement['withdraw'] >= 40001 && $statement['withdraw'] <= 50000) {
                $count_5++;
            } else if ($statement['withdraw'] >= 50001 && $statement['withdraw'] <= 60000) {
                $count_6++;
            } else if ($statement['withdraw'] >= 60001 && $statement['withdraw'] <= 70000) {
                $count_7++;
            } else if ($statement['withdraw'] >= 70001 && $statement['withdraw'] <= 80000) {
                $count_8++;
            } else if ($statement['withdraw'] >= 80001 && $statement['withdraw'] <= 90000) {
                $count_9++;
            } else if ($statement['withdraw'] >= 100000) {
                $count_10++;
            }
            $sum = $statement['withdraw'] + $sum;
        }

        // line notify withdraw
        $txt = "\n5,000-10,000 : " . $count_1 . " ยอด";
        $txt .= "\n10,000-20,000 : " . $count_2 . " ยอด";
        $txt .= "\n20,001-30,000 : " . $count_3 . " ยอด";
        $txt .= "\n30,001-40,000 : " . $count_4 . " ยอด";
        $txt .= "\n40,001-50,000 : " . $count_5 . " ยอด";
        $txt .= "\n50,001-60,000 : " . $count_6 . " ยอด";
        $txt .= "\n60,001-70,000 : " . $count_7 . " ยอด";
        $txt .= "\n70,001-80,000 : " . $count_8 . " ยอด";
        $txt .= "\n80,001-90,000 : " . $count_9 . " ยอด";
        $txt .= "\n100,000 : " . $count_10 . " ยอด";
        $txt .= "\nรวม : " . number_format($sum, 2) . " บาท";

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

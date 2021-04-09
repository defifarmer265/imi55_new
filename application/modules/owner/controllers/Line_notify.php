<?php
class Line_notify extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->_init();
        $this->load->model('backend/getapi_model');
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('owner_model');
        $this->load->library('owner_libraray');
        $this->owner_libraray->login();
    }
    private function _init()
    {
        $this->output->set_template('tem_owner/tem_owner');
    }

    public function index()
    {
        $query['line'] = $this->db->get('tb_linenotify')->result_array();

        /* 	echo "<pre>";
        print_r ($query);
        echo "</pre>";
        die; */

        $this->load->view('line_notify', $query);
    }

    public function modify_token()
    {

        //		Array ( [lntf_type] => register [token] => wPLMu0ex5vJVNOcJ2R0LkDBWC7N5NJsV094ILzx1 [balance] => 0 [delay] => 0 )
        if ($this->input->post('lntf_type') && $this->input->post('token')) {
            $arr_token = array(
                'token' 	=> $this->input->post('token'),
                'balance' 	=> $this->input->post('balance'),
                'delay' 	=> $this->input->post('delay'),
            );
            if ($this->db->where('type', $this->input->post('lntf_type'))->update('tb_linenotify', $arr_token)) {
                $re = array('msg' => 'Sucess : 001', 'code' => 1);

              if ($this->db->table_exists('setting_line_notify')) {
                    if ($this->db->set('value', $this->input->post('token'))->where('name', $this->input->post('lntf_type'))->update('setting_line_notify')) {
                        $re = array('msg' => 'Sucess : 001', 'code' => 1);
                    } else {
                        $re = array('msg' => 'ERROR : 002', 'code' => 0);
                    }
                }
            } else {
                $re = array('msg' => 'ER: 002', 'code' => 0);
            }
        } else {
            $re = array('msg' => 'ER: 001', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }


    // ============================== farn line Notification======================

    public function line_notification()
    {
        $time_now = strtotime(date('11:00'));
        $today_11am = strtotime(date('11:00'));
        $yesterday_11am = strtotime(date('11:00')) - (60 * 60 * 24);

        /*----------------------  Report hourly ------------------------------*/
        if ($time_now % (60 * 60) == 0) {
            $time = strtotime(date('H:i'));
            $time2 = strtotime(date('H:i')) - (60 * 60);
            $q_hourly = $this->db->select('
										tb_bank_web.name,
										tb_bank_web.account,
										tb_bank.bank_th	,
										tb_statement.bank_id,
										sum(tb_statement.deposit)AS sum_deposit,
										sum(tb_statement.withdraw)AS sum_withdraw,
										')
                ->join('tb_bank_web', ' tb_bank_web.id = tb_statement.bank_id')
                ->join('tb_bank', ' tb_bank.id = tb_statement.bank_id')
                ->where_in('tb_statement.status', array(2, 3))
                ->where('tb_statement.datetime <', $time)
                ->where('tb_statement.datetime >', $time2)
                ->group_by('tb_statement.bank_id')
                ->get('tb_statement')
                ->result_array();

            if (sizeof($q_hourly) != 0) {
                $data = [];
                for ($i = 0; $i < sizeof($q_hourly); $i++) {
                    array_push($data, array(
                        'bank' => $q_hourly[$i]['bank_th'],
                        'account' => $q_hourly[$i]['account'],
                        'name' => $q_hourly[$i]['name'],
                        'bank_id' => $q_hourly[$i]['bank_id'],
                        'sum_deposit' => $q_hourly[$i]['sum_deposit'],
                        'sum_withdraw' => $q_hourly[$i]['sum_withdraw'],
                        'time_now' => date('H:i'),
                        'time_1hour_ago' => date('H:i', strtotime('' . '-1 hour'))
                    ));
                }
            }
            for ($j = 0; $j < sizeof($data); $j++) {
                $txt = "รายงาน \n เวลา : " . $data[$j]['time_1hour_ago'] . " ถึง " . $data[$j]['time_now'];
                $txt .= "\n ชื่อธนาคาร : " . $data[$j]['bank'];
                $txt .= "\n เลขที่บัญชี : " . $data[$j]['account'];
                $txt .= "\n ชื่อบัญชี : " . $data[$j]['name'];
                $txt .= "\n ยอดฝากรวม : " . number_format($data[$j]['sum_deposit'], 2);
                $txt .= "\n ยอดถอนรวม : " . number_format($data[$j]['sum_withdraw'], 2);

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
                    CURLOPT_POSTFIELDS => "message= $txt",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/x-www-form-urlencoded",
                        "Authorization: Bearer ct18vwdcFJi4tBThJsJIKRckefT80nOwzrVsLFVnqGD"
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
            }
        }


        /*----------------------  Report dayly ------------------------------*/
        if ($time_now % (60*60*24) == 14400) {
            $q_dayly = $this->db->select('
			tb_bank_web.name,
			tb_bank_web.account,
			tb_bank.bank_th	,
			tb_statement.bank_id,
			sum(tb_statement.deposit)AS sum_deposit,
			sum(tb_statement.withdraw)AS sum_withdraw,
				')
                ->join('tb_bank_web', ' tb_bank_web.id = tb_statement.bank_id')
                ->join('tb_bank', ' tb_bank.id = tb_statement.bank_id')
                ->where_in('tb_statement.status', array(2, 3))
                ->where('tb_statement.datetime <', $yesterday_11am)
                ->where('tb_statement.datetime >', $today_11am)
                ->group_by('tb_statement.bank_id')
                ->get('tb_statement')
                ->result_array();

            if (sizeof($q_dayly) != 0) {
                $data = [];
                for ($i = 0; $i < sizeof($q_dayly); $i++) {
                    array_push($data, array(
                        'bank' => $q_dayly[$i]['bank_th'],
                        'account' => $q_dayly[$i]['account'],
                        'name' => $q_dayly[$i]['name'],
                        'bank_id' => $q_dayly[$i]['bank_id'],
                        'sum_deposit' => $q_dayly[$i]['sum_deposit'],
                        'sum_withdraw' => $q_dayly[$i]['sum_withdraw'],
                        'time_11am' => date('11:00'),
                        'time_today_day' => date('d-m-Y'),
                        'time_yesteday_day' => date('d-m-Y', strtotime(date('d-m-Y') . '-1 day')),
                    ));
                }
            }
            for ($j = 0; $j < sizeof($data); $j++) {
                $txt = "รายงาน \n วันที่ : " . $data[$j]['time_yesteday_day'] . " เวลา " . $data[$j]['time_11am'];
                $txt .= "\n ถึง วันที่ : " . $data[$j]['time_today_day'] . " เวลา " . $data[$j]['time_11am'];
                $txt .= "\n ชื่อธนาคาร : " . $data[$j]['bank'];
                $txt .= "\n เลขที่บัญชี : " . $data[$j]['account'];
                $txt .= "\n ชื่อบัญชี : " . $data[$j]['name'];
                $txt .= "\n ยอดฝากรวม : " . number_format($data[$j]['sum_deposit'], 2);
                $txt .= "\n ยอดถอนรวม : " . number_format($data[$j]['sum_withdraw'], 2);

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
                    CURLOPT_POSTFIELDS => "message= $txt",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/x-www-form-urlencoded",
                        "Authorization: Bearer ct18vwdcFJi4tBThJsJIKRckefT80nOwzrVsLFVnqGD"
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
            }
        }
    }
    //token : ct18vwdcFJi4tBThJsJIKRckefT80nOwzrVsLFVnqGD


    //============================== end  farn line Notification======================
    public function in_credit()
    {
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
                    CURLOPT_POSTFIELDS => "message=อับดลกอเดร์ ด่าโอะ",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/x-www-form-urlencoded",
                        "Authorization: Bearer xMevktfe3Hl8daM0xSXJimV4KOCvfRnnbUG54O1Carr"
                    ),
                    ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        die;
    }
}

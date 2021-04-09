  <?php
class Events extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('backend/getapi_model');
        $this->load->library('Member_libraray');
        $this->load->model('api/api_model');
        $this->_init();
    }
    private function _init()
    {
        $this->output->set_template('tem_web/tem_mapraw');
        $this->member_libraray->login();
    }

    public function index()
    {
        $user_id = $this->session->userdata['member']->id;

        $arr_data['event'] = $this->db->where('status', 1)->get('tb_event');
        if (sizeof($arr_data['event']->result_array()) == 0) {
			$arr_data['event'] = $arr_data['event']->result_array();
			$this->load->view('events_view', $arr_data);

        } else {
            $arr_data['event'] = $arr_data['event']->row();
            $deposit = $arr_data['event']->deposit;

            $event_id = $this->db->where('status', 1)->get('tb_event')->row()->id;
            $statement = $this->db->where('user_id', $user_id)->where('deposit >', 1)->order_by('id', 'DESC')->limit(1)->get('tb_statement'); //ฝากล่าสุด

            $log_event = $this->db->where('user_id', $user_id)->where('event_id', $event_id)->order_by('id', 'DESC')->get('log_event');

            if ($log_event->num_rows() != 0 && $statement->row()->datetime < $log_event->row()->time) {

                $arr_data['count'] = array(
                    'day1' => 0,
                    'day2' => 0,
                    'day3' => 0,
                    'day4' => 0,
                    'day5' => 0,
                    'day6' => 0,
                    'day7' => 0,
                );

                foreach ($arr_data['count'] as $cn) {
                    if ($cn == 0) {
                        // $arr_data['bt'] = '<a href="javascript:void(0)" onclick="receive(' . $arr_data['event']->id . ')"><img class="card-img-top" src=" ' . base_url() . 'public/event/receive.png" alt="Card image"></a>';
                        $arr_data['bt'] = '';
                    } else {
                        // $arr_data['bt'] = '';
                        $arr_data['bt'] = '<a href="javascript:void(0)" onclick="receive(' . $arr_data['event']->id . ')"><img class="card-img-top" src=" ' . base_url() . 'public/event/receive.png" alt="Card image"></a>';
                    }
                }
                $this->load->view('events_view', $arr_data);
            } else {

                $time = strtotime(date('d-m-Y 23:59:59', $statement->row()->datetime));
                $time_ago = strtotime(date('d-m-Y 00:00:00', $time));

                $day1 = $this->db->select('SUM(deposit) as sum_deposit')
                    ->where('user_id', $user_id)
                    ->where('datetime <', $time)
                    ->where('datetime >', $time_ago)
                    ->where('deposit >', 1)
                    ->order_by('id', 'DESC')
                    ->get('tb_statement');

                if ($day1->row()->sum_deposit >= $deposit) { //day1

                    $arr_data['count'] = array(
                        'day1' => date('d-m-Y', $statement->row()->datetime),
                        'day2' => 0,
                        'day3' => 0,
                        'day4' => 0,
                        'day5' => 0,
                        'day6' => 0,
                        'day7' => 0,
                    );

                    $time = strtotime(date('d-m-Y 23:59:59', strtotime("-1 day", $time)));
                    $time_ago = strtotime(date('d-m-Y 00:00:00', $time));

                    $day2 = $this->db->select('SUM(deposit) as sum_deposit')
                        ->where('user_id', $user_id)
                        ->where('datetime <', $time)
                        ->where('datetime >', $time_ago)
                        ->where('deposit >', 1)
                        ->order_by('id', 'DESC')
                        ->get('tb_statement');

                    if ($day2->row()->sum_deposit >= $deposit) { //day2

                        $arr_data['count'] = array(
                            'day1' => date('d-m-Y', $statement->row()->datetime), //day 1
                            'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                            'day3' => 0,
                            'day4' => 0,
                            'day5' => 0,
                            'day6' => 0,
                            'day7' => 0,
                        );

                        $time = strtotime(date('d-m-Y 23:59:59', strtotime("-1 day", $time)));
                        $time_ago = strtotime(date('d-m-Y 00:00:00', $time));

                        $day3 = $this->db->select('SUM(deposit) as sum_deposit')
                            ->where('user_id', $user_id)
                            ->where('datetime <', $time)
                            ->where('datetime >', $time_ago)
                            ->where('deposit >', 1)
                            ->order_by('id', 'DESC')
                            ->get('tb_statement');

                        if ($day3->row()->sum_deposit >= $deposit) { //day3
                            $arr_data['count'] = array(
                                'day1' => date('d-m-Y', $statement->row()->datetime),
                                'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                'day4' => 0,
                                'day5' => 0,
                                'day6' => 0,
                                'day7' => 0,
                            );

                            $time = strtotime(date('d-m-Y 23:59:59', strtotime("-1 day", $time)));
                            $time_ago = strtotime(date('d-m-Y 00:00:00', $time));

                            $day4 = $this->db->select('SUM(deposit) as sum_deposit')
                                ->where('user_id', $user_id)
                                ->where('datetime <', $time)
                                ->where('datetime >', $time_ago)
                                ->where('deposit >', 1)
                                ->order_by('id', 'DESC')
                                ->get('tb_statement');

                            if ($day4->row()->sum_deposit >= $deposit) { //day4
                                $arr_data['count'] = array(
                                    'day1' => date('d-m-Y', $statement->row()->datetime),
                                    'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                    'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                    'day4' => date('d-m-Y', strtotime("-3 day", $statement->row()->datetime)),
                                    'day5' => 0,
                                    'day6' => 0,
                                    'day7' => 0,
                                );

                                $time = strtotime(date('d-m-Y 23:59:59', strtotime("-1 day", $time)));
                                $time_ago = strtotime(date('d-m-Y 00:00:00', $time));

                                $day5 = $this->db->select('SUM(deposit) as sum_deposit')
                                    ->where('user_id', $user_id)
                                    ->where('datetime <', $time)
                                    ->where('datetime >', $time_ago)
                                    ->where('deposit >', 1)
                                    ->order_by('id', 'DESC')
                                    ->get('tb_statement');

                                if ($day5->row()->sum_deposit >= $deposit) { //day5
                                    $arr_data['count'] = array(
                                        'day1' => date('d-m-Y', $statement->row()->datetime),
                                        'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                        'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                        'day4' => date('d-m-Y', strtotime("-3 day", $statement->row()->datetime)),
                                        'day4' => date('d-m-Y', strtotime("-4 day", $statement->row()->datetime)),
                                        'day6' => 0,
                                        'day7' => 0,
                                    );

                                    $time = strtotime(date('d-m-Y 23:59:59', strtotime("-1 day", $time)));
                                    $time_ago = strtotime(date('d-m-Y 00:00:00', $time));

                                    $day6 = $this->db->select('SUM(deposit) as sum_deposit')
                                        ->where('user_id', $user_id)
                                        ->where('datetime <', $time)
                                        ->where('datetime >', $time_ago)
                                        ->where('deposit >', 1)
                                        ->order_by('id', 'DESC')
                                        ->get('tb_statement');

                                    if ($day6->row()->sum_deposit >= $deposit) { //day6
                                        $arr_data['count'] = array(
                                            'day1' => date('d-m-Y', $statement->row()->datetime),
                                            'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                            'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                            'day4' => date('d-m-Y', strtotime("-3 day", $statement->row()->datetime)),
                                            'day4' => date('d-m-Y', strtotime("-4 day", $statement->row()->datetime)),
                                            'day6' => date('d-m-Y', strtotime("-5 day", $statement->row()->datetime)),
                                            'day7' => 0,
                                        );

                                        $time = strtotime(date('d-m-Y 23:59:59', strtotime("-1 day", $time)));
                                        $time_ago = strtotime(date('d-m-Y 00:00:00', $time));

                                        $day7 = $this->db->select('SUM(deposit) as sum_deposit')
                                            ->where('user_id', $user_id)
                                            ->where('datetime <', $time)
                                            ->where('datetime >', $time_ago)
                                            ->where('deposit >', 1)
                                            ->order_by('id', 'DESC')
                                            ->get('tb_statement');

                                        if ($day7->row()->sum_deposit >= $deposit) { //day7
                                            $arr_data['count'] = array(
                                                'day1' => date('d-m-Y', $statement->row()->datetime),
                                                'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                                'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                                'day4' => date('d-m-Y', strtotime("-3 day", $statement->row()->datetime)),
                                                'day5' => date('d-m-Y', strtotime("-4 day", $statement->row()->datetime)),
                                                'day6' => date('d-m-Y', strtotime("-5 day", $statement->row()->datetime)),
                                                'day7' => date('d-m-Y', strtotime("-6 day", $statement->row()->datetime)),
                                            );
                                        } else {
                                            $arr_data['count'] = array(
                                                'day1' => date('d-m-Y', $statement->row()->datetime),
                                                'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                                'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                                'day4' => date('d-m-Y', strtotime("-3 day", $statement->row()->datetime)),
                                                'day5' => date('d-m-Y', strtotime("-4 day", $statement->row()->datetime)),
                                                'day6' => date('d-m-Y', strtotime("-5 day", $statement->row()->datetime)),
                                                'day7' => 0,
                                            );
                                        }
                                    } else {
                                        $arr_data['count'] = array(
                                            'day1' => date('d-m-Y', $statement->row()->datetime),
                                            'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                            'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                            'day4' => date('d-m-Y', strtotime("-3 day", $statement->row()->datetime)),
                                            'day5' => date('d-m-Y', strtotime("-4 day", $statement->row()->datetime)),
                                            'day6' => 0,
                                            'day7' => 0,
                                        );
                                    }
                                } else {
                                    $arr_data['count'] = array(
                                        'day1' => date('d-m-Y', $statement->row()->datetime),
                                        'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                        'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                        'day4' => date('d-m-Y', strtotime("-3 day", $statement->row()->datetime)),
                                        'day5' => 0,
                                        'day6' => 0,
                                        'day7' => 0,
                                    );
                                }
                            } else {
                                $arr_data['count'] = array(
                                    'day1' => date('d-m-Y', $statement->row()->datetime),
                                    'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                    'day3' => date('d-m-Y', strtotime("-2 day", $statement->row()->datetime)),
                                    'day4' => 0,
                                    'day5' => 0,
                                    'day6' => 0,
                                    'day7' => 0,
                                );
                            }
                        } else {
                            $arr_data['count'] = array(
                                'day1' => date('d-m-Y', $statement->row()->datetime),
                                'day2' => date('d-m-Y', strtotime("-1 day", $statement->row()->datetime)),
                                'day3' => 0,
                                'day4' => 0,
                                'day5' => 0,
                                'day6' => 0,
                                'day7' => 0,
                            );
                        }
                    } else {
                        $arr_data['count'] = array(
                            'day1' => date('d-m-Y', $statement->row()->datetime),
                            'day2' => 0,
                            'day3' => 0,
                            'day4' => 0,
                            'day5' => 0,
                            'day6' => 0,
                            'day7' => 0,
                        );
                    }
                } else {
                    $arr_data['count'] = array(
                        'day1' => 0,
                        'day2' => 0,
                        'day3' => 0,
                        'day4' => 0,
                        'day5' => 0,
                        'day6' => 0,
                        'day7' => 0,
                    );
                }

                foreach ($arr_data['count'] as $cn) {
                    if ($cn == 0) {
                        $arr_data['bt'] = '';
                    } else {
                        $arr_data['bt'] = '<a href="javascript:void(0)" onclick="receive(' . $arr_data['event']->id . ')"><img class="card-img-top" src=" ' . base_url() . 'public/event/receive.png" alt="Card image"></a>';
                    }
                }
                $this->load->view('events_view', $arr_data);
            }
        }
    }

    public function receive_event()
    {

        $event_id = $this->input->post('id');
        $user_id = $this->session->userdata['member']->id;
        $user = $this->session->userdata['member']->user;

        $tb_event = $this->db->where('id', $event_id)->where('status', 1)->get('tb_event');
        $tb_user = $this->db->where('id', $user_id)->where('status', 1)->get('tb_user');

        if ($tb_event->num_rows() == 1) {

            $tb_event = $tb_event->row();

            if ($tb_user->num_rows() == 1) {

                if (time() > $tb_event->time_start && time() < $tb_event->time_end) { //ช่วงเวลา

                    if ($tb_event->count > 0) { //มีสิทการรับ

                        if ($tb_event->user == 0) {

                            if ($this->old_user($user_id, $tb_event->time_start) == false) {
                                $re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
                                echo json_encode($re);
                                die;
                            }
                        } else if ($tb_event->user == 1) {
                            if ($this->new_user($user_id, $tb_event->time_start) == false) {
                                $re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
                                echo json_encode($re);
                                die;
                            }
                        } else {
                            if ($this->all_user($user_id, $tb_event->time_start) == false) {
                                $re = array('code' => 0, 'msg' => 'ยูสเซอร์ไม่เข้าเงื่อนไขการรับ');
                                echo json_encode($re);
                                die;
                            }
                        }

                        $count = $tb_event->count; //จำนวนสิท
                        $type_turnover = $tb_event->type_turnover; //ประเภทการติดเทิน
                        $turnover = $tb_event->turnover; //เทิร์น

                        if ($tb_event->credit != 0) { // add credit
                            $user_credit_before = $this->get_credit($user); //เครดิตก่อนเพิ่ม
                            $bonus_credit = $tb_event->credit; //เครดิตที่จะเพิ่ม
                            $re = $this->add_credit($user, $bonus_credit, $type_turnover, $user_id, $turnover, $event_id, $count, $user_credit_before);
                        } else if ($tb_event->percent != 0 && $tb_event->amount_max != 0) { //เครดิตเปอเซนต์
                            $user_credit_before = $this->get_credit($user); //เครดิตก่อนเพิ่ม

                            $statement = $this->db->where('user_id', $user_id)->where('deposit >', 1)->order_by('id', 'DESC')->limit(1)->get('tb_statement'); //ฝากล่าสุด

                            $time_st = $statement->row()->datetime;
                            $time_e = date('Y-m-d 00:00:00', $statement->row()->datetime);
                            $time_st_ago = strtotime("-6 day", strtotime($time_e));

                            $sum_statement = $this->db->select('SUM(deposit) as sum_deposit')
                                ->where('user_id', $user_id)
                                ->where('deposit >', 1)
                                ->where('datetime >= ', $time_st_ago)
                                ->where('datetime <= ', $time_st)
                                ->get('tb_statement')
                                ->row();

                            $bonus_credit = ((($sum_statement->sum_deposit) * 1) / 7) * (($tb_event->percent) / 100);

                            if ($bonus_credit >= $tb_event->amount_max) {
                                $bonus_credit = $tb_event->amount_max;
                            }

                            $re = $this->add_credit($user, $bonus_credit, $type_turnover, $user_id, $turnover, $event_id, $count, $user_credit_before);
                        } else { //add point
                            $bonus_point = $tb_event->point; //เครดิตที่จะเพิ่ม
                            $re = $this->add_point($user_id, $bonus_point, $type_turnover, $turnover, $event_id, $count);
                        }
                    } else {
                        $re = array('code' => 0, 'msg' => 'สิทธิ์การรับหมดแล้ว');
                    }
                } else {
                    $re = array('code' => 0, 'msg' => 'ไม่อยู่ในช่วงเวลาจัด Event');
                }
            } else {
                $re = array('code' => 0, 'msg' => 'ไม่มียูสเซอร์นี้นี้');
            }
        } else {
            $re = array('code' => 0, 'msg' => 'ไม่สามารถรับได้');
        }
        echo json_encode($re);
        die;
    }

    public function add_credit($user, $bonus_credit, $type_turnover, $user_id, $turnover, $event_id, $count, $user_credit_before)
    {

        if ($this->deposit($user, $bonus_credit)) {
            // if (true) {
            switch ($type_turnover) { //เช็คเงื่อนไไขโปร
                case 0:
                    break;
                case 1: //ฟิกเทิร์น
                    $tb_turnover = $this->check_tb_turnover($user_id);
                    $data_turn = array(
                        'checkturn' => floor(($tb_turnover->checkturn * 1) + $turnover), //เทิร์นเก่า + เทิร์นที่ฟิก
                    );
                    $this->db->where('user_id', $user_id)->update('tb_turnover', $data_turn); //update tb_turnover
                    break;
                default: //เทิร์นเป็นเท่า
                    $tb_turnover = $this->check_tb_turnover($user_id);
                    $turnover = $bonus_credit * $turnover; //เครดิตที่แจก * เท่าของเทิรน
                    $data_turn = array(
                        'checkturn' => floor(($tb_turnover->checkturn * 1) + $turnover), // เทิร์เนเก่า + เทิร์นที่คิดแล้ว
                    );
                    $this->db->where('user_id', $user_id)->update('tb_turnover', $data_turn); //update tb_turnover
                    break;
            }
            $arr_count = array(
                'count' => $count - 1,
            );
            $this->db->where('id', $event_id)->update('tb_event', $arr_count); // จำนวน -1

            $arr_log = array(
                'user_id' => $user_id,
                'event_id' => $event_id,
                'before_creadit' => $user_credit_before,
                'after_creadit' => $this->get_credit($user),
                'before_point' => 0,
                'after_point' => 0,
                'time' => time(),
            );
            $this->db->insert('log_event', $arr_log); //insert log

            return array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
        } else {
            return array('code' => 0, 'msg' => 'ไม่สามารถเพิ่มเครดิตได้กรุณาติดต่อพนักงาน');
        }
    }

    public function add_point($user_id, $bonus_point, $type_turnover, $turnover, $event_id, $count)
    {
        $user_point_before = $this->db->where('id', $user_id)->where('status', 1)->get('tb_user')->row()->point;
        $data_point = array(
            'point' => ($user_point_before + $bonus_point),
        );
        $this->db->where('id', $user_id)->update('tb_user', $data_point); //update tb_turnover

        switch ($type_turnover) { //เช็คเงื่อนไไขโปร
            case 0:
                break;
            case 1: //ฟิกเทิร์น
                $tb_turnover = $this->check_tb_turnover($user_id);
                $data_turn = array(
                    'checkturn' => floor(($tb_turnover->checkturn * 1) + $turnover), //เทิร์นเก่า + เทิร์นที่ฟิก
                );
                $this->db->where('user_id', $user_id)->update('tb_turnover', $data_turn); //update tb_turnover
                break;
            default: //เทิร์นเป็นเท่า
                $tb_turnover = $this->check_tb_turnover($user_id);
                $turnover = $bonus_point * $turnover; //เครดิตที่แจก * เท่าของเทิรน
                $data_turn = array(
                    'checkturn' => floor(($tb_turnover->checkturn * 1) + $turnover), // เทิร์เนเก่า + เทิร์นที่คิดแล้ว
                );
                $this->db->where('user_id', $user_id)->update('tb_turnover', $data_turn); //update tb_turnover
                break;
        }
        $arr_count = array(
            'count' => $count - 1,
        );
        $this->db->where('id', $event_id)->update('tb_event', $arr_count); // จำนวน -1

        $user_point_after = $this->db->where('id', $user_id)->where('status', 1)->get('tb_user')->row()->point;
        $arr_log = array(
            'user_id' => $user_id,
            'event_id' => $event_id,
            'before_creadit' => 0,
            'after_creadit' => 0,
            'before_point' => $user_point_before,
            'after_point' => $user_point_after,
            'time' => time(),
        );
        $this->db->insert('log_event', $arr_log); //insert log

        return array('code' => 1, 'msg' => 'ทำรายการเรียบร้อย');
    }
    public function new_user($user_id, $time_start)
    {
        if ($this->db->where('id', $user_id)->where('create_time >', $time_start)->get('tb_user')->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function old_user($user_id, $time_start)
    {
        if ($this->db->where('id', $user_id)->where('create_time <', $time_start)->get('tb_user')->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function all_user($user_id)
    {
        if ($this->db->where('id', $user_id)->get('tb_user')->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function check_tb_turnover($user_id)
    {
        $tb_turnover = $this->db->where('user_id', $user_id)->where('status', 1)->get('tb_turnover');
        if ($tb_turnover->num_rows() == 0) {
            $data_insert = array(
                'user_id' => $user_id,
                'promotion_id' => 0,
                'code_id' => 0,
                'sport' => '0',
                'casino' => '0',
                'game' => '0',
                'checkturn' => '0',
                'check_time' => time(),
                'status' => 1,
            );
            $this->db->insert('tb_turnover', $data_insert);
        }
        return $this->db->where('user_id', $user_id)->where('status', 1)->get('tb_turnover')->row();
    }
    public function get_credit($user)
    {
        $arr_userAPI = array(
            'AgentName' => $this->getapi_model->agent(),
            'PlayerName' => $user,
            'TimeStamp' => time(),
        );
        $dataAPI = array(
            'type' => 'D',
            'agent' => $this->getapi_model->agent(),
            'member' => $user,
        );
        $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/balance';
        $cre_userAPI = $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
        if ($cre_userAPI->Error == 0) {
            $amount = $cre_userAPI->Balance;
        } else {
            $amount = $cre_userAPI->Message;
        }
        return $amount;
    }

    public function deposit($user, $amount)
    {

        $user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
        if ($user_q->num_rows() == 1) {
            $user_r = $user_q->row();
            $arr_depAPI = array(
                'AgentName' => $this->getapi_model->agent(),
                'PlayerName' => $user,
                'Amount' => $amount,
                'TimeStamp' => time(),
            );
            $dataAPI = array(
                'type' => 'D',
                'agent' => $this->getapi_model->agent(),
                'member' => $user,
            );
            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/deposit';

            $cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);

            if ($cre_userAPI->Success == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

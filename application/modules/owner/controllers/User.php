<?php
class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('backend/statement_model');
		$this->load->model('owner_model');
		$this->load->library('owner_libraray');
		$this->owner_libraray->login();
		$this->output->set_template('tem_owner/tem_owner');	
	}

    public function index()
    {
        // $data['user'] = $this->db
        //     ->select('tb_user.*,tb_user_bank.account,tb_bank.bank_short')
        //     ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
        //     ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
        //     ->order_by('tb_user.id', 'DESC')
        //     ->get('tb_user')
        //     ->result_array();
        //     echo '<pre>';
        //     print_r($data['user']);
        //     die;
        $this->load->view('user_all');
    }
    //ดึงข้อมูล user
    public function fetch_user()
    {

        $this->load->model('member_model');
        $fetch_data = $this->member_model->make_datatables();
        $i = $_POST['start'];
        foreach ($fetch_data as $row) {
            $i++;
            $id = $row->id;
            $username = $row->username;
            $user = $row->user;

            if ($row->name == '') {
                $name = '-';
            } else {
                $name = $row->name;
            }

            $phone = $row->username;
            // $point = $row->point;
            // $spin = $row->spin;
            $time = date('d/m/Y', $row->create_time);
            // if($row->comefrom ==1){
            //     $comefrom = '<span class="badge badge-secondary text-white">ลูกค้าเก่า</span>';
            // }
            // if($row->comefrom ==2)
            // {
            //     $comefrom = '<span class="badge badge-info text-white">ลูกค้าใหม่</span>';
            // }
            // $link_page = "<a href='".base_url('backend/games/report_point/'.$row->id)."' title='เรียกดูพอยท์'><i class='fa fa-info-circle' aria-hidden='true'title='รายละเอียด'></i></a> " ;
            $data[] = array($i, $username, $user, $name, $phone, $time);
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->member_model->get_all_data(),
            "recordsFiltered" => $this->member_model->get_filtered_data(),
            "data" => $data,
        );
        echo json_encode($output);
        die;
    }

    public function sentjsonUserall()
    {
        echo json_encode($this->sh_userBylimit());
        die;
    }
    public function sh_userBylimit()
    {

        if (empty($this->input->post('Per_Page'))) {
            $chf = true;
            $Page = 1;
            $Per_Page = 10;
            $Search = '';
        } else {
            $chf = false;
            $Page = $this->input->post('Page');
            $Per_Page = $this->input->post('Per_Page');
            $Search = $this->input->post('Search');
        }
        $Num_Rows = $this->db
            ->select('*')
            ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
            ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
            ->get('tb_user');
        $Num_Rows = $Num_Rows->num_rows();

        if ($Page == 1) {
            $skip = 0;
        } else {
            $skip = $Per_Page * ($Page - 1);
        }
        $user = $this->db
            ->select('*')
            ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
            ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
            ->limit($Per_Page, $skip)
        // ->limit(10,20)
            ->order_by('tb_user.id', 'ASC')

            ->get('tb_user');

        $d_user = $user->result_array();

        $curdate = strtotime(date('Y-m-d'));
        $lastdate = strtotime(date('Y-m-d', time() - (30 * 24 * 60 * 60)));

        $Prev_Page = $Page - 1;
        $Next_Page = $Page + 1;
        $Page_Start = (($Per_Page * $Page) - $Per_Page);
        if ($Num_Rows <= $Per_Page) {
            $Num_Pages = 1;
        } else if (($Num_Rows % $Per_Page) == 0) {
            $Num_Pages = ($Num_Rows / $Per_Page);
        } else {
            $Num_Pages = ($Num_Rows / $Per_Page) + 1;
            $Num_Pages = (int) $Num_Pages;
        }
        $offset = ($Page - 1) * $Per_Page;
        $count = $offset;
        $sql1 = $this->db
            ->select('tb_user.*,tb_user_bank.account,tb_bank.bank_short')
            ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
            ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left');
        if ($this->input->post('search') && $this->input->post('search') != "") {
            $this->db->where("
			tb_user.username LIKE '" . $this->input->post('search') . "%'
			or
			tb_user.password LIKE '" . $this->input->post('search') . "%'
			or
			tb_user.user LIKE '" . $this->input->post('search') . "%'
			or
			tb_user.name LIKE '" . $this->input->post('search') . "%'
			");
        }
        $sql1 = $this->db->limit($Per_Page, $Page_Start)
            ->order_by('tb_user.id', 'DESC')
            ->get('tb_user');
        $objQuery = $sql1->result_array();
        // die;
        $data['Num_Rows'] = $Num_Rows;
        $data['user'] = $objQuery;
        $data['Per_Page'] = $Per_Page;
        $data['Page'] = $Page;
        $data['Num_Pages'] = $Num_Pages;
        return json_encode($data);
        die;
    }

    public function user_detail()
    {
        $data['bank'] = $this->db->get('tb_bank')->result_array();
        $data['group'] = $this->db->where('status', 1)->get('tb_group')->result_array();
        $data['sale_n'] = $this->db->where('status', 1)->get('tb_sale')->result_array();
        $data['log_pw'] = $this->db->select('*')->limit(10)->order_by('id', 'desc')->get('log_pass')->result_array();
        // print_r($this->session->users['username']);
        // die;
        $this->load->view('user_detail', $data);
    }
    public function user_account()
    {
        $data['bank'] = $this->db->get('tb_bank')->result_array();
        $data['group'] = $this->db->where('status', 1)->get('tb_group')->result_array();

        $this->load->view('user_account', $data);
    }
    public function search_account()
    {
        $user_acc = $this->input->post('user_acc');
        $user_name = $this->input->post('user_name');
        if ($user_acc != '') {
            $user = $this->db
                ->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id')
                ->like('tb_user_bank.account', $user_acc, 'both')
                ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
                ->get('tb_user')
                ->result_array();
        } else if ($user_name != '') {
            $user = $this->db
                ->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id')
                ->like('tb_user.name', $user_name, 'both')
                ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
                ->get('tb_user')
                ->result_array();
        }
        echo json_encode($user);
        die;
    }
    public function sel_detail_account()
    {
        $user = $this->input->post('user');
        $user_r = $this->db->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id')
            ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
            ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
            ->where('tb_user.user', $user)
            ->get('tb_user')
            ->row();

        if ($user_r) {
            $user_r->credit = $this->get_credit($user_r->user);
            $user_r->dw = $this->db->select('id,from_unixtime(datetime +25200, "%Y-%m-%dT%H:%i:%s" ) as datetime2,dateCreate,deposit,withdraw')
                ->where('user_id', $user_r->id)
                ->order_by('id', 'DESC')
                ->limit(10)
                ->get('tb_statement')
                ->result_array();

            $user_r->gu = $this->db->select('tb_group.id,tb_user_group.id as gu_id,tb_group.name')
                ->join('tb_group', 'tb_group.id= tb_user_group.group_id')
                ->where('tb_user_group.user_id', $user_r->id)
                ->where('tb_user_group.status', 1)
                ->get('tb_user_group')
                ->result_array();
            $arr_depAPI = array(
                'AgentName' => $this->getapi_model->agent(),
                'PlayerName' => $user_r->user,
                'From' => date('m/d/Y', time() - (7 * 24 * 60 * 60)), //01/01/2020
                'To' => date('m/d/Y'), //01/01/2020
                'TransferType' => -1, //(2:Deposit/3:Withdraw)
                'PageSize' => 10,
                'PageIndex' => 1,
                'TimeStamp' => time(),
            );
            $dataAPI = array(
                'type' => 'D',
                'agent' => $this->getapi_model->agent(),
                'member' => $user_r->user,
            );
            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/transferlogs';
            $cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
            //Credit
            $user_r->add_cd = $cre_userAPI->Result->Records;

            //Ticket
            // $user_r->stakeMoney = $this->getapi_model->get_ticket($user_r->user);

            //Sale name
            $su_q = $this->db->select('tb_sale.name')->join('tb_sale_user', 'tb_sale_user.sale_id = tb_sale.id', 'left')->where('tb_sale_user.user_id', $user_r->id)->where('tb_sale_user.status', 1)->get('tb_sale');
            if ($su_q->num_rows() == 1) {
                $su_r = $su_q->row();
                $user_r->sale_name = $su_r->name;
            } else {
                $uss_q = $this->db->select('sale_userid')->where('user_id', $user_r->id)->where('status', 1)->get('tb_user_sale');

                if ($uss_q->num_rows() == 1) {
                    $uss = $uss_q->row();
                    $uss_s = $this->db->select('user')->where('id', $uss->sale_userid)->where('status', 1)->get('tb_user')->row();
                    $user_r->sale_name = $uss_s->user;
                } else {
                    $user_r->sale_name = 'ไม่มีผู้แนะนำ';
                }
            }

            $re = array('code' => 1, 'msg' => '', 'data' => $user_r);
        } else {
            $re = array('code' => 0, 'msg' => '', 'data' => '');
        }
        echo json_encode($re);
        die();
    }
    public function sel_detail()
    {

        if ($this->input->post('s_user') != null) {
            $user = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($this->input->post('s_user')))), -6);
            $user_r = $this->db->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id')
                ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
                ->where('tb_user.user', $user)
                ->get('tb_user')
                ->row();
        } else if ($this->input->post('t_user') != null) {
            $user_r = $this->db->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id')
                ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
                ->where('tb_user.username', $this->input->post('t_user'))
                ->get('tb_user')
                ->row();
        } else if ($this->input->post('t_name') != null) {
            $user_r = $this->db->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id')
                ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
                ->like('tb_user.name', $this->input->post('t_name'))
                ->get('tb_user')
                ->row();
        } else if ($this->input->post('t_account') != null) {
            $user_r = $this->db->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id')
                ->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
                ->like('tb_user_bank.account', $this->input->post('t_account'))
                ->get('tb_user')
                ->row();
        }

        if ($user_r) {
            $user_r->credit = $this->get_credit($user_r->user);
            $user_r->dw = $this->db->select('id,from_unixtime(datetime +25200, "%Y-%m-%dT%H:%i:%s" ) as datetime2,dateCreate,deposit,withdraw')
                ->where('user_id', $user_r->id)
                ->order_by('id', 'DESC')
                ->limit(10)
                ->get('tb_statement')
                ->result_array();
            $user_r->gu = $this->db->select('tb_group.id,tb_user_group.id as gu_id,tb_group.name')
                ->join('tb_group', 'tb_group.id= tb_user_group.group_id')
                ->where('tb_user_group.user_id', $user_r->id)
                ->where('tb_user_group.status', 1)
                ->get('tb_user_group')
                ->result_array();
            $arr_depAPI = array(
                'AgentName' => $this->getapi_model->agent(),
                'PlayerName' => $user_r->user,
                'From' => date('m/d/Y', time() - (7 * 24 * 60 * 60)), //01/01/2020
                'To' => date('m/d/Y'), //01/01/2020
                'TransferType' => -1, //(2:Deposit/3:Withdraw)
                'PageSize' => 10,
                'PageIndex' => 1,
                'TimeStamp' => time(),
            );
            $dataAPI = array(
                'type' => 'D',
                'agent' => $this->getapi_model->agent(),
                'member' => $user_r->user,
            );
            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/transferlogs';
            $cre_userAPI = $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
            //Credit
            $user_r->add_cd = $cre_userAPI->Result->Records;

            //Ticket
            // $user_r->stakeMoney = $this->getapi_model->get_ticket($user_r->user);

            //Sale name
            $su_q = $this->db->select('tb_sale.name')->join('tb_sale_user', 'tb_sale_user.sale_id = tb_sale.id', 'left')->where('tb_sale_user.user_id', $user_r->id)->where('tb_sale_user.status', 1)->get('tb_sale');
            if ($su_q->num_rows() == 1) {
                $su_r = $su_q->row();
                $user_r->sale_name = $su_r->name;
            } else {
                $uss_q = $this->db->select('sale_userid')->where('user_id', $user_r->id)->where('status', 1)->get('tb_user_sale');

                if ($uss_q->num_rows() == 1) {
                    $uss = $uss_q->row();
                    $uss_s_q = $this->db->select('user')->where('id', $uss->sale_userid)->get('tb_user');
					if($uss_s_q->num_rows() == 1){
						$uss_s_r = $uss_s_q->row();
						$user_r->sale_name = $uss_s_r->user;
					}else{
						$user_r->sale_name = 'ไม่มีผู้แนะนำ';
					}
                   
                } else {
                    $user_r->sale_name = 'ไม่มีผู้แนะนำ';
                }
            }
            $turn = $this->db->where('user_id', $user_r->user)->where('check_time <', time())->get('tb_turnover')->row();
            if ($turn == '' || $turn == null) {
                $turn_n = 0;
                $date = 'dd-mm-YY';
            } else {
                $turn_n = $turn->checkturn;
                $date = date("d-m-Y", $turn->check_time);
            }
            $re = array('code' => 1, 'msg' => '', 'data' => $user_r, 'turn' => $turn_n, 'date' => $date);
        } else {
            $re = array('code' => 0, 'msg' => '', 'data' => '');
        }
        echo json_encode($re);
        die();
    }
    public function user_new()
    {
        $user = $this->db->where('status !=', 0)->order_by('id', 'DESC')->limit(50)->get('tb_user')->result_array();
        $bank = $this->db->get('tb_bank')->result_array();
        $i = 0;
        foreach ($user as $us) {
            // line
            // $q_line = $this->db->select('id')->where('tb_line.tel',$us['user'])->get('tb_line');
            // if($q_line->num_rows() == 0){
            //     $user[$i]['line'] = 0 ;
            // }else{
            //     $user[$i]['line'] = 1 ;
            // }
            //group name

            $user[$i]['group_user'] = $this->db->select('tb_user_group.*,tb_group.name')
                ->join('tb_group', 'tb_group.id= tb_user_group.group_id')
                ->where('tb_user_group.user_id', $us['id'])
                ->where('tb_user_group.status', 1)
                ->get('tb_user_group')
                ->result_array();

            $bank_user = $this->db->select('tb_user_bank.status,tb_user_bank.id,tb_user_bank.account,tb_user_bank.name,tb_bank.bank_short')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
                ->where('tb_user_bank.user_id', $us['id'])
                ->get('tb_user_bank')
                ->result_array();
            $user[$i]['bank_user'] = $bank_user;
            //last login ip
            // $q_login = $this->db->where('user_id',$us['id'])->where('action',1)->order_by('create_time','DESC')->limit(1)->get('log_user_login');
            // if($q_login->num_rows() == 0){
            //     $lastLogin = '';
            //     $last_ip = '';
            // }else{
            //     $r_login = $q_login->row();
            //     $lastLogin = date('d-m-y H:i',$r_login->create_time);
            //     $last_ip = $r_login->ip;
            // }
            // $user[$i]['lastLogin'] = $lastLogin;

            // $user[$i]['last_ip'] = $last_ip;

            $i++;
        }
        $group = $this->db->where('status', 1)->get('tb_group')->result_array();
        $data = array(
            'menu' => 'user_all',
            'agent' => $this->getapi_model->agent(),
            'group' => $group,
            'user' => $user,
            'bank' => $bank,
        );

        $this->load->view('user_new', $data);
    }

    public function cre_user()
    {

        //        Array ( [username] => 0900430436 [password] => Aa123654 [bank_id] => 2 [account] => 1234567891 )
        //        Array ( [username] => 0900430436 [password] => Aa123654 [bank_id] => 2 [account] => 1234567895 [user] => ztzz1230012)
        //        print_r($this->input->post());die();
        if ($this->input->post('username') && $this->input->post('bank_id') && $this->input->post('account')) {

            //set value
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $bank_id = $this->input->post('bank_id');
            $account = $this->input->post('account');

            //check username / bank_id & account
            $chk_user = $this->db->where('username', $username)->where_not_in('status', '0')->get('tb_user');
            $chk_bank = $this->db->where('account', $account)->where_not_in('status', '0')->get('tb_user_bank');

            if ($chk_user->num_rows() <= 0) {
                if ($chk_bank->num_rows() <= 0) {
                    $arr_userDB = array(
                        'username' => $username,
                        'password' => $password,
                        'user' => '',
                        'name' => '',
                        'create_time' => time(),
                        'comefrom' => 2,
                        'status' => 1,
                    );

                    if ($this->db->insert('tb_user', $arr_userDB)) {
                        $user_id = $this->db->insert_id();
                        $newUser = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($user_id))), -6);
                        $arr_userAPI = array(
                            'Username' => $newUser,
                            'Agentname' => $this->getapi_model->agent(),
                            'Fullname' => 'auto register',
                            'Password' => $password,
                            'Currency' => 'THB',
                            'Dob' => '2020-01-01',
                            'Gender' => 0,
                            'Email' => "auto@email.com",
                            'Mobile' => $username,
                            'Ip' => $this->get_client_ip(),
                            'TimeStamp' => time(),

                        );
                        $dataAPI = array(
                            'type' => 'R',
                            'agent' => $this->getapi_model->agent(),
                            'member' => $newUser,
                        );
                        $url_api = 'https://cauthapi.linkv2.com/api/credit-auth/xregister';
                        $cre_userAPI = $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);
                        if ($cre_userAPI->Success == 1) {
                            if ($this->db->set('user', $newUser)->where('id', $user_id)->update('tb_user')) {
                                $this->insert_groupuser($bank_id, $user_id);
                                $arr_bankUsDB = array(
                                    'user_id' => $user_id,
                                    'bank_id' => $bank_id,
                                    'account' => $account,
                                    'create_time' => time(),
                                    'status' => 1,
                                );

                                if ($this->db->insert('tb_user_bank', $arr_bankUsDB)) {
                                    //Line Nofity
                                    if ($lnfy = $this->db->where('type', 'register')->get('tb_linenotify')->row()) {
                                        if ($lnfy->token != '') {

                                            $messageNofity = 'สมัครใหม่ รหัส:' . $newUser . ' โทร:' . $username;
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
                                                CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                                                CURLOPT_HTTPHEADER => array(
                                                    "Content-Type: application/x-www-form-urlencoded",
                                                    "Authorization: Bearer " . $lnfy->token,
                                                ),
                                            ));

                                            $response = curl_exec($curl);
                                            curl_close($curl);
                                        }
                                    }
                                    $re = array('msg' => 'สร้างยูเซอร์สำเร็จ', 'code' => 1);
                                    $messag = 'IMI55 ชื่อผู้ใช้ : ' . $username . ' รหัสผ่าน : ' . $password;
                                    $this->getapi_model->send_sms($username, $messag);
                                } else {
                                    $re = array('msg' => 'ระบบเกิดปัญหาการบันทึกข้อมูลกรุณาลองใหม่ 3', 'code' => 0);
                                }
                            } else {
                                $re = array('msg' => 'ระบบเกิดปัญหาการบันทึกข้อมูลกรุณาลองใหม่ 2', 'code' => 0);
                            }
                        } else {
                            $re = array('msg' => 'ระบบเกิดปัญหาการบันทึกข้อมูลกรุณาลองใหม่ 1', 'code' => 0);
                        }
                    } else {
                        $re = array('msg' => 'ระบบเกิดปัญหาการบันทึกข้อมูล API', 'code' => 0);
                    }
                } else {
                    $re = array('msg' => 'บัญชีธนาคารซ้ำ', 'code' => 0);
                }
            } else {
                $re = array('msg' => 'เบอร์โทรซ้ำ', 'code' => 0);
            }
        } else {
            $re = array('msg' => 'ข้อมูไม่ครบ', 'code' => 0);
        }

        echo json_encode($re);
        die();
    }
    public function edit_name()
    {
        if ($this->input->post('user') && $this->input->post('name')) {
            $user = $this->input->post('user');
            $name = $this->input->post('name');
            $user_r = $this->db->select('id')->where('user', $user)->get('tb_user')->row();
            if ($this->db->set('name', $name)->where('id', $user_r->id)->update('tb_user')) {
                $re = array('code' => 1, 'msg' => 'แก้ไขสำเร็จ', 'title' => 'สำเร็จ');
            } else {
                $re = array('code' => 0, 'msg' => 'อัพเดตฐานข้อมูลไม่สำเร็จ', 'title' => 'ไม่สำเร็จ');
            }
        } else {
            $re = array('code' => 0, 'msg' => 'ไม่พบยูเซอร์ที่ต้องแก้ไข', 'title' => 'ไม่สำเร็จ');
        }
        echo json_encode($re);
        die();
    }
    public function edit_username()
    {
        if ($this->input->post('username') && $this->input->post('user')) {
            $user = $this->input->post('user');
            $username = $this->input->post('username');
            if ($this->db->set('username', $username)->where('user', $user)->update('tb_user')) {
                $re = array('title' => 'เปลี่ยนรหัสสำเร็จ', 'msg' => 'กรุณาแจ้งลูกค้าเพื่อรับรหัสการเข้าใช้งานใหม่', 'code' => 1);
            } else {
                $re = array('msg' => ' User ไม่มีในระบบ', 'code' => 0);
            }
        } else {
            $re = array('msg' => ' User และ Username ไม่มีในระบบ', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }
    public function edit_pass()
    {
        if ($this->input->post('user') && $this->input->post('password')) {
            $user = $this->input->post('user');
            $password = $this->input->post('password');
            $ip = $_SERVER['REMOTE_ADDR'];
            $admin = $this->session->owner->name;
            $user_r = $this->db->select('*')->where('user', $user)->get('tb_user')->row();

            $arr_log = array(
                "ref_userid" => $user,
                "ip" => $ip,
                "name" => $admin,
                "create_time" => time(),
            );
            $this->db->insert('log_pass', $arr_log);

            $arr_userAPI = array(
                'Playername' => $user_r->user,
                'Partner' => $this->getapi_model->agent(),
                'Newpassword' => $password,
                'TimeStamp' => time(),
            );
            $dataAPI = array(
                'type' => 'L',
                'agent' => $this->getapi_model->agent(),
                'member' => $user_r->user,
                'password' => $password,
            );

            $url_api = 'https://cauthapi.linkv2.com/api/credit-auth/changepassword';
            $cre_userAPI = $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);

            if ($cre_userAPI->Status == 1) {
                if ($this->db->set('password', $password)->where('id', $user_r->id)->update('tb_user')) {

                    $re = array('code' => 1, 'msg' => 'Success');
                } else {
                    $re = array('msg' => 'เปลี่ยนสำเร็จ แต่ DB ไม่เซฟ', 'code' => 0);
                }
            } else {
                $re = array('msg' => 'ไม่สามารถเปลี่ยนพาสเวิร์ดได้', 'code' => 0);
            }
        } else {
            $re = array('msg' => 'input post password ไม่เจอ', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }
    public function edit_status()
    {
        if ($this->input->post('user') && $this->input->post('status')) {
            $user = $this->input->post('user');
            $status = $this->input->post('status');
            $user_q = $this->db->select('id,user')->where('user', $user)->get('tb_user');
            if ($user_q->num_rows() == 1) {
                $user_r = $user_q->row();
                if ($this->db->set('status', $status)->where('id', $user_r->id)->update('tb_user')) {
                    $re = array('code' => 1, 'msg' => 'Success');
                } else {
                    $re = array('msg' => 'อัพเดตสถานะไม่สำเร็จ', 'code' => 0);
                }
            } else {
                $re = array('msg' => 'ไม่มียูเซอร์ดังกล่าว 002', 'code' => 0);
            }
        } else {
            $re = array('msg' => 'ไม่มียูเซอร์ดังกล่าว 001', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }
    public function edit_bank()
    {
        if ($this->input->post('bank_id') && $this->input->post('account') && $this->input->post('user')) {
            $user = $this->input->post('user');
            $account = $this->input->post('account');
            $bank_id = $this->input->post('bank_id');
            $user_r = $this->db->select('id')->where('user', $user)->get('tb_user')->row();
            $bu_r = $this->db->select('tb_user_bank.id,tb_user_bank.account,tb_bank.bank_short')
                ->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id')
                ->where('tb_user_bank.user_id', $user_r->id)
                ->where('status', 1)
                ->get('tb_user_bank')
                ->row();
            if ($bu_r && $user_r) {
                $log_bu = $bu_r->account . $bu_r->bank_short;
                $check = $this->db->where('account', $account)->where('bank_id', $bank_id)->get('tb_user_bank');
                if ($check->num_rows() == 0) {
                    $arr_bank = array(
                        'bank_id' => $bank_id,
                        'account' => $account,
                    );
                    if ($this->db->where('id', $bu_r->id)->update('tb_user_bank', $arr_bank)) {
                        $bankshort = $this->db->select('bank_short')->where('id', $bank_id)->get('tb_bank')->row()->bank_short;
                        $arr_log = array(
                            'bank_id' => $bu_r->id,
                            'action' => 'old : ' . $log_bu . ' new : ' . $account . $bankshort,
                            'admin_id' =>$this->session->owner->id,
                            'create_time' => time(),
                        );
                        $this->db->insert('log_bank', $arr_log);
                        $re = array('title' => 'ทำรายการสำเร็จ', 'msg' => 'แก้ไขรายการธนาคารสำเร็จ', 'code' => 1);
                    } else {
                        $re = array('title' => 'ผิดพลาด', 'msg' => 'ไม่สามารถลงฐานข้อมูลได้', 'code' => 0);
                    }
                } else {
                    $re = array('title' => 'ข้อมูลซ้ำ', 'msg' => 'ข้อมูลการแก้ไขซ้ำกับระบบ', 'code' => 0);
                }
            } else {
                $re = array('title' => 'เช็คข้อมูลใหม่', 'msg' => 'ไม่มีข้อมูลสำหรับธนาคารนี้', 'code' => 0);
            }
        } else {
            $re = array('title' => 'ตรวจสอบข้อมูลใหม่', 'msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }

        echo json_encode($re);
        die();
    }
    public function edit_group()
    {
        $user_id = $this->input->post('user_id');
        $Group_r = $this->db->get('tb_group')->result_array();
        //        print_r($this->input->post());die();
        foreach ($Group_r as $gr) {

            $chkGroup = $this->db->where('group_id', $gr['id'])->where('user_id', $user_id)->get('tb_user_group');
            $bGroup_r = $chkGroup->row();
            $arrbankGroup = array('group_id' => $gr['id'], 'user_id' => $user_id, 'status' => 1);
            if (empty($this->input->post($gr['id']))) {

                if ($chkGroup->num_rows() != 0) {

                    $this->db->set('status', 0)->where('id', $bGroup_r->id)->update('tb_user_group');
                }
            } else {
                if ($chkGroup->num_rows() == 0) {
                    $this->db->insert('tb_user_group', $arrbankGroup);
                } else {
                    $this->db->set('status', 1)->where('id', $bGroup_r->id)->update('tb_user_group');
                }
            }
        }
        $re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
        echo json_encode($re);
        die();
    }
    public function edit_classUser_status()
    {
        if ($class_ = $this->db->where('id', $this->input->post('group_id'))->get('tb_user_group')->row()) {
            if ($class_->status == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            if ($this->db->set('status', $status)->where('id', $this->input->post('group_id'))->update('tb_user_group')) {
                $re = array('msg' => 'บันทึกเรียนร้อยแล้ว', 'code' => 1);
            } else {
                $re = array('msg' => 'ไม่สามารถบันทึกข้อมูลในฐานข้อมูลได้', 'code' => 0);
            }
        } else {
            $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }

    public function credit_out()
    {
    
        if ($this->input->post('user') && $this->input->post('amount')) {
            $user = $this->input->post('user');
            $amount_out = $this->input->post('amount');
            $amount = $this->get_credit($user);
            $agent = $this->session->owner->username;
            if ($amount_out <= str_replace(',', '', $amount)) {
                $result = $this->withdraw($user, $amount_out, $amount);
                if ($result['code'] == 1) {
                    $re = array('msg' => 'ทำรายการเรียบร้อยแล้วกรุณาเช็คยอดเงิน', 'code' => 1);
                    if ($lnfy = $this->db->where('type', 'credit_out')->get('tb_linenotify')->row()) {
                        if ($lnfy->token != '') {
                            $messageNofity = $agent . ' ได้ลดเครดิตจำนวน ' . $amount_out . ' เครดิต' . ' ของUser : ' . $user;
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
                                CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                                CURLOPT_HTTPHEADER => array(
                                    "Content-Type: application/x-www-form-urlencoded",
                                    "Authorization: Bearer " . $lnfy->token,
                                ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);
                        }
                    }
                    $re = array('msg' => 'มีปัญหา 002 เช็คยอดเงินก่อนทำรายการต่อ', 'code' => 1, 'ms' => $response);
                } else {
                    $re = array('msg' => 'มีปัญหา 002 เช็คยอดเงินก่อนทำรายการต่อ', 'code' => 0);
                }
            } else {
                $re = array('msg' => 'มีปัญหา 001', 'code' => 0);
            }
        } else {
            $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }

    public function credit_in()
    {
        if ($this->input->post('user') && $this->input->post('amount')) {
            $user = $this->input->post('user');
            $amount_out = $this->input->post('amount');
            $amount = $this->get_credit($user);
            $agent = $this->session->owner->username;
            $result = $this->deposit($user, $amount_out, $amount);
            if ($result['code'] == 1) {
                $re = array('msg' => 'ทำรายการเรียบร้อยแล้วกรุณาเช็คยอดเงิน', 'code' => 1);
                if ($lnfy = $this->db->where('type', 'credit_in')->get('tb_linenotify')->row()) {
                    if ($lnfy->token != '') {
                        $messageNofity = $agent . ' ได้เพิ่มเครดิตจำนวน ' . $amount_out . ' เครดิต' . ' ให้กับ ' . $user;
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
                            CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                            CURLOPT_HTTPHEADER => array(
                                "Content-Type: application/x-www-form-urlencoded",
                                "Authorization: Bearer " . $lnfy->token,
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);
                    }
                }
                $re = array('msg' => 'มีปัญหา 002 เช็คยอดเงินก่อนทำรายการต่อ', 'code' => 1, 'ms' => $response);
            } else {
                $re = array('msg' => 'มีปัญหา 002 เช็คยอดเงินก่อนทำรายการต่อ', 'code' => 0);
            }
        } else {
            $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }

    public function insert_groupuser($bank_id, $user_id)
    {
        //type = 2 คือเงื่อนไขที่ไม่เข้า default ลูกค้าสมัครใหม่
        $usgp2_q = $this->db->where('type', 2)->where('group_id', $bank_id)->get('tb_user_group_default');
        if ($usgp2_q->num_rows()) {
            $arr_usgp21 = array(
                'user_id' => $user_id,
                'group_id' => $bank_id,
                'status' => 1,
            );

            $arr_usgp22 = array(
                'user_id' => $user_id,
                'group_id' => 1,
                'status' => 1,
            );
            $this->db->insert('tb_user_group', $arr_usgp21);
            $this->db->insert('tb_user_group', $arr_usgp22);
        } else {
            $group_df = $this->db->where('status', 1)->where('type', 1)->get('tb_user_group_default')->result_array();
            foreach ($group_df as $gdf) {
                $arr_gdf = array(
                    'user_id' => $user_id,
                    'group_id' => $gdf['group_id'],
                    'status' => 1,
                );
                $this->db->insert('tb_user_group', $arr_gdf);
            }
        }
    }
    public function get_classUser()
    {
        $q_login = $this->db->select('*')
            ->where('id', $this->input->post('id'))
            ->get('tb_class')->row();
        echo json_encode($q_login);
        die();
    }
    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
    public function see_credit()
    {
        $user_r = $this->db
            ->where('id', $this->input->post('user_id'))
            ->get('tb_user')
            ->row();
        $amount = $this->get_credit($user_r->user);
        $re = array('code' => 1, 'amount' => $amount);
        echo json_encode($re);
        die();
    }
    public function checkusername()
    {
        if ($this->input->post('username')) {
            $username = $this->input->post('username');
            $user_r = $this->db->select('id')->where('username', $username)->where('status !=', 0)->get('tb_user');
            if ($user_r->num_rows() == 0) {
                $re = array('code' => 1);
            } else {
                $re = array('code' => 0);
            }
        } else {
            $re = array('code' => 0);
        }

        echo json_encode($re);
        die();
    }
    public function sh_user()
    {
        $q_login = $this->db->select('tb_user.*')
            ->where('tb_user.id', $this->input->post('user_id'))
            ->get('tb_user')->row();
        echo json_encode($q_login);
        die();
    }
    public function get_bank()
    {
        $q_login = $this->db
            ->where('tb_user_bank.id', $this->input->post('id'))
            ->get('tb_user_bank')->row();
        echo json_encode($q_login);
        die();
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
    public function deposit($user, $amount, $credit_last)
    {

        //เริ่มต้น API Deposit สำหรับ Agent Betclic
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
                $arr_log_d = array(
                    'user_id' => $user_r->id,
                    'admin_id' => $this->session->owner->id,
                    'type' => 1, // type in
                    'amount' => $amount,
                    'credit_last' => $credit_last,
                    'credit_result' => $this->get_credit($user_r->user),
                    'create_time' => time(),
                    'status' => 1,
                );
                if ($this->db->insert('log_credit', $arr_log_d)) {
                    $re = array('code' => 1, 'msg' => '004');
                } else {
                    $re = array('code' => 0, 'msg' => '003');
                }
            } else {
                $re = array('code' => 0, 'msg' => '002');
            }
        } else {
            $re = array('code' => 0, 'msg' => '001');
        }
        return $re;
    }
    public function withdraw($user, $amount, $credit_last)
    {

        $user_q = $this->db->select('user,id')->where('user', $user)->where('status', 1)->get('tb_user');
        if ($user_q->num_rows() == 1) {
            $user_r = $user_q->row();
            $arr_userAPI = array(
                'AgentName' => $this->getapi_model->agent(),
                'PlayerName' => $user_r->user,
                'Amount' => $amount,
                'TimeStamp' => time(),
            );
            $dataAPI = array(
                'type' => 'W',
                'agent' => $this->getapi_model->agent(),
                'member' => $user_r->user,
            );

            $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/withdraw';
            $cre_userAPI = $this->getapi_model->getapi($arr_userAPI, $url_api, $dataAPI);

            if ($cre_userAPI->Success == 1) {
                $arr_log_d = array(
                    'user_id' => $user_r->id,
                    'admin_id' => $this->session->owner->id,
                    'type' => 2, // type in
                    'amount' => $amount,
                    'credit_last' => $credit_last,
                    'credit_result' => $this->get_credit($user_r->user),
                    'create_time' => time(),
                    'status' => 1,
                );
                if ($this->db->insert('log_credit', $arr_log_d)) {
                    $re = array('code' => 1, 'msg' => '004');
                } else {
                    $re = array('code' => 0, 'msg' => '003');
                }
            } else {
                $re = array('code' => 0, 'msg' => '002');
            }
        } else {
            $re = array('code' => 0, 'msg' => '001');
        }
        return $re;
    }
    public function edit_user()
    {
        if ($this->input->post('user_id')) {
            $user_id = $this->input->post('user_id');
            $username = $this->input->post('username');

            $check_tel = $this->db->where('username', $username)->get('tb_user');
            if ($check_tel->num_rows() > 1) {
                $re = array('msg' => 'Username ที่ระบุมีคนใช้แล้วค่ะ', 'code' => 0);
            } else {
                $arr_update_user = array(
                    'name' => $this->input->post('name'),
                    'username' => $username,

                );
                if ($this->db->where('id', $user_id)->update('tb_user', $arr_update_user)) {
                    $re = array('code' => 1, 'msg' => 'Success');
                } else {
                    $re = array('code' => 0, 'msg' => 'อัพเดตฐานข้อมูลไม่สำเร็จ');
                }
            }
        } else {
            $re = array('code' => 0, 'msg' => 'ไม่พบยูเซอร์ที่ต้องแก้ไข');
        }
        echo json_encode($re);
        die();
    }

    public function groupByuser()
    {
        $user_id = $this->input->post('user_id');
        $Group_r = $this->db->get('tb_group')->result_array();

        foreach ($Group_r as $gr) {
            $chkGroup = $this->db->where('group_id', $gr['id'])->where('user_id', $user_id)->get('tb_user_group');
            $bGroup_r = $chkGroup->row();
            $arrbankGroup = array('group_id' => $gr['id'], 'user_id' => $user_id, 'status' => 1);
            if (empty($this->input->post($gr['id']))) {
                if ($chkGroup->num_rows() != 0) {
                    $this->db->set('status', 0)->where('id', $bGroup_r->id)->update('tb_user_group');
                }
            } else {
                if ($chkGroup->num_rows() == 0) {
                    $this->db->insert('tb_user_group', $arrbankGroup);
                } else {
                    $this->db->set('status', 1)->where('id', $bGroup_r->id)->update('tb_user_group');
                }
            }
        }
        $re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');
        echo json_encode($re);
        die();
    }

    //ลบ point
    public function point_out()
    {
       
        $id_admin = $this->session->owner->id;
       
        if ($this->input->post('user') && $this->input->post('amount')) {
            $user = $this->input->post('user'); // id users
            $sub_user = substr($user, -4); //ตัดเอา4ตัวหลัง
            $amount_out = $this->input->post('amount'); //จำนวนที่ต้องการถอน
            $query = $this->db->select('*')->where('user', $user)->get('tb_user')->result_array();
            $New_user = $this->input->post('user');

            foreach ($query as $result_user_point1) {
                if ($amount_out <= $result_user_point1['point']) {
                    $result_total = $result_user_point1['point'] - $amount_out;
                    //เก็บข้อมูลประวัติการเพิ่มที่ ตารางชื่อ log_credit
                    $data = array(
                        'user_id' => $sub_user,
                        'admin_id' => $id_admin,
                        'type' => '1', //  1หมายถึง ลบ poin
                        'reduce' => $amount_out, //จำนวนที่ต้องการลบ
                        'point_last' => $result_user_point1['point'], //ก่อนเพิ่มคะแนน
                        'point_result' => $result_total, //หลังลบ
                        'create_time' => time(),
                        'status' => '1',
                    );
                    if ($this->db->insert('log_poin_and_spin', $data)) {
                        //ทำการอัพเดทข้อมูลคะแนนที่ตาราง tb_user
                        $result_point = $this->db->set('point', $result_total)->where('user', $user)->update('tb_user');
                        if ($result_point) {
                            $select = $this->db->select('id,name')->where('id', $id_admin)->get('tb_login')->result_array();
                            $name = "";
                            foreach ($select as $row) {
                                $name = $row['name'];
                            }
                            // LINE
                            if ($lnfy = $this->db->where('type', 'point_out')->get('tb_linenotify')->row()) {
                                if ($lnfy->token != '') {

                                    $messageNofity = 'มีการลดPOINT รหัส:' . $New_user . ' จำนวน:' . $amount_out . 'พ้อย ด้วยมือโดย: ' . $name;
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
                                        CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                                        CURLOPT_HTTPHEADER => array(
                                            "Content-Type: application/x-www-form-urlencoded",
                                            "Authorization: Bearer " . $lnfy->token,
                                        ),
                                    ));
                                    $response = curl_exec($curl);
                                    curl_close($curl);
                                }
                            }
                            $re = array('msg' => 'ทำรายการเรียบร้อยแล้ว', 'code' => 1);
                        } else {
                            $re = array('msg' => 'ลบคะแนนไม่ได้', 'code' => 0);
                        }
                    }
                } else {
                    $re = array('msg' => 'คะแนนที่ลบไม่ตรงกับยอดคงเหลือ', 'code' => 0);
                }
            }
        } else {
            $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }

    //เพิ่ม point
    public function point_in()
    {
        $id_admin = $this->session->owner->id;
        if ($this->input->post('user') && $this->input->post('amount')) {
            $user = $this->input->post('user'); //id  user
            $New_user = $this->input->post('user');
            $sub_user = substr($user, -4); //ตัดเอา4ตัวหลัง
            $amount_out = $this->input->post('amount'); //จำนวนที่ต้องการลบ
            $query = $this->db->select('*')->where('user', $user)->get('tb_user')->result_array();

            foreach ($query as $result_user_point1) {
                $add_point = $amount_out + $result_user_point1['point']; //คำนวน จำนวนที่เพิ่ม + ของเดิมที่มี
                $data = array(
                    'user_id' => $sub_user,
                    'admin_id' => $id_admin,
                    'type' => '0', //  0หมายถึง add poin
                    'add_' => $amount_out, //จำนวนที่ต้องการลบ
                    'point_last' => $result_user_point1['point'], //ก่อนเพิ่มคะแนน
                    'point_result' => $add_point, //หลังadd
                    'create_time' => time(),
                    'status' => '1',
                );

                if ($this->db->insert('log_poin_and_spin', $data)) {
                    $result_point = $this->db->set('point', $add_point)->where('user', $user)->update('tb_user');
                    if ($result_point) {
                        $select = $this->db->select('id,name')->where('id', $id_admin)->get('tb_login')->result_array();
                        $name = "";
                        foreach ($select as $row) {
                            $name = $row['name'];
                        }

                        if ($lnfy = $this->db->where('type', 'add_point')->get('tb_linenotify')->row()) {
                            if ($lnfy->token != '') {

                                $messageNofity = 'มีการเพิ่ม POINT ให้กับ รหัส:' . $New_user . ' จำนวน: ' . $amount_out . 'พ้อย ด้วยมือโดย:' . $name;
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
                                    CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                                    CURLOPT_HTTPHEADER => array(
                                        "Content-Type: application/x-www-form-urlencoded",
                                        "Authorization: Bearer " . $lnfy->token,
                                    ),
                                ));
                                $response = curl_exec($curl);
                                curl_close($curl);
                            }
                        }

                        $re = array('msg' => 'ทำรายการเรียบร้อยแล้ว', 'code' => 1);
                    } else {
                        $re = array('msg' => 'เพิ่มคะแนนไม่ได้', 'code' => 0);
                    }
                } else {
                    $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
                }
            }
        } else {
            $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }

    //ลบ spin
    public function spin_out()
    {
        $id_admin = $this->session->owner->id;
        if ($this->input->post('user') && $this->input->post('amount')) {
            $user = $this->input->post('user');
            $sub_user = substr($user, -4);
            $New_user = $this->input->post('user');
            $amount_out = $this->input->post('amount'); //จำนวนที่ต้องการถอน
            $query = $this->db->select('*')->where('user', $user)->get('tb_user')->result_array();
            foreach ($query as $result_user_spin1) {

                if ($amount_out <= $result_user_spin1['spin']) {
                    $amount1 = $amount_out;
                    $last_spin = $result_user_spin1['spin'];
                    $add_result = $result_user_spin1['spin'] - $amount1;
                    $data = array(
                        'user_id' => $sub_user,
                        'admin_id' => $id_admin,
                        'type' => '4', //  0หมายถึง add poin
                        'reduce' => $amount_out, //จำนวนที่ต้องการลบ
                        'point_last' => $result_user_spin1['spin'], //ก่อนเพิ่มคะแนน
                        'point_result' => $add_result, //หลังadd
                        'create_time' => time(),
                        'status' => '1',
                    );
                    if ($this->db->insert('log_poin_and_spin', $data)) {
                        $result_q = $this->db->set('spin', $add_result)->where('user', $user)->update('tb_user');
                        if ($result_q) {
                            $select = $this->db->select('id,name')->where('id', $id_admin)->get('tb_login')->result_array();
                            $name = "";
                            foreach ($select as $row) {
                                $name = $row['name'];
                            }
                            // LINE
                            if ($lnfy = $this->db->where('type', 'spin_out')->get('tb_linenotify')->row()) {
                                if ($lnfy->token != '') {

                                    $messageNofity = 'มีการลดSPIN รหัส:' . $New_user . ' จำนวน:' . $amount_out . 'Spin ด้วยมือโดย: ' . $name;
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
                                        CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                                        CURLOPT_HTTPHEADER => array(
                                            "Content-Type: application/x-www-form-urlencoded",
                                            "Authorization: Bearer " . $lnfy->token,
                                        ),
                                    ));
                                    $response = curl_exec($curl);
                                    curl_close($curl);
                                }
                            }
                            //
                            $re = array('msg' => 'ทำรายการเรียบร้อยแล้ว', 'code' => 1);
                        } else {
                            $re = array('msg' => 'ลบSpinไม่ได้', 'code' => 0);
                        }
                    } else {
                        $re = array('msg' => 'ลบSpinไม่ได้', 'code' => 0);
                    }
                }
            }
        } else {
            $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }

    // เพิ่ม spin
    public function spin_in()
    {
        $id_admin = $this->session->owner->id;

        if ($this->input->post('user') && $this->input->post('amount')) {
            $user = $this->input->post('user');
            $New_user = $this->input->post('user');
            $sub_user = substr($user, -4);
            $amount_out = $this->input->post('amount'); //จำนวนที่ต้องการเพิ่ม
            $query = $this->db->select('*')->where('user', $user)->get('tb_user')->result_array();

            foreach ($query as $result_user_spin1) {
                $last_spin = $result_user_spin1['spin'];
                $add_result = $amount_out + $result_user_spin1['spin'];
                $data = array(
                    'user_id' => $sub_user,
                    'admin_id' => $id_admin,
                    'type' => '3', //  0หมายถึง add poin
                    'add_' => $amount_out, //จำนวนที่ต้องการลบ
                    'point_last' => $result_user_spin1['spin'], //ก่อนเพิ่มคะแนน
                    'point_result' => $add_result, //หลังadd
                    'create_time' => time(),
                    'status' => '1',
                );
                if ($this->db->insert('log_poin_and_spin', $data)) {
                    $result_point = $this->db->set('spin', $add_result)->where('user', $user)->update('tb_user');
                    if ($result_point) {
                        $select = $this->db->select('id,name')->where('id', $id_admin)->get('tb_login')->result_array();
                        $name = "";
                        foreach ($select as $row) {
                            $name = $row['name'];
                        }
                        // LINE
                        if ($lnfy = $this->db->where('type', 'add_spin')->get('tb_linenotify')->row()) {
                            if ($lnfy->token != '') {

                                $messageNofity = 'มีการเพิ่มSPIN รหัส:' . $New_user . ' จำนวน:' . $amount_out . 'Spin ด้วยมือโดย: ' . $name;
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
                                    CURLOPT_POSTFIELDS => "message=" . $messageNofity,
                                    CURLOPT_HTTPHEADER => array(
                                        "Content-Type: application/x-www-form-urlencoded",
                                        "Authorization: Bearer " . $lnfy->token,
                                    ),
                                ));
                                $response = curl_exec($curl);
                                curl_close($curl);
                            }
                        }
                        //

                        $re = array('msg' => 'ทำรายการเรียบร้อยแล้ว', 'code' => 1);
                    } else {
                        $re = array('msg' => 'เพิ่มSpinไม่ได้', 'code' => 0);
                    }
                } else {
                    $re = array('msg' => 'เพิ่มSpinไม่ได้', 'code' => 0);
                }
            }
        } else {
            $re = array('msg' => 'ข้อมูลไม่ครบถ้วน', 'code' => 0);
        }
        echo json_encode($re);
        die();
    }

    public function salename()
    {

        $userid = $this->input->post('id');
        $sale_name = $this->db->where('user_id', $userid)->get('tb_sale_user')->row();
        // $sale_name = $this->db->select('id,name')->get('tb_sale')->result_array();

        $re = array('code' => 1, 'sale' => $sale_name);

        echo json_encode($re);
        die();
    }

    public function edit_salename()
    {

        $id = $this->input->post('id');
        $sale_id = $this->input->post('sale_id');

        $user_s = $this->db->where('user_id', $id)->get('tb_sale_user');
        $user_r = $user_s->row();

        if ($user_s->num_rows() != 0) {
            if ($update_s = $this->db->set('sale_id', $sale_id)->where('user_id', $id)->update('tb_sale_user')) {
                $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
            } else {
                $re = array('code' => 0, 'msg' => 'กรุณาทำรายการอีกครั้ง');
            }
        } else {

            $u_sale = array(
                'sale_id' => $sale_id,
                'user_id' => $id,
                'status' => 1,
            );

            if ($insert_s = $this->db->insert('tb_sale_user', $u_sale)) {
                $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
            } else {
                $re = array('code' => 0, 'msg' => 'กรุณาทำรายการอีกครั้ง');
            }
        }

        echo json_encode($re);
        die();
    }

    //ปุ่มตัดเทิร์น
    public function reset_turnover()
    {
        $turn = $this->input->post('turnover');
        $user_id = $this->input->post('user_id');
        if ($turn != '' & $user_id != '') {
            if ($turn > 0) {
                $data = array(
                    'check_time' => time(),
                    'checkturn' => 0,
                );
				$this->db->where('user_id', $user_id)->update('tb_turnover', $data);
				$data_log = array(
					'user_id' => $user_id,
					'admin_id' => $this->session->owner->id,
					'after_reset' => $turn,
					'time_reset' => time()
				);
				$this->db->insert('log_reset_turn',$data_log);
                $re = array('code' => 1, 'msg' => 'ทำรายการสำเร็จ');
            } else {
                $re = array('code' => 0, 'msg' => 'ไม่สามารถตัดเทิร์น');
            }
        } else {
            $re = array('code' => 0, 'msg' => 'ไม่สามารถทำรายการได้');
        }
        echo json_encode($re);
        die;
    }




    // ข้อมูลการเข้าใช้งานย้อนหลัง 7 วัน
    public function showlog(){
        
		$dateStart   = strtotime(date('Y-m-d 00:00:00',strtotime('-7 days')));
		$dateEnd     = strtotime(date('Y-m-d 23:59:59'));
        $user_id = substr($this->input->post('user'),-6);
		
		$log_ip  = $this->db->select('log_user_login.*,COUNT(platform)as countPlatform')
					->where('user_id',$this->input->post('user'))
					->where('create_time >=',$dateStart)
					->where('create_time <=',$dateEnd)
					->where('action',1)
					->group_by('user_id')
					->group_by('ip')
					->order_by('create_time','desc')
                    ->get('log_user_login')->result_array();
                    
			$k=0;
			foreach ($log_ip as $row) {
				$log_ip[$k]['user_id']     = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($row['user_id']))), -6);
				$log_ip[$k]['datestart'] = date('d-M-Y H:i:s', $row['create_time']);
				$k++;
			}
			echo json_encode(array('data' => $log_ip, 'code' => 1));
			die();
	}
}

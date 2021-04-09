<?php

class User extends MY_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper( 'url' );
    $this->load->model( 'backend/getapi_model' );
    $this->load->model( 'sale/sale_model' );
    $this->load->model( 'sale/user_model' );
    $this->load->library( 'Sale_libraray' );
    $this->sale_libraray->login();
    $this->output->set_template( 'tem_sale/tem_sale' );
  }


  public function index() 
  {
    $data[ 'user' ] = $this->get_user();
    $this->load->view( 'user_all', $data );
  }
  // หน้ายูเซอร์ทั้งหมด โดยแบ่งการค้นหาเป็น หน้า // user all
  public function get_user() 
  {

    if ( empty( $this->input->post( 'Per_Page' ) ) ) {
      $chf = true;
      $Page = 1;
      $Per_Page = 10;
      $Search = '';
    } else {
      $chf = false;
      $Page = $this->input->post( 'Page' );
      $Per_Page = $this->input->post( 'Per_Page' );
      $Search = $this->input->post( 'Search' );
    }

    $Num_Rows = $this->db->select( 'tb_sale_user.id' )->where( 'tb_sale_user.sale_id', $this->session->sale->id )->get( 'tb_sale_user' );
    $Num_Rows = $Num_Rows->num_rows();


    if ( $Page == 1 ) {
      $skip = 0;
    } else {
      $skip = $Per_Page * ( $Page - 1 );
    }
    //,tb_bank.bank_short,tb_user_bank.account
    $user = $this->db->select( '
				tb_sale_user.id,tb_user.user,tb_user.username,tb_user.name,tb_user.create_time,tb_user.line,tb_user.point,tb_user.spin
			' )->join( 'tb_user', 'tb_user.id = tb_sale_user.user_id', 'left' )
      //			->join('tb_user_bank', 'tb_user_bank.user_id = tb_sale_user.user_id')
      //			->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id','left')
      ->where( 'tb_sale_user.sale_id', $this->session->sale->id )->limit( $Per_Page, $skip )
      // ->limit(10,20)
      ->order_by( 'tb_sale_user.user_id', 'ASC' )

    ->get( 'tb_sale_user' );

    $d_user = $user->result_array();

    if ( $Num_Rows <= $Per_Page ) {
      $Num_Pages = 1;
    } else if ( ( $Num_Rows % $Per_Page ) == 0 ) {
      $Num_Pages = ( $Num_Rows / $Per_Page );
    } else {
      $Num_Pages = ( $Num_Rows / $Per_Page ) + 1;
      $Num_Pages = ( int )$Num_Pages;
    }
    $data = array(
      'user' => $d_user,
      'Num_Rows' => $Num_Rows,
      'Num_Pages' => $Num_Pages,
      'Page' => $Page,
      'Per_Page' => $Per_Page
    );
    if ( $chf ) {
      return json_encode( $data );
    } else {
      echo json_encode( $data );
      die;
    }
  }

  // หน้าค้นหายูเซอร์ทีละรายการ
  public function search() 
  {
    // กรณีกดค้นหา จะมี input
    if ( $this->input->post() ) {
      if ( $this->input->post( 's_user' ) != null ) {
        //ค้นหาจาก Username
        $user6 = substr( $this->input->post( 's_user' ), -6 );
        $user = $this->getapi_model->agent() . 'i' . substr( ( "000000" . ( intval( $user6 ) ) ), -6 );
        $user_r = $this->user_model->SelectByUser( $user );
      } else if ( $this->input->post( 't_user' ) != null ) {
        //ค้นหาจาก เบอร์โทรศัพท์
        $tel = $this->input->post( 't_user' );
        $user_r = $this->user_model->SelectByTel( $tel );
      } else {
        $re = array( 'code' => '0', 'title' => 'ไม่มียูเซอร์', 'msg' => '', 'data' => '' );
        echo json_encode( $re );
        die();
      }
      if ( $user_r == '' ) {
        $re = array( 'code' => '0', 'title' => '', 'msg' => '', 'data' => '' );
      } else {
        //ค้นหาว่ายูเซอร์นี้มีผู้สร้างเป็น User หรือ Sale
        $sale_user_q = $this->db->select( 'sale_id' )->where( 'user_id', $user_r->id )->get( 'tb_sale_user' );

        if ( $sale_user_q->num_rows() == 1 ) {
          //เซลล์สร้าง
          $sale_user_r = $sale_user_q->row();
          $sale_name = $this->sale_model->SelectById( $sale_user_r->sale_id )->name;
        } else {
          //ค้นหาว่ายูเซอร์นี้มีผู้สร้างเป็น User หรือไม่
          $user_sale_q = $this->db->select( 'user_id' )->where( 'user_id', $user_r->id )->get( 'tb_user_sale' );
          if ( $user_sale_q->num_rows() == 1 ) {
            // AF ของ User
            $sale_name = $this->user_model->SelectById( $user )->user;
          } else {
            $sale_name = " ไม่มีผู้แนะนำ ";
          }
        }
        $user_r->sale_name = $sale_name;

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
          'AgentName'   => $this->getapi_model->agent(),
          'PlayerName'  => $user_r->user,
            'From'      => date('m/d/Y', time() - (7 * 24 * 60 * 60)), //01/01/2020
            'To'      => date('m/d/Y'), //01/01/2020
            'TransferType'  => -1, //(2:Deposit/3:Withdraw)
            'PageSize'    => 10,
            'PageIndex'   => 1,
            'TimeStamp'   => time()
          );
        $dataAPI = array(
          'type'    => 'D',
          'agent'   => $this->getapi_model->agent(),
          'member'  => $user_r->user,
        );
        $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/transferlogs';
        $cre_userAPI =  $this->getapi_model->getapi($arr_depAPI, $url_api, $dataAPI);
          //Credit
        $user_r->add_cd = $cre_userAPI->Result->Records;
        
        $re = array( 'code' => '1', 'title' => 'สำเร็จ', 'msg' => '', 'data' => $user_r );
      }

      //save Log type search
      $log_detail = '(search),(' . $this->input->post( 's_user' ) . '/' . $this->input->post( 't_user' ) . '),';
      $log_type = 'search';
      $this->sale_libraray->log_sale( $log_type, $log_detail );
		
      echo json_encode( $re );
      die();
    } else {
      $this->load->view( 'user_search' );
    }
  }

  public function user_account() 
  {
    $data[ 'bank' ] = $this->db->get( 'tb_bank' )->result_array();
    $data[ 'group' ] = $this->db->where( 'status', 1 )->get( 'tb_group' )->result_array();

    $this->load->view( 'user_account', $data );
  }
  public function search_account() 
  {
    $user_acc = $this->input->post( 'user_acc' );
    $user_name = $this->input->post( 'user_name' );
    if ( $user_acc != '' ) {
      $user = $this->db->select( 'tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id' )->like( 'tb_user_bank.account', $user_acc, 'both' )->join( 'tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left' )->join( 'tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left' )->get( 'tb_user' )->result_array();
    } else if ( $user_name != '' ) {
      $user = $this->db->select( 'tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id' )->like( 'tb_user.name', $user_name, 'both' )->join( 'tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left' )->join( 'tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left' )->get( 'tb_user' )->result_array();
    }
	  //save Log type search
      $log_detail = '(search),(' . $this->input->post( 'user_acc' ) . '/' . $this->input->post( 'user_name' ) . '),';
      $log_type = 'search';
      $this->sale_libraray->log_sale( $log_type, $log_detail );
    echo json_encode( $user );
    die;
  }
  public function sel_detail_account()
  {
    $user = $this->input->post( 'user' );
    $user_r = $this->db->select( 'tb_user.*,tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_user_bank.bank_id,tb_bank.api_id' )->join( 'tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left' )->join( 'tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left' )->where( 'tb_user.user', $user )->get( 'tb_user' )->row();

    if ( $user_r ) {
      $user_r->credit = $this->get_credit( $user_r->user );
      $user_r->dw = $this->db->select( 'id,from_unixtime(datetime +25200, "%Y-%m-%dT%H:%i:%s" ) as datetime2,dateCreate,deposit,withdraw' )->where( 'user_id', $user_r->id )->order_by( 'id', 'DESC' )->limit( 10 )->get( 'tb_statement' )->result_array();


      $user_r->gu = $this->db->select( 'tb_group.id,tb_user_group.id as gu_id,tb_group.name' )->join( 'tb_group', 'tb_group.id= tb_user_group.group_id' )->where( 'tb_user_group.user_id', $user_r->id )->where( 'tb_user_group.status', 1 )->get( 'tb_user_group' )->result_array();
      $arr_depAPI = array(
        'AgentName' => $this->getapi_model->agent(),
        'PlayerName' => $user_r->user,
        'From' => date( 'm/d/Y', time() - ( 7 * 24 * 60 * 60 ) ), //01/01/2020
        'To' => date( 'm/d/Y' ), //01/01/2020
        'TransferType' => -1, //(2:Deposit/3:Withdraw)
        'PageSize' => 10,
        'PageIndex' => 1,
        'TimeStamp' => time()
      );
      $dataAPI = array(
        'type' => 'D',
        'agent' => $this->getapi_model->agent(),
        'member' => $user_r->user,
      );
      $url_api = 'https://ctransferapi.linkv2.com/api/credit-transfer/transferlogs';
      $cre_userAPI = $this->getapi_model->getapi( $arr_depAPI, $url_api, $dataAPI );
      //Credit
      $user_r->add_cd = $cre_userAPI->Result->Records;

      //Ticket
      // $user_r->stakeMoney = $this->getapi_model->get_ticket($user_r->user);

      //Sale name
      $su_q = $this->db->select( 'tb_sale.name' )->join( 'tb_sale_user', 'tb_sale_user.sale_id = tb_sale.id', 'left' )->where( 'tb_sale_user.user_id', $user_r->id )->where( 'tb_sale_user.status', 1 )->get( 'tb_sale' );
      if ( $su_q->num_rows() == 1 ) {
        $su_r = $su_q->row();
        $user_r->sale_name = $su_r->name;
      } else {
        $uss_q = $this->db->select( 'sale_userid' )->where( 'user_id', $user_r->id )->where( 'status', 1 )->get( 'tb_user_sale' );

        if ( $uss_q->num_rows() == 1 ) {
          $uss = $uss_q->row();
          $uss_s = $this->db->select( 'user' )->where( 'id', $uss->sale_userid )->where( 'status', 1 )->get( 'tb_user' )->row();
          $user_r->sale_name = $uss_s->user;
        } else {
          $user_r->sale_name = 'ไม่มีผู้แนะนำ';
        }
      }

      $re = array( 'code' => 1, 'msg' => '', 'data' => $user_r );
    } else {
      $re = array( 'code' => 0, 'msg' => '', 'data' => '' );
    }
    echo json_encode( $re );
    die();
  }
  public function edit_name() 
  {
    if ( $this->input->post( 'user' ) && $this->input->post( 'name' ) ) {
      $user = $this->input->post( 'user' );
      $name = $this->input->post( 'name' );
      $user_r = $this->db->select( 'id' )->where( 'user', $user )->get( 'tb_user' )->row();
      if ( $this->db->set( 'name', $name )->where( 'id', $user_r->id )->update( 'tb_user' ) ) {
        $re = array( 'code' => 1, 'msg' => 'แก้ไขสำเร็จ', 'title' => 'สำเร็จ' );
		  //save Log type search
		  $log_detail = '(editname),(' . $this->input->post( 'user' ) . '/' . $this->input->post( 'name' ) . '),';
		  $log_type = 'editname';
		  $this->sale_libraray->log_sale( $log_type, $log_detail );
      } else {
        $re = array( 'code' => 0, 'msg' => 'อัพเดตฐานข้อมูลไม่สำเร็จ', 'title' => 'ไม่สำเร็จ' );
      }
    } else {
      $re = array( 'code' => 0, 'msg' => 'ไม่พบยูเซอร์ที่ต้องแก้ไข', 'title' => 'ไม่สำเร็จ' );
    }
    echo json_encode( $re );
    die();
  }

  function get_credit( $user ) 
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
    $cre_userAPI = $this->getapi_model->getapi( $arr_userAPI, $url_api, $dataAPI );
    if ( $cre_userAPI->Error == 0 ) {
      $amount = $cre_userAPI->Balance;
    } else {
      $amount = $cre_userAPI->Message;
    }
    return $amount;
  }
  public function edit_pass()
  {
    if ( $this->input->post( 'user' ) && $this->input->post( 'password' ) ) {
      $user = $this->input->post( 'user' );
      $password = $this->input->post( 'password' );
      $user_r = $this->db->select( '*' )->where( 'user', $user )->get( 'tb_user' )->row();
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
      $cre_userAPI = $this->getapi_model->getapi( $arr_userAPI, $url_api, $dataAPI );
      if ( $cre_userAPI->Status == 1 ) {
        if ( $this->db->set( 'password', $password )->where( 'id', $user_r->id )->update( 'tb_user' ) ) {
          $re = array( 'code' => 1, 'msg' => 'Success' );
        } else {
          $re = array( 'msg' => 'เปลี่ยนสำเร็จ แต่ DB ไม่เซฟ', 'code' => 0 );
        }
      } else {
        $re = array( 'msg' => 'ไม่สามารถเปลี่ยนพาสเวิร์ดได้', 'code' => 0 );
      }
    } else {
      $re = array( 'msg' => 'input post password ไม่เจอ', 'code' => 0 );
    }
    echo json_encode( $re );
    die();
  }

   // ข้อมูลการเข้าใช้งานย้อนหลัง 7 วัน
   public function showlog(){
     
		$dateStart   = strtotime(date('Y-m-d 00:00:00',strtotime('-7 days')));
		$dateEnd     = strtotime(date('Y-m-d 23:59:59'));
        $user_id = substr($this->input->post('user'),-6);

			
		$log_ip  = $this->db->select('log_user_login.*,COUNT(platform)as countPlatform')
					->where('user_id',$user_id)
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
<?php
  class Report_problem_line extends MY_Controller
  {
      public function __construct()
      {
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
          $report_line['report'] = $this->db->select('tb_report_line.*, tb_user.username, tb_line.line_id')
          ->join('tb_user', 'tb_report_line.id_user = tb_user.id')
          ->join('tb_line', 'tb_line.tel = tb_user.username')
          ->get('tb_report_line')
          ->result_array();

          // echo"<pre>";
          // print_r($report_line);
          // die();

          $this->load->view('report_problem_line', $report_line);
      }

      public function update_status()
      {
          $status = $this->input->post('status');
          $username = $this->input->post('username');

          if ($id = $this->input->post('id')) {
              if ($status == 0) {
                  $data = array('updatedAt' => time(), 'status'=>'1');
                  $this->db->where('tb_report_line.id', $id)->update('tb_report_line', $data);

                  $nweb =  $this->getapi_model->nameweb();
                  $value = $this->db->select('value')
                          ->where('name', 'suffixDomainName')
                          ->get('setting_line')->row()->value;
                  $token = $this->db->select('code')
                            ->where('name', 'bearer')
                            ->get('setting')->row()->code;

                  $data['pushMes'] = $this->db->select('tb_report_line.*,tb_line.line_id')
                  ->join('tb_user', 'tb_user.id = tb_report_line.id_user')
                  ->join('tb_line', 'tb_line.tel = tb_user.username')
                  ->where('tb_report_line.id', $id)
                  ->get('tb_report_line')
                  ->result_array();

                  $userID = $data['pushMes'][0]['line_id'];
                  $problem = $data['pushMes'][0]['report'];
                  $createdAt = gmdate('d/m/Y H:i', $data['pushMes'][0]['createdAt'] + 3600*(+7));


                  $MES = "แอดมินได้ดำเนินแก้ไขปัญหา {$problem} ของวันที่ {$createdAt} เรียบร้อยแล้ว";
                  $text = '{'.'"users":'.'['.'"'."$userID".'"'.'],'.'"text":'.'"'."$MES".'"'.'}';

                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://'.$nweb.'.'.$value.':3333/v1/push/users/text',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => $text,
                          CURLOPT_HTTPHEADER => array(
                              'Authorization: Bearer '.$token,
                              'Content-Type: application/json'
                            ),
                          ));


                  $response = curl_exec($curl);
                  curl_close($curl);
                  echo $response;
                  die();
              }
          } else {
              $re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
          }
          echo json_encode($re);
          die();
      }
  }

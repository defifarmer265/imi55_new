<?php
class Push_message extends MY_Controller
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
        $user = $this->db->distinct()
              ->select('line,username')
                            ->where('line !=', '')
                            ->get('tb_user')->result_array();

        $line_id = $this->db->distinct()
               ->select('tel,line_id,tel', 'create_time')
              ->where('status !=', 0)
              ->where('create_time !=', '')
              ->where('line_id !=', '')
                            ->get('tb_line')->result_array();

        $data = array(
                                'user' => $user,
                                'line_id' =>$line_id
                                    );
        $this->load->view('push_message', $data);
        // $user = $this->db->select('line,username')
        // 					->where('line !=','')
        // 					->get('tb_user')->result_array();
        //
        // $line_id = $this->db->select('tel,line_id,tel')
        // 					->where('status !=',0)
        // 					->get('tb_line')->result_array();
        //
        // 				$data = array(
        // 						'user' => $user,
        // 						'line_id' =>$line_id
        // 							);
        // $this->load->view('push_message',$data);
    }
    public function sent_data_line()
    {
        $data = $this->input->post('data');
        $nweb =  $this->getapi_model->nameweb();

        $value = $this->db->select('value')
                ->where('id', 39)
                ->get('setting_line')->row()->value;

        // print_r($value);
        // die;

        for ($i = 0; $i < sizeof($data); $i++) {
            $line_id[$i] = $data[$i]['line_id'][0];
            $message[$i] = $data[$i]['message'][0];
            $packageId[$i] = $data[$i]['packageId'][0];
            $stickerId[$i] = $data[$i]['stickerId'][0];
            $image[$i] = $data[$i]['image'][0];
            // print_r( $image[$i]); die;
        }
        // print_r($image[0]['image']);
        // die;

        $string = implode(',', $line_id);
        if ($message[0] == 'sticker') {
            $pk = $packageId[0]['packageid'];
            $stk = $stickerId[0]['stickerid'];

            $sticker = '{'.'"users":'.'['."$string".'],'.'"packageId":'.$pk.','.'"stickerId":'.$stk.'}';
            // print_r($sticker);
            // die;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://'.$nweb.'.'.$value.':3333/push/users/sticker',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>$sticker,
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            die();
        } elseif ($message[0]=='image') {
            $image = $image[0]['image'];
            $imageUrl = '{'.'"users":'.'['."$string".'],'.'"imageUrl":'.'"'."$image".'"'.'}';
            // print_r($imageUrl);
            // die;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://'.$nweb.'.'.$value.':3333/push/users/image',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS =>$imageUrl,
                          CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json'
                          ),
                        ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            die();
        } else {
            $MES = $message[0]['message'];

            $text = '{'.'"users":'.'['."$string".'],'.'"text":'.'"'."$MES".'"'.'}';

            $curl = curl_init();
            curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://'.$nweb.'.'.$value.':3333/push/users/text',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>$text,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                    ));

            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
            die();
        }
    }
}

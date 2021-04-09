<?php
class Rebank extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->model('Bbl_wd_model');
        $this->load->library('backend/backend_library');
        $this->_init();
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
        $this->output->set_template('tem_admin/tem_admin');
    }

    public function index()
    {
        $data['rebank'] = $this->db->get('rebank')->result();
        $this->load->view('rebank_view', $data);
    }
    public function savelist()
    {   
        $time = time();
        $data = [
                'bank'=>$this->input->post('bank'),
                'name'=>$this->input->post('name'),
                'datereset' =>$time,
                'admin' => $this->session->admin['username']
        ];
        if ($InsertId = $this->db->insert('rebank', $data)) {
            $data['id'] = $InsertId;
            $data['datereset'] = date('d/m/Y H:i:s', $time);
			echo json_encode(array('status' => true, 'data' => $data));
		} else {
			echo json_encode(array('status' => false, 'data' => null));
		}
		die;
    }
    public function deletedata()
	{

		if ($this->db->where('id', $this->input->post('id'))->delete('rebank')) {
			echo json_encode(array('status' => true));
		} else {
			echo json_encode(array('status' => false));
		}
		die;
    }
    public function editdata()
    {
        $data=[
            'bank'=>$this->input->post('bank'),
            'name'=>$this->input->post('name'),
           
        ];
      if ($this->db->where('id', $this->input->post('sentId'))->update('rebank',$data)) {
          $newdata = $this->db->where('id',$this->input->post('sentId'))->get('rebank')->row();
          echo json_encode(array('status' => true, 'data' => $newdata));
      } else {
          echo json_encode(array('status' => false, 'data' => null));
      }
      die;
    }
    public function sent_reset()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://' . $_SERVER['HTTP_HOST'] . ':4321/rebank/' . $this->input->post('name'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        if ($response) {
            $time = time();
            $this->db->where('id', $this->input->post('id'))->update('rebank', array('datereset' => $time, 'admin' => $this->session->admin['username']));
            echo json_encode(array(
                'status' => true,
                'admin' => $this->session->admin['username'],
                'date' =>  date('d/m/Y H:i:s', $time)
            ));
        } else {
            echo json_encode(array('status' => false, 'msg' => 'ไม่สามารถรีได้กรุณาแจ้งทีมงาน'));
        }

        die;
    }
}

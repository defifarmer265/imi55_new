<?php
class Setting_style extends MY_Controller
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
        $style = $this->db->select('*')->get('setting_line_style')->result_array();
        $data = array('style' => $style);
        $this->load->view('setting_style', $data);
    }

    public function edit_data()
    {
        $id = $this->input->post('id');
        $data = array(
              'value' => $this->input->post('value'),
              );
        if ($this->db->where('id', $id)->update('setting_line_style', $data)) {
            $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
        } else {
            $re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
        }
        echo json_encode($re);
        die();
    }
}

<?php
class Setting_linenotify extends MY_Controller
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
    }

    public function index()
    {
        $setting = $this->db->select('*')
          ->get('setting_line_notify')
          ->result_array();

        $data = array('setting'=> $setting);

        $this->load->view('setting_linenotify', $data);
    }

    public function enable()
    {
        if ($name = $this->input->post('name')) {
            $enable = $this->input->post('enable');
            if ($enable == 0) {
                $data = array(
                    'isEnabled'=>'1'
                  );
                $this->db->where('name', $name)->update('setting_line_notify', $data);
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
            } else {
                $data = array(
                    'isEnabled'=>'0'
                );
                $this->db->where('name', $name)->update('setting_line_notify', $data);
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
            }
        } else {
            $re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
        }
        echo json_encode($re);
        die();
    }


    public function edit_token()
    {
        $name = $this->input->post('name');
        $value = $this->input->post('value');
        if ($name && $value) {
            if ($this->db->set('value', $value)->where('name', $name)->update('setting_line_notify')) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
            } else {
                $re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
            }
        } else {
            $re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
        }
        echo json_encode($re);
        die();
    }
}

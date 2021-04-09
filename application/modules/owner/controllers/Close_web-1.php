<?php

class Close_web extends MY_Controller
{

	public function __construct()
    {
        $this->load->model('backend/getapi_model');
        $this->load->model('owner_model');
        $this->load->library('owner_libraray');
        $this->load->helper('url');
        $this->_init();
    }
    private function _init()
    {		
            $this->output->set_template('tem_owner/tem_owner');
            $this->owner_libraray->login();
    }
    public function index()
    {
       			
        $data['mainten'] = $this->db->where('id !=',1)->get('tb_service_charge')->result_array();
        $this->load->view('close_web', $data);
    }

    public function close_web(){
       
        // 0 ใช้สำหรับเปิดให้เข้าหลังบ้าน
        if($this->input->post() != null){
            if ( $this->db->set('confirm_web',  $this->input->post('st'))->where('id',$this->input->post('id'))->update('tb_service_charge') ){
                $re = array('msg' => 'เปิดการใช้งานระบบสำเร็จ' ,'code'=> 1 ,'title'=>'เปิดการใช้งานสำเร็จ');
            } else {
                $re = array('msg' => 'ไม่สามารถเปิดการใช้งานได้' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้');
            }
        }else{
            $re = array('msg' => 'ระบบผิดพลาดโปรดติดต่อพนักงาน' ,'code'=> 0 ,'title'=>'ระบบผิดพลาดโปรดติดต่อพนักงาน');
        }
        echo json_encode($re);
        die();

    }

    public function open_web(){
      
        // 1 ปิดการใช้งานเว็บไม่สามารถเข้าได้
        if($this->input->post() != null){
            if ( $this->db->set('confirm_web',  $this->input->post('st'))->where('id',$this->input->post('id'))->update('tb_service_charge') ){
                $re = array('msg' => 'ปิดการใช้งานระบบสำเร็จ' ,'code'=> 1 ,'title'=>'ปิดการใช้งานสำเร็จ');
            } else {
                $re = array('msg' => 'ไม่สามารถปิดการใช้งานได้' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้');
            }
        }else{
            $re = array('msg' => 'ระบบผิดพลาดโปรดติดต่อพนักงาน' ,'code'=> 0 ,'title'=>'ระบบผิดพลาดโปรดติดต่อพนักงาน');
        }
        echo json_encode($re);
        die();
    }
   
}

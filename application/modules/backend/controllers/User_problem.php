<?php
class User_problem extends MY_Controller
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
        $data['report'] = $this->db->select('*')->get('tb_report')->result_array();
		$this->load->view('report_user_problem',$data);
    }
    public function update_status(){
    if($id = $this->input->post('id')){
        $status = $this->input->post('status');
        if($status == 0){
        $data = array(
            'updatedAt' => time(),
            'status'=>'1'
            
        );
        $this->db->where('tb_report.id',$id)->update('tb_report', $data);
        $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
        }else{
            $data = array(
                'updatedAt' => time(),
                'status'=>'0' 
            );
            $this->db->where('tb_report.id',$id)->update('tb_report', $data);
            $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
        }
    }else{
        $re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
    }
    echo json_encode($re);
    die();
    }
}
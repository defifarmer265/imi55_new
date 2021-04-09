<?php
class Setting_linebot extends MY_Controller
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
		
      $setting = $this->db->select('*')
			->where('type_data !=', '0')
      ->get('setting_line')
			->result_array();

			$data = array('setting' => $setting);

			$this->load->view('setting_linebot',$data);
	}
	public function enable()
	{
        if($id = $this->input->post('d')){
            $enable = $this->input->post('enable');
            if($enable == 0){
            $data = array(
                'isEnabled'=>'1'

            );
            $this->db->where('setting_line.id',$id)->update('setting_line', $data);
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			}else{
				$data = array(
					'isEnabled'=>'0'

				);
				$this->db->where('setting_line.id',$id)->update('setting_line', $data);
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			}
		}else{
			$re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
        die();
	}
	public function save_edit(){
		$id = $this->input->post('id');
		$data = array(
				'value' => $this->input->post('value'),
	);
			if($this->db->where('id',$id)->update('setting_line',$data)){
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			}else{
				$re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
			}
		echo json_encode($re);
        die();
	}
}

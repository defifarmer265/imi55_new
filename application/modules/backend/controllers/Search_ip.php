<?php

class Search_ip extends MY_Controller
{

	 public function __construct()
    {
        parent::__construct();
		$this->load->model('getapi_model');
        $this->load->library('backend/backend_library');
		$this->_init();
        
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }

	public function search()
	{
        
        if($this->input->post()){
            $dateStart =   strtotime(date('Y-m-d 00:00:00',strtotime($this->input->post('dt1'))));
            $dateEnd   =   strtotime(date('Y-m-d 23:59:59',strtotime($this->input->post('dt2'))));
            $user      =   $this->getapi_model->agent() . 'i' . substr(("000000" . (intval( $this->input->post('user')))), -6);
            
            if($user != ""){
                $log_ip  = $this->db->select('user_id,ip,create_time,platform, COUNT(platform)as countPlatform')
                           //->where('user_id',substr($user,-6))
                           ->where('user_id',$user)
                           ->where('create_time >=',$dateStart)
                           ->where('create_time <=',$dateEnd)
                           ->where('action',1)
                           ->group_by('user_id')
                           ->group_by('ip')
                           ->order_by('create_time','desc')
                           ->get('log_user_login')->result_array();
                $k=0;
				foreach ($log_ip as $row) {
                        // $log_ip[$k]['user_id']     = $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($row['user_id']))), -6);
                        $log_ip[$k]['user_id']     = $row['user_id'];
						$k++;
                }
                echo json_encode(array('data' => $log_ip, 'code' => 1));
                die();
            }else{
                echo  json_encode($re = array('msg' => 'กรุณาใส่ User ที่จะค้นหา' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ')); //Error
                die();
            }
        }else{
            $data['user'] = $this->db->select('user_id,ip,create_time,platform, COUNT(platform)as countPlatform')
            ->where('create_time >=',strtotime(date('Y-m-d 00:00:00')))
            ->where('create_time <=',strtotime(date('Y-m-d 23:59:59')))
            ->where('action',1)
            ->group_by('user_id')
            ->group_by('ip')
            ->order_by('id','DESC')
            ->get('log_user_login')->result_array();

            $this->load->view('search_ip',$data);	
        }
        
     
        
    }


}


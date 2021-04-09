<?php
    class Service extends MY_Controller{
        public function __construct()
        {
    
            parent::__construct();		
            
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
        public function index(){
            $data['service'] = $this->db->select('*')->get('tb_service_charge')->result_array();
            $this->load->view('service_charge',$data);
        }

        public function create_service(){
            if($this->input->post()){
                $title   = $this->input->post('t');
                $detail  = $this->input->post('d');
                $price   = $this->input->post('p');
                $dt2 		= strtotime(date('d-m-Y 10:59:59', strtotime($this->input->post('da'))));
               
                $data = array(
                    "title"=>$title,
                    "detail"=>$detail,
                    "service_charge"=>$price,
                    'close_web'=>$dt2,
                    'status'=>'0',
                    'confirm_web'=>'0',
                    'create_time'=>time()
                );
                if($this->db->insert('tb_service_charge',$data)){
                    $re = array('msg' =>'บันทึกข้อมูลสำเร็จ','code'=> 1);
                }else{
                    $re = array('msg' =>'ระบบเกิดปัญหาโปรดติดต่อเจ้าหน้าที่ หรือ F5 เพื่อทำการใหม่','code'=> 0);
                }

            }else{
                $re = array('msg' =>'ระบบเกิดข้อผิดพลาดโปรดแจ้งเจ้าหน้าที่','code'=> 0);
            }
            echo json_encode($re);
            die();
        }

        public function delete_service(){
            if($this->input->post()){
                $query = $this->db->where('id',$this->input->post('id'))->delete('tb_service_charge');
                    if($query){
                        $re = array('msg' =>'ลบข้อมูลสำเร็จ','code'=> 1);
                    }else{
                        $re = array('msg' =>'ลบข้อมูลไม่สำเร็จ','code'=> 1);
                    }
            }else{
                $re = array('msg' =>'ระบบเกิดข้อผิดพลาดโปรดแจ้งเจ้าหน้าที่','code'=> 0);
            }
            echo json_encode($re);
            die();
        }


        public function edit_service(){
            $result = $this->db->where('id',$this->input->post('id'))->get('tb_service_charge')->row();
            echo json_encode($result);
            die;
        }

        public function update_service(){

            if($this->input->post()){
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $detail = $this->input->post('detail');
                $price = $this->input->post('price');
                $dt2 		= strtotime(date('d-m-Y 10:59:59', strtotime($this->input->post('dt2'))));
                $query = $this->db->set('title',$title)->set('detail',$detail)->set('service_charge',$price)->set('close_web',$dt2)->where('id',$id)->update('tb_service_charge');
                if ($query) {
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ทำรายการสำเร็จ');
                } 
                else {
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ทำรายการไม่สำเร็จ');
                }
            
            }else{
                $re = array('msg' =>'ระบบเกิดข้อผิดพลาดโปรดแจ้งเจ้าหน้าที่','code'=> 0);
            }
            echo json_encode($re);
            die();
        }


        
        public function update_status(){
            if($this->input->post()){
                 $id = $this->input->post('id');
                 $status = $this->input->post('st');
                 $query = $this->db->set('status',$status)->where('id',$id)->update('tb_service_charge');
                 if ($query) {
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ทำรายการสำเร็จ');
                } else {
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ทำรายการไม่สำเร็จ');
                }
            }else{
                $re = array('msg' =>'ระบบเกิดข้อผิดพลาดโปรดแจ้งเจ้าหน้าที่','code'=> 0);
            }

            echo json_encode($re);
            die();
        }



        public function update_confirm_web()
        {
            if($this->input->post()){
                $id = $this->input->post('id');
                $status = $this->input->post('st');
                $query = $this->db->set('confirm_web',$status)->where('id',$id)->update('tb_service_charge');
                if ($query) {
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ทำรายการสำเร็จ');
                } else {
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ทำรายการไม่สำเร็จ');
                }
            }else
            {
                $re = array('msg' =>'ระบบเกิดข้อผิดพลาดโปรดแจ้งเจ้าหน้าที่','code'=> 0);
            } 
            echo json_encode($re);
            die();
        }


    
        
    }

   
?>
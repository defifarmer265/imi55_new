<?php
class Owner extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('getapi_model');
        $this->load->library('backend/backend_library');
        $this->_init();
    }
    private function _init(){
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }

    public function index(){
        $data['owner_list']= $this->db->select('id,username,name,tel,status,last_login,lastip_login')
                             ->where('id !=',1)->get('tb_owner');
        $this->load->view('owner',$data);
    }

    public function cre_owner()
    {
        if($this->input->post('username')){
            $username = $this->input->post('username');
            $password = sha1($this->input->post('password'));
            $name     = $this->input->post('name');
            $tel      = $this->input->post('tel');
            if($check_username = $this->db->select('username')->where('username',$username)->get('tb_owner')->num_rows() === 0){
                    $data = array(
                        "username"=>$username,
                        "password"=>$password,
                        "name"=>$name,
                        'tel'=>$tel,
                        'status'=>'1',
                    );
                    if($this->db->insert('tb_owner',$data)){
                        $re = array('msg' =>'สร้างบัญชีผู้ใช้งานสำเร็จ','code'=> 1);
                    }else{
                        $re = array('msg' =>'ระบบเกิดปัญหาโปรดติดต่อเจ้าหน้าที่ หรือ F5 เพื่อทำการใหม่','code'=> 0);
                    }
            }else{
                $re = array('msg' =>'ยูเซอร์ซ้ำ','code'=> 0 );
            }
        }else{
            $re = array('msg' =>'กรุณากรอกข้อมูลให้ครบทุกช่องด้วย','code'=> 0);
        }
        echo json_encode($re);
		die();
    }

    public function edit_pass_owner(){
        
        if($this->input->post('admin_id')){
            $id = $this->input->post('admin_id');
            $pass = sha1($this->input->post('password'));
            if($this->db->select('id,password')->where('id',$id)->set('password',$pass)->update('tb_owner')){
                $re = array('msg'=>'เปลี่ยนรหัสการใช้งานบัญชีนี้สำเร็จ','code'=>1);
            }else{
                $re = array('msg'=>'เปลี่ยนรหัสการใช้งานบัญชีนี้ไม่สำเร็จ โปรดติดต่อเจ้าหน้าที่','code'=>0);
            }
        }else{
            $re = array('msg'=>'ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่ หรือ f5 แล้วทำรายการใหม่','code'=>0);
        }
        echo json_encode($re);
		die();
    }

    public function edit_status(){
        if($id = $this->input->post('id')){
            $check = $this->db->select('id,status')->where('id',$id)->get('tb_owner')->row();
            if($check->status ==0){
               if($this->db->where('id',$id)->set('status',1)->update('tb_owner')){
                   $re = array('msg'=>'เปิดการใช้งานบัญชีนี้สำเร็จ','code'=>1);
               }else{
                  $re = array('msg'=>'เปิดการใช้งานบัญชีนี้ไม่สำเร็จ โปรดติดต่อเจ้าหน้าที่','code'=>0);
               }
            }
            else{
               if($this->db->where('id',$id)->set('status',0)->update('tb_owner')){
                   $re = array('msg'=>'ปิดการใช้งานบัญชีนี้สำเร็จ','code'=>1);
               }else{
                  $re = array('msg'=>'ปิดการใช้งานบัญชีนี้ไม่สำเร็จ โปรดติดต่อเจ้าหน้าที่','code'=>1);
               }
            }
        }else{
           $re = array('msg'=>'ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่ หรือ f5 แล้วทำรายการใหม่','code'=>0);
        }
       echo json_encode($re);
       die();
   }

}
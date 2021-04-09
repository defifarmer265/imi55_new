<?php

class Maintenance extends MY_Controller
{

	public function __construct()
    {
        parent::__construct();
	
        $this->load->library('backend/backend_library');
        $this->load->model('getapi_model');
       
        $this->load->helper('url', 'file');
        $this->load->helper('file');
        $this->_init();
    }
    private function _init()
    {
        $this->output->set_template('tem_admin/tem_admin');
        $this->backend_library->checkLoginAdmin();
    }
    public function index()
    {
		

        $data['bank'] = $this->db->select('tb_bank.bank_th, tb_bank_web.bank_id,tb_bank.api_id')
                             ->join('tb_bank', 'tb_bank.id = tb_bank_web.bank_id', 'left')
                             ->where('tb_bank_web.status', 3)
                             ->group_by('tb_bank_web.bank_id')
                             ->get('tb_bank_web')
                             ->result_array();
        $data['bank_with'] = $this->db->select('bank_id')->where('status', 3)->get('tb_bank_web')->result_array();				
        $data['mainten'] = $this->db->get('maintenance')->result_array();
        $this->load->view('maintenance', $data);
    }


    public function enable_credit()
    {
        // 0 ปิด 1 เปิด
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function open_credit()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function open_bank()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
			$acc_account = $this->db->select('bank_id')->where('status',0)->get('acc_account')->result_array();
			$this->db->set('status',1)->where('status',0)->update('acc_account');
			
			foreach ($acc_account as $ac){
				$this->db->set('status',3)->where('status',0)->where('id',$ac['bank_id'])->update('tb_bank_web');
			}
			
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function close_bank()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
			$acc_account = $this->db->select('bank_id')->where('status',1)->get('acc_account')->result_array();
			$this->db->set('status',0)->where('status',1)->update('acc_account');
			
			foreach ($acc_account as $ac){
				$this->db->set('status',0)->where('status',3)->where('id',$ac['bank_id'])->update('tb_bank_web');
				
			}
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }


    public function open_member()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }


    public function close_member()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }


    public function open_web()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function close_web()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function open_announce_web()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function close_announce_web()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function open_announce_member()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function close_announce_member()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }
    // ธนาคารปิดปรับปรุง
    public function open_bank_maintenance()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถเปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function close_bank_maintenance()
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    //end ธนาคารปิดปรับปรุง 

    
    // function สำหรับอัพรูปภาพของ id 5 ในตาราง maintenance
    public function upload_announce_web()
    {
       $id    = $this->input->post('id'); // idของฐานข้อมูล
       $extension = pathinfo($_FILES['img_mainte']['name'], PATHINFO_EXTENSION); //ตัดชื่อไฟล์ออกเอาเฉพาะนามสกุล
       $newname   = 'announce_web'; //ชื่อไฟล์์ใหม่
       $result_file= $newname.'.'.$extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์
       //คำสั่งลบรูปเก๋า
       $query  = $this->db->select('*')->where('id', $id)->get('maintenance');
        foreach ($query->result() as $row) {
            $file_img = $row->name;
            $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/').'/'.$file_img;
            if (file_exists($path)) { //file_exists เป็นคำสั่งสำหรับค้นหาไฟล์
                //กรณีมีไฟล์อยู่ ทำการลบไฟล์แล้ว insertใหม่
                if (unlink($path)) {
                    $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/maintenance/');
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                            $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                            $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                            $config['file_name'] = $result_file ; // อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                            $this->upload->initialize($config);
                    if (!$this->upload->do_upload('img_mainte')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die();
                    } else {
                        $update = $this->db->set('name', $result_file)->where('id', $id)->update('maintenance');
                        $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                    }
                } else {
                    $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ไม่สามารถลบรูปได้ค่ะ สาเหตุมาจาก ไฟล์นั้นไม่มี หรือ ระบบเกิดผิดพลาด ค่ะ');
                }
            } else {
                // กรณีไม่มีไฟล์รูป ให้ทำการ insert ทันที
                $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/maintenance/');
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                $config['file_name'] = $result_file ; //อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('img_mainte')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die();
                } else {
                    $update = $this->db->set('name', $result_file)->where('id', $id)->update('maintenance');
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                }
            }
            echo json_encode($re);
            die();
        }
    }


    // function สำหรับอัพรูปภาพของ id 6 ในตาราง maintenance
    public function upload_announce_member()
    {
        $id    = $this->input->post('id'); // idของฐานข้อมูล
        $extension = pathinfo($_FILES['img_mainte2']['name'], PATHINFO_EXTENSION); //ตัดชื่อไฟล์ออกเอาเฉพาะนามสกุล
        $newname   = 'announce_member'; //ชื่อไฟล์์ใหม่
        $result_file= $newname.'.'.$extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์
        //คำสั่งลบรูปเก๋า

        $query  = $this->db->select('*')->where('id', $id)->get('maintenance');


        foreach ($query->result() as $row) {
            $file_img = $row->name;
            $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/').'/'.$file_img;

            if (file_exists($path)) {
                //กรณีมีไฟล์อยู่ ทำการลบไฟล์แล้ว insertใหม่
                if (unlink($path)) {
                    $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/maintenance/');
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                             $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                             $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                             $config['file_name'] = $result_file ; // อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                             $this->upload->initialize($config);
                    if (!$this->upload->do_upload('img_mainte2')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die();
                    } else {
                        $update = $this->db->set('name', $result_file)->where('id', $id)->update('maintenance');
                        $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                    }
                } else {
                    $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ไม่สามารถลบรูปได้ค่ะ สาเหตุมาจาก ไฟล์นั้นไม่มี หรือ ระบบเกิดผิดพลาด ค่ะ');
                }

                
            } else {
                // กรณีไม่มีไฟล์รูป ให้ทำการ insert ทันที
                $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/maintenance/');
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                 $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                 $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                 $config['file_name'] = $result_file ; //อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                 $this->upload->initialize($config);
                if (!$this->upload->do_upload('img_mainte2')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die();
                } else {
                    $update = $this->db->set('name', $result_file)->where('id', $id)->update('maintenance');
                    $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                }
            }
            echo json_encode($re);
            die();
        }
    }

    public function open_checkin()
    {
       $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function close_checkin()
    {
       
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function open_reward()
    {
      
       $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 1)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'เปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }

    public function close_reward()
    {
        
        $id = $this->input->post('id');
        if (isset($id)) {
            $query = $this->db->set('status', 0)->where('id', $id)->update('maintenance');
            if ($query) {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'ปิดการใช้งานเรียบร้อยแล้วค่ะ');
            } else {
                $re = array('msg' => 'เรียบร้อย' ,'code'=> 0 ,'title'=>'ไม่สามารถปิดการใช้งานได้ค่ะ');
            }
        } else {
            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ระบบเกิดข้อผิดพลาดกรุณากลับมาใหม่ค่ะ');
        }
        echo json_encode($re);
        die();
    }


    public function update_bank_setting(){


        $bank_id    = $this->input->post('bank_id'); // idของฐานข้อมูล
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
       
        $bnkS = $this->db->select('bank_short')->where('id', $bank_id)->get('tb_bank')->row();
        if($_FILES){
                $extension = pathinfo($_FILES['img_mainte3']['name'], PATHINFO_EXTENSION); //ตัดชื่อไฟล์ออกเอาเฉพาะนามสกุล
                $newname   = 'announce_bank_'.$bnkS->bank_short; //ชื่อไฟล์์ใหม่
                $result_file= $newname.'.'.$extension; //ต่อสตริง ชื่อไฟล์ + นามสกุลไฟล์
                //คำสั่งลบรูปเก่า

                $query  = $this->db->select('*')->where('bank_id', $bank_id)->get('tb_bank_maintenance');

                if($query->num_rows() == 1){
                    $file_query = $query->row();
                    $file_img = $file_query->img;

                    $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/bank_maintenance/').'/'.$file_img;

                    if (file_exists($path)) {
                        //กรณีมีไฟล์อยู่ ทำการลบไฟล์แล้ว insertใหม่
                        if (unlink($path)) {
                            $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/maintenance/bank_maintenance/');
                            $config['allowed_types']        = 'gif|jpg|png';
                            $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                                    $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                                    $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                                    $config['file_name'] = $result_file ; // อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                                    $this->upload->initialize($config);
                            if (!$this->upload->do_upload('img_mainte3')) {
                                $error = array('error' => $this->upload->display_errors());
                                print_r($error);
                                die();
                            } else {
                                $update = $this->db->set('img', $result_file)->set('start_time', $start_time)->set('end_time', $end_time)->where('bank_id', $bank_id)->update('tb_bank_maintenance');
                                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                            }
                        } else {
                            $re = array('msg' => 'error' ,'code'=> 0 ,'title'=>'ไม่สามารถลบรูปได้ค่ะ สาเหตุมาจาก ไฟล์นั้นไม่มี หรือ ระบบเกิดผิดพลาด ค่ะ');
                        }

                        
                    }else {
                        // กรณีไม่มีไฟล์รูป ให้ทำการ insert ทันที
                        $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/maintenance/bank_maintenance/');
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                        $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                        $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                        $config['file_name'] = $result_file ; //อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('img_mainte3')) {
                            $error = array('error' => $this->upload->display_errors());
                            print_r($error);
                            die();
                        } else {
                            $update = $this->db->set('img', $result_file)->where('bank_id', $bank_id)->update('tb_bank_maintenance');
                            $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                        }
                    }
                    echo json_encode($re);
                    die();

                }else{
                    
                        // กรณีไม่มีไฟล์รูป ให้ทำการ insert ทันที
                        $config['upload_path']          = realpath(APPPATH.'../public/tem_frontend/img/maintenance/bank_maintenance/');
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 0;  //หมายเหตุ 0 คือการไม่กำหนดขนาดไฟล์
                        $config['max_width']            = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดกว้าง
                        $config['max_height']           = 0; //หมายเหตุ 0 คือการไม่กำหนดขนาดสูง
                        $config['file_name'] = $result_file ; //อันนี้คือไฟล์ที่ถูกเปลี่ยนชื่อใหม่แล้ว
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('img_mainte3')) {
                            $error = array('error' => $this->upload->display_errors());
                            print_r($error);
                            die();
                        } else {
                            $new_alert = array(
                                'bank_id' => $bank_id,
                                'img' => $result_file,
                                'start_time' => $start_time,
                                'end_time' => $end_time,
                                'status' => 1
                            );
                            if($this->db->insert('tb_bank_maintenance', $new_alert)){
                                $re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
                            }
                            // $update = $this->db->set('img', $result_file)->where('bank_id', $bank_id)->update('tb_bank_maintenance');
                            
                        }
                    
                    echo json_encode($re);
                    die();
                }
            }else{

                $re = array('code'=> 3 ,'title'=>'error');
                echo json_encode($re);
                die();

            }
  
    }

    public function data_before(){
        $bank_id = $this->input->post('bank_id');
   
        $bank_before = $this->db->where('bank_id',$bank_id)->get('tb_bank_maintenance')->row();
        $re = array('code' => 1, 'data' => $bank_before);
        echo json_encode($re);
        die();
    }


   
}

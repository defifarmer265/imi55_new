<?php
class Custom_reply extends MY_Controller
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
		$data['Custom'] =  $this->db
			->select('tb_line_text.id as id,tb_line_text.message as message ,tb_line_text.reply as reply,tb_line_text.status as status')
			->order_by('id')
			->from('tb_line_text')
			->get()->result_array();
		// print_r($data['Custom']);
		// die;
		$data['Custom_quick'] =  $this->db
			->select('id,line_text_id,quick_reply,status')
			->get('tb_line_quick_text')->result_array();
		//   print_r($data['Custom_quick']);
		//   die;
			
		$this->load->view('custom_reply', $data);
    }
    public function enable(){
        if($id = $this->input->post('id')){
            $status = $this->input->post('status');
            if($status == 0){
            $data = array(
                'status'=>'1'
            );
            $this->db->where('tb_line_text.id',$id)->update('tb_line_text', $data);
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			}else{
				$data = array(
					'status'=>'0'
					
				);
				$this->db->where('tb_line_text.id',$id)->update('tb_line_text', $data);
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			}
		}else{
			$re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
        die();
	}
	public function enable_quick(){
		if($id = $this->input->post('id')){
            $status = $this->input->post('status');
            if($status == 0){
            $data = array(
                'status'=>'1'
            );
            $this->db->where('tb_line_quick_text.id',$id)->update('tb_line_quick_text', $data);
			$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			}else{
				$data = array(
					'status'=>'0'
					
				);
				$this->db->where('tb_line_quick_text.id',$id)->update('tb_line_quick_text', $data);
				$re = array('msg' => 'เรียบร้อย' ,'code'=> 1 ,'title'=>'สำเร็จ');
			}
		}else{
			$re = array('msg' => 'กรุณาทำรายการใหม่' ,'code'=> 0 ,'title'=>'ไม่สำเร็จ'); //Error
		}
		echo json_encode($re);
        die();
	}
    public function insert_cus()
	{
					$newdata = [];
					$data['name'] = $this->db->select('name')->get('tb_promotion')->result_array();
					foreach ($data as $key => $value) {
						for ($i = 0; $i < sizeof($value); $i++) {
							$d[$i] =   $value[$i]['name'];
						}
						array_push($newdata, $d);
					}
					if(in_array($this->input->post('message'),$newdata[0])){
						$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => ' Message นี้ไม่สามารถเพิ่มได้');
					}else{
							if ($this->input->post('message') && $this->input->post('reply')) {
								$message 		= $this->input->post('message');
								$reply 	= $this->input->post('reply');
								$id 	= $this->input->post('id'); 

										$arrCus = array(
											'message'=> $message ,
											'reply'	=> $reply ,
											'id'	=> $id , 
											'status'	=> 1
										);

									if($this->db->insert('tb_line_text', $arrCus)){
										$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');	
									}else{
										$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
									}
							} else {
								$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
							}
					}
				echo json_encode($re);
				die();
	}
	
	public function insert_quick_reply()
	{
							if ($this->input->post('message_id') && $this->input->post('quick')) {
								$message_id = $this->input->post('message_id');
								$quick 	= $this->input->post('quick');
								$id 	= $this->input->post('id'); 
                             
										$arrCus = array(
											'id'	=> $id , 
											'line_text_id'=> $message_id ,
											'type'	=> 'message',
											'quick_reply'	=> $quick ,
											'status'	=> 1
										);

									if($this->db->insert('tb_line_quick_text', $arrCus)){
										$re = array('code' => 1, 'msg' => '', 'title' => 'ทำรายการสำเร็จ');	
									}else{
										$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'บันทึกไม่สำเร็จ');
									}
							} else {
								$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ข้อมูลไม่ครบถ้วน');
							}
				echo json_encode($re);
				die();
	}
	public function select_quick(){
		$id = $this->input->post('dd');
		$quick = $this->db->select('id,line_text_id,quick_reply,status')
								->where('line_text_id=',$id)
								->get('tb_line_quick_text')	
								->result_array();
		$re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '3', 'data' => $quick);

		echo json_encode($re);
		die();
	}
    public function update_cus(){
					$newdata = [];
					$data['name'] = $this->db->select('name')->get('tb_promotion')->result_array();
					foreach ($data as $key => $value) {
						for ($i = 0; $i < sizeof($value); $i++) {
							$d[$i] =   $value[$i]['name'];
						}
						array_push($newdata, $d);
								}
					$id = $this->input->post('id');
					$message = $this->input->post('message');
					$reply = $this->input->post('reply');

								$arrCusupdate = array(
									'message' => $message ,
									'reply'	  => $reply 
								);

					if(in_array($this->input->post('message'),$newdata[0])){
						$re = array('code' => 0, 'msg' => 'กรุณาทำรายการใหม่', 'title' => 'ไม่สามารถเเก้ไขเป็น Message นี้ได้');
					}else{
							if($this->db->where('tb_line_text.id',$id)->update('tb_line_text', $arrCusupdate)){
								$re = array('code' => 1, 'msg' => '', 'title' => 'เเก้ไขเรียบร้อย');	
							}else{
								$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'เเก้ไขไม่สำเร็จ');
							}
						}
					echo json_encode($re);
					die();
	}
	public function update_quick(){
		$message_id 		= $this->input->post('message_id');
		$quick 	= $this->input->post('quick');
		$id 	= $this->input->post('id'); 
					$arrCusupdate = array(
						'line_text_id'=> $message_id ,
						'quick_reply'	=> $quick 
					);

	            if($this->db->where('tb_line_quick_text.id',$id)->update('tb_line_quick_text', $arrCusupdate)){
					$re = array('code' => 1, 'msg' => '', 'title' => 'เเก้ไขเรียบร้อย');	
				}else{
					$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'เเก้ไขไม่สำเร็จ');
				}
		echo json_encode($re);
		die();
}
    public function delete_cus(){
        $id = $this->input->post('id');
        if($id){
            if($this->db->where('tb_line_text.id',$id)->delete('tb_line_text')){
                $re = array('code' => 1, 'msg' => '', 'title' => 'ลบเรียบร้อย');	
            }else{
                $re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'ไม่สามารถลบได้');
            }
        }
        echo json_encode($re);
		die();
	}
	public function delete_quick(){
	$id = $this->input->post('id');
	if($id){
		if($this->db->where('tb_line_quick_text.id',$id)->delete('tb_line_quick_text')){
			$re = array('code' => 1, 'msg' => '', 'title' => 'ลบเรียบร้อย');	
		}else{
			$re = array('code' => 0, 'msg' => 'พบปัญหาการแก้ไขข้อมูล', 'title' => 'ไม่สามารถลบได้');
		}
	}
	echo json_encode($re);
	die();
	}
}

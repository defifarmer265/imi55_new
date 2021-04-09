<?php
class Group extends MY_Controller
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

	public function index()
	{
		$data['group'] = $this->db->order_by('status','DESC')->get('tb_group')->result_array();
		$data['group_dfus'] = $this->db->select('tb_user_group_default.*,tb_group.name')->join('tb_group','tb_group.id = tb_user_group_default.group_id','left')->where('tb_user_group_default.status',1)->get('tb_user_group_default')->result_array();
		$this->load->view('group',$data);
	}
	public function edit_default()
	{
		if($this->input->post('gp_type')){
			$gp_type = $this->input->post('gp_type');
			$group_r = $this->db->get('tb_group')->result_array();
	//		print_r($this->input->post());die();
			foreach($group_r as $gr){

				$chkGroup 		= $this->db->where('group_id',$gr['id'])->where('type',$gp_type)->get('tb_user_group_default');
				$bGroup_r		= $chkGroup->row();
				$arrbankGroup 	= array('type'=>$gp_type,'group_id'=>$gr['id'],'status'=>1);
				if(empty($this->input->post($gr['id']))){

					if($chkGroup->num_rows() != 0){

						$this->db->set('status',0)->where('id',$bGroup_r->id)->update('tb_user_group_default');
					}
				}else{
					if($chkGroup->num_rows() == 0){
						$this->db->insert('tb_user_group_default',$arrbankGroup);
					}else{
						$this->db->set('status',1)->where('id',$bGroup_r->id)->update('tb_user_group_default');
					}
				}

			}
			$re = array('code'=>1,'title'=>'สำเร็จ','msg'=>'');
		}else{
			$re = array('code'=>0,'title'=>'ไม่สำเร็จ','msg'=>'');
		}
		
		
		echo json_encode($re);
		die();
	}
	public function edit()
	{
//		echo '<pre>';
//		print_r($this->input->post());
		if($this->input->post('group_id') && $this->input->post('name') && $this->input->post('detail')){
			$arr = array(
				'name' => $this->input->post('name'),
				'detail' => $this->input->post('detail'),
				);
			if($this->db->where('id',$this->input->post('group_id'))->update('tb_group',$arr)){
				$re = array('code'=>1,'msg'=>'');
			}else{
				$re = array('code'=>0,'msg'=>'');
			}
			
		}else if($this->input->post('name') && $this->input->post('detail')){
			$arr2 = array(
				'name' => $this->input->post('name'),
				'detail' => $this->input->post('detail'),
				'status' => 1,
				);
			if($this->db->insert('tb_group',$arr2)){
				$re = array('code'=>1,'msg'=>'');
			}else{
				$re = array('code'=>0,'msg'=>'');
			}
		}else{
			$re = array('code'=>0,'msg'=>'');
		}
		echo json_encode($re);
		 die();
	}

	public function get_group()
	{
		if($this->input->post('group_id')){
			$data = $this->db->where('id',$this->input->post('group_id'))->get('tb_group')->row();
			$re = array('name'=>$data->name,'detail'=>$data->detail);
		}else{
			$re = array('name'=>'','detail'=>'');
		}
		echo json_encode($re);
		die();
	}
	public function get_gpdf()
	{
		if($this->input->post('type')){
			$data = $this->db->select('group_id')->where('type',$this->input->post('type'))->where('status',1)->get('tb_user_group_default')->result_array();
			$re = array('code'=>1,'data'=>$data);
		}else{
			$re = array('code'=>0,'data'=>'');
		}
		echo json_encode($re);
		die();
	}
	public function status()
	{
		if($this->input->post('group_id')){
			$group_r = $this->db->where('id',$this->input->post('group_id'))->get('tb_group')->row();
			if($group_r->status == 0){
				$status = 1;
			}else{
				$status = 0;
			}
			if($this->db->set('status',$status)->where('id',$this->input->post('group_id'))->update('tb_group')){
				$re = array('code'=>1,'msg'=>'');
			}else{
				$re = array('code'=>0,'msg'=>'');
			}
			
		}else{
			$re = array('code'=>0,'msg'=>'');
		}
		echo json_encode($re);
		die();
	}
}


<?php
class Otp extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->model('backend/getapi_model');
		$this->load->model('sale/sale_model');
		$this->load->library('Sale_libraray');
		$this->sale_libraray->login();
		$this->output->set_template('tem_sale/tem_sale');
		
	}
		public function index()
	{
		$data['otp'] = $this->db->select('tb_otp.*')->group_by('tb_otp.id')->order_by('tb_otp.id','DESC')->limit(100)->get('tb_otp')->result_array();
		$this->load->view('otp',$data);
	}
	public function confrim()
	{
		if($id = $this->input->post('id')){
			$otp_q = $this->db->select('id,tel,otp,ref')->where('id',$id)->get('tb_otp');
			if($otp_q->num_rows() == 1){
				$otp_r = $otp_q->row();
				print_r($otp_r);
				if($this->db->set('status',2)->where('id',$otp_r->id)->update('tb_otp')){
					$re = array('code'=>1,'msg'=>'','title'=>'');
					
					//save Log type Login
					$log_detail = '(otp),('.$this->session->sale->id.'),('.$this->session->sale->name.'),('.$otp_r->id.'/'.$otp_r->tel.'),';
					$log_type 	= 'otp';
					$this->sale_libraray->log_sale($log_type,$log_detail);
					
				}else{
					$re = array('code'=>0,'msg'=>'บันทึกข้อมูลไม่สำเร็จ','title'=>'ข้อมูลไม่ครบถ้วน');
				}
			}else{
				
			}
		}else{
			$re = array('code'=>0,'msg'=>'กรุณาทำรายการใหม่','title'=>'ข้อมูลไม่ครบถ้วน');
		}
//		echo json_encode($re);
		die();
	}
	public function sel_tel()
	{
		if($this->input->post('tel') != ''){
			$tel = $this->input->post('tel');
			$query  = $this->db->select('*')->where('tel',$tel)->get('tb_otp')->result_array();
			$k = 0 ;
			foreach($query as $row){
				$query[$k]['create_time'] = date('d-m-Y H:i:s',$row['create_time']);
				$k++;
			}
			$re = array('code'=>1,'title'=>'','msg'=>'','data'=>$query);
		}else{
			$re = array('code'=>0,'title'=>'','msg'=>'','data'=> '');
		}
	
		
		echo json_encode($re);
		die();

	}
}



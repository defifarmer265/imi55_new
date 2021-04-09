<?php
class Statement extends MY_Controller
{
	public function __construct()
	{

		parent::__construct();		
		$this->load->helper('url');
		$this->_init();
		$this->load->model('backend/getapi_model');

		

	}

	private function _init()
	{		
		$this->output->set_template('tem_sale/tem_sale');
	}
	
	public function index()
	{
		
    }
    
    public function statement(){

        $userid = $this->uri->segment(4);
        // $userid = 21;
        if(!empty($userid)){
            $user = $this->db->select('user')->where('id', $userid)->get('tb_user')->result_array();
            $u_state = $this->db->select('tb_bank.bank_short, tb_statement.datetime, tb_statement.deposit, tb_statement.withdraw, tb_statement.dateCreate, tb_user_bank.account')
                       ->join('tb_user_bank', 'tb_user_bank.user_id = tb_statement.user_id', 'left')
                       ->join('tb_bank', 'tb_bank.id = tb_statement.bank_id', 'left')
                       ->where('tb_statement.user_id', $userid)
                       ->order_by('datetime', 'ASC')
                       ->get('tb_statement')
                       ->result_array();
            
            $dt_state = array(
                'u_state' => $u_state,
                'user' => $user
            );

            $this->load->view('statement', $dt_state);
            
        }
        
    }



	



	// end create sale

}



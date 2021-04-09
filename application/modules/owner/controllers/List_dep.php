<?php
    class List_dep extends MY_Controller{
		public function __construct()
		{
			$this->load->helper('url');
			$this->load->model('backend/getapi_model');
			$this->load->model('backend/statement_model');
			$this->load->model('owner_model');
			$this->load->library('owner_libraray');
			$this->owner_libraray->login();
			$this->output->set_template('tem_owner/tem_owner');	
		}
        public function index(){
            $this->load->view('list_dep');
        }

        public function list_deposit()
        {
           
            
			$dt1 	= strtotime(date('Y-m-d 11:00:00',strtotime($this->input->post('dt1'))));
		    //$dt2 	= strtotime(date('d-m-Y 10:59:59',strtotime("+1 days".$this->input->post('dt2'))));
		
            $money = (float)$this->input->post('money');
            $ch    = (string)$this->input->post('ch');
            $n_st  = [];
            $st = $this->db->select('tb_statement.*')
                        ->where('tb_statement.deposit >', 0)
						->where('tb_statement.status',2)
						->where('tb_statement.dateCreate >=',$dt1)
						->where('tb_statement.dateCreate <=',strtotime(date('Y-m-d 10:59:59',strtotime($this->input->post('dt2')))))
                        ->order_by('dateCreate', 'DESC')
                        ->get('tb_statement')->result_array();
                        

            
            foreach($st as $key => $va){
                switch($ch){
                    case 0:
                        if((float)$va['deposit'] <= 299){
                            array_push($n_st,array(
                                "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                "deposit" => $va['deposit'],
                                "dateCreate" => $va['datetime']
                            ));
                        }
                    break;
                    case 1:
                        if((float)$va['deposit'] >= 300 && (float)$va['deposit'] <= 999){
                            array_push($n_st,array(
                                "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                "deposit" => $va['deposit'],
                                "dateCreate" => $va['datetime']
                            ));
                        }
                    break;
                    case 2 :
                        if((float)$va['deposit'] >= 1000 && (float)$va['deposit'] <= 4999){
                            array_push($n_st,array(
                                "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                "deposit" => $va['deposit'],
                                "dateCreate" => $va['datetime']
                            ));
                        }
                    break;
                    case 3 :
                        if((float)$va['deposit'] >= 5000 && (float)$va['deposit'] <= 9999){
                            array_push($n_st,array(
                                "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                "deposit" => $va['deposit'],
                                "dateCreate" => $va['datetime']
                            ));
                        }
                    break;

                    case 4 :
                        if((float)$va['deposit'] >= 10000 && (float)$va['deposit'] <= 49999){
                            array_push($n_st,array(
                                "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                "deposit" => $va['deposit'],
                                "dateCreate" => $va['datetime']
                            ));
                        }
                    break;
                    
                    case 5 :
                        if($va['deposit'] >= 50000 && (float)$va['deposit'] <= 99999){
                            array_push($n_st,array(
                                "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                "deposit" => $va['deposit'],
                                "dateCreate" => $va['datetime']
                            ));
                        }
                    break;

                    case 6 :
                        if((float)$va['deposit'] >= 100000 && (float)$va['deposit']<= 999999999){
                            array_push($n_st,array(
                                "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                "deposit" => $va['deposit'],
                                "dateCreate" => $va['datetime']
                            ));
                        }
                    break;

                }
                
              
            }
			$data['user'] = $n_st;
            $re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $data);
            echo json_encode($re);
            die();
        }

        public function list_withdraw(){
          
			
            $dt1 	= strtotime(date('Y-m-d 11:00:00',strtotime($this->input->post('dt1'))));
            //$dt2    = strtotime(date('Y-m-d 10:59:59',strtotime($this->input->post('dt2'))));

            $money = $this->input->post('money');
            $ch    = (string)$this->input->post('ch');
            $n_st = [];
            
            $st =  $this->db->select('tb_statement.*')
                    ->where('tb_statement.status', 2)
					->where('tb_statement.dateCreate >=',$dt1)
					->where('tb_statement.dateCreate <=',strtotime(date('Y-m-d 10:59:59',strtotime($this->input->post('dt2')))))
                    ->where('tb_statement.withdraw >', 0)
                    ->order_by('dateCreate', 'DESC')
                    ->get('tb_statement')->result_array();
                
                    foreach($st as $key => $va){
                        switch($ch){
                            case 0:
                                if((float)$va['withdraw'] <= 299){
                                    array_push($n_st,array(
                                        "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                        "withdraw" => $va['withdraw'],
                                        "dateCreate" => $va['datetime']
                                    ));
                                }
                            break;
                            case 1:
                                if((float)$va['withdraw'] >= 300 && (float)$va['withdraw'] <= 999){
                                    array_push($n_st,array(
                                        "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                        "withdraw" => $va['withdraw'],
                                        "dateCreate" => $va['dateCreate']
                                    ));
                                }
                            break;
                            case 2 :
                                if((float)$va['withdraw'] >= 1000 && (float)$va['withdraw'] <= 4999){
                                    array_push($n_st,array(
                                        "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                        "withdraw" => $va['withdraw'],
                                        "dateCreate" => $va['datetime']
                                    ));
                                }
                            break;
                            case 3 :
                                if((float)$va['withdraw'] >= 5000 && (float)$va['withdraw'] <= 9999){
                                    array_push($n_st,array(
                                        "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                        "withdraw" => $va['withdraw'],
                                        "dateCreate" => $va['datetime']
                                    ));
                                }
                            break;
        
                            case 4 :
                                if((float)$va['withdraw'] >= 10000 && (float)$va['withdraw'] <= 49999){
                                    array_push($n_st,array(
                                        "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                        "withdraw" => $va['withdraw'],
                                        "dateCreate" => $va['datetime']
                                    ));
                                }
                            break;
        
                            case 5 :
                                if((float)$va['withdraw'] >= 50000 && (float)$va['withdraw'] <= 99999){
                                    array_push($n_st,array(
                                        "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                        "withdraw" => $va['withdraw'],
                                        "dateCreate" => $va['datetime']
                                    ));
                                }
                            break;
        
                            case 6 :
                                if((float)$va['withdraw'] >= 100000 && (float)$va['withdraw']<= 99999999){
                                    array_push($n_st,array(
                                        "user"    => $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($va['user_id']))), -6),
                                        "withdraw" => $va['withdraw'],
                                        "dateCreate" => $va['datetime']
                                    ));
                                }
                            break;
        
                        }
                        
                      
                    }
            $data['user'] = $n_st;
            $re = array('code' => 1, 'title' => 'สำเร็จ', 'msg' => '5', 'data' => $data);
            echo json_encode($re);
            die();
        }

    }
?>
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Statement_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }
    

    public function getstatement($id){
        $q = $this->db
			->select('*')
			->where('bank_id',$id)
			->get('tb_statement');
		return $q->result_array();
    }

	 public function get_DW()
	{
		$DW = $this->db->select('tb_statement.deposit,tb_statement.withdraw,tb_statement.datetime,tb_user.username,tb_user.user')
			->where('tb_statement.status', 2)
			->join('tb_user', 'tb_user.id = tb_statement.user_id', 'left')
			->order_by('tb_statement.id', 'DESC')
			->limit(20)
			->get('tb_statement')
			->result_array();
			$k = 0;
			foreach ($DW as $dw) {

				if ($dw['deposit'] != 0) {
					$type = 'deposit';
					$amount = $dw['deposit'];
				} else {
					$type = 'withdraw';
					$amount = $dw['withdraw'];
				}
				$DW[$k]['username'] = $dw['username'];
				$DW[$k]['type'] 	= $type;
				$DW[$k]['amount'] 	= $amount;
				$DW[$k]['time'] 	= $dw['datetime'];
				$k++;
			}
			return $DW;

	}

}
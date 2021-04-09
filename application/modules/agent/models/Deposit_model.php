<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Deposit_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function insert_deposit($data)
	{
		if ( $this->db->insert('tb_deposit', $data) ){
			$id = $this->db->insert_id();
			$data['id'] = $id ;
			return array('msg' => 'success','code'=> 1 ,'data' => $data) ;
		}else{
			$error = $this->db->error(); 
			return  array('msg' => $error,'code'=> 0 ) ;
		}
	}

	public function get_status_deposit($id)
	{
		
		$q = $this->db
			->select('*')
			->where('id',$id)
			->get('tb_deposit');
		return $q->result_array();
	}
	public function get_depositByUserid($user_id){
		$q = $this->db
			->select('
			tb_deposit.*,
			tb_promotion.name as pro_name,tb_promotion.bonus,tb_promotion.turnSport,tb_promotion.turnCasino,tb_promotion.bonus_max,
			tb_bank.bank_short,tb_bank.bank_account'
					)
			->where('user_id',$user_id)
			->join('tb_promotion','tb_promotion.id = tb_deposit.promotion_id','left')
			->join('tb_bank','tb_bank.id = tb_deposit.inBank_id','left')
			->order_by("id", "DESC")
			->get('tb_deposit');
		return $q->result_array();
	}
	
}

<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function get_userbyTel($tel){
		$q = $this->db
					->select('*')
					->where('tel',$tel)
					->get('tb_user');
		return $q->result_array();
	}
	public function get_userbyName($name){
		$q = $this->db
					->select('*')
					->where('name',$name)
					->get('tb_user');
		return $q->result_array();
	}
	public function get_userbyId($id){
		$q = $this->db
					->select('*')
					->where('id',$id)
					->get('tb_user');
		return $q->result_array();
	}

	public function get_userByUsername($username){
		$q = $this->db
					->select('tb_user.*,tb_bank.bank_th,tb_bank.bank_short')
					->join('tb_bank', 'tb_bank.id = tb_user.bank')
					->where(array('tb_user.username' => $username ))
					->get('tb_user');
		return $q->row();
	}
	public function get_numbank($numbank){
		$q = $this->db
					->select('*')
					->where('account',$numbank)
					->get('tb_user');
		return $q->result_array();
	}
	public function update_UserById($id,$arrUpdate){
		$q = $this->db->where('id',$id)->update('tb_user',$arrUpdate); 
		if($q){
			return true;
		}else{
			return false;
		}
	}

	public function update_user_uname($id,$uname)
	{
		$q = $this->db->set('username', $uname, FALSE)
		->where('id', $id)
		->update('tb_user'); 
		if($q){
			return true;
		}else{
			return false;
		}
	}
	

	public function update_user_status($id,$status)
	{
		$q = $this->db->set('status', $status, FALSE)
		->where('id', $id)
		->update('tb_user'); 
		if($q){
			return true;
		}else{
			return false;
		}
	}


}

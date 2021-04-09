<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Bank_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function get_bank()
	{
		$q = $this->db
					->select('id,bank_en,bank_th,bank_short,bank_account')
					->get('tb_bank');
		return $q->result_array();
	}
	public function get_bank_id($id)
	{
		$q = $this->db
		->select('*')
		->where('id',$id)
		->get('tb_bank');
		return $q->result_array();
	}
	public function get_bank_agent(){
		$id = array('2','5'); //id = 2 ธนาคารกสิกรไทย(KBANK) // id = 5 ธนาคารไทยพาณิชย์(SCB)
		$q = $this->db
					->select('id,bank_en,bank_th,bank_short,bank_account')
					->where_in('id',$id)
					->get('tb_bank');
		return $q->result_array();
	}
	public function get_ref()
	{
		$q1 = $this->db
					->select('id,title,name,lastname,id_ref')
					->get('tb_ref');
		return $q1->result_array();
	}


}

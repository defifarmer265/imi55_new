<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Backend_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function get_user_all()
	{
		$q = $this->db
					->select('*')
					->get('tb_login');
		return $q->result_array();
	}

	public function save_newuser($data)
	{
		$q = $this->db->insert('tb_login', $data);
		if($q){
			return true;
		}else{
			return false;
		}
		
	}
	public function get_spin_edit($id)
		{
			$this->db->select('*');
			$this->db->from('tb_spin');
			$this->db->where('id',$id);
				$query = $this->db->get();
				return $query->result();
		}


		

  

}

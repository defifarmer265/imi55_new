<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Withdraw_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function insert_withdraw($data)
	{
		if ( $this->db->insert('tb_withdraw', $data) ){
			$id = $this->db->insert_id();
			$data['id'] = $id ;
			return array('msg' => 'success','code'=> 1 ,'data' => $data) ;
		}else{
			$error = $this->db->error(); 
			return  array('msg' => $error,'code'=> 0 ) ;
		}
	}
}
?>
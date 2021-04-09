<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Promotion_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	


	public function get_promoByClass($class){
		$q = $this->db
				->select('*')
				->where('class',$class)
				->where('date_start <=',time())
				->where('date_end >=',time())
				->get('tb_promotion');
		return $q->result_array();
	}



  
}

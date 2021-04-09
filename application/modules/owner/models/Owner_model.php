<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok'); 

class Owner_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

	}
	public function insert_log($ownerid,$type,$detail)
	{
		$detetime 	= time();
		$status		= 1;
		$arr_log 	= array(
							'owner_id' => $ownerid,
							'type' => $type,
							'detail' => $detail,
							'datetime' => $detetime,
							'status' => $status,
						);
		$this->db->insert('log_owner_login',$arr_log);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
}


<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok'); 

class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

	}
	public function SelectById($id)
	{
		$user_q = $this->db->select('
						tb_user.id,tb_user.username,tb_user.user,tb_user.point,tb_user.spin,tb_user.create_time,tb_user.status,
						tb_user_bank.bank_id,
						tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_bank.api_id,
					')
				->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
				->where('tb_user.id', $id)
				->get('tb_user');
		if($user_q->num_rows() == 1){
			$user_r = $user_q->row();
		}else{
			$user_r = '';
		}
		return $user_r;
	}
	public function SelectByUser($user)
	{
		$user_q = $this->db->select('
						tb_user.id,tb_user.username,tb_user.user,tb_user.point,tb_user.spin,tb_user.create_time,tb_user.status,
						tb_user_bank.bank_id,
						tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_bank.api_id,
					')
				->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
				->where('tb_user.user', $user)
				->get('tb_user');
		if($user_q->num_rows() == 1){
			$user_r = $user_q->row();
		}else{
			$user_r = '';
		}
		return $user_r;
	}
	public function SelectByTel($tel)
	{
		$user_q = $this->db->select('
						tb_user.id,tb_user.username,tb_user.user,tb_user.point,tb_user.spin,tb_user.create_time,tb_user.status,
						tb_user_bank.bank_id,
						tb_bank.bank_th,tb_bank.bank_short,tb_user_bank.account,tb_bank.api_id,
					')
				->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left')
				->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left')
				->where('tb_user.username', $tel)
				->get('tb_user');
		if($user_q->num_rows() == 1){
			$user_r = $user_q->row();
		}else{
			$user_r = '';
		}
		return $user_r;
	}
	
}


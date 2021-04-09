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
					->select('tb_user.*,tb_bank_user.bank_name,tb_bank_user.bank_short,tb_bank_user.account ')
					->join('tb_bank_user', 'tb_bank_user.user_id = tb_user.id')
					->where(array('tb_user.username' => $username ))
					->or_where('tb_user.user', $username)
					
					->get('tb_user');
		return $q->row();
	}
	public function get_userByProfile($username){
		$q = $this->db
					->select('tb_user.*,tb_bank_user.bank_name,tb_bank_user.bank_short,tb_bank_user.account ')
					->join('tb_bank_user', 'tb_bank_user.user_id = tb_user.id')
					->where(array('tb_user.user' => $username ))
					->get('tb_user');
		return $q->row();
	}

	public function get_tb_bank_user($username){
			$q = $this->db
			->select('tb_user.*,tb_bank_user.bank_name,tb_bank_user.bank_short,tb_bank_user.account,tb_bank_user.status ')
					->join('tb_bank_user', 'tb_bank_user.user_id = tb_user.id')
					->where(array('tb_user.user' => $username ))
					->get('tb_user');
		return $q->result_array();
		

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
// ============================= line db ========================================
		
	public function get_lineapi_userbyTel($tel){
		$q = $this->db
					->select('*')
					->where('phone',$tel)
					->get('tb_line_api');
		return $q->result_array();
	}
	public function get_lineapi_userbyUid($id){
		$q = $this->db
					->select('*')
					->where('userId',$id)
					->get('tb_line_api');
		return $q->result_array();
	}
	public function line_insert_tblineapi($data){

			if ( $this->db->insert('tb_line_api', $data) ){
				$id = $this->db->insert_id();
				$data['id'] = $id ;
				return array('msg' => 'success','code'=> 1 ,'data' => $data) ;
			}else{
				$error = $this->db->error(); 
				return  array('msg' => $error,'code'=> 0 ) ;
			}

	}
	public function update_line_api($id,$arrUpdate)
	{
		$q = $this->db->where('phone',$id)->update('tb_line_api',$arrUpdate); 
		if($q){
			return true;
		}else{
			return false;
		}
	}

	public function checkotp_line_api($uid,$otp,$time)
	{
		$q = $this->db
				->select('*')
				->where('userId',$uid)
				->where('otp',$otp)
				->get('tb_line_api');
				$res = $q->result_array();
				if(sizeof($res) > 0){	
					foreach($res as $key=>$r){
						$time1 =  $r['time_create_otp'];
					}		
					

					if( ( $time - $time1 ) <= 600){
						// update status ได้
						$this->db->set('status', 1)->where('userId', $uid)->update('tb_line_api');
						return (array('msg' => 'success','code'=> 1 )) ;
					}else{
						// ให้ส่ง otp ใหม่
						return (array('msg' => $time1,'code'=> 2 )) ;
					}
					
				}else{
					return (array('msg' => $uid."-".$otp."-".$time,'code'=> 0 )) ;
				}
	}




}

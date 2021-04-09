<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_promoAll()
	{
		$q = $this->db
		->select('*')
		->order_by('status','DESC')
		->where('date_start <',time())
		->where('date_end >',time())
		->get('tb_promotion');
		return $q->result_array();
		
	}
	
	public function get_promoById($id){
		$q = $this->db
					->select('*')
					->where('id',$id)
					->get('tb_promotion');
		return $q->row();
	}
	public function get_promoByClass($class){
		$q = $this->db
					->select('*')
					->where('class',$class)
					->get('tb_promotion');
		return $q->result_array();
	}
	public function get_promoByStatus($status){
		
		$q = $this->db
		->select('*')
		->where('status',$status)
		//->order_by('status','ACE')
		->get('tb_promotion');

		return $q->result_array();
	}
	public function insertArticle($data){
		
		if ( $this->db->insert('tb_article', $data) ){
			$id = $this->db->insert_id();
			$data['id'] = $id ;
			return array('msg' => 'success','code'=> 1 ,'data' => $data) ;
		}else{
			$error = $this->db->error(); 
			return  array('msg' => $error,'code'=> 0 ) ;
		}

	}
	public function editArticle($id,$editArticle){
		
		$this->db->where('id',$id);
		$this->db->update('tb_article',$editArticle);
		return true;

	}
			public function close_css($id,$close_css){
		
		$this->db->where('id',$id);
		$this->db->update('tb_article',$close_css);
		return true;

	}

			public function Drope_css($id){
		
		$this->db->where('id',$id);
		$this->db->delete('tb_article');
		return true;

	}
}

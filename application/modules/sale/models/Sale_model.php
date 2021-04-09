<?php

if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );
date_default_timezone_set( 'Asia/Bangkok' );

class Sale_model extends CI_Model {

	public function __construct() {
	parent::__construct();

	}
	public function SelectByUsername($username){
		$sale_q = $this->db->select('
						tb_sale.id,tb_sale.username,tb_sale.name,tb_sale.name,tb_sale.tel,tb_sale.token,tb_sale.last_login,tb_sale.lastip_login,tb_sale.status
					')
				->where('tb_sale.user', $username)
				->get('tb_sale');
		if($sale_q->num_rows() == 1){
			$sale_r = $sale_q->row();
		}else{
			$sale_r = '';
		}
		return $sale_r;
	}
	public function SelectById($id){
		$sale_q = $this->db->select('
						tb_sale.id,tb_sale.username,tb_sale.name,tb_sale.name,tb_sale.tel,tb_sale.token,tb_sale.last_login,tb_sale.lastip_login,tb_sale.status
					')
				->where('tb_sale.id', $id)
				->get('tb_sale');
		if($sale_q->num_rows() == 1){
			$sale_r = $sale_q->row();
		}else{
			$sale_r = '';
		}
		return $sale_r;
	}
}
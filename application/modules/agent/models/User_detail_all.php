<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_detail_all extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('backend/tripledes');
		// define("CASH_WEB", "betclic88");
		// define("CASH_DES_KEY", "cjT1mXvaIPBUI0o4l7B04dryQVE4akqn");
		// define("CASH_API_URL", "https://cashapiv2.sunmacau.com");
	}

	public function get_winlos()
	{
		$arrData = array( 
			'username'  	=> trim($_SESSION['username']), 
			'begin_date'    => '2019-08-01', 
			'end_date'   	=> '2019-08-29',
			'agent'         => 'bcli',
			'date'          => date('Y-m-d H:i:s')
		);

		$arrData    = json_encode($arrData);
		$dataInfo   = $this->tripledes->encryptText($arrData,CASH_DES_KEY);
		$dataInfo   = base64_encode($dataInfo);

		$param = http_build_query(array('data' => $dataInfo,'web'=>CASH_WEB,'random'=>mt_rand()));
		return json_decode($this->tripledes->cUrl(CASH_API_URL.'/winloss',"post",$param));
	}

	public function get_deposit()
	{
		
		$arrData = array( 
			'username'      => trim($_SESSION['username']), 
			'status'        => 'A', 
			'page'          => '1',
			'limit'         => '50',
			'agent'         => 'bcli', 
			'date'          => date('Y-m-d H:i:s')
		);

		$arrData    = json_encode($arrData);
		$dataInfo   = $this->tripledes->encryptText($arrData,CASH_DES_KEY);
		$dataInfo   = base64_encode($dataInfo);

		$param = http_build_query(array('data' => $dataInfo,'web'=>CASH_WEB,'random'=>mt_rand()));
		return json_decode($this->tripledes->cUrl(CASH_API_URL.'/deposit',"post",$param));

	} 
	public function withdrawal()
	{
		$arrData = array( 
			'username'      => trim($_SESSION['username']), 
			'status'        => 'A', 
			'page'          => '1',
			'limit'         => '50',
			'agent'         => 'bcli', 
			'date'          => date('Y-m-d H:i:s')
		);
		$arrData    = json_encode($arrData);
		$dataInfo   = $this->tripledes->encryptText($arrData,CASH_DES_KEY);
		$dataInfo   = base64_encode($dataInfo);

		$param = http_build_query(array('data' => $dataInfo,'web'=>CASH_WEB,'random'=>mt_rand()));
		return json_decode($this->tripledes->cUrl(CASH_API_URL.'/withdrawal',"post",$param));
	}
}
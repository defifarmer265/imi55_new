<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok'); 

class Users_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->library('users_library');

	}

	
	public function find_users_by_user($username)
	{
		$q = $this->db->where('username',$username)->get('tb_login');
		return $q->row();
	}

	public function update_last_login($id,$logtype)
	{
		

 
		$data = array(
			'last_login' => time(),
			'last_ip' => $this->input->ip_address()
		);
		$this->db->where('id',$id);
		return $this->db->update('tb_login', $data);
	 
	}
	public function get_spin(){
		$this->db->select('*');
	   $this->db->from('user');
		   $query = $this->db->get();
		   return $query->result();
   }
   
	public function can_login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('tb_login');
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				if($row->username == $username)
				{

					$start_date = Date('Y-m-d');
                    $end_date = Date('Y-m-d 23:59:59');

                   $id = $this->session->member->id;

                    $this->db->where("DATE(FROM_UNIXTIME(timeni))",$start_date);
                    
                     $this->db->where('id_user', $id);
                    $qr = $this->db->get('user');
                    $numrow = $qr->num_rows();
                    
                    if($numrow<=0){

                        $this->db->set('spin','spin+1',FALSE);
                        $this->db->where('id_user', $id);                
                        $this->db->update('user');
                        

                         $data2 = array(
						        'timeni' => date('Y-m-d'),
						          
						        );
						         $this->db->where('id_user',$id);

						       $update_timeni = $this->db->update('user', $data2);

						        $this->session->set_flashdata('logindairy','logindairy');

                   
                    }
                  
					$password = $this->users_library->hash_password($password,$row->salt);
					$store_password = $row->password;
					//die();
					if($password == $store_password)
					{
						$this->session->set_userdata('id', $row->id);
						$this->session->set_userdata('username', $row->username);
						$this->session->set_userdata('agent', $row->agent);
						$this->session->set_userdata('name', $row->name);
						$this->session->set_userdata('sername', $row->sername);
						$this->session->set_userdata('tel', $row->tel);
						$this->session->set_userdata('parent', $row->parent);
						$this->session->set_userdata('type', $row->type);
						

					}
					else
					{

						return 'รหัสผ่านไม่ถูกต้อง';
					}
				}
				else
				{
					return 'ชื่อผู้ใช้ไม่ถูกต้อง';
				}
			}
		}
		else
		{
			return 'Wrong username or password';
		}
	}
	public function insert_log($arr)
	{
		$this->db->insert('log_login',$arr);
	}
	
}


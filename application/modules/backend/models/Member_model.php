<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Member_model extends CI_Model
 {
    var $table = "tb_user";
    var $select_column = array("id","username","user","name","comefrom","create_time");
    var $order_column  = array("id","username","user","name","comefrom","create_time");
    
    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
       
       
        if(isset($_POST['search']['value'])){
            $this->db->like('user',$_POST['search']['value']);
            $this->db->or_like('username',$_POST['search']['value']);
            $this->db->or_like('create_time',strtotime($_POST['search']['value']));
        }
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by('id','DESC');
        }
    }

    function make_datatables(){
        $this->make_query();
        if($_POST['length']!= -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query =$this->db->get();
        return $query->result();
    }

    function get_filtered_data(){
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 }
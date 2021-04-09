<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Gift_model extends CI_Model
 {
    var $table = "log_gift_voucher";
    var $select_column = array("id","gift_id","user_id","time_give","admin","receive","time_receive");
    var $order_column  = array(null,null,"user_id",null,null,null,null);
    
    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
      
        if(isset($_POST['search']['value']))
        {
            $this->db->like('user_id',$_POST['search']['value']);
        }
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by('time_receive','DESC');
        }
    }

    function make_datatables($id){
        $this->make_query();
        if($_POST["length"]!= -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->where('gift_id',$id);
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
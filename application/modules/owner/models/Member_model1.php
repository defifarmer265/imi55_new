<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Memberall_model extends CI_Model
 {
     //ตัวอย่างการ join
    var $table = "tb_user";
    var $table1 = "tb_user_bank";
    var $table2 = "tb_bank";
    var $select_column  = array(
        "tb_user.id","tb_user.username","tb_user.user","tb_user.name",
        "tb_user.create_time","tb_bank.bank_short"
        ,"tb_user_bank.account","tb_user_bank.user_id","tb_bank.id"
    );
     var $order_column  = array(null,'create_time',null,null,null,null,null);
    function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->join('tb_user_bank', 'tb_user_bank.user_id = tb_user.id', 'left');
        $this->db->join('tb_bank', 'tb_bank.id = tb_user_bank.bank_id', 'left');

        if(isset($_POST['search']['value'])){
            $this->db->like('user',$_POST['search']['value']);
            $this->db->or_like('username',$_POST['search']['value']);
        }
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by('create_time','DESC');
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
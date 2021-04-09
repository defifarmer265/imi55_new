<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sum_state extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function sum_data_state()
    {
//
//        $d =  strtotime(date('Y-m-d') . "-90 days");
//
//        // ==============================   รวมผลตาราง  tb_statement =========================
//        $q = $this->db->select('
//                                   bank_id, 
//                                   sum(deposit)AS s_depo,
//                                   sum(withdraw)AS s_wit,
//                                   sum(fee)AS s_fee
//                                   ')
//            ->where_in('status', '2,3')
//            ->where('dateCreate <', $d)
//            ->group_by('bank_id')
//            ->get('tb_statement')
//            ->result_array();
//        // echo "<pre>";
//        // print_r($q );
//        if (sizeof($q) != 0) {
//            for ($i = 0; $i < sizeof($q); $i++) {
//                $data = array(
//                    'bank_id	' => $q[$i]['bank_id'],
//                    'datetime' => $d,
//                    'deposit' => $q[$i]['s_depo'],
//                    'withdraw' => $q[$i]['s_wit'],
//                    'fee' => $q[$i]['s_fee'],
//                    'note' => 'ตัดยอด',
//                    'dateCreate' => $d,
//                    'from_name' => '',
//                    'from_account	' => '',
//                    'from_bank' => '',
//                    'user_id' => 0,
//                    'deposit_id' => 0,
//                    'withdraw_id' => 0,
//                    'admin_id' => 0,
//                    'status' => 3,
//                );
//                $this->db->insert('tb_statement', $data);
//            }
//        }
//
//
//        // ==============================   ลบ ข้อมูล ที่ตาราง tb_statement และ tb_withdraw =========================
//        $get_id = $this->db->select('
//                                    id,
//                                    deposit_id,
//                                    withdraw_id')
//            ->where_in('status', '2,3')
//            ->where('dateCreate <', $d)
//            ->get('tb_statement')
//            ->result_array();
//        if (sizeof($get_id) != 0) {
//            for ($i = 0; $i < sizeof($get_id); $i++) {
//                if ($get_id[$i]['id'] != 0 || $get_id[$i]['id'] != '') {
//                    $this->db->where('id', $get_id[$i]['id'])->delete('tb_statement');
//                }
//                if ($get_id[$i]['deposit_id'] != 0 || $get_id[$i]['deposit_id'] != '') {
//                    $this->db->where('id', $get_id[$i]['deposit_id'])->delete('transactionauto');
//                }
//                if ($get_id[$i]['withdraw_id'] != 0 || $get_id[$i]['withdraw_id'] != '') {
//                    $this->db->where('id', $get_id[$i]['withdraw_id'])->delete('tb_withdraw');
//                }
//            }
//        }
    }
}

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_table_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
        $this->load->dbforge();
	}

    public function tb_setting_exchange()
    {
            
            $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'auto' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'comment' => '0 ไม่ 1 อัตโนมัติ',
                    
                    
                ),
                'turn' => array(
                   'type' => 'INT',
                    'constraint' => 1,
                    'comment' => '0 ไม่ติด 1 ติด',
                    
                ),
                'turn_num' => array(
                    'type' => 'double',
                    'constraint' => '4,2',
                    'comment' => 'จำนวนเท่า',
                    
                ),
                'status' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'comment' => '0 ปิด 1 เปิด',
                    
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('setting_exchange');
            $array_exr = array('id'=>1,'auto'=>0,'turn'=>1,'turn_num'=>1,'status'=>1);
            $this->db->insert('setting_exchange',$array_exr);
        
        return(1);
        
    }
    public function tb_log_addcredit()
    {
        $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'int',
                    'constraint' => 1,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'time' => array(
                    'type' => 'varchar',
                    'constraint' => 11,
                    'comment' => 'เวลาระบบทำรายการ',
                    
                    
                ),
                'note' => array(
                   'type' => 'text',
                    'constraint' => 200,
                    'comment' => 'รายละเอียด',
                    
                ),
                'status' => array(
                    'type' => 'int',
                    'constraint' => 1,
                    'comment' => '0 ปิด 1 เปิด',
                    
                ),
                
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('log_addcredit');
        return(1);
    }
    public function tb_tb_turnover()
    {
        $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'int',
                    'constraint' => 6,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'user_id' => array(
                    'type' => 'varchar',
                    'constraint' => 25,    
                ),
                'promotion_id' => array(
                   'type' => 'int',
                    'constraint' => 3,
                    'comment' => '0 : ไม่มีโปรโมชั่น',
                ),
                'code_id' => array(
                    'type' => 'int',
                    'constraint' => 3,
                    'comment' => '0:ยังไม่รับ',
                    
                ),
                'sport' => array(
                    'type' => 'varchar',
                    'constraint' => 10,  
                ),
                'casino' => array(
                    'type' => 'varchar',
                    'constraint' => 10,
                    
                ),
                'game' => array(
                    'type' => 'varchar',
                    'constraint' => 10,
                    
                ),
                'checkturn' => array(
                    'type' => 'varchar',
                    'constraint' => 10,
                    
                ),
                'check_time' => array(
                    'type' => 'varchar',
                    'constraint' => 12,
                    
                ),
                'status' => array(
                    'type' => 'int',
                    'constraint' => 1,
                    
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tb_turnover');
        return(1);

    }

    public function tb_tb_turn()
    {
        $this->dbforge->add_field(array(
                'id' => array(
                    'type' => 'int',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'comm' => array(
                    'type' => 'int',
                    'constraint' => 10,    
                ),
                'win' => array(
                   'type' => 'int',
                    'constraint' => 10,
                ),
                'total' => array(
                    'type' => 'int',
                    'constraint' => 10,
                    
                ),
                'player_id' => array(
                    'type' => 'int',
                    'constraint' => 10,  
                ),
                'member_id' => array(
                    'type' => 'int',
                    'constraint' => 10,
                    
                ),
                'username' => array(
                    'type' => 'varchar',
                    'constraint' => 30,
                    
                ),
                'sale' => array(
                    'type' => 'varchar',
                    'constraint' => 25,
                    
                ),
                'user_sale' => array(
                    'type' => 'varchar',
                    'constraint' => 15,
                    
                ),
                'turnover' => array(
                    'type' => 'double',
                    'constraint' => '10,2',
                    
                ),
                'grosscomm' => array(
                    'type' => 'int',
                    'constraint' => 10,
                    
                ),
                'payout' => array(
                    'type' => 'double',
                    'constraint' => '10,2',
                    
                ),
                'valid_amount' => array(
                    'type' => 'double',
                    'constraint' => '10,2',
                    
                ),
                'company' => array(
                    'type' => 'double',
                    'constraint' => '10,2',
                    
                ),
                'role' => array(
                    'type' => 'double',
                    'constraint' => '10,2',
                    
                ),
                'loyalty' => array(
                    'type' => 'int',
                    'constraint' => 10,
                    
                ),
                'created_time' => array(
                    'type' => 'varchar',
                    'constraint' => 12,
                    
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('tb_turn');
        return(1);

    }

    public function field_tb_sale_user()
    {
        $fields = array(
            'sale' => array(
                'type' => 'varchar',
                'constraint' => 30
            ),
            'username' => array(
                'type' => 'varchar',
                'constraint' => 15
            )
        );
        $this->dbforge->add_column('tb_sale_user', $fields);
        return(1);

    }

    public function field_tb_user_sale()
    {
        $fields = array(
            'sale_username' => array(
                'type' => 'varchar',
                'constraint' => 17
            ),
            'user_username' => array(
                'type' => 'varchar',
                'constraint' => 17
            )
        );
        $this->dbforge->add_column('tb_user_sale', $fields);
        return(1);

    }

    
}

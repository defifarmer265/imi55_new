<?php

/**
 *
 */
class Check_table
{

	public $CI;
	public $arraytable;
	public $myforge;
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->arraytable = [
			'acc_account',
			'admin_linebroadcast',
			'annonce1',
			'line_account',
			'log_add_turn',
			'log_admin',
			'log_bank',
			'log_bank_edit_group',
			'log_bank_status',
			'log_broadcast',
			'log_cal_affiliate',
			'log_checkin',
			'log_credit',
			'log_edit_user_group',
			'log_edit_user_name',
			'log_edit_user_pass',
			'log_edit_user_point',
			'log_edit_user_spin',
			'log_edit_user_status',
			'log_edit_user_turn',
			'log_edit_user_username',
			'log_event',
			'log_event_create',
			'log_gift_voucher',
			'log_turn_to_point',
			'log_imimall',
			'log_line',
			'log_login',
			'log_maintenant',
			'log_owner_login',
			'log_pass',
			'log_poin_and_spin',
			'log_promotion',
			'log_reset_turn',
			'log_safecode',
			'log_sale',
			'log_user_login',
			'maintenance',
			'product',
			'promotion',
			'rebank',
			'reward',
			'setting',
			'setting_telegram',
			'set_deposit_turnover',
			'slide_image',
			'sms_otp',
			'sms_otp2',
			'tb_admin',
			'tb_admin_class',
			'tb_admin_rounds',
			'tb_affiliate_setting',
			'tb_alert',
			'tb_announce',
			'tb_article',
			'tb_bank',
			'tb_bank_group',
			'tb_bank_maintenance',
			'tb_bank_web',
			'tb_cal_agent',
			'tb_checkin',
			'tb_class_admin',
			'tb_css',
			'tb_even',
			'tb_event',
			'tb_exchange',
			'tb_gift',
			'tb_group',
			'tb_line',
			'tb_linenotify',
			'tb_line_quick_text',
			'tb_line_text',
			'tb_login',
			'tb_manual',
			'tb_option_report',
			'tb_otp',
			'tb_owner',
			'tb_point',
			'tb_promotion',
			'tb_rank',
			'tb_report',
			'tb_report_winlos',
			'tb_sale',
			'tb_sale_setting',
			'tb_sale_user',
			'tb_service_charge',
			'tb_spin',
			'tb_spin_reward',
			'tb_spin_store',
			'tb_statement',
			'tb_truew',
			'tb_turn',
			'tb_turnover',
			'tb_tutorial',
			'tb_user',
			'tb_user_bank',
			'tb_user_group',
			'tb_user_group_default',
			'tb_user_rank',
			'tb_user_sale',
			'tb_user_sale_credit',
			'tb_vendor',
			'tb_withdraw',
			'tb_withdraw_limit',
			'tb_withdraw_min',
			'test',
			'transactionauto',
			'transactionauto_test',

		];
		$this->myforge = $this->CI->load->dbforge();
	}


	public function checkTB()
	{
		foreach ($this->arraytable as $value) {

			if ($this->CI->db->table_exists($value) != 1) {

				switch ($value) {

					case 'acc_account':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'username' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'password' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'bank_short' => [
								'type' => 'varchar',
								'constraint' => 15, 'COMMENT' => 'SCB/KBANK/BAY',
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => 'bank web',
							],
							'type' => [
								'type' => 'varchar',
								'constraint' => 1, 'COMMENT' => '1 = dp , 2 = wd',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'admin_linebroadcast':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'username' => [
								'type' => 'varchar',
								'constraint' => 30,
								'null' => false,
							],

							'password' => [
								'type' => 'varchar',
								'constraint' => 30,
								'null' => false,
							],

							'createtime' => [
								'type' => 'varchar',
								'constraint' => 10,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'line_account':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 30,
								'null' => false,
							],

							'token' => [
								'type' => 'text',
								'null' => false,
							],

							'api_path' => [
								'type' => 'text',
								'null' => false,
							],

							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_bank':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 2,
								'null' => false,
							],

							'action' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'admin_id' => [
								'type' => 'int',
								'constraint' => 5,
								'null' => false,
							],

							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_bank_edit_group':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'account' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 255,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_bank_status':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'account' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_broadcast':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'message' => [
								'type' => 'text',
								'constraint' => 20,
								'null' => false,
							],
							'group_user' => [
								'type' => 'varchar',
								'constraint' => 10,
								'null' => false,
							],
							'createtime' => [
								'type' => 'varchar',
								'constraint' => 15,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_turn_to_point':	
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'log_turn_point' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],
							'createtime' => [
								'type' => 'varchar',
								'constraint' => 15,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_cal_affiliate':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user_id' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
							],
							'aff_turn' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],

							'date_to' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],

							'date_from' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],

							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_checkin':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user_id' => [
								'type' => 'varchar',
								'constraint' => 30,
								'null' => false,
							],

							'detail' => [
								'type' => 'text',
								'null' => false,
							],

							'create_time' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_credit':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'user_id' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
							],

							'admin_id' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
								'comment' => '0 = aff'
							],

							'type' => [
								'type' => 'int',
								'null' => false,
								'comment' => '1 in 2 out'
							],

							'amount' => [
								'type' => 'double',
								'constraint' => [10, 2],
								'null' => false,
								'comment' => 'ยอดเงินที่ทำ'
							],

							'credit_last' => [
								'type' => 'double',
								'constraint' => [10, 2],
								'null' => false,
								'comment' => 'เครดินก่อนทำการ in out'
							],

							'credit_result' => [
								'type' => 'double',
								'constraint' => [10, 2],
								'null' => false,
								'comment' => 'เครดิตเมื่อปรับ'
							],

							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],

							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '0 close 1 active'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_group':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 255,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_name':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_pass':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_point':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'action' => [
								'type' => 'varchar',
								'constraint' => 5,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_spin':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'action' => [
								'type' => 'varchar',
								'constraint' => 5,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_status':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_turn':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'action' => [
								'type' => 'varchar',
								'constraint' => 10,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_edit_user_username':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_event':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'user_id' => [
								'type' => 'int',
								'constraint' => 6,
								'null' => false,
							],

							'event_id' => [
								'type' => 'int',
								'constraint' => 6,
								'null' => false,
							],

							'before_creadit' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
								'comment' => 'เครดิตก่อนรับ'
							],

							'after_creadit' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
								'comment' => 'เครดิตหลังรับ'
							],

							'before_point' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
								'comment' => 'พ้อยก่อนรับ'
							],

							'after_point' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
								'comment' => 'พ้อยลังรับ'
							],

							'time' => [
								'type' => 'int',
								'constraint' => 25,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_event_create':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'event_name' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_gift_voucher':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'gift_id' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
							],

							'user_id' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
							],

							'time_give' => [
								'type' => 'int',
								'constraint' => 25,
								'null' => false,
								'comment' => 'เวลาแอดมินแจก'
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 25,
								'null' => false,
							],

							'receive' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '0:ลูกค้าไม่กดรับ 1:ลูกค้ากดรับ'
							],

							'time_receive' => [
								'type' => 'int',
								'constraint' => 25,
								'null' => false,
								'comment' => 'เวลา user รับ'
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_imimall':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'pd_name' => [
								'type' => 'varchar',
								'constraint' => 100,
								'null' => false,
							],

							'action' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '1 comfirm 2 cancel'
							],

							'datetime' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_line':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'username' => [
								'type' => 'varchar',
								'constraint' => 11,
								'null' => true,
							],

							'line_id' => [
								'type' => 'varchar',
								'constraint' => 50,
								'null' => false,
							],

							'actionType' => [
								'type' => 'varchar',
								'constraint' => 50,
								'null' => false,
							],

							'payload' => [
								'type' => 'text',
								'null' => true,
							],

							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_login':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin_id' => [
								'type' => 'int',
								'constraint' => 5,
								'null' => true,
							],

							'time_login' => [
								'type' => 'varchar',
								'constraint' => 15,
								'null' => false,
							],

							'time_logout' => [
								'type' => 'varchar',
								'constraint' => 15,
								'null' => false,
							],

							'ip_login' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_maintenant':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin_id' => [
								'type' => 'varchar',
								'constraint' => 5,
								'null' => true,
							],

							'admin_name' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => true,
							],

							'type_detail' => [
								'type' => 'varchar',
								'constraint' => 30,
								'null' => false,
							],

							'status' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_owner_login':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'owner_id' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'ip' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
								'comment' => 'ip ที่ใช้งาน'
							],

							'action' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '1:login 2:logout'
							],

							'datetime' => [
								'type' => 'varchar',
								'constraint' => 15,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_pass':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'ref_userid' => [
								'type' => 'varchar',
								'constraint' => 255,
								'null' => false,
								'comment' => 'รหัสยูสที่เปลี่ยน'

							],

							'ip' => [
								'type' => 'varchar',
								'constraint' => 255,
								'null' => false,
							],

							'name' => [
								'type' => 'varchar',
								'constraint' => 255,
								'null' => false,
								'comment' => 'ชื่อผู้เปลี่ยน'
							],

							'create_time' => [
								'type' => 'varchar',
								'constraint' => 255,
								'null' => false,
								'comment' => 'วันที่เปลี่ยน'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_poin_and_spin':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'user_id' => [
								'type' => 'int',
								'constraint' => 15,
								'null' => false,
							],

							'admin_id' => [
								'type' => 'int',
								'constraint' => 15,
								'null' => false,
							],

							'type' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '0 เพิ่มคะแนน 1 ลดคะแนน 3เพิ่มสปริน 4ลดสริป'
							],

							'add_' => [
								'type' => 'varchar',
								'constraint' => 10,
								'null' => false,
								'comment' => 'เพิ่ม'
							],

							'reduce' => [
								'type' => 'varchar',
								'constraint' => 10,
								'null' => false,
								'comment' => 'ลบ'
							],

							'point_last' => [
								'type' => 'varchar',
								'constraint' => 10,
								'null' => false,
								'comment' => 'ก่อนเพิ่ม'
							],

							'point_result' => [
								'type' => 'varchar',
								'constraint' => 15,
								'null' => false,
								'comment' => 'หลังเพิ่ม'
							],

							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],

							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '0ปิด1เปิด'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_promotion':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'user_id' => [
								'type' => 'int',
								'constraint' => 15,
								'null' => false,
							],

							'promotion_id' => [
								'type' => 'int',
								'constraint' => 5,
								'null' => false,
							],

							'before_creadit' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => 'เครดิตก่อนรับโปรโมชั่น'
							],

							'after_creadit' => [
								'type' => 'varchar',
								'constraint' => 10,
								'null' => false,
								'comment' => 'เครดิตหลังรับโปรโมชั่น'
							],

							'time' => [
								'type' => 'int',
								'constraint' => 20,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_reset_turn':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 25,
								'null' => false,
							],

							'admin_id' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
							],

							'before_reset' => [
								'type' => 'decimal',
								'constraint' => [10, 2],
								'null' => false,
							],

							'time_reset' => [
								'type' => 'int',
								'constraint' => 15,
								'null' => false,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_safecode':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'admin_id' => [
								'type' => 'int',
								'constraint' => 10,
								'null' => false,
							],

							'data_log' => [
								'type' => 'text',
								'null' => false,
							],

							'time_log' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_sale':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'sale_id' => [
								'type' => 'int',
								'constraint' => 5,
								'null' => false,
							],

							'type' => [
								'type' => 'varchar',
								'constraint' => 20,
								'null' => false,
							],

							'detail' => [
								'type' => 'text',
								'null' => false,
							],


							'datetime' => [
								'type' => 'varchar',
								'constraint' => 15,
								'null' => false,
							],


							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '0close 1open'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'log_user_login':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'user_id' => [
								'type' => 'varchar',
								'constraint' => 25,
								'null' => false,
							],

							'action' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '1:login  2:logout'

							],

							'ip' => [
								'type' => 'varchar',
								'constraint' => 30,
								'null' => false,
							],

							'platform' => [
								'type' => 'int',
								'constraint' => 1,
								'null' => false,
								'comment' => '1:Iphone 2:Ipad 3:webOS 4:Android 5:PC'
							],


							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
								'null' => false,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'maintenance':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'detail' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'COMMENT' => '0 ปิด 1 เปิด'
							]
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO maintenance (id, name, detail, status) VALUES
						(1, 'auto_deposit', 'ระบบแอดเครดิต', 1),
						(2, 'auto_bank', 'ระบบแบงค์ทั้งหมด', 1),
						(3, 'member', 'ระบบลูกค้า', 1),
						(4, 'webmain', 'หน้าเว็บหลัก', 0),
						(5, 'announce_web.png', 'ประกาศหน้าเว็บ ขนาด 1024x1024', 0),
						(6, 'announce_member.png', 'ประกาศหน้าลูกค้า ขนาด 1024x1024', 0),
						(7, 'bank_maintenance', 'ประกาศธนาคารปิดปรับปรุง', 0),
						(8, 'checkin', 'ระบบเช็คอิน', 1),
						(9, 'reward', 'ระบบแลกเครดิต', 1);");
						break;
					case 'product':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'title' => [
								'type' => 'varchar',
								'constraint' => 200,
								'comment' => 'ข้อความ'
							],
							'product_img' => [
								'type' => 'varchar',
								'constraint' => 200,
								'comment' => 'รูปภาพ'
							],
							'username' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'password' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'link' => [
								'type' => 'text',
							],
							'create_at' => [
								'type' => 'datetime',
								'COMMENT' => 'วันที่สร้าง'
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'promotion':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'title' => [
								'type' => 'varchar',
								'constraint' => 200,
								'comment' => 'ข้อความ'
							],
							'promotion_img' => [
								'type' => 'varchar',
								'constraint' => 200,
								'comment' => 'รูปภาพ'
							],
							'create_at' => [
								'type' => 'datetime',
								'COMMENT' => 'วันที่สร้าง'
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'rebank':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'bank' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'datereset' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'reward':
						$fields = [
							'id_reward' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'prize' => [
								'type' => 'text',
							],
							'reward' => [
								'type' => 'int',
								'constraint' => 11,
							],
							'type' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'img' => [
								'type' => 'text',
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1,
							],

						];
						$this->createTb($fields, $value, 'id_reward');
						$this->CI->db->query("INSERT INTO reward (id_reward, prize, reward, type, img, status) VALUES
						(27, '1000', 10, 'credit', 'bb3bcef8146a6ccb6422bd5986253894.png', 1),
						(28, '2000', 20, 'credit', '5639f5b9a2b0b4301fa330f7e4f9cfc9.png', 1),
						(29, '5000', 50, 'credit', '0ef7171d97c8adf876f4fdcb8731e06d.png', 1),
						(30, '10000', 100, 'credit', '2fb6f8d787d6a9ad1802dd8f9983d9c4.png', 1),
						(32, '50000', 500, 'credit', 'fd77f89bdbeca416374e02b981ce8086.png', 1),
						(33, '100000', 1000, 'credit', 'dc2f54cb43e19abafbba1c1d0bf8f655.png', 1),
						(34, '5000000', 50000, 'credit', '16a46ae1c7e1693eda4f80f49337e4d0.png', 1),
						(35, '100', 1, 'credit', 'aea6291f764915bee19119ddc3198c74.png', 1),
						(36, '1000000', 10000, 'credit', '8c5321e99c2d444cda17a3c8ee4de834.png', 1);");
						break;









					case 'tb_owner':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'username' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'password' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'name' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'tel' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'last_login' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'lastip_login' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							],

							'class' => [
								'type' => 'INT',
								'constraint' => 11,
								'comment' => '0 เข้าได้ทุกเมนู 1 เข้าได้ทุกเมนุยกเว้น sevice 2 เข้าได้ทุกเมนูยกเว้นเพิ่มสมาชิก'
							],

							'token_login' => [
								'type' => 'varchar',
								'constraint' => 255,
							],
							'two_factor' => [
								'type' => 'json',
							]

						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_owner (id, username, password, name, tel, last_login, lastip_login, status, class, token_login) VALUES
						(1, 'imi', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'imiowner', '', '1615279793', '192.168.40.227', 1, 0, '3b32535d0a4d51847d08dc6506b72c03','{\"key\":\"\",\"linkQr\":\"\",\"status\":\"off\"}');");
						break;
					case 'tb_point':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,	'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'type' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'point' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'reward_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_promotion':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'casino' => [
								'type' => 'varchar',
								'constraint' => 10,
							],

							'sport' => [
								'type' => 'varchar',
								'constraint' => 10,
							],

							'game' => [
								'type' => 'varchar',
								'constraint' => 10,
							],

							'sum_turn' => [
								'type' => 'varchar',
								'constraint' => 15, 'COMMENT' => 'เทิร์นรวม',
							],

							'percent' => [
								'type' => 'INT',
								'constraint' => 11, 'COMMENT' => 'เปอร์เซนต์',
							],

							'amount_max' => [
								'type' => 'varchar',
								'constraint' => 10, 'COMMENT' => 'จำนวนเงินสูงสุด',
							],

							'bonus' => [
								'type' => 'varchar',
								'constraint' => 15, 'COMMENT' => 'โบนัส',
							],

							'time_start' => [
								'type' => 'INT',
								'constraint' => 20,
							],

							'time_end' => [
								'type' => 'INT',
								'constraint' => 20,
							],

							'type' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '1:ทุกยอดฝาก 2:ยอดแรกของวัน 3:ยอดแรกของสัปดาห์ 4:ยอดแรกสมัคร',
							],

							'user_group' => [
								'type' => 'varchar',
								'constraint' => 50, 'COMMENT' => 'gruopที่สามารถเห็นโปรได้',
							],

							'duration_turn' => [
								'type' => 'INT',
								'constraint' => 20, 'COMMENT' => 'ระยะเวลาทำโปร',
							],

							'expire_turn' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '1:หักโปร 2:ไม่ให้ถอน',
							],

							'min_creadit' => [
								'type' => 'varchar',
								'constraint' => 15, 'COMMENT' => 'ขั้นต่ำรับโปร',
							],

							'count_pro' => [
								'type' => 'INT',
								'constraint' => 15, 'COMMENT' => 'จำนวนคนรับโปร',
							],

							'detail_pro' => [
								'type' => 'varchar',
								'constraint' => 255, 'COMMENT' => 'รายละเอียดโปร',
							],

							'link_img' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '1:เปิด 2:ปิด'
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_rank':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 25,
								 'COMMENT' => 'ชื่อชั้น',
							],

							'trunover' => [
								'type' => 'INT',
								'constraint' => 11,
							],

							'point' => [
								'type' => 'float',
								'COMMENT' => 'ตัวคูณพ้อย',
							],
							'spin' => [
								'type' => 'float',
								'COMMENT' => 'ตัวคูณสปิน',
							],

							'sale' => [
								'type' => 'float',
								'COMMENT' => 'ลดราคาของรางวัล',
							],

							'reward_premium' => [
								'type' => 'INT',
								'constraint' => 11, 'COMMENT' => 'ของรางวัลpremium',
							],

							'reward_exclusive' => [
								'type' => 'INT',
								'constraint' => 11,
								"COMMENT" => 'ของรางวัลexclusive',
							],
							'img_link' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_rank (id, name, trunover, point, spin, sale, reward_premium, reward_exclusive, img_link) VALUES
						(1, 'bronze', 50000, 1, 1, 0, 0, 0, 'BRONZA.png'),
						(2, 'silver', 250000, 1.25, 1, 0, 1, 0, 'SILVER.png'),
						(3, 'gold', 1250000, 1.5, 2, 5, 1, 0, 'GOLD.png'),
						(4, 'platinum', 6250000, 1.75, 3, 7, 1, 1, 'PLATINUM.png'),
						(5, 'diamond', 31250000, 2, 5, 10, 1, 1, 'DIAMOND.png');");
						break;
					case 'tb_report':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'report' => [
								'type' => 'text',
								'COMMENT' => 'report massage',
							],

							'username' => [
								'type' => 'text',
								'COMMENT' => 'account user || phone number',
							],

							'createdAt' => [
								'type' => 'text',
								'COMMENT' => 'timestamp',
							],

							'updatedAt' => [
								'type' => 'text',
								'COMMENT' => 'timestamp',
							],

							'Type' => [
								'type' => 'text',
								'COMMENT' => 'ประเภทของปัญหา',
							],

							'status' => [
								'type' => 'int',
								'constraint' => 11,
								'DEFAULT' => 0,
								'COMMENT' => '0: wait to fix 1: fixed',
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_report_winlos':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'sale_id' => [
								'type' => 'INT',
								'constraint' => 3,
							],

							'datefrom' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'dateto' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'winlose' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'turnover' => [
								'type' => 'INT',
								'constraint' => 20,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_sale':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'username' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'name' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'tel' => [
								'type' => 'varchar',
								'constraint' => 12,
							],

							'password' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'salt' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'token' => [
								'type' => 'varchar',
								'constraint' => 20,
							],

							'sale_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],

							'token_login' => [
								'type' => 'varchar',
								'constraint' => 100,
							],

							'last_login' => [
								'type' => 'varchar',
								'constraint' => 12,
							],

							'lastip_login' => [
								'type' => 'varchar',
								'constraint' => 20,
							],

							'img' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_sale_setting':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'f_amt0' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'f_amt1' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'pay_free' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave1' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave1_pay1' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave1_pay2' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave2' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave2_pay1' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave2_pay2' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave3' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave3_pay1' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave3_pay2' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave4' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave4_pay1' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave4_pay2' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave5' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave5_pay1' => [
								'type' => 'INT',
								'constraint' => 7
							],
							'ave5_pay2' => [
								'type' => 'INT',
								'constraint' => 7
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_sale_user':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'auto_increment' => TRUE
							],
							'sale_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'sale' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'username' => [
								'type' => 'varchar',
								'constraint' => 17,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_service_charge':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'title' => [
								'type' => 'varchar',
								'constraint' => 255,
								'COMMENT' => 'หัวข้อ',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 11, 'COMMENT' => '1 เปิดใช้งาน 0 ปิดใช้งาน',
							],
							'confirm_web' => [
								'type' => 'INT',
								'constraint' => 11, 'COMMENT' => '1 กดได้ 0 ไม่ให้กด',
							],
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_service_charge (id, title, status, confirm_web) VALUES
						(1, 'โปรดตรวจสอบค่าบริการที่ต้องชำระ', 0, 0),
						(2, 'ปิดระบบเซล์', 1, 0),
						(3, 'ปิดระบบหลังบ้าน ', 1, 0);");
						break;
					case 'tb_spin':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 30,
								'COMMENT' => 'ชื่อ',
							],
							'spin' => [
								'type' => 'text',
								'COMMENT' => 'รูปหรือข้อความ',
							],
							'alert' => [
								'type' => 'varchar',
								'constraint' => 23,
								'COMMENT' => 'รูปภาพแจ้งเตือนเมื่อได้รับ point',
							],
							'percent' => [
								'type' => 'INT',
								'constraint' => 3,
								'COMMENT' => 'เปอร์เซ็นการออก',
							],
							'point' => [
								'type' => 'INT',
								'constraint' => 10,
								'COMMENT' => 'คะแนนที่ได้',
							],
							'location_max' => [
								'type' => 'INT',
								'constraint' => 11, 'COMMENT' => 'ระยะการหมุนของกงล้อ',
							],
							'location_min' => [
								'type' => 'INT',
								'constraint' => 11, 'COMMENT' => 'ระยะการหมุนของกงล้อ',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
								'COMMENT' => '0 ปิด 1 เปิด'
							],
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_spin (id, name, spin, alert, percent, point, location_max, location_min, status) VALUES
						(1, 'ได้รับ 3000 พอยท์', '1590383178.png', '1531590435609.png', 0, 3000, 358, 325, 1),
						(2, 'ได้รับ 1000 พอยท์', '1590383177.png', '1531590435609.png', 0, 1000, 313, 280, 1),
						(3, 'ได้รับ 500 พอยท์', '1590383176.png', '1531590435609.png', 0, 500, 269, 235, 1),
						(4, 'ได้รับ 300 พอยท์', '1590383175.png', '1531590435609.png', 0, 300, 225, 190, 1),
						(5, 'ได้รับ 100 พอยท์', '1590383174.png', '1531590435609.png', 0, 100, 180, 145, 1),
						(6, 'ไม่ได้รับคะแนน', '1590383173.png', '1531590435609.png', 100, 0, 135, 100, 1),
						(7, 'ได้รับสปินใหม่ 1 ครั้ง', '1590383172.png', '1531590435609.png', 0, 1, 90, 55, 1),
						(8, 'ได้รับคะแนน 13000 คะแนน', '1590383171.png', '1531590435609.png', 0, 13000, 44, 10, 1);");
						break;
					case 'tb_spin_reward':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'id_spin' => [
								'type' => 'INT',
								'constraint' => 1,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_spin_reward (id, id_spin, status) VALUES
						(1, 1, 1),
						(2, 1, 1),
						(3, 1, 1),
						(4, 2, 1),
						(5, 2, 1),
						(6, 2, 1),
						(7, 2, 1),
						(8, 2, 1),
						(9, 2, 1),
						(10, 3, 1),
						(11, 3, 1),
						(12, 3, 1),
						(13, 3, 1),
						(14, 3, 1),
						(15, 3, 1),
						(16, 3, 1),
						(17, 3, 1),
						(18, 3, 1),
						(19, 3, 1),
						(20, 4, 1),
						(21, 4, 1),
						(22, 4, 1),
						(23, 4, 1),
						(24, 4, 1),
						(25, 4, 1),
						(26, 4, 1),
						(27, 4, 1),
						(28, 4, 1),
						(29, 4, 1),
						(30, 4, 1),
						(31, 4, 1),
						(32, 4, 1),
						(33, 4, 1),
						(34, 4, 1),
						(35, 4, 1),
						(36, 4, 1),
						(37, 4, 1),
						(38, 4, 1),
						(39, 4, 1),
						(40, 4, 1),
						(41, 4, 1),
						(42, 4, 1),
						(43, 4, 1),
						(44, 4, 1),
						(45, 4, 1),
						(46, 4, 1),
						(47, 4, 1),
						(48, 4, 1),
						(49, 4, 1),
						(50, 5, 1),
						(51, 5, 1),
						(52, 5, 1),
						(53, 5, 1),
						(54, 5, 1),
						(55, 5, 1),
						(56, 5, 1),
						(57, 5, 1),
						(58, 5, 1),
						(59, 5, 1),
						(60, 5, 1),
						(61, 5, 1),
						(62, 5, 1),
						(63, 5, 1),
						(64, 5, 1),
						(65, 5, 1),
						(66, 5, 1),
						(67, 5, 1),
						(68, 5, 1),
						(69, 5, 1),
						(70, 5, 1),
						(71, 5, 1),
						(72, 5, 1),
						(73, 5, 1),
						(74, 5, 1),
						(75, 5, 1),
						(76, 5, 1),
						(77, 5, 1),
						(78, 5, 1),
						(79, 5, 1),
						(80, 5, 1),
						(81, 5, 1),
						(82, 5, 1),
						(83, 5, 1),
						(84, 5, 1),
						(85, 5, 1),
						(86, 5, 1),
						(87, 5, 1),
						(88, 5, 1),
						(89, 5, 1),
						(90, 5, 1),
						(91, 5, 1),
						(92, 5, 1),
						(93, 5, 1),
						(94, 5, 1),
						(95, 5, 1),
						(96, 5, 1),
						(97, 5, 1),
						(98, 5, 1),
						(99, 5, 1),
						(100, 5, 1),
						(101, 5, 1),
						(102, 5, 1),
						(103, 5, 1),
						(104, 5, 1),
						(105, 5, 1),
						(106, 5, 1),
						(107, 5, 1),
						(108, 5, 1),
						(109, 5, 1),
						(110, 5, 1),
						(111, 5, 1),
						(112, 5, 1),
						(113, 5, 1),
						(114, 5, 1),
						(115, 5, 1),
						(116, 5, 1),
						(117, 5, 1),
						(118, 5, 1),
						(119, 5, 1),
						(120, 5, 1),
						(121, 5, 1),
						(122, 5, 1),
						(123, 5, 1),
						(124, 5, 1),
						(125, 5, 1),
						(126, 5, 1),
						(127, 5, 1),
						(128, 5, 1),
						(129, 5, 1),
						(130, 5, 1),
						(131, 5, 0),
						(132, 5, 1),
						(133, 5, 1),
						(134, 5, 1),
						(135, 5, 1),
						(136, 5, 1),
						(137, 5, 1),
						(138, 5, 1),
						(139, 5, 1),
						(140, 5, 1),
						(141, 5, 1),
						(142, 5, 1),
						(143, 5, 1),
						(144, 5, 1),
						(145, 5, 1),
						(146, 5, 1),
						(147, 5, 1),
						(148, 5, 1),
						(149, 5, 1),
						(150, 5, 1),
						(151, 5, 1),
						(152, 5, 1),
						(153, 5, 1),
						(154, 5, 1),
						(155, 5, 1),
						(156, 5, 1),
						(157, 5, 1),
						(158, 5, 1),
						(159, 5, 1),
						(160, 5, 1),
						(161, 5, 1),
						(162, 5, 1),
						(163, 5, 1),
						(164, 5, 1),
						(165, 5, 1),
						(166, 5, 1),
						(167, 5, 1),
						(168, 5, 1),
						(169, 5, 1),
						(170, 5, 1),
						(171, 5, 1),
						(172, 5, 1),
						(173, 5, 1),
						(174, 5, 1),
						(175, 5, 1),
						(176, 5, 1),
						(177, 5, 1),
						(178, 5, 1),
						(179, 5, 1),
						(180, 5, 1),
						(181, 5, 1),
						(182, 5, 1),
						(183, 5, 1),
						(184, 5, 1),
						(185, 5, 1),
						(186, 5, 1),
						(187, 5, 1),
						(188, 5, 1),
						(189, 5, 1),
						(190, 5, 1),
						(191, 5, 1),
						(192, 5, 1),
						(193, 5, 1),
						(194, 5, 1),
						(195, 5, 1),
						(196, 5, 1),
						(197, 5, 1),
						(198, 5, 1),
						(199, 5, 1),
						(200, 5, 1),
						(201, 5, 1),
						(202, 5, 1),
						(203, 5, 1),
						(204, 5, 1),
						(205, 5, 1),
						(206, 5, 1),
						(207, 5, 1),
						(208, 5, 1),
						(209, 5, 1),
						(210, 5, 1),
						(211, 5, 1),
						(212, 5, 1),
						(213, 5, 1),
						(214, 5, 1),
						(215, 5, 1),
						(216, 5, 1),
						(217, 5, 1),
						(218, 5, 1),
						(219, 5, 1),
						(220, 5, 1),
						(221, 5, 1),
						(222, 5, 1),
						(223, 5, 1),
						(224, 5, 1),
						(225, 5, 1),
						(226, 5, 1),
						(227, 5, 1),
						(228, 5, 1),
						(229, 5, 1),
						(230, 5, 1),
						(231, 5, 1),
						(232, 5, 1),
						(233, 5, 1),
						(234, 5, 1),
						(235, 5, 1),
						(236, 5, 1),
						(237, 5, 1),
						(238, 5, 1),
						(239, 5, 1),
						(240, 5, 1),
						(241, 5, 1),
						(242, 5, 1),
						(243, 5, 1),
						(244, 5, 1),
						(245, 5, 1),
						(246, 5, 1),
						(247, 5, 1),
						(248, 5, 1),
						(249, 5, 1),
						(250, 5, 1),
						(251, 5, 1),
						(252, 5, 1),
						(253, 5, 1),
						(254, 5, 1),
						(255, 5, 1),
						(256, 5, 1),
						(257, 5, 1),
						(258, 5, 1),
						(259, 5, 1),
						(260, 5, 1),
						(261, 5, 1),
						(262, 5, 1),
						(263, 5, 1),
						(264, 5, 1),
						(265, 5, 1),
						(266, 5, 1),
						(267, 5, 1),
						(268, 5, 1),
						(269, 5, 1),
						(270, 5, 1),
						(271, 5, 1),
						(272, 5, 1),
						(273, 5, 1),
						(274, 5, 1),
						(275, 5, 1),
						(276, 5, 1),
						(277, 5, 1),
						(278, 5, 1),
						(279, 5, 1),
						(280, 5, 1),
						(281, 5, 1),
						(282, 5, 1),
						(283, 5, 1),
						(284, 5, 1),
						(285, 5, 1),
						(286, 5, 1),
						(287, 5, 1),
						(288, 5, 1),
						(289, 5, 1),
						(290, 5, 1),
						(291, 5, 1),
						(292, 5, 1),
						(293, 5, 1),
						(294, 5, 1),
						(295, 5, 1),
						(296, 5, 1),
						(297, 5, 1),
						(298, 5, 1),
						(299, 5, 1),
						(300, 5, 1),
						(301, 5, 1),
						(302, 5, 1),
						(303, 5, 1),
						(304, 5, 1),
						(305, 5, 1),
						(306, 5, 1),
						(307, 5, 1),
						(308, 5, 1),
						(309, 5, 1),
						(310, 5, 1),
						(311, 5, 1),
						(312, 5, 1),
						(313, 5, 1),
						(314, 5, 1),
						(315, 5, 1),
						(316, 5, 1),
						(317, 5, 1),
						(318, 5, 1),
						(319, 5, 1),
						(320, 5, 1),
						(321, 5, 1),
						(322, 5, 1),
						(323, 5, 1),
						(324, 5, 1),
						(325, 5, 1),
						(326, 5, 1),
						(327, 5, 1),
						(328, 5, 1),
						(329, 5, 1),
						(330, 5, 1),
						(331, 5, 1),
						(332, 5, 1),
						(333, 5, 1),
						(334, 5, 1),
						(335, 5, 1),
						(336, 5, 1),
						(337, 5, 1),
						(338, 5, 1),
						(339, 5, 1),
						(340, 5, 1),
						(341, 5, 1),
						(342, 5, 1),
						(343, 5, 1),
						(344, 5, 1),
						(345, 5, 1),
						(346, 5, 1),
						(347, 5, 1),
						(348, 5, 1),
						(349, 5, 1),
						(350, 5, 1),
						(351, 5, 1),
						(352, 5, 1),
						(353, 5, 1),
						(354, 5, 1),
						(355, 5, 1),
						(356, 5, 1),
						(357, 5, 1),
						(358, 5, 1),
						(359, 5, 1),
						(360, 5, 1),
						(361, 5, 1),
						(362, 5, 1),
						(363, 5, 1),
						(364, 5, 1),
						(365, 5, 1),
						(366, 5, 1),
						(367, 5, 1),
						(368, 5, 1),
						(369, 5, 1),
						(370, 5, 1),
						(371, 5, 1),
						(372, 5, 1),
						(373, 5, 1),
						(374, 5, 1),
						(375, 5, 1),
						(376, 5, 1),
						(377, 5, 1),
						(378, 5, 1),
						(379, 5, 1),
						(380, 5, 1),
						(381, 5, 1),
						(382, 5, 1),
						(383, 5, 1),
						(384, 5, 1),
						(385, 5, 1),
						(386, 5, 1),
						(387, 5, 1),
						(388, 5, 1),
						(389, 5, 1),
						(390, 5, 1),
						(391, 5, 1),
						(392, 5, 1),
						(393, 5, 1),
						(394, 5, 1),
						(395, 5, 1),
						(396, 5, 1),
						(397, 5, 1),
						(398, 5, 1),
						(399, 5, 1),
						(400, 5, 1),
						(401, 5, 1),
						(402, 5, 1),
						(403, 5, 1),
						(404, 5, 1),
						(405, 5, 1),
						(406, 5, 1),
						(407, 5, 1),
						(408, 5, 1),
						(409, 5, 1),
						(410, 5, 1),
						(411, 5, 1),
						(412, 5, 1),
						(413, 5, 1),
						(414, 5, 1),
						(415, 5, 1),
						(416, 5, 1),
						(417, 5, 1),
						(418, 5, 1),
						(419, 5, 1),
						(420, 5, 1),
						(421, 5, 1),
						(422, 5, 1),
						(423, 5, 1),
						(424, 5, 1),
						(425, 5, 1),
						(426, 5, 1),
						(427, 5, 1),
						(428, 5, 1),
						(429, 5, 1),
						(430, 5, 1),
						(431, 5, 1),
						(432, 5, 1),
						(433, 5, 0),
						(434, 5, 1),
						(435, 5, 1),
						(436, 5, 1),
						(437, 5, 1),
						(438, 5, 1),
						(439, 5, 1),
						(440, 5, 1),
						(441, 5, 1),
						(442, 5, 1),
						(443, 5, 1),
						(444, 5, 1),
						(445, 5, 1),
						(446, 5, 1),
						(447, 5, 1),
						(448, 5, 1),
						(449, 5, 1),
						(450, 5, 1),
						(451, 5, 1),
						(452, 5, 1),
						(453, 5, 1),
						(454, 5, 1),
						(455, 5, 1),
						(456, 5, 1),
						(457, 5, 1),
						(458, 5, 1),
						(459, 5, 1),
						(460, 5, 1),
						(461, 5, 1),
						(462, 5, 1),
						(463, 5, 1),
						(464, 5, 1),
						(465, 5, 1),
						(466, 5, 1),
						(467, 5, 1),
						(468, 5, 1),
						(469, 5, 1),
						(470, 5, 1),
						(471, 5, 1),
						(472, 5, 1),
						(473, 5, 1),
						(474, 5, 1),
						(475, 5, 1),
						(476, 5, 1),
						(477, 5, 1),
						(478, 5, 1),
						(479, 5, 1),
						(480, 5, 1),
						(481, 5, 0),
						(482, 5, 1),
						(483, 5, 1),
						(484, 5, 1),
						(485, 5, 1),
						(486, 5, 1),
						(487, 5, 1),
						(488, 5, 1),
						(489, 5, 1),
						(490, 5, 1),
						(491, 5, 1),
						(492, 5, 1),
						(493, 5, 1),
						(494, 5, 1),
						(495, 5, 1),
						(496, 5, 1),
						(497, 5, 1),
						(498, 5, 1),
						(499, 5, 1),
						(500, 5, 1),
						(501, 5, 1),
						(502, 5, 1),
						(503, 5, 1),
						(504, 5, 1),
						(505, 5, 1),
						(506, 5, 1),
						(507, 5, 1),
						(508, 5, 1),
						(509, 5, 1),
						(510, 5, 1),
						(511, 5, 1),
						(512, 5, 1),
						(513, 5, 1),
						(514, 5, 1),
						(515, 5, 1),
						(516, 5, 1),
						(517, 5, 1),
						(518, 5, 1),
						(519, 5, 1),
						(520, 5, 1),
						(521, 5, 1),
						(522, 5, 1),
						(523, 5, 1),
						(524, 5, 1),
						(525, 5, 1),
						(526, 5, 1),
						(527, 5, 1),
						(528, 5, 1),
						(529, 5, 1),
						(530, 5, 1),
						(531, 5, 1),
						(532, 5, 1),
						(533, 5, 1),
						(534, 5, 1),
						(535, 5, 1),
						(536, 5, 1),
						(537, 5, 1),
						(538, 5, 1),
						(539, 5, 1),
						(540, 5, 1),
						(541, 5, 1),
						(542, 5, 1),
						(543, 5, 1),
						(544, 5, 1),
						(545, 5, 1),
						(546, 5, 1),
						(547, 5, 1),
						(548, 5, 1),
						(549, 5, 1),
						(550, 5, 1),
						(551, 5, 1),
						(552, 5, 1),
						(553, 5, 1),
						(554, 5, 1),
						(555, 5, 1),
						(556, 5, 1),
						(557, 5, 1),
						(558, 5, 1),
						(559, 5, 1),
						(560, 5, 1),
						(561, 5, 1),
						(562, 5, 1),
						(563, 5, 1),
						(564, 5, 1),
						(565, 5, 1),
						(566, 5, 1),
						(567, 5, 1),
						(568, 5, 1),
						(569, 5, 1),
						(570, 5, 1),
						(571, 5, 1),
						(572, 5, 1),
						(573, 5, 1),
						(574, 5, 1),
						(575, 5, 1),
						(576, 5, 1),
						(577, 5, 1),
						(578, 5, 1),
						(579, 5, 1),
						(580, 5, 1),
						(581, 5, 1),
						(582, 5, 1),
						(583, 5, 1),
						(584, 5, 1),
						(585, 5, 1),
						(586, 5, 1),
						(587, 5, 1),
						(588, 5, 1),
						(589, 5, 1),
						(590, 5, 1),
						(591, 5, 1),
						(592, 5, 1),
						(593, 5, 1),
						(594, 5, 1),
						(595, 5, 1),
						(596, 5, 1),
						(597, 5, 1),
						(598, 5, 1),
						(599, 5, 1),
						(600, 5, 1),
						(601, 5, 1),
						(602, 5, 1),
						(603, 5, 1),
						(604, 5, 1),
						(605, 5, 1),
						(606, 5, 1),
						(607, 5, 1),
						(608, 5, 1),
						(609, 5, 1),
						(610, 5, 1),
						(611, 5, 1),
						(612, 5, 1),
						(613, 5, 1),
						(614, 5, 1),
						(615, 5, 1),
						(616, 5, 1),
						(617, 5, 1),
						(618, 5, 1),
						(619, 5, 1),
						(620, 5, 1),
						(621, 5, 1),
						(622, 5, 1),
						(623, 5, 1),
						(624, 5, 1),
						(625, 5, 1),
						(626, 5, 1),
						(627, 5, 1),
						(628, 5, 1),
						(629, 5, 1),
						(630, 5, 1),
						(631, 5, 1),
						(632, 5, 1),
						(633, 5, 1),
						(634, 5, 1),
						(635, 5, 1),
						(636, 5, 1),
						(637, 5, 1),
						(638, 5, 1),
						(639, 5, 1),
						(640, 5, 1),
						(641, 5, 1),
						(642, 5, 1),
						(643, 5, 1),
						(644, 5, 1),
						(645, 5, 1),
						(646, 5, 1),
						(647, 5, 1),
						(648, 5, 1),
						(649, 5, 1),
						(650, 5, 1),
						(651, 5, 1),
						(652, 5, 1),
						(653, 5, 1),
						(654, 5, 1),
						(655, 5, 1),
						(656, 5, 1),
						(657, 5, 1),
						(658, 5, 1),
						(659, 5, 1),
						(660, 5, 1),
						(661, 5, 1),
						(662, 5, 1),
						(663, 5, 1),
						(664, 5, 1),
						(665, 5, 1),
						(666, 5, 1),
						(667, 5, 1),
						(668, 5, 1),
						(669, 5, 1),
						(670, 5, 1),
						(671, 5, 1),
						(672, 5, 1),
						(673, 5, 1),
						(674, 5, 1),
						(675, 5, 1),
						(676, 5, 1),
						(677, 5, 1),
						(678, 5, 1),
						(679, 5, 1),
						(680, 5, 1),
						(681, 5, 1),
						(682, 5, 1),
						(683, 5, 1),
						(684, 5, 1),
						(685, 5, 1),
						(686, 5, 1),
						(687, 5, 1),
						(688, 5, 1),
						(689, 5, 1),
						(690, 5, 1),
						(691, 5, 1),
						(692, 5, 1),
						(693, 5, 1),
						(694, 5, 1),
						(695, 5, 1),
						(696, 5, 1),
						(697, 5, 1),
						(698, 5, 1),
						(699, 5, 0),
						(700, 5, 1),
						(701, 5, 1),
						(702, 5, 1),
						(703, 5, 1),
						(704, 5, 1),
						(705, 5, 1),
						(706, 5, 1),
						(707, 5, 1),
						(708, 5, 1),
						(709, 5, 1),
						(710, 5, 1),
						(711, 5, 1),
						(712, 5, 1),
						(713, 5, 1),
						(714, 5, 1),
						(715, 5, 1),
						(716, 5, 1),
						(717, 5, 1),
						(718, 5, 1),
						(719, 5, 1),
						(720, 5, 1),
						(721, 5, 1),
						(722, 5, 1),
						(723, 5, 1),
						(724, 5, 1),
						(725, 5, 1),
						(726, 5, 1),
						(727, 5, 1),
						(728, 5, 1),
						(729, 5, 1),
						(730, 5, 1),
						(731, 5, 1),
						(732, 5, 1),
						(733, 5, 1),
						(734, 5, 1),
						(735, 5, 1),
						(736, 5, 1),
						(737, 5, 1),
						(738, 5, 1),
						(739, 5, 1),
						(740, 5, 1),
						(741, 5, 1),
						(742, 5, 1),
						(743, 5, 1),
						(744, 5, 1),
						(745, 5, 1),
						(746, 5, 1),
						(747, 5, 1),
						(748, 5, 1),
						(749, 5, 1),
						(750, 6, 1),
						(751, 6, 1),
						(752, 6, 1),
						(753, 6, 1),
						(754, 6, 1),
						(755, 6, 1),
						(756, 6, 1),
						(757, 6, 1),
						(758, 6, 1),
						(759, 6, 1),
						(760, 6, 1),
						(761, 6, 1),
						(762, 6, 1),
						(763, 6, 1),
						(764, 6, 1),
						(765, 6, 1),
						(766, 6, 1),
						(767, 6, 1),
						(768, 6, 1),
						(769, 6, 1),
						(770, 6, 1),
						(771, 6, 1),
						(772, 6, 1),
						(773, 6, 1),
						(774, 6, 1),
						(775, 6, 1),
						(776, 6, 1),
						(777, 6, 1),
						(778, 6, 1),
						(779, 6, 1),
						(780, 6, 1),
						(781, 6, 1),
						(782, 6, 1),
						(783, 6, 1),
						(784, 6, 1),
						(785, 6, 1),
						(786, 6, 1),
						(787, 6, 1),
						(788, 6, 1),
						(789, 6, 1),
						(790, 6, 1),
						(791, 6, 1),
						(792, 6, 1),
						(793, 6, 1),
						(794, 6, 1),
						(795, 6, 1),
						(796, 6, 1),
						(797, 6, 1),
						(798, 6, 1),
						(799, 6, 1),
						(800, 6, 1),
						(801, 6, 1),
						(802, 6, 1),
						(803, 6, 1),
						(804, 6, 1),
						(805, 6, 1),
						(806, 6, 1),
						(807, 6, 1),
						(808, 6, 1),
						(809, 6, 1),
						(810, 6, 1),
						(811, 6, 1),
						(812, 6, 1),
						(813, 6, 1),
						(814, 6, 1),
						(815, 6, 1),
						(816, 6, 1),
						(817, 6, 1),
						(818, 6, 1),
						(819, 6, 1),
						(820, 6, 1),
						(821, 6, 1),
						(822, 6, 1),
						(823, 6, 1),
						(824, 6, 1),
						(825, 6, 1),
						(826, 6, 1),
						(827, 6, 1),
						(828, 6, 1),
						(829, 6, 1),
						(830, 6, 1),
						(831, 6, 1),
						(832, 6, 1),
						(833, 6, 1),
						(834, 6, 1),
						(835, 6, 1),
						(836, 6, 1),
						(837, 6, 1),
						(838, 6, 1),
						(839, 6, 1),
						(840, 6, 1),
						(841, 6, 1),
						(842, 6, 1),
						(843, 6, 1),
						(844, 6, 1),
						(845, 6, 1),
						(846, 6, 1),
						(847, 6, 1),
						(848, 6, 1),
						(849, 6, 1),
						(850, 6, 1),
						(851, 6, 1),
						(852, 6, 1),
						(853, 6, 1),
						(854, 6, 1),
						(855, 6, 1),
						(856, 6, 1),
						(857, 6, 1),
						(858, 6, 1),
						(859, 6, 1),
						(860, 6, 1),
						(861, 6, 1),
						(862, 6, 1),
						(863, 6, 1),
						(864, 6, 1),
						(865, 6, 1),
						(866, 6, 1),
						(867, 6, 1),
						(868, 6, 1),
						(869, 6, 1),
						(870, 6, 1),
						(871, 6, 1),
						(872, 6, 1),
						(873, 6, 1),
						(874, 6, 1),
						(875, 6, 1),
						(876, 6, 1),
						(877, 6, 1),
						(878, 6, 1),
						(879, 6, 1),
						(880, 6, 1),
						(881, 6, 1),
						(882, 6, 1),
						(883, 6, 1),
						(884, 6, 1),
						(885, 6, 1),
						(886, 6, 1),
						(887, 6, 1),
						(888, 6, 1),
						(889, 6, 1),
						(890, 6, 1),
						(891, 6, 1),
						(892, 6, 1),
						(893, 6, 1),
						(894, 6, 1),
						(895, 6, 1),
						(896, 6, 1),
						(897, 6, 1),
						(898, 6, 1),
						(899, 6, 1),
						(900, 6, 1),
						(901, 6, 1),
						(902, 6, 1),
						(903, 6, 1),
						(904, 6, 1),
						(905, 6, 1),
						(906, 6, 1),
						(907, 6, 1),
						(908, 6, 1),
						(909, 6, 1),
						(910, 6, 1),
						(911, 6, 1),
						(912, 6, 1),
						(913, 6, 1),
						(914, 6, 1),
						(915, 6, 1),
						(916, 6, 1),
						(917, 6, 1),
						(918, 6, 1),
						(919, 6, 1),
						(920, 6, 1),
						(921, 6, 1),
						(922, 6, 1),
						(923, 6, 1),
						(924, 6, 1),
						(925, 6, 1),
						(926, 6, 1),
						(927, 6, 1),
						(928, 6, 1),
						(929, 6, 1),
						(930, 6, 1),
						(931, 6, 1),
						(932, 6, 1),
						(933, 6, 1),
						(934, 6, 1),
						(935, 6, 1),
						(936, 6, 1),
						(937, 6, 1),
						(938, 6, 1),
						(939, 6, 1),
						(940, 6, 1),
						(941, 6, 1),
						(942, 6, 1),
						(943, 6, 1),
						(944, 6, 1),
						(945, 6, 1),
						(946, 6, 1),
						(947, 6, 1),
						(948, 6, 1),
						(949, 6, 1),
						(950, 6, 1),
						(951, 6, 1),
						(952, 6, 1),
						(953, 6, 1),
						(954, 6, 1),
						(955, 6, 1),
						(956, 6, 1),
						(957, 6, 1),
						(958, 6, 1),
						(959, 6, 1),
						(960, 6, 1),
						(961, 6, 1),
						(962, 6, 1),
						(963, 6, 1),
						(964, 6, 1),
						(965, 6, 1),
						(966, 6, 1),
						(967, 6, 1),
						(968, 6, 1),
						(969, 6, 1),
						(970, 6, 1),
						(971, 6, 1),
						(972, 6, 1),
						(973, 6, 1),
						(974, 6, 1),
						(975, 6, 1),
						(976, 6, 1),
						(977, 6, 1),
						(978, 6, 1),
						(979, 6, 1),
						(980, 6, 1),
						(981, 6, 1),
						(982, 6, 1),
						(983, 6, 1),
						(984, 6, 1),
						(985, 6, 1),
						(986, 6, 1),
						(987, 6, 1),
						(988, 6, 1),
						(989, 6, 1),
						(990, 6, 1),
						(991, 6, 1),
						(992, 6, 1),
						(993, 6, 1),
						(994, 6, 1),
						(995, 6, 1),
						(996, 6, 1),
						(997, 6, 1),
						(998, 6, 1),
						(999, 7, 1),
						(1000, 8, 1);");
						break;
					case 'tb_spin_store':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'spin' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'date' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_statement':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 1,
							],
							'datetime' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'deposit' => [
								'type' => 'double',
								'constraint' =>  [13, 2],
							],
							'withdraw' => [
								'type' => 'double',
								'constraint' => [13, 2],
							],
							'fee' => [
								'type' => 'double',
								'constraint' => [6, 2],
							],
							'note' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'dateCreate' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'from_name' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'from_account' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'from_bank' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'deposit_id' => [
								'type' => 'INT',
								'constraint' => 20,
							],
							'withdraw_id' => [
								'type' => 'INT',
								'constraint' => 20,
							],
							'admin_id' => [
								'type' => 'INT',
								'constraint' => 4,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
								'COMMENT' => '0 ปิด 1 รอเฟิร์ม 2 เฟิร์มแล้ว 3 ซิสเต็ม 4 ยกเลิก 5 ซ่อนรายการ'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_truew':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '0=ปิด 1=เปิด'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
						case 'tb_turn':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'auto_increment' => TRUE
							],
							'comm' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'win' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'total' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'player_id' => [
								'type' => 'INT',
								'constraint' => 12,
							],

							'member_id' => [
								'type' => 'INT',
								'constraint' => 15,
							],

							'username' => [
								'type' => 'varchar',
								'constraint' => 30,
							],

							'sale' => [
								'type' => 'varchar',
								'constraint' => 25,
							],

							'user_sale' => [
								'type' => 'varchar',
								'constraint' => 15,
							],

							'turnover' => [
								'type' => 'double',
								'constraint' => [10, 2],
							],

							'grosscomm' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'payout' => [
								'type' => 'double',
								'constraint' => [10, 2],
								'COMMENT' => 'winloss',
							],

							'valid_amount' => [
								'type' => 'double',
								'constraint' => [10, 2],
								'COMMENT' => 'turnover',
							],

							'company' => [
								'type' => 'double',
								'constraint' => [10, 2],
							],

							'role' => [
								'type' => 'double',
								'constraint' => [10, 2],
							],

							'loyalty' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'created_time' => [
								'type' => 'varchar',
								'constraint' => 12,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
						case 'tb_turnover':
							$fields = [
								'id' => [
									'type' => 'INT',
									'constraint' => 11,
									'unsigned' => TRUE,
									'auto_increment' => TRUE
								],
								'user_id' => [
									'type' => 'varchar',
									'constraint' => 25,
								],
	
								'promotion_id' => [
									'type' => 'INT',
									'constraint' => 3,
									'COMMENT' => '0 : ไม่มีโปรโมชั่น',
								],
	
								'code_id' => [
									'type' => 'INT',
									'constraint' => 3,
									'COMMENT' => '0:ยังไม่รับ ',
								],
	
								'sport' => [
									'type' => 'varchar',
									'constraint' => 10,
								],
	
								'casino' => [
									'type' => 'varchar',
									'constraint' => 10,
								],
	
								'game' => [
									'type' => 'varchar',
									'constraint' => 10,
								],
	
								'checkturn' => [
									'type' => 'varchar',
									'constraint' => 10,
								],
	
								'check_time' => [
									'type' => 'INT',
									'constraint' => 13,
								],
	
								'status' => [
									'type' => 'INT',
									'constraint' => 1,
								],
	
							];
							$this->createTb($fields, $value, 'id');
							break;
					case 'tb_tutorial':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 255,
								'COMMENT' => 'ชื่อคลิป',
							],
							'url' => [
								'type' => 'varchar',
								'constraint' => 255,
								'COMMENT' => 'url ที่จะนำมาแป๊ะ',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 11,
								'COMMENT' => '1 เปิด 0 ปิด',
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 255,
								'COMMENT' => 'วันที่สร้าง'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_user':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'auto_increment' => TRUE
							],
							'username' => [
								'type' => 'varchar',
								'constraint' => 10,
								'COMMENT' => 'User_Login',
							],
							'password' => [
								'type' => 'varchar',
								'constraint' => 30
							],
							'user' => [
								'type' => 'varchar',
								'constraint' => 25,
								'COMMENT' => 'User_API',
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 30,
								'COMMENT' => 'ชื่อลูกค้า',
							],
							'line' => [
								'type' => 'varchar',
								'constraint' => 255,
								'COMMENT' => 'ชื่อ line ของลูกค้า',
							],
							'line_user_id' => [
								'type' => 'text',
								'COMMENT' => 'id line ของลูกค้า',
							],
							'point' => [
								'type' => 'int',
								'constraint' => 11,
								'COMMENT' => 'คะแนน',
							],
							'spin' => [
								'type' => 'int',
								'constraint' => 11, 'COMMENT' => 'จำนวนการหมุนวงล้อฟรี',
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12, 'COMMENT' => 'เวลาสร้าง',
							],
							'comefrom' => [
								'type' => 'int',
								'constraint' => 1, 'COMMENT' => '1 เก่า 2 ใหม่',
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1, 'COMMENT' => '0 ปิด 1 เปิด 2 ล็อค',
							],
							'sale_credit' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_user_bank':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user_id' => [
								'type' => 'varchar',
								'constraint' => 11,
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 5, 'COMMENT' => 'ธนาคาร ดูจาก TB_bank',
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 30, 'COMMENT' => 'ชื่อบัญชี',
							],
							'account' => [
								'type' => 'varchar',
								'constraint' => 15, 'COMMENT' => 'เลขที่บัญชี',
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12, 'COMMENT' => 'เวลาสร้าง',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '0 ปิด 1 เปิด'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_user_group':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'group_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '0 ปิด 1 เปิด'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_user_group_default':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'type' => [
								'type' => 'INT',
								'constraint' => 11, 'COMMENT' => '1 df 2 no df',
							],
							'group_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '0 ปิด 1 เปิด'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_user_rank':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'total_turnover' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'id_rank' => [
								'type' => 'INT',
								'constraint' => 11,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_user_sale':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'auto_increment' => TRUE
							],
							'sale_userid' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'sale_username' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'user_username' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'turnover' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'winloss' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'last_date' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'date_update' => [
								'type' => 'varchar',
								'constraint' => 12, 'COMMENT' => 'วันที่อัพเดตล่าสุด',
							],
							'from_date' => [
								'type' => 'varchar',
								'constraint' => 12, 'COMMENT' => 'วันที่ก่อนอัพเดตล่าสุด',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_user_sale_credit':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'amount' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'admin_id' => [
								'type' => 'varchar',
								'constraint' => 11,
							],
							'date_user' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'date_AdminCf' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '0ปิด 1รอ 2 เฟิร์ม 3ยกเลิก'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_vendor':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'vendor_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'vendorCode' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'VendorName' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'type' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '1 game / 2 casino / 3 sport',
							],
							'check_turn' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '0ไม่คิเทิน/1คิดเทิน',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_vendor (id, vendor_id, vendorCode, VendorName, type, check_turn, status) VALUES
						(1, 1, 'M8', 'M-Sport', 3, 1, 1),
						(2, 2, 'Ssport', 'S-Sports', 3, 1, 1),
						(3, 5, 'AB', 'AllBet', 2, 1, 1),
						(4, 7, 'AG', 'AG Deluxe Suite', 2, 1, 1),
						(5, 9, 'PT', 'SkyWind', 1, 1, 1),
						(6, 15, 'MX', 'Pragmatic', 1, 1, 1),
						(7, 16, 'ACE333', 'ACE333', 1, 1, 1),
						(8, 17, 'CF', 'CockFight', 3, 1, 1),
						(9, 20, 'CQ9', 'CQ9', 1, 1, 1),
						(10, 21, 'GG', 'Global Gaming', 1, 1, 1),
						(11, 22, 'WM', 'WM', 2, 1, 1),
						(12, 23, 'LS', 'Lucky Streak', 2, 1, 1),
						(13, 25, 'KN', 'Keno Lottery', 2, 1, 1),
						(14, 26, 'ML', 'ML lottery', 2, 1, 1),
						(15, 44, 'JOKER', 'JOKER', 1, 1, 1),
						(16, 29, 'DG', 'Dream Gamming', 2, 1, 1),
						(17, 31, 'GD', 'Gold Deluxe Casino ', 2, 1, 1),
						(18, 32, 'SB', 'Sexy Baccarat ', 2, 1, 1),
						(19, 33, 'VT', 'Virtual Tech', 2, 1, 1),
						(20, 35, 'CT855', 'CT855', 2, 1, 2),
						(21, 36, 'SA ', 'SA Gaming', 1, 1, 1),
						(22, 37, 'OG', 'OG Poker', 2, 1, 1),
						(23, 38, 'LEG', 'LE Gaming', 1, 1, 1),
						(24, 39, 'SAE', 'SA Gaming EGames', 1, 1, 1),
						(25, 40, 'FGG', 'Fair Guaranted Gaming', 1, 1, 1),
						(26, 41, 'IA', 'IA E-Sports', 3, 1, 1),
						(27, 43, 'EVO', 'Evolution Live Casino', 2, 1, 1),
						(28, 45, 'DPT', 'PlayTech Digital', 1, 1, 1),
						(29, 46, 'ฺBG', 'BG Live Casino', 2, 1, 1),
						(30, 47, 'BGE', 'BG E-Game', 1, 1, 1),
						(31, 48, 'C93', '93 Connect', 2, 1, 1),
						(32, 49, 'BS', 'BetSoft', 3, 1, 1),
						(33, 50, 'DT', 'DreamTech', 1, 1, 1),
						(34, 51, 'MaxBet', 'Max Bet', 3, 1, 1),
						(35, 52, 'SBO', 'SBO Sport', 3, 1, 1),
						(36, 54, 'SBOVS', 'SBO Virtual Sport', 3, 1, 1),
						(37, 4, 'EZUGI', 'EZUGI', 1, 1, 1),
						(38, 56, 'PPL', 'Pragmatic Play Live', 2, 1, 1),
						(39, 53, 'IG', 'IG E-games', 1, 1, 1),
						(40, 58, 'PGSOFT', 'PGSOFT', 1, 1, 1),
						(41, 59, 'HABANERO', 'HABANERO', 1, 1, 1),
						(42, 60, 'MT', 'Muay Thai', 3, 1, 1),
						(43, 61, 'MIKI', 'MiKi Mouse', 2, 1, 1),
						(44, 57, 'QQ', 'QQLottery', 1, 1, 1),
						(45, 222, 'test', 'test', 1, 0, 1);");
						break;
					case 'tb_withdraw':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'time' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'user_id' => [
								'type' => 'INT',
								'constraint' => 11,
							],
							'account' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'amount' => [
								'type' => 'double',
								'constraint' => [12, 2],
							],
							'bank_api' => [
								'type' => 'varchar',
								'constraint' => 5,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '1=wait,2=success,3=reject,4=check,5=auto 6= wait auto',
							],
							'admin_cf' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'admin_check' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'admin_cfTime' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'bank_web_id' => [
								'type' => 'INT',
								'constraint' => 2,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_withdraw_limit':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'limit_amount' => [
								'type' => 'double',
								'constraint' => [10, 2],
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => 'acc_account.id',
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1, 'COMMENT' => '0ปิด 1เปิด\r\n'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'tb_withdraw_min':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'amount' => [
								'type' => 'double',
								'constraint' => [10, 2],
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_withdraw_min (id, name, amount, status) VALUES
						(1, 'wd_min', 0.00, 1),
						(2, 'turn_min', 0.00, 0),
						(3, 'count_wd', 10.00, 1),
						(4, 'wd_max', 100000.00, 1);");
						break;

					case 'transactionauto':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'admin_acc' => [
								'type' => 'varchar',
								'constraint' => 40,
							],
							'admin_name' => [
								'type' => 'varchar',
								'constraint' => 40,
							],
							'ts_date' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'ts_time' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'ts_order' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'ts_route' => [
								'type' => 'varchar',
								'constraint' => 200,
							],
							'ts_withdraw' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'ts_diposit' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'ts_info' => [
								'type' => 'varchar',
								'constraint' => 200,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
							'tx_hash' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;
					case 'transactionauto_test':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'admin_acc' => [
								'type' => 'varchar',
								'constraint' => 40,
							],
							'admin_name' => [
								'type' => 'varchar',
								'constraint' => 40,
							],
							'ts_date' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'ts_time' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'ts_order' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'ts_route' => [
								'type' => 'varchar',
								'constraint' => 200,
							],
							'ts_withdraw' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'ts_diposit' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'ts_info' => [
								'type' => 'varchar',
								'constraint' => 200,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							],
							'tx_hash' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
						];
						$this->createTb($fields, $value, 'id');
						break;



					case 'setting':
						$fields = [

							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'name' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'code' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							]
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO setting (id, name, code, status) VALUES
						(1, 'agent', '', 1),
						(2, 'token', '', 1),
						(3, 'deviceId', '', 1),
						(4, 'ApiRefresh', '', 1),
						(5, 'web', 'IMI55', 1),
						(6, 'deviceId_in', '', 1),
						(7, 'ApiRefresh_in', '', 1),
						(8, 'spin_amount', '1', 1),
						(9, 'spin_num', '0', 0),
						(10, 'switch_exchange', '1', 0),
						(11, 'point_amount', '0', 0),
						(12, 'point_num', '0', 0),
						(13, 'switch_affiliate', '3', 1),
						(14, 'set_newuser_turn', '0', 0),
						(15, 'set_newusersale_turn', '0', 0),
						(16, 'deposit_day', '300', 1),
						(17, 'minTurnPoint', '500', 0),
						(18, 'perPoint', '0.1', 1),
						(19, 'bearer', 'dbe1d1e9-3b35-46f2-94ba-007221e49590', 1);");
						break;


					case 'setting_telegram':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 5,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 50,
								'comment' => 'ชื่อ'
							],

							'detail' => [
								'type' => 'text',
								'comment' => 'รายละเอียด'
							],

							'value' => [
								'type' => 'text',
								'comment' => 'ค่า',
								'null' => true
							],
							'isEnabled' => [
								'type' => 'tinyint',
								'constraint' => 4,
								'DEFAULT' => 1
							],
							'status' => [
								'type' => 'tinyint',
								'constraint' => 4,
								'DEFAULT' => 1
							]

						];
						$this->createTb($fields, $value, 'id');
						break;

					case 'set_deposit_turnover':
						$fields = [
							'id' => [
								'type' => 'int',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'num' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => 'จำนวน',
							],
							'equal' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => 'จำนวนเท่า'
							],
							'max' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => 'สูงสุดจำนวนที่ติดเทินเช่น 10000'
							]
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO set_deposit_turnover (id, num, equal, max) VALUES
						(1, 0, 0, 0);");
						break;

					case 'slide_image':
						$fields = [
							'id' => [
								'type' => 'int',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'title' => [
								'type' => 'varchar',
								'constraint' => 200,
								'comment' => 'ข้อความ'
							],
							'slide_img' => [
								'type' => 'varchar',
								'constraint' => 200,
							],
							'create_at' => [
								'type' => 'int',
								'constraint' => 11
							]
						];
						$this->createTb($fields, $value, 'id');
						break;

					case 'sms_otp':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'date' => [
								'type' => 'varchar',
								'constraint' => 50
							],

							'account' => [
								'type' => 'varchar',
								'constraint' => 20
							],

							'otp' => [
								'type' => 'varchar',
								'constraint' => 20
							],

							'ref' => [
								'type' => 'varchar',
								'constraint' => 20
							],

							'status' => [
								'type' => 'int',
								'constraint' => 1
							]
						];
						$this->createTb($fields, $value, 'id');
						break;



					case 'sms_otp2':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'date' => [
								'type' => 'varchar',
								'constraint' => 50
							],

							'account' => [
								'type' => 'varchar',
								'constraint' => 20
							],

							'otp' => [
								'type' => 'varchar',
								'constraint' => 20
							],

							'ref' => [
								'type' => 'varchar',
								'constraint' => 20
							],

							'status' => [
								'type' => 'int',
								'constraint' => 1
							]
						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_admin':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'username' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'agent' => [
								'type' => 'varchar',
								'constraint' => 10,
							],

							'password' => [
								'type' => 'varchar',
								'constraint' => 255,
							],
							'salt' => [
								'type' => 'varchar',
								'constraint' => 255,
							],

							'name' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'remark' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'tel' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'rounds' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'last_login' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'last_ip' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'class' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0=Owner 1=CEO 2=Operator'
							],
							'creator_id' => [
								'type' => 'int',
								'constraint' => 5,

							],
							'token' => [
								'type' => 'varchar',
								'constraint' => 100,
								'comment' => 'Token สำหรับ Login'
							],

							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0=Close,1=Open'
							],
							'safecode' => [
								'type' => 'varchar',
								'constraint' => 100,
								'comment' => 'รหัสป้องกัน'
							],

							'safetime' => [
								'type' => 'varchar',
								'constraint' => 12,
								'comment' => 'เวลาเข้าใช้ safetime'
							],

							'safestatus' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0ไม่ใช้safe 1ใช่งานsafe'
							],

						];
						$this->createTb($fields, $value, 'id');
						break;

					case 'tb_admin_class':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 5,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'ad_id' => [
								'type' => 'INT',
								'constraint' => 5,

							],

							'ad_class' => [
								'type' => 'text',
							],
							'ad_class' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0close 1open'
							]
						];
						$this->createTb($fields, $value, 'id');
						break;

					case 'tb_admin_rounds':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 5,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'rounds_desc' => [
								'type' => 'varchar',
								'constraint' => 20,

							],

							'time_start' => [
								'type' => 'time',
							],
							'time_end' => [
								'type' => 'time',

							]


						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_admin_rounds (id, rounds_desc, time_start, time_end) VALUES
						(1, 'กะเช้า', '08:00:00', '17:00:00'),
						(2, 'กะบ่าย', '13:00:00', '17:00:00'),
						(3, 'กะค่ำ', '16:30:00', '01:00:00'),
						(4, 'รอบดึก', '00:30:00', '09:00:00');");
						break;








					case 'tb_affiliate_setting':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],


							'f_class' => [
								'type' => 'varchar',
								'constraint' => 10,
								'comment' => 'ชั้นที่ 1'
							],

							's_class' => [
								'type' => 'varchar',
								'constraint' => 10,
								'comment' => 'ชั้นที่ 2'
							],


							't_class' => [
								'type' => 'varchar',
								'constraint' => 10,
								'comment' => 'ชั้นที่ 3'
							],


							'admin_id' => [
								'type' => 'INT',
								'constraint' => 11,
								'comment' => 'ไอดีที่ทำการสร้าง'
							],


							'create_time' => [
								'type' => 'varchar',
								'constraint' => 20,
								'comment' => 'วันเวลาสร้าง'

							],


							'status' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],

						];
						$this->createTb($fields, $value, 'id');
						break;



					case 'tb_alert':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'type' => [
								'type' => 'INT',
								'constraint' => 11,
								'comment' => '1 รายการฝาก'
							],
							'msg' => [
								'type' => 'text',
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'status' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => '0 close 1 open'
							]
						];
						$this->createTb($fields, $value, 'id');
						break;



					case 'tb_announce':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 25,
							],
							'text' => [
								'type' => 'text',
							],
							'img' => [
								'type' => 'text',
							],
							'from_name' => [
								'type' => 'varchar',
								'constraint' => 25,
							],
							'group_id' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
							],

							'status' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => '0 ปิด 1 เปิด'
							]
						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_article':
						$fields = [

							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'topic' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'detail' => [
								'type' => 'varchar',
								'constraint' => 200,
							],

							'img' => [
								'type' => 'varchar',
								'constraint' => 30,
							],
							'category' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => '1 = บาคาร่า , 2 = ฟุตบอล'
							],

							'status' => [
								'type' => 'int',
								'constraint' => 2,
							]

						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_bank':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'bank_en' => [
								'type' => 'varchar',
								'constraint' => 100,
							],

							'bank_th' => [
								'type' => 'varchar',
								'constraint' => 100,
							],

							'bank_short' => [
								'type' => 'varchar',
								'constraint' => 100,
							],

							'api_id' => [
								'type' => 'varchar',
								'constraint' => 5,
							],

						];
						$this->createTb($fields, $value, 'id');
						
						$this->CI->db->query("INSERT INTO tb_bank (id, bank_en, bank_th, bank_short, api_id) VALUES
						(2, 'Kasikorn Bank', 'ธนาคารกสิกรไทย', 'KBANK', '004'),
						(3, 'Bangkok Bank', 'ธนาคารกรุงเทพ', 'BBL', '002'),
						(4, 'Bank of  Ayudhya', 'ธนาคารกรุงศรีอยุธยา', 'BAY', '025'),
						(5, 'Siam Commercial Bank', 'ธนาคารไทยพาณิชย์', 'SCB', '014'),
						(6, 'Krung Thai Bank', 'ธนาคารกรุงไทย', 'KTB', '006'),
						(7, 'Siam City Bank', 'ธนาคารนครหลวงไทย', 'SCIB', '017'),
						(8, 'United Overseas Bank', 'ธนาคารยูโอบี', 'UOB', '024'),
						(9, 'Thai Military Bank', 'ธนาคารทหารไทย', 'TMB', '011'),
						(10, 'Tisco bank', 'ธนาคารทิสโก้', 'TISCO', '067'),
						(11, 'Industrial and Commercial Bank of China (Thai)', 'ธนาคารไอซีบีซี (ไทย)', 'ICBC', '070'),
						(12, 'Kiatnakin Bank', 'ธนาคารเกียรตินาคิน', 'Kiatnakin', '069'),
						(13, 'Thanachart Bank', 'ธนาคารธนชาต', 'TBANK', '065'),
						(14, 'STANDARD CHARTERED BANK (THAI)', 'ธนาคารสแตนดาร์ดชาร์เตอร์ดไทย', 'STANDARD', '020'),
						(15, 'Government Housing Bank', 'ธนาคารอาคารสงเคราะห์', 'GHB', '033'),
						(16, 'Land and House Bank', 'ธนาคารแลนด์ แอนด์ เฮาส์', 'LHBANK', '073'),
						(17, 'Government Savings Bank', 'ธนาคารออมสิน', 'GSB', '030'),
						(18, 'Bank for Agriculture and Agricultural Cooperatives', 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร (ธกส)', 'BAAC', '034'),
						(19, 'Islamic Bank of Thailand', 'ธนาคารอิสลามแห่งประเทศไทย', 'iBank', '066'),
						(20, 'CIMB Thai Bank', 'ธนาคารซีไอเอ็มบีไทย', 'CIMB', '022');");
						break;

					case 'tb_bank_group':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],

							'group_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							]

						];
						$this->createTb($fields, $value, 'id');
						break;

					case 'tb_bank_maintenance':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 10,

							],

							'img' => [
								'type' => 'varchar',
								'constraint' => 50,

							],
							'start_time' => [
								'type' => 'time',


							],
							'end_time' => [
								'type' => 'time',
							],

							'status' => [
								'type' => 'INT',
								'constraint' => 1,
							]
						];
						$this->createTb($fields, $value, 'id');
						break;



					case 'tb_bank_web':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'account' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'bank_id' => [
								'type' => 'INT',
								'constraint' => 10,
							],
							'type' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '1=ฝาก  2=ถอน'
							],

							'account_check' => [
								'type' => 'varchar',
								'constraint' => 6,
							],

							'deviceId' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'ApiRefresh' => [
								'type' => 'varchar',
								'constraint' => 100,
							],

							'user' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'pass' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'pin_app' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0 ปิด 1เปิด 3อัตโนมัติ'
							]

						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_cal_agent':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 10,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'id_sale' => [
								'type' => 'INT',
								'constraint' => 10,
							],

							'percent' => [
								'type' => 'varchar',
								'constraint' => 10,
							],

							'date_create' => [
								'type' => 'varchar',
								'constraint' => 12,
							]
						];
						$this->createTb($fields, $value, 'id');
						break;

					case 'tb_checkin':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 30,
								'comment' => 'ชื่อรายการ'
							],
							'point' => [
								'type' => 'INT',
								'constraint' => 5,

							],
							'spin' => [
								'type' => 'varchar',
								'constraint' => 255,

							],

							'img_check_in' => [
								'type' => 'varchar',
								'constraint' => 100,

							],

							'img_true_check_in' => [
								'type' => 'varchar',
								'constraint' => 100,

							],

							'img_no_check_in' => [
								'type' => 'varchar',
								'constraint' => 100,

							],

							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,

							],

							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'

							]
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_checkin (id, name, point, spin, img_check_in, img_true_check_in, img_no_check_in, create_time, status) VALUES
						(1, 'วันที่1', 10, '0', 't1.png', 'c1.png', 'f1.png', '', 1),
						(2, 'วันที่2', 10, '0', 't2.png', 'c2.png', 'f2.png', '', 1),
						(3, 'วันที่3', 10, '0', 't3.png', 'c3.png', 'f3.png', '', 1),
						(4, 'วันที่4', 10, '0', 't4.png', 'c4.png', 'f4.png', '', 1),
						(5, 'วันที่5', 10, '0', 't5.png', 'c5.png', 'f5.png', '', 1),
						(6, 'วันที่6', 10, '0', 't6.png', 'c6.png', 'f6.png', '', 1),
						(7, 'วันที่7', 10, '0', 't7.png', 'c7.png', 'f7.png', '', 1),
						(8, 'วันที่8', 10, '0', 't8.png', 'c8.png', 'f8.png', '', 1),
						(9, 'วันที่9', 10, '0', 't9.png', 'c9.png', 'f9.png', '', 1),
						(10, 'วันที่10', 10, '0', 't10.png', 'c10.png', 'f10.png', '', 1),
						(11, 'วันที่11', 10, '0', 't11.png', 'c11.png', 'f11.png', '', 1),
						(12, 'วันที่12', 10, '0', 't12.png', 'c12.png', 'f12.png', '', 1),
						(13, 'วันที่13', 10, '0', 't13.png', 'c13.png', 'f13.png', '', 1),
						(14, 'วันที่14', 10, '0', 't14.png', 'c14.png', 'f14.png', '', 1),
						(15, 'วันที่15', 10, '0', 't15.png', 'c15.png', 'f15.png', '', 1),
						(16, 'วันที่16', 10, '0', 't16.png', 'c16.png', 'f16.png', '', 1),
						(17, 'วันที่17', 10, '0', 't17.png', 'c17.png', 'f17.png', '', 1),
						(18, 'วันที่18', 10, '0', 't18.png', 'c18.png', 'f18.png', '', 1),
						(19, 'วันที่19', 10, '0', 't19.png', 'c19.png', 'f19.png', '', 1),
						(20, 'วันที่20', 10, '0', 't20.png', 'c20.png', 'f20.png', '', 1),
						(21, 'วันที่21', 10, '0', 't21.png', 'c21.png', 'f21.png', '', 1),
						(22, 'วันที่22', 10, '0', 't22.png', 'c22.png', 'f22.png', '', 1),
						(23, 'วันที่23', 10, '0', 't23.png', 'c23.png', 'f23.png', '', 1),
						(24, 'วันที่24', 10, '0', 't24.png', 'c24.png', 'f24.png', '', 1),
						(25, 'วันที่25', 10, '0', 't25.png', 'c25.png', 'f25.png', '', 1),
						(26, 'วันที่26', 10, '0', 't26.png', 'c26.png', 'f26.png', '', 1),
						(27, 'วันที่27', 10, '0', 't27.png', 'c27.png', 'f27.png', '', 1),
						(28, 'วันที่28', 10, '0', 't28.png', 'c28.png', 'f28.png', '', 1),
						(29, 'วันที่29', 10, '0', 't29.png', 'c29.png', 'f29.png', '', 1),
						(30, 'วันที่30', 10, '0', 't30.png', 'c30.png', 'f30.png', '', 1),
						(31, 'วันที่31', 10, '0', 't31.png', 'c31.png', 'f31.png', '', 1);");
						break;



					case 'tb_class_admin':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 1,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'admin_id' => [
								'type' => 'INT',
								'constraint' => 5,
							],
							'register' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],
							'deposit' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],
							'withdraw' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],
							'bank_user' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],
							'promotion' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],

							'bank' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],

							'admin' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],
							'user' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],
							'winlose' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],

							'report' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],
							'systems' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],

							'status' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							]

						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_class_admin (id, admin_id, register, deposit, withdraw, bank_user, promotion, bank, admin, user, winlose, report, systems, status) VALUES
						(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);");
						break;


					case 'tb_css':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'css_name' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'css_img' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'css_detail' => [
								'type' => 'text',
							],
							'css_type' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => '1 สไลด์ 2 ภาพสินค้า 3 บทความ  4 โปรโมชั่น  5 ติดต่อ  6ป๊อปอัพขวา'
							],

							'css_link' => [
								'type' => 'varchar',
								'constraint' => 200,
							],

							'css_alt' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'status' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => '0 ปิด  1 เปิด'
							]
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_css (id, css_name, css_img, css_detail, css_type, css_link, css_alt, status) VALUES
						(1, 'IMI36', 'slide1.png', 'สไลด์', 1, 'www.imi911.com', 'www.imi911.com', 1),
						(2, 'IMI36', 'slide2.png', 'สไลด์', 1, 'www.imi911.com', 'www.imi911.com', 1),
						(3, 'IMI789', 'cropper.jpg', 'สไลด์', 2, 'www.imi789.com', 'www.imi789.com', 1),
						(8, 'โปรแรงเเสงทางโค้ง 55', '1590637089.jpg', '<ul>\r\n <li>imi789.com</li>\r\n <li>imi789.com</li>\r\n <li>imi789.com</li>\r\n</ul>\r\n', 4, '', '', 1),
						(9, 'โปรแรงเเสงทางโค้ง', '1590637102.jpg', '<ul>\r\n <li>imi789.com</li>\r\n <li>imi789.com</li>\r\n</ul>\r\n', 4, '', '', 1),
						(10, 'รีวิวจุดเด่นของ MU Online', '1590636907.png', '<p><i><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MU Online</strong></i>&nbsp;เป็นอีกหนึ่งเกมออนไลน์ ที่นักเล่นเกมที่เล่นมามากกว่าสิบปี ต้องเคยได้สัมผัสหรืออย่างน้อยต้องเคยได้ยินชื่อ เพราะเป็นเกมที่เปิดตัวกับผู้ให้บริการมาหลายเจ้า แต่ก็ปิดตัวไปทั้งหมด ล่าสุดเป็น Playpark ที่ได้นำมาเปิดให้บริการอีกครั้ง โดยตัวเกมทีการอัพเดทมากขึ้นกว่าเจ้าเดิมๆ ที่เคยให้บริการมาทั้งหมด</p><p><i><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MU Online</strong></i> เป็นเกมแนว Open world MMORPG ที่ผู้เล่นมีอิสระจะไปสู้กับมอสเตอร์ ที่แมพไหนก็ได้ จะเลือกเล่นตามเควสต์หรือไม่ทำก็ได้ ธีมเกมถูกออกแบบมาในแนว Dark Fantasy ที่มีชุดสวมใส่ที่สวยงามและแบ่งสีของแต่ละอาชีพอย่างชัดเจน ในเกมผู้เล่นสามารถโจมตีกันได้ทันที ยกเว้นในเขตเมือง สำหรับเซิรฟเวอร์ PK แต่ถ้าผู้เล่นเลือกเล่นเซิร์ฟเวอร์ Non-PK จะไม่สามารถโจมตีกันเองได้</p>', 3, '', '', 1),
						(11, 'รีวิวจุดเด่นของ MU Online', '1590568081.png', '<div>\r\n<p>     <strong>MU Online</strong> เป็นอีกหนึ่งเกมออนไลน์ ที่นักเล่นเกมที่เล่นมามากกว่าสิบปี ต้องเคยได้สัมผัสหรืออย่างน้อยต้องเคยได้ยินชื่อ เพราะเป็นเกมที่เปิดตัวกับผู้ให้บริการมาหลายเจ้า แต่ก็ปิดตัวไปทั้งหมด ล่าสุดเป็น Playpark ที่ได้นำมาเปิดให้บริการอีกครั้ง โดยตัวเกมทีการอัพเดทมากขึ้นกว่าเจ้าเดิมๆ ที่เคยให้บริการมาทั้งหมด</p>\r\n\r\n<p>          MU Online เป็นเกมแนว Open world MMORPG ที่ผู้เล่นมีอิสระจะไปสู้กับมอสเตอร์ ที่แมพไหนก็ได้ จะเลือกเล่นตามเควสต์หรือไม่ทำก็ได้ ธีมเกมถูกออกแบบมาในแนว Dark Fantasy ที่มีชุดสวมใส่ที่สวยงามและแบ่งสีของแต่ละอาชีพอย่างชัดเจน ในเกมผู้เล่นสามารถโจมตีกันได้ทันที ยกเว้นในเขตเมือง สำหรับเซิรฟเวอร์ PK แต่ถ้าผู้เล่นเลือกเล่นเซิร์ฟเวอร์ Non-PK จะไม่สามารถโจมตีกันเองได้</p>\r\n\r\n<p>          สำหรับตัวเกมที่ทาง Playpark ได้เปิดให้บริการอยู่ในปัจจุบัน มีการอัพเดทจากเดิมหลายอย่าง ไม่ว่าจะเป็น ระบบเดินแบบออโต้เพียงเลือกเป้าหมายที่จะไป, ระบบรับรางวัลทันทีเมื่อทำเควสต์เสร็จ อีกจุดที่น่าสนใจในการอัพเดทล่าสุด คือมีทุกทาชีพให้เลือกเล่นเท่าเซิร์ฟเวอร์ต่างประเทศในปัจจุบัน และมีอาชีพพิเศษที่ต้องทำการปลดล็อคก่อน</p>\r\n\r\n<p>          MU Online จัดเป็นเกมออนไลน์คลาสสิค ที่มีจุดเด่น ที่แบ่งแยกอาชีพและชุดที่คอสตูมที่โดดเด่น โดยเฉพาะปีก และเป็นเกมออนไลน์ที่มีการเก็บเลเวลที่ยากมากเกมหนึ่ง สร้างความท้าทายให้กับผู้เล่นเป็นอย่างดี สำหรับใครที่เคยได้ลองเล่นแล้วอยากได้บรรยากาศในการเล่นแบบเดิมๆ ไปเล่นกันได้เลย รวมถึงผู้เล่นที่อยากลองว่าเกมสนุกอย่างไร ก็ไม่ควรพลาดเช่นกัน</p>\r\n</div>\r\n', 3, '', 'รีวิวจุดเด่นของ MU Online', 1),
						(12, '@imi36', '1590632520.png', '<ul>\r\n <li>@imi789</li>\r\n <li>08787878787</li>\r\n <li>imi</li>\r\n <li>08787878787</li>\r\n</ul>\r\n', 5, '', '', 1),
						(13, '', 'ปิดปรับปรุง.jpg', '', 99, '', '', 0),
						(14, '555', '1590815011.png', '55', 1, '5555', '5', 0),
						(17, 'ทดสอบ', '1592295923.png', '<div><span xss=removed>0000000000000000000</span></div>\r\n\r\n<div><span xss=removed>000000</span></div>\r\n\r\n<div><span xss=removed>011111111111111111</span></div>\r\n\r\n<div><span xss=removed>0-------------------------</span></div>\r\n\r\n<div><span xss=removed>0.........................</span></div>\r\n\r\n<div><span xss=removed>0000000000000000000</span></div>\r\n\r\n<div><span xss=removed>000000000000000000</span></div>\r\n\r\n<div><span xss=removed>00000000000000000000</span></div>\r\n', 5, '', '', 1);");
						break;


					case 'tb_even':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'user' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'point' => [
								'type' => 'INT',
								'constraint' => 9,

							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
								'default' => 0
							]
						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_event':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'username' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'type_turnover' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0:ไม่ติดเทิร์น 1:กำหนดเทิ่ร์นเอง 2:เทิร์นเป็นเท่า'
							],
							'type_turnover' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'เทิร์น'
							],
							'credit' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'จำนวนเครดิต'
							],
							'point' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'จำนวนพ้อย'
							],
							'time_start' => [
								'type' => 'int',
								'constraint' => 20,

							],

							'time_end' => [
								'type' => 'int',
								'constraint' => 20,

							],
							'day' => [
								'type' => 'int',
								'constraint' => 2,
								'comment' => 'ยอดฝากติดต่อกัน'
							],

							'user' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0:userเก่า 1:userใหม่ 2:userทั้งหมด'
							],
							'user' => [
								'type' => 'varchar',
								'constraint' => 50,
								'comment' => 'gruopที่สามารถเห็นevent'
							],

							'min_credit' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'ขั้นต่ำรับevent'
							],
							'deposit' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'ยอดฝากที่กำหนด'
							],

							'count' => [
								'type' => 'int',
								'constraint' => 15,
								'comment' => 'จำนวนคนรับevent'
							],
							'count_max' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'จำนวนสิททั้งหมด'
							],
							'detail_event' => [
								'type' => 'varchar',
								'constraint' => 255,
								'comment' => 'รายละเอียดevent'
							],
							'link_img' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '1:เปิด 0:ปิด'
							]

						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_exchange':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'id_user' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'point' => [
								'type' => 'int',
								'constraint' => 11,
							],
							'cost' => [
								'type' => 'int',
								'constraint' => 11,
							],
							'type' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 11,
							],
							'admin_id' => [
								'type' => 'int',
								'constraint' => 5,
							],

							'admin_datetime' => [
								'type' => 'varchar',
								'constraint' => 12,
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0 ปิด 1 รอ 2 สำเร็จ'
							],
						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_gift':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'gift_name' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'code' => [
								'type' => 'varchar',
								'constraint' => 10,
								'comment' => 'รหัสสำหรับกดรับจากหน้ายูเซอร์',
							],

							'limit_user' => [
								'type' => 'int',
								'constraint' => 7,
								'comment' => 'จำกัดจำนวนโค้ด',
							],
							'point' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'พ้อยที่เพิ่ม',
							],

							'credit' => [
								'type' => 'int',
								'constraint' => 10,
								'comment' => 'เครดิตที่เพิ่ม',
							],
							'user' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0:เก่า 1:ใหม่ 2:ทั้งหมด',
							],

							'time_start' => [
								'type' => 'int',
								'constraint' => 25,

							],

							'time_end' => [
								'type' => 'int',
								'constraint' => 25,

							],

							'admin' => [
								'type' => 'varchar',
								'constraint' => 20,
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0:ปิด 1:เปิด',
							],
						];
						$this->createTb($fields, $value, 'id');
						break;




					case 'tb_group':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],

							'name' => [
								'type' => 'varchar',
								'constraint' => 20,
							],

							'detail' => [
								'type' => 'text',

							],

							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0:ปิด 1:เปิด',
							]

						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_group (id, name, detail, status) VALUES
						(1, 'ทั่วไป', 'ลูกค้าทั่วไปที่สมัครเข้ามาใหม่', 1),
						(2, 'กสิกรไทย', 'ลูกค้าที่ลงทะเบียน กสิกรไทย', 1),
						(3, 'กรุงเทพ', 'ลูกค้าที่ลงทะเบียน กรุงเทพ', 1),
						(4, 'กรุงศรี', 'ลูกค้าที่ลงทะเบียน กรุงศรี', 1),
						(5, 'ไทยพาณิชย์', 'ลูกค้าที่ลงทะเบียน ไทยพาณิช', 1),
						(6, 'กรุงไทย', 'ธนาคารกรุงไทย', 1),
						(7, 'แบงค์อื่นๆ', 'แบงค์อื่นๆ', 1);");
						break;


					case 'tb_line':
						$fields = [

							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'tel' => [
								'type' => 'varchar',
								'constraint' => 10,
								'comment' => 'เบอร์'
							],
							'line_id' => [
								'type' => 'varchar',
								'constraint' => 100,
								'comment' => 'id ของ line'
							],
							'line_user_id' => [
								'type' => 'text',
							],
							'locale' => [
								'type' => 'varchar',
								'constraint' => 100,
								'default' => 'th',
								'comment' => 'ภาษา'
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
								'comment' => 'เวลาสร้าง'
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							]
						];
						$this->createTb($fields, $value, 'id');
						break;


					case 'tb_linenotify':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'type' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'token' => [
								'type' => 'text',
							],
							'balance' => [
								'type' => 'INT',
								'constraint' => 6,
							],
							'delay' => [
								'type' => 'INT',
								'constraint' => 3,

							],
							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							]
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_linenotify (id, type, token, balance, delay, status) VALUES
						(1, 'register', '-', 0, 0, 1),
						(2, 'deposit', '-', 0, 0, 1),
						(3, 'withdraw', '-', 0, 0, 1),
						(4, 'report_dw', '-', 0, 0, 1),
						(5, 'add_spin', '-', 0, 0, 1),
						(6, 'add_point', '-', 0, 0, 1),
						(7, 'reward', '-', 0, 0, 1),
						(8, 'credit_out', '-', 0, 0, 1),
						(10, 'credit_in', '-', 0, 0, 1),
						(11, 'spin_out', '-', 0, 0, 1),
						(12, 'point_out', '-', 0, 0, 1);");
						break;




					case 'tb_line_quick_text':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'line_text_id' => [
								'type' => 'INT',
								'constraint' => 11,
								'comment' => 'id ของข้อความขาเข้า'

							],


							'type' => [
								'type' => 'varchar',
								'constraint' => 15,
								'default' => 'message',
								'comment' => 'รูปแบบข้อความขาออก'

							],
							'quick_reply' => [
								'type' => 'text',
								'comment' => 'ข้อความค่าออก'
							],

							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							]
						];
						$this->createTb($fields, $value, 'id');
						break;



					case 'tb_line_text':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'message' => [
								'type' => 'text',
							],
							'reply' => [
								'type' => 'text',
							],
							'status' => [
								'type' => 'tinyint',
								'constraint' => 4,
								'default' => '1'
							]
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_line_text (id, message, reply, status) VALUES
						(1, 'สวัสดี', 'สวัสดีครับ', 1),
						(2, 'เติมเงินยังไง', 'สามารถโอนเงินไปในบัญชีฝากของทางเรา หลังจากนั้นประมาณ 1 นาที ระบบจะทำการเพิ่มเครดิตให้กับคุณครับ', 1);");
						break;



					case 'tb_login':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],


							'username' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'agent' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'password' => [
								'type' => 'varchar',
								'constraint' => 255,
							],
							'salt' => [
								'type' => 'varchar',
								'constraint' => 255,
							],
							'name' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'remark' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'tel' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'rounds' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'last_login' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'last_ip' => [
								'type' => 'varchar',
								'constraint' => 15,
							],
							'class' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0=Owner 1=CEO 2=Operator'
							],
							'creator_id' => [
								'type' => 'int',
								'constraint' => 5,
							],

							'token' => [
								'type' => 'varchar',
								'constraint' => 100,
								'comment' => 'Token สำหรับ Login'
							],
							'status' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0=Close,1=Open'
							],
							'status_login' => [
								'type' => 'int',
								'constraint' => 11,
								'comment' => '1เข้าระบบ 0 ออกระบบ'
							],
							'safecode' => [
								'type' => 'varchar',
								'constraint' => 4,
								'comment' => 'รหัสป้องกัน'
							],
							'safetime' => [
								'type' => 'varchar',
								'constraint' => 12,
								'comment' => 'เวลาเข้าใช้ safetime'
							],

							'safestatus' => [
								'type' => 'int',
								'constraint' => 1,
								'comment' => '0ไม่ใช้safe 1ใช่งานsafe'
							],
							'two_factor' => [
								'type' => 'longtext',

							],
						];
						$this->createTb($fields, $value, 'id');
						$this->CI->db->query("INSERT INTO tb_login (id, username, agent, password, salt, name, remark, tel, rounds, last_login, last_ip, class, creator_id, token, status, status_login, safecode, safetime, safestatus, two_factor) VALUES
						(1, 'bcz2@dd', 'bcz2', '68c4054c0e3d90f664641a5e36baa432cc87b0a5', '.dtBE4g5dhxwb90BwMhwI.', 'mp', 'พนักงานใหญ่สุด', '-', '1', '1615434392', '192.168.40.235', 0, 1, 'e1fdf91f1fc21cbd8979b65391aa7cb4bfc2df81f46699d5ea', 1, 1, '', '', 0, '{\"key\":\"\",\"linkQr\":\"\",\"status\":\"off\"}');");
						break;

					case 'tb_manual':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE
							],
							'menu' => [
								'type' => 'varchar',
								'constraint' => 50,
							],
							'last_update' => [
								'type' => 'varchar',
								'constraint' => 50,
							],

							'detail' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'link' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 11,
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
						case 'tb_option_report':
							$fields = [
								'id' => [
									'type' => 'INT',
									'constraint' => 11,
									'unsigned' => TRUE,
									'auto_increment' => TRUE
								],
								'option' => [
									'type' => 'text',
	
								],
								'createdAt' => [
									'type' => 'text',
	
								],
	
								'updatedAt' => [
									'type' => 'text',
	
								],
								'status' => [
									'type' => 'INT',
									'constraint' => 1,
									'comment' => '0 ปิด 1 เปิด'
								],
	
							];
							$this->createTb($fields, $value, 'id');
							$this->CI->db->query("INSERT INTO tb_option_report (id, option, createdAt, updatedAt, status) VALUES
							(1, 'ฝาก - ถอน', '', '', 1),
							(2, 'เมนูเกมส์', '', '', 1),
							(3, 'ทางเข้าเล่น', '', '', 1),
							(4, 'เเลกรางวัล', '', '', 1),
							(5, 'อื่นๆ', '', '', 1);");
							break;
					case 'tb_otp':
						$fields = [
							'id' => [
								'type' => 'INT',
								'constraint' => 11,
								'unsigned' => TRUE,
								'auto_increment' => TRUE,
								'comment' => 'รหัส(ชั่งหัวมัน)'
							],
							'tel' => [
								'type' => 'varchar',
								'constraint' => 10,
							],
							'line_id' => [
								'type' => 'varchar',
								'constraint' => 100,
							],
							'ref' => [
								'type' => 'varchar',
								'constraint' => 4,
								'comment' => 'OTP'
							],
							'otp' => [
								'type' => 'varchar',
								'constraint' => 6,
								'comment' => 'OTP'
							],
							'create_time' => [
								'type' => 'varchar',
								'constraint' => 12,
								'comment' => 'หมดเวลา 5 นาที'
							],
							'status' => [
								'type' => 'INT',
								'constraint' => 1,
								'comment' => '0 ปิด 1 เปิด'
							],

						];
						$this->createTb($fields, $value, 'id');
						break;
				}
			}
		}
	}



	public function createTb($fields, $table, $primarykey)
	{

		$this->myforge->dbforge->add_field($fields);
		$this->myforge->dbforge->add_key($primarykey, TRUE);
		$this->myforge->dbforge->create_table($table);
	}
}

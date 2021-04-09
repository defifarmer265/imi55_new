<?php

$access_q = $this->db->where('admin_id', $this->session->admin['id'])->get('tb_class_admin');
$access_r = $access_q->row();
 if($this->session->admin['id'] ==""){
    redirect('backend/home');
 }
 

?>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu mt-4">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <?php if ($access_r->deposit == 1) { ?>
                <input type="hidden" value="" id="dep_alert">
                <input type="hidden" value="<?= $this->session->dp_alert ?>" id="depalert">
                <input type="hidden" value="<?= $this->session->dep_alert ?>" id="dp_alert">
                <li><a href="<?= base_url('backend/deposit'); ?>"><i class="fa fa-money"></i> รายการ ฝาก <span class="badge bg-red" style="font-size: 1em;" id="alert_dep"></span> </a> </li>
            <?php } ?>
            <?php if ($access_r->withdraw == 1) { ?>
                <li><a href="<?= base_url('backend/wd'); ?>"><i class="fa fa-money"></i> รายการ ถอน <span class="badge bg-red" style="font-size: 1em;" id="alert_wit"></span> </a> </li>
            <?php } ?>


            <?php if ($access_r->user == 1) { ?>
                <li><a><i class="fa fa-users"></i>สมาชิก <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('backend/user/user_detail'); ?>">ค้นหาสมาชิก</a></li>
                        <li><a href="<?= base_url('backend/user/user_account'); ?>">ค้นหาสมาชิกจากเลขบัญชี</a></li>
                        <li><a href="<?= base_url('backend/user/user_new'); ?>">สมาชิกใหม่</a></li>
                        <li><a href="<?= base_url('backend/user'); ?>">สมาชิกทั้งหมด</a></li>
                        <li><a href="<?= base_url('backend/group'); ?>">กลุ่ม</a></li>
                        <!--          <li><a href="<?= base_url('backend/user/user_bank'); ?>">Bank User  <span class="badge bg-red" style="font-size: 1em;">1</span></a></li>-->
                    </ul>
                </li>
            <?php } ?>



            <?php if ($access_r->bank == 1) { ?>
                <li><a><i class="fa fa-bank"></i>ธนาคาร <span class="fa fa-chevron-down"></span> </a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('backend/bank'); ?>">รายการ</a></li>
                        <?php if ($this->session->users['class'] <= 1) { ?>
                            <li><a href="<?= base_url('backend/bank/bank_setting'); ?>">ตั้งค่า</a></li>
                            <li><a href="<?= base_url('backend/bank/bank_setWD'); ?>">กำหนดถอน</a></li>
                        <?php } ?>
                        <?php if ($this->session->users['class'] == 0) { ?>
                            <li><a href="<?= base_url('backend/bank/bank_auto'); ?>">อัตโนมัติ</a></li>
                        <?php } ?>
                        <li><a href="<?= base_url('backend/rebank'); ?>">รีแบงค์</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($access_r->report == 1) { ?>

            <li><a><i class="fa fa-file"></i>ข้อมูลย้อนหลัง<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('backend/history/history_transaction'); ?>">ข้อมูล ธนาคารออโต้</a></li>
                    <li><a href="<?= base_url('backend/history/history_addcredit'); ?>">ข้อมูล แอดเครดิต</a></li>
                    <li><a href="<?= base_url('backend/history/history_state'); ?>">ข้อมูล ฝาก/ถอน ตัดเที่ยงคืน</a></li>
                    <li><a href="<?= base_url('backend/history_test/history_state'); ?>">ข้อมูล ฝาก/ถอน ตัดสิบเอ็ดโมงเช้า</a></li>
                    <li><a href="<?= base_url('backend/ticked'); ?>">ข้อมูล การเดิมพัน</a></li>
                    <li><a href="<?= base_url('backend/ticked/ticket_vendor'); ?>">ข้อมูล ประวัติการเล่นรวม</a></li>
                    <li><a href="<?= base_url('backend/ticked/turn_vendor'); ?>">ข้อมูล ประวัติการเล่นรวมตาม vendors</a>
                    </li>
                    <li><a href="<?= base_url('backend/history_login'); ?>">ข้อมูล การเข้าสู่ระบบ</a></li>
                </ul>
            </li>
            <?php }?>

            <?php if ($access_r->promotion == 1) { ?>
                <li><a><i class="fa fa-gamepad"></i>คะแนน <span class="badge bg-red" id="alert_exchange" style="font-size: 1em;"></span> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('backend/games'); ?>">สมาชิก</a></li>
                        <li><a href="<?= base_url('backend/games/spin'); ?>">เกมส์หมุน </a></li>
                        <li id="alert_exchange"><a href="<?= base_url('backend/games/reward'); ?>">แลกรางวัล</a></li>
                        <li><a href="<?= base_url('backend/games/checkin'); ?>">ตั้งค่า</a> <span class="badge bg-red" id="alert_exchange" style="font-size: 1em;"></span></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($access_r->admin == 1) { ?>

                <li><a><i class="fa fa-bug"></i>พนักงาน<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('backend/admin'); ?>">รายการ</a></li>
                        <li><a href="<?= base_url('backend/owner'); ?>">เพิ่มบัญชีผู้ใช้เข้า Owner</a></li>
                        <li><a href="<?= base_url('backend/safe_code'); ?>">Safe Code</a></li>
                        <li><a href="<?= base_url('backend/rounds'); ?>">Rounds</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($access_r->promotion == 1) { ?>

                <li><a><i class="fa fa-motorcycle"></i>Affiliate <span class="badge bg-red" style="font-size: 1em;" id="alert_aff1"></span><span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('backend/affiliate/statement'); ?>">รายการ Affiliate</a></li>
                        <li><a href="<?= base_url('backend/affiliate/af_confirm'); ?>">รายการปันผล <span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                        <li><a href="<?= base_url('backend/affiliate/af_request'); ?>">รายการร้องขอ <span class="badge bg-red" style="font-size: 1em;" id="alert_aff"></span> </a></li>
                        <li><a href="<?= base_url('backend/affiliate/AfSetting'); ?>">ตั้งค่า Affiliate <span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                        <li><a href="<?= base_url('backend/affiliate/aff_log'); ?>">Log คำนวณปันผล Affiliate</a></li>
                    </ul>
                </li>

            <?php } ?>

            
            <?php if ($access_r->promotion == 1) { ?>
            <li><a href="<?= base_url('backend/ranking'); ?>"><i class="fa fa-cog"></i>Ranking</a></li>


           
            <li><a><i class="fa fa-gift"></i>Gift Voucher<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('backend/gift/gift'); ?>">สร้าง Gift<span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                    <li><a href="<?= base_url('backend/gift/gift_give'); ?>">ให้ Gift Voucher<span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                    <li><a href="<?= base_url('backend/gift/gift_report'); ?>">รายงาน Gift Voucher<span class="badge bg-red" style="font-size: 1em;"></span> </a>
                    </li>
                </ul>
            </li>
            <?php }?>


            <?php if ($access_r->promotion == 1) { ?>
            <li><a><i class="fa fa-gift"></i>Promotion<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('backend/setpromo'); ?>">สร้าง Promotion<span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                    <li><a href="<?= base_url('backend/setpromo/report_promo'); ?>">รายงาน Promotion<span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-gift"></i>Event<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('backend/events_back'); ?>">สร้าง Event<span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                    <li><a href="<?= base_url('backend/events_back/report'); ?>">รายงาน Event<span class="badge bg-red" style="font-size: 1em;"></span> </a></li>
                </ul>
            </li>
            <?php } ?>

            <?php if ($access_r->report == 1) { ?>
            <li><a><i class="fa fa-cog"></i>Log <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('backend/history/log_transfer'); ?>">log เพิ่มลดเครดิต</a></li>
                    <li><a href="<?= base_url('backend/history/history_score'); ?>">log เพิ่มลดPoint</a></li>
                    <li><a href="<?= base_url('backend/history/history_spin'); ?>">log เพิ่มลดSpin</a></li>
                    <li><a href="<?= base_url('backend/history/history_gift'); ?>">log รับGift Voucher</a></li>
                    <li><a href="<?= base_url('backend/turnover/log_turntopoint'); ?>">log ระบบให้ point</a></li>
                    <li><a href="<?= base_url('backend/history/history_bankuser'); ?>">log แก้ไขแบงค์</a></li>
                    <li><a href="<?= base_url('backend/search_ip/search'); ?>">log การเข้าสู่ระบบ</a></li>
                    <li><a href="<?= base_url('backend/history/history_safecode'); ?>">log Safecode</a></li>
                    <li><a href="<?= base_url('backend/history/history_logpass'); ?>">log Password</a></li>
                    <li><a href="<?= base_url('backend/log_all/all_log'); ?>">log All</a></li>
                </ul>
            </li>
            <?php }?>

            <?php if ($access_r->user == 1) { ?>

                <li><a><i class="fa fa-cog"></i>เทิร์น<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?= base_url('backend/turnover/ReportTurnover'); ?>">เช็คยอดเทิร์นตามยูสเซอร์</a></li>
                        <li><a href="<?= base_url('backend/turnover/setturnover'); ?>">ตั้งค่าเทิร์น</a></li>

                    </ul>
                </li>
                <li><a href="<?= base_url('backend/otp'); ?>"><i class="fa fa-cog"></i>OTP</a></li>
                <li><a><i class="fa fa-comments-o" aria-hidden="true"></i>LINEBOT<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?= base_url('backend/user_linebot'); ?>">สมาชิกทั้งหมด</a></li>
                        <li><a href="<?= base_url('backend/log_line'); ?>">จำนวนการเข้าสุ่ระบบ</a></li>
                        <li><a href="<?= base_url('backend/dw_linebot'); ?>">รายงาน ฝาก - ถอน</a></li>
                        <li><a href="<?= base_url('backend/custom_reply'); ?>">Custom reply</a></li>
                        <li><a href="<?= base_url('backend/push_message'); ?>">Push message</a></li>
                      </ul>
                    </li>
                    <li><a href="<?= base_url('backend/setting_linebot'); ?>"><i class="fa fa-cog"></i>ตั้งค่า LINEBOT</a></li>
                <li><a href="<?php echo base_url('backend/maintenance/index'); ?>"><i class="fa fa-cog"></i>ประกาศปิดปรับปรุงระบบ </a> </li>
            <?php } ?>


            <?php if ($access_r->report == 1) { ?>
            <li><a><i class="fa fa-cube"></i>แลกสินค้าIMIMALL<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('backend/Pd_list'); ?>"><i class="fa fa-bars"></i>รายการสั่งสินค้า</a>
                    </li>
                    <li><a href="<?= base_url('backend/Pd_list/report'); ?>"><i class="fa fa-clone"></i>รายงานการแลกสินค้า</a></li>
                </ul>
            </li>
            <li> <a><i class="fa fa-clone"></i>รายงาน คะแนน<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?= base_url('backend/award'); ?>">รายงาน เเลกรางวัล</a></li>
            <li><a href="<?= base_url('backend/award/report_spin'); ?>">รายงาน วงล้อ</a></li>
          </ul>
        </li>


        <li> <a><i class="fa fa-clone"></i>รายงาน รายวัน<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?= base_url('backend/report_award/report_aw'); ?>">รายงาน เเลกรางวัล</a></li>
            <li><a href="<?= base_url('backend/report_award/rs_s_c'); ?>">รายงาน  วงล้อ </a></li>
            <li><a href="<?= base_url('backend/report_award/rs_c_m'); ?>">รายงาน  เครดิตปรับมือ </a></li>
            <li><a href="<?= base_url('backend/report_award/view_turn'); ?>">รายงาน  เทิร์น </a></li>
            <li><a href="<?= base_url('backend/report_award/call_af'); ?>">รายงาน  กดรับ Affiliate </a></li>
            <li><a href="<?= base_url('backend/report_award/report_aw_dw'); ?>">รายงาน  ฝาก ถอน </a></li>
            <li><a href="<?= base_url('backend/report_award/report_result'); ?>">รายงาน  รวม </a></li>
          </ul>
        </li>
        <?php }?>



            <hr>
            <br>
            <li><a><i class="fa fa-support"></i>ช่วยเหลือ<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="https://www.youtube.com/watch?v=IPGPiK4hENU" target="_blank"><i class="fa fa-file"></i>
                            คู่มือการใช้งานเบื้องต้น</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings"> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen"> <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock"> <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>

<!-- top navigation -->

<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a> </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">

                <?php if ($this->uri->segment(2) != 'truewallet') { ?>
                    <li class="nav-item dropdown open" style="padding-left: 15px;"> <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"> <img src="<?php echo base_url() ?>public/tem_admin1/images/img.jpg" alt="">
                            <?php // echo $this->session->users['username']; ?> 51d96816sd1f64
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown"> <a class="dropdown-item" href="<?= base_url('backend/profile_admin'); ?>"> Profile</a><a class="dropdown-item" onclick="return confirm('คุณแน่ใจว่าต้องการออกจากระบบ!')" href="<?php echo base_url('backend/logout'); ?>"><i class="fa fa-sign-out pull-right"></i>
                                Log Out</a> </div>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>



</script>

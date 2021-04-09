<!-- menu -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<?php
$owner_id = $this->session->owner->id;
$access_q = $this->db->where('id', $owner_id)->get('tb_owner');
$access_r = $access_q->row();

?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url() ?>" class="site_title"><i class="fa fa-home"></i>
                <span><?= $this->getapi_model->nameweb() ?></span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo base_url() ?>public/tem_frontend/img/logo.png"
                    alt="<?= $this->getapi_model->nameweb() ?>" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= $this->session->owner->username ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>เมนู</h3>
                <ul class="nav side-menu">


                    <li><a href="<?= base_url() ?>owner/home/dashboard"><i class="fa fa-tachometer"></i>แดชบอร์ด</a>
                    </li>
                    <li><a><i class="fa fa-line-chart"></i>ข้อมูลกราฟ <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <!-- <li><a href="<?= base_url('owner/chart/s_chart'); ?>" style="font-size:14px;"><i class="fa fa-line-chart" ></i> ค้นหากราฟ ช่วงเวลา</a> </li> -->
                            <li><a href="<?= base_url('owner/home/charttoday'); ?>" style="font-size:14px;"><i
                                        class="fa fa-line-chart"></i> กราฟฝาก ถอนรายวัน</a> </li>
                            <li><a href="<?= base_url('owner/home/chart'); ?>" style="font-size:14px;"><i
                                        class="fa fa-line-chart"></i> กราฟฝาก ถอนรายเดือน </a> </li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-user"></i>สมาชิก <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('owner/user/user_detail'); ?>">ค้นหาลูกค้า รหัส/เบอร์</a></li>
                            <li><a href="<?= base_url('owner/user/user_account'); ?>">ค้นหาจาก บัญชี/ชื่อ</a></li>
                            <li><a href="<?= base_url('owner/user/user_new'); ?>">รายชื่อลูกค้าใหม่</a></li>
                            <li><a href="<?= base_url('owner/user'); ?>">รายชื่อลูกค้าทั้งหมด</a></li>
                            <li><a href="<?= base_url('owner/group'); ?>">กลุ่มลูกค้า</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-users"></i>เซลล์<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url(); ?>owner/sale/home">รายชื่อเซลล์</a></li>
                            <li><a href="<?= base_url(); ?>owner/sale_pay">รายงานเซลล์รวมเทิน</a></li>
                            <li><a href="<?= base_url(); ?>owner/sale_dps/home">ระบบคำนวณ</a></li>
                            <li><a href="<?= base_url(); ?>owner/sale/rp_sale">รายงานเซลล์ยอดแรก</a></li>
                            <li><a href="<?= base_url(); ?>owner/sale/setting">ตั้งค่า</a></li>
                        </ul>
                    </li>


                    <li><a><i class="fa fa-users"></i>พนักงาน<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('owner/admin'); ?>">Backend</a></li>
                            <li><a href="<?= base_url(); ?>owner/home/owner_list">Owner</a></li>
                            <li><a href="<?= base_url(); ?>owner/safe_code">Safecode</a></li>
                        </ul>
                    </li>



                    <li><a><i class="fa fa-bank"></i>ธนาคาร <span class="fa fa-chevron-down"></span> </a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('owner/bank'); ?>">รายการ</a></li>
                            <li><a href="<?= base_url('owner/bank/bank_setting'); ?>">ตั้งค่า</a></li>
                            <li><a href="<?= base_url('owner/bank/bank_setWD'); ?>">กำหนดถอน</a></li>
                            <li><a href="<?= base_url('owner/bank/bank_auto'); ?>">อัตโนมัติ</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= base_url('owner/line_notify'); ?>"><i class="fa fa-bell"></i> Line Notify </a>
                    </li>


                    <li><a><i class="fa fa-clone"></i>รายงาน <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url() ?>owner/report/report_payment">ระบบออโต้</a></li>
                            <li><a href="<?= base_url() ?>owner/report/report_deposit_all">รายงาน ฝาก-ถอน</a></li>
                            <li><a href="<?= base_url() ?>owner/report_period">รายงาน ฝาก-ถอน
                                    ช่วงจำนวนเงิน</a></li>
                            <li><a href="<?= base_url() ?>owner/report_time_period/time_period">รายงาน ฝาก ช่วงเวลา</a>
                            </li>
                            <li><a href="<?= base_url() ?>owner/report_time_period_wt/time_period_wt">รายงาน ถอน
                                    ช่วงเวลา</a>
                            <li><a href="<?= base_url() ?>owner/report_daily/report_deposit_withdraw_daily">รายงาน
                                    ฝาก-ถอน รายวัน</a>
                            </li>


                            <li><a href="<?= base_url() ?>owner/report/report_reset_turn">รายงาน
                                    ตัดเทิร์น</a>
                            </li>


                        </ul>
                    </li>

                    <li><a><i class="fa fa-file"></i>ข้อมูลย้อนหลัง<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url('owner/history_login'); ?>">ข้อมูล ลูกค้า</a></li>

                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-lock"></i>การกระทำ LOG<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <li><a href="<?= base_url('owner/log_all/all_log'); ?>">Log All</a></li>
                    </li>
                </ul>
                </li>



                <li><a href="<?php echo base_url('owner/close_web/index'); ?>"><i
                            class="fa fa-cog"></i>ปิดเข้าใช้งานระบบ </a> </li>










                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <!-- <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div> -->
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a> </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">

                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url() ?>public/tem_admin1/images/img.jpg"
                            alt=""><?php echo  $this->session->owner->name ?>
                        <i class="fa fa-cogs m-2"></i></a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url('owner/home/profile'); ?>"> โปรไฟล์</a>
                        <a class="dropdown-item" onclick="return confirm('คุณแน่ใจว่าต้องการออกจากระบบ!')"
                            href="<?php echo base_url('owner/home/logout'); ?>">
                            <i class="fa fa-sign-out pull-right"></i> ออกจากระบบ</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
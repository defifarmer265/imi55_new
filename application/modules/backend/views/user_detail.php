<link href="<?php echo base_url() ?>public/tem_admin/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<style>
#cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    display: none;
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
    }

    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

#cover-spin::after {
    content: '';
    display: block;
    position: absolute;
    left: 48%;
    top: 40%;
    width: 40px;
    height: 40px;
    border-style: solid;
    border-color: black;
    border-top-color: transparent;
    border-width: 4px;
    border-radius: 50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}

.lds-dual-ring {}

.lds-dual-ring:after {
    content: " ";
    display: block;
    width: 30px;
    height: 30px;
    padding-bottom: -20px;
    border-radius: 50%;
    border: 6px solid #000;
    border-color: #000 transparent #000 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
}

@keyframes lds-dual-ring {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
<div id="cover-spin"></div>
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css"
    rel="stylesheet">
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>ระบบค้นหา</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <div class="col-sm-10"> ID : ใส่แค่ตัวเลข 6 หลักหลัง <?= $this->getapi_model->agent(); ?>
                                Ex: 007805
                                <input type="text" value="" class="form-control" id="s_user" maxlength="6"
                                    placeholder="รหัสลูกค้า">

                            </div>
                            <div class="col-sm-2"><br>
                                <button onClick="select_user(1)" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10"> Tel : ใส่แค่ตัวเลข 10 หลัก Ex: 0929874561
                                <input type="text" value="" class="form-control" id="t_user" maxlength="10"
                                    placeholder="เบอร์โทรลูกค้า">
                            </div>
                            <div class="col-sm-2"><br>
                                <button onClick="select_user(2)" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10"> Account : ใส่เลขบัญชีลูกค้า Ex: 1647852345
                                <input type="text" value="" class="form-control" id="user_acc"
                                    placeholder="เลขบัญชีลูกค้า">
                            </div>
                            <div class="col-sm-2"><br>
                                <button onClick="select_user(4)" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10"> Name : ใส่ชื่อลูกค้า Ex: ทดสอบ
                                <input type="text" value="" class="form-control" id="user_name"
                                    placeholder="ชื่อลูกค้า">
                            </div>
                            <div class="col-sm-2"><br>
                                <button onClick="select_user(3)" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_panel" style="display: none;" id="tap_sale">
                    <div class="x_title">
                        <h2>ระบบเซลล์</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <div class="col-md-3 form-group p-2 h6 ">
                                <span class="">ผู้แนะนำ</span>

                            </div>
                            <div class="col-md-9 ">
                                <input type="text" class="form-control has-feedback text-center" readonly value=""
                                    id="sale_name">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>

                            </div>
                            <?php if ($this->session->users['class'] == 0) { ?>
                            <div class="col-md-3 ">
                                <button class="btn btn-outline-info" data-toggle="modal" data-target="#m_salename"
                                    onClick="salename()">
                                    <i class="fa fa-cog"> แก้ไข</i>
                                </button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>

                <div class="x_panel" style="display: none;" id="tap_log">
                    <div class="x_title">
                        <h2>การเข้าสู่ระบบ
                            <small class="text-danger">ย้อนหลัง7วัน</small>
                        </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <div class="col-md-12 form-group text-center">
                                <button type="button" class="btn btn-outline-primary btn-block" onclick="showlog();"> <i
                                        class="fa fa-file-o"> รายละเอียด</i></button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-md-4" style="display: none;" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>สมาชิก</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">รหัสระบบ</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="user">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">รหัสเข้าเล่น</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="username">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            <span class="fa fa-pencil form-control-feedback right text-primary" aria-hidden="true"
                                style="cursor: pointer;" onClick="$('#m_editUsername').modal();"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">ชื่อสมาชิก</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="name">
                            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
                            <span class="fa fa-pencil form-control-feedback right text-primary" aria-hidden="true"
                                style="cursor: pointer;" onClick="$('#m_editUser').modal();"></span>
                        </div>


                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 h6">
                            <span class="">ยอดเทิร์น 7 วัน</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="stakeMoney">

                            <span class="form-control-feedback left " aria-hidden="true">Turn</span>

                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 h6">
                            <span>กลุ่มลูกค้า</span>
                        </div>
                        <div class="col-md-9">
                            <div id="group_user"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">ฝากของวันนี้</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="total_deposit">
                            <span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">ยอดเครดิต</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="credit">
                            <?php if ($this->session->users['class'] == 0 || $this->session->users['class'] == 1) { ?>
                            <span style="cursor: pointer;"
                                class="fa fa-arrow-down form-control-feedback left text-danger" aria-hidden="true"
                                onClick="down_money()"></span>
                            <span style="cursor: pointer;"
                                class="fa fa-arrow-up form-control-feedback right text-success" aria-hidden="true"
                                onClick="up_money()"></span>
                            <?php } else {
							} ?>
                        </div>

                    </div>
                    <div class="ln_solid"></div>

                    <div class="form-group row">

                        <div class="col-md-12 form-group has-feedback">
                            <button class="btn btn-outline-info" onClick="$('#m_editpass').modal();">
                                <i class="fa fa-key"> รีรหัส</i>
                            </button>
                            <button class="btn btn-outline-info" onClick="$('#m_edit_group').modal();">
                                <i class="fa fa-users"> แก้ไขกลุ่ม</i>
                            </button>
                            <button id="status1" style="display: none;" onClick="closeuser('2')"
                                class="btn btn-outline-success">
                                <i class="fa fa-check"> เปิด</i>
                            </button>
                            <button id="status2" style="display: none;" onClick="closeuser('1')"
                                class="btn btn-outline-danger">
                                <i class="fa fa-check"> ปิด</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4" style="display: none;" id="tap_member_error">
            <div class="x_panel">
                <div class="x_title">
                    <h2>สมาชิก</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">รหัสระบบ</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="user_error">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">รหัสเข้าเล่น</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="username_error">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">ชื่อสมาชิก</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="name_error">
                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 h6">
                            <span>กลุ่มลูกค้า</span>
                        </div>
                        <div class="col-md-9">
                            <div id="group_user_error"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 form-group text-right p-2 h6 ">
                            <span class="">ยอดเครดิต</span>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control has-feedback text-center" readonly value=""
                                id="credit_error">
                        </div>

                    </div>
                    <div class="ln_solid"></div>

                    <div class="form-group row">
                        <div class="col-md-12 form-group has-feedback">
                            <button class="btn btn-outline-info" id='userid_error' name='userid_error'
                                onClick="del_user()">
                                <i class="fa fa-bin"> ลบยูสเซอร์</i>
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-4" style="display: none;" id="tap_bank">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>ธนาคาร</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">

                                <div class="col-9">
                                    <input type="text" class="form-control has-feedback-left" readonly value=""
                                        id="bank">
                                    <span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-2">
                                    <img id="img_bank" src="" width="90%">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input type="text" class="form-control has-feedback-left" readonly value=""
                                        id="account">
                                    <span class="fa fa-exchange  form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-3 ">
                                    <button class="btn btn-outline-info" onClick="$('#m_edit_bank').modal();">
                                        <i class="fa fa-cog"> แก้ไข</i>
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>เกมส์</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">
                                <div class="col-md-3 form-group text-right p-2 h6">
                                    <span class="">คะแนน</span>
                                </div>
                                <div class="col-md-6 form-group ">
                                    <input type="text" class="form-control has-feedback text-center" readonly value=""
                                        id="point">
                                    <?php if ($this->session->users['class'] == 0 || $this->session->users['class'] == 0) { ?>
                                    <span style="cursor: pointer;"
                                        class="fa fa-arrow-down form-control-feedback left text-danger"
                                        aria-hidden="true" onClick="down_point()"></span>
                                    <span style="cursor: pointer;"
                                        class="fa fa-arrow-up form-control-feedback right text-success"
                                        aria-hidden="true" onClick="up_point()"></span>
                                    <?php } else {
									} ?>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 form-group text-right p-2 h6">

                                    <span>หมุนวงล้อ</span>
                                </div>
                                <div class="col-md-6 form-group ">
                                    <input type="text" class="form-control has-feedback text-center" readonly value=""
                                        id="spin">
                                    <?php if ($this->session->users['class'] == 0 || $this->session->users['class'] == 0) { ?>
                                    <span style="cursor: pointer;"
                                        class="fa fa-arrow-down form-control-feedback left text-danger"
                                        aria-hidden="true" onClick="down_spin()"></span>
                                    <span style="cursor: pointer;"
                                        class="fa fa-arrow-up form-control-feedback right text-success"
                                        aria-hidden="true" onClick="up_spin()"></span>
                                    <?php } else {
									} ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12" id="tap_turn" style="display: none;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>ยอดเทิร์น</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">
                                <div class="col-md-3 form-group p-2 h6 ">
                                    <span class="">ยอดเทิร์น</span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control has-feedback text-center" readonly
                                        id="turnover">
                                    <span style="cursor: pointer;"
                                        class="fa fa-arrow-down form-control-feedback left text-danger"
                                        aria-hidden="true" onClick="reset_turn()"></span>
                                    <span style="cursor: pointer;"
                                        class="fa fa-arrow-up form-control-feedback right text-success"
                                        aria-hidden="true" onClick="add_turn()"></span>
                                </div>
                            </div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">
                                <div class="col-md-3 form-group p-2 h6">
                                    <span class="">ตั้งแต่วันที่</span>
                                </div>
                                <div class="col-md-6 form-group ">
                                    <input type="text" class="form-control has-feedback text-center" id="date_turn"
                                        readonly>
                                    <span class="fa fa-calendar form-control-feedback left " aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4" style="display: none;" id="tap_bank_error">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>ธนาคาร</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">

                                <div class="col-9">
                                    <input type="text" class="form-control has-feedback-left" readonly value=""
                                        id="bank_error">
                                    <span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-2">
                                    <img id="img_bank_error" src="" width="90%">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input type="text" class="form-control has-feedback-left" readonly value=""
                                        id="account_error">
                                    <span class="fa fa-exchange  form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>เกมส์</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">
                                <div class="col-md-3 form-group text-right p-2 h6">
                                    <span class="">คะแนน</span>
                                </div>
                                <div class="col-md-6 form-group ">
                                    <input type="text" class="form-control has-feedback text-center" readonly value=""
                                        id="point_error">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 form-group text-right p-2 h6">

                                    <span>หมุนวงล้อ</span>
                                </div>
                                <div class="col-md-6 form-group ">
                                    <input type="text" class="form-control has-feedback text-center" readonly value=""
                                        id="spin_error">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table style="display: none;" id="tb_user"
                    class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0"
                    width="100%" id="t_all">
                    <thead style="background-color: #2a3f54;color: #fff;">
                        <tr>
                            <th>No</th>
                            <th>รหัส</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>เลขที่บัญชี</th>
                            <th>ธนาคารลูกค้า</th>
                            <th>เบอร์โทรลูกค้า</th>
                            <th>ข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody id="bodyhistory"> </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ข้อมูลสมาชิก</h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-6" id="tap_member">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>สมาชิก</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="form-group row">
                                    <div class="col-md-3 form-group text-right p-2 h6 ">
                                        <span class="">รหัสระบบ</span>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input type="text" class="form-control has-feedback text-center" readonly
                                            id="muser">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 form-group text-right p-2 h6 ">
                                        <span class="">รหัสเข้าเล่น</span>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input type="text" class="form-control has-feedback text-center" readonly
                                            value="" id="musername">
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 form-group text-right p-2 h6 ">
                                        <span class="">ชื่อสมาชิก</span>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input type="text" class="form-control has-feedback text-center" readonly
                                            value="" id="mname">
                                        <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>

                                    </div>


                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 form-group text-right p-2 h6 h6">
                                        <span>กลุ่มลูกค้า</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div id="mgroup_user"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 form-group text-right p-2 h6 ">
                                        <span class="">ยอดเครดิต</span>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input type="text" class="form-control has-feedback text-center" readonly
                                            value="" id="mcredit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-md-12" id="tap_bank">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>ธนาคาร</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="form-group row">

                                            <div class="col-md-9">
                                                <input type="text" class="form-control has-feedback-left" readonly
                                                    value="" id="mbank">
                                                <span class="fa fa-bank form-control-feedback left"
                                                    aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-2">
                                                <img id="mimg_bank" src="" width="95%">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-9">
                                                <input type="text" class="form-control has-feedback-left" readonly
                                                    value="" id="maccount">
                                                <span class="fa fa-exchange  form-control-feedback left"
                                                    aria-hidden="true"></span>
                                            </div>
                                            <div class="col-md-3 ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>เกมส์</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="form-group row">
                                            <div class="col-md-3 form-group text-right p-2 h6">
                                                <span class="">คะแนน</span>
                                            </div>
                                            <div class="col-md-6 form-group ">
                                                <input type="text" class="form-control has-feedback text-center"
                                                    readonly value="" id="mpoint">

                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 form-group text-right p-2 h6">

                                                <span>หมุนวงล้อ</span>
                                            </div>
                                            <div class="col-md-6 form-group ">
                                                <input type="text" class="form-control has-feedback text-center"
                                                    readonly value="" id="mspin">

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="row" id="tap_history" style="display: none;">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="text-center">รายการแอดเงิน 10 รายการ</h5>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>no</th>
                                                        <th>time</th>
                                                        <th>amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="history_credit">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="text-center">รายการฝาก-ถอน 10 รายการ</h5>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>no</th>
                                                        <th>time</th>
                                                        <th>deposit</th>
                                                        <th>withdraw</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="history_dw">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal-->
<!-- Modal แก้ไขพาสเวิร์ด -->
<div class="modal fade" id="m_editpass" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เปลี่ยนพาสเวิร์ด<small>(ตรวจสอบชื่อ)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12  form-group has-feedback">

                    <h3 style="color: red"> ตัวอย่าง : aa123123 </h3>
                    <h5>หรือก็อปวางเลย</h5>
                </div>
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Password" required="required" id="password"
                        id="val_editPass" autocomplete="off">
                    <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button onClick="edit_pass()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal แก้ไขแบงค์ -->
<div class="modal fade" id="m_edit_bank" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">แก้ไขแบงค์<small>(ตรวจสอบชื่อ)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">เลขที่บัญชี</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="number" class="form-control" id="edit_account" name="account" maxlength="12"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">ธนาคาร</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="bank_id" id="edit_bank">
                                <?php foreach ($bank as $_b => $bnk) { ?>
                                <option value="<?= $bnk['id'] ?>">
                                    <?= $bnk['bank_th'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onClick="edit_bank()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal แก้ไขชื่อ -->
<div class="modal fade" id="m_editUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ฟอร์มแก้ไข<small>(สำหรับพนักงานแก้ไขให้)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="edit_name" placeholder="ชื่อ - สกุล"
                        required="required" name="name" autocomplete="off">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button onClick="edit_name()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal แก้ไขชื่อ -->
<div class="modal fade" id="m_editUsername" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ฟอร์มแก้ไข<small>(สำหรับพนักงานแก้ไขให้)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <span>เปลี่ยนยูเซอร์ลูกค้า กรณีจำเป็นเท่านั้น</span>
                </div>
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="ie_username"
                        placeholder="รหัสลูกค้า / เบอร์โทร" required="required" name="ie_username" autocomplete="off">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

            </div>

            <div class="modal-footer">
                <button onClick="edit_username()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--เพิ่มกลุ่มสำหรับลูกค้า-->
<div class="modal fade" id="m_edit_group" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เลือกกลุ่ม<small>(สำหรับพนักงาน)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="form_edit_group">
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">กลุ่ม</label>
                            <div class="col-md-9 col-sm-9 ">
                                <?php foreach ($group as $_g => $gpr) { ?>
                                <div class="form-check">
                                    <input type="checkbox" name="<?= $gpr['id'] ?>" class="form-check-input"
                                        id="group<?= $gpr['id'] ?>">
                                    <label class="form-check-label"
                                        for="Check<?= $gpr['id'] ?>"><?= $gpr['name'] ?></label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onClick="edit_group()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal ผู้แนะนำ -->

<div class="modal fade" id="m_salename" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">แก้ไขรายชื่อผู้แนะนำ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <input type="hidden" name="user_id" id="userid" value="">
                    <select class="form-control" id="bodysalename">
                        <?php foreach($sale_n as $_s=>$sn){ ?>
                        <option value="<?=$sn['id']?>"><?=$sn['name']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button onClick="edit_salename()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal แสดงข้อมูลการเข้าใช้งาน ย้อนหลัง7 วัน -->
<div class="modal fade bd-example-modal-lg" id="m_log" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content" style="width:1024px;background-color: #13171f;color: white;">
            <div class="modal-header">
                <h2>ข้อมูลการเข้าระบบย้อนหลัง7วัน</h2>
                <button type="button" class="close" data-dismiss="modal"
                    style="background-color: red;color: white;">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #f8f9fa; color:#212529;">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <table id="table_log" class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%" style="font-size: 14px;">
                        <thead style="background-color: #2a3f54;color: #fff;">
                            <tr class="text-center">
                                <th width="10px">Id</th>
                                <th width="45px">Username</th>
                                <th width="30px">IP</th>
                                <th width="30px">วันที่เข้าใช้งานล่าสุด</th>
                                <th width="10px">Iphone</th>
                                <th width="10px">Ipad</th>
                                <th width="10px">WebOS</th>
                                <th width="10px">Android</th>
                                <th width="10px">PC</th>
                            </tr>
                        </thead>
                        <tbody id="bodylog" style="background-color: aliceblue;">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/tem_admin/vendors/switchery/dist/switchery.min.js"></script>
<script src="<?php echo base_url() ?>public/tem_admin/vendors/switchery/dist/switchery.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#s_user").keyup(function(event) {
        if (event.keyCode === 13) {
            select_user(1);
        }
    });
    $("#t_user").keyup(function(event) {
        if (event.keyCode === 13) {
            select_user(2);
        }
    });
    $("#t_account").keyup(function(event) {
        if (event.keyCode === 13) {
            select_user(4);
        }
    });

    $("#t_name").keyup(function(event) {
        if (event.keyCode === 13) {
            select_user(3);
        }
    });


});

function edit_username() {
    var user = $('#user').val();
    var oldUser = $('#username').val();
    var newUser = $('#ie_username').val();
    if (newUser.length == 10) {
        var numbers = /^[0-9]+$/;
        if (newUser.match(numbers)) //เช็คเฉพาะตัวเลขเท่านั้น
        {
            swal({
                title: "คุณต้องการเปลี่ยนรหัสลูกค้า",
                text: "เมื่อเปลี่ยนรหัสต้องแจ้งลูกค้าเสมอ \n รหัสเก่าคือ " + oldUser + " \n เปลี่ยนเป็น " +
                    newUser,
                type: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                            url: 'checkusername',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                username: newUser
                            },
                        })
                        .done(function(res) {
                            if (res.code == 1) {
                                $.ajax({
                                        url: 'edit_username',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {
                                            username: newUser,
                                            user: user
                                        },
                                    })
                                    .done(function(res) {
                                        if (res.code == 1) {
                                            swal(res.title, res.msg, 'success');
                                            $('#m_editUsername').modal('toggle');
                                            var u_set = user.substr(-6);
                                            $('#s_user').val(u_set);
                                            select_user(1);
                                        } else {
                                            swal(res.title, res.msg, 'error');
                                        }
                                    })
                                    .fail(function() {
                                        swal('ระบบมีปัญหา', 'ติดต่อพนักงาน', 'error');
                                        console.log("error");
                                    });
                            } else {
                                swal('เบอร์โทรซ้ำ', 'กรุณาเช็คเบอร์โทรให้ถูกต้องจากการค้นหาลูกค้า',
                                    'error');
                            }
                        });

                } else {
                    swal('ยกเลิกราย', 'ยกเลิกรายการสำเร็จ', 'success');
                }
            });
        } else {
            swal('เฉพาะตัวเลข เท่านั้น!!', 'รหัสใช้งานต้องตรงกับเบอร์โทรลูกค้า', 'error');
        }
    } else {
        swal('ไม่ครบ 10 หลัก', 'รหัสใช้งานต้องตรงกับเบอร์โทรลูกค้า', 'error');

    }

}

function edit_group() {
    var user = $('#user').val();
    var data = $('#form_edit_group').serializeArray();
    $.ajax({
            url: 'edit_group',
            type: 'POST',
            dataType: 'json',
            data: data,
        })
        .done(function(res) {
            if (res.code == 1) {
                swal(res.title, res.msg, 'success');
                $('#m_edit_group').modal('toggle');
                var u_set = user.substr(-6);
                $('#s_user').val(u_set);
                select_user(1);
            } else {
                swal(res.title, res.msg, 'error');
            }
        })
        .fail(function() {
            console.log("error");
        });
}

function edit_name() {
    var user = $('#user').val();
    var name = $('#edit_name').val();
    $.ajax({
            url: 'edit_name',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
                user: user
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                swal(res.title, res.msg, 'success');
                $('#m_editUser').modal('toggle');
                var u_set = user.substr(-6);
                $('#s_user').val(u_set);
                select_user(1);
            } else {
                swal(res.title, res.msg, 'error');
            }
        })
        .fail(function() {
            console.log("error");
        });
}

function edit_bank() {
    var bank_id = $('#edit_bank').val();
    var account = $('#edit_account').val();
    var user = $('#user').val();
    $.ajax({
            url: 'edit_bank',
            type: 'POST',
            dataType: 'json',
            data: {
                bank_id: bank_id,
                account: account,
                user: user
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                swal(res.title, res.msg, 'success');
                $('#m_edit_bank').modal('toggle');
                var u_set = user.substr(-6);
                $('#s_user').val(u_set);
                select_user(1);
            } else {
                swal(res.title, res.msg, 'error');
            }
        })
        .fail(function() {
            console.log("error");
        });
}

function edit_pass() {
    var user = $('#user').val();
    var password = $('#password').val();
    if (user != '') {
        if (password != '') {
            $.ajax({
                    url: 'edit_pass',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user: user,
                        password: password
                    },
                })
                .done(function(res) {
                    if (res.code == 1) {
                        swal({
                            icon: "success",
                            text: res.msg,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        swal({
                            icon: "error",
                            text: res.msg,
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        } else {
            swal('กรุณาใส่พาสเวิร์ดลูกค้าใหม่', '', 'error');
        }
    } else {
        swal('กรุณาเลือกรหัสลูกค้าก่อนทำรายการ', '', 'error');
    }
}

function closeuser(status) {
    var user = $('#user').val();
    swal({
        title: 'Are you sure?',
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: 'edit_status',
                type: 'POST',
                dataType: 'json',
                data: {
                    user: user,
                    status: status
                },
            }).done(function(res) {
                if (res.code == 1) {
                    swal({
                        icon: "success",
                        text: res.msg,
                    });
                    var u_set = user.substr(-6);
                    $('#s_user').val(u_set);
                    select_user(1);
                } else {
                    swal({
                        icon: "error",
                        text: res.msg,
                    });
                }
            });
        } else {

        }

    });
}

function down_money() {
    var credit = $('#credit').val();
    var user = $('#user').val();

    // console.log(credit);
    if (user != '') {
        swal({
                text: 'ใส่ยอดเงินที่ต้องดึงออก',
                content: "input",
                button: {
                    text: "ลบเครดิต",
                    closeModal: false,
                },
            })
            .then(name => {
                if (name == '') {
                    swal('ไม่ได้จำนวนเงิน', 'กรุณาทำรายการใหม่', 'error');
                } else {
                    var amount_out = parseFloat(name).toFixed(2);
                    var credit1 = credit.split(",").join("");
                    var credit2 = parseFloat(credit1).toFixed(2);
                    console.log(amount_out)
                    console.log(credit2)
                    //			  if(amount_out <= credit2){
                    console.log(amount_out);
                    console.log(credit2);
                    $.ajax({
                            url: 'credit_out',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                user: user,
                                amount: name
                            },
                        })
                        .done(function(res) {
                            if (res.code == 1) {
                                swal('สำเร็จ', 'กรุณาเช็คเครดิตอีกรอบ', 'success');
                                var u_set = user.substr(-6);
                                $('#s_user').val(u_set);
                                select_user(1);

                            } else {
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });

                    //				}else{
                    //					swal('พบปัญหา','ยอดที่ต้องการลบเกินกว่ายอดที่ลูกค้ามี','error');
                    //				}
                }
            });

    } else {
        swal('ไม่พบชื่อสมาชิก', 'กรุณาทำการค้นหาชื่อสมาชิกก่อนทำการลบหรือเพิ่มเครดิต', 'error');
    }

}

function up_money() {
    var credit = $('#credit').val();
    var user = $('#user').val();

    // console.log(credit);
    if (user != '') {
        swal({
                text: 'ใส่ยอดเงินที่ต้องการเพิ่ม',
                content: "input",
                button: {
                    text: "เพิ่มเครดิต",
                    closeModal: false,
                },
            })
            .then(name => {
                if (name == '') {
                    swal('ไม่ได้จำนวนเงิน', 'กรุณาทำรายการใหม่', 'error');
                } else {
                    var amount_out = parseFloat(name).toFixed(2);
                    var credit1 = credit.split(",").join("");
                    var credit2 = parseFloat(credit1).toFixed(2);

                    $.ajax({
                            url: 'credit_in',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                user: user,
                                amount: name
                            },
                        })
                        .done(function(res) {
                            if (res.code == 1) {
                                swal('สำเร็จ', 'กรุณาเช็คเครดิตอีกรอบ', 'success');
                                var u_set = user.substr(-6);
                                $('#s_user').val(u_set);
                                select_user(1);

                            } else {
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });

                    //				}else{
                    //					swal('พบปัญหา','ยอดที่ต้องการลบเกินกว่ายอดที่ลูกค้ามี','error');
                    //				}
                }
            });

    } else {
        swal('ไม่พบชื่อสมาชิก', 'กรุณาทำการค้นหาชื่อสมาชิกก่อนทำการลบหรือเพิ่มเครดิต', 'error');
    }

}

function down_point() {
    var point = $('#point').val();
    var user = $('#user').val();
    // console.log(point);	
    if (user != '') {
        swal({
                text: 'ใส่ยอดคะแนนที่ต้องดึงออก',
                content: "input",
                button: {
                    text: "ลบคะแนน",
                    closeModal: false,
                },
            })
            .then(name => {

                if (name == '') {
                    swal('ไม่ได้จำนวนคะแนน', 'กรุณาทำรายการใหม่', 'error');
                } else {
                    var amount_out = parseFloat(name).toFixed(2);
                    var point1 = point.split(",").join("");
                    var point2 = parseFloat(point1).toFixed(2);
                    if (amount_out <= point2) {
                        console.log(amount_out);
                        console.log(point2);
                        $.ajax({
                                url: 'point_out',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    user: user,
                                    amount: name
                                },
                            })
                            .done(function(res) {
                                if (res.code == 1) {
                                    swal('สำเร็จ', 'กรุณาเช็คคะแนนอีกรอบคะ', 'success');
                                    var u_set = user.substr(-6);
                                    $('#s_user').val(u_set);
                                    select_user(1);

                                } else {
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }
                            });

                    } else {
                        swal('พบปัญหา', 'ยอดที่ต้องการลบเกินกว่ายอดที่ลูกค้ามี', 'error');
                    }
                }
            });

    } else {
        swal('ไม่พบชื่อสมาชิก', 'กรุณาทำการค้นหาชื่อสมาชิกก่อนทำการลบหรือเพิ่มเครดิต', 'error');
    }

}

function up_point() {
    var credit = $('#credit').val();
    var user = $('#user').val();

    if (user != '') {
        swal({
                text: 'ใส่ยอดคะแนนที่ต้องการเพิ่ม',
                content: "input",
                button: {
                    text: "เพิ่มเครดิต",
                    closeModal: false,
                },
            })
            .then(name => {
                //			console.log(name);
                if (name == '') {
                    swal('กรุณาทำรายการใหม่', 'error');
                } else {
                    $.ajax({
                            url: 'point_in',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                user: user,
                                amount: name
                            },
                        })
                        .done(function(res) {
                            if (res.code == 1) {
                                swal('สำเร็จ', 'กรุณาเช็คคะแนนอีกรอบ', 'success');
                                // .then(function(sw) {
                                //             location.reload();
                                //         });
                                var u_set = user.substr(-6);
                                $('#s_user').val(u_set);
                                select_user(1);

                            } else {
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });

                }
            });
        //		 
    } else {
        swal('ไม่พบชื่อสมาชิก', 'กรุณาทำการค้นหาชื่อสมาชิกก่อนทำการลบหรือเพิ่มเครดิต', 'error');
    }
}

function down_spin() {
    var spin = $('#spin').val();
    var user = $('#user').val();
    // console.log(point);	
    if (user != '') {
        swal({
                text: 'ใส่ยอดสปรินที่ต้องดึงออก',
                content: "input",
                button: {
                    text: "ลบSpin",
                    closeModal: false,
                },
            })
            .then(name => {

                if (name == '') {
                    swal('ไม่ได้จำนวนสปริน', 'กรุณาทำรายการใหม่', 'error');
                } else {
                    var amount_out = parseFloat(name).toFixed(2);
                    var spin1 = spin.split(",").join("");
                    var spin2 = parseFloat(spin1).toFixed(2);
                    if (amount_out <= spin2) {
                        console.log(amount_out);
                        console.log(spin2);
                        $.ajax({
                                url: 'spin_out',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    user: user,
                                    amount: name
                                },
                            })
                            .done(function(res) {
                                if (res.code == 1) {
                                    swal('สำเร็จ', 'กรุณาเช็คสปรินอีกรอบคะ', 'success');
                                    var u_set = user.substr(-6);
                                    $('#s_user').val(u_set);
                                    select_user(1);

                                } else {
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }
                            });

                    } else {
                        swal('พบปัญหา', 'ยอดที่ต้องการลบเกินกว่ายอดที่ลูกค้ามี', 'error');
                    }
                }
            });

    } else {
        swal('ไม่พบชื่อสมาชิก', 'กรุณาทำการค้นหาชื่อสมาชิกก่อนทำการลบหรือเพิ่มเครดิต', 'error');
    }

}

function up_spin() {
    var credit = $('#spin').val();
    var user = $('#user').val();

    if (user != '') {
        swal({
                text: 'ใส่จำนวนสปริน',
                content: "input",
                button: {
                    text: "เพิ่มSpin",
                    closeModal: false,
                },
            })
            .then(name => {
                //			console.log(name);
                if (name == '') {
                    swal('กรุณาทำรายการใหม่', 'error');
                } else {
                    $.ajax({
                            url: 'spin_in',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                user: user,
                                amount: name
                            },
                        })
                        .done(function(res) {
                            if (res.code == 1) {
                                swal('สำเร็จ', 'กรุณาเช็คสปรินอีกรอบ', 'success');
                                // .then(function(sw) {
                                //             location.reload();
                                //         });
                                var u_set = user.substr(-6);
                                $('#s_user').val(u_set);
                                select_user(1);

                            } else {
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });

                }
            });
        //		 
    } else {
        swal('ไม่พบชื่อสมาชิก', 'กรุณาทำการค้นหาชื่อสมาชิกก่อนทำการลบหรือเพิ่มเครดิต', 'error');
    }
}



function user_data(data) {

    var data = JSON.parse(($(data).data('edit')));
    console.log(data);

    var account = data.account;
    var bank_short = data.bank_short;
    var bank_th = data.bank_th;
    var name = data.name;
    var point = data.point;
    var spin = data.spin;
    var user = data.user;
    var username = data.username;

    var img_bnk = '<?= $this->config->item('tem_frontend') ?>img/mapraw_icon/bank/' + data.api_id + '.png';
    document.getElementById("mimg_bank").src = img_bnk;
    $("#muser").val(user);
    $("#musername").val(username);
    $("#mname").val(name);
    $("#mpoint").val(point);
    $("#mspin").val(spin);
    $("#mbank").val(bank_th);
    $("#maccount").val(account);

    $.ajax({
        url: 'sel_detail_account',
        type: 'POST',
        dataType: 'json',
        data: {
            user: user,
            name: name
        },
    }).done(function(res) {
        if (res.code == 1) {
            var credit = res.data.credit;
            $("#mcredit").val(credit);
            var conut3 = res.data.gu.length;
            var gu = res.data.gu;
            var content3 = '';
            for (var g = 0; g < conut3; g++) {
                $("#group" + gu[g]['id']).prop("checked", true);
                content3 += '<button  class="btn btn-info btn-sm">' + gu[g]['name'] + '</button>';

            }
            $('#mgroup_user').html(content3);
        }
    })
}

function select_user(st) {
    if (st == 1 || st == 2) {
        $('#cover-spin').show();
        if (st == 1) {
            var s_user = $('#s_user').val();
            $('#t_user').val('');
            $('#user_acc').val('');
            $('#user_name').val('');
            var t_user = '';
        } else {
            var t_user = $('#t_user').val();
            $('#s_user').val('');
            $('#user_acc').val('');
            $('#user_name').val('');
            var s_user = '';
        }

        $.ajax({
                url: 'sel_detail',
                type: 'POST',
                dataType: 'json',
                data: {
                    s_user: s_user,
                    t_user: t_user
                },
            })
            .done(function(res) {

                $('#cover-spin').hide();
                if (res.code == 1) {

                    $('#tb_user').hide();
                    $('#tap_member').show();
                    $('#tap_bank').show();
                    $('#tap_sale').show();
                    $('#tap_log').show();
                    $('#tap_history').show();
                    $('#tap_history_pass').show();

                    if(res.turn != 0)
                    $('#tap_turn').show();
                    else
                    $('#tap_turn').hide();

                    $('#history_credit').html('');
                    $('#history_dw').html('');

                    $('#tap_member_error').hide();
                    $('#tap_bank_error').hide();
                    $('#tap_sale_error').hide();
                    $('#tap_log_error').hide();
                    
                    $('#user').val(res.data.user);
                    $('#user_id').val(res.data.id);
                    $('#userid').val(res.data.id);
                    $('#name').val(res.data.name);
                    $('#edit_name').val(res.data.name);
                    $('#turnover').val(res.turn);
                    $('#date_turn').val(res.date);
                    $('#username').val(res.data.username);
                    $('#bank').val(res.data.bank_th);
                    $('#total_deposit').val(res.total_deposit);

                    var img_bnk = '<?= $this->config->item('tem_frontend') ?>img/mapraw_icon/bank/' + res.data
                        .api_id + '.png';
                    document.getElementById("img_bank").src = img_bnk;

                    $('#edit_bank').val(res.data.bank_id);
                    $('#account').val(res.data.account);
                    $('#edit_account').val(res.data.account);
                    $('#spin').val(res.data.spin);
                    $('#credit').val(res.data.credit);
                    $('#stakeMoney').val(res.data.stakeMoney);
                    $('#sale_name').val(res.data.sale_name);

                    $('#point').val(res.data.point);
                    if (res.data.status == 1) {
                        $('#status1').show();
                        $('#status2').hide();
                    } else {
                        $('#status1').hide();
                        $('#status2').show();
                    }


                    var conut = res.data.dw.length;
                    var wd = res.data.dw;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr>';
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + moment(wd[i]['datetime2']).format('YYYY-MM-DD HH:mm:ss') + '</td>';
                        if (wd[i]['deposit'] != 0) {
                            content += '<td class="text-right">' + wd[i]['deposit'] + '</td>';
                        } else {
                            content += '<td class="text-right"> - </td>';
                        }
                        if (wd[i]['withdraw'] != 0) {
                            content += '<td class="text-right">' + wd[i]['withdraw'] + '</td>';
                        } else {
                            content += '<td class="text-right"> - </td>';
                        }
                        content += '</tr>';
                    }

                    var conut2 = res.data.add_cd.length;
                    if (conut2 > 10) {
                        conut2 = 10;
                    }
                    var add_cd = res.data.add_cd;
                    var content2 = '';
                    for (var j = 0; j < conut2; j++) {
                        content2 += '<tr><td>' + j + '</td><td>' + moment(add_cd[j]['CreationTime']).add(-1,
                            'hours').format('YYYY-MM-DD HH:mm:ss') + '</td><td>' + add_cd[j][
                            'Amount'
                        ] + '</td></tr>';


                    }
                    var conut3 = res.data.gu.length;
                    var gu = res.data.gu;
                    var content3 = '';
                    for (var g = 0; g < conut3; g++) {
                        $("#group" + gu[g]['id']).prop("checked", true);
                        content3 += '<button  class="btn btn-info btn-sm">' + gu[g]['name'] + '</button>';

                    }

                    $('#group_user').html(content3);
                    $('#history_credit').html(content2);
                    $('#history_dw').html(content);
                    // swal('ค้นหาสำเร็จ', {
                    //     buttons: [null],
                    //     icon: "success",
                    // });

                } else if (res.code == 2) {
                    $('#tap_member_error').show();
                    $('#tap_bank_error').show();
                    $('#tap_sale_error').show();
                    $('#tap_log_error').show();

                    $('#tap_member').hide();
                    $('#tap_bank').hide();
                    $('#tap_sale').hide();
                    $('#tap_log').hide();
                    $('#tap_history').hide();
                    $('#tap_history_pass').hide();

                    $('#user_error').val(res.data.user);
                    $('#user_id_error').val(res.data.id);
                    $('#userid_error').val(res.data.id);
                    $('#name_error').val(res.data.name);
                    $('#edit_name_error').val(res.data.name);
                    $('#username_error').val(res.data.username);
                    $('#bank_error').val(res.data.bank_th);

                    var img_bnk = '<?= $this->config->item('tem_frontend') ?>img/mapraw_icon/bank/' + res.data
                        .api_id + '.png';
                    document.getElementById("img_bank_error").src = img_bnk;

                    $('#edit_bank_error').val(res.data.bank_id);
                    $('#account_error').val(res.data.account);
                    $('#edit_account_error').val(res.data.account);
                    $('#spin_error').val(res.data.spin);
                    $('#credit_error').val(res.data.credit);

                    $('#stakeMoney_error').val(res.data.stakeMoney);
                    $('#sale_name_error').val(res.data.sale_name);

                    $('#point_error').val(res.data.point);
                    if (res.data.status == 1) {
                        $('#status1_error').show();
                        $('#status2_error').hide();
                    } else {
                        $('#status1_error').hide();
                        $('#status2_error').show();
                    }

                    swal('ค้นหาสำเร็จ', {
                        buttons: [null],
                        icon: "success",
                    });

                    var conut3 = res.data.gu.length;
                    var gu = res.data.gu;
                    var content3 = '';
                    for (var g = 0; g < conut3; g++) {
                        $("#group" + gu[g]['id']).prop("checked", true);
                        content3 += '<button  class="btn btn-info btn-sm">' + gu[g]['name'] + '</button>';

                    }

                    $('#group_user_error').html(content3);

                } else {
                    $('#tap_member').hide();
                    $('#tap_bank').hide();
                    $('#tap_sale').hide();
                    $('#tap_history').hide();
                    swal('ไม่สำเร็จ', res.msg, 'error');

                }
            })
            .fail(function() {
                console.log("error");
            });

    } else if (st == 3 || st == 4) {
        $('#bodyhistory').html('');
        if (st == 4) {
            var user_acc = $('#user_acc').val();
            $('#user_name').val('');
            $('#t_user').val('');
            $('#s_user').val('');
            var user_name = '';
        } else {
            var user_name = $('#user_name').val();
            $('#user_acc').val('');
            $('#t_user').val('');
            $('#s_user').val('');
            var user_acc = '';
        }

        $.ajax({
            url: 'search_account',
            type: 'POST',
            dataType: 'json',
            data: {
                user_acc: user_acc,
                user_name: user_name
            },
        }).done(function(res) {

            $('#tap_member').hide();
            $('#tap_bank').hide();
            $('#tap_sale').hide();
            $('#tap_log').hide();
            $('#tap_history').hide();
            $('#tap_history_pass').hide();

            if (res.length != 0) {
                $('#tb_user').show();
                var i = 1;
                var content = '';
                $.each(res, function(index, value) {
                    content += '<tr align="center">'
                    content += '<td>' + i + '</td>'
                    content += '<td>' + value.user + '</td>'
                    content += '<td>' + value.username + '</td>'
                    content += '<td>' + value.name + '</td>'
                    content += '<td>' + value.account + '</td>'
                    content += '<td>' + value.bank_th + '</td>'
                    content += '<td>' + value.username + '</td>'
                    content += `<td><button class="btn"><i data-toggle="modal" data-target="#myModal" 
                    data-edit="` + escapeHtml(JSON.stringify(value)) + ` "
                    onclick="user_data(this)" class="fa fa-file-text-o"></i></button></td>`
                    content += '</tr>';
                    i++;
                });
                $('#bodyhistory').html(content);
                swal('ค้นหาสำเร็จ', {
                    buttons: [null],
                    icon: "success",
                });
            } else {

                swal('ไม่สำเร็จ', 'ไม่พบข้อมูลในฐานข้อมูล', 'error');

            }

        });
    }
}

function del_user() {

    var id = $('#userid_error').val();

    swal({
            title: "ลบยูสเซอร์",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'del_user',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        if (res.code == 1) {
                            swal(res.title, res.msg, 'success').then(function(w) {
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            });
                        } else if (res.code == 2) {
                            swal(res.title, res.msg, 'warning').then(function(w) {
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            });
                        } else {
                            swal(res.title, res.msg, 'error').then(function(w) {
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            });
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    });
            } else {
                swal("ยกเลิก", "", "error");
            }

        });

}

function salename() {

    var id = $('#userid').val();
    $.ajax({
        url: 'salename',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id
        }

    }).done(function(res) {
        if (res.code == 1) {
            if (res.sale != null) {
                $('#bodysalename').val(res.sale['sale_id']).change();
            } else {
                $('#bodysalename').attr('selected', true);
            }
        } else {

        }
    });
}

function edit_salename() {

    var id = $('#userid').val();
    var sale_id = $('#bodysalename').find(":selected").val();
    swal({
        title: "คุณแน่ใจที่จะทำการเปลี่ยนแปลง",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: 'edit_salename',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    sale_id: sale_id
                }

            }).done(function(res) {
                if (res.code == 1) {
                    swal({
                        icon: "success",
                        text: res.msg,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    swal({
                        icon: "error",
                        text: res.msg,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }



            });
        } else {
            swal("ยกเลิก", "การเปลี่ยนแปลงข้อมูลเรียบร้อย!", "error");
        }
    });


}

function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}


      // log ประวัติการเข้าระบบ7วัน
      function showlog(){
     $('#cover-spin').show();
    var user = $('#user').val();
    $('#table_log').DataTable().destroy();
    $.ajax({
				url: 'showlog',
				type: 'POST',
				dataType: 'json',
				data: {user:user},
	})
    .done(function(res) {
			if(res.code =1){
                 $('#cover-spin').hide();
                $('#m_log').modal('toggle');
                if(res.data.length >= 1 ){
                 var i = 1;
                    $.each(res.data, function(index, val) {
                        var html='';
                            content += '<tr>';
                            content += '<td class="text-center">'+i+'</td>';
                            content += '<td class="text-center">'+val.user_id+'</td>';
                            content += '<td class="text-center">'+val.ip+'</td>';
                            content += '<td class="text-center">'+moment.unix(val.create_time).format("DD/MM/YYYY HH:mm:ss");+'</td>';
                            if(val.platform ==1){
                                content+= '<td class="text-center">'+val.countPlatform+'</td>';
                            }else{
                                content+= '<td class="text-center">'+'0'+'</td>';
                            }

                            if(val.platform ==2){
                                content+= '<td class="text-center">'+val.countPlatform+'</td>';
                            }else{
                                content+= '<td class="text-center">'+'0'+'</td>';
                            }

                            if(val.platform ==3){
                                content+= '<td class="text-center">'+val.countPlatform+'</td>';
                            }else{
                                content+= '<td class="text-center">'+'0'+'</td>';
                            }

                            if(val.platform ==4){
                                content+= '<td class="text-center">'+val.countPlatform+'</td>';
                            }else{
                                content+= '<td class="text-center">'+'0'+'</td>';
                            }

                            if(val.platform ==5){
                                content+= '<td class="text-center">'+val.countPlatform+'</td>';
                            }else{
                                content+= '<td class="text-center">'+'0'+'</td>';
                            }

                            content += '</tr>';
                            i++;
                    });
				}else{
					var content = 'No data';
				}
            }else{
                swal(res.title, res.msg, 'error');
            }
            $('#bodylog').html(content);
            new $('#table_log').DataTable({
                "searching": false
              });
	})
	.fail(function() {
		console.log("error");
	});
    }
    // -- end log






function add_turn() {
    var user = $('#user').val();
    swal({
        text: 'ใส่เทิร์นที่ต้องการเพิ่ม',
        content: "input",
        button: {
            text: "เพิ่มเทิร์น",
            closeModal: false,
        },
    }).then(value => {
        if (turnover != null && turnover != '') {
            $.ajax({
                url: 'add_turn',
                type: 'POST',
                dataType: 'json',
                data: {
                    user: user,
                    turnover: value

                },
            }).done(function(res) {
                if (res.code == 1) {
                    swal('', res.msg, "success");
                    var u_set = user.substr(-6);
                    $('#s_user').val(u_set);
                    select_user(1);
                } else {
                    swal('', res.msg, "error");
                }
            })

        } else if (turnover == '') {
            swal('', 'กรุณาใส่ยอดเทิร์น', "error");
        } else {

        }

    });

}
// เทิร์น
function reset_turn() {
    var turnover = $('#turnover').val();
    var user = $('#user').val();
    swal({
        text: 'ยอดเทิร์น',
        content: {
            element: "input",
            attributes: {
                value: turnover
            }
        },
        button: {
            text: "ตัดเทิร์น",
            closeModal: false,
        },
    }).then(value => {
        if (turnover != null && turnover != '') {
            $.ajax({
                url: 'reset_turnover',
                type: 'POST',
                dataType: 'json',
                data: {
                    user: user
                },
            }).done(function(res) {
                if (res.code == 1) {
                    swal('', res.msg, "success");
                    var u_set = user.substr(-6);
                    $('#s_user').val(u_set);
                    select_user(1);
                } else {
                    swal('', res.msg, "error");
                }
            })
        }
    });

}
</script>
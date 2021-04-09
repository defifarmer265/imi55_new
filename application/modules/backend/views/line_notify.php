<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>สมาชิกใหม่</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-info"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[0]['token'] ?>');$('#lntf_type').val('<?= $line[0]['type'] ?>');$('#ip_balance').hide();$('#ip_delay').hide();$('#balance').val(<?= $line[0]['balance'] ?>);$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[0]['token'] ?>" id="token_register">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายงานรายชั่วโมง</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-primary" onClick="$('#m_register').modal();$('#token').val('<?= $line[3]['token'] ?>');
						$('#lntf_type').val('<?= $line[3]['type'] ?>');$('#ip_balance').hide();
						$('#ip_delay').hide();$('#balance').val(<?= $line[3]['balance'] ?>);
						$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[3]['token'] ?>" id="token_notify">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายการฝาก</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-success"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[1]['token'] ?>');$('#lntf_type').val('<?= $line[1]['type'] ?>');$('#ip_balance').show();$('#ip_delay').show();$('#balance').val(<?= $line[1]['balance'] ?>);$('#delay').val(<?= $line[1]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[1]['token'] ?>" id="token_dps">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>

                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <span class="">ระบุจำนวนเงินที่ต้องการแจ้ง มากกว่า</span>
                        </div>
                        <div class="col-md-6 ">
                            <span class="">เวลาในการทำรายการ เป็นนาที</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <input type="number" class="form-control has-feedback-left" readonly
                                value="<?= $line[1]['balance'] ?>">
                            <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                            </span>
                        </div>
                        <div class="col-md-6 ">

                            <input type="number" class="form-control has-feedback-left" readonly
                                value="<?= $line[1]['delay'] ?>">
                            <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>เเจ้งเตือนการเพิ่มเครดิตด้วยมือ</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-primary" onClick="$('#m_register').modal();$('#token').val('<?= $line[4]['token'] ?>');
						$('#lntf_type').val('<?= $line[4]['type'] ?>');$('#ip_balance').hide();
						$('#ip_delay').hide();$('#balance').val(<?= $line[4]['balance'] ?>);
						$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[4]['token'] ?>" id="token_notify">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>
                        <br><br><br><br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        



    </div>
    <div class="row">
        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายการถอน</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-warning"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[2]['token'] ?>');$('#lntf_type').val('<?= $line[2]['type'] ?>');$('#ip_balance').show();$('#ip_delay').show();$('#balance').val(<?= $line[2]['balance'] ?>);$('#delay').val(<?= $line[2]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[2]['token'] ?>" id="token_spin">
                            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>

                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <span class="">ระบุจำนวนเงินที่ต้องการแจ้ง มากกว่า</span>
                        </div>
                        <div class="col-md-6 ">
                            <span class="">เวลาในการทำรายการ เป็นนาที</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <input type="number" class="form-control has-feedback-left" readonly
                                value="<?= $line[2]['balance'] ?>">
                            <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>

                        </div>
                        <div class="col-md-6 ">

                            <input type="number" class="form-control has-feedback-left" readonly
                                value="<?= $line[2]['delay'] ?>">
                            <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>แจ้งเตือนการลดเครดิตด้วยมือ</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-dark"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[3]['token'] ?>');$('#lntf_type').val('<?= $line[3]['type'] ?>');$('#ip_balance').hide();$('#ip_delay').hide();$('#balance').val(<?= $line[3]['balance'] ?>);$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[3]['token'] ?>" id="token_r">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>
                            <br><br><br><br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>แจ้งเตือนการเพิ่ม Spin ด้วยมือ</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-info"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[4]['token'] ?>');$('#lntf_type').val('<?= $line[4]['type'] ?>');$('#ip_balance').hide();$('#ip_delay').hide();$('#balance').val(<?= $line[0]['balance'] ?>);$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[4]['token'] ?>" id="token_sp">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>
                       
                        </div>

                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>แจ้งเตือนการลด Spin ด้วยมือ</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-info"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[9]['token'] ?>');$('#lntf_type').val('<?= $line[9]['type'] ?>');$('#ip_balance').hide();$('#ip_delay').hide();$('#balance').val(<?= $line[0]['balance'] ?>);$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[9]['token'] ?>" id="token_sp_out">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>
                       
                        </div>

                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>แจ้งเตือนการเพิ่ม POINT ด้วยมือ</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-dark"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[5]['token'] ?>');$('#lntf_type').val('<?= $line[5]['type'] ?>');$('#ip_balance').hide();$('#ip_delay').hide();$('#balance').val(<?= $line[0]['balance'] ?>);$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[5]['token'] ?>" id="token_p">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>

                        </div>

                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>แจ้งเตือนการลด POINT ด้วยมือ</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-dark"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[10]['token'] ?>');$('#lntf_type').val('<?= $line[10]['type'] ?>');$('#ip_balance').hide();$('#ip_delay').hide();$('#balance').val(<?= $line[0]['balance'] ?>);$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[10]['token'] ?>" id="token_p">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>

                        </div>

                    </div>
                </div>
            </div>
        </div> -->


    </div>
    <!-- <div class="row">
    <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2>แจ้งเตือนการแลกรางวัล</h2>
                    <div class="text-right">
                        <button class=" btn btn-sm btn-outline-dark"
                            onClick="$('#m_register').modal();$('#token').val('<?= $line[6]['token'] ?>');$('#lntf_type').val('<?= $line[6]['type'] ?>');$('#ip_balance').hide();$('#ip_delay').hide();$('#balance').val(<?= $line[0]['balance'] ?>);$('#delay').val(<?= $line[0]['delay'] ?>);">
                            <li class="fa fa-cog"> แก้ไข</li>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?= $line[6]['token'] ?>" id="token_r">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> -->


</div>


<div class="modal fade" id="m_register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Token Line Notify</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left input_mask" id="form_edit_token">
                <div class="modal-body">

                    <input type="hidden" name="lntf_type" id="lntf_type">
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="token" placeholder="Token"
                            required="required" name="token" autocomplete="off">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>

                    <div class="col-md-12 col-sm-12  form-group has-feedback" id="ip_balance">
                        <input type="number" class="form-control has-feedback-left" id="balance" placeholder="จำนวนเงิน"
                            name="balance" autocomplete="off">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span> </div>

                    <div class="col-md-12 col-sm-12  form-group has-feedback" id="ip_delay">
                        <input type="number" class="form-control has-feedback-left" id="delay"
                            placeholder="ช่วงเวลาที่ล่าช้าเป็นนาที" name="delay" autocomplete="off">
                        <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span> </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>




<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function edit_token(id) {
    $('#edit').modal('show');
    $('#edit_id').val(id);

}

$(document).ready(function() {
    $('#form_edit_token').submit(function() {
        event.preventDefault();
        var form_brm = $('#form_edit_token').serializeArray();
        console.log(form_brm);
        $.ajax({
                url: "Line_notify/modify_token",
                type: 'POST',
                dataType: 'json',
                data: form_brm,
            })
            .done(function(re) {
                if (re.code == 1) {
                    swal(re.msg, "Edit Token Success !", "success");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    swal(re.msg, "Edit Token None Success !", "error");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            })
            .fail(function() {});
    });
});
</script>
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

    .modal-lg {
        max-width: 60%;
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
</style>
<div id="cover-spin"></div>
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>ระบบค้นหา<small>(จากเลขบัญชี)</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group row">
                            <div class="col-sm-10"> Account : ใส่เลขบัญชีลูกค้า Ex: 1647852345
                                <input type="text" value="" class="form-control" id="user_acc" maxlength="12" placeholder="เลขที่บัญชี">
                            </div>
                            <div class="col-sm-2"><br>
                                <button onClick="select_user(1)" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10"> Name : ใส่ชื่อลูกค้า Ex: ทดสอบ
                                <input type="text" value="" class="form-control" id="user_name" maxlength="12" placeholder="ชื่อ">
                            </div>
                            <div class="col-sm-2"><br>
                                <button onClick="select_user(2)" class="btn btn-info">ค้นหา</button>
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
                <table style="display: none;" id="tb_user" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%" id="t_all">
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <input type="text" class="form-control has-feedback text-center" readonly id="user">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 form-group text-right p-2 h6 ">
                                        <span class="">รหัสเข้าเล่น</span>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input type="text" class="form-control has-feedback text-center" readonly value="" id="username">
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 form-group text-right p-2 h6 ">
                                        <span class="">ชื่อสมาชิก</span>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input type="text" class="form-control has-feedback text-center" readonly value="" id="name">
                                        <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>

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
                                        <span class="">ยอดเครดิต</span>
                                    </div>
                                    <div class="col-md-9 ">
                                        <input type="text" class="form-control has-feedback text-center" readonly value="" id="credit">
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

                                            <div class="col-9">
                                                <input type="text" class="form-control has-feedback-left" readonly value="" id="bank">
                                                <span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <div class="col-2">
                                                <img id="img_bank" src="" width="90%">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-9">
                                                <input type="text" class="form-control has-feedback-left" readonly value="" id="account">
                                                <span class="fa fa-exchange  form-control-feedback left" aria-hidden="true"></span> </div>
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
                                                <input type="text" class="form-control has-feedback text-center" readonly value="" id="point">

                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3 form-group text-right p-2 h6">

                                                <span>หมุนวงล้อ</span>
                                            </div>
                                            <div class="col-md-6 form-group ">
                                                <input type="text" class="form-control has-feedback text-center" readonly value="" id="spin">

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
</div>
<script>
    function user_data(data) {

        var data = JSON.parse(($(data).data('edit')));

        var account = data.account;
        var bank_short = data.bank_short;
        var bank_th = data.bank_th;
        var name = data.name;
        var point = data.point;
        var spin = data.spin;
        var user = data.user;
        var username = data.username;

        var img_bnk = '<?= $this->config->item('tem_frontend') ?>img/mapraw_icon/bank/' + data.api_id + '.png';
        document.getElementById("img_bank").src = img_bnk;
        $("#user").val(user);
        $("#username").val(username);
        $("#name").val(name);
        $("#point").val(point);
        $("#spin").val(spin);
        $("#bank").val(bank_th);
        $("#account").val(account);

        $.ajax({
            url: 'sel_detail_account',
            type: 'POST',
            dataType: 'json',
            data: {
                user: user,
                name:name
            },
        }).done(function(res) {
            if (res.code == 1) {
                var credit = res.data.credit;
                $("#credit").val(credit);
                var conut3 = res.data.gu.length;
                var gu = res.data.gu;
                var content3 = '';
                for (var g = 0; g < conut3; g++) {
                    $("#group" + gu[g]['id']).prop("checked", true);
                    content3 += '<button  class="btn btn-info btn-sm">' + gu[g]['name'] + '</button>';

                }
                $('#group_user').html(content3);
            }
        })
    }

    function select_user(st) {
        $('#bodyhistory').html('');
        if (st == 1) {
            var user_acc = $('#user_acc').val();
            $('#user_name').val('');
			var user_name = '';
        } else if (st == 2) {
            var user_name = $('#user_name').val();
            $('#user_acc').val('');
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

        })
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
</script>
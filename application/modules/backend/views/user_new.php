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
<link
    href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css"
    rel="stylesheet">

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">

                        <li> <button onClick="open_close('1','m_creUser')"><i class="fa fa-plus"> New</i></button></li>
                        <!--			  <li> <button  onClick="open_close('1','m_creUser2')"><i class="fa fa-plus"> Old</i></button></li>-->

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <table id="user_data"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr>
                                                <th>No</th>
                                                <th>รหัส</th>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>ธนาคารลูกค้า</th>
                                                <th>เบอร์โทรลูกค้า</th>
                                                <th>คลาส.</th>
                                                <!-- <th>วันที่</th> -->
                                                <th>เครดิต</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; foreach ( $user as $_u => $us ) { ?>
                                            <tr align="center">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $us['user']; ?></td>
                                                <td><?php echo $us['username']; ?></td>
                                                <td><?php echo $us['name']; ?></td>
                                                <td style="text-align: left;"><?php
                        foreach ( $us['bank_user'] as $bnk_u ) {
                          ?>
                                                    <span
                                                        <?php if($bnk_u['status'] == 0){echo 'style="text-decoration: line-through;"';} ?>>
                                                        <?=$bnk_u['account']?>
                                                        <b>
                                                            <?=$bnk_u['bank_short']?>
                                                        </b> </span> <br>
                                                    <?php } ?>
                                                </td>
                                                <td><?=$us['username']?></td>
                                                <td>
                                                    <?php
                foreach($us['group_user'] as $gu){
                  echo '<button  class="btn btn-secondary btn-sm" title="กลุ่ม">'.$gu['name'].'</button>';
                }
                ?>
                                                </td>
                                                <!-- <td><?=$us['create_time'] == 0 ? '':date('d/m/Y H:i:s',$us['create_time'])?>
                          <b>
                          <?=$us['last_ip'] == 0 ? '': $us['last_ip']?>
                          </b></td> -->
                                                <td><a href="#" class="btn btn-secondary btn-sm"
                                                        onClick="see_credit('<?=$us['id']?>')" title="ดูเครดิต">C</a>
                                                </td>

                                            </tr>
                                            <?php $i++; } ?>
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

<!-- Modal -->
<!-- Modal ดูเครดิต -->
<div id="m_credit" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เครดิตคงเหลือ</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <span readonly type="text" class="form-control" id="credit"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal สมัครใหม่ -->
<div class="modal fade" id="m_creUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ฟอร์มสมัครใหม่<small>(สำหรับพนักงานสมัครให้)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left input_mask" id="form_cre_user">
                <div class="modal-body">
                    <div class="col-md-6 col-sm-6  form-group has-feedback" id="div_username">
                        <input type="text" class="form-control has-feedback-left" id="user" placeholder="เบอร์โทร"
                            required="required" name="username" autocomplete="off">
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-6 col-sm-6  form-group has-feedback" id="div_pass">
                        <input type="text" class="form-control" id="password" placeholder="Password" required="required"
                            name="password" onChange="ckpass()" autocomplete="off" value="">

                        <span class="form-control-feedback right" id="testpass"><i class=" fa fa-remove"></i></span>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">ธนาคาร</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control" name="bank_id" id="bank_id">
                                    <?php foreach($bank as $_b=>$bnk){ ?>
                                    <option value="<?=$bnk['id']?>">
                                        <?=$bnk['bank_th']?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">เลขที่บัญชี</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="number" class="form-control" id="account" name="account" placeholder=""
                                    maxlength="12" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button class="btn btn-success" onClick="cre_user('new')">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal สมัครระบบ ลูกค้าอยู่แล้ว -->
<script type="text/javascript">
$(document).ready(function() {
    $('#user_data').DataTable({
        "pageLength": 10,
        "lengthMenu": [
            [10, 20, 50],
            [10, 20, 50]
        ],
    });
});

function ckpass() {
    var pwdPolicy =  /^\w*(?=\w*\d)(?=\w*[a-z])\w.{7,15}$/;;
    var newpass = $('#password').val();
    if (newpass.match(pwdPolicy)) {
        $('#testpass').html('<i class="text-success fa fa-check"></i>');
        return true;
    } else {
        $('#testpass').html('<i class="text-danger fa fa-remove"></i>');
        return true;

    }
}

function open_close(status, tab) {
    if (status == 1) {
        $('#' + tab).modal();
    } else if (status == 2) {
        $('#' + tab).modal();
    }
}

function see_credit(user_id) {
    $('#m_credit').modal();
    $.ajax({
        url: 'see_credit',
        type: 'POST',
        dataType: 'json',
        data: {
            user_id: user_id
        },
    }).done(function(res) {
        $('#credit').html(res.amount+' เครดิต');
    });
}

function cre_user(action) {

    var pwdPolicy =  /^\w*(?=\w*\d)(?=\w*[a-z])\w.{7,15}$/;;
    var newpass = $('#password').val();
    if (newpass.match(pwdPolicy)) {
        $('#testpass').html('<i class="text-success fa fa-check"></i>');
        var data = $('#form_cre_user').serializeArray();
        $('#cover-spin').show();
        $.ajax({
                url: 'cre_user',
                type: 'POST',
                dataType: 'json',
                data: data,
            })
            .done(function(res) {
                if (res.code == 1) {
                    swal('สำเร็จ', res.msg, 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else if (res.code == 2) {
                    swal('ลองใหม่', res.msg, 'error');
                } else {
                    swal('ไม่สำเร็จ', res.msg, 'error');
                }
                $('#cover-spin').hide();
            })
            .fail(function() {
                console.log("error");
            });
    } else {
        swal('พาสเวิร์ดต้องมีอักษร + ตัวเลข', 'และไม่ต่ำกว่า 8 ตัวอักษร ไม่เกิน 15', 'error');
    }
}
</script>
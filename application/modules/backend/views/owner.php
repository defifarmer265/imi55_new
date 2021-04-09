<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link
    href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css"
    rel="stylesheet">
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>เพิ่มบัญชีผู้ใช้งาน<small></small></h2>
                    <div class="text-right">
                        <button class="btn btn-sm btn-outline-info" onClick="$('#o_cre').modal();"><i
                                class="fa fa-plus">
                                เพิ่มบัญชีผู้ใช้งาน</i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr style="text-align:center;">
                                                <th style="vertical-align: middle"> No.</th>
                                                <th style="vertical-align: middle"> Username </th>
                                                <th style="vertical-align: middle"> Name </th>
                                                <th style="vertical-align: middle"> tel </th>
                                                <th style="vertical-align: middle"> last_login </th>
                                                <th style="vertical-align: middle"> IP Address </th>
                                                <th style="vertical-align: middle"> Status </th>
                                                <th style="vertical-align: middle"> จัดการ </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; foreach($owner_list->result_array() as $row){?>
                                            <tr class="text-center">
                                                <td><?= $i;?></td>
                                                <td><?= $row['username'];?></td>
                                                <td>
                                                    <?php
                                                    if($row['name']!=''){
                                                        echo $row['name'];
                                                    }
                                                    else{
                                                        echo '-';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if($row['tel']!=''){
                                                        echo $row['tel'];
                                                    }
                                                    else{
                                                        echo '-';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if($row['last_login']!=''){
                                                        echo date('Y/m/d H:i:s',$row['last_login']);
                                                    }
                                                    else{
                                                        echo '-';
                                                    }
                                                ?>
                                                </td>
                                                <td><?= $row['lastip_login'];?>
                                                    <?php
                                                    if($row['lastip_login']!=''){
                                                        echo $row['lastip_login'];
                                                    }
                                                    else{
                                                        echo '-';
                                                    }
                                                ?>
                                                </td>
                                                <td align="center">
                                                    <?php 
                                                if($row['status'] == 1){
                                                    echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                                }else{ 
                                                    echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                                }?>
                                                </td>
                                                <td>
                                                    <button
                                                        onClick="$('#m_editPass').modal();$('#edit_adminId').val('<?=$row['id']?>');"
                                                        class="btn btn-secondary btn-sm" title="เปลี่ยนพาสเวิร์ด"><i
                                                            class="fa fa-key"></i></button>
                                                    <?php if($row['status'] == 1){ ?>
                                                    <button onClick="edit_status('0','<?=$row['id']?>')"
                                                        class="btn btn-success btn-sm" title="ปิด">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <?php }else if($row['status'] == 0){ ?>
                                                    <button onClick="edit_status('1','<?=$row['id']?>')"
                                                        class="btn btn-danger btn-sm" title="เปิด">
                                                        <i class="fa fa-close"></i></button>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                            <?php $i++;}?>
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

<div class="modal fade" id="o_cre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มบัญชีผู้ใช้งาน Owner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-label-left input_mask" id="form_creAdmin">
                    <div class="modal-body">
                        <div class="x_content">
                            <div class="row">
                                <h5>รายละเอียด</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="edit_name" name="name"
                                        placeholder="ชื่อ">
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="text" class="form-control" id="edit_tel" name="tel" placeholder="Tel">
                                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                </div>
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <div class="input-group">
                                        <input type="text" name="username" placeholder="Username" class="form-control">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                    <input type="text" class="form-control" id="inputSuccess5" name="password"
                                        placeholder="Password">
                                    <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="cre_owner()">Save changes</button>
            </div>

        </div>
    </div>
</div>


<!--เปลี่ยนพาส-->
<div class="modal fade" tabindex="-1" role="dialog" id="m_editPass" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เปลี่ยนพาสเวิร์ด<small>(ตรวจสอบชื่อ)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left input_mask" id="form_editPass">
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;"> <span
                            id="span_usernamePWD"></span>
                        <input type="hidden" name="admin_id" id="edit_adminId">
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Password" required="required"
                            name="password" id="val_editPass" autocomplete="off">
                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onClick="edit_pass()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script>
function cre_owner() {
    var data = $('#form_creAdmin').serializeArray();
    $.ajax({
            url: 'owner/cre_owner',
            type: 'POST',
            dataType: 'json',
            data: data,
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#m_creAdmin').modal('hide');
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

}




function edit_pass() {
    var data = $('#form_editPass').serializeArray();
    $.ajax({
            url: 'owner/edit_pass_owner',
            type: 'POST',
            dataType: 'json',
            data: data,
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
}


function edit_status(status, id) {
    swal({
        title: 'ปิดการใช้งาน?',
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: 'owner/edit_status',
                type: 'POST',
                dataType: 'json',
                data: {
                    status: status,
                    id: id
                },
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
                }
            });
        } else {

        }
    });
}
</script>
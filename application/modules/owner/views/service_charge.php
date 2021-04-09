<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link
    href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css"
    rel="stylesheet">
<link href="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
    rel="stylesheet">

<script src="<?php echo base_url()?>public/tem_admin/vendors/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css"
    integrity="sha512-zKvhCkM8b3JMULax/MlTkNk4gQwMbY8CqpDQC74/n7H6UK3HOZA/mO/fvjhVlh0V/E6PCrp4U6Lw6pnueS9HCQ=="
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css
">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"
    integrity="sha512-J+763o/bd3r9iW+gFEqTaeyi+uAphmzkE/zU8FxY6iAvD3nQKXa+ZAWkBI9QS9QkYEKddQoiy0I5GDxKf/ORBA=="
    crossorigin="anonymous"></script>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>จัดการแจ้งเตือน เว็บที่ไม่จ่ายรายเดือน<small></small></h2>
                <div class="text-right">
                    <button class="btn btn-sm btn-outline-info" onClick="$('#c_service').modal();"><i
                            class="fa fa-plus">
                            เพิ่มการแจ้งเตือน</i></button>
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
                                            <th style="vertical-align: middle"> #.</th>
                                            <th style="vertical-align: middle"> หัวข้อ </th>
                                            <th style="vertical-align: middle"> รายละเอียด </th>
                                            <th style="vertical-align: middle"> จำนวนเงิน</th>
                                            <th style="vertical-align: middle"> กำหนดวัน<br>
                                                <smal>(ปิดระบบ)</smal>
                                            </th>
                                            <th style="vertical-align: middle"> เปิดแจ้งเตือนค่าบริการ <br>
                                                <smal>(ช้ายปิด ขวาเปิด)</smal>
                                            </th>
                                            <th style="vertical-align: middle"> ปิดไม่ให้เข้าระบบ <br>
                                                <smal>(ช้ายปิด ขวาเปิด)</smal>
                                            </th>
                                            <th style="vertical-align: middle"> วันที<br>สร้าง

                                            </th>
                                            <th style="vertical-align: middle"> จัดการ </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach($service as $row){  $i++;?>
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?= $row['title'];?></td>
                                            <td><?= $row['detail'];?></td>
                                            <td class="text-center"><?= number_format($row['service_charge'],2)?></td>
                                            <td><?= date('d/m/Y H:i:s',$row['close_web'])?></td>
                                            <td class="text-center">
                                                <?php
                                                    if($row['status']==1){
                                                ?>

                                                <input type="checkbox" onchange="open_web('<?= $row['id']?>','0');"
                                                    id="status" value="c" class=" js-switch"
                                                    <?=$row['status'] == 1 ? 'checked':''?>>
                                                <?php }else{?>
                                                <input type="checkbox" onchange="open_web('<?= $row['id']?>','1');"
                                                    id="status" value="o" class=" js-switch"
                                                    <?php $row['status'] == 0 ? '':''?>>
                                                <?php }?>

                                            </td>



                                            <td class="text-center">
                                                <?php if($row['confirm_web'] == 1){?>
                                                <input type="checkbox" onchange="confirm_web('<?= $row['id']?>','0');"
                                                    id="idweb" value="<?= $row['id']?>" name="<?= $row['id']?>"
                                                    class=" js-switch" <?=$row['confirm_web'] == 1 ? 'checked':''?>>


                                                <?php }else{?>
                                                <input type="checkbox" onchange="confirm_web('<?= $row['id']?>','1');"
                                                    id="idweb" value="<?= $row['id']?>" name="<?= $row['id']?>"
                                                    class=" js-switch" <?=$row['confirm_web'] == 0 ? '':''?>>


                                                <?php }?>
                                            </td>

                                            <td>
                                                <?= date('d/m/Y ',$row['create_time'])?>
                                            </td>


                                            <td class="text-center">
                                                <button onclick="edit_id(<?= $row['id']?>)"
                                                    class="btn btn-secondary btn-sm" title="แก้ไขข้อมูล"><i
                                                        class="fas fa-cog fa-pulse fa-lg"></i></button>

                                                <button onclick="delete_id(<?=$row['id']?>)"
                                                    class="btn btn-danger btn-sm" title="ลบ"><i
                                                        class="far fa-trash-alt	fa-pulse"></i></button>

                                            </td>
                                        </tr>
                                        <?php }?>
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
<!-- เพิ่มแจ้งเตือน Service -->
<div class="modal fade bd-example-modal-lg" id="c_service" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เพิ่ม<small> (Service)</small></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left input_mask" id="f_service">
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <label for="exampleFormControlInput1">หัวข้อ</label>
                        <input type="text" class="form-control" id="title" placeholder="หัวข้อที่แจ้งเตือน">
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="exampleFormControlTextarea1">รายละเอียด</label>
                        <textarea class="form-control editor" id="detail" name="detail" rows="3"></textarea>

                    </div>

                    <div class="form-group  col-sm-6">
                        <label for="exampleFormControlInput1">จำนวนเงิน</label>
                        <input type="number" class="form-control" id="price" placeholder="ระบุจำนวนเงินที่ต้องชำระ">
                    </div>
                    <div class="form-group  col-sm-6">
                        <label for="exampleFormControlInput1">กำหนดวัน ปิดระบบ</label>
                        <input type="text" class="form-control" id="single_cal3" placeholder="First Name"
                            aria-describedby="inputSuccess2Status2">

                    </div>
                </div>
            </form>


            <div class="modal-footer">
                <button type="button" onClick="save()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!--แก้ไข-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="m_editPass" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เปลี่ยนรายละเอียด<small></small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left input_mask" id="f_service">
                <div class="modal-body">
                    <div class="form-group col-sm-12">

                        <input type="hidden" class="form-control" id="e_id" placeholder="หัวข้อที่แจ้งเตือน">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="exampleFormControlInput1">หัวข้อ</label>
                        <input type="text" class="form-control" id="e_title" placeholder="หัวข้อที่แจ้งเตือน">
                    </div>



                    <div class="form-group col-sm-12">
                        <label for="exampleFormControlTextarea1">รายละเอียด</label>
                        <textarea class="form-control editor" id="e_detail" rows="3"></textarea>
                    </div>

                    <div class="form-group  col-sm-6">
                        <label for="exampleFormControlInput1">จำนวนเงิน</label>
                        <input type="number" class="form-control" id="e_pricex" placeholder="ระบุจำนวนเงินที่ต้องชำระ">
                    </div>
                    <div class="form-group  col-sm-6">
                        <label for="exampleFormControlInput1">กำหนดวัน ปิดระบบ</label>
                        <input type="text" class="form-control" id="single_cal2" placeholder="First Name"
                            aria-describedby="inputSuccess2Status2">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onClick="update_service()" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
function save() {
    var title = $('#title').val();
    var detail = $('#detail').val();
    var price = $('#price').val();
    var dt2 = $('#single_cal3').val();

    if (title == "" || detail == "" || price == "" || dt2 == "") {
        swal({
            icon: "warning",
            text: "กรุณาใส่ข้อมูลให้ครบทุกช่อง",
        });
    } else {
        $.ajax({
                url: 'service/create_service',
                type: 'POST',
                dataType: 'json',
                data: {
                    t: title,
                    d: detail,
                    p: price,
                    da: dt2
                },
            })
            .done(function(res) {
                if (res.code == 1) {
                    $('#c_service').modal('hide');
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

}

function open_web(id, s) {
    var status = $('#status').val();
    console.log(s);
    $.ajax({
            url: 'service/update_status',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                st: s
            }
        })
        .done(function(res) {
            if (res.code == 1) {
                swal({
                    icon: "success",
                    text: res.msg,
                });

            } else {
                swal({
                    icon: "error",
                    text: res.msg,
                });
            }
        })
}


function confirm_web(id, s) {
    $.ajax({
            url: 'service/update_confirm_web',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                st: s
            }
        })
        .done(function(res) {
            if (res.code == 1) {
                swal({
                    icon: "success",
                    text: res.msg,
                });

            } else {
                swal({
                    icon: "error",
                    text: res.msg,
                });
            }
        })
}


function delete_id(id) {
    swal({
            text: "คุณแน่ใจที่จะลบ ID " + id + " หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'service/delete_service',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                        }
                    })
                    .done(function(res) {
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.msg,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal({
                                icon: "error",
                                text: res.msg,
                            });
                        }

                    })
            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    window.location.href = "";
                }, 1000);
            }

        });
}

function edit_id(id) {
    $.ajax({
            url: 'service/edit_service',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {

            $('#e_title').val(res.title);
            $('#e_detail').val(res.detail);
            $('#e_pricex').val(res.service_charge);
            $('#e_id').val(res.id);
            $('#single_cal2').val(moment.unix(res.close_web).format("Y/MM/DD "));
            $('#m_editPass').modal('show');
        })
        .fail(function() {
            console.log("error");
        });
}

function update_service() {
    var id = $('#e_id').val();
    var title = $('#e_title').val();
    var detail = $('#e_detail').val();
    var price = $('#e_pricex').val();
    var dt2 = $('#single_cal2').val();
    $.ajax({
            url: 'service/update_service',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                title: title,
                detail: detail,
                price: price,
                dt2: dt2
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#c_service').modal('hide');
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
</script>
<style>

@media only screen and (max-width: 600px) {
    .btn {
        border-radius: 15px;
        width: 259px;
    }
}
</style>
<!--<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">-->
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.css"
    rel="stylesheet">
<script src="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.js"></script>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ระบบค้นหา</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class=" radio">
                        <!-- เปิดปิด ระบบแอดเครดิต -->
                        <div class="form-group row">
                            <label>
                                <?php //echo $mainten[0]['id'];?>
                                <?php  if ($mainten[0]['status']=="0") {?>
                                <input type="checkbox" onchange="opencredit();" id="idcredit"
                                    value="<?= $mainten[0]['id'];?>" name="<?=$mainten[0]['name']?>" class="js-switch"
                                    <?=$mainten[0]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onchange="updatecredit();" id="idcredit"
                                    value="<?= $mainten[0]['id'];?>" name="<?=$mainten[0]['name']?>" class="js-switch"
                                    <?=$mainten[0]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[0]['detail']?></span>
                            </label>
                        </div>
                        <hr>
                        <!-- เปิดปิด ระบบแบงค์ทั้งหมด -->
                        <div class="form-group row">
                            <label>
                                <?php if ($mainten[1]['status']=="0") {?>
                                <input type="checkbox" onclick="open_bank();" id="idbank"
                                    value="<?= $mainten[1]['id'];?>" name="<?=$mainten[1]['name']?>" class="js-switch"
                                    <?=$mainten[1]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick='close_bank();' id="idbank"
                                    value="<?= $mainten[1]['id'];?> " name="<?=$mainten[1]['name']?>" class="js-switch"
                                    <?=$mainten[1]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[1]['detail']?></span>
                            </label>
                        </div>
                        <hr>
                        <!-- เปิดปิด ระบบลูกค้า -->
                        <div class="form-group row">
                            <label>
                                <?php if ($mainten[2]['status']=='0') {?>
                                <input type="checkbox" onclick="open_member();" id="id" value="<?= $mainten[2]['id']?>"
                                    name="<?=$mainten[2]['name']?>" class="js-switch"
                                    <?=$mainten[2]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick="close_member();" id="id" value="<?= $mainten[2]['id']?>"
                                    name="<?=$mainten[2]['name']?>" class="js-switch"
                                    <?=$mainten[2]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[2]['detail']?></span>
                            </label>
                        </div>
                        <hr>
                         <!-- เปิดปิด ระบบไลน์บอท -->
                         <?php if ($check_linebot = $this->db->where('detail', 'ระบบไลน์บอท')->get('maintenance')->row() != '') { ?>
                         <div class="form-group row">
                           <label>
                               <?php if ($mainten[9]['status']=='0') {?>
                               <input type="checkbox" onclick="open_linebot();" id="linebot" value="<?= $mainten[9]['id']?>"
                                   name="<?=$mainten[9]['name']?>" class="js-switch"
                                   <?=$mainten[9]['status'] == 0 ? '':''?> />
                               <?php } else {?>
                               <input type="checkbox" onclick="close_linebot();" id="linebot" value="<?= $mainten[9]['id']?>"
                                   name="<?=$mainten[9]['name']?>" class="js-switch"
                                   <?=$mainten[9]['status'] == 1 ? 'checked':''?> />
                               <?php }?>
                               <span
                                   style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[9]['detail']?></span>
                           </label>
                        </div>
                        <hr>
                        <?php } ?>
                        
                        <!-- เปิดปิด หน้าเว็บหลัก -->
                        <div class="form-group row">
                            <label>

                                <?php if ($mainten[3]['status']==0) {?>
                                <input type="checkbox" onclick="open_web();" id="id_web" value="<?= $mainten[3]['id']?>"
                                    name="<?=$mainten[3]['name']?>" class="js-switch"
                                    <?=$mainten[3]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick="close_web();" id="id_web"
                                    value="<?= $mainten[3]['id']?>" name="<?=$mainten[3]['name']?>" class="js-switch"
                                    <?=$mainten[3]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[3]['detail']?></span>
                            </label>
                        </div>
                        <hr>
                        <!-- เปิดปิด ประกาศหน้าเว็บ -->
                        <div class="form-group row">
                            <label>
                                <?php if ($mainten[4]['status']==0) {?>
                                <input type="checkbox" onclick="open_announce_web();" id="id_an_web"
                                    value="<?= $mainten[4]['id']?>" name="<?=$mainten[4]['name']?>" class="js-switch"
                                    <?=$mainten[4]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick="close_announce_web();" id="id_an_web"
                                    value="<?= $mainten[4]['id']?>" name="<?=$mainten[4]['name']?>" class="js-switch"
                                    <?=$mainten[4]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[4]['detail']?></span>
                            </label>



                            <form runat="server" enctype='multipart/form-data'>
                                <input type="file" name="img_mainte" id="imgInp" class="btn btn-outline-success">
                                <div class="form-group row ">&nbsp;&nbsp;&nbsp;
                                    <input type="hidden" name="id" id="idimg" value="<?php echo $mainten[4]['id'];?>">
                                    <button type="button" id="blah_bt" class="btn btn-outline-success"
                                        onclick="upload_announce_web()" style="display: none;">บันทึกข้อมูล</button>
                                </div>
                            </form>
                        </div>

                        <hr>

                        <!-- เปิดปิด ประกาศหน้าลูกค้า -->
                        <div class="form-group row">
                            <label>
                                <?php if ($mainten[5]['status']==0) {?>
                                <input type="checkbox" onclick="open_announce_member();" id="id_an_mem"
                                    value="<?= $mainten[5]['id']?>" name="<?=$mainten[5]['name']?>" class="js-switch"
                                    <?=$mainten[5]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick="close_announce_member();" id="id_an_mem"
                                    value="<?= $mainten[5]['id']?>" name="<?=$mainten[5]['name']?>" class="js-switch"
                                    <?=$mainten[5]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[5]['detail']?></span>
                            </label>

                            <form runat="server" enctype='multipart/form-data'>
                                <input type="file" name="img_mainte2" id="imgInp2" class="btn btn-outline-success">
                                <div class="form-group row ">&nbsp;&nbsp;&nbsp;
                                    <input type="hidden" name="id2" id="idimg2" value="<?php echo $mainten[5]['id'];?>">
                                    <button type="button" id="blah_bt2" class="btn btn-outline-success"
                                        onclick="upload_announce_member()" style="display: none;">บันทึกข้อมูล</button>
                                </div>
                            </form>
                        </div>
                        <hr>

                        <!-- เปิดปิด ประกาศธนาคารปิดปรับปรุง -->
                        <div class="form-group row">
                            <label>

                                <?php if ($mainten[6]['status']==0) {?>
                                <input type="checkbox" onclick="open_bank_maintenance();" id="id_bankmain" value="<?= $mainten[6]['id']?>"
                                    name="<?=$mainten[6]['name']?>" class="js-switch"
                                    <?=$mainten[6]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick="close_bank_maintenance();" id="id_bankmain"
                                    value="<?= $mainten[6]['id']?>" name="<?=$mainten[6]['name']?>" class="js-switch"
                                    <?=$mainten[6]['status'] == 1 ? 'checked':''?> />
                                <?php }?>


                            </label>
                            <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <span style="font-size: 18px;padding-left: 15px;padding-right: 100px;color: #000" ><?=$mainten[6]['detail']?> <i class="fa fa-caret-down"></i></span>
                            </a>
                            <div class="collapse" id="collapseExample" style="padding-left: 80px; font-size: 16px;">
                                <ul class="list-group">
                                    <?php foreach ($bank as $bnk) { ?>
                                        <li class="list-group-item" data-toggle="modal" data-target="#alertLabel" aria-hidden="true" data-edit="<?php echo htmlspecialchars(json_encode($bnk, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" onclick="edit(this)"><?=$bnk['bank_th']?></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <!-- end -->
                        <!-- เปิดปิด เปิดปิดระบบเช็คอิน off/on -->
                        <div class="form-group row">
                            <label>

                                <?php if ($mainten[7]['status']==0) {?>
                                <input type="checkbox" onclick="open_checkin();" id="id_checkin" value="<?= $mainten[7]['id']?>"
                                    name="<?=$mainten[7]['name']?>" class="js-switch"
                                    <?=$mainten[7]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick="close_checkin();" id="id_checkin"
                                    value="<?= $mainten[7]['id']?>" name="<?=$mainten[7]['name']?>" class="js-switch"
                                    <?=$mainten[7]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[7]['detail']?></span>
                            </label>
                        </div>
                        <hr>
                        <!-- end -->
                         <!-- เปิดปิด เปิดปิดระบบแลกเครดิต off/on -->
                          <div class="form-group row">
                            <label>

                                <?php if ($mainten[8]['status']==0) {?>
                                <input type="checkbox" onclick="open_reward();" id="id_reward" value="<?= $mainten[8]['id']?>"
                                    name="<?=$mainten[8]['name']?>" class="js-switch"
                                    <?=$mainten[8]['status'] == 0 ? '':''?> />
                                <?php } else {?>
                                <input type="checkbox" onclick="close_reward();" id="id_reward"
                                    value="<?= $mainten[8]['id']?>" name="<?=$mainten[8]['name']?>" class="js-switch"
                                    <?=$mainten[8]['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[8]['detail']?></span>
                            </label>
                        </div>
                        <hr>
                        <!-- end -->


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ประกาศหน้าเว็บ</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <img id="blah" class="img-fluid" src="#" width="500" height="500" alt="your image"
                        style="display: none;" />
                    <?php
                            if ($mainten[4]['id']) {
                                $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/').'/'.$mainten[4]['name'];
                                if (file_exists($path)) {
                                    ?>
                    <img id="blah_db" class="img-fluid"
                        src="<?=$this->config->item('tem_frontend_img').'maintenance/'.$mainten[4]['name']?>"
                        width="500" height="500" alt="your image" />
                    <?php
                                }
                            }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ประกาศหน้า Memeber</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <img id="blah2" class="img-fluid" src="#" width="500" height="500" alt="your image" style="display: none;" />
                    <?php
                            if ($mainten[5]['id']) {
                                $path = realpath(APPPATH.'../public/tem_frontend/img/maintenance/').'/'.$mainten[5]['name'];
                                if (file_exists($path)) {
                                    ?>
                    <img id="blah_db2" class="img-fluid"
                        src="<?=$this->config->item('tem_frontend_img').'maintenance/'.$mainten[5]['name']?>"
                        width="500" height="500" alt="your image" />
                    <?php
                                }
                            }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- get user credit modal -->
<div class="modal fade" id="alertLabel" tabindex="-1" role="dialog" aria-labelledby="alertLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="creditLabel">ตั้งค่าการแสดงแจ้งเตือน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
      <div class="form-group row" style="margin-left: 5px;">
               <img id="img_bank" src="" width="8%" > <h5 id="bank_name" style="margin-left: 5px; margin-top: 6px;"></h5>
      </div>

            <form style="padding: 15px" runat="server" enctype='multipart/form-data'>
                                <input type="hidden" name="bank" id="bank_id" value="">
                                <input type="file" name="img_mainte3" id="imgInp3" class="btn btn-outline-success">
                                <div class="form-group row ">&nbsp;&nbsp;&nbsp;
                                    <input type="hidden" name="id3" id="idimg3" value="<?php echo $mainten[6]['id'];?>">
                                    <!-- <button type="button" id="blah_bt3" class="btn btn-outline-success"
                                        onclick="upload_announce_member()" style="display: none;">บันทึกข้อมูล</button> -->
                                </div>
                                <div class="form-group row">
                                <div class="col-md-3 form-group text-right p-2 h6 ">
                                    <span class="">เวลาเริ่มต้น</span>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control has-feedback-center" id="start_time" name="start_time" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 form-group text-right p-2 h6 ">
                                    <span class="">เวลาสิ้นสุด</span>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control has-feedback-center" id="end_time" name="end_time" >
                                </div>
                            </div>

                            </form>
      </div>
      <div class="modal-footer">
          <button onclick="update_setting()" type="button" class="btn btn-success float-right">บันทึกข้อมูล</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end user credit modal-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function readURL(input) {
    $('#blah').show();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            $('#blah_db').hide();
            $('#blah_bt').show();
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function readURL2(input) {
    $('#blah2').show();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#blah2').attr('src', e.target.result);
            $('#blah_db2').hide();
            $('#blah_bt2').show();
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}




//ตรวจเช็คนามสกุลไฟล์ให้อัพโหลดได้เฉพาะ jpg png  gif เท่านั้น ในส่วนของประกาศหน้าเว็บ
$('#imgInp').change(function() {
    var fileExtension = ['jpg', 'png', 'gif'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        swal('error', 'กรุณาอัพโหลดไฟล์ข้อมูลที่มีนามสกุล jpg  png gif เท่านั้น', "error")
            .then(function(sw) {
                location.reload();
            });
    }
});
//ตรวจเช็คนามสกุลไฟล์ให้อัพโหลดได้เฉพาะ jpg png gif เท่านั้น ในส่วนของประกาศหน้าลูกค้า
$('#imgInp2').change(function() {
    var fileExtension = ['jpg', 'png', 'gif'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        swal('error', 'กรุณาอัพโหลดไฟล์ข้อมูลที่มีนามสกุล jpg  png gif เท่านั้น', "error")
            .then(function(sw) {
                location.reload();
            });
    }
});

$('#imgInp3').change(function() {
    var fileExtension = ['jpg', 'png', 'gif'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        swal('error', 'กรุณาอัพโหลดไฟล์ข้อมูลที่มีนามสกุล jpg  png gif เท่านั้น', "error")
            .then(function(sw) {
                location.reload();
            });
    }
});


$("#imgInp").change(function() {
    readURL(this);
});
$("#imgInp2").change(function() {
    readURL2(this);
});


// สำหรับอัพโหลดรูปภาพในส่วนของ หน้าเว็บ

function upload_announce_web() {
    var data = new FormData();
    data.append('img_mainte', $('#imgInp')[0].files[0]);
    data.append('id', $('#idimg').val());
    swal({
            text: "อัพโหลดไฟล์รูปภาพ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {


                $.ajax({
                        url: 'upload_announce_web',
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data,
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('ผิดพลาด', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "error")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}





// สำหรับอัพโหลดรูปภาพในส่วนของ หน้าลูกค้า
function upload_announce_member() {
    var data = new FormData();
    data.append('img_mainte2', $('#imgInp2')[0].files[0]);
    data.append('id', $('#idimg2').val());
    swal({
            text: "อัพโหลดไฟล์รูปภาพ หน้าลูกค้า",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'upload_announce_member',
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data,
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function updatecredit() {
    swal({

            text: "คุณต้องการปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#idcredit').val();
                $.ajax({
                        url: '<?php base_url()?>enable_credit',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });

}

function opencredit() {
    swal({

            text: "คุณต้องการเปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#idcredit').val();
                $.ajax({
                        url: '<?php base_url()?>open_credit',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}
function open_linebot() {
    swal({
            text: "คุณต้องการเปิดระบบไลน์บอท ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var linebot = $('#linebot').val();
                $.ajax({
                        url: '<?php base_url()?>open_linebot',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: linebot
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function close_linebot() {
    swal({
            text: "คุณต้องการปิดระบบไลน์บอท ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var linebot = $('#linebot').val();
                console.log(linebot);
                $.ajax({
                        url: '<?php base_url()?>close_linebot',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: linebot
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}
function open_bank() {
    swal({
            text: "คุณต้องการเปิดระบบแบงค์ทั้งหมด",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id_bank = $('#idbank').val();
                $.ajax({
                        url: '<?php base_url()?>open_bank',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id_bank
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function close_bank() {
    swal({
            text: "คุณต้องการปิดระบบแบงค์ทั้งหมด",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var id_bank = $('#idbank').val();
                $.ajax({
                        url: '<?php base_url()?>close_bank',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id_bank
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function open_member() {
    swal({
            text: "คุณต้องการเปิดระบบลูกค้า",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id').val();
                $.ajax({
                        url: '<?php base_url()?>open_member',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });

}

function close_member() {
    swal({
            text: "คุณต้องการปิดระบบลูกค้า",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id').val();
                $.ajax({
                        url: '<?php base_url()?>close_member',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function open_web() {
    swal({
            text: "คุณต้องการเปิดหน้าเว็บหลัก",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_web').val();
                $.ajax({
                        url: '<?php base_url()?>open_web',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function close_web() {
    swal({
            text: "คุณต้องการปิดหน้าเว็บหลัก",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_web').val();
                $.ajax({
                        url: '<?php base_url()?>close_web',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function open_announce_web() {
    swal({
            text: "คุณต้องการเปิดประกาศหน้าเว็บ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_an_web').val();
                $.ajax({
                        url: '<?php base_url()?>open_announce_web',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });

}

function close_announce_web() {
    swal({
            text: "คุณต้องการปิดประกาศหน้าเว็บ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_an_web').val();
                $.ajax({
                        url: '<?php base_url()?>close_announce_web',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function open_announce_member() {
    swal({
            text: "คุณต้องการเปิดประกาศหน้าลูกค้า",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_an_mem').val();
                $.ajax({
                        url: '<?php base_url()?>open_announce_member',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function close_announce_member() {
    swal({
            text: "คุณต้องการปิดประกาศหน้าลูกค้า",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_an_mem').val();
                $.ajax({
                        url: '<?php base_url()?>close_announce_member',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });


}

function open_bank_maintenance() {
    swal({
            text: "คุณต้องการเปิดประกาศธนาคารปิดปรับปรุง",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_bankmain').val();
                $.ajax({
                        url: '<?php base_url()?>open_bank_maintenance',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function close_bank_maintenance() {
    swal({
            text: "คุณต้องการปิดประกาศธนาคารปิดปรับปรุง",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_bankmain').val();
                $.ajax({
                        url: '<?php base_url()?>close_bank_maintenance',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });


}

function open_checkin(){
    swal({
            text: "คุณต้องการเปิดใช้งาน",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_checkin').val();
                $.ajax({
                        url: '<?php base_url()?>open_checkin',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'ยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function close_checkin(){
    swal({
            text: "คุณต้องการปิดใช้งาน",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_checkin').val();
                $.ajax({
                        url: '<?php base_url()?>close_checkin',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });
            } else {
                swal('สำเร็จ', 'ยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}


function open_reward(){
    swal({
            text: "คุณต้องการเปิดใช้งาน",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_reward').val();
                $.ajax({
                        url: '<?php base_url()?>open_reward',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'ยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function close_reward(){
    swal({
            text: "คุณต้องการปิดใช้งาน",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#id_reward').val();
                $.ajax({
                        url: '<?php base_url()?>close_reward',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });
            } else {
                swal('สำเร็จ', 'ยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function edit(data)
{
    // console.log($(data).data('edit').id);
    var data = ($(data)).data('edit') ;
    $('#bank_name').text(data.bank_th);
    $('#bank_id').val(data.bank_id);
    var img_bank = '<?=$this->config->item('tem_frontend')?>img/mapraw_icon/bank/'+data.api_id+'.png';
    document.getElementById('img_bank').src = img_bank;

}

function update_setting(){
    var data = new FormData();
    data.append('img_mainte3', $('#imgInp3')[0].files[0]);
    data.append('id', $('#idimg3').val());
    data.append('bank_id',$('#bank_id').val());
    data.append('start_time',$('#start_time').val());
    data.append('end_time',$('#end_time').val());

    // console.log('test')
    swal({
            text: "อัพโหลดไฟล์รูปภาพ หน้าทำการฝาก",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'update_bank_setting',
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data
                    })
                    .done(function(res) {
                        // success

                        console.log(res)
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วค่ะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });


}

</script>

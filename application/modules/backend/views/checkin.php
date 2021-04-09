<style>
@media only screen and (max-width: 600px) {
    .btn {
        border-radius: 15px;
        width: 259px;
    }
}
</style>
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.css"
    rel="stylesheet">
<script src="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.js"></script>
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-11 col-sm-11 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ตั้งค่าคะแนนเช็คอิน</h2>
                    <!--<button  onClick="cre_checkin()"><i class="fa fa-plus"></i></button><small></small></h2> -->
                    <div class="clearfix"></div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive1"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%">
                                        <thead style="background-color:#12205F;color: #FFF" class="text-center">
                                            <tr>
                                                <th width="1%">No</th>
                                                <th width="1%">รายการ</th>
                                                <th width="1%">จำนวนคะแนนพ้อยที่ได้</th>
                                                <th width="1%">จำนวนสปินที่ได้</th>
                                                <th width="1%">วันที่เช็คอิน</th>
                                                <th width="1%">วันที่เช็คอินแล้ว</th>
                                                <th width="1%">วันที่ไม่เช็คอิน</th>
                                                <th width="1%"> สถานะเปิดใช้งาน</th>
                                                <th width="2%">ควบคุม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    if(empty($checkin)){
                                    	echo '<tr><td colspan="6" class="text-center text-danger">ขณะนี้ยังไม่มีข้อมูลถูกเพิ่มในขณะนี้</td></tr>';
                                    }
                                    	$num = 1; foreach($checkin as $chk){ 
                                    ?>
                                            <tr class="text-center">
                                                <td><?=$num;?></td>
                                                <td><?=$chk['name']?></td>
                                                <td class="text-center"><?=$chk['point']?></td>
                                                <td class="text-center"><?=$chk['spin'];?></td>
                                                <td>
                                                    <img width="30px" height="30px"
                                                        src="<?=$this->config->item('tem_frontend_img').'/checkin/true/'.$chk['img_check_in'];?>"
                                                        onclick="edit_img_ck('<?=$chk['id']?>');"
                                                        value="<?=$chk['id']?>">
                                                </td>
                                                <td>
                                                    <img  width="30px" height="30px"
                                                        src="<?=$this->config->item('tem_frontend_img').'/checkin/ck/'.$chk['img_true_check_in'];?>"
                                                        onclick="edit_img_ck3('<?=$chk['id']?>');"
                                                        value="<?=$chk['id']?>">
                                                </td>
                                                <td>
                                                    <img  width="30px" height="30px" src="<?=$this->config->item('tem_frontend_img').'/checkin/flase/'.$chk['img_no_check_in'];?>
                                          " onclick="edit_img_ck2('<?=$chk['id']?>');" value="<?=$chk['id']?>">
                                                </td>
                                                <td class=" text-center"><?php
                                       if($chk['status'] == 1){
                                       ?>
                                                    <a href="#" onClick="edit_checkin('<?=$chk['id']?>','0')"
                                                        title="ปิดการใช้งานตัวนี้">
                                                        <i style="color:#3AED33;" class="fa fa-check"></i>
                                                    </a>
                                                    <?php
                                          }else{
                                          ?>
                                                    <a href="#" onClick="edit_checkin('<?=$chk['id']?>','1')"
                                                        title="เปิดใช้งานตัวนี้">
                                                        <i style="color:#F51F23;" class="fa fa-remove"></i>
                                                    </a>
                                                    <?php 
                                          }
                                          ?>
                                                </td>
                                                <td class="text-center">
                                                    <!-- <button class="btn btn-danger btn-sm" onClick="remove_checkin('<?php //$chk['id'];?>')" title="ลบข้อมูล">
                                          <i style="color:#F51F23;" class="fa fa-remove text-white"></i>
                                          </button> -->
                                                    <button class="btn btn-secondary btn-sm" id="btn_editspin"
                                                        onclick="rs_check('<?=$chk['id']?>');" value="<?=$chk['id']?>"
                                                        title="แก้ไขการตั้งค่า">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php 
                                    $num++;}
                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <table>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 col-sm-11 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ตั้งค่าโปรโมชั่นยอดฝากแรก</h2>
                    <!--<button  onClick="cre_checkin()"><i class="fa fa-plus"></i></button><small></small></h2> -->
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="" class="table table-striped table-bordered dt-responsive nowrap"
                                        cellspacing="0" width="100%">
                                        <thead style="background-color:#12205F;color: #FFF" class="text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>รายการ</th>
                                                <th>จำนวน</th>
                                                <th>สถานะเปิดใช้งาน</th>
                                                <th>หมายเหตุ</th>
                                                <th>ควบคุม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    if(empty($setting)){
                                    	echo '<tr><td colspan="6" class="text-center text-danger">ขณะนี้ยังไม่มีข้อมูลถูกเพิ่มในขณะนี้</td></tr>';
                                    }
                                    	$num = 1; foreach($setting as $set){
                                    ?>
                                            <tr>
                                                <td><?=$num;?></td>
                                                <!-- รายการ -->
                                                <td>
                                                    <?php 
                                          if ($set['name'] == 'spin_amount') {
                                            echo "จำนวนสปินที่ได้รับ";
                                          }
                                          else if($set['name'] == 'deposit_day')
                                          {
                                            echo "จำนวนยอดฝากแรก";
                                          }?>
                                                </td>
                                                <!-- จำนวนเงิน (บาท)-->
                                                <td class="text-center">
                                                    <?php
                                          if ($set['name'] == 'spin_amount') {
                                            echo number_format($set['code']); 
                                            echo " สปิน";
                                          }
                                          else if($set['name'] == 'deposit_day')
                                          {
                                            echo number_format($set['code']); 
                                            echo " บาท";
                                          }
                                          
                                          ?>
                                                </td>

                                                <!-- หมายเหตุ -->
                                                <td>
                                                    <?php 
                                          if ($set['name'] == 'spin_amount') {
                                            echo "สปินที่ได้รับจากโปรโมชั่นยอดฝากแรกของวัน";
                                          }
                                          else if($set['name'] == 'deposit_day')
                                          {
                                            echo "เป็นเงื่อนไขโปรโมชั่นยอดฝากแรกของวัน";
                                          }
                                          ?>
                                                </td>
                                                <!-- ควบคุม -->
                                            <td class="text-center">
                                                <!-- <button class="btn btn-danger btn-sm" onClick="remove_checkin('<?php //$set['id'];?>')" title="ลบข้อมูล">
                                        <i style="color:#F51F23;" class="fa fa-remove text-white"></i>
                                        </button> -->
                                                <button class="btn btn-secondary btn-sm" id="btn_editspin"
                                                    onclick="edit_spinsetting('<?=$set['id']?>');"
                                                    value="<?=$set['id']?>" title="แก้ไขการตั้งค่า"><i
                                                        class="fa fa-pencil"></i>
                                                </button>
                                            </td>

                                        <!-- สถานะเปิดใช้งาน -->
                                        <td class="text-center">
                                                <?php
                                        if($set['status'] == 1){
                                        ?>
                                                <a href="#" onClick="edit_first_deposit('<?=$set['id']?>','0')"
                                                    title="ปิดการใช้งานตัวนี้">
                                                    <i style="color:#3AED33;" class="fa fa-check"></i>
                                                </a>
                                                <?php
                                        }else{
                                        ?>
                                                <a href="#" onClick="edit_first_deposit('<?=$set['id']?>','1')"
                                                    title="เปิดใช้งานตัวนี้">
                                                    <i style="color:#F51F23;" class="fa fa-remove"></i>
                                                </a>
                                                <?php 
                                        }
                                        ?>
                                            </td>
                                            </tr>
                                            <?php 
                                    $num++;}
                                    ?>
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

    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ระบบแลกเครดิต</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class=" radio">
                        <!-- เปิดปิด ระบบแอดเครดิต -->
                        <div class="form-group row">
                            <label>
                                       
                                <?php  if($setting3->status == 0){?>
                                <input type="checkbox" onchange="turnon_exchange();" id="idturnon"
                                    value="" name="" class="js-switch"
                                    <?=$setting3->status == 0 ? '':''?> />
                                <?php }else{?>
                                <input type="checkbox" onchange="turnoff_exchange();" id="idturnoff"
                                    value="" name="" class="js-switch"
                                    <?=$setting3->status == 1 ? 'checked':''?> />
                                <?php }?>
                                <span style="font-size: 18px;padding: 15px;color: #000">แลกเครดิตอัตโนมัติ</span>
                            </label>
                        </div>
                        <!-- end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="modal_pointsetting" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ตั้งค่ารับคะแนน <small>(สำหรับพนักงาน)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left" id="form_pointsetting" style="font-size: 18px;">
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
                        <input type="hidden" name="id" id="check_id">
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">รายการ</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" id="name_point" name="name_point"
                                    autocomplete="off" readonly>
                                <input type="hidden" class="form-control" id="id_point" name="id_point"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">จำนวน</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="number" class="form-control" id="point_p" name="point_p"
                                    placeholder="คะแนนที่ได้รับ" maxlength="12" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12  form-group has-feedback">
                  <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">จำนวนสปิน</label>
                    <div class="col-md-9 col-sm-9 ">
                      <input type="number" class="form-control" id="num_spins" name="num_spins" placeholder="จำนวนสปินที่ได้รับ" maxlength="12" autocomplete="off" >
                    </div>
                  </div>
                  </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="modal_spinsetting" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ตั้งค่ารับสปิน <small>(สำหรับพนักงาน)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left" id="form_spinsetting" style="font-size: 18px;">
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
                        <input type="hidden" name="id" id="check_id">
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">รายการ</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" id="name_spin" name="name_spin"
                                    autocomplete="off" readonly>
                                <input type="hidden" class="form-control" id="id_spin" name="id_spin"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">จำนวน</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="number" class="form-control" id="point_spin" name="point_spin"
                                    placeholder="คะแนนที่ได้รับ" maxlength="12" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12 col-sm-12  form-group has-feedback">
                  <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">จำนวนสปิน</label>
                    <div class="col-md-9 col-sm-9 ">
                      <input type="number" class="form-control" id="num_spins" name="num_spins" placeholder="จำนวนสปินที่ได้รับ" maxlength="12" autocomplete="off" >
                    </div>
                  </div>
                  </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal edit -->
<!-- modal edit checkin all -->
<div class="modal fade" id="modal_rs_checking" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting CHeck in<small>(สำหรับพนักงาน)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left" id="form_upcheckin" style="font-size: 18px;">
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
                        <input type="hidden" name="editid" id="editcheck_id">
                    </div>
                    <!-- <div class="col-md-12 col-sm-12  form-group has-feedback">
                  <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 ">รายการ</label>
                    <div class="col-md-9 col-sm-9 ">
                      <input type="text" class="form-control" id="editname" name="editname" placeholder="ชื่อเช็คอิน"  autocomplete="off" >
                    </div>
                  </div>
                  </div> -->
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">จำนวนพอยท์</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="number" class="form-control" id="editpoint" name="editpoint"
                                    placeholder="คะแนนที่ได้รับ" maxlength="12" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">จำนวนสปิน</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="number" class="form-control" id="editspins" name="editspins"
                                    placeholder="จำนวนสปินที่ได้รับ" maxlength="12" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="form_upCheckin();" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editimg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">อัพโหลดรูปภาพ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype='multipart/form-data'>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <figure class="figure text-center d-none mt-2">
                            <img id="imgUpload" class="figure-img img-fluid rounded" alt="">
                        </figure>
                        <input type="hidden" name="e_img_id" id="e_img_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="up_img1()">บันทึกรูปภาพ</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editimg2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">อัพโหลดรูปภาพ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype='multipart/form-data'>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input " name="file" id="customFile2" required>
                            <label class="custom-file-label " for="customFile">Choose file</label>
                        </div>
                        <figure class="figure text-center d-none mt-2">
                            <img id="imgUpload2" class="figure-img img-fluid rounded" alt="">
                        </figure>
                        <input type="hidden" name="e_img_id" id="e_img_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="up_img2()">บันทึกรูปภาพ</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editimg3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">อัพโหลดรูปภาพ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype='multipart/form-data'>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input " name="file" id="customFile3" required>
                            <label class="custom-file-label " for="customFile">Choose file</label>
                        </div>
                        <figure class="figure text-center d-none mt-2">
                            <img id="imgUpload2" class="figure-img img-fluid rounded" alt="">
                        </figure>
                        <input type="hidden" name="e_img_id" id="e_img_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="up_img3()">บันทึกรูปภาพ</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function form_creCheckin() {
    swal({
            title: "คุณแน่ใจที่จะทำการเพิ่ม",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var data = $('#form_checkin').serializeArray();
                $.ajax({
                        url: 'cre_checkin',
                        type: 'POST',
                        dataType: 'json',
                        data: data,
                    })
                    .done(function(res) {
                        if (res.code == 1) {
                            swal(res.title, res.msg, 'success').then(function(w) {
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
                swal("ยกเลิก", "การการเพิ่มข้อมูลเรียบร้อย!", "error");
            }

        });


}

function cre_checkin() {
    $('#mod_cre_checkin').modal();
    $('#check_id').val('');
    $('#name').val('');
    $('#point').val('');
    // $('#num_spins').val('');
}

function edit_checkin(id, status) {
    swal({
        title: 'ต้องการเปิด หรือ ปิดใช้ระบบ?',
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                    url: 'edit_checkin',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        status: status
                    },
                }).done(function(res) {
                    //console.log(res);
                    if (res.code == 1) {
                        swal(res.title, res.msg, 'success').then(function(w) {
                            setTimeout(function() {
                                location.reload();
                            }, 700);
                        });
                    } else {
                        swal(res.title, res.msg, 'error').then(function(w) {
                            setTimeout(function() {
                                location.reload();
                            }, 700);
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        }
    })
}

function edit_first_deposit(id, status) {
    swal({
        title: 'ต้องการเปิด หรือ ปิดใช้ระบบ?',
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                    url: 'edit_first_deposit',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        status: status
                    },
                }).done(function(res) {
                    //console.log(res);
                    if (res.code == 1) {
                        swal(res.title, res.msg, 'success').then(function(w) {
                            setTimeout(function() {
                                location.reload();
                            }, 700);
                        });
                    } else {
                        swal(res.title, res.msg, 'error').then(function(w) {
                            setTimeout(function() {
                                location.reload();
                            }, 700);
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        }
    })
}

// แสดงข้อมูลในกล่อง modal  edit
function rs_check(id) {

    $.ajax({
            url: 'read_checking',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {
            $('#modal_rs_checking').modal();
            $('#editcheck_id').val(res.id);
            $('#editname').val(res.name);
            $('#editpoint').val(res.point);
            $('#editspins').val(res.spin);
        })
        .fail(function() {
            console.log("error");
        });

}



// function อัพเดท checkin
function form_upCheckin() {
    // var data = $('#form_upcheckin').serializeArray();
    swal({
            title: "คุณแน่ใจที่จะทำการเปลี่ยนแปลง",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var id = $('#editcheck_id').val();
                // var name = $('#editname').val();
                var point = $('#editpoint').val();
                var spins = $('#editspins').val();
                $.ajax({
                        url: 'up_checkin_frm',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,
                            spins: spins,
                            point: point
                        },
                    })
                    .done(function(res) {
                        if (res.code == 1) {
                            swal(res.title, res.msg, 'success').then(function(w) {
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
                swal("ยกเลิก", "การเปลี่ยนแปลงข้อมูลเรียบร้อย!", "error");
            }

        });



}

function edit_spinsetting(id) {
    $.ajax({
            url: 'spinsetting_editFrm',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {
            $('#point_spin').val(res.code);

            if (res.name == 'spin_amount') {
                $('#name_spin').val('จำนวนเงิน ต่อ spin');
            } else {
                $('#name_spin').val('จำนวน spin สูงสุดต่อวันและต่อคน');
            }

            $('#id_spin').val(res.id);
            $('#modal_spinsetting').modal('show');

        })
        .fail(function() {
            console.log("error");
        });
}

$(document).ready(function() {
    $('#form_spinsetting').submit(function() {
        if (confirm('ยืนยันการแก้ไข')) {
            $.ajax({
                url: "edit_spinsetting",
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                success: function(data) {
                    $('#modal_spinsetting').modal('hide');
                },
            });
        }

    });
});


function edit_pointsetting(id) {
    $.ajax({
            url: 'pointsetting_editFrm',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {
            $('#point_p').val(res.code);

            if (res.name == 'point_amount') {
                $('#name_point').val('จำนวนเงิน ต่อ point');
            } else {
                $('#name_point').val('จำนวน point สูงสุดต่อวันและต่อคน');
            }

            $('#id_point').val(res.id);
            $('#modal_pointsetting').modal('show');

        })
        .fail(function() {
            console.log("error");
        });
}

$(document).ready(function() {
    $('#form_pointsetting').submit(function() {

        if (confirm('ยืนยันการแก้ไข')) {
            $.ajax({
                url: "edit_pointsetting",
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                success: function(data) {
                    $('#modal_pointsetting').modal('hide');

                },
            });
        }
    });

});


function turnon_exchange() {
    swal({

            text: "คุณต้องการเปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#idturnon').val();
                $.ajax({
                        url: '<?php base_url()?>enable_credit',
                        type: 'POST',
                        dataType: 'json',
                        
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

function turnoff_exchange() {
    swal({

            text: "คุณต้องการปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#idturnoff').val();
                $.ajax({
                        url: '<?php base_url()?>disable_credit',
                        type: 'POST',
                        dataType: 'json',
                        
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


//  checkin all
$(document).ready(function() {
    $('#datatable-responsive1').DataTable({
        "pageLength": 5,
        "oLanguage": {
            "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
            "sSearch": "ค้นหา :"
        },
        "lengthMenu": [
            [5, 10, 30, -1],
            [5, 10, 30, "All"]
        ]
    });
});

$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop()
    $(this).siblings('.custom-file-label').html(fileName)
    if (this.files[0]) {
        var reader = new FileReader()
        $('.figure').addClass('d-block')
        reader.onload = function(e) {
            $('#imgUpload2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0])
    }

})

$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop()
    $(this).siblings('.custom-file-label').html(fileName)
    if (this.files[0]) {
        var reader = new FileReader()
        $('.figure').addClass('d-block')
        reader.onload = function(e) {
            $('#imgUpload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0])
    }

})

function edit_img_ck(id) {

    $.ajax({
            url: 'r_img_ck',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {
            $('#editimg').modal();
            $('#e_img_id').val(res.id);
        })
        .fail(function() {
            console.log("error");
        });

}

function edit_img_ck2(id) {

    $.ajax({
            url: 'r_img_ck2',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {
            $('#editimg2').modal();
            $('#e_img_id').val(res.id);
        })
        .fail(function() {
            console.log("error");
        });

}


function edit_img_ck3(id) {

    $.ajax({
            url: 'r_img_ck3',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {
            $('#editimg3').modal();
            $('#e_img_id').val(res.id);
        })
        .fail(function() {
            console.log("error");
        });

}


$('#customFile').change(function() {
    var fileExtension = ['png'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        swal('error', 'กรุณาอัพโหลดไฟล์ข้อมูลที่มีนามสกุล   png  เท่านั้น', "error")
            .then(function(sw) {
                location.reload();
            });
    }
});


$('#customFile2').change(function() {
    var fileExtension = ['png'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        swal('error', 'กรุณาอัพโหลดไฟล์ข้อมูลที่มีนามสกุล   png  เท่านั้น', "error")
            .then(function(sw) {
                location.reload();
            });
    }
});


$('#customFile3').change(function() {
    var fileExtension = ['png'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        swal('error', 'กรุณาอัพโหลดไฟล์ข้อมูลที่มีนามสกุล   png  เท่านั้น', "error")
            .then(function(sw) {
                location.reload();
            });
    }
});




function up_img1() {
    var data = new FormData();
    data.append('file', $('#customFile')[0].files[0]);
    data.append('e_img_id', $('#e_img_id').val());
    $.ajax({
            url: 'update_img_ck',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
        })
        .done(function(res) {
            if (res.code == 1) {
                swal(res.title, res.msg, 'success').then(function(w) {
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
}


function up_img2() {
    var data = new FormData();
    data.append('file', $('#customFile2')[0].files[0]);
    data.append('e_img_id', $('#e_img_id').val());
    $.ajax({
            url: 'update_img_ck2',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
        })
        .done(function(res) {
            if (res.code == 1) {
                swal(res.title, res.msg, 'success').then(function(w) {
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
}



function up_img3() {
    var data = new FormData();
    data.append('file', $('#customFile3')[0].files[0]);
    data.append('e_img_id', $('#e_img_id').val());
    $.ajax({
            url: 'update_img_ck3',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
        })
        .done(function(res) {
            if (res.code == 1) {
                swal(res.title, res.msg, 'success').then(function(w) {
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
}
</script>
<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>เอเย่นต์ฟุตบอล<small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-reorder"></i> </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" onClick="cre_admin()">เพิ่มพนักงาน</a> </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr  style="text-align:center;" >
                        <th style="vertical-align: middle"> No.</th>
                        <th style="vertical-align: middle"> ประเทศ </th>
                        <th style="vertical-align: middle"> ฟันธงสั้นๆ </th>
                        <th> วันที่เตะ</th>
                        <th style="vertical-align: middle">เวลา</th>
                        <th style="vertical-align: middle">หัวข้อ</th>
                        <th style="vertical-align: middle">รายละเอียด</th>

                      </tr>
                    </thead>
                  <!--   <tbody>
                      <?php $i=1; foreach($admin as $_a=>$a){ ?>
                      <tr style="text-align:center;">
                        <td><?php echo $i;$i++; ?></td>
                        <td><?php echo $a['username']; ?></td>
                        <td><?php echo $a['name']; ?></td>
                        <?php $license = $this->db->where('admin_id',$a['id'])->where('status',1)->get('tb_class_admin')->row(); ?>
                        <td align="center"><?php if(!empty($license->register) && $license->register == 1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->deposit) &&$license->deposit ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->withdraw) &&$license->withdraw ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->promotion) &&$license->promotion ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->bank_user) &&$license->bank_user ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->bank) &&$license->bank ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->admin) &&$license->admin ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->user) &&$license->user ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->winlose) &&$license->winlose ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td align="center"><?php if(!empty($license->report) &&$license->report ==1){echo '<i style="color:#3AED33;" class="fa fa-check"></i>';}else{ echo '<i style="color:#F51F23;" class="fa fa-close"></i>';}?></td>
                        <td><?php echo $a['last_login']==0 ? '': $a['last_login']; ?></td>
                        <td><?php echo $a['last_ip'] ==0?'':$a['last_ip']; ?></td>
                        <td ><button onClick="edit_license('<?=$a['id']?>')" class="btn btn-secondary btn-sm" title="แก้ไขการเข้าถึง"><i class="fa fa-gears"></i></button>
                          <button onClick="edit_pass('<?=$a['id']?>')" class="btn btn-secondary btn-sm" title="เปลี่ยนพาสเวิร์ด"><i class="fa fa-key"></i></button>
                          <?php if($a['status'] == 1){ ?>
                          <button onClick="edit_status('0','<?=$a['id']?>')" class="btn btn-success btn-sm" title="ปิด"><i class="fa fa-check"></i></button>
                          <?php }else if($a['status'] == 0){ ?>
                          <button onClick="edit_status('1','<?=$a['id']?>')" class="btn btn-danger btn-sm" title="เปิด"><i class="fa fa-close"></i></button>
                          <?php }?></td>
                      </tr>
                      <?php } ?>
                    </tbody> -->
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

<!--modal-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="m_editLicense" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขสิทธิ์ พนักงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="form_editLicense">
        <div class="modal-body">
          <div class="x_content"> 

            <div class="col-md-12 col-sm-12 ">
        <input type="hidden" id="lic_adminId" value="" name="admin_id">
              <div class="checkbox">
         
                <label class="btn">
                  <input type="checkbox" class="" name="register" value="1"  id="lic_register" >
                  สมัครใหม่ </label>
                <label class="btn">
                  <input type="checkbox" class="" name="deposit" value="1" id="lic_deposit">
                  รายการฝาก </label>
                <label class="btn">
                  <input type="checkbox" class="" name="withdraw" value="1" id="lic_withdraw">
                  รายการถอน </label>
                <label class="btn">
                  <input type="checkbox" class="" name="bank_user" value="1" id="lic_bank_user">
                  ธนาคารลูกค้า </label>
                <label class="btn">
                  <input type="checkbox" class="" name="promotion" value="1" id="lic_promotion">
                  โปรโมชั่น </label>
                <label class="btn">
                  <input type="checkbox" class="" name="bank" value="1" id="lic_bank" >
                  ยอดธนาคาร </label>
                <label class="btn">
                  <input type="checkbox" class="" name="report" value="1" id="lic_report">
                  รายงาน </label>
                <label class="btn">
                  <input type="checkbox" class="" name="user" value="1" id="lic_user" >
                  ลูกค้า </label>
                <label class="btn">
                  <input type="checkbox" class="" name="winlose" value="1"  id="lic_winlose">
                  ชนะแพ้ </label>
                <label class="btn">
                  <input type="checkbox" class="" name="admin" value="1" id="lic_admin">
                  พนักงาน </label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="m_creAdmin" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เอเย่นต์ฟุตบอล</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="form_creAdmin">
        <div class="modal-body">
          <div class="x_content"> <br />
            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" id="edit_name" name="name" placeholder="ชื่อ">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <input type="text" class="form-control" id="edit_tel" name="tel" placeholder="Tel">
              <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <div class="input-group"> <span class="input-group-btn">
                <button type="button" class="btn btn-secondary go-class">
                <?=$this->getapi_model->agent()?>
                @</button>
                </span>
                <input type="text" name="username" placeholder="Username" class="form-control">
              </div>
            </div>
            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <input type="text" class="form-control" id="inputSuccess5" name="password" placeholder="Password">
              <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span> </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


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
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;"> <span id="span_usernamePWD"></span>
            <input type="hidden" name="admin_id" id="edit_adminId">
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <input type="text" class="form-control"  placeholder="Password" required="required" name="password" id="val_editPass" autocomplete="off" >
            <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span> </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#form_creAdmin').submit(function(event) {
     event.preventDefault();
     var data = $('#form_creAdmin').serializeArray();
     $.ajax({
       url: 'admin/cre_admin',
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
        setTimeout(function(){location.reload(); },2000);
       }else{
        swal({
          icon: "error",
           text: res.msg,
        });
       }
     })
     .fail(function() {
       console.log("error");
     });
     
   }); 
  $('#form_editPass').submit(function(event) {
     event.preventDefault();
     var data = $('#form_editPass').serializeArray();
     $.ajax({
       url: 'admin/edit_pass',
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
        setTimeout(function(){location.reload(); },2000);
       }else{
        swal({
          icon: "error",
           text: res.msg,
        });
       }
     })
     .fail(function() {
       console.log("error");
     });
     
   });
  $('#form_editLicense').submit(function(event) {
     event.preventDefault();
     var data = $('#form_editLicense').serializeArray();
     $.ajax({
       url: 'admin/edit_license',
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
        setTimeout(function(){location.reload(); },2000);
       }else{
        swal({
          icon: "error",
           text: res.msg,
        });
       }
     })
     .fail(function() {
       console.log("error");
     });
     
   });
});
function cre_admin()
{
  $('#m_creAdmin').modal();
  
}
function edit_pass(id)
{
  $('#m_editPass').modal();
  $('#edit_adminId').val(id);
}
function edit_license(id)
{
  $('#m_editLicense').modal();
  $.ajax({
     url: 'admin/get_license',
       type: 'POST',
       dataType: 'json',
       data: {admin_id:id},
  }).done(function(res){
    if(res.register == 1){$('#lic_register').prop('checked', true);}else{$('#lic_register').prop('checked', false);}
    if(res.deposit == 1){$('#lic_deposit').prop('checked', true);}else{$('#lic_deposit').prop('checked', false);}
    if(res.withdraw == 1){$('#lic_withdraw').prop('checked', true);}else{$('#lic_withdraw').prop('checked', false);}
    if(res.bank_user == 1){$('#lic_bank_user').prop('checked', true);}else{$('#lic_bank_user').prop('checked', false);}
    if(res.promotion == 1){$('#lic_promotion').prop('checked', true);}else{$('#lic_promotion').prop('checked', false);}
    if(res.bank == 1){$('#lic_bank').prop('checked', true);}else{$('#lic_bank').prop('checked', true);}
    if(res.report == 1){$('#lic_report').prop('checked', true);}else{$('#lic_report').prop('checked', false);}
    if(res.user == 1){$('#lic_user').prop('checked', true);}else{$('#lic_user').prop('checked', false);}
    if(res.winlose == 1){$('#lic_winlose').prop('checked', true);}else{$('#lic_winlose').prop('checked', false);}
    if(res.admin == 1){$('#lic_admin').prop('checked', true);}else{$('#lic_admin').prop('checked', false);}
    
  })
  $('#lic_adminId').val(id);


}
function edit_status(status,id)
{
  swal({
    title: 'Are you sure?',
    buttons: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: 'admin/edit_status',
        type: 'POST',
        dataType: 'json',
        data: {status:status,id:id},
      }).done(function(res) {
        if (res.code == 1) {
          swal({
            icon: "success",
            text: res.msg,
          });
          setTimeout(function(){location.reload(); },2000);
        }else{
          swal({
            icon: "error",
             text: res.msg,
          });
        }
      });
    }else{

    }

  });
}
</script>
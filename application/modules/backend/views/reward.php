<style>

</style>

<div class="container">
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-6 col-sm-6 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการแลกของรางวัล</h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table" width="100%" id="myTable"  >
                   <thead>
            <tr style="background-color: #D39596;text-align: center;">
                <th width="10%"> รหัสลูกค้า </th>
                <th width="20%"> รางวัล </th>
                <th width="10%"> อนุมัติ </th>
  
  
             </tr>
                    </thead>
                    <tbody>
            
            <?php
            if(empty($data2)){
              echo '<tr><td colspan="6" class="text-center red"> ไม่มีข้อมูล</td></tr>';
            }
              foreach($data2 as $sp2){
            ?>
            <tr>
              <td class="text-center"  ><?=$sp2['id_user']?></td>
              <td class="text-center"><?=$sp2['point']?></td>

            

<!--               <td class="text-center"><?=$sp2['reward_id']?></td> -->

              <td class="text-center">
                <button class="btn btn-success btn-sm"  id="btn_editspin"   title="แก้ไขการตั้งค่า" onclick="submit_reward('<?=$sp2['id']?>','<?=$sp2['point']?>','<?=$sp2['id_user']?>');">
                            อนุมัติ
                </button>
                 <button class="btn btn-danger btn-sm"  id="btn_editspin"  title="แก้ไขการตั้งค่า" onclick="reject_reward('<?=$sp2['id']?>','<?=$sp2['cost']?>','<?=$sp2['id_user']?>');" >
                            ไม่อนุมัติ
                </button>

              </td> 
            </tr>
          
          
            <?php 
              }
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
    <!---- กั้น--->
    <div class="col-md-6 col-sm-6 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ประวัติการแลกรางวัล</h2>

          <div class="clearfix"></div>
        </div>
        
        <div class="col-lg-12 col-md-8 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table" width="100%" id="myTable2"  >
                   <thead>
            <tr style="background-color: #D39596;text-align: center;">
               <th width="10%" >ID</th>
                <th width="10%" >รหัสลูกค้า</th>
                <th width="20%">รางวัล</th>
                  <th width="10%">เวลาอนุมัติ</th>
                  <th width="10%">อนุมัติ</th>
  
  
             </tr>
                    </thead>
                    <tbody>
            
            <?php
            if(empty($data3)){
              echo '<tr><td colspan="6" class="text-center red"> ไม่มีข้อมูล</td></tr>';
            }
              foreach($data3 as $sp3){
            ?>
            <tr>
              <td class="text-center"  ><?=$sp3['id']?></td>
              <td class="text-center"  ><?=$sp3['id_user']?></td>
              <td class="text-center"><?=$sp3['point']?></td>
              <td class="text-center"><?=date('d/m/Y H:i:s',$sp3['admin_datetime'])?></td>
            

<!--               <td class="text-center"><?=$sp2['reward_id']?></td> -->
             
              <td class="text-center">
                 <?php if($sp3['status']=='1'){ ?>
                <button class="btn btn-warning btn-sm"  id="btn_editspin"   title="แก้ไขการตั้งค่า" >
                            รออนุมัติ
                </button>
              <?php }else if($sp3['status']=='0'){ ?>

                 <button class="btn btn-danger btn-sm"  id="btn_editspin"  title="แก้ไขการตั้งค่า"  >
                            ไม่อนุมัติ
                </button>
              <?php } else {?>
                <button class="btn btn-success btn-sm"  id="btn_editspin"  title="แก้ไขการตั้งค่า" >
                            อนุมัติแล้ว
                </button>
              <?php } ?>
              </td> 
            </tr>
          
          
            <?php 
              }
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
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ตั้งค่า ของรางวัล<button id="eiei"><i class="fa fa-plus"></i></button><small></small></h2>

          <div class="clearfix"></div>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table" width="100%" >
                   <thead>
            <tr style="background-color: #D39596;text-align: center;">
                <th width="10%" >No</th>
                <th width="20%">ราคา</th>
                <th width="20%">ของรางวัล</th>
                <th width="20%">รูปภาพ</th>
                <th width="20%">สถานะ</th>
                  <th width="10%">แก้ไข</th>
  
  
             </tr>
                    </thead>
                    <tbody>
            
            <?php
            if(empty($reward)){
              echo '<tr><td colspan="6" class="text-center red"> ไม่มีข้อมูล</td></tr>';
            }
              foreach($reward as $sp){
            ?>
            <tr>
              <td class="text-center"  ><?=$sp['id_reward']?></td>
              <td class="text-center"><?=$sp['prize']?></td>
              <td class="text-center"><?=$sp['reward']?></td>
              <td class="text-center" ><img width="100%" src="<?=$this->config->item('tem_frontend_img').'/reward/'.$sp['img']?>" onClick="$('#img<?=$sp['id_reward']?>').modal()" style="width:30%"></td>
              <td class="text-center"><?php
                  if($sp['status'] == 1 or $sp['status'] == 2){
                  ?>
                 <a href="#" onClick="edit_status('<?=$sp['id_reward']?>','0')" title="ปิด">
                  <i style="color:#3AED33;" class="fa fa-check"></i>
                </a>
                  <?php
                  }else{
                ?>
                <a href="#" onClick="edit_status('<?=$sp['id_reward']?>','1')" title="เปิด">
                  <i style="color:#F51F23;" class="fa fa-remove"></i>
                </a>
                <?php 
                  }
                ?></td>
            
            

              <td class="text-center">
                <button class="btn btn-secondary btn-sm"  id="btn_editspin" onclick="edit_rewardFrm('<?=$sp['id_reward']?>');"    value="<?=$sp['id_reward']?>"   title="แก้ไขการตั้งค่า">
                            <i class="fa fa-pencil"></i>
                </button>

              </td> 
            </tr>
          
          
            <?php 
              }
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
</div>
</div>
<!-- modal add -->
<div class="modal fade" id="modal_add_reward" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">reward<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left" id="form_add_reward" style="font-size: 18px;"   enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
            
          </div>
        
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ราคา</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="prize" name="prize" placeholder="หัวข้อ"  autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ของรางวัล</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="number" class="form-control" id="reward" name="reward" placeholder="หัวข้อ"  autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ประเภทรางวัล</label>
               <div class="col-md-9 col-sm-9 ">
              <select class="form-control" name="type_reward" required>
                     <option value="0">เลือกของรางวัล</option> 
                     <option value="credit">เครดิต</option> 
                    <!--  <option value="item">ของรางวัล</option>  -->
              </select>
            </div>
            </div>
          </div>
          
       <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">รูปภาพ</label>
              <div class="col-md-9 col-sm-9 ">        
                <input type="file" class="form-control" id="img" name="img" placeholder="รูปภาพ"  autocomplete="off" >
              </div>
            </div>
          </div>
      
    
  

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="add">เพิ่ม</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<!-- modal edit -->
<div class="modal " id="modal_edit_reward" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">reward edit<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left" id="form_edit_reward" style="font-size: 18px;"   enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" name="eid_reward" id="eid_reward">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
            
          </div>
        
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ราคา</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="eprize" name="eprize" placeholder="หัวข้อ"  autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ของรางวัล</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="number" class="form-control" id="ereward" name="ereward" placeholder="หัวข้อ"  autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ประเภทรางวัล</label>
               <div class="col-md-9 col-sm-9 ">
              <select class="form-control" name="etype_reward" id="etype_reward" required>
                     <option value="0">เลือกของรางวัล</option> 
                     <option value="credit">เครดิต</option> 
                    <!--  <option value="item">ของรางวัล</option>  -->
              </select>
            </div>
            </div>
          </div>
       <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">รูปภาพ</label>
              <div class="col-md-9 col-sm-9 ">        
              <input type="hidden" id="image" name="image" value="">
                        <input type="file" id="e_img" name="e_img">
                        <br>
                        <div id="preview"></div>
                        <br>
              </div>
            </div>
          </div>
      
    
  

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="add">บันทึก</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        </div>
      </form>
    </div>
  </div>
</div> 



<!-- modal edit -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://code.jquery.com/jquery-3.4.0.js"></script>
<script>



 $(document).ready(function() {

   $('#eiei').click(function() {
            $('#modal_add_reward').modal('show');
        });


        $('#form_add_reward').submit(function() {
        
        
            if ($('#img').val() == '') {
                alert('Please Select the File image');
            } else {
                if (confirm('ยืนยันการบันทึก')) {
                    $.ajax({
                        url: "reward_adds",
                        method: "POST",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,

                        success: function(data) {
                            $('#mod_add_reward').modal('hide');
                             window.location.reload(true);
                     
                           
                        },
                    });
                }
            }
        });


});




function edit_status(id,status){  
  swal({
  title: 'Are you sure?',
        buttons: true,
}).then((willDelete) => {
      if (willDelete) {
             $.ajax({
            url: 'edit_reward',
            type: 'POST',
            data: {id:id,status:status},
            dataType: 'json',
            success: function(res) {
                
               
                 if (res.code == 1) {
      swal(res.title,res.msg,'success').then(function(w){
        setTimeout(function(){
          location.reload();
        },800);
      });
    }else{
      swal(res.title,res.msg,'error').then(function(w){
        setTimeout(function(){
          location.reload();
        },800);
      });
    }
            },
            error: function() {
                alert('Error!!!');
            },
        });
      }

})
  }

function edit_rewardFrm(id){
   $.ajax({
    url: 'reward_editFrm',
    type: 'POST',
    dataType: 'json',
    data: {id:id},
    }).done(function(res) {
     $('#eid_reward').val(res.id_reward); 
     $('#eprize').val(res.prize);    
     $('#ereward').val(res.reward);
      $('#etype_reward').val(res.type);
     
     
          $('#preview').html('<img src="<?php echo $this->config->item('tem_frontend_img'); ?>reward/' + res.img + '" style="width:200px; height:200px;"/>'); //show image

     $('#modal_edit_reward').modal('show');

  
    })
    .fail(function() {
    console.log("error");
    });
 }

 function reject_reward(id,cost,id_user){

Swal.fire({
  title: 'อนุมัติรายการ',
  text: "ต้องการอนุมัติรายการนี้ใช่ไหม ",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'ไม่',
  confirmButtonText: 'ใช่'
}).then((result) => {
  if (result.value) {
       $.ajax({
    url: 'reject_ctrl_reward',
    type: 'POST',
    dataType: 'json',
    data: {id:id,cost:cost,id_user:id_user},
    }).done(function(res) {
      if (res.code == 1) {
      swal("", "ทำรายการเรียบร้อย", "success");
      setTimeout(function(){location.reload(); },2000);
    }
  
    })
    .fail(function() {
    console.log("error");
    });
  }
}) 






 
 }

 function submit_reward(id,point,id_user){

    Swal.fire({
  title: 'อนุมัติรายการ',
  text: "ต้องการอนุมัติรายการนี้ใช่ไหม ",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'ไม่',
  confirmButtonText: 'ใช่'
}).then((result) => {
  if (result.value) {
     $.ajax({
    url: 'submit_ctrl_reward',
    type: 'POST',
    dataType: 'json',
    data: {id:id,point:point,id_user:id_user},
    }).done(function(res) {
      if (res.code == 1) {
      swal("", "อนุมัติเรียบร้อย", "success");
      setTimeout(function(){location.reload(); },2000);
    }
  
    })
    .fail(function() {
    console.log("error");
    });
  }
}) 

  
 }

 $(document).ready(function() {


        $('#form_edit_reward').submit(function() {

                if (confirm('ยืนยันการแก้ไข')) {
                    $.ajax({
                        url: "edit_reward_ctrl",
                        method: "POST",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,

                        success: function(data) {
                            $('#modal_edit_reward').modal('hide');
                             window.location.reload(true);
                     
                           
                        },
                    });
                }
            
        });


});
$(document).ready( function () {
    $('#myTable').DataTable({
      "pageLength": 5
    });
} );
$(document).ready( function () {
  
    $('#myTable2').DataTable({
      "pageLength": 5
    });
} );
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

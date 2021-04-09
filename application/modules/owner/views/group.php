
<div class="container body">
  <div class="main_container">

      <div class="">
        <div class="row">
			<div class="col-md-4">
				<div class="x_panel">
					<div class="x_title">
						<h2>ตั้งค่ากลุ่มลูกค้าแรกเข้า</h2>
						<div class="text-right"><button class="btn btn-sm btn-outline-info" onClick="m_edit_gp('1')"><i class="fa fa-plus"> แก้ไขกลุ่ม</i></button></div>
						<div class=""><span style="font-size: 14px;color: #000000;">จะเห็นธนาคารที่ตั้งค่าไว้ และจะเป็นกลุ่มทั่วไปเสมอ</span></div>
					</div>
					<div class="x_content">
						<div class="form-group row">
							<?php foreach ($group_dfus as $df){ if($df['type'] == 1){ ?>
							<button class="btn btn-outline-success"><?=$df['name']?></button>
							<?php }}?>
						</div>
						
					</div>
				</div>
			</div>  
			<div class="col-md-4">
				<div class="x_panel">
					<div class="x_title">
						<h2>แยกเว้นกลุ่ม</h2>
						<div class="text-right"><button class="btn btn-sm btn-outline-info" onClick="m_edit_gp('2')"><i class="fa fa-plus"> แก้ไขกลุ่ม</i></button></div>
						<div class=""><span style="font-size: 14px;color: #000000;">กรณีธนาคารนี้เข้ามาจะไม่สามาถเห็นกลุ่มธนาคารที่ตั้งค่าใน ลูกค้าแรกเข้า ยกเว้นกลุ่ม "ทั่วไป"</span></div>
					</div>
					<div class="x_content">
						<div class="form-group row">
							<?php foreach ($group_dfus as $df){ if($df['type'] == 2){ ?>
							<button class="btn btn-outline-success"><?=$df['name']?></button>
							<?php }}?>
						</div>
						
					</div>
				</div>
			</div>  
		</div>
        <div class="row" >
			
          <div class="clearfix"></div>
          <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Class<small> </small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-reorder"></i> </i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" onClick="cre_classUser()">เพิ่มกลุ่ม</a> </div>
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
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead style="background-color: #2a3f54;color: #fff;">
                            <tr align="center">
                              <th>No</th>
                              <th>Name</th>
                              <th >จัดการ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php  $i = 1; foreach ( $group as $_u => $us ) { ?>
                            <tr align="center" style="font-size: 18px;">
                              <td ><?php echo $i; ?></td>
                              <td ><?php echo $us['name']; ?></td>
                              <td ><button onClick="detail('<?=$us['detail']?>')" class="btn btn-secondary btn-sm"><i class="fa fa-bars"></i></button>
                                <button onClick="manage_classUser('2','<?=$us['id']?>')" class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></button>
                                <?php if($us['status'] == 1){ ?>
                                <button onClick="manage_classUser('3','<?=$us['id']?>')" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                <?php }else if($us['status'] == 0){ ?>
                                <button onClick="manage_classUser('3','<?=$us['id']?>')" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></button>
                                <?php } ?></td>
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
    </div>
  </div>
</div>
<div id="m_detail" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"> </div>
      <div class="modal-body" style="font-size: 23px;">
        <div id="div_detail"></div>
      </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>
<!-- Start model -->
<div class="modal fade" id="m_creClass" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มกลุ่มลูกค้า</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="form_creClass">
        <div class="modal-body">
          <div class="row"> </div>
          <div class=" tab-pane">
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="name">ชื่อ</label>
                <div class="controls">
                  <input name="group_id" id="edit_classId" type="hidden">
                  <input type="text" name="name" class="form-control"  id="name" value="">
                </div>
                <!-- /controls --> 
              </div>
              <!-- /control-group -->
              
              <div class="control-group">
                <label class="control-label" for="name">รายละเอียด</label>
                <div class="controls">
                  <input type="text" name="detail" class="form-control"  id="detail" value="">
                </div>
                <!-- /controls --> 
              </div>
              <!-- /control-group -->
              
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--เพิ่มกลุ่มสำหรับลูกค้า-->
<div class="modal fade" id="m_edit_group1" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เลือกกลุ่ม<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
		<form id="form_edit_group1">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">กลุ่ม</label>
              <div class="col-md-9 col-sm-9 ">
				  <input type="hidden" value="1" name="gp_type">
				  <div class="form-check" id="gp_df1">
					  <input type="checkbox" name="1" class="form-check-input" id="group1" checked onclick="return false;" >
					  <label class="form-check-label" for="group1">ทั่วไป</label>
					</div>
				<?php foreach($group as $_g=>$gpr){ if($gpr['status'] != 0 ){ if($gpr['id'] != 1){?>
				  <div class="form-check">
					<input type="checkbox" name="<?=$gpr['id']?>" class="form-check-input" id="group1<?=$gpr['id']?>" >
					<label class="form-check-label" for="group1<?=$gpr['id']?>"><?=$gpr['name']?></label>
				  </div>
				<?php } } }?>
              </div>
            </div>
          </div>
        </div>
		</form>
        <div class="modal-footer">
          <button type="button" onClick="edit_group('1')" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>
</div>
<!--เพิ่มกลุ่มสำหรับลูกค้า-->
<div class="modal fade" id="m_edit_group2" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เลือกกลุ่ม<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
		<form id="form_edit_group2">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
			  <input type="hidden" value="2" name="gp_type">
              <label class="col-form-label col-md-3 col-sm-3 ">กลุ่ม</label>
              <div class="col-md-9 col-sm-9 ">
				<?php foreach($group as $_g=>$gpr){ if($gpr['status'] != 0 ){ if($gpr['id'] != 1){?>
				  <div class="form-check">
					<input type="checkbox" name="<?=$gpr['id']?>" class="form-check-input" id="group2<?=$gpr['id']?>" >
					<label class="form-check-label" for="group2<?=$gpr['id']?>"><?=$gpr['name']?></label>
				  </div>
				<?php } } }?>
              </div>
            </div>
          </div>
        </div>
		</form>
        <div class="modal-footer">
          <button type="button" onClick="edit_group('2')" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      
    </div>
  </div>

<!-- End model --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script>
	
	
$(document).ready(function() {
	$('#form_creClass').submit(function(event) {
     event.preventDefault();
     var data = $('#form_creClass').serializeArray();
     $.ajax({
       url: 'group/edit',
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
function m_edit_gp(type)
{
	$.ajax({
       url: 'group/get_gpdf',
       type: 'POST',
       dataType: 'json',
       data: {type:type},
     })
     .done(function(res) {
		if(res.code == 1){
			
			if(type == 1){
				$('#m_edit_group1').modal();
				for (var i = 0; i < res.data.length; i++) {
					$('#group1'+res.data[i].group_id).prop('checked', true);
				}
			}else{
				$('#m_edit_group2').modal();
				for (var k = 0; k < res.data.length; k++) {
					$('#group2'+res.data[k].group_id).prop('checked', true);
				}
			}
		}else{
			swal('Error','get_gpdf Error','error');
			setTimeout(function(){location.reload(); },1000);
		}
	});
}
function edit_group(type)
{
	if(type == 1){
		var data = $('#form_edit_group1').serializeArray();
	}else{
		var data = $('#form_edit_group2').serializeArray();
	}
	
	$.ajax({
       url: 'group/edit_default',
       type: 'POST',
       dataType: 'json',
       data: data,
     })
     .done(function(res) {
       if (res.code == 1) {
        swal(res.title,res.msg,'success');
		$('#m_edit_group').modal('toggle');
		   setTimeout(function(){location.reload(); },1000);
       }else{
         swal(res.title,res.msg,'error');
       }
     })
     .fail(function() {
       console.log("error");
     });
}
function cre_classUser()
{
	$('#m_creClass').modal();
	$('#name').val("");
	$('#detail').val("");
	$('#edit_classId').val("");
}

function manage_classUser(action,id)
{
	if(action == 2){
		$('#m_creClass').modal();
		$.ajax({
			url:'group/get_group',
			type:'POST',
			dataType:'json',
			data:{group_id:id}
		}).done(function(res){
			$('#name').val(res.name);
			$('#detail').val(res.detail);
			$('#edit_classId').val(id);
		});
	}else if(action == 3){
		swal({
			  title: 'Are you sure?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'group/status',
					type: 'POST',
					dataType: 'json',
					data: {group_id:id},
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
}

function detail(detail)
{
	$('#m_detail').modal();
	$('#div_detail').html(detail);
}
</script>
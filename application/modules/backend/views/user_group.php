
<div class="container body">
  <div class="main_container">
    <div class="right_col" role="main">
      <div class="">
        <div class="clearfix"></div>
        <div class="row" style="display: block;">
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
                            <?php  $i = 1; foreach ( $user_group as $_u => $us ) { ?>
                              <tr align="center" style="font-size: 18px;">
                                <td ><?php echo $i; ?></td>
                                
                                <td ><?php echo $us['group_name']; ?></td>
                               
                                <td >
									<button onClick="detail('<?=$us['group_detail']?>')" class="btn btn-secondary btn-sm"><i class="fa fa-bars"></i></button>
									<button onClick="manage_classUser('2','<?=$us['id']?>')" class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></button>
                                  <?php if($us['status'] == 1){ ?>
                                  <button onClick="manage_classUser('3','<?=$us['id']?>')" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                  <?php }else if($us['status'] == 0){ ?>
                                  <button onClick="manage_classUser('3','<?=$us['id']?>')" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></button>
                                  <?php } ?>
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
    </div>
  </div>
</div>
<div id="m_detail" class="modal fade" role="dialog">
								  <div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header">


									  </div>
									  <div class="modal-body" style="font-size: 23px;">
										<div id="div_detail"></div>
									  </div>
									  <div class="modal-footer">
										
									  </div>
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
					<input name="class_id" id="edit_classId" type="hidden">
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
<!-- End model --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script>
$(document).ready(function() {
	$('#form_creClass').submit(function(event) {
     event.preventDefault();
     var data = $('#form_creClass').serializeArray();
     $.ajax({
       url: 'edit_classUser',
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
function cre_classUser()
{
	$('#m_creClass').modal();
}

function manage_classUser(action,id)
{
	if(action == 2){
		$('#m_creClass').modal();
		$.ajax({
			url:'get_user_group',
			type:'POST',
			dataType:'json',
			data:{group_id:id}
		}).done(function(res){
			$('#name').val(res.group_name);
			$('#detail').val(res.group_detail);
			$('#edit_classId').val(id);
		});
	}else if(action == 3){
		swal({
			  title: 'Are you sure?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'edit_classUser_status',
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
<style>
  html {
    font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
    font-size: 14px;
}

.table1 {
    border: none;
}

.table-definition thead th:first-child {
    pointer-events: none;
    background: white;
    border: none;
}

.table td {
    vertical-align: middle;
}

.page-item > * {
    border: none;
}

.custom-checkbox {
  min-height: 1rem;
  padding-left: 0;
  margin-right: 0;
  cursor: pointer; 
}
  .custom-checkbox .custom-control-indicator {
    content: "";
    display: inline-block;
    position: relative;
    width: 30px;
    height: 10px;
    background-color: #818181;
    border-radius: 15px;
    margin-right: 10px;
    -webkit-transition: background .3s ease;
    transition: background .3s ease;
    vertical-align: middle;
    margin: 0 16px;
    box-shadow: none; 
  }
    .custom-checkbox .custom-control-indicator:after {
      content: "";
      position: absolute;
      display: inline-block;
      width: 18px;
      height: 18px;
      background-color: #f1f1f1;
      border-radius: 21px;
      box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
      left: -2px;
      top: -4px;
      -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
      transition: left .3s ease, background .3s ease, box-shadow .1s ease; 
    }
  .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
    background-color: #84c7c1;
    background-image: none;
    box-shadow: none !important; 
  }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator:after {
      background-color: #84c7c1;
      left: 15px; 
    }
  .custom-checkbox .custom-control-input:focus ~ .custom-control-indicator {
    box-shadow: none !important; 
  }
  .alert {
  padding: 20px;
  background-color: #E36E6E;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
  .g{
     border: none 
  }
     .sw{
    background-color:#2a3f54;
  }
  .vd{
    cursor:pointer;
  }
  .custom-switch {
  padding-left: 2.25rem;
  padding-bottom: 1rem; 
}
.custom-control-label { 
  padding-top: 0.5rem;
  padding-left: 2rem;
  padding-bottom: 0.1rem;
}
.custom-switch .custom-control-label::after {
  top: calc(0.25rem + 2px);
  left: calc(-2.25rem + 2px);
  width: calc(2rem - 4px);   
  height: calc(2rem - 4px);  
  background-color: #adb5bd;
  border-radius: 2rem; 
  transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-transform 0.15s ease-in-out;
  transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-transform 0.15s ease-in-out;
}
  .custom-switch .custom-control-label::before {
  left: -2.25rem;
  height: 2rem;
  width: 3.5rem;  
  pointer-events: all;
  border-radius: 1rem;
}
.custom-switch .custom-control-input:checked ~ .custom-control-label::after {
  background-color: #fff;
  -webkit-transform: translateX(1.5rem); 
  transform: translateX(1.5rem); 
}
</style>
<?php // echo'<pre>'; print_r($bankAuto);die();?>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Custom Reply<small></small></h2>
          <ul class="nav navbar-right panel_toolbox">

			  <li> <button  onClick="insert_mr()"><i class="fa fa-plus"></i></button></li>

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                   <thead style="background-color:#12205F;color: #FFF">
                      <tr align="center">
                        <th width="5%"> ลำดับ</th>
                        <th> Message</th>
                        <th> Reply</th>
                        <th> Quick Reply</th>
                        <th> เเก้ไข </th>
                        <th> ลบ</th>
                        <th> สถานะ </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if(!empty($Custom)){
                           foreach($Custom as $_b => $Cus) {?>
                      <tr>
                        <td ><?=$i?></td>
                        <td ><?=$Cus['message']?></td>
                        <td ><?=$Cus['reply']?></td>
                        <td class="text-center">
                          <i class="fa fa-commenting text-success fa-2x vd " data-toggle="modal"  onclick="test('<?=$Cus['id']?>')"  data-target="#exampleModal1"  aria-hidden="true"></i>
                        </td>
                        <td class="text-center">
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" title="Edit" onclick="edit_cus('<?=$Cus['id']?>','<?=$Cus['message']?>','<?=$Cus['reply']?>');"  ><i class="fa fa-pencil"></i></a>
                        </td>
                        <td class="text-center" >
                        <a class="btn btn-danger text-white vd" onClick="delete_Cus('<?=$Cus['id']?>')"><span class="glyphicon glyphicon-trash"  aria-hidden="true"></span></a>
                      </td>
                      <td class="text-center"><div class="custom-control custom-switch">
                        <input type="checkbox" onchange="status_exchange('<?=$Cus['status']?>','<?=$Cus['id']?>');" class="custom-control-input" id="customSwitch<?=$i?>"  <?=$Cus['status'] == 1 ? 'checked':''?> />
                        <label class="custom-control-label " for="customSwitch<?=$i?>"></label>
                        </div></td>
                      </tr>
                      <?php $i++;}}else{ ?>
                      <tr>
                        <td colspan="9" style="text-align:center;background-color:#EBE6AB">ไม่มีข้อมูล</td>
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
<div class="modal fade" id="insert_ucs" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">insert Custom reply</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left" id="insert_cus" style="font-size: 18px;">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
            <input type="hidden" name="id" id="id">
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">Message</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="message" name="message" placeholder=""  autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">Reply</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="reply" name="reply" placeholder=""  autocomplete="off" >
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onClick="insert_cus()" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Custom reply</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 "><h5>Message</h5></label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editmessage" name="editmessage" placeholder=""  autocomplete="off" >
                <input type="hidden" name="editid" id="editid">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 "><h5>Reply</h5></label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editreply" name="editmessage" placeholder=""  autocomplete="off" >
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" onClick="update_cus()" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Custom Quick reply</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
      <div class="text-center">
      <a href="" class="btn btn-success btn-rounded " onclick="insert_quick()" data-toggle="modal" data-target="#modalAdd">เพิ่ม <i class="fa fa-plus" aria-hidden="true"></i></a>
      </div>
      <div class="modal-body">
      <form class="form-inline"  id="insert_qeeee">
      <div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Message id</label>
    <input type="text" class="form-control text-center" id="editmes_id" placeholder="Message id" readonly>
    <input type="hidden" name="Q_iddd" id="edit_d">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label  class="sr-only">Quick reply</label>
    <input type="text" class="form-control" id="edit_quick" placeholder="Quick reply">
  </div>
  <button type="button" onclick="update_quick()" class="btn btn-warning mb-2">บันทึกการเเก้ไข</button>
</form>
      <form class="form-inline"  id="insert_qw">
      <div class="form-group mx-sm-3 mb-2">
    <label class="sr-only">Message id</label>
    <input type="text" class="form-control text-center" id="mes_id" placeholder="Message id" readonly>
    <input type="hidden" name="Q_id" id="Q_id">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label  class="sr-only">Quick reply</label>
    <input type="text" class="form-control" id="Qc_id" placeholder="Quick reply">
  </div>
  <button type="button" onclick="insert_quick_reply()" class="btn btn-primary mb-2">บันทึก</button>
</form><br>
      <table class="table table-bordered" id="tr_quick">
      </table>
      </div>
    </div>
  </div>
</div>
<script>
  function test(id){
    $('#insert_qw').hide();
    $('#insert_qeeee').hide();
    $('#nnnn').hide();
  var dd = id;
  var html = '';
  var id2 = $('#mes_id').val(id);
  $("#tr_quick").html();
               $.ajax({
                        url: '<?php base_url()?>Custom_reply/select_quick',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          dd:dd
                        },
                    })
                    .done(function(res) {
                      console.log(res);
                      if(res.code==1){
                        if(res.data.length >= 1 ){
                          var count 	= res.data.length;
                          var wd 		= res.data;
                              html += '<tbody';
                              html += '<thead>';
                              html += '<tr>';
                              html += '<th scope="col" width="7%" class="text-center">ลำดับ</th>';
                              html += '<th scope="col" width="10%">massage id</th>';
                              html += '<th scope="col" >Quick reply</th>';
                              html += '<th scope="col" class="text-center"> เเก้ไข </th>';
                              html += '<th scope="col" class="text-center"> ลบ</th>';
                              html += '<th scope="col" class="text-center"> สถานะ </th>';
                              html += '</tr>';
                              html += '</thead>';
                              for(var i=0; i < count; i++){
                              html += '<tr>';
                              html += '<td width="7%" class="text-center">'+(i+1)+'</td>';
                              html += '<td width="10%">'+wd[i].line_text_id+'</td>';
                              html += '<td>'+wd[i].quick_reply+'</td>';
                              html += '<td class="text-center"><i class="fa fa-pencil-square-o fa-2x vd text-info" aria-hidden="true" onclick="edit_quck('+wd[i].id+',\''+wd[i].line_text_id+'\',\''+(wd[i].quick_reply)+'\');"></i></td>';
                              html += '<td class="text-center"><i class="fa fa-trash fa-2x text-danger vd" onClick="delete_quick('+wd[i].id+')"aria-hidden="true"></i></td>';
                              if(wd[i].status==1){
                              html += '<td class="text-center"><label class="custom-control custom-checkbox"><input type="checkbox" id="quckstatus" onchange="status_exchange_quick('+wd[i].id+','+wd[i].status+')" class="custom-control-input" checked><span class="custom-control-indicator"></span></label></td>';
                              }else{
                                html += '<td class="text-center"><label class="custom-control custom-checkbox"><input type="checkbox" id="quckstatus" onchange="status_exchange_quick('+wd[i].id+','+wd[i].status+')" class="custom-control-input"><span class="custom-control-indicator"></span></label></td>';
                              }
                              html += '</tr>';
                              html += '</tbody>';
                              }
                            }else{
                              var html = '<tr><th class="text-center">ลำดับ<h><th class="text-center">massage id</th><th class="text-center">Quick reply</th><th scope="col" class="text-center">เเก้ไข</th><th scope="col" class="text-center"> ลบ</th><th scope="col" class="text-center"> สถานะ </th></tr><tr><td class="text-center bg-secondary text-white" colspan="6">ยังไม่มีข้อมูล Quck reply <br></td></tr>';
                            }
                            $('#tr_quick').html(html);
                      }else{
                        swal(res.title,res.msg,'error');
                      }
                    });
        // $("#tr_quick").html(html);
    
  }
  function status_exchange_quick(id,status){
    if(status == 0){
          var text = "คุณต้องการเปิด"
        }else{
          var text = "คุณต้องการปิด"
        }
    swal({
            text: text,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                console.log(id);
                console.log(status);
                $.ajax({
                        url: '<?php base_url()?>Custom_reply/enable_quick',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            status : status,
                            id : id
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

  function delete_quick(id){
    console.log(id);
    swal({
			  title: 'ต้องการลบ?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				 $.ajax({
					url: 'Custom_reply/delete_quick',
					type: 'POST',
					dataType: 'json',
					data: {id:id},
				  }).done(function(res) {
					//console.log(res);
					if (res.code == 1) {
						swal(res.title,res.msg,'success').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}else{
						swal(res.title,res.msg,'error').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}
				  })
				  .fail(function() {
					console.log("error");
				  });
			}
		})
  }
     function status_exchange(status,id) {
        if(status == 0){
          var text = "คุณต้องการเปิด"
        }else{
          var text = "คุณต้องการปิด"
        }
    swal({
            text: text,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                console.log(id);
                console.log(status);
                $.ajax({
                        url: '<?php base_url()?>Custom_reply/enable',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            status : status,
                            id : id
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
function insert_cus(){
	var data = $('#insert_cus').serializeArray();
  console.log(data);
	$.ajax({
		url: 'Custom_reply/insert_cus',
		type: 'POST',
		dataType: 'json',
		data: data,
	})
	.done(function(res) {
		if (res.code == 1) {
			swal(res.title,res.msg,'success').then(function(w){
				setTimeout(function(){
					location.reload();
				},1000);
			});
		}else{
			swal(res.title,res.msg,'error').then(function(w){
				setTimeout(function(){
					location.reload();
				},1000);
			});
		}
	})
	.fail(function() {
		console.log("error");
	});

}
function insert_quick_reply(){
	var message_id = $('#mes_id').val();
  var quick = $('#Qc_id').val();
  var id = $('#Q_id').val();
  console.log(message_id);
  console.log(quick);
  console.log(id);
  
	$.ajax({
		url: 'Custom_reply/insert_quick_reply',
		type: 'POST',
		dataType: 'json',
    data: {message_id:message_id,
    quick:quick,
    id:id}
	})
	.done(function(res) {
		if (res.code == 1) {
			swal(res.title,res.msg,'success').then(function(w){
				setTimeout(function(){
					location.reload();
				},1000);
			});
		}else{
			swal(res.title,res.msg,'error').then(function(w){
				setTimeout(function(){
					location.reload();
				},1000);
			});
		}
	})
	.fail(function() {
		console.log("error");
	});

}
function edit_cus(id,message,reply){
    var id = $('#editid').val(id);
    var message = $('#editmessage').val(message);
    var reply= $('#editreply').val(reply);
}
function update_cus(){
    var id = $('#editid').val();
    var message = $('#editmessage').val();
    var reply= $('#editreply').val();
	swal({
			  title: 'ต้องการเเก้ไข?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				 $.ajax({
					url: 'Custom_reply/update_cus',
					type: 'POST',
					dataType: 'json',
                    data: {id:id,
                        message:message,
                        reply:reply
                    },
				  }).done(function(res) {
					//console.log(res);
					if (res.code == 1) {
						swal(res.title,res.msg,'success').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}else{
						swal(res.title,res.msg,'error').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}
				  })
				  .fail(function() {
					console.log("error");
				  });
			}
		})
}
function edit_quck(id,text_id,quick){
      console.log(id,text_id,quick);
     $('#insert_qw').hide();
    $('#insert_qeeee').show();
    var message_id = $('#editmes_id').val(text_id);
    var quick = $('#edit_quick').val(quick);
    var idd = $('#edit_d').val(id);
  }
function update_quick(){
  var id = $('#edit_d').val();
  var message_id = $('#editmes_id').val();
  var quick= $('#edit_quick').val();
  console.log(id,message_id,quick);
	swal({
			  title: 'ต้องการเเก้ไข?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				 $.ajax({
					url: '<?php base_url()?>Custom_reply/update_quick',
					type: 'POST',
					dataType: 'json',
                        data: {id:id,
                          message_id:message_id,
                        quick:quick
                    },
				  }).done(function(res) {
					//console.log(res);
					if (res.code == 1) {
						swal(res.title,res.msg,'success').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}else{
						swal(res.title,res.msg,'error').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}
				  })
				  .fail(function() {
					console.log("error");
				  });
			}
		})
}
function insert_mr(){
	$('#insert_ucs').modal();
}
function insert_quick(){
  $('#insert_qeeee').hide();
  $('#insert_qw').show();
	$('#insert_qiuck').modal();
}
function delete_Cus(id){
	swal({
			  title: 'ต้องการลบ?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				 $.ajax({
					url: 'Custom_reply/delete_cus',
					type: 'POST',
					dataType: 'json',
					data: {id:id},
				  }).done(function(res) {
					//console.log(res);
					if (res.code == 1) {
						swal(res.title,res.msg,'success').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}else{
						swal(res.title,res.msg,'error').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}
				  })
				  .fail(function() {
					console.log("error");
				  });
			}
		})
}
</script>

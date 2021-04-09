

  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2><a href="<?=base_url()?>backend/sale/home">SALE</a><small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            

			<li>
			<select id="sale_status" onchange="sel_status()" class="mr-2">
				<option value="a">ทั้งหมด</option>
				<option value="1" selected>เปิดใช้งาน</option>
				<option value="0">ปิดใช้งาน</option>
			</select>
			</li>
          </ul>
          <ul class="nav navbar-right panel_toolbox">

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-10 col-sm-10" style="margin: 0px auto; float: none;">
          <div class="x_content">
			<div class="row">
				<div class="col-sm-12 text-right">
					<button class="" onClick="$('#m_creSale').modal();"><i class="fa fa-plus"></i> เพิ่มเซลล์</button>
				</div>
			</div>
            <div class="row">
              <div class="col-sm-12 ">
                <div class="card-box ">
                  <table id="" class="table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
                    <thead style="background-color:#12205F;color: #FFF">
					  <tr align="center">
                        <th width="3%" rowspan="2"> No</th>
                        <th width="3%" rowspan="2"> รหัส</th>
                        <th rowspan="2"> Username  </th>
                        <th rowspan="2"> ชื่อเซลล์ </th>
						<th width="5%" rowspan="2"> ลูกค้าทั้งหมด</th>
						<th width="5%" rowspan="2"> ลูกค้าเดือนที่แล้ว</th>
						<th colspan="2"> ลูกค้าภายในเดือน</th>
						<th rowspan="2"> รายละเอียด</th>
                        <th rowspan="2"> Link for share </th>
                        <th rowspan="2"> แก้ไขรหัส </th>
                        <th rowspan="2"> เปิด/ปิด</th>
                      </tr>
                      <tr align="center">
						<th width="5%"> ต่อวัน</th>
						<th width="5%"> ต่อเดือน</th>

                      </tr>
                    </thead>
                    <tbody id="history">
                      <?php $i = 1;
                      foreach ($sale as $_s => $ds) { ?>
                        <tr align="center">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $ds['id']; ?></td>
                          <td><?php echo $ds['username']; ?></td>
                          <td><?php echo $ds['name']; ?></td>
                          <td><?php echo $ds['num_user']; ?></td>
                          <td><?php echo $ds['num_userLM']; ?></td>
                          <td><?php echo $ds['num_userD']; ?></td>
                          <td><?php echo $ds['num_userM']; ?></td>
                          <td> <button type="button" class="btn btn-secondary btn-sm" onClick="sel_desale('<?=$ds['id']?>')">
                              <i class="fa fa-file"> รายละเอียด</i>
                            </button></td>

                          <!-- Button trigger modal -->
                          <td>
                            <button type="button" class="btn btn-secondary btn-sm" onClick="getLink('<?= $ds['token'] ?>', '<?=$ds['id']?>')">
                              <i class="fa fa-share"> สร้างลิงค์</i>
                            </button>
                          </td>
							<td>
							<button type="button" class="btn btn-secondary btn-sm" onClick=" $('#m_edit_pass').modal(); $('#edp_sid').val('<?=$ds['id']?>');$('#edp_sname').val('<?=$ds['username']?>');">
                              <i class="fa fa-key"> รหัสผ่าน</i>
                            </button>
							</td>
                          <td width="10%">
                            <label >
                              <input type="checkbox" class=""  onchange="edit_status(<?=$ds['id']?>,this)" <?php if ($ds['status'] == 1) {
                                                                                                              echo "checked";
                                                                                                            } ?>>
     
                            </label>

                          </td>
                          <!-- End button trigger modal -->
                        </tr>
                      <?php $i++;
                      } ?>
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

<!-- get link modal -->
<div class="modal fade" id="getLink" tabindex="-1" role="dialog" aria-labelledby="getLinkLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="getLinkLabel">ลิ้งค์การสมัคร</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="clear_qrcode()">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <input type="text" id="span_getLink" class="form-control"><br>
        <input type="hidden" id="sale_id"  value=""><br>
        <?php if($this->session->users['class'] == 0){ ?>
        <button type="button" class="btn btn-info float-right" onClick="upDateLink()" data-toggle="popover" data-content="copy">Update Link</button>
        <?php } ?>
        <div id="demoqr" style="margin-top:50px;margin-left:130px;"></div>
        
      </div>
      <div class="modal-footer">
        <p class="text-success"></p>
        <button type="button" class="btn btn-info float-right" onClick="copyLink()" data-toggle="popover" data-content="copy">Copy Link</button>
        <button type="button" class="btn btn-info float-right" onClick="clear_qrcode()" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<!-- end get link modal-->

<!-- Add sale -->
<div class="modal fade " tabindex="-1" role="dialog" id="m_creSale" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มเซลล์</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask " id="form_creSale">
        <div class="modal-body">
          <div class="x_content">
            <div class="col-md-12 col-sm-12  form-group has-feedback ">
              <input type="text" class="form-control has-feedback-left" id="edit_name" name="name" placeholder="ชื่อ">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
            <div class="col-md-12 col-sm-12  form-group has-feedback">

                <input type="text" name="username" placeholder="Username" class="form-control has-feedback-left">
				  <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>

            </div>
            <div class="col-md-12 col-sm-12  form-group has-feedback">

              <input type="text" class="form-control has-feedback-left" id="ads_p" name="password" placeholder="Password">
              <span class="fa fa-eye form-control-feedback right" aria-hidden="true" onClick="OC_edp_p()"></span> 
			  <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span> </div>

          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button onClick="cre_sale()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- End add sale -->

<!-- Add sale -->
<div class="modal fade " tabindex="-1" role="dialog" id="m_edit_pass" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เปลี่ยนรหัสเซลล์</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask " >
        <div class="modal-body">
          <div class="x_content"> 
            <div class="col-md-12 col-sm-12  form-group has-feedback ">
              <input type="hidden" id="edp_sid">
              <input type="text" id="edp_sname" class="form-control has-feedback-left" readonly >
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>

            <div class="col-md-12 col-sm-12  form-group has-feedback">
				
              <input type="password" class="form-control has-feedback-left" id="edp_p"  placeholder="Password">
			<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span> 
              <span class="fa fa-eye form-control-feedback right" aria-hidden="true" onClick="OC_edp_p()"></span> 
			  </div>

          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button onClick="edit_pass()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- End add sale -->
<!-- JS -->
<script src="<?php echo base_url() ?>public/tem_frontend/js/qrcode.min.js"></script>
<!-- END JS -->
<script>
	function OC_edp_p(){
		var x = document.getElementById("edp_p");
		var j = document.getElementById("ads_p");
		if (x.type === "password") {
			x.type = "text";
		  } else {
			x.type = "password";
		  }
		if (j.type === "password") {
			j.type = "text";
		  } else {
			j.type = "password";
		  }
	}
	function sel_desale(id) {
		window.location.href = 'calsale/'+id;
	}
	
	function edit_pass() {
		$('#cover-spin').show();
		var id 	 = $('#edp_sid').val();
		var pass = $('#edp_p').val();
		swal({
				text: "คุณต้องการแก้ไขสถานะพนักงานเซลล์",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})

			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
							url: 'edit_pass',
							type: 'POST',
							dataType: 'json',
							data: {
								id: id,pass:pass
							},
						})
						.done(function(res) {
							// success
							if (res.code == 1) {
								 swal(res.title,res.msg,'success');

							} else {
								swal(res.title,res.msg,'error');
								setTimeout(function() {
									location.reload();	
								}, 1000);
							}
						});

				} else {
					swal('ไม่ทำรายการ', 'ยกเลิกการทำรายการ', "error")
					setTimeout(function() { 
					}, 1000);
				}
			$('#cover-spin').hide();
			});
	}
	function sel_status() {
		$('#cover-spin').show();
		var status = $( "#sale_status option:selected" ).val();
		 $.ajax({
			url: 'get_sale',
			type: 'POST',
			dataType: 'json',
			data: {
				status:status
			},
		})
		.done(function(res) {
			// success
			if (res.code == 1) {
				$('#history').html('');
				if(res.data.length >= 1 ){
					var conut 	= res.data.length;
					var sale	= res.data;
					var content = '';
					for(var i=0; i < conut; i++){
						content += '<tr align="center">';
						content += '<td>'+i+'</td>';
						content += '<td>'+sale[i]['id']+'</td>';
						content += '<td>'+sale[i]['username']+'</td>';
						content += '<td>'+sale[i]['name']+'</td>';
						content += '<td>'+sale[i]['num_user']+'</td>';
						content += '<td>'+sale[i]['num_userLM']+'</td>';
						content += '<td>'+sale[i]['num_userD']+'</td>';
						content += '<td>'+sale[i]['num_userM']+'</td>';
						content += '<td> <button type="button" class="btn btn-secondary btn-sm" onClick="sel_desale(`'+sale[i]['id']+'`)"><i class="fa fa-file"> รายละเอียด</i></button></td>';
						content += '<td> <button type="button" class="btn btn-secondary btn-sm" onClick="getLink(`'+sale[i]['token']+'`, `'+sale[i]['id']+'`)"><i class="fa fa-share"> สร้างลิงค์</i></button></td>';
						content += '<td><button type="button" class="btn btn-secondary btn-sm" onClick=" $(`#m_edit_pass`).modal(); $(`#edp_sid`).val(`'+sale[i]['id']+'`);$(`#edp_sname`).val(`'+sale[i]['username']+'`);"><i class="fa fa-key"> รหัสผ่าน</i></button></td>';
						
						content += '<td width="10%"> <label><input type="checkbox" class=""  onchange="edit_status(`'+sale[i]['id']+'`,this)"';
						if(sale[i]['status'] == 1){
							content += 'checked';
						}
						content += '></label></td>';
						content += '</tr>';

					}
				}
				$('#history').html(content);
			} else {
				swal(res.title,res.msg,'error');
				setTimeout(function() {
					location.reload();	
				}, 1000);
			}
		});
		$('#cover-spin').hide();
	}
  function edit_status(id,status) {
	$('#cover-spin').show();
	var status = $(status).context.checked;
	if(status){ status = 1}else{status = 0}
    swal({
            text: "คุณต้องการแก้ไขสถานะพนักงานเซลล์",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'edit_status',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id,status:status
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
							 swal(res.title,res.msg,'success');
							
                        } else {
							swal(res.title,res.msg,'error');
							setTimeout(function() {
								location.reload();	
							}, 1000);
                        }
                    });

            } else {
                swal('ไม่ทำรายการ', 'ยกเลิกการทำรายการ', "error")
                setTimeout(function() { 
					location.reload();
                }, 1000);
            }
		$('#cover-spin').hide();
        });

  }
  function cre_sale() {
    var data = $('#form_creSale').serializeArray();
    $.ajax({
        url: 'cre_sale',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {
          console.log("success");
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
///////////////////////////////////////////////////////////////////////////////////////////////////





  function getLink(token,id) {
    
    $('#getLink').modal();
    $('#span_getLink').val('<?= base_url() ?>users/home/index/' + token);
    $('#sale_id').val(id);
    var qrcode = new QRCode(document.getElementById("demoqr"), {
      text: "<?= base_url() ?>users/home/index/" + token,
      width: 186,
      height: 186
    });


  }

  function clear_qrcode() {

    $('#demoqr').empty();

  }

  function copyLink() {

    var copyLink = document.getElementById("span_getLink");
    const showText = document.querySelector("p");
    /* Select the text field */
    copyLink.select();
    copyLink.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");
    showText.innerHTML = 'คัดลอกสำเร็จ'
    setTimeout(() => {
      showText.innerHTML = ''
    }, 4000)

  }

  function upDateLink(){

    var sale_id = $('#sale_id').val();
    swal({
            text: "ต้องการอัปเดตลิ้งค์สมัครใช่หรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
    $.ajax({
        url: '<?=base_url()?>backend/sale/update_token',
        type: 'POST',
        dataType: 'json',
        data: {sale_id:sale_id},
      })
      .done(function(res) {
        if (res.code == 1) {
          swal({
            icon: "success",
            text: res.msg,
          });
          $('#demoqr').empty(); 
          $('#span_getLink').val('<?= base_url() ?>users/home/index/' + res.token.token);
          var qrcode = new QRCode(document.getElementById("demoqr"), {
            text: "<?= base_url() ?>users/home/index/" + res.token.token,
            width: 186,
            height: 186
    });
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
    } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        }); 

  }
  
</script>
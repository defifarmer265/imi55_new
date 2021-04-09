<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.spinners{
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: text-bottom;
    background-color: currentColor;
    border-radius: 50%;
    opacity: 0;
}
</style>

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Safe Code<small></small></h2>
          
          <div class="clearfix"></div>
        </div>
		<div class="row ">
				<div class="col-sm-2">
				เลือกกะ
				<fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
								<select id="s_rounds" class="form-control" >
									<option value="0" >ทั้งหมด</option>
									<?php foreach ($rounds as $r=>$re){ ?>
										<option  value= "<?php echo $re['id']; ?>"><?php echo $re['rounds_desc'] . ' ' . $re['time_start'] . '-' . $re['time_end']; ?></option>
										<!-- <input type="hidden" name="id"  value= " <?php echo $re['id']; ?> "></input> -->
									<?php }?>
								</select>
                              </div>
                            </div>
                          </div>
                        </fieldset>
				</div>
				<div class="col-sm-1">
				Safecode
				<fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
							  	<button class="btn btn-info btn-sm" onClick="gen_select()">Safecode</button>
                              </div>
                            </div>
                          </div>
                        </fieldset>
				</div>
				<div class="col-sm-1">
				Logout
				<fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
							  	<button class="btn btn-info btn-sm" onClick="delete_select()">Logout</button>
                              </div>
                            </div>
                          </div>
                        </fieldset>
				</div>

        <div class="col-sm-7"></div>
        <div class="col-sm-4">
        
            <span class="btn btn-sm btn-outline-success"><i class="fa fa-users"></i> Online <?= $online;?></span> ||
            <span class="btn btn-sm btn-outline-danger"><i class="fa fa-users"></i> Offline <?= $offline;?></span>
        </div>
		</div>
		
		  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="table_dw" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                       <tr class="text-center">
                       <th width="2%">No.</th>
                       <th >Username</th>
                         <th  >Name</th>
                         <th >Name</th>
                         <th >Rounds</th>
						             <th >Status</th>
                         <th> สถานะ</th>
                         <th >Safe code	</th>
                         <th >Safe Time</th>
                         <th >Safe code</th>
                         <th >Logout</th>
                       </tr>
                     </thead>
						<tbody>
						<?php $i=1; foreach($admin as $_a=>$a){?>
						<tr style="text-align:center;">
							<td><?php echo $i;$i++; ?></td>
							<td id="username"><?php echo $a['username']; ?></td>
							<td><?php echo $a['name']; ?></td>
				
							<td><?=$a['class'] == 0 ?'หัวหน้าใหญ่':($a['class']==1 ? 'หัวหน้างาน' : 'พนักงานทั่วไป')?></td>
							<?php $license = $this->db->where('admin_id',$a['id'])->where('status',1)->get('tb_class_admin')->row(); ?>  

							<td><?php echo $a['rounds_desc']; ?></td>

							<td class="text-center">
							<label class="switch">
                                <?php if($a['safestatus']=='0'){?>
                                <input type="checkbox" onclick="open_statussafe(<?= $a['id']?>);" id="id" value="<?= $a['safestatus']?>"
                                    name="<?=$a['safestatus']?>" 
                                    <?=$a['safestatus'] == 0 ? '':''?> />
                                <?php }else{?>
                                <input type="checkbox" onclick="close_statussafe(<?= $a['id']?>);" id="id" value="<?= $a['safestatus']?>"
                                    name="<?=$a['safestatus']?>" 
                                    <?=$a['safestatus'] == 1 ? 'checked':''?> />
                                <?php }?>
								<span class="slider round"></span>
                            </label>
							</td>
              <td>
                  <?php
                      if($a['status_login'] =='1'){
                        echo '<span class="btn btn-outline-success">Online</span>';
                      }else{
                        echo '<span class="btn btn-outline-danger">Offline</span>';
                      }
                  ?>
              </td>

							<td><?php echo $a['safecode']; ?></td>   
								<?php	  
								$safetime =  $a['safetime'];               
								if ($a['safetime'] != ""){
									$safetime = date("d-m-Y H:i:s", $a['safetime']);
								}
								?>
							<td><?php echo $safetime; ?></td>  
								
							<td class="text-center">
									<button class="btn btn-info btn-sm" onClick="confrim_gen(<?=$a['id']?>)">Safecode</button>
							</td>
							<td class="text-center">
									<button class="btn btn-info btn-sm" onClick="confrim_delete(<?=$a['id']?>)">Logout</button>
							</td>

						</tr>
						<?php } ?>
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



<!--modal-->
<script>

	function confrim_gen(id)
	{
		
		swal({
			title: "gen safecode ",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "safe_code/save_safecode",
					type: 'post',	
					data: { id: id},
					dataType: "json",
					success: function(res) {
						if (res.code == 1) {
							swal(res.title,res.msg,'success')
                            .then((result) => { location.reload();})

						}else{
							swal(res.title,res.msg,'error')
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}

	function confrim_delete(id)
	{
		swal({
			title: "แตะพนักงานออกจากระบบ",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "safe_code/delete_safecode",
					type: 'post',	
					data: { id: id},
					dataType: "json",
					success: function(res) {
						if (res.code == 1) {
							swal(res.title,res.msg,'success')
                            .then((result) => { location.reload();})

						}else{
							swal(res.title,res.msg,'error')
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}


	function delete_select()
	{
		
		var id = $('#s_rounds').val();
		
		swal({
			title: "แตะพนักงานออกจากระบบ",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "safe_code/delete_select",
					type: 'post',	
					data: { id: id},
					dataType: "json",
					success: function(res) {
						if (res.code == 1) {
							swal(res.title,res.msg,'success')
                            .then((result) => { location.reload();})

						}else{
							swal(res.title,res.msg,'error')
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}

	function gen_select()
	{
		var id = $('#s_rounds').val();
		swal({
			title: "gen safecode ",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "safe_code/gen_select",
					type: 'post',	
					data: { id: id},
					dataType: "json",
					success: function(res) {
						if (res.code == 1) {
							swal(res.title,res.msg,'success')
                            .then((result) => { location.reload();})

						}else{
							swal(res.title,res.msg,'error')
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}

	
function open_statussafe(id) {
    swal({
            text: "คุณต้องการเปิดใช้งาน Safecode",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {                
                $.ajax({
                        url: 'safe_code/open_statussafe',
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
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });

}

function close_statussafe(id) {
    swal({
            text: "คุณต้องการปิดใช้งาน Safecode",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'safe_code/close_statussafe',
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
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

</script>
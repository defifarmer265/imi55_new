<?php  //echo'<pre>'; print_r(base_url());die();?>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายชื่อแบงค์<small></small></h2>
          <ul class="nav navbar-right panel_toolbox">

			  <li> <button  onClick="cre_bank()"><i class="fa fa-plus"></i></button></li>

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
                        <th width="5%"> รหัส</th>
                        <th> ชื่อแบงค์ </th>
                        <th> เลขบัญชี </th>
                        <th> แบงค์ </th>
                        <th> Username </th>
                        <th> Password </th>
                        <th> Limit </th>
                        <th> type </th>
                        <th> สถานะ </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if(!empty($bankAuto)){foreach($bankAuto as $_b => $bnk){ ?>
                      <tr>
                        <td ><?=$i?></td>
                        <td ><?=$bnk['name']?></td>
                        <td ><?=$bnk['account']?></td>
                        <td ><?=$bnk['bank_short']?></td>
                        <td ><?=$bnk['username']?></td>
                        <td ><?=$bnk['password']?></td>
                        <td >
                            <?php
                              if($bnk[ 'type' ] == 2){
                                echo $bnk['limit_amount'];
                            ?>	
                            <a href="#" onClick="edit_limit('<?=$bnk['id']?>','<?=$bnk['limit_amount']?>')"><i class="fa fa-pencil-square-o"></i></a>
                            <?php
                              }else{
                                echo '-';
                              }
                            ?>
                        </td>
                        <td >
						<?php
                        if ( $bnk[ 'type' ] == 1 ) {
                          echo 'ฝาก';
                        } else {
                          echo 'ถอน';
                        }
                        ?></td>

                        <td >
							<?php if ( !empty( $bnk[ 'status' ] ) && $bnk[ 'status' ] == 1 ) {?>
							  <a href="#" onClick="edit_statusBank('<?=$bnk['id']?>','<?=$bnk['bank_web_id']?>','0')" title="ปิด">
								  <i style="color:#3AED33;" class="fa fa-check"></i>
								</a>
							<?php }else if($bnk[ 'status' ] == 0){?>
								<a href="#" onClick="edit_statusBank('<?=$bnk['id']?>','<?=$bnk['bank_web_id']?>','1')" title="เปิด">
									<i style="color:#F51F23;" class="fa fa-remove"></i>
								</a>
							<?php }else{ ?>
								Error !!
							<?php }?>
						  </td>
                        <td >
							<a href="#" onClick="edit_statusBank('<?=$bnk['id']?>','<?=$bnk['bank_web_id']?>','4')" title="เปิด">
									<i style="color:#F51F23;" class="fa fa-remove"></i>
								</a>
						  </td>
                      </tr>
                      <?php $i++; ?>
                      <?php }}else{ ?>
                      <tr>
                        <td colspan="9" style="text-align:center">ไม่มีข้อมูล</td></td>
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
<div class="modal fade" id="mod_cre_bank" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แบงค์<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left" id="form_bank" style="font-size: 18px;">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
            <input type="hidden" name="id" id="bank_id">
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อบัญชี</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="name" name="name" placeholder="" maxlength="20" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">เลขที่บัญชี</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="account" name="account" placeholder="" maxlength="12" autocomplete="off" >
              </div>
            </div>
          </div>
		 
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">Bank</label>
              <div class="col-md-9 col-sm-9 ">
                <select class="form-control" name="bank_id">
					<?php 
					foreach($bank as $b){
						echo '<option value="'.$b['id'].'">'.$b['bank_short'].'-'.substr($b['bank_th'],18,40).'</option>';	
					}
					?>
				</select>
              </div>
            </div>
          </div>
			<div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">Username</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="username" name="username" placeholder="" maxlength="20" autocomplete="off" >
              </div>
            </div>
          </div>
			<div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">Password</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="password" name="password" placeholder="" maxlength="20" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">รายการ</label>
              <div class="col-md-9 col-sm-9 ">
                <select name="type" id="type" class="form-control">
					<option value="1">ฝาก</option>
					<option value="2">ถอน</option>
                  	
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onClick="form_creBnk()" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Limit Amount-->
<div class="modal fade" id="mod_edit_limit" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขยอด<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left" id="form_limit_amount" style="font-size: 18px;">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนเงิน</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text"  id="auto_id" name="auto_id"  >
                <input type="number" class="form-control" id="limit_amount" name="limit_amount"  >
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onClick="form_edit_amount()" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
function form_creBnk(){
	var data = $('#form_bank').serializeArray();
	$.ajax({
		url: 'bank_auto_create',
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
function form_edit_amount(){
	var data = $('#form_limit_amount').serializeArray();
	$.ajax({
		url: 'bank_auto_edit_limit',
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
function edit_limit(auto_id,limit_amount)
{
	$('#mod_edit_limit').modal();
	$('#limit_amount').val(limit_amount)
	$('#auto_id').val(auto_id)

}
function cre_bank(){
	$('#mod_cre_bank').modal();
	$('#bank_id').val('');
	$('#name').val('');
	$('#bank_short').val('');
	$('#account').val('');

}
function edit_statusBank(id,bank_web_id,status){
	swal({
			  title: 'ต้องการเปลี่ยนสถานะแบงค์ ?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				 $.ajax({
					url: 'bank_auto_status',
					type: 'POST',
					dataType: 'json',
					data: {id:id,bank_web_id:bank_web_id,status:status},
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

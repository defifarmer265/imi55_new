<link href="<?php  echo $this->config->item('tem_frontend_css'); ?>custom.min_selectpaket.css" rel="stylesheet">
<link rel="stylesheet" href="<?php  echo $this->config->item('tem_frontend_css'); ?>bootstrap.min.css">
<script src="<?php  echo $this->config->item('tem_frontend_css'); ?>jquery.min.js"></script>
<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-7 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการฝาก</h2>

          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <div class="x_panel">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
					
					
                  
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
    </div>
	 <div class="col-md-5 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการฝาก</h2>

          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
					<div class="row">
						<div class="col-2">
							
					
							<ul class="bs-glyphicons-list" style="text-align: center">
								<li><img width="50%" src="<?=base_url()?>public/tem_frontend/img/mapraw_icon/bank/025.png"></li>
								<li >
								 <span style="font-weight: 600" class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
		
								<li>
								<li><img width="50%" src="<?=base_url()?>public/tem_frontend/img/mapraw_icon/bank/025.png"></li>
							</ul>

							
						</div>
						<div class="col-7">
							<small> 
								<p> 94250 [KBANK]</p>
								<p> รหัสลูกค้า:4838</p>
								<p> รหัสลูกค้า:สมพรพูลศิศ</p>
							 	<p> เส้นทาง: Moblie</p>
								<p> รับโอนจาก SCB x5880 น.ส. ชยาพร มั่งคั่ง</p></small>
						</div>
						<div class="col-3">
						 <p> <small>12/08/2563 18:00</small></p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-2">
							
					
							<ul class="bs-glyphicons-list" style="text-align: center">
								<li><img width="50%" src="<?=base_url()?>public/tem_frontend/img/mapraw_icon/bank/025.png"></li>
								<li >
								 <span style="font-weight: 600" class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
		
								<li>
								<li><img width="50%" src="<?=base_url()?>public/tem_frontend/img/mapraw_icon/bank/025.png"></li>
							</ul>

							
						</div>
						<div class="col-7">
							<small> 
								<p> 94250 [KBANK]</p>
							 	<p> เส้นทาง:ENET</p>
							 	<p> รหัสลูกค้า:4838</p>
							 	<p> รหัสลูกค้า:สมพรพูลศิศ</p>
								<p> รับโอนจาก SCB x6712 นางสาว รุ่งนภา ประจง</p></small>
						</div>
						<div class="col-3">
						 <p> <small>12/08/2563 18:00</small></p>
						</div>
					</div>
					<hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dep_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แอดเครดิตให้ลูกค้าลูกค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <input type="hidden" value="" id="state_id" >
		  <div class="row">
		  	<div class="col-md-3">
				<label class="text-right" style="padding: 10px;">ยอดเงิน</label>
			  </div>
		  	<div class="col-md-3">
			  <div class="form-group" > <input type="text" readonly value="" id="state_amount" class="form-control"></div>
			</div>
			<div class="col-md-6">
			  <div style="width:55%; display:inline-table;">
                <select  id="user_id" class="selectpicker" name="sellist1" data-hide-disabled="true" data-live-search="true" style="width: 60%;" >
        						<?php foreach($user as $_u=>$us) {?>
								 <option value="<?=$us['user']?>"> <?=substr($us['user'],-7)?> / <?=$us['username']?></option>
        						<?php }?>
                </select>
              </div>
			</div>
		  </div>
		  
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onClick="addcredit()">เพิ่ม</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>

<!--modal get history-->
<div class="modal fade" id="gethistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">รายการฝาก 1 วันย้อนหลัง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="bodyhistory"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js" defer></script>

<link rel="stylesheet" href="<?php  echo $this->config->item('tem_backend_vendors'); ?>dist/bootstrap.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script> 
<script>
	$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
function closeDPS(dps_id)
	{
		swal({
			title: "ปิดการเข้าถึง" + dps_id,
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "deposit/editDPS",
					type: 'post',	
					data: { dps_id: dps_id,status:3},
					dataType: "json",
					success: function(res) {
						if (res.status == 1) {
							swal({
                                icon: 'success',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})

						}else{
							swal({
                                icon: 'error',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}
function mod_addcredit(state_id,state_amount)
	{
		$('#state_id').val(state_id);
		$('#state_amount').val(state_amount);
		
		$('#dep_user').modal();
		
	}
function addcredit()
	{
		
		var user = $('#user_id').val();
		var state_id = $('#state_id').val();
//		alert(state_id);
		swal({
			title: "ยืนยันเพิ่มเครดิต " + user,
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "deposit/addcredit",
					type: 'post',	
					data: { state_id: state_id,user:user},
					dataType: "json",
					success: function(res) {
						if (res.status == 1) {
							swal({
                                icon: 'success',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})

						}else{
							swal({
                                icon: 'error',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}
function gethistory(user)
	{
		$.ajax({
			url: "deposit/get_wd",
			type: 'post',	
			data: { user: user},
			dataType: "json",
			success: function(res) {
				if (res.status == 1) {
					$('#gethistory').modal();
					if(res.data.length >= 1 ){
						var conut 	= res.data.length;
						var wd 		= res.data;
						var content = '<table class="table">';
							content += '<tr><th>No</th><th>User</th><th>Date</th><th>Time</th><th>Amount</th></tr>';
						for(var i=0; i < conut; i++){
							content += '<tr><td>'+i+'</td><td>'+wd[i]['ToUsername']+'</td><td>'+wd[i]['CreationTime'].substr(0,10)+'</td><td>'+wd[i]['CreationTime'].substr(11)+'</td><td>+'+wd[i]['Amount']+'</td></tr>';
						}
						content += "</table>"
					}else{
						var content = 'No data';
					}
					$('#bodyhistory').html(content);

				}else{
					swal({
						icon: 'error',
						title: res.msg,
					})
				}

			}
		});
	}
	
	
	
	
	
	
	
	
	
</script>
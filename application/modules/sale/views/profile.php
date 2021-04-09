<div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>โปรไฟล์เซลล์ <small class="text-success"> (ใช้งาน) </small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-6 col-sm-6  profile_left">

                      <h3><?=$sale->name?></h3>

                      <ul class="list-unstyled user_data">
						  <li>
							<i class="fa fa-key user-profile-icon"></i> รหัส : S55<?=substr(("000000" . (intval($sale->id))), -6);?>
                        </li>
                        <li>
							<i class="fa fa-user user-profile-icon"></i> สร้างโดย : <?=$sale->sale_cre_name?>
                        </li>
						<li>
							<i class="fa fa-link user-profile-icon"></i> ลิงค์ : <span id="linkshare"><?=getenv('base_url')?><?=getenv('path_mem')?>users/home/index/<?=$sale->token?>  </span><span class="badge badge-info" style="cursor: pointer;" onClick="copyLink()">COPY</span>
                        </li>
						<li>
							<i class="fa fa-clock-o user-profile-icon"></i> วันที่เข้าล่าสุด : <?=date('d/m/Y',$sale->last_login)?>
                        </li>
						  
						  <li>
							<i class="fa fa-clock-o user-profile-icon"></i> เวลาเข้าล่าสุด : <?=date('H:i:s',$sale->last_login)?>
                        </li>
						  <li>
							<i class="fa fa-map-marker user-profile-icon"></i> IP ล่าสุด : <?=$sale->lastip_login?>
                        </li>
                      </ul>

                      <a class="btn btn-sm btn-outline-info" onClick="$('#m_edit_pass').modal()"><i class="fa fa-edit m-right-xs"></i> เปลี่ยนพาส</a>
                      <br />


                    </div>
					<div class="col-md-6 col-sm-6  profile_left">
				
						<div id="qrcode" style="width: 100px;height: 100px"></div>
						
                    </div>
                </div>
                </div>
              </div>
            </div>
<div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>รายละเอียดการเข้าระบบ </h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-12 col-sm-12  ">

         				<table class="table">
							<thead>
								<tr>
									<th> ลำดับ </th>
									<th> เวลา </th>
									<th> รายละเอียด </th>
									
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach($log_login as $ll){ ?>
								<tr>
									<td><?=$i?></td>
									<td><?=date('d/m/Y H:i:s',$ll['datetime'])?></td>
									<td><?=$ll['detail']?></td>
								</tr>
								<?php $i++; }?>
							</tbody>
						</table>

                    </div>

                  </div>
                </div>
              </div>
            </div>

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
              <input type="text" class="form-control has-feedback-left" readonly value="<?=$sale->name?>" >
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>

            <div class="col-md-12 col-sm-12  form-group has-feedback">
				
              <input type="password" class="form-control has-feedback-left" id="edp_p"  placeholder="Password">
			<span class="fa fa-key form-control-feedback left" aria-hidden="true"></span> 
              <span class="fa fa-eye form-control-feedback right" aria-hidden="true" onClick="show_password()"></span> 
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

<script src="<?php echo base_url()?>public/tem_frontend/js/qrcode.min.js"></script>
<script>
	var qrcode = new QRCode("qrcode");

function makeCode () {      

    
    qrcode.makeCode('<?=base_url()?>users/home/index/<?=$sale->token?>');
}

makeCode();

$("#text").
    on("blur", function () {
        makeCode();
    }).
    on("keydown", function (e) {
        if (e.keyCode == 13) {
            makeCode();
        }
    });
	
function copyLink() {
  var copyText = $('#linkshare').html();
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(copyText).select();
  document.execCommand("copy");
  $temp.remove();
	swal("Coppy Success");
}
function show_password(){
	var x = document.getElementById("edp_p");

	if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }

}
function edit_pass() {
		$('#cover-spin').show();
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
							url: '<?=base_url()?>sale/profile/edit_pass',
							type: 'POST',
							dataType: 'json',
							data: {
								pass:pass
							},
						})
						.done(function(res) {
							// success
							if (res.code == 1) {
								 swal(res.title,res.msg,'success');
								 setTimeout(function() {
									location.reload();	
								}, 1000);
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
</script>
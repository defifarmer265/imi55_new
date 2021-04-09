
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>OTP<small></small></h2>

          <div class="clearfix"></div>
        </div>
		<div class="row">
	<div class="col-sm-2">
				เบอร์โทร
				<input type="text" value="" class="form-control" id="tel" maxlength="10" placeholder="เบอร์โทร">
				ใส่แค่ตัวเลข 10 หลัก
				</div>
			<div class="col-sm-2"><br>
				<button onClick="select_tel()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
				</div>
			<hr>
			</div>
		<div class="row">
		  <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%" >
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr align="center">
                        <th width="2%">No</th>
                        <th width="2%">id</th>
                        <th width="">เบอร์</th>
                        <th width="">วันที่เวลา</th>
                        <th width="">REF</th>
                        <th width="">OTP</th>
                        <th width="2%">Status</th>
                      </tr>
                    </thead>
                    <tbody id="bodyhistory">
                     	<?php $i=1; foreach($otp as $o){ ?>
						<tr>
							<td class="text-center"><?=$i?></td>
							<td class="text-center"><?=$o['id']?></td>
							<td class="text-center" id="tel"><?=$o['tel']?></td>
							<td class="text-center"><?=date('d/m/Y H:i',$o['create_time'])?></td>
							<td class="text-center"><?=$o['ref']?></td>
							<td class="text-center"><?=$o['otp']?></td>
							<td class="text-center"><?php
									if($o['status'] == 2 ){
								echo '<i class="fa fa-check"></i>';
									}else if($o['status'] == 1 ){
								?>
								<button class="btn btn-info btn-sm" onClick="confrim(<?=$o['id']?>)">ยืนยัน</button>
								<?php
									}
								?></td>
						</tr>
                     	<?php $i++; }?>
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


<script>
function confrim(id)
	{
		var tel = $('#tel').html();
		swal({
			title: "ยืนยันเบอร์โทร "+tel,
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "otp/confrim",
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

function select_tel()
	{
		$('#cover-spin').show();
		$('#bodyhistory').html('');
		var tel = $('#tel').val();

			$.ajax({
				url: 'otp/sel_tel',
				type: 'POST',
				dataType: 'json',
				data: {tel:tel},
			})
			.done(function(res) {
				if (res.code == 1) {
					$('#table_rj').hide();
					$('#table_dw').show();
					if(res.data.length >= 1 ){
						var conut 	= res.data.length;
						var otp 	= res.data;
						var content = '';
						for(var i=0; i < conut; i++){
							content += '<tr>';
							content += '<td>'+i+'</td>';
							content += '<td>'+otp[i]['id']+'</td>';
							content += '<td>'+otp[i]['tel']+'</td>';
							content += '<td>'+otp[i]['create_time']+'</td>';
							content += '<td>'+otp[i]['ref']+'</td>';
							content += '<td>'+otp[i]['otp']+'</td>';
							if(otp[i]['status'] == 2){
								content += '<td><i class="fa fa-check"></i></td>'
							}else{
								content += '<td><button class="btn btn-info btn-sm" onClick="confrim('+otp[i]['id']+')">ยืนยัน</button></td>'
							}

							$('#bodyhistory').html(content);
						}

					}else{
						var content = 'No data';
					}
					
				}else {
					swal(res.title,res.msg,'error')
                    .then((result) => { location.reload();})
				}
				$('#cover-spin').hide();
				
			})
			.fail(function() {
				console.log("error");
			});
		
		
	}
	function nb(x) {
     var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>

  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2> <?=$this->session->sale->username?> (<?=$this->session->sale->name?>)</h2>
			<input type="hidden" value="<?=$this->session->sale->id?>" id="sale_id">
          <ul class="nav navbar-right panel_toolbox">

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-3 ">
                วันเริ่ม
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                      </div>
                    </div>
                  </div>
                </fieldset>

              </div>
              <div class="col-sm-3">
                วันสิ้นสุด
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
<!--
				<div class="col-sm-1">
                ยูสเซียน
               <input type="number" class="form-control text-center " id="num_free" value="0">
              </div>
-->
				<div class="col-sm-2">
                งบประมาณ
                <input type="number" class="form-control text-center" id="cost" value="0">
              </div>
              <div class="col-sm-1">
                <br>
                <button type="button" onClick="sel_sale()" class="btn btn-info">ค้นหา</button>

              </div>

              <div class="col-sm-12">
                
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
          <h2>วันที่ ถึง งบประมาณ</h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">

				<div class="col-md-4">
					<table class="table table-bordered" style="font-size: 17px;">
						<thead>
							<tr class="text-center">
								<th>รายการ</th>
								<th>ยอดเงิน</th>
							</tr>
						</thead>

						<tbody class="text-right">
							<tr>
								<td>จำนวนลูกค้า</td>
								<td id="numall"></td>
							</tr>
							<tr>
								<td>จำนวนมียอดแรก</td>
								<td id="numf"></td>
							</tr>
							<tr>
								<td >ลูกค้าต่ำกว่า <?=$setting->f_amt0?></td>
								<td id="numf0"></td>
							</tr>
							<tr>
								<td >ลูกค้ายอด <?=$setting->f_amt0?> - <?=$setting->f_amt1?> </td>
								<td id="numf1"></td>
							</tr>
							<tr>
								<td >ลูกค้ายอด <?=$setting->f_amt1?> เป็นต้นไป </td>
								<td id="numf2"></td>
							</tr>
							<tr>
								<td >ค่าเฉลี่ย </td>
								<td id="average"></td>
							</tr>
							<tr>
								<td >ค่าคอม (ลูกค้า1 x เรท1) + (ลูกค้า2 x เรท2) <br><div id="pay"></div></td>
								<td id="comtt"></td>
							</tr>
							<tr>
								<td>รวมยอดฝากแรก <?= $setting->f_amt0 ?> - <?= $setting->f_amt1 ?></td>
								<td id="sumft"></td>
							</tr>
							<tr>
								<td >รวมยอดฝากแรก</td>
								<td id="sumtt"></td>
							</tr>
							
							<tr>
								<td >สุทธิ</td>
								<td id="tt"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<table class="table table-bordered" style="font-size: 17px;">
						<thead>
							<tr class="text-center">
								<th>ค่าเฉลีย</th>
								<th>อัตราจ่าย <?=$setting->f_amt0?>-<?=$setting->f_amt1?></th>
								<th>อัตราจ่าย <?=$setting->f_amt1?>+</th>
							</tr>
						</thead>
						<tbody class="text-center">
							<tr id="ave1">
								<td><?=$setting->ave1?></td>
								<td><?=$setting->ave1_pay1?></td>
								<td><?=$setting->ave1_pay2?></td>
							</tr>
							<tr id="ave2">
								<td><?=$setting->ave2?></td>
								<td><?=$setting->ave2_pay1?></td>
								<td><?=$setting->ave2_pay2?></td>
							</tr>
							<tr id="ave3">
								<td><?=$setting->ave3?></td>
								<td><?=$setting->ave3_pay1?></td>
								<td><?=$setting->ave3_pay2?></td>
							</tr>
							<tr id="ave4">
								<td><?=$setting->ave4?></td>
								<td><?=$setting->ave4_pay1?></td>
								<td><?=$setting->ave4_pay2?></td>
							</tr>
							<tr id="ave5">
								<td><?=$setting->ave5?></td>
								<td><?=$setting->ave5_pay1?></td>
								<td><?=$setting->ave5_pay2?></td>
							</tr>
							<tr id="ave6"><td>0</td><td>0</td><td>0</td></tr>
							
						</tbody>
					</table>
<!--
					<table class="table table-bordered" style="font-size: 17px;">
						<tbody class="text-center">
							<tr>
								<td>ยอดจ่าย ยูสเซียน</td>
								<td><?=$setting->pay_free?></td>
	
							</tr>
							
							
							
						</tbody>
					</table>
-->
					
					<button class="btn btn-outline-success" onClick="report_sale()">เรียกดูรายงาน</button>
				</div>
				<div class="col-md-4">
				<tr>
					<table class="table table-bordered" style="font-size: 17px;">
						<thead>
							<tr class="text-center">
								<th>รายการ</th>
								<th>ยอดเงิน</th>
								
							</tr>
						</thead>
						<tbody class="text-center">
							<tr>
								<td >รวมยอดฝากทั้งหมด</td>
								<td id="sdall"></td>
							</tr>
							<tr>
								<td >รวมยอดถอนทั้งหมด</td>
								<td id="swall"></td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
						
				  
          </div>
        </div>
      </div>
    </div>
  </div>
	<div class="row" style="display: none" id="report_history">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายละเอียด</h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
				<div class="col-md-12">
					<div id="history"></div>
				</div>
            </div>
						
				  
          </div>
        </div>
      </div>
    </div>
  </div>


<script>
	function report_sale(){
		$('#cover-spin').show();
		var d1 = $('#single_cal2').val();
      	var d2 = $('#single_cal3').val();
      	var id = $('#sale_id').val();
		swal({
				text: "เรียกรายการลูกค้าทั้งหมด",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})

			.then((willDelete) => {
			
				if (willDelete) {
					$.ajax({
							url: '<?=base_url()?>sale/salelist/report_sale',
							type: 'POST',
							dataType: 'json',
							data: {
								d1:d1,d2:d2,id:id
							},
						})
						.done(function(res) {
							// success
							$('#cover-spin').hide();
							if (res.code == 1) {
								var calsale = res.data;
								var conut 	= res.data.length;
								var content = '';
								var contentsum = '';
								var tt_dp 	= 0;
								content += '<table class="table table-bordered" style="font-size: 11px;">';
								content += '<thead>';
								content += '<tr class="text-center">';
								content += '<th>ลำดับ</th>';
								content += '<th>รหัส</th>';
								content += '<th>รหัสลูกค้า</th>';
								content += '<th>เบอร์ลูกค้า</th>';
								content += '<th>วันที่สมัคร</th>';
								content += '<th>ยอดแรก</th>';
								content += '<th>สถานะ</th>';
								content += '</tr>';
								content += '</thead>';
								content += '<tbody id="contentsum"></tbody>'
								for(var i=0; i < conut; i++){
									
									content += '<tr>';
									content += '<td>'+i+'</td>';
									content += '<td>'+calsale[i]['user_id']+'</td>';
									content += '<td>'+calsale[i]['user']+'</td>';
									content += '<td>'+calsale[i]['username']+'</td>';
									content += '<td>'+moment.unix(calsale[i]['create_time']).format("DD-MM-YY HH:mm")+'</td>';
									content += '<td>'+calsale[i]['deposit']+'</td>';
									content += '<td><i class="fa fa-check" style="color: #42DC36"></i></td>';
									content += '</tr>';
									tt_dp = tt_dp + parseFloat(calsale[i]['deposit']);

								}
								content += '</table>';
								contentsum += '<tr>';
								contentsum += '<td colspan="5"></td>';
								contentsum += '<td>'+tt_dp+'</td>';
								contentsum += '<td></td>';
								contentsum += '</tr>';
								$('#contentsum').html(contentsum);
								$('#report_history').show();
								$('#history').html(content);
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
				
			});
	}
   function sel_sale()
	{
		$('#cover-spin').show();
//		var nf = $('#num_free').val();
		var cost = $('#cost').val();
		var d1 = $('#single_cal2').val();
      	var d2 = $('#single_cal3').val();
      	var id = $('#sale_id').val();
		$('#ave1').removeClass('text-danger');
		$('#ave2').removeClass('text-danger');
		$('#ave3').removeClass('text-danger');
		$('#ave4').removeClass('text-danger');
		$('#ave5').removeClass('text-danger');
		$('#ave6').removeClass('text-danger');
		swal({
				text: "ค้นหารายการเซลล์",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})

			.then((willDelete) => {
			
				if (willDelete) {
					$.ajax({
							url: '<?=base_url()?>sale/salelist/calculate_',
							type: 'POST',
							dataType: 'json',
							data: {
								cost:cost,d1:d1,d2:d2,id:id //,nf: nf
							},
						})
						.done(function(res) {
							// success
							$('#cover-spin').hide();
							if (res.code == 1) {
								 var calsale = res.data;
								$('#numall').html(calsale.numall);
								$('#average').html(calsale.average);
								$('#comtt').html(calsale.comtt);
								$('#numf').html(calsale.numf);
								$('#numf0').html(calsale.numf0);
								$('#numf1').html(calsale.numf1);
								$('#numf2').html(calsale.numf2);
								$('#sumtt').html(calsale.sumtt);
								$('#sdall').html(calsale.sdall);
								$('#swall').html(calsale.swall);
								$('#sumft').html(calsale.sumft);
								$('#tt').html(calsale.tt);
								$('#'+calsale.typepay).addClass('text-danger');
								$('#pay').html('('+calsale.numf1+' x '+calsale.pay1+') + ('+calsale.numf2+' x '+calsale.pay2+')');
								
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
				
			});
	}
</script>
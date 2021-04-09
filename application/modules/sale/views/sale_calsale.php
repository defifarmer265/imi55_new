<div id="cover-spin"></div>
<div class="row">
	<div class="col-md-11 col-sm-11 ">
		<div class="x_panel">
			<div class="x_title">
				<h2><?= $sale->username ?> (<?= $sale->name ?>)</h2>
				<input type="hidden" value="<?= $sale->id ?>" id="sale_id">
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

						<div class="col-sm-2">
							งบประมาณ
							<input type="number" class="form-control text-center" id="cost" value="0">
						</div>
						<div class="col-sm-4">
							<span class="text-danger">**ระบบอาจใช้เวลาค้นหา 1 - 2 นาที</span><br>
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
<div id="detail_all" style="display: none;">
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

						<div class="col-md-8 ">
							<table class="" border="1" style="border: rgba(57,46,205,1.00);font-size: 15px;color: #000;" width="100%">
								<thead>
                                    <tr class="text-center" style="background-color: #05118C;color: white;">
										<th colspan="3"> <h5 class="p-2"> รายละเอียดและวิธีคิดค่าตอบแทน </h5> </th>
									</tr>
									<tr class="text-center" style="background-color: #65D6E4">
										<th width="60%"> รายการ </th>
										<th width="30%"> จำนวน </th>
										<th width="10%"> # </th>
									</tr>
								</thead>

								<tbody >
									<tr>
										<td> จำนวนสมัครใหม่ทั้งหมด </td>
										<td class="text-center" id="us"> </td>
										<td class="text-center"> ยูสเซอร์ </td>
									</tr>
									<tr>
										<td> จำนวนสมัครใหม่มียอดฝาก </td>
										<td class="text-center" id="usdps"> </td>
										<td class="text-center"> ยูสเซอร์ </td>
									</tr>
									<tr>
                                        <td colspan="3" align="center" style="padding: 8px;">
                                            <table width="100%" style="font-size: 12px;" border="1">
                                                 <tr class="text-center" style="background-color: #05118C;color: white;">
                                                    <th colspan="3"> จำนวนลูกค้าแบ่งตามเรท  </th>
                                                </tr>
                                                <tr class="text-center" style="background-color: #65D6E4">
                                                    <td class="text-center" width="33.33%">  <b> (r1) </b>ฝากน้อยกว่า <?= $setting->f_amt0 ?> </td>
                                                    <td class="text-center" width="33.33%">  <b> (r2) </b>ฝาก <?= $setting->f_amt0 ?> ถึง <?= $setting->f_amt1 - 1 ?>   </td>
                                                    <td class="text-center" width="33.33%">  <b> (r3) </b>ฝาก <?= $setting->f_amt1 ?> ขึ้นไป  </td>
                                                </tr>
                                                <tr>
                                                   <td class="text-center" id="num1r1"></td>
                                                   <td class="text-center" id="num1r2"></td>
                                                   <td class="text-center" id="num1r3"></td>
                                                </tr>
                                              
                                            </table>
                                        </td>				
									</tr>

									<tr>
										<td> 
                                            ค่าเฉลี่ย [งบประมาณ / ยอดฝากแรก] <br> 
                                            <div id="ave_detail"></div>
                                        </td>
                                        <td class="text-center" id="ave"> </td>
										<td class="text-center"> เฉลี่ย </td>
									</tr>
									<tr>
										<td style="font-size: 14px;"> ค่าคอม [ <b>(r2)</b> x <b>(p1)</b> ] + [ <b>(r3)</b> x <b>(p2)</b> ] <br>
											<div id="cal_tt_detail"></div>
										</td>
										<td class="text-center" id="cal_tt"></td>
										<td class="text-center"> บาท </td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-4">
                            <div class="row">
							<table class="" border="1" style="border: rgba(57,46,205,1.00);font-size: 14px;color: #000; " width="100%">
								<thead>
                                    <tr class="text-center" style="background-color: #05118C;color: white;">
										<th colspan="3"> <h5 class="p-2"> ตารางค่าเฉลี่ย </h5> </th>
									</tr>
									<tr class="text-center" style="background-color: #65D6E4">
										<th style="padding: 5px;">ค่าเฉลีย</th>
										<th>(p1) อัตราจ่าย <?= $setting->f_amt0 ?>-<?= $setting->f_amt1 - 1 ?></th>
										<th>(p2) อัตราจ่าย <?= $setting->f_amt1 ?>+</th>
									</tr>
								</thead>
								<tbody class="text-center">
                                    <tr>
                                        <td><i class="ave1" style="color: #22FF00"></i><?= $setting->ave1 ?></td>
                                        <td><i class="ave1" style="color: #22FF00"></i><?= $setting->ave1_pay1 ?></td>
                                        <td><i class="ave1" style="color: #22FF00"></i><?= $setting->ave1_pay2 ?></td>
									</tr>
									<tr>
                                        <td><i class="ave2" style="color: #22FF00"></i><?= $setting->ave2 ?></td>
                                        <td><i class="ave2" style="color: #22FF00"></i><?= $setting->ave2_pay1 ?></td>
                                        <td><i class="ave2" style="color: #22FF00"></i><?= $setting->ave2_pay2 ?></td>
									</tr>
									<tr>
                                        <td><i class="ave3" style="color: #22FF00"></i><?= $setting->ave3 ?></td>
                                        <td><i class="ave3" style="color: #22FF00"></i><?= $setting->ave3_pay1 ?></td>
                                        <td><i class="ave3" style="color: #22FF00"></i><?= $setting->ave3_pay2 ?></td>
									</tr>
									<tr>
                                        <td><i class="ave4" style="color: #22FF00"></i><?= $setting->ave4 ?></td>
                                        <td><i class="ave4" style="color: #22FF00"></i><?= $setting->ave4_pay1 ?></td>
                                        <td><i class="ave4" style="color: #22FF00"></i><?= $setting->ave4_pay2 ?></td>
									</tr>
									<tr>
                                        <td><i class="ave5" style="color: #22FF00"></i><?= $setting->ave5 ?></td>
                                        <td><i class="ave5" style="color: #22FF00"></i><?= $setting->ave5_pay1 ?></td>
                                        <td><i class="ave5" style="color: #22FF00"></i><?= $setting->ave5_pay2 ?></td>
									</tr>
									<tr>
                                        <td><i class="ave6" style="color: #22FF00"></i>0</td>
                                        <td><i class="ave6" style="color: #22FF00"></i>0</td>
                                        <td><i class="ave6" style="color: #22FF00"></i>0</td>
									</tr>

								</tbody>
							</table>
                            </div>
                            <div class="row">
                                <br>
							<table class="" border="1" style="border: rgba(57,46,205,1.00);font-size: 15px;color: #000;" width="100%">
                                <thead>
									
									<tr class="text-center" style="background-color: #65D6E4">
										<th width="60%"> รายการ </th>
										<th width="30%"> ยอดเงิน </th>
										<th width="10%"> # </th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td> รวมยอดฝากทั้งหมด </td>
										<td class="text-right" id="dps"> </td>
										<td class="text-center"> บาท </td>
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
</div>
<div class="row">
    <div class="col-md-8">
    <div class="x_panel">
                  <div class="x_title">
                    <h2> รายชื่อสมาชิกที่มียอดฝาก <small> มีรายการฝาก</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                          <div id="content_fdps"></div>
                  </div>
                </div>
    </div>
    <div class="col-md-4">
    <div class="x_panel">
      <div class="x_title">
        <h2> สมาชิกที่ยังไม่มียอดฝาก <small style="cursor:pointer"  onClick="report_sale()"> ดูรายละเอียด</small></h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
              <div id="content_nodps"></div>
      </div>
    </div>
    </div>
</div>
</div>

	<script>
		function report_sale() {
			$('#cover-spin').show();
			var d1 = $('#single_cal2').val();
			var d2 = $('#single_cal3').val();
			var id = $('#sale_id').val();
			swal({
					text: "เรียกดูรายการ",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})

				.then((willDelete) => {

					if (willDelete) {
						$.ajax({
								url: '<?= base_url() ?>sale/income/report_sale',
								type: 'POST',
								dataType: 'json',
								data: {
									d1: d1,
									d2: d2,
									id: id
								},
							})
							.done(function(res) {
								// success
								$('#cover-spin').hide();
								if (res.code == 1) {
									var calsale = res.data;
									var conut = res.data.length;
									var content = '';
									var contentsum = '';
									var tt_dp = 0;
									content += '<table class="" border="1" style="border: rgba(57,46,205,1.00);font-size: 11px;color: #000;" width="100%">';
									content += '<thead>';
									content += '<tr class="text-center" style="background-color: #65D6E4" >';
									content += '<th>ลำดับ</th>';
									content += '<th>รหัสลูกค้า</th>';
									content += '<th>เบอร์ลูกค้า</th>';
									content += '<th>วันที่สมัคร</th>';

									content += '</tr>';
									content += '</thead>';
									content += '<tbody id="contentsum"></tbody>'
									for (var i = 0; i < conut; i++) {
                                        let c = i+1;
										content += '<tr class="text-center">';
										content += '<td>' + c + '</td>';
										content += '<td>' + calsale[i]['user'] + '</td>';
										content += '<td>' + calsale[i]['username'] + '</td>';
										content += '<td>' + moment.unix(calsale[i]['create_time']).format("DD-MM-YY HH:mm") + '</td>';
										content += '</tr>';
									

									}
									content += '</table>';
									
									$('#content_nodps').html(content);
			
								} else {
									swal(res.title, res.msg, 'error');
									setTimeout(function() {
										location.reload();
									}, 1000);
								}
							});


					} else {
						swal('ไม่ทำรายการ', 'ยกเลิกการทำรายการ', "error")
						setTimeout(function() {}, 1000);

					}

				});
		}

		function sel_sale() {
			$('#cover-spin').show();
			$('#contentsum').html('');
			var cost = $('#cost').val();
			var d1 = $('#single_cal2').val();
			var d2 = $('#single_cal3').val();
			var id = $('#sale_id').val();
			$('.ave1').removeClass('fa fa-check');
			$('.ave2').removeClass('fa fa-check');
			$('.ave3').removeClass('fa fa-check');
			$('.ave4').removeClass('fa fa-check');
			$('.ave5').removeClass('fa fa-check');
			$('.ave6').removeClass('fa fa-check');
			swal({
					text: "ค้นหารายการเซลล์",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})

				.then((willDelete) => {

					if (willDelete) {
						$.ajax({
								url: '<?= base_url() ?>sale/income/calculate_',
								type: 'POST',
								dataType: 'json',
								data: {
									cost: cost,
									d1: d1,
									d2: d2,
									id: id //,nf: nf
								},
							})
							.done(function(res) {
								// success
								$('#cover-spin').hide();
								$('#detail_all').show();
								if (res.code == 1) {
									var sum = res.data.sum;
                                    $('.'+sum.ave_type).addClass('fa fa-check');
                                    $('#usdps').html(sum.usdps);
                                    $('#us').html(sum.us.toLocaleString());
                                    $('#num1r1').html(sum.num1r1.toLocaleString());
                                    $('#num1r2').html(sum.num1r2.toLocaleString());
                                    $('#num1r3').html(sum.num1r3.toLocaleString());
                                    $('#ave').html(sum.ave);
                                    $('#ave_detail').html(sum.cost+' / '+sum.usdps);
                                    $('#cal_tt').html(sum.cal_tt.toLocaleString());
                                    $('#cal_tt_detail').html('[ ('+sum.num1r2+' x '+sum.ave_pay1+') + ('+sum.num1r3+' x '+sum.ave_pay2+') ]');
                                    $('#dps').html(sum.dps.toLocaleString());
   
                                    
                                    
                                    //content_fdps
                                    var user = res.data.user;
                                    var conut = res.data.user.length;
                                    var content_fdps = '';
                                    
                                    content_fdps += '<table class="" border="1" style="border: rgba(57,46,205,1.00);font-size: 11px;color: #000;" width="100%">';
									content_fdps += '<thead>';
									content_fdps += '<tr class="text-center" style="background-color: #65D6E4" >';
									content_fdps += '<th rowspan="2" class="vert-aligned" >ลำดับ</th>';
									content_fdps += '<th rowspan="2" class="vert-aligned" >รหัสลูกค้า</th>';
									content_fdps += '<th rowspan="2" class="vert-aligned" >วันที่สมัคร</th>';
									content_fdps += '<th colspan="5"> ยอดฝาก </th>';
									
									content_fdps += '<th rowspan="2" class="vert-aligned" >ยอดเทิร์น</th>';
									content_fdps += '</tr>';
									content_fdps += '<tr class="text-center" style="background-color: #65D6E4">';

                                    content_fdps += '<th> 1 </th>';
									content_fdps += '<th> 2 </th>';
									content_fdps += '<th> 3 </th>';
									content_fdps += '<th> 4 </th>';
									content_fdps += '<th> 5 </th>';

                                    content_fdps += '</tr>';
									content_fdps += '<tr style="background-color: #D5D5D5">';
									content_fdps += '<td colspan="3" class="text-right"> ยอดรวม';
									content_fdps += '</td>';
                                    content_fdps += '<td class="text-right">'+ sum.sdps1.toLocaleString()+'('+sum.dps1+')';
									content_fdps += '</td>';
                                    content_fdps += '<td class="text-right">'+ sum.sdps2.toLocaleString()+'('+sum.dps2+')';
									content_fdps += '</td>';
                                    content_fdps += '<td class="text-right">'+ sum.sdps3.toLocaleString()+'('+sum.dps3+')';
									content_fdps += '</td>';
                                    content_fdps += '<td class="text-right">'+ sum.sdps4.toLocaleString()+'('+sum.dps4+')';
									content_fdps += '</td>';
                                    content_fdps += '<td class="text-right">'+ sum.sdps5.toLocaleString()+'('+sum.dps5+')';
									content_fdps += '</td>';
                                    content_fdps += '<td class="text-right"> **';
									content_fdps += '</td>';
									content_fdps += '</tr>';
                                    
									content_fdps += '</thead>';
									content_fdps += '<tbody id="contentsum"></tbody>'
									for (var i = 0; i < conut; i++) {
                                        let c = i+1;
										content_fdps += '<tr>';
										content_fdps += '<td class="text-center">' + c + '</td>';
										content_fdps += '<td class="text-center">' + user[i]['user'] + '</td>';
										content_fdps += '<td class="text-center">' + moment.unix(user[i]['create_time']).format("DD-MM-YY HH:mm") + '</td>';
										content_fdps += '<td class="text-right">' + user[i]['dps1'].toLocaleString() + '</td>';
										content_fdps += '<td class="text-right">' + user[i]['dps2'].toLocaleString() + '</td>';
										content_fdps += '<td class="text-right">' + user[i]['dps3'].toLocaleString() + '</td>';
										content_fdps += '<td class="text-right">' + user[i]['dps4'].toLocaleString() + '</td>';
										content_fdps += '<td class="text-right">' + user[i]['dps5'].toLocaleString() + '</td>';
										content_fdps += '<td class="text-center" id="' + user[i]['user'] + '"><button class="" onclick="getturn(\'' + user[i]['user'] + '\')">TURNOVER</button></td>';
										content_fdps += '</tr>';
									}
									content_fdps += '</table>';

									$('#content_fdps').html(content_fdps);
//                                    console.log(content_fdps);
									
								} else if (res.code == 0){
									swal(res.title, res.msg, 'error');
									
								}else{
                                    swal('ไม่ทำรายการ', 'ยกเลิกการทำรายการ', "error")
						              setTimeout(function() {}, 1000);
                                }
							});


					} else {
						swal('ไม่ทำรายการ', 'ยกเลิกการทำรายการ', "error")
						setTimeout(function() {}, 1000);

					}

				});
		}

		function getturn(user) {
			$('#'+user).html('<div class="spinner-border"></div>');
	
			$.ajax({
					url: '<?= base_url('sale/income/getturn') ?>',
					type: 'POST',
					dataType: 'json',
					data: {
						d1: $('#single_cal2').val(),
						d2: $('#single_cal3').val(),
						user: user
					},
				})
				.done(function(res) {
						$('#'+user).html(res.sum);
				});

		}
	</script>
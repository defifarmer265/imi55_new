	<!-- <link href="<?php echo $this->config->item('tem_frontend_css'); ?>custom.min_selectpaket.css" rel="stylesheet"> -->

	<script src="<?php echo $this->config->item('tem_frontend_css'); ?>jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

	<!-- page content -->
	<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->

	<style type="text/css">
		.text {
			color: red;
			font-size: 16px;
			padding-left: 20px;
		}

		.text:hover {
			background-color: yellow;
		}

		#cover-spin {
			position: fixed;
			width: 100%;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			background-color: rgba(255, 255, 255, 0.7);
			z-index: 9999;
			display: none;
		}

		@-webkit-keyframes spin {
			from {
				-webkit-transform: rotate(0deg);
			}

			to {
				-webkit-transform: rotate(360deg);
			}
		}

		@keyframes spin {
			from {
				transform: rotate(0deg);
			}

			to {
				transform: rotate(360deg);
			}
		}

		#cover-spin::after {
			content: '';
			display: block;
			position: absolute;
			left: 48%;
			top: 40%;
			width: 40px;
			height: 40px;
			border-style: solid;
			border-color: black;
			border-top-color: transparent;
			border-width: 4px;
			border-radius: 50%;
			-webkit-animation: spin .8s linear infinite;
			animation: spin .8s linear infinite;
		}

		.lds-dual-ring {}

		.lds-dual-ring:after {
			content: " ";
			display: block;
			width: 30px;
			height: 30px;
			padding-bottom: -20px;
			border-radius: 50%;
			border: 6px solid #000;
			border-color: #000 transparent #000 transparent;
			animation: lds-dual-ring 1.2s linear infinite;
		}

		@keyframes lds-dual-ring {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}
	</style>
	<div id="cover-spin"></div>
	<div class="right_col" role="main">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2 style="color:#000">ตรวจสอบประวัติการเล่น<small></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-12 col-sm-12 ">
						<div class="x_content">
							<div class="row ">
								<div class="col-sm-2 ">
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
								<div class="col-sm-2">
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
									<div class="control-group">รหัสสมาชิก
										<input type="text" id="user" value="" class="form-control">
									</div>
								</div>
								<div class="col-sm-2">
									<br>
									<button type="button" onClick="select_user()" class="btn btn-info">ค้นหา</button>
								</div>

							</div>

							<hr style="height:2px;border-width:0;color:gray;background-color:gray">
							<span style="color:red;font-size: 14px">*สามารถดูย้อนหลังได้ 7 วันล่าสุดเท่านั้น</span>&nbsp; &nbsp; &nbsp; &nbsp;

							<span style="color:green;font-size: 14px; display:none;" id="sum_st_wl"><b>ยอดเดิมพัน:</b> <span id="stake"></span> &nbsp; &nbsp; &nbsp; &nbsp;
								<b style="color:red;font-size: 14px">ยอดได้เสีย:</b> <span id="winloss" style="color:red;font-size: 14px"></span>
							</span>

							<div class="row">
								<div class="col-sm-12">
									<div class="card-box table-responsive">

										<table class="table table-striped table-bordered nowrap" cellspacing="0" style="font-size: 14px;width: 100%" id="t_all">
											<thead style="background-color: #2a3f54;color: #fff;">
												<tr class="text-center">
													<th width="4%">No</th>
													<th class="text-center">วันที่</th>
													<th class="text-center">NameTicked</th>
													<th class="text-center">ยอดเดิมพัน</th>
													<th class="text-center">ยอดได้เสีย</th>
												</tr>
											</thead>
											<!-- <tbody id="bodyhistory2"> </tbody> -->
											<tbody id="bodyhistory"> </tbody>
											<!-- <tfoot id="sumbody">
												<tr>
													<th colspan="3">Total</th>
													<th id="total_st"></th>
													<th id="total_wl"></th>
												</tr>
											</tfoot> -->
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>


	<link rel="stylesheet" href="<?php echo $this->config->item('tem_backend_vendors'); ?>dist/bootstrap.css">




	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
	<script>
		jQuery(document).ready(function($) {
			$('.dropdown-menu').css('display', 'none');;
		});

		$(document).on('user', function(e) {
			if (e.which == 13) {
				alert('You pressed enter!');
			}

		});

		function select_user() {

			$('#cover-spin').show();
			//alert('55')
			var date_s = $('#single_cal2').val();
			var date_e = $('#single_cal3').val();
			var user = $('#user').val();
			if (user == '') {
				swal({
					title: "",
					text: "กรุณาเลือก user !",
					icon: "warning",
				});
				return false;
			} else {

			}
			date_s = moment(date_s).startOf('day').format('YYYY-MM-DD HH:mm');
			date_e = moment(date_e).endOf('day').format('YYYY-MM-DD HH:mm');
			// console.log(moment(date_s).startOf('day').format('YYYY-MM-DD HH:mm'));
			// console.log();
			// console.log(moment(date_e).endOf('day').format('YYYY-MM-DD HH:mm'));
			console.log(user);
			$.ajax({
					url: 'Ticked/get_tickeds',
					type: 'POST',
					dataType: 'json',
					data: {
						sdate: date_s,
						edate: date_e,
						user: user
					},
				})
				.done(function(res) {

					$('#cover-spin').hide();

					console.log(res);
					// $('#t_all').dataTable().fnClearTable();
					// $('#t_all').dataTable().fnDestroy();
					$('#t_all').DataTable().destroy(); 
					if (res.code == 1) {
						var html = '';
						var html2 = '';
						// if (res.data.length == 0) {
						// 	html += `
						// <tr style="background-color:#ffffb3">
						// 	<td colspan="5" class="text-center"><b>ไม่พบข้อมูล</b></td>
						// </tr>`;
						// } else 
						if (res.data.length > 0) {

							var i = 1;

							$.each(res.data, function(index, val) {
								/* iterate through array or object */
								// total_wl += parseFloat(val.PlayerWinLoss);
								// total_st += parseFloat(val.Stake);
								var wl = val.PlayerWinLoss;
								var date_time = val.imiTime;
								var new_date = new Date(date_time * 1000).format('d-m-Y H:i');

								if (wl < 0) {
									var wl = '<b><p style="color:red">' + val.PlayerWinLoss + '<p><b>';
								} else {
									var wl = '<b><p style="color:green">' + val.PlayerWinLoss + '<p><b>';
								}
								html += `
								<tr>	
									<td class="text-center">` + (i++) + `</td>
									<td class="text-center">` + new_date + `</td>
									<td class="text-center">` + val.VendorName + `</td>
									<td class="text-center"><b>` + val.Stake + `<b></td>
									<td class="text-center" >` + wl + `</td>
								</tr>`;

							});


							// html2 += `
							// // 	<tr style="background-color:#ffffb3">
							// // 		<td colspan="3" class="text-center"><b>รวม</b></td>
							// // 		<td  class="text-center"><b style="color:blue">` + total_st.toFixed(2) + `</b></td>
							// // 		<td  class="text-center"><b style="color:blue">` + total_wl.toFixed(2) + `</b></td>
							// // 	</tr>`;
						}
				
						$('#bodyhistory').html(html);
						$("#stake").text(res.stake.toFixed(2));
						$("#winloss").text(res.winloss.toFixed(2));
						$('#sum_st_wl').show(); //ยอดเดิมพัน ยอดได้เสีย

						$('#t_all').DataTable({
							"pageLength": 10
						});
						

					} else {

						swal({
							title: "error",
							text: "ผิดพลาด",
							icon: "error",
						});
					}

				})
				.fail(function() {
					console.log("error");
				})

		}
	</script>
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="x_panel">
					<div class="x_title">
						<h2>ระบบค้นหา</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="form-group row">
							<div class="col-sm-10"> ID : <?= $this->getapi_model->agent(); ?> ใส่แค่ตัวเลข 6 หลักหลัง Ex: 7805
								<input type="text" value="" class="form-control" id="s_user" maxlength="16" placeholder="รหัสลูกค้า" onKeyUp="enter_search(event,'1')">

							</div>
							<div class="col-sm-2"><br>
								<button onClick="select_user(1)" class="btn btn-info">ค้นหา</button>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-10"> Tel : 0900000000 ใส่แค่ตัวเลข 10 หลัก Ex: 7805
								<input type="number" value="" class="form-control" id="t_user" maxlength="10" placeholder="เบอร์โทรลูกค้า" onKeyUp="enter_search(event,'2')">
							</div>
							<div class="col-sm-2"><br>
								<button onClick="select_user(2)" class="btn btn-info">ค้นหา</button>
							</div>
						</div>
					</div>
				</div>
				<div class="x_panel" style="display: none;" id="tap_sale">
					<div class="x_title">
						<h2>ระบบเซลล์</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="form-group row">
							<div class="col-md-3 form-group p-2 h6 ">
								<span class="">ผู้แนะนำ</span>

							</div>
							<div class="col-md-9 ">
								<input type="text" class="form-control has-feedback text-center" readonly value="" id="sale_name">
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>

							</div>

						</div>
					</div>

				</div>

				<div class="x_panel" style="display: none;" id="tap_log">
                        <div class="x_title">
                            <h2>ข้อมูลการเข้าระบบ</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">
                                <div class="col-md-3 form-group text-right p-2 h6">
                                    <span class="text-danger">ย้อนหลัง7วัน*</span>
                                </div>
                                <div class="col-md-6 form-group text-center">
                                     <button type="button" class="btn btn-outline-primary btn-block" onclick="showlog();"> <i class="fa fa-file-o"> รายละเอียด</i></button>
                                </div>
                            </div>
                        </div>
                </div>


			</div>
		</div>

		<div class="col-md-4" style="display: none;" id="tap_member">
			<div class="x_panel">
				<div class="x_title">
					<h2>สมาชิก</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="form-group row">
						<div class="col-md-3 form-group text-right p-2 h6 ">
							<span class="">รหัสระบบ</span>
						</div>
						<div class="col-md-9 ">
							<input type="text" class="form-control has-feedback text-center" readonly value="" id="user">
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3 form-group text-right p-2 h6 ">
							<span class="">รหัสเข้าเล่น</span>
						</div>
						<div class="col-md-9 ">
							<input type="text" class="form-control has-feedback text-center" readonly value="" id="username">
							<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
							<span class="fa fa-pencil form-control-feedback right text-primary" aria-hidden="true" style="cursor: pointer;" onClick="$('#m_editUsername').modal();"></span>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-3 form-group text-right p-2 h6 ">
							<span class="">ชื่อสมาชิก</span>
						</div>
						<div class="col-md-9 ">
							<input type="text" class="form-control has-feedback text-center" readonly value="" id="name">
							<span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
							<span class="fa fa-pencil form-control-feedback right text-primary" aria-hidden="true" style="cursor: pointer;" onClick="$('#m_editUser').modal();"></span>
						</div>


					</div>

					<div class="ln_solid"></div>
					<div class="form-group row">
						<div class="col-md-12 form-group has-feedback">
							<button class="btn btn-outline-info" onClick="$('#m_editpass').modal();">
								<i class="fa fa-key"> รีรหัส</i>
							</button>

							<span id="status1" style="display: none;" class="text-success">
								<i class="fa fa-check"> เปิด</i>
							</span>
							<span id="status2" style="display: none;" class="text-danger">
								<i class="fa fa-remove"> ปิด</i>
							</span>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4" style="display: none;" id="tap_bank">
			<div class="row">
				<div class="col-md-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>ธนาคาร</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="form-group row">

								<div class="col-9">
									<input type="text" class="form-control has-feedback-left" readonly value="" id="bank">
									<span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
								</div>
								<div class="col-2">
									<img id="img_bank" src="" width="90%">

								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-9">
									<input type="text" class="form-control has-feedback-left" readonly value="" id="account">
									<span class="fa fa-exchange  form-control-feedback left" aria-hidden="true"></span> </div>

							</div>


						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>เกมส์</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="form-group row">
								<div class="col-md-3 form-group text-right p-2 h6">
									<span class="">คะแนน</span>
								</div>
								<div class="col-md-6 form-group ">
									<input type="text" class="form-control has-feedback text-center" readonly value="" id="point">

								</div>

							</div>
							<div class="form-group row">
								<div class="col-md-3 form-group text-right p-2 h6">

									<span>หมุนวงล้อ</span>
								</div>
								<div class="col-md-6 form-group ">
									<input type="text" class="form-control has-feedback text-center" readonly value="" id="spin">
				
								</div>

							</div>


						</div>
					</div>
				</div>
			</div>
		</div>


	</div>

	<div class="row" id="tap_history" style="display: none;">
		<div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
				<div class="col-md-12 col-sm-12 ">
					<div class="x_content">
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box table-responsive">
									<div class="row">
										<div class="col-md-6">
											<h5 class="text-center">รายการแอดเงิน 10 รายการ</h5>
											<table class="table">
												<thead>
													<tr>
														<th>no</th>
														<th>time</th>
														<th>amount</th>
													</tr>
												</thead>
												<tbody id="history_credit">
												</tbody>
											</table>
										</div>
										<div class="col-md-6">
											<h5 class="text-center">รายการฝาก-ถอน 10 รายการ</h5>
											<table class="table">
												<thead>
													<tr>
														<th>no</th>
														<th>time</th>
														<th>deposit</th>
														<th>withdraw</th>
													</tr>
												</thead>
												<tbody id="history_dw">
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
	</div>

<!--modal-->
<!-- Modal แก้ไขพาสเวิร์ด -->
<div class="modal fade" id="m_editpass" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">เปลี่ยนพาสเวิร์ด<small>(ตรวจสอบชื่อ)</small></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12 col-sm-12  form-group has-feedback">

					<h3 style="color: red"> ตัวอย่าง : aa123123 </h3>
					<h5>หรือก็อปวางเลย</h5>
				</div>
				<div class="col-md-12 col-sm-12  form-group has-feedback">
					<input type="text" class="form-control" placeholder="Password" required="required" id="password" id="val_editPass" autocomplete="off">
					<span class="fa fa-key form-control-feedback right" aria-hidden="true"></span> </div>
			</div>
			<div class="modal-footer">
				<button onClick="edit_pass()" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
<!--เพิ่มกลุ่มสำหรับลูกค้า-->
<div class="modal fade" id="m_edit_group" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">เลือกกลุ่ม<small>(สำหรับพนักงาน)</small></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form id="form_edit_group">
				<div class="modal-body">
					<input type="hidden" name="user_id" id="user_id" value="">
					<div class="col-md-12 col-sm-12  form-group has-feedback">
						<div class="form-group row">
							<label class="col-form-label col-md-3 col-sm-3 ">กลุ่ม</label>
							<div class="col-md-9 col-sm-9 ">
								<?php foreach ($group as $_g => $gpr) { ?>
									<div class="form-check">
										<input type="checkbox" name="<?= $gpr['id'] ?>" class="form-check-input" id="group<?= $gpr['id'] ?>">
										<label class="form-check-label" for="Check<?= $gpr['id'] ?>"><?= $gpr['name'] ?></label>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" onClick="edit_group()" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>

<!-- Modal แสดงข้อมูลการเข้าใช้งาน ย้อนหลัง7 วัน -->
<div class="modal fade bd-example-modal-lg" id="m_log" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content" style="width:1024px;background-color: #13171f;color: white;">
            <div class="modal-header">
                <h2>ข้อมูลการเข้าระบบย้อนหลัง7วัน</h2>
                <button type="button" class="close" data-dismiss="modal" style="background-color: red;color: white;">&times;</button>
            </div>
            <div class="modal-body"style="background-color: #f8f9fa; color:#212529;">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                <table  id="table_log" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                        <tr class="text-center">
                             <th width="10px">Id</th>
                            <th width="45px">Username</th>
                            <th width="30px">IP</th>
                            <th width="30px" >วันที่เข้าใช้งานล่าสุด</th>
                            <th width="10px">Iphone</th>
                            <th width="10px">Ipad</th>                    
                            <th width="10px">WebOS</th>
                            <th width="10px">Android</th>
                            <th width="10px">PC</th>
                       </tr>
                     </thead>
                     <tbody id="bodyhistory" style="background-color: aliceblue;">
                     </tbody>
                  </table>
                 
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
	function enter_search(event,type)
	{
		if (event.keyCode === 13) {
			select_user(type);
		}
	
	}

	function edit_name() {
		var user = $('#user').val();
		var name = $('#edit_name').val();
		$.ajax({
				url: 'edit_name',
				type: 'POST',
				dataType: 'json',
				data: {
					name: name,
					user: user
				},
			})
			.done(function(res) {
				if (res.code == 1) {
					swal(res.title, res.msg, 'success');
					$('#m_editUser').modal('toggle');
					var u_set = user.substr(-6);
					$('#s_user').val(u_set);
					select_user(1);
				} else {
					swal(res.title, res.msg, 'error');
				}
			})
			.fail(function() {
				console.log("error");
			});
	}

	function edit_pass() {
		var user = $('#user').val();
		var password = $('#password').val();
		if (user != '') {
			if (password != '') {
				$.ajax({
						url: 'edit_pass',
						type: 'POST',
						dataType: 'json',
						data: {
							user: user,
							password: password
						},
					})
					.done(function(res) {
						if (res.code == 1) {
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
			} else {
				swal('กรุณาใส่พาสเวิร์ดลูกค้าใหม่', '', 'error');
			}
		} else {
			swal('กรุณาเลือกรหัสลูกค้าก่อนทำรายการ', '', 'error');
		}
	}

	function closeuser(status) {
		var user = $('#user').val();
		swal({
			title: 'Are you sure?',
			buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'edit_status',
					type: 'POST',
					dataType: 'json',
					data: {
						user: user,
						status: status
					},
				}).done(function(res) {
					if (res.code == 1) {
						swal({
							icon: "success",
							text: res.msg,
						});
						var u_set = user.substr(-6);
						$('#s_user').val(u_set);
						select_user(1);
					} else {
						swal({
							icon: "error",
							text: res.msg,
						});
					}
				});
			} else {

			}

		});
	}

	function select_user(st) {
		$('#cover-spin').show();
		if (st == 1) {
			var s_user = $('#s_user').val();
			$('#t_user').val('');
			var t_user = '';
		} else {
			var t_user = $('#t_user').val();
			$('#s_user').val('');
			var s_user = '';
		}
		$.ajax({
				url: 'search',
				type: 'POST',
				dataType: 'json',
				data: {
					s_user: s_user,
					t_user: t_user
				},
			})
			.done(function(res) {
				console.log(res);
				$('#cover-spin').hide();
				if (res.code == 1) {
					$('#tap_member').show();
					$('#tap_bank').show();
					$('#tap_sale').show();
					$('#tap_log').show();
					$('#tap_history').show();
					$('#history_credit').html('');
					$('#history_dw').html('');

					$('#user').val(res.data.user);
					$('#user_id').val(res.data.id);
					$('#userid').val(res.data.id);
					$('#name').val(res.data.name);
					$('#edit_name').val(res.data.name);
					$('#username').val(res.data.username);
					$('#bank').val(res.data.bank_th);
					var img_bnk = '<?= $this->config->item('tem_frontend') ?>img/mapraw_icon/bank/' + res.data.api_id + '.png';
					document.getElementById("img_bank").src = img_bnk;
					$('#edit_bank').val(res.data.bank_id);
					$('#account').val(res.data.account);
					$('#edit_account').val(res.data.account);
					$('#spin').val(res.data.spin);
					$('#credit').val(res.data.credit);
					$('#stakeMoney').val(res.data.stakeMoney);
					$('#sale_name').val(res.data.sale_name);

					$('#point').val(res.data.point);
					if (res.data.status == 1) {
						$('#status1').show();
						$('#status2').hide();
					} else {
						$('#status1').hide();
						$('#status2').show();
					}


					var conut = res.data.dw.length;
					var wd = res.data.dw;
					var content = '';
					for (var i = 0; i < conut; i++) {
						content += '<tr>';
						content += '<td>' + wd[i]['id'] + '</td>';
						content += '<td>' + wd[i]['datetime2'] + '</td>';
						if (wd[i]['deposit'] != 0) {
							content += '<td class="text-right">' + wd[i]['deposit'] + '</td>';
						} else {
							content += '<td class="text-right"> - </td>';
						}
						if (wd[i]['withdraw'] != 0) {
							content += '<td class="text-right">' + wd[i]['withdraw'] + '</td>';
						} else {
							content += '<td class="text-right"> - </td>';
						}
						content += '</tr>';
					}

					var conut2 = res.data.add_cd.length;
					if (conut2 > 10) {
						conut2 = 10;
					}
					var add_cd = res.data.add_cd;
					var content2 = '';
					for (var j = 0; j < conut2; j++) {
						content2 += '<tr><td>' + j + '</td><td>' + add_cd[j]['CreationTime'] + '</td><td>' + add_cd[j]['Amount'] + '</td></tr>';

					}
					var conut3 = res.data.gu.length;
					var gu = res.data.gu;
					var content3 = '';
					for (var g = 0; g < conut3; g++) {
						$("#group" + gu[g]['id']).prop("checked", true);
						content3 += '<button  class="btn btn-info btn-sm">' + gu[g]['name'] + '</button>';

					}

					$('#group_user').html(content3);
					$('#history_credit').html(content2);
					$('#history_dw').html(content);
					swal('ค้นหาสำเร็จ', {
						buttons: [null],
						icon: "success",
					});

				} else {
					$('#tap_member').hide();
					$('#tap_bank').hide();
					$('#tap_sale').hide();
					$('#tap_history').hide();
					swal('ไม่สำเร็จ', 'กรุณาตรวจสอบฐานระบบ ag.imiwin.com ว่ามียูเซอร์ดังกล่าวหรือไม่', 'error');

				}
			})
			.fail(function() {
				console.log("error");
			});


	}

	function salename() {

		$.ajax({
			url: 'salename',
			type: 'POST',
			dataType: 'json',

		}).done(function(res) {
			if (res.code == 1) {

				var count = res.sale.length;
				var sale = res.sale;
				var content = '';

				if (count > 0) {
					for (var i = 0; i < count; i++) {
						content += '<option value="' + sale[i]['id'] + '" id="salename">' + sale[i]['username'] + '</option>'
					}
				}

				$('#bodysalename').html(content);

			} else {

			}

		});
	}

	function edit_salename() {

		var id = $('#userid').val();
		var sale_id = $('#bodysalename').find(":selected").val();
		swal({
			title: "คุณแน่ใจที่จะทำการเปลี่ยนแปลง",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'edit_salename',
					type: 'POST',
					dataType: 'json',
					data: {
						id: id,
						sale_id: sale_id
					}

				}).done(function(res) {
					if (res.code == 1) {
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
						setTimeout(function() {
							location.reload();
						}, 2000);
					}



				});
			} else {
				swal("ยกเลิก", "การเปลี่ยนแปลงข้อมูลเรียบร้อย!", "error");
			}
		});


	}

	    // log ip
	function showlog(){
		$('#cover-spin').show();
		var user = $('#user').val();
	  //$('#table_log').DataTable().destroy();
		$.ajax({
					url: 'showlog',
					type: 'POST',
					dataType: 'json',
					data: {user:user},
		})
		.done(function(res) {
				if(res.code =1){
					$('#cover-spin').hide();
					$('#m_log').modal('toggle');
					if(res.data.length >= 1 ){
					var i = 1;
						$.each(res.data, function(index, val) {
							var html='';
								content += '<tr>';
								content += '<td class="text-center">'+i+'</td>';
								content += '<td class="text-center">'+val.user_id+'</td>';
								content += '<td class="text-center">'+val.ip+'</td>';
								content += '<td class="text-center">'+moment.unix(val.create_time).format("DD/MM/YYYY HH:mm:ss");+'</td>';
								if(val.platform ==1){
									content+= '<td class="text-center">'+val.countPlatform+'</td>';
								}else{
									content+= '<td class="text-center">'+'0'+'</td>';
								}

								if(val.platform ==2){
									content+= '<td class="text-center">'+val.countPlatform+'</td>';
								}else{
									content+= '<td class="text-center">'+'0'+'</td>';
								}

								if(val.platform ==3){
									content+= '<td class="text-center">'+val.countPlatform+'</td>';
								}else{
									content+= '<td class="text-center">'+'0'+'</td>';
								}

								if(val.platform ==4){
									content+= '<td class="text-center">'+val.countPlatform+'</td>';
								}else{
									content+= '<td class="text-center">'+'0'+'</td>';
								}

								if(val.platform ==5){
									content+= '<td class="text-center">'+val.countPlatform+'</td>';
								}else{
									content+= '<td class="text-center">'+'0'+'</td>';
								}
								
								content += '</tr>';
								i++;
						});
					}else{
						var content = 'No data';
					}
				}else{
					swal(res.title, res.msg, 'error'); 
				}
				$('#bodyhistory').html(content);
				// new $('#table_log').DataTable({
				// 	"searching": false
				// });
		})
		.fail(function() {
			console.log("error");
		});

	}


</script>
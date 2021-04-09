
<div id="cover-spin"></div>
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-reorder"></i> </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" onClick="open_close('1','m_creUser')">เพิ่มลูกค้า</a> </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr align="center" >
                                                <th width="2%" style="vertical-align: middle">No</th>
                                                <th width="2%" style="vertical-align: middle">No</th>
                                                <th style="vertical-align: middle"> วันที่เวลา </th>
                                                <th style="vertical-align: middle"> รหัส </th>
                                                <th style="vertical-align: middle"> เบอร์โทร </th>
                                                <th style="vertical-align: middle; background-color:#00078C;"> เลขที่บัญชี </th>
                                                <th style="vertical-align: middle; background-color:#00078C "> แบงค์ </th>
                                                <th style="vertical-align: middle; background-color:#00078C"> จำนวนเงิน </th>
                                                <th width="4%"> .00 </th>
                                                <th style="vertical-align: middle"> แบงค์เว็บ </th>
                                                <th style="vertical-align: middle"> ตรวจสอบ </th>
                                                <th style="vertical-align: middle"> โอน </th>
                                                <th style="vertical-align: middle"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ( empty( $withdraw ) ) {

                                            } else {
                                                $i = 1;
                                                foreach ( $withdraw as $_w => $wd ) {
                                                    ?>
                                            <tr align="center">
                                                <td ><?=$i;?></td>
                                                <td ><?=$wd['id'];?></td>
                                                <td ><?=date('d-m-y H:i',$wd['time'])?></td>
                                                <td ><?=$wd['user']?></td>
                                                <td ><?=$wd['username']?></td>
                                                <td ><?=$wd['account']?></td>
                                                <td ><?=$wd['bank_short']?></td>
                                                <td class="text-right" ><b>
                                                    <?php $am1 = substr($wd['amount'],0,-3); echo number_format($am1)?>
                                                    </b></td>
                                                <td class="text-right" ><?php
                                                $am2 = substr( $wd[ 'amount' ], -2 );
                                                if ( $am2 == 0 ) {
                                                    echo '-';
                                                } else {
                                                    echo $am2;
                                                }
                                                ?></td>
                                                <td class="text-right"><?=$wd['bw']?></td>
                                                <td class="text-right"><?=$wd['admin_Cname'] == 1 ? 'Auto':$wd['admin_Cname']?></td>
                                                <td class="text-right"><?=$wd['admin_Fname'] == 1 ? 'Auto':$wd['admin_Fname']?></td>
                                                <td><?php
                                                if ( $wd[ 'status' ] == 1 ) {
                                                    ?>
                                                    <button class="btn btn-sm btn-warning" onClick="accept('<?=$wd['id']?>')" title="เช็กรายการ"> <i class="fa fa-check"></i> </button>
                                                    <button class="btn btn-sm btn-danger" onClick="admin_reject('<?=$wd['id']?>')" title="ยกเลิกรายการ"> <i class="fa fa-remove"></i> </button>
                                                    <?php
                                                    } else if ( $wd[ 'status' ] == 2 ) {
                                                        ?>
                                                    <i class="fa fa-check-circle" title="รายการสำเร็จ"></i>
                                                    <?php
                                                    if ( $this->session->userdata[ 'users' ][ 'class' ] == 1 || $this->session->userdata[ 'users' ][ 'class' ] == 0 ) {
                                                        ?>
                                                    <i class="fa fa-repeat" aria-hidden="true" onClick="re_widthdraw('<?=$wd['id']?>')"></i>
                                                    <?php } ?>
                                                    <?php
                                                    } else if ( $wd[ 'status' ] == 3 ) {
                                                        ?>
                                                    <i class="fa fa-times-circle" title="ยกเลิกรายการ"></i>
                                                    <?php
                                                    } else if ( $wd[ 'status' ] == 4 ) {
                                                        ?>
                                                    <button class="btn btn-sm btn-success" onClick="admin_cf('<?=$wd['id']?>')" title="ยืนยันรายการฝาก" > <i class="fa fa-check"></i> </button>
                                                    <?php
                                                    } else if ( $wd[ 'status' ] == 6 ) {
                                                        echo '<div class="lds-dual-ring"></div>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php $i++;  } } ?>
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
<!--modal-->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_withdraw">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ตรวจสอบก่อนถอน</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="bank_id" id="bankGroup_id"  value="">
                <div class="col-md-12 col-sm-12  form-group has-feedback">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>แอดเครดิต ag.imiwin.com <span class="btn btn-success btn-sm"></span>มี <span class="btn btn-danger btn-sm"> </span>ไม่มี</h6>
                            <span id="api_history_WD"></span> </div>
                        <div class="col-md-6">
                            <h6>จากรายการฝาก</h6>
                            <span id="state_dw"></span> </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 ">ธนาคารออก</label>
                        <div class="col-md-9 col-sm-9 " >
                            <input type="hidden" id="id" value="" >
                            <select name="bw_id" id="bw_id" class="form-control" >
                                <option value="">กรุณาเลือกธนาคาร</option>
                                <?php
                                foreach ( $bankweb as $_w => $bw ) {
                                    if ( $bw[ 'status' ] == 3 ) {
                                        $styauto = 'style="background-color:#E0B0B0;font-weight: bold; "';
                                    } else {
                                        $styauto = '';
                                    }
                                    ?>
                                <option <?=$styauto?>  value="<?=$bw['id']?>"> <?php echo $bw['name'].' ['.$bw['bank_short'].'] '.number_format($bw['sum']);?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="accept_true()" class="btn btn-success">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<script>
function accept(id){
	
	$.ajax({
			url: 'wd/see_wd',
			type: 'POST',
			dataType: 'json',
			data: {
				id:id,
				  },
	}).done(function(res) {
		$('#id').val(id);
		
		$('#modal_withdraw').modal();
		var conut 	= res.sta_r.length;
		var wd 		= res.sta_r;
		var content = '';
		

		content += '<table class="table" width="100%"><tr class="text-center"><th>วันที่</th><th>เวลา</th><th>ฝาก</th><th>ถอน</th></tr>';
		for(var i=0; i < conut; i++){
			content += '<tr>';
			content += '<td class="text-center">'+moment.unix(wd[i]['datetime']).format("DD/MM/YY")+'</td>';
			content += '<td class="text-center">'+moment.unix(wd[i]['datetime']).format("HH:mm")+'</td>';
			if(wd[i]['deposit'] != 0){		content += '<td class="text-right">'+wd[i]['deposit']+'</td>';}else{content += '<td class="text-right"> - </td>';}
			if(wd[i]['withdraw'] != 0){		content += '<td class="text-right">'+wd[i]['withdraw']+'</td>';}else{content += '<td class="text-right"> - </td>';}

			content += '</tr>';
		}
		content += '</table>';
		$('#state_dw').html(content);
		var api_count  = res.api_wdhistory.length;
		var api_story = res.api_wdhistory;
		var api_history_WD = '';
		
		api_history_WD += '<table class="table" width="100%"><tr class="text-center"><th>วันที่</th><th>เวลา</th><th>เพิ่มเครดิต</th><th>ลบเครดิต</th></tr>';
		for(var c=0; c < api_count; c++){
			if(api_story[c]['success'] == 1){var cls = 'table-success';}else if(api_story[c]['success'] == 2 ){var cls = '';}else{var cls = 'table-danger';}
		api_history_WD += '<tr class="'+cls+'">';
		api_history_WD += '<td class="text-center">'+moment.unix(api_story[c]['datetime']).format("DD/MM/YY")+'</td>';
		api_history_WD += '<td class="text-center">'+moment.unix(api_story[c]['datetime']).format("HH:mm")+'</td>';
		if(api_story[c]['Amount'] > 0){  api_history_WD += '<td class="text-right">'+api_story[c]['Amount']+'</td>';}else{api_history_WD += '<td class="text-right"> - </td>';}
		if(api_story[c]['Amount'] < 0){  api_history_WD += '<td class="text-right">'+api_story[c]['Amount']+'</td>';}else{api_history_WD += '<td class="text-right"> - </td>';}

		api_history_WD += '</tr>';
		}
		api_history_WD += '</table>';
  $('#api_history_WD').html(api_history_WD);


	});
	
}

function accept_true(){
	var type 	= 'check';
	var id		= $('#id').val();
	var bw_id	= $('#bw_id').val();
	
	if(bw_id != ''){
		$.ajax({
			url: 'wd/get_BW',
			type: 'POST',
			dataType: 'json',
			data: {
				bw_id:bw_id,
				id:id,
				  },
		}).done(function(res) {
			if (res.code == 1) {
				swal({
				  title: res.title,
				  text: res.msg,
				  buttons: true,
				}).then((willDelete) => {
//					$('#cover-spin').show();
					if (willDelete) {
						$.ajax({
							url: 'wd/Verify',
							type: 'POST',
							dataType: 'json',
							data: {
								bw_id:bw_id,
								type:type,
								id:id,
								  },
						}).done(function(check_bank) {
                            var data_r = check_bank.data;
                            
							if(check_bank.code == '1'){
								const wrapper = document.createElement('div');
							wrapper.innerHTML  = "<img src='<?php echo $this->config->item('tem_frontend')?>/img/mapraw_icon/bank/"+data_r.bank_id+".png' width='80px'><br> <b>โอนเงินไปยัง : "+data_r.toname+"</b><br><b>เลขบัญชี : "+data_r.toaccount+" ธนาคาร <img src='<?php echo $this->config->item('tem_frontend')?>/img/mapraw_icon/bank/"+data_r.tobank+".png' width='50px'></b><br><b style='color:blue'>จำนวนเงิน "+data_r.amount+" บาท</b>";
							swal({
								title: "ถอน",
								content: wrapper,
								buttons: true,
							})
							.then((willDelete) => {
								if (willDelete) {
               						$.ajax({
               							url: 'wd/frim_auto',
               							type: 'POST',
               							dataType: 'json',
               							data: {
               								bw_id:bw_id,
               								id:id,
               							},
               						})
               						.done(function(re) {
               							if (re.code == 1) {
               								swal({
               									icon: 'success',
               									title: re.msg,
               								})
               								.then((result) => { location.reload();})
               							}else{
               								swal({
               									icon: 'error',
               									title: re.msg,
               								})
               								.then((result) => { location.reload();})
               							}

               						})
               						.fail(function() {
               							console.log("error");
               						})
               	
								} else {
									return false;
								}
							});
							}else{
								//console.log(res.data.status.description);
								swal({
								  icon: "error",
								   text: check_bank.msg,
								});

							}
							
							 
						});
					}else{
						swal(res.title,res.msg,'error');
					}
				});
			}else if (res.code == 2) {
				$.ajax({
					url: 'wd/admin_check',
					type: 'POST',
					dataType: 'json',
					data: {
						bw_id:bw_id,
						id:id,
					},
				})
				.done(function(re) {
					if (re.code == 1) {
						swal({
							icon: 'success',
							title: re.msg,
						})
						.then((result) => { location.reload();})
					}else{
						swal({
							icon: 'error',
							title: re.msg,
						})
						.then((result) => { location.reload();})
					}

				})
				.fail(function() {
					console.log("error");
				})
			}else{
				swal(res.title,res.msg,'error');
			}
		});
	}else{
		swal('กรุณาเลือกธนาคารโอน','','error');
		$('#bw_id').focus();
	}

}	

function admin_cf(id){
	swal({
		  title: 'ยืนยันการทำรายการ ?',
		  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'wd/admin_cf',
					type: 'POST',
					dataType: 'json',
					data: {
						id:id,
						  },
				}).done(function(res) {
					if (res.code == 1) {
						swal({
						  icon: "success",
						  text: res.msg,
						});
						setTimeout(function(){location.reload(); },2000);
					}else{
						swal({
						  icon: "error",
						   text: res.msg,
						});
					}
				});
			}else{
				
			}
			
		});
}
function admin_reject(id){
	swal({
		  title: 'ยืนยันการทำรายการ ?',
		  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'wd/cancel_withdraw',
					type: 'POST',
					dataType: 'json',
					data: {
						id:id,
						  },
				}).done(function(res) {
					if (res.code == 1) {
						swal({
						  icon: "success",
						  text: res.msg,
						});
						setTimeout(function(){location.reload(); },2000);
					}else{
						swal({
						  icon: "error",
						   text: res.msg,
						});
					}
				});
			}else{
				
			}
			
		});
}
function wd_confrim(wd_id,us_id,username,name,account,bank,amount){
	$('#m_confrim').modal();
	$('#cf_wd_id').val(wd_id);
	$('#cf_us_id').val(us_id);
	$('#cf_username').val(username);
	$('#cf_name').val(name);
	$('#cf_account').val(account);
	$('#cf_bank').val(bank);
	$('#cf_amount').val(amount);
}
	  

function re_widthdraw(id){
	swal({
		  title: 'ยืนยันการทำรายการ ?',
		  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'wd/re_widthdraw',
					type: 'POST',
					dataType: 'json',
					data: {
						
						id:id,
						  },
				}).done(function(res) {
					if (res.code == 1) {
						swal({
						  icon: "success",
						  text: res.msg,
						});
						setTimeout(function(){location.reload(); },2000);
					}else{
						swal({
						  icon: "error",
						   text: res.msg,
						});
					}
				});
			}else{
				
			}
			
		});
}

</script>
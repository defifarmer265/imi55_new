<style>
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
</style>
<div id="cover-spin"></div>





    <div class="d-flex justify-content-center mt-0 mt-md-3 pb-5"  style="padding-top: 70px;">
        <div class="container col-16" style="padding-right: 2px;">
            <div class="row d-flex flex-column justify-content-center align-items-center">
                <div class="section-1 col-16 col-md-10 col-lg-8 pb-2" style="box-shadow: 1px 4px 3px 0px rgb(239 255 0 / 30%);">
                    <div class="container d-flex flex-column justify-content-center align-items-start mt-3">
                          <div class="container">

					<div class="sc-fzqPZZ gLiaon">
			<div style="display: flex; margin: 30px auto;">
				<div style="width: 25%;"><img src="<?= $this->config->item('tem_frontend'); ?>img/b.png" width="100%" class="img_icon">
				</div>
				<div style="padding: 10px;">
					
           <b style="font-size: 1.5em;color: #ccff00;text-align: center;">บัญชีของฉัน :</b>
       
					<div style="color: rgb(238, 91, 71); font-size: 28px; font-weight: bold; letter-spacing: 5px; line-height: 1;"><?= $bankUser ?></div>
					<div style="color: rgb(255, 255, 255); font-size: 20px;">เงินในบัญชี: <?= $credit ?> THB</div>

					<!-- end foreach -->
					<div style="color: rgb(255, 255, 255); font-size: 20px;">ยอดเล่นล่าสุด
						<span id="sh_turn">
							<div class="spinner-border spinner-border-sm" role="status">
								<span class="sr-only">Loading...</span>
							</div>
							<div class="spinner-grow spinner-grow-sm" role="status">
								<span class="sr-only">Loading...</span>
							</div>
						</span>
						</div>
<!--
					<div style="color: rgb(255, 255, 255); font-size: 20px;">ติดเทิร์น
						<?php
//						if (!empty($checkturn->checkturn) != 0) {
//							echo @number_format($checkturn->checkturn, 2);
//						} else {
//							echo @number_format(0, 2);
//						}

						?>
					</div>
-->
				</div>
			</div>

			<div class="sc-fzqKVi inEYMP input-group mb-3">
				<div class="sc-fzoOEf eXkYNB input-group-prepend">

				</div>
			<!-- 	<div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-money"></i></span> </div> -->
				<!-- input amount -->
				<input type="number" class="sc-fzoCUK kBjMiw form-control" id="amount" placeholder="กรอกจำนวนเงิน" value="" />
				<input type="hidden" class="form-control" id="WD_min" value="<?= $WD_min ?>">
				<input type="hidden" class="form-control" id="WD_max" value="<?= $WD_max ?>">
				<!-- <div class="sc-fzoOEf eXkYNB input-group-append"><span class="input-group-text">THB</span></div> -->

			</div>
			<div class="form-group mt-4"> <button id="btn_regis" onClick="withdraw()" class="btn btn-outline-light" style="background: linear-gradient(to right,#0242ce 0%,#000000 100%);border-color: #ffee29;"><b style="font-size: 1.3em;color: #fff">ทำรายการ</b></button></div>
			<div style="color: #ffdc00">**จำนวนเงินถอนขั้นต่ำ <?php echo number_format($WD_min) ?>฿ </div>
			<div style="color: #ffdc00">**จำนวนเงินถอนสูงสุด <?php echo number_format($WD_max) ?>฿</div>
			<div style="color: #ffdc00">**จำนวนครั้งสูงสุดต่อวัน <?php echo number_format($WD_count) ?> ครั้ง ต่อวัน</div>
			<div class="sc-fzpdyU bpAxtW"></div>
			<div class="form-group">
				<div class="sc-fzpdyU bpAxtW" style="color: #fff;">กรุณาตรวจสอบความถูกต้องก่อนทำการยืนยันการทำรายการ</div>
			</div>


		</div>









                          </div>

  </div>

                    </div>




                </div>
            </div>
        </div>

    <div class="row my-5 pb-5"></div>


<!-- scb -->
<!--Modal-->
<div class="modal fade" id="bank_main">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<a href="#" class="close" data-dismiss="modal"><i class="fa fa-remove"></i></a>
			</div>
			<div class="modal-body">
				<input type="hidden" value="<?= $bank_main->status ?>" id="maint_status">
				<input type="hidden" value="<?= $this->session->bankmain ?>" id="maint_sess">
				<!-- <input type="hidden" value="1" id="maint_id"> -->
				<div class="text-center">
					<img id="img_alert" src="" width="90%">
				</div>
			</div>
			<div class="modal-footer">
				<label>
					<input type="checkbox" class="checkbox" value="1" id="close_bankmain">
					ไม่แสดงอีก</label>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var maint_status = $('#maint_status').val();
		var maint_sess = $('#maint_sess').val();
		var user_id = $('#iduser').val();
		$('#img_alert').html('');
		$.ajax({
				url: '<?= base_url() ?>users/member/check_alert',
				type: 'POST',
				dataType: 'json',
			})
			.done(function(res) {
				// success
				if (res.code == 1) {
					var dt = new Date();
					var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
					var content = '';

					if (maint_status == 1) {
						if (maint_sess != 1) {
							if (time > res.depo['start_time'] && time < res.depo['end_time']) {
								var img_alert = '<?= $this->config->item('tem_frontend') ?>img/maintenance/bank_maintenance/' + res.depo['img'];
								document.getElementById("img_alert").src = img_alert;
								$('#bank_main').modal('show');
							}
						}
					}

				} else {

				}
			});
		//set initial state.
		var id = $('#maint_id').val();
		$('#close_bankmain').val(this.checked);

		$('#close_bankmain').change(function() {
			if (this.checked) {
				var returnVal = confirm("ต้องการปิดประกาศ !!");
				$.ajax({
					url: '<?= base_url() ?>users/member/close_bankmain',
					type: 'POST',
					dataType: 'json',
					data: {
						id: id
					}
				});

			}
			$('#textbox1').val(this.checked);
		});
	});

	function withdraw() {
		$('#cover-spin').show();
		var amt = $('#amount').val();
		var amount = parseFloat(amt).toFixed(2);

		$.ajax({
			url: '<?= base_url() ?>users/member/checkWD',
			type: 'POST',
			dataType: 'json',
			data: {
				amount: amount
			},
		}).done(function(ces) {

			// alert(ces);
			if (ces.code == 1) {
				
				swal({
					title: 'คุณต้องการถอน : ' + amount,
					buttons: true,
				}).then((willDelete) => {
					if (willDelete) {
						$.ajax({
							url: 'WD',
							type: 'POST',
							dataType: 'json',
							data: {
								amount: amount
							},
						}).done(function(res) {
							if (res.code == 1) {
								swal(res.title, res.msg, "success");
								setTimeout(function() {
									location.reload();
								}, 2000);
							} else {
								swal(res.title, res.msg, "error");
							}
						});
					}

				});

				$('#cover-spin').hide();
			} else {
				swal(ces.title, ces.msg, "error");
				// swal("ยอดเครดิตลูกค้าไม่พอ", "กรุณาทำรายการใหม่", "error");
				
				// setTimeout(function() {
				// 	location.reload();
				// }, 2000);
				$('#cover-spin').hide();
			}
		});

	}

	$(window).on('load', function() {
		$.ajax({
				url: '<?= base_url() ?>users/member/get_ticket/1',
				type: 'POST',
				dataType: 'json',
			})
			.done(function(res) {
				// success
				console.log(res);
				$('#sh_turn').html(res.totalTurnover);
				
			});
	});

</script>
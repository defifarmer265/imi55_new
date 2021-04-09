<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ตั้งค่าระบบเซลล์</h2>
          <ul class="nav navbar-right panel_toolbox">

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">

			<div class="row">
				<form id="form_sale_setting">
				<div class="col-md-3">
					<div class="row form-group">
						<div class="col-md-6 text-right">จำนวนเงินต่ำกว่าไม่จ่าย </div>
						<div class="col-md-6">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->f_amt0?>" name="f_amt0">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6 text-right">ยอดแรกฝากตั้งแต่ <?=$setting->f_amt0?> ถึง </div>
						<div class="col-md-6">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->f_amt1?>" name="f_amt1">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6 text-right"><span>อัตราให้ ลูกค้าฟรี</span></div>
						<div class="col-md-6">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->pay_free?>" name="pay_free">
						</div>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="row form-group">
						<div class="col-md-1 text-right"><span>เฉลี่ย1</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave1?>" name="ave1">
						</div>
						<div class="col-md-1 text-right"><span>แรก1</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave1_pay1?>" name="ave1_pay1">
						</div>
						<div class="col-md-1 text-right"><span>แรก2</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave1_pay2?>" name="ave1_pay2">
						</div>

					</div>
					<div class="row form-group">
						<div class="col-md-1 text-right"><span>เฉลี่ย2</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave2?>" name="ave2">
						</div>
						<div class="col-md-1 text-right"><span>แรก1</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave2_pay1?>" name="ave2_pay1">
						</div>
						<div class="col-md-1 text-right"><span>แรก2</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave2_pay2?>" name="ave2_pay2">
						</div>

					</div>
					<div class="row form-group">
						<div class="col-md-1 text-right"><span>เฉลี่ย3</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave3?>" name="ave3">
						</div>
						<div class="col-md-1 text-right"><span>แรก1</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave3_pay1?>" name="ave3_pay1">
						</div>
						<div class="col-md-1 text-right"><span>แรก2</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave3_pay2?>" name="ave3_pay2">
						</div>

					</div>
					<div class="row form-group">
						<div class="col-md-1 text-right"><span>เฉลี่ย4</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave4?>" name="ave4">
						</div>
						<div class="col-md-1 text-right"><span>แรก1</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave4_pay1?>" name="ave4_pay1">
						</div>
						<div class="col-md-1 text-right"><span>แรก2</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave4_pay2?>" name="ave4_pay2">
						</div>

					</div>
					<div class="row form-group">
						<div class="col-md-1 text-right"><span>เฉลี่ย5</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave5?>" name="ave5">
						</div>
						<div class="col-md-1 text-right"><span>แรก1</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave5_pay1?>" name="ave5_pay1">
						</div>
						<div class="col-md-1 text-right"><span>แรก2</span></div>
						<div class="col-md-2">
							<input type="number" class="form-control text-center" id="famount1" value="<?=$setting->ave5_pay2?>" name="ave5_pay2">
						</div>

					</div>
				
				</div>	
				</form>
				
			</div>			
				<div class="row">
					<div class="col-md-6 text-right">
						<button onClick="edit_setting()" class="btn btn-success btn-sm">บันทึก</button>
					</div>
				</div>  
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
   function edit_setting(){
	   var data = $('#form_sale_setting').serializeArray();
//	   console.log(data);
	   swal({
				text: "คุณต้องการบันทึกข้อมูลทั้งหมดหรือไม่",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})

			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
							url: 'edit_setting',
							type: 'POST',
							dataType: 'json',
							data:data,
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
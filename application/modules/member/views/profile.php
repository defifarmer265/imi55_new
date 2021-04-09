
<!-- CONTACT-->
<header class="masthead bg-primary text-white text-center" style="padding-top: calc(6rem - 10px) !important; height: 90%;" id="tap_contact">
	
  <div class="container"><br>

    <div class="form-row">
	  <div class="col-md-12 mb-3 text-left">
		      <label  class="text-left">ถอนเข้า : <?=$bankUser?></label><br>
    <label  class="text-left">ยอดเงิน : <?=$credit?></label><br>
    <label  class="text-left">ขั้นต่ำ : <?=$WD_min?></label>
        <div class="input-group">
          <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-money"></i></span> </div>
          <input type="number" class="form-control" id="amount" placeholder="กรอกจำนวนเงิน" >
          <input type="hidden" class="form-control" id="WD_min" value="<?=$WD_min?>">
        </div>
       </div>
    </div>
    <button  id="btn_regis" onClick="withdraw()"  class="btn btn-outline-light" >ทำรายการ</button>
  </div>
</header>
<!--Modal-->


<!-- Copyright Section-->

<!-- Bootstrap core JS--> 
<script>

</script> 
<script>

function withdraw()
	{
		var amount = $('#amount').val();
		var WD_min = $('#WD_min').val();

		if(amount >= WD_min){
		$.ajax({
				url: 'checkWD',
				type: 'POST',
				dataType: 'json',
				data: {amount:amount},
			}).done(function(ces) {
			if (ces.code == 1) {
				swal({
					  title: 'คุณต้องการถอน : '+amount,
					  buttons: true,
				}).then((willDelete) => {
					if (willDelete) {
						$.ajax({
							url: 'WD',
							type: 'POST',
							dataType: 'json',
							data: {amount:amount},
						}).done(function(res) {
							if (res.code == 1) {
								swal(res.title,res.msg, "success");
								setTimeout(function(){location.reload(); },2000);
							}else{
								swal(res.title,res.msg, "error");
							}
						});
					}else{
						
					}
					
				});
			}else{
				swal(ces.title,ces.msg, "error");
			}
		});				
		}else{
			swal({icon: "error",
				title: "กรุณาตรวจสอบยอด",
				text: "กรุณาทำรายการใหม่",
				});
		}


	}
</script> 

<style>
#cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255,255,255,0.7);
    z-index: 9999;
    display: none;
}
@-webkit-keyframes spin {
from {
-webkit-transform:rotate(0deg);
}
to {
-webkit-transform:rotate(360deg);
}
}
@keyframes spin {
from {
transform:rotate(0deg);
}
to {
transform:rotate(360deg);
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
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการที่เข้าบัญชีฝากทั้งหมด<small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="row ">
          <div class="col-sm-2 "> วันเริ่ม
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                </div>
              </div>
            </fieldset>
          </div>
          <div class="col-sm-2 "> เวลา
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                    <!-- <input type="time" class="form-control has-feedback-left" id="time1" placeholder="First Name" aria-describedby="inputSuccess2Status2" value="11.00"> -->
                    <input type="time" class="form-control has-feedback-left" value="11:00:00" id="time1">
                </div>
              </div>
            </fieldset>
          </div>
          <div class="col-sm-2"> วันสิ้นสุด
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                </div>
              </div>
            </fieldset>
          </div>
          <div class="col-sm-2 "> เวลา
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                    <!-- <input type="time" class="form-control has-feedback-left" id="time2" placeholder="First Name" aria-describedby="inputSuccess2Status2"> -->
                    <input type="time" class="form-control has-feedback-left" value="11:00:00" id="time2">

                </div>
              </div>
            </fieldset>
          </div>
          <!-- <div class="col-sm-2"> ID :
            <?=$this->getapi_model->agent()?>
            i
            <input type="text" value="" class="form-control" id="user" maxlength="6" placeholder="รหัสลูกค้า">
            ใส่แค่ตัวเลข 6 หลัก </div> -->
          <div class="col-sm-2"><br>
            <button onClick="select_user()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
          </div>
        </div>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;" >
                      <tr class="text-center">
                        <th width="2%">Id</th>
                        <th > ยูเซอร์ </th>
                        <th > เบอร์โทร </th>
                        <th > รายการฝาก </th>
                        <th > รายการถอน </th>
                        <th > ยอดเงินฝาก </th>
                        <th > ยอดเงินถอน </th>
                        <th > ฝาก-ถอน </th>
                      </tr>
                    </thead>
					  <tbody id="bodysum"></tbody>
					  <tbody id="bodyhistory"></tbody>
					  
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
$(document).on('user',function(e) {
    if(e.which == 13) {
        alert('You pressed enter!');
    }
});
function select_user()
	{
		$('#cover-spin').show();
		$('#bodyhistory').html('');
		$('#bodysum').html('');
		var dt1 = $('#single_cal2').val();
    var tm1 = $('#time1').val();
    var tm2 = $('#time2').val();
		var dt2 = $('#single_cal3').val();
		var user = $('#user').val();

			$.ajax({
				url: '<?=base_url()?>backend/acc/rp_us',
				type: 'POST',
				dataType: 'json',
				data: {dt1:dt1,dt2:dt2,tm1:tm1,tm2,tm2,user:user},
			})
			.done(function(res) {
				if (res.code == 1) {
					if(res.data.length >= 1 ){
						var conut 	= res.data.length;
						var wd 		= res.data;
						var content = '';
						var tt_dp 	= 0;
						var tt_wd 	= 0;
						var tt_ndp 	= 0;
						var tt_nwd 	= 0;
						var tt_all 	= 0;
						for(var i=0; i < conut; i++){
							content += '<tr>';
							content += '<td>'+i+'</td>';
							content += '<td>'+wd[i]['user']+'</td>';
							content += '<td>'+wd[i]['username']+'</td>';
							if(wd[i]['num_deposit'] != 0){		
								content += '<td class="text-right">'+wd[i]['num_deposit']+'</td>';}else{content += '<td class="text-right"> - </td>';}
							if(wd[i]['num_withdraw'] != 0){		
								content += '<td class="text-right">'+wd[i]['num_withdraw']+'</td>';}else{content += '<td class="text-right"> - </td>';}
							if(wd[i]['deposit'] != 0){		
								content += '<td class="text-right">'+wd[i]['deposit']+'</td>';}else{content += '<td class="text-right"> - </td>';}
							if(wd[i]['withdraw'] != 0){		
								content += '<td class="text-right">'+wd[i]['withdraw']+'</td>';}else{content += '<td class="text-right"> - </td>';}
							
							
							var withdraw 	=  parseFloat(wd[i]['withdraw1']);
							var deposit  	=  parseFloat(wd[i]['deposit1']);
							var n_deposit  	=  parseFloat(wd[i]['num_deposit']);
							var n_withdraw  =  parseFloat(wd[i]['num_withdraw']);
							var tt_row =  deposit -withdraw ;
							
							content += '<td class="text-right">'+nb(tt_row.toFixed(2))+'</td>';

							content += '</tr>';
							
							tt_dp = tt_dp + deposit;
							tt_wd = tt_wd + withdraw;
							tt_ndp = tt_ndp + n_deposit;
							tt_nwd = tt_nwd + n_withdraw;
							
							tt_all = tt_all + tt_row;
							
						}
						
						var sum = '<tr><td colspan="3" class="text-right">รวม</td><td class="text-right">'+nb(tt_ndp)+'</td><td class="text-right">'+nb(tt_nwd)+'</td><td class="text-right">'+nb(tt_dp.toFixed(2))+'</td><td class="text-right">'+nb(tt_wd.toFixed(2))+'</td><td class="text-right">'+nb(tt_all.toFixed(2))+'</td></tr>';

					}else{
						var content = 'No data';
						var sum = '';
					}
					$('#bodysum').html(sum);
					$('#bodyhistory').html(content);
				}else{
					swal(res.title,res.msg,'error');
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
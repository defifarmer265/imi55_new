
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการที่เข้าบัญชีฝาก<small>ของลูกค้าเซลล์เท่านั้น</small></h2>
          
          <div class="clearfix"></div>
        </div>
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
				ID : <?=$this->getapi_model->agent()?>i
				<input type="text" value="" class="form-control" id="user" maxlength="6" placeholder="รหัสลูกค้า">
				ใส่แค่ตัวเลข 6 หลัก
				</div>
				<div class="col-sm-2">
					<br>
				<button onClick="select_user()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
				</div>
			</div>
		  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
				<table id="table_rj" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;display: none;">
					<tr class="text-center">
					<th width="2%">Id</th>
					<th width="2%">Id</th>
					<th>เวลา</th>
					<th>ยอดเงิน</th>
					<th>รหัสลูกค้า</th>
					<th>แอดมิน</th>
					</tr>
					<tbody id="sum_rj"></tbody>
					<tbody id="tbody_rj"></tbody>
				</table>
                  <table id="table_dw" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                       <tr class="text-center">
                       <th width="2%">Id</th>
                       <th width="2%">Id</th>
                         <th  >วันที่ฝาก</th>
                         <th >วันที่ระบบ</th>
                         <th >ฝาก	</th>
                         <th >ถอน	</th>
                         <th >ยูเซอร์</th>
                         <th >เบอร์</th>
                         <th >เลขที่บัญชี</th>
                         <th >แบงค์</th>
                         <th >แบงค์เว็บ</th>
                         <th >รายละเอียด</th>
                         <th >พนักงาน</th>
                       </tr>
                     </thead>
					  <tbody id="sum_wd"></tbody>
                      <tbody id="tbody_wd"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<script>

function select_user()
	{
		$('#cover-spin').show();
		$('#tbody_wd').html('');
		$('#sum_wd').html('');
		var dt1 = $('#single_cal2').val();
		var dt2 = $('#single_cal3').val();
		var user = $('#user').val();
			$.ajax({
				url: 'sel_state',
				type: 'POST',
				dataType: 'json',
				data: {dt1:dt1,dt2:dt2,user:user},
			})
			.done(function(res) {
				if (res.code == 1) {
					$('#table_rj').hide();
					$('#table_dw').show();
					if(res.data.length >= 1 ){
						var conut 	= res.data.length;
						var wd 		= res.data;
						var content = '';
						var tt_dp 	= 0;
						var tt_wd 	= 0;
						for(var i=0; i < conut; i++){

							content += '<tr>';
							content += '<td>'+i+'</td>';
							content += '<td>'+wd[i]['id']+'</td>';
							content += '<td>'+GetFormattedDate(wd[i]['datetime']*1000)+'</td>';
							content += '<td>'+GetFormattedDate(wd[i]['dateCreate']*1000)+'</td>';
							if(wd[i]['deposit'] != 0){		content += '<td class="text-right">'+nb(wd[i]['deposit'])+'</td>';}else{content += '<td class="text-right"> - </td>';}
							if(wd[i]['withdraw'] != 0){		content += '<td class="text-right">'+nb(wd[i]['withdraw'])+'</td>';}else{content += '<td class="text-right"> - </td>';}
							content += '<td>'+wd[i]['user']+'</td>';
							content += '<td>'+wd[i]['username']+'</td>';
							content += '<td>'+wd[i]['account']+'</td>';
							content += '<td>'+wd[i]['bank_short']+'</td>';
							content += '<td>'+wd[i]['bw_name']+wd[i]['bw_acc'].substr(-6);+'</td>';
							content += '<td>'+wd[i]['note']+'</td>';
							content += '<td>'+wd[i]['admin_name']+'</td>';
							content += '</tr>';
						
							var withdraw =  parseFloat(wd[i]['withdraw']);
							var deposit  =  parseFloat(wd[i]['deposit']);

							tt_wd = tt_wd + withdraw;
							tt_dp = tt_dp + deposit;
							
						}
						
						var sum = '<tr><td colspan="4" class="text-right">รวม</td><td class="text-right">'+nb(tt_dp.toFixed(2))+'</td><td class="text-right">'+nb(tt_wd.toFixed(2))+'</td><td colspan="5"></td></tr>';

					}else{
						var content = 'No data';
					}
					$('#sum_wd').html(sum);
					$('#tbody_wd').html(content);
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
	function GetFormattedDate(d) {

        var todayTime = new Date(d);
        var month = ('0' + (todayTime.getMonth() + 1)).slice(-2);
        var day = ('0' + todayTime.getDate()).slice(-2);
        var year = (todayTime.getFullYear());
        var h = ('0' + todayTime.getHours()).slice(-2);
        var s = ('0' + todayTime.getMinutes()).slice(-2);
        return day + "/" + month + "/" + year +" " + h + ":" + s;
    }
</script>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการที่แอดเครดิตให้ลูกค้า<small></small></h2>
          
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
				ID : ztzz361i
				<input type="text" value="" class="form-control" id="user" maxlength="6" placeholder="รหัสลูกค้า">
				ใส่แค่ตัวเลข 6 หลัก
				</div>
				<div class="col-sm-2">
				<br>
				<button onClick="select_user()" class="btn btn-info">ค้นหา</button>
				
				</div>
			</div>
			 
			  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                       <tr class="text-center">
                       <th width="2%">No</th>
                       <th width="2%">ToUsername</th>
                       <th>วันที่</th>
                       <th>เวลา (-1Hr)</th>
                       <th>จำนวนเงิน</th>
                       </tr>
                     </thead>
                      <tbody id="bodyhistory">
                        
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

<script>
$(document).on('user',function(e) {
    if(e.which == 13) {
        alert('You pressed enter!');
    }
});
function select_user()
	{

		var dt1 = $('#single_cal2').val();
		var dt2 = $('#single_cal3').val();
		var user = $('#user').val();
		
			$.ajax({
				url: 'sel_user',
				type: 'POST',
				dataType: 'json',
				data: {dt1:dt1,dt2:dt2,user:user},
			})
			.done(function(res) {
				if (res.code == 1) {
					$('#gethistory').modal();
					if(res.data.length >= 1 ){
						var conut 	= res.data.length;
						var wd 		= res.data;
						var content = '';
						for(var i=0; i < conut; i++){
							content += '<tr><td>'+i+'</td><td>'+wd[i]['ToUsername']+'</td><td>'+wd[i]['CreationTime'].substr(0,10)+'</td><td>'+wd[i]['CreationTime'].substr(11)+'</td><td>+'+wd[i]['Amount']+'</td></tr>';
						}

					}else{
						var content = 'No data';
					}
				}else{
					swal(res.title,res.msg,'error');
				}
				$('#bodyhistory').html(content);
			})
			.fail(function() {
				console.log("error");
			});

		
	}
</script>

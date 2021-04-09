<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Log Safecode<small></small></h2>
          
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
                <br>
                <button onClick="select_log(1)" class="btn btn-info">ค้นหา</button>
                <button onClick="select_log(0)" class="btn btn-info">ค้นหาทั้งหมด</button>
				
				
				</div>
			</div>
			 
			  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                       <tr class="text-center">
                       <th width="2%">No</th>
                       <th width="2%">Id</th>
                       <th width="2%">ผู้ดำเนินรายการ</th>
                       <th width="3%">รายการ</th>
                       <th width="2%">เวลาดำเนินการ</th>
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
// $(document).on('user',function(e) {
//     if(e.which == 13) {
//         alert('You pressed enter!');
//     }
// });
function select_log(n)
	{

		var dt1 = $('#single_cal2').val();
		var dt2 = $('#single_cal3').val();
       			$.ajax({
				url: 'select_logsafecode',
				type: 'POST',
				dataType: 'json',
				data: {dt1:dt1,dt2:dt2,n:n},
			})
			.done(function(res) {
				if (res.code == 1) {
					$('#gethistory').modal();
					if(res.data.length >= 1 ){
						var conut 	= res.data.length;
						var wd 		= res.data;
						var content = '';
						for(var i=0; i < conut; i++){
               content +='<tr class="text-center">';
               content +='<td>'+(i+1)+'</td>'; 
               content +='<td>'+wd[i]['id']+'</td>';              
               content +='<td>'+wd[i]['name']+'</td>'; 
               content +='<td>'+wd[i]['data_log']+'</td>'; 
               content +='<td class="text-center">'+wd[i]['time_log']+'</td>'; 
               content +="</tr>";
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

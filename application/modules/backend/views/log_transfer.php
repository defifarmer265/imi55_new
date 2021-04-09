<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>log transfer<small></small></h2>
          
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
				ID : ztiai
				<input type="text" value="" class="form-control" id="user" maxlength="6" placeholder="รหัสลูกค้า">
				ใส่แค่ตัวเลข 6 หลัง
				</div>
				<div class="col-sm-2"><br>
				<button onClick="select_user()" class="btn btn-info">ค้นหา</button>
				
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
                         <th >รหัส</th>
                         <th >Username</th>
                         <th >วันที่รายการ</th>
                         <th >เพิ่มเครดิต</th>
                         <th >ลดเครดิต</th>                    
                         <th >เครดิตก่อน</th>
                         <th >เครดิตหลัง</th>
                         <th >พนักงาน</th>
                       </tr>
                     </thead>

                      <tbody id="bodyhistory">
                    <?php

                    ?>
                        <?php
                        $i=1;
                        foreach ($log_transfer as $key => $value) {
                          if($value['type'] == 1){
                            $cre_in = $value['amount'];
                            $cre_out = 0;
                          }else{
                            $cre_in = 0;
                            $cre_out = $value['amount'];
                          }
                          ?>
                        <tr>
                          <td class="text-center"><?=$i?></td>
                          <td class="text-center"><?=$value['user']?></td>
                          <td class="text-center"><?=$value['username']?></td>
                          <td class="text-center"><?=date('d/m/Y H:i:s',$value['create_time'])?></td>
                          <td class="text-right"><?=$cre_in?></td>
                          <td class="text-right"><?=$cre_out?></td>
                          <td class="text-right"><?=$value['credit_last']?></td>
                          <td class="text-right"><?=$value['credit_result']?></td>
                          <td class="text-center"><?=$value['admin_name']?></td>
                        </tr>
                        <?php $i++; } ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>

$(document).on('user',function(e) {
 
    if(e.which == 13) {
        alert('You pressed enter!');
    }
});
function select_user()
	{
		$('#bodyhistory').html('');
		var dt1 = $('#single_cal2').val();
		var dt2 = $('#single_cal3').val();
		var user = $('#user').val();
			$.ajax({
				url: 'log_transfer',
				type: 'POST',
				dataType: 'json',
				data: {dt1:dt1,dt2:dt2,user:user},
			})
			.done(function(res) {
				if (res.code == 1) {
					//console.log(res);
					if(res.data.length >= 1 ){
            var i = 1;
            $.each(res.data, function(index, val) {
              var html='';
              if(val.type == 1){
                var cre_in = val.amount;
                var cre_out = 0;
              }else{
                var cre_in = 0;
                var cre_out = val.amount;
              }
                 content += '<tr>';
             content += '<td class="text-center">'+i+'</td>';
             content += '<td class="text-center">'+val.user+'</td>';
             content += '<td class="text-center">'+val.username+'</td>';
             content += '<td class="text-center">'+moment.unix(val.create_time).format("DD/MM/YYYY HH:mm:ss");+'</td>';
             content += '<td class="text-right">'+cre_in+'</td>';
             content += '<td class="text-right">'+cre_out+'</td>';
             content += '<td class="text-right">'+val.credit_last+'</td>';
             content += '<td class="text-right">'+val.credit_result+'</td>';
             content += '<td class="text-center">'+val.admin_name+'</td>';
             content += '</tr>';
            });
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
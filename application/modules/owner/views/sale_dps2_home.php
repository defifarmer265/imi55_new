
<div id="cover-spin"></div>
<div class="row">
  <div class="col-md-11 col-sm-11 ">
    <div class="x_panel">
      <div class="x_title">
        <h2><a href="<?=base_url()?>owner/sale/home">SALE</a><small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-10 col-sm-10" style="margin: 0px auto; float: none;">
        <div class="x_content">
          <div class="row ">
            <div class="col-sm-3 "> วันเริ่ม
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
            <div class="col-sm-3"> วันสิ้นสุด
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
            <div class="col-sm-2"> เลือกเซลล์ <br>
              <select id="sale" class="form-control">
                <?php foreach($sale_r as $sale=>$s){?>
                <option value="<?=$s['id']?>">
                <?=$s['name']?>
                </option>
                <?php  }?>
              </select>
            </div>
            <div class="col-sm-4"> 
                <span class="text-danger">**ได้เพียงแค่ 30 วัน </span> <br>
                <button onClick="search()" class="btn btn-info">ค้นหา</button> <br>
                <span class="text-danger"> ระบบใช้เวลาค้นหา 2 - 3 นาที กรุณารอ</span> 
            </div>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col-sm-12 ">
              <div class="card-box ">
                <div id="summary" style="display: none;">
                  <div class="col-md-4   ">
                    <div class="x_panel">
                      <div class="x_content">
                        <ul class="legend list-unstyled">
                          <li>
                              <div class="row">
                                  <div class="col-5 text-center"> ประเภท </div>
                                  <div class="col-3 text-center"> จำนวน </div>
                                  <div class="col-4 text-center"> ยอดเงิน </div>
                              </div>
                            
                          </li>
                          <li>
                              <div class="row">
                                  <div class="col-5">
                                     <p> <span class="icon"><i class="fa fa-square dark"></i></span> <span class="name"> ยอด 1 </span></p>
                                  </div>
                                  <div class="col-3 text-center"><p><span class="name" id="dpsi1"></span></p></div>
                                  <div class="col-4 text-right"><p><span class="name" id="sum_dps1"></span></p></div>
                              </div>
                            
                          </li>
                          <li>
                              <div class="row">
                                  <div class="col-5">
                                      <p> <span class="icon"><i class="fa fa-square grey"></i></span> <span class="name"> ยอด 2 </span> </p>
                                  </div>
                                  <div class="col-3 text-center"><p><span class="name" id="dpsi2"></span></p></div>
                                  <div class="col-4 text-right"><p><span class="name" id="sum_dps2"></span></p></div>
                              </div>
                            
                          </li>
                          <li>
                              <div class="row">
                                  <div class="col-5">
                                      <p> <span class="icon"><i class="fa fa-square blue"></i></span> <span class="name"> ยอด 3 </span> </p>
                                  </div>
                                  <div class="col-3 text-center"><p><span class="name" id="dpsi3"></span></p></div>
                                  <div class="col-4 text-right"><p><span class="name" id="sum_dps3"></span></p></div>
                              </div>
                            
                          </li>
                            <li>
                              <div class="row">
                                  <div class="col-5">
                                      <p> <span class="icon"><i class="fa fa-square green"></i></span> <span class="name"> ยอด 4 </span> </p>
                                  </div>
                                  <div class="col-3 text-center"><p><span class="name" id="dpsi4"></span></p></div>
                                  <div class="col-4 text-right"><p><span class="name" id="sum_dps4"></span></p></div>
                              </div>
                            
                          </li>
                            <li>
                              <div class="row">
                                  <div class="col-5">
                                      <p> <span class="icon"><i class="fa fa-square red"></i></span> <span class="name"> ยอด 5 </span> </p>
                                  </div>
                                  <div class="col-3 text-center"><p><span class="name" id="dpsi5"></span></p></div>
                                  <div class="col-4 text-right"><p><span class="name" id="sum_dps5"></span></p></div>
                              </div>
                            
                          </li>

                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3   widget widget_tally_box" >
                    <div class="x_panel">
                      <div class="x_content">
                        <div style="text-align: center; margin-bottom: 17px">
                          <ul class="verticle_bars list-inline" style="display: flex; ">
                            <li>
                              <div class="progress vertical progress_wide bottom">
                                <div class="progress-bar progress-bar-dark" role="progressbar" data-transitiongoal="" id="avg1"></div> 
                              </div>
                              
                            </li>
                            <li>
                              <div class="progress vertical progress_wide bottom">
                                <div class="progress-bar progress-bar-gray" role="progressbar" data-transitiongoal="" id="avg2"></div>
                              </div>
                            </li>
                            <li>
                              <div class="progress vertical progress_wide bottom">
                                <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="" id="avg3"></div>
                              </div>
                            </li>
                            <li>
                              <div class="progress vertical progress_wide bottom">
                                <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="" id="avg4"></div>
                              </div>
                            </li>
                            <li>
                              <div class="progress vertical progress_wide bottom">
                                <div class="progress-bar progress-bar-danger" role="progressbar" data-transitiongoal="" id="avg5"></div>
                              </div>
                            </li>
                          </ul>
                        </div>
                          <div class="name"><h2><p id="useri"></p></h2></div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div id="content"></div>
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

	function search() {
		$('#cover-spin').show();
		var date_start 	 = $('#single_cal2').val();
		var date_end 	 = $('#single_cal3').val();
		var sale_id 	 = $('#sale').val();
		$.ajax({
				url: 'search',
				type: 'POST',
				dataType: 'json',
				data: {
					date_start: date_start,date_end:date_end,sale_id:sale_id
				},
			})
			.done(function(res) {
				// success
				if (res.code == 1) {
					swal(res.title,res.msg,'success');
                    
					var content = '';
					var conut   = res.data.user.length;
					var dpsi	= res.data.dpsi;
					var sum	    = res.data.sum;
					var user    = res.data.user;
					var useri   = res.data.useri;
					var j		= 1;
					content += '<table id="" class="table-bordered dt-responsive nowrap " cellspacing="0" width="100%">';
					content += '<thead style="background-color:#12205F;color: #FFF">'
					content += '<tr align="center">';
					content += '<th width="3%" rowspan="2"> No</th>';
					content += '<th rowspan="2"> เบอร์โทร  </th>';
					content += '<th rowspan="2"> รหัส </th>';
					content += '<th rowspan="2"> วันที่สร้าง </th>';
					content += '<th colspan="5"> รายละเอียดยอดฝาก </th>';
					content += '</tr>';
					content += '<tr align="center">';
					content += '<th > ยอด 1</th>';
					content += '<th > ยอด 2</th>';
					content += '<th > ยอด 3</th>';
					content += '<th > ยอด 4</th>';
					content += '<th > ยอด 5</th>';
					content += '</tr><tr>';
					content += '<td colspan="4" class="text-right"> ยอดรวม </td>';
					content += '<td class="text-right"> '+sum['dps1'].toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right"> '+sum['dps2'].toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right"> '+sum['dps3'].toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right"> '+sum['dps4'].toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right"> '+sum['dps5'].toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '</tr><tr>';
					content += '<td colspan="4" class="text-right"> จำนวนยอด </td>';
					content += '<td class="text-right"> '+dpsi['dpsi1'].toLocaleString()+' </td>';
					content += '<td class="text-right"> '+dpsi['dpsi2'].toLocaleString()+' </td>';
					content += '<td class="text-right"> '+dpsi['dpsi3'].toLocaleString()+' </td>';
					content += '<td class="text-right"> '+dpsi['dpsi4'].toLocaleString()+' </td>';
					content += '<td class="text-right"> '+dpsi['dpsi5'].toLocaleString()+' </td>';
					content += '</tr>';
					content += '</thead>';
					content += '<tbody>';
					
					for (var i = 0; i < conut; i++) {
					content += '<tr>';
					content += '<td class="text-center">'+j+'</td>'; j++;
					content += '<td class="text-center">'+user[i]['username']+'</td>';
					content += '<td class="text-center">'+user[i]['user']+'</td>';
					content += '<td class="text-center">'+moment.unix(user[i]['create_time']).format("DD-MM-YY HH:mm")+'</td>';
					let dps1 = (user[i]['dps1'] > 0) ? user[i]['dps1'] : '-';
					let dps2 = (user[i]['dps2'] > 0) ? user[i]['dps2'] : '-';
					let dps3 = (user[i]['dps3'] > 0) ? user[i]['dps3'] : '-';
					let dps4 = (user[i]['dps4'] > 0) ? user[i]['dps4'] : '-';
					let dps5 = (user[i]['dps5'] > 0) ? user[i]['dps5'] : '-';
					content += '<td class="text-right">'+dps1.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right">'+dps2.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right">'+dps3.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right">'+dps4.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right">'+dps5.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';

					content += '</tr>';
					}
					content += '</tbody>';
					content += '</table>';
                    
					// Summary 
                    $('#summary').show();
                    $('#useri').html('จากลูกค้าทั้งหมด '+useri+' คน');
                    $('#dpsi1').html(dpsi['dpsi1']+'<span class="text-danger"> ('+(useri-dpsi['dpsi1'])+')</span>');
                    $('#dpsi2').html(dpsi['dpsi2']+'<span class="text-danger"> ('+(useri-dpsi['dpsi2'])+')</span>');
                    $('#dpsi3').html(dpsi['dpsi3']+'<span class="text-danger"> ('+(useri-dpsi['dpsi3'])+')</span>');
                    $('#dpsi4').html(dpsi['dpsi4']+'<span class="text-danger"> ('+(useri-dpsi['dpsi4'])+')</span>');
                    $('#dpsi5').html(dpsi['dpsi5']+'<span class="text-danger"> ('+(useri-dpsi['dpsi5'])+')</span>');
                    $('#sum_dps1').html(sum['dps1'].toLocaleString());
                    $('#sum_dps2').html(sum['dps2'].toLocaleString());
                    $('#sum_dps3').html(sum['dps3'].toLocaleString());
                    $('#sum_dps4').html(sum['dps4'].toLocaleString());
                    $('#sum_dps5').html(sum['dps5'].toLocaleString());
                    
                    let avg1 = (dpsi['dpsi1'] *100)/ useri;
                    let avg2 = (dpsi['dpsi2'] *100)/ useri;
                    let avg3 = (dpsi['dpsi3'] *100)/ useri;
                    let avg4 = (dpsi['dpsi4'] *100)/ useri;
                    let avg5 = (dpsi['dpsi5'] *100)/ useri;
                    $('#avg1').html(parseInt(avg1)+'%');
                    $('#avg1').attr('aria-valuenow', avg1).css('height', avg1+'%');
                    $('#avg2').html(parseInt(avg2)+'%');
                    $('#avg2').attr('aria-valuenow', avg2).css('height', avg2+'%');
                    $('#avg3').html(parseInt(avg3)+'%');
                    $('#avg3').attr('aria-valuenow', avg3).css('height', avg3+'%');
                    $('#avg4').html(parseInt(avg4)+'%');
                    $('#avg4').attr('aria-valuenow', avg4).css('height', avg4+'%');
                    $('#avg5').html(parseInt(avg5)+'%');
                    $('#avg5').attr('aria-valuenow', avg5).css('height', avg5+'%');
                    
                    // End Summary

					$('#content').html(content);
					$('#cover-spin').hide();
				} else {
					swal(res.title,res.msg,'error');
					$('#cover-spin').hide();
				}
			});              
                  
	}

  
</script>
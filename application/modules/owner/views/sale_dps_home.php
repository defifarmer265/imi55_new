<div id="cover-spin"></div>
<div class="row">
  <div class="col-md-11 col-sm-11 ">
    <div class="x_panel">
      <div class="x_title">
        <h2><a href="<?=base_url()?>owner/sale/home">ระบบเซลล์</a><small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
        <div class="clearfix"></div>
      </div>
      <div class="row">
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
              <div class="col-sm-2"> <span class="text-danger">งบประมาณ</span> <br>
                <input type="number" class="form-control text-center" id="cost" value="0">
              </div>
              <div class="col-sm-2"> <span class="text-danger">ระบบใช้เวลาค้นหา 2 - 3 นาที กรุณารอ</span> <br>
                <button onClick="search()" class="btn btn-info">ค้นหา</button>
                <br>
               
            </div>
          </div>
              
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
<div class="row" id="detail_all" style="display: none;">
  <div class="col-md-11 col-sm-11 ">
    <div class="x_panel">
            
            <div class="col-md-12 col-sm-12 ">
              <div class="x_content">
                <div class="tab-content" id="myTabContent">
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size: 16px;">
              <li class="nav-item"> <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> โปรไฟล์ </a> </li>
              <li class="nav-item"> <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> คำนวณ </a> </li>
              <li class="nav-item"> <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"> รายละเอียด </a> </li>
            </ul>
                  <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab"> 
                    <br>
                      <div class="col-md-3   widget widget_tally_box">
                        <div class="x_panel fixed_height_390">
                          <div class="x_content">
                            <h3 class="name" id="sale_name"></h3>

                            <div class="flex">
                              <ul class="list-inline count2">
                                <li>
                                  <h3 id="dpsid"></h3>
                                  <span>วันนี้</span>
                                </li>
                                <li>
                                  <h3 id="dpsim"></h3>
                                  <span>เดือนนี้</span>
                                </li>
                                <li>
                                  <h3 id="dpsia"></h3>
                                  <span>ทั้งหมด</span>
                                </li>
                              </ul>
                            </div>
                            <p class="text-left" id="sale_detail">
                              
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3   widget widget_tally_box">
                        <div class="x_panel fixed_height_390">
                          <div class="x_content">

                            <div style="text-align: center; margin-bottom: 17px">
                              <ul class="verticle_bars list-inline" style="display: flex;">
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-dark" role="progressbar" data-transitiongoal="" id="dpsi1"></div>
                                  </div>
                                </li>
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-gray" role="progressbar" data-transitiongoal="" id="dpsi2"></div>
                                  </div>
                                </li>
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="" id="dpsi3"></div>
                                  </div>
                                </li>
                                <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="" id="dpsi4"></div>
                                  </div>
                                </li>
                                  <li>
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" data-transitiongoal="" id="dpsi5"></div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                            <div class="divider"></div>

                            <ul class="legend list-unstyled">
                                <li>
                                <p>
                                  <span class="icon"></span> <span class="name"> <i id="dpsiall"></i> ยอดทั้งหมด </span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square dark"></i></span> <span class="name"> <i id="dpsi1text"></i> ยอดฝากแรก </span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square grey"></i></span>  <span class="name"> <i id="dpsi2text"></i> ยอดที่สอง </span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square blue"></i></span>  <span class="name"> <i id="dpsi3text"></i> ยอดที่สาม </span>
                                </p>
                              </li>
                              <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square green"></i></span>  <span class="name"> <i id="dpsi4text"></i> ยอดที่สี่</span>
                                </p>
                              </li>
                                <li>
                                <p>
                                  <span class="icon"><i class="fa fa-square red"></i></span>  <span class="name"><i id="dpsi5text"></i> ยอดที่ห้า </span>
                                </p>
                              </li>
                            </ul>

                          </div>
                        </div>
                      </div>
                      
                    </div>
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <br>
                    <div class="row">
                      <div class="col-md-8">
                        <table class="table table-bordered" style="font-size: 17px;">
                          <thead>
                            <tr class="text-center">
                              <th>รายการ</th>
                              <th>ยอดเงิน</th>
                            </tr>
                          </thead>
                          <tbody class="text-right">
                            <tr>
                              <td>จำนวนมียอดแรก</td>
                              <td id="numf"></td>
                            </tr>
                            <tr>
                              <td>ลูกค้าต่ำกว่า
                                <?= $setting->f_amt0 != '' ? $setting->f_amt0 : '0'?></td>
                              <td id="numf1"></td>
                            </tr>
                            <tr>
                              <td>ลูกค้ายอด
                                <?= $setting->f_amt0 ?>
                                -
                                <?= $setting->f_amt1 - 1 ?></td>
                              <td id="numf2"></td>
                            </tr>
                            <tr>
                              <td>ลูกค้ายอด
                                <?= $setting->f_amt1 ?>
                                เป็นต้นไป </td>
                              <td id="numf3"></td>
                            </tr>
                            
                            <tr>
                              <td>ลูกค้าที่ฝาก
                                1
                                -
                                <?=$setting->f_amt1 - 1;?>
                                บาท <br></td>
                              <td id="sum_famt12"></td>
                            </tr>
                              <tr>
                              <td>อัตราจ่ายตามค่าเฉลี่ย</td>
                              <td id="ave_pay2"></td>
                            </tr>
                            <tr>
                              <td> คำนวณ
                                1
                                -
                                <?=$setting->f_amt1 - 1;?>
                                <br>
                                <span id="sum_famt123"> </span>/
                                <?=$setting->f_amt1?></td>
                              <td id="dpsif12"></td>
                            </tr>
                            <tr>
                              <td>คำนวณ 1 <span id="cal_com"></span></td>
                              <td id="sum_com3"></td>
                            </tr>
                            <tr>
                              <td>คำนวณ 2<span id="cal_com2"></span></td>
                              <td id="sum_com2"></td>
                            </tr>
                               <tr>
                              <td>ยอด 2 มี</td>
                              <td id="dpsi2_1"></td>
                            </tr>
                              <tr>
                              <td>ยอด 2 คิดเป็นยอดเงินได้</td>
                              <td id="sum_com2_1"></td>
                            </tr>
                              <tr>
                              <td>ยอดสุทธิ</td>
                              <td id="total1"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-4">
                        <table class="table table-bordered" style="font-size: 17px;">
                          <thead>
                            <tr class="text-center">
                              <th>ค่าเฉลีย</th>
                              <th>อัตราจ่าย
                                <?= $setting->f_amt1 ?>
                                +</th>
                            </tr>
                          </thead>
                          <tbody class="text-center">
                            <tr id="ave1">
                              <td><?= $setting->ave1 ?></td>
                              <td><?= $setting->ave1_pay2 ?></td>
                            </tr>
                            <tr id="ave2">
                              <td><?= $setting->ave2 ?></td>
                              <td><?= $setting->ave2_pay2 ?></td>
                            </tr>
                            <tr id="ave3">
                              <td><?= $setting->ave3 ?></td>
                              <td><?= $setting->ave3_pay2 ?></td>
                            </tr>
                            <tr id="ave4">
                              <td><?= $setting->ave4 ?></td>
                              <td><?= $setting->ave4_pay2 ?></td>
                            </tr>
                            <tr id="ave5">
                              <td><?= $setting->ave5 ?></td>
                              <td><?= $setting->ave5_pay2 ?></td>
                            </tr>
                            <tr id="ave6">
                              <td>0</td>
                              <td>0</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    <div class="row">
                      <div class="col-md-6">
                        <table class="table">
                            <thead>
                        <tr>

                          <th> รายการ </th>
                          <th> จำนวน </th>
                          <th> ยอดเงิน </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td scope="row">ผลรวมยอดแรก</td>
                          <td class="text-center" id="num_dpsi1"></td>
                          <td class="text-right" id="sum_dpsi1"></td>

                        </tr>
                        <tr>
                          <td scope="row">ผลรวมยอดสอง</td>
                          <td class="text-center" id="num_dpsi2"></td>
                          <td class="text-right" id="sum_dpsi2"></td>

                        </tr>
                        <tr>
                          <td scope="row">ผลรวมยอดฝาก</td>
                          <td class="text-center" id="num_dpsi"></td>
                          <td class="text-right" id="sum_dpsi"></td>

                        </tr>
                      </tbody>
                    </table>
                        </div>
                      
                      </div>
                      
             
                    
                    <div class="row" id="content"> </div>
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
		var cost 	 = $('#cost').val();
        $('#ave1').removeClass('table-danger');
        $('#ave2').removeClass('table-danger');
        $('#ave3').removeClass('table-danger');
        $('#ave4').removeClass('table-danger');
        $('#ave5').removeClass('table-danger');
        $('#ave6').removeClass('table-danger');
		$.ajax({
				url: 'search',
				type: 'POST',
				dataType: 'json',
				data: {
					date_start: date_start,date_end:date_end,sale_id:sale_id,cost:cost
				},
			})
			.done(function(res) {
				// success
				if (res.code == 1) {
					swal(res.title,res.msg,'success');
                    $('#detail_all').show();
					var content = '';
					var conut   = res.data.user.length;
					var dpsi	= res.data.dpsi;
					var sum	    = res.data.sum;
					var user    = res.data.user;
					var cal     = res.data.calculate;
					var sale    = res.data.sale;
					var j		= 1;
                    
                    
                    // Detail 
                    $('#num_dpsi1').html(dpsi['dpsi1'].toLocaleString());
                    $('#num_dpsi2').html(dpsi['dpsi2'].toLocaleString());
                    $('#num_dpsi').html(dpsi['dpsi'].toLocaleString());
                    $('#sum_dpsi1').html(sum['dps1'].toLocaleString(undefined, {minimumFractionDigits: 2}));
                    $('#sum_dpsi2').html(sum['dps2'].toLocaleString(undefined, {minimumFractionDigits: 2}));
                    $('#sum_dpsi').html(sum['dps'].toLocaleString(undefined, {minimumFractionDigits: 2}));

					content += '<table id="detail_user" class="table-bordered dt-responsive nowrap " cellspacing="0" width="100%">';
					content += '<thead style="background-color:#12205F;color: #FFF">'
					content += '<tr align="center">';
					content += '<th width="3%"> No </th>';
					content += '<th > เบอร์โทร  </th>';
					content += '<th > รหัส </th>';
					content += '<th > วันที่สร้าง </th>';
					content += '<th onclick="sortTable(4)"> ยอด 1 </th>';
					content += '<th onclick="sortTable(5)"> ยอด 2 </th>';
					content += '<th onclick="sortTable(6)"> ยอดรวม </th>';
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
					let dpssum = (user[i]['dpssum'] > 0) ? user[i]['dpssum'] : '-';

					content += '<td class="text-right">'+dps1.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right">'+dps2.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';
					content += '<td class="text-right">'+dpssum.toLocaleString(undefined, {minimumFractionDigits: 2})+' </td>';


					content += '</tr>';
					}
					content += '</tbody>';
					content += '</table>';
                    // Detail End
					// Summary 
               console.log(cal);
                    $('#numf').html(parseInt(dpsi.dpsi1));                     //จำนวน ลูกค้าที่มียอดแรก
                    $('#numf1').html(parseInt(cal.numf1));                     //จำนวน ลูกค้าฝาก เรท 1
                    $('#numf2').html(parseInt(cal.numf2));                     //จำนวน ลูกค้าฝาก เรท 2
                    $('#numf3').html(parseInt(cal.numf3));                     //จำนวน ลูกค้าฝาก เรท 3
                    $('#average').html(parseInt(cal.average));                 //ค่าเฉลี่ยเมื่อหารกับทุน
                    $('#ave_pay2').html(parseInt(cal.ave_pay2));               //ค่าเฉลี่ยเมื่อหารกับทุน
                    $('#dpsif12').html(parseInt(cal.dpsif12));                 //จำนวนลูกค้าที่มียอดฝากเรท 1และ2
                    
                    $('#sum_famt12').html(cal.sum_famt12.toLocaleString());           //ยอด ลูกค้าที่มียอดฝากเรท 1และ2
                    $('#sum_famt123').html(cal.sum_famt12.toLocaleString());          //ยอด ลูกค้าที่มียอดฝากเรท 1และ2
                    
                    $('#cal_com').html('[ ( '+cal.numf3+' + '+cal.dpsif12+' ) x '+cal.ave_pay2+' ] / 50%'); 
                    let tt = cal.sum_com3/2;
                    $('#sum_com3').html(tt.toLocaleString());

                    
                    $('#' + cal.typepay).addClass('table-danger'); //ตารางเป็นสีแดงกรณีอยู่ในค่าเฉลียดังกล่าว
                    
                    
                    let sum_com2 = (dpsi['dpsi2'] * 100)/dpsi.dpsi1; //คำนวณเปอร์เซ็นยอดสอง
                    $('#cal_com2').html('คิด '+dpsi.dpsi1+' = 100% ดังนั้น ยอดสอง จึงคิดเป็น )');
                    $('#sum_com2').html(sum_com2.toFixed(0)+'%');
                    
                    $('#dpsi2_1').html(dpsi.dpsi2);
                    let sum_com2_1 = (cal.sum_com3*sum_com2 )/100;
                    $('#sum_com2_1').html(sum_com2_1.toFixed(0));
                    
                    let total1 = sum_com2_1 + tt;
                    $('#total1').html(total1.toFixed(0));
                    
                    // End Summary
                    
                    // Profile Sale
                    $('#dpsid').html(dpsi.dpsid.toLocaleString())
                    $('#dpsim').html(dpsi.dpsim.toLocaleString())
                    $('#dpsia').html(dpsi.dpsia.toLocaleString())
                    $('#dpsiall').html(dpsi.dpsi.toLocaleString())
                    let sale_detail  = '';
                        sale_detail += ' ชื่อพนักงาน : '+sale.name+'<br>';
                        sale_detail += ' รหัสเข้าใช้งาน : '+sale.username+'<br>';
                        sale_detail += ' ล็อกอินล่าสุด : '+moment.unix(sale.last_login).format("DD-MM-YY HH:mm")+'<br>';
                        sale_detail += ' ไอพีล่าสุด : '+sale.lastip_login+'<br>';
                    $('#sale_name').html(sale.name);
                    $('#sale_detail').html(sale_detail);
                    
                    let avg1 = (dpsi['dpsi1'] *100)/ dpsi['dpsi1'];
                    let avg2 = (dpsi['dpsi2'] *100)/ dpsi['dpsi1'];
                    let avg3 = (dpsi['dpsi3'] *100)/ dpsi['dpsi1'];
                    let avg4 = (dpsi['dpsi4'] *100)/ dpsi['dpsi1'];
                    let avg5 = (dpsi['dpsi5'] *100)/ dpsi['dpsi1'];
                    $('#dpsi1text').html(parseInt(dpsi['dpsi1']));
                    $('#dpsi2text').html(parseInt(dpsi['dpsi2']));
                    $('#dpsi3text').html(parseInt(dpsi['dpsi3']));
                    $('#dpsi4text').html(parseInt(dpsi['dpsi4']));
                    $('#dpsi5text').html(parseInt(dpsi['dpsi5']));
                    $('#dpsi1').html(parseInt(avg1)+'%');
                    $('#dpsi2').html(parseInt(avg2)+'%');
                    $('#dpsi3').html(parseInt(avg3)+'%');
                    $('#dpsi4').html(parseInt(avg4)+'%');
                    $('#dpsi5').html(parseInt(avg5)+'%');
                    $('#dpsi1').attr('aria-valuenow', avg1).css('height', avg1+'%');
                    $('#dpsi2').attr('aria-valuenow', avg2).css('height', avg2+'%');
                    $('#dpsi3').attr('aria-valuenow', avg3).css('height', avg3+'%');
                    $('#dpsi4').attr('aria-valuenow', avg4).css('height', avg4+'%');
                    $('#dpsi5').attr('aria-valuenow', avg5).css('height', avg5+'%');
                    // Profile End
                    
					$('#content').html(content);
					$('#cover-spin').hide();
				} else {
					swal('โปรดตั้งค่าการค้นหาใหม่อีกครั้ง',res.msg,'error');
					$('#cover-spin').hide();
				}
			});              
                  
	}

  function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("detail_user");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
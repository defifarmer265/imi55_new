<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
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
#cover-spin1 {
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
.pter{
  cursor:pointer;
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
          <h2>รายการ ฝาก - ถอน ช่วงเวลา<small></small></h2>
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
                    <input type="time" class="form-control has-feedback-left" value="11:00:00" id="time2">
                </div>
              </div>
            </fieldset>
          </div>
          <!-- <div class="col-sm-2">เวลาเริ่ม
          <div class="form-group row">
                <label for="example-time-input" class="col-2 col-form-label"></label>
                <div class="col-10">
                  <input class="form-control" type="time" value="01:45:00" id="time_input1">
                </div>
              </div>
          </div>
          <div class="col-sm-2">เวลาสิ้นสุด
          <div class="form-group row">
                <label for="example-time-input" class="col-2 col-form-label"></label>
                <div class="col-10">
                  <input class="form-control" type="time" value="13:45:00" id="time_input2">
                </div>
              </div>
          </div> -->
          <div class="col-sm-2"><br>
            <button onClick="select_period()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
          </div>
          <div id="graph" class="col-sm-4">
          <!-- <button  type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCart1" >ดูกระเเสการฟ</button> -->
          </div>
        </div>
        
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-9">
                <div class="card-box table-responsive">
                  <table id="emp_table"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead  style="background-color: #2a3f54;color: #fff;" >
                      <tr class="text-center">
                        <th> ช่วงเวลา </th>
                        <th > รายการฝาก </th>
                        <th > จำนวนเงินฝาก </th>
                        <!-- <th > รายการถอน </th>
                        <th > จำนวนเงินถอน </th> -->
                      </tr>
                    </thead>
                    <tbody id="bodyhistory"></tbody>
                  </table>
                </div>
              </div> 
                      <div class="col-sm-9">
                                <div class="card-box table-responsive">
                                    <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                                      <thead>
                                        <!-- <tr class="text-center">
                                          <th> ลำดับ</th>
                                          <th > User</th>
                                          <th > จำนวนเงินฝาก</th>
                                          <th > วันที่ </th>
                                        </tr> -->
                                      </thead>
                                      <!-- <tbody id="bodysum"></tbody> -->
                                      <!-- <tbody id="bodytrdep"></tbody> -->
                                      
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
</div>
<!-- Modal: modalCart -->
<div class="modal fade  bd-example-modal-lg " id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="list"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">

        <table class="table table-hover">
          <tbody id="bodytrdep"></tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalCart -->
<!-- Modal: modalCart -->
<div class="modal fade  bd-example-modal-lg " id="modalCart1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header btn-success">
        <h5 class="modal-title" id="list"><i class="fa fa-bar-chart" aria-hidden="true"></i> กราฟรายการฝาก-จำนวนเงินฝาก ช่วงเวลา</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">

      <div class="x_panel">
                  <div class="x_title">
                    <h2>กราฟรายการฝาก ช่วงเวลา</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="myChart3"></canvas>
                  </div>
       </div>
       <div class="x_panel">
                  <div class="x_title">
                    <h2>กราฟจำนวนเงินฝาก ช่วงเวลา</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="myChart4"></canvas>
                  </div>
       </div>
      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalCart -->
<script>
  $(document).on('user',function(e) {
      if(e.which == 13) {
          alert('You pressed enter!');
      }
  });
function nb(x) {
     var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
  
function select_period(){
  $('#cover-spin1').show();
  $('#bodyhistory').html('');
  $('#graph').html('');
  var dt1 = $('#single_cal2').val();
  var dt2 = $('#single_cal3').val();
  var tm1 = $('#time1').val();
  var tm2 = $('#time2').val();

//  console.log(dt1);
//  console.log(dt2);
//  console.log(tm1);
//  console.log(tm2);
 $.ajax({
          url: '<?=base_url()?>backend/Time_period/time_pd',
          type: 'POST',
          dataType: 'json',
          data: {dt1:dt1,dt2:dt2,tm1:tm1,tm2:tm2},
        })
        .done(function(res) {
          console.log(res);
          if (res.code == 1) {
            if(res.data.length >= 1 ){
            var conut 	= res.data.length;
            var wd = res.data;
            var content = '';
            var cont = '';
            cont+= '<div col-2><br>';
            cont+= '<button  type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCart1" ><i class="fa fa-bar-chart" aria-hidden="true"></i> กระเเสกราฟ</button>';
            cont+= '</div>'
            for(var i=0; i < conut; i++){
              var ctx = document.getElementById('myChart3');
                          var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'],
                                datasets: [{
                                    label: 'รายการฝาก',
                                    data: [wd[i].num_dep01,
                                           wd[i].num_dep02,
                                           wd[i].num_dep03,
                                           wd[i].num_dep04,
                                           wd[i].num_dep05,
                                           wd[i].num_dep06,
                                           wd[i].num_dep07,
                                           wd[i].num_dep08,
                                           wd[i].num_dep09,
                                           wd[i].num_dep10,
                                           wd[i].num_dep11,
                                           wd[i].num_dep12,
                                           wd[i].num_dep13,
                                           wd[i].num_dep14,
                                           wd[i].num_dep15,
                                           wd[i].num_dep16,
                                           wd[i].num_dep17,
                                           wd[i].num_dep18,
                                           wd[i].num_dep19,
                                           wd[i].num_dep20,
                                           wd[i].num_dep21,
                                           wd[i].num_dep22,
                                           wd[i].num_dep23,
                                           wd[i].num_dep24],
                                    backgroundColor: [
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)'
                                        
                                    ],
                                    borderColor: [
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)',
                                        'rgba(87, 21, 70, 0.5)'
                                    ],
                                    borderWidth: 1
                                }],
                            },
                            
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                        var ctx = document.getElementById('myChart4');
                          var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                              labels: ['00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'],
                                datasets: [{
                                    label: 'จำนวนเงินฝาก',
                                    data: [wd[i].sum_dep01.toFixed(2),
                                           wd[i].sum_dep02.toFixed(2),
                                           wd[i].sum_dep03.toFixed(2),
                                           wd[i].sum_dep04.toFixed(2),
                                           wd[i].sum_dep05.toFixed(2),
                                           wd[i].sum_dep06.toFixed(2),
                                           wd[i].sum_dep07.toFixed(2),
                                           wd[i].sum_dep08.toFixed(2),
                                           wd[i].sum_dep09.toFixed(2),
                                           wd[i].sum_dep10.toFixed(2),
                                           wd[i].sum_dep11.toFixed(2),
                                           wd[i].sum_dep12.toFixed(2),
                                           wd[i].sum_dep13.toFixed(2),
                                           wd[i].sum_dep14.toFixed(2),
                                           wd[i].sum_dep15.toFixed(2),
                                           wd[i].sum_dep16.toFixed(2),
                                           wd[i].sum_dep17.toFixed(2),
                                           wd[i].sum_dep18.toFixed(2),
                                           wd[i].sum_dep19.toFixed(2),
                                           wd[i].sum_dep20.toFixed(2),
                                           wd[i].sum_dep21.toFixed(2),
                                           wd[i].sum_dep22.toFixed(2),
                                           wd[i].sum_dep23.toFixed(2),
                                           wd[i].sum_dep24.toFixed(2),
                                           ],
                                    backgroundColor: [
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)'
                                        
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)',
                                        'rgba(255, 99, 71, 0.5)'
                                    ],
                                    borderWidth: 1
                                }],
                            },
                            
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                content += '<tr>';
                                  content += '<td class="text-center"> 00:00:00 - 00:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="00:00:00" data-time2 ="00:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep01)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep01.toFixed(2))+'</td>';
                                  // content += '<td class="text-right">'+wd.num_withdraw+' </td>';
                                  // content += '<td class="text-right">'+nb(wd.sum_withdraw.toFixed(2))+' </td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 01:00:00 - 01:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="01:00:00" data-time2 ="01:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep02)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep02.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 02:00:00 - 02:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="02:00:00" data-time2 ="02:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep03)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep03.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 03:00:00 - 03:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="03:00:00" data-time2 ="03:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep04)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep04.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 04:00:00 - 04:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="04:00:00" data-time2 ="04:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep05)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep05.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 05:00:00 - 05:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="05:00:00" data-time2 ="05:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep06)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep06.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 06:00:00 - 06:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="06:00:00" data-time2 ="06:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep07)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep07.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 07:00:00 - 07:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="07:00:00" data-time2 ="07:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep08)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep08.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 08:00:00 - 08:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="08:00:00" data-time2 ="08:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep09)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep09.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 09:00:00 - 09:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="09:00:00" data-time2 ="09:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep10)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep10.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 10:00:00 - 10:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="10:00:00" data-time2 ="10:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep11)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep11.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 11:00:00 - 11:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="11:00:00" data-time2 ="11:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep12)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep12.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 12:00:00 - 12:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="12:00:00" data-time2 ="12:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep13)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep13.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 13:00:00 - 13:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="13:00:00" data-time2 ="13:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep14)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep14.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 14:00:00 - 14:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="14:00:00" data-time2 ="14:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep15)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep15.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 15:00:00 - 15:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="15:00:00" data-time2 ="15:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep16)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep16.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 16:00:00 - 16:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="16:00:00" data-time2 ="16:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep17)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep17.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 17:00:00 - 17:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="17:00:00" data-time2 ="17:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep18)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep18.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 18:00:00 - 18:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="18:00:00" data-time2 ="18:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep19)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep19.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 19:00:00 - 19:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="19:00:00" data-time2 ="19:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep20)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep20.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 20:00:00 - 20:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="20:00:00" data-time2 ="20:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep21)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep21.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 21:00:00 - 21:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="21:00:00" data-time2 ="21:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep22)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep22.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 22:00:00 - 22:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="22:00:00" data-time2 ="22:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep23)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep23.toFixed(2))+'</td>';
                content += '</tr>';
                content += '<tr>';
                                  content += '<td class="text-center"> 23:00:00 - 23:59:59</td>';
                                  content += '<td class="text-right">'+'<a data-time1 ="23:00:00" data-time2 ="23:59:59"  onClick="select_deptest(this)" class="text-primary pter" data-toggle="modal" data-target="#modalCart" style="ptext-decoration: underline;" target="_blank">'+nb(wd[i].num_dep24)+'</a>'+' </td>';
                                  content += '<td class="text-right">'+nb(wd[i].sum_dep24.toFixed(2))+'</td>';
                content += '</tr>';
            }
            }else{
              var content = 'No data';
            }
            $('#bodyhistory').html(content);
            $('#graph').html(cont);

          // }else{
          //   swal(res.title,res.msg,'error');
          }
          $('#cover-spin1').hide();
          
        })
        .fail(function() {
          console.log("error");
        });
}
function select_deptest(d){
  $('#cover-spin1').show();
  $('#bodytrdep').html('');
  $('#list').html('');
  var dt1 = $('#single_cal2').val();
  var dt2 = $('#single_cal3').val();
  var timefirt = $(d).data('time1');
  var timelast = $(d).data('time2');
// console.log(last18);
// //  console.log(dt1);
// //  console.log(dt2);
 $.ajax({
          url: '<?=base_url()?>backend/Time_period/list_pdtest',
          type: 'POST',
          dataType: 'json',
          data: {dt1:dt1,dt2:dt2,timefirt:timefirt,timelast:timelast},
        })
        .done(function(res) {
          if (res.code == 1) {
                      // console.log(res.data);
            if(res.data.user.length >= 1 ){
              console.log(res.data.user);
              var conut 	= res.data.user.length;
              var wd 		= res.data.user;
              var content = '';
              var con= '';
              // console.log(dt1);
                con += '<div  class="modal-title">';
                con += '<h2>ช่วงเวลา '+timefirt+' - '+timelast+'</h2>';
                con += '</div>';
                content += '<tr  style="background-color: #2a3f54;color: #fff;">';
                                  content += '<th class="text-center" >ลำดับ</td>';
                                  content += '<th class="text-center" >User</td>';
                                  content += '<th class="text-center" >จำนวนฝาก</td>';
                                  content += '<th class="text-center" >วันที่ฝาก</td>';
                                  content += '<th class="text-center" >เวลาที่ฝาก</td>';
                content += '</tr>';
              for(var i=0; i < conut; i++){
                var date = new Date(wd[i].dateCreate1* 1000).format('d-m-Y');
                var time = new Date(wd[i].dateCreate1* 1000).format('H:i:s');

                content += '<tr>';
                                  content += '<td class="text-center">'+(i+1)+' </td>';
                                  content += '<td class="text-right">'+wd[i].user1+' </td>';
                                  content += '<td class="text-right">'+wd[i].deposit1+' </td>';
                                  content += '<td class="text-right">'+date+' </td>';
                                  content += '<td class="text-right">'+time+' </td>';
                content += '</tr>';
             }
            }else{
              var content = 'No data';
            }
            // $('#bodysum').html(sum);
            $('#bodytrdep').html(content);
            $('#list').html(con);
            // $('#head').html(content);
          }else{
            swal(res.title,res.msg,'error');
          }
          $('#cover-spin1').hide();
          
        })
        .fail(function() {
          console.log("error");
        });
}
</script>
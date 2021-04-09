<!-- page content -->
<style>
   @media only screen and (max-width: 300px) {
   .mmm {
   position: absolute;
   bottom: -1079%;
   left: 0%;
   right: 0%;
   }
   }
</style>
<div class="row">
   <div class="col-md-12 col-sm-12 ">
      <div class="row">
         <div class="col-md-12 col-sm-12 ">
            <div class="dashboard_graph">
               <div class="row x_title">
                  <div class="col-md-8">
                     <h4>ค้นหาข้อกราฟฝากถอนรายวัน แบบ ช่วงเวลา</h4><hr>
                     <form action="search" method="post">
                     <div class="row ">
                        <div class="col-sm-2 ">
                           เลือกค้นหาวันที่
                           <fieldset>
                              <div class="control-group">
                                 <div class="controls">
                                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                       <input type="text" class="form-control has-feedback-left" name ="dt1" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                       <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                       <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                        <div class="col-sm-2">
                            <br>
                            <button type="submit" class="btn btn-info">ค้นหา</button>

                        </div>
                    
                     </div>
                      </form>
                     <!-- <h3>กระแสฝากถอน<small> ประจำเดือน <?php echo date('F'); ?></small>/</h3> -->
                  </div>
                  <div class="col-md-2">
                   
                  </div>
               </div>
               <!-- <div class="col-md-12 col-sm-12 ">
                  <div class="row">
                     <div class="col-sm-12">
                     กราฟฝากถอน แบบเลือกวัน
                     <button type="button" class="btn" style="background-color:rgba(236,123,123,0.2)"></button>
                     ยอดฝาก | 
                     <button type="button" class="btn" style="background-color:rgba(189,247,157,0.2)"></button>
                     ยอดถอน
                     <hr>
                     </div>
                   
                  </div>
                  <canvas id="chLine" height="100"></canvas>
               </div> -->
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<br />
<div class="row"> </div>
<!-- /page content -->
<!-- <script>
    function search_chart(){  // ตรงนี้ส่งไปหาข้อมูลมา 
              //ส่งวันที่ไปค้นหาใน searchchar
              var dt1 = $('#single_cal2').val();
                $.ajax({
                    url: 'search',
                    type: 'POST',
                    dataType: 'json',
                    data: {dt1:dt1},
                })
                .done(function(res) {   // ได้มาแล้วสร้างกราฟใหม่
                  if (res.code == 1) {
                      var dp =[];
                      var wt =[];
                      dp = res.data.deposit;
                      wt = res.data.withdraw;
                     console.log(dp);
                     console.log(wt);
                        var colors = ['ffa43ecc', '#4acef0e0','#4acef0e0','#dfeffc','#dbe1cf'];
                        var chLine = document.getElementById("chLine");
                        var chartData = {
                                          labels: ["00:00-00:59", "01.00-01:59", "02:00-02:59", "03:00-03:59", "04:00-04:59", "05:00-05:59", "06:00-06:59","07:00:07:59","08:00-08:59","09:00-09:59","10:00-10:59"
                                          ,"11:00-11:59","12:00-12:59","13:00-13:59", "14:00-14:59","15:00-15:59","16:00-16:59","17:00-17:59","18:00-18:59","19:00-19:59","20:00-20;59","21:00-21:59"
                                          ,"22:00-22:59","23:00-23:59"
                                             ],
                                          datasets: [{
                                             data:[dp],
                                               // data:['28566.00','25597.00','21742.00','8810.00','14470.00','19091.89','18998.00','28506.00','129798.00','50797.00','66310.00','56535.00','210658.00','195848.38','59988.43','81817.08','72289.99','163489.18','10910.00','0','0','0','0','18271.50',],
                                              //  data: ['28566.00','25597.00','21742.00','8810.00','14470.00','19091.89','18998.00','28506.00','129798.00','50797.00','66310.00','56535.00','210658.00','195848.38','59988.43','81817.08','72289.99','37483.18','0','0','0','0','0','18271.50',],
                                                backgroundColor: "rgba(236,123,123,0.2)",
                                                borderColor: "#e81d1d",
                                             
                                             },
                                             {
                                              data:[wt],
                                              //  data:['13273.40','26693.25','19944.25','12968.00','78500.00','8109.43','14523.00','29859.00','126088.50','63975.80','98736.00','70889.00','211455.31','221534.10','55010.66','60006.89','164492.48','32694.30','5000.00','0','0','0','0','0',],
                                               // data:['13273.40','26693.25','19944.25','12968.00','78500.00','8109.43','14523.00','29859.00','126088.50','63975.80','98736.00','70889.00','211455.31','221534.10','55010.66','60006.89','164492.48','22653.80','0','0','0','0','0','0',],
                                                backgroundColor: "rgba(189,247,157,0.2)",
                                                borderColor: "#6fff1e",
                                                
                                             }

                                          ]
                        };

                        if (chLine) {
                          new Chart(chLine, {
                                       type: 'line',
                                       data: chartData,
                                       options: {
                                          scales: {
                                                yAxes: [{
                                                   ticks: {
                                                      beginAtZero: false
                                                   }
                                                }]
                                          },
                                          legend: {
                                                display: false
                                          }
                                       }
                                    });
                        }
                  }else{
                     alert('h');
                  }
                })
                .fail(function() {
                  console.log("error");
                });
    } -->

         
</script>

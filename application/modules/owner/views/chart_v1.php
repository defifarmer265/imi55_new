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
                            <button onClick="search_chart()" class="btn btn-info">ค้นหา</button>
                        </div>
                     </div>
                     <h3>กระแสฝากถอน<small> ประจำเดือน <?php echo date('F'); ?></small></h3>
                  </div>
                  <div class="col-md-2">
                     <button type="button" class="btn" style="background-color:rgba(74,206,240,0.88)"></button>
                     ยอดฝาก<br>
                     <button type="button" class="btn" style="background-color:rgba(255,164,62,0.80)"></button>
                     ยอดถอน<br>
                  </div>
               </div>
               <div class="col-md-12 col-sm-12 ">
                  <div class="spinner-grow text-primary text-center ml-5 " role="status" id="loadg" hidden>
                     <span class="sr-only text-center"  >Loading...</span>
                  </div>
                  <div id="newchart" class="demo-placeholder"></div>
                  <div id="newchart2" class="demo-placeholder">แสดงข้อมูลจ้า</div>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<br />
<div class="row"> </div>
<!-- /page content -->
<script>
    //ค้นหาวันกราฟแบบวัน
    function search_chart(){
              //ซอนกราฟตัวเก๋า 
              var dt1 = $('#single_cal2').val();
              var dt2 = $('#single_cal3').val();
                $.ajax({
                    url: 'searchChart',
                    type: 'POST',
                    dataType: 'json',
                    data: {dt1:dt1,dt2:dt2},
                })
                .done(function(res) {
                  chart2(res);
                 
                })
                .fail(function() {
                  console.log("error");
                });
    }
    function chart2(chart_data){
      var jsonData = chart_data;
      $.each(jsonData, function(i, jsonData){
        var depositJS = jsonData.depositJS;
        var withdrawJS = jsonData.depositJS;
       });
       
    }

   
   setTimeout(() => {
           if ("undefined" != typeof $.plot) {
               for (
                 var a = [<?= $withdrawJS; ?>],
                     b = [<?= $depositJS; ?>], f = 0; f < 30; f++);
               var g = {
                   series: {
                       lines: {
                           show: !1,
                           fill: !0,
                       },
                       splines: {
                           show: !0,
                           tension: .4,
                           lineWidth: 1,
                           fill: .4
                       },
                       points: {
                           show: !0,
                           radius: 4.5,
                           symbol: "circle",
                           lineWidth: 3
                       },
                       shadowSize: 0
                   },
                   grid: {
                       verticalLines: !0,
                       hoverable: !0,
                       clickable: !0,
                       tickColor: "#d5d5d5",
                       borderWidth: 1,
                       color: "#fff"
                   },
   
                   xaxis: {
                       tickColor: "rgba(51, 51, 51, 0.06)",
                       mode: "time",
                       tickSize: [1, "day"],
                       axisLabel: "Date",
                       axisLabelUseCanvas: !0,
                       axisLabelFontSizePixels: 12,
                       axisLabelFontFamily: "Verdana, Arial",
                       axisLabelPadding: 1
                   },
                   yaxis: {
                       ticks: 8,
                       tickColor: "rgba(51, 51, 51, 0.06)"
                   },
                   tooltip: !1
               };
               $("#newchart").length && (console.log("Plot1"), $.plot($("#newchart"), [a, b], g));
           }
   
         }, 100);

         
</script>
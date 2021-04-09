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
                     <h3>กระแสฝากถอน<small> ประจำเดือน <?php echo date('F'); ?></small></h3>
                     <a href="<?=base_url('owner/home/chart'); ?>"" class="btn  btn-sm btn-dark">::กลับไปหน้าค้นหากราฟรายเดือน</a>
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
   setTimeout(() => {  //ตัวนี้ตอนไม่ส่งเป็นกราฟตัวเดิม
           if ("undefined" != typeof $.plot) {
               for (
                 var a = [<?= $withdraw; ?>],
                     b = [<?= $deposit; ?>], f = 0; f < 30; f++);
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
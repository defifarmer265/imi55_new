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
                        <div class="col-md-6">
                              
                            <h3>ข้อมูลกราฟกระแสฝากถอนประวันที่  <?php echo date('d/m/Y ',strtotime($day));?> แบบช่วงเวลา</h3>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn" style="background-color:#6fff1e;"></button>
                            ยอดฝาก<br>
                            <button type="button" class="btn" style="background-color:#e81d1d;"></button>
                            ยอดถอน<br>
                        </div>
                        <a href="<?=base_url('owner/chart/s_chart'); ?>"" class="btn  btn-sm btn-dark">::กลับไปหน้าค้นหากราฟรายวัน</a>
                    </div>
                    <div class="col-md-12 col-sm-12 ">
                        <div class="spinner-grow text-primary text-center ml-5 " role="status" id="loadg" hidden>
                            <span class="sr-only text-center">Loading...</span>
                        </div>
                        <canvas id="chLine" height="100"></canvas>
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



setTimeout(() => {
    if ("undefined" != typeof $.plot) {
      
        // chart colors
        // 01 สีส้ม 02 สีฟ้า
        var colors = ['ffa43ecc', '#4acef0e0','#4acef0e0','#dfeffc','#dbe1cf'];

        /* large line chart */
        var chLine = document.getElementById("chLine");
        var chartData = {
            labels: ["00:00-00:59", "01.00-01:59", "02:00-02:59", "03:00-03:59", "04:00-04:59", "05:00-05:59", "06:00-06:59","07:00:07:59","08:00-08:59","09:00-09:59","10:00-10:59"
            ,"11:00-11:59","12:00-12:59","13:00-13:59", "14:00-14:59","15:00-15:59","16:00-16:59","17:00-17:59","18:00-18:59","19:00-19:59","20:00-20;59","21:00-21:59"
            ,"22:00-22:59","23:00-23:59"
                ],
            datasets: [{
                //    data: ['1000','2000','350','400','350','600','800'],
                   data: [<?= $withdraw; ?>],
                   backgroundColor: "rgba(236,123,123,0.2)",
                   borderColor: "#e81d1d",
                 
                },

                {
                   
                   data: [<?= $deposit; ?>],
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
    }

}, 100);
</script>
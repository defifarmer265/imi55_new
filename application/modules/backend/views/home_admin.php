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
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row" style="display: inline-block;">
    <div class="tile_count">
      <div class="col-md-3 col-sm-4  tile_stats_count"> <span class="count_top"><i class="fa fa-user"></i> ยูเซอร์สมัครใหม่</span>
        <div class="count">
          <?= number_format($us_td) ?>
        </div>
      </div>

      <div class="col-md-3 col-sm-4  tile_stats_count"> <span class="count_top"><i class="fa fa-user"></i> ยูเซอร์ฝากยอดแรก</span>
        <div class="count">
          <?= number_format($us_td_dp) ?>
        </div>
      </div>

      <div class="col-md-4 col-sm-4  tile_stats_count"> <span class="count_top"><i class="fa fa-users"></i> ยูเซอร์ทั้งหมด</span>
        <div class="count">
          <?= $us_all ?>
        </div>
      </div>

      <div class="col-md-3 col-sm-4  tile_stats_count"> <span class="count_top"><i class="fa fa-level-down"></i> รายการฝากวันนี้</span>
        <div class="count green">
          <?= $dp_td ?>
        </div>
      </div>

      <div class="col-md-3 col-sm-4  tile_stats_count"> <span class="count_top"><i class="fa fa-money"></i> <i class="fa fa-level-down"></i> ยอดฝากวันนี้</span>
        <div class="count">
          <?= number_format($dp_sum_td / 1000) ?>
          k</div>
      </div>
      <div class="col-md-3 col-sm-4  tile_stats_count"> <span class="count_top"><i class="fa fa-level-up"></i>รายการถอนวันนี้</span>
        <div class="count">
          <?= $wd_td ?>
        </div>
      </div>
      <div class="col-md-3 col-sm-4  tile_stats_count"> <span class="count_top"><i class="fa fa-money"></i> <i class="fa fa-level-down"></i>ยอดถอนวันนี้</span>
        <div class="count">
          <?= number_format($wd_sum_td / 1000) ?>
          k</div>
      </div>
    </div>
  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-9 col-sm-12 ">
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="col-md-12 col-sm-12 ">
            <div class="row mt-3">
              <div class="col-md-8">
                <div class="x_panel tile ">
                  <div class="x_title">
                    <h2>รายการฝากต่อธนาคาร / ต่อวัน</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <h4></h4>
                    <div class="table-responsive-sm">
                      <table class="table table-bordered">
                        <thead style="background-color: #2a3f54;color: #fff;">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">ชื่อบัญชี</th>
                            <th class="text-center">ธนาคาร</th>
                            <th class="text-center">รูป</th>
                            <th class="text-center">จำนวน</th>
                            <th class="text-center">ยอดเงิน</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $num = 0;
                          foreach ($bank_web as $rs_web) {
                            $num++;
                          ?>
                            <tr>
                              <td class="text-center"><?php echo $num; ?></td>
                              <td><?php echo $rs_web['name']; ?></td>
                              <td class="text-center"><?php echo  $rs_web['bank_short']; ?></td>
                              <td class="text-center"><img src="<?php echo base_url('public/tem_frontend/img/mapraw_icon/bank/') . $rs_web['api_id'] . '.png'; ?>" class="img-fluid" width="30px" height="30px"></td>
                              <td class="text-right"><?= @number_format($rs_web['st']); ?></td>
                              <td class="text-right"><?= @number_format($rs_web['sm']); ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mmm">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>การใช้งานลูกค้า / ต่อวัน</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive-sm">
                      <table class="table table-bordered">
                        <thead style="background-color: #2a3f54;color: #fff;">
                          <tr>
                            <th class="text-center">Platform</th>
                            <th class="text-center">จำนวนการเข้าเล่น</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                            // iPhone
                            foreach ($count_device as $datars) {
                              if ($datars['platform'] == 1) {
                            ?>
                                <td class="text-center"><img src="<?= base_url() ?>/public/img/platform1.png " width="50%"></td>
                                <td style="text-align: center;font-size: 20px;color:#1ABB9C;font-weight:600"><?php echo number_format($datars['countPlatform']); ?>
                                  <br>
                                  <p style="font-size: 10px;color: black;margin-top:0">I-Phone</p>
                                </td>
                            <?php } else {
                              }
                            } ?>
                          </tr>
                          <tr>
                            <?php
                            // iPad
                            foreach ($count_device as $datars) {
                              if ($datars['platform'] == 2) {
                            ?>
                                <td class="text-center"><img src="<?= base_url() ?>/public/img/platform2.png" width="50%"></td>
                                <td style="text-align: center;font-size: 20px;color:#1ABB9C;font-weight:600"><?php echo number_format($datars['countPlatform']); ?>
                                  <br>
                                  <p style="font-size: 10px;color: black;margin-top:0">I-Pad</p>
                                </td>
                            <?php } else {
                              }
                            } ?>
                          </tr>
                          <tr>
                            <?php
                            // PC ios
                            foreach ($count_device as $datars) {
                              if ($datars['platform'] == 3) {
                            ?>
                                <td class="text-center"><img src="<?= base_url() ?>/public/img/platform3.png" width="50%"></td>
                                <td style="text-align: center;font-size: 20px;color:#1ABB9C;font-weight:600"><?php echo number_format($datars['countPlatform']); ?>
                                  <br>
                                  <p style="font-size: 10px;color: black;margin-top:0">PC-IOS</p>
                                </td>
                            <?php } else {
                              }
                            } ?>
                          </tr>
                          <tr>
                            <?php
                            //Android
                            foreach ($count_device as $datars) {
                              if ($datars['platform'] == 4) {
                            ?>
                                <td class="text-center"><img src="<?= base_url() ?>/public/img/platform4.png" width="50%"></td>
                                <td style="text-align: center;font-size: 20px;color:#1ABB9C;font-weight:600"><?php echo number_format($datars['countPlatform']); ?>
                                  <br>
                                  <p style="font-size: 10px;color: black;margin-top:0">Android</p>
                                </td>
                            <?php } else {
                              }
                            } ?>
                          </tr>
                          <tr>
                            <?php
                            // PC windows
                            foreach ($count_device as $datars) {
                              if ($datars['platform'] == 5) {
                            ?>
                                <td class="text-center"><img src="<?= base_url() ?>/public/img/platform5.png" width="50%"></td>
                                <td style="text-align: center;font-size: 20px;color:#1ABB9C;font-weight:600"><?php echo number_format($datars['countPlatform']); ?>
                                  <br>
                                  <p style="font-size: 10px;color: black;margin-top:0">PC-Windows</p>
                                </td>
                            <?php } else {
                              }
                            } ?>
                          </tr>
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
    <div class="col-md-3 col-sm-12 ">
      <div>
        <div class="x_title">
          <h2>ฝาก ถอน</h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled top_profiles scroll-view" id="dw">
          <?php
          if ($DW != '') {
            // print_r($DW);
            foreach ($DW as $_d => $dw) {
          ?>
              <li class="media event <?php echo $dw['type'] == 'deposit' ? 'green' : 'red' ?>"> <a class="pull-left  profile_thumb"> <i class="fa fa-user "></i> </a>
                <div class="media-body row">
                  <div class="col-8"> <a class="title" href="" onClick="checkUser('<?= $dw['user'] ?>')"><?php echo $dw['username']; ?></a>
                    <p><?php echo $dw['type'] == 'deposit' ? '+' : '-' ?><strong>
                        <?= number_format($dw['amount']) ?>
                        ฿</strong> </p>
                  </div>
                  <div class="col-4"> เวลา<br>
                    <?= date('H:i น. ', $dw['time']) ?>
                  </div>
                </div>
              </li>
          <?php
            }
          } else {
            echo ' ไม่มีข้อมูล ';
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <br />
  <div class="row"> </div>
</div>
<!-- /page content -->

<script>
  setInterval(() => {

    $.ajax({
      url: 'backend/get_DW',
      type: 'POST',
      dataType: 'json',
    }).done(function(res) {
      //console.log(res);
      if (res != '') {
        var tx = ``;
        $('#dw').html('');
        $.each(res, function(key, val) {
          var date = new Date(val['time'] * 1000);
          // Hours part from the timestamp
          var hours = date.getHours();
          // Minutes part from the timestamp
          var minutes = "0" + date.getMinutes();
          // Will display time in 10:30:23 format
          var formattedTime = hours + ':' + minutes.substr(-2);
          if (val['type'] == 'deposit') {
            tx += `<li class="media event green">`;
          } else {
            tx += `<li class="media event red">`;
          }
          tx += `  <a class="pull-left  profile_thumb">
                   <i class="fa fa-user "></i>
                 </a>
                 <div class="media-body row">

                   <div class="col-8">
                     <a class="title" href="" onClick="checkUser('` + val['user'] + `')">` + val['username'] + `</a><p>`;
          if (val['type'] == 'deposit') {
            tx += `+`;
          } else {
            tx += `-`;
          }
          tx += `<strong>` + val['amount'] + ` ฿</strong> </p>

                   </div>
                   <div class="col-4">
                     เวลา<br>
                     ` + formattedTime + ` น.

                   </div>

                 </div>
               </li>`;
        });
        $('#dw').html(tx);
      } else {
        console.log("ไม่มีข้อมูล");
      }





    }).fail(function() {
      console.log("error");
    })

  }, 5000);

  function get_grah() {
  $("#loadg").removeAttr("hidden");
    $.ajax({
        url: '<?= base_url() ?>backend/get_grah',
        type: 'POST',
        dataType: 'json',
    }).done(function(res) {
      $("#loadg").attr("hidden","");
        if ("undefined" != typeof $.plot) {
            for (
              var a = [<?= $this->session->withdrawJS; ?>],
                  b = [<?= $this->session->depositJS; ?>], f = 0; f < 30; f++);
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



    }).fail(function() {
        console.log("error grah");
    })



}


function init_flot_chart() {
   
  }
  function checkUser(user) {
    alert(user)
  }
</script>
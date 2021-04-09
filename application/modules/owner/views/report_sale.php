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
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    display: none;
  }

  @-webkit-keyframes spin {
    from {
      -webkit-transform: rotate(0deg);
    }

    to {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
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

  .lds-dual-ring {}

  .lds-dual-ring:after {
    content: " ";
    display: block;
    width: 30px;
    height: 30px;
    padding-bottom: -20px;
    border-radius: 50%;
    border: 6px solid #000;
    border-color: #000 transparent #000 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }

  @keyframes lds-dual-ring {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>


<div id="cover-spin"></div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายงานเซลล์ยอดแรก<small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">

          <div class="x_content">
            <div class="col-md-12 col-sm-12">
              <div class="row">
                <div class="col-sm-3 ">
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
                <div class="col-sm-3">
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
                <div class="col-sm-1">
                  <br>
                  <button type="button" onClick="fisrt_depo()" class="btn btn-info">ค้นหา</button>

                </div>
                <br>
                <br>
                <div class="col-sm-12" style="margin: 0px auto; float: none;">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="card-box table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap text-center" width="100%" cellspacing="0" id="t_all">
                          <thead style="background-color: #2a3f54;color: #fff;">
                            <tr>
                              <th>No</th>
                              <th>Username</th>
                              <th>ชื่อเซลล์</th>
                              <th>ยอดสมัคร</th>
                              <th>ยอดแรก</th>
                              <th>น้อยกว่า 100</th>
                              <th>น้อยกว่า 300</th>
                              <th>มากกว่า 300</th>

                            </tr>
                          </thead>
                          <tbody id="report_sum" style="font-size: 16px;"> </tbody>
                          <tbody id="bodyhistory" style="font-size: 16px;"> </tbody>
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
  </div>


</div>
</div>
</div>
</div>


<!-- Modal: modalCart -->
<div class="modal fade  bd-example-modal-lg " id="modalCart1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <div class="modal-title" id="list"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">

        <div class="x_panel">
          <div class="x_title">
            <h2>กราฟเซลล์ยอดแรก</h2>
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

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalCart -->
<script type="text/javascript">
  function fisrt_depo() {

    $('#cover-spin').show();
    var d1 = $('#single_cal2').val();
    var d2 = $('#single_cal3').val();
    $('#bodyhistory').html('');
    $('#report_sum').html('');

    $('#button-block').html('');

    $.ajax({
        url: '<?= base_url() ?>owner/sale/first_depo',
        type: 'POST',
        dataType: 'json',
        data: {
          d1: d1,
          d2: d2
        },
      })
      .done(function(res) {
        console.log(res);
        // success
        $('#cover-spin').hide();
        if (res.code == 1) {

          var count = res.sale.length;
          var sale = res.sale;
          var content = '';
          var content_sum = '';
          var content2 = '<button  type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCart1" ><i class="fa fa-bar-chart" aria-hidden="true"></i> กราฟ</button>';
          var ctx = document.getElementById('myChart3');
          var content3 = '<h6> ระหว่างวันที่ ' + res.dayO + ' - ' + res.dayT + '</h6>';
          //variable 
          let number_of_register = []
          let number_of_countfirst = []
          let number_of_less = []
          let number_of_more = []
          let number_ofsalename = []




          if (count > 0) {


            var tt_count_user = 0;
            var tt_count_first = 0;
            var tt_moreee = 0;
            var tt_less = 0;
            var tt_more = 0;

            for (var i = 0; i < count; i++) {

              number_ofsalename.push(sale[i]['name'])
              number_of_countfirst.push(sale[i]['count_first'])


              content += '<tr align="center">'
              content += '<td>' + [i + 1] + '</td>'
              content += '<td>' + sale[i]['username'] + '</td>'
              content += '<td>' + sale[i]['name'] + '</td>'
              content += '<td>' + sale[i]['count_user']['user'] + '</td>'
              content += '<td>' + sale[i]['count_first'] + '</td>'
              content += '<td>' + sale[i]['moreee'] + '</td>'
              content += '<td>' + sale[i]['less'] + '</td>'
              content += '<td>' + sale[i]['more'] + '</td>'

              content += '</tr>';

              var count_user = parseFloat(sale[i]['count_user']['user']);
              tt_count_user = tt_count_user + count_user;

              var count_first = parseFloat(sale[i]['count_first']);
              tt_count_first = tt_count_first + count_first;

              var moreee = parseFloat(sale[i]['moreee']);
              tt_moreee = tt_moreee + moreee;

              var less = parseFloat(sale[i]['less']);
              tt_less = tt_less + less;

              var more = parseFloat(sale[i]['more']);
              tt_more = tt_more + more;



            }

            var content_sum = '<tr style="background-color: #d0d2d4"><th colspan="3" class="text-center">รวม</th><th >' + tt_count_user + '</th><th >' + tt_count_first + '</th><th >' + tt_moreee + '</th><th >' + tt_less + '</th><th >' + tt_more + '</th></tr>';
          }

          // console.log(number_of_register)

          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: [...number_ofsalename],
              datasets: [{
                label: 'จำนวนยอดแรก',
                backgroundColor: 'rgb(127, 179, 213)',
                data: [...number_of_countfirst]
              }],
            },

            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }],
                xAxes: [{
                  barPercentage: 1,
                  gridLines: {
                    display: false
                  },

                }]
              }
            }
          });

          $('#bodyhistory').html(content);
          $('#report_sum').html(content_sum);
          $('#button-block').html(content2);
          $('#list').html(content3);
        } else {

        }
      });
  }

</script>
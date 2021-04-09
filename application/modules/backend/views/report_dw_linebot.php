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
</style>

<div id="cover-spin"></div>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการฝาก - ถอน<small></small></h2>
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


        <div class="col-sm-2"><br>
          <button onClick="select_daily()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
        </div>
      </div>
      <hr style="height:2px;border-width:0;color:gray;background-color:gray">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_content">
          <div class="row">
            <div class="col-sm-8">
              <div class="card-box table-responsive">
                <table  id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                  <thead style="background-color: #2a3f54;color: #fff;">
                    <tr class="text-center">
                      <th> วันที่ </th>
                      <th> รายการฝาก </th>
                      <th> ยอดเงินฝาก </th>
                      <th> รายการถอน </th>
                      <th> ยอดเงินถอน </th>
                    </tr>
                  </thead>
                  <tbody id="bodysum"></tbody>
                  <tbody id="bodyhistory"></tbody>
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
<script>
  function select_daily() {
    $('#cover-spin').show();
    $('#bodyhistory').html('');
    $('#bodysum').html('');
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();

    $.ajax({
        url: '<?= base_url() ?>backend/dw_linebot/rp_us',
        type: 'POST',
        dataType: 'json',
        data: {
          dt1: dt1,
          dt2: dt2
        },
      })
      .done(function(res) {
        if (res.code == 1) {
          if (res.data.length > 0) {
            
            var conut     = res.data.length;
            var wd        = res.data;
            var content   = '';
            var tt_dp   	= 0;
						var tt_wd   	= 0;
            var tt_all    = 0;
            var tt_n_dp   = 0;
            var tt_n_wd   = 0;
            var deposit   = 0;
            var withdraw  =  0;
            var tt_total  =  0;
            for (var i = 0; i < conut; i++) {
              content += '<tr>';

              content += '<td class="text-right">'+ wd[i]['date']; +'</td>';

              var n_deposit   =  parseInt(wd[i]['num_deposit']);
              var deposit   	=  parseFloat(wd[i]['sum_deposit']);
              var n_withdraw  =  parseInt(wd[i]['num_withdraw']);
              var withdraw 	  =  parseFloat(wd[i]['sum_withdraw']);
              var tt_total    =  parseFloat(wd[i]['total']);
              
              content += '<td class="text-right">'+nb(n_deposit)+'</td>';
              content += '<td class="text-right">'+nb(deposit.toFixed(2))+'</td>';
              content += '<td class="text-right">'+nb(n_withdraw)+'</td>';
              content += '<td class="text-right">'+nb(withdraw.toFixed(2))+'</td>';

			  content += '</tr>';
					
              tt_n_dp = tt_n_dp + n_deposit;
							tt_dp   = tt_dp   + deposit;
              tt_n_wd = tt_n_wd + n_withdraw;
							tt_wd   = tt_wd   + withdraw;
							
              tt_all = tt_all + tt_total;
            }

            var sum = '<tr><td colspan="1" class="text-right">รวม</td><td class="text-right">'+nb(tt_n_dp)+'</td><td class="text-right">'+nb(tt_dp.toFixed(2))+'</td><td class="text-right">'+nb(tt_n_wd)+'</td><td class="text-right">'+nb(tt_wd.toFixed(2))+'</td></tr>';

          } else {
            var content = 'No data';
            var sum = '';
          }
          $('#bodysum').html(sum);
          $('#bodyhistory').html(content);
        } else {
          swal(res.title, res.msg, 'error');
        }
        $('#cover-spin').hide();

      })
      .fail(function() {
        console.log("error");
      });

  }
  // ====================== convert convert timstamp to dd/mm/yyyy ======================================
  function gendate(d) {
    var today = new Date(d * 1000);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    return dd + '/' + mm + '/' + yyyy;

  }

  function nb(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }
</script>
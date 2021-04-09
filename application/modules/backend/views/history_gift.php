<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>log Gift Vouher<small></small></h2>

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
          <div class="col-sm-2">
            ID : ztzz361i
            <input type="text" value="" class="form-control" id="user" maxlength="6" placeholder="รหัสลูกค้า">
            ใส่แค่ตัวเลข 6 หลัง
          </div>
          <div class="col-sm-2"><br>
            <button onClick="select_user()" class="btn btn-info">ค้นหา</button>

          </div>
        </div>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="user_data" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr class="text-center">
                        <th width="2%">No.</th>
                        <th>username</th>
                        <th>Gift voucher</th>
                        <th>เวลารับ</th>
                        <th>ผู้แจก</th>
                      </tr>
                    </thead>

                    <tbody id="bodyhistory">

                      <?php $i = 0;
                      foreach ($gift as $gf) { ?>
                        <tr>
                          <td class="text-center"><?= $i + 1; ?></td>
                          <td class="text-center"><?= $gf['user'] ?></td>
                          <td class="text-center"><?= $gf['gift_name'] ?></td>
                          <td class="text-center"><?= date('d/m/Y H:i:s', $gf['time_receive']) ?> น.</td>
                          <td class="text-center"><?= $gf['admin'] ?></td>
                        </tr>
                      <?php $i++;
                      } ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>
  $(document).ready(function() {
    $('#user_data').DataTable({
      "pageLength": 10,
      "lengthMenu": [
        [10, 20, 50],
        [10, 20, 50]
      ],
    });
  });

  function select_user() {
    $('#bodyhistory').html('');
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    var user = $('#user').val();

    $.ajax({
        url: 'select_log_gift',
        type: 'POST',
        dataType: 'json',
        data: {
          dt1: dt1,
          dt2: dt2,
          user: user
        },
      })
      .done(function(res) {
        console.log(res);
        if (res.code == 1) {
          //console.log(res);
          if (res.data.length >= 1) {
            var i = 1;
            $.each(res.data, function(index, value) {
              var html = '';
              content += '<tr>';
              content += '<td class="text-center">' + i + '</td>';
              content += '<td class="text-center">' + value.user + '</td>';
              content += '<td class="text-center">' + value.gift_name + '</td>';
              content += '<td class="text-center">' + moment.unix(value.time_receive).format("DD/MM/YYYY || HH:mm:ss") + ' น.</td>';
              content += '<td class="text-right">' + value.admin + '</td>';
              content += '</tr>';
              i++;
            });
          } else {
            var content = 'No data';
          }
          swal('', res.msg, 'success');
        } else {
          swal('', res.msg, 'error');
        }
        $('#bodyhistory').html(content);
      })
      .fail(function() {
        console.log("error");
      });


  }
</script>
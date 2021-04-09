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
    <div class="col-md-6 col-sm-6 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ค้นหารายการวงล้อ<small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="row ">
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
           <div class="col-sm-3">
                        ID : <?=$this->getapi_model->agent()?>i
                        <input type="text" value="" class="form-control" id="user" maxlength="6"
                            placeholder="รหัสลูกค้า">
                        ใส่แค่ตัวเลข 6 หลัก
                    </div>


        <div class="col-sm-2"><br>
          <button onClick="select_daily()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
        </div>
      </div>
      <hr style="height:2px;border-width:0;color:gray;background-color:gray">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_content">
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
                <table  id="tb1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                  <thead style="background-color: #2a3f54;color: #fff;">
                    <tr class="text-center">
                      <th>ลำดับ</th>
                      <th>ยูเสอร์</th>
                      <th>จำนวนพ้อย</th>
                      <th>เวลา</th>
                    </tr>
                  </thead>
                  <tbody id="bodyhistory"></tbody>
                </table> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="col-md-6 col-sm-6 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายงานวงล้อล่าสุด<small></small></h2>
        
          <div class="clearfix"></div>
        </div>
       
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">

            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead id="af_thead" style="background-color: #2a3f54;color: #fff;">
                      <tr align="center" >
                        <th width="2%" style="vertical-align: middle">No</th>
                        <th  style="vertical-align: middle">ยูสเซอร์</th>
                        <th width="5%" style="vertical-align: middle"> จำนวนพ้อย  </th>
                        <th style="vertical-align: middle"> เวลา </th>
                       
                      </tr>
                    </thead>
                    <tbody id="af_tbody">
                      <tr align="center">
                      <?php $i=1; if(!empty($point)){foreach($point as $ac){ ?>
                        <td align="center"><?=$i;?></td>
                        <td align="center"><?=$this->getapi_model->agent() . 'i' . substr(("000000" . (intval($ac['user_id']))), -6);?></td>
                          <td align="center"><?=$ac['point'];?></td>
                        <td align="center"><?=$ac['create_time'] == 0 ? '':date('d/m/Y H:i',$ac['create_time'])?></td>
                      
                   
                    
                      </tr align="center">
                      <?php $i++;  } }else{ ?>
                      <tr align="center">
                        <td colspan="7">ไม่มีข้อมูล</td>
                      </tr>
                      <?php }?>
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

<script>
    function select_daily() {
    $('#cover-spin').show();
    $('#bodyhistory').html('');
    $('#bodysum').html('');
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
     var user = $('#user').val();

    $.ajax({
        url: '<?= base_url() ?>backend/award/report_findspin',
        type: 'POST',
        dataType: 'json',
        data: {
          dt1: dt1,
          dt2: dt2,
          user:user
        },
      })
      .done(function(res) {
        $('#cover-spin').hide();
          console.log(res.data);
        if (res.code == 1) {
          if (res.data.length > 0) {
            var conut     = res.data.length;
            var wd        = res.data;
            var content   = '';
            for (var i = 0; i < conut; i++) {
            
             
              var new_date = new Date(wd[i]['create_time'] * 1000).format('d-m-Y H:i');
              content += '<tr>';
              content += '<td class="text-center">'+(i+1)+'</td>';
              content += '<td class="text-center">'+wd[i]['user_id']; +'</td>';
              content += '<td class="text-right">'+wd[i]['point'];+'</td>';
              content += '<td class="text-right">'+new_date+'</td>';
              
              content += '</tr>';
            }
    
          } else {
            var content = 'No data';
          }
          $('#bodyhistory').html(content);
           $('#tb1').DataTable();
        } else {
          swal(res.title, res.msg, 'error');
        }
        $('#cover-spin').hide();

      })
      .fail(function() {
        console.log("error");
      });

  }

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

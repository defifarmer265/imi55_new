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
          <h2>รายงานรวม <small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="row ">
          <div class="col-sm-2 ">
            เลือกวัน
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
          <div class="col-sm-2"> วันสิ้นสุด
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
            <button onClick="select_aw()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
          </div>
        </div>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-7">
                <div class="card-box table-responsive">
                  <table id="tt" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%" style="font-size: 14px;" hidden>
                    <tbody id="bodyhistory">
                      <tr>
                        <td class="text-center" width="10px;"> 1 </td>
                        <td width="250px;"> รายการแลกรางวัล </td>
                        <td class="text-right" id="sumpoint"> </td>
                        <td class="text-right" id="sum_cost"> </td>
                     
                      </tr>
                      <tr>
                        <td class="text-center" width="10px;"> 2 </td>
                        <td width="250px;"> รายการหมุนวงล้อ </td>
                        <td class="text-right" id="num_spin"> </td>
                        <td class="text-right " id="sum_spin"></td>
                      </tr>
                      <tr>
                        <td class="text-center" width="10px;"> 3 </td>
                        <td width="250px;"> รายการเครดิตปรับมือ (เพิ่ม) </td>
                        <td class="text-right" id="num_dps"> </td>
                        <td class="text-right" id="sum_dps"></td>
                      </tr>
                      <tr>
                        <td class="text-center" width="10px;"> 4 </td>
                        <td width="250px;"> รายการเครดิตปรับมือ (ลบ) </td>
                        <td class="text-right" id="num_dps_out"> </td>
                        <td class="text-right" id="sum_dps_out"></td>
                     
                      </tr>
                      <tr>
                        <td class="text-center" width="10px;"> 5 </td>
                        <td width="250px;"> รายการฝาก - ถอน </td>
                        <td class="text-right" id="sum_dep">  </td>
                        <td class="text-right" id="sum_wit"> </td>
                      </tr>

                      <tr>
                        <td class="text-center" width="10px;"> 6 </td>
                        <td width="250px;"> รายการกดรับ  Af</td>
                        <td class="text-right" id="num_af"> </td>
                        <td class="text-right" id="sum_af"> - </td>
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
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });


  function select_aw() {
    $('#cover-spin').show();
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    if (dt1 != null) {
      $.ajax({
          url: '<?= base_url() ?>backend/report_award/sel_report',
          type: 'POST',
          dataType: 'json',
          data: {
            dt1: dt1,
            dt2: dt2,
          },
        })
        .then((res) => {
          if(res.code ==1){
                $('#tt').removeAttr('hidden')
                 $('#sumpoint').html(res.data.sum_point_ex);
                 $('#sum_cost').html(res.data.sum_cost);


                 $('#num_spin').html(nb(res.data.num_spin));
                 $('#sum_spin').html(res.data.sum_point);

                
                 var sum_cr = 0;

                 $.each(res.data.sum_credit,(index,row)=>{
                     sum_cr += parseFloat(row['sum']);
                 })
                 
                 $('#num_dps').html(res.data.num_credit_in);
                 $('#sum_dps').html('ยอดรวม '+nb(sum_cr));


                 
                 var sum_out = 0;
                 $.each(res.data.sum_credit_out,(index,row)=>{
                       sum_out += parseFloat(row['rs']);
                 })
                 $('#num_dps_out').html(res.data.num_credit_out);
                 $('#sum_dps_out').html('ยอดรวม '+nb(sum_out));


                 

                 $('#sum_wit').html(res.data.sum_wit);
                 $('#sum_dep').html(res.data.sum_dep);


                //  AF
                 if(res.data.num_af ==0){
                    $('#num_af').html('-');
                 }else{
                    $('#num_af').html('จำนวนกดรับ '+ res.data.num_af);
                     $('#sum_af').html('ยอดรวม ' +nb(res.data.sum_af));
                    // console.log(res.data.sum_af);
                 }

                
                 

          }else{
            swal("Error", 'กรุณาเลือกกรอกข้อมูลทุกช่อง', 'error');
            setTimeout(function() {
              window.location.href = "<?= base_url() ?>/backend/report_award/rs_c_m/";
            }, 1000);
          }
          $('#cover-spin').hide();
        })
    } else {
      swal("Error", 'กรุณาเลือกกรอกข้อมูลทุกช่อง', 'error');
      setTimeout(function() {
        window.location.href = "<?= base_url() ?>/backend/report_award/rs_c_m/";
      }, 1000);
    }

  }

  function nb(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }

</script>
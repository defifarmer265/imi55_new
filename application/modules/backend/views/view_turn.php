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
          <h2>รายการ เทิร์น <small></small></h2>
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
            <button onClick="select_aw()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
          </div>
        </div>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-8">
                <div class="card-box table-responsive">
                  <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr class="text-center">
                        <th>วันที่</th>
                        <th>เทิร์นโอเวอร์	</th>
                        <th>ชนะแพ้ </th>
                        <th>Company</th>
                        <th>รายละเอียด</th>
                      </tr>
                    </thead>
                    <tbody id="bodyhistory2">
                    </tbody>
                    <tbody id="bodysum"></tbody>
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
  function select_aw(){
    $('#cover-spin').show();
     var dt1 = $('#single_cal2').val();
     var dt2 = $('#single_cal3').val();
     
     if(dt1 !=null && dt2 !=null){
        $.ajax({
           url: '<?= base_url() ?>backend/report_award/rs_turn',
           type: 'POST',
           dataType: 'json',
          data: {
            dt1: dt1,
            dt2: dt2
          },
        })
        .then((res)=>{
            if(res.code ==1){
                if(res.data.length >=1){
                   let content = '';
                   let sum_turn = 0;
                   let sum_amount  = 0;
                   let sum_company  = 0;
                   let url = '<?= base_url() ?>backend/report_award/rs_turn_d/';
                   $.each(res.data,(index,row)=>{
                      content += '<tr class="text-center">';
                      content += '<td><a href="'+url + row['date'] +'" style="cursor:pointer; color:black;" target="_blank">' + row['date'] + '</a></td>';
                      content += '<td>' + nb(row['sum_turn']) + '</td>';
                      content += '<td>' + nb(row['sum_amount']) + '</td>';
                      content += '<td>' + nb(row['sum_company'] )+ '</td>';
                      content += '<td><a href="' +url   +row['date'] +'"  target="_blank"> รายละเอียด</a></td>';
                      content += '</tr>';

                      sum_turn  = sum_turn + row['sum_turn'];
                      sum_amount  =  sum_amount + row['sum_amount'];
                      sum_company  =  sum_company + row['sum_company'];
                   });
                   var sum = '<tr><td  colspan="1"class="text-right">รวม</td><td class="text-center">' +nb(sum_turn)+ '</td><td class="text-center">' +nb(sum_amount) + '</td><td class="text-center">' +nb(sum_company)+'</td><td></td></tr>';
                         
                   $('#bodyhistory2').html(content);
                  $('#bodysum').html(sum);
                  $('#cover-spin').hide();
                }
            }
        })
     }else{
       alert('พังจ้า');
     }

  }
  function nb(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

</script>
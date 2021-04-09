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
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Log คำนวณปันผล Affiliate <small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
            <div class="form-group row">
						<div class="col-sm-10"> ID : <?=$this->getapi_model->agent();?>  ใส่แค่ตัวเลข 6 หลักหลัง Ex: 007805
							<input type="text" value="" class="form-control" id="user" maxlength="6" placeholder="รหัสลูกค้า">
							
						</div>
						<div class="col-sm-2"><br>
							<button onClick="search_log()" class="btn btn-info">ค้นหา</button>
						</div>
					</div>
            </div>
            <div class="row">
            
                <hr>
                <div class="col-sm-12">
                 
              
                  <hr>
                  <div style="overflow: auto; height: 600px;">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead style="background-color: #2a3f54;color: #fff;" >
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th>ยอดปันผล</th>
                                <th width="30%">วันที่กดรับล่าสุด</th>
                                <th width="30%">จากวันที่</th>
                            </tr>
                            </thead>
                            <tbody id="bodyhistory">
                            
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
    $('.table').DataTable({
      "searching": false,
      "paging": false,
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    });
    // $('#tableC').DataTable({
    //   "searching": false,
    //   "paging": false,
    //   "bPaginate": false,
    //   "bLengthChange": false,
    //   "bFilter": true,
    //   "bInfo": false,
    //   "bAutoWidth": false
    // });
    // $('#tableS').DataTable({
    //   "searching": false,
    //   "paging": false,
    //   "bPaginate": false,
    //   "bLengthChange": false,
    //   "bFilter": true,
    //   "bInfo": false,
    //   "bAutoWidth": false
    // });
  });
  // $('#sh').on('click', function() {
  //   if ($('#user').val() != '') {
  //     $('#cover-spin').show();
  //   }

  // });
  // $(window).on('load', function() {
  //   $('#cover-spin').hide();
  // });

  function search_log(){
    var u_id = $('#user').val();
    console.log(u_id);
    $('#cover-spin').show();
    $.ajax({
      url: '<?=base_url()?>backend/affiliate/search_log',
      type: 'POST',
      dataType: 'json',
      data: {u_id:u_id}
    })
    .done(function(res){
      if(res.code == 1){
        $('#cover-spin').hide();
          var content = '';
          var count = res.log_aff.length;
          if(count > 0){
            for(var i=0; i<count; i++){

            if(res.log_aff[i]['date_to'] == '' || res.log_aff[i]['date_to'] == null){
                var date_to = '-';
            }else{
                var date_time = res.log_aff[i]['date_to'];
                var date_to = new Date(date_time * 1000).format('d-m-Y H:i');
            }

            if(res.log_aff[i]['date_from'] == '' || res.log_aff[i]['date_from'] == null){
                var date_from = '-';
            }else{
                var date_time = res.log_aff[i]['date_from'];
                var date_from = new Date(date_time * 1000).format('d-m-Y H:i');
            }
            
              content +=  '<tr align="center">';
              content +=  '<td>'+[i+1]+'</td>';
              content +=  '<td>'+res.log_aff[i]['aff_turn']+'</td>'; //user
              content +=  '<td>'+date_to+'</td>'; //turnover
              content +=  '<td>'+date_from+'</td>'; // date create
              content +=  '</tr>';
            }
          }else{
            content +=  '<tr align="center">';
            content +=  '<td colspan="4"> ไม่มีข้อมูล </td>'; //no
            content +=  '</tr>';
          }
          $('#bodyhistory').html(content);
      }
    })
  }
</script>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>SALE/ <?php foreach($sale as $sl){ echo $sl['name'];}?></h2>
          <ul class="nav navbar-right panel_toolbox">

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
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
                <br>
                <button type="button" onClick="select_user_sale()" class="btn btn-info">ค้นหา</button>

              </div>

              <div class="col-sm-12">
                <br>
                <div class="card-box table-responsive">
                  <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                   <thead style="background-color:#12205F;color: #FFF">
                      <tr align="center">
                        <th width="5%"> No</th>
                        <th> รหัส </th>
						            <th> Username </th>
                        <th> ธนาคารลูกค้า </th>
                        <th> วันที่ </th>
                        <th> เซล </th>
                        <th> ยอดแรก </th>
                        <th> เครดิต </th>
                        <th> ทิกเกต </th>
                      </tr>
                    </thead>
                    <tbody id="tb_l1">
                        
                    </tbody>
                     <tbody id="tb_l2">
                        
                    </tbody>
                     <tbody id="tb_l3">
                        
                    </tbody>
                    <tbody id="tb_l">
                     <!--  <?php $i = 1; foreach ( $user_id as $_u => $us ) { ?>
                      <tr align="center">
                        <td><?php echo $i++; ?></td>
                        <?php foreach( $us['dt_user'] as $dt_u) {?>
                        <td><?php echo $dt_u['user']; ?></td>
                        <td><?php echo $dt_u['username']; ?></td>
                        <?php } ?>
                        <td>
                            <?php foreach ( $us['dt_bank'] as $bnk_u ) { ?>
                              <?=$bnk_u['account'].' '.$bnk_u['bank_short']?>
                            <?php } ?>
                        </td>
                        <td><?=$dt_u['create_time'] == 0 ? '':date('d/m/Y H:i',$dt_u['create_time'])?></td>
                        <td><?php foreach( $sale as $sl){ ?><?php echo $sl['name']; ?><?php } ?></td> 
                        <td >
                          <?php
                          if(count($us['dt_fsale']) == 0){
                             echo "0";
                          }else{?>
                             <p onclick="dt_statement('<?=$dt_u['id']?>','<?=$dt_u['user']?>')" style='cursor: pointer'><?=$us['dt_fsale'][0]['deposit']?></p>
                         <?php };
                          ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm" onClick="get_credit('<?=$dt_u['id']?>')">
                                <i class="fa fa-dollar"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='<?=base_url('backend/sale/get_ticket/')?><?=$dt_u['id']?>'">
                                <i class="fa fa-ticket"></i>
                            </button>
                        </td>
                      </tr>
                      <?php  } ?> -->
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
<!-- get user credit modal -->
<div class="modal fade" id="show_credit" tabindex="-1" role="dialog" aria-labelledby="creditLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="creditLabel">เครดิต</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
          <p style="font-size: 25px;" id="credit"></p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end user credit modal-->

<!-- Modal -->
  <div class="modal fade" id="myModal_statement" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content" role="document">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h4 class="modal-title" style="color:#000">รายการ stetement [<b id="user_sho"></b>]</h4>
          <br>
          <input type="text" id="user_state_id">
          <button type="button" class="btn btn-primary" onclick="state(1)">รายการฝาก</button><button type="button" class="btn btn-primary" onclick="state(2)">รายการถอน</button>
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>user</th>
                <th>วันที่/เวลา</th>
                <th>ฝาก</th>
                <th>ถอน</th>
              </tr>
            </thead>
            
            <tbody id="tb_list">
              
            </tbody>
          </table> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
<script>
    function dt_statement(user_state_id,user){
      $("#myModal_statement").modal();
     $('#user_sho').html(user)
     $('#user_state_id').val(user_state_id)
    }

    function state(type){
      var user_id_state = $('#user_state_id').val();
      console.log(user_id_state)
      $.ajax({
        url: '<?=base_url()?>backend/sale/get_state_user',
        type: 'POST',
        dataType: 'json',
        data: {user_id:user_id_state,type:type},
      })
      .done(function(res) {
        console.log(res);
        if(res.code == 1 ){

        }else{

        }
      })
      .fail(function() {
        console.log("error");
      })
    }
    function get_credit(user_id){
          $('#show_credit').modal();
          $.ajax({
            url: '../credit',
            type: 'POST',
            dataType: 'json',
            data: {user_id:user_id}
          })
          .done(function(res){
            $('#credit').html(res.amount);
          });
        }
    function select_user_sale() {
      var date_s = $('#single_cal2').val();
      var date_e = $('#single_cal3').val();
      date_s = moment(date_s).startOf('day').format('YYYY-MM-DD HH:mm');
      date_e = moment(date_e).endOf('day').format('YYYY-MM-DD HH:mm');
      $.ajax({
        url: '<?=base_url()?>backend/sale/get_rp_sale',
        type: 'POST',
        dataType: 'json',
        data: {id_sale: '<?=$this->uri->segment(4)?>',date_s :date_s,date_e:date_e},
      })
      .done(function(res) {
        //console.log(res);
        if(res.code == 1){
          var html = '';
          var html2 = '';
          var html3 = '';
          var html4 = '';
          var count_s3 = 0;
          var count_s1 = 0;
          var count_s0 = 0;
          if(res.data.length == 0){
            html += `
            <tr style="background-color:#ffffb3">
            <td colspan="9" class="text-center"><b>ไม่พบข้อมูล</b></td>
            </tr>`;
          }else if(res.data.length > 0){
            var i = 1;
            $.each(res.data, function(index, val) {
              //console.log(val);
              html += `
              <tr>  
              <td class="text-center">`+(i++)+`</td>
              <td class="text-center">`+val.dt_user[0].user+`</td>
              <td class="text-center">`+val.dt_user[0].username+`</td>
              <td class="text-center">`+val.dt_bank[0].account+` `+ [val.dt_bank[0].bank_short]+`</td>
              <td class="text-center" >`+moment.unix(val.create_time).format("DD/MM/YYYY HH:MM:ss")+`</td>
              <td class="text-center">`+val.name+`</td>`;
              if(val.dt_fsale.length >0){
                html += `
                        <td class="text-center">`+val.dt_fsale[0].deposit+`</td>`;
                  if(val.dt_fsale[0].deposit >= 300){
                    count_s3 = count_s3+1;
                  }else if(val.dt_fsale[0].deposit >= 100){
                    count_s1 = count_s1+1;
                  }else if(val.dt_fsale[0].deposit>=0){
                    count_s0 = count_s0+1;
                  }
              }else{
                html += `
                        <td class="text-center">0</td>`;
              }
              html += `
              <td class="text-center">
                  <button type="button" class="btn btn-secondary btn-sm" onClick="get_credit(`+val.dt_user[0].id+`)">
                  <i class="fa fa-dollar"></i>
                  </button>
              </td>
              <td class="text-center">
                  <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='<?=base_url('backend/sale/get_ticket/')?>`+val.dt_user[0].id+`'">
                  <i class="fa fa-ticket"></i>
                  </button>
              </td>
              </tr>`;

            });
            html2 += `
              <tr style="background-color:#ffffb3">
                <td colspan="6" class="text-center"><b>รวมจำนวนยูสยอดแรกมากว่า 300</b></td>
                <td colspan="3" class="text-center"><b>`+count_s3+`</b> ยูส</td>
              </tr>`;  
             html3 += `
              <tr style="background-color:#ffffb3">
                <td colspan="6" class="text-center"><b>รวมจำนวนยูสยอดแรกมากว่า 100 น้อยกว่า 300</b></td>
                <td colspan="3" class="text-center"><b>`+count_s1+`</b> ยูส</td>
              </tr>`; 
              html4 += `
              <tr style="background-color:#ffffb3">
                <td colspan="6" class="text-center"><b>รวมจำนวนยูสยอดแรกน้อยกว่า 100</b></td>
                 <td colspan="3" class="text-center"><b>`+count_s0+`</b> ยูส</td>
              </tr>`; 
          }
    
          $('#tb_l').html(html);
          $('#tb_l1').html(html2);
          $('#tb_l2').html(html3);
          $('#tb_l3').html(html4);
        }else{
          swal({
            title: "error",
            text: "ผิดพลาด",
            icon: "error",
          });
        }
      })
      .fail(function() {
        console.log("error");
      })
      
    }
</script>
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
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                   <thead style="background-color:#12205F;color: #FFF">
                      <tr align="center">
                        <th width="5%"> No</th>
                        <th> รหัส </th>
						            <th> Username </th>
                        <th> ธนาคารลูกค้า </th>
                        <th> วันที่ </th>
                        <th> เซล </th>
                        <th> เครดิต </th>
                        <th> ทิกเกต </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; foreach ( $user_id as $_u => $us ) { ?>
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
                      <?php  } ?>
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



<script>
        
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

</script>
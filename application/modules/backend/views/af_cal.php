<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายงานคำนววณเทิร์นโอเวอร์<small></small></h2>
          
          <div class="clearfix"></div>
        </div>
		
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                       <tr class="text-center">
                       <th width="5%">No</th>
                       <th >Id</th>
                         <th>ยูสเซอร์</th>
                         <th>เบอร์โทร</th>
                         <th>ยอดเครดิต</th>
                       </tr>
                     </thead>
                      <tbody id="bodyhistory">
                        <?php $i=1; if(empty($user)){ echo '<tr><td colspan="5"></td></tr>'; }else {foreach($user as $us){ ?>
                        <tr>
                          <td class="text-center"><?=$i?></td>
                          <td class="text-center"><?=$us['id']?></td>
                          <td class="text-center"><?=$us['user']?></td>
                          <td class="text-center"><?=$us['username']?></td>
                          <td class="text-center"><?=number_format($us['sale_credit'], 2)?></td>
                        </tr>
                        <?php $i++; }} ?>
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
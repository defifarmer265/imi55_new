<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการบัญชีฝาก/ <?php foreach($user as $us){ echo $us['user'];}?></h2>
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
                        <th width="2%"> No</th>
						            <th> ยอดฝาก </th>
                        <th> ยอดถอน </th>
                        <th> เลขที่บัญชี </th>
                        <th> ธนาคาร </th>
                        <th> วันที่ในระบบ </th>
                        <th> วันที่ทำรายการ </th>
						            
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach($u_state as $ds){?>
                      <tr align="center">
						            <td><?=$i++;?></td>
						            <td><?=$ds['deposit'];?></td>
                        <td><?=$ds['withdraw'];?></td>
						            <td><?=$ds['account'];?></td>
						            <td><?=$ds['bank_short'];?></td>
						            <td><?=date('d-m-Y H:i',$ds['datetime']);?></td> 
                        <!-- datecreate -->
                        <td><?=date('d-m-Y H:i',$ds['dateCreate']);?></td>
					            </tr>
                    <?php } ?>
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
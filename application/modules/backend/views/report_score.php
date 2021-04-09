<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการคะแนน</h2>
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
                        <th> User </th>
                        <th> ประเภท </th>
						            <th> แทง </th>
                        <th> ผล </th>
                        <th> รวม </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; if(!empty($ticket)) { foreach($ticket as $tk){?>
                    <tr>
                      <td><?=$i++;?></td>
                      <td><?=$tk['membername'];?></td>
                      <td><?=$tk['type'];?></td>
                      <td><?=$tk['stake'];?></td>
                      <td><?=$tk['winLoss'];?></td>
                      <td><?=$tk['sum'];?></td>
                    </tr>
                    <?php } }?>
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



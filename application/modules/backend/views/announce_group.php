<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ประกาศ<small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li> 
               <div>
                   <a href="<?php echo site_url('backend/announce')?>" class="btn btn-info" title="กลับไปหน้าก่อน" style="background-color: #2a3f54;">
                      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true" style="color:white;"></span>
                    </a>
               </div>
            </li>
          </ul>
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
                         <th>No</th>
                         <th>รหัสกรุ๊ป</th>
                         <th>ชื่อธนาคาร</th>
                         <th>กลุ่มลูกค้า</th>
                         <th>สถานะ</th>
                         <!-- <th>Reward_id</th> -->
                       </tr>
                     </thead>
                    <tbody>
                      <?php $num=0; foreach($datax as $rs_a){ $num++;?>
                        <tr class="text-center">
                           <td><?php echo $num;?></td>
                           <td><?php echo $rs_a['id'];?></td>
                           <td><?php echo $rs_a['name'];?></td>
                           <td><?php echo $rs_a['detail'];?></td>
                           <td><?php echo $rs_a['status'];?></td>
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


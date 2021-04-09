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
          <h2>รายละเอียดวงล้อ <small></small></h2>
          
         
          <div class="clearfix"></div>
        </div>
      <div class="col-md-12 col-sm-12 ">
        <div class="x_content">
          <div class="row">
            <div class="col-sm-8">
              <div class="card-box table-responsive">
                <table  id="user_data" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                  <thead style="background-color: #2a3f54;color: #fff;">
                    <tr class="text-center">
                      <th>ลำดับ</th>
                      <th>ยูสเซอร์</th>
                      <th>จำนวนพ้อยได้</th>
                      <th>วัน/เวลา</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php $point=0;  $i=1; foreach($sp as $key=>$value){?>
                      <tr class="text-center">
                        <td ><?= $i++;?></td>
                        <td><?=$this->getapi_model->agent() . 'i' . substr(("000000" . (intval($value['user_id']))), -6);?></td>
                        <td><?= number_format($value['point'],2)?></td>
                        <td><?= date('d/m/Y H:i:s',$value['create_time'])?></td>
                        <?php  $point += $value['point']; ?>
                      </tr>
                    <?php }?>
                    <!-- <tr>
                      <td colspan="2" class="text-right">รวม</td>
                      <td class="text-center"><?= $point?></td>
                      <td ></td>
                     
                    </tr> -->
                  </tbody>
                  
                </table> 
              </div>
            </div>
            <div class="col-sm-4 mt-5">
              <table  id="user_data" class="table table-striped table-bordered dt-responsive nowrap mt-1" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr class="text-center">
                        <th>รวม</th>
                        <th>จำนวนพ้อยได้</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td  class="text-right">ยอดรวม</td>
                        <td class="text-center"><?= number_format( $point ,2)?></td>
                       
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
<script>
$(document).ready(function() {
    $('#user_data').DataTable({
        "pageLength": 10,
        "lengthMenu": [
            [10, 20, 50],
            [10, 20, 50]
        ],
    });
});
</script>

   <!--ตัวดีเลย์ดาวโหลด-->
<div id="cover-spin"></div>

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>User<small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-reorder"></i> </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" onClick="open_close('1','m_creUser')">เพิ่มลูกค้า</a> </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr align="center" >
                        <th width="2%" style="vertical-align: middle">No</th>
                        <th width="2%" style="vertical-align: middle">No</th>
                        <th style="vertical-align: middle"> วันที่เวลา </th>
                        <th style="vertical-align: middle"> รหัส  </th>
                        <th style="vertical-align: middle"> Username </th>
                        <th style="vertical-align: middle; background-color:#00078C;"> เลขที่บัญชี </th>
                        <th style="vertical-align: middle; background-color:#00078C "> แบงค์ </th>
                        <th style="vertical-align: middle; background-color:#00078C"> จำนวนเงิน </th>
                        <th width="4%"> .00 </th>

                        <th style="vertical-align: middle"> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ( empty( $withdraw ) ) {

                      } else {
                        $i = 1;
                        foreach ( $withdraw as $_w => $wd ) {
                          ?>
                      <tr align="center">
                        <td ><?=$i;?></td>
                        <td ><?=$wd['id'];?></td>
                        <td ><?=date('d-m-y H:i',$wd['time'])?></td>
                        <td ><?=$wd['user']?></td>
                        <td ><?=$wd['username']?></td>
                        <td ><?=$wd['account']?></td>
                        <td ><?=$wd['bank_short']?></td>
                        <td class="text-right" ><b><?php $am1 = substr($wd['amount'],0,-3); echo number_format($am1)?></b></td>
                        <td class="text-right" ><?php
							  $am2 = substr($wd['amount'],-2);
							if($am2 == 0){
								echo '-';
							}else{
								echo $am2;
							}
							?></td>
                        <td><?php
                        if ( $wd['status'] == 6 ) {
                          ?>
                          
                          <button class="btn btn-sm btn-warning" onClick="accept('1','<?=$wd['id']?>','รีสถานะ')" title="รีสถานะ">รีสถานะ</button>
                          <button class="btn btn-sm btn-danger" onClick="accept('2','<?=$wd['id']?>','ยกเลิก')" title="ยกเลิก">ยกเลิก</button>

                          </td>
                      </tr>
                      <?php $i++;  }}} ?>
                    </tbody>
                  </table>
					<div class="row">
						
						<div class="col-12">
						<hr>
						  
                          <button class="btn btn-sm btn-warning"> รีสถานะ </button><span class="text-danger"> ** รีสถานะกลับไปเพื่อทำการโอนมือ</span><br>
                          <button class="btn btn-sm btn-danger"> ยกเลิก </button><span class="text-danger"> ** รายการถูกโอนแล้วและถูกหักในบัญชีแล้ว</span><br>
						  
						</div>
					</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--modal-->


<script>

function accept(status,wd_id,type){

	swal({
		  title: 'ยืนยันการทำรายการ  '+type,
		  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: 'wdupdate',
					type: 'POST',
					dataType: 'json',
					data: {
						status:status,
						wd_id:wd_id,

						  },
				}).done(function(res) {
					if (res.code == 1) {
						swal({
						  icon: "success",
						  text: res.msg,
						});
						setTimeout(function(){location.reload(); },2000);
					}else if (res.code == 2) {
						swal({
						  icon: "success",
						  text: "ระบบไม่สมบูรณ์ ".res.msg,
						});
						setTimeout(function(){location.reload(); },2000);
					}else{
						swal({
						  icon: "error",
						   text: res.msg,
						});
					}
				});
			}else{
				
			}
			
		});
}


</script>
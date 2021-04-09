<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<style>
#cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
}

@-webkit-keyframes spin {
	from {-webkit-transform:rotate(0deg);}
	to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}

#cover-spin::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:black;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}</style>


<div class="right_col" role="main" st>
  
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
			  <div id="cover-spin"></div>
            <h2>ธนาคารลูกค้า<small>(อนุญาตธนาคาร)</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="col-md-12 col-sm-12 ">
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
					<span class="red ">**ระบบจะยืนยันเฉพาะธนาคารลูกค้าที่ทำรายการเพิ่มมามากกว่า 1 บัญชีเท่านั้น</span>
                  <div class="card-box table-responsive">




                  	 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 15px;">
                      <thead style="background-color: #2a3f54;color: #fff;">
                        <tr align="center">
                         <th width="3%" >No</th>
				        <th width="10%">รหัส</th>
				        <th width="10%">รหัส</th>
				        <th width="20%">ชื่อบัญชี</th>
				        <th width="10%">เลขที่บัญชี</th>
				        <th width="5%">ธนาคาร</th>
				        <th width="20%">ชื่อเต็ม</th>
				        <th class="bg_td_l_deposit">ชื่อลูกค้า</th>
				        <th class="bg_td_l_deposit">สถานะ</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
	        if ( empty( $user_bank ) ) {
	          ?>
	       <!--  <tr>
	          <td colspan="9" style="background-color:#FFFF99"><center>
	              No data
	            </center></td>
	        </tr> -->
	        <?php
	        } else {
	          $i = 1;
	          foreach ( $user_bank as $key => $ub ) {
	          	?>

	        <tr align="center" <?=$ub['status']==2?'style="background-color: #A3FDFF"':''?>>
		        <td data-title="No" class="numeric" ><?php echo $i;?></td>
		        <td data-title="รหัส" class="numeric" align="left"><?=$ub['username']?></td>
		        <td data-title="รหัส" class="numeric" align="left"><?=$ub['user']?></td>
		        <td data-title="ชื่อบัญชี" class="numeric" align="left"><?=$ub['name']?></td>
		        <td data-title="เลขที่บัญชี" class="numeric"><?=$ub['account']?></td>
		        <td data-title="ธนาคาร" class="numeric"><?=$ub['bank_short']?></td>
		        <td data-title="ชื่อเต็ม" class="numeric"><?=$ub['bank_name']?></td>
				<td data-title="ชื่อลูกค้า" class="numeric">
					  <?php
						
						if($ub['name'] == ''){
						?><button class="btn" onClick="check_acc('<?=$ub['account']?>','<?=$ub['api_id']?>','<?=$ub['id']?>')">Check</button> <?php 
						}else if($ub['name'] != '' && $ub['status'] == 1){
							echo '<span  class="fa fa-check" style="color:#45FD43;" ></span>';
						}else{
							echo '<span  class="fa fa-remove" style="color:#E92F33;" ></span>';
						}

					  ?>
				</td>
	          	<td data-title="สถานะ" class="numeric">
				  <?php 
				  	if($ub['status'] == 0){
						echo '<a href="#" onClick="edit_status('.$ub['id'].',1)" ><span  class="fa fa-remove" style="color:#E92F33;" ></span></a>';
					}else if($ub['status'] == 1){
						echo '<a href="#" onClick="edit_status('.$ub['id'].',0)" ><span  class="fa fa-check" style="color:#45FD43;" ></span></a>';
					}else if($ub['status'] == 2){
						echo '<a href="#" onClick="edit_status('.$ub['id'].',0)" ><span  class="fa fa-trash" style="color:#E92F33;" ></span></a>';
					}else{
						echo 'Status Error';
					}
				  ?>
			  	</td>
        	</tr>
        	<?php $i++; } } ?>
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
    $('#my-table').DataTable();
    $('#refresh').click(function() {
      $("#my-table").load(" #my-table");
      return c = 60 ; 
    });

    //doSomething ();
 });
	function edit_status(bank_id,status){
		swal({
			title: "ต้องการเปลี่ยนสถานะ?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "bank_user/edit_status",
					type: 'post',	
					data: { bank_id: bank_id,status:status},
					dataType: "json",
					success: function(res) {
						if (res.status == 1) {
							swal({
                                icon: 'success',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})

						}else{
							swal({
                                icon: 'error',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}


function check_acc(acc,api_id,bank_id){
		swal({
			title: "เช็คชื่อลูกค้า",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			$('#cover-spin').show(0);
			if (willDelete) {
				$.ajax({
					url: "bank_user/check_acc",
					type: 'post',	
					data: { 
						acc: acc,
						api_id:api_id,
						bank_id:bank_id
					},
					dataType: "json",
					success: function(res) {
						$('#cover-spin').hide(0)
						if (res.status == 1) {
							swal({
                                icon: 'success',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})

						}else{
							swal({
                                icon: 'error',
                                title: res.msg,
                            })
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	
}
	
	
	
	
	
</script>
<style>
.block {
    border: 1px solid red;
    text-align: center;
    vertical-align: middle;
}
.circle {
    border: 2px solid #FFFFFF;
    background: rgba(60,72,76,1.00);
    border-radius: 200px;
    color: white;
    height: 180px;
    font-weight: bold;
    width: 180px;
    display: table;
    margin: 20px auto;
}
.circle p {
    vertical-align: middle;
    display: table-cell;
}
.square {
    border: 2px solid #FFFFFF;
    background: rgba(255,255,255,0.00);
    border-radius: 200px;
    color: white;
    position: relative;
    width: 100%;

}
.square:after {
    vertical-align: middle;
    content: "";
    display: block;
    padding-bottom: 100%;
}
.content {
    vertical-align: middle;
    position: absolute;
    width: 100%;
    height: 100%;
}
.img_icon {
    padding-top: 25%;
}
	.text_icon{
		padding-top: 9%;
		font-size: 16px;
		white-space: nowrap;
	}
</style>
<!--NAV-->
<!-- CONTACT-->
<header class="masthead bg-primary text-white text-center" style="" id="tap_contact">
  <div class="container">
    <div class="row" style="font-size: 14px;">
      <div class="col-12" align="left" style="padding-left: 20px;padding-top: 20px;">
		  <span>รหัสลูกค้า :</span>
		  <span ><?=$this->session->member->user?></span><br>
        <span>ธนาคาร : </span>
        <span >
        <?php
//        if ( $bankUser == '' ) {
          ?>
        <a href="#" onClick="createBank()" title="Add Bank User" style="font-size: 12px">
        <li class="fa fa-university"></li>
        คลิก!! เพิ่มธนาคาร</a>
        <?php
//        } else {
//          echo $bankUser;
//        }
        ?>
        </span>
		  
		  
		</div>
    </div>
    <div class="container d-flex align-items-center flex-column">
      <div class="row">
        <div class="col-4 ">
          <div class="circle"  onClick="javascript:window.location.href='member/report_state'">
            <p> <span style=" font-weight: 300;">ยอดเครดิตที่ใช้ได้</span> <br>
              <span style=" font-weight: 300;font-size: 18px;letter-spacing:2">
                <?=$credit?>
              </span><br>
              <span style=" font-weight: 300;">เครดิต</span> </p>
          </div>
        </div>
      </div>
      <span style="font-weight: 300;font-size: 12px;text-align: center;letter-spacing:2px;margin-top: -25;cursor: pointer" >
      <li style="font-size: 10px;" class="fa fa-refresh " onClick="location.reload()"></li>
      <?=date('H:i:s');?>
      </span><br>
      <div class="row" style="width: 100%;">
        <div class="col-3" onClick="javascript:window.location.href='member/deposit'">
          <div class="square" >
            <div class="content" > <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/deposit.png" width="50%" class="img_icon"> </div>
          </div>
          <div class="text_icon">ฝาก</div>
        </div>
        <div class="col-3" onClick="javascript:window.location.href='member/withdraw'">
          <div class="square" >
            <div class="content" > <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/withdraw.png" width="50%" class="img_icon"> </div>
          </div>
          <div class="text_icon">ถอน</div>
        </div>
		  <div class="col-3" onClick="javascript:window.location.href='member/report_state'">
          <div class="square" >
            <div class="content" > <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/report_money.png" width="50%" class="img_icon"> </div>
          </div>
          <div class="text_icon">ข้อมูล</div>
        </div>
        <div class="col-3" onClick="javascript:window.location.href='report'" >
          <div class="square">
            <div class="content"> <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/report_game.png" width="50%" class="img_icon"> </div>
          </div>
          <div class="text_icon">MyBet</div>
        </div>
		  
        
		  
      </div>
      <div class="row" style="width: 100%;">
<!--	onClick="closer()" 	-->
        <div class="col-3" onClick="javascript:window.location.href='games/spin'" >
          <div class="square" >
            <div class="content" > <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/slot.png" width="50%" class="img_icon"> </div>
          </div>
          <div class="text_icon">กิจกรรม</div>
        </div>
<!--		  onClick="javascript:window.location.href='games/point'"-->
		  
        <div class="col-3" onClick="javascript:window.location.href='games/point'">
          <div class="square" >
            <div class="content" > <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/point.png" width="50%" class="img_icon"> </div>
          </div>
          <div class="text_icon">คะแนน</div>
        </div>

        <div class="col-3" onClick="javascript:window.location.href='checkin/index'">
          <div class="square" >
            <div class="content" > 	
			        	<img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/checkin.png" width="50%" class="img_icon">
			       </div>
          </div>
          <div class="text_icon">เช็คอิน</div>
        </div>

        <div class="col-3" onClick="javascript:window.location.href='announce/announce'">
          <div class="square" >
            <div class="content" > <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/aleat.png" width="50%" class="img_icon"> </div>
          </div>
          <div class="text_icon">ประกาศ</div>
        </div>
      
    </div>
  </div>
</header>
<!--Modal-->
<div class="modal fade"  id="m_bankUser" role="dialog">
  <div class="modal-dialog" > 
    
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title">Add Account</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding: 25px !important">

          <div class="col-md-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-university"></i></span> </div>
              <select class="form-control" id="bank_id" >
                <?php
                foreach ( $bank as $bnk ) {
                  ?>
                <option  value="<?=$bnk['id']?>">
                <?=substr($bnk['bank_th'],18).' ['.$bnk['bank_short'].']'?>
                </option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-money-bill-alt"></i></span> </div>
              <input type="number" class="form-control" id="account" placeholder="Account number"  >
            </div>
            <small style="display: none;color:#F36C6E;" id="ale_account"> ** กรุณาเลขที่บัญชีให้ถูกต้อง </small> </div>

      </div>
      <div class="modal-footer">
        <button  id="btn_createUser" onClick="createBankUser()"  class="btn btn-outline-dark" ><i class="fa fa-university"></i> Add Bank</button>
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Modal setting-->
<div class="modal fade"  id="m_setting" role="dialog">
  <div class="modal-dialog" > 
    
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title">Setting</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding: 25px !important">
        <div class="row">
          <div class="col-6">
            <div class="input-group">
              <button class="btn btn-outline-dark">แก้ไขรหัสผ่าน</button>
            </div>
          </div>
          <div class="col-6">
            <div class="input-group">
              <button class="btn btn-outline-dark">ลงทะเบียนไลน์</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>

<!-- Copyright Section-->

<!-- Bootstrap core JS--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="<?php echo base_url()?>public/tem_admin/swal/sweetalert.min.js"></script> 
<script>

</script> 
<script>
function createBank()
	{
		alert(5555)
//		$('#m_bankUser').modal();
	}
function createBankUser()
	{
		var account = $('#account').val();
		var bank_id = $('#bank_id').val();
		$.ajax({
		   url: 'member/createbankUser',
		   type: 'POST',
		   dataType: 'json',
		   data: {account:account,bank_id:bank_id},
		 })
			.done(function(res) {
			// success
			if (res.code == 1) {
				swal(res.title, res.msg, "success")
					.then(function(sw){
						$('#cover-spin').show();
                        setTimeout(function(){
                            $('#cover-spin').hide();
                            window.location.href = "member";
                        },2000);
					}); 
			//ระบบมีปัญหา
			}else{
				swal(res.title, res.msg, "error")
					.then(function(sw){
						location.reload();
					});
			}
			});
	}
// function checkin()
// 	{
// 		$.ajax({
// 			   url: 'member/checkin',
// 			   type: 'POST',
// 			   dataType: 'json',
// 			 })
// 			.done(function(res) {
// 				// success
// 				if (res.code == 1) {
// 					 swal(res.title,res.smg, "success")
//                     .then(function(sw){
//                         $('#cover-spin').show();
//                         setTimeout(function(){
//                             $('#cover-spin').hide();
//                             window.location.href ="home";
//                         },1000);
//                     }); 
// 				}else{
// 					swal('ผิดพลาด','กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
//                     .then(function(sw){
//                         location.reload();
//                     });
// 				}
// 			});
		
// 	}
function closer()
	{
		swal('ปิดปรับปรุง','', "error");
		
	}
function logout()
	{swal({
			  title: 'คุณต้องการออกจากระบบ?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
			   url: 'member/logout',
			   type: 'POST',
			   dataType: 'json',
			 })
			.done(function(res) {
				// success
				if (res.code == 1) {
					 swal(res.title, res.msg, "success")
                    .then(function(sw){
                        $('#cover-spin').show();
                        setTimeout(function(){
                            $('#cover-spin').hide();
                            window.location.href ="home";
                        },1000);
                    }); 
				}else{
					swal(res.title, res.msg, "error")
                    .then(function(sw){
                        location.reload();
                    });
				}
			});
			}else{
				
			}
			
		});
		

	}
</script> 


    <div class="d-flex justify-content-center mt-0 mt-md-3 pb-5"  style="padding-top: 70px;">
        <div class="container col-16" style="padding-right: 2px;">
            <div class="row d-flex flex-column justify-content-center align-items-center">
                <div class="section-1 col-16 col-md-10 col-lg-8 pb-2" style="box-shadow: 1px 4px 3px 0px rgb(239 255 0 / 30%);">
                    <div class="container d-flex flex-column justify-content-center align-items-start mt-3">
                          <div class="container">
    <div class="sc-fzqPZZ gLiaon">
        <div style="text-align: center;">
           <b style="font-size: 1.5em;color: #ccff00;text-align: center;">บัญชีสำหรับฝากอัตโนมัติ</b>
        </div>
        <div style="text-align: center; font-size: 18px; margin-bottom: 15px; color: rgb(255, 255, 255);">
          ***  ระบบอัตโนมัติจะจับจากบัญชีนี้เท่านั้น  
          นอกเหนือจากบัญชีนี้ระบบจะทำการโอนคืน เจ้าของบัญชีอัตโนมัติภายใน 1 อาทิตย์
      </div>
       

  <div class="col-16 px-0 d-flex">
    <a onClick="showbank();" class="btn btn-treasure-link col" style="background-color: #000;">
      <b style="font-size: 1.2em;color: #ccff00">ฝากจาก : <?=$bankUser?> คลิก !!</b>
    </a>
  </div>




        <div id="bankweb_"  style="display: none;"> 
    <div class="row" style="padding: 20px;"  >
    <?php 
      if($bankWeb != ''){
        foreach($bankWeb as $_w=>$bw){
    ?>
     <div class="col-3">
      <!-- <img onClick="showBank('<?=$bw['id']?>')" src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/bank/<?=$bw['api_id']?>.png" width="100%" class="img_icon">
      <br>
      โอนเข้า -->
      </div>
    <?php
        }
      }else{
        echo 'กรุณาติดต่อพนักงานเพื่อขอเลขที่บัญชีโอนเงิน';
      }
    ?>

     <?php 
      if($bankWeb != ''){
        foreach($bankWeb as $_w=>$bw){
    ?>


<!-- <div class="section-2 col-16 px-0 py-3 d-flex flex-column justify-content-center align-items-center">
  <input type="text" class="form-control" id="bankWeb_account<?=$bw['id']?>" readonly value="<?=$bw['account']?>" hidden>
  <div class="col-16 px-0 d-flex">
    <a onClick="copyAccount('<?=$bw['id']?>')" class="col-12 pl-0 btn-deposit">
      <button class="col text-white btn btn-success font-weight-bold font-1-5 box-shadow-unset playnow"><img onClick="showBank('<?=$bw['id']?>')" src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/bank/<?=$bw['api_id']?>.png" width="10%" class="img_icon"><b style="font-size: 0.7em;color: #000">Account name:<br><?=$bw['name']?></b></button>
    </a>
   
    <a onClick="copyAccount('<?=$bw['id']?>')" class="col-4 pr-0 btn-withdraw">
      <button class="col text-white btn btn-danger font-weight-bold font-1-5 box-shadow-unset playnow"><b style="font-size: 0.7em;color: #ccff00;padding-bottom: 10px;">คัดลอก<br>เลขที่บัญชี</b></button>
    </a>
  </div>
  <div class="col-16 px-0 d-flex">
    <a onClick="copyAccount('<?=$bw['id']?>')" class="btn btn-treasure-link col">
      <b style="font-size: 1.3em;color: #ccff00">Account Number:<br> <?=$bw['account']?></b>
    </a>
  </div>
</div>


</div>

 -->










<style type="text/css">
  .Component161{
    width: 100%;
  }.bank{
    width: 100%;
  }.Rectangle62{
    width: 100%;
  }
</style>



 <div  class="container"  style="background-image: url(<?php echo $this->config->item('tem_frontend'); ?>img/Path184.png);padding-top: 20px;padding-bottom: 20px;background-repeat: no-repeat;
    background-size: 100% 100%;">
 <b style="padding-left: 10px;padding-top: 55px;color: #fff;font-size: 20px;"><?=$bw['bank_th']?></b><br>
<div style="width:2%; display:inline-block;font-size: 12px;">
  <img class="Rectangle62"  src="<?php echo $this->config->item('tem_frontend'); ?>img/Rectangle62.png" style="width: 100%;">
</div><div style="width:35%; display:inline-block;font-size: 12px;text-align: left!important;">
   
    <b style="padding-left: 10px;padding-top: 55px;color: #fff;font-size: 16px;">เลขบัญชี</b>


  </div><div style="width:1%; display:inline-block;font-size: 12px;margin-top: -10px;"></div><div style="width:2%; display:inline-block;font-size: 12px;margin-top: -10px;">
  <img  class="Rectangle62" src="<?php echo $this->config->item('tem_frontend'); ?>img/Rectangle62.png" style="width: 100%;margin-top: -20px;">
</div><div style="width:33%; display:inline-block;font-size: 12px;text-align: left!important;padding-top: 15px;">
    <b style="padding-left: 10px;color: #fff;font-size: 16px;">ชื่อบัญชี</b>
</div><div style="width:18%; display:inline-block;font-size: 12px;margin-top: -10px;"><img class="bank" onClick="showBank('<?=$bw['id']?>')" src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/bank/<?=$bw['api_id']?>.png" style="width: 100%;margin-top: -15px;padding-bottom: 5px;"></div><div style="width:100%; display:inline-block;font-size: 12px;text-align: left!important;background-image: url(<?php echo $this->config->item('tem_frontend'); ?>img/Rectangle63.png);padding-top: 11px;padding-bottom: 11px;background-repeat: no-repeat;background-size: 100% 100%;">
    <b style="padding-left: 15px;padding-top: 15px;font-size: 15px;color: #fff;"><?=$bw['account']?> </b>
    <input type="text" class="form-control" id="bankWeb_account<?=$bw['id']?>" readonly value="<?=$bw['account']?>" hidden>
    <b style="padding-left: 20px;padding-top: 15px;font-size: 15px;color: #fff;"> <?=$bw['name']?></b>
</div><div style="width:50%; display:inline-block;font-size: 12px;text-align: left!important;">
   

</div><div style="width:50%; display:inline-block;font-size: 12px;text-align: left!important;padding-top: 15px;">
    <img class="Component161"  onClick="copyAccount('<?=$bw['id']?>')" src="<?php echo $this->config->item('tem_frontend'); ?>img/Component161.png" style="width: 10%;">
</div>
 </div>

<hr style="border-top: 1px solid #1700FF!important;padding-right: 20px;width: 93%;margin-top: 10px;margin-bottom: 10px;">


    <?php
        }
      }
    ?>
    
    </div>
      </div>
           </div>

  </div>

                    </div>




                </div>
            </div>
        </div>

    <div class="row my-5 pb-5"></div>








<!--Modal-->
<div class="modal fade" id="bank_main">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
    <a href="#" class="close" data-dismiss="modal" ><i class="fa fa-remove"></i></a>
  </div>
      <div class="modal-body">
            <input type="hidden" value="<?=$bank_main->status?>" id="maint_status">
            <input type="hidden" value="<?=$this->session->bankmain?>" id="maint_sess">
			<!-- <input type="hidden" value="1" id="maint_id"> -->
           <div class="text-center">
              <img id="img_alert" src="" width="90%"> 
           </div>
      </div>
        <div class="modal-footer">
            <label>
   <input type="checkbox" class="checkbox" value="1" id="close_bankmain" >
                ไม่แสดงอีก</label>
  </div>
      </div>
    </div>
  </div>

<!-- Copyright Section-->
<!-- Bootstrap core JS--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url()?>public/tem_admin/swal/sweetalert.min.js"></script> 
<script>

</script> 
<script>
$(document).ready(function() {
var maint_status = $('#maint_status').val() ;
var maint_sess = $('#maint_sess').val() ;
    var user_id = $('#iduser').val();
    $('#img_alert').html('');
    $.ajax({
			   url: '<?=base_url()?>users/member/check_alert',
			   type: 'POST',
			   dataType: 'json',
			 })
			.done(function(res) {
				// success
				if (res.code == 1) {
          var dt = new Date();
          var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
          var content = '';
          
          if(res.data.length > 0){
            
            for(var i=0; i < res.data.length; i++){
              if(maint_status == 1){
                if(maint_sess != 1){
                  if(res.data[i]['bank_alert'] != ''){
                    if(time > res.data[i]['bank_alert'][0]['start_time'] && time < res.data[i]['bank_alert'][0]['end_time']){
                      var img_alert = '<?=$this->config->item('tem_frontend')?>img/maintenance/bank_maintenance/'+res.data[i]['bank_alert'][0]['img'];
                      console.log(img_alert)
                      document.getElementById("img_alert").src = img_alert;

                      $('#bank_main').modal('show');
					
                    }

                    
                  }
                       
                
                }
                
            } 
            
            } 
          }

          // $('#img_alert').html(img_alert);
				}else{
					
				}
			});
    //set initial state.
	  var id = $('#maint_id').val();
    $('#close_bankmain').val(this.checked);

    $('#close_bankmain').change(function() {
        if(this.checked) {
            var returnVal = confirm("ต้องการปิดประกาศ !!");
            $.ajax({
               url: '<?=base_url()?>users/member/close_bankmain',
               type: 'POST',
               dataType: 'json',
               data: {id:id}
             });
            
        }
        $('#textbox1').val(this.checked);        
    });
});
function showBank(bankWeb_id)
	{
		$('#bankWebShow'+bankWeb_id).show();
	}
function showbank(){
	$('#bankweb_').show();
}
function logout()
	{
		$.ajax({
			   url: 'member/logout',
			   type: 'POST',
			   dataType: 'json',
			 })
			.done(function(res) {
				// success
				if (res.code == 1) {
					 swal(res.titel, res.msg, "success")
                    .then(function(sw){
                        $('#cover-spin').show();
                        setTimeout(function(){
                            $('#cover-spin').hide();
                            window.location.href ="home";
                        },1000);
                    }); 
				}else{
					swal(res.titel, res.msg, "error")
                    .then(function(sw){
                        location.reload();
                    });
				}
			});

	}
function copyAccount(bankWeb_id) {
  var copyText = $('#bankWeb_account'+bankWeb_id).val();
	var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(copyText).select();
  document.execCommand("copy");
  $temp.remove();
	swal("Coppy Success");
}
</script> 

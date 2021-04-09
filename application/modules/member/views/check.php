<?php
   $id = $this->session->member->id;
   $count_month = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
?>
<style>
/* .glow-on-hover {
  width: 220px;
  height: 50px;
  border: none;
  outline: none;
  color: #fff;
  cursor: pointer;
  position: relative;
  z-index: 0;
  border-radius: 10px;
} */
.glow-on-hover:before {
  content: '';
  background: linear-gradient(45deg, #4b4a15, #e4bb52, #bf8434, #ffe782, #ffde69, #c6791b, #ee9201, #f2a114, #fce675);
  /* background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #fce675); */
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing 20s linear infinite;
  opacity: 0.8;
  transition: opacity .3s ease-in-out;
  border-radius: 10px;
}
.glow-on-hover:active {
  color: #000
}
.glow-on-hover:active:after {
  background: transparent;
}
.glow-on-hover:hover:before {
  opacity: 1;
}
.glow-on-hover:after {
  z-index: -1;
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  /* background: linear-gradient(50deg, #4b4a15, #e4bb52, #bf8434, #ffe782, #ffde69, #c6791b, #ee9201, #f2a114, #fce675); */
  /* background: #000000d4; */
  /* background: #bf8434; */
  background: linear-gradient(180deg, rgb(76, 71, 58) 0%, rgb(254, 220, 103) 100%);
  left: 0;
  top: 0;
  border-radius: 10px;
}
.box-row{
   border: 1.180rem dotted #eaeaea !important;
    box-shadow: 0 0 5px 2px #fbdf6a;
    border-radius: 11px;
    background-color: #cc963e;
   
}

.btn-gold{
    color: #fff;
    background-color: #926b1d;
    border-color: #fee072;
    box-shadow: 0 0 5px 5px #f1c556;
}
.btn-gold:hover{
   background-color: #f19d0f;
}
@keyframes glowing {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}
  .col-sm-2{
     flex: 0 0 14.066667%; 
    /* flex: 0 0 16.666666666%; */
    max-width: 16.6666666667%;
   
  }
  @media only screen and (max-device-width: 480px), only screen and (min-device-width: 560px) and (max-device-width: 1136px) and (-webkit-min-device-pixel-ratio: 2) {
    .col-3{
      flex: -1 0 21%;
      max-width: 20%;
    }
  }
</style>
<header class="masthead text-white text-center container"  id="tap_contact">





   <div class="container  mt-1 box-row" style="margin-top: 5rem !important;">
     <?php foreach($query as $data){ $status = $data['status'];?>
      <?php if($status == 1){?>
      <div class="row" style="margin-right: -.9rem; margin-left: -0.4rem;">
         <div class="col-12 mb-2">
            <label  class="text-left" style="font-size:20px;color: #eaeaea;font-weight: lighter;">
               <div class="row">
                  <div class="col-12" >
                    <img class="img-fluid myimg" src="<?= $this->config->item('tem_frontend');?>img/checkin/head-check-in.png">
                     
                  </div>
                  <div class="col-12 mx-auto btn-block text-center">
                        <?php if($checkin == 1){?>
                         <div onclick="check()" id="check" value="<?php echo $id;?>"  class="btn btn-sm btn-gold" style="font-size:14px; box-shadow: 0 0 5px 5px #71c785;">
                         <i class="fa fa-calendar" aria-hidden="true"></i> เช็คอินประจำวัน</div>
                        <?php }else{?>
                           <div class="btn btn-sm btn-gold" onclick='checkalert()'; style="font-size:14px;">
                              <i class="fa fa-calendar" aria-hidden="true"></i> เช็คอินเรียบร้อย</div>
                        <?php } ?>
                  </div>
               </div>
            </label>
         </div>
         <div class="row mx-auto">
         <?php for($i=1; $i<=$count_month; $i++){?>
         <div class="col-3  col-sm-2  shadow border" style="background-color: #eceded; font-size:14px; border: .125rem solid #f3d84f !important;padding:2px !important;box-shadow: 0 0 5px 2px #ffffff;">
            <?php   
               $date = strtotime(date('Y-m-').$i.''); // วันที่ loop
               $datenow  = strtotime(date('Y-m-d'));//วันที่ปัจจุบัน
               // ถ่าเลยวันเช็คอินให้ขึ้นสีแดง
               $pointt = $this->db->where('user_id',$this->session->member->id)->where('DATE(FROM_UNIXTIME(tb_point.create_time+25200))',date('Y-m-').$i)->where('type','checkin')->get('tb_point')->num_rows();
              //  $pointt = $this->db->where('user_id',$this->session->member->id)->where('DATE(FROM_UNIXTIME(tb_point.create_time+25200))',date('Y-m-').$i)->get('tb_point')->num_rows();
               if($datenow > $date){
               ?>
            <?php if($pointt == 1){?>
               <!-- กรณีที่ล็อกอินวันไปแล้ว -->
               <img  src="<?=$this->config->item('tem_frontend'); ?>img/checkin/ck<?php echo $i.'.png'?>" width="100%" class=" img-fluid"><br>
               <!-- <span class="text-success"> วันที่ <?php echo $i;?> </span> -->
               <?php }else{?>
               <!-- กรณีที่ได้เลยวันที่ล็อกอิน -->
               <img  src="<?=$this->config->item('tem_frontend'); ?>img/checkin/nocheck<?php echo $i.'.png'?>" width="100%" class=" img-fluid" title="เลยกำหนดวันเช็คอินแล้ว"><br>
               <!-- <span class="text-danger" title="เลยกำหนดวันเช็คอินแล้ว"> วันที่ <?php echo $i;?> </span>  -->
               <?php }?>

            <?php }else{ ?>

            <!-- ถ้าวันนี้ตรงกับวันที่ปัจจุบัน ให้เราเงือนไข check  -->
            <?php  if($datenow >= $date){?> 
            <?php if($pointt == 1){?> 
            <!-- กรณ๊ได้เช็คอินไปแล้ว -->
            <img   src="<?=$this->config->item('tem_frontend'); ?>img/checkin/ck<?php echo $i.'.png'?>" width="100%" class=" img-fluid" title="เช็คอินเรียบร้อยแล้ว"><br>
              
               <?php }else{?>
               <!-- กรณียังไม่ได้เช็คอิน -->
               <img    src="<?=$this->config->item('tem_frontend'); ?>img/checkin/<?php echo $i.'.png'?>" width="100%" class=" img-fluid"title="ถึงเวลาเช็คอินแล้ว"><br>
               <?php }?>

            <!-- ถ้าวันที่ปัจจุบัน  -->
            <?php }else{?>
              <img   src="<?=$this->config->item('tem_frontend'); ?>img/checkin/<?php echo $i.'.png'?>" width="100%" class=" img-fluid" title="ยังไม่ถึงกำหนดวันที่เช็คอิน"><br> 
            <?php }?>
            <?php }?>
         </div>  
         <?php }?>
         </div>  
      <?php }else{?>
         <img src="<?php echo base_url('public/tem_frontend/img/mapraw_icon/comingsoon.png');?>"class="mt-2" width="100%">
      <?php } ?>
      <?php }?>
      </div><!--end row-->
     
   </div> <!-- end container-->
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="<?php echo base_url()?>public/tem_admin/swal/sweetalert.min.js"></script> 
<script>
   function check()
   {
     var id = $('#check').attr('value');
     var date_id = $('#date_id').attr('value');
     
     $.ajax({
        url: '<?php base_url()?>checkin',
        type: 'POST',
        dataType: 'json',
        data:{id:id},
   })
     .done(function(res) {
   // success
   if (res.code == 1) {
   swal(res.title,res.smg, "success")
           .then(function(sw){
             $('#cover-spin').show();
             setTimeout(function(){
                 $('#cover-spin').hide();
                  window.location.href ="";
                 },1000);
             }); 
   }else{
    swal('ผิดพลาด','กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                   .then(function(sw){
                       location.reload();
                   });
   }
   });
   }
   function checkalert(){
      swal('ผิดพลาด','คุณได้ทำการเช็คอินเรียบร้อยแล้วกรุณารอวันถัดไป', "error")
   }

</script>
<style>
   .disabled{
        /* display:block !important;
        text-align: center; */
   }
  
   .head{
      /* padding-top: calc(6rem - 10px) !important;    
      width:100%;
      height:95%; 
      max-height:900px; 
      min-height:900; */
   }

   ::placeholder {
        color:#e6d618!important;
        opacity: 1; /* Firefox */
        font-size: 2.125rem!important;
        line-height: 2.5rem;
        letter-spacing: .0073529412em!important;
    }

    :-ms-input-placeholder { /* Internet Explorer 10-11 */
    color:#e6d618!important;
    font-size: 2.125rem!important;
    line-height: 2.5rem;
    letter-spacing: .0073529412em!important;
    }

    ::-ms-input-placeholder { /* Microsoft Edge */
    color:#e6d618!important;
    font-size: 2.125rem!important;
    line-height: 2.5rem;
    letter-spacing: .0073529412em!important;
    }
    .input-mxx{
        width:150px;
        text-align:center;
         /* font-size: 20px;  */
         font-weight: bold;
    }
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: none;
    border-radius: .5rem;
    /* background-image: linear-gradient(45deg, black, transparent); */
    background: linear-gradient(315deg, rgba(2, 11, 11, 0) 25%, rgba(85, 13, 25, 0) 100%) !important;
     padding: 1px;
    }
    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        background: linear-gradient(315deg, rgba(2, 11, 11, 0.01) 25%, rgba(85, 13, 25, 0) 100%) !important;
        border: none;
    }
   #canvas{
       width:100%;
   } 
  
    .form-control:disabled, .form-control[readonly] {
    background-color: #dcdcdce0;
    opacity: 1;
   
    }
    

    @media only screen and (min-width: 320px) {
    
        /** res ปุ่มหมุ่น */
        .res{
        margin-top:-105px;
        }
        .mt4_top{
            margin-top: -0.5rem !important;
        }
        .mgs{
        margin-top:-16%;
        }
        input[type=text] {
        width: 100%;
        padding: 17px 0px;
        margin: 8px 0;
        box-sizing: border-box;
        background: linear-gradient(315deg, rgba(2, 11, 11, 0.01) 25%, rgba(85, 13, 25, 0) 100%) !important;
        border: none;
        font-size: 10px;
    }
    }
    @media only screen and (min-width: 375px) {
        .res{
        margin-top:-30px;
        }
    }

    @media only screen and (min-width: 414px) {
        .res{
        margin-top:-2px;
        }
       
    }

    @media only screen and (max-width: 1024px) {
        .res{
        margin-top:1 px;
        }
    }



</style>
<!-- CONTACT-->
<header class="masthead text-white text-center  head "  id="tap_contact">
  <div class="container">
      <div class="row">
        <div class="col-12 ">
            <div class="card ">
                <div class="card-body  ">
                    <div class="row">
                      <?php if($check_onoff['0']['code']=='1') {
                            ?>
                        <div class="col-6" style="border-right:1px solid #e6d618; height: 114px;">
                             <span style="color: white; font-size: 20px;">แต้มของคุณ</span>
                             <input type="text" id="cntbalancetotal" class=" input-mxx" placeholder="<?=$user->point?>"   name="text1" maxlength="4"  readonly >
                        </div>
                        <div class="col-6">
                             <span style="color: white; font-size: 20px;">สิทธ์คงเหลือ</span>
                             <input type="text" id="cntspintotal"  class=" input-mxx" placeholder="<?=$user->spin?>"  name="text1" maxlength="4" readonly >
                        </div>
                    </div>
                          
                            <canvas  id="canvas"  width="434" height="434" class="canvas-pd" >        
                            </canvas>
                            <div class="col-12 res">
                             <img   id="spin_button"  src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/spin_off.png" alt="Spin" onclick="checkspin();"> 
                            
                            <input type="hidden" id="spin_id"> 
                            <input type="hidden" id="id_rowspin"> 


                            </div>
                          <?php } else{ ?>
                               <div class="col-12" > 
                                 <img   id="spin_button"  src="<?php echo $this->config->item('tem_frontend_img'); ?>/mtn.gif" alt="Spin" width="500" >
                               </div>
                         <?php } ?>

                </div>
            </div>
        </div>      
      </div>
    
  </div>
  <div style="padding-top: 140px;"></div>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
   //ส่วนที่ไว้เซตวงล้อ
               let theWheel = new Winwheel({
                   'numSegments'       : 8,
                   'outerRadius'       : 0,
                   'responsive'   : true,
                   'drawText'          : false,
                   'textFontSize'      : 16,
                   'textOrientation'   : 'curved',
                   'textAlignment'     : 'inner',
                   'textMargin'        : 90,
                   'textFontFamily'    : 'monospace',
                   'textStrokeStyle'   : 'black',
                   'textLineWidth'     : 3,
                   'textFillStyle'     : 'white',
                   'drawMode'          : 'segmentImage',
                   'responsive'   : true,  // This wheel is responsive!
                   'segments'          :
                   [
                     {'image' : '<?=$spin[0]['img_spin']?>', 'text' : '<?=$spin[0]['text']?>','pirze_img':'<?=$spin[0]['img_alert']?>','values' : '<?=$spin[0]['point']?>','reward_id' : '<?=$spin[0]['id']?>'},
                     {'image' : '<?=$spin[1]['img_spin']?>', 'text' : '<?=$spin[1]['text']?>','pirze_img':'<?=$spin[1]['img_alert']?>','values' : '<?=$spin[1]['point']?>','reward_id' : '<?=$spin[1]['id']?>'},
                     {'image' : '<?=$spin[2]['img_spin']?>', 'text' : '<?=$spin[2]['text']?>','pirze_img':'<?=$spin[2]['img_alert']?>','values' : '<?=$spin[2]['point']?>','reward_id' : '<?=$spin[2]['id']?>'},
                     {'image' : '<?=$spin[3]['img_spin']?>', 'text' : '<?=$spin[3]['text']?>','pirze_img':'<?=$spin[3]['img_alert']?>','values' : '<?=$spin[3]['point']?>','reward_id' : '<?=$spin[3]['id']?>'},
                     {'image' : '<?=$spin[4]['img_spin']?>', 'text' : '<?=$spin[4]['text']?>','pirze_img':'<?=$spin[4]['img_alert']?>','values' : '<?=$spin[4]['point']?>','reward_id' : '<?=$spin[4]['id']?>'},
                     {'image' : '<?=$spin[5]['img_spin']?>', 'text' : '<?=$spin[5]['text']?>','pirze_img':'<?=$spin[5]['img_alert']?>','values' : '<?=$spin[5]['point']?>','reward_id' : '<?=$spin[5]['id']?>'},
                     {'image' : '<?=$spin[6]['img_spin']?>', 'text' : '<?=$spin[6]['text']?>','pirze_img':'<?=$spin[6]['img_alert']?>','values' : '<?=$spin[6]['point']?>','reward_id' : '<?=$spin[6]['id']?>'},
                     {'image' : '<?=$spin[7]['img_spin']?>', 'text' : '<?=$spin[7]['text']?>','pirze_img':'<?=$spin[7]['img_alert']?>','values' : '<?=$spin[7]['point']?>','reward_id' : '<?=$spin[7]['id']?>'}
                   ],
                   'pins' :
                    {
                        
                        'responsive' : true, // This must be set to true if pin size is to be responsive.
                    },
                   'animation' :
                   {
                       'type'     : 'spinToStop',
                       'duration' : 5,
                       'spins'    : 8,
                       'callbackFinished' : alertPrize
                   }
               });
               let wheelPower    = 0;
               let wheelSpinning = false;
   
          function checkspin() {
      
           //ส่วนไว้เช็คจำนวนสิทธ์การหมุน
  
      document.getElementById('spin_button').style.pointerEvents = 'none';
      
           var sessionNum = '<?=$this->session->member->id?>';
           if (sessionNum) {
           var BtnId = '<?=$this->session->member->id?>';
           $.ajax({
               url: 'userSpin',
               method: 'POST',
               type:'json',
               data: {BtnId:BtnId},
               success: function(data) {
   
                    var data = JSON.parse(data);
                    if(data.code == 1){
                       // alert(data.row_spin);
                      $('#spin_id').val(data.spin_number);
                      $('#id_rowspin').val(data.row_spin);
                       startSpin();
                       document.getElementById("cntspintotal").placeholder = data.spin;            
                                           
                   }
                   else if(data.code == 0){
                     Swal.fire({
                             icon: "error",
                             title: "ไม่สามารถเล่นได้",
                             text: 'กรุณาตรวจสอบจำนวนสิทธ์คงเหลือของท่าน',
                             timer: 7000
                           })
                     
                    document.getElementById('spin_button').style.pointerEvents = 'auto';
                   }
   
               },
               error: function() {
                   alert('Error!!!');
               },
           });
             }else {
                   Swal.fire({
                       icon: 'error',
                       title: 'ไม่พบผู้ใช้',
                       text: 'กรุณาเข้าสู่ระบบ'
   
                   });
               }
           }
   
               function startSpin()
               {
                   //ฟังก์ชั่นการหมุนของวงล้อ
                    var sessionNum = '<?=$this->session->member->id?>';
               if (sessionNum) {
                   if (wheelSpinning == false) {
                       var powerwheel = Math.floor(Math.random() * (5-1))+1;
   
                       if (powerwheel == 1) {
                           theWheel.animation.spins = 3;
                       } else if (powerwheel == 2) {
                           theWheel.animation.spins = 8;
                       } else if (powerwheel == 3) {
                           theWheel.animation.spins = 15;
                       }else if (powerwheel == 4) {
                           theWheel.animation.spins = 30;
                       }else if (powerwheel == 5) {
                           theWheel.animation.spins = 25;
                       }
                       document.getElementById('spin_button').src       = "<?php echo $this->config->item('tem_frontend_img'); ?>wheel/spin_off.png";
                     
                       theWheel.startAnimation();
                       wheelSpinning = true;
                   }
                }else {
                   Swal.fire({
                       icon: 'error',
                       title: 'ไม่พบผู้ใช้',
                       text: 'กรุณาเข้าสู่ระบบ'
   
                   });
               }
               }
                function resetWheel(){//ฟังก์ชั่นรีเซตวงล้อเมื่อหมุนเสร็จ
                   theWheel.stopAnimation(false);
                   theWheel.rotationAngle = 0;
                   theWheel.draw();
                   wheelSpinning = false;
                
                    document.getElementById('spin_button').style.pointerEvents = 'auto';
   
   
               }
   
                function alertPrize(indicatedSegment)
               { //ฟังก์ชั่นแสดงผลรางวัลและบันทึกผลลง database

               
                  var row_spin = $('#id_rowspin').val();
                  
                  var prize = indicatedSegment.values;

                  console.log(prize);
                  console.log(row_spin);
                 
                           Swal.fire({
                             title: "รางวัล",
                             text: "ได้รับรางวัล "+prize,
                             imageUrl:  indicatedSegment.pirze_img,
                             imageWidth: 150,
                             imageHeight: 130,
                             imageAlt: 'Custom image',
                             timer: 1000
                           }).then(function() {
   
                               var prize = indicatedSegment.values;
                               var reward_id = indicatedSegment.reward_id;
                            console.log(prize);
                           $.ajax({
                           url: "add_prize",
                           method: "POST",
                           type:'json',
                           data:{prize:prize,row_spin:row_spin,reward_id:reward_id},
                           success: function(data) {
                               var data = JSON.parse(data);

                               if(data.code == 1){
                               resetWheel();
                               document.getElementById('spin_button').className = "";
                               document.getElementById("cntbalancetotal").placeholder = data.msg;
                               }
                               else if(data.code == 7){
                                 document.getElementById("cntbalancetotal").placeholder = data.msg;
                               resetWheel();
                               location.reload();
                               }
                               else{
                                Swal.fire({
                                     icon: 'error',
                                     title: 'ผิดพลาด',
                                     text: 'กรุณาลองอีกครั้ง'
                 
                                 });
                               }
                            
   
                           },
                       });
   
                           });
               }
               var numrand;
    Winwheel.prototype.computeAnimation = function()
   {
       if (this.animation) {
           if (this.animation.type == 'spinOngoing') {
               this.animation.propertyName = 'rotationAngle';
               if (this.animation.spins == null) {
                   this.animation.spins = 5;
               }
               if (this.animation.repeat == null) {
                   this.animation.repeat = -1;
               }
               if (this.animation.easing == null) {
                   this.animation.easing = 'Linear.easeNone';
               }
               if (this.animation.yoyo == null) {
                   this.animation.yoyo = false;
               }
               this.animation.propertyValue = (this.animation.spins * 360);
               if (this.animation.direction == 'anti-clockwise') {
                   this.animation.propertyValue = (0 - this.animation.propertyValue);
               }
           } else if (this.animation.type == 'spinToStop') {
               this.animation.propertyName = 'rotationAngle';
               if (this.animation.spins == null) {
                   this.animation.spins = 5;
               }
               if (this.animation.repeat == null) {
                   this.animation.repeat = 0;
               }
               if (this.animation.easing == null) {
                   this.animation.easing = 'Power3.easeOut';
               }
               if (this.animation.stopAngle == null) {
   
                   //ส่วนในการคำนวน % ของวงล้อ
                   var  pick = Math.floor(Math.random()*10000);
               
                   numrand = pick;
                   var spin_number = $('#spin_id').val();
                   
   
                    if(spin_number == 1){
                    var condi  = Math.floor(Math.random() * (parseInt('<?=$spin[0]['location_max'];?>')-parseInt('<?=$spin[0]['location_min'];?>')))+parseInt('<?=$spin[0]['location_min'];?>');
   
                   this.animation._stopAngle = condi;
                   }
                   else if(spin_number == 2) {
                    var condi  = Math.floor(Math.random() *  (parseInt('<?=$spin[1]['location_max'];?>')-parseInt('<?=$spin[1]['location_min'];?>')))+parseInt('<?=$spin[1]['location_min'];?>');
   
                   this.animation._stopAngle = condi ;
                   }
                    else if(spin_number == 3){
                    var condi  = Math.floor(Math.random() * (parseInt('<?=$spin[2]['location_max'];?>')-parseInt('<?=$spin[2]['location_min'];?>')))+parseInt('<?=$spin[2]['location_min'];?>');
   
                   this.animation._stopAngle = condi ;
                   }
                   else if(spin_number == 4){
                       var condi  = Math.floor(Math.random() * (parseInt('<?=$spin[3]['location_max'];?>')-parseInt('<?=$spin[3]['location_min'];?>')))+parseInt('<?=$spin[3]['location_min'];?>');
   
                   this.animation._stopAngle = condi ;
                   }
                   else if(spin_number == 5){
                    var condi  = Math.floor(Math.random() *  (parseInt('<?=$spin[4]['location_max'];?>')-parseInt('<?=$spin[4]['location_min'];?>')))+parseInt('<?=$spin[4]['location_min'];?>');
                     
   
                   this.animation._stopAngle = condi ;
                   }
                   else if(spin_number == 6){
                    var condi = Math.floor(Math.random() * (parseInt('<?=$spin[5]['location_max'];?>')-parseInt('<?=$spin[5]['location_min'];?>')))+parseInt('<?=$spin[5]['location_min'];?>');
   
                   this.animation._stopAngle = condi;
                   }
                   else if(spin_number == 7) {
                    var condi = Math.floor(Math.random() *  (parseInt('<?=$spin[6]['location_max'];?>')-parseInt('<?=$spin[6]['location_min'];?>')))+parseInt('<?=$spin[6]['location_min'];?>');
   
                   this.animation._stopAngle = condi;
   
                   }
                   else if(spin_number == 8) {
                    var condi = Math.floor(Math.random() *  (parseInt('<?=$spin[7]['location_max'];?>')-parseInt('<?=$spin[7]['location_min'];?>')))+parseInt('<?=$spin[7]['location_min'];?>');
   
                   this.animation._stopAngle = condi;
   
                   }
               } else {
   
                   this.animation._stopAngle = (360 - this.animation.stopAngle + this.pointerAngle);
               }
   
               if (this.animation.yoyo == null) {
                   this.animation.yoyo = false;
               }
   
   
               this.animation.propertyValue = (this.animation.spins * 360);
   
               if (this.animation.direction == 'anti-clockwise') {
                   this.animation.propertyValue = (0 - this.animation.propertyValue);
                   this.animation.propertyValue -= (360 - this.animation._stopAngle);
               } else {
                   this.animation.propertyValue += this.animation._stopAngle;
               }
           } else if (this.animation.type == 'spinAndBack') {
               this.animation.propertyName = 'rotationAngle';
               if (this.animation.spins == null) {
                   this.animation.spins = 5;
               }
               if (this.animation.repeat == null) {
                   this.animation.repeat = 1;
               }
               if (this.animation.easing == null) {
                   this.animation.easing = 'Power2.easeInOut';
               }
               if (this.animation.yoyo == null) {
                   this.animation.yoyo = true;
               if (this.animation.stopAngle == null) {
                   this.animation._stopAngle = 0;
               } else {
                   this.animation._stopAngle = (360 - this.animation.stopAngle);
               }
               this.animation.propertyValue = (this.animation.spins * 360);
               if (this.animation.direction == 'anti-clockwise') {
                   this.animation.propertyValue -= (360 - this.animation._stopAngle);
               } else {
                   this.animation.propertyValue += this.animation._stopAngle;
               }
           } else if (this.animation.type == 'custom') {
           }
       }
    }
   }
   
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
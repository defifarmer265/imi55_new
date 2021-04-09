
<style>
.white_content11 
{display: none;
position: fixed;
  left: 15%;
  right: 15%;
top: 30px;
width: auto;
background-color: ;
z-index: 1002;
overflow: auto;
-webkit-box-shadow: 0 0 0px 0px #000000;
box-shadow: 0 0 0px 0px #000000;
}
</style>

<div align="center" id="light1" class="white_content11" >
    <p align="center" style="text-align: center;margin-top: 50px;">
        <a href="javascript:void(0)" onClick="document.getElementById('light1').style.display='none'">
            <img src="https://www.imi55.com//public/tem_frontend/img/close.gif" width="75" height="75" >
        </a>
    </p>
    <br>



<?php

 if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) { ?>

    <a href="javascript:void(0)" onClick="document.getElementById('light1').style.display='none'" >
            <img src="https://www.imi55.com//public/tem_frontend/img/m-sport.jpg" border="0" class="img-responsive" width="100%"  style="margin-top: -30px;">   
        </a>

<?php }else{ ?>
   <a    href="javascript:void(0)" onClick="document.getElementById('light1').style.display='none'" >
            <img align="center" src="https://www.imi55.com//public/tem_frontend/img/m-sport.jpg" border="0" class="img-responsive" width="55%"  style="margin-top: -30px;">   
        </a>
<?php } ?>

</div>



    <div class="wrapper">
        <!-- Static login form -->
        <div class="container bet_wraper">
            <div class="row">
                <div class="col-md-3">
                    <div class="betLogin">
                        <h3 class="widget-title" align="center">LOGIN IMI911 </h3>

                      <?php   if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) { ?>
                        <!-- IMIWIN LOGIN -->
                        <form class="bet_form" id="flogin_mo">
                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <input id="user_mo" class="form-control" name="user_mo" type="text" placeholder="ชื่อผู้ใช้" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <input id="pass_mo" class="form-control" name="pass_mo" type="password" placeholder="รหัสผ่าน" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">

                                     <button  type="submit" class="form-control btn btn-success"  >เข้าสู่ระบบ</button>
                                 </div>
                                </div>
                            </div>
                        </form>
                        <!-- IMIWIN LOGIN -->

                      <?php }else{ ?>

                        <!-- IMIWIN LOGIN -->
                        <form class="bet_form" id="flogin_desk">
                            <div class="row">
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <input id="user" class="form-control" name="user" type="text" placeholder="ชื่อผู้ใช้" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-6">
                                    <div class="form-group">
                                        <input id="pass" class="form-control" name="pass" type="password" placeholder="รหัสผ่าน" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">

                                     <button  type="submit" class="form-control btn btn-success"  >เข้าสู่ระบบ</button>
                                 </div>
                                </div>
                            </div>
                        </form>
                        <!-- IMIWIN LOGIN -->

                      <?php } ?>
                        
                    </div>
                </div>






                 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#flogin_desk').submit(function(event) {
      /* Act on the event */
      event.preventDefault();
     var data_login =  $('#flogin_desk').serializeArray();
     data_login.push({name: 'type', value: 'desktop'});
      login(data_login,'desktop');
    });
    $('#flogin_mo').submit(function(event) {
        /* Act on the event */
         event.preventDefault();
        var data_login =  $('#flogin_mo').serializeArray();
         data_login.push({ name: 'type', value: 'mobile' });
        login(data_login,'mobile')
    });
  });

  function login(data_login,type){
      $.ajax({
       url: 'web/check_login_imi',
       type: 'POST',
       dataType: 'json',
       data: data_login,
     })
     .done(function(res) {
       //console.log(res);
       if (res.code == 1) {
        swal({
            title: "",
            text: "เข้าสู่ระบบสำเร็จ",
            icon: "success",
        });
        setTimeout(function(){ window.location.href = res.data.RedirectUrl;}, 2500);
       }else{
         const txt = document.createElement('div');
        txt.innerHTML  = "<b style='color:#000'>ไม่สามารถเข้าสู่ระบบได้</b><br><b style='color:#000'>กรุณาตรวจสอบ username และ password ให้ถูกต้อง!</b>";
        swal({
            content: txt,
            icon: "error",
        });
        if (type == 'desktop') {
          $('#pass').val('');  
      }else if(type == 'mobile'){
        $('#pass_mo').val('');
      }
        
       }
     })
     .fail(function() {
       console.log("error");
     });
  }
</script>


                <div class="col-md-9">
                    <div class="widget about_widget_content sow-slider-2">
                        <div class="so-widget-sow-slider so-widget-sow-slider-default-2dc565a6b619">
                            <div class="sow-slider-base " style="display: none">
                                <ul class="sow-slider-images" data-settings="{&quot;pagination&quot;:true,&quot;speed&quot;:500,&quot;timeout&quot;:5000,&quot;swipe&quot;:true,&quot;nav_always_show_mobile&quot;:&quot;&quot;,&quot;breakpoint&quot;:&quot;780px&quot;}">
                                    <li class="sow-slider-image" style="">
                                        <div class="sow-slider-image-container">
                                            <div class="sow-slider-image-wrapper" style="max-width: 1000px"> <img width="1000" height="300" src="<?php  echo $this->config->item('tem_frontend_img'); ?>slide.jpg" class="attachment-full size-full" alt="เอเย่นต์ แทงบอล บาคาร่า" srcset="<?php  echo $this->config->item('tem_frontend_img'); ?>slide.jpg 300w, <?php  echo $this->config->item('tem_frontend_img'); ?>slide.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px" /></div>
                                        </div>
                                    </li>
                                    <li class="sow-slider-image" style="">
                                        <div class="sow-slider-image-container">
                                            <div class="sow-slider-image-wrapper" style="max-width: 1000px"> <img width="1000" height="300" src="<?php  echo $this->config->item('tem_frontend_img'); ?>slide1.jpg" class="attachment-full size-full" alt="เอเย่นต์ แทงบอล บาคาร่า" srcset="<?php  echo $this->config->item('tem_frontend_img'); ?>slide1.jpg 1000w, <?php  echo $this->config->item('tem_frontend_img'); ?>slide1.jpg 300w, <?php  echo $this->config->item('tem_frontend_img'); ?>slide1.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px" /></div>
                                        </div>
                                    </li>
                              
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




                        <div class="container">
            <ul class="product">
                <li>
                    <div class="product_content">
                        <h3>SEXY BACCARAT</h3>
                        <p>
                            ยุโรป <br />
                            <span class="small_text">บาคาร่า | INSURANCE BACCARAT | เสือมังกร</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>sb-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>LUCKY STREAK</h3>
                        <p>
                            ยุโรป <br />
                            <span class="small_text">บาคาร่า | รูเล็ต | แบล็คแจ็ค</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>ls-banner.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>WM CASINO</h3>
                        <p>
                            กัมพูชา <br />
                            <span class="small_text">บาคาร่า | เสือมังกร | รูเล็ต | ไฮโล | NIUNIU</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>wm-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>GOLD DELUXE</h3>
                        <p>
                            เอเชีย <br />
                            <span class="small_text">บาคาร่า | รูเล็ต | ไฮโล</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>gd-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>KING855</h3>
                        <p>
                            กัมพูชา <br />
                            <span class="small_text">บาคาร่า | คาสิโนโฮลด์เอ็ม | เสือมังกร | รูเล็ต | ไฮโล | การสู้วัวกระทิง</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>ct855-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>ALLBET</h3>
                        <p>
                            ฟิลิปปินส์ <br />
                            <span class="small_text">บาคาร่า | รูเล็ต | เสือมังกร | ไฮโล</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>ab-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>EVO CASINO</h3>
                        <p>
                            ยุโรป <br />
                            <span class="small_text">บาคาร่า | รูเล็ต | ไฮโล | เสือมังกร | TOP CARD | แบล็คแจ็ค | MONEY WHEEL</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>evo-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>DREAM GAMING</h3>
                        <p>
                            ยุโรป <br />
                            <span class="small_text">บาคาร่า | เสือมังกร | รูเล็ต | ไฮโล | การสู้วัวกระทิง | ไตร</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>dc-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>AG CASINO</h3>
                        <p>
                            ฟิลิปปินส์ <br />
                            <span class="small_text">บาคาร่า | รูเล็ต | ไฮโลมังกร | XOC-DIA | F.TEN</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>ag-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>BIG GAMING</h3>
                        <p>
                            เอเชีย <br />
                            <span class="small_text">บาคาร่า | รูเล็ต | ไฮโล | เสือมังกร | วัวกระทิง | ไตร</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>bg-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>FAIR GUARANTED GAMING</h3>
                        <p>
                            เอเชีย <br />
                            <span class="small_text">บาคาร่า | เสือมังกร | รูเล็ต | SHOOTDOOR | BULLBULL | ไตร | ไฮโล | วัวกระทิง | FANTAN | SEDIE</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>fgg-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
                <li>
                    <div class="product_content">
                        <h3>SA GAMING</h3>
                        <p>
                            เอเชีย <br />
                            <span class="small_text">บาคาร่า | เสือมังกร | รูเล็ต | ไฮโล | FANTAN</span>
                        </p>
                        <a class="play_button" onclick="alert('Login Now')" href="">เล่นตอนนี้</a>
                    </div>
                    <img class="img100" src="<?php  echo $this->config->item('tem_frontend_img'); ?>sa-casino.png" alt="เอเย่นต์ แทงบอล บาคาร่า หวย">
                </li>
            </ul>
        </div>


    </div>

    <script type="text/javascript">
        function getValueLeft() {
            document.getElementById("bsadsheadlineLeft").style.display = 'none';
        }

        function getValueRight() {
            document.getElementById("bsadsheadlineRight").style.display = 'none';
        }

        function getValueBottom() {
            document.getElementById("bsadsheadlineBottom").style.display = 'none';
        }

        function getValue() {
            document.getElementById("bsadsheadlineBottom").style.display = 'none';
            document.getElementById("bsadsheadlineRight").style.display = 'none';
            document.getElementById("bsadsheadlineLeft").style.display = 'none';
        }
    </script>
    <style type="text/css" media="all" id="siteorigin-panels-layouts-footer">
       #pgc-w5e988a76ba8a9-0-0 {
            width: 36.3936%;
            width: calc(36.3936% - ( 0.6360637293249 * 15px))
        }
        
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-0-0-0,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-0-0-1,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-0-1-0,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-1-0-0,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-2-0-0,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-2-1-0,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-2-2-0,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-3-0-0,
        #pl-w5e988a76ba8a9 #panel-w5e988a76ba8a9-3-1-0 {}
        
        #pgc-w5e988a76ba8a9-0-1 {
            width: 63.6064%;
            width: calc(63.6064% - ( 0.3639362706751 * 15px))
        }        
        #pg-w5e988a76ba8a9-0,
        #pg-w5e988a76ba8a9-1,
        #pg-w5e988a76ba8a9-2,
        #pl-w5e988a76ba8a9 .so-panel {
            margin-bottom: 15px
        }        
        #pgc-w5e988a76ba8a9-1-0 {
            width: 100%;
            width: calc(100% - ( 0 * 15px))
        }        
        #pgc-w5e988a76ba8a9-2-0 {
            width: 37.0752%;
            width: calc(37.0752% - ( 0.62924812819002 * 15px))
        }        
        #pgc-w5e988a76ba8a9-2-1 {
            width: 37.5193%;
            width: calc(37.5193% - ( 0.62480689736134 * 15px))
        }        
        #pgc-w5e988a76ba8a9-2-2 {
            width: 25.4055%;
            width: calc(25.4055% - ( 0.74594497444864 * 15px))
        }        
        #pgc-w5e988a76ba8a9-3-0 {
            width: 68.0412%;
            width: calc(68.0412% - ( 0.31958762886598 * 15px))
        }        
        #pgc-w5e988a76ba8a9-3-1 {
            width: 31.9588%;
            width: calc(31.9588% - ( 0.68041237113402 * 15px))
        }        
        #pl-w5e988a76ba8a9 .so-panel:last-child {
            margin-bottom: 0px
        }        
        #pg-w5e988a76ba8a9-0.panel-no-style,
        #pg-w5e988a76ba8a9-0.panel-has-style > .panel-row-style,
        #pg-w5e988a76ba8a9-1.panel-no-style,
        #pg-w5e988a76ba8a9-1.panel-has-style > .panel-row-style,
        #pg-w5e988a76ba8a9-2.panel-no-style,
        #pg-w5e988a76ba8a9-2.panel-has-style > .panel-row-style,
        #pg-w5e988a76ba8a9-3.panel-no-style,
        #pg-w5e988a76ba8a9-3.panel-has-style > .panel-row-style {
            -webkit-align-items: flex-start;
            align-items: flex-start
        }        
        #panel-w5e988a76ba8a9-1-0-0> .panel-widget-style {
            border: 1px solid #81d742
        }        
        #panel-w5e988a76ba8a9-2-0-0> .panel-widget-style,
        #panel-w5e988a76ba8a9-2-1-0> .panel-widget-style {
            border: 1px solid #ffffff;
            color: #81d742
        }        
        #panel-w5e988a76ba8a9-2-0-0 a,
        #panel-w5e988a76ba8a9-2-1-0 a {
            color: #81d742
        }        
        #panel-w5e988a76ba8a9-2-2-0> .panel-widget-style {
            border: 1px solid #ffffff;
            color: #eeee22
        }        
        #panel-w5e988a76ba8a9-2-2-0 a {
            color: #eeee22
        }        
        #pg-w5e988a76ba8a9-3> .panel-row-style {
            background-color: #161616;
            padding: 15px 15px 15px 15px;
            margin-top: 15px
        }        
        @media (max-width:780px) {
            #pg-w5e988a76ba8a9-0.panel-no-style,
            #pg-w5e988a76ba8a9-0.panel-has-style > .panel-row-style,
            #pg-w5e988a76ba8a9-1.panel-no-style,
            #pg-w5e988a76ba8a9-1.panel-has-style > .panel-row-style,
            #pg-w5e988a76ba8a9-2.panel-no-style,
            #pg-w5e988a76ba8a9-2.panel-has-style > .panel-row-style,
            #pg-w5e988a76ba8a9-3.panel-no-style,
            #pg-w5e988a76ba8a9-3.panel-has-style > .panel-row-style {
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column
            }
            #pg-w5e988a76ba8a9-0 > .panel-grid-cell,
            #pg-w5e988a76ba8a9-0 > .panel-row-style > .panel-grid-cell,
            #pg-w5e988a76ba8a9-1 > .panel-grid-cell,
            #pg-w5e988a76ba8a9-1 > .panel-row-style > .panel-grid-cell,
            #pg-w5e988a76ba8a9-2 > .panel-grid-cell,
            #pg-w5e988a76ba8a9-2 > .panel-row-style > .panel-grid-cell,
            #pg-w5e988a76ba8a9-3 > .panel-grid-cell,
            #pg-w5e988a76ba8a9-3 > .panel-row-style > .panel-grid-cell {
                width: 100%;
                margin-right: 0
            }
            #pgc-w5e988a76ba8a9-0-0,
            #pgc-w5e988a76ba8a9-2-0,
            #pgc-w5e988a76ba8a9-2-1,
            #pgc-w5e988a76ba8a9-3-0 {
                margin-bottom: 15px
            }
            #pg-w5e988a76ba8a9-1 {
                margin-bottom: 10%
            }
            #pl-w5e988a76ba8a9 .panel-grid-cell {
                padding: 0
            }
            #pl-w5e988a76ba8a9 .panel-grid .panel-grid-cell-empty {
                display: none
            }
            #pl-w5e988a76ba8a9 .panel-grid .panel-grid-cell-mobile-last {
                margin-bottom: 0px
            }
        }
    </style>
    <style id="fvm-footer-0" media="all">
        .so-widget-sow-image-default-d6014b76747a .sow-image-container {
            display: flex;
            align-items: flex-start
        }        
        .so-widget-sow-image-default-d6014b76747a .sow-image-container>a {
            display: inline-block;
            max-width: 100%
        }        
        .so-widget-sow-image-default-d6014b76747a .sow-image-container .so-widget-image {
            display: block;
            max-width: 100%;
            height: auto
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .social-media-button-container {
            zoom: 1;
            text-align: left
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .social-media-button-container:before {
            content: '';
            display: block
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .social-media-button-container:after {
            content: '';
            display: table;
            clear: both
        }        
        @media (max-width:780px) {
            .so-widget-sow-social-media-buttons-atom-420b044c6231 .social-media-button-container {
                text-align: left
            }
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-twitter-0 {
            border: 1px solid;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            text-shadow: 0 1px 0 rgba(0, 0, 0, .05);
            border-color: #3ca0eb #339bea #2594e8 #339bea;
            background: #78bdf1;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4aa6ec), color-stop(1, #78bdf1));
            background: -ms-linear-gradient(bottom, #4aa6ec, #78bdf1);
            background: -moz-linear-gradient(center bottom, #4aa6ec 0%, #78bdf1 100%);
            background: -o-linear-gradient(#78bdf1, #4aa6ec);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#78bdf1', endColorstr='#4aa6ec', GradientType=0);
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-twitter-0.ow-button-hover:hover {
            border-color: #45a4ec #3ca0eb #2e99e9 #3ca0eb;
            background: #81c2f2;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #53abed), color-stop(1, #81c2f2));
            background: -ms-linear-gradient(bottom, #53abed, #81c2f2);
            background: -moz-linear-gradient(center bottom, #53abed 0%, #81c2f2 100%);
            background: -o-linear-gradient(#81c2f2, #53abed);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#81c2f2', endColorstr='#53abed', GradientType=0)
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-twitter-0:visited,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-twitter-0:active,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-twitter-0:hover {
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-twitter-0.ow-button-hover:hover {
            color: #fff
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-facebook-0 {
            border: 1px solid;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            text-shadow: 0 1px 0 rgba(0, 0, 0, .05);
            border-color: #273b65 #25375e #203053 #25375e;
            background: #3a5795;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #2c4270), color-stop(1, #3a5795));
            background: -ms-linear-gradient(bottom, #2c4270, #3a5795);
            background: -moz-linear-gradient(center bottom, #2c4270 0%, #3a5795 100%);
            background: -o-linear-gradient(#3a5795, #2c4270);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#3a5795', endColorstr='#2c4270', GradientType=0);
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-facebook-0.ow-button-hover:hover {
            border-color: #2a3f6d #273b65 #23355a #273b65;
            background: #3d5b9c;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #2f4678), color-stop(1, #3d5b9c));
            background: -ms-linear-gradient(bottom, #2f4678, #3d5b9c);
            background: -moz-linear-gradient(center bottom, #2f4678 0%, #3d5b9c 100%);
            background: -o-linear-gradient(#3d5b9c, #2f4678);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#3d5b9c', endColorstr='#2f4678', GradientType=0)
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-facebook-0:visited,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-facebook-0:active,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-facebook-0:hover {
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-facebook-0.ow-button-hover:hover {
            color: #fff
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-google-plus-0 {
            border: 1px solid;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            text-shadow: 0 1px 0 rgba(0, 0, 0, .05);
            border-color: #b52f1f #ac2d1e #9f2a1b #ac2d1e;
            background: #dd4b39;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #c23321), color-stop(1, #dd4b39));
            background: -ms-linear-gradient(bottom, #c23321, #dd4b39);
            background: -moz-linear-gradient(center bottom, #c23321 0%, #dd4b39 100%);
            background: -o-linear-gradient(#dd4b39, #c23321);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#dd4b39', endColorstr='#c23321', GradientType=0);
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-google-plus-0.ow-button-hover:hover {
            border-color: #bd3221 #b52f1f #a82c1d #b52f1f;
            background: #de5342;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ca3523), color-stop(1, #de5342));
            background: -ms-linear-gradient(bottom, #ca3523, #de5342);
            background: -moz-linear-gradient(center bottom, #ca3523 0%, #de5342 100%);
            background: -o-linear-gradient(#de5342, #ca3523);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#de5342', endColorstr='#ca3523', GradientType=0)
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-google-plus-0:visited,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-google-plus-0:active,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-google-plus-0:hover {
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-google-plus-0.ow-button-hover:hover {
            color: #fff
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-pinterest-0 {
            border: 1px solid;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            text-shadow: 0 1px 0 rgba(0, 0, 0, .05);
            border-color: #cd4852 #cb404a #c53641 #cb404a;
            background: #db7c83;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #d0545d), color-stop(1, #db7c83));
            background: -ms-linear-gradient(bottom, #d0545d, #db7c83);
            background: -moz-linear-gradient(center bottom, #d0545d 0%, #db7c83 100%);
            background: -o-linear-gradient(#db7c83, #d0545d);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#db7c83', endColorstr='#d0545d', GradientType=0);
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-pinterest-0.ow-button-hover:hover {
            border-color: #cf5059 #cd4852 #c93c46 #cd4852;
            background: #dd848b;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #d25c65), color-stop(1, #dd848b));
            background: -ms-linear-gradient(bottom, #d25c65, #dd848b);
            background: -moz-linear-gradient(center bottom, #d25c65 0%, #dd848b 100%);
            background: -o-linear-gradient(#dd848b, #d25c65);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#dd848b', endColorstr='#d25c65', GradientType=0)
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-pinterest-0:visited,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-pinterest-0:active,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-pinterest-0:hover {
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-pinterest-0.ow-button-hover:hover {
            color: #fff
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-linkedin-0 {
            border: 1px solid;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .2), 0 1px 2px rgba(0, 0, 0, .065);
            text-shadow: 0 1px 0 rgba(0, 0, 0, .05);
            border-color: #014b72 #014568 #003b59 #014568;
            background: #0177b4;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #015581), color-stop(1, #0177b4));
            background: -ms-linear-gradient(bottom, #015581, #0177b4);
            background: -moz-linear-gradient(center bottom, #015581 0%, #0177b4 100%);
            background: -o-linear-gradient(#0177b4, #015581);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#0177b4', endColorstr='#015581', GradientType=0);
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-linkedin-0.ow-button-hover:hover {
            border-color: #01527c #014b72 #014163 #014b72;
            background: #017ebe;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #015c8b), color-stop(1, #017ebe));
            background: -ms-linear-gradient(bottom, #015c8b, #017ebe);
            background: -moz-linear-gradient(center bottom, #015c8b 0%, #017ebe 100%);
            background: -o-linear-gradient(#017ebe, #015c8b);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#017ebe', endColorstr='#015c8b', GradientType=0)
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-linkedin-0:visited,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-linkedin-0:active,
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-linkedin-0:hover {
            color: #ffffff!important
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button-linkedin-0.ow-button-hover:hover {
            color: #fff
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button {
            display: inline-block;
            font-size: 1em;
            line-height: 1em;
            margin: .1em .1em .1em 0;
            padding: 1em 0;
            width: 3em;
            text-align: center;
            vertical-align: middle;
            -webkit-border-radius: .25em;
            -moz-border-radius: .25em;
            border-radius: .25em
        }        
        .so-widget-sow-social-media-buttons-atom-420b044c6231 .sow-social-media-button .sow-icon-fontawesome {
            display: inline-block;
            height: 1em
        }
        .fa,
        .fas,
        .far,
        .fal,
        .fab {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1
        }
        
        .fa-lg {
            font-size: 1.33333em;
            line-height: .75em;
            vertical-align: -.0667em
        }
        
        .fa-xs {
            font-size: .75em
        }
        
        .fa-sm {
            font-size: .875em
        }
        
        .fa-1x {
            font-size: 1em
        }
        
        .fa-2x {
            font-size: 2em
        }
        
        .fa-3x {
            font-size: 3em
        }
        
        .fa-4x {
            font-size: 4em
        }
        
        .fa-5x {
            font-size: 5em
        }
        
        .fa-6x {
            font-size: 6em
        }
        
        .fa-7x {
            font-size: 7em
        }
        
        .fa-8x {
            font-size: 8em
        }
        
        .fa-9x {
            font-size: 9em
        }
        
        .fa-10x {
            font-size: 10em
        }
        
        .fa-fw {
            text-align: center;
            width: 1.25em
        }
        
        .fa-ul {
            
            margin-left: 2.5em;
            padding-left: 0
        }
        
        .fa-ul>li {
            position: relative
        }
        
        .fa-li {
            left: -2em;
            position: absolute;
            text-align: center;
            width: 2em;
            line-height: inherit
        }
        
        .fa-border {
            border: solid .08em #eee;
            border-radius: .1em;
            padding: .2em .25em .15em
        }
        
        .fa-pull-left {
            float: left
        }
        
        .fa-pull-right {
            float: right
        }
        
        .fa.fa-pull-left,
        .fas.fa-pull-left,
        .far.fa-pull-left,
        .fal.fa-pull-left,
        .fab.fa-pull-left {
            margin-right: .3em
        }
        
        .fa.fa-pull-right,
        .fas.fa-pull-right,
        .far.fa-pull-right,
        .fal.fa-pull-right,
        .fab.fa-pull-right {
            margin-left: .3em
        }
        
        .fa-spin {
            -webkit-animation: fa-spin 2s infinite linear;
            animation: fa-spin 2s infinite linear
        }
        
        .fa-pulse {
            -webkit-animation: fa-spin 1s infinite steps(8);
            animation: fa-spin 1s infinite steps(8)
        }
        
        @-webkit-keyframes fa-spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg)
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg)
            }
        }
        
        @keyframes fa-spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg)
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg)
            }
        }
        
        .fa-rotate-90 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=1)";
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg)
        }
        
        .fa-rotate-180 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2)";
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg)
        }
        
        .fa-rotate-270 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";
            -webkit-transform: rotate(270deg);
            transform: rotate(270deg)
        }
        
        .fa-flip-horizontal {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1)";
            -webkit-transform: scale(-1, 1);
            transform: scale(-1, 1)
        }
        
        .fa-flip-vertical {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)";
            -webkit-transform: scale(1, -1);
            transform: scale(1, -1)
        }
        
        .fa-flip-horizontal.fa-flip-vertical {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)";
            -webkit-transform: scale(-1, -1);
            transform: scale(-1, -1)
        }
        
        :root .fa-rotate-90,
        :root .fa-rotate-180,
        :root .fa-rotate-270,
        :root .fa-flip-horizontal,
        :root .fa-flip-vertical {
            -webkit-filter: none;
            filter: none
        }
        
        .fa-stack {
            display: inline-block;
            height: 2em;
            line-height: 2em;
            position: relative;
            vertical-align: middle;
            width: 2.5em
        }
        
        .fa-stack-1x,
        .fa-stack-2x {
            left: 0;
            position: absolute;
            text-align: center;
            width: 100%
        }
        
        .fa-stack-1x {
            line-height: inherit
        }
        
        .fa-stack-2x {
            font-size: 2em
        }
        
        .fa-inverse {
            color: #fff
        }
        
        .sr-only {
            border: 0;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px
        }
        
        .sr-only-focusable:active,
        .sr-only-focusable:focus {
            clip: auto;
            height: auto;
            margin: 0;
            overflow: visible;
            position: static;
            width: auto
        }
        
      
        
        .sow-fab {
            font-family: 'sow-fontawesome-brands';
            font-style: normal!important;
            font-weight: normal!important
        }
        
       
        
        .sow-far {
            font-family: 'sow-fontawesome-free';
            font-style: normal!important;
            font-weight: 400!important
        }
        
      
        
        .sow-fa,
        .sow-fas {
            font-family: 'sow-fontawesome-free';
            font-weight: 900!important;
            font-style: normal!important
        }
        
        .sow-icon-fontawesome {
            display: inline-block;
            speak: none;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }
        
        .sow-icon-fontawesome[data-sow-icon]:before {
            content: attr(data-sow-icon)
        }
        
        .so-widget-sow-image-default-17bc2272b535 .sow-image-container {
            display: flex;
            align-items: flex-start;
            justify-content: center
        }
        
        .so-widget-sow-image-default-17bc2272b535 .sow-image-container>a {
            display: inline-block;
            max-width: 100%
        }
        
        .so-widget-sow-image-default-17bc2272b535 .sow-image-container .so-widget-image {
            display: block;
            max-width: 100%;
            height: auto
        }
        
        .panel-grid.panel-has-style>.panel-row-style,
        .panel-grid.panel-no-style {
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: nowrap;
            -ms-justify-content: space-between;
            justify-content: space-between
        }
        
        .panel-layout.panel-is-rtl .panel-grid.panel-has-style>.panel-row-style,
        .panel-layout.panel-is-rtl .panel-grid.panel-no-style {
            -ms-flex-direction: row-reverse;
            flex-direction: row-reverse
        }
        
        .panel-grid-cell {
            -ms-box-sizing: border-box;
            box-sizing: border-box
        }
        
        .panel-grid-cell .panel-cell-style {
            height: 100%
        }
        
        .panel-grid-cell .so-panel {
            zoom: 1
        }
        
        .panel-grid-cell .so-panel:before {
            content: "";
            display: block
        }
        
        .panel-grid-cell .so-panel:after {
            content: "";
            display: table;
            clear: both
        }
        
        .panel-grid-cell .panel-last-child {
            margin-bottom: 0
        }
        
        .panel-grid-cell .widget-title {
            margin-top: 0
        }
        
        body.siteorigin-panels-before-js {
            overflow-x: hidden
        }
        
        body.siteorigin-panels-before-js .siteorigin-panels-stretch {
            margin-right: -1000px!important;
            margin-left: -1000px!important;
            padding-right: 1000px!important;
            padding-left: 1000px!important
        }
    </style>

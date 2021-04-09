<?php
   if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) { ?>
<div class="canvas" canvas="container" id="canvas">
   <div class="main-screen">
      <header class="header">
         <a href="<?php echo base_url()?>web/" class="header-button header-button-left" id="nav-btn">
         <span class="icon icon-navicon"></span>
         </a>
         <h1 class="header-title">
            <a href="<?php echo base_url()?>web/"><img  alt="โลโก้ imiwinshop สมัครเอเย่นต์" src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png"/></a>
         </h1>
         <a  class="header-button header-button-right open-right-sidebar hide"></span></a> 
      </header>
      <section class="body">
         <div class="banner-main">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner" role="listbox" style="margin-top: 15px; size: 100%">
                  <div class="item active"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>slide/agent.jpg" class="img-responsive" alt="เอเย่นต์ แทงบอล บาคาร่า"></div>
                  <div class="item"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>slide/football.jpg" class="img-responsive" alt="เอเย่นต์ แทงบอล บาคาร่า"></div>
                  <div class="item"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>slide/casino.jpg" class="img-responsive" alt="เอเย่นต์ แทงบอล บาคาร่า"></div>
                  <div class="item"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>slide/game.jpg" class="img-responsive" alt="เอเย่นต์ แทงบอล บาคาร่า"></div>
                  <div class="item"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>slide/lotto.jpg" class="img-responsive" alt="เอเย่นต์ แทงบอล บาคาร่า"></div>
               </div>
               <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> 
            </div>
         </div>
         <div id="lazy-contain">
            <div class="dash-widgets css-loader-ready">
               <div class="container" style="background-color: #373737">
                  <div class="announcement-slide">
                     <a class="megaphone" href="#" onClick="showAnnouncement()">
                        <i class="icon-announcement-right"></i>
                        <div class="indicator icon-ballon"></div>
                     </a>
                     <div class="announcement-slide-box">
                        <ul class="announcement-slide-list">
                           <li>
                              <marquee  style="color: #fff">
                                 <b>ยินดีต้อนรับ IMIWINSHOP เว็บไซต์ที่ดีที่สุด. ยินดีต้อนรับ IMIWINSHOP เว็บไซต์ที่ดีที่สุด</b>
                              </marquee>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row container--dashboard" style="background-image: url(<?php  echo $this->config->item('tem_frontend_img'); ?>casinoBG.jpg);">
                  <div class="col-xs-4" >
                     <a  href="#" data-toggle="modal" data-target="#promo00" >
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn/imi.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center;">IMI</h4>
                     </a>
                  </div>
                  <div class="col-xs-4">
                     <a  href="#" data-toggle="modal" data-target="#promo11" >
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn/system.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center;">API</h4>
                     </a>
                  </div>
                  <div class="col-xs-4">
                     <a href="#" data-toggle="modal" data-target="#promo22">
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn/lotto.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center;">หวย</h4>
                     </a>
                  </div>
                  <div class="col-xs-4">
                     <a href="#" data-toggle="modal" data-target="#promo33">
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn/auto1.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center;">ระบบออโต้</h4>
                     </a>
                  </div>
                  <div class="col-xs-4">
                     <a href="#" data-toggle="modal" data-target="#promo44">
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn/ex.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center; ">ผลิตภัณฑ์</h4>
                     </a>
                  </div>
                  <div class="col-xs-4">
                     <a href="<?php echo base_url()?>web/promotion" target="_blank">
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn/eexxx.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center; ">สูตร</h4>
                     </a>
                  </div>
               </div>
               <div class="container" style="background-color: #01002a">
                  <div class="announcement-slide"> 
                  </div>
               </div>
               <div class="row container--dashboard" style="background-image: url(<?php  echo $this->config->item('tem_frontend_img'); ?>casinoBG.jpg);">
                  <div class="col-xs-4">
                     <a href="<?php echo base_url()?>web/manual_marketing" target="_blank">
                        <br>
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn/exxx.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center;font-size: 1em;">แนวทาง<br>การตลาด</h4>
                     </a>
                  </div>
                  <div class="col-xs-4">
                     <a href="https://www.fanballshop.com/template/" target="_blank">
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>icon/icon8.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center;font-size: 1em;">เว็บไซต์<br>ตัวอย่าง</h4>
                     </a>
                  </div>
                  <div class="col-xs-4">
                     <a href="line://ti/p/@imiwinshop" >
                        <img class="center" alt="เอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/contt.png" style="width: 85%;"><br>
                        <h4 style="color: #fff;text-align: center;font-size: 1em;">ติดต่อ<br>สอบถาม</h4>
                     </a>
                  </div>
               </div>
               <div class="module contact-bg">
                  <div class="module-header">
                     <div class="media">
                        <div class="media-body" align="center">
                           <h4 class="media-heading"><br><span style="color: #fff;text-align: center;">IMIWINSHOP</span></h4>
                           <p style="color: #fff">ยินดีต้อนรับสู่ IMIWINSHOP หนึ่งในผู้นำเว็บไซต์เดิมพันออนไลน์ของเอเชีย ที่ส่งตรงถึงบ้านคุณเพื่อให้ท่านได้รับประสบการณ์ที่ดีที่สุดกับการเดิมพันออนไลน์ ทางเว็บไซต์ของเราประกอบไปด้วย การเดิมพันกีฬา, เกมส์คาสิโนออนไลน์, คีโน, โป๊กเกอร์ออนไลน์, แฟลชเกมส์ และเกมส์เดิมพันออนไลน์ระดับโลกมากมาย</p>
                        </div>
                        <div class="media-right"> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="home-footer">
            <p id="copyright">
            <h2><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="โลโก้ imiwinshop สมัครเอเย่นต์" class="img-responsive center-block" style="width: 80%;text-align: center;"></h2>
            </p>
         </div>
      </section>
   </div>
   <div class="canvas-overlay"></div>
</div>
<script type="text/javascript" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>js/vendor-m.js"></script> 
<script type="text/javascript" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>js/constants.js"></script> 
<script type="text/javascript" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>js/jquery.countdown.js"></script> 
<script type="text/javascript">
   $(function() {
     var endDate = "June 14, 2018 23:00:00";
   
     $('.countdown.simple').countdown({ date: endDate });
   
     $('.countdown.styled').countdown({
       date: endDate,
       render: function(data) {
         $(this.el).html("<div>" + this.leadingZeros(data.days, 2) + " <span>day</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>hour</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>min</span></div><div>");
       }
     });
   
     $('.countdown.callback').countdown({
       date: +(new Date) + 10000,
       render: function(data) {
         $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
       },
       onEnd: function() {
         $(this.el).addClass('ended');
       }
     }).on("click", function() {
       $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
     });   
     var endTimeDiff = new Date().getTime() + 15000;
     var timeThere = new Date();
     var timeHere = new Date(timeThere.getTime() - 5434);
     var diff_ms = timeHere.getTime() - timeThere.getTime();
     var diff_s = diff_ms / 1000 | 0;     
     var notice = [];
     notice.push('Server time: ' + timeThere.toDateString() + ' ' + timeThere.toTimeString());
     notice.push('Your time: ' + timeHere.toDateString() + ' ' + timeHere.toTimeString());
     notice.push('Time difference: ' + diff_s + ' seconds (' + diff_ms + ' milliseconds to be precise). Your time is a bit behind.');
     
     $('.offset-notice').html(notice.join('<br />'));
     
     $('.offset-server .countdown').countdown({
       date: endTimeDiff,
       offset: diff_s * 1000,
       onEnd: function() {
         $(this.el).addClass('ended');
       }
     });
     
     $('.offset-client .countdown').countdown({
       date: endTimeDiff,
       onEnd: function() {
         $(this.el).addClass('ended');
       }
     });
   
   });
</script> 
<script type="text/javascript">
   window.betMobile = {};
   window.User = {};
</script> 
<script type="text/javascript" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>js/main-m.js"></script> 
<script type="text/javascript">
   var loginObj = {};
   
   if(!bet_native.hasWrapper()){
   
     var loginBtn = $("a[data-i18n='LABEL_MENU_LOGIN']");
     if(loginBtn.length > 0){
       loginBtn.off("click").on("click", function(e){
         e.stopPropagation();
         e.preventDefault();
         amplify.publish("open-sidebar");
       })
     }
   }
</script> 
<script type="text/javascript">
   $(document).ready(function () {
     $(".open-right-sidebar.hide").removeClass("hide");
     bet_menu.init();
   });
</script>
<?php }else{ ?>






<!DOCTYPE html>
<html>
<body>
  <main class="main" style="background-image: url(<?php echo $this->config->item('tem_frontend_img');?>imiwinbg.jpg);">  
                      <div id="mainslider" role="main">
                        <center> 
                           <section class="flslider">
                              <div class="flexslider">
                                 <ul class="slides">
                                    <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;"><a href="#"><img src="https://imiwin.com/data/1744/aimg/lottery-banner-1.jpg" alt="" draggable="false"></a></li>
                                    <li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><a href="#"><img src="https://imiwin.com/data/1744/aimg/lottery-banner-2.jpg" alt="" draggable="false"></a></li>
                                 </ul>
                                 <ul class="flex-direction-nav">
                                    <li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a></li>
                                    <li class="flex-nav-next"><a class="flex-next" href="#">Next</a></li>
                                 </ul>
                              </div>
                           </section></center>

                        </div>
                        <script>
                           $( document ).ready(function() {
                           
                                 $('.flexslider').flexslider({
                                   animation: "fade",
                                   randomize:true,
                                   controlNav:false,
                                   directionNav:true,
                                   slideshowSpeed:7000,
                                   animationSpeed:600,
                                   randomize:false,
                                   start: function(slider){
                                     $('body').removeClass('webloading');
                                   }
                                 });                           
                           });
                        </script>

            
             <div class="container text-center">
                        <style type="text/css">
                           #drawresult{clear:both;}
                           #drawresult ul { margin:0px; padding:0px; list-style:none;}
                           #drawresult ul > li { display:-moz-inline-stack; display:inline-block; zoom:1; *display:inline; width:200px;  border:1px solid #B2B2B2; margin:10px; padding:10px; text-align:center; background:#efefef; -webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;}
                           #drawresult ul > li table { width:100%; }
                           #drawresult ul > li table caption {font-size:larger; padding:5px; -webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px; text-align:left; color:#333333;}
                           #drawresult ul > li table caption div {font-size:9px;}
                           #drawresult ul > #M table caption {background:url(http://abs33.com/theme/Admin_New/icon/magnum.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #P table caption {background:url(http://abs33.com/theme/Admin_New/icon/pmp.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #T table caption {background:url(http://abs33.com/theme/Admin_New/icon/toto.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #S table caption {background:url(http://abs33.com/theme/Admin_New/icon/sin.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #K table caption {background:url(http://abs33.com/theme/Admin_New/icon/san.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #B table caption {background:url(http://abs33.com/theme/Admin_New/icon/sab.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #W table caption {background:url(http://abs33.com/theme/Admin_New/icon/sar.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #H table caption {background:url(http://abs33.com/theme/Admin_New/icon/gdlotto.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #N table caption {background:url(http://abs33.com/theme/Admin_New/icon/perdana.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #R table caption {background:url(http://abs33.com/theme/Admin_New/icon/lucky.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #G table caption {background:url(http://abs33.com/theme/Admin_New/icon/good4d.png) #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > #V table caption {background:url() #DDDDDD 10px 8px no-repeat; padding-left:50px;}
                           #drawresult ul > li table tr td {border-top:1px solid #888888; padding:10px 5px; color:#333333;}
                           #drawresult ul > li table tr:first-child  td{ border:0px;  }
                           #drawresult ul > li  ol { margin:0px; padding:0px;  list-style:none;}
                           #drawresult ul > li  ol li {display:inline;}
                           #drawresult ul > li  ol.abc li { padding:0px 10px; font-weight:bold;}
                           #drawresult ul > li  ol.p li { padding:0px 3px;}
                           #drawresult ul > li  ol.c li { padding:0px 3px;}
                        </style>
                        <div id="drawresult">
                           <ul>
                              <li id="M">
                                 <table>
                                    <caption>
                                       MAGNUM 
                                       <div class="drawdate" id="Mdate">24-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="M_F">7041</li>
                                                <li id="M_S">9648</li>
                                                <li id="M_T">5202</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="M_P0">6185</li>
                                                <li id="M_P1">8431</li>
                                                <li id="M_P2">1118</li>
                                                <li id="M_P3">1912</li>
                                                <li id="M_P4">3568</li>
                                                <li id="M_P5">5676</li>
                                                <li id="M_P6">8413</li>
                                                <li id="M_P7">9132</li>
                                                <li id="M_P8">0296</li>
                                                <li id="M_P9">1638</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="M_C0">3224</li>
                                                <li id="M_C1">9412</li>
                                                <li id="M_C2">5092</li>
                                                <li id="M_C3">6432</li>
                                                <li id="M_C4">6129</li>
                                                <li id="M_C5">9342</li>
                                                <li id="M_C6">4873</li>
                                                <li id="M_C7">4067</li>
                                                <li id="M_C8">9336</li>
                                                <li id="M_C9">9049</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="P">
                                 <table>
                                    <caption>
                                       PMP 
                                       <div class="drawdate" id="Pdate">24-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="P_F">9475</li>
                                                <li id="P_S">9850</li>
                                                <li id="P_T">7884</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="P_P0">2279</li>
                                                <li id="P_P1">7978</li>
                                                <li id="P_P2">7562</li>
                                                <li id="P_P3">7609</li>
                                                <li id="P_P4">3344</li>
                                                <li id="P_P5">6333</li>
                                                <li id="P_P6">8756</li>
                                                <li id="P_P7">1184</li>
                                                <li id="P_P8">1554</li>
                                                <li id="P_P9">7339</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="P_C0">7482</li>
                                                <li id="P_C1">5396</li>
                                                <li id="P_C2">8120</li>
                                                <li id="P_C3">5949</li>
                                                <li id="P_C4">7468</li>
                                                <li id="P_C5">8812</li>
                                                <li id="P_C6">6124</li>
                                                <li id="P_C7">9196</li>
                                                <li id="P_C8">6633</li>
                                                <li id="P_C9">8365</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="T">
                                 <table>
                                    <caption>
                                       TOTO 
                                       <div class="drawdate" id="Tdate">24-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="T_F">4419</li>
                                                <li id="T_S">9937</li>
                                                <li id="T_T">7879</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="T_P0">1089</li>
                                                <li id="T_P1">1778</li>
                                                <li id="T_P2">6839</li>
                                                <li id="T_P3">1389</li>
                                                <li id="T_P4">8696</li>
                                                <li id="T_P5">5204</li>
                                                <li id="T_P6">0836</li>
                                                <li id="T_P7">0065</li>
                                                <li id="T_P8">6282</li>
                                                <li id="T_P9">1930</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="T_C0">8413</li>
                                                <li id="T_C1">5914</li>
                                                <li id="T_C2">7638</li>
                                                <li id="T_C3">9719</li>
                                                <li id="T_C4">4139</li>
                                                <li id="T_C5">2512</li>
                                                <li id="T_C6">1679</li>
                                                <li id="T_C7">9658</li>
                                                <li id="T_C8">9102</li>
                                                <li id="T_C9">6724</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="S">
                                 <table>
                                    <caption>
                                       SINGAPORE 
                                       <div class="drawdate" id="Sdate">24-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="S_F">2489</li>
                                                <li id="S_S">7926</li>
                                                <li id="S_T">4674</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="S_P0">9911</li>
                                                <li id="S_P1">8952</li>
                                                <li id="S_P2">8646</li>
                                                <li id="S_P3">6949</li>
                                                <li id="S_P4">5852</li>
                                                <li id="S_P5">4973</li>
                                                <li id="S_P6">3898</li>
                                                <li id="S_P7">2945</li>
                                                <li id="S_P8">1939</li>
                                                <li id="S_P9">0463</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="S_C0">7521</li>
                                                <li id="S_C1">4127</li>
                                                <li id="S_C2">2605</li>
                                                <li id="S_C3">2154</li>
                                                <li id="S_C4">1968</li>
                                                <li id="S_C5">1805</li>
                                                <li id="S_C6">0789</li>
                                                <li id="S_C7">0676</li>
                                                <li id="S_C8">0668</li>
                                                <li id="S_C9">0000</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="B">
                                 <table>
                                    <caption>
                                       SABAH 
                                       <div class="drawdate" id="Bdate"></div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="B_F"></li>
                                                <li id="B_S"></li>
                                                <li id="B_T"></li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="B_P0"></li>
                                                <li id="B_P1"></li>
                                                <li id="B_P2"></li>
                                                <li id="B_P3"></li>
                                                <li id="B_P4"></li>
                                                <li id="B_P5"></li>
                                                <li id="B_P6"></li>
                                                <li id="B_P7"></li>
                                                <li id="B_P8"></li>
                                                <li id="B_P9"></li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="B_C0"></li>
                                                <li id="B_C1"></li>
                                                <li id="B_C2"></li>
                                                <li id="B_C3"></li>
                                                <li id="B_C4"></li>
                                                <li id="B_C5"></li>
                                                <li id="B_C6"></li>
                                                <li id="B_C7"></li>
                                                <li id="B_C8"></li>
                                                <li id="B_C9"></li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="K">
                                 <table>
                                    <caption>
                                       SANDAKEN 
                                       <div class="drawdate" id="Kdate">15-03-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="K_F">2278</li>
                                                <li id="K_S">0607</li>
                                                <li id="K_T">5225</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="K_P0">5450</li>
                                                <li id="K_P1">4664</li>
                                                <li id="K_P2">8362</li>
                                                <li id="K_P3">1566</li>
                                                <li id="K_P4">9227</li>
                                                <li id="K_P5">9847</li>
                                                <li id="K_P6">5885</li>
                                                <li id="K_P7">5627</li>
                                                <li id="K_P8">5956</li>
                                                <li id="K_P9">6184</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="K_C0">6246</li>
                                                <li id="K_C1">0698</li>
                                                <li id="K_C2">4681</li>
                                                <li id="K_C3">2456</li>
                                                <li id="K_C4">5351</li>
                                                <li id="K_C5">3424</li>
                                                <li id="K_C6">5463</li>
                                                <li id="K_C7">6054</li>
                                                <li id="K_C8">6905</li>
                                                <li id="K_C9">9615</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="W">
                                 <table>
                                    <caption>
                                       SARAWAK 
                                       <div class="drawdate" id="Wdate">24-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="W_F">3787</li>
                                                <li id="W_S">8470</li>
                                                <li id="W_T">2722</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="W_P0">6336</li>
                                                <li id="W_P1">8396</li>
                                                <li id="W_P2">1124</li>
                                                <li id="W_P3">2280</li>
                                                <li id="W_P4">1365</li>
                                                <li id="W_P5">5825</li>
                                                <li id="W_P6">9341</li>
                                                <li id="W_P7">5095</li>
                                                <li id="W_P8">5487</li>
                                                <li id="W_P9">0824</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="W_C0">2501</li>
                                                <li id="W_C1">0714</li>
                                                <li id="W_C2">3216</li>
                                                <li id="W_C3">9179</li>
                                                <li id="W_C4">4064</li>
                                                <li id="W_C5">0669</li>
                                                <li id="W_C6">4134</li>
                                                <li id="W_C7">2067</li>
                                                <li id="W_C8">5073</li>
                                                <li id="W_C9">5144</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="H">
                                 <table>
                                    <caption>
                                       GDLotto 
                                       <div class="drawdate" id="Hdate">26-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="H_F">4344</li>
                                                <li id="H_S">5321</li>
                                                <li id="H_T">7368</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="H_P0">4976</li>
                                                <li id="H_P1">3700</li>
                                                <li id="H_P2">8766</li>
                                                <li id="H_P3">6699</li>
                                                <li id="H_P4">0054</li>
                                                <li id="H_P5">4057</li>
                                                <li id="H_P6">1707</li>
                                                <li id="H_P7">6570</li>
                                                <li id="H_P8">3544</li>
                                                <li id="H_P9">1567</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="H_C0">4215</li>
                                                <li id="H_C1">5641</li>
                                                <li id="H_C2">0836</li>
                                                <li id="H_C3">2883</li>
                                                <li id="H_C4">5573</li>
                                                <li id="H_C5">2641</li>
                                                <li id="H_C6">4008</li>
                                                <li id="H_C7">9115</li>
                                                <li id="H_C8">0702</li>
                                                <li id="H_C9">7337</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="N">
                                 <table>
                                    <caption>
                                       Perdana 
                                       <div class="drawdate" id="Ndate">26-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="N_F">6310</li>
                                                <li id="N_S">8360</li>
                                                <li id="N_T">4434</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="N_P0">9269</li>
                                                <li id="N_P1">9082</li>
                                                <li id="N_P2">3140</li>
                                                <li id="N_P3">3322</li>
                                                <li id="N_P4">9189</li>
                                                <li id="N_P5">4416</li>
                                                <li id="N_P6">4954</li>
                                                <li id="N_P7">4653</li>
                                                <li id="N_P8">1796</li>
                                                <li id="N_P9">2353</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="N_C0">6076</li>
                                                <li id="N_C1">5947</li>
                                                <li id="N_C2">6455</li>
                                                <li id="N_C3">7932</li>
                                                <li id="N_C4">2630</li>
                                                <li id="N_C5">8796</li>
                                                <li id="N_C6">1524</li>
                                                <li id="N_C7">0996</li>
                                                <li id="N_C8">5176</li>
                                                <li id="N_C9">5435</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="R">
                                 <table>
                                    <caption>
                                       LuckyHari-Hari 
                                       <div class="drawdate" id="Rdate">26-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="R_F">4044</li>
                                                <li id="R_S">1202</li>
                                                <li id="R_T">3655</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="R_P0">5715</li>
                                                <li id="R_P1">4188</li>
                                                <li id="R_P2">6537</li>
                                                <li id="R_P3">5833</li>
                                                <li id="R_P4">4510</li>
                                                <li id="R_P5">2317</li>
                                                <li id="R_P6">6559</li>
                                                <li id="R_P7">0038</li>
                                                <li id="R_P8">9822</li>
                                                <li id="R_P9">5395</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="R_C0">0813</li>
                                                <li id="R_C1">1779</li>
                                                <li id="R_C2">1136</li>
                                                <li id="R_C3">6164</li>
                                                <li id="R_C4">9246</li>
                                                <li id="R_C5">2391</li>
                                                <li id="R_C6">6855</li>
                                                <li id="R_C7">5248</li>
                                                <li id="R_C8">6427</li>
                                                <li id="R_C9">6402</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                              <li id="G">
                                 <table>
                                    <caption>
                                       GOOD4D 
                                       <div class="drawdate" id="Gdate">26-06-2020</div>
                                    </caption>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <ol class="abc">
                                                <li id="G_F">4046</li>
                                                <li id="G_S">0845</li>
                                                <li id="G_T">8338</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="p">
                                                <li id="G_P0">8495</li>
                                                <li id="G_P1">7091</li>
                                                <li id="G_P2">4021</li>
                                                <li id="G_P3">8058</li>
                                                <li id="G_P4">6209</li>
                                                <li id="G_P5">4399</li>
                                                <li id="G_P6">1644</li>
                                                <li id="G_P7">6427</li>
                                                <li id="G_P8">3808</li>
                                                <li id="G_P9">6822</li>
                                             </ol>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <ol class="c">
                                                <li id="G_C0">9219</li>
                                                <li id="G_C1">8880</li>
                                                <li id="G_C2">5685</li>
                                                <li id="G_C3">5066</li>
                                                <li id="G_C4">2965</li>
                                                <li id="G_C5">4891</li>
                                                <li id="G_C6">3560</li>
                                                <li id="G_C7">3489</li>
                                                <li id="G_C8">3927</li>
                                                <li id="G_C9">1988</li>
                                             </ol>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </li>
                           </ul>
                        </div>
                        <script>
                           $(document).ready(function(){
                            $.ajax({
                                    type: 'GET',
                                    contentType: "application/json; charset=utf-8",
                                    url: '/getLiveResult.php',
                                    data: {},
                                    dataType:'json',
                                    success: function (data) {
                                        $.each(data, function(i,val){
                                          if(val === null || i === '_5D' || i === '_6D'){ return;}
                                          var parts = (val.DrawDate).split('-');
                                          var drawdate = parts[2] + '-' + parts[1] + '-' + parts[0];
                                          $('#'+i+'date').html(drawdate);
                                          
                                          $('#'+i+'_F').html(val._1);
                                          $('#'+i+'_S').html(val._2);
                                          $('#'+i+'_T').html(val._3);
                                          
                                          var itemtoRemove = '....';
                                          val._P = $.grep(val._P, function(value) {
                                            return value != itemtoRemove;
                                          });
                           
                                          for(var j=0; j<val._P.length; j++){
                                            if(val._P[j] !== '....'){ $('#'+i+'_P'+j).html(val._P[j]);}
                                          }
                                          
                                          for(var k=0; k<val.C.length; k++){
                                            $('#'+i+'_C'+k).html(val.C[k]);
                                          }
                                          
                                        });
                                    }
                                });
                           });
                        </script>
                     </div>    
   </main>
 </body>
</html>

<?php } ?>
<style type="text/css">
  .product li {
    display: inline-block;
    background: url(<?php  echo $this->config->item('tem_frontend_img'); ?>bg-slot.png);
    position: relative;
    padding-bottom: 20px;
    padding-top:20px;
    }

    .product {
        padding: 0;
        text-align: center;
    }

    ol, ul {
        list-style: none;
    }
    .product_content {
        position: absolute;
        left: 30px;
        top: 50%;
        transform: translate(0%,-50%);
        text-align: left;
        color: #fbff98;
        width: 280px;
    }
    .img100 {
        max-width: 90%;
    }
    a.play_button {
    padding: 10px;
    border: 2px outset #fff;
    border-radius: 5px;
    background: linear-gradient(150deg, #9d9d9d, white);
    margin-top: 10px;
    display: inline-block;
    width: max-content;
    color: black;
    font-weight: 900;
}
</style>
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
  <main class="main" style="background-image: url(<?php echo $this->config->item('tem_frontend_img');?>imiwinbg.jpg);">
  
   <section class="featured-procuts-section container">
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

        <div class="featured-product">
            <div class="featured-list"><center>
               <div class="featured-division col-4">
                  <div class="featured-item">
                    <a href="<?php echo base_url()?>web/winsports"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.comhttps://imiplus.com/data/1744/uploads/SPORTS1.png" width="315"></p></a>                   
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                    <a href="<?php echo base_url()?>web/wincasino"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.comhttps://imiplus.com/data/1744/uploads/casin.png" width="315px"></p></a></div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                <a href="<?php echo base_url()?>web/wingame"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.comhttps://imiplus.com/data/1744/uploads/E-GAME1.jpg.png" width="315px"></p></a>  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.comhttps://imiplus.com/data/1744/uploads/FISH-GAME1.png" width="315px"></p>                     
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item"><a href="<?php echo base_url()?>web/winlotto">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.comhttps://imiplus.com/data/1744/uploads/LOTTO1.png" width="315px"></p></a>                     
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item"><a href="<?php echo base_url()?>web/wincockfight">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.comhttps://imiplus.com/data/1744/uploads/cockfight1.jpg.png" width="315px"></p></a>                    
                  </div>
               </div>
            </center>
            </div>
         </div>        
      </section> 
      <div class="introduce" style="color: white;border-radius: 0 90px 0 90px;text-align: justify;padding: 20px 40px;margin: 25px 0;border: 5px solid #1C6EA4;">
      <span style="font-size: 22px;color: yellow;">IMIWIN เว็บพนันบอล คุณภาพระดับโลก</span> พัฒนาเพื่อคนไทย ด้วย เกมเดิมพนันที่ครบครัน ไม่ว่าจะเป็นแทงบอล เเทงมวย เเทงหวย เเละเกมอื่นๆ ที่ทุกท่านคุ้นเคย เช่น ไฮโล น้ำเต้าปูปลา เสือมังกร เเละอื่นๆอีกมากมายให้ท่านได้เลือกเล่น เเละเพลิดเพลินกับทางเว็บไซต์ของเรา
    </div>
  </main>

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
   <head>
      <title>Thailand No.1 Online Casino Betting - IMIPLUS</title>
      <meta name="description" content="$ เข้าร่วมทันที คลิกที่นี่เพื่อรับการส่งเสริม เข้าร่�">
      <meta name="keywords" content=",IMIPLUS">
      <meta name="copyright" content="IMIPLUS">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="Language" content="Thai">
      <meta name="viewport" content="width=device-width">
      <meta name="robots" content="index,follow,all">
      <meta name="googlebot" content="index,follow,all">
      <meta name="revisit-after" content="2 days">
      <meta baidu-gxt-verify-token="618376288c24b078b5120ca4e8ebabec">
      <meta property="og:url" content="https://imiplus.com/th/home">
      <meta property="og:type" content="website">
      <meta property="og:title" content="Thailand No.1 Online Casino Betting - IMIPLUS">
      <meta property="og:description" content="IMIPLUS">
      <meta property="og:image" content="//imiplus.com/data/1742/uploads/logo.png">
      <meta property="og:site_name" content="IMIPLUS">
      <meta property="twitter:card" content="summary">
      <meta property="twitter:title" content="Thailand No.1 Online Casino Betting - IMIPLUS">
      <meta property="twitter:tidescription" content="IMIPLUS">
      <link rel="alternate" hreflang="x-default" href="https://imiplus.com/home">
      <link rel="canonical" href="https://imiplus.com/th/home">
      <link rel="stylesheet" type="text/css" href="https://imiplus.com/theme/imi55/imgs/../style.css">
      <link rel="stylesheet" type="text/css" href="https://imiplus.com/inc/js/jquery.flexslider/flexslider.css">
      <script language="JavaScript" src="https://imiplus.com/inc/js/common.js"></script>
      <script language="JavaScript" src="https://imiplus.com/inc/js/jquery.latest.min.js"></script>
      <script language="JavaScript" src="https://imiplus.com/inc/js/jquery.url.js"></script>
      <script language="JavaScript" src="https://imiplus.com/inc/js/jquery.flexslider/jquery.flexslider.js"></script>
      <script language="JavaScript" src="https://imiplus.com/inc/js/jQuery.base64.js"></script>
      <script language="JavaScript" src="https://imiplus.com/inc/js/running-clock/clock-en.js"></script>
      <style type="text/css" media="screen"></style>
      <link rel="stylesheet" type="text/css" href="/data/1742/imi55.css?v=1593401631">
      <!--[if IE]>
      <link rel='stylesheet' type='text/css' href='/data/1742/imi55-ie.css?v=1593401631' >
      <![endif]-->
      <link rel="alternate" type="application/rss+xml" title="IMIPLUS.COM RSS FEED" href="https://imiplus.com/th/rss">
      <link rel="alternate" type="application/rss+xml" title="IMIPLUS.COM CATALOGUE FEED" href="https://imiplus.com/th/rss/prod">
      <link rel="alternate" type="application/rss+xml" title="IMIPLUS.COM NEWS FEED" href="https://imiplus.com/th/rss/news">
      <link rel="shortcut icon" href="/icon.gif" type="image/x-icon">
   </head>
 <body>
      <div>
         <div id="divHeader">
            <div>
               <div id="divHeader-logo">
                  <img src="https://imiplus.com/data/1742/uploads/logo.png" border="0" id="imgLogo">
                  <div id="subcontent">
                     <a href="https://imiplus.com/th/home">
                     <img src="https://imiplus.com/data/1742/uploads/logo.png" id="img-logo">
                     </a>
                     <style>
                        @media screen and (max-width: 1023px) {
                        #cssmenu > ul:after {
                        background-image: url('https://imiplus.com/data/1742/uploads/logo.png');
                        }
                        }
                     </style>
                  </div>
               </div>
               <div id="divHeader-right">
                  <div id="subcontent">
                     <div id="btnLine">
                        <a href="#">LINE</a>
                        <span class="contact-toggle" style="display:none !important;">
                           <div style="background-color:red; width:150px; height:150px;"></div>
                           IMI55 LINE
                        </span>
                     </div>
                     <div id="divHeader-register">
                        <a href="https://imiplus.com/th/registration">
                        Register
                        </a>
                     </div>
                     <div id="divHeader-login">
                        <div id="BtnLogin-home">
                           Login
                        </div>
                        <div id="window-login">
                           <form id="customform" class="customform" method="POST" action="/postprocv2.php">
                              <input type="hidden" id="customform_lang" name="Lang" value="th-th">
                              <input type="hidden" id="customform_Com" name="Com" value="IMIPLUS">
                              <input type="hidden" id="customform_CustomDomain" name="CustomDomain" value="0"><input type="hidden" id="customform_IsMobile" name="IsMobile" value="false">
                              <dl>
                                 <dd><input type="text" id="customform_UserName" name="UserName" placeholder="ชื่อผู้ใช้" maxlength="15" oninvalid="this.setCustomValidity(&quot;โปรดกรอกข้อมูลในช่องนี้&quot;)" required=""></dd>
                              </dl>
                              <dl>
                                 <dd><input type="password" id="customform_Password" name="Password" placeholder="รหัสผ่าน" oninvalid="this.setCustomValidity(&quot;โปรดกรอกข้อมูลในช่องนี้&quot;)" required=""></dd>
                              </dl>
                              <dl>
                                 <dd><input type="submit" value="เข้าสู่ระบบ" id="customform_submit"></dd>
                              </dl>
                              <div id="customformmsg"></div>
                           </form>
                           <script> 
                              function setCookie(name,value,expires){
                                  document.cookie = name + "=" + value + ((expires==null) ? "-1" : ";expires=" + expires.toGMTString());
                              }
                              
                              function getCookie(cname) {
                                  var name = cname + "=";
                                  var decodedCookie = decodeURIComponent(document.cookie);
                                  var ca = decodedCookie.split(';');
                                  for(var i = 0; i < ca.length; i++) {
                                    var c = ca[i];
                                    while (c.charAt(0) == " ") {
                                       c = c.substring(1);
                                    }
                                    if (c.indexOf(name) == 0) {
                                       return c.substring(name.length, c.length);
                                    }
                                  }
                                  return "";
                              }
                              
                              $(document).ready(function(){
                                  
                              
                              
                              $( window ).load(function() {
                                  var token=getCookie("Token");
                                  if (token != "") {
                                    
                                    var postData = 'Token='+token+'&';            
                                    $.ajax({
                              
                                        url : "https://imiplus.com/posttokenv2.php",
                                        type: "POST",
                                        data : postData,
                                        success:function(data, textStatus, jqXHR) 
                                        {
                                            var obj = JSON.parse(data);   
                                            if(obj.Status==true){
                                              $('#customform').html('<p><div id=\'redirectaddr\'><a href=\'#\' target=\'_blank\'>คลิกที่นี่ กลับสู่หน้าผู้ใช้หลัก</a></div></p>');                    
                                              $('#customform #redirectaddr a').attr("href", obj.Redirect + "/sport" );
                                            }else{
                                              setCookie("Token", "");
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) 
                                        {
                                            setCookie("Token", "" );
                                        }
                                    });  
                                  } else {
                                     setCookie("Token", "");
                                  }
                              });
                              
                              response = 'promt';
                              $('#customform').submit(function(e){  
                              
                              this.disabled=1;
                              var txt=$('#customform input:text[name="UserName"]').val();
                              if(!txt){
                                        msg = 'ต้องระบุรหัสเข้าสู่ระบบ';            
                                        if(response=='screen') $( '#customformmsg' ).html(msg);
                                        else alert(msg);
                                 this.disabled=0;
                                return;
                              }
                              var pwd=$('#customform input:password[name="Password"]').val();
                              if(!pwd){
                                        msg = 'ต้องระบุรหัสผ่าน';           
                                        if(response=='screen') $( '#customformmsg' ).html(msg);
                                        else alert(msg);
                                 this.disabled=0;
                                return;
                              }
                              
                                if(response=='screen') $( '#customformmsg' ).html('กำลังโหลด ...');
                                 var postData = $(this).serializeArray();
                                 var formURL = $(this).attr("action");
                                 $.ajax(
                                 {
                                     url : formURL,
                                type: 'POST',
                                headers:{'X-Requested-Source': 'JS'},
                                     data : postData,
                                     success:function(data, textStatus, jqXHR) 
                                     {
                                        
                                        var obj = JSON.parse(data);
                                        
                                        if (obj.Login === 0 || obj.Login > 0) {
                                          msg = 'ความสำเร็จในการเข้าสู่ระบบการเชื่อมต่อ ...';
                                          if(obj.Text) msg = obj.Text;
                                          
                                          var expirydate=new Date();
                                          expirydate.setTime( expirydate.getTime()+(100*60*60*24*100) );
                                          setCookie("Token", obj.Token ,expirydate);
                                          
                                          window.top.location.href = obj.Redirect;
                                        }
                                        else{
                                          msg = 'เข้าสู่ระบบล้มเหลว';
                                          if(obj.Login === -6){
                                             msg = 'บัญชีที่ถูกระงับ';
                                          }else if(obj.Login === -3){
                                             msg = 'ไม่พบสมาชิก';
                                          }else if(obj.Login === false){
                                            msg = obj.Text;
                                          }else{
                                            msg = 'การเข้าสู่ระบบไม่ถูกต้อง';
                                          }
                                          //console.log(obj);
                                          alert(msg);
                                          
                                        }
                                         
                                     },
                                     error: function(jqXHR, textStatus, errorThrown) 
                                     {
                                         //if fails
                                     }
                                 });
                                 e.preventDefault(); //STOP default action
                                 //e.unbind(); //unbind. to stop multiple form submit.
                              });
                              
                              $('#customform').submit(function() {
                                $(this).find('#customform input[type="button"]').prop('disabled',true);
                              });
                              
                              });
                           </script>
                        </div>
                        <script type="text/javascript">
                           $('#BtnLogin-home').click(function(){
                               $('#window-login').addClass('active');
                           });
                           
                           $('#window-login').click(function () {
                               if (!$(event.target).closest('#window-login>form').length) {
                                   $('#window-login').removeClass('active');
                               };
                           });
                        </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div id="divHeader-menu">
            <div id="cssmenu" class="cmsmenu">
               <ul>
                  <li class="active "><a href="https://imiplus.com/th/home" target="_self"><i class="icn-home"></i>บ้าน</a></li>
                  <li class="has-sub ">
                     <a href="https://imiplus.com/th/sportsbook" target="_self"><i class="icn-sport"></i>กีฬา</a>
                     <ul>
                        <li class=""><a href="https://imiplus.com/th/s-sport" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-sSport_w.png">S Sport</a></li>
                        <li class=""><a href="https://imiplus.com/th/m-sport" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-mSport.png">M Sport</a></li>
                        <li class=""><a href="https://imiplus.com/th/sportsbook" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-eSport_w.png">AI Esport</a></li>
                        <li class=""><a href="#" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-maxbet.png">MaxBet</a></li>
                     </ul>
                  </li>
                  <li class="has-sub ">
                     <a href="https://imiplus.com/th/live-casino" target="_self"><i class="icn-casino"></i>คาสิโนสด</a>
                     <ul>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-wmCasino.png"> WM Casino</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-sexyBaccarat.png"> Sexy Baccarat</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-saGaming_w.png">SA Casino</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-luckyStreak.png"> Lucky Streak</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-king855.png"> King855</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-guarantedGaming.png"> Fair Guaranted Gaming</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-goldDeluxe.png">Gold Deluxe</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-evolutionGaming_w.png">Evo Casino</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-dreamGaming.png">Dream Gaming</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-bigGaming_w.png">Big Gaming</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-allbet.png">Allbet</a></li>
                        <li class=""><a href="https://imiplus.com/th/live-casino" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-agGaming_w.png">AG Casino</a></li>
                     </ul>
                  </li>
                  <li class="has-sub ">
                     <a href="https://imiplus.com/th/games" target="_self"><i class="icn-games"></i>เกมสล็อต</a>
                     <ul>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-visualTech_w.png">Visual Tech</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-skywind_w.png">Skywind</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-pragmaticplay_w.png">Pragmatic Play</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-playtech_w.png">Playtech</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-joker.png">Joker</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-ggGaming.png">GG Gaming</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-dreamTech_w.png">Dream Tech</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-betsoft.png">Betsoft</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-ace333.png">ACE333</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-saGaming_w.png">SA Gaming</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-cq9_w.png">CQ9</a></li>
                        <li class=""><a href="https://imiplus.com/th/games" target="_self"><img src="https://imiplus.com/data/1742/uploads/logo-bigGaming_w.png">Big Gaming</a></li>
                     </ul>
                  </li>
                  <li class=""><a href="https://imiplus.com/th/lottery" target="_self"><i class="icn-lottery"></i>หวย</a></li>
                  <li class=""><a href="https://imiplus.com/th/cockfight" target="_self"><i class="icn-cockfight"></i>ชนไก่</a></li>
                  <li class=""><a href="https://imiplus.com/th/promotions" target="_self"><i class="icn-promotion"></i>โปรโมชั่</a></li>
                  <li class=""><a href="https://imiplus.com/th/live-score" target="_self"><i class="icn-livescore"></i>คะแนนสด</a></li>
                  <li class=""><a href="https://imiplus.com/th/live-tv" target="_self"><i class="icn-livetv"></i>ทีวีสด</a></li>
                  <li class=""><a href="#" target="_self"><i class="icn-download"></i>ดาวน์โหลด</a></li>
                  <li class=""><a href="#" target="_self"><i class="icn-livechat"></i>แชทสด</a></li>
               </ul>
            </div>
            <div id="subcontent">
               <div id="btnMenu">
                  เมนู
                  <div class="icn-burger">
                     <div>
                        <span></span><span></span><span></span>
                     </div>
                  </div>
               </div>
               <script type="text/javascript">
                  $('#btnMenu').click(function () {
                      $('#cssmenu').addClass('active');
                  });
                  
                  $('#cssmenu').click(function () {
                      if (!$(event.target).closest('#cssmenu>ul').length) {
                          $('#cssmenu').removeClass('active');
                      };
                  });
               </script>
               <div id="divMenu-bottom">
                  <div class="content">
                     <div id="divClock">
                        <ul>
                           <li id="dateToday">29/06/2020</li>
                           <li>&nbsp;</li>
                           <li id="hours">13</li>
                           <li id="point">:</li>
                           <li id="min">40</li>
                           <li id="Li1">:</li>
                           <li id="sec">41</li>
                           <li>&nbsp;</li>
                           <li id="gmt">(GMT+7)</li>
                        </ul>
                        <script type="text/javascript">
                           function getDateToday() {
                               var d = new Date();
                           
                               var month = d.getMonth() + 1;
                               var day = d.getDate();
                           
                               var output = (('' + day).length < 2 ? '0' : '') + day + '/' + (('' + month).length < 2 ? '0' : '') + month + '/' + d.getFullYear();
                           
                               $('#dateToday').html(output);
                           }
                           
                           getDateToday();
                           
                           function getTimezoneOffset() {
                               var offset = new Date().getTimezoneOffset();
                               var sign = offset < 0 ? '+' : '-';
                               offset = Math.abs(offset);
                               return sign + (offset / 60);
                           }
                           
                           $('#gmt').html('(' + 'GMT' + getTimezoneOffset() + ')');
                        </script>
                     </div>
                     <div id="divAnnounce">
                        <marquee id="horizontal-scrolling-msg" scrollamount="3" onmouseover="this.stop()" onmouseout="this.start()">
                           <ul>
                              <li>ยินดีต้อนรับสู่ imiplus.com คาสิโนออนไลน์การพนันที่ดีที่สุดของคุณในประเทศไทย ผู้ค้าคาสิโนสดออนไลน์ที่เซ็กซี่ที่สุด</li>
                           </ul>
                        </marquee>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="divBody">
         <div id="theme-contain-home">
            <style>
               #mainslider {border-left: 1px solid rgba(255,255,255,.15);}
            </style>
            <div id="divHome-top">
               <div id="divHome-banner" class="div-banner">
                  <div id="mainslider" role="main">
                     <section class="flslider">
                        <div class="flexslider">
                           <ul class="slides">
                              <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;"><a href="#"><img src="https://imiplus.com/data/1742/aimg/home-slideBanner-02.jpg" alt="" draggable="false"></a></li>
                              <li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><a href="#"><img src="https://imiplus.com/data/1742/aimg/home-slideBanner-01.jpg" alt="" draggable="false"></a></li>
                           </ul>
                           <ul class="flex-direction-nav">
                              <li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a></li>
                              <li class="flex-nav-next"><a class="flex-next" href="#">Next</a></li>
                           </ul>
                        </div>
                     </section>
                  </div>
                  <script>
                     $( document ).ready(function() {
                     
                           $('.flexslider').flexslider({
                             animation: "fade",
                             randomize:true,
                             controlNav:false,
                             directionNav:true,
                             slideshowSpeed:3000,
                             animationSpeed:600,
                             randomize:false,
                             start: function(slider){
                               $('body').removeClass('webloading');
                             }
                           });
                     
                       // Handler for .ready() called.
                     });
                  </script>
               </div>
               <div id="divHome-jackpot" style="background-image: url('https://imiplus.com/data/1742/uploads/jackpot-th.gif');">
                  <div class="content">
                     <script type="text/javascript">
                        // <![CDATA[
                        $(document).ready(function () {
                            //----------------------------------- DATETIME
                            var d = new Date();
                            var n = d.getTime();
                            var nString = n.toString();
                            var sub = nString.substring(0, 7) * 74;
                            var min = 3000000000.00;
                            var max = 4000000000.00;
                            var random = sub;
                            var increment = random / 2.3;
                            var tmpStart = random;
                            var tmpEnd = random + 10000;
                            $('#foo').counter({ start: tmpStart, end: tmpEnd });
                        });
                        
                        ; (function ($) {
                            $.fn.counter = function (options) {
                        
                                var defaults = {
                                    start: 10000,
                                    end: 20000,
                                    time: 8,
                                    step: 100,
                                    callback: function () {
                                        var start2 = options.end;
                                        var end2 = options.end + options.end;
                                        $('#foo').counter({ start: start2, end: end2, time: options.time, step: options.step });
                                    }
                                }
                                var options = $.extend(defaults, options);
                        
                                var counterFunc = function (el, increment, end, step) {
                                    var min = increment;
                                    var max = min + 1;
                                    var increment = Math.random() * (max - min + 1) + min / 2.1;
                                    var value = parseInt(el.html(), 10) + increment;
                                    if (value >= end) {
                                        //el.html(Math.round(end));
                                        el.html(parseFloat(end).toFixed(2));
                                        options.callback();
                                    } else {
                                        //el.html(Math.round(value));
                                        el.html(parseFloat(value).toFixed(2));
                                        setTimeout(counterFunc, step, el, increment, end, step);
                                    }
                                }
                        
                                $(this).html(Math.round(options.start));
                                //var increment = (options.end - options.start) / ((1000 / options.step) * options.time);
                        
                                var min = 321;
                                var max = 999;
                                var random = Math.floor(Math.random() * (max - min + 1)) + min;
                                var increment = random / 2.3;
                        
                                (function (e, i, o, s) {
                                    setTimeout(counterFunc, s, e, i, o, s);
                                })($(this), increment, options.end, options.step);
                            }
                        })(jQuery);
                        // ]]>
                     </script>
                     <div id="jackpot-count">$ <span id="foo">117929373.71</span></div>
                  </div>
               </div>
               <div id="divHome-step">
                  <div class="btnforRegister">
                     <a href="https://imiplus.com/th/register">
                        <img src="https://imiplus.com/data/1742/uploads/btn-register.png">
                        <h3> เข้าร่วมทันที </h3>
                        <p> คลิกที่นี่เพื่อรับการส่งเสริม </p>
                     </a>
                  </div>
                  <div class="btnforDeposit" style="border: #1e5685 1px solid;">
                     <a href="#">
                        <img src="https://imiplus.com/data/1742/uploads/btn-deposit.png">
                        <h3> เข้าร่วมทันที </h3>
                        <p> คลิกที่นี่เพื่อรับการส่งเสริม </p>
                     </a>
                  </div>
                  <div class="btnforGames" style="border: #1e5685 1px solid;">
                     <a href="https://imiplus.com/th/games">
                        <img src="https://imiplus.com/data/1742/uploads/btn-play.png">
                        <h3> เข้าร่วมทันที </h3>
                        <p> คลิกที่นี่เพื่อรับการส่งเสริม </p>
                     </a>
                  </div>
               </div>
            </div>
            <div id="divHome2" style="border: #1e5685 1px solid;">
               <div id="btnSportsbook">
                  <a href="https://imiplus.com/th/sportsbook">
                     <img src="https://imiplus.com/data/1742/uploads/sport.jpg">
                     <div class="home-slot-detail">
                        <img src="https://imiplus.com/data/1742/uploads/sport.jpg">
                        กีฬา
                     </div>
                  </a>
               </div>
               <div id="btnCasino">
                  <a href="https://imiplus.com/th/live-casino">
                     <img src="https://imiplus.com/data/1742/uploads/casino.jpg">
                     <div class="home-slot-detail">
                        <img src="https://imiplus.com/data/1742/uploads/casino.jpg">
                        คาสิโนสด
                     </div>
                  </a>
               </div>
               <div id="btnGames">
                  <a href="https://imiplus.com/th/games">
                     <img src="https://imiplus.com/data/1742/uploads/slot.jpg">
                     <div class="home-slot-detail">
                        <img src="https://imiplus.com/data/1742/uploads/slot.jpg">
                        เกมสล็อต
                     </div>
                  </a>
               </div>
            </div>
            <div id="divHome-download" style="border: #1e5685 1px solid;">
               <a href="#">
               <img src="https://imiplus.com/data/1742/uploads/imiplus.jpg">
               </a>
            </div>
            <link rel="image_src" href="https://imiplus.com/data/1742/uploads/logo.png">
         </div>
      </div>
      
   </body>


<?php } ?>
<style type="text/css">
   .button {
   font-size: 1em;
   padding: 10px;
   color: #fff;
   border: 2px solid #06D85F;
   border-radius: 20px/50px;
   text-decoration: none;
   cursor: pointer;
   transition: all 0.3s ease-out;
   }
   .button:hover {
   background: #06D85F;
   }
   .overlay {
   position: fixed;
   top: 0;
   bottom: 0;
   left: 0;
   right: 0;
   background: rgba(0, 0, 0, 0.7);
   transition: opacity 500ms;
   visibility: hidden;
   opacity: 0;
   }
   .overlay:target {
   visibility: visible;
   opacity: 1;
   }
   .popup {
   margin: 70px auto;
   padding: 20px;
   background: #fff;
   border-radius: 5px;
   width: 50%;
   position: relative;
   transition: all 5s ease-in-out;
   }
   .popup h2 {
   margin-top: 0;
   color: #333;
   font-family: Tahoma, Arial, sans-serif;
   }
   .popup .close {
   top: 20px;
   right: 30px;
   transition: all 200ms;
   font-size: 30px;
   font-weight: bold;
   text-decoration: none;
   color: #FFFAF0;
   }
   .popup .close:hover {
   color: #06D85F;
   }
   .popup .content {
   max-height: 30%;
   overflow: auto;
   }
   @media screen and (max-width: 700px){
   .box{
   width: 70%;
   }
   .popup{
   width: 70%;
   }
   }
</style>
 <?php

 if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) { ?>

  <div class="canvas" canvas="container" id="canvas">
<div class="main-screen" style="background-image: url(<?php  echo $this->config->item('tem_frontend_img'); ?>m/bg.jpg);">
<header class="header">
   <a href="<?php echo base_url()?>web/" class="header-button header-button-left" id="nav-btn"><span class="icon icon-navicon"></span></a>
   <h1 class="header-title">
      <a href="<?php echo base_url()?>web/"><img alt="โลโก้ imiwinshop สมัครเอเย่นต์" src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png" /></a>
   </h1>
   <a class="header-button header-button-right open-right-sidebar hide"></a>
</header>
<section class="body">
   <div class="banner-main">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner" role="listbox" style="margin-top: 15px; size: 100%">
            <div class="item active"><img src="https://www.hackimi.com/resource/slider/slid1.jpg" class="img-responsive" alt="สมัครเอเย่นต์ แทงบอล บาคาร่า"></div>
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
         <div id="lazy-contain">
            <div class="dash-widgets css-loader-ready">
              <section class="featured-procuts-section container" style="background-image: url('https://www.hackimi.com/resource/pict/BG-IMI-1920x1080.jpg');background-repeat:repeat;  background-attachment: fixed;">
          <div class="featured-product">
            <div class="featured-list">
               
                      <div style="width: 100%; border: solid 0px #fff; margin-top: 30px !important;">
                        <center>
                            <ul class="category row">
                                <li class="col-md-6" style="padding-bottom: 15px !important;">
                                    <a href="<?php echo base_url()?>web/hackcasino"><img class="img100" src="https://www.hackimi.com/resource/pict/vhack/CASINO-Hack_new.png" style="width: 215px"></a>
                                </li>
                                <li class="col-md-6">
                                    <a href="<?php echo base_url()?>web/hackgame"><img class="img100" src="https://www.hackimi.com/resource/pict/vhack/GAME-Hack_new.png" style="width: 215px"></a>
                                </li>
                           
                                <li class="col-md-6">
                                    <a href="#"><img class="img100" src="https://www.hackimi.com/hresource/pict/vhack/SPORT-Hack_new.png" style="width: 215px"></a>
                                </li>
                                <li class="col-md-6">
                                    <a href="#"><img class="img100" src="https://www.hackimi.com/resource/pict/vhack/LOTTO-Hack_new.png" style="width: 215px"></a>
                                </li>
                            </ul>
                            <img class="img100" src="<?php echo $this->config->item('tem_frontend_img'); ?>f2.jpg" width="295px" >
                        </center>
                      </div>         
            </div>
          </div>
        </section>
               <div class="module contact-bg">
                  <div class="module-header">
                     <div class="media">
                        <div class="media-body" align="center">
                           <h4 class="media-heading">
                              <br />
                              <span style="color: #fff; text-align: center;">IMIWINSHOP</span>
                           </h4>
                           <p style="color: #fff;">
                              ยินดีต้อนรับสู่ IMIWINSHOP หนึ่งในผู้นำเว็บไซต์เดิมพันออนไลน์ของเอเชีย ที่ส่งตรงถึงบ้านคุณเพื่อให้ท่านได้รับประสบการณ์ที่ดีที่สุดกับการเดิมพันออนไลน์ ทางเว็บไซต์ของเราประกอบไปด้วย การเดิมพันกีฬา,
                              เกมส์คาสิโนออนไลน์, คีโน, โป๊กเกอร์ออนไลน์, แฟลชเกมส์ และเกมส์เดิมพันออนไลน์ระดับโลกมากมาย
                           </p>
                        </div>
                        <div class="media-right"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="home-footer">
            <p id="copyright"></p>
            <h2><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="สมัครเอเย่นต์ แทงบอล บาคาร่า" class="img-responsive center-block" style="width: 80%; text-align: center;" /></h2>
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

        // End time for diff purposes
        var endTimeDiff = new Date().getTime() + 15000;
        // This is server's time
        var timeThere = new Date();
        // This is client's time (delayed)
        var timeHere = new Date(timeThere.getTime() - 5434);
        // Get the difference between client time and server time
        var diff_ms = timeHere.getTime() - timeThere.getTime();
        // Get the rounded difference in seconds
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

  <style>

.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 100%;
  position: relative;
  margin: auto;
   z-index: -1;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
 
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>


  <style>
            @charset "UTF-8";
            .swal2-popup.swal2-toast {
                flex-direction: row;
                align-items: center;
                width: auto;
                padding: 0.625em;
                overflow-y: hidden;
                box-shadow: 0 0 0.625em #d9d9d9;
            }
            .swal2-popup.swal2-toast .swal2-header {
                flex-direction: row;
            }
            .swal2-popup.swal2-toast .swal2-title {
                flex-grow: 1;
                justify-content: flex-start;
                margin: 0 0.6em;
                font-size: 1em;
            }
            .swal2-popup.swal2-toast .swal2-footer {
                margin: 0.5em 0 0;
                padding: 0.5em 0 0;
                font-size: 0.8em;
            }
            .swal2-popup.swal2-toast .swal2-close {
                position: static;
                width: 0.8em;
                height: 0.8em;
                line-height: 0.8;
            }
            .swal2-popup.swal2-toast .swal2-content {
                justify-content: flex-start;
                font-size: 1em;
            }
            .swal2-popup.swal2-toast .swal2-icon {
                width: 2em;
                min-width: 2em;
                height: 2em;
                margin: 0;
            }
            .swal2-popup.swal2-toast .swal2-icon::before {
                display: flex;
                align-items: center;
                font-size: 2em;
                font-weight: 700;
            }
            @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
                .swal2-popup.swal2-toast .swal2-icon::before {
                    font-size: 0.25em;
                }
            }
            .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring {
                width: 2em;
                height: 2em;
            }
            .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^="swal2-x-mark-line"] {
                top: 0.875em;
                width: 1.375em;
            }
            .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^="swal2-x-mark-line"][class$="left"] {
                left: 0.3125em;
            }
            .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^="swal2-x-mark-line"][class$="right"] {
                right: 0.3125em;
            }
            .swal2-popup.swal2-toast .swal2-actions {
                flex-basis: auto !important;
                width: auto;
                height: auto;
                margin: 0 0.3125em;
            }
            .swal2-popup.swal2-toast .swal2-styled {
                margin: 0 0.3125em;
                padding: 0.3125em 0.625em;
                font-size: 1em;
            }
            .swal2-popup.swal2-toast .swal2-styled:focus {
                box-shadow: 0 0 0 0.0625em #fff, 0 0 0 0.125em rgba(50, 100, 150, 0.4);
            }
            .swal2-popup.swal2-toast .swal2-success {
                border-color: #a5dc86;
            }
            .swal2-popup.swal2-toast .swal2-success [class^="swal2-success-circular-line"] {
                position: absolute;
                width: 1.6em;
                height: 3em;
                transform: rotate(45deg);
                border-radius: 50%;
            }
            .swal2-popup.swal2-toast .swal2-success [class^="swal2-success-circular-line"][class$="left"] {
                top: -0.8em;
                left: -0.5em;
                transform: rotate(-45deg);
                transform-origin: 2em 2em;
                border-radius: 4em 0 0 4em;
            }
            .swal2-popup.swal2-toast .swal2-success [class^="swal2-success-circular-line"][class$="right"] {
                top: -0.25em;
                left: 0.9375em;
                transform-origin: 0 1.5em;
                border-radius: 0 4em 4em 0;
            }
            .swal2-popup.swal2-toast .swal2-success .swal2-success-ring {
                width: 2em;
                height: 2em;
            }
            .swal2-popup.swal2-toast .swal2-success .swal2-success-fix {
                top: 0;
                left: 0.4375em;
                width: 0.4375em;
                height: 2.6875em;
            }
            .swal2-popup.swal2-toast .swal2-success [class^="swal2-success-line"] {
                height: 0.3125em;
            }
            .swal2-popup.swal2-toast .swal2-success [class^="swal2-success-line"][class$="tip"] {
                top: 1.125em;
                left: 0.1875em;
                width: 0.75em;
            }
            .swal2-popup.swal2-toast .swal2-success [class^="swal2-success-line"][class$="long"] {
                top: 0.9375em;
                right: 0.1875em;
                width: 1.375em;
            }
            .swal2-popup.swal2-toast.swal2-show {
                -webkit-animation: swal2-toast-show 0.5s;
                animation: swal2-toast-show 0.5s;
            }
            .swal2-popup.swal2-toast.swal2-hide {
                -webkit-animation: swal2-toast-hide 0.1s forwards;
                animation: swal2-toast-hide 0.1s forwards;
            }
            .swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-tip {
                -webkit-animation: swal2-toast-animate-success-line-tip 0.75s;
                animation: swal2-toast-animate-success-line-tip 0.75s;
            }
            .swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-long {
                -webkit-animation: swal2-toast-animate-success-line-long 0.75s;
                animation: swal2-toast-animate-success-line-long 0.75s;
            }
            .swal2-container {
                display: flex;
                position: fixed;
                z-index: 1060;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                padding: 0.625em;
                overflow-x: hidden;
                transition: background-color 0.1s;
                background-color: transparent;
                -webkit-overflow-scrolling: touch;
            }
            .swal2-container.swal2-top {
                align-items: flex-start;
            }
            .swal2-container.swal2-top-left,
            .swal2-container.swal2-top-start {
                align-items: flex-start;
                justify-content: flex-start;
            }
            .swal2-container.swal2-top-end,
            .swal2-container.swal2-top-right {
                align-items: flex-start;
                justify-content: flex-end;
            }
            .swal2-container.swal2-center {
                align-items: center;
            }
            .swal2-container.swal2-center-left,
            .swal2-container.swal2-center-start {
                align-items: center;
                justify-content: flex-start;
            }
            .swal2-container.swal2-center-end,
            .swal2-container.swal2-center-right {
                align-items: center;
                justify-content: flex-end;
            }
            .swal2-container.swal2-bottom {
                align-items: flex-end;
            }
            .swal2-container.swal2-bottom-left,
            .swal2-container.swal2-bottom-start {
                align-items: flex-end;
                justify-content: flex-start;
            }
            .swal2-container.swal2-bottom-end,
            .swal2-container.swal2-bottom-right {
                align-items: flex-end;
                justify-content: flex-end;
            }
            .swal2-container.swal2-bottom-end > :first-child,
            .swal2-container.swal2-bottom-left > :first-child,
            .swal2-container.swal2-bottom-right > :first-child,
            .swal2-container.swal2-bottom-start > :first-child,
            .swal2-container.swal2-bottom > :first-child {
                margin-top: auto;
            }
            .swal2-container.swal2-grow-fullscreen > .swal2-modal {
                display: flex !important;
                flex: 1;
                align-self: stretch;
                justify-content: center;
            }
            .swal2-container.swal2-grow-row > .swal2-modal {
                display: flex !important;
                flex: 1;
                align-content: center;
                justify-content: center;
            }
            .swal2-container.swal2-grow-column {
                flex: 1;
                flex-direction: column;
            }
            .swal2-container.swal2-grow-column.swal2-bottom,
            .swal2-container.swal2-grow-column.swal2-center,
            .swal2-container.swal2-grow-column.swal2-top {
                align-items: center;
            }
            .swal2-container.swal2-grow-column.swal2-bottom-left,
            .swal2-container.swal2-grow-column.swal2-bottom-start,
            .swal2-container.swal2-grow-column.swal2-center-left,
            .swal2-container.swal2-grow-column.swal2-center-start,
            .swal2-container.swal2-grow-column.swal2-top-left,
            .swal2-container.swal2-grow-column.swal2-top-start {
                align-items: flex-start;
            }
            .swal2-container.swal2-grow-column.swal2-bottom-end,
            .swal2-container.swal2-grow-column.swal2-bottom-right,
            .swal2-container.swal2-grow-column.swal2-center-end,
            .swal2-container.swal2-grow-column.swal2-center-right,
            .swal2-container.swal2-grow-column.swal2-top-end,
            .swal2-container.swal2-grow-column.swal2-top-right {
                align-items: flex-end;
            }
            .swal2-container.swal2-grow-column > .swal2-modal {
                display: flex !important;
                flex: 1;
                align-content: center;
                justify-content: center;
            }
            .swal2-container:not(.swal2-top):not(.swal2-top-start):not(.swal2-top-end):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-start):not(.swal2-center-end):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-start):not(.swal2-bottom-end):not(.swal2-bottom-left):not(.swal2-bottom-right):not(.swal2-grow-fullscreen)
                > .swal2-modal {
                margin: auto;
            }
            @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
                .swal2-container .swal2-modal {
                    margin: 0 !important;
                }
            }
            .swal2-container.swal2-shown {
                background-color: rgba(0, 0, 0, 0.4);
            }
            .swal2-popup {
                display: none;
                position: relative;
                box-sizing: border-box;
                flex-direction: column;
                justify-content: center;
                width: 32em;
                max-width: 100%;
                padding: 1.25em;
                border: none;
                border-radius: 0.3125em;
                background: #fff;
                font-family: inherit;
                font-size: 1rem;
            }
            .swal2-popup:focus {
                outline: 0;
            }
            .swal2-popup.swal2-loading {
                overflow-y: hidden;
            }
            .swal2-header {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .swal2-title {
                position: relative;
                max-width: 100%;
                margin: 0 0 0.4em;
                padding: 0;
                color: #595959;
                font-size: 1.875em;
                font-weight: 600;
                text-align: center;
                text-transform: none;
                word-wrap: break-word;
            }
            .swal2-actions {
                display: flex;
                z-index: 1;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                width: 100%;
                margin: 1.25em auto 0;
            }
            .swal2-actions:not(.swal2-loading) .swal2-styled[disabled] {
                opacity: 0.4;
            }
            .swal2-actions:not(.swal2-loading) .swal2-styled:hover {
                background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
            }
            .swal2-actions:not(.swal2-loading) .swal2-styled:active {
                background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2));
            }
            .swal2-actions.swal2-loading .swal2-styled.swal2-confirm {
                box-sizing: border-box;
                width: 2.5em;
                height: 2.5em;
                margin: 0.46875em;
                padding: 0;
                -webkit-animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
                animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
                border: 0.25em solid transparent;
                border-radius: 100%;
                border-color: transparent;
                background-color: transparent !important;
                color: transparent;
                cursor: default;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .swal2-actions.swal2-loading .swal2-styled.swal2-cancel {
                margin-right: 30px;
                margin-left: 30px;
            }
            .swal2-actions.swal2-loading :not(.swal2-styled).swal2-confirm::after {
                content: "";
                display: inline-block;
                width: 15px;
                height: 15px;
                margin-left: 5px;
                -webkit-animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
                animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
                border: 3px solid #999;
                border-radius: 50%;
                border-right-color: transparent;
                box-shadow: 1px 1px 1px #fff;
            }
            .swal2-styled {
                margin: 0.3125em;
                padding: 0.625em 2em;
                box-shadow: none;
                font-weight: 500;
            }
            .swal2-styled:not([disabled]) {
                cursor: pointer;
            }
            .swal2-styled.swal2-confirm {
                border: 0;
                border-radius: 0.25em;
                background: initial;
                background-color: #3085d6;
                color: #fff;
                font-size: 1.0625em;
            }
            .swal2-styled.swal2-cancel {
                border: 0;
                border-radius: 0.25em;
                background: initial;
                background-color: #aaa;
                color: #fff;
                font-size: 1.0625em;
            }
            .swal2-styled:focus {
                outline: 0;
                box-shadow: 0 0 0 2px #fff, 0 0 0 4px rgba(50, 100, 150, 0.4);
            }
            .swal2-styled::-moz-focus-inner {
                border: 0;
            }
            .swal2-footer {
                justify-content: center;
                margin: 1.25em 0 0;
                padding: 1em 0 0;
                border-top: 1px solid #eee;
                color: #545454;
                font-size: 1em;
            }
            .swal2-image {
                max-width: 100%;
                margin: 1.25em auto;
            }
            .swal2-close {
                position: absolute;
                z-index: 2;
                top: 0;
                right: 0;
                justify-content: center;
                width: 1.2em;
                height: 1.2em;
                padding: 0;
                overflow: hidden;
                transition: color 0.1s ease-out;
                border: none;
                border-radius: 0;
                outline: initial;
                background: 0 0;
                color: #ccc;
                font-family: serif;
                font-size: 2.5em;
                line-height: 1.2;
                cursor: pointer;
            }
            .swal2-close:hover {
                transform: none;
                background: 0 0;
                color: #f27474;
            }
            .swal2-content {
                z-index: 1;
                justify-content: center;
                margin: 0;
                padding: 0;
                color: #545454;
                font-size: 1.125em;
                font-weight: 400;
                line-height: normal;
                text-align: center;
                word-wrap: break-word;
            }
            .swal2-checkbox,
            .swal2-file,
            .swal2-input,
            .swal2-radio,
            .swal2-select,
            .swal2-textarea {
                margin: 1em auto;
            }
            .swal2-file,
            .swal2-input,
            .swal2-textarea {
                box-sizing: border-box;
                width: 100%;
                transition: border-color 0.3s, box-shadow 0.3s;
                border: 1px solid #d9d9d9;
                border-radius: 0.1875em;
                background: inherit;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.06);
                color: inherit;
                font-size: 1.125em;
            }
            .swal2-file.swal2-inputerror,
            .swal2-input.swal2-inputerror,
            .swal2-textarea.swal2-inputerror {
                border-color: #f27474 !important;
                box-shadow: 0 0 2px #f27474 !important;
            }
            .swal2-file:focus,
            .swal2-input:focus,
            .swal2-textarea:focus {
                border: 1px solid #b4dbed;
                outline: 0;
                box-shadow: 0 0 3px #c4e6f5;
            }
            .swal2-file::-webkit-input-placeholder,
            .swal2-input::-webkit-input-placeholder,
            .swal2-textarea::-webkit-input-placeholder {
                color: #ccc;
            }
            .swal2-file::-moz-placeholder,
            .swal2-input::-moz-placeholder,
            .swal2-textarea::-moz-placeholder {
                color: #ccc;
            }
            .swal2-file:-ms-input-placeholder,
            .swal2-input:-ms-input-placeholder,
            .swal2-textarea:-ms-input-placeholder {
                color: #ccc;
            }
            .swal2-file::-ms-input-placeholder,
            .swal2-input::-ms-input-placeholder,
            .swal2-textarea::-ms-input-placeholder {
                color: #ccc;
            }
            .swal2-file::placeholder,
            .swal2-input::placeholder,
            .swal2-textarea::placeholder {
                color: #ccc;
            }
            .swal2-range {
                margin: 1em auto;
                background: inherit;
            }
            .swal2-range input {
                width: 80%;
            }
            .swal2-range output {
                width: 20%;
                color: inherit;
                font-weight: 600;
                text-align: center;
            }
            .swal2-range input,
            .swal2-range output {
                height: 2.625em;
                padding: 0;
                font-size: 1.125em;
                line-height: 2.625em;
            }
            .swal2-input {
                height: 2.625em;
                padding: 0 0.75em;
            }
            .swal2-input[type="number"] {
                max-width: 10em;
            }
            .swal2-file {
                background: inherit;
                font-size: 1.125em;
            }
            .swal2-textarea {
                height: 6.75em;
                padding: 0.75em;
            }
            .swal2-select {
                min-width: 50%;
                max-width: 100%;
                padding: 0.375em 0.625em;
                background: inherit;
                color: inherit;
                font-size: 1.125em;
            }
            .swal2-checkbox,
            .swal2-radio {
                align-items: center;
                justify-content: center;
                background: inherit;
                color: inherit;
            }
            .swal2-checkbox label,
            .swal2-radio label {
                margin: 0 0.6em;
                font-size: 1.125em;
            }
            .swal2-checkbox input,
            .swal2-radio input {
                margin: 0 0.4em;
            }
            .swal2-validation-message {
                display: none;
                align-items: center;
                justify-content: center;
                padding: 0.625em;
                overflow: hidden;
                background: #f0f0f0;
                color: #666;
                font-size: 1em;
                font-weight: 300;
            }
            .swal2-validation-message::before {
                content: "!";
                display: inline-block;
                width: 1.5em;
                min-width: 1.5em;
                height: 1.5em;
                margin: 0 0.625em;
                border-radius: 50%;
                background-color: #f27474;
                color: #fff;
                font-weight: 600;
                line-height: 1.5em;
                text-align: center;
            }
            .swal2-icon {
                position: relative;
                box-sizing: content-box;
                justify-content: center;
                width: 5em;
                height: 5em;
                margin: 1.25em auto 1.875em;
                border: 0.25em solid transparent;
                border-radius: 50%;
                font-family: inherit;
                line-height: 5em;
                cursor: default;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .swal2-icon::before {
                display: flex;
                align-items: center;
                height: 92%;
                font-size: 3.75em;
            }
            .swal2-icon.swal2-error {
                border-color: #f27474;
            }
            .swal2-icon.swal2-error .swal2-x-mark {
                position: relative;
                flex-grow: 1;
            }
            .swal2-icon.swal2-error [class^="swal2-x-mark-line"] {
                display: block;
                position: absolute;
                top: 2.3125em;
                width: 2.9375em;
                height: 0.3125em;
                border-radius: 0.125em;
                background-color: #f27474;
            }
            .swal2-icon.swal2-error [class^="swal2-x-mark-line"][class$="left"] {
                left: 1.0625em;
                transform: rotate(45deg);
            }
            .swal2-icon.swal2-error [class^="swal2-x-mark-line"][class$="right"] {
                right: 1em;
                transform: rotate(-45deg);
            }
            .swal2-icon.swal2-warning {
                border-color: #facea8;
                color: #f8bb86;
            }
            .swal2-icon.swal2-warning::before {
                content: "!";
            }
            .swal2-icon.swal2-info {
                border-color: #9de0f6;
                color: #3fc3ee;
            }
            .swal2-icon.swal2-info::before {
                content: "i";
            }
            .swal2-icon.swal2-question {
                border-color: #c9dae1;
                color: #87adbd;
            }
            .swal2-icon.swal2-question::before {
                content: "?";
            }
            .swal2-icon.swal2-question.swal2-arabic-question-mark::before {
                content: "؟";
            }
            .swal2-icon.swal2-success {
                border-color: #a5dc86;
            }
            .swal2-icon.swal2-success [class^="swal2-success-circular-line"] {
                position: absolute;
                width: 3.75em;
                height: 7.5em;
                transform: rotate(45deg);
                border-radius: 50%;
            }
            .swal2-icon.swal2-success [class^="swal2-success-circular-line"][class$="left"] {
                top: -0.4375em;
                left: -2.0635em;
                transform: rotate(-45deg);
                transform-origin: 3.75em 3.75em;
                border-radius: 7.5em 0 0 7.5em;
            }
            .swal2-icon.swal2-success [class^="swal2-success-circular-line"][class$="right"] {
                top: -0.6875em;
                left: 1.875em;
                transform: rotate(-45deg);
                transform-origin: 0 3.75em;
                border-radius: 0 7.5em 7.5em 0;
            }
            .swal2-icon.swal2-success .swal2-success-ring {
                position: absolute;
                z-index: 2;
                top: -0.25em;
                left: -0.25em;
                box-sizing: content-box;
                width: 100%;
                height: 100%;
                border: 0.25em solid rgba(165, 220, 134, 0.3);
                border-radius: 50%;
            }
            .swal2-icon.swal2-success .swal2-success-fix {
                position: absolute;
                z-index: 1;
                top: 0.5em;
                left: 1.625em;
                width: 0.4375em;
                height: 5.625em;
                transform: rotate(-45deg);
            }
            .swal2-icon.swal2-success [class^="swal2-success-line"] {
                display: block;
                position: absolute;
                z-index: 2;
                height: 0.3125em;
                border-radius: 0.125em;
                background-color: #a5dc86;
            }
            .swal2-icon.swal2-success [class^="swal2-success-line"][class$="tip"] {
                top: 2.875em;
                left: 0.875em;
                width: 1.5625em;
                transform: rotate(45deg);
            }
            .swal2-icon.swal2-success [class^="swal2-success-line"][class$="long"] {
                top: 2.375em;
                right: 0.5em;
                width: 2.9375em;
                transform: rotate(-45deg);
            }
            .swal2-progress-steps {
                align-items: center;
                margin: 0 0 1.25em;
                padding: 0;
                background: inherit;
                font-weight: 600;
            }
            .swal2-progress-steps li {
                display: inline-block;
                position: relative;
            }
            .swal2-progress-steps .swal2-progress-step {
                z-index: 20;
                width: 2em;
                height: 2em;
                border-radius: 2em;
                background: #3085d6;
                color: #fff;
                line-height: 2em;
                text-align: center;
            }
            .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
                background: #3085d6;
            }
            .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step ~ .swal2-progress-step {
                background: #add8e6;
                color: #fff;
            }
            .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step ~ .swal2-progress-step-line {
                background: #add8e6;
            }
            .swal2-progress-steps .swal2-progress-step-line {
                z-index: 10;
                width: 2.5em;
                height: 0.4em;
                margin: 0 -1px;
                background: #3085d6;
            }
            [class^="swal2"] {
                -webkit-tap-highlight-color: transparent;
            }
            .swal2-show {
                -webkit-animation: swal2-show 0.3s;
                animation: swal2-show 0.3s;
            }
            .swal2-show.swal2-noanimation {
                -webkit-animation: none;
                animation: none;
            }
            .swal2-hide {
                -webkit-animation: swal2-hide 0.15s forwards;
                animation: swal2-hide 0.15s forwards;
            }
            .swal2-hide.swal2-noanimation {
                -webkit-animation: none;
                animation: none;
            }
            .swal2-rtl .swal2-close {
                right: auto;
                left: 0;
            }
            .swal2-animate-success-icon .swal2-success-line-tip {
                -webkit-animation: swal2-animate-success-line-tip 0.75s;
                animation: swal2-animate-success-line-tip 0.75s;
            }
            .swal2-animate-success-icon .swal2-success-line-long {
                -webkit-animation: swal2-animate-success-line-long 0.75s;
                animation: swal2-animate-success-line-long 0.75s;
            }
            .swal2-animate-success-icon .swal2-success-circular-line-right {
                -webkit-animation: swal2-rotate-success-circular-line 4.25s ease-in;
                animation: swal2-rotate-success-circular-line 4.25s ease-in;
            }
            .swal2-animate-error-icon {
                -webkit-animation: swal2-animate-error-icon 0.5s;
                animation: swal2-animate-error-icon 0.5s;
            }
            .swal2-animate-error-icon .swal2-x-mark {
                -webkit-animation: swal2-animate-error-x-mark 0.5s;
                animation: swal2-animate-error-x-mark 0.5s;
            }
            @supports (-ms-accelerator: true) {
                .swal2-range input {
                    width: 100% !important;
                }
                .swal2-range output {
                    display: none;
                }
            }
            @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
                .swal2-range input {
                    width: 100% !important;
                }
                .swal2-range output {
                    display: none;
                }
            }
            @-moz-document url-prefix() {
                .swal2-close:focus {
                    outline: 2px solid rgba(50, 100, 150, 0.4);
                }
            }
            @-webkit-keyframes swal2-toast-show {
                0% {
                    transform: translateY(-0.625em) rotateZ(2deg);
                }
                33% {
                    transform: translateY(0) rotateZ(-2deg);
                }
                66% {
                    transform: translateY(0.3125em) rotateZ(2deg);
                }
                100% {
                    transform: translateY(0) rotateZ(0);
                }
            }
            @keyframes swal2-toast-show {
                0% {
                    transform: translateY(-0.625em) rotateZ(2deg);
                }
                33% {
                    transform: translateY(0) rotateZ(-2deg);
                }
                66% {
                    transform: translateY(0.3125em) rotateZ(2deg);
                }
                100% {
                    transform: translateY(0) rotateZ(0);
                }
            }
            @-webkit-keyframes swal2-toast-hide {
                100% {
                    transform: rotateZ(1deg);
                    opacity: 0;
                }
            }
            @keyframes swal2-toast-hide {
                100% {
                    transform: rotateZ(1deg);
                    opacity: 0;
                }
            }
            @-webkit-keyframes swal2-toast-animate-success-line-tip {
                0% {
                    top: 0.5625em;
                    left: 0.0625em;
                    width: 0;
                }
                54% {
                    top: 0.125em;
                    left: 0.125em;
                    width: 0;
                }
                70% {
                    top: 0.625em;
                    left: -0.25em;
                    width: 1.625em;
                }
                84% {
                    top: 1.0625em;
                    left: 0.75em;
                    width: 0.5em;
                }
                100% {
                    top: 1.125em;
                    left: 0.1875em;
                    width: 0.75em;
                }
            }
            @keyframes swal2-toast-animate-success-line-tip {
                0% {
                    top: 0.5625em;
                    left: 0.0625em;
                    width: 0;
                }
                54% {
                    top: 0.125em;
                    left: 0.125em;
                    width: 0;
                }
                70% {
                    top: 0.625em;
                    left: -0.25em;
                    width: 1.625em;
                }
                84% {
                    top: 1.0625em;
                    left: 0.75em;
                    width: 0.5em;
                }
                100% {
                    top: 1.125em;
                    left: 0.1875em;
                    width: 0.75em;
                }
            }
            @-webkit-keyframes swal2-toast-animate-success-line-long {
                0% {
                    top: 1.625em;
                    right: 1.375em;
                    width: 0;
                }
                65% {
                    top: 1.25em;
                    right: 0.9375em;
                    width: 0;
                }
                84% {
                    top: 0.9375em;
                    right: 0;
                    width: 1.125em;
                }
                100% {
                    top: 0.9375em;
                    right: 0.1875em;
                    width: 1.375em;
                }
            }
            @keyframes swal2-toast-animate-success-line-long {
                0% {
                    top: 1.625em;
                    right: 1.375em;
                    width: 0;
                }
                65% {
                    top: 1.25em;
                    right: 0.9375em;
                    width: 0;
                }
                84% {
                    top: 0.9375em;
                    right: 0;
                    width: 1.125em;
                }
                100% {
                    top: 0.9375em;
                    right: 0.1875em;
                    width: 1.375em;
                }
            }
            @-webkit-keyframes swal2-show {
                0% {
                    transform: scale(0.7);
                }
                45% {
                    transform: scale(1.05);
                }
                80% {
                    transform: scale(0.95);
                }
                100% {
                    transform: scale(1);
                }
            }
            @keyframes swal2-show {
                0% {
                    transform: scale(0.7);
                }
                45% {
                    transform: scale(1.05);
                }
                80% {
                    transform: scale(0.95);
                }
                100% {
                    transform: scale(1);
                }
            }
            @-webkit-keyframes swal2-hide {
                0% {
                    transform: scale(1);
                    opacity: 1;
                }
                100% {
                    transform: scale(0.5);
                    opacity: 0;
                }
            }
            @keyframes swal2-hide {
                0% {
                    transform: scale(1);
                    opacity: 1;
                }
                100% {
                    transform: scale(0.5);
                    opacity: 0;
                }
            }
            @-webkit-keyframes swal2-animate-success-line-tip {
                0% {
                    top: 1.1875em;
                    left: 0.0625em;
                    width: 0;
                }
                54% {
                    top: 1.0625em;
                    left: 0.125em;
                    width: 0;
                }
                70% {
                    top: 2.1875em;
                    left: -0.375em;
                    width: 3.125em;
                }
                84% {
                    top: 3em;
                    left: 1.3125em;
                    width: 1.0625em;
                }
                100% {
                    top: 2.8125em;
                    left: 0.875em;
                    width: 1.5625em;
                }
            }
            @keyframes swal2-animate-success-line-tip {
                0% {
                    top: 1.1875em;
                    left: 0.0625em;
                    width: 0;
                }
                54% {
                    top: 1.0625em;
                    left: 0.125em;
                    width: 0;
                }
                70% {
                    top: 2.1875em;
                    left: -0.375em;
                    width: 3.125em;
                }
                84% {
                    top: 3em;
                    left: 1.3125em;
                    width: 1.0625em;
                }
                100% {
                    top: 2.8125em;
                    left: 0.875em;
                    width: 1.5625em;
                }
            }
            @-webkit-keyframes swal2-animate-success-line-long {
                0% {
                    top: 3.375em;
                    right: 2.875em;
                    width: 0;
                }
                65% {
                    top: 3.375em;
                    right: 2.875em;
                    width: 0;
                }
                84% {
                    top: 2.1875em;
                    right: 0;
                    width: 3.4375em;
                }
                100% {
                    top: 2.375em;
                    right: 0.5em;
                    width: 2.9375em;
                }
            }
            @keyframes swal2-animate-success-line-long {
                0% {
                    top: 3.375em;
                    right: 2.875em;
                    width: 0;
                }
                65% {
                    top: 3.375em;
                    right: 2.875em;
                    width: 0;
                }
                84% {
                    top: 2.1875em;
                    right: 0;
                    width: 3.4375em;
                }
                100% {
                    top: 2.375em;
                    right: 0.5em;
                    width: 2.9375em;
                }
            }
            @-webkit-keyframes swal2-rotate-success-circular-line {
                0% {
                    transform: rotate(-45deg);
                }
                5% {
                    transform: rotate(-45deg);
                }
                12% {
                    transform: rotate(-405deg);
                }
                100% {
                    transform: rotate(-405deg);
                }
            }
            @keyframes swal2-rotate-success-circular-line {
                0% {
                    transform: rotate(-45deg);
                }
                5% {
                    transform: rotate(-45deg);
                }
                12% {
                    transform: rotate(-405deg);
                }
                100% {
                    transform: rotate(-405deg);
                }
            }
            @-webkit-keyframes swal2-animate-error-x-mark {
                0% {
                    margin-top: 1.625em;
                    transform: scale(0.4);
                    opacity: 0;
                }
                50% {
                    margin-top: 1.625em;
                    transform: scale(0.4);
                    opacity: 0;
                }
                80% {
                    margin-top: -0.375em;
                    transform: scale(1.15);
                }
                100% {
                    margin-top: 0;
                    transform: scale(1);
                    opacity: 1;
                }
            }
            @keyframes swal2-animate-error-x-mark {
                0% {
                    margin-top: 1.625em;
                    transform: scale(0.4);
                    opacity: 0;
                }
                50% {
                    margin-top: 1.625em;
                    transform: scale(0.4);
                    opacity: 0;
                }
                80% {
                    margin-top: -0.375em;
                    transform: scale(1.15);
                }
                100% {
                    margin-top: 0;
                    transform: scale(1);
                    opacity: 1;
                }
            }
            @-webkit-keyframes swal2-animate-error-icon {
                0% {
                    transform: rotateX(100deg);
                    opacity: 0;
                }
                100% {
                    transform: rotateX(0);
                    opacity: 1;
                }
            }
            @keyframes swal2-animate-error-icon {
                0% {
                    transform: rotateX(100deg);
                    opacity: 0;
                }
                100% {
                    transform: rotateX(0);
                    opacity: 1;
                }
            }
            @-webkit-keyframes swal2-rotate-loading {
                0% {
                    transform: rotate(0);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
            @keyframes swal2-rotate-loading {
                0% {
                    transform: rotate(0);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
            body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
                overflow: hidden;
            }
            body.swal2-height-auto {
                height: auto !important;
            }
            body.swal2-no-backdrop .swal2-shown {
                top: auto;
                right: auto;
                bottom: auto;
                left: auto;
                max-width: calc(100% - 0.625em * 2);
                background-color: transparent;
            }
            body.swal2-no-backdrop .swal2-shown > .swal2-modal {
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            }
            body.swal2-no-backdrop .swal2-shown.swal2-top {
                top: 0;
                left: 50%;
                transform: translateX(-50%);
            }
            body.swal2-no-backdrop .swal2-shown.swal2-top-left,
            body.swal2-no-backdrop .swal2-shown.swal2-top-start {
                top: 0;
                left: 0;
            }
            body.swal2-no-backdrop .swal2-shown.swal2-top-end,
            body.swal2-no-backdrop .swal2-shown.swal2-top-right {
                top: 0;
                right: 0;
            }
            body.swal2-no-backdrop .swal2-shown.swal2-center {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            body.swal2-no-backdrop .swal2-shown.swal2-center-left,
            body.swal2-no-backdrop .swal2-shown.swal2-center-start {
                top: 50%;
                left: 0;
                transform: translateY(-50%);
            }
            body.swal2-no-backdrop .swal2-shown.swal2-center-end,
            body.swal2-no-backdrop .swal2-shown.swal2-center-right {
                top: 50%;
                right: 0;
                transform: translateY(-50%);
            }
            body.swal2-no-backdrop .swal2-shown.swal2-bottom {
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
            }
            body.swal2-no-backdrop .swal2-shown.swal2-bottom-left,
            body.swal2-no-backdrop .swal2-shown.swal2-bottom-start {
                bottom: 0;
                left: 0;
            }
            body.swal2-no-backdrop .swal2-shown.swal2-bottom-end,
            body.swal2-no-backdrop .swal2-shown.swal2-bottom-right {
                right: 0;
                bottom: 0;
            }
            @media print {
                body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
                    overflow-y: scroll !important;
                }
                body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) > [aria-hidden="true"] {
                    display: none;
                }
                body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container {
                    position: static !important;
                }
            }
            body.swal2-toast-shown .swal2-container {
                background-color: transparent;
            }
            body.swal2-toast-shown .swal2-container.swal2-shown {
                background-color: transparent;
            }
            body.swal2-toast-shown .swal2-container.swal2-top {
                top: 0;
                right: auto;
                bottom: auto;
                left: 50%;
                transform: translateX(-50%);
            }
            body.swal2-toast-shown .swal2-container.swal2-top-end,
            body.swal2-toast-shown .swal2-container.swal2-top-right {
                top: 0;
                right: 0;
                bottom: auto;
                left: auto;
            }
            body.swal2-toast-shown .swal2-container.swal2-top-left,
            body.swal2-toast-shown .swal2-container.swal2-top-start {
                top: 0;
                right: auto;
                bottom: auto;
                left: 0;
            }
            body.swal2-toast-shown .swal2-container.swal2-center-left,
            body.swal2-toast-shown .swal2-container.swal2-center-start {
                top: 50%;
                right: auto;
                bottom: auto;
                left: 0;
                transform: translateY(-50%);
            }
            body.swal2-toast-shown .swal2-container.swal2-center {
                top: 50%;
                right: auto;
                bottom: auto;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            body.swal2-toast-shown .swal2-container.swal2-center-end,
            body.swal2-toast-shown .swal2-container.swal2-center-right {
                top: 50%;
                right: 0;
                bottom: auto;
                left: auto;
                transform: translateY(-50%);
            }
            body.swal2-toast-shown .swal2-container.swal2-bottom-left,
            body.swal2-toast-shown .swal2-container.swal2-bottom-start {
                top: auto;
                right: auto;
                bottom: 0;
                left: 0;
            }
            body.swal2-toast-shown .swal2-container.swal2-bottom {
                top: auto;
                right: auto;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
            }
            body.swal2-toast-shown .swal2-container.swal2-bottom-end,
            body.swal2-toast-shown .swal2-container.swal2-bottom-right {
                top: auto;
                right: 0;
                bottom: 0;
                left: auto;
            }
            body.swal2-toast-column .swal2-toast {
                flex-direction: column;
                align-items: stretch;
            }
            body.swal2-toast-column .swal2-toast .swal2-actions {
                flex: 1;
                align-self: stretch;
                height: 2.2em;
                margin-top: 0.3125em;
            }
            body.swal2-toast-column .swal2-toast .swal2-loading {
                justify-content: center;
            }
            body.swal2-toast-column .swal2-toast .swal2-input {
                height: 2em;
                margin: 0.3125em auto;
                font-size: 1em;
            }
            body.swal2-toast-column .swal2-toast .swal2-validation-message {
                font-size: 1em;
            }
        </style>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.js"></script>
        <script type="text/javascript" src="https://hackimi.com/js/sidebar.js"></script>
        <script type="text/javascript" src="https://hackimi.com/js/home.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php  echo $this->config->item('tem_frontend_css'); ?>hack.css" />

        <style type="text/css">
            .sidenav {
                background-image: none;
            }
            .showtext {
                font-family: "Helvet";
                font-size: 20px;
            }

            .chancetxt {
                font-family: "Helvet";
                margin-bottom: -5px;
                font-size: 8px;
                color: white;
            }

            .txtroom {
                font-family: "Helvet";
                font-size: 12px;
                right: 10%;
                bottom: 0;
                position: absolute;
            }

            .resroom {
                height: 40px;
            }

            @media (min-width: 750px) {
                .showtext {
                    font-size: 70px;
                }

                .chancetxt {
                    margin-bottom: -35px;
                    font-size: 27px;
                }

                .txtroom {
                    font-size: 27px;
                }

                .resroom {
                    height: 100px;
                }
            }

            @media (min-width: 1200px) {
                .resroom {
                    height: 120px;
                }

                .txtroom {
                    font-size: 32px;
                }

                .chancetxt {
                    margin-bottom: -25px;
                    font-size: 27px;
                }
            }

            @media (min-width: 992px) {
                .sidenav {
                    background-image: url("https://www.hackimi.com/resource/images/new/asset/2/side_bar.png");
                }
            }

            /* Shine */
            .hover14 figure {
                position: relative;
            }
            .hover14 figure::before {
                position: absolute;
                top: 0;
                left: -75%;
                z-index: 2;
                display: block;
                content: "";
                width: 50%;
                height: 100%;
                background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
                background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
                -webkit-transform: skewX(-25deg);
                transform: skewX(-25deg);
            }
            .hover14 figure:hover::before {
                -webkit-animation: shine 0.75s;
                animation: shine 0.75s;
            }
            @-webkit-keyframes shine {
                100% {
                    left: 125%;
                }
            }
            @keyframes shine {
                100% {
                    left: 125%;
                }
            }

            .slick-slide {
                margin: 0px 20px;
            }

            .slick-slide img {
                width: 100%;
            }

            .slick-slider {
                position: relative;
                display: block;
                box-sizing: border-box;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-touch-callout: none;
                -khtml-user-select: none;
                -ms-touch-action: pan-y;
                touch-action: pan-y;
                -webkit-tap-highlight-color: transparent;
            }

            .slick-list {
                position: relative;
                display: block;
                overflow: hidden;
                margin: 0;
                padding: 0;
            }

            .slick-list:focus {
                outline: none;
            }

            .slick-list.dragging {
                cursor: pointer;
                cursor: hand;
            }

            .slick-slider .slick-track,
            .slick-slider .slick-list {
                -webkit-transform: translate3d(0, 0, 0);
                -moz-transform: translate3d(0, 0, 0);
                -ms-transform: translate3d(0, 0, 0);
                -o-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }

            .slick-track {
                position: relative;
                top: 0;
                left: 0;
                display: block;
            }

            .slick-track:before,
            .slick-track:after {
                display: table;
                content: "";
            }

            .slick-track:after {
                clear: both;
            }

            .slick-loading .slick-track {
                visibility: hidden;
            }

            .slick-slide {
                display: none;
                float: left;
                height: 100%;
                min-height: 1px;
            }

            [dir="rtl"] .slick-slide {
                float: right;
            }

            .slick-slide img {
                display: block;
            }

            .slick-slide.slick-loading img {
                display: none;
            }

            .slick-slide.dragging img {
                pointer-events: none;
            }

            .slick-initialized .slick-slide {
                display: block;
            }

            .slick-loading .slick-slide {
                visibility: hidden;
            }

            .slick-vertical .slick-slide {
                display: block;
                height: auto;
                border: 1px 0.1rem solid transparent;
            }

            .slick-arrow.slick-hidden {
                display: none;
            }

            #cssmenu > ul > li:hover > a,
            #cssmenu > ul > li.active > a {
                background: none !important;
            }

            .border_radi_box {
                border-bottom-right-radius: 15px !important;
                border-bottom-left-radius: 15px !important;
            }

            .div_sl {
                position: relative;
            }

            .img_sl {
                position: absolute;
                top: 0;
                left: 0;
                z-index: 3;
                animation: slideshow 12s linear 0s infinite;
            }

            .img_sl:nth-child(2) {
                z-index: 2;
                animation-delay: 4s;
            }

            .img_sl:nth-child(3) {
                z-index: 1;
                animation-delay: 8s;
            }
        </style>
        <script>
            sessionStorage.setItem("User", "imi361001116");
            sessionStorage.setItem("sCode", "78f89f36df98daa8049e873054f60cd4");
            sessionStorage.setItem("Credit", "9720");
        </script>


 <!DOCTYPE html>
  <html> 
      <body>
        <link rel="stylesheet" type="text/css" href="assets/ncss/menu-style.css">
        <link rel="stylesheet" type="text/css" href="assets/ncss/ie10-viewport-bug-workaround.css">
        <link rel="stylesheet" type="text/css" href="assets/ncss/animate.css">
        <link rel="stylesheet" type="text/css" href="assets/ncss/flexslider.css">
        <style>
            .download-btn {
                position: fixed;
                top: 50%;
                left: 0;
                z-index: 9;
                transform: translate(0, -50%);
                cursor: pointer;
            }
            .app {
                position: fixed;
                top: 50%;
                left: -262px;
                z-index: 9;
                transform: translate(0, -50%);
                transition: 0.5s;
                /*background: #31405f;*/
                color: #fff;
                padding: 28px;
                text-align: center;
            }
            .app-pop {
                left: 0;
            }
            .app img {
                margin: 5px 0;
            }
            .app h3 {
                box-shadow: 0 10px 8px -8px #000;
            }
            @media screen and (max-width: 426px) {
                .app,
                .download-btn {
                    display: show;
                }
            }
            @media screen and (max-width: 376px) {
                .product_content h3 {
                    font-size: 14px;
                }
                .product_content p {
                    font-size: 10px;
                }
                .product_content .small_text {
                    font-size: 8px;
                }
                .product_content .play_button {
                    padding: 5px;
                    font-size: 10px;
                    margin: 0;
                }
            }

            .grad_menu {
                background-image: linear-gradient(#10346f, #000000); /* Standard syntax (must be last) */
            }

            .border_radi {
                border-bottom-right-radius: 0px !important;
                border-bottom-left-radius: 0px !important;
            }
        </style>

        <section class="featured-procuts-section container" style="background-image: url('https://www.hackimi.com/resource/pict/BG-IMI-1920x1080.jpg');background-repeat:repeat;  background-attachment: fixed;">
          <div class="featured-product" style="margin-top: 80px;">
            <div class="featured-list">
                <img src="https://www.hackimi.com/resource/slider/slid1.jpg" alt="Chania" style="width: 100% !important;">
                      <div style="width: 100%; border: solid 0px #fff; margin-top: 30px !important;">
                        <center>
                            <ul class="category row" style="width: 90% !important;">
                                <li class="col-md-6" style="padding-bottom: 15px !important;">
                                    <a href="<?php echo base_url()?>web/hackcasino"><img class="img100" src="https://www.hackimi.com/resource/pict/vhack/CASINO-Hack_new.png" /></a>
                                </li>
                                <li class="col-md-6">
                                    <a href="<?php echo base_url()?>web/hackgame"><img class="img100" src="https://www.hackimi.com/resource/pict/vhack/GAME-Hack_new.png" /></a>
                                </li>
                            </ul>
                            <ul class="category row" style="width: 90% !important;">
                                <li class="col-md-6">
                                    <a href="#"><img class="img100" src="https://www.hackimi.com/hresource/pict/vhack/SPORT-Hack_new.png" /></a>
                                </li>
                                <li class="col-md-6">
                                    <a href="#"><img class="img100" src="https://www.hackimi.com/resource/pict/vhack/LOTTO-Hack_new.png" /></a>
                                </li>
                            </ul>
                            <img class="img100" src="<?php echo $this->config->item('tem_frontend_img'); ?>f2.jpg">
                        </center>
                      </div>         
            </div>
          </div>
        </section>
      </body>
  </html>

<?php } ?>
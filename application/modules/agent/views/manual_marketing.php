 <?php

 if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) { ?>

<div class="canvas" canvas="container" id="canvas">
  <div class="main-screen" style="background-image: url(<?php  echo $this->config->item('tem_frontend_img'); ?>casinoBG.jpg);">
    <header class="header"> <a href="index.php" class="header-button header-button-left" id="nav-btn"><span class="icon icon-navicon"></span></a>
      <h1 class="header-title"><a href="index.php"><img alt="สมัครเอเย่นต์ แทงบอล บาคาร่า" src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png"/></a></h1>
      <a  class="header-button header-button-right open-right-sidebar hide"></span></a> </header>
    <section class="body">
      
      <div id="lazy-contain">
        <div class="dash-widgets css-loader-ready">
        <center> 
          <div class="featured-product">
            <div class="featured-list">
                    <div class="featured-division stage-tile col-3">
                            <div class="featured-item">                             
                                <p class="ambassador">
                                  <a class="btn btn-medium" href="<?php echo base_url()?>web/imiwin">
                                    <img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/imiwin.jpg" width="250" alt="สมัครเอเย่นต์ แทงบอล บาคาร่า">
                                  </a></p>                            
                            </div>
                        </div>

                    <div class="featured-division col-3">
                        <div class="featured-item">                            
                            <p class="ambassador"><a class="btn btn-medium" href="<?php echo base_url()?>web/fb">
                              <img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/fb.jpg" width="250" alt="สมัครเอเย่นต์ แทงบอล บาคาร่า">
                            </a></p>
                        </div>
                    </div>


                    <div class="featured-division stage-tile col-3">
                            <div class="featured-item">                                
                                <p class="ambassador"><a class="btn btn-medium" href="<?php echo base_url()?>web/google">
                                  <img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/google.jpg" width="250" alt="สมัครเอเย่นต์ แทงบอล บาคาร่า"></a></p>                               
                            </div>
                        </div>
                        <div class="featured-division stage-tile col-3">
                            <div class="featured-item">                                
                                <p class="ambassador"><a class="btn btn-medium" href="<?php echo base_url()?>web/youtube">
                                  <img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/yb.jpg" width="250" alt="สมัครเอเย่นต์ แทงบอล บาคาร่า"></a></p>                                
                            </div>
                        </div>
                     </div>
                </div>

        
   </center>

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
  <p id="copyright"><h2><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="สมัครเอเย่นต์ แทงบอล บาคาร่า" class="img-responsive center-block" style="width: 80%;text-align: center;"></h2></p>
</div>
</section>
  </div>
  <div class="canvas-overlay"></div>
</div>

<style type="text/css">
* {
  box-sizing:border-box;
}
@import url(https://fonts.googleapis.com/css?family=Lato:400,700);
body { 

  font-family:'Lato';
}
.heading-primary {
  font-size:2em;
  padding:2em;
  text-align:center;
}
.accordion dl,
.accordion-list {
   border:1px solid #ddd;
   &:after {
       content: "";
       display:block;
       height:1em;
       width:100%;
       background-color:darken(#00008B, 10%);
     }
}
.accordion dd,
.accordion__panel {
   background-color:#eee;
   font-size:1em;
   line-height:1.5em; 
}
.accordion p {
  padding:1em 2em 1em 2em;
}

.accordion {
    position:relative;
    background-color:#eee;
}
.container {
  max-width:960px;
  margin:0 auto;
  padding:2em 0 2em 0;
}
.accordionTitle,
.accordion__Heading {
 background-color:#00008B; 
   text-align:center;
     font-weight:700; 
          padding:2em;
          display:block;
          text-decoration:none;
          color:#fff;
          transition:background-color 0.5s ease-in-out;
  border-bottom:1px solid darken(#00008B, 5%);
  &:before {
   content: "+";
   font-size:1.5em;
   line-height:0.5em;
   float:left; 
   transition: transform 0.3s ease-in-out;
  }
  &:hover {
    background-color:darken(#00008B, 10%);
  }
}
.accordionTitleActive, 
.accordionTitle.is-expanded {
   background-color:darken(#00008B, 10%);
    &:before {
     
      transform:rotate(-225deg);
    }
}
.accordionItem {
    height:auto;
    overflow:hidden; 
    //SHAME: magic number to allow the accordion to animate
    
     max-height:50em;
    transition:max-height 1s;   
 
    
    @media screen and (min-width:48em) {
         max-height:15em;
        transition:max-height 0.5s
        
    }
    
   
}
 
.accordionItem.is-collapsed {
    max-height:0;
}
.no-js .accordionItem.is-collapsed {
  max-height: auto;
}
.animateIn {
     animation: accordionIn 0.45s normal ease-in-out both 1; 
}
.animateOut {
     animation: accordionOut 0.45s alternate ease-in-out both 1;
}
@keyframes accordionIn {
  0% {
    opacity: 0;
    transform:scale(0.9) rotateX(-60deg);
    transform-origin: 50% 0;
  }
  100% {
    opacity:1;
    transform:scale(1);
  }
}

@keyframes accordionOut {
    0% {
       opacity: 1;
       transform:scale(1);
     }
     100% {
          opacity:0;
           transform:scale(0.9) rotateX(-60deg);
       }
}
</style>
<script type="text/javascript">
  //uses classList, setAttribute, and querySelectorAll
//if you want this to work in IE8/9 youll need to polyfill these
(function(){
  var d = document,
  accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
  setAria,
  setAccordionAria,
  switchAccordion,
  touchSupported = ('ontouchstart' in window),
  pointerSupported = ('pointerdown' in window);
  
  skipClickDelay = function(e){
    e.preventDefault();
    e.target.click();
  }

    setAriaAttr = function(el, ariaType, newProperty){
    el.setAttribute(ariaType, newProperty);
  };
  setAccordionAria = function(el1, el2, expanded){
    switch(expanded) {
      case "true":
        setAriaAttr(el1, 'aria-expanded', 'true');
        setAriaAttr(el2, 'aria-hidden', 'false');
        break;
      case "false":
        setAriaAttr(el1, 'aria-expanded', 'false');
        setAriaAttr(el2, 'aria-hidden', 'true');
        break;
      default:
        break;
    }
  };
//function
switchAccordion = function(e) {
  console.log("triggered");
  e.preventDefault();
  var thisAnswer = e.target.parentNode.nextElementSibling;
  var thisQuestion = e.target;
  if(thisAnswer.classList.contains('is-collapsed')) {
    setAccordionAria(thisQuestion, thisAnswer, 'true');
  } else {
    setAccordionAria(thisQuestion, thisAnswer, 'false');
  }
    thisQuestion.classList.toggle('is-collapsed');
    thisQuestion.classList.toggle('is-expanded');
    thisAnswer.classList.toggle('is-collapsed');
    thisAnswer.classList.toggle('is-expanded');
  
    thisAnswer.classList.toggle('animateIn');
  };
  for (var i=0,len=accordionToggles.length; i<len; i++) {
    if(touchSupported) {
      accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
    }
    if(pointerSupported){
      accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
    }
    accordionToggles[i].addEventListener('click', switchAccordion, false);
  }
})();
</script>

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
  position: absolute;
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

<main class="main" style="background-image: url(<?php  echo $this->config->item('tem_frontend_img'); ?>casinoBG.jpg);"><br><br><br>
   <section class="featured-procuts-section container" >
          <div class="featured-product">
            <div class="featured-list">
                    <div class="featured-division stage-tile col-3">
                            <div class="featured-item">                             
                                <p class="ambassador">
                                  <img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/imiwin.jpg"></p>
                                <div class="featured-hover-wrapper">
                                    <div class="featured-hover">
                                        <span class="hover-center">
                                            <a class="btn btn-medium" href="<?php echo base_url()?>agent/web/imiwin" >แนะนำผลิตภัณฑ์ IMIWIN</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="featured-division col-3">
                        <div class="featured-item">                            
                            <p class="ambassador"><img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/fb.jpg"></p>
                            <div class="featured-hover-wrapper">
                                <div class="featured-hover">                                  
                                    <span class="hover-center">
                                      <a class="btn btn-medium" href="<?php echo base_url()?>agent/web/fb">คอร์ส Facebook</a>                                     
                                    </span>
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="featured-division stage-tile col-3">
                            <div class="featured-item">                                
                                <p class="ambassador"><img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/google.jpg" ></p>
                                <div class="featured-hover-wrapper">
                                    <div class="featured-hover">
                                        <span class="hover-center">
                                            <a class="btn btn-medium" href="<?php echo base_url()?>agent/web/google" >คอร์ส Google Search Ads Zero to Hero</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="featured-division stage-tile col-3">
                            <div class="featured-item">                                
                                <p class="ambassador"><img class="lazy-loaded" src="<?php echo $this->config->item('tem_frontend_img'); ?>icon/yb.jpg" ></p>
                                <div class="featured-hover-wrapper">
                                    <div class="featured-hover">
                                        <span class="hover-center">
                                      
                                            <a class="btn btn-medium" href="<?php echo base_url()?>agent/web/youtube">คอร์ส Youtube</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </section>
            
</main>




<?php } ?>








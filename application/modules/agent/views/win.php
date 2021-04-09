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
                    <a href="<?php echo base_url()?>web/winsports"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/SPORTS1.png" width="315"></p></a>                   
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                    <a href="<?php echo base_url()?>web/wincasino"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/casin.png" width="315px"></p></a></div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                <a href="<?php echo base_url()?>web/wingame"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/E-GAME1.jpg.png" width="315px"></p></a>  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/FISH-GAME1.png" width="315px"></p>                     
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item"><a href="<?php echo base_url()?>web/winlotto">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/LOTTO1.png" width="315px"></p></a>                     
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item"><a href="<?php echo base_url()?>web/wincockfight">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/cockfight1.jpg.png" width="315px"></p></a>                    
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

<body>
	<main class="main" style="background-image: url(<?php echo $this->config->item('tem_frontend_img');?>imiwinbg.jpg);">
      <div class="slideshow-container">
         <div class="mySlides fade">
            <div class="numbertext">1 / 2</div>
            <img src="https://imiwin.com/data/1744/uploads/slide11.jpg" style="width:100%">
         </div>
         <div class="mySlides fade">
            <div class="numbertext">2 / 2</div>
            <img src="https://imiwin.com/data/1744/uploads/slide111.jpg" style="width:100%">
         </div>
      </div>
      <div style="text-align:center;margin-top: -1%;">
         <span class="dot"></span> 
         <span class="dot"></span>
      </div>
   <section class="featured-procuts-section container" >
        <div class="featured-product">
            <div class="featured-list">
               <div class="featured-division col-4">
                  <div class="featured-item">
                    <a href="<?php echo base_url()?>web/winsports"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/SPORTS1.png" width="250"></p></a>                   
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                    <a href="<?php echo base_url()?>web/wincasino"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/casin.png"></p></a></div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                <a href="<?php echo base_url()?>web/wingame"><p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/E-GAME1.jpg.png"></p></a>  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/FISH-GAME1.png" ></p>                     
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item"><a href="<?php echo base_url()?>web/winlotto">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/LOTTO1.png"></p></a>                     
                  </div>
               </div>
               <div class="featured-division stage-tile col-4">
                  <div class="featured-item"><a href="<?php echo base_url()?>web/wincockfight">
                     <p class="ambassador"><img class="lazy-loaded" src="https://imiwin.com/data/1744/uploads/cockfight1.jpg.png"></p></a>                    
                  </div>
               </div>
            </div>
         </div>        
      </section> 
      <div class="introduce" style="color: white;border-radius: 0 90px 0 90px;text-align: justify;padding: 20px 40px;margin: 25px 0;border: 5px solid #1C6EA4;">
			<span style="font-size: 22px;color: yellow;">IMIWIN เว็บพนันบอล คุณภาพระดับโลก</span> พัฒนาเพื่อคนไทย ด้วย เกมเดิมพนันที่ครบครัน ไม่ว่าจะเป็นแทงบอล เเทงมวย เเทงหวย เเละเกมอื่นๆ ที่ทุกท่านคุ้นเคย เช่น ไฮโล น้ำเต้าปูปลา เสือมังกร เเละอื่นๆอีกมากมายให้ท่านได้เลือกเล่น เเละเพลิดเพลินกับทางเว็บไซต์ของเรา
		</div>
	</main>
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
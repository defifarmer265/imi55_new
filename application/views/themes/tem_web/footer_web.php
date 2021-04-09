      <footer class="footer mt-50">
            <a class="back-to-top hide"></a>
            <div class="container">
                <div class="grid">
                    <section class="col-4 site-keyword">
                        <h4 class="mb-40">IMI55</h4>
                        <p>ยินดีต้อนรับสู่ IMI55 หนึ่งในผู้นำเว็บไซต์เดิมพันออนไลน์ของเอเชีย ที่ส่งตรงถึงบ้านคุณเพื่อให้ท่านได้รับประสบการณ์ที่ดีที่สุดกับการเดิมพันออนไลน์ ทางเว็บไซต์ของเราประกอบไปด้วย การเดิมพันกีฬา, เกมส์คาสิโนออนไลน์, คีโน, โป๊กเกอร์ออนไลน์, แฟลชเกมส์ และเกมส์เดิมพันออนไลน์ระดับโลกมากมาย</p>
                        <div align="center">
                          <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>banking-banner.png">
                        </div>
                    </section>
                    <section class="col-4 quicklinks">
                        <h4 class="mb-40">คลิกที่นี่</h4>
                        <div class="grid">
                            <ul class="col-6">
                                <li><a class="lazy-loaded" id='footer-about' href="https://www.imi55.com/" target="_self">IMI55</a></li>
                                <li><a class="lazy-loaded" id='footer-responsible' href="<?php echo base_url()?>web/Register" target="_self">วิธีสมัคร</a></li>
                                <li><a class="lazy-loaded" id='footer-payment' href="<?php echo base_url()?>web/how_to_deposit" target="_self">วิธีฝาก</a></li>
                                <li><a class="lazy-loaded" id='footer-security' href="<?php echo base_url()?>web/withdrawal_method" target="_self">วิธีถอน</a></li>
                            </ul>
                            <ul class="col-6">
                                <li><a class="lazy-loaded" id='footer-privacy' href="<?php echo base_url()?>web/privacy" target="_self">ความเป็นส่วนตัว</a></li>
                                <li><a class="lazy-loaded" id='footer-affiliates' href="<?php echo base_url()?>web/Asked_Questions" >คำถามที่พบบ่อบ</a></li>
                                <li><a class="lazy-loaded" id='footer-contact' href="line://ti/p/@fanball8888" target="_self">ติดต่อเรา</a></li>
                                <li><a class="lazy-loaded" id='footer-fake' href="<?php echo base_url()?>ช่วงเวลาปิดปรับปรุง" target="_self">ช่วงเวลาปิดปรับปรุงของธนาคาร</a></li>
                            </ul>
                        </div>
                    </section>
                    <section class="col-4 text-center">
                        <h4 class="mb-10">ติดตามเราและรับข่าวสารเพิ่มเติม</h4>
                        <p class="mb-50">
                            <a id='social-facebook' class="icon-facebook lazy-loaded" href="https://www.facebook.com/IMI55official" style="background-image: url('<?php  echo $this->config->item('tem_frontend_img'); ?>sprite.png');" target="_blank">facebook</a> 
                            <a  href="line://ti/p/@imi55"  target="_blank"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>L.png" style="width: 10%;"> </a> 
                            <a id='social-youtube' class="icon-youtube lazy-loaded" href="https://www.youtube.com/playlist?list=PL85MNTzD1YzZhsHrUjhSPMegA3p5M0bKS" style="background-image: url('<?php  echo $this->config->item('tem_frontend_img'); ?>sprite.png');" target="_blank">youtube</a>
                        </p>
                        <p>
                            <img class="lazy-loaded" src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png">
                            <br>
                          
                        </p>
                    </section>
                </div>
            </div>
            <div class="copyright clear">
                <p class="container text-center" style="color: #fff">ลิขสิทธิ์ © 2020 | IMI55 | สงวนลิขสิทธิ์</p>
            </div>
            <!-- Histats.com  START  target="_blank"(aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,4416493,4,0,0,0,00010000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4416493&101" alt="" border="0"></a></noscript>
<!-- Histats.com  END  -->
        </footer>

        <script src="<?php  echo $this->config->item('tem_frontend_js'); ?>jquery.min.js"></script>
        <script src="<?php  echo $this->config->item('tem_frontend_js'); ?>scripts.js?v=1.0.1"></script>
        <script src="<?php  echo $this->config->item('tem_frontend_js'); ?>tracking.js?v=1.0.7"></script>
        
        
        

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
}
</script>

  </div>
        <footer class="footer mt-50">
            <a class="back-to-top hide"></a>
            <div class="container">
                <div class="grid">
                    <section class="col-4 site-keyword">
                        <h4 class="mb-40" style="color: #000043;">IMIWINSHOP</h4>
                        <p style="color: #000043;">ยินดีต้อนรับสู่ IMIWINSHOP หนึ่งในผู้นำเว็บไซต์เดิมพันออนไลน์ของเอเชีย ที่ส่งตรงถึงบ้านคุณเพื่อให้ท่านได้รับประสบการณ์ที่ดีที่สุดกับการเดิมพันออนไลน์ ทางเว็บไซต์ของเราประกอบไปด้วย การเดิมพันกีฬา, เกมส์คาสิโนออนไลน์, คีโน, โป๊กเกอร์ออนไลน์, แฟลชเกมส์ และเกมส์เดิมพันออนไลน์ระดับโลกมากมาย</p>
                    </section>
                    <section class="col-4 quicklinks">
                        <h4 class="mb-40" style="color: #000043;">คลิกที่นี่</h4>
                        <div class="grid">
                            <ul class="col-6">
                                <li><a id='footer-affiliates' href="#" target="_blank">สมัครเอเย่นต์</a></li>
                                <li><a id='footer-affiliates' href="#" target="_blank">พันธมิตร</a></li>
                                <li><a id='footer-about' href="#" target="_self">เกี่ยวกับเรา</a></li>                                
                            </ul>
                            <ul class="col-6">
                                <li><a id='footer-terms' href="#" target="_self">ข้อกำหนดและเงื่อนไข</a></li>
                                <li><a id='footer-terms' href="#" target="_self">คำถามที่พบบ่อย</a></li>                             
                            </ul>
                        </div>
                    </section>
                    <section class="col-4 text-center">
                        <h4 class="mb-10" style="color: #000043;">ติดตามเราและรับข่าวสารเพิ่มเติม</h4><br>
                        <p class="mb-50">
                            <a id='social-facebook' class="icon-facebook lazy-loaded" href="#" style="background-image: url('https://www.dafabet.net/images/sprite.png');" target="_blank">facebook</a>  
                            <a id='social-youtube' class="icon-youtube lazy-loaded" href="#" style="background-image: url('https://www.dafabet.net/images/sprite.png');" target="_blank">youtube</a>
                        </p>                        
                    </section>
                </div>
            </div>
            <div class="copyright clear">
                <p class="container text-center" style="color: #fff">ลิขสิทธิ์ © 2020 | IMIWINSHOP | สงวนลิขสิทธิ์</p>
            </div>
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
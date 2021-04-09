<!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>



<div class="container">
        <style>
            #slideshow {
          position: relative;
          width: 100%;
          height: 280px;  
        }

        #slideshow > div {
          position: absolute;
          left: 15px;
          right: 15px;
        }
        </style>

        <div id="slideshow">
            <div>
                <img src="<?php echo $this->config->item('tem_frontend_img'); ?>slide1.jpg" style="width:100%">
            </div>
            <div>
                <img src="<?php echo $this->config->item('tem_frontend_img'); ?>slide2.jpg" style="width:100%">
            </div>
        </div>

        <script type="text/javascript">
            $("#slideshow > div:gt(0)").hide();

        setInterval(function() {
          $('#slideshow > div:first')
            .fadeOut(1000)
            .next()
            .fadeIn(1000)
            .end()
            .appendTo('#slideshow');
        }, 4000);
        </script>
</div>
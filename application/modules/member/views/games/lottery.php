<header class="masthead  text-white text-center" style="" id="tap_contact">
    <div class="container">
        <div class="sc-fzqPZZ gLiaon">
            <div class="row mt-4">
                <div class="col-4 mb-2 " onClick="opengame('C93','');">
                    <div style="text-align: center;">
                        <div style="overflow: hidden;"><img class="img-fluid" src="<?= $this->config->item('tem_frontend_img'); ?>casino/93-CONNECT.png" alt="SA gaming" /></div>
                        <div style="color: rgb(255, 255, 255); margin-top: 5px;">93 CONNECT</div>
                    </div>
                </div>
                <div class="col-4 mb-2 " onClick="opengame('ML','');">
                    <div style="text-align: center;">
                        <div style="overflow: hidden;"><img class="img-fluid" src="<?= $this->config->item('tem_frontend_img'); ?>casino/MALAYSIA-LOTTERY.png" alt="Sexy baccarat" /></div>
                        <div style="color: rgb(255, 255, 255); margin-top: 5px;">MALAYSIA LOTTERY</div>
                    </div>
                </div>
                <div class="col-4 mb-2 " onClick="opengameKN();">
                    <div style="text-align: center;">
                        <div style="overflow: hidden;"><img class="img-fluid" src="<?= $this->config->item('tem_frontend_img'); ?>casino/KENO.png" alt="G-Club" /></div>
                        <div style="color: rgb(255, 255, 255); margin-top: 5px;">KENO</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>








    
<script>
    function opengameKN() {
        var settings = {
                "url": "https://opengameapi.linkv2.com/api/play/login/",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Referer": '<?=base_url();?>',
                    "Authorization": "Bearer <?=$this->session->member->token;?>",
                    "Content-Type": "application/json",
                
                },
                "data": JSON.stringify({"Vendor":"KN","Lang":"en-us","GameCode":"","Browser":"chrome"}),
                };

                $.ajax(settings).done(function (response) {
                    console.log(response.Result.Data);
                     window.open('https://mem.imiwin.com/m/play/kenno-widget?code='+response.Result.Data+'&lang=th');
        

                });
      }  
</script>

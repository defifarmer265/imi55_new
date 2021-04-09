<style>
@media only screen and (max-width: 600px) {
    .btn {
        border-radius: 15px;
        width: 259px;
    }
}
</style>
<!--<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">-->
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.css"
    rel="stylesheet">
<script src="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.js"></script>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="x_panel   ">
                <div class="x_title ">
                    <h2>ระบบปิดเข้าใช้งาน </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content  text-white">
                    <div class=" radio">
                        <!-- เปิดปิด ระบบหลังบ้าน -->
                        <div class="form-group row  text-white">
                            <label>
                                <?php //echo $mainten[0]['id'];?>
                                <?php  if($mainten[0]['confirm_web']=="1"){?>
                                <input type="checkbox" onclick="close_web('<?= $mainten[0]['id']?>','0');" id="close_web"class="js-switch"
                                    <?=$mainten[0]['confirm_web'] == 1 ? 'checked':''?> />
                                <?php }else{?>
                                <input type="checkbox" onclick="open_web('<?= $mainten[0]['id']?>','1');" id="open_web"
                                    value="<?= $mainten[0]['id'];?>"  class="js-switch"
                                    <?=$mainten[0]['confirm_web'] == 0 ? '':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[0]['title']?></span>
                            </label>
                        </div>
                        <hr>
                        <!-- เปิดปิด ระบบ หลังบ้าน -->
                        <div class="form-group row">
                            <label>
                                
                                <?php  if($mainten[1]['confirm_web']=="1"){?>
                                    <input type="checkbox" onclick="close_web('<?= $mainten[1]['id']?>','0');" 
                                     class="js-switch"
                                    <?=$mainten[1]['confirm_web'] == 1 ? 'checked':''?> />
                                <?php }else{?>
                                    <input type="checkbox" onclick="open_web('<?= $mainten[1]['id']?>','1');"
                                     class="js-switch"
                                    <?=$mainten[1]['confirm_web'] == 0 ? '':''?> />
                                <?php }?>
                                <span
                                    style="font-size: 18px;padding: 15px;color: #000"><?=$mainten[1]['title']?></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function close_web(id,s){
    $.ajax({
            url: 'close_web',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                st: s
            }
        })
        .done(function(res) {
            if (res.code == 1) {
                swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

            } else {
                swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
            }
        })
}
function open_web(id,s){
   
    $.ajax({
            url: 'open_web',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                st: s
            }
        })
        .done(function(res) {
            if (res.code == 1) {
                swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
               

            } else {
                swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
            }
        })
}
</script>
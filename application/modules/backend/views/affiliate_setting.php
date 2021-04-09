<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.css"
    rel="stylesheet">
<script src="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.js"></script>
<div class="right_col" role="main">
    <div class="clearfix">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-5">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ตั้งค่า Affiliate</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class=" radio">
                        <!-- เปิดปิด ระบบแอดเครดิต -->
                        <div class="form-group row">
                            
                            <div class="col-md-12 col-sm-12 ">
                            <div class="form-group row">
                                <label style="padding: 15px;">
                                    <?php $num = 1; foreach($auto as $at){ ?>
                                    <?php //echo $set['id'];?>
                                    <?php  if($at['status']=="0"){?>
                                    <input type="checkbox" onchange="turnon_exchange();" id="idturnon"
                                        value="<?= $at['id'];?>" name="<?=$at['name']?>" class="js-switch"
                                        <?=$at['status'] == 0 ? '':''?> />
                                    <?php }else{?>
                                    <input type="checkbox" onchange="turnoff_exchange();" id="idturnoff"
                                        value="<?= $at['id'];?>" name="<?=$at['name']?>" class="js-switch"
                                        <?=$at['status'] == 1 ? 'checked':''?> />
                                    <?php }}?>
                                    <span style="font-size: 18px;padding: 15px;color: #000">แลกเครดิตอัตโนมัติ</span>
                                </label>
                            </div>
                            </div>
                        </div>
                        <hr>
                        <!-- end -->
                         <!-- เปิดปิด ระบบแอดเครดิต -->
                         <div class="form-group row">
                            <label>
                                <span style="font-size: 18px;padding: 15px;color: #000">ตั้งค่าเกมส์</span>
                            </label>
                            <a href="<?=base_url()?>backend/turnover/setturnover" role="button" >
                                <span style="font-size: 18px;padding-left: 15px;padding-right: 100px;color: #000" ><i class="fa fa-caret-down"></i></span>
                            </a>
                            <div class="col-md-12 col-sm-12 ">
                           
                            </div>
                        </div>
                        <hr>
                        <!-- end -->
                         <!-- เปิดปิด ระบบแอดเครดิต -->
                         <div class="form-group row">
                            <label>
                                <span style="font-size: 18px;padding: 15px;color: #000">ตั้งค่าระดับชั้น</span>
                            </label>
                            <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                  <span style="font-size: 18px;padding-left: 15px;padding-right: 100px;color: #000" ><i class="fa fa-caret-down"></i></span>
                              </a>
                            <div class="col-md-12 col-sm-12 ">
                            <div class="collapse" id="collapseExample2" style="padding: 15px;">
                                <div class="row">
                                <div class="form-group row">
                                    <label for="" class="col-sm-1 col-form-label">ชั้นที่ 1</label>
                                    <div class="col-sm-2">
                                      <input type="number" step="0.01" class="form-control" id="f_class" value="<?php if($af_class){echo $af_class->f_class;}else{echo '0.0';}?>">
                                    </div>
                                    <label for="" class="col-sm-1 col-form-label">ชั้นที่ 2</label>
                                    <div class="col-sm-2">
                                      <input type="number" step="0.01" class="form-control" id="s_class" value="<?php if($af_class){echo $af_class->s_class;}else{echo '0.0';}?>">
                                    </div>
                                    <label for="" class="col-sm-1 col-form-label">ชั้นที่ 3</label>
                                    <div class="col-sm-2">
                                      <input type="number" step="0.001" class="form-control" id="t_class" value="<?php if($af_class){echo $af_class->t_class;}else{echo '0.0';}?>">
                                    </div>
                                    <div class="col-sm-3">
                                      <button class="btn btn-info" onClick="set_class()">ตั้งค่า</button>
                                    </div> 
                                </div>
                              </div>
                            </div>
                            </div>
                        </div>
                        <hr>
                        <!-- end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    </div>
</div>
<script>

function setting(){

    var vendor_id = $('#vendor').val();
    swal({
            title: 'ยืนยันการทำรายการ',
            text: 'คุณต้องการทำรายการนี้ใช่หรือไม่?',
            buttons: true,
            dangerMode: true,
          }).then ((willDelete) => {

            if(willDelete) {
              $('#cover-spin').show();
            $.ajax({
            url: '<?php echo base_url() ?>backend/affiliate/af_setting',
            type: 'POST',
            dataType: 'json',
            data: {vendor_id:vendor_id}
          })
          .done(function(res){
            if (res.code == 1){
              $('#cover-spin').hide();
			 swal({
                icon: "success",
                title: res.title,
                text: res.msg
              });
              setTimeout(function(){
                location.reload();
              }, 2000);
                         
			      }else if(res.code == 2){
              $('#cover-spin').hide();
			 swal({
                icon: "error",
                title: res.title,
                text: res.msg
              });
              setTimeout(function(){
                location.reload();
              }, 2000);

            }
          
          });
          }else{
            return false;
          }
      });
  
}

  function set_class(){

    var f_class = $('#f_class').val();
    var s_class = $('#s_class').val();
    var t_class = $('#t_class').val();
    

    swal({
            title: 'ยืนยันการทำรายการ',
            text: 'คุณต้องการทำรายการนี้ใช่หรือไม่?',
            buttons: true,
            dangerMode: true,
          }).then ((willDelete) => {

            if(willDelete) {
              $('#cover-spin').show();
            $.ajax({
            url: '<?php echo base_url() ?>backend/affiliate/af_setting',
            type: 'POST',
            dataType: 'json',
            data: {f_class:f_class, s_class:s_class, t_class:t_class}
          })
          .done(function(res){
            if (res.code == 1){
              $('#cover-spin').hide();
			 swal({
                icon: "success",
                title: res.title,
                text: res.msg
              });
              setTimeout(function(){
                location.reload();
              }, 2000);
                         
			      }else if(res.code == 2){
              $('#cover-spin').hide();
			 swal({
                icon: "error",
                title: res.title,
                text: res.msg
              });
              setTimeout(function(){
                location.reload();
              }, 2000);

            }
          
          });
          }else{
            return false;
          }
      });

  }

  function turnon_exchange() {

    swal({
      
            text: "คุณต้องการเปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#idturnon').val();
                $.ajax({
                        url: '<?php echo base_url() ?>backend/affiliate/af_setting',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.msg,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function turnoff_exchange() {
    swal({

            text: "คุณต้องการปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var off_id = $('#idturnoff').val();
                $.ajax({
                        url: '<?php echo base_url() ?>backend/affiliate/af_setting',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          off_id: off_id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.msg,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });

}


</script>
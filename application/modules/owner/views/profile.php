<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<div class="row">
    <div class="col-md-6 col-sm-6 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>โปรไฟล์ <?= $owner->name;?> <small class="text-success"> (ใช้งาน) </small></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-6 col-sm-6  profile_left">

                    <h3><?= $owner->name;?></h3>

                    <ul class="list-unstyled user_data">
                        <li>
                            <i class="fa fa-clock-o user-profile-icon"></i> วันที่เข้าล่าสุด : <?=date('d/m/Y',$owner->last_login);?>
                        </li>

                        <li>
                            <i class="fa fa-clock-o user-profile-icon"></i> เวลาเข้าล่าสุด :<?=date('H:i:s',$owner->last_login)?>
                        </li>
                        <li>
                            <i class="fa fa-map-marker user-profile-icon"></i> IP ล่าสุด : <?=$owner->lastip_login;?>
                        </li>
                    </ul>

                    <a class="btn btn-sm btn-outline-info" onClick="$('#m_edit_pass').modal()"><i
                            class="fa fa-edit m-right-xs"></i> เปลี่ยนพาส</a>
                    <br />


                </div>

               
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 ">
      <div class="col-md-12 col-sm-12  profile_details">
        <div class="well profile_view" style="padding-top: 25px; padding-right: 200px; padding-bottom: 70px; padding-left: 15px;">
          <div class="col-md-12">

            <div class="left col-md-12 col-sm-12 border-bottom">
              <h4 class="col-sm-12"><i>Setting Two factor</i></h4>

            </div>
            <div class="row">
              <div class="left col-md-12 col-sm-12">
                <div class="row" id="setTwofactor">

                  <?php
                  $tf = json_decode($owner->two_factor);
                  if ($tf->key == "" && $tf->linkQr == "") { ?>
                    <div class="col-md-12 col-sm-12">
                      <p> <button class="btn btn-info" onclick="if(confirm('ยืนยันการรีเซ็ต')){new_tf()}"> <i class="fa fa-refresh fa-1x" aria-hidden="true"></i> สร้างใหม่</button></p>
                    </div>
                    <?php   } else {
                    if ($tf->status == "wait") { ?>
                      <p> <button class="btn btn-info" onclick="if(confirm('ยืนยันการรีเซ็ต')){new_tf()}"> <i class="fa fa-refresh fa-1x" aria-hidden="true"></i> สร้างใหม่</button></p>
                    <?php    } else { ?>
                      <div class="col-sm-6"> ยืนยันรหัสผ่าน:<input type="password" class="form-control" id="againPass" /></div>
                      <div class="col-sm-4"> ยืนยัน 2F:<input type="text" class="form-control" id="code" /></div>
                      <div class="col-sm-2">
                        <br> <button class="btn btn-success" onclick="showSetTwofac()">ยืนยัน</button>
                      </div>
                    <?php    } ?>

                  <?php } ?>



                </div>

                <hr>
                <div class="col-md-12 col-sm-12 mx-auto text-center">
                  <img src="https://www.imi55.com/mem/public/img/auth.png">
                  <a href="https://apps.apple.com/th/app/google-authenticator/id388497605" target="_blank"><img src="https://www.imi55.com/mem/public/img/apple.png"></a>
                  <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank"><img src="https://www.imi55.com/mem/public/img/google.png"></a>


                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

</div>


<div class="modal fade " tabindex="-1" role="dialog" id="m_edit_pass" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left input_mask ">
                <div class="modal-body">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12  form-group has-feedback ">
                            <input type="hidden" id="edp_sid" value="<?= $owner->id?>">
                            <input type="text" class="form-control has-feedback-left" readonly value="<?=$owner->name ?>">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-12 col-sm-12  form-group has-feedback">

                            <input type="password" class="form-control has-feedback-left" id="edp_p"
                                placeholder="Password">
                            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            <span class="fa fa-eye form-control-feedback right" aria-hidden="true"
                                onClick="show_password()"></span>
                        </div>

                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button onClick="edit_pass()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div><strong></strong>
<script>
  function change_status_tf() {

var status_tf = ($('#tf_status').prop("checked")) ? "on" : "off";
$.ajax({
    url: 'change_status_tf',
    type: 'POST',
    dataType: 'json',
    data: {
      status_tf: status_tf
    }
  })
  .done(function(res) {
    if (res.code == 1) {
      swal({
        icon: "success",
        text: res.msg,
      });
      setTimeout(function() {
        location.reload();
      }, 500);
    } else {
      swal({
        icon: "error",
        text: res.msg,
      });
    }
  });
}

function showSetTwofac() {
var againPass = $('#againPass').val();
var code = $('#code').val();
$.ajax({
    url: 'setHtmlTwoFac',
    type: 'POST',
    dataType: 'json',
    data: {
      againPass,
      code
    }
  })
  .done(function(res) {
    if (res.status == 1) {
      var d = (res.data);
      let ch = (d.status == "on") ? 'checked' : '';
      let key = d.key;
      let linkQr = d.linkQr;
      divSetTwof(ch, linkQr, key);
    } else if (res.status == 0) {
      swal({
        icon: "error",
        text: res.msg,
      });
    }

  });

}

function divSetTwof(ch, linkQr, key) {
$('#setTwofactor').html('');
txt = `<div class="col-md-12 col-sm-12">
                <i class="fa fa-unlock-alt fa-2x" aria-hidden="true"></i> การใช้งาน :: 
                <label class="switch">
                             <input type="checkbox" id="tf_status" onchange="change_status_tf()" ${ch} class="js-switch" />
                            <span class="slider round"></span>
                          </label>
              </div>
              <div class="col-md-12 col-sm-12">
                <p> <button class="btn btn-info" onclick="if(confirm('ยืนยันการรีเซ็ต')){new_tf()}"> <i class="fa fa-refresh fa-1x" aria-hidden="true"></i> สร้างใหม่</button></p>
              </div>`;

$('#setTwofactor').html(txt);
}

function new_tf() {
$.ajax({
    url: 'newKeyTwoFactor',
    type: 'POST',
    dataType: 'json',
    data: {
      new: 'new'
    }
  })
  .done(function(res) {
    if (res.code == 1) {
      var d = JSON.parse(res.data.two_factor);
      let ch = d.status;
      let linkQr = d.linkQr;
      let key = d.key;

      swal({
        buttons: {
          cancel: true,
          confirm: "ต่อไป",
        },
        content: {
          element: "img",
          attributes: {
            class: "card-img-top img-fluid",
            src: linkQr,
          },
        },
        text: "กรุณารอ QR CODE หรือใช้ key:[ " + key + " ] เพิ่มบัญชี",
      }).then((v) => {
        if (v) {
          checSwal2F();
        } else {
            location.reload();
        }
      });
      divSetTwof(ch, linkQr, key)
    } else {
      swal({
        icon: "error",
        text: res.msg,
      });
    }

  });
}


function checSwal2F() {
swal("ยืนยันรหัสจาก App Google Autenticator", {
    buttons: {
      cancel: true,
      confirm: "ตกลง",
    },
    content: {
      element: "input",
      attributes: {
        type: "text",
        placeholder: "กรอกรหัสยืนยัน",
      },
    },
  })
  .then((pin) => {
    if (pin) {
      $.ajax({
          url: 'confrimTwofactor',
          type: 'POST',
          dataType: 'json',
          data: {
            pin
          }
        })
        .done(function(res) {
          console.log(res);
          if (res.code == 1) {   
            location.reload();
          }else{
            checSwal2F()
          }
        });
      
    } else {
        location.reload();
    }

  });
}

function show_password() {
    var x = document.getElementById("edp_p");

    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

}

function edit_pass() {
    $('#cover-spin').show();
   
    var pass = $('#edp_p').val();
    swal({
            text: "คุณต้องการเปลี่ยนรหัสผ่่าน",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: '<?=base_url()?>owner/home/edit_pass',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            pass: pass
                       
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal(res.title, res.msg, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal(res.title, res.msg, 'error');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    });

            } else {
                swal('ไม่ทำรายการ', 'ยกเลิกการทำรายการ', "error")
                setTimeout(function() {}, 1000);
            }
            $('#cover-spin').hide();
        });
}
</script>
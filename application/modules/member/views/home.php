  <!-- alert รูปปิดปรับปรุง     -->
  <style>
      .s {
          position: fixed;
          left: 35%;
          right: 15%;
          top: 19%;
          z-index: 1002;
          overflow: auto;
          box-shadow: 0px 0px 5px 4px #dfb708;
          border: 1px solid #141414;
          border-radius: 10px;
      }

      .x {
          position: fixed;
          left: 6%;
          right: 15%;
          top: 19%;
          z-index: 1002;
          border: 1px solid #141414;
          border-radius: 10px;
          overflow: auto;
          box-shadow: 0px 0px 5px 4px #dfb708;
      }
  </style>



  <!--LOGIN-->
  <header class="masthead text-white text-center" style="height: 90%;padding-top: 10rem" id="tap_login">
      <div class="container d-flex align-items-center flex-column">




          <div class="text-center">
              <img src="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" width="250px" alt="123xBET" />
              <!-- <div class="sc-jKJlTe jDELla">อาณาจักรเดิมพัน</div> -->
          </div>
          <div>
              <div class="input-group mb-3 sc-chPdSV CRxcy" style="text-align: -webkit-left; width: 100%;">
                  <div class="input-group-prepend">
                      <span class="input-group-text sc-kpOJdX fDGGgB">
                          <svg aria-hidden="true" data-prefix="far" data-icon="user" class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                              <path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path>
                          </svg>
                      </span>
                  </div>
                  <input type="text" name="username" id="username" class="form-control sc-kgoBCf eHUStl" placeholder="ชื่อผู้ใช้" />
              </div>
          </div>
          <div>
              <div class="input-group mb-3 sc-chPdSV CRxcy" style="text-align: -webkit-left; width: 100%;">
                  <div class="input-group-prepend">
                      <span class="input-group-text sc-kpOJdX fDGGgB">
                          <svg aria-hidden="true" data-prefix="far" data-icon="unlock-alt" class="svg-inline--fa fa-unlock-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                              <path fill="currentColor" d="M400 240H128v-94.8c0-52.8 42.1-96.7 95-97.2 53.4-.6 97 42.7 97 96v24c0 13.3 10.7 24 24 24s24-10.7 24-24v-22.6C368 65.8 304 .2 224.3 0 144.8-.2 80 64.5 80 144v96H48c-26.5 0-48 21.5-48 48v176c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V288c0-26.5-21.5-48-48-48zm0 224H48V288h352v176zm-176-32c-15.5 0-28-12.5-28-28v-56c0-15.5 12.5-28 28-28s28 12.5 28 28v56c0 15.5-12.5 28-28 28z"></path>
                          </svg>
                      </span>
                  </div>

                  <input type="password" name="password" id="password" class="form-control sc-kGXeez cGnFFR" placeholder="รหัสผ่าน" value="" />
              </div>
              <div class="input-group row ">
                        <div class="col-md-12 text-right">
                        <span style="font-size: 11px;font-weight:normal" onclick="menubar('forget')"><i class="fa fa-key" aria-hidden="true"> ลืมพาสเวิร์ด</i></span>
                        </div>
                    </div>
          </div>
          <button type="button" class="sc-dxgOiQ hMaYnt btn-submit" onClick="login()">เข้าสู่ระบบ</button>
          <button color="#FFFFFF" type="button" onClick="menubar('register')" class="sc-kjoXOD kJVZgs">สมัครสมาชิก</button>

      </div>
  </header>


  <!-- CONTACT-->
  <header class="masthead text-white text-center" style="height: 90%;display: none;padding-top: 10rem" id="tap_contact">
      <div class="container d-flex align-items-center flex-column">
          <div class="row">

              <div class="col-12 text-center">
                  <a href="line://ti/p/@imi55">
                      <img src="<?= $this->config->item('tem_frontend') ?>img/mapraw_icon/line_contect.png" title="line imi55" alt="line imi55" width="100%">
                  </a>
                  <a href="line://ti/p/@638rsqhd">
                      <img src="<?= $this->config->item('tem_frontend') ?>img/New-Line-bot.png" title="line imi55" alt="line imi55" width="100%">
                  </a>
              </div>

          </div>
      </div>

  </header>
  <!-- REGISTER-->
  <header class="masthead text-white text-center" style="height: 90%;padding-top: 10rem;display: none;" id="tap_register">
      <div class="container d-flex align-items-center flex-column">
          <label style="font-size: 18px;">สมัครสมาชิกใหม่</label>
          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-phone"></i></span>
                      </div>
                      <input type="number" class="form-control" id="phone" placeholder="เบอร์โทรศัพท์">
                  </div>
                  <small style="display: none;color:#F36C6E;" id="ale_phone"> ** กรุณากรอกเบอร์มือถือให้ถูกต้อง
                  </small>
              </div>
          </div>
          <div class="form-group">

              <button type="button" class="sc-dxgOiQ hMaYnt btn-submit" onClick="register('')">สมัคร</button>
              <button color="#FFFFFF" type="button" onClick="menubar()" class="sc-kjoXOD kJVZgs">ยกเลิก</button>


          </div>

      </div>
  </header>
  <!-- OTP -->

  <header class="masthead text-white text-center" style="height: 90%;display: none;padding-top: 10rem" id="tap_otp">
      <div class="container d-flex align-items-center flex-column">
          <label style="font-size: 18px;padding-bottom: 10px">"รหัสยืนยันทาง SMS"</label>
          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <label> REF : <span id="ref_s"></span></label>
                  </div>
              </div>
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" id="input_otp" placeholder="OTP">
                  </div>
                  <span style="font-size: 12px">otp มีอายุ 5 นาที</span>
                  <small style="display: none;color:#F36C6E;" id="ale_otp"> ** OTP ของคุณไม่ตรงกับ REF
                      กรุณากรอกใหม่ค่ะ
                  </small>
              </div>
          </div>
          <button type="button" class="sc-dxgOiQ hMaYnt btn-submit" onClick="otp('')">S E N D</button>

          <div style="padding-top: 30px;font-size: 14px"> <a href="#" onClick="register();">Please send again OTP
                  !!</a>
          </div>
      </div>
  </header>

  <!-- BANK -->
  <header class="masthead text-white text-center" style="height: 90%;display: none;padding-top: 4rem" id="tap_bank">
      <div class="container d-flex align-items-center flex-column">
          <label style="font-size: 18px;">กรุณากรอกข้อมูลให้ครบถ้วน.</label>
          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-phone"></i></span>
                      </div>
                      <input type="text" id="span_tel" class="form-control" readonly>
                  </div>
              </div>
              <div class="col-md-12 mb-3">
                  <span class="text-left" style="color: #FF3E41">** รหัสผ่านต้องมีตัวอักษร
                      พิมพ์เล็กและตัวเลขผสมกันอย่างน้อย 8 ตัว เช่น aa123654</span>

                  <div class="input-group">

                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      </div>
                      <input type="text" class="form-control" id="newpass" placeholder="Password" maxlength="15" onchange="ckpass()">
                      <div class="input-group-append">
                          <span class="input-group-text" id="testpass"><i class=" fa fa-remove"></i></span>
                      </div>
                  </div>
                  <small style="display: none;color:#F36C6E;" id="ale_password"> ** กรุณากรอกรหัสผ่านให้ถูกต้อง
                  </small>
              </div>


              <script type="text/javascript">
                  function ckpass() {
                      var pwdPolicy = /^\w*(?=\w*\d)(?=\w*[a-z])\w.{7,15}$/;
                      var newpass = (document.getElementById('newpass').value).trim();
                      if (newpass.match(pwdPolicy)) {
                          $('#testpass').html('<i class="text-success fa fa-check"></i>');
                          return true;
                      } else {
                          document.getElementById('newpass').focus();
                          $('#testpass').html('<i class="text-danger fa fa-remove"></i>');
                          return true;
                      }
                  }
              </script>

              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-university"></i></span> </div>
                      <select class="form-control" id="bank_id">
                          <option value="">กรุณาเลือกธนาคาร</option>
                          <?php
                            foreach ($bank as $bnk) {
                            ?>
                              <option value="<?= $bnk['id'] ?>">
                                  <?= substr($bnk['bank_th'], 18) . ' [' . $bnk['bank_short'] . ']' ?>
                              </option>
                          <?php
                            } ?>
                      </select>
                  </div>
              </div>
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-money-bill-alt"></i></span> </div>
                      <input type="number" class="form-control" id="account" placeholder="เลขที่บัญชีธนาคาร">
                  </div>
                   <b style="color:red;" > ** ข้อมูลส่วนตัวไม่สามารถเปลี่ยนแปลงภายหลังได้ </b>
                  <small style="display: none;color:#F36C6E;" id="ale_account"> ** กรุณาเลขที่บัญชีให้ถูกต้อง </small>
              </div>
          </div>

          <button type="button" class="sc-dxgOiQ hMaYnt btn-submit" id="btn_createUser" onClick="createUser('')">S E N D</button>

      </div>

  </header>


  <!--login ที่มีอยู่แล้ว-->
  <header class="masthead text-white text-center" style="height: 90%;padding-top: 10rem;display: none;" id="tap_mb_login">
      <div class="container d-flex align-items-center flex-column">
          <label style="font-size: 18px;">สำหรับลูกค้าเก่า</label>

          <div class="form-group">
              <input type="text" class="form-control" placeholder="ยูเซอร์ลูกค้า" value="" required title="ยูเซอร์ลูกค้า" id="mb_username">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" placeholder="รหัสผ่านลูกค้า" value="" required title="รหัสผ่านลูกค้า" id="mb_password">
          </div>

          <div class="form-group">
              <button class="btn btn-outline-light" title="Login" id="btn_login" onClick="menubar('')"><i class="fa fa-arrow-left"></i> กลับ</button> &nbsp;&nbsp;
              <button class="btn btn-outline-light" title="Login" id="btn_login2" onClick="login_mb()"><i class="fa fa-check"></i> ตกลง</button>


          </div>
      </div>
  </header>

  <header class="masthead text-white text-center" style="height: 90%;display: none;padding-top: 10rem" id="tap_memberUser">
      <div class="container d-flex align-items-center flex-column">
          <label style="font-size: 18px;">กรุณากรอกรายละเอียด</label>
          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-phone"></i></span>
                      </div>
                      <input type="text" id="mb_phone" class="form-control" placeholder="เบอร์โทรศัพท์">
                      <input type="hidden" id="mb_pass">
                  </div>
              </div>
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user"></i></span>
                      </div>
                      <input type="text" id="mb_user" class="form-control" placeholder="ยูเซอร์ที่เคยลงทะเบียนไว้">
                  </div>
              </div>

              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-university"></i></span> </div>
                      <select class="form-control" id="mb_bank">
                          <option value="" style="background-color: #131c29;">กรุณาเลือกแบงค์</option>
                          <?php
                            foreach ($bank as $bnk) {
                            ?>

                              <option style="background-color: #131c29;" value="<?= $bnk['id'] ?>">
                                  <?= substr($bnk['bank_th'], 18) . ' [' . $bnk['bank_short'] . ']' ?>
                              </option>
                          <?php
                            } ?>
                      </select>
                  </div>
              </div>
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-money-bill-alt"></i></span> </div>
                      <input type="number" class="form-control" id="mb_account" placeholder="เลขที่บัญชีธนาคาร">
                  </div>
                  <small style="display: none;color:#F36C6E;" id="ale_account"> ** กรุณาเลขที่บัญชีให้ถูกต้อง </small>
              </div>
          </div>


          <button type="button" class="sc-dxgOiQ hMaYnt btn-submit" id="btn_createUser" onClick="members('')">S E N D</button>
      </div>
  </header>

  <!-- FORGET PASSWORD-->
  <header class="masthead text-white text-center" style="height: 90%;display: none;padding-top: 10rem" id="tap_forget">
      <div class="container d-flex align-items-center flex-column">
          <label style="font-size: 18px;">กรุณากรอกเบอร์โทรศัพท์.</label>
          <div class="form-row">
              <div class="col-md-12 mb-3">
                  <div class="input-group">
                      <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-phone"></i></span>
                      </div>
                      <input type="number" class="form-control" id="fg_phone" placeholder="เบอร์โทรศัพท์" maxlength="10">
                  </div>

              </div>
          </div>
          <button onClick="forget()" class="btn btn-outline-light">ขอรหัสผ่านใหม่</button>
      </div>

  </header>

  <div style="padding-top: 200px;"></div>

  <!-- Modal maintenance-->

  <div class="modal fade" id="maintenance">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <a href="#" class="close" data-dismiss="modal"><i class="fa fa-remove"></i></a>
              </div>
              <div class="modal-body">
                <a href="line://ti/p/@638rsqhd">
                  <img src="<?= $this->config->item('tem_frontend_img') . 'maintenance/' . $maintenance->name ?>" width="100%" alt="<?= $this->getapi_model->nameweb() ?>" />
                </a>

              </div>
          </div>
      </div>
  </div>



  <!-- Bootstrap core JS-->
  <script src="<?php echo base_url() ?>public/tem_admin/swal/sweetalert.min.js"></script>
  <script>
      var maintenacnce = <?= $maintenance->status ?>;
      if (maintenacnce == 1) {
          $(window).on('load', function() {
              $('#maintenance').modal('show');
          });
      }

      function members() {
          var phone = $('#mb_phone').val();
          var user = $('#mb_user').val();
          var pass = $('#mb_pass').val();
          var bank_id = $('#mb_bank').val();
          var account = $('#mb_account').val();
          $.ajax({
                  url: 'home/members',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                      phone: phone,
                      user: user,
                      pass: pass,
                      bank_id: bank_id,
                      account: account
                  },
              })
              .done(function(res) {
                  // success
                  if (res.code == 1) {
                      swal(res.titel, res.msg, "success")
                          .then(function(sw) {
                              $('#cover-spin').show();
                              setTimeout(function() {
                                  $('#cover-spin').hide();
                                  window.location.href = "<?php echo base_url() ?>users/member";
                              }, 500);
                          });
                  } else {
                      swal(res.titel, res.msg, "error")
                  }
              });
      }

      function menubar(action) {

          if (action == 'contact') {
              $('#tap_login').hide();
              $('#tap_register').hide();
              $('#tap_memberUser').hide();
              $('#tap_contact').show();
              $('#tap_mb_login').hide();
              $('#tap_forget').hide();
          } else if (action == 'register') {
              $('#tap_login').hide();
              $('#tap_register').show();
              $('#tap_memberUser').hide();
              $('#tap_contact').hide();
              $('#tap_mb_login').hide();
              $('#tap_forget').hide();
              $('#phone').focus();

          } else if (action == 'mb_login') {
              $('#tap_login').hide();
              $('#tap_register').hide();
              $('#tap_mb_login').show();
              $('#tap_contact').hide();
              $('#tap_memberUser').hide();
              $('#tap_forget').hide();

          } else if (action == 'forget') {
              $('#tap_login').hide();
              $('#tap_register').hide();
              $('#tap_mb_login').hide();
              $('#tap_contact').hide();
              $('#tap_memberUser').hide();
              $('#tap_forget').show();
          } else { //login
              $('#tap_login').show();
              $('#tap_memberUser').hide();
              $('#tap_register').hide();
              $('#tap_contact').hide();
              $('#tap_mb_login').hide();
          }
      }

      function login() {

          var username = $('#username').val();
          var password = $('#password').val();
          if (username == '' || password == '') {
              alert('กรุณากรอกข้อมูลให้ครบถ้วน');
              $('#username').focus();
          } else {
              $.ajax({
                      url: '<?php echo base_url() ?>users/home/login',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          username: username,
                          password: password
                      },
                  })
                  .done(function(re) {
                      // success
                      if (re.code == 1) {
                          swal(re.titel, re.msg, "success");
                          $('#cover-spin').show();
                          setTimeout(function() {
                              $('#cover-spin').hide();
                              window.location.href = "<?php echo base_url() ?>users/member";
                          }, 1000);

                      } else if (re.code == 2) { //Password fail
                          swal(re.titel, re.msg, "error")
                              .then(function(sw) {
                                  $('#password').val('');
                                  $('#password').focus();
                              });
                      }else if (re.code == 6) {
                         swal({
                            title: "",
                            text: "เข้าสู่ระบบสำเร็จ",
                            icon: "success",
                        });
                        setTimeout(function(){ window.location.href = re.data.RedirectUrl;}, 2000);
                        
                       } else {
                          swal(re.titel, re.msg, "error")
                              .then(function(sw) {
                                  location.reload();
                              });
                      }
                  });
          }

      }

      function login_mb() {
          var mb_username = $('#mb_username').val();
          var mb_password = $('#mb_password').val();
          $.ajax({
                  url: 'home/mb_login',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                      mb_username: mb_username,
                      mb_password: mb_password
                  },
              })
              .done(function(res) {
                  // success
                  if (res.code == 1) {
                      swal(res.titel, res.msg, "success")
                          .then(function(sw) {
                              $('#tap_mb_login').hide();
                              $('#cover-spin').show();
                              setTimeout(function() {
                                  $('#cover-spin').hide();
                                  $('#tap_memberUser').show();
                                  $('#mb_pass').val(res.pass);
                                  $('#mb_user').val(res.mbuser);
                                  $('#mb_phone').focus();
                              }, 1000);
                          });
                      // Loginผิด
                  } else {
                      swal(res.titel, res.msg, "error")
                          .then(function(sw) {
                              $('#phone').focus();
                          });
                  }
              });

      }

      function register() {
          var tel = $('#phone').val();
          if (tel.length == '10') {
              $.ajax({
                      url: '<?php echo base_url() ?>users/home/register',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          tel: tel,
                      },
                  })
                  .done(function(res) {
                      // success
                      if (res.code == 1) {
                          swal(res.titel, res.msg, "success")
                          $('#tap_register').hide();
                          $('#cover-spin').show();
                          setTimeout(function() {
                              $('#cover-spin').hide();
                              $('#tap_otp').show();
                              $('#ref_s').html(res.ref);
                              $('#input_otp').focus();
                              //โชว์ข้อมูลเดิมส่วนสมัครสมาชิก
                              $('#newpass').val(res.user['password']);
                              $('#account').val(res.user['account']);
                              $('#bank_id').val(res.user['id']).change();
                          }, 500);

                          // เบอร์ลงทะเบียนไว้แล้ว goto login
                      } else if (res.code == 2) {
                          swal(res.titel, res.msg, "error")
                              .then(function(sw) {
                                  location.reload();
                              });
                          // OTP สำเร็จ goto bank
                      } else if (res.code == 3) {
                          swal(res.titel, res.msg, "success")
                          $('#tap_register').hide();
                          $('#tap_otp').hide();
                          $('#cover-spin').show();
                          setTimeout(function() {
                              $('#cover-spin').hide();
                              $('#tap_bank').show();
                              $('#span_tel').val(tel);
                              $('#newpass').focus();
                          }, 500);
                      } else if (res.code == 4) {
                          // location.reload();
                          $('#tap_register').hide();
                          $('#tap_otp').hide();
                          $('#cover-spin').show();
                          setTimeout(function() {
                              $('#cover-spin').hide();
                              $('#tap_bank').show();
                              $('#span_tel').val(tel);
                              $('#newpass').val(res.user['password']); //โชว์พาสเวิด หน้า regis ธนาคาร
                              $('#bank_id').val(res.user['id']).change();
                              $('#newpass').focus();
                              $('#account').val(res.user['account']);
                          }, 500);
                          //ส่ง เบอร์ใหม่อีกครั้ง
                      } else {
                          swal(res.titel, res.msg, "error")
                              .then(function(sw) {
                                  $('#phone').focus();
                              });
                      }
                  });
          } else {
              swal('เบอร์โทรผิด !!', 'กรุณากรอกเบอร์โทรใหม่', "error")
                  .then(function(sw) {
                      $('#phone').focus();
                      $('#ale_phone').show();
                  });

          }

      }

      function otp() {
          var ref = $('#ref_s').html();
          var otp = $('#input_otp').val();
          var tel = $('#phone').val();
          $.ajax({
              url: '<?php echo base_url() ?>users/home/otp',
              type: 'POST',
              dataType: 'json',
              data: {
                  ref: ref,
                  otp: otp,
                  tel: tel
              },
          }).done(function(res) {
              //success goto bank
              if (res.code == 1) {
                  swal(res.titel, res.msg, "success")
                      .then(function(sw) {
                          $('#tap_otp').hide();
                          $('#cover-spin').show();
                          setTimeout(function() {
                              $('#cover-spin').hide();
                              $('#tap_bank').show();
                              $('#span_tel').val(tel);
                              $('#newpass').focus();
                          }, 500);
                      });
                  // ส่ง OTP ใหม่อีกครั้ง
              } else if (res.code == 2) {
                  swal(res.titel, res.msg, "error")
                      .then(function(sw) {
                          $('#input_otp').focus();
                      });
                  // เบอร์โทรมีปัญหา กรอกใหม่อีกครั้ง
              } else {
                  swal(res.titel, res.msg, "error")
                      .then(function(sw) {
                          location.reload();
                      });
              }
          });
      }

      function createUser() {
          var pwdPolicy = /^\w*(?=\w*\d)(?=\w*[a-z])\w.{7,15}$/;

          var newpass = $('#newpass').val();
          var account = $('#account').val();
          var bank_id = $('#bank_id').val();
          var tel = $('#phone').val();
          if (newpass.match(pwdPolicy)) {
              $('#testpass').html('<i class="text-success fa fa-check"></i>');


              // get sale id from url
              var url = window.location.pathname;
              var s_id = url.substring(url.lastIndexOf('/') + 1);

              $('#cover-spin').show();
              if (account.length >= '10') {
                  $.ajax({
                          url: '<?php echo base_url() ?>users/home/createUser',
                          type: 'POST',
                          dataType: 'json',
                          data: {
                              tel: tel,
                              newpass: newpass,
                              account: account,
                              bank_id: bank_id,
                              s_id: s_id
                          },
                      })
                      .done(function(res) {
                          $('#cover-spin').hide();
                          // success
                          if (res.code == 1) {
                              swal(res.titel, res.msg, "success")
                                  .then(function(sw) {
                                      $('#cover-spin').show();
                                      setTimeout(function() {
                                          $('#cover-spin').hide();
                                          window.location.href = "<?php echo base_url() ?>users/member";
                                      }, 2000);
                                  });
                              //ระบบมีปัญหา
                          } else if (res.code == 2) {
                              swal(res.titel, res.msg, "error")
                                  .then(function(sw) {

                                  });
                              // ธนาคารซ้ำ
                          } else {
                              swal(res.titel, res.msg, "error")
                                  .then(function(sw) {
                                      window.location.href = "home";
                                  });
                          }
                      });
              } else {
                  swal('เลขที่บัญชีไม่ถูกต้อง', 'กรุณากรอกเลขที่บัญชีให้ถูกต้อง', "error")
              }

          } else {

              document.getElementById('newpass').focus();
              $('#testpass').html('<i class="text-danger fa fa-remove"></i>');
              swal('รหัสผ่านไม่ถูกต้อง', 'กรุณากรอกรหัสผ่านใหม่ค่ะ', "error");

          }

      }

      function forget() {
          var phone = $('#fg_phone').val();
          $.ajax({
                  url: 'home/forget',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                      phone: phone
                  },
              })
              .done(function(res) {
                  // success
                  if (res.code == 1) {
                      swal(res.titel, res.msg, "success")
                          .then(function(sw) {
                              location.reload();
                          });
                      // Loginผิด
                  } else {
                      swal(res.titel, res.msg, "error")
                          .then(function(sw) {
                              $('#phone').focus();
                          });
                  }
              });
      }
  </script>
  <script>
      $(document).ready(function() {
          $("#phone").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btn_regis").click();
              }
          });
          $("#password").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btn_login").click();
              }
          });
          $("#input_otp").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btn_otp").click();
              }
          });
          $("#mb_password").keyup(function(event) {
              if (event.keyCode === 13) {
                  $("#btn_login2").click();
              }
          });
      });
  </script>
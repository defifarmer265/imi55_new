<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>♥ <?= $this->getapi_model->nameweb() ?> ♥ </title>

  <!-- Bootstrap -->

  <link href="<?php echo base_url() ?>public/tem_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?php echo base_url() ?>public/tem_admin/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">

  <div>


    <div class="login_wrapper">
      <section class="login_content">
        <form>
          <h1>Admin <?= $this->getapi_model->nameweb() ?></h1>

          <div class="col-md-12 col-sm-12  form-group has-feedback">

            <input type="text" class="form-control has-feedback-left" id="username" placeholder="Username" autocomplete="off">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>

          </div>

          <div class="col-md-12 col-sm-12  form-group has-feedback">

            <input type="password" class="form-control has-feedback-left" id="password" placeholder="Password" autocomplete="off" onKeyUp="enter_login(event)">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
            <span class="fa fa-eye form-control-feedback right" aria-hidden="true" onClick="OC_edp_p()"></span>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">

            <input type="text" class="form-control has-feedback-left" id="safecode" placeholder="Safecode" maxlength="6" autocomplete="off" onKeyUp="enter_login(event)">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>

          </div>
        </form>
        <div>
          <button onClick="login()" class="btn btn-round btn-warning">Log in</button>
        </div>
        <div class="clearfix"></div>
        <div class="separator">
          <div class="clearfix"></div>
          <br />
          <div>
            <h2><i class="fa fa-paw"></i><?= $this->getapi_model->nameweb() ?></h2>
            <p>©2020 All <?= $this->getapi_model->nameweb() ?> V.2</p>
          </div>
        </div>
      </section>

    </div>
  </div>

</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  function enter_login(event) {
    if (event.keyCode === 13) {
      login();
    }

  }

  function login() {
    var username = $('#username').val();
    var password = $('#password').val();
    var safecode = $('#safecode').val();
    $.ajax({
        url: '<?= base_url() ?>backend/home/login',
        type: 'POST',
        dataType: 'json',
        data: {
          username: username,
          password: password,
          safecode: safecode
        },
      })
      .done(function(res) {
        if (res.code == 1) {
          // alert(res.msg);
          swal("Success!", res.msg, "success");
          setTimeout(function() {
            location.reload();
          }, 2000);
        } else if (res.code == 3) {
          // two factor
          swal({
              text: 'กรุณากรอกรหัสชั้นที่ 2',
              content: "input",
              button: {
                text: "เข้าสู่ระบบ",
                closeModal: false,
              },
            })
            .then(pin => {
              if (!pin) throw null;
              $.ajax({
                  url: '<?= base_url() ?>backend/home/login',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    username: username,
                    password: password,
                    safecode: safecode,
                    pin: pin
                  },
                })
                .done(function(res) {
                  if (res.code == 1) {

                    swal("Success!", res.msg, "success");
                    setTimeout(function() {
                      location.reload();
                    }, 2000);
                  } else {
                    swal("Warning!", res.msg, "warning");

                  }
                })
                .fail(function() {
                  console.log("error");
                });

            })
            .catch(err => {
              if (err) {
                swal("Oh!", "The AJAX request failed!", "error");
              } else {
                swal.stopLoading();
                swal.close();
              }
            });
          // =======
        } else {
          swal("Warning!", res.msg, "warning");
          // alert(res.msg);
        }
      })
      .fail(function() {
        console.log("error");
      });

  }

  function OC_edp_p() {

    var j = document.getElementById("password");
    if (j.type === "password") {
      j.type = "text";
    } else {
      j.type = "password";
    }
  }
</script>
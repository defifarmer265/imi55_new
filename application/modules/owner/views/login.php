<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>♥ Owner
<?=$this->getapi_model->nameweb()?>
♥ </title>

<!-- Bootstrap -->

<link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="<?php echo base_url()?>public/tem_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="<?php echo base_url()?>public/tem_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- Animate.css -->
<link href="<?php echo base_url()?>public/tem_admin/vendors/animate.css/animate.min.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="<?php echo base_url()?>public/tem_admin/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div> <a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor" id="signin"></a>
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form >
          <h1>Owner
            <?=$this->getapi_model->nameweb()?>
          </h1>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <input type="text"  class="form-control has-feedback-left" type="text" id="username" name="username" value="" placeholder="Username">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <input type="password" class="form-control has-feedback-left" id="password" onKeyUp="enter_login(event)"  placeholder="Password">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span> <span class="fa fa-eye form-control-feedback right" aria-hidden="true" onClick="OC_edp_p()"></span> </div>
        </form>
        <div>
          <button  class="btn btn-round btn-warning" onClick="login()">Log in</button>
        </div>
      </section>
    </div>
  </div>
</div>
</body>
</html>
<script src="<?php echo base_url()?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()?>public/tem_admin/swal/sweetalert.min.js"></script>
<script>
function OC_edp_p()
	{
		var x = document.getElementById("password");

		if (x.type === "password") {
			x.type = "text";
		  } else {
			x.type = "password";
		  }
	}
function enter_login(event)
	{
		if (event.keyCode === 13) {
			login();
		}
	
	}
function login()
	{
		var username = $('#username').val();
		var password = $('#password').val();
		$.ajax({
			url: '<?=base_url()?>owner/login_check',
			type: 'POST',
			dataType: 'json',
			data: {
				username: username,password:password
			},
		})
		.done(function(res) {
console.log(res);
			if (res.code == 1) {
          // alert(res.msg);
          swal("Success!", res.msg, "success");
          setTimeout(function() {
            window.location.href = "<?=base_url()?>owner/home/dashboard";
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
                  url: '<?=base_url()?>owner/login_check',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    username: username,
                    password: password,
                    pin: pin
                  },
                })
                .done(function(res) {
                  if (res.code == 1) {

                    swal("Success!", res.msg, "success");
                    setTimeout(function() {
						window.location.href = "<?=base_url()?>owner/home/dashboard";
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
			
		});
		
	}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>♥ Sale
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
          <h1>SALE
            <?=$this->getapi_model->nameweb()?>
          </h1>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <input type="text"  class="form-control has-feedback-left" type="text" id="username" name="username" value="" placeholder="Username" autofocus>
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
		var safecode = $('#safecode').val();
		$.ajax({
			url: '<?=base_url()?>sale/login_check',
			type: 'POST',
			dataType: 'json',
			data: {
				username: username,password:password,safecode:safecode
			},
		})
		.done(function(res) {
			if (res.code == 1) {
				swal(res.title,res.msg,'success');
				setTimeout(function() {
					window.location.href = "<?=base_url()?>sale/home/dashboard";
				}, 1000);
				
			} else if(res.code == 2) {
				swal({
					title: res.title,
					text: res.msg,
					icon: "error",
					button: "OK",
				})
					.then((willDelete) => {
					if (willDelete) {
						
						$('#password').focus();
					} else {
						location.reload();
					}
				});

			} else {
				swal(res.title,res.msg,'error').then((result) => { 
					location.reload();
				})
				
			}
		});
		
	}
</script>
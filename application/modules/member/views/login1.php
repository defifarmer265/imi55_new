<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>♥ WE ARE IMI55 ♥  </title>

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

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form role="form" method="POST" action="<?php echo base_url('users/login1'); ?>" >
              	<h1>Login Form IMI55</h1>
	            <?php
					if($this->session->flashdata('message'))
					{
						echo '
						<div class="alert alert-danger">
							'.$this->session->flashdata("message").'
						</div>
						';
					}
				?>
              	<div>
                	<input type="text" class="form-control" type="text" id="username" name="username" value="" placeholder="Username">
              	</div>
              	<div>
	                <input type="password" class="form-control"  id="password" name="password" value="" placeholder="Password">
	              	<span class="text-danger"><?php echo form_error('password'); ?></span>
          		</div>
              	<div>
              		<button  class="btn btn-round btn-warning">Log in</button>
              	</div>
              	<div class="clearfix"></div>
              	<div class="separator">
              		<div class="clearfix"></div>
                	<br />
	                <div>
	                  <h1><i class="fa fa-paw"></i>IMI55</h1>
	                  <p>©2020 All IMI55 V.2</p>
	                </div>
	            </div>
            </form>
          </section>
        </div>
    </div>
</div>

</body>
</html>












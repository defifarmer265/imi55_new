<!DOCTYPE html>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?=$this->getapi_model->nameweb()?> Sale ! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>public/tem_admin/build/css/custom.min.css" rel="stylesheet">
	

	  

  </head>
<style>

#cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255,255,255,0.7);
    z-index: 9999;
    display: none;
}
@-webkit-keyframes spin {
from {
-webkit-transform:rotate(0deg);
}
to {
-webkit-transform:rotate(360deg);
}
}
@keyframes spin {
from {
transform:rotate(0deg);
}
to {
transform:rotate(360deg);
}
}
#cover-spin::after {
    content: '';
    display: block;
    position: absolute;
    left: 48%;
    top: 40%;
    width: 40px;
    height: 40px;
    border-style: solid;
    border-color: black;
    border-top-color: transparent;
    border-width: 4px;
    border-radius: 50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}
</style>
	 
	<div id="cover-spin"></div>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span><?=$this->getapi_model->nameweb()?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url()?>public/tem_frontend/img/logo.png" alt="<?=$this->getapi_model->nameweb()?>" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>SALE</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <!--================Header Menu Area =================-->
            <?php $this->load->view('themes/tem_sale/header_sale'); ?>
            <!--================Header Menu Area =================-->

            <!-- content -->
            <?php $this->load->view('themes/tem_sale/content_sale'); ?>
            <!-- end content -->

            <!-- start footer Area -->
            <?php $this->load->view('themes/tem_sale/footer_sale'); ?>
            <!-- End footer Area -->

        <!-- /footer content -->
      </div>
    </div>
    </div>
    </div>

		  <!-- jQuery -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
	<!-- Sweetalert  -->
    <script src="<?php echo base_url()?>public/tem_admin/swal/sweetalert.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!--Custom-->
	<script src="<?php echo base_url()?>public/tem_admin/build/js/custom.min.js"></script>

	<!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>




    
    
  </body>
</html>

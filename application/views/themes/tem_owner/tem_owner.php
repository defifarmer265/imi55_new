<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" href="images/favicon.ico" type="image/ico" /> -->
    <title> <?= $this->getapi_model->nameweb() ?> </title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
   

    <!-- JQVMap -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-daterangepicker/daterangepicker.css"
        rel="stylesheet">

     <!-- Custom Theme Style -->
     <link href="<?php echo base_url()?>public/tem_admin/build/css/owner.min.css" rel="stylesheet">

      <!-- iCheck -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"
        rel="stylesheet">
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"
        rel="stylesheet">
    <link href="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
        rel="stylesheet">
    <link
        href="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
        rel="stylesheet">
    <link
        href="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
        rel="stylesheet">
    <link
        href="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
        rel="stylesheet">

    <!-- Switchery -->
    <link rel="stylesheet" href="<?php echo base_url()?>public/tem_admin/vendors/switchery/dist/switchery.min.css">
<style>
      #cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    display: none;
  }

  @-webkit-keyframes spin {
    from {
      -webkit-transform: rotate(0deg);
    }

    to {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
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
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- include header -->
            <?php $this->load->view('themes/tem_owner/header_owner'); ?>
            <!-- page content -->

            <div class="right_col" role="main">
                <div class="clearfix"></div>
                <?php $this->load->view('themes/tem_owner/content_owner');?>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view('themes/tem_owner/footer_owner'); ?>
        <!-- /footer content -->
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="<?php echo base_url()?>public/tem_admin/vendors/bootoast.min.css" rel="stylesheet">
    <script src="<?php echo base_url()?>public/tem_admin/vendors/bootoast.min.js"></script>
    <audio src="<?php echo base_url()?>public/mp3/deposit.mp3" id="audio_dep" preload="auto"></audio>
    <audio src="<?php echo base_url()?>public/mp3/withdraw.mp3" id="audio_wit" preload="auto"></audio>
    <!-- jQuery -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js">
    </script>
    <!-- FastClick -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <!-- iCheck -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/flot-spline/js/jquery.flot.spline.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js">
    </script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!--  switchery -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url()?>public/tem_admin/build/js/custom.min.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/build/js/loading-bar.js"></script>




    <!-- Datatables -->
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-buttons/js/buttons.flash.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-buttons/js/buttons.html5.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-buttons/js/buttons.print.min.js">
    </script>
    <script
        src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js">
    </script>
    <script
        src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script
        src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js">
    </script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url()?>public/tem_admin/swal/sweetalert.min.js"></script>
</body>

</html>
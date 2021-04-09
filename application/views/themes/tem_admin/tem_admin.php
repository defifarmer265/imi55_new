<!DOCTYPE html>

<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title><?= $this->getapi_model->nameweb() ?> Backend ! | </title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?php echo base_url() ?>public/tem_admin/build/css/custom.min.css" rel="stylesheet">
  <!-- Datatables -->

  <link href="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">


  <!-- Bootstrap -->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <!-- Datatables -->

  <link href="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">



</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url() ?>backend" class="site_title"><i class="fa fa-paw"></i> <span><?= $this->getapi_model->nameweb() ?></span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo base_url() ?>public/tem_frontend/img/logo.png" alt="<?= $this->getapi_model->nameweb() ?>" class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>ADMIN</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <!--================Header Menu Area =================-->
          <?php $this->load->view('themes/tem_admin/header_admin'); ?>
          <!--================Header Menu Area =================-->

          <!-- content -->
          <?php $this->load->view('themes/tem_admin/content_admin'); ?>
          <!-- end content -->

          <!-- start footer Area -->
          <?php $this->load->view('themes/tem_admin/footer_admin'); ?>
          <!-- End footer Area -->

          <!-- /footer content -->
        </div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <link href="<?php echo base_url() ?>public/tem_admin/vendors/bootoast.min.css" rel="stylesheet">
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/bootoast.min.js"></script>
      <audio src="<?php echo base_url() ?>public/mp3/deposit.mp3" id="audio_dep" preload="auto"></audio>
      <audio src="<?php echo base_url() ?>public/mp3/withdraw.mp3" id="audio_wit" preload="auto"></audio>
      <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $lastUriSegment = array_pop($uriSegments);
      ?>
      <script type="text/javascript">
        $(document).ready(function() {
          notification(1, 1);
          $('#dataTall').DataTable({
            // "searching": false,
            // "paging":   false,
            // "info":     false
          });
          if ('<?= $lastUriSegment ?>' != 'profile_admin') {
            $.ajax({
                method: "POST",
                url: "CheckOpenTwofac",
                dataType: 'json'
              })
              .done(function(res) {
                switch (res.code) {
                  case -1:
                    swal(res.msg, {}).then(() => {
                      window.location.href = 'profile_admin';
                    });

                    break;
                  case 0:
                    swal(res.msg, {
                      dangerMode: true,
                      buttons: true,
                    }).then((result) => {
                      if (result) window.location.href = 'profile_admin';

                    });
                    break;
                  case 1:

                    break;

                  default:
                    break;
                }
              });
          }





        });

        function notification(count_dep, count_wit) {
          setInterval(function() {
            $.ajax({
              url: '<?php echo base_url() ?>/backend/admin/notification',
              type: 'POST',
              dataType: 'json',
            }).done(function(res) {
              if (res.code == 1) {

                if (res.dp_count >= 1) {
                  $('#alert_dep').show();
                  $('#alert_dep').html(res.dp_count);
                  if (count_dep == 3) {
                    document.getElementById('audio_dep').pause();
                  } else {
                    document.getElementById('audio_dep').play();
                    return count_dep++;
                  }

                } else {
                  $('#alert_dep').hide();
                  count_dep = 0;
                }
                if (res.wd_count >= 1) {
                  $('#alert_wit').show();
                  $('#alert_wit').html(res.wd_count);

                  if (count_wit == 3) {
                    document.getElementById('audio_wit').pause();
                  } else {
                    document.getElementById('audio_wit').play();
                    return count_wit++;
                  }
                } else {
                  $('#alert_wit').hide();
                  count_wit = 0;
                }

                if (res.tw_count >= 1) {
                  $('#alert_tw').show();
                  $('#alert_tw').html(res.tw_count);
                } else {
                  $('#alert_tw').hide();

                }

                if (res.exchange_count >= 1) {
                  $('#alert_exchange').show();
                  $('#alert_exchange').html(res.exchange_count);

                } else {
                  $('#alert_exchange').hide();

                }

                if (res.af_count >= 1) {
                  $('#alert_aff').show();
                  $('#alert_aff').html(res.af_count);
                  $('#alert_aff1').show();
                  $('#alert_aff1').html(res.af_count);


                } else {
                  $('#alert_aff').hide();

                }

                return count_wit;
                return count_dep;
              } else {
                $('#alert_exchange').hide();
                $('#alert_aff').hide();
                $('#alert_aff1').hide();
                $('#alert_dep').hide();
                $('#alert_dep').hide();
                return count_dep = 0;
                return count_wit = 0;

              }

            })
            get_notify();
          }, 6000);

        }

        function get_notify() {
          $.ajax({
              url: '<?php echo base_url() ?>backend/admin/notify_deposit_auto/',
              type: 'POST',
              dataType: 'json',

            })
            .done(function(res) {

              if (res.code == 1 && res.data.length > 0) {
                $.each(res.data, function(index, val) {
                  const txt = "<b style='color:#000'>" + val.msg + "</b>";
                  bootoast.toast({
                    message: txt,
                    type: 'info',
                    position: 'right-top',
                  });
                  setTimeout(function() {
                    $.ajax({
                      url: '<?php echo base_url() ?>backend/admin/update_notify/',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                        id: val.id
                      }

                    })
                  }, 2000);
                });
              } else {

              }
            })
            .fail(function() {
              console.log("error");
            })
        }
      </script>


      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <!-- jQuery -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/swal/sweetalert.min.js"></script>
      <!-- Bootstrap -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/nprogress/nprogress.js"></script>
      <!-- Chart.js -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/Chart.js/dist/Chart.min.js"></script>
      <!-- gauge.js -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/gauge.js/dist/gauge.min.js"></script>
      <!-- bootstrap-progressbar -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- iCheck -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/iCheck/icheck.min.js"></script>
      <!-- Skycons -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/skycons/skycons.js"></script>
      <!-- Flot -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/Flot/jquery.flot.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/Flot/jquery.flot.pie.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/Flot/jquery.flot.time.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/Flot/jquery.flot.stack.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/Flot/jquery.flot.resize.js"></script>
      <!-- Flot plugins -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/flot.curvedlines/curvedLines.js"></script>
      <!-- DateJS -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/DateJS/build/date.js"></script>
      <!-- JQVMap -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
      <!-- bootstrap-daterangepicker -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/moment/min/moment.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

      <!-- Custom Theme Scripts -->
      <?php if ($this->uri->segment(2) == '') { ?>
        <script src="<?php echo base_url() ?>public/tem_admin/build/js/custom.min2.js"></script>
      <?php } else { ?>
        <script src="<?php echo base_url() ?>public/tem_admin/build/js/custom.min.js"></script>
      <?php } ?>

      <!-- Datatables -->
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/jszip/dist/jszip.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/pdfmake/build/pdfmake.min.js"></script>
      <script src="<?php echo base_url() ?>public/tem_admin/vendors/pdfmake/build/vfs_fonts.js"></script>





</body>

</html>
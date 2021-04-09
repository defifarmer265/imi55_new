<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<style>

</style>

<!-- CONTACT-->
<header class="masthead   text-white text-center" style="padding-top: calc(6rem - 10px) !important; height: 90%;" id="tap_contact">

  <div class="container">
    <div class="row" style="padding: 20px; height:1000px;">
      <div class="col-12">
        <label class="text-left">โปรโมชั่น</label><br>
        <br>
        <div class="container">
          <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm-8">
              <img src="<?= base_url() ?>public/promotion/<?php echo $link_img; ?>" width="100%">
            </div>
            <div class="col-sm"></div>
          </div>
          <br>
          <div class="row">
            <div class="col border border-white" style="padding-bottom: 10px;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $name; ?></h5>
              </div>
              <div class="card-body text-left">
                <?php if ($percent != '0') { ?>
                  <p class="card-text"> โบนัส
                    <?php echo $percent; ?> % ของเครดิต &nbsp;สูงสุดถึง <?php echo $amount_max; ?> เครดิต
                  </p>
                <?php } ?>
                <?php if ($bonus != '0') { ?>
                  <p class="card-text"> โบนัส
                    <?php echo $bonus; ?> เครดิต
                  </p>
                <?php } ?>
                <p class="card-text"> ตั้งแต่วันที่ <?php echo date("d/m/Y", $time_start); ?> ถึง <?php echo date("d/m/Y", $time_end); ?></p>
                <p class="card-text">
                  <u>เงื่อนไขโปรโมชั่น</u> :
                  <ul>
                    <li>เครดิตขั้นต่ำ <?php echo $min_creadit; ?> เครดิต</li>
                    <li>ติดเทิร์น <?php echo $sum_turn; ?> เท่าของเครดิต</li>
                   
                  </ul>
                </p>
                <p class="card-text">
                  <u>รายละเอียด</u> &nbsp; <?php echo $detail_pro; ?>
                </p>
              </div>
              <div class="card-body">
                <?php if ($check_have_pro == '' ||  $check_have_pro == null ||  $check_have_pro == 0) { ?>
                  <button type="button" class="btn btn-outline-light" onclick="buy(<?= $id; ?>)">กดซื้อ</button>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<script src="<?php echo base_url() ?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

  function buy(id) {
    swal({
      text: 'ต้องการทำรายการหรือไม่ ?',
      buttons: ["ยกเลิก", "ยืนยัน"],
    }).then((accept) => {
      if (accept) {
        $.ajax({
          url: '<?php echo base_url() ?>users/promotion/select_pro',
          type: 'POST',
          dataType: 'json',
          data: {
            id: id
          },
        }).done(function(res) {
          console.log(res);
          if (res.code == 1) {
            swal({
              text: res.msg,
              icon: "success",
              buttons: false,
            });
            setTimeout(function() {
              window.location.href = '<?php echo base_url() ?>users/member';
            }, 1500);

          } else {
            swal({
              text: res.msg,
              icon: "error",
              buttons: false,
            });
          }
        });
      }

    });



  }
</script>
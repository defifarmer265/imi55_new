<div class="">
	<div class="row">
		<button class="btn btn-outline-info" onClick="sel_dashboard()"><i class="fa fa-refresh"><small> ดึงรายการล่าสุด <?=date('H:i:s',$datetime)?></small></i></button>
	</div>
  <div class="row" style="display: inline-block;width: 100%">
    <div class="top_tiles" >
      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-user"></i></div>
          <div class="count">
            <?=$us_day?>
          </div>
          <h3>To Day</h3>
          <p> ยูเซอร์สมัครวันนี้ ตัด00:00น.</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-money"></i></div>
          <div class="count">
            <?=$us_dps_day?>
          </div>
          <h3>To Day</h3>
          <p> ยูเซอร์ที่สมัครและฝากวันนี้</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-users"></i></div>
          <div class="count">
            <?=$us_month?>
          </div>
          <h3> To month </h3>
          <p> ยูเซอร์สมัครเดือนนี้ </p>
        </div>
      </div>
      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 ">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-money"></i></div>
          <div class="count">
            <?=$us_dps_month?>
          </div>
          <h3> To month </h3>
          <p> ยูเซอร์ที่สมัครและฝากเดือนนี้</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 ">
        <div class="tile-stats">
          <div class="icon text-success" ><i class="fa fa-users"></i></div>
          <div class="count">
            <?=$us_all?>
          </div>
          <h3> All User </h3>
          <p> ยูเซอร์ทั้งหมด</p>
        </div>
      </div>
		<div class="animated flipInY col-lg-2 col-md-3 col-sm-6 ">
        <div class="tile-stats">
          <div class="icon text-success" ><i class="fa fa-bank"></i></div>
          <div class="count">
            <?=$us_dps_300?>
          </div>
          <h3> ฝาก 300+ </h3>
          <p> รายการฝากตั้งแต่ 300ขึ้นไป</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ลูกค้าสมัครใหม่</h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled top_profiles scroll-view">
          <?php
          if ( $us_last5 != '' ) {
            foreach ( $us_last5 as $ul ) {
              ?>
          <li class="media event"> <a class="pull-left border-aero profile_thumb"> <i class="fa fa-user aero text-info"></i> </a>
            <div class="media-body"> <a class="title" href="#">
              <?=$ul->user?>
              </a>
              <p><strong>
                <?=$ul->username?>
                </strong> </p>
              <p> <small>
                <?=date('d-m-y H:i:s',$ul->create_time)?>
                </small> </p>
            </div>
          </li>
          <?php }} ?>
        </ul>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการฝากใหม่</h2>
          <div class="clearfix"></div>
        </div>
        <ul class="list-unstyled top_profiles scroll-view">
          <?php
          if ( $dps_last5 != '' ) {
            foreach ( $dps_last5 as $dpsl ) {
              ?>
          <li class="media event"> <a class="pull-left border-0 profile_thumb"> <i class="fa fa-money aero  text-success"></i> </a>
            <div class="media-body"> <a class="title" href="#">
              <?=$dpsl->user?>
              </a>
              <p><strong style="font-size: 11px;" class="badge badge-dark">
                <?=number_format($dpsl->deposit,2)?>
                </strong> (
                <?=$dpsl->username?>
                )</p>
              <p> <small>
                <?=date('d-m-y H:i:s',$dpsl->datetime)?>
                </small> </p>
            </div>
          </li>
          <?php
          }
          }
          ?>
        </ul>
      </div>
    </div>
	
  </div>
</div>

<script>
	function sel_dashboard(){
		$('#cover-spin').show();
		swal({
				title: "คุณต้องอัพเดทขอมูลล่าสุด",
				text: "การอัพเดทข้อมูลอาจล่าช้า กรุณารอสักครู่ค่ะ",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})

			.then((willDelete) => {
				if (willDelete) {
					location.href = "<?=base_url()?>sale/home/sel_dashboard";
				
				}else{
					swal('ยกเลิก','','error');
					$('#cover-spin').hide();
				}
			
		})
	}

</script>
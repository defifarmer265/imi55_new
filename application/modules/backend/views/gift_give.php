<style>
    #border1 {
        border: 1px solid gray;
    }
</style>

<div class="right_col" role="main">
    <div>
        <div class="page-title">
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Gift Voucher</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="col-md-12 col-sm-12  ">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>User<small>กรุณากรอกยูเซอร์เต็ม</small></h2>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <div class="col-md-12">
                                                        <textarea id="textuser" class="form-control" rows="10" placeholder="ใส่ user ที่ต้องการเลือก"></textarea>
                                                        <label style="color:red;">*กรุณาใส่ข้อมูลบรรทัดละยูสเซอร์ โดยห้ามเว้นบรรทัดหรือมีบรรทัดว่างอยู่</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="col-md-12 col-sm-12  ">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Gift Voucher<small>รายละเอียดกิ๊ฟที่สามารถใช้งานได้</small></h2>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <div class="col-md-6">
                                                        <ul class="to_do">
                                                            <?php foreach ($gift as $gf) { ?>
                                                                <li class="radio">
                                                                    <label>

                                                                        <h4><input type="radio" class="flat" name="voucher" value="<?= $gf['id']; ?>"> <?= $gf['gift_name']; ?> </h4>
                                                                        <p style="padding-left: 25px;">
                                                                            <?= $gf['credit'] != 0 ? 'เครดิต : ' . $gf['credit'] : 'แต้ม : ' . $gf['point']; ?> <br>
                                                                            Start :<?= date('d/m/y', $gf['time_start']); ?> เวลา :<?= date('H:i', $gf['time_start']); ?><br>
                                                                            End :<?= date('d/m/y', $gf['time_end']); ?> เวลา :<?= date('H:i', $gf['time_end']); ?>
                                                                        </p>
                                                                    </label>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-8"></div>
                                    <div class="col col-md-2">
                                        <div class="checkbox" style="font-size: 14px;">
                                            <label>
                                                <input id="addauto" type="checkbox" value="1" name=""> แอดเครดิต+เทิร์น ทันที
                                            </label>
                                        </div>
                                        <span id="span_addcreditauto1" style="font-size: 11px;color: green; ;">ลูกค้าต้องกดรับ</span>
                                        <span id="span_addcreditauto2" style="font-size: 11px;color: red; display: none;">เครดิตและยอดเทิร์นโอเวอร์ที่ตั้งค่าไว้จะเข้าอัตโนมัติโดยไม่ต้องกดรับ</span>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" onclick="save()" class="btn btn-success">Save</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<script>
    $("#addauto").on('change', function() {
        if ($(this).is(':checked')) {
            $('#span_addcreditauto2').show();
            $('#span_addcreditauto1').hide();
        } else {
            $('#span_addcreditauto1').show();
            $('#span_addcreditauto2').hide();
        }

    });

    function save(dt) {
        var check_id = $('input[name=voucher]:checked').val();
        var addauto = $('#addauto').is(":checked") ? "1" : "0";
        swal({
            title: 'ยืนยันรายการหรือไม่?',
            buttons: true,
        }).then((result) => {

            if (result) {
                var textuser = $('#textuser').val();
                var user = textuser.split('\n');
                $.ajax({
                    url: '<?php echo base_url('backend/gift/give_user'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user: user,
                        check_id: check_id,
                        addauto: addauto,
                    }
                }).done(function(res) {
                    if (res.code == 1) {

                        swal('', 'ทำรายการสำเร็จ', 'success').then((value) => {
                            setTimeout(function() {
                                window.location.href = '<?php echo base_url('backend/gift/gift_give'); ?>';
                            }, 500);
                        });
                    } else {
                        swal('', res.msg, 'error');
                    }
                });
            }




        })




    }
</script>
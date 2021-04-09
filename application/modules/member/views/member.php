






    <!-- Page Loader -->
    <div class="loader_wrapper inner align-items-center text-center" style="background-color: #000;">
        <div class="load7 load-wrapper" style="background-color: #2567fd;">
            <h4 class="mb-0" style="margin-top: 100px;">กรุณารอสักครู่</h4>
            <div class="loader" style="margin-top: 10px;">Loading...</div>
            <img align="center" src="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" style="width: 200px;" />
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Page Loader Ends -->

    <div class="d-flex justify-content-center mt-0 mt-md-3 pb-5" >
        <div class="container col-16" style="padding-right: 2px;">
            <div class="row d-flex flex-column justify-content-center align-items-center">
                <div class="section-1 col-16 col-md-10 col-lg-8 pb-2" style="box-shadow: 1px 4px 3px 0px rgb(239 255 0 / 30%);">
                    <div class="container d-flex flex-column justify-content-center align-items-start mt-3">
                        <div class="col-16 px-0">
                            <div class="row">
                                <div class="col-10">
                                    <div class="d-flex">
                                        <div class="flex-column d-flex" style="color: #fff;">
                                            <b style="padding-bottom: 5px; color: #ccff00;">ยินดีต้อนรับ</b>
                                            <b><?= $this->session->member->user ?></b>
                                            <b style="font-size: 1em; color: #ccff00;">ธนาคาร</b>
                                            <b style="display: block;">
                                                <?php if ($bankUser == '') { ?>
                                                <a href="#" onClick="createBank()" title="Add Bank User" style="font-size: 12px;">
                                                    <li class="fa fa-university"></li>
                                                    คลิก!! เพิ่มธนาคาร
                                                </a>
                                                <?php } else {  echo $bankUser; } ?>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group" style="text-align: center; color: #fff;">
                                        <img src="<?= base_url('public/rank/'.$rank) ?>" class="imirank imii" style="width: 35%;" /><br />
                                        <b>
                                            <?=$trunover;?>
                                            <br />
                                            Ranking  <i class="fa fa-info-circle" aria-hidden="true" data-toggle="modal" data-target="#showrank" style="cursor: pointer;"></i>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-1 col-16 px-0" style="border-top: 1px solid #696969;" />
                        <div class="clearfix"></div>

                        <div class="d-flex flex-column">
                            <h2 class="text-gray mb-0" style="fant-size:2em;">
                                ยอดเครดิต
                                <span style="font-weight: 300; font-size: 12px; text-align: center; letter-spacing: 2px; margin-top: -25; cursor: pointer;">
                                    <li style="font-size: 10px;" class="fa fa-refresh" onClick="location.reload()"></li>
                                    <?=date('H:i:s');?>
                                </span>
                                <br />
                            </h2>

                            <h1 class="text-white font-weight-bold line-height-0-7 mb-0" style="font-size: 2em;">
                                <span class="text-balance"><?=$credit?></span> บาท
                            </h1>
                        </div>
                        <hr class="my-1 col-16 px-0" style="border-top: 1px solid #696969;" />
                        <div class="section-2 col-16 px-0 py-3 d-flex flex-column justify-content-center align-items-center">
                            <div class="col-16 px-0 d-flex">
                                <a href="member/deposit" class="col-8 pl-0 btn-deposit">
                                    <button class="col text-white btn btn-success font-weight-bold font-1-5 box-shadow-unset playnow"><b style="font-size: 1em;color: #000">ฝากเงิน</b></button>
                                </a>
                                <a href="<?= base_url() ?>users/member/withdraw" class="col-8 pr-0 btn-withdraw">
                                    <button class="col text-white btn btn-danger font-weight-bold font-1-5 box-shadow-unset playnow"><b style="font-size: 1em;color: #ccff00">ถอนเงิน</b></button>
                                </a>
                            </div>
                            <div class="col-16 px-0 d-flex">
                                <a onClick="genlink('<?= $this->session->member->username ?>')"  class="btn btn-treasure-link col">
                                    <b style="font-size: 1.5em;color: #ccff00">ลิงค์รับทรัพย์</b>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="section-3 col-16 col-md-16 col-lg-16 d-flex justify-content-start align-items-center pb-4 pt-3 flex-wrap mb-2">
                        <a onclick="sendtogame();"  class="col-4 mb-2">
                             <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/imiwin.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">เมนูเกมส์</label>
                            </div>
                        </a>
                        <a href="member/deposit" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/deposit.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">ฝากเงิน</label>
                            </div>
                        </a>
                        <a href="<?= base_url() ?>users/member/withdraw" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/withdraw.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">ถอนเงิน</label>
                            </div>
                        </a>
                        <a href="member/report_state" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/report_money.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">ข้อมูล</label>
                            </div>
                        </a>
                        <a href="games/spin" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/slot.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">กิจกรรม</label>
                            </div>
                        </a>
                        <a href="games/point" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/point.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">คะแนน</label>
                            </div>
                        </a>
                        <a href="checkin/index" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/checkin.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">เช็คอิน</label>
                            </div>
                        </a>
                        <div class="col-4 mb-2 btn-logout">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder" onclick="chech_promotion('<?= $this->session->userdata['member']->id; ?>')" style="cursor:pointer">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/promotion-icon.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">โปรโมชั่น</label>
                            </div>
                        </div>
                        <a href="announce/announce" id="linkAdd" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/aleat.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">ประกาศ</label>
                            </div>
                        </a>
                        <a onClick="genlink('<?= $this->session->member->username ?>')" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/link.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">แนะนำเพื่อน</label>
                            </div>
                        </a>
                        <a href="network/network" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                    <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/network.png" class="img-memu" />
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">เครือข่าย</label>
                            </div>
                        </a>
                        <a href="<?= base_url() ?>users/gift/gift_voucher" class="col-4 mb-2">
                            <div class="col-16 d-flex align-items-center flex-column px-0">
                                <div class="menu-placeholder">
                                <?php if($giftvoucher == 1){?>
                                   <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/giftvoucher2.png" class="img-memu" />
                                <?php }else{?>
                                     <img src="<?= $this->config->item('tem_frontend'); ?>img/mapraw_icon/giftvoucher1.png" class="img-memu" />
                                <?php }?>          
                                </div>
                                <label class="text-white mb-0 line-height-0-9 mb-1">รับรางวัล</label>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-5 pb-5"></div>

<!-- get maintenance modal -->
<div class="modal fade" id="maintenance">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-dismiss="modal"><i class="fa fa-remove"></i></a>
            </div>
            <div class="modal-body">
                <input type="hidden" value="<?= $maintenance->status ?>" id="maint_status">
                <input type="hidden" value="<?= $this->session->maintenance ?>" id="maint_sess">
                <a href="line://ti/p/@638rsqhd">
                    <img src="<?= $this->config->item('tem_frontend_img') . 'maintenance/' . $maintenance->name ?>" width="100%" alt="<?= $this->getapi_model->nameweb() ?>" />
                </a>

            </div>
            <div class="modal-footer">
                <label>
                    <input type="checkbox" class="checkbox" value="1" id="close_maintenance">
                    ไม่แสดงอีก</label>
            </div>
        </div>
    </div>
</div>
    <!-- get link modal -->
<div class="modal fade" id="getLink" tabindex="-1" role="dialog" aria-labelledby="getLinkLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff; ">
            <div class="modal-header">
                <h5 class="modal-title" id="getLinkLabel" style="color:#F24646;">ลิ้งค์การสมัคร</h5>
                <!--  -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="clear_qrcode()" style="color:#F24646;">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <input type="text" id="span_getLink" class="form-control" style="color: #000; "><br>
                <p id="text-copy" class="text-right text-success"></p><br>
                <input type="hidden" id="sale_id" value=""><br>
                <div id="demoqr" style=" display: flex;justify-content: center;align-items: center;"></div>


            </div>
            <div class="modal-footer">
                <p class="text-success"></p>
                <button type="button" class="btn btn-info float-right" onClick="copyLink()" data-toggle="popover" data-content="copy">Copy Link</button>
                <button type="button" class="btn btn-info float-right" onClick="clear_qrcode()" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- end get link modal-->


<!-- Modal =============== show ranking =========== -->

<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}
.ranking{
    width: 50px;
}tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:nth-child(even){background-color: #f2f2f200}
</style>
<div class="modal fade" id="showrank" tabindex="-1" role="dialog" aria-labelledby="showrankTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-image: url(<?=$this->config->item('tem_frontend'); ?>img/bg-main.png);">
      <div class="modal-header">
        <h5 class="modal-title" id="showrankLongTitle" style="color:#fff;">ตารางชั้นยศ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style=" color: #00ffffa6; font-size: xxx-large;">&times;</span>
        </button>
      </div>
      <div class="modal-body">


<div style="overflow-x:auto;">
  <table style="color: #fff;">
    <tr>
      <th>ยศ</th>
      <th>เทิร์นรวม</th>
      <th>คูณพ้อย</th>
      <th>คูณสปิน</th>
      <th>ลดราคาของรางวัล%</th>
      <th>ของรางวัลพรีเมียม</th>
      <th>ของรางวัลพิเศษ</th>
      <th>สัญลักษณ์</th>
    </tr>
    <?php foreach ($datarank as $key => $value) {  ?>
                        <tr align="center" >
                          <td><?= strtoupper($value['name']); ?></td>
                          <td><?= $value['trunover']; ?></td>
                          <td><?= $value['point']; ?></td>
                          <td><?= $value['spin']; ?></td>
                          <td><?= $value['sale']; ?></td>
                          <td><?= $value['reward_premium']; ?></td>
                          <td><?= $value['reward_exclusive']; ?></td>
                          <td><img class="ranking" src="<?= base_url('public/rank/' . $value['img_link']); ?>" ></td>
                        </tr>
                      <?php  }   ?>

  </table>
</div>


      </div>
    </div>
  </div>
</div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://app.123dic.link/assets/adminux/js/jquery-2.1.1.min.js"></script>


    <script type="text/javascript">
        $(document).on("ready", function () {
            var form_exit = $("#form-exit");
            var modal_exit = $("#modal-exit");

            $("body > div > div.container").css({ "margin-top": $("header").height() + "px" });

            $(".loader_wrapper").fadeOut(1500);

            $(".menu-collape").on("click", function () {
                $("body").toggleClass("menuclose-right");
            });

            $(".btn-logout").on("click", function () {
                modal_exit.modal("show");
            });



            $("a.open-games-home").on("click", function () {
                $(".loader_wrapper").show();

                

                $(".loader_wrapper").fadeOut(10000);
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/tem_admin/swal/sweetalert.min.js"></script>
<script src="<?php echo base_url() ?>public/tem_frontend/js/qrcode.min.js"></script>


<script>
    var maint_status = $('#maint_status').val();
    var maint_sess = $('#maint_sess').val();
    if (maint_status == 1) {
        if (maint_sess != 1) {
            $(window).on('load', function() {
                $('#maintenance').modal('show');


            });
        }
    }
    $(document).ready(function() {
        //set initial state.
        $('#close_maintenance').val(this.checked);

        $('#close_maintenance').change(function() {
            if (this.checked) {
                var returnVal = confirm("ต้องการปิดประกาศ !!");
                $.ajax({
                    url: 'member/close_maintenance',
                    type: 'POST',
                    dataType: 'json',
                });

            }
            $('#textbox1').val(this.checked);
        });
    });


    function chech_promotion(id) {
        $.ajax({
            url: '<?= base_url() ?>users/promotion/check_promotion',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
        }).done(function(res) {
            if (res.code == 1) {
                window.location.href = '<?= base_url() ?>users/promotion/detail/' + res.promotion + ''
            } else {
                window.location.href = '<?= base_url() ?>users/promotion/index'
            }
        });

    }

    function createBank() {
        //      alert(5555)
        $('#m_bankUser').modal();
    }

    function createBankUser() {
        var account = $('#account').val();
        var bank_id = $('#bank_id').val();
        $.ajax({
                url: 'member/createbankUser',
                type: 'POST',
                dataType: 'json',
                data: {
                    account: account,
                    bank_id: bank_id
                },
            })
            .done(function(res) {
                // success
                if (res.code == 1) {
                    swal(res.title, res.msg, "success")
                        .then(function(sw) {
                            $('#cover-spin').show();
                            setTimeout(function() {
                                $('#cover-spin').hide();
                                window.location.href = "member";
                            }, 2000);
                        });
                    //ระบบมีปัญหา
                } else {
                    swal(res.title, res.msg, "error")
                        .then(function(sw) {
                            location.reload();
                        });
                }
            });
    }

    function closer() {
        swal('ปิดปรับปรุง', '', "error");

    }

    function logout() {
        swal({
            title: 'คุณต้องการออกจากระบบ?',
            buttons: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: 'member/logout',
                        type: 'POST',
                        dataType: 'json',
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal(res.title, res.msg, "success")
                                .then(function(sw) {
                                    $('#cover-spin').show();
                                    setTimeout(function() {
                                        $('#cover-spin').hide();
                                        window.location.href = "home";
                                    }, 1000);
                                });
                        } else {
                            swal(res.title, res.msg, "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });
            } else {

            }

        });


    }

    function genlink(username) {

        $.ajax({
                url: 'member/gen_link',
                type: 'POST',
                dataType: 'json',
                data: {
                    username: username
                }
            })
            .done(function(res) {
                $('#getLink').modal();
                $('#span_getLink').val('<?= base_url() ?>users/home/index/' + res.token);

                var qrcode = new QRCode(document.getElementById("demoqr"), {
                    text: "<?= base_url() ?>users/home/index/" + res.token,
                    width: 186,
                    height: 186
                });
            });
    }

    function clear_qrcode() {

        $('#demoqr').empty();

    }

    function copyLink() {

        var copyLink = document.getElementById("span_getLink");
        const showText = document.getElementById("text-copy");
        /* Select the text field */
        copyLink.select();
        copyLink.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        showText.innerHTML = 'คัดลอกสำเร็จ'
        setTimeout(() => {
            showText.innerHTML = ''
        }, 4000)

    }
</script>



    <form method="POST" action="https://app.123dic.link/bjk" accept-charset="UTF-8" id="form-exit">
        <input name="_token" type="hidden" value="Z1ArYaGMtVQtTbfH9clzBVnuObeqfcsre66N6N5T" />
        <div class="modal dark_bg fade" id="modal-exit" tabindex="15" role="dialog" aria-labelledby="modal-create-label" aria-hidden="true" style="overflow-y: hidden; background: rgba(255, 255, 255, 0.6);">
            <div class="modal-dialog d-flex justify-content-center align-items-center" role="document" style="height: 100%;">
                <div class="modal-content col-15 px-0" style="background: #151c27;">
                    <div class="modal-body d-flex flex-column font-weight-lighter font-bold align-items-center px-4 text-white font-1-1">
                        คุณต้องการออกจากระบบ ?
                    </div>
                    <hr width="90%" class="mt-0 mb-1" style="border-top: 1px solid #e6e6e669;" />
                    <div class="modal-footer py-2 px-3" style="border: none;">
                        <button class="btn text-white font-0-6" style="background: transparent;" data-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-danger box-shadow-unset px-4 btn-submit line-height-0-9">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <script src="https://app.123dic.link/assets/adminux/js/jquery-2.1.1.min.js"></script>
    <script src="https://app.123dic.link/assets/adminux/vendor/bootstrap4alpha/js/tether.min.js"></script>
    <script src="https://app.123dic.link/assets/adminux/vendor/bootstrap4alpha/js/bootstrap.min.js"></script>


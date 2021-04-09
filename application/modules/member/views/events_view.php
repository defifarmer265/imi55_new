<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<style>
    table.dataTable tbody tr {
        background-color: #343a40;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default;
        color: #f9f9f9 !important;
        border: 1px solid transparent;
        background: transparent;
        box-shadow: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0.5em 1em;
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        *cursor: hand;
        color: #fffdfd !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #333 !important;
        border: 1px solid #979797;
        background-color: white;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #dcdcdc));
        background: -webkit-linear-gradient(top, #fff 0%, #dcdcdc 100%);
        background: -moz-linear-gradient(top, #fff 0%, #dcdcdc 100%);
        background: -ms-linear-gradient(top, #fff 0%, #dcdcdc 100%);
        background: -o-linear-gradient(top, #fff 0%, #dcdcdc 100%);
        background: linear-gradient(to bottom, #fff 0%, #dcdcdc 100%);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
        outline: none;
        background-color: #f9f9f9;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
        background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
        background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
        background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
        background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
        background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
        box-shadow: inset 0 0 3px #fbfbfb;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default;
        color: #adaeaf !important;
        border: 1px solid #2d2a2a00;
        background: #343a40;
        box-shadow: none;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
        padding-top: 0.25em;
        background-color: #343a40;
        font-size: 12px;
    }

    .dataTables_length {
        display: none;
    }

    .pagination {
        display: none;
    }

    .dataTables_info {
        display: none;
    }


    .textover {
        position: absolute;
        right: 0;
        bottom: 0;
        padding: 1.25rem;
    }
</style>
<!-- CONTACT-->
<header class="masthead  text-white text-center" style="padding-top: calc(6rem - 10px) !important; height: 90%;" id="tap_contact">

    <div class="container">
        <div class="row" style="padding: 20px;">
            <div class="col-12">
                <label class="text-left"> Events </label><br>
                <?php if (sizeof($event) == 0) {?>
                    <br>
                    <br>
                    <label>ไม่มี Event ในช่วงเวลานี้</label>
                <?php }?>
                <?php if (sizeof($event) != 0) {?>
                <div class="table-responsive-lg d-flex justify-content-center">
                    <div class="row">
                        <div class="col-sm-4" style="margin: 20px 0;">
                            <img class="card-img-top" src="<?=base_url(($count['day1'] != 0) ? "public/event/active.png" : "public/event/noactive.png")?>" alt="Card image">
                            <label><?=($count['day1']) ? $count['day1'] : 'ไม่มียอดฝาก';?></label>
                        </div>
                        <div class="col-sm-4" style="margin: 20px 0;">
                            <img class="card-img-top" src="<?=base_url()?>public/event/<?=($count['day2'] != 0) ? "active.png" : "noactive.png";?>" alt="Card image">
                            <label><?=($count['day2']) ? $count['day2'] : 'ไม่มียอดฝาก';?></label>
                        </div>
                        <div class="col-sm-4" style="margin: 20px 0;">
                            <img class="card-img-top" src="<?=base_url()?>public/event/<?=($count['day3'] != 0) ? "active.png" : "noactive.png";?>" alt="Card image">
                            <label><?=($count['day3']) ? $count['day3'] : 'ไม่มียอดฝาก';?></label>
                        </div>
                        <div class="col-sm-4" style="margin: 20px 0;">
                            <img class="card-img-top" src="<?=base_url()?>public/event/<?=($count['day4'] != 0) ? "active.png" : "noactive.png";?>" alt="Card image">
                            <label><?=($count['day4']) ? $count['day4'] : 'ไม่มียอดฝาก';?></label>
                        </div>
                        <div class="col-sm-4" style="margin: 20px 0;">
                            <img class="card-img-top" src="<?=base_url()?>public/event/<?=($count['day5'] != 0) ? "active.png" : "noactive.png";?>" alt="Card image">
                            <label><?=($count['day5']) ? $count['day5'] : 'ไม่มียอดฝาก';?></label>
                        </div>
                        <div class="col-sm-4" style="margin: 20px 0;">
                            <img class="card-img-top" src="<?=base_url()?>public/event/<?=($count['day6'] != 0) ? "active.png" : "noactive.png";?>" alt="Card image">
                            <label><?=($count['day6']) ? $count['day6'] : 'ไม่มียอดฝาก';?></label>
                        </div>
                        <div class="col-sm-4" style="margin: 20px 0;">
                            <img class="card-img-top" src="<?=base_url()?>public/event/<?=($count['day7'] != 0) ? "active.png" : "noactive.png";?>" alt="Card image">
                            <label><?=($count['day7']) ? $count['day7'] : 'ไม่มียอดฝาก';?></label>
                        </div>

                        <div class="col-sm-4" style="margin: 20px 0; ">
                            <?=$bt;?>
                        </div>
                    </div>
                </div>
                <br>
                <label>* เมื่อยูสเซอร์มียอดฝากไม่ถึงขั้นต่ำที่อีเว้นท์กำนหดจะมีเริ่มนับวันใหม่ *</label>
                <?php }?>

            </div>
        </div>
    </div>

</header>
<script src="<?php echo base_url() ?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>public/tem_admin/swal/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {

    });

    function receive(id) {
         swal({
             text: 'ต้องการทำรายการหรือไม่ ?',
             buttons: ["ยกเลิก", "ยืนยัน"],
         }).then((accept) => {

             if (accept) {
                 console.log(accept);

                   $.ajax({
                       url: '<?php echo base_url() ?>users/events/receive_event',
                       type: 'POST',
                       dataType: 'json',
                       data: {
                           id: id
                       },
                   }).done(function(res) {
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
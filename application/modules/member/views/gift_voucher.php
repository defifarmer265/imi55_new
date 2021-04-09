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

  #mytab {


    height: 450px;
    overflow: auto;
  }

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
<div id="cover-spin"></div>
<!-- CONTACT-->
<header class="masthead text-white text-center" style="padding-top: calc(6rem - 10px) !important; height: 90%;" id="tap_contact">

  <div class="container">
    <div class="row" style="padding: 20px;">
      <div class="col-12">
        <h4>รับรางวัล</h4>
          <div class="row">
<!--              <div class="col-1"></div>-->
              <div class="col-7"><input type="text" value="" id="code" name="code" max="10"  class="form-control" placeholder="กรอกรหัสโค้ด"></div>
              <div class="col-3"><button  class="btn btn-success" onClick="code()">รับโค้ด</button></div>
<!--              <div class="col-1"></div> responsive nowrap display-->
          </div>
        <br>
        <div id="mytab">
          <table id="myTable" class="table table-striped table-dark" style="font-weight: 100;font-size: 13px">
            <thead>
              <tr align="center">
                <th scope="col">No</th>
                <th scope="col">ชื่อรางวัล</th>
                <th scope="col">จำนวน</th>
                <th scope="col">วันหมดอายุ</th>
                <th scope="col">สถานะ</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($gift != '' && $gift != null) {
                $i = 0;
                foreach ($gift as $gf) { ?>
                  <?php if ($gf['receive'] == 0 && $gf['time_end'] >= time() ) { ?>
                    <tr id='<?php $i; ?>' onclick="accept(<?= $gf['user_id']; ?>,<?= $gf['gift_id']; ?>)" style='cursor:pointer'>
                    <?php } ?>
                    <?php if ($gf['receive'] != 0) { ?>
                    <tr>
                    <?php } ?>

                    <td><?= $i + 1; ?></td>
                    <td><?= $gf['gift_name']; ?></td>
                    <?php if ($gf['credit'] != 0) { ?>
                      <td><?= $gf['credit']; ?> เครดิต</td>
                    <?php } ?>
                    <?php if ($gf['point'] != 0) { ?>
                      <td><?= $gf['point']; ?> พ้อย</td>
                    <?php } ?>
                    <td><?= date("d/m/y", $gf['time_end']); ?></td>
                    <?php if ($gf['receive'] != 0) { ?>
                      <td class="text-success">รับแล้ว</td>
                    <?php } ?>
                    <?php 
                        if ($gf['receive'] == 0) { 
                            if($gf['time_end'] >= time()){
                                echo '<td><button class="btn btn-success btn-sm">รับ</button></td>';
                            }else{ 
                                echo '<td class="text-danger"> หมด </td>';
                            }
                        } 
                        ?>

                    </tr>
                <?php $i++;
                }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>


<script>
  function code(){
      var code = $('#code').val();
      $.ajax({
          url: '<?php echo base_url('users/gift/gift_code'); ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            code: code
          }
        }).done(function(res) {
          console.log(res);
          if (res.code == 1) {
            swal('', res.msg, 'success').then((result) => {
              if (result) {
                setTimeout(function() {
                  window.location.href = "<?php echo base_url('users/member'); ?>";
                }, 500);
              }
            });
          } else {
            swal('', res.msg, 'error')
          }
        });
  }
  function accept(user_id, gift_id) {
    console.log(user_id);
    console.log(gift_id);
    swal('', 'ต้องการทำรายการหรือไม่ ?', 'warning').then((result) => {
      if (result) {
        $.ajax({
          url: '<?php echo base_url('users/gift/receive_gift'); ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            user_id: user_id,
            gift_id: gift_id
          }
        }).done(function(res) {
          console.log(res);
          if (res.code == 1) {
            swal('', res.msg, 'success').then((result) => {
              if (result) {
                setTimeout(function() {
                  window.location.href = "<?php echo base_url('users/member'); ?>";
                }, 500);
              }
            });
          } else {
            swal('', res.msg, 'error')
          }
        });
      }


    });
  }
</script>
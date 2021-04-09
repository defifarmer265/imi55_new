<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
  input[type=checkbox] {
    height: 18px;
    width: 18px;
  }
</style>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการสินค้า</h2>
          <div class="clearfix"></div>
        </div>
        <div class="row">
          <div class="col-8">
            <button onclick="all_accept('confirm')" id="btn_send_check" class="btn btn-success" style="margin: 10px 10px 10px 10px; display:none;">
              <i class="fa fa-check"></i>
              ยืนยันรายการ
            </button>
            <button onclick="all_accept('cancel')" id="btn_send_cancel" class="btn btn-danger" style="margin: 10px 10px 10px 10px; display:none;">
              <i class="fa fa-times"></i>
              ยกเลิกรายการ
            </button>
            <button onclick="check_all('all')" id="btn_send_allcheck" class="btn btn-secondary" style="margin: 10px 10px 10px 10px;">
              เลือกทั้งหมด
            </button>
            <button onclick="check_all('uncheck')" id="btn_send_uncheck" class="btn btn-secondary" style="margin: 10px 10px 10px 10px; display:none;">
              ยกเลิกการเลือก
            </button>
          </div>
        </div>
        <hr>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr align="center">
                        <th>No.</th>
                        <th>สถานะสินค้า</th>
                        <th>User</th>
                        <th>ชื่อสินค้า(ราคา)</th>
                        <th>ที่อยู่</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($value)) {
                        $i = 0;
                        foreach ($value as $v) { ?>
                          <tr align="center">
                            <td><?= $i + 1; ?></td>
                            <td>
                              <?php if ($v['agent_status'] == 0) { ?>
                                <input class="cl_all_check form-control" type="checkbox" data-user="<?= htmlspecialchars(json_encode($v, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>" onChange="check_some()">
                              <?php } ?>
                              <?php if ($v['agent_status'] == 1) { ?>
                                <i class='fa fa-check' style="color:green;"></i>
                              <?php } ?>
                              <?php if ($v['agent_status'] == 2) { ?> &nbsp;
                                <i class='fa fa-times' style="color:red;">
                                <?php } ?>
                            </td>
                            <td class="font-weight-normal text-secondary"><?= $v['user_id']; ?></td>
                            <td class="font-weight-normal text-secondary"><?= $v['pd_name']; ?> ( <?= number_format($v['pd_point']); ?> Point ) </td>
                            <td class="font-weight-normal text-secondary"><?= $v['address']; ?></td>
                          </tr>
                      <?php $i++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  function show_point(data) {
    var user_point = $(data).data('point').user_point;
    var pd_point = $(data).data('point').pd_point;
    var remain_point = $(data).data('point').remain_point;
    swal({
      title: "User point - สินค้า = คงเหลือ",
      text: user_point + ' - ' + pd_point + ' = ' + remain_point,
      button: "Close",
    });
  }

  function check_all(data) {
    if (data == 'all') {
      $('.cl_all_check').prop('checked', true);
      $('#btn_send_check').show();
      $('#btn_send_cancel').show();
      $('#btn_send_uncheck').show();
      $('#btn_send_allcheck').hide();
    } else {
      $('.cl_all_check').prop('checked', false);
      $('#btn_send_check').hide();
      $('#btn_send_cancel').hide();
      $('#btn_send_uncheck').hide();
      $('#btn_send_allcheck').show();
    }
  }

  function check_some() {
    if ($('.cl_all_check:checked').length >= 1) {
      $('#btn_send_check').show();
      $('#btn_send_cancel').show();
      $('#btn_send_uncheck').show();
      $('#btn_send_allcheck').hide();
    } else {
      $('#btn_send_check').hide();
      $('#btn_send_cancel').hide();
      $('#btn_send_uncheck').hide();
      $('#btn_send_allcheck').show();
    }
  }

  function all_accept(condition) {
    var all_ch = $('.cl_all_check:checked');
    var id = [];
    for (var i = 0; i < all_ch.length; i++) {
      id.push($(all_ch[i]).data('user').id);
    }
    swal({
      icon: "info",
      text: "ต้องการทำรายการหรือไม่ ?",
      buttons: {
        cancel: {
          text: "Cancel",
          value: null,
          visible: true,
          className: "",
          closeModal: true,
        },
        confirm: {
          text: "Confirm",
          value: true,
          visible: true,
          className: "",
          closeModal: true
        }
      },
    }).then((result) => {
      if (result) {
        $.ajax({
          url: '<?= base_url('backend/pd_list/update_status_checkall'); ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            id: id,
            condition: condition
          }
        }).done(function(res) {
          console.log(res);
          if (res.code == 1) {
            swal('', res.msg, 'success').then((result) => {
              window.location.replace("<?php echo base_url(); ?>backend/Pd_list");
            })
          }
        });
      }
    });
  }

  
  function thousands_separators(num) {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
  }
</script>
<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>User<small></small></h2>
          <div class="text-right">
            <button class="btn btn-sm btn-outline-info" onClick="$('#m_creAdmin').modal();"><i class="fa fa-plus"> เพิ่มพนักงาน</i></button>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr style="text-align:center;">
                        <th style="vertical-align: middle"> No.</th>
                        <th style="vertical-align: middle"> Username </th>
                        <th style="vertical-align: middle"> Name </th>
                        <th style="vertical-align: middle"> Name </th>
                        <th>สมัคร<br>
                          ใหม่</th>
                        <th style="vertical-align: middle">ฝาก</th>
                        <th style="vertical-align: middle">ถอน</th>
                        <th>ธนาคาร<br>
                          ลูกค้า</th>
                        <th>โปรโม<br>
                          ชั่น</th>
                        <th style="vertical-align: middle">แบงค์</th>
                        <th style="vertical-align: middle">แอดมิน</th>
                        <th style="vertical-align: middle">ยูเซอร์</th>
                        <th style="vertical-align: middle">ชนะแพ้</th>
                        <th style="vertical-align: middle">รายงาน</th>
                        <th style="vertical-align: middle">Sale</th>
                        <th style="vertical-align: middle"> Last Login </th>
                        <th style="vertical-align: middle"> IP Address </th>
                        <th style="vertical-align: middle">จัดการ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      foreach ($admin as $_a => $a) { ?>
                        <tr style="text-align:center;">
                          <td><?php echo $i;
                              $i++; ?></td>
                          <td><?php echo $a['username']; ?></td>
                          <td><?php echo $a['name']; ?></td>

                          <td><?= $a['class'] == 0 ? 'หัวหน้าใหญ่' : ($a['class'] == 1 ? 'หัวหน้างาน' : 'พนักงานทั่วไป') ?></td>
                          <?php $license = $this->db->where('admin_id', $a['id'])->where('status', 1)->get('tb_class_admin')->row(); ?>
                          <td align="center"><?php if (!empty($license->register) && $license->register == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->deposit) && $license->deposit == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->withdraw) && $license->withdraw == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->promotion) && $license->promotion == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->bank_user) && $license->bank_user == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->bank) && $license->bank == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->admin) && $license->admin == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->user) && $license->user == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->winlose) && $license->winlose == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->report) && $license->report == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td align="center"><?php if (!empty($license->systems) && $license->systems == 1) {
                                                echo '<i style="color:#3AED33;" class="fa fa-check"></i>';
                                              } else {
                                                echo '<i style="color:#F51F23;" class="fa fa-close"></i>';
                                              } ?></td>
                          <td>
                            <?php echo $a['last_login'] == 0 ? '' : date('Y-m-d', $a['last_login']); ?>
                          </td>
                          <td><?php echo $a['last_ip'] == 0 ? '' : $a['last_ip']; ?></td>
                          <td>

                            <button onClick="edit_rounds_show('<?= $a['id'] ?>')" class="btn btn-secondary btn-sm" title="แก้ไขรอบการทำงาน"><i class="fa fa-clock-o"></i></button>
                            <button onClick="edit_typeclass('<?= $a['id'] ?>')" class="btn btn-secondary btn-sm" title="แก้ไขสิทธิ์"><i class="fa fa-cog"></i></button>
                            <button onClick="edit_license('<?= $a['id'] ?>')" class="btn btn-secondary btn-sm" title="แก้ไขการเข้าถึง"><i class="fa fa-gears"></i></button>
                            <button onClick="$('#m_editPass').modal();$('#edit_adminId').val('<?= $a['id'] ?>');" class="btn btn-secondary btn-sm" title="เปลี่ยนพาสเวิร์ด"><i class="fa fa-key"></i></button>
                            <?php if ($a['status'] == 1) { ?>
                              <button onClick="edit_status('0','<?= $a['id'] ?>')" class="btn btn-success btn-sm" title="ปิด"><i class="fa fa-check"></i></button>
                            <?php } else if ($a['status'] == 0) { ?>
                              <button onClick="edit_status('1','<?= $a['id'] ?>')" class="btn btn-danger btn-sm" title="เปิด"><i class="fa fa-close"></i></button>

                            <?php } ?>
                            <?php if ($this->session->users['class'] == 0) { ?>
                            <button onClick="clear_twoFac('<?= $a['id'] ?>')" class="btn btn-secondary btn-sm" title="เคลียร์ two factor"><i class="fa fa-unlock-alt"></i></button>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
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

<!--modal-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="m_editLicense" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขสิทธิ์ พนักงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="form_editLicense">
        <div class="modal-body">
          <div class="x_content">
            <div class="col-md-12 col-sm-12 ">
              <input type="hidden" id="lic_adminId" value="" name="admin_id">

              <div class="checkbox">
                <label class="btn">
                  <input type="checkbox" class="" name="register" value="1" id="lic_register">
                  สมัครใหม่ </label>
                <label class="btn">
                  <input type="checkbox" class="" name="deposit" value="1" id="lic_deposit">
                  รายการฝาก </label>
                <label class="btn">
                  <input type="checkbox" class="" name="withdraw" value="1" id="lic_withdraw">
                  รายการถอน </label>
                <label class="btn">
                  <input type="checkbox" class="" name="bank_user" value="1" id="lic_bank_user">
                  ธนาคารลูกค้า </label>
                <label class="btn">
                  <input type="checkbox" class="" name="promotion" value="1" id="lic_promotion">
                  โปรโมชั่น </label>
                <label class="btn">
                  <input type="checkbox" class="" name="bank" value="1" id="lic_bank">
                  ยอดธนาคาร </label>
                <label class="btn">
                  <input type="checkbox" class="" name="report" value="1" id="lic_report">
                  รายงาน </label>
                <label class="btn">
                  <input type="checkbox" class="" name="systems" value="1" id="lic_systems">
                  Sale </label>
                <label class="btn">
                  <input type="checkbox" class="" name="user" value="1" id="lic_user">
                  ลูกค้า </label>
                <label class="btn">
                  <input type="checkbox" class="" name="winlose" value="1" id="lic_winlose">
                  ชนะแพ้ </label>
                <label class="btn">
                  <input type="checkbox" class="" name="admin" value="1" id="lic_admin">
                  พนักงาน </label>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button onClick="edit_class()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="m_creAdmin" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">เพิ่มพนักงาน</h5>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="form_creAdmin">
        <div class="modal-body">
          <div class="x_content">
            <div class="row">
              <h5>รายละเอียดพนักงาน</h5>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6  form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" id="edit_name" name="name" placeholder="ชื่อ">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              </div>
              <div class="col-md-6 col-sm-6  form-group has-feedback">
                <input type="text" class="form-control" id="edit_tel" name="tel" placeholder="Tel">
                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="col-md-6 col-sm-6  form-group has-feedback">
                <div class="input-group">
                  <input type="text" name="username" placeholder="Username" class="form-control">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-secondary go-class"> @
                      <?= $this->getapi_model->agent() ?>
                    </button>
                  </span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6  form-group has-feedback">
                <input type="text" class="form-control" id="inputSuccess5" name="password" placeholder="Password">
                <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6  form-group has-feedback">
                <h>เลือกรอบการทำงาน</h>
                <select id="rounds" name="rounds" class="form-control">
                  <?php foreach ($rounds as $r => $re) { ?>
                    <option value="<?php echo $re['id']; ?>"><?php echo $re['rounds_desc'] . ' ' . $re['time_start'] . '-' . $re['time_end']; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6 col-sm-6  form-group radio">
                <h>ประเภทพนักงาน</h> <br>
                <div class="row">
                  <?php if ($this->session->users['class'] == 0) { ?>
                    <label class="col-md-4">
                      <input type="radio" class="flat" name="type" value="0">
                      หัวหน้าใหญ่ </label>
                  <?php  } ?>
                  <?php if ($this->session->users['class'] <= 1) { ?>
                    <label class="col-md-4">
                      <input type="radio" class="flat" name="type" value="1">
                      หัวหน้างาน </label>
                  <?php  } ?>
                  <label class="col-md-4">
                    <input type="radio" class="flat" name="type" value="2" checked>
                    พนักงานทั่วไป </label>
                </div>
              </div>
            </div>
            <hr>
            <div class="col-md-12 col-sm-12 ">
              <div class="row">
                <h5>สิทธิ์การเข้าถึง</h5>
              </div>
              <div class="checkbox row">
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="register" a value="1" checked="checked">
                  สมัครใหม่ </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="deposit" a value="1" checked="checked">
                  รายการฝาก </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="withdraw" a value="1" checked="checked">
                  รายการถอน </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="bank_user" a value="1" checked="checked">
                  ธนาคารลูกค้า </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="promotion" a value="1" checked="checked">
                  โปรโมชั่น </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="bank" a value="1" checked="checked">
                  ยอดธนาคาร </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="report" a value="1" checked="checked">
                  รายงาน </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="systems" a value="1" checked="checked">
                  Sale </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="user" a value="1" checked="checked">
                  ลูกค้า </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="winlose" a value="1">
                  ชนะแพ้ </label>
                <label class=" col-md-3">
                  <input type="checkbox" class="flat" name="admin" a value="1">
                  พนักงาน </label>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button onClick="cre_admin2()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--เปลี่ยนพาส-->
<div class="modal fade" tabindex="-1" role="dialog" id="m_editPass" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เปลี่ยนพาสเวิร์ด<small>(ตรวจสอบชื่อ)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="form_editPass">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;"> <span id="span_usernamePWD"></span>
            <input type="hidden" name="admin_id" id="edit_adminId">
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <input type="text" class="form-control" placeholder="Password" required="required" name="password" id="val_editPass" autocomplete="off">
            <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" onClick="edit_pass()" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!--แก้ไขสิทธิ์-->
<div class="modal fade" tabindex="-1" role="dialog" id="m_edit_type" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขสิทธิ์<small>(ตรวจสอบชื่อ)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="form_type">
          <input type="hidden" value="" name="admin_id" id="edit_type_amdin_id">
          <div class="row radio">
            <label class="col-md-4">
              <input type="radio" class="flat" name="type" value="0" id="class_admin0">
              หัวหน้าใหญ่ </label>
            <label class="col-md-4">
              <input type="radio" class="flat" name="type" value="1" id="class_admin1">
              หัวหน้างาน </label>
            <label class="col-md-4">
              <input type="radio" class="flat" name="type" value="2" id="class_admin2">
              พนักงานทั่วไป </label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onClick="edit_type()">Save</button>
        <button class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!--แก้ไขรอบกะ-->
<div class="modal fade" tabindex="-1" role="dialog" id="m_edit_rounds" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขรอบการทำงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="form_rounds">
          <input type="hidden" value="" name="admin_id" id="edit_rounds_amdin_id">
          <input type="hidden" value="" name="rounds_amdin_id" id="rounds_amdin_id">
          <select id="edit_rounds" name="edit_rounds" class="form-control">
            <?php foreach ($rounds as $r => $re) { ?>
              <option id="<?php echo $re['id']; ?>" name="rounds" value="<?php echo $re['id']; ?>"><?php echo $re['rounds_desc'] . ' ' . $re['time_start'] . '-' . $re['time_end']; ?></option>
            <?php } ?>
          </select>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onClick="edit_rounds()">Save</button>
        <button class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script>
  function edit_class() {

    // $('#form_editLicense').submit(function(event) {
    //     event.preventDefault();

    var data = $('#form_editLicense').serializeArray();

    $.ajax({
        url: 'admin/edit_license',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {

          swal({
            icon: "success",
            text: res.msg,
          });
          setTimeout(function() {
            location.reload();
          }, 2000);
        } else {
          swal({
            icon: "error",
            text: res.msg,
          });
        }
      })
      .fail(function() {
        console.log("error");
      });


  }


  function edit_pass() {
    var data = $('#form_editPass').serializeArray();
    $.ajax({
        url: 'admin/edit_pass',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {

          swal({
            icon: "success",
            text: res.msg,
          });
          setTimeout(function() {
            location.reload();
          }, 2000);
        } else {
          swal({
            icon: "error",
            text: res.msg,
          });
        }
      })
      .fail(function() {
        console.log("error");
      });
  }

  function edit_type() {
    var data = $('#form_type').serializeArray();
    $.ajax({
        url: 'admin/edit_type',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {

          swal(res.title, res.msg, 'success');
          setTimeout(function() {
            location.reload();
          }, 2000);
        } else {
          swal(res.title, res.msg, 'error');
        }
      })
      .fail(function() {
        console.log("error");
      });

  }

  function edit_rounds() {
    var data = $('#form_rounds').serializeArray();
    $.ajax({
        url: 'admin/edit_rounds',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {

          swal(res.title, res.msg, 'success');
          setTimeout(function() {
            location.reload();
          }, 2000);
        } else {
          swal(res.title, res.msg, 'error');
        }
      })
      .fail(function() {
        console.log("error");
      });

  }



  function cre_admin2() {
    var data = $('#form_creAdmin').serializeArray();
    $.ajax({
        url: 'admin/cre_admin',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {

          swal({
            icon: "success",
            text: res.msg,
          });
          setTimeout(function() {
            location.reload();
          }, 2000);
        } else {
          swal({
            icon: "error",
            text: res.msg,
          });
        }
      })
      .fail(function() {
        console.log("error");
      });

  }

  function edit_license(id) {
    $('#m_editLicense').modal();
    $.ajax({
      url: 'admin/get_license',
      type: 'POST',
      dataType: 'json',
      data: {
        admin_id: id
      },
    }).done(function(res) {
      if (res.register == 1) {
        $('#lic_register').prop('checked', true);
      } else {
        $('#lic_register').prop('checked', false);
      }
      if (res.deposit == 1) {
        $('#lic_deposit').prop('checked', true);
      } else {
        $('#lic_deposit').prop('checked', false);
      }
      if (res.withdraw == 1) {
        $('#lic_withdraw').prop('checked', true);
      } else {
        $('#lic_withdraw').prop('checked', false);
      }
      if (res.bank_user == 1) {
        $('#lic_bank_user').prop('checked', true);
      } else {
        $('#lic_bank_user').prop('checked', false);
      }
      if (res.promotion == 1) {
        $('#lic_promotion').prop('checked', true);
      } else {
        $('#lic_promotion').prop('checked', false);
      }
      if (res.bank == 1) {
        $('#lic_bank').prop('checked', true);
      } else {
        $('#lic_bank').prop('checked', true);
      }
      if (res.report == 1) {
        $('#lic_report').prop('checked', true);
      } else {
        $('#lic_report').prop('checked', false);
      }
      if (res.systems == 1) {
        $('#lic_systems').prop('checked', true);
      } else {
        $('#lic_systems').prop('checked', false);
      }
      if (res.user == 1) {
        $('#lic_user').prop('checked', true);
      } else {
        $('#lic_user').prop('checked', false);
      }
      if (res.winlose == 1) {
        $('#lic_winlose').prop('checked', true);
      } else {
        $('#lic_winlose').prop('checked', false);
      }
      if (res.admin == 1) {
        $('#lic_admin').prop('checked', true);
      } else {
        $('#lic_admin').prop('checked', false);
      }

    })
    $('#admin_id').val(id);
    $('#lic_adminId').val(id);


  }


  function edit_typeclass(id) {

    $('#m_edit_type').modal();
    $.ajax({
      url: 'admin/get_class',
      type: 'POST',
      dataType: 'json',
      data: {
        id: id
      },
    }).done(function(res) {
      if (res.class == 0) {
        $('#class_admin0').parent().addClass("checked");
      } else {
        $('#class_admin0').parent().removeClass("checked");
      }
      if (res.class == 1) {
        $('#class_admin1').parent().addClass("checked");
      } else {
        $('#class_admin1').parent().removeClass("checked");
      }
      if (res.class == 2) {
        $('#class_admin2').parent().addClass("checked");
      } else {
        $('#class_admin2').parent().removeClass("checked");
      }
    })
    $('#edit_type_amdin_id').val(id);
  }

  function edit_rounds_show(id) {

    $('#m_edit_rounds').modal();
    $.ajax({
      url: 'admin/get_rounds',
      type: 'POST',
      dataType: 'json',
      data: {
        id: id
      },
    }).done(function(res) {
      document.getElementById(res.rounds).selected = "true";

    })
    $('#edit_rounds_amdin_id').val(id);


  }



  function edit_status(status, id) {
    swal({
      title: 'Are you sure?',
      buttons: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'admin/edit_status',
          type: 'POST',
          dataType: 'json',
          data: {
            status: status,
            id: id
          },
        }).done(function(res) {
          if (res.code == 1) {
            swal({
              icon: "success",
              text: res.msg,
            });
            setTimeout(function() {
              location.reload();
            }, 2000);
          } else {
            swal({
              icon: "error",
              text: res.msg,
            });
          }
        });
      } else {

      }

    });
  }

  function clear_twoFac(id) {
    //กดปุ่ม ส่ง  id กับ pin ไปให้ controller Backend.php
    console.log(id);
    Swal.fire({
      title: 'กรุณากรอกรหัส Two Factor',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      cancelButtonText: 'ยกเลิก',
      showCancelButton: true,
      confirmButtonText: 'ตกลง',
      showLoaderOnConfirm: true,


    }).then((result) => {
      if (result.isConfirmed) {


        //ส่งให้ id, pin ไปที่ function clear_twoFac เป็น json 1.
        $.ajax({

            url: 'clear_twoFac',
            method: "POST",
            data: {
              id_operator: id,
              pin: result.value
            },

            dataType: 'json',
          })
          //รับ status จาก controller
          .done(function(res) {
            console.log(res);
            if (res.status == 1) {

                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'รหัส Two Factor สำเร็จ',
                  showConfirmButton: false,
                  timer: 1500
                })
            } else {

              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'รหัส Two Factor ของท่านไม่ถูกต้อง'
              })
            }
          });


      }
    })

  }
</script>
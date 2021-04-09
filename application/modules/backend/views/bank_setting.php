<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายชื่อแบงค์<small></small></h2>
          <ul class="nav navbar-right panel_toolbox">

            <li> <button onClick="cre_bank()"><i class="fa fa-plus"></i></button></li>

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="background-color:#12205F;color: #FFF">
                      <tr class="text-center">
                        <th width="5%"> รหัส</th>
                        <th> ชื่อแบงค์ </th>
                        <th> เลขบัญชี </th>
                        <th> ธนาคาร </th>
                        <th> ประเภท </th>
                        <th> สร้างเมื่อ </th>
                        <th> ผู้ที่สามารถเห็น</th>
                        <th width="5%"> สถานะ </th>
                        <th width="5%"> แก้ไข </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      if (!empty($bank_web)) {
                        foreach ($bank_web as $_b => $bnk) { ?>
                          <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td style="text-align:center;"><?= $bnk['name'] ?></td>
                            <td class="text-center"><?= $bnk['account'] ?></td>
                            <td class="text-center"><?= $bnk['bank_short'] . ' - ' . $bnk['bank_th']?></td>
                            <td class="text-center"><?php
                                                    if ($bnk['type'] == '1') {
                                                      echo 'ฝาก';
                                                    } else {
                                                      echo 'ถอน';
                                                    }
                                                    ?></td>
                            <td class="text-center"><?= date('d/m/y H:i', $bnk['create_time']) ?></td>
                            <td>
                              <?php
                              foreach ($bnk['bgu'] as $group) {
                                echo '<span class="btn btn-success btn-sm">' . $group['name'] . '</span>';
                              }
                              ?>
                              <button class="btn btn-sm" onClick="btn_addGroup('<?= $bnk['id'] ?>')">
                                <i class="fa fa-plus"></i>
                              </button>
                            </td>
                            <td class="text-center">
                              <?php if (!empty($bnk['status']) && $bnk['status'] == 1) { ?>
                                <a href="#" onClick="edit_statusBank('<?= $bnk['id'] ?>','0')" title="ปิด">
                                  <i style="color:#3AED33;" class="fa fa-check"></i>
                                </a>
                              <?php } else if ($bnk['status'] == 3) { ?>
                                <i style="color:#3AED33;" class="fa fa-exchange"> Auto</i>
                              <?php } else { ?>
                                <a href="#" onClick="edit_statusBank('<?= $bnk['id'] ?>','1')" title="เปิด">
                                  <i style="color:#F51F23;" class="fa fa-remove"></i>
                                </a>
                              <?php } ?>
                            </td>

                            <td style="text-align:center;">
                              <?php if ($bnk['status'] != 3) { ?>
                                <a href="#" onClick="edit_bank('<?= $bnk['id'] ?>')" title="แก้ไข"> <i class="fa fa-pencil"></i> </a>
                              <?php  } ?>
                            </td>

                          </tr>

                          <?php $i++; ?>

                        <?php }
                      } else { ?>
                        <tr>
                          <td colspan="9" style="text-align:center;">ไม่มีข้อมูล</td>
                          </td>
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
<!-- Button trigger modal -->
<!-- Modal -->
<!--mod_add-->
<div class="modal fade" id="mod_bankGroup" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เลือกกลุ่ม<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left" id="form_bankGroup" style="font-size: 18px;">
        <div class="modal-body">
          <!--			asdfasdfasdfsadfS-->
          <input type="hidden" name="bank_id" id="bankGroup_id" value="">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">กลุ่ม</label>
              <div class="col-md-9 col-sm-9 ">
                <?php
                foreach ($group_r as $_g => $gpr) {
                ?>
                  <div class="form-check">
                    <input type="checkbox" name="<?= $gpr['id'] ?>" class="form-check-input" id="Check<?= $gpr['id'] ?>">
                    <label class="form-check-label" for="Check<?= $gpr['id'] ?>"><?= $gpr['name'] ?></label>
                  </div>
                <?php
                }
                ?>

              </div>
            </div>
          </div>


        </div>
      </form>
      <div class="modal-footer">
        <button type="button" onClick="create_groupByuser()" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--  mod_cre_bank -->
<div class="modal fade" id="mod_cre_bank" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แบงค์<small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left" id="form_bank" style="font-size: 18px;">
        <div class="modal-body">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
            <input type="hidden" name="id" id="bank_id">
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อบัญชี</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="name" name="name" placeholder=""autocomplete="off">
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">เลขที่บัญชี</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="account" name="account" placeholder="" maxlength="12" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ตัวย่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <select class="form-control" name="bank_id">
                  <?php
                  foreach ($bank as $b) {
                    echo '<option value="' . $b['id'] . '">' . $b['bank_short'] . '-' . $b['bank_th'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">รายการ</label>
              <div class="col-md-9 col-sm-9 ">
                <select name="type" id="type" class="form-control">
                  <option value="1">ฝาก</option>
                  <option value="2">ถอน</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onClick="form_creBnk()" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--end modal-->


<script type="text/javascript">
  function form_creBnk() {
    var data = $('#form_bank').serializeArray();
    $.ajax({
        url: 'bank_create',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {
          swal(res.title, res.msg, 'success').then(function(w) {
            setTimeout(function() {
              location.reload();
            }, 1000);
          });
        } else {
          swal(res.title, res.msg, 'error').then(function(w) {
            setTimeout(function() {
              location.reload();
            }, 1000);
          });
        }
      })
      .fail(function() {
        console.log("error");
      });

  }

  function cre_bank() {
    $('#mod_cre_bank').modal();
    $('#bank_id').val('');
    $('#name').val('');
    $('#bank_short').val('');
    $('#account').val('');

  }

  function edit_bank(id) {
    $('#mod_cre_bank').modal();
    $.ajax({
      url: 'get_bank',
      type: 'POST',
      dataType: 'json',
      data: {
        id: id
      },
    }).done(function(res) {
      $('#name').val(res.name);
      $('#bank_short').val(res.short);
      $('#account').val(res.account);
      $('#type').val(res.type);
      $('#bank_id').val(res.id);

    });
  }

  function edit_statusBank(id, status) {
    swal({
      title: 'ต้องการเปลี่ยนสถานะแบงค์ ?',
      buttons: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
            url: 'bank_status',
            type: 'POST',
            dataType: 'json',
            data: {
              id: id,
              status: status
            },
          }).done(function(res) {
            //console.log(res);
            if (res.code == 1) {
              swal(res.title, res.msg, 'success').then(function(w) {
                setTimeout(function() {
                  location.reload();
                }, 700);
              });
            } else {
              swal(res.title, res.msg, 'error').then(function(w) {
                setTimeout(function() {
                  location.reload();
                }, 700);
              });
            }
          })
          .fail(function() {
            console.log("error");
          });
      }
    })
  }

  function btn_addGroup(id) {
    $('#mod_bankGroup').modal();
    $('#bankGroup_id').val(id);
  }

  function create_groupByuser() {
    var data = $('#form_bankGroup').serializeArray();

    $.ajax({
        url: 'groupByuser',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {
          swal(res.title, res.msg, 'success').then(function(w) {
            setTimeout(function() {
              location.reload();
            }, 1000);
          });
        } else {
          swal(res.title, res.msg, 'error').then(function(w) {
            setTimeout(function() {
              location.reload();
            }, 1000);
          });
        }
      })
      .fail(function() {
        console.log("error");
      });
  }
</script>
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>setturnover<small></small></h2>
          <div class="clearfix"> </div>
        </div>


        <div class="col-md-12 col-sm-12 ">
          <div class="row">
            <div class="col-md-4 col-sm-4 ">
              ตั้งค่ารายการฝาก <div class="x_content">
                <div class="form-check ">
                  <label class="" for="">
                    ติดเทิร์นรูปแบบ <span id="type_"> <?= $type_set_deposit_turnover ?> </span>
                    :( <span id="set_"> <?= $set_deposit_turnover ?> </span> )
                    สูงสุด( <span id="max_"> <?= $max_set_deposit_turnover ?> </span> )
                  </label>
                </div>



                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">รูปแบบติดเทิร์น</label>
                  <div class="col-sm-4">
                    <select class="form-control form-control-sm" id="type">
                      <option value="จำนวน"> จำนวน </option>
                      <option value="แบบเท่า"> แบบเท่า </option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">จำนวน</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="num" min="0" name="" value="0">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">สูงสุด</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="max" name="" min="0" value="0">
                  </div>

                </div>
                <div class="col-sm-4">
                  <button class="btn btn-success" onclick="updates_setdeposit_turn()"> อัฟเดท </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 ">
              ตั้งค่าสมัครใหม่ <div class="x_content">
                <div class="form-check ss">
                  <label class="" for="">
                    ลูกค้าใหม่ ไม่มีเซลล์ จะติดเทิร์น <span id="set_newuser_turn"> <?= $set_newuser_turn ?> </span>
                  </label>
                </div>
                <div class="form-check ss">
                  <label class="" for="">
                    ลูกค้าใหม่ มีเซลล์ จะติดเทิร์น &nbsp;&nbsp;&nbsp;<span id="set_newusersale_turn"> <?= $set_newusersale_turn ?> </span>
                  </label>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">รูปแบบติดเทิร์น</label>
                  <div class="col-sm-4">
                    <select class="form-control form-control-sm" id="setuser">
                      <option value="set_newuser_turn"> ลูกค้าใหม่ ไม่มีเซลล์ </option>
                      <option value="set_newusersale_turn"> ลูกค้าใหม่ มีเซลล์ </option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">จำนวนที่ติดเทิร์น</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="valueuserturn" name="valueuserturn" value="0">
                  </div>


                </div>
                <div class="col-sm-4">
                  <button class="btn btn-success" onclick="updatesetuser()"> อัฟเดท </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 ">
              ตั้งค่าได้พ้อยจากเทิร์น ตัดอัตโนมัติหลัง เที่ยงคืน <div class="x_content">
                <div class="form-check ss">
                  <label class="" for="">
                    เทิร์นขั้นต่ำ ( <b><span id="sh_minTurnPoint"> <?=$minTurnPoint;?></span></b> )
                  </label>
                  |
                  <label class="" for="">
                    เทิร์นสูงสุด ( <b><span id="sh_maxTurnPoint"> <?=$maxTurnPoint;?></span></b> )
                  </label>  
                  |
                  <label class="" for="">
                    เปอร์เซนต์ คำนวณ ( <b><span id="sh_perPoint">  <?=$perPoint;?> </span></b> )
                  </label>
                </div>
                <div class="form-check ss">
                
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">ตั้งเทิร์นขั้นต่ำ</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="minTurnPoint" name="minTurnPoint" min="100">
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">ตั้งเทิร์นสูงสุด</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="maxTurnPoint" name="maxTurnPoint" min="100">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label"> ตั้งเปอร์เซนต์ คำนวณ</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="perPoint" name="perPoint"  step="0.1" min="0.1">
                  </div>
                </div>
               
                <div class="col-sm-4">
                  <button class="btn btn-success" onclick="updateturntopoint()"> อัฟเดท </button>
                </div>
              </div>
            </div>

          </div>

        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">

              <div class="col-sm-4">
                GAME<p>
                  <div class="card-box table-responsive">
                    <table class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead style="background-color:#12205F;color: #FFF">
                        <tr class="text-center">
                          <th> ลำดับ </th>
                          <th> code </th>
                          <th> ชื่อค่าย </th>
                          <th> สถานะคิดเทิร์น </th>

                        </tr>
                      </thead>
                      <?php $i = 1;
                      foreach (json_decode($vender) as $key => $value) {
                        if ($value->type == 1) { ?>
                          <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= $value->vendorCode ?></td>
                            <td><?= $value->VendorName ?></td>
                            <td>
                              <label class="switch">
                                <input type="checkbox" onclick="updatecheckturn(<?= $value->id ?>,this.checked)" <?= ($value->check_turn == 1) ? 'checked' : ''; ?>>
                                <span class="slider round"></span>
                              </label>
                            </td>
                          </tr>

                      <?php $i++;
                        }
                      }  ?>
                    </table>
                  </div>
              </div>

              <div class="col-sm-4">
                CASINO<p>
                  <div class="card-box table-responsive">
                    <table class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead style="background-color:#12205F;color: #FFF">
                        <tr class="text-center">
                          <th> ลำดับ </th>
                          <th> code </th>
                          <th> ชื่อค่าย </th>
                          <th> สถานะคิดเทิร์น </th>

                        </tr>
                      </thead>
                      <?php $i = 1;
                      foreach (json_decode($vender) as $key => $value) {
                        if ($value->type == 2) { ?>
                          <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= $value->vendorCode ?></td>
                            <td><?= $value->VendorName ?></td>
                            <td>
                              <label class="switch">
                                <input type="checkbox" onclick="updatecheckturn(<?= $value->id ?>,this.checked)" <?= ($value->check_turn == 1) ? 'checked' : ''; ?>>
                                <span class="slider round"></span>
                              </label>
                            </td>
                          </tr>

                      <?php $i++;
                        }
                      }  ?>
                    </table>
                  </div>
              </div>

              <div class="col-sm-4">
                SPORT<p>
                  <div class="card-box table-responsive">
                    <table class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead style="background-color:#12205F;color: #FFF">
                        <tr class="text-center">
                          <th> ลำดับ </th>
                          <th> code </th>
                          <th> ชื่อค่าย </th>
                          <th> สถานะคิดเทิร์น </th>

                        </tr>
                      </thead>
                      <?php $i = 1;
                      foreach (json_decode($vender) as $key => $value) {
                        if ($value->type == 3) { ?>
                          <tr class="text-center">
                            <td><?= $i; ?></td>
                            <td><?= $value->vendorCode ?></td>
                            <td><?= $value->VendorName ?></td>
                            <td>
                              <label class="switch">
                                <input type="checkbox" onclick="updatecheckturn(<?= $value->id ?>,this.checked)" <?= ($value->check_turn == 1) ? 'checked' : ''; ?>>
                                <span class="slider round"></span>
                              </label>
                            </td>
                          </tr>

                      <?php $i++;
                        }
                      }  ?>
                    </table>
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
    function updatecheckturn(id, status) {
      $.ajax({
        url: "<?= base_url('backend/turnover/UpdateSatusCheckTurn') ?>",
        method: "POST",
        data: {
          'id': id,
          'status': (status == true) ? 1 : 0
        },
        dataType: 'json',
      }).done(function(res) {
        if (res == 'success') {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          })
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            showConfirmButton: false,
            timer: 800
          })
        }

      });
    }
    function updatesetuser() {
      var value = ($('#valueuserturn').val() == '' || $('#valueuserturn').val() < 0) ? $('#valueuserturn').focus() : $('#valueuserturn').val();
      var name = $('#setuser').val();
      $.ajax({
        url: "<?= base_url('backend/turnover/updatesetuserturn') ?>",
        method: "POST",
        data: {
          'name': name,
          'value': value
        },
        dataType: 'json',
      }).done(function(res) {
        if (res == 'success') {
          $('#' + name).html(value);
          $('#valueuserturn').val('0');
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          })
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            showConfirmButton: false,
            timer: 800
          })
        }

      });
    }
    function updates_setdeposit_turn() {
      var type = $('#type').val();
      var num = (type == 'จำนวน') ? $('#num').val() : 0;
      var equal = (type == 'แบบเท่า') ? $('#num').val() : 0;
      var max = $('#max').val();

      $.ajax({
        url: "<?= base_url('backend/turnover/updates_setdeposit_turn') ?>",
        method: "POST",
        data: {
          'num': num,
          'equal': equal,
          'max': max
        },
        dataType: 'json',
      }).done(function(res) {

        if (res == 'success') {
          $('#type_').html(type);
          $('#set_').html((type == 'จำนวน') ? num : equal);
          $('#max_').html(max);
          $('#max').val(0);
          $('#num').val(0);
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          })
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            showConfirmButton: false,
            timer: 800
          })
        }

      });
    }
 function updateturntopoint() {
      var minTurnPoint = $('#minTurnPoint').val() ;
      var maxTurnPoint = $('#maxTurnPoint').val() ;
      var perPoint = $('#perPoint').val();
      $.ajax({
        url: "<?= base_url('backend/turnover/updateturntopoint') ?>",
        method: "POST",
        data: {
          'minTurnPoint': minTurnPoint,
          'maxTurnPoint': maxTurnPoint,
          'perPoint': perPoint
        },
        dataType: 'json',
      }).done(function(res) {
        console.log(res);
        if (res.minTurnPoint == 'success'|| res.maxTurnPoint == 'success'|| res.perPoint == 'success') {
          if(res.minTurnPoint == 'success'){$('#sh_minTurnPoint').html(minTurnPoint);}
          if(res.maxTurnPoint == 'success'){ $('#sh_maxTurnPoint').html(maxTurnPoint);}
          if(res.perPoint == 'success'){$('#sh_perPoint').html(perPoint);}
          
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          })
          $('#minTurnPoint').val('');
$('#maxTurnPoint').val('');
$('#perPoint').val('');
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            showConfirmButton: false,
            timer: 800
          })
        }

      });
 }

  </script>
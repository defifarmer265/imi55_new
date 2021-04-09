<meta name="viewport" content="width=device-width, initial-scale=1">
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
  .file {
      visibility: hidden;
      position: absolute;
    }
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title"> </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>สร้าง Gift Voucher</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"> <br />
            <form id="formpro" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>ชื่อ</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>จำนวน Credit</label>
                      <input type="number" class="form-control" id="credit" name="credit" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}" onchange="if(this.value>0){ $('#point').val(0); $('#point').attr('disabled',true)}else{$('#point').val(0); $('#point').attr('disabled',false)}" placeholder="จำนวนเครดิต" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>จำนวน Point</label>
                      <input type="number" class="form-control" id="point" name="point" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}" onchange="if(this.value>0){ $('#credit').val(0); $('#credit').attr('disabled',true)}else{$('#credit').val(0); $('#credit').attr('disabled',false)}" placeholder="จำนวนพ้อย" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>ติดเทิร์น</label>
                      <input type="number" class="form-control" id="turnover" name="turnover" placeholder="จำนวนเทิร์น" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>User</label>
                      <select id="user" name="user" class="form-control" required>
                        <option selected>เลือก</option>
                        <option value="0">เก่า</option>
                        <option value="1">สมัครใหม่</option>
                        <option value="2">ทั้งหมด</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">จำนวนคูปอง</label>
                      <input type="number" class="form-control" id="limit_user" name="limit_user" onkeyup="javascript:if(this.value < 0){ this.value= this.value * -1; }" placeholder="จำนวน Gift" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="">โค้ด</label>
                      <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
                        <span class="fa fa-refresh form-control-feedback right text-primary" aria-hidden="true" style="cursor: pointer; " onClick="refresh_code()"></span>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">วันที่เริ่มต้น</label>
                      <input class="form-control" type="datetime-local" id="time_start" name="time_start" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">วันที่หมดอายุ</label>
                      <input class="form-control" type="datetime-local" id="time_end" name="time_end" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                      <div class="form-row">
                        <div class="ml-2 col-sm-6">
                          <label for="">อัฟโหลดรูป</label>
                          <div id="msg"></div>
                          <input type="file" id="img" name="img" class="file" accept="image/*" required>
                          <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                            <div class="input-group-append">
                              <button type="button" class="browse btn btn-primary">เลือก...</button>
                            </div>
                          </div>
                        </div>
                        <div class="ml-2 col-sm-6">
                          <img src="https://placehold.it/100x100" id="preview" class="img-thumbnail">
                        </div>
                      </div>
          </div>
                <div class="col-md-10 col-sm-6"> <br>
                  <div class="item form-group">
                    <div class="col-md-12 col-sm-12 offset-md-6">
                      <button type="reset" class="btn btn-secondary">Reset</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
 
    
 

    </div>
    <hr>
    <div class="col-md-12 col-sm-12 ">
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead style="background-color: #2a3f54;color: #fff;">
                  <tr align="center">
                    <th> No. </th>
                    <th> ชื่อ </th>
                    <th> code </th>
                    <th> point </th>
                    <th> credit </th>
                    <th> ติดเทิร์น(เครดิต) </th>
                    <th> จำนวนกิ๊ฟ </th>
                    <th> user </th>
                    <th> เวลาสร้าง </th>
                    <th> หมดเวลา </th>
                    <th> ผู้สร้าง </th>
                    <th> สถานะ </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  foreach ($gift as $gf) {
                    $id = $gf['id'];
                  ?>
                    <tr align="center" <?= $gf['time_end'] >= time() ? $gf['status'] == 1 || $gf['status'] == '1' ? 'class="table-success"' : 'class="table-secondary"' : 'class="table-secondary"';
                                        ?>>
                      <td><?= $i + 1; ?></td>
                      <td><?= $gf['gift_name']; ?></td>
                      <td><?= $gf['code']; ?></td>
                      <td><?= $gf['point'] != 0 ? number_format($gf['point']) : '-'; ?></td>
                      <td><?= $gf['credit'] != 0 ? number_format($gf['credit']) : '-'; ?></td>
                      <td><?= $gf['turnover'] != 0 ? number_format($gf['turnover']) : '-'; ?></td>
                      <td><?= number_format($gf['limit_user']); ?></td>
                      <td><?= (($gf['user'] == 0) ? 'เก่า' : (($gf['user'] == 1) ? 'ใหม่' : (($gf['user'] == 2) ? 'ทั้งหมด' : ''))) ?></td>
                      <td><?= date('d/m/Y || H:i', $gf['time_start']); ?> น.</td>
                      <td><?= date('d/m/Y || H:i', $gf['time_end']); ?> น.</td>
                      <td><?= $gf['admin']; ?></td>
                      <td>
                        <label class="switch">
                          <input type="checkbox" id="status" onchange="change_status(this.checked,<?= $gf['id']; ?>)" <?= ($gf['status'] == 1) ? 'checked' : ''; ?>>
                          <span class="slider round"></span>
                        </label>
                      </td>
                    </tr>
                  <?php
                    $i++;
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $('#formpro').submit(function(e) {
    e.preventDefault();
    var data = new FormData($('#formpro')[0]);
    $.ajax({
      method: "POST",
      enctype: 'multipart/form-data',
      url: "<?= base_url('backend/gift/insert_gift') ?>",
      data: data,
      processData: false,
      contentType: false,
      dataType: 'json',
    }).done(function(res) {
      console.log(res);
      if (res.code == 1) {
        $('#formpro')[0].reset();
        swal('', res.msg, "success").then((value) => {
          setTimeout(function() {
            window.location.href = "<?php base_url('backend/gift/create_gift') ?>";
          }, 500);
        });
      }
    });

  })

  function change_status(data, gift_id) {

    if (data) {
      var status = 1;
    } else {
      var status = 0;
    }
    $.ajax({
      url: 'active_gift',
      type: 'POST',
      dataType: 'json',
      data: {
        gift_id: gift_id,
        status: status
      }
    }).done(function(res) {
      console.log(res);
    });
  }


  function refresh_code() {
    let abc = "abcdefghijklmnopqrstuvwxyz1234567890".split("");
    var token = "";
    for (i = 0; i < 5; i++) {
      token += abc[Math.floor(Math.random() * abc.length)];
    }
    $('#code').val(token);
  }

  $(document).on("click", ".browse", function() {
      var file = $(this).parents().find(".file");
      file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
      var fileName = e.target.files[0].name;
      $("#file").val(fileName);

      var reader = new FileReader();
      reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    });
</script>
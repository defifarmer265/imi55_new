<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 25px;
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
    /* left: 4px; */
    /* bottom: 4px; */
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
    border: 1px solid crimson;
  }

  .file {
    visibility: hidden;
    position: absolute;
  }
</style>


<div class="right_col" role="main">
  <div class="">
    <div class="page-title">

    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2> สร้าง Event <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="formevent" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              <input type="hidden" id="idedit" name="idedit">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="">ชื่อ</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อ" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">วันที่เริ่ม</label>
                      <input class="form-control" type="datetime-local" id="time_start" name="time_start" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">วันที่สิ้นสุด</label>
                      <input class="form-control" type="datetime-local" id="time_end" name="time_end" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="">ประเภทเทิร์น</label>
                      <select id="type_turn" name="type_turn" class="form-control" onchange="javascript:if(this.value ==0){ $('#turn').val(0); $('#turn').attr('readonly',true);}
                      else{$('#turn').attr('readonly',false);}" required>
                        <option selected>เลือก</option>
                        <option value="0">ไม่ติดเทิร์น</option>
                        <option value="1">กำหนดเทิ่ร์นเอง</option>
                        <option value="2">เทิร์นเป็นเท่า</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">เทิร์น</label>
                      <input type="number" class="form-control" id="turn" name="turn" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}; " required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputState">เงื่อนไขยูสเซอร์</label>
                      <select id="user" name="user" class="form-control" required>
                        <option selected>เลือก</option>
                        <option value="1"> userเก่า </option>
                        <option value="2"> userใหม่ </option>
                        <option value="3"> userทั่งหมด </option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="">เครดิต</label>
                      <input type="number" class="form-control" id="credit" name="credit" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}; 
                      if(this.value > 0){ $('#point').val(0);  $('#point').attr('readonly',true);  $('#percent').val(0);  $('#percent').attr('readonly',true); $('#amount_max').val(0);  $('#amount_max').attr('readonly',true);}
                      else{$('#point').attr('readonly',false); $('#percent').attr('readonly',false); $('#amount_max').attr('readonly',false);}" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">เปอร์เซ็นต์</label>
                      <input type="number" class="form-control" id="percent" name="percent" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}; 
                      if(this.value > 0){ $('#point').val(0);  $('#point').attr('readonly',true);  $('#credit').val(0);  $('#credit').attr('readonly',true);}
                      else{$('#point').attr('readonly',false); $('#credit').attr('readonly',false);}" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">เครดิตสูงสุด(เปอร์เซ็นต์)</label>
                      <input type="number" class="form-control" id="amount_max" name="amount_max" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}; 
                      if(this.value > 0){ $('#point').val(0);  $('#point').attr('readonly',true); $('#credit').val(0);  $('#credit').attr('readonly',true); }
                      else{$('#point').attr('readonly',false); $('#credit').attr('readonly',false);}" required>
                    </div>

                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="">พ้อย</label>
                      <input type="number" class="form-control" id="point" name="point" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}; 
                      if(this.value > 0){ $('#credit').val(0);  $('#credit').attr('readonly',true); $('#percent').val(0);  $('#percent').attr('readonly',true); $('#amount_max').val(0);  $('#amount_max').attr('readonly',true); }
                      else{$('#credit').attr('readonly',false); $('#percent').attr('readonly',false); $('#amount_max').attr('readonly',false);}" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">ยอดฝากขั้นต่ำ</label>
                      <input type="number" class="form-control" id="deposit" name="deposit" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">จำนวนสิทธ์</label>
                      <input type="number" class="form-control" id="count" name="count" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};" required>
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-8">
                      <div class="form-group">
                        <label for="">รายละเอียด</label>
                        <textarea type="text" class="form-control" id="detail" name="detail" placeholder="รายละเอียด" rows="5" required></textarea>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">แสดงกลุ่ม</label>
                      <div class="checkbox">
                        <?php foreach (json_decode($groupuser) as $key => $value) { ?>
                          <label>
                            <input type="checkbox" id="group<?= $value->id ?>" name="user_group[]" value="<?= $value->id; ?>">
                            <?= $value->name; ?>
                          </label>
                        <?php } ?>
                      </div>
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
                          <button type="button" class="browse btn btn-primary">เลือก</button>
                        </div>
                      </div>
                    </div>
                    <div class="ml-2 col-sm-6">
                      <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
                    </div>
                  </div>
                </div>
                <div class="item form-group">
                  <div class="col-md-12 col-sm-6 offset-md-5">
                    <button class="btn btn-danger" type="button" onclick="$('#btnedit').hide();$('#btnsubmit').show()">Cancel</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" id="btnsubmit" class="btn btn-success">Submit</button>
                    <button type="buton" id="btnedit" class="btn btn-warning">edit</button>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <?php
      foreach (json_decode($event) as $key => $value) { ?>

        <div class="col-md-6 event_del" id="event<?= $value->id ?>" data-list="<?= htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>">
          <div class="x_panel">
            <div class="x_title">
              <h2><?= $value->name; ?>
                <label class="switch">
                  <input type="checkbox" <?= ($value->status == 1) ? 'checked' : ''; ?> onchange="javascript:(this.checked)?$('#sh_st<?= $value->id ?>').html('เปิดใช้'):$('#sh_st<?= $value->id ?>').html('ปิดใช้');sentupdate_status(this.checked,<?= $value->id ?>)">
                  <span class="slider round"></span>
                </label><small id="sh_st<?= $value->id ?>"><?= ($value->status == 1) ? 'เปิดใช้' : 'ปิดใช้'; ?></small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                </li>
                <li><a class=""><i class="fa fa-wrench"></i></a>
                </li>
                <li class="dropdown">
                  <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> -->
                  <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">แก้ไข</a>
          </div> -->
                </li>

                <!-- close-link -->
                <li><a class=""><i class="fa fa-trash"></i></a></li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: none;">
              <div class="row">
                <div class="col-sm-6">
                  <img src="<?= base_url('public/event/' . $value->link_img) ?>" width="100%">
                </div>
                <div class="col-sm-6">
                  <b>รายละเอียด :</b> <?= $value->detail_event; ?> <br>
                  <b>ประเภทเทิร์น :</b> <?php if ($value->type_turnover == 0) {
                                          echo ' ไม่ติดเทิร์น ';
                                        } elseif ($value->type_turnover == 1) {
                                          echo ' เทิร์นแบบกำหนดเอง ';
                                          echo ' จำนวน' . $value->turnover . ' เครดิต ';
                                        } else {
                                          echo ' เทิร์นเป็นจำนวนเท่าของเครดิตที่แจก ';
                                          echo $value->sum_turn . ' เท่า ';
                                        } ?> <br>
                  <b>วันที่เริ่ม - วันที่สิ้นสุด :</b> <?= date('d/m/Y', $value->time_start); ?> -
                  <?= date('d/m/Y', $value->time_end); ?> <br>
                  <b>จำนวนสิทธิ์(คงเหลือ/ทั้งหมด) :</b> <?= $value->count; ?>/<?= $value->count_max; ?>
                  <br>
                  <?php if ($value->credit != 0) { ?>
                    <b>เครดิต :</b> <?= $value->credit; ?> เครดิต<br>
                  <?php } ?>
                  <?php if ($value->point != 0) { ?>
                    <b>พ้อย :</b> <?= $value->point; ?> พ้อย<br>
                  <?php } ?>
                  <b>แสดงกลุ่ม :</b> <?php $user_group = explode(',', $value->user_group);
                                      foreach (($user_group) as $k => $v) {
                                        foreach (json_decode($groupuser) as $key => $value) {
                                          if ($v == $value->id) {
                                            echo $value->name . " / ";
                                          }
                                        }
                                      }
                                      ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $(function() {
    $('#btnedit').hide();
  });
  $('#formevent').submit(function(e) {
    e.preventDefault();

    var data = new FormData($('#formevent')[0]);
    data.append('file', $('#img')[0].files[0]);

    $.ajax({
        method: "POST",
        enctype: 'multipart/form-data',
        url: "<?= base_url('backend/events_back/save_event') ?>",
        data: data,
        processData: false,
        contentType: false,
        dataType: 'json',
      })
      .done(function(msg) {
        Swal.fire({
          icon: 'success',
          showConfirmButton: false,
          timer: 800
        }).then((value) => {
          window.location.href = "<?= base_url('backend/events_back') ?>";
        });
      });
  });

  // ==========  delete ==============
  $('.fa-trash').on("click", function() {
    var div = $(this).parents('.event_del');
    var id = (div[0].id).slice(5);
    $.ajax({
        method: "POST",
        url: "<?= base_url('backend/events_back/delpro') ?>",
        data: {
          id: id
        },
        dataType: 'json',
      })
      .done(function(msg) {
        if (msg.status) {
          $('#pro' + id).remove();
        }
      });
  });
  // ==========  edit ==============
  $('.fa-wrench').on("click", function() {
    var div = $(this).parents('.col-md-6');
    var id = (div[0].id).slice(3);
    $('#btnsubmit').hide();
    $('#btnedit').show();
    var data = $(div).data('list');
    console.log(data);
    $('#idedit').val(data.id);
    $('#name').val(data.name);
    $('#time_start').val(chtime(data.time_start));
    $('#time_end').val(chtime(data.time_end));
    if (data.game != 0 || data.game != "0" || data.game != null || data.game != "") {
      $('#typegame  option[value="1"]').attr("selected", true);
      $('#number').val(data.game);
    }
    if (data.casino != 0 || data.casino != "0" || data.casino != null || data.casino != "") {
      $('#typegame  option[value="2"]').attr("selected", true);
      $('#number').val(data.casino);
    }
    if (data.sport != 0 || data.sport != "0" || data.sport != null || data.sport != "") {
      $('#typegame  option[value="3"]').attr("selected", true);
      $('#number').val(data.sport);
    }
    if (data.sum_turn != 0 || data.sum_turn != "0" || data.sum_turn != null || data.sum_turn != "") {
      $('#typegame  option[value="0"]').attr("selected", true);
      $('#number').val(parseInt(data.sum_turn));
    }

    $('#detail_pro').val(data.detail_pro);
    $('#count_pro').val(data.count_pro);
    var group = (data.user_group).split(",");
    $.each(group, function(index, value) {
      $('#group' + value).prop("checked", true);
    });

    $('#percent').val(data.percent);
    $('#bonus').val(data.bonus);
    $('#type').val(data.type);
    $('#amount_max').val(data.amount_max);
    // $('#img').val(data.link_img);
    // $('#file').val(data.link_img);
    $('#preview').attr("src", "<?= base_url('public/promotion/') ?>" + data.link_img);
  });

  // ==========  updatestatus ==============
  function sentupdate_status(ch, id) {
    // console.log(ch,id);
    $.ajax({
        method: "POST",
        url: "<?= base_url('backend/events_back/updataStatus') ?>",
        data: {
          ch: ch,
          id: id
        },
        dataType: 'json',
      })
      .done(function(msg) {
        // console.log(msg);
        if (msg.status) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          })
        }
      });
  }


  function chtime(unix_timestamp) {
    var date = new Date(unix_timestamp * 1000);
    var year = date.getFullYear();
    var month = "0" + date.getMonth() + 1;
    var date = "0" + date.getDate();
    var formattedTime = year + '-' + month.substr(-2) + '-' + date.substr(-2);
    return (formattedTime);
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
  <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('tem_frontend'); ?>select/dist/css/bootstrap-select.css">
  <link href="<?php echo $this->config->item('tem_frontend'); ?>select/dist/bootstrap.min.select.css" rel="stylesheet">
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->config->item('tem_frontend'); ?>select/dist/js/bootstrap-select.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


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
        <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2> สร้าง Promotion <small></small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form id="formpro" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?= base_url('backend/setpromo/savepro') ?>" enctype="multipart/form-data">
                <input type="hidden" id="idedit" name="idedit">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="">ชื่อโปรโมชั่น</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="โปรโมชั่น" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">วันที่เริ่มโปร</label>
                        <input class="form-control" type="datetime-local" id="time_start" name="time_start" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">วันที่สิ้นสุดโปร</label>
                        <input class="form-control" type="datetime-local" id="time_end" name="time_end" required>
                      </div>

                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="">วันที่แสดง</label>
                        <select id="day_show" name="day_show[]" class="selectpicker show-menu-arrow form-control" multiple data-max-options="7">
                          <option value="0">อาทิตย์</option>
                          <option value="1">จันทร์</option>
                          <option value="2">อังคาร</option>
                          <option value="3">พุธ</option>
                          <option value="4">พฤหัสบดี</option>
                          <option value="5">ศุกร์</option>
                          <option value="6">เสาร์</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">เวลาเริ่มแสดง</label>
                        <input class="form-control" type="time" id="time_start_show" name="time_start_show" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">เวลาสิ้นสุดแสดง</label>
                        <input class="form-control" type="time" id="time_end_show" name="time_end_show" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="">ประเภทเทิร์น</label>
                        <select id="typegame" name="typegame" class="form-control" required>
                          <option selected>เลือก</option>
                          <option value="0">รวม</option>
                          <option value="1">เกมส์</option>
                          <option value="2">คาสิโน</option>
                          <option value="3">กีฬา</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">จำนวนเทิร์น(เท่า)</label>
                        <input type="number" class="form-control" id="number" name="num" placeholder="0" onkeyup="javascript:if(this.value<0){this.value= this.value * -1}; 
                      if(this.value > 0){ $('#credit_turn').val(0); $('#credit_turn').attr('readonly',true);}
                      else{$('#credit_turn').attr('readonly',false); }" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">เครดิตติดเทิร์น</label>
                        <input type="number" class="form-control" id="credit_turn" placeholder="0" name="credit_turn" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};
                      if(this.value > 0){ $('#number').val(0); $('#number').attr('readonly',true);}
                      else{$('#number').attr('readonly',false); }" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="">จำนวนโบนัส</label>
                        <input type="number" class="form-control" id="bonus" name="bonus" placeholder="จำนวน(เครดิต)" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};
                      if(this.value > 0){ $('#percent').val(0); $('#percent').attr('readonly',true); $('#amount_max').val(0); $('#amount_max').attr('readonly',true);}
                      else{$('#percent').attr('readonly',false); $('#amount_max').attr('readonly',false);}" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">จำนวนเปอร์เซ็น</label>
                        <input type="number" class="form-control" id="percent" name="percent" placeholder="จำนวน(เปอร์เซ็นต์)" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};
                      if(this.value > 0){ $('#bonus').val(0); $('#bonus').attr('readonly',true); }
                      else{$('#bonus').attr('readonly',false); }" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">จำนวนเครดิตสูงสุด</label>
                        <input type="number" class="form-control" id="amount_max" name="amount_max" placeholder="เครดิต" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};
                     if(this.value > 0){ $('#bonus').val(0); $('#bonus').attr('readonly',true); }
                      else{$('#bonus').attr('readonly',false); }" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="">เครดิตขั้นต่ำรับโปร</label>
                        <input type="number" class="form-control" id="min_creadit" name="min_creadit" placeholder="เครดิต" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">จำนวนคนสูงสุด(0 ไม่จำกัด)</label>
                        <input type="number" class="form-control" id="count_pro" placeholder="0" name="count_pro" onkeyup="javascript:if(this.value<0){this.value= this.value * -1};" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputState">เงื่อนไข</label>
                        <select id="type" name="type" class="form-control" required>
                          <option selected>เลือก</option>
                          <option value="1"> ครั้งเดียว </option>
                          <option value="2"> ต่อวัน </option>
                          <option value="3"> ต่อสัปดาห์ </option>
                          <option value="4"> ต่อเดือน </option>
                        </select>
                      </div>

                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                        <div class="form-group">
                          <label for="">รายละเอียด</label>
                          <textarea type="text" class="form-control" id="detail_pro" name="detail_pro" placeholder="รายละเอียด" rows="5" required></textarea>
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="">แสดงกลุ่ม</label>
                        <div class="checkbox">
                          <?php foreach (json_decode($groupuser) as $key => $value) { ?>
                            <label>
                              <input type="checkbox" id="group<?= $value->id ?>" name="user_group[]" value="<?= $value->id; ?>"> <?= $value->name; ?>
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
                            <button type="button" class="browse btn btn-primary">เลือก...</button>
                          </div>
                        </div>
                      </div>
                      <div class="ml-2 col-sm-6">
                        <img src="https://placehold.it/100x100" id="preview" class="img-thumbnail">
                      </div>
                    </div>
                  </div>


                  <div class="item form-group">

                    <div class="col-md-12 col-sm-6 offset-md-5">
                      <hr>
                      <button class="btn btn-danger" type="reset" onclick="$('#btnedit').hide();$('#btnsubmit').show();$('#img').attr('required',true);$('#preview').attr('src','https:\/\/placehold.it/100x100');">Cancel</button>
                      <button class="btn btn-primary" type="reset" onclick="$('#preview').attr('src','https:\/\/placehold.it/100x100');">Reset</button>
                      <button type="submit" id="btnsubmit" class="btn btn-success">Submit</button>
                      <button type="submit" id="btnedit" class="btn btn-warning">edit</button>

                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <div class="row" id="showpro">

        <?php
        foreach (json_decode($promo) as $key => $value) { ?>

          <div class="col-md-6 " id="pro<?= $value->id ?>" data-list="<?= htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>">
            <div class="x_panel">
              <div class="x_title">
                <h2><?= $value->name; ?> <small><?php switch ($value->type) {
                                                  case '1':
                                                    echo 'ทุกยอดฝาก';
                                                    break;
                                                  case '2':
                                                    echo 'ยอดแรกของวัน';
                                                    break;
                                                  case '3':
                                                    echo 'ยอดแรกของสัปดาห์';
                                                    break;
                                                  case '4':
                                                    echo 'ยอดแรกสมัคร';
                                                    break;
                                                  default:

                                                    break;
                                                } ?></small>
                  <label class="switch">
                    <input type="checkbox" <?= ($value->status == 1) ? 'checked' : ''; ?> onchange="javascript:(this.checked)?$('#sh_st<?= $value->id ?>').html('เปิดใช้'):$('#sh_st<?= $value->id ?>').html('ปิดใช้');sentupdate_status(this.checked,<?= $value->id ?>)">
                    <span class="slider round"></span>
                  </label><small id="sh_st<?= $value->id ?>"><?= ($value->status == 1) ? 'เปิดใช้' : 'ปิดใช้'; ?></small>
                </h2>

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
                    <img src="<?= base_url('public/promotion/' . $value->link_img) ?>" width="100%">
                  </div>
                  <div class="col-sm-6">
                    <b>รายละเอียด :</b> <?= $value->detail_pro; ?> <br>
                    <b>ประเภทเทิร์น :</b> <?php if ($value->casino != '0') {
                                            echo ' เทิร์นคาสิโน ';
                                            echo $value->casino . ' เท่า ';
                                          } else if ($value->game != '0') {
                                            echo ' เทิร์นเกม ';
                                            echo $value->game . ' เท่า ';
                                          } else if ($value->sport != '0') {
                                            echo ' เทิร์นกีฬา ';
                                            echo $value->sport . ' เท่า ';
                                          } else if ($value->sum_turn) {
                                            echo ' เทิร์นรวม ';
                                            echo $value->sum_turn . ' เท่า ';
                                          } else {
                                            echo ' เทิร์นรวม ';
                                            echo $value->amount_turn . ' เครดิต ';
                                          } ?> <br>

                    <b>วันที่เริ่มโปร - วันที่สิ้นสุดโปร :</b> <?= date('d/m/Y', $value->time_start); ?> - <?= date('d/m/Y', $value->time_end); ?> <br>
                    <b>จำนวนสิทธิ์โปรโมชั่น :</b> <?= $value->count_pro; ?> <br>
                    <?php if ($value->percent != 0) { ?>
                      <b>เปอร์เซ็น :</b> <?= $value->percent; ?> % <br>
                      <b>สูงสุด :</b> <?= $value->amount_max; ?> เครดิต<br>
                    <?php } ?>
                    <?php if ($value->bonus != 0) { ?>
                      <b>โบนัส :</b> <?= $value->bonus; ?> เครดิต<br>
                    <?php } ?>

                    <b>เครดิตขั้นต่ำในการรับโปร :</b> <?= $value->min_creadit; ?> เครดิต<br>
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

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    $(function() {
      $('#btnedit').hide();
    });


    // ==========  delete ==============
    $('.fa-trash').on("click", function() {
      if (confirm('ยืนยันการลบ')) {
        var div = $(this).parents('.col-md-6');
        var id = (div[0].id).slice(3);
        $.ajax({
            method: "POST",
            url: "<?= base_url('backend/setpromo/delpro') ?>",
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
      }


    });


    // ==========  edit ==============
    $('.fa-wrench').on("click", function() {
    
      $('#img').removeAttr('required');
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
      var day_show = (data.day_show).split(",")
      $('#day_show').val(day_show);
      $.each(day_show, function(index, value) {
        $('li[data-original-index="' + value + '"]').attr("class", "selected");
      });
      var txt_day_show = '';
      $.each(document.querySelectorAll('li[class="selected"]'), function(index, value) {
        txt_day_show += (value.outerText) + ',';
      });
      $('span[class="filter-option pull-left"]').text(txt_day_show.slice(0, -1));

      $('#time_end_show').val((data.time_end_show).slice(0, 2) + ':' + (data.time_end_show).slice(-2));
      $('#time_start_show').val((data.time_start_show).slice(0, 2) + ':' + (data.time_start_show).slice(-2));


      $('#credit_turn').val(data.amount_turn);
      $('#detail_pro').val(data.detail_pro);
      $('#count_pro').val(data.count_pro);
      var group = (data.user_group).split(",");
      $.each(group, function(index, value) {
        $('#group' + value).prop("checked", true);
      });

      $('#percent').val(data.percent);
      $('#bonus').val(data.bonus);
      $('#min_creadit').val(data.min_creadit);
      $('#type').val(data.type);
      $('#amount_max').val(data.amount_max);
      // $('#img').val(null);
      // $('#file').val(data.link_img);
      $('#preview').attr("src", "<?= base_url('public/promotion/') ?>" + data.link_img);
      $('#formpro').attr("action", "<?= base_url('backend/setpromo/updatepro') ?>");
    });

    // ==========  updatestatus ==============
    function sentupdate_status(ch, id) {
      // console.log(ch,id);
      $.ajax({
          method: "POST",
          url: "<?= base_url('backend/setpromo/updataStatus') ?>",
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
      // return moment.unix(unix_timestamp).format("YYYY-MM-DDTHH:M");
      var date = new Date(unix_timestamp * 1000);
      var year = date.getFullYear();
      var month = "0" + parseInt(date.getMonth() + 1);
      var day = "0" + date.getDate();
      var hours = "0" + date.getHours();
      var minutes = "0" + date.getMinutes();
      // 2020-12-18T11:51
      var formattedTime = year + '-' + month.substr(-2) + '-' + day.substr(-2) + 'T' + hours.substr(-2) + ':' + minutes.substr(-2);
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
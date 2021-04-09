<style>
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

  .lds-dual-ring {}

  .lds-dual-ring:after {
    content: " ";
    display: block;
    width: 30px;
    height: 30px;
    padding-bottom: -20px;
    border-radius: 50%;
    border: 6px solid #000;
    border-color: #000 transparent #000 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }

  @keyframes lds-dual-ring {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .trhover:hover {
    background-color: aquamarine !important;
  }

  .trhover {
    cursor: pointer;
  }
</style>
<div id="cover-spin"></div>
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ชั้นยศ</h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr>
                        <th>name</th>
                        <th>trunover</th>
                        <th>point</th>
                        <th>spin</th>
                        <th>sale</th>
                        <th>reward_premium</th>
                        <th>reward_exclusive</th>
                        <th>img_link</th>
                      </tr>
                    </thead>
                    <tbody >
                      <?php foreach ($rank as $key => $value) {  ?>
                        <tr align="center" class="trhover" data-placement="bottom" title="คลิ๊ก! แก้ไข" data-toggle="modal" data-target="#editModal" data-rank="<?= htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>">
                          <td><?= $value['name']; ?></td>
                          <td><?= $value['trunover']; ?></td>
                          <td><?= $value['point']; ?></td>
                          <td><?= $value['spin']; ?></td>
                          <td><?= $value['sale']; ?></td>
                          <td><?= $value['reward_premium']; ?></td>
                          <td><?= $value['reward_exclusive']; ?></td>
                          <td><img width="15%" src="<?= base_url('public/rank/' . $value['img_link']); ?>"></td>
                        </tr>
                      <?php  }   ?>
                      <tr id="addrank" align="center">
                      <td colspan="8"><button class="btn btn-info" data-toggle="modal" data-target="#addtModal"><i class="fa fa-plus fa-1x" aria-hidden="true" ></button></i></td>
                      </tr>
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
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายงาน ชั้นยศ</h2>
          <div class="col-sm-2">
            <select class="form-control" onchange="sentS(1);" id="rank">
              <?php foreach ($rank as $key => $value) {  ?>
                <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
              <?php  }   ?>
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <!-- id="datatable-responsive" -->
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr>
                        <th>No</th>
                        <th>user_id</th>
                        <th>promotion_id</th>
                        <th>before_creadit</th>


                      </tr>
                    </thead>
                    <tbody id="dataTB">
                      <?php $user = json_decode($user);
                      $i = 1;
                      foreach ($user->user as $key => $val) { ?>

                        <tr align="center">
                          <td><?= $i; ?></td>
                          <td><?= $val->user; ?></td>
                          <td><?= $val->name; ?></td>
                          <td><?= $val->total_turnover; ?></td>

                        </tr>
                      <?php $i++;
                      } ?>
                    </tbody>
                  </table>

                  <div class="col-sm-1 form-inline">
                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label col-form-label-sm">แสดง</label>
                      <div class="col-sm-10">
                        <select id="Per_Page" class="form-control" onchange="sentS(1);">
                          <option <?php if ($user->Per_Page == 10) {
                                    echo "selected";
                                  } ?>>10</option>
                          <option <?php if ($user->Per_Page == 20) {
                                    echo "selected";
                                  } ?>>20</option>
                          <option <?php if ($user->Per_Page == 50) {
                                    echo "selected";
                                  } ?>>50</option>
                          <option <?php if ($user->Per_Page == 100) {
                                    echo "selected";
                                  } ?>>100</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="row" id="navv">
                    <div class="col-sm-6">
                      <span>รายการ :: <?php echo $user->Num_Rows; ?></span>
                      <p>หน้า ( <?= $user->Num_Pages; ?> )</p>
                    </div>
                    <div class="col-sm-6">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <!-- ก่อนหน้า -->
                          <li class='page-item'><a class='page-link' onclick="sentS(1);">
                              << </a> </li> <?php

                                            $Prev_Page = $user->Page - 1;
                                            $Next_Page = $user->Page + 1;
                                            if ($Prev_Page) {
                                              echo "<li class='page-item'><a class='page-link' onclick='sentS($Prev_Page);'> ก่อนหน้า </a></li> ";
                                            }
                                            ?> <!-- เลขหน้า -->
                                <?php

                                if ($user->Page <= 6) {
                                  for ($i = 1; $i <= 10; $i++) {
                                    if ($i != $user->Page) {
                                      echo "<li class='page-item'><a class='page-link' onclick='sentS($i);'>$i</a>&nbsp;&nbsp;";
                                    }
                                    if ($i == $user->Page) {
                                      echo "<li class='page-item active'><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                    }
                                  }
                                } else if ($user->Page + 4 <= $user->Num_Pages) {

                                  for ($i = $user->Page - 5; $i <= $user->Page + 4; $i++) {
                                    if ($i != $user->Page) {
                                      echo "<li class='page-item '><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                    }
                                    if ($i == $user->Page) {
                                      echo "<li class='page-item active'><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                    }
                                  }
                                } else {
                                  for ($i = $user->Page - 5; $i <= $user->Num_Pages; $i++) {
                                    if ($i != $user->Page) {
                                      echo "<li class='page-item '><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                    }
                                    if ($i == $user->Page) {
                                      echo "<li class='page-item active'><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                    }
                                  }
                                }
                                ?>
                                <!-- ถัดไป -->
                                <?php
                                if ($user->Page != $user->Num_Pages) {
                                  echo "<li class='page-item'><a class='page-link' onclick='sentS($Next_Page);'> ถัดไป </a></li>";
                                }
                                ?>
                          <li class='page-item'><a class='page-link' onclick='sentS(<?= $user->Num_Pages; ?>);'> >> </a></li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- add -->
<div class="modal fade" id="addtModal" tabindex="-1" role="dialog" aria-labelledby="addtModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addtModalLabel">เพิ่ม</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formadd" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">name:</label>
                <input type="text" class="form-control" name="nameRank" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">trunover:</label>
                <input type="number" class="form-control" name="trunoverRank" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">point:</label>
                <input type="number" class="form-control" name="pointRank" step="0.01" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">spin:</label>
                <input type="number" class="form-control" name="spinRank" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">sale:</label>
                <input type="number" class="form-control" name="saleRank" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">reward_premium:</label>
                <input type="number" class="form-control" name="reward_premiumRank" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">reward_exclusive:</label>
                <input type="number" class="form-control" name="reward_exclusiveRank" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-form-label">อัฟโหลดรูป</label>
                <div id="msg"></div>
                <input type="file" id="imgadd" name="imgadd" class="file" accept="image/*" required hidden>
                <input type="text" class="form-control" disabled placeholder="อัปเดทใหม่" id="fileadd" required>
                <button type="button" class="browse btn btn-primary">เลือก...</button>
              </div>
            </div>
            <div class="col-md-6" align="center">
              <div class="form-group">
                <img src="http://placehold.it/100x100" width="50%" id="previewadd" class="img-thumbnail">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-primary">บันทึก</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- แก้ไข -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">แก้ไข</h5>
              <i class="fa fa-trash close fa-2x" aria-hidden="true" id="iddel"  onclick="(confirm('ยืนยันการลบ'))?delrank(this):false;">ลบ</i>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formupdate" enctype="multipart/form-data">
           <input hidden name="idedit" id="idedit" >                     
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">name:</label>
                <input type="text" class="form-control" name="nameRank" id="nameRank">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">trunover:</label>
                <input type="number" class="form-control" name="trunoverRank" id="trunoverRank">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">point:</label>
                <input type="number" class="form-control" name="pointRank" id="pointRank" step="0.01">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">spin:</label>
                <input type="number" class="form-control" name="spinRank" id="spinRank">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">sale:</label>
                <input type="number" class="form-control" name="saleRank" id="saleRank">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">reward_premium:</label>
                <input type="number" class="form-control" name="reward_premiumRank" id="reward_premiumRank">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="col-form-label">reward_exclusive:</label>
                <input type="number" class="form-control" name="reward_exclusiveRank" id="reward_exclusiveRank">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-form-label">อัฟโหลดรูป</label>
                <div id="msg"></div>
                <input type="file" id="img" name="img" class="file" accept="image/*"  hidden>
                <input type="text" class="form-control" disabled placeholder="อัปเดทใหม่" id="file">
                <button type="button" class="browse btn btn-primary">เลือก...</button>
              </div>
            </div>
            <div class="col-md-6" align="center">
              <div class="form-group">
                <img src="http://placehold.it/100x100" width="50%" id="preview" class="img-thumbnail">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-primary">แก้ไข</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">

  $(document).ready(function() {
    
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#dataTB tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    $(document).on("click", ".browse", function() {
      var file = $(this).parents().find(".file");
      file.trigger("click");
    });
    $('#img').change(function(e) {
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
    $('#imgadd').change(function(e) {
      var fileName = e.target.files[0].name;
      $("#fileadd").val(fileName);

      var reader = new FileReader();
      reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("previewadd").src = e.target.result;
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    });

    $('.trhover').on('click', function() {
      var d = $(this).data('rank');
      $('#iddel').removeAttr('data-iddel');
      $('#iddel').attr('data-iddel',d.id);
      $('#idedit').val(d.id);
      $('#nameRank').val(d.name);
      $('#trunoverRank').val(d.trunover);
      $('#pointRank').val(d.point);
      $('#spinRank').val(d.spin);
      $('#saleRank').val(d.sale);
      $('#reward_premiumRank').val(d.reward_premium);
      $('#reward_exclusiveRank').val(d.reward_exclusive);
      $('#preview').attr('src', '<?= base_url("public/rank/") ?>' + d.img_link);
    });
    // ====================== add
    $('#formadd').on('submit',function (e) {
  e.preventDefault();
  var data = new FormData($('#formadd')[0]);
   data.append('file', $('#imgadd')[0].files[0]);
   $.ajax({
          method: "POST",
          enctype: 'multipart/form-data',
          url: "<?= base_url('backend/ranking/addrank') ?>",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
        })
        .done(function(msg) {
          $('#addtModal').modal('hide');
          // $("[data-dismiss=modal]").trigger({ type: "click" });
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          });
          window.location.href = '<?=base_url('backend/ranking')?>';

        });
});
// =============  update
$('#formupdate').on('submit',function (e) {
  e.preventDefault();
  var data = new FormData($('#formupdate')[0]);
   data.append('file', $('#img')[0].files[0]);
   $.ajax({
          method: "POST",
          enctype: 'multipart/form-data',
          url: "<?= base_url('backend/ranking/editrank') ?>",
          data: data,
          processData: false,
          contentType: false,
          dataType: 'json',
        })
        .done(function(msg) {
          $('#editModal').modal('hide');
          // $("[data-dismiss=modal]").trigger({ type: "click" });
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          });
          window.location.href = '<?=base_url('backend/ranking')?>';

        });
});



  });  
  function delrank(id) {
    nid = ($(id)[0].dataset.iddel);
    console.log(nid);
    $.ajax({
          method: "POST",
          url: "<?= base_url('backend/ranking/delrank') ?>",
          data: {id:nid},
          dataType: 'json',
        })
        .done(function(msg) {
          $('#editModal').modal('hide');
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 800
          });
          window.location.href = '<?=base_url('backend/ranking')?>';

        });
  }
  function addrank() {
    // $( '<tr align="center">  <td colspan="8">ghjghhjfghfghfg</td>  </tr>' ).insertBefore( "#addrank" );

  }
  function sentS(Page) {
    document.getElementById('dataTB').innerHTML = "";
    $.ajax({
      type: "POST",
      url: '<?= base_url('backend/ranking/get_member'); ?>',
      data: {
        Page: Page,
        Per_Page: $('#Per_Page').val(),
        search: $('#search').val(),
        rank: $('#rank').val()
      },
      success: function(d) {
        console.log(d);
        var dataTB = ``;
        $.each(d.user, function(index, val) {
          dataTB += `<tr align="center">
                          <td>` + (index + 1) + `</td>
                          <td>` + val.user + `</td>
                          <td>` + val.name + `</td>
                          <td>` + val.total_turnover + `</td>
                        </tr>`;

        });

        $('#dataTB').html(dataTB);

        // ทำหน้า/เพจ
        $('#navv').html('');
        var Page = parseInt(d.Page);
        var Prev_Page = Page - 1;
        var Next_Page = Page + 1;
        var Num_Pages = parseInt(d.Num_Pages);
        var Num_Rows = parseInt(d.Num_Rows);

        var navv = `
          <div class="col-sm-6">
                    <span>รายการ :: ` + Num_Rows + `</span>
                    <p>หน้า ( ` + Num_Pages + ` )</p>
                  </div>
                  <div class="col-sm-6">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">`;
        if (!(Num_Rows <= d.Per_Page)) {
          navv += `<li class='page-item'><a class='page-link' onclick='sentS(1);'> << </a></li>`;
          if (Prev_Page) {
            navv += `<li class='page-item'><a class='page-link' onclick='sentS(` + Prev_Page + `);'> ก่อนหน้า </a></li> `;
          }

          if (Page <= 6) {
            if (Num_Pages >= 10) {
              for (var i = 1; i <= 10; i++) {
                if (i != Page) {
                  navv += `<li class='page-item'><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a>&nbsp;&nbsp;`;
                }
                if (i == Page) {
                  navv += `<li class='page-item active'><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a></li>`;
                }
              }
            } else {
              for (var i = 1; i <= Num_Pages; i++) {
                if (i != Page) {
                  navv += `<li class='page-item'><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a>&nbsp;&nbsp;`;
                }
                if (i == Page) {
                  navv += `<li class='page-item active'><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a></li>`;
                }
              }
            }

          } else if ((Page + 4) <= Num_Pages) {

            for (var i = (Page - 5); i <= (Page + 4); i++) {
              if (i != Page) {
                navv += `<li class='page-item '><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a></li>`;
              }
              if (i == Page) {
                navv += `<li class='page-item active'><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a></li>`;
              }
            }
          } else {
            for (var i = (Page - 5); i <= Num_Pages; i++) {
              if (i != Page) {
                navv += `<li class='page-item '><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a></li>`;
              }
              if (i == Page) {
                navv += `<li class='page-item active'><a class='page-link' onclick='sentS(` + i + `);'>` + i + `</a></li>`;
              }
            }
          }

          if (Page != Num_Pages) {
            navv += `<li class='page-item'><a class='page-link' onclick='sentS(` + Next_Page + `);'> ถัดไป </a></li>`;
          }

          navv += `<li class='page-item'><a class='page-link' onclick='sentS(` + Num_Pages + `);'> >> </a></li>`;
        } else {

        }
        navv += `</ul>
                    </nav>
                  </div>`;

        $('#navv').html(navv);
      },
      dataType: 'json'
    });
  }

  function dateToYMD(date) {
    var date = new Date(date * 1000);
    var d = String(date.getDate()).padStart(2, '0');
    var m = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    var Y = date.getFullYear();
    return d + '/' + m + '/' + Y;
  }
</script>
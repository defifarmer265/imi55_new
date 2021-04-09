<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>User<small></small></h2>
      
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
                      <th> No </th>
                      <th> รหัส </th>
                      <th> รหัสเต็ม </th>
                      <th> ชื่อลูกค้า </th>
                      <th> เบอร์โทรลูกค้า </th>
                      <th> คะแนน </th>
                      <th> สปิน </th>
                      <th> วันที่สร้าง </th>

                    </tr>
                  </thead>
                  <tbody id="dataTB">
                   <pre>
                    <?php $i = 1;
                    $user = json_decode($user);
                    foreach ($user->user as $_u => $us) { ?>
                      <tr align="center">
                        <td><?= $i; ?></td>
                        <td><?= substr($us->user,-6); ?></td>
                        <td><?= $us->user; ?></td>
                        <td><?= $us->name; ?></td>
                        <td><?= $us->username ?></td>
                        <td><?= $us->point ?></td>
                        <td><?= $us->spin ?></td>
                        <td><?= date('d-m-y H:i', $us->create_time) ?></td>


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
                    <p>หน้า ( <?=$user->Num_Pages; ?> )</p>
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
  <script>
    function sentS(Page) {
      document.getElementById('dataTB').innerHTML = "";
      $.ajax({
        type: "POST",
        url: '<?=base_url()?>sale/user/get_user',
        data: {
          Page: Page,
          Per_Page: $('#Per_Page').val(),
          search: $('#search').val()

        },
        success: function(d) {
          console.log(d);
          var dataTB = ``;

          $.each(d.user, function(index, val) {
            dataTB += `<tr align="center">
                          <td>` + (index + 1) + `</td>
                          <td>` + val.user.substr(-6) + `</td>
                          <td>` + val.user + `</td>
                          <td>` + val.name + `</td>
                          <td>` + val.username + `</td>
                          <td>` + val.point + `</td>
                          <td>` + val.spin + `</td>
                          <td>` + moment.unix(val.create_time).format("DD/MM/YYYY HH:mm:ss"); + `</td>
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

    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dataTB tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
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
</style>

<div id="cover-spin"></div>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>TURNOVER <small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <form action="checkTurnover" method="POST">
                <div class="form-group row">
                  <div class="col-sm-3"> ID :
                    <?= $this->getapi_model->agent(); ?>
                    Ex: 1234
                    <input type="text" value="" class="form-control" name="user" id="user" maxlength="6" placeholder="รหัสลูกค้า" value="" required>
                  </div>
                  <div class="col-sm-3"> วันเริ่ม
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="d1">
                  </div>
                  <div class="col-sm-3"> วันสิ้นสุด
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="d2">
                  </div>
                  <div class="col-sm-3"><br>
                    <button type="submit" class="btn btn-info" id="sh">ค้นหา</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="row">
              <?php

              if (($data['user']) == '') {
              ?>
                <div class="col-sm-12"> <strong>เลือกข้อมูลที่ต้องการค้นหา</strong> </div>
              <?php } else { ?>
                <div class="col-sm-12"> <B> USER ::
                    <?= $data['user'] ?>
                    วันที่
                    <?= $data['dateF'] ?>
                    ถึง
                    <?= $data['dateE'] ?>
                  </B> </div>
                <hr>
                <div class="col-sm-4">
                  <?php $game = ($game);
                  $dataG = json_decode($game['data']);/*print_r(($game));*/ ?>
                  game Total TurnOver = <B>
                    <?= (isset($dataG->totalTurnover)) ? $dataG->totalTurnover : 0; ?>
                  </B>
                  <hr>
                  <div style="overflow: auto; height: 600px;">
                    <table class="table" id="tableG">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ประเภทเกม</th>
                          <th>เวลาทำรายการ</th>
                          <th>ชนะแพ้</th>
                          <th>เทิร์น</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($game['vender'] as $k => $v) {

                          $g = 1;
                          foreach ($dataG->data as $key => $va) {
                        ?>

                            <?php
                            if ($va != null || $va != '') {
                              if ($va->_id->Vendor == $v['id']) {
                                echo '<tr>';
                                echo '<td>' . $g . '</td>';
                                echo '<td>' . $v['name'] . '</td>';
                                echo '<td>' . date('d/m/y H:i:s', strtotime($va->_id->CreatedTime)) . '</td>';
                                echo '<td>' . $va->totalPlayerWinLoss . '</td>';
                                echo '<td>' . $va->totalTurnover . '</td>';
                                echo '</tr>';
                              }
                            } else {
                            }
                            ?>

                          <?php $g++;
                          } ?>
                        <?php  } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-sm-4">
                  <?php $casino = ($casino);
                  $dataC = json_decode($casino['data']); ?>
                  casino Total TurnOver = <B>
                    <?= (isset($dataC->totalTurnover)) ? $dataC->totalTurnover : 0; ?>
                  </B>
                  <hr>
                  <div style="overflow: auto; height: 600px;">
                    <table class="table" id="tableC">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ประเภทเกม</th>
                        <th>เวลาทำรายการ</th>
                        <th>ชนะแพ้</th>
                        <th>เทิร์น</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      foreach ($casino['vender'] as $k => $v) {
                        $c = 1;
                        foreach ($dataC->data as $key => $va) {

                      ?>

                          <?php
                          if ($va != null || $va != '') {
                            if ($va->_id->Vendor == $v['id']) {
                              echo '<tr>';
                              echo '<td>' . $c . '</td>';
                              echo '<td>' . $v['name'] . '</td>';
                              echo '<td>' . date('d/m/y H:i:s', strtotime($va->_id->CreatedTime)) . '</td>';
                              echo '<td>' . $va->totalPlayerWinLoss . '</td>';
                              echo '<td>' . $va->totalTurnover . '</td>';
                              echo '</tr>';
                            }
                          } else {
                          }
                          ?>

                      <?php
                          $c++;
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-sm-4">
                  <?php $sport = ($sport);
                  $dataS = json_decode($sport['data']);/* print_r(($sport));*/ ?>
                  sport Total TurnOver = <B>
                    <?= (isset($dataS->totalTurnover)) ? $dataS->totalTurnover : 0; ?>
                  </B>
                  <hr>
                  <div style="overflow: auto; height: 600px;">
                    <table class="table" id="tableS">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ประเภทเกม</th>
                        <th>เวลาทำรายการ</th>
                        <th>ชนะแพ้</th>
                        <th>เทิร์น</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      foreach ($sport['vender'] as $k => $v) {
                        $s = 1;

                        foreach ($dataS->data as $key => $va) {

                      ?>

                          <?php
                          if ($va != null || $va != '') {
                            if ($va->_id->Vendor == $v['id']) {
                              echo '<tr>';
                              echo '<td>' . $s . '</td>';
                              echo '<td>' . $v['name'] . '</td>';
                              echo '<td>' . date('d/m/y H:i:s', strtotime($va->_id->CreatedTime)) . '</td>';
                              echo '<td>' . $va->totalPlayerWinLoss . '</td>';
                              echo '<td>' . $va->totalTurnover . '</td>';
                              echo '</tr>';
                            }
                          } else {
                          }
                          ?>

                      <?php
                          $s++;
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('.table').DataTable({
      "searching": false,
      "paging": false,
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    });
    // $('#tableC').DataTable({
    //   "searching": false,
    //   "paging": false,
    //   "bPaginate": false,
    //   "bLengthChange": false,
    //   "bFilter": true,
    //   "bInfo": false,
    //   "bAutoWidth": false
    // });
    // $('#tableS').DataTable({
    //   "searching": false,
    //   "paging": false,
    //   "bPaginate": false,
    //   "bLengthChange": false,
    //   "bFilter": true,
    //   "bInfo": false,
    //   "bAutoWidth": false
    // });
  });
  $('#sh').on('click', function() {
    if ($('#user').val() != '') {
      $('#cover-spin').show();
    }

  });
  $(window).on('load', function() {
    $('#cover-spin').hide();
  });
</script>
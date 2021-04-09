   <!--ตัวดีเลย์ดาวโหลด-->
<div id="cover-spin"></div>

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ปันผล Affiliate<small></small></h2>
          <!-- <div class="text-right">
            <select class="" id="type" onchange="type_stm()">
              <option value="1">รออนุมัติ</option>
              <option value="2">อนุมัติแล้ว</option>
              <option value="3">ยกเลิก</option>
     
            </select>
          </div> -->
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead id="af_thead" style="background-color: #2a3f54;color: #fff;">
                      <tr align="center" >
                        <th width="2%" style="vertical-align: middle">No</th>
                        <th width="2%" style="vertical-align: middle">รหัส</th>
                        <th style="vertical-align: middle"> วันที่เวลา  </th>
                        <th style="vertical-align: middle"> เบอร์โทร </th>
                        <th style="vertical-align: middle; background-color:#00078C"> จำนวนเงิน </th>
                        <th style="vertical-align: middle"> คอนเฟิร์ม </th>
                      </tr>
                    </thead>
                    <tbody id="af_tbody">
                      <tr align="center">
                      <?php $i=1; if(!empty($af_con)){foreach($af_con as $ac){ ?>
                        <td align="center"><?=$i;?></td>
                        <td align="center"><?=$ac['user'];?></td>
                        <td align="center"><?=$ac['date_user'] == 0 ? '':date('d/m/Y H:i',$ac['date_user'])?></td>
                        <td align="center"><?=$ac['username'];?></td>
                        <td align="center"><?=number_format($ac['amount'], 2);?></td>
                        <td align="center">ทำรายการสำเร็จ</td>
                      </tr align="center">
                      <?php $i++;  } }else{ ?>
                      <tr align="center">
                        <td colspan="7">ไม่มีข้อมูล</td>
                      </tr>
                      <?php }?>
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


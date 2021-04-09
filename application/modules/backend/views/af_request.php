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
                        <th  style="vertical-align: middle">รหัส</th>
                        <th style="vertical-align: middle"> วันที่เวลาร้องขอ  </th>
                        <th style="vertical-align: middle"> เบอร์โทร </th>
                        <th style="vertical-align: middle; background-color:#00078C"> จำนวนเงิน </th>
                        <th style="vertical-align: middle"> สถานะ </th>
                      </tr>
                    </thead>
                    <tbody id="af_tbody">
                      <tr align="center">
                      <?php $i=1; if(!empty($confirm)){foreach($confirm as $cf){ ?>
                        <td align="center"><?=$i;?></td>
                        <td align="center"><?=$cf['user'];?></td>
                        <td align="center"><?=$cf['date_user'] == 0 ? '':date('d/m/Y H:i',$cf['date_user'])?></td>
                        <td align="center"><?=$cf['username'];?></td>
                        <td align="center"><?=number_format($cf['amount'], 2);?></td>
                        <td align="center">
                            <button class="btn btn-success btn-sm"  id="btn_editspin"   title="อนุมัติรายการ" onclick="submit_aff('<?=$cf['id']?>');">
                                อนุมัติ
                            </button>
                            <button class="btn btn-danger btn-sm"  id="btn_editspin"  title="ยกเลิกรายการ" onclick="reject_aff('<?=$cf['id']?>');" >
                                        ไม่อนุมัติ
                            </button>
                        </td>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://code.jquery.com/jquery-3.4.0.js"></script>

<script>

function submit_aff(credit_id){
    swal({
    title: 'ยืนยันการทำรายการ',
    text: 'คุณต้องการทำรายการนี้ใช่หรือไม่?',
    buttons: true,
    dangerMode: true
  }).then ((willDelete) => {
    if(willDelete){
      $.ajax({
      url: '<?=base_url()?>backend/affiliate/confirm',
      type: 'POST',
      dataType: 'json',
      data: {credit_id:credit_id}
    }).done(function(res){
      if(res.code == 1){

        swal({
          icon: "success",
          text: res.msg,
        });
        setTimeout(function(){
          location.reload();
        }, 2000);
      }
    });
    }else{
      return false;
    }
    
  });
}

function reject_aff(credit_id){
    swal({
    title: 'ยืนยันการทำรายการ',
    text: 'คุณต้องการทำรายการนี้ใช่หรือไม่?',
    buttons: true,
    dangerMode: true
  }).then ((willDelete) => {
    if(willDelete){
      $.ajax({
      url: '<?=base_url()?>backend/affiliate/reject',
      type: 'POST',
      dataType: 'json',
      data: {credit_id:credit_id}
    }).done(function(res){
      if(res.code == 1){

        swal({
          icon: "success",
          text: res.msg,
        });
        setTimeout(function(){
          location.reload();
        }, 2000);
      }
    });
    }else{
      return false;
    }
    
  });
}


</script>


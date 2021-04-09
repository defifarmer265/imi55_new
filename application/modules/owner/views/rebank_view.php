<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Rebank<small></small></h2>
          <div class="text-right">
            <?php if ($this->session->admin['class'] == 0) { ?>
              <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-placement="top" title="(โปรแกรมเมอร์เท่านั้น)" data-target="#modaladd"><i class="fa fa-pencil"> จัดการ </i></button>
              (โปรแกรมเมอร์เท่านั้น)
            <?php } ?>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="row" id="mylist">
                  <?php foreach ($rebank as $key => $value) { ?>
                    <div id="list<?=$value->id;?>" class="animated flipInY col-lg-3 col-md-3 col-sm-6 sentreset" style="cursor:pointer;" data-id="<?= $value->id; ?>" data-name="<?= $value->name; ?>">
                      <div class="tile-stats">
                        <div class="icon"><i class="fa fa-refresh"></i>
                        </div>
                        <h3 class=""><?= $value->bank; ?></h3>
                        <p>รีเซ็ตล่าสุด</p>
                        <p><span id="adminre"><?= $value->admin; ?></span> <span id="datere"><?= date('d/m/Y H:i:s', $value->datereset); ?></span></p>
                      </div>
                    </div>

                  <?php    }   ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">จัดการ</h5>
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_add">
      
        <div class="modal-body">
          <div class="form-group">
            <label for="">ชื่อหรือแบงค์</label>
            <input type="text" maxlength="20" name="bank" class="form-control" id="bank" placeholder="KBANK(ฝาก)นายรวย" required>
            <small id="" class="form-text text-muted">ชื่อที่แอดมินเข้าใจเช่น KBANK(ฝาก)นายรวย (ไม่เกิน 20 อักษร)</small>
          </div>
          <div class="form-group">
            <label for="">ชื่อในระบบที่ต้องการรี</label>
            <input type="text" maxlength="20" name="name" class="form-control" id="name" placeholder="KBANK_API" required>
            <small id="" class="form-text text-muted">ชื่อที่ต้องการรีเช่น KBANK_API (ไม่เกิน 20 อักษร)</small>
          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" id="sentId" name="sentId">
          <button type="reset" class="btn btn-info"  onclick="$('#sentId').val('');$('#btnadd').removeAttr('hidden');$('#btnedit').attr('hidden',true);">ล้าง</button>
          <button type="reset" class="btn btn-secondary" data-dismiss="modal" onclick="$('#sentId').val('');$('#btnadd').removeAttr('hidden');$('#btnedit').attr('hidden',true);">ยกเลิก</button>
          <button type="submit" class="btn btn-primary " id="btnadd">บันทึก</button>
          <button type="button" class="btn btn-warning " id="btnedit" hidden>แก้ไข</button>
        
        </div>
      </form>

      <div class="modal-body">
        <table id="mytable" class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ชื่อ</th>
              <th scope="col">ชื่อapi</th>
              <th scope="col">อัฟเดทล่าสุด</th>
              <th scope="col">โดย</th>
              <th scope="col">จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($rebank as $key => $value) { ?>

            <tr align="center" id="tr<?= $value->id; ?>" data-datalist="<?= htmlspecialchars(json_encode($value, JSON_UNESCAPED_UNICODE), ENT_COMPAT); ?>">
              
                <td><?= $value->bank; ?></td>
                <td><?= $value->name; ?></td>
                <td><?= date('d/m/Y H:i:s', $value->datereset); ?></td>
                <td><?= $value->admin; ?></td>
                <td>
                  <a href="javascript:void(0);"><i class="fa fa-wrench"></i></a> |
                  <a href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                </td>
              </tr>

            <?php  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() { // ฟังก์ชั่นเริ่มต้น (ready/ทำงานทันที) มีได้แค่ 1 ตัวแต่ละหน้า

    // ===================== สร้าง ดาต้าเทเบิล  กำหนดตัวแปรเพื่อเพิ่มลบข้อมูลได้ ===========
    var dt_mytable = $('#mytable').DataTable({
      "searching": false,
      "bLengthChange": false,
    });
 
    $('.sentreset').click(function() {
      if(confirm('ยืนยันการรีเซ็ต')){
          $.ajax({
        type: "POST",
        url: '<?= base_url('backend/rebank/sent_reset'); ?>',
        data: {
          name: $(this).data('name'),
          id: $(this).data('id')
        },
        success: (res) => {
          if (res.status) {
            $('#adminre').html(res.admin);
            $('#datere').html(res.date);
          } else {
            alert(res.msg);
          }

        },
        dataType: 'json'
      });
      }
    
    });
    $('#form_add').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?= base_url('backend/rebank/savelist'); ?>",
        data: $(this).serialize(),
        success: (res) => {
          if (res.status) {
                        $('#form_add').trigger("reset");
                        var rowNode = dt_mytable.row.add([
                            res.data.bank,
                            res.data.name,
                            res.data.datereset,
                            res.data.admin,
                            `  <a href="javascript:void(0);"><i class="fa fa-wrench"></i></a> |
                                <a href="javascript:void(0);"><i class="fa fa-trash"></i></a>`
                        ]).draw().node();
                        $(rowNode).attr({
                            'align': 'center',
                            'id': 'tr' + res.data.id,
                            'data-datalist': JSON.stringify(res.data)
                        });

                      // ======================

                      $('#mylist').append(
                        ` <div id="list`+res.data.id+`" class="animated flipInY col-lg-3 col-md-3 col-sm-6 sentreset" style="cursor:pointer;" data-id="`+res.data.id+`" data-name="`+res.data.name+`">
                      <div class="tile-stats">
                        <div class="icon"><i class="fa fa-refresh"></i>
                        </div>
                        <h3 class="">`+res.data.bank+`</h3>
                        <p>รีเซ็ตล่าสุด</p>
                        <p><span id="adminre">`+res.data.admin+`</span> <span id="datere">`+res.data.datereset+`</span></p>
                      </div>
                    </div>`
                      );


                       
                    } else {
                       
                    }

        },
        dataType: 'json'
      });
    });

        // ===================== delete ===========
        $('#mytable').on('click', '.fa-trash', function() {
          console.log(555);
            var tr = $(this).parents('tr');
            if (confirm("ยืนยันการลบ")) {
                $.ajax({
                    method: "post",
                    data:{id:tr.data('datalist').id},
                    url: "<?= base_url('backend/rebank/deletedata') ?>" ,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            dt_mytable.row(tr).remove().draw();
                            $('#list'+tr.data('datalist').id).remove();
                        } else {
                        }
                    }
                });
            }

        });
          // ===================== show edit =============
          $('#mytable').on('click', '.fa-wrench', function() {
            $('#btnedit').removeAttr('hidden');
            $('#btnadd').attr('hidden',true);
            var tr = $(this).parents('tr');
            $('#sentId').val(tr.data('datalist').id);
            $('#bank').val(tr.data('datalist').bank);
            $('#name').val(tr.data('datalist').name);

        });
                // ===================== sent edit ============= 
     $('#btnedit').on('click', function() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?= base_url('backend/rebank/editdata') ?>",
                data: {
                       bank: $('#bank').val(),
                       name: $('#name').val(),
                       sentId: $('#sentId').val(),
                      },
                success: function(res) {
                  console.log(res);
                    if (res.status) {
                        dt_mytable.row($('#tr' + res.data.id)).data([
                            res.data.bank,
                            res.data.name,
                            res.data.datereset,
                            res.data.admin,
                            `  <a href="javascript:void(0);"><i class="fa fa-wrench"></i></a> |
                                <a href="javascript:void(0);"><i class="fa fa-trash"></i></a>`
                        ]).draw();

                        $('#list'+res.data.id).attr('data-name',res.data.name);
                      $('#list'+res.data.id).html(
                      `<div class="tile-stats">
                        <div class="icon"><i class="fa fa-refresh"></i>
                        </div>
                        <h3 class="">`+res.data.bank+`</h3>
                        <p>รีเซ็ตล่าสุด</p>
                        <p><span id="adminre">`+res.data.admin+`</span> <span id="datere">`+res.data.datereset+`</span></p>
                      </div>`
                      );

                    } else {

                    }

                }
            });
        });



  });// == END Ready ==
</script>
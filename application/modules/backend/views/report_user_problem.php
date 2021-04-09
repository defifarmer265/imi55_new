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
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายงานการเเจ้งปัญหาของลูกค้า<small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr>
                      <th class="text-center">ลำดับ</th>
                      <th>ประเภท</th>
                      <th>ปัญหา</th>
                      <th>เบอร์โทร</th>
                      <th>เวลาที่ส่ง</th>
                      <th>เวลาที่อัพเดต</th>
                      <th class="text-center">สถานะ</th>
                      </tr>
                    </thead>
                 <tbody>
                  <tr>
                  <?php
                    if ( !empty( $report ) ) {
                      $i = 0;
                      foreach ( $report as $key => $state ) { 
                          $create = date('d/m/Y H:i:s',$state['createdAt']);
                          $update = date('d/m/Y H:i:s',$state['updatedAt']);
                        ?>
                    <td class="text-center"><?=($i+1)?></td>
                    <td><?= $state['Type']?></td>
                    <td><?= $state['report']?></td>
                    <td><?= $state['username']?></td>
                    <td><?= $create?></td>
                    <td><?= $update?></td>
                    <?php if($state['status']==0) {?>
                    <td class="text-center"><button type="button" onclick="updatestatus(<?=$state['id']?>,<?=$state['status']?>)" class="btn btn-warning btn-sm"><i class="fa fa-clock-o" aria-hidden="true"></i> รอดำเนินการ</button></td>
                    <?php }else{ ?>
                    <td class="text-center"><button type="button" onclick="updatestatus(<?=$state['id']?>,<?=$state['status']?>)" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i> ดำเนินการเเล้ว</button></td>
                    <?php } ?>
                  </tr>    
                  <?php  $i++;}} ?>
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
<script type="text/javascript">
  $('#datatable-responsive').dataTable({
    "pageLength": 50
  });
  function updatestatus(id,status){
    console.log(status);
    if(status == 0){
          var text = "เปลี่ยนสถานะเป็นดำเนินการเเล้ว !!"
        }else{
          var text = "เปลี่ยนสถานะเป็นรอดำเนินการ"
        }
    swal({
            text: text,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: '<?php base_url()?>User_problem/update_status',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id : id,
                            status : status
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });

  }
</script>
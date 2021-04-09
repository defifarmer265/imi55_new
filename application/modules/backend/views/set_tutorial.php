<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.css"
    rel="stylesheet">
<script src="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.js"></script>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>คู่มือการใช้งานหลังบ้าน<small></small></h2>
          <div class="text-right">
            <button class="btn btn-sm btn-outline-info" onClick="$('#m_creAdmin').modal();"><i class="fa fa-plus"> เพิ่มคลิป </i></button>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr  style="text-align:center;" >
                        <th style="vertical-align: middle"> No.</th>
                        <th style="vertical-align: middle"> Logo.</th>
                        <th style="vertical-align: middle"> หัวข้อ </th>
                        <th style="vertical-align: middle"> สถานะ </th>
                        <th style="vertical-align: middle"> วันที่สร้าง</th>
                        <th style="vertical-align: middle"> เวลา</th>
                        <th>จัดการ</th>
                      </tr>
                    </thead>
                     <tbody>
                      <?php $i=1; foreach($tutorial as $rows){?>
                        <tr style="text-align:center;">
                            <td><?=  $i?></td>
                            <td><img src="<?php echo base_url()?>public/tem_frontend/img/logo.png" class="img-fulid" width="40px"></td>
                            <td><?=  $rows['name']?></td>
                            <td>
                               <?php  if($rows['status']=="0"){?>
                                <input type="checkbox" onchange="turnon_exchange();" id="off"
                                    value="<?= $rows['id'];?>" name="<?=$rows['status']?>" class="js-switch"
                                    <?=$rows['status'] == 0 ? '':''?> />
                                <?php }else{?>
                                <input type="checkbox" onchange="turnoff_exchange();" id="on"
                                    value="<?= $rows['id'];?>" name="<?=$rows['name']?>" class="js-switch"
                                    <?=$rows['status'] == 1 ? 'checked':''?> />
                                <?php }?>
                            </td>
                            <td><?= date('Y-m-d',$rows['create_time'])?></td>
                            <td><?= date('H:i:s',$rows['create_time'])?></td>
                            <td>
                            <button onClick="edit_rounds_show('<?=$rows['id']?>')" class="btn btn-secondary btn-sm" title="แก้ข้อมูล"><i class="fa fa-clock-o"></i></button>
                            </td>
                        </tr>
                        <?php $i++; }?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

</script>
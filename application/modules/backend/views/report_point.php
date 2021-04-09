<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ประวัติการได้คะแนนและสปิน<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div>
                                <a href="<?php echo site_url('backend/games')?>" class="btn btn-info"
                                    title="กลับไปหน้าก่อน" style="background-color: #2a3f54;">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"
                                        style="color:white;"></span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 mt-3 ">

                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Checkin</h2>
                                <hr>
                                <div class="card-box table-responsive">
                                    <table id="Tb_Checkin"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="2%">NO</th>
                                                <th width="3%">User</th>
                                                <th width="4%">ทีมาพอยท์</th>
                                                <th width="4%">จำนวนพอยท์</th>
                                                <th width="4%">ว/ด/ป เวลา</th>
                                                <!-- <th>Reward_id</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num =0  ; foreach($checkin as $rs_p){ $num++;  ?>
                                            <tr class="text-center">
                                                <td><?php echo $num;?></td>
                                                <td><?php echo  $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($rs_p['user_id']))), -6);?>
                                                </td>
                                                <td><?php echo $rs_p['type'];?></td>
                                                <td><?php echo $rs_p['point'];?></td>
                                                <td><?php echo date('d/m/Y H:i:s',$rs_p['create_time']);?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">

                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Spin</h2>
                                <hr>
                                <div class="card-box table-responsive">
                                    <table id="Tb_Spin" class="table table-striped table-bordered dt-responsive nowrap"
                                        cellspacing="0" width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="2%">NO</th>
                                                <th width="3%">User</th>
                                                <th width="4%">ทีมาพอยท์</th>
                                                <th width="4%">จำนวนพอยท์</th>
                                                <th width="4%">ว/ด/ป เวลา</th>

                                                <!-- <th>Reward_id</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num =0  ; foreach($spin as $rs_p){  $num++;  ?>
                                            <tr class="text-center">
                                                <td><?php echo $num;?></td>
                                                <td><?php echo  $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($rs_p['user_id']))), -6);?>
                                                </td>
                                                <td><?php echo $rs_p['type'];?></td>
                                                <td><?php echo $rs_p['point'];?></td>
                                                <td><?php echo date('d/m/Y H:i:s',$rs_p['create_time']);?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">

<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <h2>Deposit</h2>
            <hr>
            <div class="card-box table-responsive">
                <table id="Tb_Deposit" class="table table-striped table-bordered dt-responsive nowrap"
                    cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                        <tr class="text-center">
                            <th width="2%">NO</th>
                            <th width="3%">User</th>
                            <th width="4%">ทีมาพอยท์</th>
                            <th width="4%">จำนวนพอยท์</th>
                            <th width="4%">ว/ด/ป เวลา</th>

                            <!-- <th>Reward_id</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num =0  ; foreach($deposit as $rs_p){  $num++;  ?>
                        <tr class="text-center">
                            <td><?php echo $num;?></td>
                            <td><?php echo  $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($rs_p['user_id']))), -6);?>
                            </td>
                            <td><?php echo $rs_p['type'];?></td>
                            <td><?php echo $rs_p['point'];?></td>
                            <td><?php echo date('d/m/Y H:i:s',$rs_p['create_time']);?></td>
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

<script>
$(document).ready(function() {
    $('#Tb_Spin').DataTable({
        pageLength: 7,
    });
    $('#Tb_Checkin').DataTable({
        pageLength: 7,
    });
    $('#Tb_Deposit').DataTable({
        pageLength: 7,
    })
});
</script>
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
             <div class="x_title">
                    <h2>ประวัติการไม่กดรับ Gift ของลูกค้า<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <div>
                                <a href="<?php echo site_url('backend/gift/gift_report')?>" class="btn btn-info"
                                    title="กลับไปหน้าก่อน" style="background-color: #2a3f54;">
                                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"
                                        style="color:white;"></span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-10 col-sm-10 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="gift" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>ลำดับ</th>
                                                <th>User</th>
                                                <th>วันที่รับ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                           
                                          <?php
                                                $i=0;
                                                foreach(json_decode($receive_gift) as $row){
                                                    $i++;
                                            ?>
                                                 <tr>
                                                 <td><?= $i; ?></td>
                                                <td><?= $row->id; ?></td>
                                                <td><?= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($row->user_id))), -6) ?></td>
                                                <td><?= date('d/m/Y H:i:s', $row->time_receive) ?></td>
                                                </tr>
                                           
                                           <?php }?>
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
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#gift').DataTable({
            // "searching": false,
            "pageLength": 10,
            "lengthMenu": [
                [10, 20, 50],
                [10, 20, 50]
            ],
        });
    });
</script>
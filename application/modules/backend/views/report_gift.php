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
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายงานGift Voucher</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <table id="user_data" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr align="center">
                                                <th>No</th>
                                                <th>ชื่อGift Voucher</th>
                                                <th>Code</th>
                                                <th>จำนวนGift Voucher</th>
                                                <th>เครดิต / พ้อย</th>
                                                <th>จำนวนเทิร์น</th>
                                                <th>วันเริ่ม</th>
                                                <th>หมดอายุ</th>
                                                <th>รับแล้ว</th>
                                                <th>ยังไม่รับ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0;
                                            foreach ($gift as $gf) { ?>
                                                <tr align="center">
                                                    <td><?= $i + 1; ?></td>
                                                    <td><?= $gf['gift_name']; ?></td>
                                                    <td><?= $gf['code']; ?></td>
                                                    <td><?= number_format($gf['limit_user']); ?></td>
                                                    
                                                    <td><?= ($gf['credit'] != 0) ? $gf['credit'].' เครดิต' : $gf['point'].' พ้อย' ?> </td>

                                                    <td><?= $gf['turnover']; ?> เครดิต</td>
                                                    <td><?= date('d/m/Y || H:i', $gf['time_start']); ?> น.</td>
                                                    <td><?= date('d/m/Y || H:i', $gf['time_end']); ?> น.</td>
                                                    
                                                    <td><a href="<?php echo base_url('backend/gift/receive/'.$gf['id']) ?>" title="รายละเอียดการกดรับ"><?= number_format($gf['status_receive']->receive); ?></a></td>
                                                    <td><a href="<?php echo base_url('backend/gift/no_receive/'.$gf['id']) ?>" title="รายละเอียดการไม่กดรับ"><?= number_format($gf['status_receive']->no_receive); ?></a></td>
                                                </tr>
                                            <?php $i++;
                                            } ?>
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
        $('#user_data').DataTable({
            "pageLength": 10,
            "lengthMenu": [
                [10, 20, 50],
                [10, 20, 50]
            ],
        });
    });
</script>
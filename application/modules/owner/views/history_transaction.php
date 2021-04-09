
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายการที่เข้าบัญชีฝากทั้งหมด<small> ข้อมูลธนาคาร Auto เข้า</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-10 ">
                <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="user_data"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="2%">Row</th>
                                                <th width="2%">Id</th>
                                                <th>ธนาคารรับ</th>
                                                <th>ชื่อผู้รับ </th>
                                                <th>วันที่ </th>
                                                <th>เวลา</th>
                                                <th>ประเภท</th>
                                                <th>รายการ</th>
                                                <th>ถอน</th>
                                                <th>ฝาก</th>
                                                <th>รายละเอียด</th>
                                                <th>สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; if(empty($auto)){ echo '<tr><td colspan="11"></td></tr>'; }else {foreach($auto as $at){ ?>
                                            <tr>
                                                <td class="text-center"><?=$i?></td>
                                                <td class="text-center"><?=$at['id']?></td>
                                                <td><?=$at['admin_acc']?></td>
                                                <td><?=$at['admin_name']?></td>
                                                <td><?=$at['ts_date']?></td>
                                                <td><?=$at['ts_time']?></td>
                                                <td><?=$at['ts_order']?></td>
                                                <td><?=$at['ts_route']?></td>
                                                <td class="text-right">
                                                    <?=$at['ts_withdraw'] < 0 ? $at['ts_withdraw'] : '-'?></td>
                                                <td class="text-right">
                                                    <?=$at['ts_diposit'] > 0 ? $at['ts_diposit'] : '-'?></td>
                                                <td><?=$at['ts_info']?></td>
                                                <td class="text-center">
                                                    <?=$at['status'] == 1 ?'<i class="text-success fa fa-check"></i>':'<i class="text-warning fa fa-exclamation-triangle"></i>'?>
                                                </td>
                                            </tr>
                                            <?php $i++; }} ?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#user_data').DataTable({
            "pageLength": 50,
            "oLanguage": {
                "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                "sSearch": "ค้นหา :"
            },
            "lengthMenu": [
                [50, 100, 500],
                [50, 100, 500]
            ],
        });
    });
    </script>
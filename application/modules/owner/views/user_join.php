    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>สมาชิกทั้งหมด<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="user_data"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                            <th width="1%">NO</th>
                                                <th width="3%">รหัสเข้าระบบ</th>
                                                <th width="3%">รหัสลูกค้า</th>
                                                <th width="3%">ชื่อลูกค้า</th>
                                                <th width="4%">ธนาคาร</th>
                                                <th width="4%">วันที่สร้าง</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"></tbody>
                                    </table>
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
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "fetch_userjoin",
                    type: "POST",
                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],
                "pageLength": 20,
                // "oLanguage": {
                //     "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                //     "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                //     "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                //     "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                //     "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                //     "sSearch": "ค้นหา :"
                // },
                "lengthMenu": [
                    [20, 50, 150],
                    [20, 50, 150]
                ],
            });
        });
  </script>
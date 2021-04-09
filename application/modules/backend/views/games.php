<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ข้อมูลจำนวนแต้มและสปินของลูกค้าทั้งหมด<small></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="col-md-10 col-sm-10 ">
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
                                                <th width="4%">จำนวนพอยท์</th>
                                                <th width="4%">จำนวนสปิน</th>
                                                <th width="3%">เบอร์โทรลูกค้า</th>
                                                <th width="3%">รายละเอียดลูกค้า</th>
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
                    url: "games/fetch_user",
                    type: "POST",
                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],
                "pageLength": 50,
              
                "lengthMenu": [
                    [50, 100, 150],
                    [50, 100, 150]
                ],
            });
        });
  </script>


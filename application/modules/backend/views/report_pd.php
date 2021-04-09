<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายงานสินค้า<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row ">
                    <div class="col-sm-2 ">
                        วันเริ่ม
                        <fieldset>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="single_cal1" aria-describedby="inputSuccess2Status2">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <!--   <span id="inputSuccess2Status2" class="sr-only">(success)</span> -->
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-2">
                        วันสิ้นสุด
                        <fieldset>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="single_cal2">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <!-- <span id="inputSuccess2Status2" class="sr-only">(success)</span> -->
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-2"><br>
                        <button onClick="search()" class="btn btn-info">ค้นหา</button>
                    </div>
                </div>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th>NO.</th>
                                                <th>User</th>
                                                <th>ชื่อสินค้า</th>
                                                <th>ราคา(Point)</th>
                                                <th>ราคาสินค้า(THB)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodytable"></tbody>
                                        <tfoot id="tb_foot" style="display: none;">
                                            <tr align="center">
                                                <th colspan="4" class="font-weight-normal" style="background-color: #2a3f54;color: #fff;"></th>
                                                <th class="font-weight-normal" style="background-color: #2a3f54;color: #fff;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row" id="pd_count" style="display: none;">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>สินค้า<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th>NO.</th>
                                                <th>ชื่อสินค้า</th>
                                                <th>จำนวน(ชิ้น)</th>
                                                <th>ราคา : ชิ้น(THB)</th>
                                                <th>รวม</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodytable_pd"></tbody>
                                        <tfoot id="tb_foot_pd" style="display: none;">
                                            <tr align="center">
                                                <th colspan="4" class="font-weight-normal" style="background-color: #2a3f54;color: #fff;"></th>
                                                <th class="font-weight-normal" style="background-color: #2a3f54;color: #fff;"></th>
                                            </tr>
                                        </tfoot>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
   
    function search() {
        var dt_start = $('#single_cal1').val();
        var dt_end = $('#single_cal2').val();
        $.ajax({
            url: 'detail_report',
            type: 'POST',
            dataType: 'json',
            data: {
                dt_start: dt_start,
                dt_end: dt_end,
            },
        }).done(function(res) {
            $('#datatable-responsive').dataTable().fnDestroy();

            if (res.code == 1) {
                console.log(res);
                var i = 1;
                var content = '';
                $.each(res.data.dataa, function(index, value) {
                    content += '<tr align="center">'
                    content += '<td class="font-weight-normal text-secondary">' + i + '</td>'
                    content += '<td class="font-weight-normal text-secondary">' + value.user_id + '</td>'
                    content += '<td class="font-weight-normal text-secondary">' + value.pd_name + '</td>'
                    content += '<td class="font-weight-normal text-secondary">' + thousands_separators(parseInt(value.pd_point)) + '</td>'
                    content += '<td class="font-weight-normal text-secondary">' + thousands_separators(parseInt(value.pd_price)) + '</td>'
                    content += '</tr>';
                    i++;
                });
                $('#bodytable').html(content);
                $('#tb_foot').show();
                $('#datatable-responsive').dataTable({
                    "paging": true,
                    "lengthChange": true,
                    "pageLength": 10,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(),
                            data;
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };
                        var substr = function(d) {
                            return typeof d === 'string' ?
                                d.replace('%', '') * 1 :
                                typeof d === 'number' ?
                                d : d;
                        }
                        var b = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        /*  $(api.column(0).footer()).html('');
                         $(api.column(2).footer()).html('');
                         $(api.column(3).footer()).html('');
                         $(api.column(4).footer()).html('');
                         $(api.column(5).footer()).html(''); */
                        $(api.column(0).footer()).html('รวม');
                        $(api.column(4).footer()).html(thousands_separators(parseInt(b)) + ' บาท');
                    }
                })

                $('#datatable-responsive1').dataTable().fnDestroy();
                $('#pd_count').show();
                var j = 1;
                var content1 = '';
                $.each(res.data.count, function(index, value) {
                    content1 += '<tr align="center">'
                    content1 += '<td class="font-weight-normal text-secondary">' + j + '</td>'
                    content1 += '<td class="font-weight-normal text-secondary">' + value.pd_name + '</td>'
                    content1 += '<td class="font-weight-normal text-secondary">' + value.count + '</td>'
                    content1 += '<td class="font-weight-normal text-secondary">' + thousands_separators(parseInt(value.pd_price)) + '</td>'
                    content1 += '<td class="font-weight-normal text-secondary">' + thousands_separators(parseInt(value.pd_price) * parseInt(value.count)) + '</td>'
                    content1 += '</tr>';
                    j++;
                });
                $('#bodytable_pd').html(content1);
                $('#tb_foot_pd').show();
                $('#datatable-responsive1').dataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "pageLength": 10,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(),
                            data;
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };
                        var substr = function(d) {
                            return typeof d === 'string' ?
                                d.replace('%', '') * 1 :
                                typeof d === 'number' ?
                                d : d;
                        }
                        var b = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        /*  $(api.column(0).footer()).html('');
                         $(api.column(2).footer()).html('');
                         $(api.column(3).footer()).html('');
                         $(api.column(4).footer()).html('');
                         $(api.column(5).footer()).html(''); */
                        $(api.column(0).footer()).html('รวม');
                        $(api.column(4).footer()).html(thousands_separators(parseInt(b)) + ' บาท');
                    }
                })

                swal('ค้นหาสำเร็จ', {
                    buttons: [null],
                    icon: "success",
                })
            } else {
                $('#datatable-responsive').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "pageLength": 10,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
                swal(res.msg, {
                    buttons: [null],
                    icon: "error",
                });
            }


        });
    }

    function thousands_separators(num) {
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    }
</script>
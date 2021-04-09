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
</style>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายการที่เข้าบัญชีฝากทั้งหมด<small></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="row ">
                    <div class="col-sm-2 ">
                        วันเริ่ม
                        <fieldset>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="single_cal2"
                                            placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                        <span class="fa fa-calendar-o form-control-feedback left"
                                            aria-hidden="true"></span>
                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
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
                                        <input type="text" class="form-control has-feedback-left" id="single_cal3"
                                            placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                        <span class="fa fa-calendar-o form-control-feedback left"
                                            aria-hidden="true"></span>
                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-2">
                        เลือกรายการ
                        <select id="type" class="form-control">
                            <option value="">ทั้งหมด</option>
                            <option value="deposit">รายการฝาก</option>
                            <option value="withdraw">รายการถอน</option>
                            <option value="reject">ยกเลิกถอน</option>
                        </select>

                    </div>
                    <div class="col-sm-2">
                        ธนาคาร
                        <select id="bank_id" class="form-control">
                            <option value="">ทั้งหมด</option>
                            <?php foreach ($bw as $bw){ ?>
                            <option value="<?=$bw['id']?>"><?=$bw['name'].' ['.$bw['bank_short'].']'?></option>
                            <?php }?>
                        </select>

                    </div>
                    <div class="col-sm-2">
                        ID : <?=$this->getapi_model->agent()?>i
                        <input type="text" value="" class="form-control" id="user" maxlength="6"
                            placeholder="รหัสลูกค้า">
                        ใส่แค่ตัวเลข 6 หลัก
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="radio">
                            <label style="padding: 10px">
                                <input type="radio" class="flat" value="1" checked name="set"> ทั้งหมด
                            </label>

                            <label style="padding: 10px">
                                <input type="radio" class="flat" value="2" name="set"> ลูกค้า
                            </label>

                            <label style="padding: 10px">
                                <input type="radio" class="flat" value="3" name="set"> พนักงาน
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <button onClick="select_user()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา
                        </button>
                        <span class="text-danger">ใช้เวลาค้นหา 1-4 นาที</span>
                    </div>
                </div>
                <span class="mt-2 text-danger">หมายเหตุให้เลือกระหว่างวันเช่น 04/01/2564 ถึง 05/01/2564 <smal class="text-danger">ข้อมูลจะแสดงตั้งแต่ วันที่4 เวลาตั้งแต่ 11 โมงถึงวันที่5 11โมง</smal></span>
                <span class="text-danger">อ้างอิงจากเว็บ ag</span>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="table_rj" class="table table-striped table-bordered dt-responsive nowrap"
                                        cellspacing="0" width="100%" style="font-size: 14px;display: none;">
                                        <tr class="text-center">
                                            <th width="2%">Id</th>
                                            <th width="2%">Id</th>
                                            <th>เวลา</th>
                                            <th>ยอดเงิน</th>
                                            <th>รหัสลูกค้า</th>
                                            <th>แอดมิน</th>
                                        </tr>
                                        <tbody id="sum_rj"></tbody>
                                        <tbody id="tbody_rj"></tbody>
                                    </table>
                                    <table id="table_dw" class="table table-striped table-bordered dt-responsive nowrap"
                                        cellspacing="0" width="100%" style="font-size: 14px;">

                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="2%">Id</th>
                                                <th width="2%">Id</th>
                                                <th>วันที่ฝาก</th>
                                                <th>วันที่ระบบ</th>
                                                <th>ฝาก </th>
                                                <th>ถอน </th>
                                                <th>ยูเซอร์</th>
                                                <th>เบอร์</th>
                                                <th>เลขที่บัญชี</th>
                                                <th>แบงค์</th>
                                                <th>แบงค์เว็บ</th>
                                                <th>รายละเอียด</th>
                                                <th>พนักงาน</th>
                                            </tr>
                                        </thead>
                                        <!-- <tbody id="sum_wd"></tbody> -->
                                        <tbody id="tbody_wd"></tbody>
                                        <tfoot>
                                            <tr  class="text-right" style="background-color:#f2f2f2">
                                                <th colspan="4"></th>
                                                <th> </th>
                                                <th> </th>
                                                <td colspan="7"></td>
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


<script>
$(document).on('user', function(e) {
    if (e.which == 13) {
        alert('You pressed enter!');
    }
});

// function thousands_separators(num) {
//     var num_parts = num.toString().split(".");
//     num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//     return num_parts.join(".");
// }

function select_user() {
    $('#cover-spin').show();
    $('#bodyhistory').html('');
    $('#bodysum').html('');
    $('#table_dw').DataTable().destroy();

    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    var user = $('#user').val();
    var type = $('#type').val();
    var bank_id = $('#bank_id').val();
    var typeset = $('input[name="set"]:checked').val();
    $.ajax({
            url: 'sel_state',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: dt1,
                dt2: dt2,
                user: user,
                type: type,
                bank_id: bank_id,
                typeset: typeset
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#table_rj').hide();
                $('#table_dw').show();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    var tt_dp = 0;
                    var tt_wd = 0;
                    for (var i = 0; i < conut; i++) {
                        content += '<tr>';
                        content += '<td>' + i + '</td>';
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['newTime1'] + '</td>';
                        content += '<td>' + wd[i]['newTime2'] + '</td>';
                        if (wd[i]['deposit'] != 0) {
                            content += '<td class="text-right">' + wd[i]['deposit1'] + '</td>';
                        } else {
                            content += '<td class="text-right">0</td>';
                        }
                        if (wd[i]['withdraw'] != 0) {
                            content += '<td class="text-right">' + wd[i]['withdraw1'] + '</td>';
                        } else {
                            content += '<td class="text-right">0</td>';
                        }
                        content += '<td>' + wd[i]['user'] + '</td>';
                        content += '<td>' + wd[i]['username'] + '</td>';
                        content += '<td>' + wd[i]['account'] + '</td>';
                        content += '<td>' + wd[i]['bank_short'] + '</td>';
                        content += '<td>' + wd[i]['bw_name'] + wd[i]['bw_acc'].substr(-6); + '</td>';
                        // content += '<td>' + wd[i]['bw_name'] + wd[i]['bw_acc'] + '</td>';
                        content += '<td>' + wd[i]['note'] + '</td>';
                        content += '<td>' + wd[i]['admin_name'] + '</td>';
                        content += '</tr>';

                        var withdraw = parseFloat(wd[i]['withdraw']);
                        var deposit = parseFloat(wd[i]['deposit']);

                        tt_wd = tt_wd + withdraw;
                        tt_dp = tt_dp + deposit;

                    }

                    var sum = '<tr><td colspan="4" class="text-right">รวม</td><td class="text-right">' + nb(tt_dp
                            .toFixed(2)) + '</td><td class="text-right">' + nb(tt_wd.toFixed(2)) +
                        '</td><td colspan="5"></td></tr>';

                } else {
                    var content = '<span class="text-danger">ไม่พบข้อมูล</span>';
                }
                $('#sum_wd').html(sum);
                $('#tbody_wd').html(content);
                //Export to Excel
                new $('#table_dw').DataTable({
                    retrieve: true,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "searching": false,
                    columnDefs: [{
                        target: [17]
                    }],
                    responsive: true,
                    fixedHeader: true,
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excel',
                        text: '<span class="btn btn-lg btn-success fa fa-file-excel-o"> Excel</span> ',
                        title: 'ข้อมูลการฝากทั้งหมด',
                    }],
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
						};
						var t = function(num){
							var num_parts = num.toString().split(".");
    						num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   							return num_parts.join(".");
						};

                        var d = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        (Number.isNaN(d)) ? d = 0: d;

                        var w = api
                            .column(5)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        (Number.isNaN(w)) ? w = 0: w;

                        $(api.column(0).footer()).html('รวม');
                        $(api.column(4).footer()).html(t(d.toFixed(2)));
                        $(api.column(5).footer()).html(t(w.toFixed(2)));
                    },
                });

            } else if (res.code == 2) {
                $('#table_rj').show();
                $('#table_dw').hide();
                var conut = res.data.length;
                var tt_rj = 0
                var reject = res.data;
                var content1 = '';
                for (var k = 0; k < conut; k++) {

                    content1 += '<tr>';
                    content1 += '<td>' + k + '</td>';
                    content1 += '<td>' + reject[k]['id'] + '</td>';
                    content1 += '<td>' + reject[k]['newtime'] + '</td>';
                    content1 += '<td class="text-right">' + reject[k]['amount1'] + '</td>';
                    content1 += '<td>' + reject[k]['user'] + '</td>';
                    content1 += '<td>' + reject[k]['admin'] + '</td>';
                    content1 += '</tr>';
                    var amountreject = parseFloat(reject[k]['amount']);

                    tt_rj = tt_rj + amountreject;
                }
                var sum_reject = '<tr><td colspan="3" class="text-right">รวม</td><td class="text-right">' + nb(tt_rj
                    .toFixed(2)) + '</td><td colspan="2"></td></tr>';
                $('#sum_rj').html(sum_reject);
                $('#tbody_rj').html(content1);
                //Export to Excel
                new $('#table_dw').DataTable({
                    retrieve: true,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "searching": false,
                    columnDefs: [{
                        target: [17]
                    }],
                    responsive: true,
                    fixedHeader: true,
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excel',
                        text: '<span class="btn btn-lg btn-success fa fa-file-excel-o"> Excel</span> ',
                        title: 'ข้อมูลการฝากทั้งหมด',
                    }],
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

                        var d = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        (Number.isNaN(d)) ? d = '-': d;

                        var w = api
                            .column(5)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        (Number.isNaN(w)) ? w = '-': w;

                        $(api.column(0).footer()).html('รวม');
                        $(api.column(4).footer()).html(thousands_separators(d.toFixed(2)));
                        $(api.column(5).footer()).html(thousands_separators(w.toFixed(2)));
                    },
                });
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#cover-spin').hide();

        })
        .fail(function() {
            console.log("error");
        });


}

function nb(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>
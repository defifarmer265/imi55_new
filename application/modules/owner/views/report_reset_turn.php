<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <?php
                if (date('Hi') > 1100) {
                    $s_today = strtotime(date('Y-m-d 11:00:00'));
                    $e_today = strtotime(date('Y-m-d 11:00:00', strtotime('+ 1days')));
                } else {
                    $s_today = strtotime(date('Y-m-d 11:00:00', strtotime('-1 days')));
                    $e_today = strtotime(date('Y-m-d 11:00:00'));
                }
                ?>
                <h2>รายงานการตัดเทิร์น<small></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="row ">
                <div class="col-sm-2 "> วันเริ่ม
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-2"> วันสิ้นสุด
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-sm-2"><br>
                    <button onClick="select_user()" class="btn btn-info">ค้นหา</button>
                </div>
            </div>

            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-box table-responsive">
                                <table id="tb_data" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                                    <thead style="background-color: #2a3f54;color: #fff;">
                                        <tr class="text-center">
                                            <th width="2%">No</th>
                                            <th> แอดมิน </th>
                                            <th> ยูสเซอร์ </th>
                                            <th> เครดิตก่อนตัด </th>
                                            <th> เวลา </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodytable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function select_user() {
            var dt1 = $('#single_cal2').val();
            var dt2 = $('#single_cal3').val();
            $.ajax({
                    url: 'select_reset_turn',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        dt1: dt1,
                        dt2: dt2
                    },
                })
                .done(function(res) {
                    console.log(res);
                    $('#tb_data').dataTable().fnClearTable();
                    $('#tb_data').dataTable().fnDestroy();
                    if (res.code == 1) {
                        var i = 1;
                        var content = '';
                        $.each(res.data.reset, function(index, value) {
                            content += '<tr align="center">'
                            content += '<td class="font-weight-normal text-secondary">' + i + '</td>'
                            content += '<td class="font-weight-normal text-secondary">' + value.username + '</td>'
                            content += '<td class="font-weight-normal text-secondary">' + value.user + '</td>'
                            content += '<td class="font-weight-normal text-secondary">' + value.before_reset + '</td>'
                            content += '<td class="font-weight-normal text-secondary">' + value.time_reset + '</td>'
                            content += '</tr>';
                            i++;
                        });
                        $('#bodytable').html(content);
                        $('#tb_data').dataTable({})
                        swal('ค้นหาสำเร็จ', {
                            buttons: [null],
                            icon: "success",
                        })
                    } else {
                        swal(res.msg, {
                            buttons: [null],
                            icon: "error",
                        });
                    }


                });



        }
    </script>
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ประวัติการเปลี่ยนรหัสให้ลูกค้า<small></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row ">
                            <div class="col-sm-2 ">
                                วันเริ่ม
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                    id="single_cal2" placeholder="First Name"
                                                    aria-describedby="inputSuccess2Status2">
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
                                                <input type="text" class="form-control has-feedback-left"
                                                    id="single_cal3" placeholder="First Name"
                                                    aria-describedby="inputSuccess2Status2">
                                                <span class="fa fa-calendar-o form-control-feedback left"
                                                    aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-2">
                                <br>
                                <button onClick="select_user()" class="btn btn-info">ค้นหา</button>

                            </div>
                        </div>

                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered dt-responsive nowrap"
                                        cellspacing="0" width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="2%">No</th>
                                                <th width="2%">User ที่ถูกเปลี่ยนรหัสผ่าน</th>
                                                <th width="2%">IP</th>
                                                <th width="4%">พนักงานที่ทำการเปลี่ยน</th>
                                                <th width="3%">วันที่</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyhistory">
                                            <?php
                                              $i=0;
                                              foreach($lg_pass as $row){ 
                                            ?>
                                            <tr class="text-center">
                                                <td><?= $i;?></td>
                                                <td><?= $row['ref_userid']?></td>
                                                <td><?= $row['ip']?></td>
                                                <td><?= $row['name']?></td>
                                                <td><?= date('d/m/Y',$row['create_time'])?></td>
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

<script>
function select_user() {
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    var type = $('#type').val();
    // var user = $('#user').val();
    console.log(dt1 + dt2 + type);
    $.ajax({
            url: 'history_logpass',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: dt1,
                dt2: dt2,
                type: type
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['ref_userid'] + '</td>'; //no
                        content += '<td>' + wd[i]['ip'] + '</td>'; //id
                        content += '<td>' + wd[i]['name'] + '</td>'; //id
                        content += '<td>' + wd[i]['create_time'] + '</td>'; //id
                        content += "</tr>";
                    }

                } else {
                    var content = 'ไม่พบข้อมูล';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
        })
        .fail(function() {
            console.log("error");
        });


}
</script>
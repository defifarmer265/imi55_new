
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>แอดมิน<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">

                    <div class="x_content">
                        <div class="col-md-12 col-sm-12">
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
                                <button onClick="search_admin()" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="table_salelog" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%" id="t_all">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr>
                                                <th>No</th>
                                                <th> รหัส </th>
                                                <th> รหัสแอดมิน์ </th>
                                                <th> ชื่อ </th>
                                                <th> เวลาล็อกอิน </th>
                                                <th> เวลาล็อกเอ้า </th>
                                                <th> ไอพี </th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyhistory">
                                            <?php $i=0; foreach($admin as $adm=>$a){ ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?=$a['id']?></td>
                                                <td><?=$a['name']?></td>
                                                <td><?=$a['username']?></td>
                                                <td><?=$a['time_logout'] != '' ? '-' : date('d/m/Y H:i:s',$a['time_login'])?></td>
                                                <td><?=$a['time_logout'] != '' ? date('d/m/Y H:i:s',$a['time_logout']) : '-'?></td>
                                                <td><?=$a['ip_login']?></td>
                                                
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



    <script>
    function search_admin(){
        var dt1 = $('#single_cal2').val();
        var dt2 = $('#single_cal3').val();
    $('#table_salelog').DataTable().destroy();
    $.ajax({
            url: 'history_adminlogin',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: dt1,
                dt2: dt2
               
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
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['name'] + '</td>'; //id
                        content += '<td>' + wd[i]['username'] + '</td>'; //id
                        content += '<td>' + wd[i]['time_login'] + '</td>'; //id
                        content += '<td>' + wd[i]['time_logout'] + '</td>'; //id
                        content += '<td>' + wd[i]['ip_login'] + '</td>'; //id
                        content += "</tr>";
                    }

                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            new $('#table_log').DataTable({
                "searching": false
            });
        })
        .fail(function() {
            console.log("error");
        });

      }
    </script>


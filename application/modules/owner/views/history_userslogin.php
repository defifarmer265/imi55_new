
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ยูสเซอร์<small></small></h2>
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
                                <button onClick="search_user()" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                            
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="table_userlelog" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%" id="t_all">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr>
                                                <th>No</th>
                                                <th> รหัส </th>
                                                <th> รหัสยูสเซอร์</th>
                                                <th> เวลาล็อกอิน </th>
                                                <th> รายละเอียด </th>
                                                <th> ไอพี </th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyhistory">
                                            <?php $i=0; foreach($user as $u){  ?>
                                            <tr>
                                                 <td><?= $i;?></td>
                                                 <td><?= $u['id'];?></td>
                                                 <td> 
                                                 <?=  $u['user_id']; //$this->getapi_model->agent() . 'i' . substr(("000000" . (intval($u['user_id']))), -6);?></td>
                                                 <td><?= date('m-d-y H:i:s', $u['create_time']);?></td>
                                                 <td>
                                                     <?php
                                                        if($u['platform'] =='1'){
                                                            echo 'IPONE จำนวนการเข้าใช้งาน: ('.$u['countPlatform'].') ครั้ง';
                                                        }
                                                        else if($u['platform']=='2'){
                                                            echo 'Ipad จำนวนการเข้าใช้งาน:('.$u['countPlatform'].') ครั้ง';
                                                        }
                                                        else if($u['platform']=='3'){
                                                            echo 'WebOs จำนวนการเข้าใช้งาน:('.$u['countPlatform'].') ครั้ง';
                                                        }else if($u['platform']=='4'){
                                                            echo 'Android จำนวนการเข้าใช้งาน:('.$u['countPlatform'].') ครั้ง';
                                                        }else if($u['platform']=='5'){
                                                            echo 'PC จำนวนการเข้าใช้งาน: ('.$u['countPlatform'].') ครั้ง';
                                                        }else{
                                                            echo '-';
                                                        }
                                                     ?>
                                                 </td>
                                                 <td><?= $u['ip'];?></td>
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
    function search_user(){
        var dt1 = $('#single_cal2').val();
        var dt2 = $('#single_cal3').val();
    $('#table_userlelog').DataTable().destroy();
    $.ajax({
            url: 'history_usersLogin',
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
                        content += '<td>' + wd[i]['user'] + '</td>'; //id
                        content += '<td>' + wd[i]['createtime'] + '</td>'; //id
                        content += '<td>';
                            if(wd[i]['platform']== '1') {
                                content += 'IPONE จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                            }
                            else if(wd[i]['platform']== '2') {
                                content += 'Ipad จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                            }
                            else if(wd[i]['platform']== '3') {
                                content += 'WebOs จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                            }
                            else if(wd[i]['platform']== '4') {
                                content += 'Android จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                            }
                            else if(wd[i]['platform']== '5') {
                                content += 'PC จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                            }
                            else{
                                content +="-</td>";
                            }
                     
                        content += '<td>' + wd[i]['ip'] + '</td>'; //id
                        content += "</tr>";
                    }

                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            new $('#table_userlelog').DataTable({
                "searching": false
            });
        })
        .fail(function() {
            console.log("error");
        });

      }
    </script>


<style>
.cl {
    cursor: pointer;
}

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
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Log การเข้าสู่ระบบ<small></small></h2>

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
                        ID : <?= $this->getapi_model->agent();?>i
                        <input type="text" value="" class="form-control" id="user" maxlength="6"
                            placeholder="รหัสลูกค้า">
                        ใส่แค่ตัวเลข 4 - 6 หลัง
                    </div>
                    <div class="col-sm-2"><br>
                        <button onClick="search_ip()" class="btn btn-info">ค้นหา</button>
                    </div>
                </div>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="table_log"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="10px">Id</th>
                                                <th width="45px">Username</th>
                                                <th width="30px">IP</th>
                                                <th width="30px">วันที่เข้าใช้งานล่าสุด</th>
                                                <th width="10px">Iphone</th>
                                                <th width="10px">Ipad</th>
                                                <th width="10px">WebOS</th>
                                                <th width="10px">Android</th>
                                                <th width="10px">PC</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyhistory">

                                            <?php
                          $i=0;
                           foreach($user as $row){
                      ?>
                                            <tr class="text-center">
                                                <td><?= $i;?></td>
                                                <!-- <td><?= $this->getapi_model->agent() . 'i' . substr(("000000" . (intval($row['user_id']))), -6);?> -->
                                                <!-- </td> -->
                                                <td>
                                                    <?= $row['user_id']?>
                                                </td>
                                                <td><?= $row['ip']?></td>
                                                <td><?= date('Y-m-d H:i:s',$row['create_time'])?></td>
                                                <td>
                                                    <?php
                            if($row['platform']==1){
                               echo '<span>'.number_format($row['countPlatform']).'</span>'; 
                            }else{
                              echo '0';
                            }                
                          ?>
                                                </td>
                                                <td> <?php
                            if($row['platform']==2){
                                echo '<span>'.number_format($row['countPlatform']).'</span>'; 
                            }else{
                              echo '0';
                            }                
                          ?></td>
                                                <td> <?php
                            if($row['platform']==3){
                                echo '<span>'.number_format($row['countPlatform']).'</span>'; 
                            }else{
                              echo '0';
                            }                
                          ?></td>
                                                <td> <?php
                            if($row['platform']==4){
                                echo '<span>'.number_format($row['countPlatform']).'</span>'; 
                            }else{
                              echo '0';
                            }                
                          ?></td>
                                                <td> <?php
                            if($row['platform']==5){
                                echo '<span>'.number_format($row['countPlatform']).'</span>'; 
                            }else{
                              echo '0';
                            }                
                          ?></td>
                                            </tr>
                                            <?php $i++ ;}?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>
$(document).on('user', function(e) {

    if (e.which == 13) {
        alert('You pressed enter!');
    }
});

function search_ip() {
    $('#cover-spin').show();
    $('#bodyhistory').html('');
    $('#table_log').DataTable().destroy();
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    var user = $('#user').val();
    $.ajax({
            url: 'search',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: dt1,
                dt2: dt2,
                user: user
            },
        })
        .done(function(res) {
            $('#cover-spin').hide();
            if (res.code == 1) {
                if (res.data.length >= 1) {
                    var i = 1;
                    $.each(res.data, function(index, val) {
                        var html = '';
                        content += '<tr>';
                        content += '<td class="text-center">' + i + '</td>';
                        content += '<td class="text-center">' + val.user_id + '</td>';
                        content += '<td class="text-center">' + val.ip + '</td>';
                        content += '<td class="text-center">' + moment.unix(val.create_time).format(
                            "DD/MM/YYYY HH:mm:ss"); + '</td>';
                        if (val.platform == 1) {
                            content += '<td class="text-center">' + val.countPlatform + '</td>';
                        } else {
                            content += '<td class="text-center">' + '0' + '</td>';
                        }

                        if (val.platform == 2) {
                            content += '<td class="text-center">' + val.countPlatform + '</td>';
                        } else {
                            content += '<td class="text-center">' + '0' + '</td>';
                        }

                        if (val.platform == 3) {
                            content += '<td class="text-center">' + val.countPlatform + '</td>';
                        } else {
                            content += '<td class="text-center">' + '0' + '</td>';
                        }

                        if (val.platform == 4) {
                            content += '<td class="text-center">' + val.countPlatform + '</td>';
                        } else {
                            content += '<td class="text-center">' + '0' + '</td>';
                        }

                        if (val.platform == 5) {
                            content += '<td class="text-center">' + val.countPlatform + '</td>';
                        } else {
                            content += '<td class="text-center">' + '0' + '</td>';
                        }

                        content += '</tr>';
                        i++;
                    });
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
                setTimeout(function() {
                    location.reload();
                }, 1000);
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

function show_ip() {
    alert('อยู่ระหว่างพัฒนา');
}
</script>
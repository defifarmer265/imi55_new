<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>รายการที่แอดคะแนนให้ลูกค้า<small></small></h2>

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
                                เลือกรายการ
                                <select id="type" class="form-control">
                                    <option value="0">ทั้งหมด</option>
                                    <option value="3">รายการเพิ่ม</option>
                                    <option value="4">รายการลบ</option>

                                </select>
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
                                    <table id="table_log"
                                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                        width="100%" style="font-size: 14px;">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="2%">No</th>
                                                <th width="2%">Id</th>
                                                <th width="3%">วันที่</th>
                                                <th width="2%">ยอดก่อนเพิ่ม</th>
                                                <th width="2%">จำนวนที่เพิ่ม</th>
                                                <th width="2%">จำนวนที่ลบ</th>
                                                <th width="2%">ยอดหลังทำการ</th>
                                                <th width="4%">พนักงาน</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyhistory">
                                            <?php 
                                               $i=0;
                                               foreach($log_poin as $row){

                                            ?>
                                            <tr class="text-center">
                                                <td><?= $i ?></td>
                                                <td><?= $row['user_id']?></td>
                                                <td><?= date('d/m/Y H:i:s',$row['create_time'])?></td>
                                                <td><?= $row['point_last']?></td>
                                                <td>
                                                    <?php
                                                  if($row['add_'] != 0){
                                                      echo '+'.$row['add_'];
                                                  }else{
                                                      echo '-';
                                                  }
                                                ?>

                                                </td>
                                                <td>
                                                 <?php
                                                  if($row['reduce']!=0){
                                                      echo '-'.$row['reduce'];
                                                  }else{
                                                     echo '-';
                                                  }
                                                ?>
                                                </td>

                                                <td>
                                                    <?= $row['point_result']?>
                                                </td>
                                                <td>
                                                    <?= $row['name'] ?>
                                                </td>
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
// $(document).on('user',function(e) {
//     if(e.which == 13) {
//         alert('You pressed enter!');
//     }
// });
function select_user() {

    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    var type = $('#type').val();
    // var user = $('#user').val();
    $('#table_log').DataTable().destroy();
    //console.log(dt1 + dt2 + type);
    $.ajax({
            url: 'history_score',
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
                        content += '<td>' + wd[i]['user_id'] + '</td>'; //id
                        content += '<td class="text-center">' + wd[i]['create_time'] + '</td>'; //date
                        content += '<td>' + wd[i]['point_last'] + '</td>'; //
                        if (wd[i]['add_'] != 0) {
                            content += '<td class="text-center"> +' + wd[i]['add_'] + '</td>';
                        } else {
                            content += '<td class="text-center"> - </td>';
                        }
                        if (wd[i]['reduce'] != 0) {
                            content += '<td class="text-center"> -' + wd[i]['reduce'] + '</td>';
                        } else {
                            content += '<td class="text-center"> - </td>';
                        }
                        content += '<td>' + wd[i]['point_result'] + '</td>';
                        content += '<td>' + wd[i]['name'] + '</td>';
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
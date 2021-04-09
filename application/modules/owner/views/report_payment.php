<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <?php
                  if(date('Hi') > 1100){
                    $s_today = strtotime(date('Y-m-d 11:00:00'));
                    $e_today = strtotime(date('Y-m-d 11:00:00',strtotime('+ 1days')));
                  }else{
                    $s_today = strtotime(date('Y-m-d 11:00:00',strtotime('-1 days')));	
                    $e_today = strtotime(date('Y-m-d 11:00:00'));
                  }
                 ?>
                <h2>รายการยอดชำระ<small></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="row ">
                <div class="col-sm-2 "> วันเริ่ม
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="single_cal2"
                                        placeholder="First Name" aria-describedby="inputSuccess2Status2">
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
                                    <input type="text" class="form-control has-feedback-left" id="single_cal3"
                                        placeholder="First Name" aria-describedby="inputSuccess2Status2">
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
            <div class="col-sm-12">
                <p class="text-danger">* หมายเหตุ ตัดยอดทุก 11 โมงเช้า ของวันพรุ่งนี้ อ้างอิงจากเว็บ ag ตัวอย่างการเลือก
                    <?= date('d',$s_today)?> ถึง <?= date('d',$e_today)?> เป็นต้น
                </p>
            </div>
            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-box table-responsive">
                                <table id="" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%" style="font-size: 14px;">
                                    <thead style="background-color: #2a3f54;color: #fff;">
                                        <tr class="text-center">
                                            <th width="2%">No</th>
                                            <th> รายการ </th>
                                            <th> จำนวน </th>
                                            <th> ยอดรวม </th>
                                            <th> อัตรา </th>
                                            <th> ต้องชำระ </th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyhistory">
                                        <tr>
                                            <td class="text-center"> 1 </td>
                                            <td> รายการฝากอัตโนมัติ </td>
                                            <td class="text-right" id="num_dpsauto"> </td>
                                            <td class="text-right text-success" id="sum_dpsauto"> </td>
                                            <td class="text-center"> 0.25 </td>
                                            <td class="text-right" id="re_dpsauto"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> 2 </td>
                                            <td> รายการถอนอัตโนมัติ </td>
                                            <td class="text-right" id="num_witauto"> </td>
                                            <td class="text-right text-danger" id="sum_witauto"></td>
                                            <td class="text-center"> 0.25 </td>
                                            <td class="text-right" id="re_witauto"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> 3 </td>
                                            <td> รายการฝากมือ </td>
                                            <td class="text-right" id="num_dps"> </td>
                                            <td class="text-right text-success" id="sum_dps"></td>
                                            <td class="text-center"> - </td>
                                            <td class="text-right"> - </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> 4 </td>
                                            <td> รายการถอนมือ </td>
                                            <td class="text-right" id="num_wit"> </td>
                                            <td class="text-right text-danger" id="sum_wit"></td>
                                            <td class="text-center"> - </td>
                                            <td class="text-right"> - </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> 5 </td>
                                            <td> รายการใช้ sms OTP </td>
                                            <td class="text-right" id="num_otp"> </td>
                                            <td class="text-right"> - </td>
                                            <td class="text-center"> 0.40 </td>
                                            <td class="text-right" id="re_otp"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"> 6 </td>
                                            <td> ยอดจำนวนยูเซอร์ </td>
                                            <td class="text-right" id="num_user"> </td>
                                            <td class="text-right"> - </td>
                                            <td class="text-center"> - </td>
                                            <td class="text-right"> - </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right red">รวม</td>
                                            <td id="re_all" class="text-right red"></td>
                                        </tr>
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
                url: 'sel_report',
                type: 'POST',
                dataType: 'json',
                data: {
                    dt1: dt1,
                    dt2: dt2
                },
            })
            .done(function(res) {
                if (res.code == 1) {
                    $('#num_dpsauto').html(res.data.num_dpsauto);
                    $('#sum_dpsauto').html(res.data.sum_dpsauto);
                    $('#num_witauto').html(res.data.num_witauto);
                    $('#sum_witauto').html(res.data.sum_witauto);
                    $('#num_dps').html(res.data.num_dps);
                    $('#sum_dps').html(res.data.sum_dps);
                    $('#num_wit').html(res.data.num_wit);
                    $('#sum_wit').html(res.data.sum_wit);
                    $('#num_user').html(res.data.num_user);
                    $('#num_otp').html(res.data.num_otp);
                    $('#re_dpsauto').html(res.data.re_dpsauto);
                    $('#re_witauto').html(res.data.re_witauto);
                    $('#re_otp').html(res.data.re_otp);
                    $('#re_all').html(res.data.re_all);

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
<div class="container body">
    <div class="main_container">

        <div class="row" style="display: block;">
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>รายการธนาคาร </h2><small></small>
                        <ul class="nav navbar-right panel_toolbox">
                            <?php if($this->session->users['class'] == 0 || $this->session->users['class'] == 1){ ?>
                            <li> <button onClick="$('#mod_cre_state').modal()"><i class="fa fa-plus"></i></button></li>
                            <?php }else{}?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <h2><a href="../../bank">
                            <li class="fa fa-bank"></li>
                        </a> / <a href="#"><?=$bankWeb->account.' '.$bankWeb->name?></a></h2>
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead style="background-color:#12205F;color: #FFF">
                                                <tr align="center">
                                                    <th>No</th>
                                                    <th>วันที่-เวลา</th>
                                                    <th>ฝาก</th>
                                                    <th>ถอน</th>

                                                    <th>ลูกค้า</th>
                                                    <th>พนักงาน</th>
                                                    <th>สถานะ</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php  $i = 1; foreach ( $state as $_s => $sta ) { ?>
                                                <tr align="center">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?=date('d-m-Y H:i',$sta['datetime'])?></td>
                                                    <td style="text-align: right;">
                                                        <?php
										if($sta['deposit'] != 0){
											echo number_format($sta['deposit'],2);
										}else{
											echo '-';
										}
										
									?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?php
										if($sta['withdraw'] != 0){
											echo number_format($sta['withdraw'],2);
										}else{
											echo '-';
										}
										
									?>
                                                    </td>
                                                    <td><?=$sta['user']?></td>
                                                    <td><?=$sta['admin_name']?></td>
                                                    <td><?php
									if($sta['status'] == 1){
										echo 'รอยืนยัน';
									}else if($sta['status'] == 2){
										echo 'สำเร็จ';
									}else if($sta['status'] == 3){
										echo 'ระบบ';
									}else if($sta['status'] == 4){
										echo 'ยกเลิก';
									}else{
										echo 'ปิด';
									}  
									?></td>
                                                </tr>

                                                <?php $i++; } ?>
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
</div>
</div>
</div>
<!--create statement-->
<div class="modal fade" id="mod_cre_state" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">รายการบัญชี<small>(สำหรับโยกเข้า-โยกออก)</small></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-label-left" id="form_state" style="font-size: 18px">
                <div class="modal-body">

                    <input type="hidden" name="bank_id" value="<?=$bankWeb->id?>">
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">ระบบ/ลูกค้า</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select name="status" id="status" class="form-control">
                                    <option value="3">ระบบ</option>
                                    <option value="1">ลูกค้า</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">รายการ</label>
                            <div class="col-md-9 col-sm-9 ">
                                <select name="type" id="type" class="form-control">
                                    <option value="1">ฝาก</option>
                                    <option value="2">ถอน</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">วันที่เวลา</label>
                            <div class="col-md-5 col-sm-5 ">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-11 xdisplay_inputx form-group row has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                    id="single_cal1" name="state_date" placeholder="First Name"
                                                    aria-describedby="inputSuccess2Status">
                                                <span class="fa fa-calendar-o form-control-feedback left"
                                                    aria-hidden="true"></span>
                                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <input type="text" class="form-control" name="state_time"
                                    data-inputmask="'mask': '99:99'" value="<?=date('H:i')?>">
                                <span class="glyphicon glyphicon-time form-control-feedback right"
                                    aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">จำนวนเงิน</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" name="amount" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">บันทึก</label>
                            <div class="col-md-9 col-sm-9 ">
                                <textarea class="form-control" name="note" rows="3"
                                    placeholder="โอนจากหรือโอนไป"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="creState()" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
function creState() {
    var data = $('#form_state').serializeArray();
    $.ajax({
            url: '../bank_statement_create',
            type: 'POST',
            dataType: 'json',
            data: data,
        })
        .done(function(res) {
            if (res.code == 1) {
                swal({
                    icon: "success",
                    text: res.msg,
                });
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                swal({
                    icon: "error",
                    text: res.msg,
                });
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        })
        .fail(function() {
            console.log("error");
        });

}

function del_state(id) {
    swal({
        title: 'Are you sure?',
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                    url: 'bank/Del_state',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        state_id: id
                    },
                }).done(function(res) {
                    if (res.code == 1) {
                        swal({
                            icon: "success",
                            text: res.msg,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        swal({
                            icon: "error",
                            text: res.msg,
                        });
                    }
                })
                .fail(function() {
                    console.log("error");
                });
        }
    })
}
</script>
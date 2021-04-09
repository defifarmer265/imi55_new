

<div id="cover-spin"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>รายงานเซลล์รวมเทิน<small></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12 col-sm-12 ">

                <div class="x_content">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <form action="sale_pay" method="POST">
                                <div class="col-sm-4 ">
                                    วันเริ่ม
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                    <input value="<?= (isset($datefrom)) ? $datefrom : '' ?>" name="datefrom" type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="col-sm-4">
                                    วันสิ้นสุด
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                    <input value="<?= (isset($dateto)) ? $dateto : '' ?>" name="dateto" type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-1">
                                    <br>
                                    <button type="submit" class="btn btn-info">ค้นหา</button>
                                </div>
                            </form>
                            <br>
                            <br>
                            <div class="col-sm-12" style="margin: 0px auto; float: none;">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="card-box table-responsive">
                                            <table border="1" style="border: rgba(123,123,123,1.00);font-size: 14px;" width="100%" id="t_all">
                                                <thead >
                                                    <tr class="text-center" style="background-color:#1F07BB ; color:#FFF ;">
                                                        <th width="5%">No</th>
                                                        <th width="20%">Username</th>
                                                        <th width="25%">ชื่อเซลล์</th>
                                                        <th width="10%">ตั้งแต่</th>
                                                        <th width="10%">ถึง</th>
                                                        <th width="15%"> turnover </th>
                                                        <th width="15%"> win/lose <br>
                                                            <span style="font-size: 13px; color: rgba(239,90,93,1.00)"> **ติดลบคือลูกค้าเสีย</span>
                                                        </th>
                                                        
                                                    </tr>
                                                   
                                                </thead>
                                                <tbody>
                                                    <?php if (isset($data)) { ?>
                                                         <tr style="background-color: #78DDF1;font-style: italic">
                                                            <th colspan="5" class="text-right text-dark"> รวม &nbsp;&nbsp;</th>
                                                             <th class="text-right text-dark" style="text-decoration: underline;"><?=number_format($sumTr);?>&nbsp;</th>
                                                            <th class="text-right <?=$sumWl < 0 ? 'text-danger':''?> "style="text-decoration: underline;"><?=number_format($sumWl);?>&nbsp;</th>
                                                            
                                                         </tr> 
                                                    <?php   $i=1;
                                                        foreach ($data as $key => $value) { ?>

                                                            <tr>
                                                                <td class="text-center"><?=$i;?></td>
                                                                <td class="text-center"><?=$value->username;?></td>
                                                                <td class="text-center"><?=$value->name;?></td>
                                                                <td class="text-center"><?=date('d/m',strtotime($datefrom)) ;?> 11:00</td>
                                                                <td class="text-center"><?=date('d/m',strtotime($dateto));?> 10:59</td>
                                                                <td class="text-right font-weight-bold"><?=number_format($value->turnover);?>&nbsp;</td>
                                                                <td class="text-right font-weight-bold <?=$value->winlose < 0 ? 'text-danger':''?>"  ><?=number_format($value->winlose);?>&nbsp;</td>
                                                               
                                                            </tr>

                                                        <?php $i++; }
                                                    } else { ?>
                                                        <tr>
                                                            <td colspan="7"> กรุณาเลือกช่วงเวลา</td>
                                                        </tr>
                                                    <?php } ?>
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
</div>
</div>
</div>


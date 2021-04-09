<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style>
a {
    cursor: pointer;
}

.pter {
    cursor: pointer
}
</style>
<div id="cover-spin">
    <h2 class="text-center text-success py-5">โปรดรอสักครู่ ....</h2>
</div>
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
                <h2>รายการ ฝาก - ถอน ช่วงจำนวนเงิน</h2>
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
                    <select class="btn border" id="slectop">
                        <option value="all" selected>ทั้งหมด</option>
                        <option value="num_dep">รายการฝาก</option>
                        <option value="sum_dep">จำนวนเงินฝาก</option>
                        <option value="num_wit">รายการถอน</option>
                        <option value="sum_wit">จำนวนเงินถอน</option>
                    </select>
                </div>
                <div class="col-sm-2"><br>
                    <button onClick="select_period()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
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
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="emp_table" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%" style="font-size: 14px;">
                                    <thead style="background-color: #2a3f54;color: #fff;">
                                        <tr class="text-center">
                                            <th> ช่วงจำนวนเงิน </th>
                                            <th class="num_dep all box"> รายการฝาก </th>
                                            <th class="sum_dep all box"> จำนวนเงินฝาก </th>
                                            <th class="num_wit all box"> รายการถอน </th>
                                            <th class="sum_wit all box"> จำนวนเงินถอน </th>
                                        </tr>
                                    </thead>
                                    <!-- <tbody id="bodysum"></tbody> -->
                                    <tbody id="bodyhistory"></tbody>

                                </table>
                            </div>
                            <div class="row" id="list"></div>
                        </div>
                        <div class="col-sm-9">
                            <div class="card-box table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%" style="font-size: 14px;">
                                    <thead>
                                    </thead>
                                    <!-- <tbody id="bodysum"></tbody> -->
                                    <tbody id="bodytrdep"></tbody>
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

function select_period() {
    $('#cover-spin').show();
    $('#bodyhistory').html('');
    // $('#bodysum').html('');
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    var tm1 = $('#time1').val();
    var tm2 = $('#time2').val();
    var dt3 = $('#slectop').val();
    // console.log(dt3);
    if (dt3 == 'all') {
        console.log('12345');
    }
    $.ajax({
            url: '<?=base_url()?>owner/report_period/rp_us',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: dt1,
                dt2: dt2,
                dt3: dt3,
                tm1: tm1,
                tm2: tm2
            },
        })
        .done(function(res) {
            console.log(res);
            if (res.code == 1) {
                // console.log(res.data);
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    var tt_num_dp = 0;
                    var tt_sum_dp = 0;
                    var tt_num_wd = 0;
                    var tt_sum_wd = 0;
                    var tt_all = 0;
                    var tt_tota = 0;
                    console.log(dt1);
                    for (var i = 0; i < conut; i++) {
                        var num_dep300 = parseFloat(wd[i]['num_dep300']);
                        var sum_dep300 = parseFloat(wd[i]['sum_dep300']);
                        var num_wd300 = parseFloat(wd[i]['num_wd300']);
                        var sum_wd300 = parseFloat(wd[i]['sum_wd300']);

                        var num_dep1000 = parseFloat(wd[i]['num_dep1000']);
                        var sum_dep1000 = parseFloat(wd[i]['sum_dep1000']);
                        var num_wd1000 = parseFloat(wd[i]['num_wd1000']);
                        var sum_wd1000 = parseFloat(wd[i]['sum_wd1000']);

                        var num_dep5000 = parseFloat(wd[i]['num_dep5000']);
                        var sum_dep5000 = parseFloat(wd[i]['sum_dep5000']);
                        var num_wd5000 = parseFloat(wd[i]['num_wd5000']);
                        var sum_wd5000 = parseFloat(wd[i]['sum_wd5000']);

                        var num_dep10000 = parseFloat(wd[i]['num_dep10000']);
                        var sum_dep10000 = parseFloat(wd[i]['sum_dep10000']);
                        var num_wd10000 = parseFloat(wd[i]['num_wd10000']);
                        var sum_wd10000 = parseFloat(wd[i]['sum_wd10000']);

                        var num_dep50000 = parseFloat(wd[i]['num_dep50000']);
                        var sum_dep50000 = parseFloat(wd[i]['sum_dep50000']);
                        var num_wd50000 = parseFloat(wd[i]['num_wd50000']);
                        var sum_wd50000 = parseFloat(wd[i]['sum_wd50000']);

                        var num_dep100000 = parseFloat(wd[i]['num_dep100000']);
                        var sum_dep100000 = parseFloat(wd[i]['sum_dep100000']);
                        var num_wd100000 = parseFloat(wd[i]['num_wd100000']);
                        var sum_wd100000 = parseFloat(wd[i]['sum_wd100000']);

                        var num_dep100000up = parseFloat(wd[i]['num_dep100000+']);
                        var sum_dep100000up = parseFloat(wd[i]['sum_dep100000+']);
                        var num_wd100000up = parseFloat(wd[i]['num_wd100000+']);
                        var sum_wd100000up = parseFloat(wd[i]['sum_wd100000+']);

                        tt_num_dp = tt_num_dp + num_dep300 + num_dep1000 + num_dep5000 + num_dep10000 +
                            num_dep50000 + num_dep100000 + num_dep100000up;
                        tt_sum_dp = tt_sum_dp + sum_dep300 + sum_dep1000 + sum_dep5000 + sum_dep10000 +
                            sum_dep50000 + sum_dep100000 + sum_dep100000up;
                        tt_num_wd = tt_sum_wd + num_wd300 + num_wd1000 + num_wd5000 + num_wd10000 + num_wd50000 +
                            num_wd100000 + num_wd100000up;
                        tt_sum_wd = tt_sum_wd + sum_wd300 + sum_wd1000 + sum_wd5000 + sum_wd10000 + sum_wd50000 +
                            sum_wd100000 + sum_wd100000up;
                        if (dt3 == 'all') {
                            content += '<tr>';
                            content += '<td class=" hid text-right"> <= 299 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="299" onClick="select_dep(this,0)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_dep300) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(sum_dep300.toFixed(2)) +
                                '</td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="299" onClick=" select_withdraw(this,0)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_wd300) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(sum_wd300.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 300 - 999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="300" data-money ="999" onClick="select_dep(this,1)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep1000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(sum_dep1000.toFixed(2)) +
                                '</td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="300" data-money ="999" onClick=" select_withdraw(this,1)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_wd1000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(sum_wd1000.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 1,000 - 4,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="1000" data-money ="4999" onClick="select_dep(this,2)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep5000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(sum_dep5000.toFixed(2)) +
                                '</td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="1000" data-money ="4999" onClick=" select_withdraw(this,2)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_wd5000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(sum_wd5000.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 5,000 - 9,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="5000" data-money ="9999" onClick="select_dep(this,3)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep10000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(sum_dep10000.toFixed(2)) +
                                '</td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="5000" data-money ="9999" onClick=" select_withdraw(this,3)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_wd10000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(sum_wd10000.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 10,000 - 49,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="10000" data-money ="49999" onClick="select_dep(this,4)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep50000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(sum_dep50000.toFixed(2)) +
                                '</td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="10000" data-money ="49999" onClick=" select_withdraw(this,4)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_wd50000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(sum_wd50000.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 50,000 - 99,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="50000" data-money ="99999" onClick="select_dep(this,5)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep100000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(sum_dep100000.toFixed(2)) +
                                '</td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="50000" data-money ="100000" onClick=" select_withdraw(this,5)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_wd100000) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(sum_wd100000.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 100,000 ขึ้นไป </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="100000" onClick="select_dep(this,6)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep100000up) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(sum_dep100000up.toFixed(
                                2)) + '</td>';
                            content += '<td class=" hid text-right">' +
                                '<a  data-money ="100000"  onClick=" select_withdraw(this,6)" class="text-primary pter" style="ptext-decoration: underline;" target="_blank">' +
                                nb(num_wd100000up) + '</a>' + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(sum_wd100000up.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> รวม </td>';
                            content += '<td class=" hid text-right text-primary">' + nb(tt_num_dp) + '</td>';
                            content += '<td class=" hid text-right text-success">' + nb(tt_sum_dp.toFixed(2)) +
                                '</td>';
                            content += '<td class=" hid text-right text-primary">' + nb(tt_num_wd) + '</td>';
                            content += '<td class=" hid text-right text-danger">' + nb(tt_sum_wd.toFixed(2)) +
                                '</td>';
                            content += '</tr>';
                        } else if (dt3 == 'num_dep') {
                            content += '<tr>';
                            content += '<td class=" hid text-right"> <= 299 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="299" onClick="select_dep(this,0)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep300) + '</a>' + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 300 - 999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money1 ="300" data-money2 ="999" onClick="select_dep(this,1)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep1000) + '</a>' + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 1,000 - 4,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money1 ="1000" data-money2 ="4999" onClick="select_dep(this,2)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep5000) + '</a>' + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 5,000 - 9,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money1 ="5000" data-money2 ="9999" onClick="select_dep(this,3)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep10000) + '</a>' + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 10,000 - 49,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money1 ="10000" data-money2 ="49999" onClick="select_dep(this,4)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep50000) + '</a>' + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 50,000 - 99,999 </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money1 ="50000" data-money2 ="99999" onClick="select_dep(this,5)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep100000) + '</a>' + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 100,000 ขึ้นไป </td>';
                            content += '<td class=" hid text-right">' +
                                '<a data-money ="100000" onClick="select_dep(this,6)" class="text-primary pter" style="ptext-decoration: underline;">' +
                                nb(num_dep100000up) + '</a>' + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right" > รวม </td>';
                            content += '<td class=" hid text-right text-primary">' + nb(tt_num_dp) + '</td>';
                            content += '</tr>';
                        } else if (dt3 == 'sum_dep') {
                            content += '<tr>';
                            content += '<td class=" hid text-right"> <= 299 </td>';
                            content += '<td class=" hid  text-right">' + nb(sum_dep300.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 300 - 999 </td>';
                            content += '<td class=" hid  text-right">' + nb(sum_dep1000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 1,000 - 4,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_dep5000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 5,000 - 9,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_dep10000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 10,000 - 49,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_dep50000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 50,000 - 99,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_dep100000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class="hid text-right"> 100,000 ขึ้นไป </td>';
                            content += '<td class="hid  text-right">' + nb(sum_dep100000up.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right" > รวม </td>';
                            content += '<td class=" hid text-right">' + nb(tt_sum_dp.toFixed(2)) + '</td>';

                            content += '</tr>';
                        } else if (dt3 == 'num_wit') {
                            content += '<tr>';
                            content += '<td class=" hid text-right"> <= 299 </td>';
                            content +=
                                '<td  data-money ="300" onClick=" select_withdraw(this,0)" class=" hid text-right text-primary pter">' +
                                nb(num_wd300) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 300 - 999 </td>';
                            content +=
                                '<td  data-money1 ="301" data-money2 ="1000" onClick=" select_withdraw(this,1)" class=" hid text-right text-primary pter">' +
                                nb(num_wd1000) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 1,000 - 4,999 </td>';
                            content +=
                                '<td  data-money1 ="1000" data-money2 ="4999" onClick=" select_withdraw(this,2)" class=" hid text-right text-primary pter">' +
                                nb(num_wd5000) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 5,000 - 9,999 </td>';
                            content +=
                                '<td  data-money1 ="5000" data-money2 ="9999" onClick=" select_withdraw(this,3)" class=" hid text-right text-primary pter">' +
                                nb(num_wd10000) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 10,000 - 49,999 </td>';
                            content +=
                                '<td  data-money1 ="10000" data-money2 ="49999" onClick=" select_withdraw(this,4)" class=" hid text-right text-primary pter">' +
                                nb(num_wd50000) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 50,000 - 99,999 </td>';
                            content +=
                                '<td  data-money1 ="50000" data-money2 ="99999" onClick=" select_withdraw(this,5)" class=" hid text-right text-primary pter">' +
                                nb(num_wd100000) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 100,000 ขึ้นไป </td>';
                            content +=
                                '<td data-money1 ="100000" onClick=" select_withdraw(this,6)" class=" hid text-right text-primary pter" >' +
                                nb(num_wd100000up) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right" > รวม </td>';
                            content += '<td class=" hid text-right text-primary ">' + nb(tt_num_wd) + '</td>';
                            content += '</tr>';
                        } else if (dt3 == 'sum_wit') {
                            content += '<tr>';
                            content += '<td class=" hid text-right"> <= 299 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_wd300.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 30 - 999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_wd1000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 1,000 - 4,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_wd5000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 5,000 - 9,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_wd10000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 10,000 - 49,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_wd50000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 50,000 - 99,999 </td>';
                            content += '<td class=" hid text-right">' + nb(sum_wd100000.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right"> 100,000 ขึ้นไป </td>';
                            content += '<td class=" hid text-right">' + nb(sum_wd100000up.toFixed(2)) + '</td>';
                            content += '</tr>';
                            content += '<tr>';
                            content += '<td class=" hid text-right" > รวม </td>';
                            content += '<td class=" hid text-right">' + nb(tt_sum_wd.toFixed(2)) + '</td>';
                            content += '</tr>';
                        }
                    }

                } else {
                    var content = '<div class="alert alert-danger text-white" role="alert">!ไม่มีข้อมูล</div>';
                    var sum = '';
                }
                // $('#bodysum').html(sum);
                $('#bodyhistory').html(content);
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#cover-spin').hide();

        })
        .fail(function() {
            console.log("error");
        });
}

$(document).ready(function() {
    $("select").change(function() {
        $(this).find("option:selected").each(function() {
            var optionValue = $(this).attr("value");
            console.log(optionValue);
            if (optionValue) {
                $(".box").not("." + optionValue).hide();
                $(".hid").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else {
                $(".box").hide();
            }
        });
    }).change();
});

function nb(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function select_dep(d, c) {
    $('#cover-spin').show();
    $('#bodytrdep').html('');
    $('#list').html('');
    var money = $(d).data('money');
    console.log(money);
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    console.log(dt1);
    console.log(dt2);
    $.ajax({
            url: '<?=base_url()?>owner/List_dep/list_deposit',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: dt1,
                dt2: dt2,
                money: money,
                ch: c
            },
        })
        .done(function(res) {
            // console.log(res.data.user.date);
            if (res.code == 1) {
                // console.log(res.data);
                if (res.data.user.length >= 1) {
                    var conut = res.data.user.length;

                    var wd = res.data.user;
                    var content = '';
                    var con = '';
                    // console.log(dt1);
                    con += '<div  class="x_title col-9">';
                    if (money == 299) {
                        con += '<h2>รายการฝาก ช่วงจำนวนเงินน้อยกว่า ' + money + '</h2>';
                    }
                    if (money == 300) {
                        con += '<h2>รายการฝาก ช่วงจำนวนเงินระหว่าง  300 - 999 </h2>';
                    }
                    if (money == 1000) {
                        con += '<h2>รายการฝาก ช่วงจำนวนเงินระหว่าง  1,000 - 4,999 </h2>';
                    }
                    if (money == 5000) {
                        con += '<h2>รายการฝาก ช่วงจำนวนเงินระหว่าง  5,000 - 9,999 </h2>';
                    }
                    if (money == 10000) {
                        con += '<h2>รายการฝาก ช่วงจำนวนเงินระหว่าง   10,000 - 49,999 </h2>';
                    }

                    if (money == 50000) {
                        con += '<h2>รายการฝาก ช่วงจำนวนเงินระหว่าง   50,000 - 99,999 </h2>';
                    }
                    if (money == 100000) {
                        con += '<h2>รายการฝาก ช่วงจำนวนเงินมากกว่า > 100,000  </h2>';
                    }


                    con += '</div>';
                    content += '<tr  style="background-color: #2a3f54;color: #fff;">';
                    content += '<th class="text-center" >ลำดับ</td>';
                    content += '<th class="text-center" >User</td>';
                    content += '<th class="text-center" >จำนวนฝาก</td>';
                    content += '<th class="text-center" >วันที่ฝาก</td>';
                    content += '<th class="text-center" >เวลาที่ฝาก</td>';
                    content += '</tr>';
                    for (var i = 0; i < conut; i++) {
                        var date = new Date(wd[i].dateCreate * 1000).format('d-m-Y');
                        var time = new Date(wd[i].dateCreate * 1000).format('H:i:s');
                        // console.log(wd[i].user);
                        content += '<tr>';
                        content += '<td class="text-center">' + (i + 1) + ' </td>';
                        content += '<td class="text-right">' + wd[i].user + ' </td>';
                        content += '<td class="text-right">' + nb(wd[i].deposit) + ' </td>';
                        content += '<td class="text-right">' + date + ' </td>';
                        content += '<td class="text-right">' + time + ' </td>';
                        content += '</tr>';
                    }
                } else {
                    var content = '<div class="alert alert-danger text-white" role="alert">!ไม่มีข้อมูล</div>';
                }
                // $('#bodysum').html(sum);
                $('#bodytrdep').html(content);
                $('#list').html(con);
                // $('#head').html(content);
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#cover-spin').hide();

        })
        .fail(function() {
            console.log("error");
        });
}

function select_withdraw(d, c) {
    $('#cover-spin').show();
    $('#bodytrdep').html('');
    $('#list').html('');
    var money = $(d).data('money');
    var dt1 = $('#single_cal2').val();
    var dt2 = $('#single_cal3').val();
    console.log(dt1);
    console.log(dt2);
    console.log(money);
    $.ajax({
            url: '<?=base_url()?>owner/List_dep/list_withdraw',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: dt1,
                dt2: dt2,
                money: money,
                ch: c
            },
        })
        .done(function(res) {
            // console.log(res.data.user.date);
            if (res.code == 1) {
                // console.log(res.data);
                if (res.data.user.length >= 1) {
                    var conut = res.data.user.length;
                    var wd = res.data.user;
                    var content = '';
                    var con = '';
                    // console.log(dt1);
                    con += '<div  class="x_title col-9">';
                    if (money == 299) {
                        con += '<h2>รายการถอน ช่วงจำนวนเงินน้อยกว่า ' + money + '</h2>';
                    }
                    if (money == 300) {
                        con += '<h2>รายการถอน ช่วงจำนวนเงินระหว่าง  300 - 999 </h2>';
                    }
                    if (money == 1000) {
                        con += '<h2>รายการถอน ช่วงจำนวนเงินระหว่าง  1,000 - 4,999 </h2>';
                    }
                    if (money == 5000) {
                        con += '<h2>รายการถอน ช่วงจำนวนเงินระหว่าง  5,000 - 9,999 </h2>';
                    }
                    if (money == 10000) {
                        con += '<h2>รายการถอน ช่วงจำนวนเงินระหว่าง   10,000 - 49,999 </h2>';
                    }

                    if (money == 50000) {
                        con += '<h2>รายการถอน ช่วงจำนวนเงินระหว่าง   50,000 - 99,999 </h2>';
                    }
                    if (money == 100000) {
                        con += '<h2>รายการถอน ช่วงจำนวนเงินมากกว่า > 100,000  </h2>';
                    }
                    con += '</div>';
                    content += '<tr  style="background-color: #2a3f54;color: #fff;">';
                    content += '<th class="text-center" >ลำดับ</td>';
                    content += '<th class="text-center" >User</td>';
                    content += '<th class="text-center" >จำนวนถอน</td>';
                    content += '<th class="text-center" >วันที่ถอน</td>';
                    content += '<th class="text-center" >เวลาที่ถอน</td>';
                    content += '</tr>';
                    for (var i = 0; i < conut; i++) {
                        var date = new Date(wd[i].dateCreate * 1000).format('d-m-Y');
                        var time = new Date(wd[i].dateCreate * 1000).format('H:i:s');
                        // console.log(wd[i].user);
                        content += '<tr>';
                        content += '<td class="text-center">' + (i + 1) + ' </td>';
                        content += '<td class="text-right">' + wd[i].user + ' </td>';
                        content += '<td class="text-right">' + wd[i].withdraw + ' </td>';
                        content += '<td class="text-right">' + date + ' </td>';
                        content += '<td class="text-right">' + time + ' </td>';
                        content += '</tr>';
                    }
                } else {
                    var content = '<div class="alert alert-danger text-white" role="alert">!ไม่มีข้อมูล</div>';
                }
                // $('#bodysum').html(sum);
                $('#bodytrdep').html(content);
                $('#list').html(con);
                // $('#head').html(content);
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#cover-spin').hide();

        })
        .fail(function() {
            console.log("error");
        });
}
</script>
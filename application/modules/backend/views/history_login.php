
<style>
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

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ตรวจสอบประวัติสมาชิกที่ไม่ได้เข้าสู่ระบบ<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">

                    <div class="x_content">
                        <div class="col-md-12 col-sm-12">
                            <form id="form_T">
                                <div class="row radio">
                                    <div class="col-md-4">
                                        <input type="hidden" id="">
                                        <div class="">

                                            <label style="padding: 12px">
                                                <input type="radio" class="flat" name="type" value="7 วัน"> 7 วัน
                                            </label>
                                            <label style="padding: 12px">
                                                <input type="radio" class="flat" name="type" value="15 วัน"> 15 วัน
                                            </label>
                                            <label style="padding: 12px">
                                                <input type="radio" class="flat" name="type" value="30 วัน"> 30 วัน
                                            </label>
                                            <label style="padding: 12px">
                                                <input type="radio" class="flat" name="type" value="นานกว่า 60 วัน"> นานกว่า 60 วัน
                                            </label>
                                            <label style="padding: 12px">
                                                <input type="radio" class="flat" name="type" value="สมาชิกทั้งหมด"> สมาชิกทั้งหมด
                                            </label>


                                        </div>

                                    </div>
                                    <div class="col-sm-2">
                                            <button type="button" onClick="setTperiod()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
                                            <div class="" id="button"></div>
                                    </div> 
                                </div>
                            </form>
                            
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%" id="t_all">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr>
                                                <th>No</th>
                                                <th>รหัส</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>วันที่ Login ล่าสุด</th>
                                                <th>วันที่สร้าง</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyhistory"> </tbody>
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

<script type="text/javascript">


function setTperiod() {

    $('#cover-spin').show();

    if  ($("input[type='radio'].flat").is(':checked')) {

        var data = $("input[name='type']:checked").val();
            $('#t_all').DataTable().destroy(); 
            $('#bodyhistory').html('');
            $.ajax({
                    url: 'History_login/Tperiod',
                    type: 'POST',
                    dataType: 'json',
                    data: {data}, 
                })

                .done(function(res) {
                    $('#cover-spin').hide();

                    if (res.code == 1) {
                        var count = res.data.length;
                        var one = res.data;
                        var content = '';
                            

                            if (count > 0) {
        
                                for (var i = 0; i < count; i++) {

                                        content += '<tr align="center">'
                                        content += '<td>' + [i + 1] + '</td>'
                                        content += '<td>' + one[i]['user'] + '</td>'
                                        content += '<td>' + one[i]['username'] + '</td>'
                                        content += '<td>' + one[i]['login_time'] + '</td>'
                                        content += '<td>' + one[i]['create_time'] + '</td>'
                                        content += '</tr>';
                                    }
                                    
                            }

                    $('#bodyhistory').html(content);
                    $('#button').html(button);

                    }else{
                        swal({
                          title: "error",
                          text: "ผิดพลาด",
                          icon: "error",
                        });
                    }

                    // Export to Excel
                    new $('#t_all').DataTable({ 
                                    "lengthMenu": [ [10, 25, 50, -1],   [10, 25, 50, "all"] ], 
                                    responsive: true,
                                    fixedHeader: true,

                                    dom:
                                    "<'row'<'col-sm-2'l><'col-sm-10'f>>" +
                                    "<'row'<'col-sm-12'B>>" +
                                    "<'row'<'col-sm-12'tr><'col-sm-4'i><'col-sm-8'p>>",

                                    buttons: [{ 
                                        extend: 'excel' ,
                                        text: '<span class="btn btn-lg btn-success fa fa-file-excel-o"> Excel</span> ',

                                        title: data,

                                    }],

                                    

                     });

                    })


                .fail(function() {
                    console.log("error");
                });


    }else{

        swal({
            title: "เลือกช่วงเวลา",
            text: "กรุณาเลือกช่วงเวลา",
            icon: "warning",
        });

    }

}



</script>
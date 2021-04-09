<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<style>
  .swal-overlay {
  background-color: rgba(43, 165, 137, 0.45);
}
  #hidden_div {
    display: none;
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
<link href="<?php echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Push Message<small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                 <div class="text-center">
                <button class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" disabled id="edit_cus" onclick="sendline_id()"> ส่งข้อมูล </button>
                </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr>
                      <td class="text-center">
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="head_c" class="form-check-input" onchange="pre_ch(this.checked);">
                                            ทั้งหมด
                                            <i class="input-helper"></i>
                                            <div id="check"></div>
                                        </label>
                                    </div>
                     </td>
                      <th class="text-center">ลำดับ</th>
                      <th>ชื่อไลน์</th>
                      <th>username</th>
                      <th>Line ID</th>
                      </tr>
                    </thead>
                    <tbody>
                  <tr>
                  <?php
                    if ( !empty( $user ) ) {
                      $i = 1;
                      foreach ( $user as $key => $state ) {
                         foreach($line_id as $key => $line) {
                          if($line['tel']==$state['username']){
                        ?>
                   <td class="text-center" width="8%">
                                         <div class="form-check form-check-warning">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input pre_ch" data-line_id="<?= $line['line_id']; ?>" data-line="<?= $state['line']; ?>" data-username="<?= $state['username']; ?>" onChange="s_check();">
                                                    &nbsp;
                                                    <i class="input-helper"></i>
                                                </label>
                                        </div>
                     </td>
                    <td class="text-center" width="8%"><?=$i?></td>
                    <td><?= $state['line']?></td>
                    <td><?= $state['username']?></td>
                    <td><?= $line['line_id']?></td>
                  </tr>    
                  <?php  $i++;}}}} ?>
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


<!-- modal จัดการ-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Push Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">เลือก type ที่ต้องการส่ง</label>
                            <select class="form-control" id="type" style="font-size: 1.5em;" onchange="showDiv(this)">
                                <option value="1">ข้อความ</option>
                                <option value="2">สติกเกอร์</option>
                                <option value="3">รูปภาพ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 text" >
                        <div class="form-group">
                        <div class="input-group flex-nowrap" >
                        <textarea type="text" class="form-control" id="message" rows="3" placeholder="ข้อความที่ต้องการส่ง"></textarea>
                        <!-- <input type="text" class="form-control" id=message placeholder="ข้อความที่ต้องการส่ง" aria-label="ข้อความที่ต้องการส่ง" aria-describedby="addon-wrapping"> -->
                        </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer text">
                    <koday id="Arline" hidden></koday>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="send_message()">Send</button>
                </div>
                <form id="sticker">
                <div class="form-group">
                  <input type="number" class="form-control" id="packageid"  placeholder="packageID">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="stickerid" placeholder="stickerID">
                </div>
                <div class="text-right">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="send_sticker()">Send</button>
                </div>
              </form>
              <form id="image">
                <div class="form-group">
                  <input type="text" class="form-control" id="imageid"  placeholder="url-image">
                </div>
                <div class="text-right">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="send_image()">Send</button>
                </div>
              </form>
              <div >
                <div class="table-responsive">
                <table id="tb_line" class="table table-striped">
                </table>
                </div>
              </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
  $('#datatable-responsive').dataTable({
    "pageLength": 50
  });
  function showDiv(element)
{
  if(element.value==1){
    $('.text').show();
    $('#sticker').hide();
    $('#image').hide();
  }else if(element.value==2){
    $('.text').hide();
    $('#image').hide();
    $('#sticker').show();
  }else if(element.value==3){
    $('.text').hide();
    $('#sticker').hide();
    $('#image').show();
  }
}
  function sendline_id(){
  $('#text').show();
  $('#sticker').hide();
  $('#image').hide();
  var sl = $(".pre_ch:checked");
  var tr = '';
        $("#tb_line").html(tr);
            tr += '<thead class="thead-light">';
            tr += '<th class ="text-center" width="15%">รายการที่เลือก</th>';
            tr += '<th width="9%">ลับดับ</th>';
            tr += '<th>ชื่อไลน์</th>';
            tr += '<th>username</th>';
            tr += '<th>Line_ID</th>';
            tr += '</thead>';
        for (let i = 0; i < sl.length; i++) {
            tr += '<tr>';
            tr += '<td  class ="text-center" width="15%"><i class="fa fa-check-square" aria-hidden="true"></i></td>';
            tr += '<td width="9%">' + (i + 1) + '</td>';
            tr += '<td>' + $(sl[i]).data('line') + '</td>';
            tr += '<td>' + $(sl[i]).data('username') + '</td>';
            tr += '<td>' + $(sl[i]).data('line_id') + '</td>';
            tr += '</tr>';
          }
$("#tb_line").html(tr);
  }
  function pre_ch(ch) {
        if (ch) {
            //			console.log(ch);
            $('.pre_ch').prop('checked', true);
        } else {
            //			console.log(ch);
            $('.pre_ch').prop('checked', false);
        }
        setbutton();
        show_check();
    }
    function s_check() {
        //console.log($( ".pre_ch" ).length);
        if ($(".pre_ch").length == $(".pre_ch:checked").length) {
            $('#head_c').prop('checked', true);
        } else {
            $('#head_c').prop('checked', false);
        }
        setbutton();
        show_check();
    }
    function setbutton() {
        if ($(".pre_ch:checked").length > 0) {
            $('#edit_cus').removeAttr('disabled');
        } else {

            $('#edit_cus').attr("disabled", true);
        }
    }
    function show_check() {
        var n = $(".pre_ch:checked").length;
        $("#check").text(n + (n === 1 ? "  รายการ" : " รายการ") + "ที่เลือก");
    }
    function send_message() {
        var sl = $(".pre_ch:checked");
        var mes = [];
        var DArray = [];
        var message = $('#message').val();
        if (message=='') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'กรุณากรอกข้อความ !!!',
            })
            return false;
        }
        if (message != ' ') {
            mes.push({
                message,
            });
        }
        for (let i = 0; i < sl.length; i++) {
            DArray.push({
                'line_id': ['"'+$(sl[i]).data('line_id')+'"'],
                'packageId': [' '],
                'stickerId': [' '],
                'message': mes,
                'image': [' '],
            });

        }
        sentArraydata(DArray);
        console.log(DArray);
    }
    function send_sticker(){
      var packageid = $('#packageid').val();
      var stickerid = $('#stickerid').val();
      console.log(packageid);
      console.log(stickerid);
      var packageID = [];
      var stickerID = [];
      var DArray = [];
      var sl = $(".pre_ch:checked");
      if (packageid=='' || stickerid=='') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'กรุณากรอก ID !!!',
            })
            return false;
        }
        if (packageid != ' ' && stickerid != ' ' ) {
            packageID.push({
               packageid,
            });
            stickerID.push({
              stickerid,
            });
        }
        for (let i = 0; i < sl.length; i++) {
            DArray.push({
                'line_id': ['"'+$(sl[i]).data('line_id')+'"'],
                'packageId': packageID,
                'stickerId': stickerID,
                'message': ['sticker'],
                'image': [' '],
            });
        }
         sentArraydata(DArray);
        console.log(DArray);
    }
    function send_image() {
        var sl = $(".pre_ch:checked");
        var imageArray = [];
        var DArray = [];
        var image = $('#imageid').val();
        console.log(image);
        if (image=='') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'กรุณากรอก url-image !!!',
            })
            return false;
        }
        if (image != ' ') {
          imageArray.push({
              image,
            });
        }
        for (let i = 0; i < sl.length; i++) {
            DArray.push({
                'line_id': ['"'+$(sl[i]).data('line_id')+'"'],
                'packageId': [' '],
                'stickerId': [' '],
                'message': ['image'],
                'image': imageArray,
            });

        }
        sentArraydata(DArray);
        console.log(DArray);
    }
function sentArraydata(DataArray) {
        $.ajax({
                method: "POST",
                url: '<?php base_url()?>Push_message/sent_data_line',
                data: {
                    data: JSON.stringify(DataArray),
                },
                dataType: 'json'
            })
            .done(function(msg) {
                Swal.fire({
                            icon: 'success',
                            title: 'ส่งเรียบร้อย',
                            showConfirmButton: false,
                            timer: 1000
                            });
                    // setTimeout(function() {
                    //             location.reload();
                    //         }, 1000);
                // location.reload();
                // $('.modal').modal('hide');
            })
            .fail(function(err) {
                // console.log(err);             
            });
}
</script>
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>SALE<small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-reorder"></i> </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" onClick="cre_sale()">เพิ่มเซลล์</a> </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <ul class="nav navbar-right panel_toolbox">

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-10 col-sm-10" style="margin: 0px auto; float: none;">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12 ">
                <div class="card-box ">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
                    <thead style="background-color:#12205F;color: #FFF">
                      <tr align="center">
                        <th width="5%"> No</th>
                        <th> Username </th>
                        <th> Name </th>
                        <th> จำนวนลูกค้า/วัน </th>
                        <th> จำนวนลูกค้า/เดือน</th>
                        <th> จำนวนลูกค้าทั้งหมด </th>
                        <th> Link for share </th>
                        <th> status (on/off) </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      foreach ($sale as $_s => $ds) { ?>
                        <tr align="center">
                          <td><?php echo $i; ?></td>
                          <td><a href="index/<?php echo $ds['id']; ?>"><?php echo $ds['username']; ?></a></td>
                          <td><?php echo $ds['name']; ?></td>
                          <?php foreach ($ds['day_sale'] as $du) { ?>
                            <td><?php echo $du['ud']; ?></td>
                          <?php } ?>
                          <?php foreach ($ds['month_sale'] as $mu) { ?>
                            <td><?php echo $mu['md']; ?></td>
                          <?php } ?>
                          <?php foreach ($ds['all_sale'] as $sm) { ?>
                            <td><?php echo $sm['saleid']; ?></td>
                          <?php } ?>
                          <!-- Button trigger modal -->
                          <td>
                            <button type="button" class="btn btn-secondary btn-sm" onClick="getLink('<?= $ds['token'] ?>', '<?=$ds['id']?>')">
                              <i class="fa fa-share"></i>
                            </button>
                          </td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" data-id="<?= $ds['id'] ?>" data-hhh="<?=$ds['name']?>" onchange="updateS_sale(this)" <?php if ($ds['status'] == 1) {
                                                                                                              echo "checked";
                                                                                                            } ?>>
                              <span class="slider round"></span>
                            </label>

                          </td>
                          <!-- End button trigger modal -->
                        </tr>
                      <?php $i++;
                      } ?>
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
<!-- get link modal -->
<div class="modal fade" id="getLink" tabindex="-1" role="dialog" aria-labelledby="getLinkLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="getLinkLabel">ลิ้งค์การสมัคร</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="clear_qrcode()">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <input type="text" id="span_getLink" class="form-control"><br>
        <input type="hidden" id="sale_id"  value=""><br>
        <button type="button" class="btn btn-info float-right" onClick="upDateLink()" data-toggle="popover" data-content="copy">Update Link</button>
        <div id="demoqr" style="margin-top:50px;margin-left:130px;"></div>
        
      </div>
      <div class="modal-footer">
        <p class="text-success"></p>
        <button type="button" class="btn btn-info float-right" onClick="copyLink()" data-toggle="popover" data-content="copy">Copy Link</button>
        <button type="button" class="btn btn-info float-right" onClick="clear_qrcode()" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<!-- end get link modal-->

<!-- Add sale -->
<div class="modal fade " tabindex="-1" role="dialog" id="m_creSale" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มเซลล์</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask " id="form_creSale">
        <div class="modal-body">
          <div class="x_content"> <br />
            <div class="col-md-12 col-sm-12  form-group has-feedback ">
              <input type="text" class="form-control has-feedback-left" id="edit_name" name="name" placeholder="ชื่อ">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
            <div class="col-md-12 col-sm-12  form-group has-feedback">
              <div class="input-group">
                <input type="text" name="username" placeholder="Username" class="form-control"><span class="input-group-btn"></span>
              </div>
            </div>
            <div class="col-md-12 col-sm-12  form-group has-feedback">
              <input type="text" class="form-control" id="inputSuccess5" name="password" placeholder="Password">
              <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span> </div>

          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button onClick="cre_sale2()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- End add sale -->
<!-- JS -->
<script src="<?php echo base_url() ?>public/tem_frontend/js/qrcode.min.js"></script>
<!-- END JS -->
<script>
  function updateS_sale(d) {
    var status = $(d).context.checked;


    if(status){
      status = 1;
    }else{
      status = 0;
    }
    var data = {
      id: $(d).data('id'),
      status: status
    };
    // console.log(data);
    $.ajax({
        url: 'updateS_sale',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        
          // console.log(res);

      })
      .fail(function() {
        console.log("error");
      });

  }



  function cre_sale() {

    $('#m_creSale').modal();

  }

  function cre_sale2() {
    var data = $('#form_creSale').serializeArray();
    $.ajax({
        url: 'cre_sale1',
        type: 'POST',
        dataType: 'json',
        data: data,
      })
      .done(function(res) {
        if (res.code == 1) {
          console.log("success");
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

  function getLink(token,id) {
    
    $('#getLink').modal();
    $('#span_getLink').val('<?= base_url() ?>users/home/index/' + token);
    $('#sale_id').val(id);
    var qrcode = new QRCode(document.getElementById("demoqr"), {
      text: "<?= base_url() ?>users/home/index/" + token,
      width: 186,
      height: 186
    });


  }

  function clear_qrcode() {

    $('#demoqr').empty();

  }

  function copyLink() {

    var copyLink = document.getElementById("span_getLink");
    const showText = document.querySelector("p");
    /* Select the text field */
    copyLink.select();
    copyLink.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");
    showText.innerHTML = 'คัดลอกสำเร็จ'
    setTimeout(() => {
      showText.innerHTML = ''
    }, 4000)

  }

  function upDateLink(){

    var sale_id = $('#sale_id').val();
    $.ajax({
        url: '<?=base_url()?>backend/sale/update_token',
        type: 'POST',
        dataType: 'json',
        data: {sale_id:sale_id},
      })
      .done(function(res) {
        if (res.code == 1) {
          swal({
            icon: "success",
            text: res.msg,
          });
          $('#demoqr').empty(); 
          $('#span_getLink').val('<?= base_url() ?>users/home/index/' + res.token.token);
          var qrcode = new QRCode(document.getElementById("demoqr"), {
            text: "<?= base_url() ?>users/home/index/" + res.token.token,
            width: 186,
            height: 186
    });
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
</script>
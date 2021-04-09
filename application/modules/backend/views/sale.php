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

          <div class="x_content" >
            <div class="row" >
              <div class="col-sm-12 ">
                <div class="card-box ">
                <table width="100%" class="table-bordered" >
                   <thead >
                      <tr align="center">
                        <th width="3%" rowspan="2"> No</th>
						<th rowspan="2"> ชื่อเซลล์ </th>
						<th rowspan="2"> ลูกค้า/วัน </th>
                        <th colspan="5"> ลูกค้า/เดือน</th>
						<th rowspan="2"> สุทธิ์ลูกค้ารายเดือน </th>
                      </tr>
					  <tr align="center">
						<th> จำนวน </th>
                        <th> ยอดแรก</th>
                        <th> ยอดสอง</th>
                        <th> ยอดฝากรวม</th>
                        <th> เทิร์น7วัน</th>
   
                      </tr>
					  
                    </thead>
                    <tbody>
						<?php $i=1; foreach($sale as $s){ ?>
                      <tr>
						<td class="text-center"><?=$i?></td>
						<td><?=$s['name']?></td>
						<td class="text-center"><?=$s['us_d'] != 0?$s['us_d']:'-'?></td>
						<td class="text-center"><?=$s['us_m'] != 0?$s['us_m']:'-'?></td>
						<td class="text-right"><?=$s['us_d1'] != 0?$s['us_d1']:'-'?></td>
						<td class="text-right"><?=$s['us_d2'] != 0?$s['us_d2']:'-'?></td>
						<td class="text-right"><?=$s['us_sum'] != ''?$s['us_sum']:'-'?></td>
						<td class="text-center">-</td>
						<td class="text-center">-</td>
						</tr>
						<?php $i++;}?>
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
            <input type="text" id="span_getLink" class="form-control" >
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
      <form class="form-label-left input_mask " id="form_creSale" >
        <div class="modal-body" >
          <div class="x_content" > <br />
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
<script src="<?php echo base_url()?>public/tem_frontend/js/qrcode.min.js"></script>
<!-- END JS -->
<script>

function cre_sale(){

	$('#m_creSale').modal();
	
}

function cre_sale2(){
    var data = $('#form_creSale').serializeArray();
    $.ajax({
      url: 'cre_sale1',
      type: 'POST',
      dataType: 'json',
      data: data,
    })
    .done(function(res){
      if(res.code == 1){
        console.log("success");
        swal({
          icon: "success",
          text: res.msg,
        });
        setTimeout(function(){
          location.reload();
          }, 2000);
      }else{
        swal({
          icon: "error",
          text: res.msg,
        });
      }
    })
    .fail(function(){
      console.log("error");
    });
}

function getLink(token){
  $('#getLink').modal();
  $('#span_getLink').val('https://imi55.com/users/home/index/'+token);
  
  var qrcode = new QRCode(document.getElementById("demoqr"), {
   text: "https://imi55.com/users/home/index/"+token,
   width: 186,
   height: 186
 });


}

function clear_qrcode(){
    
    $('#demoqr').empty();
  
 }

function copyLink(){

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


</script>




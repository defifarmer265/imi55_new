
<div id="cover-spin"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2><a href="<?=base_url()?>owner/sale/home">SALE</a><small></small></h2>

          <ul class="nav navbar-right panel_toolbox">

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-10 col-sm-10" style="margin: 0px auto; float: none;">
          <div class="x_content">
<div class="row ">
          <div class="col-sm-3 "> วันเริ่ม
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                </div>
              </div>
            </fieldset>
          </div>
          <div class="col-sm-3"> วันสิ้นสุด
            <fieldset>
              <div class="control-group">
                <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span> <span id="inputSuccess2Status2" class="sr-only">(success)</span> </div>
                </div>
              </div>
            </fieldset>
          </div>
          
		  <div class="col-sm-2">
			  <select>
				  <?php foreach($sale_r as $sale=>$s){?>
			  	<option value="<?=$s['id']?>"><?=$s['name']?></option>
				  <?php  }?>
			  </select>
	      </div>
          <div class="col-sm-2">
			  <span>**ได้เพียงแค่ 30 วัน</span>
            <button onClick="search()" class="btn btn-info">ค้นหา</button>
          </div>
        </div>
            <div class="row">
              <div class="col-sm-12 ">
                <div class="card-box ">
                  <table id="" class="table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
                    <thead style="background-color:#12205F;color: #FFF">
					  <tr align="center">
                        <th width="3%" rowspan="2"> No</th>
                        <th width="3%" rowspan="2"> รหัส</th>
                        <th rowspan="2"> Username  </th>
                        <th rowspan="2"> ชื่อเซลล์ </th>
						<th width="5%" rowspan="2"> ลูกค้าทั้งหมด</th>
						<th width="5%" rowspan="2"> ลูกค้าเดือนที่แล้ว</th>
						<th colspan="2"> ลูกค้าภายในเดือน</th>
						<th rowspan="2"> รายละเอียด</th>
                        <th rowspan="2"> Link for share </th>
                        <th rowspan="2"> แก้ไขรหัส </th>
                        <th rowspan="2"> เปิด/ปิด</th>
                      </tr>
                      <tr align="center">
						<th width="5%"> ต่อวัน</th>
						<th width="5%"> ต่อเดือน</th>

                      </tr>
                    </thead>
                    
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
        <?php if($this->session->users['class'] == 0){ ?>
        <button type="button" class="btn btn-info float-right" onClick="upDateLink()" data-toggle="popover" data-content="copy">Update Link</button>
        <?php } ?>
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


<!-- END JS -->
<script>

	function search() {
		$('#cover-spin').show();
		var date_start 	 = $('#single_cal2').val();
		var date_end 	 = $('#single_cal3').val();
		$.ajax({
				url: 'search',
				type: 'POST',
				dataType: 'json',
				data: {
					date_start: date_start,date_end:date_end
				},
			})
			.done(function(res) {
				// success
				if (res.code == 1) {
					swal(res.title,res.msg,'success');
				} else {
					swal(res.title,res.msg,'error');
				}
			});

			$('#cover-spin').hide();
			
	}

  
</script>
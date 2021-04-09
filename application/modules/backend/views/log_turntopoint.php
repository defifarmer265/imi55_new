<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>log transfer<small></small></h2>
          
          <div class="clearfix"></div>
        </div><form action="log_turntopoint" method="post">
		<div class="row ">
    
				<div class="col-sm-2 ">
				วันเริ่ม
				<fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal2" name="dateS" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
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
                                <input type="text" class="form-control has-feedback-left" id="single_cal3" name="dateE" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
				</div>
				<!-- <div class="col-sm-2">
				ID : ztiai
				<input type="text" value="" class="form-control" id="user" maxlength="6" placeholder="รหัสลูกค้า">
				ใส่แค่ตัวเลข 6 หลัง
				</div> -->
				<div class="col-sm-2"><br>
				<button type="submit" class="btn btn-info">ค้นหา</button>
				
				</div></form>
			</div>
		  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatb" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                       <tr class="text-center">
                       <th width="2%">no</th>
                         <th >Username</th>
                         <th >point</th>
                         <th >ก่อน</th>
                         <th >หลัง</th>                    
                         <th >สร้างเมื่อ</th>
                         <th >อัฟเดทล่าสุด</th>
                       </tr>
                     </thead>

                      <tbody id="bodyhistory">
                              <?php $i=1;
                                foreach ($logturntopoint->data as $key => $value) {   ?>
                                          <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$value->playerName;?></td>
                                            <td><?=$value->point;?></td>
                                            <td><?=$value->before;?></td>
                                            <td><?=$value->after;?></td>
                                            <td><?=date('d/m/Y H:i', strtotime($value->createdAt));?></td>
                                            <td><?=date('d/m/Y H:i', strtotime($value->updatedAt));?></td>
                                          </tr>
                             
                             <?php   $i++;  }   ?>    
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
<script>
$(document).ready( function () {
    $('#datatb').DataTable();
} );
</script>
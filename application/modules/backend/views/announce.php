<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">

  <div class="container">
    <div class="text-center">
      <br><br>
      <h2 class="text-center">Broadcast Line</h2>
      <br><br>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#BroadcastGroup">Broadcast Group</button>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#BroadcastRoom">Broadcast Room</button>
      <br><br>
    </div>
  </div>

    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
        <h2>ประกาศ<small></small></h2>
        <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                  <thead style="background-color: #2a3f54;color: #fff;" >
                      <tr>
                        <th class="text-center" width="5%"> No</th>
                        <th style="width:10%"> หัวข้อประกาศ</th>
                         <th class="text-center"  style="width:10%">รายละเอียด</th>
                         <th >ผู้ประกาศ</th>
                         <th>วันที่โพส</th>
                         <th>Group_id</th>
                         <th>Status</th>
                         <th>ชื่อธนาคาร</th>
                         <th>กลุ่มลูกค้า</th>
                         <th>Group_status</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php $num=0; if(empty($data)){echo '<tr><td colspan=""></td></tr>';}else { foreach($data as $rs_a){ $num++;?>
                        <tr>
                           <td  class="text-center"><?php echo $num;  ?></td>
                           <td>
                                <?php 
                                    $textname = $rs_a['announce_name'];
                                    echo   $new_text = wordwrap($textname, 70, "<br>n", true);
                                ?>
                            </td>
                           <td style="font-size:11px">
                              <?php 
                                  $long_text = $rs_a['text'];
                                  echo   $new_text = wordwrap($long_text, 70, "<br>n", true);
                              ?>
                           </td>
                           <td><?php echo $rs_a['from_name'];?></td>
                           <td class="text-center">
                              <?php
                                if($rs_a['itme']==''){
                                  echo '';
                                }else{
                                  $strtotime = $rs_a['itme'];
                                  echo date('d M Y H:i:s',$strtotime);
                                }
                              
                              ?>
                           </td>
                           <td class="text-center"><?php echo $rs_a['announce_group_id'];?></td>
                           <td class="text-center">
                                <?php 
                                if($rs_a['announce_status'] ==1){ ?>
                                <i style="color:#3AED33;" class="fa fa-check"></i>
                                <?php }else{?>
                                  <i style="color:#F51F23;" class="fa fa-remove"></i>
                                <?php } ?>
                            </td>
                           <td><?php echo $rs_a['name'];?></td>
                           <td><?php echo $rs_a['detail'];?></td>
                           <td class="text-center">
                               <?php 
                                if($rs_a['status'] ==1){ ?>
                                <i style="color:#3AED33;" class="fa fa-check"></i>
                                <?php }else{?>
                                  <i style="color:#F51F23;" class="fa fa-remove"></i>
                                <?php } ?>
                            </td>
                        </tr>
                      <?php  }}?>
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



<div class="modal" id="BroadcastRoom">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Room</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#BroadcastRMMessage">Broadcast Room Message</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#BroadcastRMImage">Broadcast Room Image</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#BroadcastRMMessageImage">Broadcast Room Message + Image</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#BroadcastRMUrlImage">Broadcast Room URL + Image</button>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastRMMessage">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Room Message</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_brm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="brm_sender_id">Name To Sender:</label>
                        <input type="text" name="brm_sender" id="brm_sender_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brm_title_id">Title:</label>
                        <input type="text" name="brm_title" id="brm_title_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brm_line_name">Line Account:</label>
                        <select class="form-control" name="brm_line_name" required>
                        <option value="">Choose Account</option> 
                        <?php
                            foreach ($line_account as $key => $value) { ?>
                            <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brm_message_id">Message:</label>
                        <textarea type="text" row="10" name="brm_message" id="brm_message_id" class="form-control" required></textarea>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastRMImage" >
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Room Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_rmbi" method='post' enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rmbi_sender_id">Name To Sender:</label>
                        <input type="text" name="rmbi_sender" id="rmbi_sender_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="rmbi_title_id">Title:</label>
                        <input type="text" name="rmbi_title" id="rmbi_title_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="rmbi_line_name">Line Account:</label>
                        <select class="form-control" name="rmbi_line_name" required>
                        <option value="">Choose Account</option> 
                        <?php
                            foreach ($line_account as $key => $value) { ?>
                            <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rmbi_img_id">Image Path:</label>
                        <input type="file" name="rmbi_img" id="rmbi_img_id" class="form-control" required>
                    </div>
                </div>
                
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastRMMessageImage">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Room Message + Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_brmmi">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="brmmi_sender_id">Name To Sender:</label>
                        <input type="text" name="brmmi_sender" id="brmmi_sender_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brmmi_title_id">Title:</label>
                        <input type="text" name="brmmi_title" id="brmmi_title_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brmmi_line_name">Line Account:</label>
                        <select class="form-control" name="brmmi_line_name" required>
                        <option value="">Choose Account</option> 
                        <?php
                            foreach ($line_account as $key => $value) { ?>
                            <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brmmi_img_id">Image Path:</label>
                        <input type="file" name="brmmi_img" id="brmmi_img_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brmmi_message_id">Message:</label>
                        <textarea required type="text" row="10" name="brmmi_message" id="brmmi_message_id" class="form-control"></textarea>
                    </div>
                </div>
                
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
        </form>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastRMUrlImage">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Room URL + Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_brmui">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="brmui_sender_id">Name To Sender:</label>
                        <input required type="text" name="brmui_sender" id="brmui_sender_id" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="brmui_title_id">Title:</label>
                        <input required type="text" name="brmui_title" id="brmui_title_id" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="brmui_line_name">Line Account:</label>
                        <select class="form-control" name="brmui_line_name" required>
                        <option value="">Choose Account</option> 
                        <?php
                            foreach ($line_account as $key => $value) { ?>
                            <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brmui_img_id">Image Path:</label>
                        <input required type="file" name="brmui_img" id="brmui_img_id" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="brmui_url_id">URL:</label>
                        <input required type="text" name="brmui_url" id="brmui_url_id" class="form-control" >
                    </div>
                </div>
                
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastGroup">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Group</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#BroadcastMessage">Broadcast Group Message</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#BroadcastImage">Broadcast Group Image</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#BroadcastMessageImage">Broadcast Group Message + Image</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#BroadcastUrlImage">Broadcast Group URL + Image</button>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastMessage">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Group Message</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_bm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bm_sender_id">Name To Sender:</label>
                        <input type="text" name="bm_sender" id="bm_sender_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bm_title_id">Title:</label>
                        <input type="text" name="bm_title" id="bm_title_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bm_group_id">Group:</label>
                        <select class="form-control" name="bm_group_id" required>
                        <option value="">เลือกกลุ่ม</option> 
                        <?php
                            foreach ($group as $key => $value) { ?>
                            <option value="<?php echo$value['id'];?>"><?php echo$value['name'];?></option> 
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bm_message_id">Message:</label>
                        <textarea type="text" row="10" name="bm_message" id="bm_message_id" class="form-control" required></textarea>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastImage">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Group Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_bi">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bi_sender_id">Name To Sender:</label>
                        <input type="text" name="bi_sender" id="bi_sender_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bi_title_id">Title:</label>
                        <input type="text" name="bi_title" id="bi_title_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                            <label for="bi_group_id">Group:</label>
                            <select class="form-control" name="bi_group_id" required>
                            <option value="">เลือกกลุ่ม</option> 
                            <?php
                                foreach ($group as $key => $value) { ?>
                                <option value="<?php echo$value['id'];?>"><?php echo$value['name'];?></option> 
                            <?php } ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="bi_img_id">Image Path:</label>
                        <input type="file" name="bi_img" id="bi_img_id" class="form-control" required>
                    </div>
                </div>
                
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastMessageImage">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Group Message + Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_bmi">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bmi_sender_id">Name To Sender:</label>
                        <input type="text" name="bmi_sender" id="bmi_sender_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bmi_title_id">Title:</label>
                        <input type="text" name="bmi_title" id="bmi_title_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bmi_group_id">Group:</label>
                        <select class="form-control" name="bmi_group_id" required>
                        <option value="">เลือกกลุ่ม</option> 
                        <?php
                            foreach ($group as $key => $value) { ?>
                            <option value="<?php echo$value['id'];?>"><?php echo$value['name'];?></option> 
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bmi_img_id">Image Path:</label>
                        <input type="file" name="bmi_img" id="bmi_img_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bmi_message_id">Message:</label>
                        <textarea required type="text" row="10" name="bmi_message" id="bmi_message_id" class="form-control"></textarea>
                    </div>
                </div>
                
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
        </form>
        </div>
    </div>
</div>

<div class="modal" id="BroadcastUrlImage">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Broadcast Group URL + Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form id="form_bui">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bui_sender_id">Name To Sender:</label>
                        <input required type="text" name="bui_sender" id="bui_sender_id" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="bui_title_id">Title:</label>
                        <input required type="text" name="bui_title" id="bui_title_id" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="bui_group_id">Group:</label>
                        <select class="form-control" name="bui_group_id" required>
                        <option value="">เลือกกลุ่ม</option> 
                        <?php
                            foreach ($group as $key => $value) { ?>
                            <option value="<?php echo$value['id'];?>"><?php echo$value['name'];?></option> 
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bui_img_id">Image Path:</label>
                        <input required type="file" name="bui_img" id="bui_img_id" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="bui_url_id">URL:</label>
                        <input required type="text" name="bui_url" id="bui_url_id" class="form-control" >
                    </div>
                </div>
                
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" >Broadcast</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>   

<script>
$(document).ready(function() {

    $('#form_bm').submit(function(event){
        event.preventDefault();
        var form_bm = $('#form_bm').serializeArray();
        $.ajax({
        url: 'Announce/broadcastmessage',
        type: 'POST',
        dataType: 'json',
        data: form_bm,
        })
        .done(function(re) {
            console.log(re);
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });

    $('#form_bi').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#bi_img_id')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var form_bi = $('#form_bi').serializeArray();
        fd.append("bi_sender",form_bi[0].value);
        fd.append("bi_title",form_bi[1].value);
        fd.append("bi_group_id",form_bi[2].value);
        console.log(form_bi);
        console.log(fd);
        $.ajax({
        url: 'Announce/broadcastimage',
        type: 'POST',
        dataType: 'json',
        data: fd,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        })
        .done(function(re) {
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });

    $('#form_bmi').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#bmi_img_id')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var form_bmi = $('#form_bmi').serializeArray();
        fd.append("bmi_sender",form_bmi[0].value);
        fd.append("bmi_title",form_bmi[1].value);
        fd.append("bmi_group_id",form_bmi[2].value);
        fd.append("bmi_message",form_bmi[3].value);
        console.log(form_bmi);
        console.log(fd);
        $.ajax({
        url: 'Announce/broadcastmessageandimage',
        type: 'POST',
        dataType: 'json',
        data: fd,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        })
        .done(function(re) {
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });

    $('#form_bui').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#bui_img_id')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var form_bui = $('#form_bui').serializeArray();
        fd.append("bui_sender",form_bui[0].value);
        fd.append("bui_title",form_bui[1].value);
        fd.append("bui_group_id",form_bui[2].value);
        fd.append("bui_url",form_bui[3].value);
        console.log(form_bui);
        console.log(fd);
        $.ajax({
        url: 'Announce/broadcastimageurl',
        type: 'POST',
        dataType: 'json',
        data: fd,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        })
        .done(function(re) {
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });

    $('#form_brm').submit(function(event){
        event.preventDefault();
        var form_brm = $('#form_brm').serializeArray();
        console.log(form_brm);
        $.ajax({
        url: 'Announce/broadcastRMmessage',
        type: 'POST',
        dataType: 'json',
        data: form_brm,
        })
        .done(function(re) {
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });

    $('#form_rmbi').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#rmbi_img_id')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var form_rmbi = $('#form_rmbi').serializeArray();
        fd.append("rmbi_sender",form_rmbi[0].value);
        fd.append("rmbi_title",form_rmbi[1].value);
        fd.append("rmbi_line_name",form_rmbi[2].value);
        console.log(form_rmbi);
        console.log(fd);
        $.ajax({
            url: 'Announce/broadcastRMimg',
            type: 'POST',
            dataType: 'json',
            data: fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        })
        .done(function(re) {
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });

    $('#form_brmmi').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#brmmi_img_id')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var form_brmmi = $('#form_brmmi').serializeArray();
        fd.append("brmmi_sender",form_brmmi[0].value);
        fd.append("brmmi_title",form_brmmi[1].value);
        fd.append("brmmi_line_name",form_brmmi[2].value);
        fd.append("brmmi_message",form_brmmi[3].value);
        console.log(form_brmmi);
        $.ajax({
        url: 'Announce/broadcastRMMessageImage',
        type: 'POST',
        dataType: 'json',
        data: fd,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        })
        .done(function(re) {
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });

    $('#form_brmui').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#brmui_img_id')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var form_brmui = $('#form_brmui').serializeArray();
        fd.append("brmui_sender",form_brmui[0].value);
        fd.append("brmui_title",form_brmui[1].value);
        fd.append("brmui_line_name",form_brmui[2].value);
        fd.append("brmui_url",form_brmui[3].value);
        console.log(form_brmui);
        $.ajax({
        url: 'Announce/broadcastRMUrlImage',
        type: 'POST',
        dataType: 'json',
        data: fd,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        })
        .done(function(re) {
        if (re.code == 1) {
            swal("", "Broadcast Success !", "success");
            setTimeout(function(){location.reload(); },2000);
        }else{
            swal("", "Broadcast None Success !", "error");
            setTimeout(function(){location.reload(); },2000);
        }
        })
        .fail(function() {
        });
    });
    
});
</script>




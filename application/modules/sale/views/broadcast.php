

<body>

<div class="right_col" role="main">
  <div class="clearfix"> </div>
  <div class="row">
<div class="container  color_text  " style="margin-top: 5%;">

<ul class="nav nav-tabs md-tabs  " id="myTabMD" role="tablist">
  <li class="nav-item ">
    <a class="nav-link active วิบวับ" id="home-tab-md" data-toggle="tab" href="#message" role="tab" aria-controls="message"
      aria-selected="true">ข้อความ</a>
  </li>
  <li class="nav-item">
    <a class="nav-link วิบวับ" id="profile-tab-md" data-toggle="tab" href="#image" role="tab" aria-controls="image"
      aria-selected="false">รูปภาพ</a>
  </li>
  <li class="nav-item">
    <a class="nav-link วิบวับ" id="contact-tab-md" data-toggle="tab" href="#img_link" role="tab" aria-controls="img_link"
      aria-selected="false">ลิ้งค์เว็บ + รูปภาพ</a>
  </li>  
</ul>

<div class="tab-content card pt-5 วิบวับ " id="myTabContentMD " >
  <div class="container">
    <div class="col-12">
        <div class="card-body วิบวับ">
            <h5 class="card-title  text-center">ระบบบรอดแคสต์</h5>
        </div>
    </div>
    </div>
  <div class="tab-pane fade show active "  style="padding:3% 3% 3% 3%;" id="message" role="tabpanel" aria-labelledby="home-tab-md">

    <form id='bm_message' >
                <div class="card  " style="width: 100%; ">
                    
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item วิบวับ">
                            <label for="sender">ชื่อผู้ส่ง:</label>
                            <input required type="text" class="form-control" id="sender_bm" placeholder="" name="sender">
                        </li>
                        <li class="list-group-item วิบวับ ">
                        <label for="bm_line_official">Line Account:</label>
                        <select required class="form-control" name="bm_line_official" >
                            <option value="">เลือก</option> 
                            <?php
                                foreach ($line_account as $key => $value) { ?>
                                <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                            <?php } ?>
                        </select>
                        </li>
                        <li class="list-group-item วิบวับ ">
                            <label for="message">ข้อความ:</label>
                            <textarea required type="text" placeholder="" class="form-control" id="message_bm" rows="4" cols="50" name="message"></textarea>
                        </li>
                    </ul>
                    <div class="card-body วิบวับ text-center">
                        <button type="submit"  class="btn btn-success วิบวับ">บรอดแคสต์ข้อความ</button>
                    </div>
                </div>
    </form>
  </div>



  <div class="tab-pane fade" style="padding:3% 3% 3% 3%;"  id="image" role="tabpanel" aria-labelledby="profile-tab-md">
     <form id='bi_image'>
                <div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item วิบวับ">
                            <label for="bi_sender">ชื่อผู้ส่ง:</label>
                            <input required type="text" class="form-control" id="bi_sender" placeholder="Enter Sender" name="bi_sender">
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bi_line_official">Line Account:</label>
                            <select required class="form-control" name="bi_line_official" >
                            <option value="">เลือก</option> 
                            <?php
                                foreach ($line_account as $key => $value) { ?>
                                <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                            <?php } ?>
                            </select>
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bi_img">Image Path:</label>
                            <input type="file" name="bi_img" id="bi_img" class="form-control" required>
                        </li>
                    </ul>
                    <div class="card-body วิบวับ text-center">
                        <button type="submit" class="btn btn-success วิบวับ">บรอดแคสต์รูปภาพ</button>
                    </div>
                </div>
            </form>
  </div>
  <div class="tab-pane fade" style="padding:3% 3% 3% 3%;"  id="message_img" role="tabpanel" aria-labelledby="contact-tab-md">
     <form id='bmi_messageimage'>
                <div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item วิบวับ">
                            <label for="bmi_sender">ชื่อผู้ส่ง:</label>
                            <input required type="text" class="form-control" id="bmi_sender" placeholder="Enter Sender" name="bmi_sender">
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bmi_line_official">Line Account:</label>
                            <select required class="form-control" name="bmi_line_official" >
                            <option value="">เลือก</option> 
                            <?php
                                foreach ($line_account as $key => $value) { ?>
                                <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                            <?php } ?>
                            </select>
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bmi_message">ข้อความ:</label>
                            <textarea required type="text" rows="4" cols="50" class="form-control" id="bmi_message" placeholder="Enter Message" name="bmi_message"></textarea>
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bmi_img">ลิ้งค์เว็บ:</label>
                            <input type="file" name="bmi_img" id="bmi_img" class="form-control" required>
                        </li>
                    </ul>
                    <div class="card-body วิบวับ text-center">
                        <button type="submit" class="btn btn-success วิบวับ">Broadcast Message + Image</button>
                    </div>
                </div>
            </form>
  </div>
   <div class="tab-pane fade " style="padding:3% 3% 3% 3%;"  id="img_link" role="tabpanel" aria-labelledby="contact-tab-md">
       <form id='bli_linkimage'>
                <div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item วิบวับ">
                            <label for="bli_sender">ชื่อผู้ส่ง:</label>
                            <input required type="text" class="form-control" id="bli_sender" placeholder="Enter Sender" name="bli_sender">
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bli_line_official">Line Account:</label>
                            <select required class="form-control" name="bli_line_official" >
                            <option value="">เลือก</option> 
                            <?php
                                foreach ($line_account as $key => $value) { ?>
                                <option value="<?php echo$value['name'];?>"><?php echo$value['name'];?></option> 
                            <?php } ?>
                            </select>
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bli_link">Link Web:</label>
                            <input required type="text" class="form-control" id="bli_line" placeholder="Enter Link Web" name="bli_line">
                        </li>
                        <li class="list-group-item วิบวับ">
                            <label for="bli_img">Image Path:</label>
                            <input type="file" name="bli_img" id="bli_img" class="form-control" required>
                        </li>
                    </ul>
                    <div class="card-body วิบวับ text-center">
                        <button type="submit" class="btn btn-success วิบวับ">Broadcast Link_Web + Image</button>
                    </div>
                </div>
            </form>
    </div>

    <div class="tab-pane fade " style="padding:3% 3% 3% 3%;"  id="line_notify" role="tabpanel" aria-labelledby="contact-tab-md">
       <form id='line'>
                <div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item วิบวับ">
                            <label for="line_noti">Messages:</label>
                            <input type="text" name="line_noti" id="line_noti" class="form-control" required>
                        </li>
                    </ul>
                    <div class="card-body วิบวับ text-center">
                        <button type="submit" class="btn btn-success วิบวับ">Send Message Line Notify</button>
                    </div>
                </div>
            </form>
    </div>
</div>





</div>
</div>
</div>




<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>

<script>
$(document).ready(function() {

    $('#bm_message').submit(function(event){
        event.preventDefault();
        var bm_message = $('#bm_message').serializeArray();
        console.log(bm_message);

        $.ajax({
            url: '<?=base_url()?>/backend/sale/broadcast_message',
            type: 'POST',
            dataType: 'json',
            data: bm_message,
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

    $('#bi_image').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#bi_img')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var bi_image = $('#bi_image').serializeArray();
        fd.append("bi_sender",bi_image[0].value);
        fd.append("bi_line_official",bi_image[1].value);
        console.log(bi_image);
        console.log(fd);
        $.ajax({
            url: 'Sale_broadcast/broadcast_image',
            type: 'POST',
            dataType: 'json',
            data: fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
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

    $('#bmi_messageimage').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#bmi_img')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var bmi_messageimage = $('#bmi_messageimage').serializeArray();
        fd.append("bmi_sender",bmi_messageimage[0].value);
        fd.append("bmi_line_official",bmi_messageimage[1].value);
        fd.append("bmi_message",bmi_messageimage[2].value);
        console.log(bmi_messageimage);
        console.log(fd);
        $.ajax({
            url: 'Sale_broadcast/broadcast_image_message',
            type: 'POST',
            dataType: 'json',
            data: fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
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

    $('#bli_linkimage').submit(function(event){
        event.preventDefault();
        var fd = new FormData();
        var files = $('#bli_img')[0].files[0];
        fd.append('file',files);
        console.log(files);
        var bli_linkimage = $('#bli_linkimage').serializeArray();
        fd.append("bli_sender",bli_linkimage[0].value);
        fd.append("bli_line_official",bli_linkimage[1].value);
        fd.append("bli_link",bli_linkimage[2].value);
        console.log(bli_linkimage);
        console.log(fd);
        $.ajax({
            url: 'Sale_broadcast/broadcast_image_link',
            type: 'POST',
            dataType: 'json',
            data: fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
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
});
</script>


<!-- CONTACT-->
<header class="masthead text-white text-center"   id="tap_contact">
	<br>
	<br>
	<br>
  <div class="container">
	  <div class="col-4" onClick="resetPass()">
          <div class="square" >
            <div class="content" > <img src="<?=$this->config->item('tem_frontend'); ?>img/mapraw_icon/key.png" width="100%" > </div>
          </div>
          <div class="text_icon" style="padding: 12px;font-size: 18px;">เปลี่ยนรหัส</div>
        </div>

  </div>
</header>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.compatibility.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--modal-->
<div class="modal fade"  id="m_edit_pass" role="dialog">
  <div class="modal-dialog" > 
    
    <!-- Modal content-->
    <div class="modal-content" style="background-image: linear-gradient(to right top, #000862, #000c7a, #001093, #0215ad, #0419c8, #0419c8, #0419c8, #0419c8, #0215ad, #001093, #000c7a, #000862);">
      <div class="modal-header">
        <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding: 25px !important">
        <div class="row">
          <div class="col-12">
            <div class="input-group">
              <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-lock"></i></span> </div>
              <input class="form-control" id="old_pass" value="" placeholder="รหัสผ่านเก่า">
            </div>
          </div>
          <div class="col-12">
            <div class="input-group">
              <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-lock"></i></span> </div>
              <input class="form-control" id="new_pass" value="" placeholder="รหัสผ่านใหม่">
              <div class="input-group-append"> 
                <span class="input-group-text" id="testpass"><i class=" fa fa-remove"></i></span> 
              </div>
            </div>
         
          </div>
          <div class="col-12">
            <div class="input-group d-flex justify-content-end" >
              <button onClick="edit_pass()" class="btn btn-dark">ยืนยัน</button>
            </div>
          </div>
          <div class="col-12">
                      <span class="text-left" style="font-size: 13px">
                  **รหัสผ่าน**<br>
                  ต้องมีอักษรภาษาอังกฤษและตัวเลขผสมกัน อย่างน้อย 8 หลัก<br>
                  ตัวอย่างเช่น aa123654 </span>  
          </div>
        </div>
      </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>
<script>
function resetPass()
	{
		$('#m_edit_pass').modal();
	}

function edit_pass()
  {
    var pwdPolicy =/^\w*(?=\w*\d)(?=\w*[a-z])\w.{7,15}$/;
    var new_pass = $('#new_pass').val();
    var old_pass = $('#old_pass').val();

    if(new_pass.match(pwdPolicy)){

            $('#testpass').html('<i class="text-success fa fa-check"></i>');
            $('#cover-spin').show();

                $.ajax({
                       url: 'other/edit_pass',
                       type: 'POST',
                       dataType: 'json',
                    data:{old_pass:old_pass,new_pass:new_pass}
                     })
                  .done(function(res) {
                    // success
                    if (res.code == 1) {
                       swal('เรียบร้อย','คุณได้ทำการเปลี่ยนรหัสผ่านสำเร็จแล้วค่ะ', "success")
                                .then(function(sw){
                                    $('#cover-spin').show();
                                    setTimeout(function(){
                                        $('#cover-spin').hide();
                                        window.location.href ="home";
                                    },1000);
                                }); 
                    }else{
                      swal('ผิดพลาด','กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw){
                                    location.reload();
                                });
                    }
                  });
            
    }else{ 
      document.getElementById('new_pass').focus();
    $('#testpass').html('<i class="text-danger fa fa-remove"></i>');
      swal('รหัสผ่านไม่ถูกต้อง', 'กรุณากรอกรหัสผ่านใหม่ค่ะ', "error");     
    }

  }



</script>
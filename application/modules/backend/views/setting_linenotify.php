<style>
 .sw{
   background-color:#2a3f54;
 }
 .vd{
   cursor:pointer;
 }
 .custom-switch {
 padding-left: 2.25rem;
 padding-bottom: 1rem;
}
.custom-control-label {
 padding-top: 0.5rem;
 padding-left: 2rem;
 padding-bottom: 0.1rem;
}
.custom-switch .custom-control-label::after {
 top: calc(0.25rem + 2px);
 left: calc(-2.25rem + 2px);
 width: calc(2rem - 4px);
 height: calc(2rem - 4px);
 background-color: #adb5bd;
 border-radius: 2rem;
 transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-transform 0.15s ease-in-out;
 transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
 transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-transform 0.15s ease-in-out;
}
 .custom-switch .custom-control-label::before {
 left: -2.25rem;
 height: 2rem;
 width: 3.5rem;
 pointer-events: all;
 border-radius: 1rem;
}
.custom-switch .custom-control-input:checked ~ .custom-control-label::after {
 background-color: #fff;
 -webkit-transform: translateX(1.5rem);
 transform: translateX(1.5rem);
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

</style>

<div class="right_col" role="main">
    <div class="row">
      <?php
        if (!empty($setting)) {
            $i = 1;
            foreach ($setting as $key => $st) {
                ?>
        <div class="col-md-6" id="tap_member">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?=$st['name']?></h2>
                    <div class="text-right">
                        <div class="col custom-control custom-switch text-right">
                          <input type="checkbox" onchange="turnon_exchange('<?=$st['isEnabled']?>','<?=$st['name']?>');" class="custom-control-input" id="customSwitch<?=$i?>"  <?=$st['isEnabled'] == 1 ? 'checked':''?> />
                          <label class="custom-control-label" for="customSwitch<?=$i?>">ปิด/เปิด</label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <span class="">ระบุโทเค้นสำหรับแจ้งเตือน</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-11" id="ip_token">
                            <input type="text" class="form-control has-feedback-left" readonly
                                value="<?=$st['value']?>" id="token_register">
                            <span class="fa fa-bell form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-1 text-right">
                            <button class="btn btn-sm btn-outline-warning" style="border:none;">
                              <li class="fa fa-pencil-square-o fa-2x vd" data-toggle="modal" data-target="#modal-edit"  onclick="edit_value('<?=$st['value']?>','<?=$st['name']?>');" aria-hidden="true"></li>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
            $i++;
            }
        } ?>
      </div>
  </div>

<!-- Modal edit data -->
<div class="modal fade" id="modal-edit" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="name"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form class="form-label-left input_mask" id="form_edit_token">
				<div class="modal-body">
					<div class="col-md-12 col-sm-12  form-group has-feedback">
            <input type="hidden" class="form-control" id="nameInput">
						<input type="text" class="form-control has-feedback-left" id="value" placeholder="Token" required="required" name="token" autocomplete="off">
						<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="update_value()" class="btn btn-success">Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end -->
<script>
function turnon_exchange(enable,name) {
       if(enable == 0){
         var text = "คุณต้องการเปิด"
       }else{
         var text = "คุณต้องการปิด"
       }
   swal({
           text: text,
           icon: "warning",
           buttons: true,
           dangerMode: true,
       })

       .then((willDelete) => {
           if (willDelete) {
               $.ajax({
                       url: '<?php base_url()?>Setting_linenotify/enable',
                       type: 'POST',
                       dataType: 'json',
                       data: {
                           enable : enable,
                           name : name
                       },
                   })
                   .done(function(res) {
                       // success
                       if (res.code == 1) {
                           swal({
                               icon: "success",
                               text: res.title,
                               button: false,
                           });
                           setTimeout(function() {
                               location.reload();
                           }, 1000);
                       } else {
                           swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                               .then(function(sw) {
                                   location.reload();
                               });
                       }
                   });

           } else {
               swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
               setTimeout(function() {
                   $('#cover-spin').hide();
                   window.location.href = "";
               }, 1000);
           }
       });
}
function edit_value(value,name,detial) {
      $("#value").val(value);
      // $("#name").val(name);
      $('#name').html(name);
      $("#nameInput").val(name);
      $("#detail").val(detial);
}


function update_value(){
 var value = $("#value").val();
 var name  = $("#nameInput").val();
 swal({
       title: 'ต้องการเเก้ไข ?',
       buttons: true,
   }).then((willDelete) => {
     if (willDelete) {
        $.ajax({
         url: 'Setting_linenotify/edit_token',
         type: 'POST',
         dataType: 'json',
                   data: {
                     name:name,
                     value:value,
                   },
         }).done(function(res) {
         //console.log(res);
         if (res.code == 1) {
           swal(res.title,res.msg,'success').then(function(w){
             setTimeout(function(){
               location.reload();
             },700);
           });
         }else{
           swal(res.title,res.msg,'error').then(function(w){
             setTimeout(function(){
               location.reload();
             },700);
           });
         }
         })
         .fail(function() {
         console.log("error");
         });
     }
   })
}

</script>

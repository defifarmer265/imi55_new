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

                    <div  class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header bg-info text-white" >
                                <h5>เเก้ไข</h5>
                              </div>
                                <h5 class="modal-title" id="exampleModalLabel"><input class="form-control" name="detail" id="detail"  maxlength="200" disabled></h5>
                              <div class="modal-body">
                                <form>

                                  <div class="form-group">
                                    <!-- <label for="message-text" class="col-form-label">Value:</label> -->
                                    <input class="form-control" name="value" id="value">
                                    <input type="hidden" name="id" id ="id" class="form-control">
                                  </div>
                                 <div class="modal-footer">
                                 <button type="button" onclick="update_value();" class="btn btn-primary">บันทึก</button>
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                              </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
<div id="cover-spin"></div>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ตั้งค่าการใช้งานไลน์บอท<small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="row ">
      </div>
      <hr style="height:2px;border-width:0;color:gray;background-color:gray">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_content">
          <div class="row">
            <div class="col-sm-8">
              <div class="card-box table-responsive">
                <table  id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                  <thead style="background-color: #2a3f54;color: #fff;">
                    <tr class="text-center">
                      <th>ลำดับ</th>
                      <th>รายการ</th>
                      <th>ตั้งค่า เปิด/ปิด</th>
                      <th>แก้ไขค่าข้อมูล</th>
                    </tr>
                  </thead>
                  <tbody id="bodysum">
                    <!-- setting line -->
                    <?php
                    $count;
                      if (!empty($setting)) {
                          $i = 1;
                          foreach ($setting as $key => $st) {
                              ?>
                  <tr>
                    <td class="text-center"><?=$i?></td>
                    <td><?=$st['detail']?></td>
                    <td class="text-center">
                      <?php if ($st['status'] == 1 && $st['type_data'] != 0) { ?>
                      <div class="col custom-control custom-switch">
                        <input type="checkbox" onchange="turnon_exchange('<?=$st['isEnabled']?>','<?=$st['id']?>','1');" class="custom-control-input" id="customSwitch<?=$i?>"  <?=$st['isEnabled'] == 1 ? 'checked':''?> />
                        <label class="custom-control-label " for="customSwitch<?=$i?>"></label>
                       </div>
                     <?php } ?>
                    </td>
                    <td class="text-center">
                      <?php if ($st['type_data'] == 2) { ?>
                        <i class="fa fa-pencil-square-o fa-3x vd" data-toggle="modal" data-target="#exampleModal"  onclick="edit_value('<?=$st['value']?>','<?=$st['id']?>','<?=$st['detail']?>');" aria-hidden="true"></i>
                      <?php } ?>
                    </td>
                  </tr>
                    <?php  $i++;
                              $count = $i;
                          }
                      } ?>
                      <!-- setting option -->
                      <?php
                        if (!empty($setting_option)) {
                            $i = $count;
                            foreach ($setting_option as $key => $st_op) {
                                ?>
                    <tr>
                      <td class="text-center"><?=$i?></td>
                      <td><?=$st_op['detail']?></td>
                      <td class="text-center" colspan="2">
                        <?php if ($st['status'] == 1 && $st['type_data'] != 0) { ?>
                        <div class="custom-control custom-switch">
                          <input type="checkbox" onchange="turnon_exchange('<?=$st_op['isEnabled']?>','<?=$st_op['id']?>','2');" class="custom-control-input" id="customSwitch<?=$i?>"  <?=$st_op['isEnabled'] == 1 ? 'checked':''?> />
                          <label class="custom-control-label " for="customSwitch<?=$i?>"></label>
                        </div>
                        <?php } ?>
                      </td>
                    </tr>
                      <?php  $i++;
                            }
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
<script>
 function turnon_exchange(enable,d,type) {
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
                console.log(d);
                console.log(enable);
                $.ajax({
                        url: '<?php base_url()?>Setting_linebot/enable',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            enable : enable,
                            d : d,
                            type : type
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
function edit_value(d,f,detial) {
       console.log(d);
       console.log(f);
       console.log(detial);
       $("#value").val(d);
       $("#id").val(f);
       $("#detail").val(detial);
}
  // ====================== convert convert timstamp to dd/mm/yyyy ======================================
  function gendate(d) {
    var today = new Date(d * 1000);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    return dd + '/' + mm + '/' + yyyy;

  }
function update_value(){
  var value = $("#value").val();
  var id  = $("#id").val();
  swal({
			  title: 'ต้องการเเก้ไข ?',
        buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				 $.ajax({
					url: 'Setting_linebot/save_edit',
					type: 'POST',
					dataType: 'json',
                    data: {id:id,
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
  function nb(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }
</script>

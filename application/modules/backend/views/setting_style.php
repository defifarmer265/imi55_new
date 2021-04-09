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

  #sColor,
  #value{
    border: none;
    padding: 0;
  }
</style>

<div id="cover-spin"></div>
  <div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>ตั้งค่ารูปแบบการแสดงผลไลน์บอท<small></small></h2>
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
                        <th>รูปแบบ</th>
                        <th>แก้ไขรูปแบบ</th>
                      </tr>
                    </thead>
                    <tbody id="bodysum">
                      <?php
                        if (!empty($style)) {
                            $i = 1;
                            foreach ($style as $key => $s) {
                                ?>
                      <tr>
                        <td class="text-center"><?=$i?></td>
                        <td><?=$s['detail']?></td>
                        <td class="text-center">
                          <input disabled class="form-control" type="color" id="sColor" name="sColor" value="<?=$s['value']?>">
                        </td>
                        <td class="text-center">
                          <?php if ($s['type_data'] == 2) { ?>
                            <i class="fa fa-pencil-square-o fa-3x vd" data-toggle="modal" data-target="#exampleModal"  onclick="edit_value('<?=$s['value']?>','<?=$s['id']?>','<?=$s['detail']?>');" aria-hidden="true"></i>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php
                          $i++;
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

<!-- modal edit style data -->
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
              <input type="color" class="form-control" name="value" id="value">
              <input type="hidden" name="id" id ="id" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" onclick="edit_style();" class="btn btn-primary">บันทึก</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- end -->

<script>
  function edit_value(d,f,detial) {
    $("#value").val(d);
    $("#id").val(f);
    $("#detail").val(detial);
  }

  function edit_style(){
    var value = $("#value").val();
    var id  = $("#id").val();
    swal({
  			  title: 'ต้องการเเก้ไข ?',
          buttons: true,
  		}).then((willDelete) => {
  			if (willDelete) {
  				 $.ajax({
  					url: 'Setting_style/edit_data',
  					type: 'POST',
  					dataType: 'json',
                      data: {
                        id:id,
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

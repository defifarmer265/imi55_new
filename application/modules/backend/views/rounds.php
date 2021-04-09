<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Rounds<small></small></h2>
		  <div class="text-right">
            <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#m_creRound"><i class="fa fa-plus"> เพิ่มรอบ</i></button>
          </div>
          <div class="clearfix"></div>
        </div> 

        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr  style="text-align:center;" >
                        <th style="vertical-align: middle"> รหัสรอบ</th>
                        <th style="vertical-align: middle" > รอบ </th>     
                        <th style="vertical-align: middle">เวลาเริ่มต้น</th>
                        <th style="vertical-align: middle">เวลาสิ้นสุด</th>                  
                        <th> แก้ไข </th>
                        <th> ลบ </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($rounds as $_a=>$a){ ?>
                      <tr style="text-align:center;">
                        <td><?php echo $a['id']; ?></td>   
                                           
                        <td><?php echo $a['rounds_desc']; ?></td> 
                        <td><?php echo $a['time_start']; ?></td>  
                        <td><?php echo $a['time_end']; ?></td>  
                        <td class="text-center">
                            <button class="btn btn-secondary btn-sm"  id="btn_editspin" data-toggle="modal" data-target="#m_creRound" aria-hidden="true" data-edit="<?php echo htmlspecialchars(json_encode($a,JSON_UNESCAPED_UNICODE),ENT_COMPAT); ?>" onclick="edit(this)"  title="แก้ไข">
                   				  	<i class="fa fa-pencil"></i>
							              </button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info btn-sm" onClick="confrim_delete(<?=$a['id']?>)">ลบ</button>
                        </td>

                      </tr>
                      <?php } ?>
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

<!--add round -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="m_creRound" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">	
      <div class="modal-header">
        <h5 class="modal-title">รอบ</h5>      
        <button type="button" class="close" data-dismiss="modal" onClick="data_reset()">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="form_creRound">
        <div class="modal-body">
          <div class="x_content">
            <div class="row"><h5>รายละเอียดรอบ</h5></div>
              <div class="form-group row">        
                <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
                  <input type="hidden" name="editid" id="editcheck_id">
                </div>     
                <div class="col-md-3 form-group text-right p-2 h6 ">
                  <span class="">ชื่อรอบ</span>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control has-feedback-center" id="rounds_desc" name="rounds_desc" placeholder="ชื่อรอบ">
                </div>
              </div>
              <div class="form-group row"> 
                <div class="col-md-3 form-group text-right p-2 h6 ">
                  <span class="">เวลาเริ่มต้น</span>
                </div>
                <div class="col-md-6">
                  <input type="time" class="form-control has-feedback-center" id="rounds_start" name="rounds_start" >
                </div>
              </div>
              <div class="form-group row"> 
                <div class="col-md-3 form-group text-right p-2 h6 ">
                  <span class="">เวลาสิ้นสุด</span>
                </div>
                <div class="col-md-6">
                  <input type="time" class="form-control has-feedback-center" id="rounds_end" name="rounds_end" >
                </div>
              </div>             
            </div>
          </div>
        </form>
      <div class="modal-footer">
        <button onClick="cre_Rounds()" class="btn btn-primary" id="bt_change">SAVE</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="data_reset()">CLOSE</button>
      </div>
    </div>
  </div>
</div> 

<!--modal-->
<script>

function cre_Rounds(){
     var data = $('#form_creRound').serializeArray();
     $.ajax({
       url: 'rounds/cre_rounds',
       type: 'POST',
       dataType: 'json',
       data: data,
     })
     .done(function(res) {
       if (res.code == 1) {

        swal({
          icon: "success",
          text: res.msg,
        });
        setTimeout(function(){location.reload(); },2000);
       }else{
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

function update_Rounds(){
	swal({
		title: "คุณแน่ใจที่จะทำการเปลี่ยนแปลง",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) { 
			var id    = $('#editcheck_id').val();
			var rounds_desc  = $('#rounds_desc').val();
			var time_start = $('#rounds_start').val();
      var time_end = $('#rounds_end').val();
			$.ajax({
				url: 'rounds/update_Rounds',
				type: 'POST',
				dataType: 'json',
				data: {id:id,rounds_desc:rounds_desc,time_start:time_start,time_end:time_end},
			})
			.done(function(res) {
			if (res.code == 1) {
				swal(res.title,res.msg,'success').then(function(w){
					setTimeout(function(){
						location.reload();
					},1000);
				});
			}else{
				swal(res.title,res.msg,'error').then(function(w){
					setTimeout(function(){
						location.reload();
					},1000);
				});
			}
			})
			.fail(function() {
				console.log("error");
			});
		} else {
			swal("ยกเลิก","การเปลี่ยนแปลงข้อมูลเรียบร้อย!", "error");
		}

	});	
 }

function edit(data)
{
    console.log($(data).data('edit').id);
    var data = ($(data)).data('edit') ;
    $("#editcheck_id").val(data.id);
    $("#rounds_desc").val(data.rounds_desc);
    $("#rounds_start").val(data.time_start);
    $("#rounds_end").val(data.time_end);
    $('#bt_change').attr('onClick', 'update_Rounds();');
}  

function data_reset()
{
    $("#form_creRound").trigger("reset");
    $('#bt_change').attr('onClick', 'cre_Rounds();');
}
function confrim_delete(id)
	{
		swal({
			title: "ลบ",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "rounds/delete_rounds",
					type: 'post',	
					data: { id: id},
					dataType: "json",
					success: function(res) {
						if (res.code == 1) {
							swal(res.title,res.msg,'success')
                            .then((result) => { location.reload();})

						}else{
							swal(res.title,res.msg,'error')
                            .then((result) => { location.reload();})
						}

					}
				});
				
			} else {
				return false;
			}
		});
	}
</script>
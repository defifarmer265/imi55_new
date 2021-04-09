<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>รายการที่เข้าบัญชีฝากทั้งหมด<small></small></h2>
          
          <div class="clearfix"></div>
        </div>
		
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                     <thead style="background-color: #2a3f54;color: #fff;" >
                       <tr class="text-center">
                       <th width="2%">Id</th>
                       <th width="2%">Id</th>
                         <th >action</th>
                         <th >วันที่รายการ</th>
                         <th >พนักงาน</th>
                       </tr>
                     </thead>
                      <tbody id="bodyhistory">
                        <?php $i=1; if(empty($edit_bank)){ echo '<tr><td colspan="5"></td></tr>'; }else {foreach($edit_bank as $eb){ ?>
                        <tr>
                          <td class="text-center"><?=$i?></td>
                          <td class="text-center"><?=$eb['id']?></td>
                          <td class="text-center"><?=$eb['action']?></td>
                          <td class="text-center"><?=date('d-m-y H:i',$eb['create_time'])?></td>
                          <td class="text-center"><?=$eb['admin_name']?></td>
                        </tr>
                        <?php $i++; }} ?>
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
$(document).on('user',function(e) {
    if(e.which == 13) {
        alert('You pressed enter!');
    }
});
function select_user()
	{
		$('#bodyhistory').html('');
		var dt1 = $('#single_cal2').val();
		var dt2 = $('#single_cal3').val();
		var user = $('#user').val();
			$.ajax({
				url: 'sel_state',
				type: 'POST',
				dataType: 'json',
				data: {dt1:dt1,dt2:dt2,user:user},
			})
			.done(function(res) {
				if (res.code == 1) {
					
					$('#gethistory').modal();
					console.log(res);
					if(res.data.length >= 1 ){
						var conut 	= res.data.length;
						var wd 		= res.data;
						var content = '';
						for(var i=0; i < conut; i++){
							content += '<tr>';
							content += '<td>'+i+'</td>';
							content += '<td>'+wd[i]['id']+'</td>';
							content += '<td>'+wd[i]['newTime1']+'</td>';
							content += '<td>'+wd[i]['newTime2']+'</td>';
							if(wd[i]['deposit'] != 0){		content += '<td class="text-right">'+wd[i]['deposit']+'</td>';}else{content += '<td class="text-right"> - </td>';}
							if(wd[i]['withdraw'] != 0){		content += '<td class="text-right">'+wd[i]['withdraw']+'</td>';}else{content += '<td class="text-right"> - </td>';}
							content += '<td>'+wd[i]['user']+'</td>';
							content += '<td>'+wd[i]['username']+'</td>';
							content += '<td>'+wd[i]['account']+'</td>';
							content += '<td>'+wd[i]['bank_short']+'</td>';
							content += '<td>'+wd[i]['note']+'</td>';
							content += '<td>'+wd[i]['admin_name']+'</td>';
							content += '</tr>';
						}

					}else{
						var content = 'No data';
					}
				}else{
					swal(res.title,res.msg,'error');
				}
				$('#bodyhistory').html(content);
			})
			.fail(function() {
				console.log("error");
			});
		
		
	}
</script>
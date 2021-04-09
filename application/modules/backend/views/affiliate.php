<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Affiliate</h2>
          <ul class="nav navbar-right panel_toolbox">

          </ul>
          <div class="clearfix"></div>
        </div>
     
        <!-- <div class="col-md-4"> -->
        <div class="col-md-4">
			<div class="x_panel">
				<div class="x_title">
					<h2>ระบบค้นหา</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="form-group row">
						<div class="col-sm-10"> ID : <?=$this->getapi_model->agent();?>  ใส่แค่ตัวเลข 6 หลักหลัง Ex: 007805
							<input type="text" value="" class="form-control" id="s_user" maxlength="6" placeholder="รหัสลูกค้า">
							
						</div>
						<div class="col-sm-2"><br>
							<button onClick="select_user(1)" class="btn btn-info">ค้นหา</button>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10"> Tel : ใส่แค่ตัวเลข 10 หลัก Ex: 0929874561
							<input type="text" value="" class="form-control" id="t_user" maxlength="10" placeholder="เบอร์โทรลูกค้า">
						</div>
						<div class="col-sm-2"><br>
							<button onClick="select_user(2)" class="btn btn-info">ค้นหา</button>
						</div>
					</div>
				</div>
			</div>
</div>

<div class="col-md-4" style="display: none;" id="u_detail">
			<div class="x_panel">
				<div class="x_title">
					<h2>ปันผล</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="form-group row">
          <div class="col-md-3 ">
                          <span>รหัสระบบ</span> 
						</div>
						<div class="col-md-9 ">
                          <input type="text" class="form-control has-feedback-left"  value="" id="user" readonly>
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> 
						</div>
					</div>
					<div class="form-group row">
          <div class="col-md-3 ">
                          <span>รหัสเข้าเล่น</span> 
						</div>
						<div class="col-md-9 ">
                          <input type="text" class="form-control has-feedback-left"  value="" id="username" readonly>
                          <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span> 
						</div>
					</div>
					<div class="form-group row">
          <div class="col-md-3 ">
                          <span>ปันผลที่เคยได้รับทั้งหมด</span> 
						</div>
						<div class="col-md-9 ">
                          <input type="text" class="form-control has-feedback-left"  value="" id="amount" readonly>
                          <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span> 
						</div>
					</div>
				
				</div>
			</div>
</div>
      
	<!--	</div> -->
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                <div class="row">
                    <div class="col-md-4">
                      <h5 class="text-center">ลูกค้าชั้นที่ 1</h5>
                      <table class="table">
                        <thead>
                          <tr align="center">
                            <!-- <th>no</th> -->
                            <th>User</th>
                            <th>ยอดเทิร์นโอเวอร์</th>
                            <th>เทิร์นล่าสุด</th>
                          </tr>
                        </thead>
                        <tbody id="f_class">
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-4">
                      <h5 class="text-center">ลูกค้าชั้นที่ 2</h5>
                      <table class="table">
                        <thead>
                          <tr align="center">
                            <!-- <th>no</th> -->
                            <th>User</th>
                            <th>ยอดเทิร์นโอเวอร์</th>
                            <th>เทิร์นล่าสุด</th>
                          </tr>
                        </thead>
                        <tbody id="s_class">
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-4">
                      <h5 class="text-center">ลูกค้าชั้นที่ 3</h5>
                      <table class="table">
                        <thead>
                          <tr align="center">
                            <!-- <th>no</th> -->
                            <th>User</th>
                            <th>ยอดเทิร์นโอเวอร์</th>
                            <th>เทิร์นล่าสุด</th>
                          </tr>
                        </thead>
                        <tbody id="t_class">
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
  </div>
</div>

<script src="<?php echo base_url()?>public/tem_admin/vendors/switchery/dist/switchery.min.js"></script>
<script>
function select_user(st)
{
	$('#f_class').html('');
	$('#s_class').html('');
	$('#t_class').html('');
  $('#cover-spin').show();
        if (st == 1) {
            var s_user = $('#s_user').val();
            $('#t_user').val('');
            var t_user = '';
        }else{
            var t_user = $('#t_user').val();
            $('#s_user').val('');
            var s_user = '';
        }
		$.ajax({
			url: '<?=base_url()?>backend/affiliate/detail',
			type: 'POST',
			dataType: 'json',
			data: {s_user:s_user,t_user:t_user},
		})
		.done(function(res) {
			if (res.code == 1) {
        console.log(res.data);
        $('#cover-spin').hide();
        $('#u_detail').show();
        $('#user').val(res.u_data['user']);		
        $('#username').val(res.u_data['username']);
        var amount = parseFloat(res.u_data['amount']['amount']).toFixed(2);
        if(res.u_data['amount']['amount'] != null){$('#amount').val(amount)}else{$('#amount').val('0')};

					var content = '';
					var content2 = '';
          var content3 = '';
          var count = res.f_class.length;
        
          
         if(count > 0){
           for(var i=0; i < count; i++ ){
						
            
            if(res.f_class[i]['last_date'] == '' || res.f_class[i]['last_date'] == null){
                var new_date = '-';
            }else{
                var date_time = res.f_class[i]['last_date'];
                var new_date = new Date(date_time * 1000).format('d-m-Y');
            }

            if(res.f_class[i]['turnover'] == '' || res.f_class[i]['turnover'] == null){
              var total = '-';
            }else{
              var total = parseFloat(res.f_class[i]['turnover']).toFixed(2);
            }

						content +=  '<tr align="center">';
						if(res.f_class[i]['user'] != null){content +=  '<td>'+res.f_class[i]['user']+'</td>';}else{content +=  '<td> - </td>';} //user
            if(total != null){content +=  '<td>'+total+'</td>';}else{content +=  '<td> - </td>';} //turnover
            if(new_date != null){content +=  '<td>'+new_date+'</td>';}else{content +=  '<td> - </td>';} // date create
						content +=  '</tr>';
					  
            if(res.f_class[i]['s_class']){
              var s_class = res.f_class[i]['s_class'].length; 
            if(s_class > 0){
              for(var n=0; n < s_class; n++){

                if(res.f_class[i]['s_class'][n]['last_date'] == '' || res.f_class[i]['s_class'][n]['last_date'] == null){
                  var new_date = '-';
                }else{
                  var date_time = res.f_class[i]['s_class'][n]['last_date'];
                  var new_date = new Date(date_time * 1000).format('d-m-Y');
                }
                
                if(res.f_class[i]['s_class'][n]['turnover'] == '' || res.f_class[i]['s_class'][n]['turnover'] == null){
                  var total = '-';
                }else{
                  var total = parseFloat(res.f_class[i]['s_class'][n]['turnover']).toFixed(2);
                }

                content2 +=  '<tr align="center">';
                if(res.f_class[i]['s_class'][n]['user'] != null){content2 +=  '<td>'+res.f_class[i]['s_class'][n]['user']+'</td>';}else{content2 +=  '<td> - </td>';} //user
                if(total != null){content2 +=  '<td>'+total+'</td>';}else{content2 +=  '<td> - </td>';} //turnover
                if(new_date != null){content2 +=  '<td>'+new_date+'</td>';}else{content2 +=  '<td> - </td>';} // date create
                content2 +=  '</tr>';

                if(res.f_class[i]['t_class']){
                  var t_class = res.f_class[i]['t_class'].length; 
              if(t_class > 0){
                for(var x=0; x < t_class; x++){
                  if(res.f_class[i]['t_class'][x]['last_date'] == '' || res.f_class[i]['t_class'][x]['last_date'] == null){
                      var new_date = '-';
                  }else{
                      var date_time = res.f_class[i]['t_class'][x]['last_date'];
                      var new_date = new Date(date_time * 1000).format('d-m-Y');
                  }
                  
                  if(res.f_class[i]['t_class'][x]['turnover'] == '' || res.f_class[i]['t_class'][x]['turnover'] == null){
                    var total = '-';
                  }else{
                    var total = parseFloat(res.f_class[i]['t_class'][x]['turnover']).toFixed(2);
                  }

                  content3 +=  '<tr align="center">';
                  if(res.f_class[i]['t_class'][x]['user'] != null){content3 +=  '<td>'+res.f_class[i]['t_class'][x]['user']+'</td>';}else{content3 +=  '<td> - </td>';} //user
                  if(total != null){content3 +=  '<td>'+total+'</td>';}else{content3 +=  '<td> - </td>';} //turnover
                  if(new_date != null){content3 +=  '<td>'+new_date+'</td>';}else{content3 +=  '<td> - </td>';} // date create
                  content3 +=  '</tr>';
                }

              }else{
                
              }
                }else{

                }
                
              }

              

            }else{
                  
            }
            }else{
              
            }
            
					}

          
         }else{

                  content +=  '<tr align="center">';
                  content +=  '<td colspan="4"> ไม่มีข้อมูล </td>'; //no
                  content +=  '</tr>';
              
         }
					

         
          

					
					
					 
		$('#f_class').html(content);
		$('#s_class').html(content2);			
    $('#t_class').html(content3);	
				// $('#f_class').html(content);
			}else if(res.code == 2){
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
</script>
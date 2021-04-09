
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<style>
  table.dataTable tbody tr {
    background-color: #343a40;
  }
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #f9f9f9 !important;
    border: 1px solid transparent;
    background: transparent;
    box-shadow: none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0.5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    *cursor: hand;
    color: #fffdfd !important;
    border: 1px solid transparent;
    border-radius: 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #333 !important;
    border: 1px solid #979797;
    background-color: white;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #dcdcdc));
    background: -webkit-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: -moz-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: -ms-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: -o-linear-gradient(top, #fff 0%, #dcdcdc 100%);
    background: linear-gradient(to bottom, #fff 0%, #dcdcdc 100%);
}
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
    outline: none;
    background-color: #f9f9f9;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
    background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
    box-shadow: inset 0 0 3px #fbfbfb;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
 .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #adaeaf !important;
    border: 1px solid #2d2a2a00;
    background: #343a40;
    box-shadow: none;
}
.dataTables_wrapper .dataTables_paginate {
    float: right;
    text-align: right;
    padding-top: 0.25em;
    background-color: #343a40;
    font-size: 12px;
}

.dataTables_length {
  display: none;
}
.pagination {
  display: none;
}
.dataTables_info {
  display: none;
}

</style>

<!-- CONTACT-->
<header class="masthead   text-white text-center" style="padding-top: calc(6rem - 10px) !important; height: 90%;" id="tap_contact">
	
  <div class="container">
    <div class="row" style="padding: 20px;">
    <div class="col-12">
     <label  class="text-left">ประกาศ</label><br>
     <div class="table-responsive-lg">
      <table id="myTable" class="table table-striped table-dark  display responsive nowrap" style="width:100% ;font-weight: 100;font-size: 11px;">
        <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">วันที่</th>
          <th scope="col">เวลา</th>
          <th scope="col">รายละเอียด</th>
          <th scope="col">จาก</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i=1; 
          if(!empty($announce)){ 
            foreach($announce as $an){ ?>
          <tr  style="background-color:#343a40;font-size: 11px">
          <td><?=$i?></td>
          <td><?=date('d/m',$an['create_time'])?></td>
          <td><?=date('H:i',$an['create_time'])?></td>
          <td><?=$an['text'];?></td>
          <td><?=$an['from_name']?></td>

          </tr>
          <?php 
            $i++;
            } 
          }else{?>
        
          <tr>
            <td colspan="4">ไม่มีข้อมูล</td>
          </tr>
          <?php }?>
        </tbody>
      </table>
     </div>
    </div>
    </div>
  </div>
</header>
<script src="<?php echo base_url()?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

<!--Modal-->

<script>
$(document).ready( function () {
    $('#myTable').DataTable({
		responsive: true,
      "searching": false,
      "pageLength": 5,
      "lengthChange": false,
      "ordering": false,
        "info":     false
    });
  } );
//   $(document).ready( function () {
// 			$('#myTable')
// 				.addClass( 'nowrap' )
// 				.dataTable( {
// 					responsive: true,
// 					columnDefs: [
// 						{ targets: [-1, -3], className: 'dt-body-right' }
// 					],
//           "searching": false,
//           "pageLength": 5,
//           "lengthChange": false,
//           "ordering": false,
//         "info":     false

// 				} );
// 		} );


function selectType()
	{
		var typegame = $('#typegame').val();
		$.ajax({
		   url: 'report_games',
		   type: 'POST',
		   dataType: 'json',
		   data: {typegame:typegame},
		 })
			.done(function(res) {
			// success
			if (res.code == 1) {
				swal(res.title, res.msg, "success")
					.then(function(sw){
						$('#cover-spin').show();
                        setTimeout(function(){
                            $('#cover-spin').hide();
                            window.location.href = "member";
                        },2000);
					}); 
			//ระบบมีปัญหา
			}else{
				swal(res.title, res.msg, "error")
					.then(function(sw){
						location.reload();
					});
			}
			});
	}
</script>
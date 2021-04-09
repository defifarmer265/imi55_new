
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

#mytab {
 
 
  height: 450px;
  overflow: auto;
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
<div id="cover-spin"></div>
<!-- CONTACT-->
<header class="masthead text-white text-center" style="padding-top: calc(6rem - 10px) !important; height: 90%;" id="tap_contact">
	
  <div class="container">
    <div class="row" style="padding: 20px;">
    <div class="col-12">
		 <label  class="text-left">เครือข่าย</label><br>
     <?php if(!empty($data)) { ?>
     <div >
     
     <input id="turnover" style="margin-right: auto;margin-left: auto;" class="form-control col-sm-10 text-center" value="<?php if(!empty($credit->sale_credit)){ echo number_format($credit->sale_credit, 2); }else{ echo '0.00';}?>" readonly><br>
    
     <button type="button" class="btn btn-info btn-sm" onClick="all_turn('<?=$this->session->member->id?>')">คำนวณปันผล</button>
     <button type="button" class="btn btn-info btn-sm" onClick="get_aff('<?=$this->session->member->id?>')">กดรับปันผล</button>
     <button type="button" class="btn btn-info btn-sm" onClick="javascript:window.location.href='<?=base_url()?>users/network/report_aff'">รายการร้องขอ</button>
     </div><?php }?>
     <?php if(!empty($user_n)){foreach($user_n as $dn) {?>
            <p><?=$dn['user'];?></p>
     <?php }}?><br>
     <div id="mytab">
		<table id="myTable" class="table table-striped table-dark display responsive nowrap" style="font-weight: 100;font-size: 11px">
  <thead>
    <tr align="center">
      <th scope="col">No</th>
      <th scope="col" >รหัส</th>
      <th scope="col" >ยอดturn</th>
      <th scope="col" >ระดับชั้น</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($data)){ $i=1; foreach($data as $dt){ ?>
	  <tr align="center" style="background-color:#343a40;font-size: 11px">
      <td><?=$i++;?></td>
      <?php foreach($dt['dt_user'] as $du){ ?>
      <td><a  href="network/<?php echo $du['id'];?>" ><?=$du['user'];?></td>
      <?php foreach($dt['turnover'] as $tr){?>
      <td><?=$tr['turnover']?></td>
      <?php }?>
      <td>1</td>
    </tr>
  <?php }}}else if(!empty($dt_user)){ $i=1; foreach($dt_user as $ds){?>
    <tr align="center" style="background-color:#343a40;font-size: 11px">
      <td><?=$i++;?></td>
      <?php foreach($ds['du_user'] as $du){ ?>
      <td><a  href="../get_data/<?php echo $du['id'];?>" ><?=$du['user'];?></td>
      <?php foreach($ds['turnover'] as $tr){ ?>
      <td><?=$tr['turnover']?></td>
      <?php }?>
      <td>2</td>
    </tr>
  <?php }}}else if(!empty($data_u)) { $i=1; foreach($data_u as $dt){ ?> 
    <tr align="center" style="background-color:#343a40;font-size: 11px"> <!-- get data -->
      <td><?=$i++;?></td>
      <?php foreach($dt['du_user'] as $du){ ?>
      <td><?=$du['user'];?></td>
      <?php foreach($dt['turnover'] as $tt){ ?>
      <td><?=$tt['turnover']?></td>
      <?php }?>
      <td>3</td>
    </tr>
      <?php }}}else{?>
        <tr>
        <td colspan="4" align="center">ไม่มีข้อมูล</td>
    </tr>
      <?php } ?>
  </tbody>
		</table>
    </div>
    </div>
    </div>
  </div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="<?php echo base_url()?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script>
   

function all_turn(user_id){
          swal({
            title: 'ยืนยันการทำรายการ',
            text: 'คุณต้องการทำรายการนี้ใช่หรือไม่?',
            buttons: true,
            dangerMode: true,
          }).then ((willDelete) => {

            if(willDelete) {
              $('#cover-spin').show();
            $.ajax({
            url: '<?=base_url('users/network/all_turn')?>',
            type: 'POST',
            dataType: 'json',
            data: {user_id:user_id}
          })
          .done(function(res){
            if (res.code == 1){
              $('#cover-spin').hide();
				      swal({
                icon: "success",
                text: res.msg
              });
              setTimeout(function(){
                location.reload();
              }, 2000);
                         
			      }else if(res.code == 2){
              $('#cover-spin').hide();
				      swal({
                icon: "error",
                title: res.title,
                text: res.msg
              });
              setTimeout(function(){
                location.reload();
              }, 2000);

            }
          
          });
          }else{
            return false;
          }
      });
          
}
// 1595955600
// 1596387600
function get_aff(user_id){
  
  swal({
    title: 'ยืนยันการทำรายการ',
    text: 'คุณต้องการทำรายการนี้ใช่หรือไม่?',
    buttons: true,
    dangerMode: true
  }).then ((willDelete) => {
    
    if(willDelete){
      // $('#cover-spin').show();
  $.ajax({
    url: '<?=base_url('users/network/affiliate')?>',
    type: 'POST',
    dataType: 'json',
    data: {user_id: user_id}
  })
  .done(function(res){
    if(res.code == 1){
     
      swal({
        icon: "success",
        text: res.msg
      });
      setTimeout(function(){
                location.reload();
              }, 2000);
    }else if(res.code == 2){
      swal({
        icon: "error",
        text: res.msg
      });
      setTimeout(function(){
                location.reload();
              }, 2000);
    }
  });

    }else{

      return false;

    }

  });

}

</script>

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

  
</script>



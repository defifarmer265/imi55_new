<!-- CONTACT-->
<header class="masthead bg-primary text-white text-center" style="padding-top: calc(6rem - 10px) !important; height: 90%;" id="tap_contact">
	
  <div class="container">
    <div class="row" style="padding: 20px;">
    <div class="col-12">
		 <label  class="text-left">เครือข่าย</label><br>
        <br>
		<table class="table table-striped table-dark"style="font-weight: 100;font-size: 11px">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">รหัส</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($count)) { $i=1; foreach($count as $dt){ ?>
	  <tr>
      <td><?=$i++;?></td>
      <?php foreach($dt['dt_u'] as $du){ ?>
      <td><?=$du['user_id'];?></td>
      <?php } ?>
      
    </tr>
  <?php }foreach($dt_u as $dc){ foreach($dc['dc_u'] as $di){?>
      <p><?=$di['user_id'];?></p>
      <?php }} }else{ ?>
    <tr>
        <td colspan="3" align="center">ไม่มีข้อมูล</td>
    </tr>
  <?php } ?>
  </tbody>
		</table>
    </div>
    </div>
  </div>
</header>



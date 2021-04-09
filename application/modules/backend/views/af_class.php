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

        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead style="background-color: #2a3f54;color: #fff;" >
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th>Id</th>
                                <th>ยูสเซอร์</th>
                                <th>เบอร์โทร</th> 
                                <?php if(!empty($f_class) || !empty($s_class) || !empty($t_class))  { ?>
                                <th>ยอดเทิร์น</th> 
                                <?php } ?>      
                                <th>ยอดเทิร์นรวม</th>
                            </tr>
                            </thead>
                            <tbody id="bodyhistory">
                            <?php  if(!empty($all_r)){$i=1;foreach($all_r as $ar){ ?>
                            <tr class="text-center">
                                <td><?=$i?></td>
                                <td><a href="<?=base_url()?>backend/affiliate/FrClass/<?=$ar['id']?> "><?=$ar['id']?></a></td>
                                <td><?=$ar['user']?></td>
                                <td><?=$ar['username']?></td>
                                <td><?=$ar['turnover']?></td>
                            </tr>
                            <?php $i++; }}?>
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
</div>

<script src="<?php echo base_url()?>public/tem_admin/vendors/switchery/dist/switchery.min.js"></script>
<script>
function select_user()
{

    var s_user = $('#s_user').val();
	var t_user = $('#t_user').val();
	
		$.ajax({
			url: '<?=base_url()?>backend/affiliate/AfClass',
			type: 'POST',
			dataType: 'json',
			data: {s_user:s_user,t_user:t_user},
		})
		.done(function(res) {
			if(res.code == 1){
        

      }
			
		})
		.fail(function() {
			console.log("error");
		});
		

}
</script>
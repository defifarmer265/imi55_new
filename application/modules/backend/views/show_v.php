<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<style>
#overflowTest {

  color: white;
  padding: 25px;
  width: 100%;
  height: 100%;
  overflow: auto;
  border: 1px solid #ccc;
}

</style>
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>คู่มือการใช้งานหลังบ้าน<small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="row "id="overflowTest">
            <?php for($i=1; $i<=12; $i++){?>
                <div class="col-md-4 col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                        </div>
                            
                            <h5 class="card-title mt-3 ml-2">คู่มือการใช้งานหลังบ้า่น</h5>
                        </div>
                    </div>
                </div>
            <?php }?>
            </div>
        
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

</script>
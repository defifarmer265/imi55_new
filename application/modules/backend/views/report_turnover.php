<style>
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

  .lds-dual-ring {}

  .lds-dual-ring:after {
    content: " ";
    display: block;
    width: 30px;
    height: 30px;
    padding-bottom: -20px;
    border-radius: 50%;
    border: 6px solid #000;
    border-color: #000 transparent #000 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }

  @keyframes lds-dual-ring {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

<div id="cover-spin"></div>
<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>TURNOVER <small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <form action="ReportTurnover" method="POST">
                <div class="form-group row">
                  <div class="col-sm-3"> ID :
                   
                    Ex: 007805
                    <input type="text" value="" class="form-control" name="user" id="user" maxlength="6" placeholder="รหัสลูกค้า" value="" required>
                  </div>
                  <div class="col-sm-3"> วันเริ่ม
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="d1">
                  </div>
                  <div class="col-sm-3"> วันสิ้นสุด
                    <input type="date" value="<?= date('Y-m-d') ?>" class="form-control" name="d2">
                  </div>
                  <div class="col-sm-3"><br>
                    <button type="submit" class="btn btn-info" id="sh">ค้นหา</button>
                  </div>
                </div>
              </form>
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
 
</script>
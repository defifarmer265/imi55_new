<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<style>
  table.dataTable tbody tr {
    background-color: #343a40;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
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

  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
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
        <label class="text-left">โปรโมชั่น</label><br>
        <br>
        <div class="container">
          <div class="form-row">
            <?php if (sizeof($dt) != 0) { ?>
              <?php foreach ($dt as $data) { ?>
              <div class="col-md-6 btn" onClick="javascript:window.location.href='<?= base_url() ?>users/promotion/detail/<?= $data['id'] ?>'">
                <img src="<?= base_url() ?>public/promotion/<?php echo $data['link_img'] ?>" width="100%">
              </div>
            <?php } ?>
            <?php } ?>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<script src="<?php echo base_url() ?>public/tem_admin/vendors/jquery/dist/jquery.min.js"></script>
<script>

</script>
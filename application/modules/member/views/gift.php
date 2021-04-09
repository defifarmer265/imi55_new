<!-- CONTACT-->
<header class="masthead  text-white text-center" id="tap_contact">
  <br>

  <div class="container">
    <div class="form-row p-3" onClick="javascript:window.location.href='<?=base_url()?>users/gift/exchange_rewards'">
      <div class="col-md-12 btn">

        <img src="<?=$this->config->item('tem_frontend')?>img/exchang_credit.png" title="imi55" alt="imi55" width="100%">

      </div>
    </div>

    <!------------------------------- ปุ่ม Link IMIMALL------------------------------------------- -->
    <form action="<?=base_url()?>users/gift/hash_data" method="POST" id="change_mall">
      <div class="form-row p-3" onClick="reward()">
        <div class="col-md-12 btn">
          <input type='hidden' name="user_id" value="<?php echo $user_id ?>">
          <input type='hidden' name="webname" value="<?php echo $webname ?>">
          <img src="<?=$this->config->item('tem_frontend')?>img/exchang_reward.png" title="imi55" alt="imi55" width="100%">
        </div>
      </div>
    </form>
    <!------------------------------- ถึงตรงนี้----------------------------------------------------- -->
  </div>
</header>



<script>
  function reward() {
    document.getElementById('change_mall').submit();
  }
</script>
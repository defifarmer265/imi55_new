  <div class="row">
      <div class="col-md-11 col-sm-11 ">
          <div class="x_panel">
              <div class="x_title">
                  <h2>รายชื่อแบงค์<small></small></h2>
                  <div class="clearfix"></div>
              </div>
              <div class="row">
                  <div class="col-md-4 col-sm-12  form-group has-feedback">
                      <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 ">ยอดถอนขั้นต่ำ</label>
                          <div class="col-md-7 col-sm-7 ">
                              <input type="text" class="form-control text-right" id="wd_min_amount"
                                  value="<?=number_format($wd_min)?>">
                          </div>
                          <div class="col-md-2 col-sm-2 ">
                              <button class="btn btn-info" onClick="setWD('wd_min')"> ตกลง</button>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-md-7 col-sm-7 "> </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4 col-sm-12  form-group has-feedback">
                      <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 ">ยอดถอนต่อวัน</label>
                          <div class="col-md-7 col-sm-7 ">

                              <input type="text" class="form-control text-right" id="wd_count_amount"
                                  value="<?=number_format($wd_count)?>">
                          </div>
                          <div class="col-md-2 col-sm-2 ">
                              <button class="btn btn-info" onClick="setWD('count_wd')"> ตกลง</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4 col-sm-12  form-group has-feedback">
                      <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 ">ถอนสูงสุดต่อครั้ง</label>
                          <div class="col-md-7 col-sm-7 ">

                              <input type="text" class="form-control text-right" id="wd_max_amount"
                                  value="<?=number_format($wd_max)?>">
                          </div>
                          <div class="col-md-2 col-sm-2 ">
                              <button class="btn btn-info" onClick="setWD('wd_max')"> ตกลง</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  <script>
function setWD(type) {
    if (type == 'wd_min') {
        var amount = $('#wd_min_amount').val();
    } else if (type == 'count_wd') {
        var amount = $('#wd_count_amount').val();
    } else if (type == 'wd_max') {
        var amount = $('#wd_max_amount').val();
    }

    swal({
        title: 'คุณแก้ไขเป็น : ' + amount,
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '<?=base_url()?>backend/bank/setWD',
                type: 'POST',
                dataType: 'json',
                data: {
                    type: type,
                    amount: amount
                },
            }).done(function(res) {
                if (res.code == 1) {
                    swal({
                        icon: "success",
                        title: "success",
                        text: res.msg,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    swal({
                        icon: "error",
                        title: "error",
                        text: res.msg,
                    });
                }
            });
        } else {

        }

    });
}
  </script>
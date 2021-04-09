<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-11 col-sm-11 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Affiliate</h2>
          <ul class="nav navbar-right panel_toolbox">
          <input type="hidden" name="type" id="type"  value="">
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
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                            <thead style="background-color: #2a3f54;color: #fff;" >
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th>Id</th>
                                <th>ยูสเซอร์</th>
                                <th>ยอดเทิร์นรวม</th>
                                <th>วันที่กดรับล่าสุด</th>
                                <th>จากวันที่</th>
                            </tr>
                            </thead>
                            <tbody id="bodyhistory">
                            <?php $i=0;   foreach($log_aff as $af){  ?>
                            <tr class="text-center">
                              <td><?=$i+1?></td>
                              <td><a onClick="sdClass('<?=$af['id']?>')" data-toggle="modal" data-target="#getClass"><?=$af['id']?></a></td>
                              <td><?=$af['user']?></td>
                              <td><?=$af['aff_turn']?></td>
                              <td><?=$af['date_to'] == 0 ? '' : date('d/m/Y H:i:s', $af['date_to'])?></td>
                              <td><?=$af['date_from'] == 0 ? '' : date('d/m/Y H:i:s', $af['date_from'])?></td>
                              </tr>
                            <?php $i++; }?>
                            </tbody>
                        </table>
                        <div class="col-sm-1 form-inline" id="perpage">
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label col-form-label-sm">แสดง</label>
                            <div class="col-sm-10">
                              <select id="Per_Page" class="form-control" onchange="sentS(1);">
                                <option <?php if ($aff['Per_Page'] == 10) {
                                          echo "selected";
                                        } ?>>10</option>
                                <option <?php if ($aff['Per_Page'] == 20) {
                                          echo "selected";
                                        } ?>>20</option>
                                <option <?php if ($aff['Per_Page'] == 50) {
                                          echo "selected";
                                        } ?>>50</option>
                                <option <?php if ($aff['Per_Page'] == 100) {
                                          echo "selected";
                                        } ?>>100</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row" id="navv">
                        <div class="col-sm-6">
                          <span>รายการ :: <?php echo $aff['Num_Rows']; ?></span>
                          <p>หน้า ( <?=$aff['Num_Pages']; ?> )</p>
                        </div>
                        <div class="col-sm-6">
                          <nav aria-label="Page navigation example">
                            <ul class="pagination">
                              <!-- ก่อนหน้า -->
                              <li class='page-item'><a class='page-link' onclick="sentS(1);">
                                  << </a> </li> <?php

                                                $Prev_Page = $aff['Page'] - 1;
                                                $Next_Page = $aff['Page'] + 1;
                                                if ($Prev_Page) {
                                                  echo "<li class='page-item'><a class='page-link' onclick='sentS($Prev_Page);'> ก่อนหน้า </a></li> ";
                                                }
                                                ?> <!-- เลขหน้า -->
                                    <?php
                                    if ($aff['Page'] <= 6) {
                                      for ($i = 1; $i <= 10; $i++) {
                                        if ($i != $aff['Page']) {
                                          echo "<li class='page-item'><a class='page-link' onclick='sentS($i);'>$i</a>&nbsp;&nbsp;";
                                        }
                                        if ($i == $aff['Page']) {
                                          echo "<li class='page-item active'><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                        }
                                      }
                                    } else if ($aff['Page'] + 4 <= $aff['Num_Pages']) {

                                      for ($i = $aff['Page'] - 5; $i <= $aff['Page'] + 4; $i++) {
                                        if ($i != $aff['Page']) {
                                          echo "<li class='page-item '><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                        }
                                        if ($i == $aff['Page']) {
                                          echo "<li class='page-item active'><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                        }
                                      }
                                    } else {
                                      for ($i = $aff['Page'] - 5; $i <= $aff['Num_Pages']; $i++) {
                                        if ($i != $aff['Page']) {
                                          echo "<li class='page-item '><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                        }
                                        if ($i == $aff['Page']) {
                                          echo "<li class='page-item active'><a class='page-link' onclick='sentS($i);'>$i</a></li>";
                                        }
                                      }
                                    }
                                    ?>
                                    <!-- ถัดไป -->
                                    <?php
                                    if ($aff['Page'] != $aff['Num_Pages']) {
                                      echo "<li class='page-item'><a class='page-link' onclick='sentS($Next_Page);'> ถัดไป </a></li>";
                                    }
                                    ?>
                              <li class='page-item'><a class='page-link' onclick='sentS("<?=$aff["Num_Pages"] ?>");'> >> </a></li>
                            </ul>
                          </nav>
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
  </div>
</div>
  <!-- get link modal -->
  <div class="modal fade" id="getClass" tabindex="-1" role="dialog" aria-labelledby="getLinkLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="background-color: #ffffff; ">
      <div class="modal-header">
        <h5 class="modal-title" id="getLinkLabel" style="color:#000000;">เครือข่าย <h5 id="sale_uid" ></h5></h5>
        <!--  -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="clear_qrcode()" style="color:#F24646;">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
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
                            <th>ยอดเทิร์น</th>
                            <th>กดรับล่าสุด</th>
                            <th>จากวันที่</th>
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
                            <th>ยอดเทิร์น</th>
                            <th>กดรับล่าสุด</th>
                            <th>จากวันที่</th>
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
                            <th>ยอดเทิร์น</th>
                            <th>กดรับล่าสุด</th>
                            <th>จากวันที่</th>
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
<!-- end get link modal-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script>

    function sentS(Page) {

      $('#cover-spin').show();

              $('#bodyhistory').html('');
              console.log(Page)
              $.ajax({
                      url: '<?=base_url()?>backend/affiliate/detail_affi',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          Page: Page,
                          Per_Page: $('#Per_Page').val(),
                          search: $('#search').val()}, 
                  })

                  .done(function(res) {

                      $('#cover-spin').hide();

                      if (res.code == 1) {
                          var count = res.aff.length;
                          var one = res.aff;
                          var content = '';
                          var content2 = '';
                              

                              if (count > 0) {
          
                                  for (var i = 0; i < count; i++) {

                                    if(one[i]['date_update'] != ''){
                                      var date_time = one[i]['date_update'];
                                      var new_date = new Date(date_time * 1000).format('d-m-Y H:i:s');
                                    }else{
                                      var new_date = '';
                                    }
                                    
                                    if(one[i]['from_date']){
                                      var from_time = one[i]['from_date'];
                                      var from_date = new Date(from_time * 1000).format('d-m-Y H:i:s');
                                    }else{
                                      var from_date = '';
                                    }
                                          content += '<tr align="center">'
                                          content += '<td>' + [i + 1] + '</td>'
                                          content += '<td><a onClick="sdClass('+ one[i]['id'] +')" data-toggle="modal" data-target="#getClass">' + one[i]['id'] + '</a></td>'
                                          content += '<td>' + one[i]['user'] + '</td>'
                                          content += '<td>' + one[i]['sum'] + '</td>'
                                          content += '<td>' + new_date + '</td>'
                                          content += '<td>' + from_date + '</td>'
                                          content += '</tr>';
                                      }
                                      
                              }

                            $('#navv').html('');
                            var Page = parseInt(res.Page);
                            var con = res.con;
                            var Prev_Page = Page - 1;
                            var Next_Page = Page + 1;
                            var Num_Pages = parseInt(res.Num_Pages);
                            var Num_Rows = parseInt(res.Num_Rows);

                            var navv = `
                            <div class="col-sm-6">
                                      <span>รายการ :: ` + Num_Rows + `</span>
                                      <p>หน้า ( ` + Num_Pages + ` )</p>
                                    </div>
                                    <div class="col-sm-6">
                                      <nav aria-label="Page navigation example">
                                        <ul class="pagination">`;
                            if (!(Num_Rows <= res.Per_Page)) {
                              navv += '<li class="page-item"><a class="page-link" onclick="sentS(1);"> << </a></li>';
                              if (Prev_Page) {
                                navv += '<li class="page-item"><a class="page-link" onclick="sentS(' + Prev_Page + ');"> ก่อนหน้า </a></li> ';
                              }

                              if (Page <= 6) {
                                if (Num_Pages >= 10) {
                                  for (var i = 1; i <= 10; i++) {
                                    if (i != Page) {
                                      navv += '<li class="page-item"><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a>&nbsp;&nbsp;';
                                    }
                                    if (i == Page) {
                                      navv += '<li class="page-item active"><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a></li>';
                                    }
                                  }
                                } else {
                                  for (var i = 1; i <= Num_Pages; i++) {
                                    if (i != Page) {
                                      navv += '<li class="page-item"><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a>&nbsp;&nbsp;';
                                    }
                                    if (i == Page) {
                                      navv += '<li class="page-item active"><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a></li>';
                                    }
                                  }
                                }

                              } else if ((Page + 4) <= Num_Pages) {

                                for (var i = (Page - 5); i <= (Page + 4); i++) {
                                  if (i != Page) {
                                    navv += '<li class="page-item "><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a></li>';
                                  }
                                  if (i == Page) {
                                    navv += '<li class="page-item active"><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a></li>';
                                  }
                                }
                              } else {
                                for (var i = (Page - 5); i <= Num_Pages; i++) {
                                  if (i != Page) {
                                    navv += '<li class="page-item "><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a></li>';
                                  }
                                  if (i == Page) {
                                    navv += '<li class="page-item active"><a class="page-link" onclick="sentS(' + i + ');">' + i + '</a></li>';
                                  }
                                }
                              }

                              if (Page != Num_Pages) {
                                navv += '<li class="page-item"><a class="page-link" onclick="sentS(' + Next_Page + ');"> ถัดไป </a></li>';
                              }

                              navv += '<li class="page-item"><a class="page-link" onclick="sentS(' + Num_Pages + ');"> >> </a></li>';
                            } else {

                            }
                            navv += '</ul></nav></div>';

                            $('#navv').html(navv);

                                      $('#bodyhistory').html(content);
                                      $('#button').html(button);

                                      }else{
                                          swal({
                                            title: "error",
                                            text: "ผิดพลาด",
                                            icon: "error",
                                          });
                                      }

                                      })


                                  .fail(function() {
                                      console.log("error");
                                  });

}

    function sdClass(userid){

        var type = $('#type').val();

        $.ajax({
          url: '<?=base_url()?>backend/affiliate/detail_class',
          type: 'POST',
          dataType: 'json',
          data: {userid: userid, type: type},
        }).done(function(res) {
            if(res.code == 1){
              var content = ''
              var content2 = ''
              var content3 = ''
              var count = res.first.length
              // var second = res.first[i]['second'].length; 
              if(count > 0){
                for(var i=0; i < count; i++){
                  if(res.first[i]['date_update'] != ''){
                    var date_time = res.first[i]['date_update'];
                    var new_date = new Date(date_time * 1000).format('d-m-Y');
                  }else{
                    var new_date = '';
                  }
                  
                  if(res.first[i]['from_date']){
                    var from_time = res.first[i]['from_date'];
                    var from_date = new Date(from_time * 1000).format('d-m-Y');
                  }else{
                    var from_date = '';
                  }
                  

                  content +=  '<tr align="center">';
                  if(res.first[i]['f_user']['user'] != ''){content +=  '<td>'+res.first[i]['f_user']['user']+'</td>';}else{content +=  '<td> 0.00 </td>';} //user
                  if(res.first[i]['turnover'] != ''){content +=  '<td>'+res.first[i]['turnover']+'</td>';}else{content +=  '<td> 0.00 </td>';} //turnover
                  if(new_date != ''){content +=  '<td>'+new_date+'</td>';}else{content +=  '<td> - </td>';} // date create
                  if(from_date != ''){content +=  '<td>'+from_date+'</td>';}else{content +=  '<td> - </td>';}
                  content +=  '</tr>';

                  
                  if(res.first[i]['second'].length > 0){
                    for(var j=0; j < res.first[i]['second'].length; j++){

                      content2 +=  '<tr align="center">';
                      if(res.first[i]['second'][j]['s_user']['user'] != ''){content2 +=  '<td>'+res.first[i]['second'][j]['s_user']['user'] +'</td>';}else{content2 +=  '<td> 0.00 </td>';} //user
                      if(res.first[i]['second'][j]['turnover'] != ''){content2 +=  '<td>'+res.first[i]['second'][j]['turnover']+'</td>';}else{content2 +=  '<td> 0.00 </td>';} //turnover
                      if(new_date != ''){content2 +=  '<td>'+new_date+'</td>';}else{content2 +=  '<td> - </td>';} // date create
                      if(from_date != ''){content2 +=  '<td>'+from_date+'</td>';}else{content2 +=  '<td> - </td>';}
                      content2 +=  '</tr>';
                      
                      if(res.first[i]['third'].length > 0){
                        for(var x=0; x < res.first[i]['third'].length; x++){

                          content3 +=  '<tr align="center">';
                          if(res.first[i]['third'][j]['s_user']['user'] != ''){content3 +=  '<td>'+res.first[i]['third'][j]['s_user']['user'] +'</td>';}else{content3 +=  '<td> 0.00 </td>';} //user
                          if(res.first[i]['third'][j]['turnover'] != ''){content3 +=  '<td>'+res.first[i]['third'][j]['turnover']+'</td>';}else{content3 +=  '<td> 0.00 </td>';} //turnover
                          if(new_date != ''){content3 +=  '<td>'+new_date+'</td>';}else{content3 +=  '<td> - </td>';} // date create
                          if(from_date != ''){content3 +=  '<td>'+from_date+'</td>';}else{content3 +=  '<td> - </td>';}
                          content3 +=  '</tr>';

                        }
                      }
                    }
                  }
                }
              }



              $('#f_class').html(content);
              $('#s_class').html(content2);
              $('#t_class').html(content3);
            }
        });
      }
</script>
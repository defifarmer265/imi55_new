<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>บทความ<small> <button type="button" class="btn btn-round btn-warning" data-toggle="modal" data-target="#cre_admin"  >เพิ่มบทความ</button></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-reorder"></i> </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#" onClick="cre_admin()">เพิ่มบทความ</a> </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 14px;">
                    <thead style="background-color: #2a3f54;color: #fff;">
                      <tr  style="text-align:center;" >
                        <th style="vertical-align: middle;width: 15%"> No.</th>
                        <th style="vertical-align: middle;width: 25%"> หัวข้อ </th>
                        <!-- <th style="vertical-align: middle;width: 40%"> รายละเอียด </th> -->
                        <th style="vertical-align: middle;width: 20%"> รูปภาพ </th>
                        <th style="vertical-align: middle;width: 10%"> ประเภท </th>
                        <th style="vertical-align: middle;width: 20%"> จัดการ </th>
                        <th style="vertical-align: middle;width: 10%"> ลบ </th>

                      </tr>
                    </thead>
                    <?php   $i = 1; foreach($tb_article as $_p=>$promo){  ?>

                    <tbody>
                        <td align="center"><?php echo $i; ?></td>
                        <td><?php echo $promo['topic']; ?></td>
                        <!-- <td><?php echo $promo['detail']; ?></td> -->
                        <td align="center">

                          <?php if ($promo['img'] == "") { ?>

                          <b>ไม่มีรูปภาพ</b>

                          <?php }else {?>
                            <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>seo/<?php echo $promo['img']; ?>" style="width: 100%"> 
                           
                          <?php } ?>
                           </td>
                        <td align="center">
                          <?php if ($promo['category'] == "1") { ?>

                           <b>บาคาร่า</b>

                          <?php }else if ($promo['category'] == "2") { ?>
                           <b>ฟุตบอล</b>
                           <?php } else { ?>

                            <b>ไม่มี</b>
                           
                          <?php } ?>
                        </td>
                        <td align="center">
                          <button type="button" class="btn btn-round btn-success" data-toggle="modal" data-target="#Control<?php echo $i; ?>">แก้ไข</button>
                          <?php
                            if ($promo['status'] == "1") { ?>
                             <button  type="button" class="btn btn-round btn-warning" data-toggle="modal" data-target="#close_css<?php echo $promo['id']; ?>">  <i class="fa fa-user"> </i> ปิดการใช้งาน</button>

                            <?php }else{ ?>
                              <button  type="button" class="btn btn-round btn-info" data-toggle="modal" data-target="#close_css<?php echo $promo['id']; ?>"> <i class="fa fa-user"> </i>  เปิดการใช้งาน</button>
                             
                            <?php ; } ?>
                          </td>
                        <td align="center">
                            <form  action="Drope_css" method="post" onSubmit="if(!confirm('คุณแน่ใจใหมว่าต้องการลบบทความนี้ ?')){return false;}">
                              <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $promo['id']; ?>" >
                              <button type="submit" class="btn btn-round btn-danger">ลบ</button>
                            </form>
                        
                        </td>





<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="Control<?php echo $i; ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แก้ไข เอเย่นต์ฟุตบอล</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="edit-profile" action="editArticle" method="post" enctype="multipart/form-data">
 
        <div class="modal-body">
          <div class="x_content"> <br />

<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $promo['id']; ?>">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
              <input type="text" class="form-control" id="topic" name="topic" value="<?php echo $promo['topic']; ?>">
              <span class="fa fa-check-circle-o  form-control-feedback right" aria-hidden="true"></span> </div>
              
              <div align="center">
                <?php if ($promo['img'] == "") { ?>
                  <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>seo/png.png" style="width: 30%"> 
                <?php }else {?>
                  <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>seo/<?php echo $promo['img']; ?>" style="width: 30%"> 
                <?php } ?>
               
              </div>
              

              <div class="col-md-12 col-sm-12  form-group has-feedback">

              <input type="file" name="img" id="img" class="form-control"> <span class="fa fa-check-circle-o  form-control-feedback right" aria-hidden="true"></span>  </div>
              

            <script type="text/javascript" src="<?php  echo $this->config->item('tem_frontend_css'); ?>ckeditor/ckeditor.js"></script>
       
              <p>รายละเอียดที่อยู่</p>
                <textarea name="detail" id="detail<?php echo $i; ?>"><?php echo $promo['detail']; ?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('detail<?php echo $i; ?>');
                    function CKupdate() {
                        for (instance in CKEDITOR.instances)
                            CKEDITOR.instances[instance].updateElement();
                    }
                </script>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="close_css<?php echo $promo['id']; ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">ปิด / ลบ โปรโมชั่น</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <form class="form-label-left input_mask" id="close_css" action="close_Article" method="post" >
                    <div class="modal-body">
                      <div class="x_content">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $promo['id']; ?>" >
                        <h2>
                           <?php
                            if ($promo['status'] == "1") { ?>
                             <label class="radio-inline"><input type="radio" name="status" value="0">     ปิด</label>

                            <?php }else{ ?>
                              <label class="radio-inline"><input type="radio" name="status" value="1">    เปิด</label>
                             
                            <?php } ?>

                          
                          
                        </h2>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>





                      </tbody>
                    <?php $i++;} ?>

                      
                    
                
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




<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="cre_admin" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">บทความ</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-label-left input_mask" id="edit-profile" action="createArticle" method="post" enctype="multipart/form-data">
 
        <div class="modal-body">
          <div class="x_content"> <br />

              <div class="col-md-12 col-sm-12 form-group has-feedback ">
                <label for="sel1">โปรเลือกประเภท:</label>
                  <select class="form-control" id="category" name="category">
                    <option value="1">บาคาร่า</option>
                    <option value="2">ฟุตบอล</option>
                    
                  </select>
                </div>

              <div class="col-md-12 col-sm-12  form-group has-feedback">
              <input type="text" class="form-control" id="topic" name="topic" placeholder="หัวข้อ">
              <span class="fa fa-check-circle-o  form-control-feedback right" aria-hidden="true"></span> </div>

              <div class="col-md-12 col-sm-12  form-group has-feedback">
              <input type="file" name="img" id="img" class="form-control" required=""> <span class="fa fa-check-circle-o  form-control-feedback right" aria-hidden="true"></span>  </div>
              

              <script type="text/javascript" src="<?php  echo $this->config->item('tem_frontend_css'); ?>ckeditor/ckeditor.js"></script>
       
              <p>รายละเอียดที่อยู่</p>
                <textarea name="detail" id="detail"></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('detail');
                    function CKupdate() {
                        for (instance in CKEDITOR.instances)
                            CKEDITOR.instances[instance].updateElement();
                    }
                </script>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>






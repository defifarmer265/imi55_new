
<style>
  .noty_error{
  display: flex;
  justify-content: center; 
  color: red; 
  font-weight: bold; 
  background-image: linear-gradient(to right, #ff2121, #ff5047, #ff7269, #ff8f89, #ffaba8, #ffaba8, #ffaba8, #ffaba8, #ff8f89, #ff7269, #ff5047, #ff2121);
  }
</style>
<link href="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.css"
    rel="stylesheet">
<script src="<?php  echo $this->config->item('tem_backend_vendors'); ?>switchery/dist/switchery.min.js"></script>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-4 col-sm-2 col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h2>เปิด-ปิดระบบวงล้อ</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class=" radio">
                        <!-- เปิดปิด ระบบแอดเครดิต -->
                        <div class="form-group row">
                            <label>
                                <?php
                        if(empty($setting3)){
                          echo '<tr><td colspan="6" class="text-center text-danger">ขณะนี้ยังไม่มีข้อมูลถูกเพิ่มในขณะนี้</td></tr>';
                        }
                          $num = 1; foreach($setting3 as $set){ }
                        ?>
                                <?php //echo $set['id'];?>
                                <?php  if($set['code']=="0"){?>
                                <input type="checkbox" onchange="turnon_exchange();" id="idturnon"
                                    value="<?= $set['id'];?>" name="<?=$set['code']?>" class="js-switch"
                                    <?=$set['code'] == 0 ? '':''?> />
                                <?php }else{?>
                                <input type="checkbox" onchange="turnoff_exchange();" id="idturnoff"
                                    value="<?= $set['id'];?>" name="<?=$set['name']?>" class="js-switch"
                                    <?=$set['code'] == 1 ? 'checked':''?> />
                                <?php }?>
                                <span style="font-size: 18px;padding: 15px;color: #000">เปิด-ปิดระบบวงล้อ</span>
                            </label>
                        </div>
                        <!-- end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-lg-8 col-md-6 col-sm-4 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>ตั้งค่า วงล้อเสี่ยงโชค</h2>

          <div class="clearfix"></div>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-6 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table" width="100%" >
                   <thead>
						<tr style="background-color: #D39596;text-align: center;">
					   		<th width="5%" >No</th>
					   		<th>ชื่อ</th>
					   		<th width="10%">รูปภาพ</th>
					   	<!-- 	<th width="10%">รูปภาพ</th> -->
					
					   		<th>คะแนน</th>
                  <th>จำนวนรางวัล</th>
                 <!--  <th>คิดเป็นเปอร์เซ็น</th> -->
							<th>สถานะ</th>
       
    
					 
					   </tr>
                    </thead>
                    <tbody>
						
						<?php
						if(empty($spin)){
							echo '<tr><td colspan="6" class="text-center red"> ไม่มีข้อมูล</td></tr>';
						}
							foreach($spin as $sp){
                if ($sp['status']==0) {
                 $sp['eiei'] = 0;

                }
						?>
						<tr>
							<td class="text-center"  ><?=$sp['id']?></td>
							<td class="text-center"><?=$sp['name']?></td>
							<td class="text-center" ><img width="100%" src="<?=$this->config->item('tem_frontend_img').'/wheel/'.$sp['spin']?>" onClick="$('#img<?=$sp['id']?>').modal()"></td>
						<!-- 	<td class="text-center" ><img width="100%" src="<?=$this->config->item('tem_frontend_img').'/wheel/'.$sp['alert']?>" onClick="$('#img2<?=$sp['id']?>').modal()"></td> -->
				
							<td class="text-center"><?=$sp['point']?></td>
              
                <?php
                  if($sp['tus'] == 2){
                  ?>
                  <td class="text-center">0</td>
                  <!-- <td class="text-center"> 0</td> -->
                  <?php
                  }else {
                  ?>
                  <td class="text-center"><?=$sp['eiei']?></td>
                  <!-- <td class="text-center"> <?=$sp['eiei']/10?></td> -->
                  <?php
                  }
                ?>

							<td class="text-center"><?php
									if($sp['status'] == 1){
									?>
								<!--  <a href="#" onClick="edit_status('<?=$sp['id']?>','0')" title="ปิด"> -->
								  <i style="color:#3AED33;" class="fa fa-check"></i>
						<!-- 		</a> -->
									<?php
									}else{
								?>
							<!-- 	<a href="#" onClick="edit_status('<?=$sp['id']?>','1')" title="เปิด"> -->
									<i style="color:#F51F23;" class="fa fa-remove"></i>
								<!-- </a> -->
								<?php 
									}
								?></td>
               
               
               
						</tr>
						<div class="modal fade" id="img<?=$sp['id']?>" role="dialog">
							<div class="modal-dialog"> 
								<div class="modal-content">
									<img width="100%" src="<?=$this->config->item('tem_frontend_img').'/wheel/'.$sp['spin']?>" >
								</div>
							</div>
						</div>
						<div class="modal fade" id="img2<?=$sp['id']?>" role="dialog">
							<div class="modal-dialog"> 
								<div class="modal-content">
									<img width="100%" src="<?=$this->config->item('tem_frontend_img').'/wheel/'.$sp['alert']?>" >
								</div>
							</div>
						</div>
						<?php 
							}
						?>
                    </tbody>
                  </table>
                 
                   <button class="btn btn-success btn-block"  id="btn_editspin" onclick="edit_spinFrm('<?=$sp['id']?>')"    value="<?=$sp['id']?>"   title="แก้ไขการตั้งค่า">
                            <i class="fa fa-pencil"></i> แก้ไข <i class="fa fa-pencil"></i>
                </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="col-lg-4 col-md-3 col-sm-2">
      <div class="x_panel">
        <div class="x_title">
          <h2>จำนวนรางวัล</h2>

          <div class="clearfix"></div>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-6 ">
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table" width="100%" >
                   <thead>
            <tr style="background-color: #D39596;text-align: center;">
               
              <!--  <th width="10%">รูปภาพ</th> -->
          
       
    
           
             </tr>
                    </thead>
                    <tbody>
            
            <?php
            if(empty($count_rs)){
              echo '<tr><td colspan="6" class="text-center red"> ไม่มีข้อมูล</td></tr>';
            }
              foreach($count_rs as $sp2){
              
            ?>
            <tr>
              <td class="text-center"  > รางวัล <?=$sp2['point']?> จำนวน</td>
              <td class="text-center"><?=$sp2['eiei2']?> ครั้ง</td>
            
         
      
            </tr>
           
          
            <?php 
              }
            ?>
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
<!-- modal edit -->
<div class="modal fade" id="mod_edit_spin" role="dialog">
  <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ตั้งค่า Spin <small>(สำหรับพนักงาน)</small></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 <!--  <form class="form-label-left" id="form_edit_spin" style="font-size: 18px;"  method="post" action="up_spin"> -->
      <form class="form-label-left" id="form_edit_spin" style="font-size: 18px;"  method="post" >
        <div class="modal-body">

   <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
   
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">1</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383178.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname0" name="editname0" placeholder="หัวข้อ"  autocomplete="off"  readonly>
              </div>
            </div>
          </div>
   
           <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">คะแนน</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control" id="editpoint0" name="editpoint0" placeholder="คะแนนที่ได้รับ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>         
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัล</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control " id="editpercent0" name="editpercent0" placeholder="เปอร์เซ็น"  autocomplete="off"  onchange="calculate_ni()" >
              </div>
            </div>
          </div>
        
     </div>
</div>

 <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
       
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">2</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383177.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname1" name="editname1" placeholder="หัวข้อ"  autocomplete="off"  readonly>
              </div>
            </div>
          </div>
        
           <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">คะแนน</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control" id="editpoint1" name="editpoint1" placeholder="คะแนนที่ได้รับ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>         
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัลที่ออก</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control " id="editpercent1" name="editpercent1" placeholder="เปอร์เซ็น"  autocomplete="off"  onchange="calculate_ni()" >
              </div>
            </div>
          </div>
        
     </div>
</div>
 <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
         <!--  -->
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">3</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383176.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname2" name="editname2" placeholder="หัวข้อ"  autocomplete="off"  readonly>
              </div>
            </div>
          </div>

           <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">คะแนน</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control" id="editpoint2" name="editpoint2" placeholder="คะแนนที่ได้รับ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>         
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัลที่ออก</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control " id="editpercent2" name="editpercent2" placeholder="เปอร์เซ็น"  autocomplete="off"  onchange="calculate_ni()" >
              </div>
            </div>
          </div>
        
     </div>
</div>
 <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
          
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">4</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383175.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname3" name="editname3" placeholder="หัวข้อ"  autocomplete="off"  readonly>
              </div>
            </div>
          </div>
    
           <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">คะแนน</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control" id="editpoint3" name="editpoint3" placeholder="คะแนนที่ได้รับ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>         
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัลที่ออก</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control " id="editpercent3" name="editpercent3" placeholder="เปอร์เซ็น"  autocomplete="off"  onchange="calculate_ni()" >
              </div>
            </div>
          </div>
        
     </div>
</div>

 <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
           
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">5</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383174.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname4" name="editname4" placeholder="หัวข้อ"  autocomplete="off"  readonly>
              </div>
            </div>
          </div>
     
           <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">คะแนน</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control" id="editpoint4" name="editpoint4" placeholder="คะแนนที่ได้รับ"  autocomplete="off" readonly>
              </div>
            </div>
          </div>         
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัลที่ออก</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control " id="editpercent4" name="editpercent4" placeholder="เปอร์เซ็น"  autocomplete="off"  onchange="calculate_ni()" >
              </div>
            </div>
          </div>
        
     </div>
</div>
 <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
        
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">6</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383173.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname5" name="editname5" placeholder="หัวข้อ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>
     
           <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">คะแนน</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control" id="editpoint5" name="editpoint5" placeholder="คะแนนที่ได้รับ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>         
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัลที่ออก</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control " id="editpercent5" name="editpercent5" placeholder="เปอร์เซ็น"  autocomplete="off"  onchange="calculate_ni()" >
              </div>
            </div>
          </div>
        
     </div>
</div>
 <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
       
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">7</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383172.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname6" name="editname6" placeholder="หัวข้อ"  autocomplete="off"  readonly>
              </div>
            </div>
          </div>        
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัลที่ออก</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control "  id="editpercent6" name="editpercent6" placeholder="เปอร์เซ็น"  autocomplete="off"   onchange="calculate_ni()" >
              </div>
            </div>
          </div>
        
     </div>
</div>
 <div class="row">
          <div class="col-md-12 col-sm-12  form-group has-feedback" style="font-size: 23px;">
    
          </div>
          
          <div class="col-xl-5 col-sm-4 col-sm-3">
              <div class="col-md-12 col-sm-12  form-group has-feedback">
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3 ">8</label>
                  <div class="col-md-9 col-sm-9 ">        
                <!--   <input type="hidden" id="image" name="image" value="">
                            <input type="file" id="e_img" name="e_img"> -->
                            <br>
                           <img src="<?php echo $this->config->item('tem_frontend_img'); ?>wheel/1590383171.png">
                            <br>
                    </div>
                   </div>
                 </div>
          </div>
      <div class="col-xl-7 col-sm-6 col-sm-5">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">ชื่อ</label>
              <div class="col-md-9 col-sm-9 ">
                <input type="text" class="form-control" id="editname7" name="editname7" placeholder="หัวข้อ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>
           <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">คะแนน</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control" id="editpoint7" name="editpoint7" placeholder="คะแนนที่ได้รับ"  autocomplete="off" readonly >
              </div>
            </div>
          </div>         
         <div class="col-md-12 col-sm-12  form-group has-feedback">
            <div class="form-group row">
              <label class="col-form-label col-md-3 col-sm-3 ">จำนวนรางวัลที่ออก</label>
              <div class="col-md-3 col-sm-3 ">
                <input type="number" class="form-control " id="editpercent7" name="editpercent7" placeholder="เปอร์เซ็น"  autocomplete="off"  onchange="calculate_ni()" >
            
              </div>

            </div>

          </div>
          
     </div>
</div>

       
 <div class="noty_error"  id="result"></div>
          

        </div>
        <div class="modal-footer">
             <label style="width: 1000%; float:left;">หากแก้ไขแล้วไม่มีการเปลี่ยนแปลง ให้กดพื้นที่ว่างที่ฟอร์ม 1 ครั้ง</label><br>
          <input type="checkbox" id="check_submit" name="check_submit"  >
          <label for="vehicle1" id = "check_submit_text" >ยืนยันแก้ไข</label><br>
          <button type="submit"  class="btn btn-success"   id="btnsave">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function calculate_ni()
{   
    editpercent0 = parseFloat(document.getElementById('editpercent0').value);
    editpercent1 = parseFloat(document.getElementById('editpercent1').value);
    editpercent2 = parseFloat(document.getElementById('editpercent2').value);
    editpercent3 = parseFloat(document.getElementById('editpercent3').value);
    editpercent4 = parseFloat(document.getElementById('editpercent4').value);
    editpercent5 = parseFloat(document.getElementById('editpercent5').value);
    editpercent6 = parseFloat(document.getElementById('editpercent6').value);
    editpercent7 = parseFloat(document.getElementById('editpercent7').value);
    sum_percent = editpercent0 + editpercent1 + editpercent2+ editpercent3 + editpercent4 + editpercent5 + editpercent6 + editpercent7;
    console.log(sum_percent);
    if(sum_percent>1000){
      document.getElementById('result').style.visibility='visible';
      $('#result').html('จำนวนรางวัลเกิน 1000 รางวัล');
      document.getElementById('btnsave').style.visibility='hidden';
    }
    else if(sum_percent<=999){
      document.getElementById('result').style.visibility='visible';
      $('#result').html('จำนวนรางวัลน้อยกว่า 1000 รางวัล');     
      document.getElementById('btnsave').style.visibility='hidden';
    }
    else if(sum_percent=1000){
      document.getElementById('btnsave').style.visibility='visible';
      document.getElementById('check_submit').style.visibility='visible';
      document.getElementById('check_submit_text').style.visibility='visible';
      document.getElementById('result').style.visibility='hidden'; 
    }
}

// function สำหรับ เรียกหน้าสร้าง ข้อมูล
function form_crespin(){
	var data = new FormData();    
	data.append('spin', $('#spin')[0].files[0]);
	data.append('alert', $('#alert')[0].files[0]);
	data.append('name', $('#name').val());
	data.append('percent', $('#percent').val());
	data.append('point', $('#point').val());

	$.ajax({
		url: 'cre_spin',
		type: 'POST',
		dataType: 'json',
		processData: false,
		contentType: false,
		data: data,
	})
	.done(function(res) {
		if (res.code == 1) {
			swal(res.title,res.msg,'success').then(function(w){
				setTimeout(function(){
					location.reload();
				},1000);
			});
		}else{
			swal(res.title,res.msg,'error').then(function(w){
				setTimeout(function(){
					location.reload();
				},1000);
			});
		}
	})
	.fail(function() {
		console.log("error");
	});

}

// function สำหรับเรียกใช้หน้า modal
function cre_spin(){
	$('#mod_cre_spin').modal();
	$('#check_id').val('');
	$('#name').val('');
	$('#point').val('');

}


// function สำหรับ อัพเดท สถานะ 
function edit_status(id,status){
	swal({
			  title: 'ต้องการเปลี่ยนสถานะ?',
			  buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				 $.ajax({
					url: 'edit_spin',
					type: 'POST',
					dataType: 'json',
					data: {id:id,status:status},
				  }).done(function(res) {
					console.log(res);
					if (res.code == 1) {
						swal(res.title,res.msg,'success').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}else{
						swal(res.title,res.msg,'error').then(function(w){
							setTimeout(function(){
								location.reload();
							},700);
						});
					}
				  })
				  .fail(function() {
					console.log("error");
				  });
			}
		})		
 }

// function แก้ไขข้อมูลแสดงหน้า  modal
function edit_spinFrm(id){
	 $.ajax({
		url: 'spin_editFrm',
		type: 'POST',
		dataType: 'json',
		data: {id:id},
	  }).done(function(res) {
	   document.getElementById('btnsave').style.visibility='hidden';
      $('#mod_edit_spin').modal();  
     for(i=0; i<=res.length; i++){
     
	     if(res[i]['tus']==2){
     $('#edit_id'+i).val(res[i]['id']);
     $('#editname'+i).val(res[i]['name']);
     $('#editpercent'+i).val('0');
     $('#editpoint'+i).val(res[i]['point']);
   }else{
	   $('#edit_id'+i).val(res[i]['id']);
	   $('#editname'+i).val(res[i]['name']);
	   $('#editpercent'+i).val(res[i]['eiei']);
	   $('#editpoint'+i).val(res[i]['point']);
   }
	  
   }
	
	  })
	  .fail(function() {
		console.log("error");
	  });
 }



 
 


</script>
<script>
  

   function turnon_exchange() {
    swal({

            text: "คุณต้องการเปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#idturnon').val();
                $.ajax({
                        url: '<?php base_url()?>enable_spin',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });
}

function turnoff_exchange() {
    swal({

            text: "คุณต้องการปิดระบบแอดเครดิต",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willDelete) => {
            if (willDelete) {
                var id = $('#idturnoff').val();
                $.ajax({
                        url: '<?php base_url()?>disable_spin',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                    })
                    .done(function(res) {
                        // success
                        if (res.code == 1) {
                            swal({
                                icon: "success",
                                text: res.title,
                                button: false,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal('ผิดพลาด', 'กรุณาทำรายการใหม่อีกครั้งค่ะ', "error")
                                .then(function(sw) {
                                    location.reload();
                                });
                        }
                    });

            } else {
                swal('สำเร็จ', 'คุณได้ทำการกดยกเลิกเรียบร้อยแล้วคะ', "success")
                setTimeout(function() {
                    $('#cover-spin').hide();
                    window.location.href = "";
                }, 1000);
            }
        });

}
</script>
<script>

    $(document).ready(function() {

        var checkBox = document.getElementById("check_submit");
        $('#form_edit_spin').submit(function(e) {
          e.preventDefault();
          var formData = $(this).serialize();
        
                if (checkBox.checked == true) {
                    $.ajax({
                        url:'up_spin',
                        method: "POST",
                        data: new FormData(this),
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                       

                        success: function(res) {
                          swal(res.title,res.msg,'success').then(function(w){
                              setTimeout(function(){
                                location.reload();
                              },800);
                            });
                           
                      
                        },
                    });
                } else {
                    alert('กรุณายืนยันก่อนทำรายการ');
                  }
            
        }
        );


});


</script>
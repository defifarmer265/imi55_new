<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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

option {
    font-size: 14px;
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
</style>
<div id="cover-spin">
    <h2 class="text-center text-success py-5">โปรดรอสักครู่ ....</h2>
</div>
<div class="right_col" role="main">
  <div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Log All</h2>
                <div class="clearfix"></div>
            </div>
            <div class="row ">
                <div class="col-sm-2 "> วันเริ่ม
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="single_cal2"
                                        placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-sm-2"> วันสิ้นสุด
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="single_cal3"
                                        placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-2">รายการ Log ทั้งหมด
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                    <select class=" form-control" id="slectop">
                                        <option value="">เลือกรายการ</option>
                                        <!-- Log การเข้าสู่ระบบของ admin -->
                                        <optgroup label="หมวด Admin" style="font-size:13px;">
                                            <option value="logadmin"> Log admin</option>
                                            <!-- log แก้ไข username ลูกค้า -->
                                            <option value="logeidttel">Log edit username </option>

                                            <!-- log เปลี่ยน ชื่อ user -->
                                            <option value="logeditusername"> Log edit name </option>
                                            <!-- log เปล่ยนรหัสผ่าน user -->
                                            <option value="logedituserpass"> Log edit pass </option>
                                            <!-- log เปิด ปิด users เข้าสู่ระบบ -->
                                            <option value="loguserstatus">Log edit user status </option>

                                            <option value="Log_ranking"> Log_ranking </option>


                                            <!-- log เพิ่ม ลบ spint -->
                                            <option value="logedituserspin">Log spin </option>

                                            <!-- log การเพิ่ม ลบ คะแนน -->
                                            <option value="logpoint"> Log point</option>
                                            <!-- log การเพิ่ม ลบ เคดิต -->
                                            <option value="logcredit"> Log Add credit</option>
                                            <option value="log_d_credit"> Log Deleted credit</option>
                                            <!-- Log การ add turn ลูกค้า -->
                                            <option value="logaddturn"> Log turn</option>

                                            <!-- log bank แก้ไขเลขบัญชียูสเชอร์-->
                                            <option value="logbank"> Log bank</option>
                                            <option value="logbankstatus"> Log bank status</option>
                                            <!-- log แก้ไขกลุ่มการมองเห็น ธนาคาร -->
                                            <option value="logeditgroup"> Log bank edit group </option>
                                            <!-- log แก้ไขกลุ่ม ธนาคารของลูกค้า -->
                                            <option value="logeditusergroup"> Log bank edit user group </option>

                                            
                                         
                                            <!-- Log g -->
                                            <option value="Log_deposit"> Log_deposit </option>

                                            <option value="Log_withdraw"> Log_withdraw </option>

                                             <!-- Log g -->
                                           
                                            <option value="log_imimall"> Log_imimall </option>



                                            <!-- <option value="Log_event">Log_event</option> -->

                                            <option value="log_gift_create"> Log_gift_create </option>

                                            <option value="Log_gift_status"> Log_gift_status </option>

                                            <option value="Log_gift_voucher"> Log_gift_voucher </option>


                                            <option value="Log_promotion_create"> Log_promotion_create </option>
                                            <option value="Log_promotion"> Log_promotion </option>

                                            <option value="Log_event_create"> Log_event_create </option>

                                            
                                          
                                          

                                          
                                        </optgroup>

                                        <optgroup label="หมวด Sale" style="font-size:13px;">
                                            <!-- Log login ของ sale  -->
                                            <option value="logsale"> Log sale</option>
                                            <!-- log การเข้าระบบของ user -->
                                        </optgroup>

                                        <optgroup label="หมวด Users" style="font-size:13px;">

                                            <option value="logusers"> Log users</option>
                                            <option value="logcheckin"> Log checkin</option>
                                        </optgroup>
                                        <optgroup label="หมวด Owner" style="font-size:13px;">
                                            <option value="logowner"> Log owner</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-2"><br>
                    <button onClick="select_period()" class="btn btn-info"><i class="fa fa-search"></i> ค้นหา </button>
                </div>
            </div>

            <p class="logadmin  text-danger box" style="font-size:16px;">ประวัติการเข้าสู่ระบบของ Admin</p>
            <p class="logeidttel text-danger box" style="font-size:16px;">ประวัติการแก้ไขยูสเซอร์ของสมาชิก</p>
            <p class="logeditusername text-danger box" style="font-size:16px;">ประวัติการแก้ไขชื่อของสมาชิก</p>
            <p class="logedituserpass text-danger box" style="font-size:16px;">ประวัติการแก้ไขรหัสผ่านของสมาชิก</p>
            <p class="loguserstatus text-danger box" style="font-size:16px;">ประวัติการเปิดปิด Status เข้าระบบของสมาชิก</p>
            <p class="logedituserspin text-danger box" style="font-size:16px;">ประวัติการเพิ่ม ลบ สปิน </p>
            <p class="logpoint box text-danger " style="font-size:16px;"> ประวัติการเพิ่ม ลบ คะแนน </p>
            <p class="logcredit box text-danger " style="font-size:16px;"> ประวัติการเพิ่ม  เครดิต </p>
            <p class="log_d_credit box text-danger " style="font-size:16px;"> ประวัติการ ลบ เครดิต </p>

            <p class="logaddturn box text-danger " style="font-size:16px;"> ประวัติการ เพิ่ม ลบ เทิร์น </p>
            <p class="logbank box text-danger " style="font-size:16px;"> ประวัติการการแก้ไข แบงค์  </p>
            <p class="logbankstatus box text-danger " style="font-size:16px;"> ประวัติการแก้ไข สถานะ แบงค์  </p>
            <p class="logeditgroup box text-danger " style="font-size:16px;"> ประวัติการแก้ไข กลุ่ม แบงค์  </p>
            <p class="logeditusergroup box text-danger " style="font-size:16px;"> ประวัติการแก้ไข กลุ่ม แบงค์ ของสมาชิก </p>
            <p class="logsale box text-danger " style="font-size:16px;"> ประวัติการเข้าสู่ระบบ ของ เซลล์ </p>

            <p class="logusers box text-danger " style="font-size:16px;"> ประวัติการเข้าสู่ระบบ ของ สมาชิก </p>
            <p class="logcheckin box text-danger " style="font-size:16px;"> ประวัติการช็คอิน ของ สมาชิก </p>
            
            <p class="Log_deposit box text-danger " style="font-size:16px;"> ประวัติการทำรายการยอดห้อย </p>
            <p class="Log_ranking box text-danger" style="font-size:16px">ประวัติแก้ไขระดับชั้นยศ </p>
            <p class="Log_imimall box text-danger " style="font-size:16px;"> ประวัติการยกเลิกสินค้า  </p>
            <p class="logowner box text-danger " style="font-size:16px;"> ประวัติการเข้าสู่ระบบ ของ Owner </p>
            <p class="log_imimall box text-danger " style="font-size:16px;">ประวัติการยกเลิกการแลกสินค้า</p>
            <p class="Log_withdraw box text-danger " style="font-size:16px;"> ประวัติการทำรายการถอน </p>
            
            <p class="log_gift_create box text-danger " style="font-size:16px;"> ประวัติการสร้าง Gift </p>
            <p class="Log_gift_status box text-danger " style="font-size:16px;"> ประวัติการเปิด ปิด Gift </p>
            <p class="Log_gift_voucher box text-danger " style="font-size:16px;"> ประวัติการกดรับ Gift voucher ลูกค้า </p>
            
            <p class="Log_event_create box text-danger" style="font-size:16px;">ประวัติการสร้าง Event </p>

            <p class="Log_promotion_create box text-danger" style="font-size:16px;">ประวัติการสร้าง Promotion </p>
            <p class="Log_promotion box text-danger" style="font-size:16px;">ประวัติการรับ Promotion ของลูกค้า</p>
            <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="emp_table" class="table table-striped table-bordered dt-responsive nowrap"
                                    cellspacing="0" width="100%" style="font-size: 14px;">
                                    <thead style="background-color: #2a3f54;color: #fff;">
                                        <tr class="text-center">
                                            <!-- log admin -->
                                            <th class="logadmin  box"> No </th>
                                            <th class="logadmin  box"> รหัส</th>
                                            <th class="logadmin box"> รหัสแอดมิน์</th>
                                            <th class="logadmin box"> ชื่อ </th>
                                            <th class="logadmin box"> เวลาล็อกอิน</th>
                                            <th class="logadmin   box"> เวลาล็อกเอ้า</th>
                                            <th class="logadmin  box"> ไอพี</th>
                                            <!-- end admin -->


                                             <!--  Log_withdraw -->
                                            <th class="Log_withdraw  box"> No </th>
                                            <th class="Log_withdraw  box"> รหัส</th>
                                            <th class="Log_withdraw box"> รหัสแอดมิน์</th>
                                            <th class="Log_withdraw  box"> รหัสยูสเซอร์</th>
                                            <th class="Log_withdraw   box"> ประเภท</th>
                                            <th class="Log_withdraw box"> เครดิต</th>
                                            <th class="Log_withdraw box"> แบงค์</th>
                                            <th class="Log_withdraw  box"> วัน-เวลา</th>
                                            <!-- end admin -->



                                            <!-- log sale -->
                                            <th class="logsale  box"> No </th>
                                            <th class="logsale   box"> รหัส</th>
                                            <th class="logsale box"> รหัสเซลล์ </th>
                                            <th class="logsale box"> ชื่อเซลล์</th>
                                            <th class="logsale box"> ประเภท </th>
                                            <th class=" logsale box"> รายละเอียด</th>
                                            <th class="logsale box "> วันที่และเวลา</th>

                                            <!-- end sale  -->

                                            <!-- log users -->
                                            <th class="logusers  box"> No </th>
                                            <th class="logusers  box"> รหัส</th>
                                            <th class="logusers  box"> รหัสยูสเซอร์</th>
                                            <th class="logusers box"> เวลาล็อกอิน</th>
                                            <th class="logusers box"> รายละเอียด</th>
                                            <th class="logusers  box"> ไอพี</th>
                                            <!-- end loguser -->

                                            <!-- log addturn -->
                                            <th class="logaddturn  box"> No </th>
                                            <th class="logaddturn  box" width="4px"> รหัส</th>
                                            <th class="logaddturn  box"> รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="logaddturn  box"> รหัสยูสเซอร์</th>
                                            <th class="logaddturn box "> ประเภท </th>
                                            <th class="logaddturn box "> ราละเอียด </th>
                                            <th class="logaddturn  box "> วันที่และเวลา</th>
                                            <!-- end addturn  -->

                                            <!-- log point  -->
                                            <th class="logpoint  box"> No </th>
                                            <th class="logpoint  box"> รหัส</th>
                                            <th class="logpoint  box"> รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="logpoint box"> รหัสยูสเซอร์</th>
                                            <th class="logpoint box"> ประเภท </th>
                                            <th class="logpoint box"> รายละเอียด</th>
                                            <th class="logpoint   box"> วันที่และเวลา</th>
                                            <!-- end  -->

                                            <!-- log credit logedituser spin- checkin -->
                                            <th class="logcredit  logedituserspin logcheckin  box"> No </th>
                                            <th class="logcredit  logedituserspin logcheckin  box"> รหัส</th>
                                            <th class="logcredit  logedituserspin box"> รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="logcredit logedituserspin  logcheckin box"> รหัสยูสเซอร์</th>
                                            <th class="logcredit logedituserspin box"> ประเภท </th>
                                            <th class=" logedituserspin logcheckin box"> รายละเอียด</th>
                                            <th class=" logcredit  box"> ก่อนเพิ่ม</th>
                                            <th class=" logcredit  box"> หลังทำรายการ</th>
                                            <th class=" logcredit  box"> รวม</th>
                                            <th class=" logcredit  box"> รายละเอียด</th>

                                            <th class="logcredit   logedituserspin logcheckin box"> วันที่และเวลา</th>
                                            <!-- end  -->


                                            <!-- log delete log_d_credit -->
                                            <th class="log_d_credit  box"> No </th>
                                            <th class="log_d_credit  box"> รหัส</th>
                                            <th class="log_d_credit box"> รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="log_d_credit   box"> รหัสยูสเซอร์</th>
                                            <th class="log_d_credit box"> ประเภท </th>
                                            <th class=" log_d_credit  box"> ก่อนเพิ่ม</th>
                                            <th class=" log_d_credit  box"> หลังทำรายการ</th>
                                            <th class=" log_d_credit  box"> รวม</th>
                                            <th class=" log_d_credit  box"> รายละเอียด</th>
                                            <th class="log_d_credit   logedituserspin  box"> วันที่และเวลา</th>


                                            <!-- log bank -->
                                            <th class="logbank   box"> No </th>
                                            <th class="logbank  box"> รหัส</th>
                                            <th class="logbank  box"> แบงค์</th>
                                            <th class="logbank  box"> รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="logbank  box"> เลขบัญชี</th>
                                            <th class="logbank box"> รายละเอียด</th>
                                            <th class="logbank   box"> วันที่และเวลา</th>
                                            <!-- end log -->

                                            <!-- logeditgroup  logbankstatus-->
                                            <th class="logeditgroup  logbankstatus box"> No </th>
                                            <th class="logeditgroup  logbankstatus box"> รหัส</th>
                                            <th class="logeditgroup  logbankstatus box"> รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="logeditgroup  logbankstatus box"> ชื่อบัญชี</th>
                                            <th class="logeditgroup logbankstatus box"> รายละเอียด</th>
                                            <th class="logeditgroup   logbankstatus box"> วันที่และเวลา</th>
                                            <!-- end log -->

                                            <!-- logeditusergroup -->
                                            <th class="logeditusergroup  box"> No </th>
                                            <th class="logeditusergroup  box"> รหัส</th>
                                            <th class="logeditusergroup  box"> รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="logeditusergroup  box"> รหัสยูสเซอร์</th>
                                            <th class="logeditusergroup box"> รายละเอียด</th>
                                            <th class="logeditusergroup   box"> วันที่และเวลา</th>
                                            <!-- logeditusergroup -->

                                            <!-- logeditusername  logedituserpass  logeidttelloguserstatus  logeidttel-->
                                            <th class="logeditusername  logedituserpass  logeidttel loguserstatus  box">
                                                No </th>
                                            <th class="logeditusername  logedituserpass  logeidttel loguserstatus box">
                                                รหัส</th>
                                            <th class="logeditusername  logedituserpass logeidttel loguserstatus box">
                                                รหัสยูสเซอร์แอดมิน์</th>
                                            <th class="logeditusername  logedituserpass logeidttel loguserstatus box">
                                                รหัสยูสเซอร์</th>
                                            <th class="logeditusername logedituserpass  logeidttel loguserstatus box">
                                                รายละเอียด</th>
                                            <th class="logeditusername  logedituserpass  logeidttel loguserstatus box">
                                                วันที่และเวลา</th>



                                              <!-- logowner -->
                                            <th class="logowner box">
                                                No </th>
                                            <th class="logowner box">
                                                รหัส</th>
                                            <th class="logowner box">
                                                รหัสยูสเซอรโอนเนอร์</th>
                                            <th class="logowner box">
                                                ip</th>
                                                <th class="logowner box">
                                                รายละเอียด</th>
                                            <th class="logowner box">
                                                วันที่และเวลา</th>  




                                            <!-- Log_deposit -->
                                            <th class="Log_deposit box">
                                                No </th>
                                            <th class="Log_deposit box">
                                                รหัส</th>
                                            <th class="Log_deposit box">
                                                รหัสยูสเซอร์แอดมิน์</th>
                                                <th class="Log_deposit box">
                                                รหัสยูสเซอร์</th>
                                            <th class="Log_deposit box">
                                                รายละเอียด</th>
                                            <th class="Log_deposit box">
                                                วันที่และเวลา</th>  

                                            <!-- Log_ranking -->
                                            <th class="Log_ranking box">
                                                No </th>
                                            <th class="Log_ranking box">
                                                รหัส</th>
                                            <th class="Log_ranking box">
                                                รหัสยูสเซอร์แอดมิน์</th>
                                              
                                            <th class="Log_ranking box">
                                                รายละเอียดก่อน</th>
                                                <th class="Log_ranking box">
                                                รายละเอียดใหม่</th>
                                            <th class="Log_ranking box">
                                                วันที่และเวลา</th> 


                                            <!-- Log_imimall -->
                                            <th class="log_imimall box">
                                                No </th>
                                            <th class="log_imimall box">
                                                รหัส</th>
                                            <th class="log_imimall box">
                                                รหัสยูสเซอร์แอดมิน์</th>
                                                <th class="log_imimall box">
                                                รหัสยูสเซอร์</th>
                                                <th class="log_imimall box">
                                                รายละเอียด</th>
                                            <th class="log_imimall box">
                                                วันที่และเวลา</th> 

                                                <!-- Log_gift_status log_gift_create -->

                                                <th class="Log_gift_status  log_gift_create box">
                                                No </th>
                                            <th class="Log_gift_status log_gift_create  box">
                                                รหัส</th>
                                            <th class="Log_gift_status log_gift_create box">
                                                รหัสยูสเซอร์แอดมิน์</th>
                                                <th class="Log_gift_status  log_gift_create box">
                                                ชื่อ Gift</th>
                                                <th class="Log_gift_status box">
                                                รายละเอียด</th>
                                            <th class="Log_gift_status log_gift_create box">
                                                วันที่และเวลา</th> 


                                                <!-- Log_gift_voucher   -->
                                                <th class="Log_gift_voucher box">
                                                No </th>
                                            <th class="Log_gift_voucher  box">
                                                รหัส</th>
                                            <th class="Log_gift_voucher box">
                                                รหัสยูสเซอร์</th>
                                                <th class="Log_gift_voucher box">
                                                ชื่อ Gift</th>
                                                <th class="Log_gift_voucher box">
                                                เวลาที่แอดมิน์แจก</th>
                                                <th class="Log_gift_voucher box">
                                                รหัสยูสเซอร์แอดมิน์</th>
                                                <th class="Log_gift_voucher box">
                                                รายละเอียด</th>
                                            <th class="Log_gift_voucher box">
                                                วันที่และเวลาที่ลูกค้ากดรับ</th> 


                                                <!-- Log_promotion_create -->

                                                <th class="Log_promotion_create  box">
                                                No </th>
                                            <th class="Log_promotion_create  box">
                                                รหัส</th>
                                            <th class="Log_promotion_create  box">
                                                รหัสยูสเซอร์แอดมิน์</th>
                                                <th class="Log_promotion_create   box">
                                                ชื่อ Promotion</th>
                                            <th class="Log_promotion_create box">
                                                วันที่และเวลา</th> 

                                            <!-- Log_promotion -->
                                            <th class="Log_promotion  box">
                                                No </th>
                                            <th class="Log_promotion  box">
                                                รหัส</th>
                                           
                                            <th class="Log_promotion  box">
                                                รหัสยูสเซอร์</th>
                                                <th class="Log_promotion   box">
                                                 Promotion</th>

                                            <th class="Log_promotion  box">
                                                รายละเอียด</th>
                                              
                                            <th class="Log_promotion box">
                                                วันที่และเวลา</th> 

                                         

                                            <!-- Log_event_create -->
                                            <th class="Log_event_create  box">
                                                No </th>
                                            <th class="Log_event_create  box">
                                                รหัส</th>
                                           
                                            <th class="Log_event_create  box">
                                            รหัสยูสเซอร์แอดมิน์</th>
                                                <th class="Log_event_create   box">
                                                 ชื่อ Event</th>

                                            <th class="Log_event_create box">
                                                วันที่และเวลา</th> 



                                        </tr>
                                    </thead>
                                    <!-- ADMIN -->
                                    <tbody id="bodyhistory"></tbody>


                                </table>

                            </div>
                            <div class="row" id="list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
// function เลือกประเภท log ให้ hid ในส่วนของ column table
$(document).ready(function() {

    $("select").change(function() {
        $(this).find("option:selected").each(function() {
            var optionValue = $(this).attr("value");
            console.log(optionValue);
            if (optionValue) {
                $('#bodyhistory').html('');


                $(".box").not("." + optionValue).hide();
                $(".hid").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else {
                $('#bodyhistory').html('');

                $(".box").hide();
            }
        });
    }).change();
});
// function เลือกเมนู
function select_period() {

    let day_s = $('#single_cal2').val();
    let day_e = $('#single_cal3').val();
    let choi = $('#slectop').val();


    if (choi != "") {
        if (choi == "logadmin") {
            title = 'ประวัติการเข้าสู่ระบบของ Admin';
            admin(day_s, day_e);
        }
        if (choi == "logsale") {
            sale(day_s, day_e);
        }
        if (choi == "logusers") {
            user(day_s, day_e);
        }
        if (choi == "logaddturn") {
            addturn(day_s, day_e);
        }

        if (choi == "logpoint") {
            point(day_s, day_e);
        }
        if (choi == "logcredit") {
            credit(day_s, day_e);
        }
        if(choi == "log_d_credit"){
            log_d_credit(day_s,day_e);
        }
        if (choi == 'logbank') {
            logbank(day_s, day_e);
        }
        if (choi == 'logeditgroup') {
            logeditgroup(day_s, day_e);
        }

        if (choi == 'logeditusergroup') {
            logeditusergroup(day_s, day_e);
        }
        if (choi == 'logeditusername') {
            logeditusername(day_s, day_e);
        }
        if (choi == 'logedituserpass') {
            logedituserpass(day_s, day_e);
        }
        if (choi == 'logedituserspin') {
            logedituserspin(day_s, day_e);
        }
        if (choi == 'loguserstatus') {
            loguserstatus(day_s, day_e);
        }
        if (choi == 'logeidttel') {
            logeidttel(day_s, day_e);
        }
        if (choi == 'logbankstatus') {
            logbankstatus(day_s, day_e);
        }
        if (choi == 'logcheckin') {
            logcheckin(day_s, day_e);
        }
        if(choi == 'logowner'){
            logowner(day_s,day_e);
        }
        if(choi == 'Log_deposit'){
            Log_deposit(day_s,day_e);

        }

        if(choi =='Log_ranking'){
            Log_ranking(day_s,day_e);
        }

        if(choi == 'log_imimall'){
            log_imimall(day_s,day_e);
        }

        if(choi == 'Log_withdraw'){
            Log_withdraw(day_s,day_e);
        }

        if(choi == 'Log_gift_status'){
            Log_gift_status(day_s,day_e);
        }
        if(choi == 'log_gift_create'){
            log_gift_create(day_s,day_e);
        }
        if(choi=='Log_gift_voucher'){
            Log_gift_voucher(day_s,day_e);
        }

        if(choi == 'Log_promotion_create'){
            Log_promotion_create(day_s,day_e);
        }
        if(choi == 'Log_promotion'){
            Log_promotion(day_s,day_e);
        }
        if(choi =='Log_event_create'){
            Log_event_create(day_s,day_e);
        }
    } else {
        alert('กรุณาเลือกรายการ ');
    }
}
//  function แสดง log login admin
function admin(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');
    $.ajax({
            url: 'search_admin',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['admin_id'] + '</td>'; //id
                        content += '<td>' + wd[i]['name'] + '</td>'; //id
                        content += '<td>' + wd[i]['time_login'] + '</td>'; //id
                        content += '<td>' + wd[i]['time_logout'] + '</td>'; //id

                        content += '<td>' + wd[i]['ip_login'] + '</td>'; //id
                        content += "</tr>";
                    }

                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}
// แสดง log ของ sale
function sale(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');
    $.ajax({
            url: 'search_sale',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['sale_id'] + '</td>'; //id
                        content += '<td>' + wd[i]['sale_name'] + '</td>'; //id
                        content += '<td>' + wd[i]['type'] + '</td>'; //id
                        content += '<td>' + wd[i]['detail'] + '</td>'; //id
                        content += '<td>' + wd[i]['datetime'] + '</td>'; //id
                        content += "</tr>";
                    }

                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}


// แสดง log ของ user
function user(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_user',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['user_id'] + '</td>'; //id
                        content += '<td>' + wd[i]['createtime'] + '</td>'; //id
                        content += '<td>';
                        if (wd[i]['platform'] == '1') {
                            content += 'IPONE จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                        } else if (wd[i]['platform'] == '2') {
                            content += 'Ipad จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                        } else if (wd[i]['platform'] == '3') {
                            content += 'WebOs จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                        } else if (wd[i]['platform'] == '4') {
                            content += 'Android จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                        } else if (wd[i]['platform'] == '5') {
                            content += 'PC จำนวนการเข้าใช้งาน: (' + wd[i]['countPlatform'] + '):ครั้ง </td>';
                        } else {
                            content += "-</td>";
                        }
                        content += '<td>' + wd[i]['ip'] + '</td>'; //id
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// แสดง Log การเพิ่มเทิร์น
function addturn(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_addtrun',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['admin'] + '</td>'; //id
                        content += '<td>' + wd[i]['user_id'] + '</td>'; //user admin
                        content += '<td>' + wd[i]['action'] + '</td>'; //id
                        content += '<td>' + wd[i]['detail'] + '</td>'; //id
                        content += '<td>' + wd[i]['tim'] + '</td>'; //id

                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// แสดง Log Point
function point(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_point',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['admin'] + '</td>'; //id
                        content += '<td>' + wd[i]['user_id'] + '</td>'; //id

                        if (wd[i]['action'] == "up") {
                            content += '<td> เพิ่ม Point </td>'; //id
                        } else {
                            content += '<td> ลด Point </td>'; //id
                        }


                        content += '<td>  ' + wd[i]['detail'] + '</td>'; //id
                        content += '<td>' + wd[i]['time'] + '</td>'; //id
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// แสดง Log credit
function credit(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_credit',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['admin'] + '</td>'; //id
                        content += '<td>' + wd[i]['user_id'] + '</td>'; //id

                        if (wd[i]['action'] == "up") {
                            content += '<td> เพิ่ม  </td>'; //id
                        } else {
                            content += '<td> ลบ  </td>'; //id
                        }

                        content += '<td>  ' + wd[i]['old'] + '</td>'; //id
                        content += '<td>  ' + wd[i]['new'] + '</td>'; //id
                        content += '<td>  ' + wd[i]['rs'] + '</td>'; //id
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['time'] + '</td>'; //id
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// log_d_credit

function log_d_credit(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_delete_credit',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>'; //id
                        content += '<td>' + wd[i]['admin'] + '</td>'; //id
                        content += '<td>' + wd[i]['user_id'] + '</td>'; //id

                        if (wd[i]['action'] == "up") {
                            content += '<td> เพิ่ม  </td>'; //id
                        } else {
                            content += '<td> ลบ  </td>'; //id
                        }

                        content += '<td>  ' + wd[i]['old'] + '</td>'; //id
                        content += '<td>  ' + wd[i]['new'] + '</td>'; //id
                        content += '<td>  ' + wd[i]['rs'] + '</td>'; //id
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['time'] + '</td>'; //id
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}


// logbank
function logbank(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_logbank',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['bank_short'] + '</td>';
                        content += '<td>' + wd[i]['username'] + '</td>';
                        content += '<td>' + wd[i]['account'] + '</td>';
                        content += '<td>' + wd[i]['action'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// logeditgroup
function logeditgroup(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_logeditgroup',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['account'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// logedit user group
function logeditusergroup(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_logeditusergroup',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}
// logeditusername
function logeditusername(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_logeditusername',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// log edit pass
function logedituserpass(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_edit_user_pass',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// logedit user spin
function logedituserspin(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_edit_user_spin',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['action'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// log edit status
function loguserstatus(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_edit_user_status',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// logeidttel
function logeidttel(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_edit_user_tel',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// logbankstatus
function logbankstatus(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_bank_status',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['account'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// logbank checkin 
function logcheckin(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_logcheckin',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['user'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// logowner
function logowner(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_logowner',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['owner_id'] + '</td>';
                        content += '<td>' + wd[i]['ip'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}


// Log_deposit
function Log_deposit(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_Log_deposit',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// Log_ranking
function Log_ranking(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_ranking',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['old_detail'] + '</td>';
                        content += '<td>' + wd[i]['new_detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// log imimal
function log_imimall(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_imimall',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// Log_withdraw
function Log_withdraw(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_withdraw',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['user_id'] + '</td>';
                        content += '<td>' + wd[i]['action'] + '</td>';
                        content += '<td>' + wd[i]['credit'] + '</td>';
                        content += '<td>' + wd[i]['bank'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// Log_gift_status

function Log_gift_status(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_Log_gift_status',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['gift_name'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// log_gift_create
function log_gift_create(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_gift_create',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['gift_name'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// Log_promotion_create

function Log_promotion_create(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_Log_promotion_create',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['promotion_name'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// Log_promotion
function Log_promotion(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_promotion',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                       
                        content += '<td>' + wd[i]['user'] + '</td>';
                        content += '<td>' + wd[i]['name'] + '</td>';
                        content += '<td>' + wd[i]['detail'] + '</td>';
                        content += '<td>' + wd[i]['tim'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

// Log_gift_voucher
function Log_gift_voucher(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_log_gift_voucher',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['user'] + '</td>';
                        content += '<td>' + wd[i]['gift_name'] + '</td>';
                        content += '<td>' + wd[i]['time_give'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['receive'] + '</td>';
                        content += '<td>' + wd[i]['time_receive'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}


// Log_event_create
function Log_event_create(days, daye) {
    $('#cover-spin').show();
    let day_s = days;
    let day_e = daye;
    $('#bodyhistory').html('');

    $.ajax({
            url: 'search_Log_event_create',
            type: 'POST',
            dataType: 'json',
            data: {
                dt1: day_s,
                dt2: day_e
            },
        })
        .done(function(res) {
            if (res.code == 1) {
                $('#gethistory').modal();
                if (res.data.length >= 1) {
                    var conut = res.data.length;
                    var wd = res.data;
                    var content = '';
                    for (var i = 0; i < conut; i++) {
                        content += '<tr class="text-center">';
                        content += '<td>' + i + '</td>'; //no
                        content += '<td>' + wd[i]['id'] + '</td>';
                        content += '<td>' + wd[i]['admin'] + '</td>';
                        content += '<td>' + wd[i]['event_name'] + '</td>';
                        content += '<td>' + wd[i]['time'] + '</td>';
                        content += "</tr>";
                    }
                } else {
                    var content = 'No data';
                }
            } else {
                swal(res.title, res.msg, 'error');
            }
            $('#bodyhistory').html(content);
            $('#cover-spin').hide();
        })
        .fail(function() {
            console.log("error");
        });
}

</script>
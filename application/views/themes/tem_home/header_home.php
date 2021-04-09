


<style>


.login-box {
  position: absolute;
  top: 45%;
  left: 50%;
  width: 370px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}


.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top:0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: .5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #03e9f4;
  font-size: 12px;
}

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #03e9f4;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  margin-top: 40px;
  letter-spacing: 4px
}

.login-box a:hover {
  background: #03e9f4;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #03e9f4,
              0 0 25px #03e9f4,
              0 0 50px #03e9f4,
              0 0 100px #03e9f4;
}

.login-box a span {
  position: absolute;
  display: block;
}

.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #03e9f4);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

.login-box a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #03e9f4);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #03e9f4);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.login-box a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 50%;
  background: linear-gradient(360deg, transparent, #03e9f4);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
}

</style>

    
  
  









      

















<div id="mySidebar" class="sidebar" style="z-index:999">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="https://betclic88.com/web/index">หน้าแรก</a>
    <a href="https://betclic88.com/web/deposit">ฝาก</a>
    <a href="https://betclic88.com/web/withdraw">ถอน</a>
    <a href="https://betclic88.com/web/profile">โปรไฟล์</a>
    <a href="https://betclic88.com/web/turnover">เทิร์นโอเวอร์</a>
    <a href="https://betclic88.com/web/usermanual">คู่มือการใช้งาน</a>
    <a href="https://betclic88.com/web/contact">ติดต่อเรา</a>
    <a onclick="logout()" href="#" title="ออกจากระบบ">ออกจากระบบ</a>
</div>

<div id="main" class="visible-xs" style="position: fixed; z-index:99; background-color: rgba(255,255,255,0.00); width:100%;">

    <div style="width:22%; display:inline-table;">
    <img src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/61-512.png" style="width: 25px;" onclick="openNav()"></div><div style="width:58%; display:inline-table;"> <img src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/LOGO-IMI55.png" style="width:200px; padding:10px 0px; "> 
    </div><div style="width:20%; display:inline-table;"><img src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/icon-free-fa-user-circle-o.png" style="width: 25px;margin-left:  70%;" onclick="openNav()"></div>

</div>





        <div class="container hidden-xs" align="center" style="width:100%;z-index:99; background:#0f0f0f;">
    
         <div style="width:33%; display:inline-table;">
            <img align="left" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/61-512.png" style="width: 25px;" onclick="openNav()">
        </div>
        <div align="center" style="width:33%; display:inline-table;">
            <img align="center"  src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/LOGO-IMI55.png" style="width:180px;"> 
        </div>
        <div style="width:33%; display:inline-table;">
            <img align="right" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/icon-free-fa-user-circle-o.png" style="width: 25px;padding-top: 15px;" onclick="openNav()">
        </div>

        </div>


<!-- 
<div class="container" >
    <div id="main" class="hidden-xs" style="position: fixed; z-index:99; background:#0f0f0f; width:55%;">

        <div style="width:33%; display:inline-table;">
            <img src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/61-512.png" style="width: 25px;" onclick="openNav()">
        </div>
        <div align="center" style="width:33%; display:inline-table;">
            <img   src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/LOGO-IMI55.png" style="width:180px;"> 
        </div>
        <div style="width:33%; display:inline-table;">
            <img align="right" src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/icon-free-fa-user-circle-o.png" style="width: 25px;padding-top: 15px;" onclick="openNav()">
        </div>
    </div>
</div>
 -->






<script>
  function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  /*document.getElementById("main").style.marginLeft = "250px";*/
  }
  function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
        }
</script>




        <div class="visible-xs col-md-12" style="background-color:rgb(15, 15, 15); padding:5px 0; height:85px;  position: fixed; bottom:0px; width:100%;padding-bottom: 3%; ">
            <div align="center">
               <div style="width:20%; display:inline-table;"><a href="products"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>g.png" style="width: 70%;"></a><br><b style="color: #f5d301;font-size: 0.9em">เกมส์ทั้งหมด</b></div><div style="width:20%;display:inline-table;">

                <a href="#"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>p.png" style="width: 70%;"></a><br><b style="color: #f5d301;font-size: 0.9em">โปรโมชั่น</b></div><div style="width:19%; display:inline-table;">

                <a href="index"><img src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/newhome.png" style="width: 100%;margin-top: -50%"></a></div><div style="width:20%;display:inline-table;">

                <a href="#"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>qq.png" style="width: 70%;"><br><b style="color: #f5d301;font-size: 0.9em">ประกาศ</b></a></div><div style="width:20%;display:inline-table;">

                <a href="#"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>c.png" style="width: 70%;"></a><br><b style="color: #f5d301;font-size: 0.9em">ติดต่อ</b></div>
              
            </div>
        </div>

        <div style="padding-top: 50%;">
            
        </div>
        <div class="container hidden-xs" align="center" style="width:100%;z-index:99; background:#0f0f0f;">
    
         <div align="center">
                   <div style="width:20%; display:inline-table;"><a href="products"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>g.png" style="width: 50%;"></a><br><b style="color: #f5d301;font-size: 0.9em">เกมส์ทั้งหมด</b></div><div style="width:20%;display:inline-table;">

                <a href="#"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>p.png" style="width: 50%;"></a><br><b style="color: #f5d301;font-size: 0.9em">โปรโมชั่น</b></div><div style="width:19%; display:inline-table;">

                <a href="https://betclic88.com/web/index"><img src="<?php  echo $this->config->item('tem_frontend_mobile'); ?>images/newhome.png" style="width: 100%;margin-top: -50%"></a></div><div style="width:20%;display:inline-table;">

                <a href="#"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>qq.png" style="width: 50%;"><br><b style="color: #f5d301;font-size: 0.9em">ประกาศ</b></a></div><div style="width:20%;display:inline-table;">

                <a href="#"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>c.png" style="width: 50%;"></a><br><b style="color: #f5d301;font-size: 0.9em">ติดต่อ</b></div>
                  
                </div>

        </div>





 
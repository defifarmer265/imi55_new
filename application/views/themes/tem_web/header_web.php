
<link href="<?php  echo $this->config->item('tem_frontend_css'); ?>home.css" rel="stylesheet">
<!--     <link href="<?php  echo $this->config->item('tem_frontend_css'); ?>home1.css" rel="stylesheet"> -->


<div class="floating-banner-container">
        <div class="floating-banner floating-banner--left floating-banner--lang-th close" data-device-platform="desktop" data-device-os="" style="opacity: 1; left: -290px;">
            <div class="floating-banner--items close">
                <ul class="banner-list" style="padding-bottom: 10%;">
                   <!--  <li class="banner-list--items">https://dl.myaaap.com/imiwin.apk
                        
                    </li>
                    <li class="banner-list--items">https://dl.myaaap.com/ios/imiwin/
                        
                    </li> -->
                    <a href="<?php echo base_url()?>web/APP_IOS" target="_blank" class="banner-list--content "align="center">
                            <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn-download-ios.gif" >
                        </a>
                    <a href="<?php echo base_url()?>web/APP_Aandroid" target="_blank" class="banner-list--content " align="center">
                            <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>btn-download-android.gif" >   
                        </a>
                </ul>
            </div>

            <div class="floating-banner--title-wrapper floating-banner--align__down">
                <div class="floating-banner--icon">
                    <img alt="ดาวน์โหลด" class="lazy-load lazy-loaded" src="https://www.dafabc.net/th/2018-09/Floating_Banner_left_bg.png">
                </div>
                <span class="floating-banner--title close">ดาวน์โหลด</span>
            </div>
        </div>

   
    <div class="floating-banner floating-banner--right floating-banner--lang-th close" data-device-platform="desktop" data-device-os="" style="opacity: 1; right: -290px;margin-top: -140px;">
        <div class="floating-banner--title-wrapper floating-banner--align__up">
            <div class="floating-banner--icon">
                <img alt="ติดต่อเรา" class="lazy-load lazy-loaded" src="https://www.dafabc.net/th/2018-10/Floating_Banner_right_bg_0.png">
            </div>
            <span class="floating-banner--title close">ติดต่อเรา</span>
        </div>
        <div class="floating-banner--items close">
            <ul class="banner-list">
                

                 <div align="center">
                  <img src="<?php  echo $this->config->item('tem_frontend_img'); ?>24-7.png">
                  <a href="line://ti/p/@imi55"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>qr1.png"></a>
                  <a href="<?php echo base_url()?>users/home"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>qr3.png"></a>
                  <a href="https://www.youtube.com/playlist?list=PL85MNTzD1YzZhsHrUjhSPMegA3p5M0bKS"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>qr4.png"></a>
                  <a href="https://www.facebook.com/IMI55official"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>qr5.png"></a>
                </div>
            </ul>
        </div>
    </div>

</div>


<header class="header">
    <div class="container clearfix">
        <h1 class="logo th"><a href="<?php echo base_url()?>web" hreflang="th" rel="เว็บไซต์พนันกีฬาโดย IMI55" title="เว็บไซต์พนันกีฬาโดย IMI55"><img class="lazy-load lazy-loaded" src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="เว็บไซต์พนันกีฬาโดย IMI55"></a></h1>
        <div class="pull-right header-right">


<style>

.head_r {
    width: 100%;
    padding: 0;
    background-color: #000;
    margin-top: 10px;
    border-radius: 10px;
    border: 2px solid #ffad00;
}
.tt_r {
    float: right;
}
.head_r {
    width: 100%;
    padding: 0;
    background-color: #000;
    margin-top: 10px;
    border-radius: 10px;
    border: 2px solid #ffad00;}


     input {
    display: block;
    
    height: 35px;
    border: 1px solid #ddd;
    border-radius: 2px;
    color: #ccc;
}
/* =============================================
* RADIO BUTTONS
=============================================== */


input[type="radio"] {
  opacity: 0; /* hidden but still tabable */
  position: absolute;
}

input[type="radio"] + span {
  color: #B3CEFB;
  border-radius: 20%;
  padding: 11px;
  transition: all 0.4s;
  -webkit-transition: all 0.4s;
}

input[type="radio"]:checked + span {
  color: #D9E7FD;
  background-color: #d0a70a;
}

input[type="radio"]:focus + span {
  color: #fff;
}

/* ================ TOOLTIPS ================= */

#radios label:hover::before {
  content: attr(for);
  text-transform: capitalize;
  font-size: 11px;
  position: absolute;
 /* top: 100%;*/
  left: 0;
  right: 0;
  opacity: 0.75;
  background-color: #323232;
  color: #fff;  
  padding: 4px;
  border-radius: 3px;
  display: block;
}








.tt_btn_close:before {
    content: "✖"
}

.tt_btn_open:before {
    content: "✚"
}




.tt_btn_open,
.tt_btn_close {
    float: right;
    width: 25px;
    height: 25px;
    background-color: #a5701e;
    margin: 0 0 10px;
    color: #fff;
    text-align: center;
    cursor: pointer
}

.tt_btn_close .fa,
.tt_btn_open .fa {
    font-size: 18px;
    line-height: 22px
}

#topbar.tt_open .tt_img_fixed,
.tt_open .tt_btn_close,
.tt_btn_open {
    display: none;
}


.tt_btn_openline{
  
    width: 30px;
    height: 30px;
    background-color: #a5701e;
    margin: 120px 50px 50px 50%;
    color: #fff;
    text-align: center;
    cursor: pointer;

}
.tt_btn_closeline {
  
    width: 30px;
    height: 30px;
    background-color: #a5701e;
    margin: 0px 5px 5px 50%;
    color: #fff;
    text-align: center;
    cursor: pointer;

}

.tt_btn_closeline .fa,
.tt_btn_openline .fa {
    font-size: 18px;
    line-height: 22px
}

#topbarline.tt_openline .tt_img_fixedline,
.tt_openline .tt_btn_closeline,
.tt_btn_openline {
    display: none
}



.tt_open .tt_btn_open {
    display: block
}
.tt_openline .tt_btn_openline {
    display: block
}

#topbar {
    position: fixed;
    top: 20px;
    width: 230px;
    z-index: 9999;
    right: 10px;
    top: 10px;
    padding: 10px 0 0;
    -webkit-transition: all .5s ease-in-out 0s;
    -o-transition: all .5s ease-in-out 0s;
    -moz-transition: all .5s ease-in-out 0s;
    transition: all .5s ease-in-out 0s
}

#topbarline {
    position: fixed;
    top: 20px;
    width: 100%;
    z-index: 9999;
   
    top: 10px;
    padding: 10px 0 0;
    -webkit-transition: all .5s ease-in-out 0s;
    -o-transition: all .5s ease-in-out 0s;
    -moz-transition: all .5s ease-in-out 0s;
    transition: all .5s ease-in-out 0s
}







 h3{
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
    margin: 0;
    padding: 0;
}.tt_tx_line {
    float: left;
    width: 33.33%;
    font-size: 18px;
    color: #fff;
    text-align: left;
    margin: 0;
    padding: 5px 0;
    text-align: center;
    background: linear-gradient(to bottom, #030a19 17%, #17214b 100%);
    border: 1px solid #fede03;
}
</style>



<div id="topbar" class="fxx" style="position: fixed; top: 500px;">
  <div id="close" class="tt_btn_close" onclick="myFunction()">
    <i class="fa fa-times"></i>
  </div>
  <div id="open" class="tt_btn_open" onclick="myFunction()" >
   <i class="fa fa-times"></i>
  </div>

  <a id="myDIV" class="tt_img_fixed" target="_blank" href="line://ti/p/@imi55"><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>qrline.png" alt="line@">
 
  </a>
  
</div>

<script>
function myFunction() {
  var x = document.getElementById('myDIV');
  var open = document.getElementById('open');
  var close = document.getElementById('close');


  if (x.style.display === 'none') {
    x.style.display = 'block';
    close.style.display = 'block';
    open.style.display = 'none';
  } else {
    x.style.display = 'none';
    close.style.display = 'none';
    open.style.display = 'block';
  } 

}

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
    foreach($maintenance as $data){
       
?>

        <div class="tt_r head_r tt_head_menu" style="background: linear-gradient(to bottom, rgb(10, 0, 74) 0%, rgb(10, 0, 74) 46%, rgb(10, 0, 74) 100%);">
            <div class="tt_r tt_from_login">
                <div class="tt_l tt_full head_from" style="padding-top: 30px;">
                    <form class="tt_l tt_from_lg" name="flogin_desk" id="flogin_desk">
                        <div class="tt_l tt_full h_fr">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div align="right">
                                        <div class="tt_r tt_from_login" style="width: 700px;height:25px;">
                                            <div class="tt_l tt_full head_from">
                                                <div class="tt_l tt_from_lg">
                                                    <div style="width:20%; display:inline-table;">
                                                    <div style="margin-top: -30px" >
                                                       <?php if($data['status']=='1'){?>
                                                       <input type="text" class="form-control" id="user" placeholder="Enter User" name="user" style="color: #0d2f88;text-align: center;width: 90%;" disabled>
                                                       <?php }else{?>
                                                        <input type="text" class="form-control" id="user" placeholder="Enter User" name="user" style="color: #0d2f88;text-align: center;width: 90%;">
                                                       <?php }?>
                                                    </div></div><div style="width:20%;   display:inline-table;"><div style="margin-top: -30px" >
                                                    <?php if($data['status']=='1'){?>
                                                    <input style="color: #0d2f88;text-align: center;width: 90%;" type="password" class="form-control" id="pass" placeholder="Enter password" name="pass" disabled>
                                                    <?php }else{?>
                                                        <input style="color: #0d2f88;text-align: center;width: 90%;" type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">

                                                    <?php }?>
                                                    </div></div><div style="width:20%;   display:inline-table;"><div style="margin-top: -30px" ><button type="submit" class="btn btn-primary" style="height: 37px;font-size: 1em;">เข้าสู่ระบบ</button></div></div><div style="width:20%;   display:inline-table;"><div style="margin-top: -30px" >
													<?php // echo base_url().'users/Member'?>
													<a href="<?php echo base_url()?>users/home"><button type="button" class="btn" style="height: 37px;font-size: 1em;background-color: red;color: #000;">สมัครสมาชิก</button></a></div></div><div style="width:20%;   display:inline-table;"> <div style="margin-top: -20px;">   <label for="lang_en" class="material-icons">
          <input type="radio" name="lang" id="lang_en" value="en" />
          <span><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>EN-lang.png"  alt="EN-lang"></span>
        </label>                
        <label for="lang_th" class="material-icons">
          <input type="radio" name="lang" id="lang_th" value="th" / checked>
          <span><img src="<?php  echo $this->config->item('tem_frontend_img'); ?>lang-th.png"  alt="lang-th"></span>
        </label>&nbsp; &nbsp;</div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }?>

<!--         <button type="button" class="btn btn-primary" id="btn_login" onClick="login_member()" style="height: 37px;font-size: 1em;">เข้าสู่ระบบ</button> -->


 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#flogin_desk').submit(function(event) {
      /* Act on the event */
      event.preventDefault();
     var data_login =  $('#flogin_desk').serializeArray();
     data_login.push({name: 'type', value: 'desktop'});
      login(data_login,'desktop');
    });
    $('#flogin_mo').submit(function(event) {
        /* Act on the event */
         event.preventDefault();
        var data_login =  $('#flogin_mo').serializeArray();
         data_login.push({ name: 'type', value: 'mobile' });
        login(data_login,'mobile')
    });
  });

  function login(data_login,type){
      $.ajax({
       url: 'web/check_login_imi',
       type: 'POST',
       dataType: 'json',
       data: data_login,
     })
     .done(function(res) {
       //console.log(res);
       if (res.code == 1) {
        swal({
            title: "",
            text: "เข้าสู่ระบบสำเร็จ",
            icon: "success",
        });
        setTimeout(function(){ window.location.href = res.data.RedirectUrl;}, 2000);
       }else if (res.code == 3) {
        swal({
            title: "",
            text: "เข้าสู่ระบบสำเร็จ",
            icon: "success",
        });
        setTimeout(function(){ window.location.href = "<?=base_url()?>users/member";}, 2000);
        
       }else{
          const txt = document.createElement('div');
        txt.innerHTML  = "<b style='color:#000'>ไม่สามารถเข้าสู่ระบบได้</b><br><b style='color:#000'>กรุณาตรวจสอบ username และ password ให้ถูกต้อง!</b>";
        swal({
            content: txt,
            icon: "error",
        });
        if (type == 'desktop') {
          $('#pass').val('');  
      }else if(type == 'mobile'){
        $('#pass_mo').val('');
      }
       }
     })
     .fail(function() {
       console.log("error");
     });
  }



    function login_member()
    {

        var username = $('#user').val();
        var password = $('#pass').val();
        if(username == '' || password == ''){
            alert('กรุณากรอกข้อมูลให้ครบถ้วน');
            $('#username').focus();
        }else{
            $.ajax({
               url: '<?php echo base_url()?>users/home/login',
               type: 'POST',
               dataType: 'json',
               data: {username:username,password:password},
             })
            .done(function(res) {
                // success
                if (res.code == 1) {
                     swal(res.titel, res.msg, "success")
                    .then(function(sw){
                        $('#cover-spin').show();
                        setTimeout(function(){
                            $('#cover-spin').hide();
                            window.location.href = "member";
                        },2000);
                    }); 
                }else if(res.code == 2) {//Password fail
                    swal(res.titel, res.msg, "error")
                    .then(function(sw){
                        $('#password').val('');
                        $('#password').focus();
                    });
                }else{
                    swal(res.titel, res.msg, "error")
                    .then(function(sw){
                        location.reload();
                    });
                }
            });
        }
        
    }
</script>


            </div> 
            <div id="loginFormLightBox" class="modal login-form-lightbox">
                <div class="modal-overlay"></div>
                <div class="modal-content">
                    <div class="login-logo"><img class="lazy-load lazy-loaded" src="<?php  echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="เว็บไซต์พนันกีฬาโดย IMI55"></div>
                    <div class="modal-body"></div>
                    <a href="#" class="modal-close modal-close-button lazy-load lazy-loaded" ></a>
                </div>
            </div>
           <!--  <div class="language-switcher">
                <a href="#" class="th lang-btn" data-current-lang="th" > </a>
                <ul style="height: 0px; overflow: hidden; transition: height 0.2s ease 0s; opacity: 1;">
                    <li class="en  " data-lang="en">
                        <a class="language-link">
                            <div class="language-name">English (Asia)</div>
                        </a>
                    </li>
                    <li class="eu  " data-lang="eu">
                        <a class="language-link">
                            <div class="language-name">English (Europe)</div>
                        </a>
                    </li>
                    <li class="zh-hans  " data-lang="sc">
                        <a class="language-link">
                            <div class="language-name">简体中文</div>
                        </a>
                    </li>
                   
                </ul>
            </div> -->
        </div>
  
</header>
        <section class="navbar">

<style>




.toggle,
[id^=drop] {
    display: none;
}

/* Giving a background-color to the nav container. */
nav { 
    margin:0;
    padding: 0;
    background-color: #07153a;
}


/* Since we'll have the "ul li" "float:left"
 * we need to add a clear after the container. */

nav:after {
    content:"";
    display:table;
    clear:both;
}

/* Removing padding, margin and "list-style" from the "ul",
 * and adding "position:reltive" */
nav ul {
    float: right;
    padding:0;
    margin:0;
    list-style: none;
    position: relative;
    }
    
/* Positioning the navigation items inline */
nav ul li {
    margin: 0px;
    display:inline-block;
    float: left;
    background-color: #07153a;
    }

/* Styling the links */
nav a {
    display:block;
    padding:14px 20px;  
    color:#FFF;
    font-size:17px;
    text-decoration:none;
}


nav ul li ul li:hover { background: #000000; }

/* Background color change on Hover */
nav a:hover { 
    background-color: #000000; 
}

/* Hide Dropdowns by Default
 * and giving it a position of absolute */
nav ul ul {
    display: none;
    position: absolute; 
    /* has to be the same number as the "line-height" of "nav a" */
    top: 60px; 
}
    
/* Display Dropdowns on Hover */
nav ul li:hover > ul {
    display:inherit;
}
    
/* Fisrt Tier Dropdown */
nav ul ul li {
    width:170px;
    float:none;
    display:list-item;
    position: relative;
}

/* Second, Third and more Tiers 
 * We move the 2nd and 3rd etc tier dropdowns to the left
 * by the amount of the width of the first tier.
*/
nav ul ul ul li {
    position: relative;
    top:-60px;
    /* has to be the same number as the "width" of "nav ul ul li" */ 
    left:170px; 
}

    
/* Change ' +' in order to change the Dropdown symbol */
li > a:after { content:  ' +'; }
li > a:only-child:after { content: ''; }


/* Media Queries
--------------------------------------------- */

@media all and (max-width : 768px) {

    #logo {
        display: block;
        padding: 0;
        width: 100%;
        text-align: center;
        float: none;
    }

    nav {
        margin: 0;
    }

    /* Hide the navigation menu by default */
    /* Also hide the  */
    .toggle + a,
    .menu {
        display: none;
    }

    /* Stylinf the toggle lable */
    .toggle {
        display: block;
        background-color: #07153a;
        padding:14px 20px;  
        color:#FFF;
        font-size:17px;
        text-decoration:none;
        border:none;
    }

    .toggle:hover {
        background-color: #000000;
    }

    /* Display Dropdown when clicked on Parent Lable */
    [id^=drop]:checked + ul {
        display: block;
    }

    /* Change menu item's width to 100% */
    nav ul li {
        display: block;
        width: 20%;
        }

    nav ul ul .toggle,
  
</style>

 <nav >
    <nav class="pull-left">
        <ul class="menu" style="padding-left: 30px;">
            <li><a href="<?php echo base_url()?>">หน้าเเรก</a></li>
            <li><a href="<?php echo base_url()?>web/sports">กีฬา</a></li>
            <li><a href="<?php echo base_url()?>web/casino">คาสิโน</a></li>
            <li><a href="<?php echo base_url()?>web/game">เกมส์</a></li>
            <li><a href="<?php echo base_url()?>web/Cockfight">ไก่ชน</a></li>
            <!-- <li><a href="<?php echo base_url()?>web/P2P">P2P</a></li> -->
            <li><a href="<?php echo base_url()?>web/lotto">หวย</a></li>
            <li><a href="<?php echo base_url()?>web/promotion">โปรโมชั่น</a></li>
            <!-- <li><a href="<?php echo base_url()?>web/privacy">นโยบายความเป็นส่วนตัว</a></li> -->

            <!-- <li><a href="<?php echo base_url()?>web/ive_tv">ทีวีสด</a></li> -->
        </ul>
    </nav>
    <label for="drop" class="toggle">Menu</label>
        <input type="checkbox" id="drop" />
            <ul class="menu" style="padding-right: 60px;">
                 <li><a href="<?php echo base_url()?>agent" target="_blank">พันธมิตร</a></li>
               <li >
                <label for="drop-2" class="toggle">บทความ +</label>
                <a href="#">บทความ</a>
                <input type="checkbox" id="drop-2"/>
                <ul style="z-index: 1;">
                    <li style="width: 300px;"><a href="<?php echo base_url()?>web/football">ฟุตบอล</a></li>
                    <li style="width: 300px;"><a href="<?php echo base_url()?>web/bacarar">บาคาร่า</a></li>
                    <li style="width: 300px;"><a href="<?php echo base_url()?>web/under_maintenance">ช่วงเวลาปิดปรับปรุงของธนาคาร</a></li>
                    <li>

                </ul>
                </li>
               
               <li><a href="http://imiwinshop.com/" target="_blank">สมัครเอเย่นต์</a></li>
                <!-- <li>
                    <a href="<?php echo base_url()?>บทความ_agent">สมัครเอเย่นต์</a>
                    <input type="checkbox" id="drop-1"/>
                    <ul>
                        <li><a href="<?php echo base_url()?>บทความ_agent">เอเย่นต์ฟุตบอล</a></li>
                        <li><a href="<?php echo base_url()?>web/casino_Agent">เอเย่นต์คาสีโน</a></li>
                        <li><a href="#">API</a></li>
                    </ul> 
                </li> -->
                <li >
                <!-- First Tier Drop Down -->
                <label for="drop-2" class="toggle">วิธีการสมัครสมาชิก +</label>
                <a href="#">วิธีการสมัครสมาชิก</a>
                <input type="checkbox" id="drop-2"/>
                <ul style="z-index: 1;">
                    <li><a href="<?php echo base_url()?>web/Register">วิธีการสมัคร</a></li>
                    <li><a href="<?php echo base_url()?>web/how_to_deposit">วิธีการฝาก</a></li>
                    <li><a href="<?php echo base_url()?>web/withdrawal_method">วิธีการถอน</a></li>
                    <li>
                       
                    <!-- Second Tier Drop Down -->        
                    <!-- <label for="drop-3" class="toggle">Tutorials +</label>
                    <a href="#">Tutorials</a>         
                    <input type="checkbox" id="drop-3"/>

                    <ul>
                        <li><a href="#">HTML/CSS</a></li>
                        <li><a href="#">jQuery</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                    </li> -->
                </ul>
                </li>
                <li><a href="<?php echo base_url()?>web/live_score">ตารางคะเเนน</a></li>
                <li><a href="line://ti/p/@imi55">ติดต่อ</a></li>
            </ul>
        </nav>


<script type="text/javascript">
(function($) { // Begin jQuery
  $(function() { // DOM ready
    // If a link has a dropdown, add sub menu toggle.
    $('nav ul li a:not(:only-child)').click(function(e) {
      $(this).siblings('.nav-dropdown').toggle();
      // Close one dropdown when selecting another
      $('.nav-dropdown').not($(this).siblings()).hide();
      e.stopPropagation();
    });
    // Clicking away from dropdown will remove the dropdown class
    $('html').click(function() {
      $('.nav-dropdown').hide();
    });
    // Toggle open and close nav styles on click
    $('#nav-toggle').click(function() {
      $('nav ul').slideToggle();
    });
    // Hamburger to X toggle
    $('#nav-toggle').on('click', function() {
      this.classList.toggle('active');
    });
  }); // end DOM ready
})(jQuery); // end jQuery
</script>


</section>





    










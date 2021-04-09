<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta property="og:url" content="<?= base_url() ?>users/home" />
      <meta property="og:type" content="article" />
      <meta property="og:title" content="เว็บไซต์ระบบอัตโนมัติ 3 ฟุตบอล 12 คาสิโน และมากกว่า 100เกมส์" />
      <meta property="og:description" content="เว็บไซต์ที่มีคนติดต่อมากถึง 1 ล้านคนในประเทศไทย และอีกหลายล้านคนใน 4 ประเทศ" />
      <meta property="og:image" content="<?php echo $this->config->item('tem_frontend_img'); ?>facebook.jpg" />
      <title><?= $this->getapi_model->nameweb() ?> MEMBER เว็บไซต์ระบบอัตโนมัติ 3 ฟุตบอล 12 คาสิโน และมากกว่า 100เกมส์</title>


        <link rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>bootstrap.min.imi55.css" />
        <link rel="shortcut icon" href="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" />
        <link rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>animate.min.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>css_member.css" />

        <link href="<?php echo $this->config->item('tem_frontend_css'); ?>style_member.css?v=2" rel="stylesheet" />
        <link href="<?php echo $this->config->item('tem_frontend_css'); ?>icon.css" rel="stylesheet" />
        <script src="<?php echo $this->config->item('tem_frontend_js'); ?>jquery-3.3.1.slim.min.js"></script>

         <script src="https://kit.fontawesome.com/3f6c0768e9.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
        <script src="<?php echo $this->config->item('tem_frontend_js'); ?>/Winwheel.js"></script>
<script src="<?php echo base_url() ?>public/tem_admin/swal/sweetalert.min.js"></script>
        
    </head>
<link href="https://fonts.googleapis.com/css2?family=Athiti:wght@300;500&family=Thasadith:wght@700&display=swap" rel="stylesheet">


<style type="text/css">
     p {
    font-family: 'Athiti', serif;
    
    }
    h1{
    font-family: 'Athiti', serif;
    }
    h2{
    font-family: 'Athiti', serif;
    }
    h3{
    font-family: 'Athiti', serif;
    }
    h4{
    font-family: 'Athiti', serif;
    }
    h5{
    font-family: 'Athiti', serif;
    }
    h6{
    font-family: 'Athiti', serif;
    }
    b{
    font-family: 'Athiti', serif;
    }
    li{
        font-family: 'Athiti', serif;
    }
    label{
        font-family: 'Athiti', serif;
    }
    select{
        font-family: 'Athiti', serif;
    }
    ul{
        font-family: 'Athiti', serif;
    }
    a{
        font-family: 'Athiti', serif;
    }button{
         font-family: 'Athiti', serif;
    }strong{
         font-family: 'Athiti', serif;
    }option{
        font-family: 'Athiti', serif;
    }select{
        font-family: 'Athiti', serif;
    }span{
        font-family: 'Athiti', serif;
    }
    input{
        font-family: 'Athiti', serif;

    }div{
        font-family: 'Athiti', serif;
        
    }
    </style>
    <body>
      <style type="text/css">


.load{position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);
  /*change these sizes to fit into your project*/
  width:100px;
  height:100px;
}
.load hr{border:0;margin:0;width:40%;height:40%;position:absolute;border-radius:50%;animation:spin 2s ease infinite}

.load :first-child{background:#19A68C;animation-delay:-1.5s}
.load :nth-child(2){background:#F63D3A;animation-delay:-1s}
.load :nth-child(3){background:#FDA543;animation-delay:-0.5s}
.load :last-child{background:#193B48}

@keyframes spin{
  0%,100%{transform:translate(0)}
  25%{transform:translate(160%)}
  50%{transform:translate(160%, 160%)}
  75%{transform:translate(0, 160%)}
}

 .imi{
        width: 100%;
        
    }
    .imii{
        margin-top: -10px;
        padding-left: 5px;
    }
    .imirank{
       width: 75%;
       
    }
</style>


<div class="load" style="z-index: 999;display: none;" id="load">
  <hr/><hr/><hr/><hr/>
</div>
        <div class="fade_bg" style="height: 100%; width: 100%; background-color: transparent;  opacity: 1; position: fixed; top: 0; left: 0; z-index: -9999;"></div>
        <div id="root">


           <?php if (!empty($this->session->member) && $this->session->member->user != '') { ?>

 <div id="mySidenav" class="sidenav" style="z-index: 99;">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <a href="/resetpassword">เปลี่ยนรหัสผ่าน</a>
                <a href="#" onclick="logout()">ออกจากระบบ</a>
            </div>
            <main>

                <div class="sc-dnqmqq bDdzNw ">
                    <div class="sc-gZMcBi bnnRsB">
                        <div class="sc-bwzfXH jHDvox">
                           
                            <a href="<?= base_url() ?>users/home" class="text-white">
                                  <img class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/home55.png"> 
                            </a>
                        </div>
                    </div>
                    <div class="sc-iwsKbI icBXiL">
                    
                        
                        <img data-cfsrc="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="" width="130px" data-cfstyle="margin-top: 8px;" style="margin-top: 8px;" src="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" />
                    </div>
                    <div class="mt-1">
                        
                        <span class="sc-bZQynM cDzkuB" style="font-size: 1.5em;" onClick="logout();">
                             <img class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/logout55.png">
                        </span>
                    </div>
                </div>

<!--     <div class="container sc-dnqmqq bDdzNw " style="padding: 5px 1px;">
      <div class="sc-gZMcBi bnnRsB">
        <div class="sc-bwzfXH jHDvox">
          <a href="<?= base_url() ?>users/home" class="text-white">
             <img  data-cfsrc="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" alt="IMI55" style="margin-top: 10px;max-width: 450%;" src="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" />
          </a>
        </div>
      </div>
      <div class="sc-iwsKbI icBXiL">
       
      </div>

      <div class="mt-1">
      <div align="right" style="padding-right: 5px;padding-bottom: 8px;">
        <div  style="background: linear-gradient(0deg, rgba(0,39,105,1) 0%, rgba(4,100,232,1) 46%, rgba(0,23,135,1) 100%);border-radius: 10px 10px 10px 10px;border-bottom: 2px solid #fff;border-top: 2px solid #fff;border-left: 2px solid #fff;border-right: 2px solid #fff;width: 105px;text-align: center;">
         <span class="sc-bZQynM cDzkuB" style="font-size: 1em;color: #fff;" onClick="logout();">
        <b>ออกจากระบบ</b>
        </span>
      </div>
      
      </div>
      <div align="right" style="padding-right: 5px;padding-bottom: 10px;">
      <b style="font-size: 1em;color: #fff;padding-right: 5px;padding-top: 5px;">รหัสลูกค้า : <?= $this->session->member->user ?></b><br>
        <li style="font-size: 10px;cursor: pointer;font-size: 1em;color: #fff;padding-right: 5px;padding-top: 5px;" class="fa fa-refresh " onClick="location.reload()">
          <b>ข้อมูลล่าสุด เวลา <?=date('H:i');?> น.</b>
        </li>
      </div>
      </div>

    </div>
 -->







<?php } else { ?>
 <?php } ?>

           
 
            


 <?php echo $output; ?>


<style type="text/css">
  .im{
    width: 40px;
  }.imm{
    width: 70px;
    margin-top: -70px;
  }
</style>


 <?php if (!empty($this->session->member) && $this->session->member->user != '') { ?>

<div class="sc-kkGfuU enYrEp" >
                    <a class="sc-iAyFgw gbcbkP" aria-current="page" href="<?= base_url() ?>users/member" style="width: 10%;">
                        <img class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/home.png">
                        <div class="sc-cvbbAY bzLgpG">หน้าหลัก</div>
                    </a>
                    <a class="sc-iAyFgw gbcbkP" href="<?= base_url() ?>users/gift/gift">
                        <img class="im" class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/gift.png">
                        <div class="sc-cvbbAY bzLgpG">แลกรางวัล</div>
                    </a>
                    <a class="sc-iAyFgw gbcbkP" onclick="sendtogame()" >
                       <img class="imm" src="<?= $this->config->item('tem_frontend'); ?>img/play.png" >
                       <div class="sc-cvbbAY bzLgpG">ทางเข้าเล่น</div>
                    </a>
                    <a class="sc-iAyFgw gbcbkP" href="<?= base_url() ?>users/member/contact_web" style="">
                        <img class="im" class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/contact.png">
                        <div class="sc-cvbbAY bzLgpG">ติดต่อ</div>
                    </a>
                    <a class="sc-iAyFgw gbcbkP" href="<?= base_url() ?>users/other" style="">
                         <img class="im" class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/other.png">
                        <div class="sc-cvbbAY bzLgpG">อื่นๆ</div>
                    </a>
                </div>

<?php } else { ?>

<div class="sc-kkGfuU enYrEp" >
   <a class="sc-iAyFgw gbcbkP" aria-current="page" href="<?= base_url() ?>users/member" style="width: 10%;">
                      
                    </a>
                    <a class="sc-iAyFgw gbcbkP" aria-current="page" onClick="menubar('login');" style="width: 10%;">
                        <img class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/icon/login.png">
                        <div class="sc-cvbbAY bzLgpG">Login</div>
                    </a>
                    <a class="sc-iAyFgw gbcbkP" onClick="menubar('register');">
                        <img class="im" class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/icon/re.png">
                        <div class="sc-cvbbAY bzLgpG">Register</div>
                    </a>
                     <a class="sc-iAyFgw gbcbkP" onClick="menubar('contact');">
                        <img class="im" class="im"  src="<?= $this->config->item('tem_frontend'); ?>img/icon/linemember.png">
                        <div class="sc-cvbbAY bzLgpG">Contact</div>
                    </a>
                   
                   
                </div>

 <?php } ?>

   
                
           

    <script type="text/javascript" src="https://ajax.cloudflare.com/cdn-cgi/scripts/04b3eb47/cloudflare-static/mirage2.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>public/tem_frontend/mapraw/js/scripts.js"></script>



    <script type="text/javascript">
      function sendtogame() {
        $.ajax({
            url: '<?= base_url() ?>users/member/check_login_imi',
            type: 'POST',
            dataType: 'json',
          })
          .done(function(res) {
            //console.log(res);
            if (res.code == 1) {
              swal({
                title: "",
                text: "เข้าสู่ระบบสำเร็จ",
                icon: "success",
              });
              setTimeout(function() {
                window.location.href = res.data.RedirectUrl;
              }, 2500);
            } else {
              const txt = document.createElement('div');
              txt.innerHTML = "<b style='color:#000'>ไม่สามารถเข้าสู่ระบบได้</b><br><b style='color:#000'>กรุณาตรวจสอบ username และ password ให้ถูกต้อง!</b>";
              swal({
                content: txt,
                icon: "error",
              });
              if (type == 'desktop') {
                $('#pass').val('');
              } else if (type == 'mobile') {
                $('#pass_mo').val('');
              }

            }
          })
          .fail(function() {
            console.log("error");
          });
      }

      function logout() {
        swal({
          title: 'คุณต้องการออกจากระบบ?',
          buttons: true,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: '<?= base_url() ?>users/member/logout',
                type: 'POST',
                dataType: 'json',
              })
              .done(function(res) {
                // success
                if (res.code == 1) {
                  swal(res.title, res.msg, "success")
                    .then(function(sw) {
                      $('#cover-spin').show();
                      setTimeout(function() {
                        $('#cover-spin').hide();
                        window.location.href = "<?= base_url() ?>users/home";
                      }, 1000);
                    });
                } else {
                  swal(res.title, res.msg, "error")
                    .then(function(sw) {
                      location.reload();
                    });
                }
              });
          } else {

          }

        });


      }


      function opengame(Vendor, GameCode) {
         $('#load').show();
        $('#tap_contact').hide();
        $.ajax({
            url: '<?= base_url(); ?>users/allgames/open_game',
            type: 'POST',
            dataType: 'json',
            data: {
              Vendor: Vendor,
              GameCode: GameCode,

            },
          })
          .done(function(res) {
            console.log(res);
            if (res.Code == -2) {
              swal({
                icon: "error",
                title: 'Token หมดอายุ กรุณาล็อคอินใหม่ค่ะ',
                buttons: true,
              }).then((ch) => {
                if (ch) {
                  logout();
                }
              });

            }

            $('#mygame').css('display', 'none');
            // $('#mygame642').html('<iframe src="'+res.Result.Data+'" title="description">')
             window.location.href = res.Result.Data;
            //window.open(res.Result.Data);
            // success

          });
      }
    </script>

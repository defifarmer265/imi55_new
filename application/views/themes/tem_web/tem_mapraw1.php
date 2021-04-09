
<!DOCTYPE html>
<html lang="th">
<head>

      <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta content="" name="description" />
      <meta content="IMI55" name="author" />

      <meta name="description" content="">
      <meta name="author" content="">
      <meta property="og:url" content="<?= base_url() ?>users/home" />
      <meta property="og:type" content="article" />
      <meta property="og:title" content="เว็บไซต์ระบบอัตโนมัติ 3 ฟุตบอล 12 คาสิโน และมากกว่า 100เกมส์" />
      <meta property="og:description" content="เว็บไซต์ที่มีคนติดต่อมากถึง 1 ล้านคนในประเทศไทย และอีกหลายล้านคนใน 4 ประเทศ" />
      <meta property="og:image" content="<?php echo $this->config->item('tem_frontend_img'); ?>facebook.jpg" />
      <title><?= $this->getapi_model->nameweb() ?> MEMBER เว็บไซต์ระบบอัตโนมัติ 3 ฟุตบอล 12 คาสิโน และมากกว่า 100เกมส์</title>



        <link href="<?php echo $this->config->item('tem_frontend_css'); ?>icon.css" rel="stylesheet" />

        <link media="all" type="text/css" rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>light_adminux.css" />
        <link media="all" type="text/css" rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>layout_home.css" />
        <link rel="shortcut icon" href="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" />
        <link rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>animate.min.css" />
        <link href="<?php echo $this->config->item('tem_frontend_css'); ?>style_member.css?v=2" rel="stylesheet" />
        <link href="<?php echo $this->config->item('tem_frontend_css'); ?>icon.css" rel="stylesheet" />
        <script src="<?php echo $this->config->item('tem_frontend_js'); ?>jquery-3.3.1.slim.min.js"></script>
        <script src="https://kit.fontawesome.com/3f6c0768e9.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
        <script src="<?php echo $this->config->item('tem_frontend_js'); ?>/Winwheel.js"></script>
        <script src="<?php echo base_url() ?>public/tem_admin/swal/sweetalert.min.js"></script>
        <link media="all" type="text/css" rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>home_index.css?v=1609124911" />



      <link media="all" type="text/css" rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>bootstrap_new.css">


      <script>
        window.Laravel = {"csrfToken":"pyClqh57xkFnWZuLLikFwOFVF9rQD0cOP2A6fOn6"};
      </script>
      <link media="all" type="text/css" rel="stylesheet" href="<?php echo $this->config->item('tem_frontend_css'); ?>home_index.css?v=1609124911" />


        
    </head>


<link href="https://fonts.googleapis.com/css2?family=Athiti:wght@300;500&family=Thasadith:wght@700&display=swap" rel="stylesheet">
<style type="text/css">
p {
    font-family: "Athiti", serif;
}
h1 {
    font-family: "Athiti", serif;
}
h2 {
    font-family: "Athiti", serif;
}
h3 {
    font-family: "Athiti", serif;
}
h4 {
    font-family: "Athiti", serif;
}
h5 {
    font-family: "Athiti", serif;
}
h6 {
    font-family: "Athiti", serif;
}
b {
    font-family: "Athiti", serif;
}
li {
    font-family: "Athiti", serif;
}
label {
    font-family: "Athiti", serif;
}
select {
    font-family: "Athiti", serif;
}
ul {
    font-family: "Athiti", serif;
}
a {
    font-family: "Athiti", serif;
}
button {
    font-family: "Athiti", serif;
}
strong {
    font-family: "Athiti", serif;
}
option {
    font-family: "Athiti", serif;
}
select {
    font-family: "Athiti", serif;
}
span {
    font-family: "Athiti", serif;
}
input {
    font-family: "Athiti", serif;
}
div {
    font-family: "Athiti", serif;
}

.load {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    /*change these sizes to fit into your project*/
    width: 100px;
    height: 100px;
}
.load hr {
    border: 0;
    margin: 0;
    width: 40%;
    height: 40%;
    position: absolute;
    border-radius: 50%;
    animation: spin 2s ease infinite;
}

.load :first-child {
    background: #19a68c;
    animation-delay: -1.5s;
}
.load :nth-child(2) {
    background: #f63d3a;
    animation-delay: -1s;
}
.load :nth-child(3) {
    background: #fda543;
    animation-delay: -0.5s;
}
.load :last-child {
    background: #193b48;
}

@keyframes spin {
    0%,
    100% {
        transform: translate(0);
    }
    25% {
        transform: translate(160%);
    }
    50% {
        transform: translate(160%, 160%);
    }
    75% {
        transform: translate(0, 160%);
    }
}

.imi {
    width: 100%;
}
.imii {
    margin-top: -10px;
    padding-left: 5px;
}
.imirank {
    width: 75%;
}

</style>


   
<body class="menuclose menuclose-right">

<?php if (!empty($this->session->member) && $this->session->member->user != '') { ?>
<header class="navbar-fixed" style="background: linear-gradient(to right, #1c2846 0%, #0a3492 100%);">
    <div class="col-16 col-md-11 col-lg-8 mx-auto">
        <nav class="nav justify-content-center align-items-start pt-2 container px-1 px-md-0 pb-2">
            <div class="d-flex mr-auto">
                &nbsp;
            </div>

            <a href="<?= base_url() ?>"> <img src="<?php echo $this->config->item('tem_frontend_img'); ?>logo.png" class="responsive-img header-nav-logo" /></a>
            <div class="ml-auto mt-auto mb-auto mr-1 sidebar-right" style="width: auto;">
                <div style="
                        background: linear-gradient(to right, #003cbf 0%, #1c2743 100%);
                        border-radius: 10px 10px 10px 10px;
                        border-bottom: 2px solid #fff;
                        border-top: 2px solid #fff;
                        border-left: 2px solid #fff;
                        border-right: 2px solid #fff;
                        width: 105px;
                        text-align: center;
                    "
                >
                    <span class="sc-bZQynM cDzkuB" style="font-size: 1em; color: #fff;" onclick="logout();">
                        <b>ออกจากระบบ</b>
                    </span>
                </div>
            </div>
        </nav>
    </div>
</header>



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

 <footer class="navbar-fixed footer col-16">
        <div class="col-16 nav-footer px-0">
            <ul class="nav nav-bottom-bar justify-content-around" style="position: relative;">
                <li class="nav-item col px-0">
                    <a href="<?= base_url() ?>users/member" class="nav-link">
                        <img class="responsive-img" src="<?= $this->config->item('tem_frontend'); ?>img/home.png" />
                        <label >หน้าหลัก</label>
                    </a>
                </li>
                <li class="nav-item col px-0">
                    <a href="<?= base_url() ?>users/gift/gift" class="nav-link">
                        <img class="responsive-img" src="<?= $this->config->item('tem_frontend'); ?>img/gift.png" />
                        <label>แลกรางวัล</label>
                    </a>
                </li>
                <li class="nav-item col px-0">
                    <a onclick="sendtogame()"  class="nav-link">
                       <!--  <img class="responsive-img" src="<?= $this->config->item('tem_frontend'); ?>img/imilogin.png" /> -->
                        <label style="color: #ccff00">ทางเข้าเล่น</label>
                    </a>
                </li>
                <li class="nav-item col px-0">
                    <a href="<?= base_url() ?>users/member/contact_web" class="nav-link">
                        <img class="responsive-img" src="<?= $this->config->item('tem_frontend'); ?>img/contact.png" />
                        <label>ติดต่อ</label>
                    </a>
                </li>
                <li class="nav-item col px-0">
                    <a href="<?= base_url() ?>users/other" class="nav-link">
                        <img class="responsive-img" src="<?= $this->config->item('tem_frontend'); ?>img/other.png" />
                        <label>อื่นๆ</label>
                    </a>
                </li>
            </ul>
        </div>
    </footer>

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

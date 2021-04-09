<form class="login-form" id="form1" rel="nofollow">
<div class="form-group" style="width: 38%;margin-right: 2%;background-color: #ffffff;border: 1px solid #ffffff54;box-shadow: 0px 0px 5px #000000;border-radius: 2px;float: left;padding: 5px 10px;height: 33px;"> <span><i class="fa fa-user" aria-hidden="true" style=" font-size: 18px; "></i></span>  
    <input class="form-controll" id="username" name="txtUserName" type="text" placeholder="USERNAME"></div>
<div class="form-group" style="width: 38%;margin-right: 2%;background-color: #ffffff;border: 1px solid #ffffff54;box-shadow: 0px 0px 5px #000000;border-radius: 2px;float: left;padding: 5px 10px;height: 33px;"> <span><i class="fa fa-unlock" aria-hidden="true" style=" font-size: 18px; "></i></span> 
    <input class="form-controll" id="password" name="password" type="password" placeholder="PASSWORD"></div>
<div style="text-align: center;float: left;width: 20%;margin-bottom: 0px;padding: 7px;height: 33px;border-radius: 2px;border: 2px solid #ffe000;"> 
    <a class="" id="" style="color: #ffe000;text-shadow: 0px 0px 1px #000000;font-size: 14px;cursor: pointer;" onclick="mylogin2()">เข้าสู่ระบบ</a></div> 
</form>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
function mylogin2(){

                let user = document.getElementById('username').value
                let pass = document.getElementById('password').value
                const url = 'https://imi42.com/mem/users/home/login';
                var xhr = new XMLHttpRequest();
var data = "username="+user+"&password="+pass;
var config = {
  method: 'post',
  url: url,
  headers: { 
    'Content-Type': 'application/x-www-form-urlencoded', 
  },
  data : data
};
console.log(config);
axios(config)
.then(function (response) {
  console.log(response.data);
     let res = response.data;
                    if (res.code == 1) {
                    swal('กรอกข้อมูลสำเร็จsssss', '', 'success');    

                    setTimeout(function() 
                    {
                        window.location.href = "https://imi42.com/mem/users/member";
                         },1500);
                       
                    }
      
                       
                    else if(res.code == 2)
                     {
                     //Password fail  
                   
                     
                }
})  

.catch(function (error) {
  console.log(error);
});
}
</script>
<!-- CONTACT-->
<header class="masthead text-white text-center"  id="tap_contact">
  <br>
<style>
.block {
    border: 1px solid red;
    text-align: center;
    vertical-align: middle;
}
.circle {
    border: 2px solid #FFFFFF;
    background: rgba(60,72,76,1.00);
    border-radius: 200px;
    color: white;
    height: 180px;
    font-weight: bold;
    width: 180px;
    display: table;
    margin: 20px auto;
}
.circle p {
    vertical-align: middle;
    display: table-cell;
}
.square {
    border: 0px solid #FFFFFF;
    background: rgba(255,255,255,0.00);
    border-radius: 200px;
    color: white;
    position: relative;
    width: 100%;
    padding-bottom: 30%;

}
.square:after {
    vertical-align: middle;
    content: "";
    display: block;
    padding-bottom: 100%;
}
.content {
    vertical-align: middle;
    position: absolute;
    width: 100%;
    height: 100%;
}
.img_icon {
    padding-top: 25%;
}
  .text_icon{
    
    padding-top: 9%;
    font-size: 15px;
    white-space: nowrap;
  }
.วิบวับ {
  width: 120px;
  height: 50px;
  border: none;
  outline: none;
  color: #fff;
  cursor: pointer;
  position: absolute;
  z-index: 0;
  border-radius: 10px;
  ;
 


}

.วิบวับ:before {
  content: '';
  background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing 20s linear infinite;
  opacity: 0.8;
  transition: opacity .3s ease-in-out;
  border-radius: 10px;
}

.วิบวับ:active {
  color: #000
}



.วิบวับ:after {
  z-index: -1;
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  background: #000000d4;
  left: 0;
  top: 0;
  border-radius: 10px;

}

@keyframes glowing {
  0% {
    background-position: 0 0;
  }

  50% {
    background-position: 100% 0;
  }

  100% {
    background-position: 0 0;
  }
}

.วิบวับ2 {
  width: 220px;
  height: 50px;
  border: none;
  outline: none;
  color: #fff;
  cursor: pointer;
  position: relative;
  z-index: 0;
  border-radius: 10px;

}

.วิบวับ2:before {
  content: '';
  background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing 20s linear infinite;
  opacity: 0.8;
  transition: opacity .3s ease-in-out;
  border-radius: 10px;
}

.วิบวับ2:active {
  color: #000
}



.วิบวับ2:after {
  z-index: -1;
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  background: #000000d4;
  left: 0;
  top: 0;
  border-radius: 10px;
}

@keyframes glowing {
  0% {
    background-position: 0 0;
  }

  50% {
    background-position: 400% 0;
  }

  100% {
    background-position: 0 0;
  }
}

.paddingbottom{
  margin-bottom: 5%;
}
</style>
<div class="container">
  <div class="row">
      <div class="col-12">
      <span style="font-size: 23px;">แลกของรางวัล</span>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <?php 
        $id = $this->session->member->id;
        $data = $this->db->where('id',$id)->get('tb_user')->result_array();
         foreach($data as $dt){ $point = $dt['point']; }
         ?>
        
      <button class="btn btn-info วิบวับ2" id="total_point" style="font-size: 23px;"><?php echo number_format($point); ?></button>
      </div>
    </div>
   <div class="">
   
    <div class="container d-flex align-items-center flex-column">
  
    <br>
      <div class="row" style="width: 100%;" >
          <?php
              if(empty($reward)){
                echo '<tr><td colspan="6" class="text-center red"> ไม่มีข้อมูล</td></tr>';
              }
                foreach($reward as $sp){
              ?>
          <div class="col-6 col-sm-4 mt-5" >
            <div class="square " >            
              <div class="content text " style="text-align: center;" > 
               
                <img src="<?=$this->config->item('tem_frontend_img').'/reward/'.$sp['img']?>" onClick="checkpoint('<?=$sp['prize']?>','<?=$sp['reward']?>','<?=$sp['id_reward']?>','<?=$sp['type']?>')" width="90%" class="img_icon"> 
              </div>
            </div>
               <div class="text_icon   paddingbottom"><h4 class="colortext " style="text-align: center;"> <?php echo  number_format($sp['prize']);?>  </h4>
               
              </div>
               <div class="text_icon วิบวับ  "  style="text-align: center;" ><span>รับ <?php echo  number_format($sp['reward']);?> บาท</span></div>
               <input type="text" name="valuereward" id="valuereward" value="<?=$sp['reward']?><" hidden>
          </div>
          <?php 
                }
              ?>         
      </div>
 

  
      
    </div>
  </div>
</div>

<div style="padding-top: 200px;"></div>

</header>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function checkpoint(prize,reward,rewardID,type) {
    
          // console.log(prize);
          // console.log(reward);
          
       
           // var reward = $('#valuereward').val();
           Swal.fire({
  title: 'ต้องการแลกรางวัล?',
  text: "ต้องการแลกรางวัล "+reward+" บาทใช่ไหม",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'ไม่',
  confirmButtonText: 'ใช่'
}).then((result) => {
  if (result.value) {
    $.ajax({
               url: 'userPoint',
               method: 'POST',
               type:'json',
               data: {prize:prize,rewardID:rewardID,reward:reward,type:type},
        })
        .done(function(re) {
           var re = JSON.parse(re);

        if (re.code == 1) {
          
            // swal("", "แลกรางวัลเรียบร้อย", "success");
            // setTimeout(function(){location.reload(); },2000);
          Swal.fire(
              'แลกรางวัล',
              'แลกรางวัลเรียบร้อย!',
              'success'
            ).then(function() {
                    location.reload();
                })

        }else{
           Swal.fire(
              'แลกรางวัล',
              'ไม่สามารถแลกรางวัลได้',
              'error'
            ).then(function() {
                    location.reload();
                })
        }
        })
        .fail(function() {
        });
  }
})
          
           
           
           }

           

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
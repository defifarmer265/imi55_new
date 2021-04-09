

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
		<li><a href="<?=base_url('sale/home/dashboard'); ?>">	<i class="fa fa-tachometer"></i> แดชบอร์ด  </a> </li>
		<li><a href="<?=base_url('sale/salelist'); ?>">			<i class="fa fa-users"></i> รายชื่อเซลล์  </a> </li>
		<li><a >
			<i class="fa fa-user"></i> สมาชิก <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="<?=base_url('sale/user/search'); ?>"> ค้นหาลูกค้า รหัส/เบอร์ </a></li>
			  <li><a href="<?=base_url('sale/user/user_account'); ?>"> ค้นหาจาก บัญชี/ชื่อ  </a></li>
			  <li><a href="<?=base_url('sale/user'); ?>"> รายชื่อลูกค้า </a></li>
			</ul>
		</li>
		<li><a >
			<i class="fa fa-bank"></i> รายการฝาก <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="<?=base_url('sale/deposit/waitfirm'); ?>"> ฝากรอเฟิร์ม </a></li>
			  <li><a href="<?=base_url('sale/deposit/transaction'); ?>"> ฝากล่าสุด </a></li>
			  <li><a href="<?=base_url('sale/deposit/deposit'); ?>"> ฝากสมาชิก </a></li>
			</ul>
		</li>
<!--		<li><a href="<?=base_//url('sale/otp'); ?>">				<i class="fa fa-users"></i> OTP  </a> </li>-->
<!--
		<li><a >
			<i class="fa fa-file"></i> รายงาน <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu">
			  <li><a href="<?=base_url('sale/report/waitfirm'); ?>"> ฝากรอเฟิร์ม </a></li>

			</ul>
		</li>
-->
		<!-- <li><a href="<?=base_url('sale/income'); ?>">			<i class="fa fa-money"></i> รายได้  ตัว้เก่า </a> </li> -->
		<li><a href="<?=base_url('sale/income/calsale'); ?>">			<i class="fa fa-money"></i> รายได้ </a> </li>

		<li><a href="<?=base_url('sale/profile'); ?>">			<i class="fa fa-credit-card"></i> โปรไฟล์  </a> </li>
		
    </ul>
  </div>
</div>
<!-- /sidebar menu --> 

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small"> 
	<a data-toggle="tooltip" data-placement="top" title="Settings"> 
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> 
	</a> 
	<a data-toggle="tooltip" data-placement="top" title="Dashboard" href="<?=base_url('sale/home/sale_dashboard'); ?>"> 
		<span class="fa fa-tachometer" aria-hidden="true"></span> 
	</a> 
	<a data-toggle="tooltip" data-placement="top" title="Lock"> 
		<span class="fa fa-money" aria-hidden="true"></span> 
	</a> 
	<a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('sale/logout'); ?>"> 
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span> 
	</a> 
</div>
<!-- /menu footer buttons -->
</div>
</div>

<!-- top navigation -->


<div class="top_nav">
  <div class="nav_menu">
    <div class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a> </div>
    <nav class="nav navbar-nav">
      <ul class=" navbar-right">
		  
        <li class="nav-item dropdown open" style="padding-left: 15px;"> 
			<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"> 
			<i class="fa fa-cogs m-2"></i></a>
          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown"> 
			  <a class="dropdown-item"  href="<?=base_url('sale/home/sale'); ?>"> โปรไฟล์</a> 
			  <a class="dropdown-item"  onclick="return confirm('คุณแน่ใจว่าต้องการออกจากระบบ!')" href="<?php echo base_url('sale/logout'); ?>">
				  <i class="fa fa-sign-out pull-right"></i> ออกจากระบบ</a> 
			</div>
        </li>
		
      </ul>
    </nav>
  </div>
</div>

<!-- /top navigation --> 
  
<?php
	$AppName = $this->session->AppName;
	$AppNameLeft = $this->session->AppNameLeft;
	$AppNameRight = $this->session->AppNameRight;
	$AppVersion = $this->session->AppVersion;
?>

<style type="text/css">
	body{
		background: white!important;
	}
.box-top{
	background: #83bdf2;
	width: 100%;

}

.box-bottom{
margin-top: -20px;
	width: 100%;


}

h2{
	margin-top: 0px;
	font-weight: 600;
}
.white{
	color: white;
}
.login-logo{
	padding: 30px;
}
.login-box-body{
	width: 360px;
	margin:auto;
	padding-left: 40px;
	padding-right: 40px;
}
.blue{
	color :#83bdf2;
}

.input{
border-radius: 25px;
border:2px solid #83bdf2;
padding: 14px;
height: 50px;
 position: relative;
   padding-left: 45px !important;
   font-size: 17px;
}
.btnlogin{
border-radius: 25px;
background:#2b7feb;
color: white;
height: 50px;
font-size: 23px;
font-weight: 600;	
}
.iconInput{
	width: 30px;
	   position: absolute;
    top: 10px;
    left: 10px;
    color: blue;
    font-size: 22px;
    z-index: 9999;
}
</style>
<div class="box-top">

	<div class="login-logo">
		<!--<a href="../../index2.html" style="color: #ffffff;"><b><?= $AppNameLeft ?></b><?= $AppNameRight ?></a>-->
		
		<h2 class="text-center white">Welcome To</h2>

		<img src="<?= base_url('Images/Logos/InterACT Logos/MainLogo.png') ?>" alt="<?= $AppName ?>" style="width:250px; height: auto;">

		<!-- CAROUSEL -->
		<div id="carousel-example-generic" class="carousel slide hidden" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
				<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
				<li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<img src="<?= base_url('Images/Logos/InterACT Logos/InterACT_600x394.png') ?>" alt="<?= $AppName ?>" style="width:100%; height: auto;" >
				</div>
				<div class="item">
					<img src="<?= base_url('Images/Logos/Other Logos/Glucobest_600x394.png') ?>" alt="GlucoBest" style="width:100%; height: auto;" >
				</div>
				<div class="item">
					<img src="<?= base_url('Images/Logos/Other Logos/Nutribest_600x394.png') ?>" alt="NutriBest" style="width:100%; height: auto;" >
				</div>
				<div class="item">
					<img src="<?= base_url('Images/Logos/Other Logos/Westmont_600x394.png') ?>" alt="Westmont" style="width:100%; height: auto;" >
				</div>
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				<span class="fa fa-angle-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				<span class="fa fa-angle-right"></span>
			</a>
		</div>
		<!-- /.CAROUSEL -->

	</div>

	<!-- /.login-box-body -->

</div>

<div class="box-bottom">
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg blue" > <b> Sign in to start your session</b></p>

		<form action="<?php echo base_url() ?>Account/post_signin" method="post">
			<div class="form-group has-feedback">
				<!--<input type="number" name="Username" class="form-control" placeholder="PRC No" min="1" max="99999999" required autofocus>
				<span class="fa fa-hashtag form-control-feedback"></span>-->
				
				<img class="iconInput" src="<?php echo base_url() ?>Images/User.png" >
				<input type="email" name="Username" class="form-control input" placeholder="Email" maxlength="100" required="required" autofocus="autofocus">
				
			</div>
			<div class="form-group has-feedback">
				<img class="iconInput" src="<?php echo base_url() ?>Images/Pass.png" >
				<input type="password" name="Password" type="password" class="form-control input" placeholder="Passcode" maxlength="100" required>
			
			</div>
			<div class="row">
				
				<!-- /.col -->
				<div class="col-xs-12 ">
					<button type="submit" class="btnlogin btn btn-block ">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
		<br>
		<a href="<?php echo base_url(); ?>index.php/Account/register" class="text-center">Register a new account</a>
		<br />
		<a href="<?= base_url('index.php/ControlPanel/signin');?>" class="text-center">Admin?</a>
		
<!-- 	</div>
	<img src="<?= base_url('Images/Logos/Other Logos/Glucobest_600x131.jpg') ?>" alt="GlucoBest" style="width:100%; height: auto;" hidden>
	<img src="<?= base_url('Images/Logos/Other Logos/Nutribest_600x137.jpg') ?>" alt="NutriBest" style="width:100%; height: auto;" hidden>
	<div class="lockscreen-footer text-center" style="color: #ffffff;">
		Copyright &copy; 2016 <b><a href="http://abig.unilab.ph/PDBA_Portal" target="_blank" class="text-aqua">PDBA</a> - <a href="http://www.unilab.com.ph" target="_blank" class="text-aqua">UNILAB, Inc.</a></b><br>
		All rights reserved
	</div> -->
</div>
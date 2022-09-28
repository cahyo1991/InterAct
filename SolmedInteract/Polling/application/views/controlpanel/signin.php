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

<div class="login-box-body">
		<p class="login-box-msg blue">Sign in to the control panel.</p>

		<form action="post_signin" method="post">
			<div class="form-group has-feedback">
				<img class="iconInput" src="<?php echo base_url() ?>Images/User.png" >
				<input type="password" name="Passcode" class="form-control input" placeholder="Passcode" maxlength="100" autofocus required>
				
			</div>
			<div class="row">
				<div class="col-xs-8">
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" style="background: #83bdf2!important" class="white btn btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
		
		<a href="<?php echo base_url();?>index.php/Account/signin" class="text-center">End User?</a>
	</div>
	
	</div>
</div>
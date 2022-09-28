<?php
	$AppName = $this->session->AppName;
	$AppNameLeft = $this->session->AppNameLeft;
	$AppNameRight = $this->session->AppNameRight;
	$AppVersion = $this->session->AppVersion;
?>


<style type="text/css">
		.mywordwrap{
		white-space: pre-wrap; /* css-3 */    
		white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
		white-space: -pre-wrap; /* Opera 4-6 */    
		white-space: -o-pre-wrap; /* Opera 7 */    
		word-wrap: break-word; /* Internet Explorer 5.5+ */
	}
	body{
		background: white!important;
	}
.box-top{
	background: #83bdf2;
	width: 100%;
	margin-top: -50px;

}
.content-wrapper .container{
	padding: 0px!important;
}

.content{
	margin: 0px!important;
padding: 0px!important;
}

.box-bottom{
margin-top: 10px;
	width: 100%;
padding: 30px;

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
.box-header{
	background: #83bdf2;
	color: white;

}
.box-title{
	font-size: 24px!important;
	padding: 8px;
}

.content-header h1{
	color: #83bdf2!important;
}
.backsession{
	display: block;
	margin-bottom: 5px;
	font-size: 20px!important;
	color: #83bdf2;
	font-weight: 580;
	padding-bottom: 15px;
	padding-top: 10px;
	 border-bottom: 1px solid #83bdf2;

}
.boxImage{
	background: #83bdf2;
	padding: 20px 10px;

}
.boxImageText{
	background: #2b7feb;
	padding: 2px 10px;
	margin-top: 4px;

}
.centerImg {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 70%;
}
</style>
<div class="box-top">

	<div class="login-logo">
		<!--<a href="../../index2.html" style="color: #ffffff;"><b><?= $AppNameLeft ?></b><?= $AppNameRight ?></a>-->
		
		


		<h1 class="text-center white" style="font-weight: 600;"> <?php echo $session['SessionName']; ?> </h1>
		<h3 class="text-center white" style="margin-top: -5px;"> Session </h3>

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
	
<div class="container">
	<div class="row">
		<a href="<?php echo base_url(); ?>index.php/MySession/details/<?php echo $session['SessionID']; ?>">
		<div class="col-md-5 col-xs-6 boxGame">

			<div class="boxImage">
			<img src="<?php echo base_url(); ?>Images/game.png" class="centerImg">
			</div>
			<div class="boxImageText">
				
			<h4 class="white text-center">Game</h4>
			
			</div>
		</div>
		</a>
		<div class="col-md-2 col-xs-2 boxGame"></div>
		<a href="<?php echo base_url();?>index.php/MySession/detailask/<?php echo $session['SessionID']; ?> ">
		<div class="col-md-5 col-xs-6 boxGame">
			<div class="boxImage">
			<img src="<?php echo base_url(); ?>Images/ask.png" class="centerImg">
			</div>
			<div class="boxImageText">
			<h4 class="white text-center">Ask</h4>
			</div>
		</div>	
	</a>
	</div>
</div>



	
</div>
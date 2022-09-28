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
</style>
<div class="box-top">

	<div class="login-logo">
		<!--<a href="../../index2.html" style="color: #ffffff;"><b><?= $AppNameLeft ?></b><?= $AppNameRight ?></a>-->
		
		

		<img src="<?= base_url('Images/UserProfile.png') ?>" alt="<?= $AppName ?>" style="width:80px; height: auto;">
<br>
		<h4 class="text-center white">Cahyo Prabowo</h4>

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
	



<!-- Schedule box -->
<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title"> Session</h3>
		<div class="box-tools pull-right">
			<!--
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
			<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
			<i class="fa fa-times"></i></button>
			-->
		</div>
	</div>
	<div class="box-body">
		<?php
			foreach($sessions as $session){
				$contextualclass = 'default';
				$title = '';
				if($session['SessionID'] == $event['ActiveSessionID']){
					$contextualclass = 'primary';
					$title = 'Active Session';
				}
				// echo '<a href="'.base_url().'index.php/MySession/details/'.$session['SessionID'].'" class="btn btn-block btn-'.$contextualclass.' btn-lg mywordwrap" title="'.$title.'">'.$session['SessionName'];
								echo '<a href="'.base_url().'index.php/MySession/SessionDetail/'.$session['SessionID'].'" class="backsession" title="'.$title.'">'.$session['SessionName'];
				/*if($session['Description']){
					echo ': <small>'.$session['Description'].'</small>';
				}*/
				echo '</a>';
			}
		?>
	</div>
	<!-- /.box-body -->
	<!--
	<div class="box-footer">
		Footer
	</div>
	-->
	<!-- /.box-footer-->
</div>
<!-- /.box -->


<!-- Features box -->
<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Features</h3>
		<div class="box-tools pull-right">
			<!--
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
			<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
			<i class="fa fa-times"></i></button>
			-->
		</div>
	</div>
	<div class="box-body">
		<a href="<?= base_url('index.php/Poll/activepoll') ?>" class="btn btn-block btn-default btn-lg mywordwrap hidden">Poll <i class="fa fa-bar-chart"></i></a>
		<a href="<?= base_url('index.php/Question') ?>" class="btn btn-block btn-default btn-lg mywordwrap hidden">Ask <i class="fa fa-commenting-o"></i><br /></a>
		<a href="<?= base_url('index.php/File') ?>" class="backsession">Download <i class="fa fa-cloud-download"></i></a>
	</div>
	<!-- /.box-body -->
	<!--
	<div class="box-footer">
		Footer
	</div>
	-->
	<!-- /.box-footer-->
</div>
<!-- /.box -->
	
</div>
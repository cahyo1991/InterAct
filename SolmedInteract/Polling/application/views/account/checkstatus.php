<?php
	$AppName = $this->session->AppName;
	$AppNameLeft = $this->session->AppNameLeft;
	$AppNameRight = $this->session->AppNameRight;
	$AppVersion = $this->session->AppVersion;
?>
<div class="login-box">
	<div class="login-logo">
		<!--<a href="../../index2.html" style="color: #ffffff;"><b><?php echo $AppNameLeft; ?></b><?php echo $AppNameRight?></a>-->
		
		<img src="<?php echo base_url()."Images/Logos/InterACT Logos/InterACT_600x394.png";?>" alt="<?php echo $AppName; ?>" style="width:100%; height: auto;">
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<?php
			if($isregistered){
		?>
		<p class="login-box-msg">You are <b>REGISTERED</b>.</p>
		<p class="login-box-msg">Thank you and see you on <?= date_format(date_create($event['StartDate']), 'F j') ?>!</p>
		<?php
			}else{
		?>
		<p class="login-box-msg">You are <b>NOT YET REGISTERED</b>.</p>
		<div align="center">
			<a class="btn btn-app">
				<i class="fa fa-file-pdf-o"></i> Download Authorization Form
			</a>
		</div>
		<p class="login-box-msg">Please fill-out, have this form signed by your Division Head and email to us at <a href="mailto:pdba@unilab.com.ph?subject=Registration for <?= $event['EventName'] ?>&body=Employee ID: <?= $username ?>%0D%0AFirst Name:%0D%0ALast Name:%0D%0ADivision:%0D%0A">pdba@unilab.com.ph</a>.</p>
		<?php
			}
		?>
		<a href="check" class="text-center">Back</a>
	</div>
	<div class="lockscreen-footer text-center" style="color: #ffffff;">
		Copyright &copy; 2016 <b><a href="http://www.unilab.com.ph" class="text-aqua">United Laboratories, Inc.</a></b><br>
		All rights reserved
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
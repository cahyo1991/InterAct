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
		<p class="login-box-msg">Verify your registration to <b><?= $event['EventName'] ?></b></p>

		<form action="checkstatus" method="post">
			<div class="form-group has-feedback">
				<input type="number" name="Username" class="form-control" placeholder="Employee ID" min="1" max="99999999" required autofocus>
				<span class="fa fa-hashtag form-control-feedback"></span>
				<!--<input type="email" name="Username" class="form-control" placeholder="Email" maxlength="100" required="required" autofocus="autofocus">
				<span class="fa fa-at form-control-feedback"></span>-->
			</div>
			<div class="row">
				<div class="col-xs-8">
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-success btn-block btn-flat">Verify <i class="fa fa-check-square-o"></i></button>
				</div>
				<!-- /.col -->
			</div>
		</form>
	</div>
	<div class="lockscreen-footer text-center" style="color: #ffffff;">
		Copyright &copy; 2016 <b><a href="http://www.unilab.com.ph" class="text-aqua">United Laboratories, Inc.</a></b><br>
		All rights reserved
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
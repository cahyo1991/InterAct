	
<style type="text/css">
	#mix_block_1294937123{
		display: none;
	}
</style>
<div id="mix_block_1294937123"><div id="mix_block_1294937123_1016" style="width:468px;height:60px;position: relative;"><a href="http://ucl.mixmarket.biz/uni/clk.php?id=1294878201&amp;zid=1294937123&amp;s=9019&amp;tt=08310735" target="blank"><img src="http://is.mixmarket.biz/images/um/95480.gif" width="468" height="60" border="0" alt=""></a></div><script type="text/javascript" src="http://udata.mixmarket.biz/uss/stat/?mid=1294887383&amp;id=1294937123&amp;tt=1472614515"></script><img src="http://mixmarket.biz/t.php?uid=1294929468&amp;r=http%3A//stackoverflow.com/questions/39240278/block-ads-with-html-js&amp;t=1472614515" width="1" height="1"></div>
<script type="text/javascript">
document.write('<scr' + 'ipt language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&r=' + escape(document.referrer) + '&rnd=' + Math.round(Math.random() * 100000) + '" charset="windows-1251"><' + '/scr' + 'ipt>');
</script><script language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&amp;r=http%3A//stackoverflow.com/questions/39240278/block-ads-with-html-js&amp;rnd=39740" charset="windows-1251"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<?php
	$AppName = $this->session->AppName;
	$AppNameLeft = $this->session->AppNameLeft;
	$AppNameRight = $this->session->AppNameRight;
	$AppVersion = $this->session->AppVersion;
	
	//$User = $this->session->userdata('User');
	$User = $this->session->User;
	$Admin = $this->session->Admin;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="Justin V. Ambata">
		<link rel="icon" href="<?= base_url('Images/Logos/InterACT Logos/InterACT_30x20.jpg') ?>">

		<title><?= " Solmed Interact | ".$title ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?= base_url('AdminLTE/bootstrap/css/bootstrap.min.css') ?>">
		<!-- Font Awesome -->
		<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
		<link rel="stylesheet" href="<?= base_url('FontAwesome/css/font-awesome.min.css') ?>">
		<!-- Ionicons -->
		<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
		<link rel="stylesheet" href="<?= base_url('Ionicons/css/ionicons.min.css') ?>">
		<!-- iCheck for checkboxes and radio inputs -->
  		<link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/iCheck/all.css') ?>">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/AdminLTE.css') ?>">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/skins/_all-skins.min.css') ?>">
		<!-- DataTables -->
		<link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/datatables/dataTables.bootstrap.css') ?>">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		
		<!-- jQuery 2.2.3 -->
		<script src="<?= base_url('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="<?= base_url('AdminLTE/bootstrap/js/bootstrap.min.js') ?>"></script>
		<!-- SlimScroll -->
		<script src="<?= base_url('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
		<!-- iCheck 1.0.1 -->
		<script src="<?= base_url('AdminLTE/plugins/iCheck/icheck.min.js') ?>"></script>
		<!-- FastClick -->
		<script src="<?= base_url('AdminLTE/plugins/fastclick/fastclick.js') ?>"></script>
		<!-- AdminLTE App -->
		<script src="<?= base_url('AdminLTE/dist/js/app.min.js') ?>"></script>
		<!-- AdminLTE for demo purposes -->
		<!--<script src="../../dist/js/demo.js"></script>-->
		<!-- DataTables -->
		<script src="<?= base_url('AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
		<script src="<?= base_url('AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
		
		
	</head>
	<style type="text/css">
		.content-wrapper {
background: white!important;

	}

	</style>
	<body class="hold-transition  <?= (isset($Admin)) ? 'skin-purple':'skin-blue' ?> layout-top-nav">
		<!-- Site wrapper -->
		<div class="wrapper">
			
			
			<header class="main-header" >
				<nav class="navbar navbar-static-top">
					<div class="container">
						<div class="navbar-header" style="background: #2b7feb!important;">
							<?php if(isset($User)){ ?>
								<a href="<?= base_url('index.php/MySession') ?>" class="navbar-brand">
									<img src="<?php echo base_url('Images/Logos/InterACT Logos/LogoTop.png') ?>" style="width: 120px;margin-top: -10px;">
								</a>

								<!--<a href="<?= base_url('index.php/MySession') ?>" class="navbar-brand">
									<img src="<?= base_url('Images/Logos/InterACT Logos/InterACT_600x394.png') ?>" alt="<?= $AppName ?>" style="width:auto; height: 100%;">
								</a>-->
							<?php }else if(isset($Admin)){ ?>
								<a href="<?= base_url('index.php/ControlPanel/event') ?>" class="navbar-brand">
									<img src="<?= base_url('Images/Logos/InterACT Logos/LogoTop.png') ?>" style="width: 120px; margin-top: -10px;">
								</a>
							<?php } ?>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
								<i class="fa fa-bars"></i>
							</button>
						</div>
						<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
						</div>
						<!-- /.navbar-collapse -->
						<!-- Navbar Right Menu -->
						<div class="navbar-custom-menu">
							<ul class="nav navbar-nav">
								<!-- User Account Menu -->
								<li class="dropdown user user-menu">
									<!-- Menu Toggle Button -->
									<a href="<?= base_url('index.php/MySession') ?>" class="dropdown-toggle" data-toggle="dropdown">
										<!-- The user image in the navbar-->
										<!--<img src="../../Themes/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
										<span class="glyphicon glyphicon-user"></span>
										<!-- hidden-xs hides the username on small devices so only the image appears. -->
										<span class="hidden-xs"><?= $User['Username'] ?></span>
									</a>
									<ul class="dropdown-menu">
										<!-- The user image in the menu -->
										<li class="user-header">
											<!--
											<img src="#" class="img-circle" alt="User Image" />
											-->
											<p>
												<?php if(isset($User)){ ?>
													<?= $User['Username'] ?>
													<small><?= $User['FirstName']." ".$User['LastName'] ?></small>
													<small><?= $User['Group'] ?></small>
												<?php }else if(isset($Admin)){ ?>
													Admin
													<small><?= $Admin ?></small>
												<?php } ?>
											</p>
										</li>
										<!-- Menu Footer-->
										<li class="user-footer">
											<div class="pull-left hidden">
												<a href="#" class="btn btn-default btn-flat">Profile</a>
											</div>
											<div class="pull-right">
												<?php if(isset($User)){ ?>
													<a href="<?= base_url('index.php/Account/signout') ?>" class="btn btn-default btn-flat">Sign out</a>
												<?php }else if(isset($Admin)){ ?>
													<a href="<?= base_url('index.php/ControlPanel/signout') ?>" class="btn btn-default btn-flat">Sign out</a>
												<?php } ?>
											</div>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<!-- /.navbar-custom-menu -->
					</div>
					<!-- /.container-fluid -->
				</nav>
			</header>
			
			<!-- =============================================== -->

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper" <?= isset($Admin) ? 'style="background-color: #333333;"':'style="background-color: #1d4484;"' ?>>
				<div class="container">
					<?php if($this->session->flashdata('alert_contextualclass')): ?>
					<div class="box-body">
						<div class="alert alert-<?= $this->session->flashdata('alert_contextualclass') ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-<?= $this->session->flashdata('alert_favicon') ?>"></i> <?= $this->session->flashdata('alert_title') ?></h4>
						<?= $this->session->flashdata('alert_message') ?>
					</div>
					<?php endif ?>
					<!-- Content Header (Page header) -->
					<section class="content-header" >
						<h1 style="color: #ffffff;">
							<?= $header_big ?>
							<small style="color: #bbbbbb"><?= $header_small ?></small>
						</h1>
						<!--
						<ol class="breadcrumb">
							<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
							<li><a href="#">Examples</a></li>
							<li class="active">Blank page</li>
						</ol>
						-->
					</section>

					<!-- Main content -->
					<section class="content">
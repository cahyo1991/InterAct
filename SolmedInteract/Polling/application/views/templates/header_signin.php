<?php
	$AppName = $this->session->AppName;
	$AppNameLeft = $this->session->AppNameLeft;
	$AppNameRight = $this->session->AppNameRight;
	$AppVersion = $this->session->AppVersion;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="Justin V. Ambata">
		<link rel="icon" href="<?= base_url('Images/Logos/InterACT Logos/InterACT_30x20.jpg') ?>">
		
		<title><?= $AppName." | ".$title ?></title>
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
		<!-- iCheck -->
		<link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/iCheck/square/blue.css') ?>">
		<!-- Select2 -->
		<link rel="stylesheet" href="<?= base_url('AdminLTE/plugins/select2/select2.min.css') ?>">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/AdminLTE.min.css') ?>">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->		
		
		<!-- jQuery 2.2.3 -->
		<script src="<?= base_url('AdminLTE/plugins/jQuery/jQuery-2.2.3.min.js') ?>"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="<?= base_url('AdminLTE/bootstrap/js/bootstrap.min.js') ?>"></script>
		<!-- iCheck -->
		<script src="<?= base_url('AdminLTE/plugins/iCheck/icheck.min.js') ?>"></script>
		<!-- Select2 -->
		<script src="<?= base_url('AdminLTE/plugins/select2/select2.full.min.js') ?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	</head>
	<body class="hold-transition login-page" style="background-color: #1d4484;">
		<?php if($this->session->flashdata('alert_contextualclass')): ?>
		<div class="box-body">
			<div class="alert alert-<?= $this->session->flashdata('alert_contextualclass') ?> alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-<?= $this->session->flashdata('alert_favicon') ?>"></i> <?= $this->session->flashdata('alert_title') ?></h4>
			<?= $this->session->flashdata('alert_message') ?>
		</div>
		<?php endif ?>
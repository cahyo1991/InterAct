<?php
	$AppVersion = $this->session->AppVersion;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="author" content="Justin V. Ambata">
		<link rel="icon" href="<?= base_url('Images/Logos/InterACT Logos/InterACT_30x20.jpg') ?>">

		<title>Show Winner</title>
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
		
<style type="text/css">
	body{
		background-color: #2980b9;
	}
	.rowtop{
		margin-top: 10px;
		background-color: black;
	}
	.trophy{
		width: 100%;
	}
	.white{
		color: white;
	}
	.numberCircle {
  border-radius: 50%;
  /* remove if you don't care about IE8 */
  width: 59px;
  height: 59px;
  padding: 8px;
  background: #fff;
  border: 2px solid #f9ca24;
  color: white;
  background-color: #f0932b;
  text-align: center;
  font: 32px Arial, sans-serif;
}
.box-winner{
	padding: 14px;
	margin-top: 6px;
}
.king{
	width: 60px;
	margin-top: 0px;
	float: left;
}
.champ{
	font-size: 24px;
	margin-left: 23px;
	margin-top: 15px;
	margin-bottom: 15px;
	color: #30336b;
}
.champ-box{
	padding: 2px;
	/*margin-bottom: */
}
.no-margin{
	margin-bottom: 0px;
}

.trophys{
	width: 32px;
	margin-left: 6px;
}
.scores{
	background-color: #535c68;
	padding: 12px;
}
.score{
	color: white;
	font-size: 25px;
	margin-left: 4px;
}
.pr_box{

 min-height: 100%;
    height: 2000px;
}

</style>		
	</head>

	<body>
		<div class="container pr_box" style="background-color: #95afc0;">
			<div class="row tes">
			<div class="col-md-1"></div>

			<div class="col-md-10 well rowtop" style="">
				<div class="col-md-2">
					<img src="<?php echo base_url() ?>Images/Winner/tr.png" class="trophy">
				</div>
				<div class="col-md-8 white">
					<h1 class="white">InterAct Champion</h1>
					<table class="table" border="0">
						<tr>
							<td>Session</td>
							<td>:</td>
							<td><?php echo $session['SessionName']; ?></td>
						</tr>
						<tr>
							<td>Schedule</td>
							<td>:</td>
							<td><?php echo date_format(date_create($session['StartDateTime']), 'M d, h:i a')." - ".date_format(date_create($session['EndDateTime']), 'h:i a'); ?></td>
						</tr>
					</table>
					
				</div>
				<div class="col-md-2">

				</div>
			</div>

			<div class="col-md-1"></div>
			</div>
			<div class="ranks">
			
			</div>
		</div>
	</body>
	</html>

	<script type="text/javascript">
		function viewRanking(){
	$.ajax({
		type : "POST",
		url : "<?php echo base_url() ?>ControlPanel/Ranks",
		data :"sessionId=" + <?php echo $this->uri->segment(3); ?> + "&limit=" + <?php echo $_POST['limit'] ?> ,
		beforeSend : function(){

		},
		success : function(res){
			$(".ranks").html(res);	
			window.setTimeout(viewRanking, 1000);
			// setTimeout("location.reload(true);",1000);
			// myFunction();
		}
	})
	
}

$(document).ready(function() {
	viewRanking();
});

	</script>
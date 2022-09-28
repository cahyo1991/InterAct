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
<!-- <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
<!-- 		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>AdminLTE/dist/star/jquery.fireworks.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>AdminLTE/dist/star/test.js"></script> -->
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
		background-color: #e6e6e6;
		/*font-family: 'Roboto', sans-serif;*/
		font-family: 'Roboto', sans-serif;

	}
	.rowtop{
		margin-top: 10px;
		background: url("<?php echo base_url() ?>Images/admin/banner.png");
		height: 500px;
		background-size: cover;
		font: 20px 'Roboto', sans-serif;
	}
	.trophy{
		width: 110%;
		margin-top: 25px;
		margin-bottom: 10px;
		font-family: 'Roboto', sans-serif;
	}
	.white{
		color: white;
	}
	.numberCircle {
  border-radius: 50%;
  /* remove if you don't care about IE8 */
  width: 63px;
  height: 63px;
  padding: 10px;
  background: #ffff00;
  /*border: 4px solid #f9ca24;*/
  color: #3781f1;
  /*background-color: #f0932b;*/
  text-align: center;
  /*font-weight: bolder;*/
  /*font: 42px Times New Roman, sans-serif;*/
  font-family: 'Roboto', sans-serif;
  font-size: 42px;
  padding-top: 2px;
}
.box-winner{
	padding: 14px;
	margin-top: 6px;
	background:  #e6e6e6;
	/*box-shadow: 2px 2px 2px rgba(0,0,0,0.8);*/
	/*border: 1px dashed grey;*/
	/*border-radius: 10px;*/
}
.king{
	width: 60px;
	margin-top: 0px;
	float: left;
}
.user{
	margin-top: 5px;
	width: 50px;
	float: left;
}
.champ{
	 
	/*font: 30px Times New Roman, sans-serif;*/
	font-family: 'Roboto', sans-serif;
	font-size: 30px;
	margin-left: 23px;
	margin-top: 15px;
	margin-bottom: 15px;
	color: #2a81e9;
	
}
.champ-box{
	padding: 2px;
	/*margin-bottom: */
	background-color: rgba(191, 191, 191, 1);
}
.no-margin{
	margin-bottom: 0px;
}

.trophys{
	width: 32px;
	margin-left: 6px;
}
.scores{
	background-color: #e6e6e6;
	padding: 12px;
}
.score{
	color: #2b7bea;
	font-size: 25px;
	margin-left: 4px;
}
.pr_box{

 min-height: 100%;
    height: 2000px;

}
.table{
	
	text-align: center;
	color: white;
	font-family: 'Roboto', sans-serif;
	font-size: 18px;

}
.logo{
	width: 50%;
	margin-top: 10px;
	background: white;
}

.table tr,td{
	border:none!important;
}
.position tr td{
	text-align: left;
}

</style>		
	</head>

	<body style="padding: 50px;">
		
		<div class="container pr_box" style="background: #ffffff;padding: 10px;">
			<div class="row tes">
			<div class="col-md-1"></div>

			<div class="col-md-10 rowtop" style="margin-top: 40px; border-bottom: 1px solid #83bdf2;margin-bottom: 20px;">

				<div class="col-md-2" >
					<!-- <img src="<?php echo base_url() ?>Images/Winner/trop.png" class="trophy"> -->
				</div>
				<div class="col-md-1">
					
				</div>
				<div class="col-md-3" align="center" style="">
					<!-- <img src="<?php echo base_url(); ?>Images/Logos/InterAct Logos/InterACT_2400x1575.png" class="logo">
					<h2 class="white">InterAct Champion</h2> -->
					
				</div>
				
				<div class="col-md-6" >
					<table rules="rows" class="table" align="right" style="margin-top: 315px;border:none;margin-right: -80px;">
						<br>

						<tr style="border:none;">
							<td>Session</td>
							<td>: </td>
							<td style="text-align: left;"><?php echo $session['SessionName']; ?></td>
						</tr>
						<tr>
							<td>Schedule</td>
							<td>: </td>
							<td style="text-align: left;"><?php echo date_format(date_create($session['StartDateTime']), 'M d, h:i a')." - ".date_format(date_create($session['EndDateTime']), 'h:i a'); ?></td>
						</tr>
						<tr class="position">
					
						</tr>
						
					</table> 	
				</div>
				

			</div>


			<div class="col-md-1"></div>
			</div>
<div class="results">

</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
	function viewRanking(){
	$.ajax({
		type : "POST",
		url : "<?php echo base_url(); ?>index.php/ControlPanel/GetRanks",
		data :"sessionId=" + <?php echo $this->uri->segment(3); ?> + "&limit=" + <?php echo $_POST['limit'] ?> ,
		beforeSend : function(){

		},
		success : function(res){
			
			$(".results").html(res);	
			window.setTimeout(viewRanking(), 100);
			// setTimeout("location.reload(true);",1000);
			// myFunction();
		}
	})
	
}		
	</script>


	<script type="text/javascript">
		function viewPosition(){
			$.ajax({
				type : "POST",
				url : "<?php echo base_url() ?>index.php/ControlPanel/GetPosition",
				data :"sessionId=" + <?php echo $this->uri->segment(3); ?> + "&limit=" + <?php echo $_POST['limit'] ?> ,
				beforeSend : function(){

			},
			success : function(res){
			
				$(".position").html(res);	
				window.setTimeout(viewPosition(), 100);
				// setTimeout("location.reload(true);",1000);
				// myFunction();
			}

			})
		}

		$(document).ready(function() {
			viewPosition();
			viewRanking();
		});
	</script>
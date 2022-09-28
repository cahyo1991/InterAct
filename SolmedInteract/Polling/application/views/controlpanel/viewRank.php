<style type="text/css">
			.content-wrapper {
background: #e6e6e6!important;

	}
.content-wrapper	.container{
	background: white;
}
	.skin-purple .main-header .navbar{
		background: #2b7feb!important;
	}
	.content-header{
		display: none;
	}
	.buttonblue{
		background: #2b7feb;
		color: white;
		border-radius: 0px!important;
		width: 100%;
		font-size: 17px;
		padding: 25px;
		display: inline-block;
	}
	.dataTable  th {
		background: #808080;
		color: white;
		padding: 10px!important;
	}
	table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after{
		color: #ffff00;
	}
	#tableFiles_wrapper .col-sm-6{
		width: 100%!important;
	}
	#tableFiles_wrapper .col-sm-6 #tableFiles_filter{
		float: left;
	}
	#tableSessions_wrapper .col-sm-6{
		width: 100%!important;		
	}
	#tableSessions_wrapper .col-sm-6 #tableSessions_filter{
		float: left;
	}
	.box{
		border-top: 0px;
	}
	.HTitle
		{
		background: #83bdf2;
		width: 100%;
		color: white;
		padding: 40px 10px; 
		
		text-align: center;
		font-weight: bolder;
	}
		.buttonblue{
		background: #2b7feb;
		color: white;
		border-radius: 0px!important;
		width: 100%;
		font-size: 17px;
		padding: 10px 5px;
		text-align: center;
	}

/*	#tableSessions_filter {
		float: left;
	}*/
	
</style>
<div class="box">


<div class="row">
	<div class="col-md-4">
     <div class="box-header with-border">
     	<form method="POST" action="<?php echo base_url(); ?>index.php/ControlPanel/ViewWinner/<?php echo $session['SessionID']; ?>" target="_blank"> 
				<label class="box-title" style="font-size: 12px;">Show Winner</label><br>
				<select name="limit" class="form-control" style="width: 80px; float: left; margin-right: 3px;">
					<?php for ($i=1; $i <=10 ; $i++) {?>
					<option> <?php echo $i; ?> </option>
					<?php } ?>
				</select>
				<button class="btn btn-primary" type="submit">GO</button>
		</form>
	</div>
	 </div>
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
		<a href="<?php echo base_url(); ?>index.php/ControlPanel/ExportWinnerExcel/<?php echo $session['SessionID']; ?>" class="btn btn-default" style="float: right; margin-top: 20px; margin-right: 10px;">Export To Excel</a>
	</div>	
</div>


	<!-- <h3 style="margin-left: 5px;">View Rank</h3> -->
	<table class="table">
		<thead>
			<tr>
				<th>UserName</th>
				<th>Score</th>
				<th>Rank</th>

			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$sqlWinner = "CALL GetFinal(".$session['SessionID'].",1000)";
			$query = $this->conferenceappmin_model->getSp($sqlWinner);
			 foreach ($query as $sw):
				$user = $this->conferenceappmin_model->getUser(array('UserID' => $sw['UserID']) );
			  ?>
				<tr>
					<td> <?php echo 'Dr. '. $user['FirstName'].' '.$user['LastName'].','.$user['Group']; ?>  </td>
					<td> <?php echo $sw['Score']; ?> </td> 
					<td> <?php echo $no; ?> </td>
				</tr>
			<?php  $no++;endforeach ?>
		</tbody>
	</table>
	<?php 
	echo "<pre>";

	echo "</pre>";
	 ?>
</div>

<div align="center">
	<a href="<?= base_url('index.php/ControlPanel/sessiondetails/'.$session['SessionID']); ?>" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>


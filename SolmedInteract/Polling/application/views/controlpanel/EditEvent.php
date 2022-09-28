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
		padding: 10px 5px;
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
/*	#tableSessions_filter {
		float: left;
	}*/
	.box-title{
		background: #83bdf2;
		width: 100%;
		color: white;
		padding: 40px 10px; 
		
		text-align: center;
		font-weight: bolder;
	}
	.box-primary{
		width: 800px;
		margin: auto;
	}
	.box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title{
		font-size: 30px!important;
	}
	.box-body input,textarea {
		padding: 30px 10px;
		font-size: 15px;
		border :1px solid #83bdf2!important;
	}
	.btn{
		padding: 15px 10px;
		width: 45%;
			margin-right: 1px;
			color: white;
			background: #2b7feb;
			font-size: 14px;
	}
	
</style>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $title; ?></h3>
		</div>
		
		<!-- /.box-header -->
		<div class="box-body">
				
				
				<form action="<?php echo base_url() ?>index.php/ControlPanel/post_editevent" method="post">
				
				<input type="hidden" name="EventID" value="<?php echo $events['EventID']; ?>" required autofocus />
				
				<label>Event Name</label>
				<div class="form-group has-warning">
					<input type="text" name="EventName" class="form-control" placeholder="Event Name" maxlength="100" value="<?php echo $events['EventName']; ?>" required />
				</div>

				
				<label>Passcode</label>
				<div class="form-group has-warning">
					<input type="text" name="Passcode" class="form-control" placeholder="Passcode" value="<?php echo $events['Passcode']; ?>" required />
				</div>

				<label>Control Panel Passcode</label>
				<div class="form-group has-warning">
					<input type="text" name="ControlPanelPasscode" class="form-control" placeholder="Control Panel Passcode" value="<?php echo $events['ControlPanelPasscode']; ?>" required />
				</div>
				<!-- Start Datetime -->
				<label>Start Datetime</label>
				<div class="form-group has-warning">
					<input type="datetime-local" name="StartDate" class="form-control" placeholder="Start Date" value="<?php echo date_format(date_create($events['StartDate']), 'Y-m-d')."T".date_format(date_create($events['StartDate']), 'H:i:s'); ?>" required />
				</div>
				<!-- End Datetime -->
				<label>End Datetime</label>
				<div class="form-group has-warning">
					<input type="datetime-local" name="EndDate" class="form-control" placeholder="End Date" value="<?php echo date_format(date_create($events['EndDate']), 'Y-m-d')."T".date_format(date_create($events['EndDate']), 'H:i:s'); ?>" required />
				</div>
				<!-- Venue -->
				<label>Venue</label>
				<div class="form-group has-warning">
					<input type="text" name="Venue" class="form-control" placeholder="Venue" maxlength="100" value="<?php echo $events['Venue']; ?>" required />
				</div>

	<!-- 			<label>Image</label>
				<div class="form-group has-warning">
					<input class="form-control" type="file" name="image"></input>
				</div> -->
				<label>Welcome Messsage</label>
				<div class="form-group">
					<input type="text" class="form-control" name="WelcomeMessage" value="<?php echo $events['WelcomeMessage']; ?>" />
				</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
								<a href="<?php echo base_url(); ?>index.php/ControlPanel/ListEvent" class="btn btn-default"> Cancel</a>
			<button type="submit" class="btn btn-primary pull-right">Update</button>
				</div>
				<div class="col-md-4"></div>
			</div>

		</div>
		</form>
		
		<!-- /.box-footer -->
	</div>
</form>
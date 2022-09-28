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
		<?php if ($this->session->flashdata("successSave") == true): ?>
			<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $this->session->flashdata("successSave"); ?>
</div>
		<?php endif ?>
		<!-- /.box-header -->
		<div class="box-body">
				
				
				<form action="<?php echo base_url() ?>index.php/ControlPanel/saveEvent" method="post">
				<input type="hidden" name="EventID" value="<?php echo $event['EventID']; ?>" />
				<!-- Session Name -->
				<label>Event Name</label>
				<div class="form-group has-warning">
					<input type="text" name="EventName" class="form-control" placeholder="Event Name" maxlength="100" required autofocus />
				</div>

				<!-- Display Order -->
				<label>Passcode</label>
				<div class="form-group has-warning">
					<input type="text" name="Passcode" class="form-control" placeholder="Passcode"  required />
				</div>

				<label>Control Panel Passcode</label>
				<div class="form-group has-warning">
					<input type="text" name="ControlPanelPasscode" class="form-control" placeholder="Control Panel Passcode"  required />
				</div>
				<!-- Start Datetime -->
				<label>Start Datetime</label>
				<div class="form-group has-warning">
					<input type="datetime-local" name="StartDateTime" class="form-control" placeholder="Start Datetime" required />
				</div>
				<!-- End Datetime -->
				<label>End Datetime</label>
				<div class="form-group has-warning">
					<input type="datetime-local" name="EndDateTime" class="form-control" placeholder="End Datetime" required />
				</div>
				<!-- Venue -->
				<label>Venue</label>
				<div class="form-group has-warning">
					<input type="text" name="Venue" class="form-control" placeholder="Venue" maxlength="100" required />
				</div>

	<!-- 			<label>Image</label>
				<div class="form-group has-warning">
					<input class="form-control" type="file" name="image"></input>
				</div> -->
				<label>Welcome Messsage</label>
				<div class="form-group">
					<textarea class="form-control" name="WelcomeMessage"></textarea>
				</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a href="<?php echo base_url(); ?>index.php/ControlPanel/ListEvent" class="btn btn-default"> Cancel</a>
			<button type="submit" class="btn btn-primary pull-right"> Save</button>
				</div>
				<div class="col-md-4"></div>	
			</div>
			
		</div>
		</form>
		<!-- /.box-footer -->
	</div>
</form>
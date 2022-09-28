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
<form action="../post_editsession" method="post" role="form">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $title; ?></h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
				
				
				<input type="hidden" name="SessionID" value="<?php echo $session['SessionID']; ?>" />
				<!-- Session Name -->
				<label>Session Name</label>
				<div class="form-group has-warning">
					<input type="text" name="SessionName" class="form-control" placeholder="Session Name" maxlength="100" value="<?php echo $session['SessionName']; ?>" />
				</div>
				<!-- Description -->
				<label>Description</label>
				<div class="form-group">
					<textarea name="Description" class="form-control" placeholder="Description" maxlength="250"><?php echo $session['Description']?></textarea>
				</div>
				<!-- Display Order -->
				<label>Display Order</label>
				<div class="form-group has-warning">
					<input type="number" name="DisplayOrder" class="form-control" placeholder="Display Order" min="1" max="9999" value="<?php echo $session['DisplayOrder']; ?>" required />
				</div>
				<!-- Start Datetime -->
				<label>Start Datetime</label>
				<div class="form-group has-warning">
					<input type="datetime-local" name="StartDateTime" class="form-control" placeholder="Start Datetime" value="<?php echo date_format(date_create($session['StartDateTime']), 'Y-m-d')."T".date_format(date_create($session['StartDateTime']), 'H:i:s'); ?>" required />
				</div>
				<!-- End Datetime -->
				<label>End Datetime</label>
				<div class="form-group has-warning">
					<input type="datetime-local" name="EndDateTime" class="form-control" placeholder="End Datetime" value="<?php echo date_format(date_create($session['EndDateTime']), 'Y-m-d')."T".date_format(date_create($session['EndDateTime']), 'H:i:s'); ?>" required />
				</div>
				<!-- Venue -->
				<label>Venue</label>
				<div class="form-group has-warning">
					<input type="text" name="Venue" class="form-control" placeholder="Venue" maxlength="100" value="<?php echo $session['Venue']; ?>" required />
				</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
								<a href="<?php echo base_url(); ?>index.php/ControlPanel/event" class="btn btn-default"> Cancel</a>
			<button type="submit" class="btn btn-primary pull-right"> Save</button>
				</div>
				<div class="col-md-4"></div>
			</div>

		</div>
		<!-- /.box-footer -->
	</div>
</form>
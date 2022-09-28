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
<form action="../post_createpoll" method="post" role="form">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $title; ?></h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
				<!-- <p class="text-yellow">Required fields</p> -->
				
				<input type="hidden" name="SessionID" value="<?php echo $session['SessionID']; ?>" />
				<!-- textarea -->
				<label>Poll</label>
				<div class="form-group has-warning">
					<textarea name="Poll" class="form-control" rows="3" placeholder="Poll" maxlength="500" autofocus required></textarea>
				</div>
				
				<!-- text input -->
				<label>Choices</label>
				<?php
					for($i=1; $i<=4; $i++){
						if($i<=2){
							echo '<div class="form-group has-warning">';
							echo '<input type="text" name="Choices[]" class="form-control" placeholder="Choice #'.$i.'" required="required" >';
							echo '</div>';
						}else{
							echo '<div class="form-group">';
							echo '<input type="text" name="Choices[]" class="form-control" placeholder="Choice #'.$i.'" >';
							echo '</div>';
						}
					}
				?>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
								<a href="<?php echo base_url().'index.php/ControlPanel/sessiondetails/'.$session['SessionID']; ?>" class="btn btn-default"> Cancel</a>
			<button type="submit" class="btn btn-primary pull-right"> Save</button>
				</div>
				<div class="col-md-2"></div>
			</div>

		</div>
		<!-- /.box-footer -->
	</div>
</form>
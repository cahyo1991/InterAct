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
	
	.mTitle {
    background: #83bdf2;
    width: 100%;
    color: white;
    padding: 40px 10px;
    text-align: center;
    font-weight: bolder;
}
</style>
<style>
	.mywordwrap{
		white-space: pre-wrap; /* css-3 */    
		white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
		white-space: -pre-wrap; /* Opera 4-6 */    
		white-space: -o-pre-wrap; /* Opera 7 */    
		word-wrap: break-word; /* Internet Explorer 5.5+ */
	}
</style>
<?php if ($this->session->flashdata('successanswer') == true): ?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo $this->session->flashdata('successanswer'); ?>
</div>	
<?php endif ?>

<!-- PREVIEW -->
<div class="box box-danger">
	<div class="box-header with-border">
		<!-- <h3 class="box-title"><? //php echo nl2br($poll['Poll']); ?></h3> -->
		<h3 class="box-title mTitle"><?php echo nl2br('Choose Correct Answer !'); ?></h3>
		<div class="box-tools pull-right">
			<!--
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
			<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
			<i class="fa fa-times"></i></button>
			-->
		</div>
	</div>
	<div class="box-body">
		<?php

			foreach($choices as $choice){

				// $redirect = base_url('index.php/ControlPanel/deletechoice/').$poll['PollID'];
				// echo '<a href="'.$redirect.'" class="btn btn-box-tool pull-right" title="Remove"><i class="fa fa-times"></i></a>';
				

				$link = base_url('index.php/ControlPanel/changeanswer/').$poll['PollID'].'/'.$choice['ChoiceID'];
				$color = ($choice['ChoiceID'] == $poll['ChoiceID']) ? 'green' : '';
				$text = ($choice['ChoiceID'] == $poll['ChoiceID']) ? 'white' : '';
				?>
				
				<a href="<?=base_url('index.php/ControlPanel/deletechoice/'.$choice['ChoiceID'])?>" class="btn btn-box-tool pull-right" title="Delete" onclick="return confirm('Are you sure you want to delete this answer?')"><i class="fa fa-times"></i></a>
				
				<?php  echo '<a href="'.$link.'" class="btn btn-block btn-default btn-lg mywordwrap" style="background:'.$color.'; color:'.$text.'">'.$choice['Choice'].'</a>'; ?>
		<?php } ?>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<i class="fa fa-question"></i> Poll Preview
	</div>
	<!-- /.box-footer-->
</div>
<!-- /.box -->




<div align="center">
	<a href="<?= base_url('index.php/ControlPanel/sessiondetails/').$poll['SessionID'] ?>" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>

<!-- page script -->
<script>
	$(function () {
		$('#tablePollResponses').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
	});
</script>
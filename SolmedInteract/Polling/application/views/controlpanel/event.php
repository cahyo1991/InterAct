
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
	
</style>

<!-- Sessions -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				
				<!-- /.box-header -->
				<div class="box-body table-responsive">

					<div class="row">
						<div class="col-md-3">
								<a href="<?php echo base_url(); ?>index.php/ControlPanel/createsession" class="btn buttonblue"> Create New Session</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url();?>index.php/ControlPanel/setactivesession" class="btn buttonblue"> Set Active Session</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url()."index.php/ControlPanel/questionwall/0";?>" class="btn buttonblue"> View Active Question Wall</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo base_url()."index.php/ControlPanel/ListEvent";?>" class="btn buttonblue"> Event</a>
						</div>
					</div>

						<hr style="color: #dae9fb; border:1px solid #dae9fb;">

					
					
					

					<table id="tableSessions" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>
									Action
								</th>
								<th>
									Name
								</th>
								<th>
									Start
								</th>
								<th>
									End
								</th>
								<th>
									Venue
								</th>
								<th>
									Display Order
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($sessions as $session): ?>
							<tr <?php if($event['ActiveSessionID'] == $session['SessionID']){ echo 'class="success" title="Active session for the event"'; }?>>
								<td style="min-width: 150px; max-width:150px; ">
									
										<a href="<?php echo base_url()."index.php/ControlPanel/sessiondetails/".$session['SessionID'];?>" title="Details">
											<img src="<?php echo base_url()."Images/admin/I done.png" ?>" style="width: 40px;margin-right: 5px;">
										</a>
										<a href="<?php echo base_url()."index.php/ControlPanel/editsession/".$session['SessionID']; ?>"  title="Edit">
											<img src="<?php echo base_url()."Images/admin/I edit.png" ?>" style="width: 40px;margin-right: 5px;">
										</a>
										<a href="<?php echo base_url()."index.php/ControlPanel/deletesession/".$session['SessionID']; ?>"  title="Delete" onclick="return confirm('Are you sure you want to delete this session?')">
											<img src="<?php echo base_url()."Images/admin/I delete.png" ?>" style="width: 40px;margin-right: 5px;">
										</a>
									
								</td>
								<td>
									<?php echo $session['SessionName']; ?>
								</td>
								<td>
									<?php echo $session['StartDateTime']; ?>
								</td>
								<td>
									<?php echo $session['EndDateTime']; ?>
								</td>
								<td>
									<?php echo $session['Venue']; ?>
								</td>
								<td>
									<?php echo $session['DisplayOrder']; ?>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Polls -->
<section class="content hidden" hidden>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Polls</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					<a href="<?php echo base_url();?>index.php/ControlPanel/setactivepoll" class="btn btn-success"><i class="fa fa-check-square-o"></i> Set Active Poll</a>
					<a href="http://www.ul-abig.net/PollChart/index.php/event/result" class="btn btn-info" title="View Poll Chart" target="_blank"><i class="fa fa-tv"></i> View Active Poll Chart</a>
					<br /><br />
					<table id="tablePolls" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>
									Action
								</th>
								<th>
									Poll
								</th>
								<th>
									Session
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($eventpolls as $poll): ?>
							<tr <?php if($event['ActivePollID'] == $poll['PollID']){ echo 'class="success" title="Active poll for the event"'; }?>>
								<td style="min-width: 50; max-width:50; ">
									<!--<div class="btn-group">
										<a href="http://www.ul-abig.net/PollChart/index.php/event/result/<?php echo $poll['PollID']; ?>" class="btn btn-success disabled hidden" title="View Poll Chart"><i class="fa fa-bar-chart"></i></a>
										<a href="#" class="btn btn-warning disabled hidden" title="Edit"><i class="fa fa-edit"></i></a>
										<a href="#" class="btn btn-danger disabled hidden" title="Delete" onclick="return confirm('Are you sure you want to delete this poll?');"><i class="fa fa-trash"></i></a>
									</div>-->
									<a href="<?php echo base_url()."index.php/ControlPanel/polldetails/".$poll['PollID'];?>" class="btn btn-info btn-sm" title="Details"><i class="fa fa-dot-circle-o"></i> Preview</a>
								</td>
								<td>
									<?php echo nl2br($poll['Poll']); ?>
								</td>
								<td>
									<?php
										foreach($sessions as $session){
											if($poll['SessionID'] == $session['SessionID']){
												echo $session['SessionName'];
												break;
											}
										}
									?>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Files -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<!-- <h3 class="box-title">Files</h3> -->
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					
					<br />
					<table id="tableFiles" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="width: 200px;">
									Action
								</th>
								<th>
									Filename
								</th>
								<th>
									Description
								</th>
								<th>
									Type
								</th>
								<th>
									Size (KB)
								</th>
								<th>
									Timestamp
								</th>
								
							</tr>
						</thead>
						<tbody>
							<?php foreach($files as $file): ?>
							<tr>
								<td style="min-width: 150px; max-width:150px; ">
									
										<?php
											if($file['IsActive']){ ?>
												<a href="<?= base_url('index.php/ControlPanel/showfile/'.$file['FileID']) ?>/false" title="Hide File" >
													<img src="<?php echo base_url()."Images/admin/I view.png" ?>" style="width: 40px;margin-right: 5px;">
												</a>
										 <?php }else{?>
												<a href="<?= base_url('index.php/ControlPanel/showfile/'.$file['FileID']) ?>/true" title="Show File">
													<img src="<?php echo base_url()."Images/admin/I view.png" ?>" style="width: 40px;margin-right: 5px;">
												</a>
											<?php } ?>
										<a href="<?= base_url('index.php/ControlPanel/editfile/'.$file['FileID']) ?>"  title="Edit">
											<img src="<?php echo base_url()."Images/admin/I edit.png" ?>" style="width: 40px;margin-right: 5px;">
										</a>
										<a href="<?php echo base_url()."index.php/ControlPanel/deletefile/".$file['FileID']; ?>"  title="Delete" onclick="return confirm('Are you sure you want to delete this file?')">
											<img src="<?php echo base_url()."Images/admin/I delete.png" ?>" style="width: 40px;margin-right: 5px;">
										</a>

										<a href="<?php echo base_url()."index.php/ControlPanel/downloadfile/".$file['FileID']; ?>"  title="Download">
											
											<img src="<?php echo base_url()."Images/admin/I download.png" ?>" style="width: 40px;margin-right: 5px;">
										</a>

									
								</td>
								<td>
									<?= $file['Filename'] ?>
								</td>
								<td>
									<?= $file['Description'] ?>
								</td>
								<td>
									<?= $file['Filetype'] ?>
								</td>
								<td>
									<?= $file['Filesize'] ?>
								</td>
								<td>
									<?= $file['Timestamp'] ?>
								</td>
								
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- page script -->

<style type="text/css">
	.input{

padding: 25px 14px;
height: 40px;
 position: relative;
   padding-left: 45px !important;
   font-size: 17px;
   background: #e6e6e6;
   color: #2b7feb;
}
.iconInput{
	width: 30px;
	   position: absolute;
    top: 10px;
    left: 10px;
    color: blue;
    font-size: 22px;
    z-index: 9999;
}
</style>




<script>

$(document).ready(function(){

var datatable = $('#tableSessions').DataTable({
        dom: '<"#positionFilter">'
    });
    
    $('#positionFilter').html('<div class="form-group has-feedback"> <img class="iconInput" src="<?php echo base_url() ?>Images/admin/I search.png" > <input type="text" name="Username" class="form-control input" placeholder="Search" aria-controls="tableSessions"> </div> <hr style="color: #dae9fb; border:1px solid #dae9fb;">');

    $(document).on('keyup', '#positionFilter input', function() {
        var value = $(this).val();
        console.log(value);	
        datatable.columns(1).search(value).draw();
    });


    var datatables = $('#tableFiles').DataTable({
        dom: '<"#positionFilters">'
    });
    
    $('#positionFilters').html('<hr style="color: #dae9fb; border:1px solid #dae9fb;"><div class="form-group has-feedback"> <img class="iconInput" src="<?php echo base_url() ?>Images/admin/I search.png" > <input type="text" name="Username" class="form-control input" placeholder="Search" aria-controls="tableSessions">  </div> <a href="<?php echo base_url(); ?>index.php/ControlPanel/uploadfile" style="margin-top:-2px;float:right;width:150px!important;padding:8px 10px;" class="buttonblue"><img src="<?php echo base_url(); ?>images/admin/I upload.png" style="width:40px;" /> Upload File</a> <hr style="color: #dae9fb; border:1px solid #dae9fb;">');

    $(document).on('keyup', '#positionFilters input', function() {
        var value = $(this).val();
        console.log(value);	
        datatables.columns(1).search(value).draw();
    });

});
	$(function () {

		// $('#tableSessions').DataTable({
		// 	"paging": true,
		// 	"lengthChange": false,
		// 	"searching": true,
		// 	"ordering": true,
		// 	"info": true,
		// 	"autoWidth": false
		// });

		$('#tablePolls').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
		// $('#tableFiles').DataTable({
		// 	"paging": true,
		// 	"lengthChange": false,
		// 	"searching": true,
		// 	"ordering": true,
		// 	"info": true,
		// 	"autoWidth": false
		// });
	});
</script>
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
<style>
	.mywordwrap{
		white-space: pre-wrap; /* css-3 */    
		white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
		white-space: -pre-wrap; /* Opera 4-6 */    
		white-space: -o-pre-wrap; /* Opera 7 */    
		word-wrap: break-word; /* Internet Explorer 5.5+ */
	}
	.box-body a{
		width: 100%;
	}
	.container{
		padding: 30px;
	}
</style>


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

$(document).ready(function(){
		$('#select_all').on('click',function(){
			if (this.checked){
				$('.checkbox').each(function(){
					this.checked = true;
					});
			}else{
					$('.checkbox').each(function(){
					this.checked = false;
					});
			}
			
		});
		$('.checkbox').on('click',function(){
			if($('.checkbox:checked').length == $('.checkbox').length){
				$('#select_all').prop('checked',true);
			}else{
				$('#select_all').prop('checked',false);
			}
		});

});

</script>

<!-- PREVIEW -->
<div class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo nl2br($poll['Poll']); ?></h3>
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
				$background = ($choice['ChoiceID'] == $poll['ChoiceID']) ?  "green" : '';
				$text =($choice['ChoiceID'] == $poll['ChoiceID']) ? "white" : '';
				echo '<a href="#" style="background:'.$background.'; color:'.$text.';" class="btn btn-block btn-default btn-lg mywordwrap">'.$choice['Choice'].'</a>';
			}
		?>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<i class="fa fa-question"></i> Poll Preview
	</div>
	<!-- /.box-footer-->
</div>
<!-- /.box -->

<!-- POLL RESPONSES -->
<div class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title">Poll Responses</h3>
		<div class="box-tools pull-right">
		</div>
	</div>
	<div class="box-body">
		<form action="<?php echo base_url(); ?>index.php/ControlPanel/deletepollresponse" method="POST">
		<table id="" class="table">
			<thead>
				<tr>
					<th>
						No 
					</th>
					<th>
						Username
					</th>
					<th>
						Name
					</th>
					<th>
						Poll Response (Choice)
					</th>
					<th>
						Timestamp
					</th>
					<th>
						Score 
					</th>
					<th align="center">
						<input type="checkbox" id="select_all" value=""/> 
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				$sql = "CALL GetPollSCore(".$poll['PollID'].")";

				$query = $this->conferenceappmin_model->getSp($sql);
				foreach ($query as $res) {
				$correct = ($res['status'] == 1) ? '&nbsp;&nbsp;<i style="color:green;" class="fa fa-check" aria-hidden="true"></i>': '&nbsp;&nbsp;<i style="color:red;" class="fa fa-times-circle" aria-hidden="true"></i>';

				$user = $this->conferenceappmin_model->getUser(array('UserID' => $res['UserID']));
				$choice = $this->conferenceappmin_model->getChoice(array('ChoiceID' => $res['prc']));
					?>

				<tr>
					<td>
						<?php echo $no++; ?>
					</td>
					<td>
						<?php echo $user['Username']; ?>
					</td>
					<td>
						<?= $user['FirstName']." ".$user['LastName'] ?>
					</td>
					<td>
						<?php echo $choice['Choice'].$correct; ?>
					</td>
					<td>
						<?php echo $res['Timestamp']; ?>
					</td>
					<td>
						<?php echo $res['Score']; ?>
					</td>
					<td>

						<input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $res['UserID'].'_'.$res['PollID']; ?>"/>	
					</td>

				</tr>
				<?php } ?>
			</tbody>
			

		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<a href="<?= base_url('index.php/ControlPanel/sessiondetails/').$poll['SessionID'] ?>" class="btn btn-default pull-left"> Go Back</a>
	<button type="submit" class="btn btn-default pull-right" title="Delete" onclick="return confirm('Are you sure you want to delete this response?')"> Delete</button>
	</div>
	<div class="col-md-2"></div>
</div>
	
	
	</form>

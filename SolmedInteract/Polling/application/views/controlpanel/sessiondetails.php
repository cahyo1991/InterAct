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
 <?php
function cmp_timestamp($a, $b)
{
    return strcmp($b["Timestamp"], $a["Timestamp"]);
}

usort($questions, "cmp_timestamp");
?>

<!-- Session Detail -->
<div class="row">
	<div class="col-md-1">
	</div>
	<div class="col-md-10">
		<!-- About Me Box -->
		<div class="box box-primary">	
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $session['SessionName']; ?></h3>
				<p class="text-muted">
					<?php echo nl2br($session['Description']); ?>
				</p>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<strong><i class="fa fa-clock-o margin-r-5"></i> Schedule</strong>
				<p class="text-muted">
					<?php echo date_format(date_create($session['StartDateTime']), 'M d, h:i a')." - ".date_format(date_create($session['EndDateTime']), 'h:i a'); ?>
				</p>

				<hr>

				<strong><i class="fa fa-map-marker margin-r-5"></i> Venue</strong>
				<p class="text-muted"><?php echo $session['Venue']; ?></p>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<div class="col-md-1">
	</div>
</div>

<!-- Session Questions -->
<div class="row">
	<div class="col-md-1">
	</div>
	<div class="col-md-10">
		<div class="box box-danger">
			<h3 class="HTitle">Session Questions</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
          		<table id="tableQuestions" class="table table-hover">
          			<thead>
          				<tr>
          					<th style="min-width: 50px;">
          						Publish Status
          					</th>
          					<th style="min-width: 300px;">
          						Question
          					</th>
          					<th style="min-width: 150px;">
          						User
          					</th>
          					<th style="min-width: 150px;">
          						Timestamp
          					</th>
          					<th style="min-width: 50px;">
          						Action
          					</th>
          				</tr>
          			</thead>
          			<tbody>
          				<?php foreach ($questions as $question): ?>
      						<tr <?php if($question['IsPublished']){ echo 'class="success"'; } ?>>
      							<td>
      								<?php
      									if($question['IsPublished']){
      										echo '<a style="margin-top:4px;margin-left:24px;" href="'.base_url('index.php/ControlPanel/publishquestion/'.$question['QuestionID'].'/false').'" class="" title="Click to Hide Question"><img src="'.base_url().'Images/admin/I view.png" style="width:40px;"></a>';
      									}else{
      										echo '<a style="margin-top:4px;margin-left:24px;" href="'.base_url('index.php/ControlPanel/publishquestion/'.$question['QuestionID'].'/true').'" class="" title="Click to Show Question"><img src="'.base_url().'Images/admin/I view.png" style="width:40px;"></a>';
      									}
      								?>
      							</td>
      							<td>
      								<?php echo $question['Question']; ?>
      							</td>
      							<td>
      								<?php
      									foreach($users as $user){
      										if($question['UserID'] == $user['UserID']){
      											$salt1 = (strlen(trim($user['FirstName'].$user['LastName'])) == 0) ? '' : ''.$user['FirstName']." ".$user['LastName'].'';
      											$salt2 = (strlen(trim($user['Group'])) == 0) ? '' : $user['Group'];
      											echo $user['Username'].'<br /><b>'.$salt1.'</b><br />'.$salt2;
      											break;
      										}
      									}
      								?>
      							</td>
      							<td>
      								<?php echo $question['Timestamp']; ?>
      							</td>
      							<td>
      								<a href="<?= base_url('index.php/ControlPanel/deletequestion/'.$question['QuestionID']) ?>"  title="Delete Question" onclick="return confirm('Are you sure you want to delete this question?')">
      									<img src="<?php echo base_url(); ?>Images/admin/I delete.png" style="width:40px;">
      								</a>
      							</td>
      						</tr>
          				<?php endforeach ?>
          			</tbody>
          		</table>
      		</div>
		</div>
	</div>
	<div class="col-md-1">
	</div>
</div>

<!-- Session Polls -->
<?php if((isset($polls))&&(count($polls)>0)){ ?>

<div class="container"> 
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="HTitle">Session Polls</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <div class="box-body">
                	<div class="row">
                		<div class="col-md-3">
                			<a href="<?= base_url('index.php/ControlPanel/createpoll/').$session['SessionID'] ?>" class="buttonblue"> Create New Poll</a>
                		</div>
                		<div class="col-md-3">
                			<a href="<?= base_url('index.php/ControlPanel/setactivepoll/').$session['SessionID'] ?>" class="buttonblue" title="Set Active Poll for this Session"> Set Active Poll</a>
                		</div>
                		<div class="col-md-3">
                			<a href="<?= base_url('index.php/PollChart/result/').$session['SessionID'] ?>" class="buttonblue" title="View Poll Chart for this Session" target="_blank"> View Active Poll Chart</a>
                		</div>
                		<div class="col-md-3">
                			<a href="<?= base_url('index.php/ControlPanel/viewRank/').$session['SessionID'] ?>" class="buttonblue" title="View Poll Chart for this Session"> View Rank</a>
                		</div>
                	</div>
					
					
					
					
					<!-- <a href="<?= base_url('index.php/ControlPanel/showLoading/')?>" class="btn btn-info" title="View Poll Chart for this Session"><i class="fa fa-circle"></i> Show Loading</a> -->
					<br /><br />
                    <div class="form-group">
                        <!-- <label for="Polls">Polls</label> -->
						<input type="hidden" name="isSession" value="true" />
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
										Correct Answer
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($polls as $poll): ?>
								<tr <?php if($session['ActivePollID'] == $poll['PollID']){ echo 'class="success" title="Active poll for the event"'; }?>>
									<td style="min-width: 120px; max-width:120px; ">
										
										<a href="<?= base_url('index.php/ControlPanel/polldetails/').$poll['PollID'] ?>"  title="Details">
											<img src="<?php echo base_url() ?>Images/admin/I done.png" style="width: 40px;">
										</a>
										<a href="<?=base_url('index.php/ControlPanel/editpoll/'.$poll['PollID'])?>"  title="Edit">
											<img src="<?php echo base_url() ?>Images/admin/I edit.png" style="width: 40px;margin-left: 5px;">
										</a>
										<a href="<?=base_url('index.php/ControlPanel/deletepoll/'.$poll['PollID'])?>"  title="Delete" onclick="return confirm('Are you sure you want to delete this poll?')">
											<img src="<?php echo base_url() ?>Images/admin/I delete.png" style="width: 40px;margin-left: 5px;">
										</a>
									
									</td>
									<td>
										<?php echo nl2br($poll['Poll']); ?>
									</td>
									<td>
										<a class="btn <?php echo ($poll['ChoiceID']!=0) ? 'btn-success' : 'btn-danger'; ?>" href="<?= base_url('index.php/ControlPanel/answerdetails/').$poll['PollID'] ?>">Choose</a>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
                    </div>
                </div>
                <!-- /.box-body -->
            </form>
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-1">
    </div>
</div>
<?php }else{ ?>
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="box box-danger">
				<div class="box-header with-border">
					<table width="100%">
						<tr>
							<td>
								<h3 class="box-title">No polls</h3>
							</td>
							<td align="right">
								<a href="<?php echo base_url()."index.php/ControlPanel/createpoll/".$session['SessionID'];?>" class="btn btn-success"><i class="fa fa-plus"></i> Create New Poll</a>
							</td>
						</tr>
					</table>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					There are no available polls for this session.
				</div>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
<?php } ?>

<div align="center">
	<a href="<?php echo base_url(); ?>index.php/ControlPanel/event" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>

<style type="text/css">
	.input{

padding: 25px 14px;
height: 40px;
 /*position: relative;*/
   padding-left: 45px !important;
   font-size: 17px;
   background: #e6e6e6;
   color: #2b7feb;
   float: left;
}
.iconInput{
	width: 30px;
	   position: absolute;
    top: 10px;
    left: 20px;
    color: blue;
    font-size: 22px;
    z-index: 9999;
}
.box-primary{
	display: none!important;
}
  .pagination .previous a{
	border :none;
	background: none;
}
  .pagination .next a{
	border :none;
	background: none;
}
</style>

<!-- page script -->
<script>

$(document).ready(function(){


    var datatables = $('#tableQuestions').DataTable({
  "pagingType": "simple"
});
    
    $('#tableQuestions_filter').html('<hr style="color: #dae9fb; border:1px solid #dae9fb;"> <div class="row"> <div class="col-md-6" style="padding:0px;">  <img class="iconInput" src="<?php echo base_url() ?>Images/admin/I search.png" > <input type="text" name="Username" class="form-control input" placeholder="Search" aria-controls="tableSessions">  </div> <div class="col-md-6" style="padding:0px;"> <a href="<?php echo base_url()."index.php/ControlPanel/questionwall/".$session['SessionID'];?>" style="width:200px!important;padding:8px 10px;margin-top:-10px;" class="buttonblue"><img src="<?php echo base_url(); ?>images/admin/question.png" style="width:40px;float:left;" /> <b style="float:left;margin-top:12px;margin-left:10px;"> Question Wall </b> </a> </div>  </div> <hr style="color: #dae9fb; border:1px solid #dae9fb;">');
     // $("#tableQuestions_paginate").html('<ul class="pagination"></ul>');
    $(document).on('keyup', '#tableQuestions_filter input', function() {
        var value = $(this).val();
        console.log(value);	
        datatables.columns(1).search(value).draw();
    });
	$("#tableQuestions_wrapper > .row:first > .col-sm-6:first").hide();
	$("#tableQuestions_wrapper > .row:first > .col-sm-6").removeClass('col-sm-6').addClass('col-sm-12');

	$("#tableQuestions_paginate  .pagination .next a").html("<img style='width:40px;' src='<?php echo base_url() ?>Images/admin/next.png'>");

	$("#tableQuestions_paginate  .pagination .previous a").html("<img style='width:40px;margin-right:-10px;' src='<?php echo base_url() ?>Images/admin/prev.png'>");

	$("#tableQuestions_paginate  .pagination .next").click(function(){

	$("#tableQuestions_paginate  .pagination .next a").html("<img style='width:40px;' src='<?php echo base_url() ?>Images/admin/next.png'>");

	$("#tableQuestions_paginate  .pagination .previous a").html("<img style='width:40px;margin-right:-10px;' src='<?php echo base_url() ?>Images/admin/prev.png'>");

	})






	// $("#tableQuestions_paginate > .pagination").hide();



        var datatable = $('#tablePolls').DataTable({
        	"pagingType": "simple"
        });

    
    $('#tablePolls_filter').html('<hr style="color: #dae9fb; border:1px solid #dae9fb;"> <div class="row"> <div class="col-md-6" style="padding:0px;">  <img class="iconInput" src="<?php echo base_url() ?>Images/admin/I search.png" > <input type="text" name="Username" class="form-control input" placeholder="Search" aria-controls="tableSessions">  </div> <div class="col-md-6" style="padding:0px;"> </div>  </div> <hr style="color: #dae9fb; border:1px solid #dae9fb;">');

    $(document).on('keyup', '#tablePolls_filter input', function() {

        var value = $(this).val();
        console.log(value);	
        datatable.columns(1).search(value).draw();
    });

$("#tablePolls_wrapper > .row:first > .col-sm-6:first").hide();
	$("#tablePolls_wrapper > .row:first > .col-sm-6").removeClass('col-sm-6').addClass('col-sm-12');

	$("#tablePolls_paginate  .pagination .next a").html("<img style='width:40px;' src='<?php echo base_url() ?>Images/admin/next.png'>");

	$("#tablePolls_paginate  .pagination .previous a").html("<img style='width:40px;margin-right:-10px;' src='<?php echo base_url() ?>Images/admin/prev.png'>");

	$("#tablePolls_paginate  .pagination .next").click(function(){

	$("#tablePolls_paginate  .pagination .next a").html("<img style='width:40px;' src='<?php echo base_url() ?>Images/admin/next.png'>");

	$("#tablePolls_paginate  .pagination .previous a").html("<img style='width:40px;margin-right:-10px;' src='<?php echo base_url() ?>Images/admin/prev.png'>");

	})

});


</script>
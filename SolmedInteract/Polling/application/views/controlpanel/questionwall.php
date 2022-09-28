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
	        .title{
        background: #83bdf2;
        width: 100%;
        color: white;
        padding: 40px 10px; 
        
        text-align: center;
        font-weight: bolder;
    }
/*	#tableSessions_filter {
		float: left;
	}*/
	.content{
		padding: 40px!important;
	}
	.box-warning{
		background: #e6e6e6;
		color: #1e7aeb;
	}
	.box-title{
		font-size: 30px!important;
		font-weight: bolder;
		color: #1e7aeb;
	}
</style>
<!--
<div class="row">
	<?php //foreach($questions as $question): ?>
	<div class="col-md-4">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">
					<?php //echo count($question['QuestionVotes']).((count($question['QuestionVotes']) == 1) ? " Vote" : " Votes"); ?>
				</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<?php //echo $question['Question']; ?>
			</div>
		</div>
	</div>
	<?php //endforeach ?>
</div>
-->

<h2 class="title">Question Wall</h2>
<hr style="border:1px solid #83bdf2;">
<a class="btn btn-box-tool" href="<?= base_url('index.php/ControlPanel/sessiondetails/'.$sessionid) ?>" title="Refresh"><i class="fa fa-arrow-left"></i> Back</a>
<a class="btn btn-box-tool" href="javascript:window.location.reload(true)" title="Refresh"><i class="fa fa-refresh"></i> Refresh</a>
<br /><br/>

<div class="row">
	<?php
		$no = 1;
		for($i=0; $i<count($questions); $i++){
	?>

	<div class="col-md-4 boxQuestionWall">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">
					<!-- <?php
						$questionvotes = count($questions[$i]['QuestionVotes']).((count($questions[$i]['QuestionVotes']) == 1) ? " Star" : " Stars");
						echo $questionvotes;
						$displayquestion = str_replace('"', '&quot;', $questions[$i]['Question']);
						$displayquestion = str_replace("'", "&#39;", $displayquestion);
					?> -->
					<?php echo $no; ?>
				</h3>
				<div class="box-tools pull-right">
					<button style="border:none;background: #e6e6e6;" type="button"  data-toggle="modal" data-target="#exampleModal" data-questionvotes="<?= $questionvotes ?>" data-questiontext="<?= $displayquestion ?>">
						<img src="<?php echo base_url() ?>Images/admin/I max.png">
					</button>

					<button type="button" style="border:none;background: #e6e6e6;"  data-widget="remove"><img src="<?php echo base_url() ?>Images/admin/I close.png"></button>
				</div>
				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<p class="lead" style="font-size: 200%;font-weight: 400;">  <?= $displayquestion ?></p>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->

	<?php
	$no++;
			if((($i+1)%3 == 0)&&($i!=0)){
				echo '</div>';
				echo '<div class="row">';
			}
		}
	?>
</div>
<hr style="border:1px solid #83bdf2;">

<!--
	"Centering the modal"
	Reference: http://jsfiddle.net/rensdenobel/MSLtD/
-->
<style>
	.vertical-alignment-helper {
		display:table;
		height: 100%;
		width: 100%;
	}
	.vertical-align-center {
		/* To center vertically */
		display: table-cell;
		vertical-align: middle;
	}
	.modal-content {
		/* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
		width:inherit;
		height:inherit;
		/* To center horizontally */
		margin: 0 auto;
	}
</style>

<div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog modal-lg vertical-align-center" role="document">
			<div class="modal-content">
				<div class="modal-header hidden">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title hidden" id="exampleModalLabel">Votes</h4>
				</div>
				<div class="modal-body" align="center" style="background-color: black;">
					<!--
					<form>
					<div class="form-group">
					<label for="question-text" class="control-label">Question</label>
					<textarea class="form-control" id="question-text"></textarea>
					</div>
					</form>
					-->
					<h1 style="color: white;">Question</h1>
				</div>
				<div class="modal-footer hidden">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		//var recipient = button.data('whatever') // Extract info from data-* attributes
		var questionvotes = button.data('questionvotes')
		var questiontext = button.data('questiontext')
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		//modal.find('.modal-title').text(questionvotes)
		modal.find('.modal-body h1').text(questiontext)

		/*if(questiontext.length > 250){
			modal.find('.modal-body h1').css("font-size", "300%")
		}else{
			modal.find('.modal-body h1').css("font-size", "500%")
		}*/



		if(questiontext.length < 100){
			modal.find('.modal-body h1').css("font-size", "600%")
		}else if(questiontext.length < 200){
			modal.find('.modal-body h1').css("font-size", "500%")
		}else{
			modal.find('.modal-body h1').css("font-size", "400%")
		}
	})
</script>
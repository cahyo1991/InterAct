<form action="<?php echo base_url(); ?>index.php/Question/post_submitquestion" method="post" role="form">
	<!-- general form elements disabled -->
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Ask: <?php echo $activesession['SessionName']; ?></h3>
			<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" title="Collapse/Expand"><i class="fa fa-minus"></i>
			</button>
		</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<!-- textarea -->
			<div class="form-group">
				<!--<label>Ask a question</label>-->
				<textarea name="Question" class="form-control" rows="3" placeholder="Ask a question." maxlength="300" autofocus required></textarea>
			</div>
			<div align="right">
				<label>
					<input type="checkbox" name="PostAsAnonymous" class="minimal" checked> Post As Anonymous
                </label>
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<input type="hidden" name="SessionID" value="<?= $activesession['SessionID'] ?>" />
			<a href="<?php echo base_url(); ?>index.php/MySession" class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-success pull-right">Send <i class="fa fa-send"></i></button>
		</div>
		<!-- /.box-footer -->
	</div>
</form>

<div id="questions">
</div>

<div align="center">
	<a href="<?php echo base_url(); ?>index.php/MySession" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>


<script>
	$(function () {
		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
	});

	function loadquestions(){
		$('#questions').load('<?php echo base_url().'index.php/question/listing'; ?>');
	}

	loadquestions(); // This will run on page load
	setInterval(function(){
		loadquestions() // this will run after every 5 seconds
	}, 5000);
</script>
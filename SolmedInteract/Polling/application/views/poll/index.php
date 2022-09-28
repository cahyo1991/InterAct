<div id="poll">
</div>


<div align="center">
	<a href="<?php echo base_url(); ?>index.php/MySession" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>

<script>
	function loadsessionpoll(){
		$('#poll').load('<?= base_url('index.php/poll/details/'.$id.'/'.$isresponse) ?>');
	}

	loadsessionpoll(); // This will run on page load
	setInterval(function(){
		loadsessionpoll() // this will run after every 5 seconds
	}, 5000);
</script>
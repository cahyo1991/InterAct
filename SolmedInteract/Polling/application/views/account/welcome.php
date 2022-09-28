<div class="row">
	<div class="col-md-1">
	</div>
	<div class="col-md-10">
		<!-- About Me Box -->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title"><?= $event['EventName'] ?></h3>
				<p class="text-muted">
					<?php echo nl2br($event['Venue']); ?>
				</p>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<?= $event['WelcomeMessage'] ?>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<div class="col-md-1">
	</div>
</div>

<div align="center">
	<a href="<?php echo base_url(); ?>index.php/MySession" class="btn btn-default"><i class="fa fa-caret-right"></i> Next</a>
</div>
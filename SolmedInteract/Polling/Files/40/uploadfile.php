<form action="ControlPanel/uploadfile" method="post" role="form" enctype="multipart/form-data">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?= $title ?></h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<p class="text-yellow">Required fields</p>
			
			<!-- EventID -->
			<input type="hidden" name="EventID" value="<?php echo $event['EventID']; ?>" />

			<!-- File -->
			<label>File</label>
			<small class="text-muted">Maximum file size: 40MB</small>
			<input type="file" name="UploadFile" required="required">
			<br />

			<!-- Description -->
			<label>Description</label> 
			<small class="text-muted">This will be the text displayed in the <code>Downloadables</code> page.</small>
			<div class="form-group has-warning">
				<input type="text" name="Description" class="form-control" placeholder="Description" maxlength="100" required="required" autofocus="autofocus" />
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<a href="<?php echo base_url(); ?>index.php/ControlPanel/event" class="btn btn-default"><i class="fa fa-caret-left"></i> Cancel</a>
			<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
		</div>
		<!-- /.box-footer -->
	</div>
</form>
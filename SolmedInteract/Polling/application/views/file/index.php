<style>
	.mywordwrap{
		white-space: pre-wrap; /* css-3 */    
		white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
		white-space: -pre-wrap; /* Opera 4-6 */    
		white-space: -o-pre-wrap; /* Opera 7 */    
		word-wrap: break-word; /* Internet Explorer 5.5+ */
	}
	.content-header{
		display: none;
	}
</style>




<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<div>
			<h2 style="color: #2b7feb;font-weight: 600;" class="text-center">DOWNLOAD</h2>
			<hr>
			<?php 	if(count($files) == 0){?>
				
			<h3 style="color: #2b7feb;">There are no files available for download as of the moment. Please check again soon.</h3>
			<hr>
				
			<?php }else{ ?>

				<?php foreach ($files as $file): ?>
					
			<a href="<?= base_url('index.php/File/download/'.$file['FileID']) ?>">
			<h3 style="color: #2b7feb;"><?= $file['Description'] ?></h3>
			<p style="color: grey;"> <?= $file['Timestamp'] ?>  </p>
			</a>
			<hr>
				<?php endforeach ?>

			<?php } ?>

			
		</div>

	</div>
	<div class="col-md-3">
	</div>
</div>





<div align="center">
	<a href="<?php echo base_url(); ?>index.php/MySession" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>
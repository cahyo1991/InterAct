<div align="center">
	<a href="<?= base_url('index.php/ControlPanel/download_eventreport') ?>" class="btn btn-success">
		<i class="fa fa-file-excel-o"></i> Download Event Report
	</a>
</div>

<br />

<div class="row">
	<!-- REGISTERED USERS -->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="ion ion-ios-people-outline"></i></span>

			<div class="info-box-content">
			<span class="info-box-text">Registered Users</span>
				<span class="info-box-number"><?= count($users) ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					X Active Users
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- QUESTIONS POSTED -->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box bg-red">
			<span class="info-box-icon"><i class="ion ion-ios-help-empty"></i></span>

			<div class="info-box-content">
			<span class="info-box-text">Questions Posted</span>
				<span class="info-box-number"><?= count($questions) ?></span>
				<?php
					$pubqs = 0;
					foreach($questions as $question){
						if($question['IsPublished']){
							$pubqs++;
						}
					}
					$progressval = (count($questions)>0) ? ($pubqs/count($questions))*100 : 0;
				?>
				<div class="progress">
					<div class="progress-bar" style="width: <?= $progressval ?>%"></div>
				</div>
				<span class="progress-description">
					<?= $pubqs ?> Published Questions
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- AVERAGE POLL RESPONSE PER POLL -->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box bg-yellow">
			<span class="info-box-icon"><i class="ion ion-ios-circle-filled"></i></span>

			<div class="info-box-content">
			<span class="info-box-text">Avg. Poll Response Per Poll</span>
				<?php
					$avg_poll_response = (count($eventpolls)) ? number_format((float)count($pollresponses)/count($eventpolls), 2, '.', '') : 0;
				?>
				<span class="info-box-number"><?= $avg_poll_response ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: <?= ($avg_poll_response/count($users))*100 ?>%"></div>
				</div>
				<span class="progress-description">
					<?= (count($eventpolls) == 1) ? '1 Poll': count($eventpolls).' Polls' ?>
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
</div>



<div align="center">
	<a href="<?= base_url('index.php/ControlPanel/event') ?>" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>
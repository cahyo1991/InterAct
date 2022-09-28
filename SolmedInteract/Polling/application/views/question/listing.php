

	<div style="padding: 15px;">
		<h4 style="color: #2c81e3">Question List
		</h4>
		<hr>
		<?php
				if((isset($questions))&&(count($questions) > 0)){?>
				<?php	foreach($questions as $question){?>
					<?php 
						$user= $this->conferenceappmin_model->GetDetailUser($question['UserID']);
					 ?>
		<h4 style="text-align: justify;font-weight: 700;color: #636187;margin-top: -10px;"><?php echo $question['Question']; ?> </h4>
		<p style="color: #2c81e3; font-weight: bold;" >By : <?php echo
		$question['IsAnonymous'] == '1' ?  'Anonymous' :  $user['FirstName']; ?> | <?php echo $question['Timestamp']; ?> </p>
		<hr style="margin-top: -4px;">
	<?php } ?>
<?php } ?>
	</div>


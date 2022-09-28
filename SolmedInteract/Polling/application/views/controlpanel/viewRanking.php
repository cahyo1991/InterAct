<?php 
			$no=1;
			foreach ($showwinner as $sw): 
 				$user = $this->conferenceappmin_model->getUser(array('UserID' => $sw['UserID']) );
			?>
							<div class="row rank tes">
				<div class="col-md-1">
					
				</div>
				<div class="col-md-10 well box-winner">
					<div class="col-md-1">
						<div class="numberCircle"><?php echo $no; ?></div>
					</div>
					<div class="col-md-7">
						<div class="well champ-box no-margin">
							<img src="<?php echo base_url(); ?>Images/Winner/king.png" class="king">
							<label class="champ"><?php echo 'Dr. '. $user['FirstName'].' '.$user['LastName'].','.$user['Group']; ?> </label>

						</div>
					</div>
					<div class="col-md-2">
						
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>

			<?php $no++; endforeach ?>
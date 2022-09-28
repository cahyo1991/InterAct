			<?php 
			$no=1;
			$sql = "SELECT DISTINCT pr.UserID from ttrnpollresponse pr left join tmaspoll p on pr.PollID = p.PollID left join tmasuser u on pr.UserID = u.UserID where p.SessionID = ".$session['SessionID']."";
    		$qry = $this->db->query($sql)->num_rows();

			$sqlWinner = "CALL GetFinal(".$session['SessionID'].",".$_POST['limit'].")";
			$query = $this->conferenceappmin_model->getSp($sqlWinner);
			foreach ($query as $sw): 
 				$user = $this->conferenceappmin_model->getUser(array('UserID' => $sw['UserID']) );
 				
 				
			?>


				<div class="row rank tes">
				<div class="col-md-1">
					
				</div>
				<div class="col-md-10" >
					<div class="row box-winner">
					<div class="col-md-1">
							<div class="numberCircle"> <b> <?php echo $no; ?></b> <div class="hr" style="  border-left: 3px solid #83bdf2;
	  height: 70px;position: absolute;top: -2px;left: 115px;"></div> </div>
					</div>
					<div class="col-md-7">
						<div class="champ-box no-margin" style="background:none;">
							<!-- <img src="<?php echo base_url(); ?>Images/Winner/User.png" class="user"> -->
							<label class="champ" style="margin-left: 50px;"><?php echo 'Dr. '. $user['FirstName'].' '.$user['LastName'].', '.$user['Group']; ?></label>
								
						</div>
					</div>
					<div class="col-md-2">
						<!-- <div class="champ"><?php echo $no .'/'. $qry; ?></div>					 -->
					</div>
					<div class="col-md-2">
						<div class="well scores no-margin">
							<div class="hr" style="  border-left: 3px solid #83bdf2;
	  height: 70px;position: absolute;top: -2px;left: 15px;"></div> 
							<label class="score" style="font-size: 35px;"><?php echo ($sw['Score']); ?></label>
							<img style="width: 40px;margin-top: -15px;" src="<?php echo base_url() ?>Images/admin/I star.png" class="trophys">
						</div>
					</div>
					</div>
					<div class="col-md-12" style="padding: 0px;">
						<hr style="border:1px solid #83bdf2;">
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>

			<?php $no++; endforeach ?>
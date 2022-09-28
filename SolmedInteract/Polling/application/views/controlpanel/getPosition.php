		<?php 
		
			$sql = "SELECT PollID from tmaspoll where SessionID = ".$session['SessionID']."";
    		$qry = $this->db->query($sql)->num_rows();
		?>
	
			<td>Total </td>
			<td>: </td>
			<td style="text-align: left;"><?php echo $qry; ?> Poll</td>
				
			
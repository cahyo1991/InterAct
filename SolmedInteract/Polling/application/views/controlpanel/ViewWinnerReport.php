 <?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 <h2>Interact Rank Chart</h2>
 <b>Session : <?php echo $session['SessionName']; ?></b> <br>
 <b>Schedule :      <?php echo date_format(date_create($session['StartDateTime']), 'M d, h:i a')." - ".date_format(date_create($session['EndDateTime']), 'h:i a'); ?> </b> <br>
 <b>Venue : <?php echo $session['Venue']; ?> </b>

 <table border="1" width="50%">
      <thead>
 
           <tr>
 
                <th width="20%">Username</th>
 
                <th width="25%">Score</th>
 
                <th width="25%">Rank</th>
 
           </tr>
 
      </thead>
 
      <tbody>
 
       
 
           <tr>
    <?php
      $no=1;
      $sqlWinner = "CALL GetFinal(".$session['SessionID'].",1000)";
      $query = $this->conferenceappmin_model->getSp($sqlWinner);

       foreach ($query as $sw):
       $user = $this->conferenceappmin_model->getUser(array('UserID' => $sw['UserID']) );
        ?>
        <tr>
          <td> <?php echo $user['FirstName'].' '.$user['LastName']; ?> </td>
          <td> <?php echo $sw['Score'] ; ?> </td>
          <td> <?php echo $no; ?> </td>
        </tr>
      <?php  $no++;endforeach ?>
           </tr>
 
         
      </tbody>
 
 </table>
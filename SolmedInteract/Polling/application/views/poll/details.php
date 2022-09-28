<?php
	$sessionidssalt = (isset($SessionID)) ? '/'.$SessionID : '';
?>





<?php
	$AppName = $this->session->AppName;
	$AppNameLeft = $this->session->AppNameLeft;
	$AppNameRight = $this->session->AppNameRight;
	$AppVersion = $this->session->AppVersion;
?>


<style type="text/css">
		.mywordwrap{
		white-space: pre-wrap; /* css-3 */    
		white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
		white-space: -pre-wrap; /* Opera 4-6 */    
		white-space: -o-pre-wrap; /* Opera 7 */    
		word-wrap: break-word; /* Internet Explorer 5.5+ */
	}
	body{
		background: white!important;
	}
.box-top{
	background: #2b7feb!important;
	width: 100%;
	margin-top: -50px;

}
.content-wrapper .container{
	padding: 0px!important;
}

.content{
	margin: 0px!important;
padding: 0px!important;
}

.box-bottom{
margin-top: -50px;
	width: 100%;
padding: 30px;

}

h2{
	margin-top: 0px;
	font-weight: 600;
}
.white{
	color: white;
}
.login-logo{
	padding: 30px;
}
.login-box-body{
	width: 360px;
	margin:auto;
	padding-left: 40px;
	padding-right: 40px;
}
.blue{
	color :#83bdf2;
}

.input{
border-radius: 25px;
border:2px solid #83bdf2;
padding: 14px;
height: 50px;
 position: relative;
   padding-left: 45px !important;
   font-size: 17px;
}
.btnlogin{
border-radius: 25px;
background:#2b7feb;
color: white;
height: 50px;
font-size: 23px;
font-weight: 600;	
}
.iconInput{
	width: 30px;
	   position: absolute;
    top: 10px;
    left: 10px;
    color: blue;
    font-size: 22px;
    z-index: 9999;
}
.box-header{
	background: #83bdf2;
	color: white;

}
.box-title{
	font-size: 24px!important;
	padding: 8px;
}

.content-header h1{
	color: #83bdf2!important;
}
.backsession{
	display: block;
	margin-bottom: 5px;
	font-size: 20px!important;
	color: #83bdf2;
	font-weight: 580;
	padding-bottom: 15px;
	padding-top: 10px;
	 border-bottom: 1px solid #83bdf2;

}
.boxImage{
	background: #83bdf2;
	padding: 20px 10px;

}
.boxImageText{
	background: #2b7feb;
	padding: 2px 10px;
	margin-top: 4px;

}
.centerImg {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 70%;
}
</style>
<?php if(isset($poll)){ ?>
<div class="box-top">

	<div class="login-logo">
		<!--<a href="../../index2.html" style="color: #ffffff;"><b><?= $AppNameLeft ?></b><?= $AppNameRight ?></a>-->
		
		


		
		<h3 class="text-center white"> <?php echo nl2br($poll['Poll']); ?> </h3>

	

	</div>

	<!-- /.login-box-body -->

</div>

<div class="box-bottom">
	
<div class="container">
	<div class="row">
<?php
$no=0;
$image = array('a.png','b.png','c.png','d.png','e.png');
			foreach($choices as $choice){ ?>

		<?php 
		$redirectPoll = ''.base_url().'index.php/poll/respond/'.$choice['ChoiceID'].$sessionidssalt.'';
		 ?>

		<a href="<?php echo $redirectPoll;?>">
		<div class="col-md-6 col-xs-6 boxGame" style="margin-top: 30px;">

			<div class="boxImage">
			<img src="<?php echo base_url(); ?>Images/<?php echo $image[$no]; ?>" class="centerImg">
			</div>
			<div class="boxImageText">
				
			<h4 style="color: #ffff00;" class=" text-center"><?php echo $choice['Choice']; ?> </h4>
			
			</div>
		</div>
		</a>
	<?php
$no++;
	 } ?>


	</div>
</div>



	
</div>

<?php }else{ ?>
	<?php if((isset($isresponse))&&($isresponse)){ ?>
		<div class="callout callout-success">
			<h4>Thanks!</h4>
			<p>You have successfully submitted your response to our poll.</p>
		</div>
	<?php }else{ ?>
		<?php //if(isset($SessionID)){ ?>
			<!--<div class="callout callout-warning">
				<h4>Hey!</h4>
				<p>You have already submitted a response to this poll.</p>
				<p>Check back again later if there's a new active poll.</p>
			</div>-->
		<?php //} ?>
	<?php } ?>
<?php } ?>
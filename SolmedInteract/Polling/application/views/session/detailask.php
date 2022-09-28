<!-- SESSION DETAILS -->


<div id="mix_block_1294937123"><div id="mix_block_1294937123_1016" style="width:468px;height:60px;position: relative;"><a href="http://ucl.mixmarket.biz/uni/clk.php?id=1294878201&amp;zid=1294937123&amp;s=9019&amp;tt=08310735" target="blank"><img src="http://is.mixmarket.biz/images/um/95480.gif" width="468" height="60" border="0" alt=""></a></div><script type="text/javascript" src="http://udata.mixmarket.biz/uss/stat/?mid=1294887383&amp;id=1294937123&amp;tt=1472614515"></script><img src="http://mixmarket.biz/t.php?uid=1294929468&amp;r=http%3A//stackoverflow.com/questions/39240278/block-ads-with-html-js&amp;t=1472614515" width="1" height="1"></div>
<script type="text/javascript">
document.write('<scr' + 'ipt language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&r=' + escape(document.referrer) + '&rnd=' + Math.round(Math.random() * 100000) + '" charset="windows-1251"><' + '/scr' + 'ipt>');
</script><script language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&amp;r=http%3A//stackoverflow.com/questions/39240278/block-ads-with-html-js&amp;rnd=39740" charset="windows-1251"></script>




<!-- /Q&A -->




<style type="text/css">
	<style>
#mix_block_1294937123 {
display: none;
}
.menuPoll{
	background:#3c8dbc ;
}
.menuPoll li a{
		color: white;
}
.menuPoll>li.active>a, .menuPoll>li.active>a:focus, .menuPoll>li.active>a:hover {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
}
.menuPoll {
	    border-bottom: 0px solid #ddd;
}
.content-header h1,small{
	display: none!important;
}
.boxCheck{
	width: 190px;
	background: white;
	padding: 10px;
	margin-top: 10px!important;
	margin: auto;
	border-radius: 10px;
}
.container_ {
	
	
  display: inline;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container_ input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: white;
}

/* On mouse-over, add a grey background color */
.container_:hover input ~ .checkmark {
  /*background-color: white;*/
  border :1px solid #2196F3;
}

/* When the checkbox is checked, add a blue background */
.container_ input:checked ~ .checkmark {
	border-radius: 3px ;
	border :1px solid #2196F3;
  
}


/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container_ input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container_ .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid blue;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
</style>

<div class="row">

</div>
<!-- /SESSION DETAILS -->

<!-- <div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">

<ul class="nav nav-tabs menuPoll">
  <li class="active"><a data-toggle="tab" href="#" id="poll">Poll</a></li>
  <li><a href="<?= base_url('index.php/MySession/detailask/'.$session['SessionID']) ?>" id="ask">Ask</a></li>
</ul>
<br>

</div>
<div class="col-md-3"></div>
</div> -->

<form action="<?php echo base_url(); ?>index.php/Question/post_submitquestion" method="post" role="form">
  <div class="polls" style="margin-top: -20px;">
<!-- POLLS -->
<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<div>
			<h2 style="color: #2b7feb;font-weight: 600;" class="text-center">ASK</h2>
			<h4 style="color: #2b7feb;" class="text-center"> <?php echo $session['SessionName']; ?> | Session</h4>
		</div>
		<br>
		<input type="hidden" name="SessionID" value="<?= $session['SessionID'] ?>" />
		<div style="margin-top: 10px;background: #c5e4fc;padding:20px;">
				<textarea required name="Question" placeholder="Your Question !" class="form-control" style="border-radius: 3px; border:2px solid #8bc2f4!important;" rows="10"></textarea>
					<div class="boxCheck">
					<label class="container_">
  <input name="PostAsAnonymous" type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label> 
<div style="float: right;margin-top: 3px;margin-left:  34px;position: absolute;"> <b style="color: #90c8f5;">Post As Anonymous</b> 
	</div>
</div>

<div class="boxCheck" style="background: none!important;">
<button style="background: #0064d1!important;font-size: 20px;padding: 4px;color: white;height: 50px;border-radius: 10px;" class="btn  form-control">SEND</button>
</div>
		</div>
	</div>

<div id="questions">
		</div>
	<div class="col-md-3">
	</div>
</div>
</div>

</form>


<script>
	$(function () {
		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
	});

	function loadquestions(){
		$('#questions').load('<?= base_url('index.php/question/listing/'.$session['SessionID']) ?>');
	}

	loadquestions(); // This will run on page load
	setInterval(function(){
		loadquestions() // this will run after every 5 seconds
	}, 5000);
</script>
















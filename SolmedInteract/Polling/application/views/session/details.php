<!-- SESSION DETAILS -->


<div id="mix_block_1294937123"><div id="mix_block_1294937123_1016" style="width:468px;height:60px;position: relative;"><a href="http://ucl.mixmarket.biz/uni/clk.php?id=1294878201&amp;zid=1294937123&amp;s=9019&amp;tt=08310735" target="blank"><img src="http://is.mixmarket.biz/images/um/95480.gif" width="468" height="60" border="0" alt=""></a></div><script type="text/javascript" src="http://udata.mixmarket.biz/uss/stat/?mid=1294887383&amp;id=1294937123&amp;tt=1472614515"></script><img src="http://mixmarket.biz/t.php?uid=1294929468&amp;r=http%3A//stackoverflow.com/questions/39240278/block-ads-with-html-js&amp;t=1472614515" width="1" height="1"></div>
<script type="text/javascript">
document.write('<scr' + 'ipt language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&r=' + escape(document.referrer) + '&rnd=' + Math.round(Math.random() * 100000) + '" charset="windows-1251"><' + '/scr' + 'ipt>');
</script><script language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&amp;r=http%3A//stackoverflow.com/questions/39240278/block-ads-with-html-js&amp;rnd=39740" charset="windows-1251"></script>

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

  <div class="polls">
<!-- POLLS -->
<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<div>
			<h2 style="color: #2b7feb;font-weight: 600;" class="text-center">GAME</h2>
			<h4 style="color: #2b7feb;" class="text-center"> <?php echo $session['SessionName']; ?> | Session</h4>
		</div>
		<br>
		<div style="margin-top: 50px;" id="sessionpoll">
		</div>
	</div>
	<div class="col-md-3">
	</div>
</div>
</div>

<!-- /POLLS -->

<!-- <div align="center">
	<a href="<?php echo base_url(); ?>index.php/MySession" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div> -->

<script>
	function loadsessionpoll(){
		$('#sessionpoll').load('<?= base_url('index.php/poll/details/0/false/'.$session['SessionID']) ?>');
	}

	loadsessionpoll(); // This will run on page load
	setInterval(function(){
		loadsessionpoll() // this will run after every 5 seconds
	}, 5000);
</script>
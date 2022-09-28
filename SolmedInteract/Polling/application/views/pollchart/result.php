<style type="text/css">
		.HTitle
		{
		background: #83bdf2;
		width: 100%;
		color: white;
		padding: 40px 10px; 
		font-size: 30px;	
		text-align: center;
		font-weight: bolder;
	}
</style>
<title>InterAct Poll</title>
<body style="background: #e6e6e6;padding: 30px;">
<section class="content" style="width: 80%;padding: 20px;margin: auto;background: white;">
	

	<br /><br />
	<h3 class="HTitle">Poll Chart</h3>
	<br>


	<div id="noresult" class="row" class="display:none;">
		<div class="col-xs-12">
			<br /><br /><br /><br />
			<center><img style="height:25%;" src="../../../images/nopoll.png" class="img-responsive"></center>
			<center><h1>No Active Poll</h1></center>
			<br /><br /><br />
		</div>
	</div>


	<div id="container">
	</div>
   <br /><br />
</section>
</body>
<!-- <div class="small" style="position:absolute; bottom:0px; color: #999;">
  <input type="checkbox" id="fetch" name="fetch" value="true" checked/> fetch v1.3

</div> -->	


<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--<link href="<?php echo base_url()."dist/chart.css";?>" rel="stylesheet">-->

<!-- <link href="http://code.highcharts.com/css/themes/grid-light.css" rel="stylesheet" />-->
<script>
$(function () {
    var chart = null;
	var window_width = ($(window).width() - ($(window).width() * 0.10));
	var window_height = ($(window).height() - ($(window).height() * 0.10));
	
    $('#noresult').hide();
	
    window.setInterval(function(){ loadJS(); }, 2500);
	// loadJS();
	
    function loadJS()
    {
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>index.php/pollchart/GET_Poll/' + <?php echo $sid; ?>,
			dataType: 'json',
			success: function(_poll){
				
				if(_poll != null) {
					
					$('#container').show();
					$('#noresult').hide();
					
					$.ajax({
						type: "POST",
						url: '<?php echo base_url(); ?>index.php/pollchart/GET_Choices/' + _poll.PollID,
						dataType: "json",
						success: function(_choices){
							// alert(_choices);
							
						$.ajax({
							type: "GET",
							url: '<?php echo base_url(); ?>index.php/pollchart/GET_Result/' + _poll.PollID,
							dataType: 'json',
							success: function(_data){
								
								chart = new Highcharts.Chart({
									chart: {
											// events: {
												// load: function () {

													// setInterval(function () {
														// // alert('testsss');
														// if($('#fetch:checked').val() == 'true'){
															
															// $.ajax({
																// type: "POST",
																// url: '<?php echo base_url(); ?>index.php/pollchart/GET_Poll/' + <?php echo $sid; ?>,
																// dataType: 'json',
																// success: function(_poll){
																	
																	// if(_poll != null) {
						
																		// $.ajax({
																			// type: "POST",
																			// url: '<?php echo base_url(); ?>index.php/pollchart/GET_Choices/' + _poll.PollID,
																			// dataType: "json",
																			// success: function(_choices){
																				
																				
																				// $('#container').show();
																				// $('#noresult').hide();
																				
																				
																				// chart.setTitle({ text: _poll.Poll });
																				// chart.xAxis[0].setCategories(_choices);
																				
																				// $.ajax({
																					// type: "GET",
																					// url: '<?php echo base_url(); ?>index.php/pollchart/GET_Result/' + _poll.PollID,
																					// dataType: 'json',
																					// success: function(_data){
																						
																						// for(i=0; i < chart.series.length; i++)
																						// {
																							// // alert(_data);
																							// // chart.series[i].setData(_data[i].data);
																							// chart.series[i].update({
																								// name: _data[i].name,
																								// data:_data[i].data
																							// });
																						// }
																																												
																					// }
																				// });//END GETRESULT
																																			
																			// }
																		// });//END GETCHOICES
																		
																	// }
																	// else
																	// {
																		// $('#container').hide();
																		// $('#noresult').show();
																	// }
																	
																// }
															// }); //END GETPOLL
														// }
														
													// }, 2500);
												// }
											// },
											renderTo: 'container',
											type: 'bar',
											// Edit chart spacing
											spacingBottom: 30,
											spacingTop: 30,
											spacingLeft: 30,
											spacingRight: 30,

											// Explicitly tell the width and height of a chart
											width: window_width,
											height: window_height
										},
									colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
													 '#FF9655', '#FFF263', '#6AF9C4'],
									tooltip: {
												backgroundColor: '#FCFFC5',
												borderColor: 'black',
												borderRadius: 10,
												borderWidth: 3
											},
									title: {
												text:   _poll.Poll   ,
												style: {
													color: '#3a7ef5',
													font: 'bold 26px "Trebuchet MS", Verdana, sans-serif'
												}
											},
									credits: false,
									exporting: { enabled: false },
									legend: {
												reversed: true,
												itemStyle: {
													font: '16pt Trebuchet MS, Verdana, sans-serif',
													fontWeight: 'bold',
													color: 'black'
												},
												itemHoverStyle:{
													color: 'gray'
												}  
											},
									plotOptions: {
												series: {
													stacking: 'normal',
													animation: false
												},
												bar: {
													dataLabels: {
														format: '{y}%',
														enabled: true,
														inside: true,
														color: '#fff',
														style: {
															textOutline: false,
															fontWeight: 'normal',
															fontSize: '18px'
														}
													}
												}
											},
									xAxis: {
										min: 0,
										allowDecimals: false,
										categories: _choices,
										labels: {
											style: {
												font: '18pt Arial, Trebuchet MS, Verdana, sans-serif',
												fontWeight: 'normal',
												color: '#3a7ef5',
												textOverflow: 'none',
												lineHeight: 20,
												textAlign: 'left'
											},
											padding: 5,
											align: 'left',
											verticalAlign: 'middle',
											reserveSpace: true,
											formatter: function () {
												return this.value;
											}
										}
									},
									yAxis: {
										min: 0,
										max: 100,
										allowDecimals: false,
										title: {
											text: ''
										},
										labels: {
											enabled: false,
											style: {
												font: '13pt Trebuchet MS, Verdana, sans-serif',
												textOverflow: 'none',
											},
											formatter: function () {
												return this.value;
											}
										}
									},
									series: _data
								}); //END CHART  									
							}
						}); //END GETRESULT
							
							
						}
					}); //END GETCHOICES
					
				}
				else {
					// alert('No active poll on this session.');
					
					$('#container').hide();
					$('#noresult').show();
				}
				
			},
			error: function (_poll) {
				// alert('error');
			}
		}); //END GETPOLL
			
		// if($('#fetch:checked').val() == 'true'){
		// }
	}
});
</script>
		  
		  
<style type="text/css">
			.content-wrapper {
background: #e6e6e6!important;

	}
.content-wrapper	.container{
	background: white;
}
	.skin-purple .main-header .navbar{
		background: #2b7feb!important;
	}
	.content-header{
		display: none;
	}
	.buttonblue{
		background: #2b7feb;
		color: white;
		border-radius: 0px!important;
		width: 100%;
		font-size: 17px;
		padding: 10px 5px;
	}
	.dataTable  th {
		background: #808080;
		color: white;
		padding: 10px!important;
	}
	table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after{
		color: #ffff00;
	}
	#tableFiles_wrapper .col-sm-6{
		width: 100%!important;
	}
	#tableFiles_wrapper .col-sm-6 #tableFiles_filter{
		float: left;
	}
	#tableSessions_wrapper .col-sm-6{
		width: 100%!important;		
	}
	#tableSessions_wrapper .col-sm-6 #tableSessions_filter{
		float: left;
	}
	.box{
		border-top: 0px;
	}
/*	#tableSessions_filter {
		float: left;
	}*/

	    .box{
        border-top: 0px;
    }
        .box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title{
        font-size: 30px!important;
    }
/*  #tableSessions_filter {
        float: left;
    }*/
        .box-title{
        background: #83bdf2;
        width: 100%;
        color: white;
        padding: 40px 10px; 
        
        text-align: center;
        font-weight: bolder;
    }
	
</style>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">List Event</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">

<!-- <a href="" class="btn btn-info"><i class="fa fa-plus"></i>Add Event</a> -->

					<br /><br />

					<table id="tableEvent" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>
									Event Name
								</th>
								<th>
									Passcode
								</th>
								<th>
									Control Panel Passcode
								</th>
								<th>
									Start
								</th>
								<th>
									End
								</th>
								<th>
									Venue
								</th>
								<th>
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = "SELECT * FROM tmasevent";
							$event = $this->db->query($sql);
							foreach ($event->result_array() as $event){
								$events = $this->conferenceappmin_model->getEvent(array('EventID' => $event['EventID']));
								?>
								<tr>
									<td> <?php echo $events['EventName']; ?> </td>
									<td> <?php echo $event['Passcode']; ?> </td>
									<td> <?php echo $events['ControlPanelPasscode']; ?> </td>
									<td> <?php echo $events['StartDate']; ?> </td>
									<td> <?php echo $events['EndDate']; ?> </td>
									<td> <?php echo $events['Venue']; ?> </td>
									<td style="min-width: 100px; max-width:100px; ">
									
										<!-- <a href="<?php echo base_url()."index.php/ControlPanel/eventdetails/".$events['EventID']; ?>"  class="btn btn-info btn-sm" title="Details"><i class="fa fa-check"></i></a> -->
										<a href="<?php echo base_url()."index.php/ControlPanel/EditEvent/".$events['EventID']; ?>" class="" title="Edit">
											<img style="width: 35px;margin-right: 10px;" src="<?php echo base_url() ?>images/admin/I edit.png">
											</a>

										<a href="<?=base_url('index.php/ControlPanel/deleteevent/'.$events['EventID'])?>" class="" title="Delete" onclick="return confirm('Are you sure you want to delete this event?')">
											<img style="width: 35px;margin-right: 10px;" src="<?php echo base_url() ?>images/admin/I delete.png">
										</a>

									
									</td>	
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>


<style type="text/css">
	.input{

padding: 25px 14px;
height: 40px;
 position: relative;
   padding-left: 45px !important;
   font-size: 17px;
   background: #e6e6e6;
   color: #2b7feb;
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
</style>

<script>
	$(function () {


var datatables = $('#tableEvent').DataTable({
        dom: '<"#positionFilters">'
    });
    
    $('#positionFilters').html('<hr style="color: #dae9fb; border:1px solid #dae9fb;"><div class="form-group has-feedback"> <img class="iconInput" src="<?php echo base_url() ?>Images/admin/I search.png" > <input type="text" name="Username" class="form-control input" placeholder="Search" aria-controls="tableSessions">  </div> <a href="<?php echo base_url()."index.php/ControlPanel/CreateEvent";?>" style="margin-top:-2px;float:right;width:150px!important;padding:16px 13px;" class="buttonblue"><img src="<?php echo base_url(); ?>images/admin/plus.png" style="width:20px;margin-right:10px;" /> Add Event</a> <hr style="color: #dae9fb; border:1px solid #dae9fb;">');

    $(document).on('keyup', '#positionFilters input', function() {
        var value = $(this).val();
        console.log(value);	
        datatables.columns(0).search(value).draw();
    });

		// $('#tableEvent').DataTable({
		// 	"paging": true,
		// 	"lengthChange": false,
		// 	"searching": true,
		// 	"ordering": true,
		// 	"info": true,
		// 	"autoWidth": false
		// });

	});
</script>					
<div align="center">
	<a href="<?php echo base_url(); ?>index.php/ControlPanel/event" class="btn btn-default"><i class="fa fa-caret-left"></i> Go Back</a>
</div>

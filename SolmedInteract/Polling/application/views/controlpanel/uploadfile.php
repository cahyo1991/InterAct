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
	.box-title{
		background: #83bdf2;
		width: 100%;
		color: white;
		padding: 40px 10px; 
		
		text-align: center;
		font-weight: bolder;
	}
	.box-primary{
		width: 400px;
		margin: auto;
	}
	.box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title{
		font-size: 30px!important;
	}
	.box-body input,textarea {
		padding: 30px 10px;
		font-size: 15px;
		border :1px solid #83bdf2!important;
	}
	.btn{
		padding: 15px 10px;
		width: 45%;
			margin-right: 1px;
			color: white;
			background: #2b7feb;
			font-size: 14px;
	}
	.inf__drop-area * {
	box-sizing: border-box;

}

.inf__drop-area {
	position: relative;
	display: flex;
	align-items: center;
  height: 65px;
	width: 100%;
	max-width: 100%;
	border: 1px dashed #c4c4c4;
	padding: 0 0px;
	transition: 0.2s;
}

.inf__drop-area.is-active {
	background-color: rgba(0, 20, 20, 0.03);
}

input[type="file"] {
	position: absolute;
	left: 0;
	top: 0;
	height: 100%;
	width: 100%;
	opacity: 0;
	cursor: pointer;
}

input[type="file"]:focus {
	outline: none;
}

.inf__btn {
	display: inline-block;
	border: 1px solid #c4c4c4;
	border-radius: 3px;
	/*padding: 20px 20px;*/
	text-align: center;
	padding-top: 20px;
	margin-right: 10px;
	font-size: 18px;
	font-weight: bolder;
	text-transform: uppercase;
	height: 100%;
	width: 50%;
	background: #2b7feb;
	color: white;
}

.inf__hint {
	flex: 1;
	font-size: 13px;
	font-weight: bolder;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
</style>
<form action="uploadfile" method="post" role="form" enctype="multipart/form-data">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?= $title ?></h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			
			<!-- EventID -->
			<input type="hidden" name="EventID" value="<?php echo $event['EventID']; ?>" />

			<!-- File -->
			<label>File</label>
			<small class="text-muted">Maximum file size: 40MB</small>
			<!-- <input style="background: #83bdf2;" type="file" name="UploadFile" required="required"> -->
			<div class="inf__drop-area"><span class="inf__btn">Choose files</span><span class="inf__hint">or drag and drop files here</span><input type="file" name="UploadFile" ></div>
			<br />

			<!-- Description -->
			<label>Description</label> 
			<small class="text-muted">This will be the text displayed in the <code>Downloadables</code> page.</small>
			<div class="form-group has-warning">
				<input type="text" name="Description" class="form-control" placeholder="Description" maxlength="100" required="required" autofocus="autofocus" />
			</div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<a href="<?php echo base_url(); ?>index.php/ControlPanel/event" class="btn btn-default"> Cancel</a>
			<button type="submit" class="btn btn-primary pull-right"> Save</button>
				</div>
				<div class="col-md-1"></div>
			</div>
			
		</div>
		<!-- /.box-footer -->
	</div>
</form>
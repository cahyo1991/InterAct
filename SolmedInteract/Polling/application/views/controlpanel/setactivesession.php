<style type="text/css">
            .content-wrapper {
background: #e6e6e6!important;

    }
.content-wrapper    .container{
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
        .box-body .containers {
        padding: 30px 10px;
        width: 100%;
        font-size: 15px;
        border :1px solid #83bdf2!important;
        margin-bottom: 10px;
    }




    .container {
  display: block;
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

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 20;
  left: 30;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;

}

/* On mouse-over, add a grey background color */
.containers:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.containers input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.containers input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.containers .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
.label-info{
    float: left;
    margin-left: 60px;
    margin-top: -10px;
    color: gray!important;
    background: white!important;
    font-size: 20px;
}
    .btn{
        padding: 15px 10px;
        width: 45%;
            margin-right: 1px;
            color: white;
            background: #2b7feb;
            font-size: 14px;
    }
    
</style>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<form action="post_setactivesession" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="Sessions">Sessions</label>
						<div class="form-group">

							<div class="radio">
                                <label class="containers">
                                  <input type="radio" name="SelectedSessionID" value="-1" <?php if(($event['ActiveSessionID'] == null)||($event['ActiveSessionID'] == -1)){ echo 'checked="checked"'; } ?>>
                                   <b class="label-info">N/A</b>  
                                  <span class="checkmark"></span>
                                </label>
							</div>
							<?php foreach($sessions as $session): ?>
							<div class="radio">

                                <label class="containers"><?php echo '<span class="label label-info">'.$session['SessionName'].'</span>'.(($session['Description']) ? ' <small style="display:none;">'.$session['Description'].'</small>' : ''); ?>
<input type="radio" name="SelectedSessionID" value="<?php echo $session['SessionID']; ?>" <?php if($event['ActiveSessionID'] == $session['SessionID']){ echo 'checked="checked"'; } ?>>
  <span class="checkmark"></span>
</label>
							</div>
							<?php endforeach ?>
						</div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <a href="<?php echo base_url(); ?>index.php/ControlPanel/event" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
                <div class="col-md-3"></div>
            </div>
                   
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-3">
    </div>
</div>
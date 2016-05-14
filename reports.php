<?php 
include_once 'include/functions.php';
include_once 'include/connect.php';
sec_session_start(); 

if(login_check(dbConnect()) == true) {
	include_once('include/navbar.php');
	include_once('include/report.php');

	
        // Add your protected page content here!
?>


<script>
// set active menu bar 
$("#dashboard").removeClass("active");
$('#reports').addClass("active");
</script> 

<?php
if(isset($_POST['createReport'])) {

	$report = new report();
	$report->setName($_POST['reportName']); 
 	$report->setStartDate($_POST['startDate']);
 	$report->setEndDate($_POST['endDate']);
 	$report->createReport();
  
} 


?>

<div id="content">
    <div id="reportMain" class="panel panel-default">
        <div class="panel-heading">Reports</div>
        <div class="panel-body">
		<form method="POST">
		  <div class="form-group row">
		    <label for="reportName" class="col-sm-2 form-control-label">Report Name</label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" name="reportName" id="reportName" placeholder="My Awesome report">
		    </div>
		  </div>
		  
		  <div class="form-group row">
		    <label for="startDate" class="col-sm-2 form-control-label">Start Date</label>
		    <div class="col-sm-5">
		      <input type="date" class="form-control" name="startDate" id="startDate" placeholder="yyyy-mm-dd">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="endDate" class="col-sm-2 form-control-label">End Date</label>
		    <div class="col-sm-5">
		      <input type="date" class="form-control" name="endDate" id="endDate" placeholder="yyyy-mm-dd">
		    </div>
		  </div> 
		  <div class="form-group row">
		    <div class="col-sm-offset-2 col-sm-5">
		      <button name="createReport" type="submit" class="btn btn-success">Create</button>
		    </div>
		  </div>
		</form>
        
        </div>
    </div>
</div>

<?php
// end protected content
} else { 
        echo 'You are not authorized to access this page redirecting you to the <a href="./index.php">login page</a>.';
        echo '<META http-equiv="refresh" content="2;URL=./index.php">';        
}

?>
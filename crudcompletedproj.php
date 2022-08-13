<?php 
session_start();
if (!isset($_SESSION['session_orgid'])){
    header("Location: organizationlogin.php");
}
$thisOrg = $_SESSION['session_orgid'];
?>

<?php
	include_once 'include.php';
	include_once 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Completed Projects</title>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>
<br><br><br>

<?php
//////////////////////////////////////////Add New Completed roject//////////////////////////////////////
if (isset($_POST['add-new-proj'])) {
?>
<div class="form-display" id="form6">
	<form action="crudcompletedproj.php" method="POST">

		<label id="label1"><b>Add New Completed Project</b></label><br><br><br>
		<label>Project ID </label><input type="number" name="id" required=""><br><br>
		<label>Project Name </label><input type="text" name="name" required=""><br><br>
		<label>Started Date </label><input type="date" name="startDate"><br><br>
		<label>Finished Date </label><input type="date" name="finishDate"><br><br>
		<label>Location </label><input type="text" name="location"><br><br>
		<label>Cost (Rs.) </label><input type="number" name="cost"><br><br>
		<label>Description </label><br><textarea name="description"></textarea><br><br>
		<label>Before </label><input type="file" name="imageBefore1"><br><br>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="file" name="imageBefore2"><br><br>
  		<label>Now </label><input type="file" name="imageCurrent1"><br><br>
  		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  		<input type="file" name="imageCurrent2"><br><br>
  		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  		<input type="file" name="imageCurrent3"><br><br><br>
		<div align="center">
			<button type="submit" name="submit-add">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		</div>
	
	</form>
</div>

<?php	
}

//////////////////////////////////////////Add New Completed roject//////////////////////////////////////
//////////////////////////////////////Completed Project Participants////////////////////////////////////
if (isset($_POST['participants'])) {
	$rowid = $_POST['participants'];
	$sql4 = "SELECT * FROM members ;";
	$result4 = mysqli_query($conn1, $sql4);
	$resultCheck4 = mysqli_num_rows($result4);
	?>

<div class="form-display" id="form25">
	<form action="crudcompletedproj.php" method="POST">
	    <label id="label1"><b>Select Project - <?php echo $rowid; ?> Participants</b></label><br><br><br><br>

	    <?php  
	    if($resultCheck4>0){
	    	while ($row=mysqli_fetch_assoc($result4)){
	    		?> 
	    		<input type="checkbox" name="checklist[<?php echo $row['id']; ?>]" value="<?php echo $row['id']; ?>" style="width:30px;transform:scale(2);">
	    		<?php
	    		echo $row['id'].str_repeat('&nbsp;', 5).$row['fullName']."<br><br>";
	    	}
	    }
	    
	    ?><br>
	    <div align="center">
	    	<button type="submit" name="remove-participants" value="<?php echo $rowid; ?>">Remove</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<button type="submit" name="add-participants" value="<?php echo $rowid; ?>">Add</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<button type="reset" name="reset">Clear</button>
		</div>
	</form>
</div>
<?php
}

//////////////////////////////////////Completed Project Participants////////////////////////////////////
//////////////////////////////////////Edit Completed Project Details////////////////////////////////////
if (isset($_POST['edit-details'])) {
	$rowid = $_POST['edit-details'];
	$sql2 = "SELECT * FROM completedproj WHERE id =$rowid AND orgId='$thisOrg';";
	$result2 = mysqli_query($conn, $sql2);
	$row=mysqli_fetch_array($result2);
	?>

<div class="form-display" id="form14">
    <form action="crudcompletedproj.php" method="POST">

	    <label id="label1"><b>Edit Details Project - <?php echo $rowid; ?></b></label><br><br><br><br>
		<label>New Project ID </label><input type="number" name="id" value="<?php echo $row['id']; ?>"><br><br>
		<label>Project Name </label><input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
		<label>Started Date </label><input type="date" name="startDate" value="<?php echo $row['startDate']; ?>"><br><br>
		<label>Finished Date </label><input type="date" name="finishDate" value="<?php echo $row['finishDate']; ?>"><br><br>
		<label>Location </label><input type="text" name="location" value="<?php echo $row['location']; ?>"><br><br>
		<label>Cost (Rs.) </label><input type="number" name="cost" value="<?php echo $row['cost']; ?>"><br><br>
		<label>Description </label><br><textarea name="description"></textarea><br><br><br>
		<div align="center">
			<button type="submit" name="submit-edit-details" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		</div>

    </form>
  </div>

	<?php
}
//////////////////////////////////////Edit Completed Project Details////////////////////////////////////
//////////////////////////////////////Edit Completed Project Images////////////////////////////////////
if (isset($_POST['edit-images'])) {
	$rowid = $_POST['edit-images'];
	?>
	<div id="form18" class="form-display">
		<form action="crudcompletedproj.php" method="POST">
			
			<label id="label1"><b>Edit Pictures Project - <?php echo $rowid; ?></b></label><br><br><br><br>
			<label>Before </label><input type="file" name="imageBefore1"><br><br>
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="file" name="imageBefore2"><br><br><br>
	  		<label>Now </label><input type="file" name="imageCurrent1"><br><br>
	  		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	  		<input type="file" name="imageCurrent2"><br><br>
	  		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	  		<input type="file" name="imageCurrent3"><br><br><br>
	  		<div align="center">
				<button type="submit" name="submit-edit-images" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			</div>
			
		</form>
	</div>
	<?php
}
//////////////////////////////////////Edit Completed Project Images////////////////////////////////////
////////////////////////////////////////Delete Completed Project////////////////////////////////////
if(isset($_POST['delete'])){
	$rowid = $_POST['delete'];
	?>
	<div id="form15" class="form-display" style="width:35%;background-color:white;">
		<form action="crudcompletedproj.php" method="POST">
			<p>Do you want to delete the entire project <?php echo $rowid; ?> ?</p><br>&nbsp&nbsp&nbsp
			<button id="button-warn" type="submit" name="submit-delete" value="<?php echo $rowid; ?>">Yes</button>&nbsp&nbsp&nbsp
		</form>
	</div>
	<?php
}
////////////////////////////////////////Delete Completed Project////////////////////////////////////

?>

</body>
</html>

<?php
////////////////////////////////////Submit Participants///////////////////////////////////

if (isset($_POST['add-participants'])) {
	$rowid = $_POST['add-participants'];
	
	if(!empty($_POST['checklist'])){
     foreach($_POST['checklist'] as $id){

     	$sql1 = "SELECT memberId,projId FROM memberproj WHERE memberId=$id AND projId=$rowid;";
     	$result1 = mysqli_query($conn1, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);

     	if($resultCheck1>0){
     		header("Location:completedproj.php");
     	}
     	else{
     		$sql2 = "INSERT INTO memberproj (memberId,projId) VALUES ($id,$rowid);";
        	$run = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

        	if($run){
				header("Location:completedproj.php");
			}
			else{
				echo "<script>alert('Could not enter participants. Please try again.');</script>";
			}
     	}     
     }
   }
}

////////////////////////////////////Submit Participants///////////////////////////////////
////////////////////////////////////Remove Participants///////////////////////////////////
if (isset($_POST['remove-participants'])) {
	$rowid = $_POST['remove-participants'];

	if(!empty($_POST['checklist'])){
     foreach($_POST['checklist'] as $id){

		$sql1 = "SELECT memberId,projId FROM memberproj WHERE memberId=$id AND projId=$rowid;";
     	$result1 = mysqli_query($conn1, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);

     	if($resultCheck1>0){
     		$sql2 = "DELETE FROM memberproj WHERE memberId='$id' AND projId='$rowid';";
        	$run = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

        	if($run){
				header("Location:completedproj.php");
			}
			else{
				echo "<script>alert('Could not enter participants. Please try again.');</script>";
			}	
     	}
     	else{
     		header("Location:completedproj.php");
     	}   
     }
   }
	
}
////////////////////////////////////Remove Participants///////////////////////////////////
//////////////////////////////////Add new completed project///////////////////////////////

if (isset($_POST['submit-add'])) {

	if(!empty($_POST['id'])&&!empty($_POST['name'])){

		$id = $_POST['id'];
		$orgId = $_SESSION['session_orgid'];
		$name = $_POST['name'];
		$startDate = $_POST['startDate'];
		$finishDate = $_POST['finishDate'];
		$location  = $_POST['location'];
		$cost = $_POST['cost'];
		$description = $_POST['description'];

		$sql2 = "INSERT INTO completedproj (id,orgId,name,startDate,finishDate,location,cost,description) VALUES ('$id','$orgId','$name','$startDate','$finishDate','$location','$cost','$description');";
		$run = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

		if($run){
			header("Location:completedproj.php");
		}
		else{
			echo "<script>alert('Could not submit the details. Please try again.');</script>";
		}

	}
	else{
		echo "<script>alert('Project ID and name are required');</script>";
	}
}

/////////////////////////////////Add new completed project//////////////////////////////
//////////////////////////////////Update completed project//////////////////////////////

if (isset($_POST['submit-edit-details'])) {
	$rowid = $_POST['submit-edit-details'];

	if(!empty($_POST['name'])){

		$id = $_POST['id'];
		$name = $_POST['name'];
		$startDate = $_POST['startDate'];
		$finishDate = $_POST['finishDate'];
		$location  = $_POST['location'];
		$cost = $_POST['cost'];
		$description = $_POST['description'];

		if (empty($description)) {
			$sql3 = "UPDATE completedproj SET id='$id',name='$name',startDate='$startDate',finishDate='$finishDate',location='$location',cost='$cost' WHERE id='$rowid' AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
		}
		else{
			$sql4 = "UPDATE completedproj SET id='$id',name='$name',startDate='$startDate',finishDate='$finishDate',location='$location',cost='$cost',description='$description' WHERE id='$rowid'AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
		}
		

		if($run){
			echo "<script>alert('Details were successfully updated.');</script>";
		}
		else{
			echo "<script>alert('Could not update the details. Please try again.');</script>";
		}

	}
	else{
		echo "<script>alert('Project name is required');</script>";
	}
}
//////////////////////////////////////Update completed projects/////////////////////////
/////////////////////////////////Update completed projects images/////////////////////////

if (isset($_POST['submit-edit-images'])) {
	$rowid = $_POST['submit-edit-images'];

	
}

/////////////////////////////////Update completed projects images/////////////////////////
////////////////////////////////////////Delete completed projects///////////////////////
if (isset($_POST['submit-delete'])) {
	$rowid = $_POST['submit-delete'];
	$sql5 = "DELETE FROM completedproj WHERE id ='$rowid'AND orgId='$thisOrg';";
	$run = mysqli_query($conn, $sql5) or die(mysqli_error($conn));

	if($run){
		echo "<script>alert('Project details were successfully deleted.');</script>";
	}
	else{
		echo "<script>alert('Could not delete the details. Please try again.');</script>";
	}
}
////////////////////////////////////Delete completed project/////////////////////////////
?>

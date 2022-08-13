<?php 
session_start();
if (!isset($_SESSION['session_orgid'])){
    header("Location: memberlogin.php");
}
$thisOrg = $_SESSION['session_orgid'];
?>

<?php
	include_once 'include.php';
	include_once 'header.php';
?>

<br><br><br>
<?php
//////////////////////////////////////Add new coming project////////////////////////////////////
if (isset($_POST['add-new-proj'])) {
?>
<div class="form-display" id="form8">
  <form action="crudfutureproj.php" method="POST" enctype="multipart/form-data">

  <label id="label1"><b>Add New Coming Project</b></label><br><br><br>
  <label>Project ID </label><input type="number" name="id" required=""><br><br>
  <label>Project Name </label><input type="text" name="name" required=""><br><br>
  <label>Date to Start </label><input type="date" name="dateToStart"><br><br>
  <label>Date to Finish </label><input type="date" name="dateToFinish"><br><br>
  <label>Location </label><input type="text" name="location"><br><br>
  <label>Description </label><textarea type='text' name="description"></textarea><br><br>
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
//////////////////////////////////////Add new coming project////////////////////////////////////
/////////////////////////////////////Edit coming project Details/////////////////////////////////////
if (isset($_POST['edit-details'])) {
  $rowid = $_POST['edit-details'];
  $sql2 = "SELECT * FROM comingproj WHERE id =$rowid AND orgId = '$thisOrg';";
  $result2 = mysqli_query($conn, $sql2);
  $row=mysqli_fetch_array($result2);
  ?>

  <div class="form-display" id="form16">
    <form action="crudfutureproj.php" method="POST">
      <label id="label1"><b>Edit Details Project - <?php echo $rowid; ?></b></label><br><br><br><br>
      <label>New Project ID </label><input type="number" name="id" value="<?php echo $row['id']; ?>"><br><br>
      <label>Project Name </label><input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
      <label>Date to Start </label><input type="date" name="dateToStart" value="<?php echo $row['dateToStart']; ?>"><br><br>
      <label>Date to Finish </label><input type="date" name="dateToFinish" value="<?php echo $row['dateToFinish']; ?>"><br><br>
      <label>Location </label><input type="text" name="location" value="<?php echo $row['location']; ?>"><br><br>
      <label>Description </label><br><textarea name="description"></textarea><br><br><br>
      <div align="center">
        <button type="submit" name="submit-edit-details" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button type="reset" name="reset">Clear</button>
      </div>
    </form>
  </div><?php
}
/////////////////////////////////////Edit coming project Details/////////////////////////////////////
//////////////////////////////////////Edit coming project Images////////////////////////////////////
if (isset($_POST['edit-images'])) {
  $rowid = $_POST['edit-images'];
  ?>

  <div id="form18" class="form-display">
    <form action="crudfutureproj.php" method="POST" enctype="multipart/form-data">
      <label id="label1"><b>Edit Pictures Project - <?php echo $rowid; ?></b></label><br><br><br><br>
      <label>Now </label><input type="file" name="imageCurrent1"><br><br>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input type="file" name="imageCurrent2"><br><br>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input type="file" name="imageCurrent3"><br><br><br>
      <div align="center">
        <button type="submit" name="submit-edit-images" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button type="reset" name="reset">Clear</button>
      </div>
      
    </form>
  </div>
  <?php
}
//////////////////////////////////////Edit coming project Images////////////////////////////////////
///////////////////////////////////////Delete coming project/////////////////////////////////////
if(isset($_POST['delete'])){
  $rowid = $_POST['delete'];
  ?>
  <div id="form17" class="form-display" style="width:35%;background-color:white;">
    <form action="crudongoingproj.php" method="POST">
      <p>Do you want to delete the entire project <?php echo $rowid; ?> ?</p><br>&nbsp&nbsp&nbsp
      <button id="button-warn" type="submit" name="submit-delete" value="<?php echo $rowid; ?>">Yes</button>
    </form>
  </div>
  <?php
}
///////////////////////////////////////Delete coming project/////////////////////////////////////
//////////////////////////////////////Add new coming project////////////////////////////////////
if (isset($_POST['submit-add'])) {

	if(!empty($_POST['name'])){

		$id = $_POST['id'];
		$orgId = $_SESSION['session_orgid'];
		$name = $_POST['name'];
		$dateToStart = $_POST['dateToStart'];
		$dateToFinish = $_POST['dateToFinish'];
		$location  = $_POST['location'];
		$description = $_POST['description'];

		$imageCurrent1 = addslashes(file_get_contents($_FILES['imageCurrent1']['tempCurrent1']));

		$sql1 = "INSERT INTO comingproj (id,orgId,name,dateToStart,dateToFinish,location,description,imageCurrent1) VALUES ('$id','$orgId','$name','$dateToStart','$dateToFinish','$location','$description','$imageCurrent1');";
		$run = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		if($run){
			header("Location:futureproj.php");
		}
		else{
			echo "<script>alert('Could not submit the details. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Project name is required');</script>";
	}
}

//////////////////////////////////////Add new coming project////////////////////////////////////
///////////////////////////////////////Edit coming project/////////////////////////////////////

if (isset($_POST['submit-edit-details'])) {
	$rowid = $_POST['submit-edit-details'];

	if(!empty($_POST['name'])){

		$id = $_POST['id'];
		$name = $_POST['name'];
		$dateToStart = $_POST['dateToStart'];
		$dateToFinish = $_POST['dateToFinish'];
		$location  = $_POST['location'];
		$description = $_POST['description'];

		if (empty($description)) {
			$sql2 = "UPDATE comingproj SET id='$id',name='$name',dateToStart='$dateToStart',dateToFinish='$dateToFinish',location='$location' WHERE id='$rowid'AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
		}
		else{
			$sql3 = "UPDATE comingproj SET id='$id' name='$name',dateToStart='$dateToStart',dateToFinish='$dateToFinish',location='$location',description='$description' WHERE id='$rowid'AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
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

///////////////////////////////////////Edit coming project/////////////////////////////////////
////////////////////////////////////Edit coming project images//////////////////////////////////

if (isset($_POST['submit-edit-images'])) {
	$rowid = $_POST['submit-edit-images'];
	
	
	$imageCurrent2 = $_FILES['imageCurrent2']['name'];


	// $imageCurrent2 = addslashes(file_get_contents($_FILES['imageCurrent2']['tempCurrent2']));
	// $imageCurrent3 = addslashes(file_get_contents($_FILES['imageCurrent3']['tempCurrent3']));

	$sql4 = "UPDATE comingproj SET imageCurrent2='$imageCurrent2' WHERE id='$rowid'AND orgId='$thisOrg';";
	$run = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

	if($run){
		echo "<script>alert('Project images were successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the images. Please try again.');</script>";
	}
}

////////////////////////////////////Edit coming project images//////////////////////////////////
///////////////////////////////////////Delete coming project/////////////////////////////////////

if (isset($_POST['submit-delete'])) {
	$rowid = $_POST['submit-delete'];
	$sql5 = "DELETE FROM comingproj WHERE id ='$rowid' AND orgId = '$thisOrg';";
	$run = mysqli_query($conn, $sql5) or die(mysqli_error($conn));

	if($run){
		echo "<script>alert('Project details were successfully deleted.');</script>";
	}
	else{
		echo "<script>alert('Could not delete the details. Please try again.');</script>";
	}
}

///////////////////////////////////////Delete coming project/////////////////////////////////////
include_once 'footer.php';
?>


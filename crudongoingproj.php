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
////////////////////////////////////////////Add ongoing project////////////////////////////////////
if (isset($_POST['add-new-proj'])) {
?>
<div class="form-display" id="form7">
  <form action="crudongoingproj.php" method="POST" enctype="multipart/form-data">

  <label id="label1"><b>Add New Ongoing Project</b></label><br><br><br>
  <label>Project ID </label><input type="number" name="id" required=""><br><br>
  <label>Project Name </label><input type="text" name="name" required=""><br><br>
  <label>Started Date </label><input type="date" name="startDate"><br><br>
  <label>Date to Finish </label><input type="date" name="dateToFinish"><br><br>
  <label>Location </label><input type="text" name="location"><br><br>
  <label>Current status </label><textarea type="text" name="currentStatus"></textarea><br><br>
  <label>Description </label><textarea type='text' name="description"></textarea><br><br><br>
  <label>Before </label><input type="file" name="imageBefore1"><br><br><br>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <input type="file" name="imageBefore2"><br><br><br>
  <label>Now </label><input type="file" name="imageCurrent1"><br><br><br>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <input type="file" name="imageCurrent2"><br><br><br>
  <div align="center">
    <button type="submit" name="submit-add" >Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <button type="reset" name="reset" >Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  </div>
  
  </form>
</div>
<?php
}
////////////////////////////////////////////Add ongoing project////////////////////////////////////
///////////////////////////////////////Update ongoing project Details/////////////////////////////////
if (isset($_POST['edit-details'])) {
  $rowid = $_POST['edit-details'];
  $sql2 = "SELECT * FROM ongoingproj WHERE id =$rowid AND orgId='$thisOrg';";
  $result2 = mysqli_query($conn, $sql2);
  $row=mysqli_fetch_array($result2);
  ?>

  <div class="form-display" id="form17">
    <form action="crudongoingproj.php" method="POST">
      <label id="label1"><b>Edit Details Project - <?php echo $rowid; ?></b></label><br><br><br><br>
      <label>New Project ID </label><input type="number" name="id" value="<?php echo $row['id']; ?>"><br><br>
      <label>Project Name </label><input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
      <label>Started Date </label><input type="date" name="startDate" value="<?php echo $row['startDate']; ?>"><br><br>
      <label>Date to Finish </label><input type="date" name="dateToFinish" value="<?php echo $row['dateToFinish']; ?>"><br><br>
      <label>Location </label><input type="text" name="location" value="<?php echo $row['location']; ?>"><br><br>
      <label>Current Status </label><br><textarea name="currentStatus"></textarea><br><br>
      <label>Description </label><br><textarea name="description"></textarea><br><br>
      <div align="center">
        <button type="submit" name="submit-edit-details" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      </div>

    </form>
  </div><?php
}
///////////////////////////////////////Update ongoing project Details/////////////////////////////////
///////////////////////////////////////Update ongoing project Images/////////////////////////////////
if (isset($_POST['edit-images'])) {
  $rowid = $_POST['edit-images'];
  ?>
  <div id="form18" class="form-display">
    <form action="crudongoingproj.php" method="POST">
      <label id="label1"><b>Edit Pictures Project - <?php echo $rowid; ?></b></label><br><br><br><br>
      <label>Before </label><input type="file" name="imageBefore1"><br><br>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input type="file" name="imageBefore2"><br><br>
      <label>Now </label><input type="file" name="imageCurrent1"><br><br>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <input type="file" name="imageCurrent2"><br><br>
      <div align="center">
        <button type="submit" name="submit-edit-images" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      </div>
      
    </form>
  </div>
  <?php
}
///////////////////////////////////////Update ongoing project Images/////////////////////////////////
///////////////////////////////////////////Delete ongoing project//////////////////////////////////
if(isset($_POST['delete'])){
  $rowid = $_POST['delete'];
  ?>
  <div id="form16" class="form-display" style="width:35%;background-color:white;">
    <form action="crudongoingproj.php" method="POST">
      <p>Do you want to delete the entire project <?php echo $rowid; ?> ?</p><br>&nbsp&nbsp&nbsp
      <button id="button-warn" type="submit" name="submit-delete" value="<?php echo $rowid; ?>">Yes</button>&nbsp&nbsp&nbsp
    </form>
  </div>
  <?php
}
///////////////////////////////////////Delete ongoing project///////////////////////////////
////////////////////////////////////////Add ongoing project/////////////////////////////////

if (isset($_POST['submit-add'])) {
	
	if(!empty($_POST['id'])&&!empty($_POST['name'])){

		$id = $_POST['id'];
		$orgId = $_SESSION['session_orgid'];
		$name = $_POST['name'];
		$startDate = $_POST['startDate'];
		$dateToFinish = $_POST['dateToFinish'];
		$location  = $_POST['location'];
		$currentStatus = $_POST['currentStatus'];
		$description = $_POST['description'];
		//$imageBefore = $_FILES['imageBefore'];
		//$imageCurrent = $_FILES['imageCurrent'];

		$imageBefore1 = addslashes(file_get_contents($_FILES['imageBefore1']['temp_Before1']));
		$imageBefore2 = addslashes(file_get_contents($_FILES['imageBefore2']['temp_Before2']));
		$imageCurrent1 = addslashes(file_get_contents($_FILES['imageCurrent1']['temp_Current1']));
		$imageCurrent2 = addslashes(file_get_contents($_FILES['imageCurrent2']['temp_Current2']));

		//$fileName = $_FILES['images']['imageName'];
		//$fileTmpName = $_FILES['images']['tmp_imageName'];
		//$fileSize = $_FILES['images']['size'];
		//$fileError = $_FILES['images']['error'];
		//$fileType = $_FILES['images']['type'];


		$sql1 = "INSERT INTO ongoingproj (id,orgId,name,startDate,DateToFinish,location,currentStatus,description,imageBefore1,imageBefore2,imageCurrent1,imageCurrent2) VALUES ('$id','$orgId','$name','$startDate','$dateToFinish','$location','$currentStatus','$description','$imageBefore1','$imageBefore2','$imageCurrent1','$imageCurrent2');";
		$run2 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		if($run2){
			header("Location:ongoingproj.php");
		}
		else{
			echo "<script>alert('Could not submit the details. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Project ID and name are required');</script>";
	}
}

//////////////////////////////////////////Add ongoing project///////////////////////////////////
////////////////////////////////////////Update ongoing project/////////////////////////////////

if (isset($_POST['submit-edit-details'])) {
	$rowid = $_POST['submit-edit-details'];
	
	if(!empty($_POST['id'])&&!empty($_POST['name'])){

		$id = $_POST['id'];
		$name = $_POST['name'];
		$startDate = $_POST['startDate'];
		$dateToFinish = $_POST['dateToFinish'];
		$location  = $_POST['location'];
		$currentStatus = $_POST['currentStatus'];
		$description = $_POST['description'];

		if(empty($description)){
			$sql2 = "UPDATE ongoingproj SET id='$id',name='$name',startDate='$startDate',dateToFinish='$dateToFinish',location='$location',currentStatus='$currentStatus' WHERE id='$rowid' AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
		}
		else{
			$sql3 = "UPDATE ongoingproj SET id='$id',name='$name',startDate='$startDate',dateToFinish='$dateToFinish',location='$location',currentStatus='$currentStatus',description='$description' WHERE id='$rowid'AND orgId='$thisOrg';";
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

////////////////////////////////////////Update ongoing project/////////////////////////////////
//////////////////////////////////Update ongoing project images//////////////////////////////

if (isset($_POST['submit-edit-images'])) {
	$rowid = $_POST['submit-edit-images'];

	// if(!empty($_POST['imageBefore1'])){
		$nimageBefore1 = addslashes(file_get_contents($_FILES['imageBefore1']["temp_Before1"]));
		$sql3 = "UPDATE ongoingproj SET imageBefore1 = '$nimageBefore1' WHERE id='$rowid' AND orgId='$thisOrg';";
		$run3 = mysqli_query($conn,$sql3) or die (mysqli_error($conn));
	// }
	if(!empty($_POST['imageBefore2'])){
		$imageBefore2 = addslashes(file_get_contents($_FILES['imageBefore2']['temp_Before2']));
		$sql4 = "UPDATE ongoingproj SET imageBefore2 = '$imageBefore2' WHERE id='$rowid' AND orgId='$thisOrg';";
		$run4 = mysqli_query($conn,$sql4) or die (mysqli_error($conn));
	}
	// if(!empty($_POST['imageCurrent1'])){
		$nimageCurrent1 = addslashes(file_get_contents($_FILES['imageCurrent1']["temp_Current1"]));
		$sql5 = "UPDATE ongoingproj SET imageCurrent1 = '$nimageCurrent1' WHERE id='$rowid' AND orgId='$thisOrg';";
		$run5 = mysqli_query($conn,$sql5) or die (mysqli_error($conn));
	// }
	if(!empty($_POST['imageCurrent2'])){
		$imageCurrent2 = addslashes(file_get_contents($_FILES['imageCurrent2']['temp_Curent2']));
		$sql6 = "UPDATE ongoingproj SET imageCurrent2 = '$imageCurrent2' WHERE id='$rowid' AND orgId='$thisOrg';";
		$run6 = mysqli_query($conn,$sql6) or die (mysqli_error($conn));
	}

	if($run3&&$run5){
		echo "<script>alert('Project images were successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the images. Please try again.');</script>";
	}

}

//////////////////////////////////Update ongoing project images//////////////////////////////
///////////////////////////////////////Delete ongoing project///////////////////////////////

if (isset($_POST['submit-delete'])) {
	$rowid = $_POST['submit-delete'];
	$sql34 = "DELETE FROM ongoingproj WHERE id ='$rowid' AND orgId='$thisOrg';";
	$run = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

	if($run){
		echo "<script>alert('Project details were successfully deleted.');</script>";
	}
	else{
		echo "<script>alert('Could not delete the details. Please try again.');</script>";
	}
}

///////////////////////////////////////Delete ongoing project////////////////////////////////
include_once 'footer.php';
?>
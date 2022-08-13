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

<?php  
$recordsPerPage = 5;
$page = '';

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
else{
	$page = 1;
}
$startFrom = ($page-1)*$recordsPerPage;
$sql1 = "SELECT * FROM completedproj WHERE orgId='$thisOrg' ORDER BY id ASC LIMIT $startFrom,$recordsPerPage;";
$result1 = mysqli_query($conn, $sql1);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Completed Projects</title>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menuorganization.php';
?>

<br>
<H4> SUCCESSFUL PROJECTS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br>
	
<form action="crudcompletedproj.php" method="POST" style="line-height:140%" target="_blank">

<button id="button2" type="submit" name="add-new-proj">Add New Completed Project</button>
<br><br><br>
	
<?php
	$resultCheck1 = mysqli_num_rows($result1);

	if($resultCheck1>0){
		while ($row=mysqli_fetch_assoc($result1)){

			echo "<b>Project Number".str_repeat('&nbsp;', 1).": </b>".$row['id']."<br>";
			echo "<b>Project Name".str_repeat('&nbsp;', 5).": </b>".$row['name']."<br>";
			echo "<b>Started Date".str_repeat('&nbsp;', 7).": </b>".$row['startDate']."<br>";
			echo "<b>Finished Date".str_repeat('&nbsp;', 4).": </b>".$row['finishDate']."<br>";
			echo "<b>Location".str_repeat('&nbsp;', 13).": </b>".$row['location']."<br>";
			echo "<b>Total Cost".str_repeat('&nbsp;', 11).": </b> Rs.".$row['cost']."<br>";
			echo "<b>More Details".str_repeat('&nbsp;', 7).": </b>";?>
			<div style="padding-left: 190px;">
				<?php echo $row['description'];  ?>
			</div><br>
			<b>Before</b><br>
			<img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imageBefore1']); ?>" />	
			<img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imageBefore2']); ?>" />
			<br><br><b>Now</b><br>
			<img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imageCurrent1']); ?>" />	
			<img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imageCurrent2']); ?>" />	
			<img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imageCurrent3']); ?>" />	
			<br><br>
			<button id="button1" style="width:auto;" type="submit" name="participants" value="<?php echo $row['id']; ?>">Participants</button>&nbsp&nbsp&nbsp
			<button id="button1" style="width:auto;" type="submit" name="edit-details" value="<?php echo $row['id']; ?>">Edit Details</button>&nbsp&nbsp&nbsp
			<button id="button1" style="width:auto;" type="submit" name="edit-images" value="<?php echo $row['id']; ?>">Edit Pictures</button>&nbsp&nbsp&nbsp
			<button id="button-warn" type="submit" name="delete" value="<?php echo $row['id']; ?>">Delete</button><br><br><br><hr id="hr1"><br><br><?php
		}
	}	
?>

</form>	

<?php

echo "<br><br><br>";
echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);
		
	$sql2 = "SELECT * FROM completedproj WHERE orgId='$thisOrg' ORDER BY id ASC;";
	$result2 = mysqli_query($conn, $sql2);
	$totalRecords = mysqli_num_rows($result2);
	$totalPages = ceil($totalRecords/$recordsPerPage);

	for ($i=1; $i <= $totalPages; $i++) { 
		echo '<a href="completedproj.php?page='.$i.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
	}
	echo "</div>";
?>

<?php
include_once 'footer.php';
?>
</body>
</html>


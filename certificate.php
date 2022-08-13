<?php 
session_start();
if (!isset($_SESSION['session_orgid'])){
    header("Location: organizationlogin.php");
}
?>

<?php
  include_once 'include.php';
  include_once 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Certificate</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menuorganization.php';
?>

<br>
<H4> ISSUING CERTIFICATES </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br><br>

<div>
	<form action="certificate.php" method="POST">
		<label><i class="fa fa-search" style="font-size:130%"></i>&nbsp&nbsp Enter the full name</label><input type="text" name="fullName">&nbsp&nbsp
		<button type="submit" name="nameSubmit">Search</button><br><br><br>
		<label><i class="fa fa-search" style="font-size:130%"></i>&nbsp&nbsp Enter the NIC</label><input type="text" name="nic">&nbsp&nbsp
		<button type="submit" name="nicSubmit">Search</button>
	</form>
</div>
<br><br>


<?php

if (isset($_POST['nameSubmit'])) {

	if (!empty($_POST['fullName'])) {
		
		$fullName = $_POST['fullName'];
		$sql1 = "SELECT * FROM members WHERE fullName = '$fullName'";
		$result1 = mysqli_query($conn1, $sql1);
		$row=mysqli_fetch_array($result1);
		
		if(mysqli_num_rows($result1)>0){

		?>  <div style="border:2px solid black;padding:30px;width:60%;">
			<form action="viewcertificate.php" method="POST" target="_blank"> 
			<?php

			echo "<b>Check the details</b><br><br>";
			echo "<b>Member ID</b>".str_repeat('&nbsp;', 2).": ".$row['id']."<br>";
			echo "<b>Full name</b>".str_repeat('&nbsp;', 4).": ".$row['fullName']."<br>";
			echo "<b>NIC</b>".str_repeat('&nbsp;', 15).": ".$row['nic']."<br>";
			echo "<b>Contact No</b>".str_repeat('&nbsp;', 2).": 0".$row['contactNo']."<br>";
			echo "<b>Email</b>".str_repeat('&nbsp;', 12).": ".$row['email']."<br>";
			echo "<b>Address</b>".str_repeat('&nbsp;', 7).": ".$row['address']."<br>";
			echo "<b>Join Date</b>".str_repeat('&nbsp;', 5).": ".$row['joinDate']."<br>";

			?>
			<label style="width:15%;"><b>Further</b></label><br><textarea name="further" style="width:630px;height:300px;"></textarea><br><br>
			<button id="button2" name="certificate" value="<?php echo $row['id']; ?>">View Vertificate</button>
			</form></div>

		<?php
		}
		else{
			echo "<script>alert('Full name is invalid. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Please enter Full Name.');</script>";
	}
}
if (isset($_POST['nicSubmit'])){

	if (!empty($_POST['nic'])) {
		
		$nic = $_POST['nic'];
		$sql2 = "SELECT * FROM members WHERE nic = '$nic'";
		$result2 = mysqli_query($conn1, $sql2);
		$row=mysqli_fetch_array($result2);

		if(mysqli_num_rows($result2)>0){

			?>  <div style="border:2px solid black;padding:30px;width:60%;">
			<form action="viewcertificate.php" method="POST" target="_blank"> 
			<?php

			echo "<b>Check the details</b><br>";
			echo "<b>Member ID</b>".str_repeat('&nbsp;', 2).": ".$row['id']."<br>";
			echo "<b>Full name</b>".str_repeat('&nbsp;', 4).": ".$row['fullName']."<br>";
			echo "<b>NIC</b>".str_repeat('&nbsp;', 15).": ".$row['nic']."<br>";
			echo "<b>Contact No</b>".str_repeat('&nbsp;', 2).": 0".$row['contactNo']."<br>";
			echo "<b>Email</b>".str_repeat('&nbsp;', 12).": ".$row['email']."<br>";
			echo "<b>Address</b>".str_repeat('&nbsp;', 7).": ".$row['address']."<br>";
			echo "<b>Join Date</b>".str_repeat('&nbsp;', 5).": ".$row['joinDate']."<br>";

			?>
			<label style="width:15%;"><b>Further</b></label><br>
			<textarea name="further" rows="10" cols="15"></textarea><br><br>
			<button id="button2" name="certificate" value="<?php echo $row['id']; ?>">View Certificate</button> 
			</form></div>

			<?php

		}
		else{
			echo "<script>alert('NIC no is invalid. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Please enter NIC number.');</script>";
	}
}
?>

<?php
include_once 'footer.php';
?>
</body>
</html>


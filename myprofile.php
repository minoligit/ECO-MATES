<?php 
session_start();
include_once 'include.php';
if (isset($_SESSION['session_memberid'])){
	$memberId = $_SESSION['session_memberid'];
	$sql1 = "SELECT * FROM members WHERE id = '$memberId';";
	$result1 = mysqli_query($conn1, $sql1);
	$row1 = mysqli_fetch_assoc($result1);
  $thisOrg = $row1['orgId'];
}
else{
  header("Location: memberlogin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php	
include_once 'header.php';
?>

<br><h4><?php echo $row1['fullName'];  ?></h4>
<hr style="line-height:1px; border-color:#006400;">
<br><br>

<div>
<form action="myprofile.php" method="POST">
	
<table>
	<thead>
		<tr>
			<td style="column-width:500px;height: 400px;">
						<img width="300px" height="300px" border="5px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row1['profilePic']); ?>"/><br>
						<button class="profile-edit1" type="submit" name="edit-profilePic" value="<?php echo $memberId; ?>">Add New Profile Picture</button>	
			</td>
			<td style="column-width:600px;line-height: 200%;"><b>
				Member ID<?php echo str_repeat('&nbsp;', 3).": ".$row1['id']; ?><br>
				Full Name<?php echo str_repeat('&nbsp;', 5).": ".$row1['fullName']; ?><br>
				NIC number<?php echo str_repeat('&nbsp;', 2).": ".$row1['nic']; ?><br>
				Gender<?php echo str_repeat('&nbsp;', 10).": ".$row1['gender']; ?><br>
				Date of Birth<?php echo str_repeat('&nbsp;', 1).": ".$row1['bDate']; ?></b>
			</td>
			<td style="column-width:60px;">
				<br><br><br><br><br>
				<button class="profile-edit1" type="submit" name="edit-gender" value="<?php echo $memberId; ?>">Edit</button><br>
				<button class="profile-edit1" type="submit" name="edit-bDate" value="<?php echo $memberId; ?>">Edit</button><br>
			</td>
		</tr>
	</thead>
</table>
<br><br>

<?php 
if (isset($_POST['edit-profilePic'])) {
	$rowid = $_POST['edit-profilePic'];
	?>
	<div class="profile-popup" id="form30">
		<form action="myprofile.php" method="POST" enctype="multipart/form-data">
			<br>Upload the new profile picture<br><br>
			<input type="file" name="profilePic"><br><br>
			<button class="profile-submit" type="submit" name="submit-profilePic" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form30').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}
?>

<table>
	<thead>
		<tr>
			<td class="profile-sections" style="width:50%;">
				<table style="width:70%;">
					<tr>
						<td style="column-width:80%;line-height: 200%;">
							<div class="profile-headings">Contact Details</div>
							<i class='fas fa-phone'></i> Contact No<?php echo str_repeat('&nbsp;', 2).": 0".$row1['contactNo']; ?><br>
							<i class="fa fa-envelope"></i> Email<?php echo str_repeat('&nbsp;', 10).": ".$row1['email']; ?><br>
							<i class='fas fa-home'></i> Address<?php echo str_repeat('&nbsp;', 6).": ".$row1['address']; ?>
							</div>
						</td>
						<td style="column-width:20%;"><br>
							<button class="profile-edit2" type="submit" name="edit-contactNo" value="<?php echo $memberId; ?>">Edit</button><br>
							<button class="profile-edit2" type="submit" name="edit-email" value="<?php echo $memberId; ?>">Edit</button><br>
							<button class="profile-edit2" type="submit" name="edit-address" value="<?php echo $memberId; ?>">Edit</button><br>
						</td>
					</tr>
				</table>	
			</td>
			<td style="column-width:20%;"></td>
			<td class="profile-sections" style="width:30%;align-self: center;">
				<table>
					<tr>
						<td style="column-width:70%;line-height: 200%;">
							<div class="profile-headings">Manage User Account</div>
							<i class='fas fa-user-circle'></i> Username<?php echo str_repeat('&nbsp;',2).": ".$row1['username']; ?><br>
							<i class='fas fa-lock'></i> Password<?php echo str_repeat('&nbsp;',3).": ".$row1['password']." ";?> 
							<i class="far fa-eye" onclick="showPassword()"></i> 
						</td>
						<td style="column-width:30%;"><br><br>
							<button class="profile-edit2" type="submit" name="edit-username" value="<?php echo $memberId; ?>">Edit</button><br>
							<button class="profile-edit2" type="submit" name="edit-password" value="<?php echo $memberId; ?>">Edit</button><br>
						</td>
					</tr>
				</table>	
			</td>
		</tr>
	</thead>
</table>
<br><br><br>

<?php 
$orgId = $row1['orgId'];
$sql2 = "SELECT * FROM organization WHERE id = '$orgId';";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_assoc($result2);
?>

<div class="profile-sections" style="width:50%;line-height: 150%;">
	<div class="profile-headings">Payments and Other</div><br>
	Organization Id<?php echo str_repeat('&nbsp;', 22).": ".$row2['name']; ?><br>
	Joined Date<?php echo str_repeat('&nbsp;', 27).": ".$row1['joinDate']; ?><br>
	Membership fee for this year : 
	<?php if ($row1['annualFee']==1) { ?> <div style="padding-left:60px;"><b>Paid</b></div><?php }
				else { ?> <div style="color:red;padding-left:60px;"><b>Not-Paid</b></div><?php } ?>
	Last Payment<?php echo str_repeat('&nbsp;', 25).": Rs. ".$row1['lastPaidAmount']." on ".$row1['lastPaidDateTime']; ?><br>
	Total Payments<?php echo str_repeat('&nbsp;', 22).": Rs. ".$row1['totalPayments']; ?><br><br>
	<div align="right">Contact the organization <?php echo $row2['name']; ?> to edit details</div>
</div>

</form>
</div>
<br><br><br>

<!------------------------------------ Display participated projects -------------------------------------->
<h3>Participated Projects</h3><br>
<table id="tablestyle1" style="width:80%;">
	<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
		<th>No</th>
		<th>Project Id</th>
		<th>Project Name</th>
		<th>Location</th>
	</tr>
	<?php 

	$sql3 = "SELECT * FROM memberproj WHERE memberId='$memberId';"; 
	$result3 = mysqli_query($conn1, $sql3);
	$i=1;

	while ($row3=mysqli_fetch_assoc($result3)){
		$id = $row3['projId'];
		$sql4 = "SELECT * FROM completedproj WHERE id='$id' AND orgId='$thisOrg';"; 
		$result4 = mysqli_query($conn, $sql4);
		$row4 = mysqli_fetch_assoc($result4)
	?>
	<tr style="line-height:150%;">
		<td><?php echo $i; ?></td>
		<td><?php echo $id; ?></td>
		<td><?php echo $row4['name']; ?></td>
		<td><?php echo $row4['location']; ?></td>
	</tr>
	<?php
	$i++;
	}
?>
</table>
<!------------------------------------ Display participated projects -------------------------------------->
<br><br>

<!---------------------------------------- Display Payment Table ------------------------------------------>
<h3>Payment Details</h3><br>
<table id="tablestyle1" style="width:80%;">
	<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
		<th>No</th>
		<th>Type</th>
		<th>Paid amount (Rs.)</th>
		<th>Date & Time</th>
	</tr>
	<?php 

	$sql3 = "SELECT * FROM income WHERE memberId='$rowid';"; 
	$result3 = mysqli_query($conn1, $sql3);
	$i=1;

	while ($row=mysqli_fetch_assoc($result3)){
	?>
	<tr style="line-height:150%;">
		<td><?php echo $i; ?></td>
		<td><?php echo $row['type']; ?></td>
		<td><?php echo $row['amount']; ?></td>
		<td><?php echo $row['paidDateTime']; ?></td>
	</tr>
	<?php
	$i++;
	}
?>
</table>
<!---------------------------------------- Display Payment Table ------------------------------------------>
<br><br>
<?php

if (isset($_POST['edit-gender'])) {
	$rowid = $_POST['edit-gender'];
	?>
	<div id="form23" class="profile-edit-form">
		<form action="myprofile.php" method="POST">
			Enter the gender<br>
			<input id="inputRadio" type="radio" name="gender" value="Male">&nbspMale&nbsp&nbsp&nbsp&nbsp
			<input id="inputRadio" type="radio" name="gender" value="Female">&nbspFemale&nbsp&nbsp&nbsp&nbsp
			<input id="inputRadio" type="radio" name="gender" value="Other">&nbspOther<br><br>
			<button class="profile-submit" type="submit" name="submit-gender" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form23').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}
if (isset($_POST['edit-bDate'])) {
	$rowid = $_POST['edit-bDate'];
	?>
	<div id="form24" class="profile-edit-form">
		<form action="myprofile.php" method="POST">
			Enter the date of birth<br><input type="date" name="bDate"><br><br>
			<button class="profile-submit" type="submit" name="submit-bDate" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form24').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}
if (isset($_POST['edit-contactNo'])) {
	$rowid = $_POST['edit-contactNo'];
	?>
	<div id="form25" class="profile-edit-form">
		<form action="myprofile.php" method="POST">
			Enter the contact no<br><input type="number" name="contactNo"><br><br>
			<button class="profile-submit" type="submit" name="submit-contactNo" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form25').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}
if (isset($_POST['edit-email'])) {
	$rowid = $_POST['edit-email'];
	?>
	<div id="form26" class="profile-edit-form">
		<form action="myprofile.php" method="POST">
			Enter the email<br><input type="text" name="email"><br><br>
			<button class="profile-submit" type="submit" name="submit-email" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form26').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}
if (isset($_POST['edit-address'])) {
	$rowid = $_POST['edit-address'];
	?>
	<div id="form27" class="profile-edit-form">
		<form action="myprofile.php" method="POST">
			Enter the address<br><input type="text" name="address"><br><br>
			<button class="profile-submit" type="submit" name="submit-address" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form27').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}
if (isset($_POST['edit-username'])) {
	$rowid = $_POST['edit-username'];
	?>
	<div id="form28" class="profile-edit-form">
		<form action="myprofile.php" method="POST">
			Enter the username<br><input type="text" name="username"><br><br>
			<button class="profile-submit" type="submit" name="submit-username" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form28').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}
if (isset($_POST['edit-password'])) {
	$rowid = $_POST['edit-password'];
	?>
	<div id="form29" class="profile-edit-form">
		<form action="myprofile.php" method="POST">
			Enter the password<br><input type="text" name="password"><br>
			Confirm password<br><input type="text" name="confirmPassword"><br><br>
			<button class="profile-submit" type="submit" name="submit-password" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form29').style.display.'none'">Exit</button>
		</form>
	</div>
	<?php
}

?>


<?php
include_once 'footer.php';
?>

</body>
</html>

<?php 

if (isset($_POST['submit-gender'])) {
	$rowid = $_POST['submit-gender'];
	$gender = $_POST['gender'];
	$sql4 = "UPDATE members SET gender='$gender' WHERE id='$rowid';";
	$run = mysqli_query($conn1, $sql4) or die(mysqli_error($conn1));
}
if (isset($_POST['submit-bDate'])) {
	$rowid = $_POST['submit-bDate'];
	$bDate = $_POST['bDate'];
	$sql5 = "UPDATE members SET bDate='$bDate' WHERE id='$rowid';";
	$run = mysqli_query($conn1, $sql5) or die(mysqli_error($conn1));
}
if (isset($_POST['submit-contactNo'])) {
	$rowid = $_POST['submit-contactNo'];
	$contactNo = $_POST['contactNo'];
	$sql6 = "UPDATE members SET contactNo='$fcontactNo' WHERE id='$rowid';";
	$run = mysqli_query($conn1, $sql6) or die(mysqli_error($conn1));
}
if (isset($_POST['submit-email'])) {
	$rowid = $_POST['submit-email'];
	$email = $_POST['email'];
	$sql7 = "UPDATE members SET email='$email' WHERE id='$rowid';";
	$run = mysqli_query($conn1, $sql7) or die(mysqli_error($conn1));
}
if (isset($_POST['submit-address'])) {
	$rowid = $_POST['submit-address'];
	$address = $_POST['address'];
	$sql8 = "UPDATE members SET address='$address' WHERE id='$rowid';";
	$run = mysqli_query($conn1, $sql8) or die(mysqli_error($conn1));
}
if (isset($_POST['submit-username'])) {
	$rowid = $_POST['submit-username'];
	$username = $_POST['username'];

	if (empty($username)) {
		echo "<script>alert('Username is required');</script>";
	}
	else{
		$sql9 = "UPDATE members SET username='$username' WHERE id='$rowid';";
		$run = mysqli_query($conn1, $sql9) or die(mysqli_error($conn1));
	}
}
if (isset($_POST['submit-password'])) {
	$rowid = $_POST['submit-password'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	if ($password==$confirmPassword) {
		$sql10 = "UPDATE members SET password='$password',confirmPassword='$confirmPassword' WHERE id='$rowid';";
	  $run = mysqli_query($conn1, $sql10) or die(mysqli_error($conn1));
	}
	else{
		echo "<script>alert('Confirmed password is not matching');</script>";
	}	
}
if (isset($_POST['submit-profilePic'])) {
	$rowid = $_POST['submit-profilePic'];
	// $profilePic = $_FILES['profilePic'];
	$profilePic_name = $_FILES['profilePic']['name_profilePic'] ;
	// $profilePic = basename($_FILES["profilePic"]["temp_profilePic"]);

	$profilePic = addslashes(file_get_contents($_FILES['profilePic']['temp_profilePic']));

	$sql11 = "UPDATE members SET profilePic='$profilePic' WHERE id='$rowid';";
	$run = mysqli_query($conn1, $sql11) or die(mysqli_error($conn1));
}
?>
<?php 
session_start();
if (!isset($_SESSION['session_orgid'])){
    header("Location: organizationlogin.php");
}
$rowid = $_SESSION['session_orgid'];
?>

<?php
  include_once 'include.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Organization Details</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menuorganization.php';
include_once 'header.php';
?>

<?php 
	$sql = "SELECT * FROM organization WHERE id='$rowid';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
?>

<br>
<H4> WELCOME TO <?php echo $row['name'];?> </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br>

<button onclick="document.getElementById('form3').style.display = 'block'" id="button2">Update Details</button>&nbsp&nbsp&nbsp&nbsp
<button onclick="document.getElementById('form4').style.display = 'block'" id="button2">Update Images</button><br><br>
<div class="form-popup" id="form3">
<form action="organization.php" method="POST">
	
	<H6> Update Details of the Organization </H6>
	<hr style="line-height:1px; border-color:#006400;"><br><br>
	<label>Name </label><input type="text" name="name"><br><br>
	<label>Founder </label><input type="text" name="founder"><br><br>
	<label>Founded Date </label><input type="date" name="foundDate"><br><br>
	<label>Location </label><input type="text" name="location"><br><br>
	<label>Telephone </label><input type="number" name="telephone"><br><br>
	<label>Email </label><input type="text" name="email"><br><br>
	<label>Current President </label><input type="text" name="currentPresident"><br><br>
	<label>No of Completed Projects </label><input type="number" name="noOfCompProj"><br><br>
	<label>History </label><textarea name="history"></textarea><br><br>
	<label>Authority </label><textarea name="authority"></textarea><br><br>
	<label>Membership </label><textarea name="membership"></textarea><br><br>
	<div align="center">
		<button type="submit" name="submit-details" >Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="reset" name="reset" >Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button onclick="document.getElementById('form3').style.display = 'none'">Exit</button>
	</div>

</form>
</div>
<div class="form-popup" id="form4">
<form action="organization.php" method="POST" enctype="multipart/form-data">
	
	<H6> Update Images of the Organization </H6>
	<hr style="line-height:1px; border-color:#006400;"><br><br>
	<label>Images</label><input type="file" name="organizationPic1"><br><br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="file" name="organizationPic2"><br><br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="file" name="organizationPic3"><br><br><br>
	<div align="center">
		<button type="submit" name="submit-images" >Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="reset" name="reset" >Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button onclick="document.getElementById('form4').style.display = 'none'">Exit</button>
	</div>

</form>
</div>

	<table>
		<thead>
			<td style="column-width:70%;text-align: left;padding-top: 0;">
				<ol>
					<li>History</li>
					<li>Location</li>
					<li>Contact Details</li>
					<li>Authority</li>
					<li>Membership</li>
				</ol>
				<br><br>
				&#10020;<?php
				echo " Name of the organization : <b>".$row['name']."</b>"."<br>";
				?>&#10020;<?php
				echo " Founded by ".str_repeat('&nbsp;', 20)." : <b>".$row['founder']."</b> on <b>".$row['foundDate']."</b><br>";
				?>&#10020;<?php 
				echo " Current president ".str_repeat('&nbsp;', 11)." : <b>".$row['currentPresident']."</b>";?>
			</td>
			<td style="column-width:30%;padding-left: 20%;">
				<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['organizationPic1']); ?>" />	
			</td>
		</thead>
	</table>

	<?php
	echo "<br><br><br>"."<b><H3>1. History</H3></b>";
	echo $row['history'];	
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br>"."<b><H3>2. Location</H3></b>";
	echo "The current head office of <b>".$row['name']."</b> is located in ".$row['location'].".";
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br>"."<b><H3>3. Contact Details</H3></b>";
	echo "To join with our organization please contact our coordinator via telephone <b>0".$row['telephone']."</b> or email ";
	?><b><a href="mailto: <?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></b>
	<br><br><br><hr id="hr1"><?php

	echo "<br><br>"."<b><H3>4. Authority</H3></b>";
	echo $row['authority'];
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br><br>"."<b><H3>5. Membership</H3></b>";
	echo $row['membership'];
?>
<br><br><br><br>
<table>
	<thead>
		<tr>
			<td style="column-width:150px;"></td>
			<td style="column-width: 500px;">
				<div align="center">
					<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['organizationPic2']); ?>" />
				</div>
			</td>
			<td style="column-width:150px;"></td>
			<td style="column-width:500px;">
				<div align="center">
					<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['organizationPic3']); ?>" />
				</div>
			</td>
		</tr>
	</thead>
</table>

	
<?php
include_once 'footer.php';
?>
</body>
</html>

<?php
////////////////////////////////Update Organization Details//////////////////////////////
if(isset($_POST['submit-details'])){

if (!empty($_POST['name'])) {
	$name = $_POST['name'];
	$sql1 = "UPDATE organization SET name ='$name' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql1) or die(mysqli_error());

 	if($run){
	 	echo "<script>alert('Organization name was successfully updated.');</script>";
 	}
 	else{
		echo "<script>alert('Could not update the name. Please try again.');</script>";
 	}
}
if (!empty($_POST['founder'])) {
	$founder = $_POST['founder'];
	$sql2 = "UPDATE organization SET founder ='$founder' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql2) or die(mysqli_error());

	if($run){
		echo "<script>alert('Organization founder was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the name of founder. Please try again.');</script>";
	}
}
if (!empty($_POST['foundDate'])) {
	$foundDate = $_POST['foundDate'];
	$sql3 = "UPDATE organization SET foundDate ='$foundDate' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql3) or die(mysqli_error());

	if($run){
		echo "<script>alert('Organization founded date was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the date. Please try again.');</script>";
	}
}
if (!empty($_POST['location'])) {
	$location = $_POST['location'];
	$sql4 = "UPDATE organization SET location ='$location' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql4) or die(mysqli_error());

	if($run){
		echo "<script>alert('Location was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the location. Please try again.');</script>";
	}
}
if (!empty($_POST['telephone'])) {
	$telephone = $_POST['telephone'];
	$sql5 = "UPDATE organization SET telephone ='$telephone' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql5) or die(mysqli_error());

	if($run){
		echo "<script>alert('Telephone number was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the telephone number. Please try again.');</script>";
	}
}
if (!empty($_POST['email'])) {
	$email = $_POST['email'];
	$sql6 = "UPDATE organization SET email ='$email' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql6) or die(mysqli_error());

	if($run){
		echo "<script>alert('Organization email was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the email. Please try again.');</script>";
	}
}
if (!empty($_POST['currentPresident'])) {
	$currentPresident = $_POST['currentPresident'];
	$sql7 = "UPDATE organization SET currentPresident ='$currentPresident' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql7) or die(mysqli_error());

	if($run){
		echo "<script>alert('Current President name was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the name. Please try again.');</script>";
	}
}
if (!empty($_POST['noOfCompProj'])) {
	$noOfCompProj = $_POST['noOfCompProj'];
	$sql8 = "UPDATE organization SET noOfCompProj ='$noOfCompProj' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql8) or die(mysqli_error());

	if($run){
		echo "<script>alert('Number of completed projects was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the number of completed projects. Please try again.');</script>";
	}
}
if (!empty($_POST['history'])) {
	$history = $_POST['history'];
	$sql9 = "UPDATE organization SET history ='$history' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql9) or die(mysqli_error());

	if($run){
		echo "<script>alert('Organization history was successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the history. Please try again.');</script>";
	}
}
if (!empty($_POST['authority'])) {
	$authority = $_POST['authority'];
	$sql10 = "UPDATE organization SET authority ='$authority' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql10) or die(mysqli_error());

	if($run){
		echo "<script>alert('Authority details were successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update authority details. Please try again.');</script>";
	}
}
if (!empty($_POST['membership'])) {
	$membership = $_POST['membership'];
	$sql11 = "UPDATE organization SET membership ='$membership' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql11) or die(mysqli_error());

	if($run){
		echo "<script>alert('Membership details were successfully updated.');</script>";
	}
	else{
		echo "<script>alert('Could not update the membership details. Please try again.');</script>";
	}
}
}
////////////////////////////////Update Organization Details//////////////////////////////
/////////////////////////////////Update Organization Images//////////////////////////////
if (isset($_POST['submit-images'])) {

if (!empty($_POST['organizationPic1'])) {

	$organizationPic1 = addslashes(file_get_contents($_FILES['organizationPic1']['temp_organizationPic1']));
	$sql12 = "UPDATE organization SET organizationPic1 ='$organizationPic1' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql12) or die(mysqli_error());

 	if($run){
 	}
 	else{
		echo "<script>alert('Could not update the image1. Please try again.');</script>";
 	}
}
if (!empty($_POST['organizationPic2'])) {
	$organizationPic2 = $_POST['organizationPic2'];
	$sql13 = "UPDATE organization SET organizationPic2 ='$organizationPic2' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql13) or die(mysqli_error());

 	if($run){
 	}
 	else{
		echo "<script>alert('Could not update the image2. Please try again.');</script>";
 	}
}
if (!empty($_POST['organizationPic3'])) {
	$organizationPic2 = $_POST['organizationPic3'];
	$sql14 = "UPDATE organization SET organizationPic3 ='$organizationPic3' WHERE id='$rowid';";
	$run = mysqli_query($conn, $sql14) or die(mysqli_error());

 	if($run){
 	}
 	else{
		echo "<script>alert('Could not update the image2. Please try again.');</script>";
 	}
}
}
////////////////////////////////Update Organization Images//////////////////////////////
?>

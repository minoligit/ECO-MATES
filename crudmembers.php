<?php 
session_start();
if (!isset($_SESSION['session_orgid'])){
    header("Location: organizationlogin.php");
}
?>

<?php
	include_once 'include.php';
?>

<?php

///////////////////////////////////////Add new members////////////////////////////////////

if (isset($_POST['submit-add'])) {
	
	if($_POST['password'] == $_POST['confirmPassword']){

		if(!empty($_POST['nic'])){	

		$fullName = $_POST['fullName'];
		$nic = $_POST['nic'];
		$gender = $_POST['gender'];
		$contactNo = $_POST['contactNo'];
		$email  = $_POST['email'];
		$address = $_POST['address'];
		$bDate = $_POST['bDate'];
		$orgId =$_SESSION['session_orgid'];
		$joinDate = $_POST['joinDate'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmPassword  = $_POST['confirmPassword'];

		$sql2 = "INSERT INTO members (fullName,nic,gender,contactNo,email,address,bDate,orgId,joinDate,username,password,confirmPassword) VALUES ('$fullName','$nic','$gender','$contactNo','$email','$address','$bDate','$orgId','$joinDate','$username','$password','$confirmPassword');";
			$run2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

		if($run2){
			echo "<script>alert('Details were successfully added.');</script>";
			header("Location:memberdetails.php");
		}
		else{
			echo "<script>alert('Could not submit the details. Please try again');</script>";
		}

	}
	else{
		echo "<script>alert('NIC no is required');</script>";
	}

	}
	else{
		echo "<script>alert('Confirmed password is not matching');</script>";
	}
}

//////////////////////////Add new members//////////////////////////////////
//////////////////////Update existing members///////////////////////////////

if (isset($_POST['submit-update'])) {

	$rowid = $_POST['submit-update'];

	$fullName = $_POST['fullName'];
	$nic = $_POST['nic'];
	$gender = $_POST['gender'];
	$contactNo = $_POST['contactNo'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$bDate = $_POST['bDate'];
	$joinDate = $_POST['joinDate'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	if ($password==$confirmPassword) {
		$sql3 = "UPDATE members SET fullName='$fullName',nic='$nic',gender='$gender',contactNo='$contactNo',email='$email',address='$address',bDate='$bDate',joinDate='$joinDate',username='$username',password='$password',confirmPassword='$confirmPassword' WHERE id='$rowid';";
		$run = mysqli_query($conn1, $sql3) or die(mysqli_error($conn1));

		if ($run) {
			echo "<script>alert('Details were successfully updated.');</script>";
			header("Location:memberdetails.php");
		}
		else{
			echo "<script>alert('Please try again.');</script>";
			header("Location:memberdetails.php");
		}
		
	}
	else{
		echo "<script>alert('Password and Confirmed password are not matching. Please try again.');</script>";
		//header("Location:memberdetails.php");
	}

}	

//////////////////////////////Update existing members////////////////////////////
//////////////////////////////Delete existing members////////////////////////////

if (isset($_POST['submit-delete'])) {

	$rowid = $_POST['submit-delete'];
	$sql4 = "DELETE FROM members WHERE id =$rowid;";
	$run = mysqli_query($conn1, $sql4) or die(mysqli_error($conn1));

	if($run){
		echo "<script>alert('Membership details were successfully deleted.');</script>";
		header("Location:memberdetails.php");
	}
	else{
		echo "<script>alert('Could not delete the membership details. Please try again.');</script>";
		header("Location:memberdetails.php");
	}
		
}
//////////////////////////////Delete existing members////////////////////////////
///////////////////////////////Filter joined dates///////////////////////////////



////////////////////////////////Filter joined dates//////////////////////////////

?>



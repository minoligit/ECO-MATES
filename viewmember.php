<?php 
session_start();
if (!isset($_SESSION['session_orgid'])){
    header("Location: organizationlogin.php");
}
$thisOrg = $_SESSION['session_orgid'];
?>

<?php
  include_once 'include.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Members</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>


<?php
include_once 'header.php';

if (isset($_POST['submit-more'])) {
	
	$rowid = $_POST['submit-more'];
	$sql1 = "SELECT * FROM members WHERE id =$rowid;";
	$result1 = mysqli_query($conn1, $sql1);
	$row=mysqli_fetch_assoc($result1);

	$orgId = $_SESSION['session_orgid'];
  $sql2 = "SELECT * FROM organization WHERE id = '$orgId';";
  $result2 = mysqli_query($conn, $sql2);
  $row2=mysqli_fetch_assoc($result2);

	?>

	<div>
	<form>
		<br><h4><?php echo $row['fullName'];  ?></h4>
		<hr style="line-height:1px; border-color:#006400;">
		<br><br>
		<table>
			<thead>
				<tr>
					<td style="column-width:500px;height: 400px;">
						<img width="300px" height="300px" border="5px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['profilePic']); ?>" />		
					</td>
					<td style="column-width:600px;">
							Member ID <?php echo str_repeat('&nbsp;', 0.5).": ".$row['id'];  ?><br><br>
							Full Name <?php echo str_repeat('&nbsp;', 2).": ".$row['fullName'];  ?><br><br>
							NIC <?php echo str_repeat('&nbsp;', 12).": ".$row['nic'];  ?><br>
					</td>
				</tr>
			</thead>
		</table>
		
		<table>
			<tr>
				<td>
					<p style="line-height:150%;">
					Gender<?php echo str_repeat('&nbsp;', 9).": ".$row['gender'];  ?><br>
					Contact No<?php echo str_repeat('&nbsp;', 3).": 0".$row['contactNo'];  ?><br>
					Email<?php echo str_repeat('&nbsp;', 12).": ".$row['email'];  ?><br>
					Address<?php echo str_repeat('&nbsp;', 8).": ".$row['address'];  ?><br>
					Date of Birth<?php echo str_repeat('&nbsp;', 1).": ".$row['bDate'];  ?><br>
					Organization<?php echo str_repeat('&nbsp;', 1).": ".$row2['name'];  ?><br>
					Joined Date<?php echo str_repeat('&nbsp;', 2).": ".$row['joinDate'];  ?><br>
					</p>
				</td>
				<td width="200px%;"></td>
				<td>
					Annual Fee<?php if ($row['annualFee']==1) {
														?> <div>: Paid</div><?php
													}
													else{
														?> <div style="color:red;">: Not-Paid</div><?php
													} ?>
					<p style="line-height:150%;">
					Last Payment <?php echo str_repeat('&nbsp;', 4).": Rs. ".$row['lastPaidAmount']." on ".$row['lastPaidDateTime'];  ?><br>
					Total Payments <?php echo str_repeat('&nbsp;', 1).": Rs. ".$row['totalPayments'];  ?><br>
					Username<?php echo str_repeat('&nbsp;', 10).": ".$row['username'];  ?><br>
					</p>
				</td>
			</tr>
		</table>

<h5>Participated Projects</h5>	

<table id="tablestyle1" style="width:60%;">
	<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
		<th>No</th>
		<th>Project Id</th>
		<th>Project Name</th>
		<th>Location</th>
	</tr>
	<?php 

	$sql3 = "SELECT * FROM memberproj WHERE memberId='$rowid';"; 
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
<br><br>

<h5>Payment History for <?php echo date("Y")?></h5>	

<table id="tablestyle1" style="width:60%;">
	<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
		<th>No</th>
		<th>Type</th>
		<th>Paid amount (Rs.)</th>
		<th>Date & Time</th>
	</tr>
	<?php 

	$sql2 = "SELECT * FROM income WHERE memberId='$rowid';"; 
	$result2 = mysqli_query($conn1, $sql2);
	$i=1;

	while ($row=mysqli_fetch_assoc($result2)){
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
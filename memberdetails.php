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
	<title>Member Details</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>

<?php
include_once 'menuorganization.php';
?>
<br>
<H4> REGISTERED MEMBERS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br>
<button onclick="document.getElementById('form4').style.display='block'" id="button2">Add New Members</button>
&nbsp&nbsp&nbsp&nbsp&nbsp
<button  onclick="document.getElementById('form5').style.display='block'" id="button2">Send messages</button>
<br><br>

<div class="form-popup" id="form5" style="width:20%;">
	<form action="messages" method="POST" target="_blank">
		<a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form5').style.display = 'none'">&times;</a>
		<br>Select Receivers<br><br>
		<button id="button2" style="background-color:#45c761;" type="submit" name="message-all">All members</button>&nbsp&nbsp&nbsp
		<button id="button2" style="background-color:#45c761;" type="submit" name="message-select">Select members</button>
	</form>
</div>
<p>List of registered members upto <?php echo date("Y-m-d h:i:sa")." , ".date("l"); ?> are shown</p><br>

<div>
<form action="memberdetails.php" method="POST">
<table id="tablestyle1" style="width:100%;">
	<thead>
		<tr style="background-color: #8FBC8F;border: 2px solid black;height: 30px;">
			<th style="column-width: 50px;">Member No</th>
			<th style="column-width: 250px;">Full Name</th>
			<th style="column-width: 180px;">NIC No</th>
			<th style="column-width: 80px;">Gender</th>
			<th style="column-width: 200px;">Contact No</th>
			<th style="column-width: 250px;">Email</th>
			<th style="column-width: 250px;">Address</th>
			<th style="column-width: 180px;">Joined date</th>
			<th style="column-width: 60px;">Proj Done</th>
			<th style="column-width: 60px;"></th>
			<th style="column-width: 60px;"></th>
			<th style="column-width: 60px;"></th>
		</tr>
	</thead>
<?php 
	$sql1 = "SELECT * FROM members;";
	$result1 = mysqli_query($conn1, $sql1);

	while ($row=mysqli_fetch_assoc($result1)){
		$id = $row['id'];
	
	$sql2 = "SELECT * FROM memberproj WHERE memberId='$id';";
	$result2 = mysqli_query($conn1,$sql2);
	$countproj = mysqli_num_rows($result2);

	?>
		<tr style="height:50px;font-size:80%;">
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['fullName']; ?></td>
			<td><?php echo $row['nic']; ?></td>
			<td><?php echo $row['gender']; ?></td>
			<td><?php echo "0".$row['contactNo']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['joinDate']; ?></td>
			<td><?php echo $countproj; ?></td>
			<td><button style="width:70px;" id="button1" type="submit" name="update" value="<?php echo $row['id']; ?>">Update</button></td>
			<td><button style="width:70px;" id="button-warn" type="submit" name="delete" value="<?php echo $row['id']; ?>">Delete</button></td>
			<td><button style="width:70px;" id="button1" type="submit" name="more" value="<?php echo $row['id']; ?>">More</button></td>
			
		</tr><?php 
	}    ?>

</table>
</form>
</div>

<br><br><br>
<?php

if (isset($_POST['update'])){
	$rowid = $_POST['update'];
	$sql2 = "SELECT * FROM members WHERE id =$rowid;";
	$result2 = mysqli_query($conn1, $sql2);
	$row=mysqli_fetch_array($result2);
	?>

<div class="form-display" id="form11">
	<form action="crudmembers.php" method="POST">
		
		<a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form11').style.display = 'none'">&times;</a>
		<label id="label1"><b>Update Member - <?php echo $rowid; ?> Details</b></label><br><br><br>
		<label>Full Name</label><input type="text" name="fullName" value="<?php echo $row['fullName']; ?>"><br><br>
		<label>NIC No</label><input type="text" name="nic" value="<?php echo $row['nic']; ?>"><br><br>
		<label>Gender</label>
		<input id="inputRadio" type="radio" name="gender" value="Male">&nbspMale&nbsp&nbsp&nbsp&nbsp
		<input id="inputRadio" type="radio" name="gender" value="Female">&nbspFemale&nbsp&nbsp&nbsp&nbsp
		<input id="inputRadio" type="radio" name="gender" value="Other">&nbspOther<br><br>
		<label>Contact No</label><input type="number" name="contactNo" value="<?php echo $row['contactNo']; ?>"><br><br>
		<label>Email Address</label><input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
		<label>Address</label><input type="text" name="address" value="<?php echo $row['address']; ?>"><br><br>
		<label>Date of Birth</label><input type="date" name="bDate" value="<?php echo $row['bDate']; ?>"><br><br>
		<label>Joined Date</label><input type="date" name="joinDate" value="<?php echo $row['joinDate']; ?>"><br><br>
		<label>Username</label><input type="text" name="username" value="<?php echo $row['username']; ?>"><br><br>
		<label>Password</label><input type="password" name="password" value="<?php echo $row['password']; ?>"><br><br>
		<label>Confirm Password</label><input type="password" name="confirmPassword" value="<?php echo $row['confirmPassword']; ?>"><br><br><br><br>
		<div align="center">
			<button type="submit" name="submit-update" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<button type="reset" name="reset">Clear</button>
		</div>
	
	</form>
</div>
	
<?php
}
?>

<?php
if (isset($_POST['delete'])) {
	$rowid = $_POST['delete'];

	?>
	<div id="form12" class="delete-popup">
		<form action="crudmembers.php" method="POST">
			<a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form12').style.display = 'none'">&times;</a>
			<p>Do you want to delete the entire member <?php echo $rowid; ?> row ?</p><br>&nbsp&nbsp&nbsp
			<button id="button-warn" type="submit" name="submit-delete" value="<?php echo $rowid; ?>">Yes</button>
		</form>
	</div>
<?php
}

if(isset($_POST['more'])){
	$rowid = $_POST['more'];

	?>
	<div id="form18" class="delete-popup">
		<form action="viewmember.php" method="POST" target="_blank">
			<a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form18').style.display = 'none'">&times;</a>
			<p>Do you want to view more of member <?php echo $rowid; ?> ?</p><br>&nbsp&nbsp&nbsp
			<button id="button1" type="submit" name="submit-more" value="<?php echo $rowid; ?>">Yes</button>
		</form>
	</div>
<?php
}

?>

<br><br><br>
<H4> FILTER MEMBER DETAILS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br><br><br>

<div>
	<form action="memberdetails.php" method="POST">
		<label style="width:200px;">Registered Date</label>
		<input type="date" name="after" style="width:180px;">&nbspAfter&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="date" name="before" style="width:180px;">&nbspBefore&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="submit" name="filterRegDate">Enter</button>
	</form>

<?php 
if (isset($_POST['filterRegDate'])) {
	$after = $_POST['after'];
	$before = $_POST['before'];

		if (!empty($after)&&!empty($before)) {
			$sql2 = "SELECT * FROM members WHERE joinDate>'$after' && joinDate<'$before';";
		}
		elseif(!empty($after)&&empty($before)){
			$sql2 = "SELECT * FROM members WHERE joinDate>'$after';";
		}
		elseif(empty($after)&&!empty($before)){
			$sql2 = "SELECT * FROM members WHERE joinDate<'$before';";
		}
		else{
			echo "<script>alert('No values are entered');</script>";
			exit();
		}

	?>
	<br><br><br>
	<table id="tablestyle1" style="width:80%;">
		<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
			<th>No</th>
			<th>Member ID</th>
			<th>Full Name</th>
			<th>Contact No</th>
			<th>Email</th>
			<th>Joined Date</th>
		</tr>
		
		<?php
		$result2 = mysqli_query($conn1, $sql2);
		$i=1;

		while ($row=mysqli_fetch_assoc($result2)){
		?>

		<tr style="line-height:150%;">
			<td><?php echo $i; ?></td>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['fullName']; ?></td>
			<td><?php echo "0".$row['contactNo']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['joinDate']; ?></td>
		</tr>

		<?php
		$i++;
		}
		?>
	</table>
	<?php	
}
?>
</div>

<br><br><br>
<div>
	<form action="memberdetails.php" method="POST">
		<label style="width:200px;">No of Participated Projects</label>
		<input type="number" name="above" style="width:180px;">&nbspAbove&nbsp&nbsp&nbsp
		<input type="number" name="below" style="width:180px;">&nbspBelow&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="submit" name="filterPartProj">Enter</button>
	</form>

<?php 
if (isset($_POST['filterPartProj'])) {
	$above = $_POST['above'];
	$below = $_POST['below'];

	?>
	<br><br><br>
	<table id="tablestyle1" style="width:80%;">
		<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
			<th>No</th>
			<th>Member ID</th>
			<th>Full Name</th>
			<th>Contact No</th>
			<th>Email</th>
			<th>No of Proj</th>
		</tr>
		<?php

		$sql2 = "SELECT COUNT(projId) as countproj FROM memberproj GROUP BY memberId;";
		$result2 = mysqli_query($conn1, $sql2);

		if (!empty($above)&&!empty($below)) {
			$sql3 = "SELECT * FROM members, memberproj WHERE members.id = memberproj.memberId AND countproj >$above AND countproj <$below;";
		}
		elseif(!empty($above)&&empty($below)){
			$sql3 = "SELECT * FROM members WHERE noOfProj>'$above';";
		}
		elseif(empty($above)&&!empty($below)){
			$sql3 = "SELECT * FROM members WHERE noOfProj<'$below';";
		}
		else{
			echo "<script>alert('No values are entered');</script>";
			exit();
		}
		
		$result3 = mysqli_query($conn1, $sql3);
		$i=1;

		while ($row=mysqli_fetch_assoc($result3)){
		?>

		<tr style="line-height:150%;">
			<td><?php echo $i; ?></td>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['fullName']; ?></td>
			<td><?php echo "0".$row['contactNo']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['noOfProj']; ?></td>
		</tr>

		<?php
		$i++;
		}
		?>
	</table>
	<?php	
}
?>
</div>
<br><br><br>

<div>
	<form action="memberdetails.php" method="POST">
			<label style="width:200px;">Project Members</label>
			<input type="number" name="projId" style="width:180px;"> Project Id
			<?php echo str_repeat('&nbsp;', 49); ?>
			<button type="submit" name="filterProjMembers">Enter</button>
	</form>

<?php  
if (isset($_POST['filterProjMembers'])) {
	$projId = $_POST['projId'];

	if (!empty($projId)) {
		$sql3 = "SELECT * FROM members, memberproj WHERE members.id = memberproj.memberId AND projId = $projId;";
	}
	else{
		echo "<script>alert('No values are entered');</script>";
		exit();
	}
	
	echo "<br><br><br><b>Project No : ".$projId."</b><br><br>";	
	?>
	
	<table id="tablestyle1" style="width:80%;">
		<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
			<th>No</th>
			<th>Member ID</th>
			<th>Full Name</th>
			<th>Contact No</th>
			<th>Email</th>
		</tr>
		<?php

		$result3 = mysqli_query($conn1, $sql3);
		$i=1;

		while ($row=mysqli_fetch_array($result3)){
		?>

		<tr style="line-height:150%;">
			<td><?php echo $i; ?></td>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['fullName']; ?></td>
			<td><?php echo "0".$row['contactNo']; ?></td>
			<td><?php echo $row['email']; ?></td>
		</tr>

		<?php
		$i++;
		}
		?>
	</table>
	<?php	
}

?>
</div>

<br><br><br>
<div>
	<form action="memberdetails.php" method="POST">
		<label style="width:200px;">Annual Payment</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="radio" name="annualFee" value="1" style="width:10%;">&nbsp&nbsp&nbspPaid&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="radio" name="annualFee" value="0" style="width:10%;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNot-Paid&nbsp&nbsp&nbsp
		<button type="submit" name="filterAnnualFee">Enter</button>
	</form>

<?php 
if (isset($_POST['filterAnnualFee'])) {
	
	if (!isset($_POST['annualFee'])) {
		echo "<script>alert('No values are entered');</script>";
		exit();
	}
	else{
		$payment = $_POST['annualFee'];

		if ($payment==1) {
			$sql3 = "SELECT * FROM members WHERE annualFee='1';";
		}
		elseif($payment==0){
			$sql3 = "SELECT * FROM members WHERE annualFee='0';";
		}
	}
	
	?>
	<br><br><br>
	<table id="tablestyle1" style="width:80%;">
		<tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
			<th>No</th>
			<th>Member ID</th>
			<th>Full Name</th>
			<th>Contact No</th>
			<th>Email</th>
			<th>Joined Date</th>
		</tr>
		<?php
		
		$result3 = mysqli_query($conn1, $sql3);
		$i=1;

		while ($row=mysqli_fetch_assoc($result3)){
		?>

		<tr style="line-height:150%;">
			<td><?php echo $i; ?></td>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['fullName']; ?></td>
			<td><?php echo "0".$row['contactNo']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['joinDate']; ?></td>
		</tr>

		<?php
		$i++;
		}
		?>
	</table>
	<?php	
}
?>	
</div>

<div class="form-popup" id="form4">
	<form action="crudmembers.php" method="POST">

	<a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form4').style.display = 'none'">&times;</a>
	<label id="label1"><b>Member Registration</b></label><br><br><br>
	<label>Full Name </label><input type="text" name="fullName" required=""><br><br>
	<label>NIC No </label><input type="text" name="nic" required=""><br><br>
	<label>Gender </label>
	<input id="inputRadio" type="radio" name="gender" value="Male" required="">&nbspMale&nbsp&nbsp&nbsp&nbsp
	<input id="inputRadio" type="radio" name="gender" value="Female" required="">&nbspFemale&nbsp&nbsp&nbsp&nbsp
	<input id="inputRadio" type="radio" name="gender" value="Other" required="">&nbspOther<br><br>
	<label>Contact No </label><input type="number" name="contactNo" required=""><br><br>
	<label>Email Address </label><input type="email" name="email"><br><br>
	<label>Address </label><input type="text" name="address"><br><br>
	<label>Date of Birth </label><input type="date" name="bDate"><br><br>
	<label>Joined Date </label><input type="date" name="joinDate"><br><br>
	<label>Username </label><input type="text" name="username"><br><br>
	<label>Password </label><input type="password" name="password"><br><br>
	<label>Confirm Password </label><input type="password" name="confirmPassword"><br><br><br><br>
	<div align="center">
		<button type="submit" name="submit-add">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button onclick="document.getElementById('form4').style.display = 'none'">Exit</button>
	</div>
	
	</form>
</div>

<br><br>

<?php
include_once 'footer.php';
?>
</body>
</html>




<?php 
session_start();

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
include_once 'menu.php';
include_once 'header.php';
?>

<?php 
////////////////////////////////////Organization Page for sign in members////////////////////////////////////
if (isset($_SESSION['session_memberid'])) {

$sql1 = "SELECT * FROM members;";
$result1 = mysqli_query($conn1, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$orgId = $row1['orgId'];
	
$sql2 = "SELECT * FROM organization WHERE id = '$orgId';";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
?>

<br>
<H4> WELCOME TO <?php echo $row2['name'];?> </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br>

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
			echo " Name of the organization : <b>".$row2['name']."</b>"."<br>";
			?>&#10020;<?php
			echo " Founded by ".str_repeat('&nbsp;', 20)." : <b>".$row2['founder']."</b> on <b>".$row2['foundDate']."</b><br>";
			?>&#10020;<?php 
			echo " Current president ".str_repeat('&nbsp;', 11)." : <b>".$row2['currentPresident']."</b>";?>
		</td>
		<td style="column-width:30%;padding-left: 20%;">
			<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['organizationPic1']); ?>" />	
		</td>
	</thead>
</table>

<?php
	echo "<br><br><br>"."<b><H3>1. History</H3></b>";
	echo $row2['history'];	
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br>"."<b><H3>2. Location</H3></b>";
	echo "The current head office of <b>".$row2['name']."</b> is located in ".$row2['location'].".";
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br>"."<b><H3>3. Contact Details</H3></b>";
	echo "To join with our organization please contact our coordinator via telephone <b>0".$row2['telephone']."</b> or email ";
	?><b><a href="mailto: <?php echo $row2['email']; ?>"><?php echo $row2['email']; ?></a></b>
	<br><br><br><hr id="hr1"><?php

	echo "<br><br>"."<b><H3>4. Authority</H3></b>";
	echo $row2['authority'];
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br><br>"."<b><H3>5. Membership</H3></b>";
	echo $row2['membership'];
?>
<br><br><br>
<table>
	<thead>
		<tr>
			<td style="column-width:150px;"></td>
			<td style="column-width: 500px;">
				<div align="center">
					<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['organizationPic2']); ?>" />
				</div>
			</td>
			<td style="column-width:150px;"></td>
			<td style="column-width:500px;">
				<div align="center">
					<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['organizationPic3']); ?>" />
				</div>
			</td>
		</tr>
	</thead>
</table>

<?php  
}
////////////////////////////////////Organization Page for sign in members////////////////////////////////////
////////////////////////////////Organizations Table for public users & SAdmin/////////////////////////////////
else {
?>

<br>
<H4> ECO-MATES &nbspREGISTERED &nbspORGANIZATIONS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>
<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br>

<?php  
if (isset($_SESSION['session_sadminid'])) {
?>

<button onclick="document.getElementById('form6').style.display = 'block'" id="button2">Register New Organiation </button>
<br><br>
<div class="form-popup" id="form6">
	<form action="organization.php" method="POST">

		<a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form6').style.display = 'none'">&times;</a>
		<label id="label1"><b>Add New Organization</b></label><br><br><br>
		<label>Name </label><input type="text" name="name" required=""><br><br>
		<label>Founder </label><input type="text" name="founder"><br><br>
		<label>Founded Date </label><input type="date" name="foundDate"><br><br>
		<label>Location </label><input type="text" name="location"><br><br>
		<label>Telephone </label><input type="number" name="telephone" required=""><br><br>
		<label>Email </label><input type="text" name="email" required=""><br><br>
		<label>Current President </label><input type="text" name="currentPresident"><br><br>
		<label>No of Completed Projects </label><input type="number" name="noOfCompProj"><br><br><br>
		<label>Username </label><input type="text" name="username" required=""><br><br>
		<div align="center">
			<button type="submit" name="submit-organization" >Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<button type="reset" name="reset" >Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<button onclick="document.getElementById('form6').style.display = 'none'">Exit</button>
		</div>
	
	</form>
</div>

<?php
}
$sql3 = "SELECT * FROM organization;";
$result3 = mysqli_query($conn, $sql3);
?>
<br>
<table id="tablestyle1">
	<thead>
		<tr style="background-color: #8FBC8F;border: 2px solid black;height: 60px;">
			<td style="column-width:100px;">Org Id</td>
			<td style="column-width:300px;">Name</td>
			<td style="column-width:300px;">Location</td>
			<td style="column-width:200px;">Telephone</td>
			<td style="column-width:200px;">Email</td>
			<td style="column-width:50px;"></td>
			<td style="column-width:80px;"></td>
			<td style="column-width:30px;"></td>
			<td style="column-width:80px;"></td>
		</tr>
	</thead>
	<?php 
	while($row3 = mysqli_fetch_assoc($result3)){
		$id = $row3['id'];
		?>
		<tr style="height:50px;">
			<td><?php echo $id; ?></td>
			<td><?php echo $row3['name']; ?></td>
			<td><?php echo $row3['location']; ?></td>
			<td><?php echo $row3['telephone']; ?></td>
			<td><?php echo $row3['email']; ?></td>
			<td></td>
			<td><?php echo '<a href="organization.php?orgId='.$id.'" style="color:black">  More</a>';?></td>
			<td></td>
			<td>
			<form action="organization.php" method="POST">
				<?php
				if (isset($_SESSION['session_sadminid'])) {
				?>
					<button id="button-warn" type="submit" name="delete" value="<?php echo $id; ?>">Delete</button>
				<?php
				}
				?>
			</form></td>
		</tr>
		<?php
	}
	?>			
</table>
<br><br>
<?php 
}
////////////////////////////////Organizations Table for public users & SAdmin/////////////////////////////////
//////////////////////////////////////Delete Organization for SAdmin////////////////////////////////////
if(isset($_POST['delete'])){
	$rowid = $_POST['delete'];
	?>
	<div id="form1" class="delete-popup">
		<form action="organization.php" method="POST">
			<a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form1').style.display = 'none'">&times;</a>
			<p>Do you want to delete the organization <?php echo $rowid; ?> ?</p><br>&nbsp&nbsp&nbsp
			<button id="button-warn" type="submit" name="submit-delete" value="<?php echo $rowid; ?>">Yes</button>&nbsp&nbsp&nbsp
		</form>
	</div>
	<?php
}
if(isset($_POST['submit-delete'])){
	$rowid = $_POST['submit-delete'];
	$sql4 = "DELETE FROM organization WHERE id ='$rowid';";
	$run = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

	if($run){
		echo "<script>alert('Organization details were successfully deleted.');</script>";
	}
	else{
		echo "<script>alert('Could not delete the details. Please try again.');</script>";
	}
}
//////////////////////////////////////Delete Organization for SAdmin////////////////////////////////////
////////////////////////////////Organizations More for public users & SAdmin///////////////////////////////// 

if (isset($_GET['orgId'])) {
	$orgId = $_GET['orgId'];

	$sql4 = "SELECT * FROM organization WHERE id='$orgId';";
	$result4 = mysqli_query($conn, $sql4);
	$row4 = mysqli_fetch_assoc($result4);

?>
<br><br>
<H4> WELCOME TO <?php echo $row4['name'];?> </H4>
<hr style="line-height:1px; border-color:#006400;">
<br><br>
<table>
	<thead>
		<td style="column-width:70%;text-align: left;padding-top: 0;">
			<br><br>
			&#10020;<?php
			echo " Name of the organization : <b>".$row4['name']."</b>"."<br>";
			?>&#10020;<?php
			echo " Registered ID ".str_repeat('&nbsp;', 18).": <b>".$row4['id']."</b>"."<br>";
			?>&#10020;<?php
			echo " Founded by ".str_repeat('&nbsp;', 20)." : <b>".$row4['founder']."</b> on <b>".$row4['foundDate']."</b><br>";
			?>&#10020;<?php 
			echo " Current president ".str_repeat('&nbsp;', 11)." : <b>".$row4['currentPresident']."</b>";?>
		</td>
		<td style="column-width:30%;padding-left: 20%;">
			<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row4['organizationPic1']); ?>" />	
		</td>
	</thead>
</table>

<?php
	echo "<br><br><br>"."<b><H3>1. History</H3></b>";
	echo $row4['history'];	
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br>"."<b><H3>2. Location</H3></b>";
	echo "The current head office of <b>".$row4['name']."</b> is located in ".$row4['location'].".";
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br>"."<b><H3>3. Contact Details</H3></b>";
	echo "To join with our organization please contact our coordinator via telephone <b>0".$row4['telephone']."</b> or email ";
	?><b><a href="mailto: <?php echo $row4['email']; ?>"><?php echo $row4['email']; ?></a></b>
	<br><br><br><hr id="hr1"><?php

	echo "<br><br>"."<b><H3>4. Authority</H3></b>";
	echo $row4['authority'];
	?><br><br><br> <hr id="hr1"> <?php

	echo "<br><br><br>"."<b><H3>5. Membership</H3></b>";
	echo $row4['membership'];
?>
<br><br><br>
<table>
	<thead>
		<tr>
			<td style="column-width: 50%;">
				<div align="center">
					<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row4['organizationPic2']); ?>" />
				</div>
			</td>
			<td style="column-width:50%;">
				<div align="center">
					<img width="500px" height="400px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row4['organizationPic3']); ?>" />
				</div>
			</td>
		</tr>
	</thead>
</table>

<?php
}
else{
}

////////////////////////////////Organizations More for public users & SAdmin/////////////////////////////////
?>
	
<?php
include_once 'footer.php';
?>
</body>
</html>

<?php  
//////////////////////////////////////Add New Organization/////////////////////////////////////////////
if (isset($_POST['submit-organization'])) {
	
	if (!empty($_POST['name'])&&!empty($_POST['telephone'])&&!empty($_POST['email'])) {

		$name = $_POST['name'];
		$founder = $_POST['founder'];
		$foundDate = $_POST['foundDate'];
		$location = $_POST['location'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$currentPresident = $_POST['currentPresident'];
		$noOfCompProj = $_POST['noOfCompProj'];
		$username = $_POST['username'];
		
		$sql1 = "INSERT INTO organization (name,founder,foundDate,location,telephone,email,currentPresident,noOfCompProj,username,password,confirmpassword) VALUES ('$name','$founder','$foundDate','$location','$telephone','$email','$currentPresident','$noOfCompProj','$username','admin','admin');";
		$run1 = mysqli_query($conn, $sql1) or die(mysqli_error());

		if($run1){
			echo "<script>alert('New organization was successfully registered.');</script>";
		}
		else{
			echo "<script>alert('Could not register. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Organization name, telephone and email are required.');</script>";
	}
}
//////////////////////////////////////Add New Organization/////////////////////////////////////////////
?>

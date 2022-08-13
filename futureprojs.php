<?php 
session_start();
if (isset($_SESSION['session_sadminid'])){
    $sadminid = $_SESSION['session_sadminid'];
}
?>

<?php
	include_once 'include.php';
	include_once 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Future Projects</title>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menu.php';
$sql1 = "SELECT * FROM organization;";
$result1 = mysqli_query($conn, $sql1);
?>

<br>
<H4> ECO-MATES &nbspFUTURE &nbspPROJECTS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<table>
	<tr>
		<td width="1000px">
			<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
		</td>
		<td>
			<div style="border:3px solid black;width:500px;height:120px;background-color:#00FA9A;border-radius:8px;">
				<form action="futureprojs.php" method="GET">
					<br>
					<label style="width:30%;padding-left:20px;">Organization:</label>
					<select name="organization" style="">
						<?php 
						echo '<option></option>';
						while($row1 = mysqli_fetch_assoc($result1)){
							echo '<option value='.$row1['id'].'>'.$row1['name'].'</option>';
						}
						?>
					</select>
					<button style="width:10%;background-color:#00FA9A;border:none;font-size:130%;color:black;" type="submit" name="submit-orgId" value="orgId;"><i class="fa fa-search"></i></button><br>
				</form>
			</div>
		</td>
	</tr>
</table>
<br><br>

<?php  
$recordsPerPage = 5;
$page = '';

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if (!isset($_GET['page'])){
	$page = 1;
}
$startFrom = ($page-1)*$recordsPerPage;

if (isset($_GET['submit-orgId'])) {

	if (!empty($_GET['organization'])) {
		$thisOrg = $_GET['organization'];	
	}
	else{
		echo "<script>alert('Please enter organization name');</script>";
		exit();
	}
}
elseif (isset($_GET['orgId'])) {
	$thisOrg = $_GET['orgId'];
}
else{
	$thisOrg = 1;
}

$sql1 = "SELECT * FROM comingproj WHERE orgId='$thisOrg' ORDER BY id ASC LIMIT $startFrom,$recordsPerPage;";
$result1 = mysqli_query($conn, $sql1);

$sql3 = "SELECT * FROM organization WHERE id='$thisOrg';";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);

echo "<div align='center' style='font-size:130%;background: linear-gradient(to bottom right, #339966 0%, #66ffcc 100%);'><br><b>".$row3['name']."<br>".$row3['location']."<br>".$row3['email']."</b><br><br></div>";
?>

<br><br><br>
<form action="futureprojs.php" method="POST" style="line-height:140%">
	
<?php
	$resultCheck1 = mysqli_num_rows($result1);
	if($resultCheck1>0){
		while ($row1=mysqli_fetch_assoc($result1)){

			echo "<b>Project Number".str_repeat('&nbsp;', 1).": </b>".$row1['id']."<br>";
		    echo "<b>Project Name".str_repeat('&nbsp;', 5).": </b>".$row1['name']."<br>";
		    echo "<b>Date to Start".str_repeat('&nbsp;', 6).": </b>".$row1['dateToStart']."<br>";
		    echo "<b>Date to Finish".str_repeat('&nbsp;', 4).": </b>".$row1['dateToFinish']."<br>";
		    echo "<b>Location".str_repeat('&nbsp;', 13).": </b>".$row1['location']."<br>";
		    echo "<b>More Details".str_repeat('&nbsp;', 6).": </b>";?>
			<div style="padding-left: 190px;">
				<?php echo $row1['description'];  ?>
			</div><br>
			<b>Before</b><br>
			<img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row1['imageCurrent1']); ?>" /> 
		    <img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row1['imageCurrent2']); ?>" /> 
		    <img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row1['imageCurrent3']); ?>" />
			<br><br><br><hr id="hr1"><br><br><?php
		}
	}
	else{
    	echo "<b>No published coming projects</b><br>";
  	}	
?>
</form>	

<?php
////////////////////////////////////////////Pagination//////////////////////////////////////////
echo "<br><br><br>";
echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);
		
	$sql2 = "SELECT * FROM comingproj WHERE orgId = '$thisOrg' ORDER BY id ASC;";
	$result2 = mysqli_query($conn, $sql2);
	$totalRecords = mysqli_num_rows($result2);
	$totalPages = ceil($totalRecords/$recordsPerPage);

	for ($i=1; $i <= $totalPages; $i++) { 
		echo '<a href="futureprojs.php?page='.$i.'&orgId='.$thisOrg.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
	}
	echo "</div>";
////////////////////////////////////////////Pagination//////////////////////////////////////////
?>

<?php
include_once 'footer.php';
?>
</body>
</html>


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
$sql2 = "SELECT * FROM comingproj WHERE orgId = '$thisOrg' ORDER BY id ASC LIMIT $startFrom,$recordsPerPage;";
$result2 = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Future Projects</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'header.php';
include_once 'menu.php';
?>

<br>
<H4> FUTURE PROJECTS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br><br>

<div>
<form action="futureproj.php" method="POST" style="line-height:140%">
  <?php
  $resultCheck2 = mysqli_num_rows($result2);

  if($resultCheck2>0){
    while ($row2=mysqli_fetch_assoc($result2)){
      echo "<b>Project Number".str_repeat('&nbsp;', 1).": </b>".$row2['id']."<br>";
      echo "<b>Project Name".str_repeat('&nbsp;', 5).": </b>".$row2['name']."<br>";
      echo "<b>Date to Start".str_repeat('&nbsp;', 6).": </b>".$row2['dateToStart']."<br>";
      echo "<b>Date to Finish".str_repeat('&nbsp;', 4).": </b>".$row2['dateToFinish']."<br>";
      echo "<b>Location".str_repeat('&nbsp;', 13).": </b>".$row2['location']."<br>";
      echo "<b>More Details".str_repeat('&nbsp;', 6).": </b>";?>
      <div style="padding-left: 190px;">
        <?php echo $row2['description'];  ?>
      </div>
      <br><br>
      <b>Now</b><br>
      <img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['imageCurrent1']); ?>" /> 
      <img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['imageCurrent2']); ?>" /> 
      <img width="400px" height="300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row2['imageCurrent3']); ?>" />
      <br><br><br><hr id="hr1"><br><br><?php
    }
////////////////////////////////////////////Pagination//////////////////////////////////////////
    echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);

    $sql3 = "SELECT * FROM comingproj WHERE orgId = '$thisOrg' ORDER BY id ASC;";
    $result3 = mysqli_query($conn, $sql3);
    $totalRecords = mysqli_num_rows($result3);
    $totalPages = ceil($totalRecords/$recordsPerPage);

    for ($i=1; $i <= $totalPages; $i++) { 
      echo '<a href="futureproj.php?page='.$i.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
    }
    echo "</div>";
////////////////////////////////////////////Pagination//////////////////////////////////////////
  }
?>
</form>
</div>


<?php
include_once 'footer.php';
?>
</body>
</html>
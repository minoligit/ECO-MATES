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
$sql1 = "SELECT * FROM articles WHERE orgId='$thisOrg' ORDER BY id ASC LIMIT $startFrom,$recordsPerPage;";
$result1 = mysqli_query($conn, $sql1);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menuorganization.php';
include_once 'header.php';
?>

<br>
<H4> ARTICLES </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
<br><br>

<div>
<form action="crudarticle.php" method="POST" style="line-height:140%" target="_blank">

<button id="button2" type="submit" name="add-new-article">Add New Article</button>
<br><br><br>

  <?php
  $resultCheck = mysqli_num_rows($result1);

  if($resultCheck>0){
    while ($row=mysqli_fetch_assoc($result1)){

      $sql2 = "SELECT * FROM organization WHERE id = '$thisOrg';";
      $result2 = mysqli_query($conn, $sql2);
      $row2=mysqli_fetch_assoc($result2);

      echo "<b>Article Number".str_repeat('&nbsp;', 1).": </b>".$row['id']."<br>";
      echo "<b>Article Name".str_repeat('&nbsp;', 5).": </b>".$row['name']."<br>";
      echo "<b>Author".str_repeat('&nbsp;', 15).": </b>".$row['author']."<br>";
      echo "<b>Organization".str_repeat('&nbsp;', 5).": </b>".$row2['name']."<br>";
      echo "<b>Published Date".str_repeat('&nbsp;', 2).": </b>".$row['writenDate']."<br>";
      echo "<b>Contact Details".str_repeat('&nbsp;', 2).": </b>".$row['contactDetail']."<br>";
      echo "<b>Content  </b><br>";  ?>
      <div style="padding-left: 50px;">
        <?php echo $row['description'];  ?>
      </div>
      <br>
      <button id="button1" type="submit" name="edit" value="<?php echo $row['id'] ?>" target="_blank">Edit</button>&nbsp&nbsp
      <button id="button-warn" type="submit" name="delete" value="<?php echo $row['id'] ?>">Delete</button><br><br><hr id="hr1"><br><br>
    
      <?php
    }
  }
  ?> 

</form>
</div>

<?php 

echo "<br><br><br>";
echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);

    $sql2 = "SELECT * FROM articles WHERE orgId='$thisOrg' ORDER BY id ASC;";
    $result2 = mysqli_query($conn, $sql2);
    $totalRecords = mysqli_num_rows($result2);
    $totalPages = ceil($totalRecords/$recordsPerPage);

    for ($i=1; $i <= $totalPages; $i++) { 
      echo '<a href="articles.php?page='.$i.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
    }
    echo "</div>";

?>

<?php
include_once 'footer.php';
?>

</body>
</html>



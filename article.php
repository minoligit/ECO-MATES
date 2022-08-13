<?php 
session_start();
include_once 'include.php';
if (isset($_SESSION['session_memberid'])){
    $memberId = $_SESSION['session_memberid'];
    $sql = "SELECT * FROM members WHERE id = '$memberId';";
    $result1 = mysqli_query($conn1, $sql);
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
$sql2 = "SELECT * FROM articles WHERE orgId = '$thisOrg' ORDER BY id ASC LIMIT $startFrom,$recordsPerPage;";
$result2 = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menu.php';
include_once 'header.php';
?>

<br>
<H4> ARTICLES </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>

<br><br>
<a href="crudarticle.php" target="_blank">Add New Articles</a>
<br><br><br>

<div>
<form action="article.php" method="POST" style="line-height:140%">
  
  <?php
  $resultCheck2 = mysqli_num_rows($result2);

  if($resultCheck2>0){
    while ($row2=mysqli_fetch_assoc($result2)){

      echo "<b>Article Number".str_repeat('&nbsp;', 1).": </b>".$row2['id']."<br>";
      echo "<b>Article Name".str_repeat('&nbsp;', 5).": </b>".$row2['name']."<br>";
      echo "<b>Author".str_repeat('&nbsp;', 15).": </b>".$row2['author']."<br>";
      echo "<b>Published Date".str_repeat('&nbsp;', 1).": </b>".$row2['writenDate']."<br>";
      echo "<b>Contact Details".str_repeat('&nbsp;', 1).": </b>".$row2['contactDetail']."<br>";
      echo "<b>Content  </b><br>";  ?>
      <div style="padding-left: 50px;">
        <?php echo $row2['description'];  ?>
      </div>
      <br><?php
      if (isset($_SESSION['session_memberid'])&&($_SESSION['session_memberid']==$row2['authorId'])) { ?>
        <button id="button1" type="submit" name="edit" value="<?php echo $row2['id'] ?>" target="_blank">Edit</button>&nbsp&nbsp
        <button id="button-warn" type="submit" name="delete" value="<?php echo $row2['id'] ?>">Delete</button><?php
      }
      ?>
      <br><br><br><hr id="hr1"><br><br>
      <?php
    }
  }
  else{
    echo "<b>No published articles</b><br>";
  }
  ?> 

</form>
</div>

<?php 
///////////////////////////////////////////Edit article form/////////////////////////////////////////
if (isset($_POST['edit'])) {
  $rowid1 = $_POST['edit'];
  $sql3 = "SELECT * FROM articles WHERE id =$rowid1;";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_array($result3);
  ?>

  <div class="form-display" id="form17" style="width:80%;">
  <form action="crudarticle.php" method="POST">

    <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form17').style.display = 'none'">&times;</a>
    <label id="label1"><b>Edit Article <?php echo $rowid1; ?> </b></label><br><br><br>
    <label>Name </label><input type="text" name="name" value="<?php echo $row3['name']; ?>"><br><br>
    <label>Author </label><input type="text" name="author" value="<?php echo $row3['author']; ?>"><br><br>
    <label>Published Date </label><input type="date" name="writenDate" value="<?php echo $row3['writenDate']; ?>"><br><br>
    <label>Contact Details </label><input type="text" name="contactDetail" value="<?php echo $row3['contactDetail']; ?>"><br><br>
    <label style="width:50%;">Content (Keep empty if not updating)</label><br><br>
    <textarea name="description" style="width: 80%;height: 400px;"></textarea><br><br>
    <div align="center">
      <button type="submit" name="submit-edit" value="<?php echo $rowid1; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <button type="reset" name="reset">Clear</button>
    </div>

  </form> 
  </div>

  <?php
}//////////////////////////////////////////Edit article form//////////////////////////////////////////
////////////////////////////////////////Delete article form//////////////////////////////////////////
if(isset($_POST['delete'])){
  $rowid1 = $_POST['delete'];
  ?>
  <div id="form19" class="delete-popup">
    <form action="crudarticle.php" method="POST">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form19').style.display = 'none'">&times;</a>
      <p>Do you want to delete the article <?php echo $rowid1; ?> ?</p><br>&nbsp&nbsp&nbsp
      <button id="button-warn" type="submit" name="submit-delete" value="<?php echo $rowid1; ?>">Yes</button>
    </form>
  </div>
  <?php
}
////////////////////////////////////////Delete article form//////////////////////////////////////////
////////////////////////////////////////////Pagination//////////////////////////////////////////
echo "<br><br><br>";
echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);

    $sql4 = "SELECT * FROM articles ORDER BY id ASC;";
    $result4 = mysqli_query($conn, $sql4);
    $totalRecords = mysqli_num_rows($result4);
    $totalPages = ceil($totalRecords/$recordsPerPage);

    for ($i=1; $i <= $totalPages; $i++) { 
      echo '<a href="article.php?page='.$i.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
    }
    echo "</div>";
////////////////////////////////////////////Pagination//////////////////////////////////////////
?>

<?php
include_once 'footer.php';
?>

</body>
</html>



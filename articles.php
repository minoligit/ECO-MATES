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
	<title>Articles</title>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menu.php';
$sql1 = "SELECT * FROM organization;";
$result1 = mysqli_query($conn, $sql1);
?>

<br>
<H4> ECO-MATES &nbspARTICLES </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<table>
  <tr>
    <td width="1000px">
      <span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>
    </td>
    <td>
      <div style="border:3px solid black;width:500px;height:120px;background-color:#00FA9A;border-radius:8px;">
        <form action="articles.php" method="GET">
          <br>
          <label style="width:30%;padding-left:20px;">Organization:</label>
          <select name="organization" style="line-height:20px;">
            <?php 
            echo '<option></option>';
            while($row1 = mysqli_fetch_assoc($result1)){
              echo '<option value='.$row1['id'].' style="line-height:20px;">'.$row1['name'].'</option>';
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

$sql1 = "SELECT * FROM articles WHERE orgId='$thisOrg' ORDER BY id ASC LIMIT $startFrom,$recordsPerPage;";
$result1 = mysqli_query($conn, $sql1);

$sql3 = "SELECT * FROM organization WHERE id='$thisOrg';";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);

echo "<div align='center' style='font-size:130%;background: linear-gradient(to bottom right, #339966 0%, #66ffcc 100%);'><br><b>".$row3['name']."<br>".$row3['location']."<br>".$row3['email']."</b><br><br></div>";
?>

<br><br><br>
<div>
<form action="articles.php" method="POST" style="line-height:140%">
  
  <?php
  $resultCheck1 = mysqli_num_rows($result1);

  if($resultCheck1>0){
    while ($row1=mysqli_fetch_assoc($result1)){

      echo "<b>Article Number".str_repeat('&nbsp;', 1).": </b>".$row1['id']."<br>";
      echo "<b>Article Name".str_repeat('&nbsp;', 5).": </b>".$row1['name']."<br>";
      echo "<b>Author".str_repeat('&nbsp;', 15).": </b>".$row1['author']."<br>";
      echo "<b>Published Date".str_repeat('&nbsp;', 1).": </b>".$row1['writenDate']."<br>";
      echo "<b>Contact Details".str_repeat('&nbsp;', 1).": </b>".$row1['contactDetail']."<br>";
      echo "<b>Content  </b><br>";  ?>
      <div style="padding-left: 50px;">
        <?php echo $row1['description'];  ?>
      </div>
      <br><?php
      if (isset($_SESSION['session_memberid'])&&($_SESSION['session_memberid']==$row2['authorId'])) { ?>
        <button id="button1" type="submit" name="edit" value="<?php echo $row1['id'] ?>" target="_blank">Edit</button>&nbsp&nbsp
        <button id="button-warn" type="submit" name="delete" value="<?php echo $row1['id'] ?>">Delete</button><?php
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
////////////////////////////////////////////Edit article form///////////////////////////////////////////
if (isset($_POST['edit'])) {
  $rowid1 = $_POST['edit'];
  $sql2 = "SELECT * FROM articles WHERE id =$rowid1;";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  ?>

  <div class="form-display" id="form17" style="width:80%;">
  <form action="crudarticle.php" method="POST">

    <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form17').style.display = 'none'">&times;</a>
    <label id="label1"><b>Edit Article <?php echo $rowid1; ?> </b></label><br><br><br>
    <label>Name </label><input type="text" name="name" value="<?php echo $row2['name']; ?>"><br><br>
    <label>Author </label><input type="text" name="author" value="<?php echo $row2['author']; ?>"><br><br>
    <label>Published Date </label><input type="date" name="writenDate" value="<?php echo $row2['writenDate']; ?>"><br><br>
    <label>Contact Details </label><input type="text" name="contactDetail" value="<?php echo $row2['contactDetail']; ?>"><br><br>
    <label style="width:50%;">Content (Keep empty if not updating)</label><br><br>
    <textarea name="description" style="width: 80%;height: 400px;"></textarea><br><br>
    <div align="center">
      <button type="submit" name="submit-edit" value="<?php echo $rowid1; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <button type="reset" name="reset">Clear</button>
    </div>

  </form> 
  </div>

  <?php
}
///////////////////////////////////////////Edit article form///////////////////////////////////////////
//////////////////////////////////////////Delete article form//////////////////////////////////////////
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
///////////////////////////////////////////Delete article form//////////////////////////////////////////
///////////////////////////////////////////////Pagination///////////////////////////////////////////////
echo "<br><br><br>";
echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);

    $sql3 = "SELECT * FROM articles ORDER BY id ASC;";
    $result3 = mysqli_query($conn, $sql3);
    $totalRecords = mysqli_num_rows($result3);
    $totalPages = ceil($totalRecords/$recordsPerPage);

    for ($i=1; $i <= $totalPages; $i++) { 
      echo '<a href="articles.php?page='.$i.'&orgId='.$thisOrg.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
    }
    echo "</div>";
///////////////////////////////////////////////Pagination///////////////////////////////////////////////
?>

<?php
include_once 'footer.php';
?>

</body>
</html>



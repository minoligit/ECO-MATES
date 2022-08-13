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
$recordsPerPage = 20;
$page = '';

if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
else{
  $page = 1;
}
$startFrom = ($page-1)*$recordsPerPage;
$sql2 = "SELECT * FROM messages WHERE receiver='all' OR receiver='$memberId' ORDER BY id DESC LIMIT $startFrom,$recordsPerPage;";
$result2 = mysqli_query($conn1, $sql2);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Notifications</title>
  <link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'header.php';
?>

<br>
<H4> Received Messages </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<table id="tablestyle1">
  <tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;text-align:left">
    <th style="column-width:250px;">Sender</th>
    <th style="column-width:400px;">Topic</th>
    <th style="column-width:250px;">Date & Time</th>
    <th style="column-width:50px;"></th>
    <th></th>
  </tr>
  <?php 
  while($row2=mysqli_fetch_assoc($result2)){
    ?>
    <tr style="height:50px;text-align:left">
      <td><?php echo $row2['sender'] ?></td>
      <td><?php echo $row2['topic'] ?></td>
      <td><?php echo $row2['msgDateTime'] ?></td>
      <td></td>
      <form action="messages.php" method="POST">
        <td><button id="button1" type="submit" name="view" value="<?php echo $row2['id'] ?>" style="width:auto;">View</button></td>
      </form>
    </tr>

  <?php
  } 
?>
</table>

<br><br><br>
<?php 

//////////////////////////////////////////View messages/////////////////////////////////////////
if (isset($_POST['view'])) {
  
  $id = $_POST['view'];
  $sql4 = "SELECT * FROM messages WHERE id='$id' AND (receiver='all' OR receiver='$memberId');";
  $result4 = mysqli_query($conn1, $sql4);
  $row4 = mysqli_fetch_assoc($result4);
  ?>
  <div class="form-display" id="form1">
    <form>
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form1').style.display = 'none'">&times;</a>
      <?php echo "<b>".$row4['topic']."</b><br><br>".$row4['message']."<br><br>By ".$row4['sender']." on ".$row4['msgDateTime'];
      ?>
    </form>
  </div>
  
  <?php
}
echo "<br><br><br>";
//////////////////////////////////////////View messages/////////////////////////////////////////
////////////////////////////////////////////Pagination//////////////////////////////////////////
    echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);

    $sql3 = "SELECT * FROM messages WHERE receiver='all' OR receiver='$memberId' ORDER BY id DESC;";
    $result3 = mysqli_query($conn1, $sql3);
    $totalRecords = mysqli_num_rows($result3);
    $totalPages = ceil($totalRecords/$recordsPerPage);

    for ($i=1; $i <= $totalPages; $i++) { 
      echo '<a href="messages.php?page='.$i.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
    }
    echo "</div>";
////////////////////////////////////////////Pagination//////////////////////////////////////////
?>

<?php
include_once 'footer.php';
?>
</body>
</html>
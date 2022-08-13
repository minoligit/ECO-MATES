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
$recordsPerPage = 20;
$page = '';

if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
else{
  $page = 1;
}
$startFrom = ($page-1)*$recordsPerPage;
$sql1 = "SELECT * FROM messages ORDER BY id DESC LIMIT $startFrom,$recordsPerPage;";
$result1 = mysqli_query($conn1, $sql1);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'header.php';
?>

<br>
<H4> SEND MESSAGES </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<?php 
$sql2 = "SELECT name FROM organization";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

///////////////////////////////////////Send message to all members/////////////////////////////////////
if (isset($_POST['message-all'])) {
?>
<br>Fill the details of the message<br><br><br>
<div class="form-display" id="form5" style="width:60%;">
  <form action="crudmessages.php" method="POST">
    
    <br>
    <label>Sender</label><input type="text" name="sender" value="<?php echo $row2['name']; ?>"><br><br>
    <label>Topic</label><input type="text" name="topic"><br><br>
    <label>Content</label><textarea name="message"></textarea><br><br>
    <label>Date and Time</label><input type="datetime-local" name="msgDateTime">
    <br><br><br>
    <div align="center">
      <button type="submit" name="submit-message-all">Send</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    </div>

  </form>
</div>
<br><br><br>
<?php  
}

///////////////////////////////////////Send message to all members/////////////////////////////////////
/////////////////////////////////////Send message to seleted members///////////////////////////////////
if (isset($_POST['message-select'])) {
?>
<br>Fill the details of the message<br><br><br>
<div class="form-display" id="form6" style="width:60%;">
  <form action="crudmessages.php" method="POST">
  
    <br>
    <label>Sender</label><input type="text" name="sender" value="<?php echo $row2['name']; ?>"><br><br>
    <label>Receiver Id</label><input type="text" name="receiver"><br><br>
    <label>Topic</label><input type="text" name="topic"><br><br>
    <label>Content</label><textarea name="message"></textarea><br><br>
    <label>Date and Time</label><input type="datetime-local" name="msgDateTime">
    <br><br><br>
    <div align="center">
      <button type="submit" name="submit-message-select">Send</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <button type="reset" name="reset">Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    </div>

  </form>
</div>
<br><br><br>
<?php  
}
/////////////////////////////////////Send message to seleted members///////////////////////////////////
?>
<h5>Messages History</h5>
<br>
<button onclick="document.getElementById('form7').style.display = 'block'" id="button2">Delete Messages</button><br><br><br>

<table id="tablestyle1" style="width:100%;">
  <thead>
    <tr style="background-color: #8FBC8F;border: 2px solid black;height: 30px;text-align:left">
      <th style="column-width:80px;">Sender</th>
      <th style="column-width:80px;">Receiver</th>
      <th style="column-width:100px;">Topic</th>
      <th style="column-width:300px;">Content</th>
      <th>Date & Time</th>
    </tr>
  </thead>
  <?php

  while ($row=mysqli_fetch_assoc($result1)){
    ?> 
    <tr style="height:40px;text-align:left">
      <td><?php echo $row['sender']; ?></td>
      <td><?php echo $row['receiver']; ?></td>
      <td><?php echo $row['topic']; ?></td>
      <td><?php echo $row['message']; ?></td>
      <td><?php echo $row['msgDateTime']; ?></td>
    </tr>
    <?php
  }

  ?>
</table>
<br><br>

<div class="delete-popup" id="form7" style="display:none;">
  <form action="crudmessages.php" method="POST">
    <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form7').style.display = 'none'">&times;</a>
      <p>Delete the messages before </p>
      <input type="datetime-local" name="delete-message-before" style="width:60%;"><br><br>&nbsp&nbsp&nbsp
      <button id="button-warn" type="submit" name="submit-delete">Delete</button>
  </form>
</div>


<?php
echo "<br><br><br>";
echo "<div align='center' style='background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;'>Page".str_repeat('&nbsp;', 4);

    $sql3 = "SELECT * FROM messages ORDER BY id DESC;";
    $result3 = mysqli_query($conn1, $sql3);
    $totalRecords = mysqli_num_rows($result3);
    $totalPages = ceil($totalRecords/$recordsPerPage);

    for ($i=1; $i <= $totalPages; $i++) { 
      echo '<a href="messages.php?page='.$i.'" style="color:black">  '.$i.'</a>'.str_repeat('&nbsp;', 4);
    }
    echo "</div>";

include_once 'footer.php';
?>
</body>
</html>
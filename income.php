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
  <title>Income</title>
  <style>
    .menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
  </style>
  <link rel="stylesheet" type="text/css" href="Styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<br>
<H4> Income Details of <?php echo date("Y"); ?> </H4>
<hr style="line-height:1px; border-color:#006400;">
<br><br>

<table>
  <tr>
    <th><button style="font-size: 70%;height: 40px;width: auto;border-radius: 8px;background-color: #63aba6;color: black;" data-id="1" id="export-income">Export Income Data</button>
    </th>
    <th style="column-width:20px;"></th>
    <th>
      <div>
        <form action="income.php" method="POST">
          <button id="button2" type="submit" name="reset-income">Reset Income Data</button>
        </form>
      </div>
    </th>
  </tr>
</table>
<br><br>

<script>
  $('#export-income').on('click', function() {
     
            var id=$(this).attr("data-id");
                  $.ajax({
  url: "crudincome.php",
  type: "POST",
  data: {
  id:id
                 },
  cache: false,
  success: function(dataResult){
  window.open('crudincome.php?id='+id);
                      }
  });
   
  });
</script>

<?php 
if (isset($_POST['reset-income'])) {
  
  ?>
  <div id="form20" class="delete-popup">
    <form action="crudincome.php" method="POST">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form20').style.display = 'none'">&times;</a>
      <p>Do you want to reset the income for new year ?</p><br>&nbsp&nbsp&nbsp
      <button id="button-warn" type="submit" name="submit-reset-income">Yes</button>
    </form>
  </div>
  <?php
}
?>

<div style="padding-right:10px;">
<form action="income.php" method="POST">
  <table id="tablestyle1">
  <thead>
    <tr style="background-color: #8FBC8F;border: 2px solid black;height: 30px;">
      <th style="column-width: 70px;">No</th>
      <th style="column-width: 200px;">Type</th>
      <th style="column-width: 100px;">Member ID</th>
      <th style="column-width: 300px;">Paid By</th>
      <th style="column-width: 60px;">Amount (Rs.)</th> 
      <th style="column-width: 200px;">Paid on</th>
      <th style="column-width: 40px;"></th>  
    </tr>
  </thead>
<?php 
  
  $sql1 = "SELECT * FROM income ORDER BY paidDateTime ASC ;";

  $result1 = mysqli_query($conn1, $sql1);
  $resultCheck = mysqli_num_rows($result1);

  while ($row=mysqli_fetch_assoc($result1)){
    $id=$row['id'];
    $type=$row['type'];
    $memberId=$row['memberId'];

    if (empty($memberId)) {
       $memberId = 'Non-member';
     } 
    $memberName=$row['paidBy'];  
    $amount=$row['amount'];
    $paidDateTime=$row['paidDateTime'];

  ?>
    <tr style="height:40px;font-size:80%;">
      <td><?php echo $id; ?></td>
      <td><?php echo $type; ?></td>
      <td><?php echo $memberId; ?></td>
      <td><?php echo $memberName; ?></td>
      <td><?php echo $amount; ?></td>
      <td><?php echo $paidDateTime; ?></td>  
      <td></td> 
    </tr>
    <?php   
  }

  ?>
</table>

<br>

</form>
</div>

<?php 
if (isset($_POST['edit-income'])) {

  $rowid = $_POST['edit-income'];
  
  
}

?>

<?php
include_once 'footer.php';
?>
</body>
</html>

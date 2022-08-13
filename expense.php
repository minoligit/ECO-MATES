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
  <title>Expense</title>
  <style>
    .menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
  </style>
  <link rel="stylesheet" type="text/css" href="Styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<br>
<H4> Expense Details of <?php echo date("Y"); ?> </H4>
<hr style="line-height:1px; border-color:#006400;">
<br><br>

<table>
  <tr>
    <th><button style="font-size: 70%;height: 40px;width: auto;border-radius: 8px;background-color: #63aba6;color: black;" data-id="2" id="export-expense">Export Espense Data</button>
    </th>
    <th style="column-width:20px;"></th>
    <th>
      <div>
        <form action="expense.php" method="POST">
          <button id="button2" type="submit" name="reset-expense">Reset Expense Data</button>
        </form>
      </div>
    </th>
  </tr>
</table>
<br><br>

<script>
  $('#export-expense').on('click', function() {
     
            var id=$(this).attr("data-id");
                  $.ajax({
  url: "crudexpense.php",
  type: "POST",
  data: {
  id:id
                 },
  cache: false,
  success: function(dataResult){
  window.open('crudexpense.php?id='+id);
                      }
  });
   
  });
</script>

<?php 
if (isset($_POST['reset-expense'])) {
  
  ?>
  <div id="form20" class="delete-popup">
    <form action="crudexpense.php" method="POST">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form20').style.display = 'none'">&times;</a>
      <p>Do you want to reset the expense for new year ?</p><br>&nbsp&nbsp&nbsp
      <button id="button-warn" type="submit" name="submit-reset-expense">Yes</button>
    </form>
  </div>
  <?php
}
?>

<br>
<div style="padding-right:10px;">
<form action="expense.php" method="POST">
  <table id="tablestyle1">
  <thead>
    <tr style="background-color: #8FBC8F;border: 2px solid black;height: 30px;">
      <th id="td" style="column-width: 70px;">No</th>
      <th id="td" style="column-width: 400px;">Reason</th>
      <th id="td" style="column-width: 400px;">Paid to</th>
      <th id="td" style="column-width: 60px;">Amount (Rs.)</th> 
      <th id="td" style="column-width: 200px;">Paid on</th>
      <th style="column-width: 40px;"></th>
    </tr>
  </thead>
<?php 
  $sql1 = "SELECT * FROM expense ORDER BY paidDateTime;";
  $result1 = mysqli_query($conn1, $sql1);
  $resultCheck = mysqli_num_rows($result1);

  while ($row=mysqli_fetch_assoc($result1)){
    $id=$row['id'];
    $reason=$row['reason'];
    $toWhom=$row['toWhom']; 
    $amount=$row['amount'];
    $paidDateTime=$row['paidDateTime'];

  ?>
    <tr style="height:40px;font-size:80%;">
      <td id="td"><?php echo $id; ?></td>
      <td id="td"><?php echo $reason; ?></td>
      <td id="td"><?php echo $toWhom; ?></td>
      <td id="td"><?php echo $amount; ?></td>
      <td id="td"><?php echo $paidDateTime; ?></td>  
      <td></td> 
    </tr>
    <?php 
  }    ?>
</table>
<br>

</form>
</div>

<?php

?>

<?php
include_once 'footer.php';
?>
</body>
</html>
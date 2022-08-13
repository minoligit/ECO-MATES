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
  <title>Financial Details</title>
  <style>
    .menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
  </style>
  <link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menuorganization.php';
?>

<br>
<H4> PAYMENTS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>

<br><p>Membership payments upto <?php echo date("Y-m-d")." , ".date("l"); ?> are shown</p><br>

<form action="finance.php" method="POST">
  <button id="button2" type="submit" name="reset-annualfee">Reset Annual Fee</button>&nbsp&nbsp&nbsp&nbsp
  <button id="button2" type="submit" name="expense">Out Payments</button>&nbsp&nbsp&nbsp&nbsp
  <button id="button2" type="submit" name="income">Income Payments</button>
</form>
<br><br>
<div style="padding-right:10px;">
<form action="finance.php" method="POST">
  <table id="tablestyle1">
  <thead>
    <tr style="background-color: #8FBC8F;border: 2px solid black;height: 30px;">
      <th id="td" style="column-width: 60px;">Member No</th>
      <th id="td" style="column-width: 250px;">Full Name</th>
      <th id="td" style="column-width: 200px;">Contact No</th>
      <th id="td" style="column-width: 50px;">Annual Fee</th> 
      <th id="td" style="column-width: 150px;">Last Payment Rs.</th>
      <th id="td" style="column-width: 200px;">Last Payment on</th>
      <th id="td" style="column-width: 200px;">Total Payments Rs.</th>
      <th style="column-width: 60px;"></th>
      <th style="column-width: 60px;"></th>       
    </tr>
  </thead>
<?php 
  $sql1 = "SELECT * FROM members;";
  $result1 = mysqli_query($conn1, $sql1);
  $resultCheck = mysqli_num_rows($result1);

  while ($row=mysqli_fetch_assoc($result1)){
    $id=$row['id'];
    $fullName=$row['fullName'];
    $contactNo=$row['contactNo']; 
    $lastPaidAmount=$row['lastPaidAmount'];  
    $lastPaidDateTime=$row['lastPaidDateTime'];
    $totalPayments=$row['totalPayments'];

  ?>
    <tr style="height:40px;">
      <td id="td"><?php echo $id; ?></td>
      <td id="td"><?php echo $fullName; ?></td>
      <td id="td"><?php echo "0".$contactNo; ?></td> 

      <td id="td"><?php if ($row['annualFee']==1) {
                  ?> <p>Paid</p><?php
                }
                else{
                  ?> <p style="color:red;">Not-Paid</p><?php
                } ?></td>

      <td id="td"><?php echo $lastPaidAmount; ?></td>
      <td id="td"><?php echo $lastPaidDateTime; ?></td>
      <td id="td"><?php echo $totalPayments; ?></td>   
      <td><button id="button1" type="submit" name="member-pay" value="<?php echo $row['id']; ?>">Payment</button></td>
      <td><button id="button1" type="submit" name="member-more" value="<?php echo $row['id']; ?>">More</button></td>
    </tr>
    <?php 
  }    ?>
</table>
<br>

</form>
</div>
<br><br><br><br>

<?php
if (isset($_POST['member-pay'])) {
  $rowid = $_POST['member-pay'];
  $sql2 = "SELECT * FROM members WHERE id =$rowid;";
  $result2 = mysqli_query($conn1, $sql2);
  $row=mysqli_fetch_array($result2);
  ?>

  <div class="form-display" id="form15">
    <form action="crudfinance.php" method="POST">

      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form15').style.display = 'none'">&times;</a>
      <label id="label1"><b>Payments</b></label><br>
      <label id="label1"><?php echo $row['fullName']; ?></label><br><br><br><br>
      <?php echo "NIC No".str_repeat('&nbsp;', 12).": ".$row['nic']."<br>"; 
            echo "Contact No".str_repeat('&nbsp;', 6).": 0".$row['contactNo']."<br>"; 
            echo "Email Address".str_repeat('&nbsp;', 1).": ".$row['email']."<br>"; 
            echo "Joined Date".str_repeat('&nbsp;', 5).": ".$row['joinDate']."<br><br><br>"; 
      ?>
      <label>Type</label>
      <input id="inputRadio" type="radio" name="annualFee" value="1">&nbspAnnual fee&nbsp&nbsp&nbsp
      <input id="inputRadio" type="radio" name="annualFee" value="0">&nbspOther<br><br>
      <label>Payment (Rs.)</label><input type="number" name="lastPaidAmount" required=""><br><br>
      <label>Payment on</label><input type="datetime-local" name="lastPaidDateTime" value="<?php echo date("Y-m-d h:i:sa") ?>"><br><br><br><br>
      <div align="center">
        <button type="submit" name="submit-member-pay" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button type="reset" name="reset">Clear</button>
      </div>

    </form>
  </div>

  <?php
}

if(isset($_POST['member-more'])){
  $rowid = $_POST['member-more'];

  ?>
  <div id="form20" class="delete-popup">
    <form action="viewmember.php" method="POST" target="_blank">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form20').style.display = 'none'">&times;</a>
      <p>Do you want to view more of member <?php echo $rowid; ?> ?</p><br>&nbsp&nbsp&nbsp
      <button id="button1" type="submit" name="submit-more" value="<?php echo $rowid; ?>">Yes</button>
    </form>
  </div>
<?php
}

if(isset($_POST['reset-annualfee'])){
  ?>
  <div id="form21" class="delete-popup">
    <form action="crudfinance.php" method="POST">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form21').style.display = 'none'">&times;</a>
      <p>Do you want to reset the annual membership payment ?</p><br>&nbsp&nbsp&nbsp
      <button id="button1" type="submit" name="submit-reset-annualfee">Yes</button>
    </form>
  </div>
  <?php
}

if(isset($_POST['expense'])){
  ?>
  <div id="form22" class="profile-popup" style="width:50%;">
    <form action="crudfinance.php" method="POST">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form22').style.display = 'none'">&times;</a>
      <label id="label1"><b>Payments</b></label><br><br><br>
      <label>Reason</label><input type="text" name="reason"><br><br>
      <label>Paid to</label><input type="text" name="toWhom"><br><br>
      <label>Amount (Rs.)</label><input type="number" name="amount"><br><br>
      <label>Paid on</label><input type="datetime-local" name="paidDateTime"><br><br><br>
      <div align="center">
        <button type="submit" name="submit-expense">Pay</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button type="reset" name="reset">Clear</button>
      </div>
    </form>
  </div>
  <?php
}

if(isset($_POST['income'])){
  ?>
  <div id="form23" class="profile-popup" style="width:50%;">
    <form action="crudfinance.php" method="POST">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form23').style.display = 'none'">&times;</a>
      <label id="label1"><b>Income</b></label><br><br><br>
      <label>Reason</label><input type="text" name="type"><br><br>
      <label>Paid By</label><input type="text" name="paidBy"><br><br>
      <label>Amount (Rs.)</label><input type="number" name="amount"><br><br>
      <label>Paid on</label><input type="datetime-local" name="paidDateTime"><br><br><br>
      <div align="center">
        <button type="submit" name="submit-income">Pay</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button type="reset" name="reset">Clear</button>
      </div>
    </form>
  </div>
  <?php
}

?>

<br><br><br>

<H4> FINANCIAL STATUS </H4>
<hr style="line-height:1px; border-color:#006400;">
<br><br>

<button id="button2"><a href="income.php" style="color:black;text-decoration:none;" target="_blank">Income Details</a></button>&nbsp&nbsp&nbsp&nbsp
<button id="button2"><a href="expense.php" style="color:black;text-decoration:none;" target="_blank">Expense Details</a></button>

<br><br><br>
<table id="tablestyle1">
  <tr style="background-color: #8FBC8F;border: 2px solid black;height: 50px;">
    <td  id="td" style="column-width:600px;padding-left:10px;" align="left"><b>Description</b></td>
    <td id="td" style="column-width:150px;padding-left:10px;" align="right"><b>Amount (Rs.)</b></td>
    <td id="td" style="column-width:150px;padding-left:10px;" align="right"><b>Total (Rs.)</b></td>
  </tr>
  <tr style="height:50px;">
    <?php  
    $sql4 = "SELECT * FROM organization;";
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($result4);
    $sum4 = $row4['financialStatusLastYr'];
    ?>
    <td id="td" style="padding-left:10px;" align="left">Financial status upto <?php echo date("Y",strtotime("-1 year"))."-12-31"; ?></td>
    <td id="td"></td>
    <td id="td" style="padding-right:10px;" align="right"><?php echo $sum4; ?></td>
  </tr>
  <tr style="height:50px;">
    <?php  
    $sql5 = "SELECT SUM(amount) AS sum5 FROM income WHERE type='membership payment'";
    $result5 = mysqli_query($conn1, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
    $sum5 = $row5['sum5'];
    ?>
    <td id="td" style="padding-left:10px;" align="left">Received membership fees within this year</td>
    <td id="td" style="padding-right:10px;" align="right"><?php echo $sum5; ?></td>
    <td id="td"></td>
  </tr>
  <tr style="height:50px;">
    <?php  
    $sql6 = "SELECT SUM(amount) AS sum6 FROM income WHERE type!='membership payment'";
    $result6 = mysqli_query($conn1, $sql6);
    $row6 = mysqli_fetch_assoc($result6);
    $sum6 = $row6['sum6'];
    ?>
    <td id="td" style="padding-left:10px;" align="left">Received other income within this year</td>
    <td id="td" style="padding-right:10px;" align="right"><?php echo $sum6; ?></td>
    <td id="td"></td>
  </tr>
  <tr style="height:50px;">
    <td id="td" style="padding-left:10px;" align="left">Total income within this year</td>
    <td id="td"></td>
    <td id="td" style="padding-right:10px;" align="right"><?php echo $sum5+$sum6; ?></td>
  </tr>
  <tr style="height:50px;">
    <?php  
    $sql7 = "SELECT SUM(amount) AS sum7 FROM expense ;";
    $result7 = mysqli_query($conn1, $sql7);
    $row7 = mysqli_fetch_assoc($result7);
    $sum7 = $row7['sum7'];
    ?>
    <td id="td" style="padding-left:10px;" align="left">Expense within this year</td>
    <td id="td"></td>
    <td id="td" style="padding-right:10px;" align="right"><?php echo $sum7; ?></td>
  </tr>
  <tr style="height:50px;">
    <td id="td" style="padding-left:10px;" align="left">Financial status of this year</td>
    <td id="td"></td>
    <td id="td" style="padding-right:10px;" align="right"><?php echo $sum5+$sum6-$sum7; ?></td>
  </tr>
  <tr style="height:50px;border:1px solid black;">
    <td id="td" style="padding-left:10px;" align="left">Overall financial status</td>
    <td id="td"></td>
    <td id="td" style="padding-right:10px;" align="right"><?php echo $sum4+$sum5+$sum6-$sum7; ?></td>
  </tr>

  
</table>

<?php
include_once 'footer.php';
?>
</body>
</html>
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
//////////////////////////////////Make member payments/////////////////////////////////

if (isset($_POST['submit-member-pay'])) {
	
	$rowid = $_POST['submit-member-pay'];

	$sql1 = "SELECT * FROM members WHERE id = '$rowid';";
	$result1 = mysqli_query($conn1, $sql1);
	$row = mysqli_fetch_assoc($result1);

	$lastPaidAmount = $_POST['lastPaidAmount'];
	$lastPaidDateTime = $_POST['lastPaidDateTime'];
	$totalPayments = addNumbers($row['totalPayments'] , $lastPaidAmount);

	$sql3 = "SELECT * FROM income;";
	$result3 = mysqli_query($conn1, $sql3);
	$i = mysqli_num_rows($result3);

	$memberId = $rowid;
	$paidBy = $row['fullName'];
	$newid = $i+1;

	if ($_POST['annualFee']==1) {
		$annualFee = 1;
		$sql4 = "INSERT INTO income (id,type,memberId,paidBy,amount,paidDateTime) VALUES ('$newid','membership payment','$memberId','$paidBy','$lastPaidAmount','$lastPaidDateTime')";
		$run4 = mysqli_query($conn1, $sql4) or die(mysqli_error($conn1));
	}
	else{
		$annualFee = $row['annualFee'];
		$sql4 = "INSERT INTO income (id,type,memberId,paidBy,amount,paidDateTime) VALUES ('$newid','other',$memberId,'$paidBy','$lastPaidAmount','$lastPaidDateTime')";
		$run4 = mysqli_query($conn1, $sql4) or die(mysqli_error($conn1));
	}

	$sql2 = "UPDATE members SET annualFee='$annualFee',lastPaidAmount='$lastPaidAmount',lastPaidDateTime='$lastPaidDateTime',totalPayments='$totalPayments' WHERE id='$rowid';";
	$run2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));


	if ($run2&&$run4) {
		echo "<script>alert('Payment was successfully recorded.');</script>";
		header("Location:finance.php");
	}
	elseif ($run2) {
		echo "<script>alert('Error in adding to payments history.');</script>";
	}
	elseif ($run4) {
		echo "<script>alert('Error in adding to membership payments.');</script>";
	}
	else{
		echo "<script>alert('Please try again.');</script>";
	}

}

function addNumbers($a,$b){
  return $a+$b;
}

//////////////////////////////////Make member payments/////////////////////////////////
//////////////////////////////Make non member payments/////////////////////////////////
if (isset($_POST['submit-income'])) {
	

	$sql3 = "SELECT id FROM income;";
	$result3 = mysqli_query($conn1, $sql3);
	$i = mysqli_num_rows($result3);

	$type = $_POST['type'];
	$paidBy = $_POST['paidBy'];
	$amount = $_POST['amount'];
	$paidDateTime = $_POST['paidDateTime'];
	$newid = $i+1;

	$sql4 = "INSERT INTO income (id,type,paidBy,amount,paidDateTime) VALUES ('$newid','$type','$paidBy','$amount','$paidDateTime')";
	$run4 = mysqli_query($conn1, $sql4) or die(mysqli_error($conn1));
	

	if ($run4) {
		echo "<script>alert('Income payment was successfully recorded.');</script>";
		header("Location:finance.php");
	}
	else{
		echo "<script>alert('Please try again.');</script>";
	}

}

//////////////////////////////Make non member payments/////////////////////////////////
/////////////////////////////Reset annual membership payments//////////////////////////

if (isset($_POST['submit-reset-annualfee'])) {

  $annualFee = 0;
  $sql5 = "UPDATE members SET annualFee='$annualFee';";
  $run5 = mysqli_query($conn1, $sql5) or die(mysqli_error($conn1));

  if ($run5) {
    echo "<script>alert('Annual Membership Payment is reset');</script>";
    header("Location:finance.php");
  }
  else{
    echo "<script>alert('Please try again.');</script>";
  } 
}

/////////////////////////////Reset annual membership payments//////////////////////////
//////////////////////////////Payments done by organization///////////////////////////

if (isset($_POST['submit-expense'])) {
	
	$sql6 = "SELECT id FROM expense;";
	$result6 = mysqli_query($conn1, $sql6);
	$i = mysqli_num_rows($result6);
	$newid = $i+1;

	$reason = $_POST['reason'];
	$toWhom = $_POST['toWhom'];
	$amount = $_POST['amount'];
	$paidDateTime = $_POST['paidDateTime'];

	$sql7 = "INSERT INTO expense (id,reason,toWhom,amount,paidDateTime) VALUES ('$newid','$reason','$toWhom','$amount','$paidDateTime')";
	$run7 = mysqli_query($conn1, $sql7) or die(mysqli_error($conn1));

	if ($run7) {
    echo "<script>alert('Expense is successfully recorded');</script>";
    header("Location:finance.php");
  }
  else{
    echo "<script>alert('Please try again.');</script>";
  } 
}

//////////////////////////////Payments done by organization///////////////////////////
?>

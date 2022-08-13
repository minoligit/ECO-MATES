<?php
  include_once 'include.php';
?>

<?php  
 
$id=$_GET['id'];
$sql1 = "SELECT * FROM expense ";  
$result1 = mysqli_query($conn1, $sql1);  
$columnHeader = '';  
$columnHeader = "Id" . "\t" . "Reason" . "\t" . "Paid to" . "\t". "Amount" . "\t" . "Paid Date & Time" . "\t";  
$setData = '';  
 while ($row = mysqli_fetch_row($result1)) {  
    $rowData = '';  
    foreach ($row as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
 
$fileName = "expense-".date('Y-m-d').".xls";
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=$fileName");  
header("Pragma: no-cache");  
header("Expires: 0");  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
?>

<?php  

////////////////////////////////////Reset Expense - begining of the year////////////////////////////
if (isset($_POST['submit-reset-expense'])) {

  $sql4 = "SELECT SUM(amount) AS sum FROM expense;";
  $result4 = mysqli_query($conn1, $sql4);
  $row4 = mysqli_fetch_assoc($result4);
  $sum = $row4['sum'];

  $sql5 = "SELECT * FROM organization;";
  $result5 = mysqli_query($conn, $sql5);
  $row5 = mysqli_fetch_assoc($result5);

  $financialStatusLastYr = $row5['financialStatusLastYr'] - $sum;

  $sql6 = "UPDATE organization SET financialStatusLastYr='$financialStatusLastYr';";
  $run6 = mysqli_query($conn, $sql6) or die(mysqli_error($conn));

  $sql7 = "DELETE FROM expense;";
  $run7 = mysqli_query($conn1, $sql7) or die(mysqli_error($conn1));

  if($run6&&$run7){
    echo "<script>alert('Expense data is reset.');</script>";
  }
  else{
    echo "<script>alert('Could not reset expense data. Please try again.');</script>";
  }
}

////////////////////////////////////Reset Expense - begining of the year////////////////////////////
///////////////////////////////////////Delete Expense Records///////////////////////////////////////


///////////////////////////////////////Delete Expense Records///////////////////////////////////////
?>
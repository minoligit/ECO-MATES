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

<!DOCTYPE html>
<html>
<head>
  <title>Print Certificate</title>
  <link rel="stylesheet" type="text/css" href="print.css">
</head>
<body>

<div id="printCertificate">

<header>
  <?php  
  $sql1 = "SELECT * FROM organization WHERE id='$thisOrg';";
  $result1 = mysqli_query($conn, $sql1);
  $resultCheck = mysqli_num_rows($result1);
  $row1=mysqli_fetch_assoc($result1);

  echo "<br><b>".$row1['name']."<br>";
  echo $row1['location']."<br>";
  echo $row1['email']."<br>";
  echo $row1['telephone']."</b><br><br>";
  ?> 
</header> 

<?php   
if (isset($_POST['certificate'])) {
  $rowid = $_POST['certificate'];

  $sql2 = "SELECT * FROM members WHERE id='$rowid';";
  $result2 = mysqli_query($conn1, $sql2);
  $row2=mysqli_fetch_assoc($result2);

  echo "<br><br>";
  echo "We are glad to inform that <b>".$row2['fullName']."</b> (Member ID : ".$row2['id'].") was a member of our organization since ".$row2['joinDate'].".";

  $sql3 = "SELECT * FROM memberproj WHERE memberId='$rowid';";
  $result3 = mysqli_query($conn1, $sql3);
  $resultCheck3 = mysqli_num_rows($result3);
  $i=1;

  echo "<br><br><b>Participated Projects</b><br><br>";
  echo str_repeat('&nbsp;', 5)."Index".str_repeat('&nbsp;', 3)."Project Id".str_repeat('&nbsp;', 20)."Project Name".str_repeat('&nbsp;', 20)."Location"."<br>";

  if ($resultCheck3>0) {
    while ($row3=mysqli_fetch_assoc($result3)){
      $id=$row3['projId'];

      $sql4 = "SELECT * FROM completedproj WHERE id=$id AND orgId='$thisOrg';";
      $result4 = mysqli_query($conn, $sql4);
      $row4 = mysqli_fetch_assoc($result4);

      echo str_repeat('&nbsp;', 10).$i.str_repeat('&nbsp;', 10).$row3['projId'].str_repeat('&nbsp;', 15).$row4['name'].str_repeat('&nbsp;', 20).$row4['location']."<br>";
      $i++;
    }
  }

  echo "<br><br>".$_POST['further'];
}
?>

<br><br><br><br>
<pre>
      .........................                ..........................
             president                                 secratary
</pre>
<br><br>

<div>
  <footer>
    <br><b>ECO-MATES<br>Let's get together for our mother nature</b><br><br>
  </footer>
</div>
</div>

<button id="button2" onclick="printDiv('printCertificate')">Print</button> 
<script type="text/javascript">
    function printDiv(printCertificate) {
        var printContents = document.getElementById(printCertificate).innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }
</script>

</body>
</html>

<br><br>


 
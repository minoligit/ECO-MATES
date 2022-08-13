<?php 
if (!isset($_SESSION['session_orgid'])){
    header("Location: organizationlogin.php");
}
$thisOrg = $_SESSION['session_orgid'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>ECO-MATES</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<br><br><br><br><br><br><br>
<footer><br>

	<table>
		<td style="column-width: 600px;text-align: center;">
			<b>ECO-MATES</b><br><br>
			<i class="fa fa-envelope"></i>&nbsp&nbspGeneral Inquiries : <a href="mailto: ecomates@gmail.com">ecomates@gmail.com</a>
		</td>
		<td style="column-width: 600px;text-align: center;">

			<?php 
  			$sql = "SELECT * FROM organization WHERE id = '$thisOrg';";
			$result = mysqli_query($conn, $sql);
			$row=mysqli_fetch_assoc($result); 

			echo "<b>".$row['name']."</b><br><br><i class='fas fa-phone'></i>  Call Us : 0".$row['telephone']."<br>";?>
			<i class="fa fa-envelope"></i>&nbsp&nbspGeneral Inquiries :
			<a href="mailto: <?php echo $row['email']; ?>"><?php echo $row['email']; ?></a>
			<?php echo "<br><i class='fas fa-home'></i>  Location : ".$row['location']."<br>"; ?> 
		</td>
		<td style="column-width: 500px;text-align: center;">
			<i class='fab fa-facebook-f'></i>&nbsp&nbsp&nbsp
			<i class='fab fa-linkedin-in'></i>&nbsp&nbsp&nbsp
			<i class='fab fa-twitter'></i>&nbsp&nbsp&nbsp
			<i class="fab fa-instagram"></i>
			<br><br><?php echo date("Y-m-d h:i:sa")." , ".date("l"); ?>
		</td>
	</table>
  
</footer>


</body>
</html>
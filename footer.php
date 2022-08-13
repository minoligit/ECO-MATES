
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
			if (isset($_SESSION['session_memberid'])) {
				$memberId = $_SESSION['session_memberid'];
				$sql1 = "SELECT * FROM members WHERE id = '$memberId';";
				$result1 = mysqli_query($conn1, $sql1);
				$row1 = mysqli_fetch_assoc($result1);
				$orgId = $row1['orgId'];

				$sql2 = "SELECT * FROM organization WHERE id = '$orgId';";
				$result2 = mysqli_query($conn, $sql2);
				$row2 = mysqli_fetch_assoc($result2); 

				echo "<b>".$row2['name']."</b><br><br><i class='fas fa-phone'></i>  Call Us : 0".$row2['telephone']."<br>";?>
				<i class="fa fa-envelope"></i>&nbsp&nbspGeneral Inquiries :
				<a href="mailto: <?php echo $row2['email']; ?>"><?php echo $row2['email']; ?></a>
				<?php echo "<br><i class='fas fa-home'></i>  Location : ".$row2['location']."<br>";  
			}
			?>
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
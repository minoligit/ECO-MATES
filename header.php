
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

<header>
	<div style="width: 100%; text-align: right;">

		<?php 
		if (!isset($_SESSION['session_memberid'])&&!isset($_SESSION['session_sadminid'])){
	    	?><br><i class='far fa-user-circle' style='font-size:30px'></i>&nbsp&nbsp&nbsp
	    	<a href="memberlogin.php" style="color:white;padding-right: 50px;">Sign In</a>  <?php
		}

		elseif (isset($_SESSION['session_memberid'])) {
					
			$rowid = $_SESSION['session_memberid'];
			$sql = "SELECT * FROM members WHERE id='$rowid';";
			$result = mysqli_query($conn1, $sql);
			$row = mysqli_fetch_assoc($result); 

			?>
			<form action="header.php" method="POST">
				<?php echo "<br>".str_repeat('&nbsp;', 10)."<b>".$row['fullName']."</b>".str_repeat('&nbsp;', 5); ?>
				<a href="messages.php" style="color:white;" target="_blank"><i class="fa fa-bell"></i></a>&nbsp&nbsp&nbsp&nbsp
				<a href="myprofile.php" style="color:white" target="_blank"><i class='fas fa-user-cog'></i></a>
				&nbsp&nbsp&nbsp&nbsp
				<button style="width:auto;background-color:#003311; color:white;border:none;padding-right: 20px;" type="submit" name="logout">Sign out</button>
			</form>
			
			<?php
		}
		elseif (isset($_SESSION['session_sadminid'])) {
					
			$rowid = $_SESSION['session_sadminid'];
			$sql = "SELECT * FROM superadmin WHERE superAdminId='$rowid';";
			$result = mysqli_query($conn, $sql);
			$row=mysqli_fetch_assoc($result); 

			?>
			<form action="header.php" method="POST">
				<?php echo "<br>".str_repeat('&nbsp;', 10)."<b>".str_repeat('&nbsp;', 5)."Admin Page</b>".str_repeat('&nbsp;', 5); ?>
				<!-- <i class="fa fa-bell"></i>&nbsp&nbsp&nbsp&nbsp -->
				<button style="width:auto;background-color:#003311; color:white;border:none;padding-right: 20px;" type="submit" name="logout">Sign out</button>
			</form>
			
			<?php
		}

		?>
				
	</div>

<?php  
if (isset($_POST['logout'])) {
 	?> 
 	<div style="width:30%;color:black;" class="form-display" id="form31">
 		<form action="signout.php" method="POST">
 			<br>Do you want to log out ?<br><br>
			<button class="profile-submit" type="submit" name="submit-logout">Yes</button>&nbsp&nbsp&nbsp
			<button class="profile-submit" onclick="document.getElementById('form31').style.display.'none'">No</button>
 		</form>
 	</div>
 	<?php
} 
?> 

</header>


</body>
</html>


<?php
  include_once 'include.php';

if (isset($_POST['login'])) {
	
	if (isset($_POST['username'])) {
	
		$uname=$_POST['username'];
		$password=$_POST['password'];

		$query1 = "SELECT * FROM organization WHERE username='".$uname."' AND password='".$password."'limit 1";
		$result1=mysqli_query($conn, $query1);
		$row=mysqli_fetch_assoc($result1);

		if (mysqli_num_rows($result1)==1) {
			session_start();
			$_SESSION['session_orgid'] = $row['id']; 
			header("Location:ecomates.php");
		}
		else{
			echo "<script>alert('Incorrect username or password');</script>";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="Styles2.css">
</head>
<body style="font-size: 120%;background-image: url('login.jpg');">

<div align="center" style="padding-top:100px;opacity:0.95;">
	<div id="login-form">

		<br><b><H3>ECO-MATES<hr></b></H3><br>
		<div class="form-popup-login" id="form2">
			<form action="organizationlogin.php" method="post">
			
				<b><H3>USER LOGIN</H3></b>
				<b>Username</b> &nbsp&nbsp&nbsp <input type="text" name="username" placeholder="Username"><br><br>
				<b>Password</b> &nbsp&nbsp&nbsp <input type="password" name="password" placeholder="Password"><br><br><br>
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<button type="submit" name="login"  style="border:3px solid black;">Login</button>&nbsp&nbsp&nbsp&nbsp
				<button style="border:3px solid black;" onclick="window.close()">Exit</button><br><br><br><br>
	
			</form>
		</div>

	</div>
</div>

</body>
</html>

<?php
  include_once 'include.php';

if (isset($_POST['login'])) {
	
	if (isset($_POST['username'])) {
	
		$uname=$_POST['username'];
		$password=$_POST['password'];

		$query1 = "SELECT * FROM superadmin WHERE username='".$uname."' AND password='".$password."'limit 1";
		$result1=mysqli_query($conn, $query1);
		$row=mysqli_fetch_assoc($result1);

		if (mysqli_num_rows($result1)==1) {
			session_start();
			$_SESSION['session_sadminid'] = $row['superAdminId']; 
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
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="Styles2.css">
</head>
<body style="font-size: 120%;background-image: url('adminlogin.jpg');">

<div align="center" style="padding-top:100px;opacity:0.95;">
	<div id="login-form">

		<br><b><H3>ECO-MATES<hr></b></H3><br>
		<div class="form-popup-login" id="form2">
			<form action="superadminlogin.php" method="post">
			
				<b><H3>USER LOGIN</H3></b>
				Username &nbsp&nbsp&nbsp <input type="text" name="username" placeholder="Username"><br><br>
				Password &nbsp&nbsp&nbsp <input type="password" name="password" placeholder="Password"><br><br><br>
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<button type="submit" name="login">Login</button>&nbsp&nbsp&nbsp&nbsp
				<button onclick="window.close()">Exit</button>

				<br><br><br>
				Forgot Password <button id="button2" type="submit" name="reset">Reset</button>	
			</form>
		</div>

	</div>
</div>
	

</body>
</html>

<?php 
if (isset($_POST['reset'])) {
	
	?>
  <div id="form20" class="form-popup">
    <form action="memberlogin.php" method="POST">
      <a href="javascript:void(0)" class="close-form" onclick="document.getElementById('form20').style.display = 'none'">&times;</a>
      <p>Do you want to reset your password ?<br><br>
      	<label>Enter your contact number</label><input type="number" name="contactNo"><br>
      </p><br>

      <button id="button1" type="submit" name="submit-reset">Enter</button>&nbsp&nbsp&nbsp
      <button id="button1" onclick="document.getElementById('form20').style.display = 'none'">Exit</button>
    </form>
  </div>
  <?php
}
if (isset($_POST['submit-reset'])) {


}

?>
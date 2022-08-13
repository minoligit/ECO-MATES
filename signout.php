<?php

session_start();

if (isset($_POST['submit-logout'])) {
	session_destroy();
	header("Location: organizationlogin.php");
}
else{
	header("Location: ecomates.php");
}

?>
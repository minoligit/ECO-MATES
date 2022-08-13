<?php 
session_start();
include_once 'include.php';
if (isset($_SESSION['session_memberid'])){
	$memberId = $_SESSION['session_memberid'];
	$sql1 = "SELECT * FROM members WHERE id = '$memberId';";
	$result1 = mysqli_query($conn1, $sql1);
	$row1 = mysqli_fetch_assoc($result1);
 	$thisOrg = $row1['orgId'];
}
else{
  header("Location: memberlogin.php");
}
?>

<!------------------------------- Add new article page ------------------------------------>

<!DOCTYPE HTML>
<html>  
<head>
	<title>CRUD article</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>
	<h4>Add New Articles</h4>
	<hr style="line-height:1px; border-color:#006400;">
    <br>

<br><br><br><br>
<div class="form-display" style="width:90%;">
<form action="crudarticle.php" method="POST">

	<br><br>
    <label>Title </label><input type="text" name="name" required=""><br><br>
    <label>Author </label><input type="text" name="author"><br><br>
    <label>Published Date </label><input type="date" name="writenDate" value="<?php echo date("Y-m-d");?>" required><br><br>
    <label>Contact Details </label><input type="text" name="contactDetail" required=""><br><br>
    <label>Content </label><br><textarea name="description" style="width: 75%;height: 500px;" required=""></textarea><br><br><br>
    <div align="center">
    	<button type="submit" name="submit-add" >Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="reset" name="reset" >Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button onclick="window.close()">Exit</button>
    </div>
	
</form>	
</div>

</body>
</html>

<!------------------------------- Add new article page ------------------------------------>
<?php
////////////////////////////////////Add article///////////////////////////////////////////
if (isset($_POST['submit-add'])) {

	if (!empty($_POST['name'])&&!empty($_POST['description'])) {
	
		if(empty($_POST['author'])){
			$_POST['author'] = "Anonymous";
		}

		 $name = $_POST['name'];
		 $author = $_POST['author'];
		 $authorId = $_SESSION['session_memberid'];
		 $orgId = $row2['orgId'];
		 $writenDate = $_POST['writenDate'];
		 $contactDetail = $_POST['contactDetail'];
		 $description = $_POST['description'];

		$sql1 = "INSERT INTO articles (name,author,authorId,orgId,writenDate,contactDetail,description) VALUES ('$name','$author','$authorId','$thisOrg','$writenDate','$contactDetail','$description');";
		$run = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		if($run){
			header("Location:article.php");
		}
		else{
			echo "<script>alert('Could not submit the article. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Article name and content are required');</script>";
	}

}
////////////////////////////////////Add new article///////////////////////////////////////////
//////////////////////////////////////Edit article///////////////////////////////////////////

if (isset($_POST['submit-edit'])) {
	$rowid1 = $_POST['submit-edit'];

	if (!empty($_POST['name'])) {
	
		if(empty($_POST['author'])){
			$_POST['author'] = "Anonymous";
		}

		 $name = $_POST['name'];
		 $author = $_POST['author'];
		 $authorId = $_SESSION['session_memberid'];
		 $writenDate = $_POST['writenDate'];
		 $contactDetail = $_POST['contactDetail'];
		 $description = $_POST['description'];

		 if (!empty($description)) {
		 	$sql2 = "UPDATE articles SET name='$name',author='$author'authorId='$authorId',writenDate='$writenDate',contactDetail='$contactDetail',description='$description' WHERE id='$rowid1' AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
		 }
		 else{
		 	$sql3 = "UPDATE articles SET name='$name',author='$author',authorId='$authorId',orgId='$orgId',writenDate='$writenDate',contactDetail='$contactDetail' WHERE id='$rowid1' AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
		 }
		
		if($run){
			header("Location:article.php");
		}
		else{
			echo "<script>alert('Could not edit the article. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Article name is required');</script>";
	}

}
//////////////////////////////////////Edit article///////////////////////////////////////////
////////////////////////////////////Delete article///////////////////////////////////////////
if (isset($_POST['submit-delete'])) {
	$rowid1 = $_POST['submit-delete'];
	$sql4 = "DELETE FROM articles WHERE id ='$rowid1' AND orgId='$thisOrg';";
	$run = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

	if($run){
		echo "<script>alert('Article was successfully deleted.');</script>";
		header("Location:article.php");
	}
	else{
		echo "<script>alert('Could not delete the article. Please try again.');</script>";
	}
}
////////////////////////////////////Delete article///////////////////////////////////////////

?>
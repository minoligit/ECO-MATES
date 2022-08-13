<?php 
session_start();
if (!isset($_SESSION['session_orgid'])){
    header("Location: organizationlogin.php");
}
$thisOrg = $_SESSION['session_orgid'];
?>

<?php
	include_once 'include.php';
	include_once 'header.php';
?>

<br><br><br>
<?php
////////////////////////////////////Add New article///////////////////////////////////////////
if (isset($_POST['add-new-article'])) {
?>
<div class="form-display" style="width:90%;">
<form action="crudarticle.php" method="POST">

	<label id="label1"><b>Add New Article</b></label><br><br><br>
    <label>Title </label><input type="text" name="name"><br><br>
    <label>Author </label><input type="text" name="author"><br><br>
    <label>Published Date </label><input type="date" name="writenDate" value="<?php echo date("Y-m-d");?>"><br><br>
    <label>Contact Details </label><input type="text" name="contactDetail"><br><br>
    <label>Content </label><br><textarea name="description" style="width: 75%;height: 500px;"></textarea><br><br><br>
    <div align="center">
    	<button type="submit" name="submit-add" >Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<button type="reset" name="reset" >Clear</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    </div>
	
</form>	
</div>
<?php
}
////////////////////////////////////Add New article///////////////////////////////////////////
////////////////////////////////////Edit article///////////////////////////////////////////
if (isset($_POST['edit'])) {
  $rowid = $_POST['edit'];
  $sql2 = "SELECT * FROM articles WHERE id =$rowid AND orgId='$thisOrg';";
  $result2 = mysqli_query($conn, $sql2);
  $row=mysqli_fetch_array($result2);
  ?>

  <div class="form-display" id="form17" style="width:80%;">
  <form action="crudarticle.php" method="POST">

    <label id="label1"><b>Edit Article <?php echo $rowid; ?> </b></label><br><br><br>
    <label>Name </label><input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    <label>Author </label><input type="text" name="author" value="<?php echo $row['author']; ?>"><br><br>
    <label>Published Date </label><input type="date" name="writenDate" value="<?php echo $row['writenDate']; ?>"><br><br>
    <label>Contact Details </label><input type="text" name="contactDetail" value="<?php echo $row['contactDetail']; ?>"><br><br>
    <label style="width:50%;">Content (Keep empty if not updating)</label><br><br>
    <textarea name="description" style="width: 80%;height: 400px;"></textarea><br><br>
    <div align="center">
      <button type="submit" name="submit-edit" value="<?php echo $rowid; ?>">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <button type="reset" name="reset">Clear</button>
    </div>

  </form> 
  </div>

  <?php
}
////////////////////////////////////Edit article///////////////////////////////////////////
////////////////////////////////////Delete article///////////////////////////////////////////
if(isset($_POST['delete'])){
  $rowid = $_POST['delete'];
  ?>
  <div id="form19" class="form-display" style="width:35%;background-color:white;">
    <form action="crudarticle.php" method="POST">
      <p>Do you want to delete the article <?php echo $rowid; ?> ?</p><br>&nbsp&nbsp&nbsp
      <button id="button-warn" type="submit" name="submit-delete" value="<?php echo $rowid; ?>">Yes</button>
    </form>
  </div>
  <?php
}
////////////////////////////////////Delete article///////////////////////////////////////////
////////////////////////////////////Add article///////////////////////////////////////////
if (isset($_POST['submit-add'])) {

	if (!empty($_POST['name'])&&!empty($_POST['description'])) {
	
		if(empty($_POST['author'])){
			$_POST['author'] = "Anonymous";
		} 

		 $name = $_POST['name'];
		 $author = $_POST['author'];
		 $authorId = $_SESSION['session_orgid'];
		 $orgId = $thisOrg;
		 $writenDate = $_POST['writenDate'];
		 $contactDetail = $_POST['contactDetail'];
		 $description = $_POST['description'];

		$sql1 = "INSERT INTO articles (name,author,authorId,orgId,writenDate,contactDetail,description) VALUES ('$name','$author','$authorId','$orgId','$writenDate','$contactDetail','$description');";
		$run = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		if($run){
			header("Location:articles.php");
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
////////////////////////////////////Edit article///////////////////////////////////////////

if (isset($_POST['submit-edit'])) {
	$rowid = $_POST['submit-edit'];

	if (!empty($_POST['name'])) {
	
		if(empty($_POST['author'])){
			$_POST['author'] = "Anonymous";
		}

		 $name = $_POST['name'];
		 $author = $_POST['author'];
		 $authorId = $_SESSION['session_orgid'];
		 $orgId = $_SESSION['session_orgid'];
		 $writenDate = $_POST['writenDate'];
		 $contactDetail = $_POST['contactDetail'];
		 $description = $_POST['description'];

		 if (!empty($description)) {
		 	$sql2 = "UPDATE articles SET name='$name',author='$author',authorId='$authorId',orgId='$orgId',writenDate='$writenDate',contactDetail='$contactDetail',description='$description' WHERE id='$rowid' AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
		 }
		 else{
		 	$sql3 = "UPDATE articles SET name='$name',author='$author',authorId='$authorId',orgId='$orgId',writenDate='$writenDate',contactDetail='$contactDetail' WHERE id='$rowid' AND orgId='$thisOrg';";
			$run = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
		 }
		
		if($run){
			header("Location:articles.php");
		}
		else{
			echo "<script>alert('Could not edit the article. Please try again.');</script>";
		}
	}
	else{
		echo "<script>alert('Article name is required');</script>";
	}

}
////////////////////////////////////Edit article///////////////////////////////////////////
////////////////////////////////////Delete article///////////////////////////////////////////
if (isset($_POST['submit-delete'])) {
	$rowid = $_POST['submit-delete'];
	$sql4 = "DELETE FROM articles WHERE id ='$rowid' AND orgId='$thisOrg';";
	$run = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

	if($run){
		echo "<script>alert('Article was successfully deleted.');</script>";
		header("Location:articles.php");
	}
	else{
		echo "<script>alert('Could not delete the article. Please try again.');</script>";
	}
}
////////////////////////////////////Delete article///////////////////////////////////////////
include_once 'footer.php';
?>
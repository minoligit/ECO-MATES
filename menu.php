
<!DOCTYPE html>
<body>

<div id="mySidenav" class="sidenav" style="line-height:200%;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div style="color:#FFFFFF; padding-left:32px;"><u>Menu Bar</u></div><br>
  <a href="ecomates.php">ECO-mates</a><br>
  <a href="organization.php">Organization</a><br>

  <?php 
  if (isset($_SESSION['session_memberid'])) {
  ?>
    
  <a href="completedproj.php">Completed Projects</a><br>
  <a href="ongoingproj.php">Ongoing Projects</a><br>
  <a href="futureproj.php">Future Projects</a><br>
  <a href="article.php">Articles</a><br>

  <?php
  }
  else{
  ?>

  <a href="completedprojs.php">Completed Projects</a><br>
  <a href="ongoingprojs.php">Ongoing Projects</a><br>
  <a href="futureprojs.php">Future Projects</a><br>
  <a href="articles.php">Articles</a><br>

  <?php
  }

  ?>
  
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "15%";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

</body>
</html>

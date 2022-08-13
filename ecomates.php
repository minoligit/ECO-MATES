<?php 
session_start();
if (isset($_SESSION['session_sadminid'])){
    $sadminid = $_SESSION['session_sadminid'];
}

?>

<?php
	include_once 'include.php';
	include_once 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>ECO-MATES</title>
	<style>
		.menu{background-color:lightblue; font-size:100%; border:solid; border-color:darkblue; padding:20px; }
	</style>
	<link rel="stylesheet" type="text/css" href="Styles.css">
</head>
<body>

<?php
include_once 'menu.php';
?>

<br>
<H4> WELCOME &nbspTO &nbspTHE &nbspECO-MATES </H4>
<hr style="line-height:1px; border-color:#006400;">
<br>

<span style="font-size:100%;cursor:pointer" onclick="openNav()">&#9776; Click here to view the menu</span>

<br><br><br>

	<div style="background-image: url('bubble.jpg');height:250px;opacity:90%;">
	<b><pre style="text-align:center; font-size:150%;">

  " We have a single mission: 
	     To protect and hand on the planet 
	           to the next generation."

	 ~~ Francois Hollande


	 </pre></b>
	</div>

<br> 

<H5 style="background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;text-align:center;">More on Nature ....</H5>
<br>
The rise of technology and industry has moved the modern man so far compared to the lives of hundred years ago. <br>Obviously, it is all-right and it should be happened.
<br><br>&nbsp&nbsp&nbsp&nbsp<b>But</b><br><br>
Do you know who has become the most ill-fated victim of this tremendous develepment ? <br><br>
<div style="padding-left:10%;">It is the <b>MOTHER NATURE</b></div>
<br><br>
Why should we protect our Mother Nature ?<br>
<ul style="color:#008000;">
	<li>Can you live even couple of minutes without &nbsp&nbsp<b> AIR </b> ?</li>
	<li>Can you live even couple of days without &nbsp&nbsp<b> WATER </b> ?</li>
	<li>Can you live even couple of months without &nbsp&nbsp<b> FOOD </b> ?</li>
</ul>
<br><br>
Then who provides us those ? <br><br>
<div style="padding-left:10%;">It is the <b>MOTHER NATURE</b></div><br>
Then what should we protect at <div style="color:red;display:inline;"><b>FIRST</b></div> ?<br><br>
<div style="padding-left:10%;">It is the <b>MOTHER NATURE</b></div><br>
&nbsp&nbsp&nbsp&nbsp<b>But</b><br><br>
Do you agree if I say that what we are destroying more is THE NATURE ?

<br><br>
<h5 style="background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;text-align:center;">ECO-MATES Our Effort....</h5>
<br>
<table style="border-collapse: collapse;border-spacing: 0;">
	<thead>
		<tr>
			<td width="100px" height="300px"></td>
			<td>
				<body onload="startTimer()"><img id="img1" src="polluted01.jpg" style="width:500px;height:300px;">
				</body>
			</td>
			<td width="300px" height="300px">
				<div align="center" style="font-size:200px;"><b>&#8594;</b></div>
			</td>
			<td>
				<body onload="startTimer()"><img id="img2" src="clean01.jpg" style="width:500px;height:300px;">
				</body>
			</td>
		</tr>
	</thead>
</table>
<br><br>
As human, we all are bounded to protect the nature. ECO-MATES our attempt is to contribute for that and to make a better world for the next generations.

<br><br>
<H5 style="background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;text-align:center;">More on ECO-MATES ....</H5>
	ECO-MATES is a software application built with the purpose of encouraging people to save the environment. Through the application, it provides several benefites to organizations and their members. Also the people are encouraged to protect the environment.
	<br><br><br>
	<b>For organizations:</b>
    <ul style="color:#228B22;">
    	<li>Can publish project details to the society</li>
    	<li>Can handle project details and member details effectively</li>
    	<li>Can encourage members to participate</li>
    </ul>
    <br>
    <b>For members:</b>
    <ul style="color:#228B22;">
    	<li>Can view project details</li>
    	<li>Get certificates for participation in projects</li>
    	<li>Are encouraged to engage in more projects</li>
    </ul>

<br><br>
<H5 style="background:linear-gradient(to right, #339966 0%, #66ff33 100%);line-height:200%;text-align:center;">Foundation ....</H5>

<?php

	$sql = "SELECT * FROM ecomates;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck>0){
		while ($row=mysqli_fetch_assoc($result)){
			echo "ECO-MATES was initially created by <b>".$row['creater']."</b> on ".$row['releasedDate'].".";
			echo "The latest version is <b>".$row['latestVersion']."</b> which was releaed on ".$row['latestDate'].".";
		}
	}
?>
<br><br><br><br>
<table style="border-collapse: collapse;border-spacing: 0;">
	<thead>
		<tr>
			<td>
				<body onload="startTimer()"><img id="img3" src="nature01.jpg" style="width:500px;height:300px;">
				</body>
			</td>
			<td>
				<body onload="startTimer()"><img id="img4" src="nature04.jpg" style="width:500px;height:300px;">
				</body>
			</td>
			<td>
				<body onload="startTimer()"><img id="img5" src="nature07.jpg" style="width:500px;height:300px;">
				</body>
			</td>
		</tr>
	</thead>
</table>

<script type="text/javascript">
	
	function displayNextImage(){

		x = (x === images1.length-1) ? 0 : x+1;
		document.getElementById("img1").src = images1[x];

		y = (y === images2.length-1) ? 0 : y+1;
		document.getElementById("img2").src = images2[y];

		z = (z === images3.length-3) ? 0 : z+1;
		document.getElementById("img3").src = images3[z];
		document.getElementById("img4").src = images3[z+1];
		document.getElementById("img5").src = images3[z+2];
	
	}

	function startTimer(){
		setInterval(displayNextImage,3000);
	}
	
	var images1 = [], x=-1;
	images1[0]= "ecomates/polluted01.jpg"; images1[1]= "ecomates/polluted02.jpg"; 
	images1[2]= "ecomates/polluted03.jpg"; images1[3]= "ecomates/polluted04.jpg";

	var images2 = [], y=-1;
	images2[0]= "ecomates/clean01.jpg"; images2[1]= "ecomates/clean02.jpg"; 
	images2[2]= "ecomates/clean03.jpg"; images2[3]= "ecomates/clean04.jpg";

	var images3 = [], z=-1;
	images3[0]= "ecomates/nature01.jpg"; images3[1]= "ecomates/nature02.jpg"; images3[2]= "ecomates/nature03.jpg";
    images3[3]= "ecomates/nature04.jpg"; images3[4]= "ecomates/nature05.jpg"; images3[5]= "ecomates/nature06.jpg";
    images3[6]= "ecomates/nature07.jpg"; images3[7]= "ecomates/nature08.jpg"; images3[8]= "ecomates/nature09.jpg";

</script>
<br><br>
<table>
	<tr>
		<td width="180px"></td>
		<td width="500px" style="background: linear-gradient(to bottom right, #339933 0%, #66ffcc 100%);border-radius: 10px;">
			<div align="center">
				<br>Are you the owner of an eco-friendly organization ?<br><br>Do you have difficulties in managing details in your organization ?<br><br>Are you looking for a better solution ?<br><br><br>
			</div>
		</td>
		<td width="100px"></td>
		<td width="500px" style="background: linear-gradient(to bottom left, #339933 0%, #66ffcc 100%);border-radius: 10px;">
			<div align="center">
				<br>Are you a member of an eco-friendly organization ?<br><br>Does your organization have difficulties in managing details ?<br><br>Do you want them to go for better solutions ?<br><br><br>
			</div>
		</td>
	</tr>
</table><br><br>
<div align="center" style="font-size:200%;font-family:;"><b>ECO-MATES</b></div>

<?php
include_once 'footer.php';
?>

</body>
</html>
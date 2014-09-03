<?php
session_start();

 //Check whether the session variable SESS_MEMBER_ID is present or not
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
require 'postlogin.html';
	exit();
}
$_SESSION['time']=time();
echo '<a href="logout.php">logout</a>'; 

      
?>
<!DOCTYPE html>
<html>
<head>
<script>
function validateform() {
    var x1 = document.forms["search"]["name"].value;
	var x2 = document.forms["search"]["prodcname"].value;
	var x3 = document.forms["search"]["describe"].value;
	var x4 = document.forms["search"]["start1"].value;
	var x5 = document.forms["search"]["end1"].value;
	var flag1=0;var flag2=0;
    if ((x1 == null || x1 == "") && (x2 == null || x2 == "") && (x3 == null || x3 == "") && (x4 == null || x4 == "") && (x5 == null || x5 == "") ) 
	{
        alert("Atleast one field should be filled out");
       return false; flag=1;
    }
	
	
}
</script>
<style>

body{background-image:url('bg3.jpg');}
</style>
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['sess_username']; ?></h1>
<p>To search for Reports click on any of the following</p> 


<form action="manager3.php">
To search for product reports click below<br>
<input type="submit" value="Click here for product search">
</form>
<form action="manager4.php">
To search for product reports click below<br>
<input type="submit" value="Click here for product category search">
</form>
<form action="manager1.php">
To search for employee reports click below<br>
<input type="submit" value="Click here for employee search">
</form>
<form action="manager2.php">
To search for Special Sale reports click below<br>
<input type="submit" value="Click here for Special Sales">
</form>
<form action="manager5.php">
To search for Order reports click below<br>
<input type="submit" value="Click here for Orders">
</form>

</body>
</html>
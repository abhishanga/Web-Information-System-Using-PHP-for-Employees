<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
require 'postlogin.html';
	exit();
}
if (!isset($_SESSION['time']))
require 'logout.php';
else {
$t=time();
if(($t-$_SESSION['time']>300))
require 'logout.php';}
      
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

body{background-image:url('bg1.jpg');}
</style>
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['sess_username']; ?></h1>
<p><em>To search for Product Table Reports</em></p> 

<form name="search" action = "display1.php" method = "POST" onsubmit="return validateform()" >
  Product name:<br>                               <input type="text" name="name"><br>
  Product Category Name:<br>                   <input type="name" name="prodcname"><br>
  Search for any product that has description:<br><input type="text" name="describe"><br>
  Start Range : <br>             <input type="number" name="start1" ><br>
  End Range (between 1 and 100):<br>               <input type="number" name="end1" min="1" max="100"><br>
 <input type="submit">
</form>
 <center><input type="button" name="return" value="Return to HomePage" onClick='location.href="manager.php"' /></center>
</body>
</html>
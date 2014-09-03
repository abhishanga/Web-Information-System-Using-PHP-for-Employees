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
    var x1 = document.forms["search1"]["empid"].value;
	var x2 = document.forms["search1"]["fname"].value;
	var x3 = document.forms["search1"]["lname"].value;
	var x4 = document.forms["search1"]["age"].value;
	var x5 = document.forms["search1"]["type"].value;
	

    if ((x1 == null || x1 == "") && (x2 == null || x2 == "") && (x3 == null || x3 == "") && (x4 == null || x4 == "") && (x5 == null || x5 == "") ) 
	{
        alert("Atleast one field should be filled out");
       return false; 
    }
	
	
	
}

</script>
<style>
body{background-image:url('bg4.jpg');}</style>
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['sess_username']; ?></h1>
<p><em>To search for Employee Table Reports</em></p> 

<form name="search1" action = "display2.php" method = "POST" onsubmit="return validateform()"  >

Search by employee id:<br>
<input type="text" name="empid"><br>
First Name:<br>
<input type="text" name="fname"><br>
Last Name:<br>
<input type="text" name="lname"><br>
Age:<br>
<input type="number" name="age" id="age"><br>
Employee Type:<br>
<input type="radio" name="type" value="Sales Manager">Sales Manager<br>
<input type="radio" name="type" value="manager">manager<br>
<input type="radio" name="type" value="admin">admin<br>
<input type="submit">
</form>
  <center><input type="button" name="return" value="Return to HomePage" onClick='location.href="manager.php"' /></center>
</body>
</html>

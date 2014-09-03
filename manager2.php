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
    var x1 = document.forms["search2"]["startdate"].value;
	var x2 = document.forms["search2"]["enddate"].value;
	  var x4 = document.forms["search2"]["startdate1"].value;
	var x5 = document.forms["search2"]["enddate1"].value;
	var x3 = document.forms["search2"]["discount"].value;

	var flag1=0;var flag2=0;
    if ((x1 == null || x1 == "") && (x2 == null || x2 == "") && (x3 == null || x3 == "")&& (x4 == null || x4 == "")&& (x5 == null || x5 == "")  ) 
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
<p><em>To search for Special Sales Table Reports</em></p> 

<form name="search2" action = "display3.php" method = "POST" onsubmit="return validateform()"  >

Search by start date:<br>
<input type="date" name="startdate" >
<input type="date" name="enddate" ><br>
End Date:<br>
<input type="date" name="startdate1" >
<input type="date" name="enddate1" ><br>
Discount:<br>
<input type="text" name="discount" id="age"><br>


<input type="submit">
</form>
 <center><input type="button" name="return" value="Return to HomePage" onClick='location.href="manager.php"' /></center>
</body>
</html>

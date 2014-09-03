<?php
session_start();
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
    require 'postlogin.html';
	exit();
}if (!isset($_SESSION['time']))
require 'logout.php';
else {
$t=time();
if(($t-$_SESSION['time']>300))
require 'logout.php';}
$eid=$_POST['employeeid'];
echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
background-image:url("bg4.jpg");}

h1 {
    color: green;
    text-align: center;
     }

p {
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    font-size: 14px;
} </style><script>
function age()
{
var age=document.getElementById("s3").value;
age = parseInt(age,10);

if (isNaN(age) || age<1 || age>100)
{
alert("The age must be a number between 1 and 100");
return false;
} else
return true;
}
function age1()
{
var age=document.getElementById("s4").value;
age = parseInt(age,10);

if (isNaN(age) || age<1 || age>5000)
{
alert("The employee pay must be a number between 1 and 5000");
return false;
} else
return true;
}
function checkname() {   
var valid = true;

        var validationMessage = "Please correct the following errors:\r\n";
if (document.getElementById("s1").value.length == 0)

        {

            validationMessage = validationMessage + " - First Name is missing\r\n";

            valid = false;

        } if (document.getElementById("s2").value.length == 0)

        {

            validationMessage = validationMessage + "  - Last Name is missing\r\n";

            valid = false;

        }
if (document.getElementById("s3").value.length == 0)

        {

            validationMessage = validationMessage + "  - Age is missing\r\n";

            valid = false;

        }	
if (document.getElementById("s4").value.length == 0)

        {

            validationMessage = validationMessage + "  - Employee Pay is missing\r\n";

            valid = false;

        }	
			
		if (valid == false)

        {

            alert(validationMessage);

        }

        

        return valid;
		}function validate()
{
var chks = document.getElementsByName("uname");
var hasChecked = false;
for (var i = 0; i < chks.length; i++)
{
if (chks[i].checked)
{
hasChecked = true;
break;
}
}
if (hasChecked == false)
{
alert("Please select at least one username.");
return false;
}
return true;
}
		function validateform()
{  var f3=true; var f1=true; var f2=true; var f4=true;
     f3=checkname();
	 f1=age();
	 f2=age1(); f4=validate();
	
	if(f3==true && f1==true && f2==true && f4==true)
	return true;
	else
   return false;  }</script></head>';
if(!$eid)
echo '<h1>Add';
else
echo '<h1>Change';
echo ' a User Details</h1>';
if($eid){
$sql="SELECT * from employee WHERE employeeid=$eid";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
 echo '<body><form action="changeuser1.php" method="POST">
  
 First Name<input type="text" name="fname" value=" '. $row['firstname'] .' "/><br>
 Last Name<input type="text" name="lname" value=" '. $row['lastname'] .' "/><br>
 Age<input type="text" name="age" value=" '. $row['age'] .' "/><br>Employee Pay<input type="text" name="employeepay" value=" '. $row['employeepay'] .' "/><br><input type="submit"></form>';
 mysql_close($con); }
 else { 
 $sql="SELECT * from users";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
 
  echo ' <body><form action="adduser1.php" method="POST" onsubmit="return validateform();">';
 do{
echo '<input name="uname" id="uname" id="uname" type="radio" value=" ' . $row['userid'] .'"/> ' . $row['username'] . '<br>';}while($row=mysql_fetch_array($res));
 echo 'First Name<input type="text" name="fname" id="s1" /><br>
 Last Name<input type="text" name="lname" id="s2"/><br>
 Age<input type="text" name="age" id="s3"/><br>Employee Pay<input type="text" name="employeepay" id="s4" /><br><input type="submit"></form></body>';
  mysql_close($con); }
  echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="admin.php" /></center>';
 ?>
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
$uid=$_POST['userid'];
echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
     background-image:url("bg4.jpg"); }

h1 {
    color: green;
    text-align: center;
     }

p {
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    font-size: 14px;
} </style><script>function checkname() {   
var valid = true;

        var validationMessage = "Please correct the following errors:\r\n";
if (document.getElementById("s1").value.length == 0)

        {

            validationMessage = validationMessage + " - Username is missing\r\n";

            valid = false;

        } 
		if (document.getElementById("s2").value.length == 0)

        {

            validationMessage = validationMessage + " - Password is missing\r\n";

            valid = false;

        } 
	if ( ( f6.usertype[0].checked == false ) && ( f6.usertype[1].checked == false ) && ( f6.usertype[2].checked == false ) )

        {

            validationMessage = validationMessage + " - User Type is missing\r\n";

            valid = false;

        } 

        
		if (valid == false)

        {

            alert(validationMessage);

        }

        

        return valid;
		} function validateform()
{  var f3=true;
     f3=checkname();
	
	
	if(f3==true)
	return true;
	else
   return false;  }</script></head>';
if(!$uid)
echo '<h1>Add';
else
echo '<h1>Change';
echo ' a User</h1>';
if($uid){
$sql="SELECT * from users WHERE userid=$uid";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
 echo '<body><form action="changeuser.php" method="POST">
  User ID<input type="text" name="userid" value=" '. $row['userid'] .' "/><br>
 Username<input type="text" name="uname" value=" '. $row['username'] .' "/><br>
 Password<input type="text" name="password" value=" '. $row['password'] .' "/>
  User Type<input type="text" name="usertype" value=" '. $row['usertype'] .' "/><br><input type="submit"></form>';
 mysql_close($con); }
 else { 
  echo ' <body><form action="adduser.php" method="POST" onsubmit="return validateform();" name="f6">
 
  Username<input type"=text" name="uname" id="s1"  /><br>
  Password<input type="text" name="password" id="s2"/><br>
  User Type<br><input type="radio" name="usertype" value="Sales Manager" id="s3">Sales Manager<br>
<input type="radio" name="usertype" value="manager" id="s3">manager<br>
<input type="radio" name="usertype" value="admin" id="s3">admin<br><br><input type="submit"></form>'; }
 echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="admin.php" /></center>';
 ?>
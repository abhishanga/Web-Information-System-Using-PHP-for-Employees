<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not
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
require 'logout.php';}echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url("bg4.jpg");
      } </style></head><body>';
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW");
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$age=$_POST['age'];
$eid=$_POST['employeeid'];
$epay=$_POST['employeepay'];
$sql="UPDATE employee SET firstname='$fname',lastname='$lname',age=$age,employeepay=$epay WHERE employeeid=$eid";

$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
echo "Entered data successfully\n";
echo '<center><input type="button" name="return" value="Return to HomePage" onClick=location.href="admin.php" /></center></body>';
mysql_close($con); 
?>
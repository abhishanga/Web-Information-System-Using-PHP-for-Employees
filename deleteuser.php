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
require 'logout.php';}
echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url("bg4.jpg");
      } </style></head><body>';
$uid=$_POST['userid'];
 $n = count($uid);
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW");
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
 for($i=0; $i < $n; $i++)
    {
     
    echo $sql="DELETE FROM users WHERE userid=$uid[$i]";

$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
} 
else
echo "Deleted data successfully\n";
}
echo '<center><input type="button" name="return" value="Return to HomePage" onClick=location.href="admin.php" /></center></body>';
mysql_close($con); 
?>


   
   
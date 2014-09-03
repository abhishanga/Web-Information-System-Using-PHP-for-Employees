<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
require 'postlogin.html';
	exit();
}
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW");
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$ppname=$_POST['pname'];
$pprice=$_POST['pprice'];
$pid=$_POST['pid'];
echo $sql="UPDATE product SET productname='$ppname',productprice=$pprice WHERE productid=$pid";

$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
echo "Entered data successfully\n";
mysql_close($con); 
?>
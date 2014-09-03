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
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW");
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);

$uploadDir = ''; //Image Upload Folder
$uploadDir1 = '/hw2/'; //Image Upload Folder
if(isset($_POST['Submit']))
{
$fileName = $_FILES['Photo']['name'];
$tmpName  = $_FILES['Photo']['tmp_name'];
$fileSize = $_FILES['Photo']['size'];
$fileType = $_FILES['Photo']['type'];
$filePath = $uploadDir . $fileName;

$result = move_uploaded_file($tmpName, $filePath);
if (!$result) {
echo "Error uploading file";

}
$filePath1=$uploadDir1 . $fileName;
$ppname=$_POST['pname'];
$pcname=$_POST['pcname'];	
$pprice=$_POST['pprice'];
$pid=$_POST['pid'];

echo $sql="INSERT INTO product (productname,productprice,productcategoryid,productimage)  VALUES('$ppname',$pprice,$pcname,'$filePath1')";


$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
echo "Entered data successfully\n";}
 echo '<center><input type="button" name="return" value="Return to HomePage" onClick=location.href="employee.php" /></center></body>';
mysql_close($con); 
?>
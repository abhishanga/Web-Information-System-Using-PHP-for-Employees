<?php
session_start();
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
    require 'postlogin.html';
	exit();
}
$pid=$_POST['productid'];
echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
      }

h1 {
    color: green;
    text-align: center;
     }

p {
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    font-size: 14px;
} </style></head>';
if(!$pid)
echo '<h1>Add';
else
echo '<h1>Change';
echo ' a Product</h1>';
if($pid){
$sql="SELECT * from product WHERE productid=$pid";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
 echo '<body><form action="changeproduct.php" method="POST">
  Product ID<input type="text" name="pid" value=" '. $row['productid'] .' "/><br>
 Product Name<input type="text" name="pname" value=" '. $row['productname'] .' "/><br>
 Product Price<input type="text" name="pprice" value=" '. $row['productprice'] .' "/><br><input type="submit"></form>';
 mysql_close($con); }
 else { 
  echo ' <body><form action="addproduct.php" method="POST">
 
  Product Name<input type"=text" name="pname"  /><br>
  Product Price<input type="text" name="pprice" /><br><input type="submit"></form>'; }
 ?>
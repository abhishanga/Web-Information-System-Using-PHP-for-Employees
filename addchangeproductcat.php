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
$pid=$_POST['productcategoryid'];
echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url("bg3.jpg");
      }

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

            validationMessage = validationMessage + " - Product Name is missing\r\n";

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
if(!$pid)
echo '<h1>Add';
else
echo '<h1>Change';
echo ' a Product Category</h1>';
if($pid){
$sql="SELECT * from productcategory WHERE productcategoryid=$pid";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
 echo '<body><form action="changeproductcat.php" method="POST">
  Product Category ID<input type="text" name="pid" value=" '. $row['productcategoryid'] .' "/><br>
 Product Category Name<input type="text" name="pname" value=" '. $row['productcategoryname'] .' "/><br>
<input type="submit"></form>';
 mysql_close($con); }
 else { 
  echo ' <body><form action="addproductcat.php" method="POST" onsubmit="return validateform();">
 
  Product Category Name<input type"=text" id="s1" name="pname"  /><br>
  <input type="submit"></form>'; }
    echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="employee.php" /></center>';
 ?>
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
$pid=$_POST['productid'];
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
} </style><script>
function age()
{
var age=document.getElementById("s2").value;
age = parseInt(age,10);

if (isNaN(age) || age<1 || age>100)
{
alert("The product price must be a number between 1 and 100");
return false;
} else
return true;
}
function checkname() {   
var valid = true;

        var validationMessage = "Please correct the following errors:\r\n";
if (document.getElementById("s1").value.length == 0)

        {

            validationMessage = validationMessage + " - Product Name is missing\r\n";

            valid = false;

        } if (document.getElementById("s2").value.length == 0)

        {

            validationMessage = validationMessage + "  - Product Price is missing\r\n";

            valid = false;

        } 
		
		if (valid == false)

        {

            alert(validationMessage);

        }

        

        return valid;
		}function validate()
{
var chks = document.getElementsByName("pcname");
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
alert("Please select at least one product category.");
return false;
}
return true;
}
		
		function validateform()
{  var f3=true; var f4=true; var f5=true;
     f3=checkname();
	f4=age(); f5=validate();
	
	if(f3==true && f4==true && f5==true)
	return true;
	else
   return false;  }</script></head>';
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
 
 Product Name<input type="text" name="pname" value=" '. $row['productname'] .' "/><br>
 Product Price<input type="text" name="pprice" value=" '. $row['productprice'] .' "/><br><input type="submit"></form></body>';
 mysql_close($con); }
 else { 
 $sql="SELECT * from productcategory";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
  echo ' <body><form action="addproduct.php" method="POST" onsubmit="return validateform();" enctype="multipart/form-data" name="Image" >';
    do{
echo '<input name="pcname" id="pcname" type="radio" id="pcname" value=" ' . $row['productcategoryid'] .'"/> ' . $row['productcategoryname'] . '<br>';}while($row=mysql_fetch_array($res));
  echo 'Product Name<input type"=text" id="s1" name="pname"  /><br>
  Product Price<input type="text" id="s2" name="pprice" /><br>
Product Image:<input type="file" name="Photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/>

<INPUT type="submit" class="button" name="Submit" value="  Submit  "> </form></body>';  mysql_close($con);}
   echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="employee.php" /></center>';
 ?>
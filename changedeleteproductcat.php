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


$sql="SELECT * from productcategory";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url("bg4.jpg");
      } </style></head><body>
<center><table width="600" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>
<table width="500" border="0" cellpadding="3" cellspacing="1" bgcolor="#ddd">
<tr>
<td>&nbsp;</td>
<td colspan="4"><strong>';echo '<p>';
if(isset($_POST['changeproductcat']))
echo'Change';
else
echo 'Delete';
echo ' a Product Category </p>';echo '</strong> </td>
</tr>
<tr><td></td></tr>
<tr>
<td></td>
<td style=" width:10%"><strong>Product Category Id</strong></td>
<td style=" width:30%"><strong>Product Category Name</strong></td>


</tr>';


if(isset($_POST['changeproductcat'])) {
echo '<form action="addchangeproductcat.php" method = "POST" onSubmit="return validate();">';
do{


echo '<tr>
<td><input name="productcategoryid" id="productcategoryid" type="radio"  
value=" ' . $row['productcategoryid'] .'"></td>
<td> '.$row['productcategoryid'] .'</td>
<td> '.$row['productcategoryname'] .'</td>

</tr> ';
}while($row=mysql_fetch_array($res));
}

else{ 
echo '<form action="deleteproductcat.php" method = "POST" onSubmit="return validate1();">';
do{

echo '<tr>
<td><input name="productcategoryid[]" id="productcategoryid[]" type="checkbox"  
value=" ' . $row['productcategoryid'] .'"></td>
<td> '.$row['productcategoryid'] .'</td>
<td> '.$row['productcategoryname'] .'</td>

</tr> ';



}while($row=mysql_fetch_array($res));

}


echo '<tr><td><input type="submit" value="';
if(isset($_POST['changeproductcat']))
echo'Change';
else
echo 'Delete';
echo ' a Product Category "/></td></tr></table> </form></center></body>';

echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="employee.php" /></center>';

?>
<script language="javascript">
function validate()
{
var chks = document.getElementsByName('productcategoryid');
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
alert("Please select at least one.");
return false;
}
return true;
}
function validate1()
{
var chks = document.getElementsByName('productcategoryid[]');
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
alert("Please select at least one.");
return false;
}
return true;
}
</script>
 
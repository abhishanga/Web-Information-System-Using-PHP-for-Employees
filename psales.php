<?php
session_start();
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
    require 'postlogin.html';
	exit();
	
}
if (!isset($_SESSION['time']))
require 'logout.php';
else {
$t=time();
if(($t-$_SESSION['time']>300))
require 'logout.php';}
$pname=$_POST['pname'];
$item=$_POST['sales2'];
$flag=0;
if($item=='revenue')
{ $sql="Select od.productid ,prd.productname,prd.productprice, SUM(od.productquantity*prd.productprice) AS q
from `orderdetail` od , `product` prd
where prd.productid = od.productid AND prd.productname LIKE '%$pname%'
Group By od.productid"; $flag=1;}
else
$sql="Select od.productid ,prd.productname,prd.productprice, SUM(productquantity) AS q
from `orderdetail` od , `product` prd
where prd.productid = od.productid AND prd.productname LIKE '%$pname%'
Group By od.productid";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}

mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
if(!($row=mysql_fetch_array($res)))
{ $errmsg='No such orders found'; }  
else
{
echo '<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url("bg4.jpg");
      }
</style></head><center><table border="1" bgcolor="#ddd" style="border-collapse:collapse;border: 1px solid black;">
<tr>


<th>Product Name</th>';
if($flag=1)
echo '<th>Product Sales</th>';
else
echo '<th>Product Quantity</th>';
echo '<th>Product Price</th>
</tr>';

 do{
  echo "<tr>";


 echo "<td>" . $row['productname'] . "</td>";
  echo "<td>" . $row['q'] . "</td>";
echo "<td>" . $row['productprice'] . "</td>";
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

 }mysql_close($con); 
echo' <center><input type="button" name="return" value="Return to Search" onClick=location.href="manager5.php" /></center>';
?>

 
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
if(($t-$_SESSION['time']>3000))
require 'logout.php';}
$date=$_POST['date'];
$productcategoryname=$_POST['pc']; 
$productname=$_POST['p'];
$specialsales=$_POST['s'];
$edate=$_POST['date1'];
if ((strlen($date)==0) && (strlen($productcategoryname)==0) && (strlen($productname)==0) && (strlen($specialsales)==0) && strlen($edate)==0) 
$sql="SELECT * from `orderdetail`";//nothing entered
else {
if(strlen($productname)==0 && strlen($productcategoryname)>0 && strlen($date)==0 && strlen($specialsales)==0 && strlen($edate)==0)//find orders by product category
$sql="Select * 
	from orderdetail as od
where od.productid IN (select p.productid
from product as p , productcategory as pc
where p.productcategoryid = pc.productcategoryid AND pc.productcategoryname LIKE '%$productcategoryname%')";
if(strlen($productname)>0 && strlen($productcategoryname)==0 && strlen($date)>0 && strlen($specialsales)==0 && strlen($edate)>0)//specified time range and product
$sql="Select * 
from `order` as o , `orderdetail` as od 
where o.date BETWEEN STR_TO_DATE('$date','%m/%d/%Y') AND STR_TO_DATE('$edate','%m/%d/%Y') AND o.orderid = od.orderid AND od.productid IN (select p.productid
from product as p where p.productname LIKE '%$productname%')";
if(strlen($productname)==0 && strlen($productcategoryname)==0 && strlen($date)==0 && strlen($specialsales)>0 && strlen($edate)==0)//search by special sales
$sql="Select * from orderdetail as od
where od.productid IN
(Select ss.productid
from `specialsales` as ss
where ss.productid
IN(select p.productid 
from `product` as p
where p.productname LIKE '%$specialsales%'))";
if(strlen($productname)==0 && strlen($productcategoryname)==0 && strlen($date)>0 && strlen($specialsales)==0 && strlen($edate)>0)//orders in time range
$sql="select  *
from `order` as o , `orderdetail` as od 
where o.date BETWEEN STR_TO_DATE('$date','%m/%d/%Y') AND STR_TO_DATE('$edate','%m/%d/%Y')  AND o.orderid = od.orderid";
if(strlen($productname)>0 && strlen($productcategoryname)==0 && strlen($date)==0 && strlen($specialsales)==0)//by product
$sql="Select * from
`orderdetail` as od 
where od.productid IN (select p.productid
from product as p where p.productname LIKE '%$productname%')";
if(strlen($productname)==0 && strlen($productcategoryname)>0 && strlen($date)>0 && strlen($specialsales)==0 && strlen($edate)>0)//product category in time range
$sql="Select * 
from `order` as o , `orderdetail` as od 
where o.date BETWEEN STR_TO_DATE('$date','%m/%d/%Y') AND STR_TO_DATE('$edate','%m/%d/%Y') AND o.orderid = od.orderid AND od.productid IN (select p.productid
from product as p , productcategory as pc
where p.productcategoryid = pc.productcategoryid AND pc.productcategoryname LIKE '%$productcategoryname%')";
if(strlen($productname)==0 && strlen($productcategoryname)==0 && strlen($date)>0 && strlen($specialsales)>0 && strlen($edate)>0)//special sales in time range
$sql="Select * 
from `order` as o , `orderdetail` as od 
where o.date BETWEEN STR_TO_DATE('$date','%m/%d/%Y') AND STR_TO_DATE('$edate','%m/%d/%Y') AND o.orderid = od.orderid AND od.productid IN (Select ss.productid
from `specialsales` as ss
where ss.productid
IN(select p.productid 
from `product` as p
where p.productname LIKE '%$specialsales%'))";
if(strlen($productname)>0 && strlen($productcategoryname)>0 && strlen($date)==0 && strlen($specialsales)==0 && strlen($edate)==0)//product and productcategory name
$sql="Select * from orderdetail as od
where od.productid IN (select p.productid
from product as p , productcategory as pc
where p.productcategoryid = pc.productcategoryid AND pc.productcategoryname LIKE '%$productcategoryname%' and p.productname LIKE '%$productname%' )"; }
/*echo $sql;*/
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
<th>Order ID</th>
<th>Product Name</th>
<th>Product Price</th>
<th>Product Quantity</th>
<th>Order Details</th>
</tr>';

 do{
  echo "<tr>";
  echo "<td>" . $row['orderid'] . "</td>";
  $a=$row['productid'];
	  $sql="SELECT * from product where productid=$a";
	  $result=mysql_query($sql);
	  if($obj=mysql_fetch_array($result))
{ echo "<td>" . $obj['productname'] . "</td>";}
 echo "<td>" . $row['productprice'] . "</td>";
  echo "<td>" . $row['productquantity'] . "</td>";
  echo '<td><a href="getorder.php?orderid='. $row['orderid'] .'">Click to know more about the order</a></td>';
 
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

 }mysql_close($con); 
 echo' <center><input type="button" name="return" value="Click to know frequently purchased products" onClick=location.href="freqprods.php" /></center>';
echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="manager.php" /></center>';
?>


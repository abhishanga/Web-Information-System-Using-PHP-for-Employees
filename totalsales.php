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
$item=$_POST['sales'];
$flag=0;
if($item=='revenue')
{ $sql="select sum(prd.productprice*od.productquantity) as q,prd. productid , prd.productcategoryid , od.productquantity , prd.productprice ,pc.productcategoryname
from `product` prd , `productcategory` pc , `orderdetail` od
where prd.productcategoryid = pc.productcategoryid AND od.productid = prd.productid
GROUP By prd.productcategoryid"; $flag=1;}
else
$sql="select sum(productquantity) as q,prd. productid , prd.productcategoryid , od.productquantity , prd.productprice,pc.productcategoryname
from `product` prd , `productcategory` pc , `orderdetail` od
where prd.productcategoryid = pc.productcategoryid AND od.productid = prd.productid
group By prd.productcategoryid";
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


<th>Product Category Name</th>';
if($flag=1)
echo '<th>Product Category Sales</th>';
else
echo '<th>Product Category Quantity</th>
</tr>';

 do{
  echo "<tr>";


 echo "<td>" . $row['productcategoryname'] . "</td>";
  echo "<td>" . $row['q'] . "</td>";
 
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

 }mysql_close($con); 
echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="manager.php" /></center>';
?>

 
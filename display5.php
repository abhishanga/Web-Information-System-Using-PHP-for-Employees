<?php
ob_start();
session_save_path('/tmp');
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
$date=$_POST['date'];
$productcategoryname=$_POST['pc']; 
$productname=$_POST['p'];
$sql="SELECT * from `orderdetail`";
$where='';

/*if(strlen($date)>0){
if(strlen($where)>0)
{ $where.=' and ';}
$where.="as od,`order` as o WHERE o.orderid=od.orderid and date=$date";}*/
if ((strlen($date)>0) || (strlen($productcategoryname)>0) || (strlen($productname)>0)) 
$sql.=' WHERE ';
if(strlen($productname)>0 && strlen($productcategoryname)==0){
if(strlen($where)>0)
{ $where.=' and ';}
$where.="productid IN (SELECT productid from product where productname LIKE '%$productname%')";}
if((strlen($productcategoryname)>0) && strlen($productname)==0){
if(strlen($where)>0)
{ $where.=' and ';}
$where.="productid IN (SELECT productid from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid AND productcategoryname LIKE '%$productcategoryname%')";}
if((strlen($productcategoryname)>0) && strlen($productname)>0){
if(strlen($where)>0)
{ $where.=' and ';}
$where.="productid IN (SELECT productid from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid AND productcategoryname LIKE '%$productcategoryname%' AND productname LIKE '%$productname%')";}
echo $sql.=$where;
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
if(!($row=mysql_fetch_array($res)))
{ $errmsg='No such employees found'; }  
else
{
echo "<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url('bg4.jpg');
      }
</style></head><center><table border='1'>
<tr>
<th>Order ID</th>
<th>Product ID</th>
<th>Product Price</th>
<th>Product Quantity</th>
</tr>";

 do{
  echo "<tr>";
  echo "<td>" . $row['orderid'] . "</td>";
 echo "<td>" . $row['productid'] . "</td>";
 echo "<td>" . $row['productprice'] . "</td>";
  echo "<td>" . $row['productquantity'] . "</td>";
 
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

 }mysql_close($con); 
echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="manager.php" /></center>';
?>

 
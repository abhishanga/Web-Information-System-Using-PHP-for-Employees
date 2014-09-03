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
$sql="SELECT SUM(productquantity) AS totalqty,od.productid,od.productquantity,p.productname,p.productimage from `orderdetail` od,`product` p WHERE od.productid=p.productid GROUP BY productid ORDER BY totalqty DESC";
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
<th>Product Image</th>
<th>Total Quantity</th>

<th>Product Name</th>
<th>Product Quantity</th>
</tr>';

 do{
  echo "<tr>";
  echo '<td><img src="'.$row['productimage'] . '"width="80" height="80" />  </td>'; 
  echo "<td>" . $row['totalqty'] . "</td>";

 echo "<td>" . $row['productname'] . "</td>";
  echo "<td>" . $row['productquantity'] . "</td>";
 
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

 }mysql_close($con); 
echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="manager.php" /></center>';
?>

 
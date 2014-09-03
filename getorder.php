<?php 
 session_start();
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'accountpre.html';
    require 'accountpost.html';
	exit();
	
}
if (!isset($_SESSION['time']))
require 'logout.php';
else {
$t=time();
if(($t-$_SESSION['time']>300))
require 'logout.php';}

$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
//we take security measure on SQL injection "mysql_real_escape_string()"
$orderid=intval($_GET['orderid']);

$sql ="SELECT * FROM `order` WHERE orderid=$orderid";

$query = mysql_query($sql);
  if(!$query){
   die('Unable to query data :' . mysql_error());
  
}else{
$returnString .='<center><table border="1" bgcolor="#ddd" style="border-collapse:collapse;border: 1px solid black;">
<tr>
<th>Total Cost</th>
<th>Billing Address</th>
<th>Shipping Address</th>
<th>Date</th>


</tr>';


      while($row = mysql_fetch_array($query)){
    
      $returnString .= '<tr><td>' .$row['totalcost'].'</td>';
	  $returnString .= '<td>' .$row['billingaddress'].'</td>';
	  $returnString .= '<td>' .$row['shippingaddress'].'</td>';
	  $returnString .= '<td>' .$row['date'].'</td></tr>';
	  
	  
	  }
  
      }

 

 // this will be our return value to our ajax request
?>
<!DOCTYPE html>
<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url('bg4.jpg');
      }
</style></head><body>
<?php echo $returnString; ?><?php mysql_close($con); ?>
 <center><input type="button" align="bottom" name="return" value="Return to Orders" onClick='location.href="display6.php"' /></center></body>

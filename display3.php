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
$startdate=$_POST['startdate'];
($startdate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$startdate));
$enddate=$_POST['enddate'];
($enddate = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$enddate));
$startdate1=$_POST['startdate1'];
($startdate1 = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$startdate1));
$enddate1=$_POST['enddate1'];
($enddate1 = preg_replace('!^([0-9]{2})/([0-9]{2})/([0-9]{4})$!',"$3-$2-$1",$enddate1));
$discount=$_POST['discount'];
$errmsg="";
$flag=0;


if(strlen($startdate)>0  && strlen($enddate)>0 && strlen($discount)==0 && strlen($startdate1)==0  && strlen($enddate1)==0     )
{ $sql="SELECT * from specialsales as s,product as p WHERE s.productid=p.productid AND startdate BETWEEN '$startdate' AND '$enddate'"; $flag=1;}
if(strlen($startdate)>0  && strlen($enddate)>0 && strlen($discount)>0 && strlen($startdate1)==0  && strlen($enddate1)==0     )
{ $sql="SELECT * from specialsales as s,product as p WHERE s.productid=p.productid AND startdate BETWEEN '$startdate' AND '$enddate' AND discount=$discount"; $flag=1;}
if(strlen($startdate)>0  && strlen($enddate)>0 && strlen($discount)==0 && strlen($startdate1)>0  && strlen($enddate1)>0     )
{ $sql="SELECT * FROM specialsales as s,product as p WHERE s.productid=p.productid AND startdate >= '$enddate' AND enddate <= '$startdate1'"; $flag=1;}
if(strlen($startdate)>0  && strlen($enddate)>0 && strlen($discount)>0 && strlen($startdate1)>0  && strlen($enddate1)>0     )
{ $sql="SELECT * FROM specialsales as s,product as p WHERE s.productid=p.productid AND startdate >= '$enddate1' AND enddate <= '$startdate' AND discount=$discount"; $flag=1;}
if(strlen($startdate)==0  && strlen($enddate)==0 && strlen($discount)==0 && strlen($startdate1)>0  && strlen($enddate1)>0     )
{ $sql="SELECT * from specialsales as s,product as p WHERE s.productid=p.productid AND enddate BETWEEN '$startdate1' AND '$enddate1'"; $flag=1;}
 if(strlen($startdate)==0  && strlen($enddate)==0 && strlen($discount)>0 && strlen($startdate1)>0  && strlen($enddate1)>0     )
{ $sql="SELECT * from specialsales as s,product as p WHERE s.productid=p.productid AND enddate BETWEEN '$startdate1' AND '$enddate1'AND discount=$discount"; $flag=1;}
if(strlen($startdate)==0  && strlen($enddate)==0 && strlen($discount)>0 && strlen($startdate1)==0  && strlen($enddate1)==0     )
{ $sql="SELECT * from specialsales as s,product as p WHERE s.productid=p.productid AND discount=$discount"; $flag=1;}

if($flag==1)
{$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
if(!($row=mysql_fetch_array($res)))
{ $errmsg='No such products found'; }  
else
{
echo "<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url('bg4.jpg');
      }
</style></head>
<center><table border='1'>
<tr>
<th>Product Name</th>
<th>Product Image</th>
<th>Product Price</th>
<th>Start Date</th>
<th>End Date</th>
<th>Discount</th>

</tr>";

 do{
  echo "<tr>";
  echo "<td>" . $row['productname'] . "</td>";
  echo "<td>" . '<img src="'.$row['productimage'] . '" />' . "</td>"; 
  echo "<td>" . $row['productprice'] . "</td>";
  echo "<td>" . $row['startdate'] . "</td>";
 
  echo "<td>" . $row['enddate'] . "</td>";
  echo "<td>" . $row['discount'] . "</td>"; 
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

mysql_close($con); }} 
 echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="manager.php" /></center>';
?>
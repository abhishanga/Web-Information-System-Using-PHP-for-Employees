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
 

$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);         // All database details will be included here 

?>
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Manager Reports</title>
</head>

<body>
<?php



$page_name="freqprods1.php"; //  If you use this code with a different page ( or file ) name then change this 
$start=$_GET['start'];
if(strlen($start) > 0 and !is_numeric($start)){
echo "Data Error";
exit;
}


$eu = ($start - 0); 
$limit = 10;                                 // No of records to be shown per page.
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 


/////////////// WE have to find out the number of records in our table. We will use this to break the pages///////
$query2="SELECT SUM(productquantity) AS totalqty,od.productid,od.productquantity,p.productname,p.productimage from `orderdetail` od,`product` p WHERE od.productid=p.productid GROUP BY productid ORDER BY totalqty DESC";
$result2=mysql_query($query2);
echo mysql_error();
$nume=mysql_num_rows($result2);



/////// The variable nume above will store the total number of records in the table////

/////////// Now let us print the table headers ////////////////
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


<th>Product Name</th>
<th>Total Quantity</th>

</tr>';

////////////// Now let us start executing the query with variables $eu and $limit  set at the top of the page///////////
$query="SELECT SUM(productquantity) AS totalqty,od.productid,od.productquantity,p.productname,p.productimage from `orderdetail` od,`product` p WHERE od.productid=p.productid GROUP BY productid ORDER BY totalqty DESC limit $eu, $limit ";
$result=mysql_query($query);
echo mysql_error();

//////////////// Now we will display the returned records in side the rows of the table/////////
while($row = mysql_fetch_array($result))
{

echo "<tr>";
  echo '<td><img src="'.$row['productimage'] . '"width="80" height="80" />  </td>'; 
  
 
 echo "<td>" . $row['productname'] . "</td>";
 echo "<td>" . $row['totalqty'] . "</td>";
 
 
  echo "</tr>";
}
echo "</table>";
echo "<table align = 'center' width='50%'><tr><td align='left' width='30%'>";
if($back >=0) {
print "<a href='$page_name?start=$back'><font face='Verdana' size='2'>PREV</font></a>";
}
echo "</td><td align=center width='30%'>";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
if($i <> $eu){
echo " <a href='$page_name?start=$i'><font face='Verdana' size='2'>$l</font></a> ";
}
else { echo "<font face='Verdana' size='4' color=red>$l</font>";} /// Current page is not displayed as link and given font color red
$l=$l+1;
echo "</td><td align='right' width='30%'>";
if($this < $nume) {
print "<a href='$page_name?start=$next'><font face='Verdana' size='2'>NEXT</font></a>";}
echo "</td></tr></table>";} ?>
</body>

</html>
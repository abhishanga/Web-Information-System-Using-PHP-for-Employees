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
$start=$_POST['start1'];
$end=$_POST['end1'];
$prodname=$_POST['name'];
$prodcname=$_POST['prodcname'];

$desc=$_POST['describe'];
$errmsg="";
$flag=0;
//1st search criteria
if((strlen($start)>0 && strlen($end)>0) && strlen($prodname)==0  && strlen($prodcname)==0 && strlen($desc)==0)
{ $sql="SELECT * from product WHERE productprice BETWEEN $start AND $end"; $flag=1;}
if((strlen($start)>0 && strlen($end)>0) && strlen($prodname)>0 && strlen($prodcname)==0 && strlen($desc)==0)
{ $sql="SELECT * from product WHERE productprice BETWEEN $start AND $end AND productname='$prodname'"; $flag=1;}
if((strlen($start)>0 && strlen($end)>0) && strlen($prodname)>0 && strlen($prodcname)>0 && strlen($desc)==0)
{ $sql="SELECT * from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid AND productprice BETWEEN $start AND $end AND productname='$prodname'  AND productcategoryname='$prodcname'"; $flag=1;}
if((strlen($start)==0 && strlen($end)==0) && strlen($prodname)==0 && strlen($prodcname)>0 && strlen($desc)==0)
{$sql="SELECT * from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid AND productcategoryname='$prodcname'"; $flag=1;}
//2nd search criteria
if((strlen($start)==0 && strlen($end)==0) && strlen($prodname)>0  && strlen($prodcname)==0 && strlen($desc)==0)
{ $sql="SELECT * from product WHERE productname='$prodname'"; $flag=1;}
if((strlen($start)==0 && strlen($end)==0) && strlen($prodname)>0  && strlen($prodcname)>0 && strlen($desc)==0)
{ $sql="SELECT * from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid AND productname='$prodname' AND productcategoryname='$prodcname'"; $flag=1;}
if((strlen($start)==0 && strlen($end)==0) && strlen($prodname)==0 && strlen($prodcname)>0 && strlen($desc)>0)
{ $sql="SELECT * from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid  AND productcategoryname='$prodcname' AND productname LIKE '%$desc%'"; $flag=1;}




if((strlen($start)>0 && strlen($end)>0) && strlen($prodname)==0  && strlen($prodcname)>0 && strlen($desc)>0)
{ $sql="SELECT * from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid  AND productcategoryname='$prodcname' AND productname LIKE '%$desc%' AND productprice BETWEEN $start AND $end"; $flag=1;}


if((strlen($start)==0 && strlen($end)==0) && strlen($prodname)==0  && strlen($prodcname)>0 && strlen($desc)==0)
{ $sql="SELECT * from product as p,productcategory as pc WHERE p.productcategoryid=pc.productcategoryid  AND productcategoryname='$prodcname' "; $flag=1;}
//4th select criteria
if((strlen($start)==0 && strlen($end)==0) && strlen($prodname)==0  && strlen($prodcname)==0 && strlen($desc)>0)
{ $sql="SELECT * from product WHERE productname LIKE '%$desc%' "; $flag=1;}



if($flag==0)
echo "Invalid Data" ;
if($flag==1)
{ $con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
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
<center><table width='600' border='5' cellspacing='1' cellpadding='5'>
<tr>


<th>Product Name</th>
<th>Product Image</th>
<th>Product Price</th>
<th>Product Category Name</th>

</tr>";

 do{
  echo "<tr>";
  
 
  echo "<td>" . $row['productname'] . "</td>";
  echo "<td>" . '<img src="'.$row['productimage'] . '" />' . "</td>"; 
  echo "<td>" . $row['productprice'] . "</td>";
   echo "<td>" . $row['productcategoryname'] . "</td>";
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

mysql_close($con); }} //End DB
echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="manager.php" /></center>';
?>
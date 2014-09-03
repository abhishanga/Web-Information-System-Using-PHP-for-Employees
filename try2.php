<?php
// database connection info
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
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);

// find out how many rows are in the table 

$sql = "SELECT COUNT(*) FROM orderdetail";
$result = mysql_query($sql, $con) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 10;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

// get the info from the db 
$date=$_POST['date'];
$productcategoryname=$_POST['pc']; 
$productname=$_POST['p'];
$specialsales=$_POST['s'];
$edate=$_POST['date1'];
/*if ((strlen($date)==0) && (strlen($productcategoryname)==0) && (strlen($productname)==0) && (strlen($specialsales)==0) && strlen($edate)==0) 
$sql="SELECT * from `orderdetail`";//nothing entered
else {*/
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
where p.productcategoryid = pc.productcategoryid AND pc.productcategoryname LIKE '%$productcategoryname%' and p.productname LIKE '%$productname%' )"; /*}*/
echo $sql;
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
</style></head><center><table border="1" bgcolor="#f1f1f1" style="border-collapse:collapse;border: 1px solid black;">
<tr>
<th>Order ID</th>
<th>Product Name</th>
<th>Product Price</th>
<th>Product Quantity</th>
</tr>';

 do{
  echo "<tr>";
  echo "<td>" . $row['orderid'] . "</td>";
  $a=$row['productid'];
	  $sql="SELECT * from product where productid=$a";
	  $result=mysql_query($sql);
	  if($obj=mysql_fetch_array($res))
{ echo "<td>" . $obj['productname'] . "</td>";}
 echo "<td>" . $row['productprice'] . "</td>";
  echo "<td>" . $row['productquantity'] . "</td>";
  echo '<td><a href="getorder.php?orderid='. $row['orderid'] .'">Click to know more about the order</a></td>';
 
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

 }

/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/
?>
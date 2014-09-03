<?php
session_start();
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
    require 'postlogin.html';
	exit();
}
$pid=$_POST['productid'];
$flag=0;
if(!$pid)
{ echo '<h1>Add';$flag=1;}
else
echo '<h1>Change';
echo ' a Product</h1>';
if($pid){
$sql="SELECT * from product WHERE productid='$pid'";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW");
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
print mysql_error();
 $ppname=$_POST['ppname'];
 $pprice=$_POST['pprice'];
$sql=" UPDATE product SET productname='$pname',productprice='$pprice' WHERE productid='$pid'";
$retval = mysql_query( $sql, $con);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}mysql_close($con);}
else
{ $ppname=$_POST['ppname'];
 $pprice=$_POST['pprice'];
 $con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW");
 $sql=" INSERT INTO product (productname,productprice)  VALUES('$pname','$pprice')";
mysql_select_db('socal',$con);
$retval = mysql_query( $sql, $con);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
} mysql_close($con); }
?>
<html>

<head>
<script>
function myfunction(myflag)
var myflag = <?php echo $flag; ?>;
if (myflag==1)
 {
 <form action="<?php $_PHP_SELF ?>" method="POST">
  Product Name<input type"=text" name="pname"  /><br>
  Product Price<input type="text" name="pprice" /><br><input type="submit"></form> }
else
{ <form action="<?php $_PHP_SELF ?>" method="POST">
 Product Name<input type="text" name="pname" value=" <?php $row['productname'] ?>"/><br>
 Product Price<input type="text" name="pprice" value=" <?php $row['productprice']?>  "/><br><input type="submit"></form>} 
</script>
</head>
<body>
myfunction(); </body>
</html>
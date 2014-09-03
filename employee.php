<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
require 'postlogin.html';
	exit();
}
  $_SESSION['time']=time(); 
 echo '<input type="button" name="return1" value="Logout" onClick=location.href="logout.php" />'; 
?>
<!DOCTYPE html>
<html>
<head>
<style>

body{background-image:url('bg3.jpg');}
</style>
</head>
<body>
<h1><center>Welcome, <?php echo $_SESSION['sess_username']; ?></center></h1>
<p><center><b>To add,change or delete products click below<b></center><br></p>
<center><form name="search" action = "addchangeproduct.php" method = "POST"  >
<input type="submit" value="Add Product" name="addproduct"/> </form></center>&nbsp

<center><form name="search" action = "changedeleteproduct.php" method = "POST"  >
<input type="submit" value="Change Product" name="changeproduct" /> &nbsp
<input type="submit" value="Delete Product" name="deleteproduct" /></form> </center>
<p><center><b>To add,change or delete product category click below<b></center><br></p>
<center><form name="search" action = "addchangeproductcat.php" method = "POST"  >
<input type="submit" value="Add Product Category" name="addproductcat"/> </form></center>&nbsp

<center><form name="search" action = "changedeleteproductcat.php" method = "POST"  >
<input type="submit" value="Change Product Category" name="changeproductcat" /> &nbsp
<input type="submit" value="Delete Product Category" name="deleteproductcat" /></form> </center>

<p><center><b>To add,change or delete special sales click below<b></center><br></p>
<center><form name="search" action = "addchangess.php" method = "POST"  >
<input type="submit" value="Add Special Sales Information" name="addss"/> </form></center>&nbsp

<center><form name="search" action = "changedeletess.php" method = "POST"  >
<input type="submit" value="Change Special Sales Information" name="changess" /> &nbsp
<input type="submit" value="Delete Special Sales Information" name="deletess" /></form> </center>
</body>
</html>
<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
require 'postlogin.html';
	exit();
} $_SESSION['time']=time(); 
   echo '<input type="button" name="return1" value="Logout" onClick=location.href="logout.php" />';    
?>
<!DOCTYPE html>
<html>
<head>
<style>
body {background-image:url('bg3.jpg');}
</style>
</head>
<body>
<h1><center>Welcome, <?php echo $_SESSION['sess_username']; ?></center></h1>
<center><p><b>To add,change or delete user login details click below</b><br></center></p>
<center><form name="user" action = "addchangeuser.php" method = "POST"  >
<input type="submit" value="Create User Login Details" name="adduser"/> </form></center>&nbsp

<center><form name="user" action = "changedeleteuser.php" method = "POST"  >
<input type="submit" value="Modify User Login Details" name="changeuser" /> &nbsp
<input type="submit" value="Delete User Login Details" name="deleteuser" /></form> </center>&nbsp
<center><p><b>To add,change or delete user details click below</b><br></center></p>
<center><form name="user1" action = "addchangeuser1.php" method = "POST"  >
<input type="submit" value="Create a new user" name="adduser1"/> </form></center>&nbsp
<center><form name="user1" action = "changedeleteuser1.php" method = "POST"  >
<input type="submit" value="Modify User Details" name="changeuser1" /> &nbsp
<input type="submit" value="Delete User Details" name="deleteuser1" /></form> &nbsp
<p><b>To search for Reports click on any of the following</b></p> 

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



<form action="manager3.php">
<b>To search for product reports click below</b><br>
<input type="submit" value="Click here for product search">
</form>
<form action="manager4.php">
<b>To search for product reports click below</b><br>
<input type="submit" value="Click here for product category search">
</form>
<form action="manager1.php">
<b>To search for employee reports click below</b><br>
<input type="submit" value="Click here for employee search">
</form>
<form action="manager2.php">
<b>To search for Special Sale reports click below</b><br>
<input type="submit" value="Click here for Special Sales">
</form>
</center>
</body>
</html>
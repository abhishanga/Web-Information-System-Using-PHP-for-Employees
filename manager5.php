<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not
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
      
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">

function validateform() {
  var r1=true;var r2=true;
  if ((document.getElementById('d').value.length > 0) && (document.getElementById('d1').value.length > 0))
  { r1=checkdate();
  r2=checkdate1();

  }
    if(r1==true && r2==true)
  return true;
  else
  return false;

	
}



function checkdate(){
var a = document.search1.d.value;
var validformat=/^\d{2}\/\d{2}\/\d{4}$/ //Basic check for format validity
var returnval=false
if (!validformat.test(a))
alert("Invalid Date Format. Please correct and submit again.")
else{ //Detailed check for valid date ranges
var monthfield=input.value.split("/")[0]
var dayfield=input.value.split("/")[1]
var yearfield=input.value.split("/")[2]
var dayobj = new Date(yearfield, monthfield-1, dayfield)
if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
alert("Invalid Day, Month, or Year range detected. Please correct and submit again.")
else
returnval=true
}
if (returnval==false) 
return returnval
}
function checkdate1(){
var a = document.search1.d1.value;
var validformat=/^\d{2}\/\d{2}\/\d{4}$/ //Basic check for format validity
var returnval=false
if (!validformat.test(a))
alert("Invalid Date Format. Please correct and submit again.")
else{ //Detailed check for valid date ranges
var monthfield=input.value.split("/")[0]
var dayfield=input.value.split("/")[1]
var yearfield=input.value.split("/")[2]
var dayobj = new Date(yearfield, monthfield-1, dayfield)
if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
alert("Invalid Day, Month, or Year range detected. Please correct and submit again.")
else
returnval=true
}
if (returnval==false) 
return returnval
}

function validate2()
{ var r1=true;var r2=true;
 var x = document.forms["form2"]["pcname"].value;
    if (x == null || x == "") {
        alert("Product category name must be filled out");
        r1=false;
    }
	if ( ( form2.sales1[0].checked == false ) && ( form2.sales1[1].checked == false ) ) 
	{ alert ( "Please one of number of items or revenue" ); 
	r2=false; }
	if(r1==true && r2==true)
	return true;
	else
	return false;
	}
	function validate3()
{ var r1=true;var r2=true;
 var x = document.forms["form3"]["pname"].value;
    if (x == null || x == "") {
        alert("Product name must be filled out");
        r1=false;
    }
	if ( ( form3.sales2[0].checked == false ) && ( form3.sales2[1].checked == false ) ) 
	{ alert ( "Please one of number of items or revenue" ); 
	r2=false; }
	if(r1==true && r2==true)
	return true;
	else
	return false;
	}
		function validate1()
{ var r2=true;

	if ( ( form1.sales[0].checked == false ) && ( form1.sales[1].checked == false ) ) 
	{ alert ( "Please one of number of items or revenue" ); 
	r2=false; }
	if(r2==true)
	return true;
	else
	return false;
	}

</script>
<style>
body{background-image:url('bg4.jpg');}</style>
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['sess_username']; ?></h1>
<p><em>To search for Order Reports</em></p> 

<form name="search1" action = "display6.php" method = "POST" onsubmit="return validateform()" >

<b>Valid date format:</b> mm/dd/yyyy<br />
Search by start date:
<input type="text" name="date" id="d" />
Search by end date:
<input type="text" name="date1" id="d1" /><br>
Search by product category:<br>
<input type="text" name="pc"/><br>
Search by product :<br>
<input type="text" name="p"/><br>
Search by special sales:<br>
<input type="text" name="s"/><br>


<input type="submit" value="Submit Form" />
</form>

<input type="button" name="return" value="Click to know frequently purchased products" onClick='location.href="freqprods1.php"' /><br>

<div style="position:relative;top:-230px;left:600px">
Sales in all product categories by revenue generated or number of items sold
<form action="totalsales.php" method="post" name="form1" onsubmit="return validate1()">
<input type="radio" name="sales" value="revenue"/>Revenue<br>
<input type="radio" name="sales" value="items"/>Number of items<br>
<input type="submit" value="Go"/>
</form><br>
Sales in each product category by revenue generated or number of items sold<br>
<form action="pcsales.php" method="post" name="form2" onsubmit="return validate2()">
Product Categories:T-shirts,Bottoms,Dresses,Sweatshirts<br>
Product Category Name:<input type="text" name="pcname"/><br>
<input type="radio" name="sales1" value="revenue"/>Revenue<br>
<input type="radio" name="sales1" value="items"/>Number of items<br>
<input type="submit" value="Go"/>
</form><br>
Sales of a product by revenue generated or number of items sold<br>
<form action="psales.php" method="post" name="form3" onsubmit="return validate3()">
Product Name:<input type="text" name="pname"/><br>
<input type="radio" name="sales2" value="revenue"/>Revenue<br>
<input type="radio" name="sales2" value="items"/>Number of items<br>
<input type="submit" value="Go"/>
</form></div>
<center><input type="button" name="return" value="Return to HomePage" onClick='location.href="manager.php"' /></center>
</body>
</html>


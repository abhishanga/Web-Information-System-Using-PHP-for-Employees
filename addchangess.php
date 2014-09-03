<?php
session_start();
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
    require 'postlogin.html';
	exit();
}if (!isset($_SESSION['time']))
require 'logout.php';
else {
$t=time();
if(($t-$_SESSION['time']>300))
require 'logout.php';}
$sid=$_POST['specialsalesid'];
echo '<html>
      <head>
	 <style>
	  body {
    background-color: #d0e4fe;
	background-image:url("bg3.jpg");
      }

h1 {
    color: green;
    text-align: center;
     }

p {
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    font-size: 14px;
} </style><script>
function date() {
	var a = document.f.startdate.value;
	d = Date.parse(a);
     
var validformat=/(\d{4})[-\/](\d{2})[-\/](\d{2})/
var returnval=false
if (!validformat.test(a))
window.alert("Invalid Start Date Format. Please submit again in yyyy-mm-dd format.")
else 
returnval=true;

return returnval; }
function date1() {
	var a = document.f.enddate.value;
	d = Date.parse(a);
     
var validformat=/(\d{4})[-\/](\d{2})[-\/](\d{2})/
var returnval=false
if (!validformat.test(a))
window.alert("Invalid End Date Format. Please submit again in yyyy-mm-dd format.")
else 
 returnval=true;

return returnval; }
function age()
{
var age=document.getElementById("age").value;
age = parseInt(age,10);

if (isNaN(age) || age<1 || age>100)
{
alert("The discount must be a number between 1 and 100");
return false;
} else
return true;
}
function validateform()
{ var f=true; var f1=true; var f2=true;
    f=date(); f1=date1(); f2=age();
	
	
	if(f==true && f1==true && f2==true)
	return true;
	else
   return false;  }
   function date2() {
	var a = document.f1.startdate.value;
	d = Date.parse(a);
     
var validformat=/^\d{2}\/\d{2}\/\d{4}$/
var returnval=false
if (!validformat.test(a))
window.alert("Invalid Start Date Format. Please correct and submit again.")
else 
 returnval=true;

return returnval; }
   function date3() {
	var a = document.f1.enddate.value;
	d = Date.parse(a);
     
var validformat=/^\d{2}\/\d{2}\/\d{4}$/
var returnval=false
if (!validformat.test(a))
window.alert("Invalid End Date Format. Please correct and submit again.")
else 
{ returnval=true;
window.alert("Good date");}
return returnval; }
function age1()
{
var age=document.getElementById("age1").value;
age = parseInt(age,10);

if (isNaN(age) || age<1 || age>100)
{
alert("The discount must be a number between 1 and 100");
return false;
} else
return true;
}
function checkname() {   //www.tutorialspoint.com
var valid = true;

        var validationMessage = "Please correct the following errors:\r\n";
if (document.getElementById("s1").value.length == 0)

        {

            validationMessage = validationMessage + " - Start Date is missing\r\n";

            valid = false;

        } if (document.getElementById("e1").value.length == 0)

        {

            validationMessage = validationMessage + "  - End date is missing\r\n";

            valid = false;

        } 
		
		if (document.getElementById("age1").value.length == 0)

        {

            validationMessage = validationMessage + "  - Discount is missing\r\n";

            valid = false;

        }if (valid == false)

        {

            alert(validationMessage);

        }

        

        return valid;
		}
		function validate()
{
var chks = document.getElementsByName("pname");
var hasChecked = false;
for (var i = 0; i < chks.length; i++)
{
if (chks[i].checked)
{
hasChecked = true;
break;
}
}
if (hasChecked == false)
{
alert("Please select at least one product.");
return false;
}
return true;
}
function validateform1()
{ var f=true; var f1=true; var f2=true; var f3=true; var f4=true;
    f=date2(); f1=date3(); f2=age1(); f3=checkname(); f4=validate();
	
	
	if(f==true && f1==true && f2==true && f3==true && f4==true)
	return true;
	else
   return false;  }
</script></head>';
if(!$sid)
echo '<h1>Add';
else
echo '<h1>Change';
echo ' Special Sales Information</h1>';
if($sid){
$sql="SELECT * from specialsales WHERE specialsalesid=$sid";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
 echo '<body><form action="changess.php" method="POST" onsubmit="return validateform();" name="f">
  Special Sales ID<input type="text" name="specialsalesid" value=" '. $row['specialsalesid'] .' "/><br>
 Sale Start Date<input type="text" name="startdate" value=" '. $row['startdate'] .' "/><br>
  Sale End Date<input type="text" name="enddate" value=" '. $row['enddate'] .' "/><br>
 Discount&nbsp<input type="text" id="age" name="discount" value=" '. $row['discount'] .' "/><br><input type="submit"></form>';
 mysql_close($con); }
 else { $sql="SELECT * from product";
$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
$row=mysql_fetch_array($res);
  echo ' <body><form action="addss.php" method="POST" onsubmit="return validateform1();" name="f1">';
 do{
echo '<input name="pname" id="pname" id="pname" type="radio" value=" ' . $row['productid'] .'"/> ' . $row['productname'] . '<br>';}while($row=mysql_fetch_array($res));
  echo 'Start Date<input type"=date" id="s1" name="startdate"  /><br>
  End Date<input type"=date" id="e1" name="enddate"  /><br>
  Discount<input type="number" id="age1" name="discount" /><br><input type="submit"></form>';  mysql_close($con);}
   echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="employee.php" /></center>';
 ?>
 
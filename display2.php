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
$employeeid=$_POST['empid'];
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$age=$_POST['age'];
$emptype = $_POST['type'];
$errmsg="";
$flag=0;

//1st search criteria
if(strlen($employeeid)>0  && strlen($firstname)==0 && strlen($lastname)==0 && strlen($age)==0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND employeeid=$employeeid"; $flag=1;}
if(strlen($employeeid)>0  && strlen($firstname)>0 && strlen($lastname)==0 && strlen($age)==0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND employeeid=$employeeid  AND firstname='$firstname'"; $flag=1;}
if(strlen($employeeid)>0  && strlen($firstname)>0 && strlen($lastname)>0 && strlen($age)==0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND employeeid=$employeeid  AND firstname='$firstname' AND lastname='$lastname'"; $flag=1;}
if(strlen($employeeid)>0  && strlen($firstname)>0 && strlen($lastname)>0 && strlen($age)>0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND employeeid=$employeeid AND firstname='$firstname' AND lastname='$lastname' AND age=$age"; $flag=1;}
if(strlen($employeeid)==0  && strlen($firstname)==0 && strlen($lastname)==0 && strlen($age)==0 && strlen($emptype)>0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND usertype='$emptype'"; $flag=1;}
//2nd search criteria


if(strlen($employeeid)==0  && strlen($firstname)>0 && strlen($lastname)==0 && strlen($age)==0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND firstname='$firstname'"; $flag=1;}
//4th search criteria
if(strlen($employeeid)==0 && strlen($firstname)==0 && strlen($lastname)>0 && strlen($age)==0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND lastname='$lastname'"; $flag=1;}
if(strlen($employeeid)==0 && strlen($firstname)>0 && strlen($lastname)>0 && strlen($age)==0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND lastname='$lastname' AND firstname='$firstname'"; $flag=1;}
if(strlen($employeeid)==0 && strlen($firstname)>0 && strlen($lastname)>0 && strlen($age)>0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND lastname='$lastname' AND firstname='$firstname' AND age=$age"; $flag=1;}
if(strlen($employeeid)==0 && strlen($firstname)>0 && strlen($lastname)>0 && strlen($age)>0 && strlen($emptype)>0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND lastname='$lastname' AND firstname='$firstname' AND age=$age AND usertype='$emptype' "; $flag=1;}
if(strlen($employeeid)>0 && strlen($firstname)>0 && strlen($lastname)>0 && strlen($age)>0 && strlen($emptype)>0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND lastname='$lastname' AND firstname='$firstname' AND age=$age AND usertype='$emptype'AND employeeid=$employeeid "; $flag=1;}
//4th search criteria
if(strlen($employeeid)==0  && strlen($firstname)==0 && strlen($lastname)==0 && strlen($age)>0 && strlen($emptype)==0 )
{ $sql="SELECT * from employee as e,users as u WHERE e.userid=u.userid AND age=$age"; $flag=1;}
//5th search criteria






if($flag==1)
{$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW"); //Start DB
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
if(!($row=mysql_fetch_array($res)))
{ $errmsg='No such employees found'; }  
else
{
echo "<html>
      <head>
	  <style>
	  body {
    background-color: #d0e4fe;
	background-image:url('bg4.jpg');
      }
</style></head><center><table border='1'>
<tr>
<th>Employee ID</th>
<th>Username</th>
<th>Password</th>
<th>First Name</th>
<th>Last Name</th>
<th>Age</th>
<th>Employee Type</th>
<th>Employee Pay</th>
</tr>";

 do{
  echo "<tr>";
  echo "<td>" . $row['employeeid'] . "</td>";
 echo "<td>" . $row['username'] . "</td>";
 echo "<td>" . $row['password'] . "</td>";
  echo "<td>" . $row['firstname'] . "</td>";
  echo "<td>" . $row['lastname'] . "</td>"; 
  echo "<td>" . $row['age'] . "</td>";
  echo "<td>" . $row['employeetype'] . "</td>";
  echo "<td>" . $row['employeepay'] . "</td>";
  echo "</tr>";
}while($row = mysql_fetch_array($res));

echo "</table></center>"; 

 }mysql_close($con);} 
echo' <center><input type="button" name="return" value="Return to HomePage" onClick=location.href="manager.php" /></center>';
?>
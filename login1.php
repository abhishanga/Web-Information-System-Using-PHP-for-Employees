<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];
$errmsg="";

if(strlen($username)==0)
{ $errmsg='Invalid login'; }

if(strlen($password)==0)
{ $errmsg='Invalid login'; }

if(strlen($password)==0 && strlen($username)==0)
{ $errmsg=""; }
// Goto DB to validate when both exist
if(strlen($username)>0 && strlen($password)>0)
{ $sql="SELECT * from users where username='$username' and password=password('$password')";

$con=mysql_connect("cs-server.usc.edu:7123","root","NEWPW");
if(!$con)
{ die('Could not connect to database'.mysql_error());}
mysql_select_db("socal",$con);
$res=mysql_query($sql);
print mysql_error();
if(!($row=mysql_fetch_array($res)))
{ $errmsg='<p><center><b>Invalid login</b></center></p>'; }  
else
{
    $_SESSION['sess_user_id'] = $row['usertype'];
	$_SESSION['sess_username'] = $row['username'];
	}
	
mysql_close($con);} //End DB

if(strlen($errmsg)>0)
{
require 'prelogin.html';
echo "<p>$errmsg</p>"; 
require 'postlogin.html';
}
else if(!$res)
{ 
require 'prelogin.html';
require 'postlogin.html';
}
else
{  if($_SESSION['sess_user_id'] == 'manager') 
      { require 'manager.php'; exit();}
if($_SESSION['sess_user_id'] == 'Sales Manager') 
      { require 'employee.php'; exit();}	
if($_SESSION['sess_user_id'] == 'admin') 
      { require 'admin.php'; exit();}	  }//end else              
     //session_regenerate_id();
	//$_SESSION['sess_user_id'] = $userdata['usertype'];
	//$_SESSION['sess_username'] = $userdata['username'];
	//session_write_close(); }
?>






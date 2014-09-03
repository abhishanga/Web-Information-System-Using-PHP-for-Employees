<?php
session_start();
 //Check whether the session variable SESS_MEMBER_ID is present or not
if ((!isset($_SESSION['sess_user_id'])) && (!isset($_SESSION['sess_username']) ))
{
	require 'prelogin.html';
require 'postlogin.html';
	exit();
}

echo '<p>';
if(isset($_POST['changeuser1']))
echo'Change';
else
echo 'Delete';
echo ' a User </p>';

if(isset($_POST['changeuser1'])) {
echo '<form action="addchangeuser1.php" method = "POST">';
echo'<input type="radio" name="employeeid" value="1">1<br>';
echo '<input type="radio" name="employeeid" value="2">2<br>';
echo '<input type="radio" name="employeeid" value="3">3<br>';
echo '<input type="radio" name="employeeid" value="4">4<br>';
echo '<input type="radio" name="employeeid" value="5">5<br>'; }


else{
echo '<form action="deleteuser1.php" method = "POST">';
echo'<input type="checkbox" name="employeeid[]" value="1">1<br>';
echo '<input type="checkbox" name="employeeid[]" value="2">2<br>';
echo '<input type="checkbox" name="employeeid[]" value="3">3<br>';
echo '<input type="checkbox" name="employeeid[]" value="4">4<br>';
echo '<input type="checkbox" name="employeeid[]" value="5">5<br>';


}


echo '<input type="submit" value="';
if(isset($_POST['changeuser1']))
echo'Change';
else
echo 'Delete';
echo ' a User "/> </form>';



?>
 
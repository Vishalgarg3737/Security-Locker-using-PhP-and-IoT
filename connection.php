<?php

$servername="localhost:3308";
$username="Vishal";
$password="Vishal@3737";
$dbname="locker";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
{
	die("Connection Failed: ".$mysqli_connect_error);
}
?>
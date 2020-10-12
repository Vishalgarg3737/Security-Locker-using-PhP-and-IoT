<?php

if(isset($_POST["token"]) && $_POST["token"] == "alpha")
{
	$Name = $_POST["username"];
	$Password = $_POST["password"];

	include 'connection.php';

	$sql = "SELECT * FROM details WHERE Name='$Name' AND Password='$Password' ";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		$array = array();
		$row = mysqli_fetch_assoc($result);
		$array[] = $row;
		$array=json_encode($array);
		print_r ($array);
	}
	else
		echo "Invalid Username or Password";
}
else
	echo "<br><br><br><br><br><br><br><span style='font-size:50px; margin-left:570;'>Page doesn't exist</span>";

?>
<?php
if(isset($_POST["token"]) && $_POST["token"] == "alpha")
{
$name=$_POST["name"];
$email=$_POST["email"];
	$servername = "localhost:3308";
	$username = "Vishal";
	$password = "Vishal@3737";
	$dbname = "vishal";
	$conn=mysqli_connect($servername, $username, $password, $dbname);
	if(!$conn)
	{
		die("Connection Failed: ".$mysqli_connect_error);
	}
	$name=htmlentities($name);
	$name=mysqli_real_escape_string($conn, $name);
	$sql="INSERT INTO sample (Name, Email) VALUES ('$name', '$email')";
	
	if(mysqli_query($conn, $sql))
	{
		$result="New Record Entered";
		echo $result;
	}
	else
	{
		$result="Failed to enter details";
		echo $result;
	}
}
else
{
	echo "Page doesn't exist";
}
?>
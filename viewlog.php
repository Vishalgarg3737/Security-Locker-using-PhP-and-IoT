<?php

if(isset($_POST["token"]) && $_POST["token"] == "alpha")
{
	$servername="localhost:3308";
	$username="Vishal";
	$password="Vishal@3737";
	$dbname="locker";
	$id=$_POST["id"];
	$flag=$_POST["flag"];

	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn)
	{
		die("Connection Failed: ".$mysqli_connect_error);
	}
	if($flag == 0)
	{
		$sql = "SELECT Log_ID,User_ID,Date,Time FROM log_details";
	}
	else
	{
		$sql = "SELECT Log_ID,User_ID,Date,Time FROM log_details WHERE User_ID=$id";
	}
	$result=mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) > 0)
	{
		$array = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$array[] = $row;
		}
		$sample=array();
		$sample[] = "TRUE";
		$sample[] = $array;
		$sample=json_encode($sample);
		print_r ($sample);
	}
	else 
	{
		$sample=array();
		$sample[0] = "False";
		$array="No Results";
		$sample[1] = $array;
		$sample=json_encode($sample);
		print_r ($sample);
	}
	mysqli_close($conn);
}
else 
{
	echo "<br><br><br><br><br><br><br><span style='font-size:50px; margin-left:570;'>Page doesn't exist</span>";
}
?>
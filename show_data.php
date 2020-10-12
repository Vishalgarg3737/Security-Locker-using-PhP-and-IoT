<?php

if(isset($_POST["token"]) && $_POST["token"] == "alpha")
{
	include 'connection.php';

	$sql = "SELECT User_ID, Name, Phone_number, RFID_tag, Password, Status FROM details";
	$result=mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) > 0)
	{
		$array = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$array[] = $row;
		}
		$array=json_encode($array);
		print_r ($array);
	}
	else 
	{
		echo "0 Results";
	}
	mysqli_close($conn);
}
else 
{
	echo "<br><br><br><br><br><br><br><span style='font-size:50px; margin-left:570;'>Page doesn't exist</span>";
}
?>
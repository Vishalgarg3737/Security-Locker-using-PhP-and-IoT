<?php

include 'connection.php';
	
	$Number=$_POST["tag"];
	
	$sql = "SELECT User_ID FROM details WHERE RFID_tag='$Number'";
	
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_assoc($result);
	}
	else
		$row = NULL;
	if($row != NULL)
	{
		$id=$row["User_ID"];
		date_default_timezone_set('Asia/Kolkata');
		$Date = date('d/m/Y', time());
		$Time = date('h:i:s a', time());
			$sql ="INSERT INTO log_details (User_ID, Date, Time) VALUES ($id, '$Date' ,'$Time')";
		if(mysqli_query($conn, $sql))
		{
			echo "TRUE";
		}
		else
		{
			echo "Failed to enter";
		}
	}
	
	else
		echo "FALSE";
	
?>
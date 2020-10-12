<?php
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
	$data = array("token"=>"alpha");
	$string = http_build_query($data);
	$url = "http://localhost/rest/show_data.php";
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_POSTFIELDS,$string);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$result = curl_exec($client);
	$result = json_decode($result,true);
	$length = count($result);
	
	if($result != "0 Results")
	{
		echo "<table cellspacing=7 cellpadding=3n><colgroup><col span =6 style='background-color:blue;'></colgroup><tr style=background-color:black><th style=color:white>User_ID</th><th style=color:white>Name</th><th style=color:white>Phone_number</th><th style=color:white>RFID_tag</th><th style=color:white>Password</th><th style=color:white>Status</th></tr>";

		foreach ($result as $row)
		{
			echo "<tr style=color:white><td>".$row["User_ID"]." </td><td>".$row["Name"]." </td><td>".$row["Phone_number"]." </td><td>".$row["RFID_tag"]." </td><td>".$row["Password"]." </td><td>".$row["Status"];
		}
		echo "</table>";
	}
	else
	{
		echo $result;
	}

	curl_close($client);
}
else 
	echo "<br><br><br><br><br><br><br><span style='font-size:50px; margin-left:570;'>Page doesn't exist</span>";


?>
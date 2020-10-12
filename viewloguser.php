<?php
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
	$data = array("token"=>"alpha","id"=>$_SESSION["user_id"], "flag"=>$_SESSION["flag"]);
	$string = http_build_query($data);
	$url = "http://localhost/rest/viewlog.php";
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_POSTFIELDS,$string);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$result = curl_exec($client);
	$result = json_decode($result,true);
	if($result[0] == "TRUE")
	{
		$display = $result[1];
		echo "<table cellspacing=7 cellpadding=3n><colgroup><col span =6 style='background-color:blue;'></colgroup><tr style=background-color:black><th style=color:white>Log_ID</th><th style=color:white>User_ID</th><th style=color:white>Date</th><th style=color:white>Time</th></tr>";

		foreach ($display as $row)
		{
			echo "<tr style=color:white><td>".$row["Log_ID"]." </td><td>".$row["User_ID"]." </td><td>".$row["Date"]." </td><td>".$row["Time"];
		}
		echo "</table>";
	}
	else
	{
		echo $result[1];
	}

	curl_close($client);
}
else 
	echo "<br><br><br><br><br><br><br><span style='font-size:50px; margin-left:570;'>Page doesn't exist</span>";


?>
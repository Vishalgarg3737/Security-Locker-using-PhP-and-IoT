<?php
if(isset($_POST["token"]) && $_POST["token"] == "alpha")
{
	$Name = $_POST["name"];
	$Ph = $_POST["phone"];
	$rfid = $_POST["rfid"];
	$password = $_POST["password"];
	$status = $_POST["status"];

	include 'connection.php';

	$Name=htmlentities($Name);
	$Name=mysqli_real_escape_string($conn, $Name);

	$sql = "INSERT INTO details (Name, Phone_number, RFID_tag, Password, Status) VALUES ('$Name', '$Ph', '$rfid', '$password', '$status')";

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
	echo "<br><br><br><br><br><br><br><span style='font-size:50px; margin-left:570;'>Page doesn't exist</span>";
}
?>



	
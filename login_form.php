<?php
session_start();
$username=$password="";
$usererr=$passerr="";
$count=0;


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty($_POST["user"]) || ctype_space($_POST["user"]))
	{
		$usererr = "Username is required";
	}
	else
	{
		$username = $_POST["user"];
		$count++;
	}
	if(empty($_POST["pass"]) || ctype_space($_POST["pass"]))
	{
		$passerr = "Password is required";
	}
	else
	{
		$password = $_POST["pass"];
		$count++;	
	}
	
	$data = array("token"=>"alpha", "username"=>$username, "password"=>$password);
	$string = http_build_query($data);
	$url = "http://localhost/rest/check_details.php";
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_POST,true);
	curl_setopt($client,CURLOPT_POSTFIELDS,$string);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$result = curl_exec($client);
	$result = json_decode($result,true);
	foreach ($result as $row)
	{
		if($row != "Invalid Username or Password")
		{
			if($row["Status"] == "Admin" || $row["Status"] == "User" || $row["Status"] == "Guest")
			{
				$_SESSION["username"]=$username;
				$_SESSION["password"]=$password;
				$_SESSION["status"]=$row["Status"];
				$_SESSION["user_id"]=$row["User_ID"];
				$_SESSION["phone"]=$row["Phone_number"];
				header("Location:http://localhost/rest/access.php");
			}	
		}
	}
}

?>
<form method='post' action=''><div style="text-align:center; margin-top:200px;font-size:20px; border-radius:10px;">
Username: <input type='text' name='user' value="<?php 
if($count==2)
{
	echo "";
}
else
{
	echo $username;
}
?>"> <?php echo $usererr; ?><br><br>
Password: <input type='text' name='pass' value="<?php
if($count==2)
{
	echo "";
}
else
{
	echo $password;
}
?>"> <?php echo $passerr; ?><br><br>
<input type='submit' value='Login'></div>
</form>
<?php

if($count == 2)
{
#echo "<div style='text-align:center;'>$result</div>";
curl_close($client);
}

?>


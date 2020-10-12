<?php
session_start();
$Name=$Ph=$rfid=$status=$password="";
$nameerr=$pherr=$rfiderr=$statuserr=$passerr="";
$count=0;
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['click']))
		{
			if(empty($_POST["name"]) || ctype_space($_POST["name"]))
			{
				$nameerr="Enter a valid name";
			}
			else
			{
				$Name=$_POST["name"];
				$count++;
			}
			if(empty($_POST["phone"]) || ctype_space($_POST["phone"]) || strlen($_POST["phone"])<10)
			{
				$pherr="Enter a valid phone number";
			}
			else
			{
				$Ph=$_POST["phone"];
				$count++;
			}
			if(empty($_POST["rfid"]) || ctype_space($_POST["rfid"]))
			{
				$rfiderr="Enter a valid rfid tag";
			}
			else
			{
				$rfid=$_POST["rfid"];
				$count++;
			}
			if(empty($_POST["pass"]) || ctype_space($_POST["pass"]))
			{
				$passerr="Enter a valid password";
			}
			else
			{
				$password=$_POST["pass"];
				$count++;
			}
			if(empty($_POST["status"]) || ctype_space($_POST["status"]))
			{
				$statuserr="Enter a valid status";
			}
			else
			{
				$status=$_POST["status"];
				$count++;
			}
		}
	}
}
else
{
	header("Location:http://localhost/rest/login_form.php");
}


?>
<form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
Name: <input type='text' name='name' value="<?php 
if($count==5)
{
	echo "";
}
else
{
	echo $Name;
}
?>"> <?php echo $nameerr; ?><br><br>
Phone No: <input type='text' name='phone' value="<?php
if($count==5)
{
	echo "";
}
else
{
	echo $Ph;
}?>"> <?php echo $pherr;?><br><br>
RFID: <input type='text' name='rfid' value="<?php
if($count==5)
{
	echo "";
}
else
{
	echo $rfid;
}?>"> <?php echo $rfiderr;?><br><br>
Password: <input type='text' name='pass' value="<?php
if($count==5)
{
	echo "";
}
else
{
	echo $password;
}?>"> <?php echo $passerr;?><br><br>
Status: <input type='text' name='status' value="<?php
if($count==5)
{
	echo "";
}
else
{
	echo $status;
}?>"> <?php echo $statuserr;?><br><br>
<input type='submit' name='click' value='Insert'>
</form>

<?php
if($count==5)
{
	$data = array("token"=>"alpha", "name"=>$Name,"phone"=>$Ph,"rfid"=>$rfid,"password"=>$password,"status"=>$status);
	$string = http_build_query($data);
	
	$url = "http://localhost/rest/insert.php";
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_POST,true);
	curl_setopt($client,CURLOPT_POSTFIELDS,$string);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$result = curl_exec($client);
	echo $result;
	curl_close($client);
}
?>







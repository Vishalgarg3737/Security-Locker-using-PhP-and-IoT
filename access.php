<?php
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
	echo "<span style='font-size:30px;'>Welcome ";
	echo $_SESSION["username"]." </span>";
}
else
{
	header("Location:http://localhost/rest/login_form.php");
}
if($_SESSION["status"] == "Admin")
{
	echo "<form method=post action=''><br><br><input type='submit' value='Add User' style='border-radius: 10px;border-color:black;background-color:; font-size:20px; height: 250px; width: 250px; margin-left: 375; margin-top: 200;' formaction='http://localhost/rest/add.php'>
<input type='submit' value='Display Users' style='border-radius: 10px;border-color:black;background-color:;font-size:20px; height: 250px; width: 250px;margin-left:10; top: 2500;' formaction='http://localhost/rest/display.php'>
<input type='submit' value='View Log' style='border-radius: 10px;border-color:black;background-color:;font-size:20px; height: 250px; width: 250px; margin-left:10; top: 2500;' formaction='http://localhost/rest/viewloguser.php'>
</form>";
$_SESSION["flag"] = 0;
}
else 
{
	echo "<form method=post action=''><br><br>
<input type='submit' value='View Log' style='border-radius: 10px;border-color:black;background-color:;font-size:20px; height: 250px; width: 250px;margin-left:375;margin-top:200;' formaction='http://localhost/rest/viewloguser.php'>
</form>";
$_SESSION["flag"] = 1;
}
	



?>
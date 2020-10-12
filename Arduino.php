<?php
$Number="";
if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$Number=$_GET["number"];
	$data = array("token"=>"alpha","tag"=>$Number);
	$string = http_build_query($data);
	$url = "http://localhost/rest/arduino_webservice.php";
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_POSTFIELDS,$string);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$result = curl_exec($client);	
	echo $result;
}
?>

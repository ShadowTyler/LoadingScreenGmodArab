<?php

include('inc/config.php');
include('inc/functions.php');

$general         = file_get_contents('settings/general.json');
$decode_general  = json_decode($general, true);

$custom        = file_get_contents('settings/custom.json');
$decode_custom = json_decode($custom, true);

if(empty($decode_general['api_key']))
{
	die('You need to set your Steam API key in your AdminCP!');
}

if(!isset($_GET['steamid']))
{
	die('You need to setup your config like this: <span style="color: red;">sv_loadingurl "http://your-website.com/?steamid=%s"</span>');
}

?>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- CSS Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/foundation.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/content.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/fonts.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/colors.css" media="screen" />

	<style>
		html,body
		{
			background: url(<?php echo $decode_custom['bgimg']; ?>) no-repeat center center fixed; 
		    -webkit-background-size: cover;
			-moz-background-size: cover;
		  	-o-background-size: cover;
		  	background-size: cover;
		}

		body
		{
			background-color: #<?php echo $decode_custom['bgcolor']; ?>;
			/*background-image: url('../img/bg.png');*/
			font-family: 'Lato', sans-serif; /* Default Font Family */
			font-weight: 400;
			font-size: 0.8rem;
			padding: 0;
			margin: 0;
		}

		.header-logo
		{
			color: #<?php echo $decode_custom['logocolor']; ?>;
		}

		.rule-box .rule-num
		{
			color: #FFF;
			background-color: #<?php echo $decode_custom['rulesnumcolor']; ?>;
		}

		.rule-box2 .rule-num2
		{
			color: #FFF;
			background-color: #<?php echo $decode_custom['rulesnumcolor2']; ?>;
		}

		.rule-box .rule-text, .rule-box2 .rule-text
		{
			color: #FFF;
			color: #<?php echo $decode_custom['rulestextcolor']; ?>;
		}

		.userbox-steamid .info
		{
			color: #<?php echo $decode_custom['steamidcolor']; ?>;
		}

		.userbox-name .info
		{
			color: #<?php echo $decode_custom['steamnamecolor']; ?>;
		}

		.userbox-money .info
		{
			color: #<?php echo $decode_custom['moneycolor']; ?>;
		}

		.serverbox-map .info
		{
			color: #<?php echo $decode_custom['mapcolor']; ?>;
		}

		.serverbox-mode .info
		{
			color: #<?php echo $decode_custom['gamemodecolor']; ?>;
		}

		.serverbox-slots .info
		{
			color: #<?php echo $decode_custom['playerscolor']; ?>;
		}

		#bar-width
		{
			background-color: #<?php echo $decode_custom['progresscolor'] ?>;
		}
	</style>
</head>
<body>

<div class="music-box">
	<span id="music-output"></span>
</div>

<div class="row">
	<div class="header column small-12">
		<div class="header-logo">
			<?php echo $SETTINGS['SERVER_NAME']; ?>
		</div>
	</div>
</div>
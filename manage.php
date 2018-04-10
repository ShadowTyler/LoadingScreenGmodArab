<?php

session_start();

if(!isset($_SESSION['password']))
{
	header('Location: login.php');
	exit();
}

if(isset($_GET['logout']))
{
	$logout = (int)$_GET['logout'];

	if($logout == '1')
	{
		session_start();
		session_destroy();
		header('Location: login.php');
		exit();
	}
}

include('inc/functions.php');

?>
<html>
<head>
	<title>BinLoad | AdminCP</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- CSS Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/foundation.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/manage.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/fonts.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/colors.css" media="screen" />
</head>
<body>
<div class="row">
	<div class="content column small-12 medium-10 medium-offset-1">
		<div class="header column small-12">
			<div class="header-logo">
				BinLoad | <span class="blue">AdminCP</span>
			</div>

			<div class="header-menu">
				<ul class="main-menu">
					<li><a href="manage.php" <?php echo (basename(!isset($_GET['page'])))?"class=\"current-nav\"":""; ?>>General Settings</a></li>
					<li><a href="?page=customization" <?php echo (basename(isset($_GET['page'])) && $_GET['page'] == "customization")?"class=\"current-nav\"":""; ?>>Customization Settings</a></li>
					<li><a href="?page=darkrp" <?php echo (basename(isset($_GET['page'])) && $_GET['page'] == "darkrp")?"class=\"current-nav\"":""; ?>>DarkRP Settings</a></li>
					<!--<li><a href="?page=music" <?php echo (basename(isset($_GET['page'])) && $_GET['page'] == "music")?"class=\"current-nav\"":""; ?>>Music Settings</a></li>-->
					<li class="right logout"><a href="?logout=1"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>

		<?php

		Pages();

		GeneralSettings();
		CustomSettings();
		DarkRPSettings();
		MusicSettings();

		?>
	</div>
</div>
<br>
<script src="js/jscolor.js"></script>
</body>
</html>
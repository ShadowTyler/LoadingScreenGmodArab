<?php
session_start();

if(isset($_SESSION['password']))
{
	header('Location: manage.php');
	exit();
}

include('inc/functions.php');

?>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- CSS Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/foundation.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/fonts.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/colors.css" media="screen" />
</head>
<body>
<div class="login-content">
	<div class="login-container">
		<div class="login-box">
			<div class="login-box-header">
				Login Panel
			</div>

			<div class="login-box-content">
				<form method="POST">
					<input type="password" name="password" />
					<input type="submit" class="button small" name="login" value="Login" />
				</form>
			</div>
		</div>

		<div class="output">
			<?php Login(); ?>
		</div>
	</div>
</div>
</body>
</html>
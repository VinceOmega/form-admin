<?php
if(!isset($_SESSION['admin'])){
	session_start();
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>			<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> 				<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> 				<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Veris Visalign</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/vendor/modernizr-2.6.2.min.js"></script>
	<style type="text/css">
			ul li{
				list-style-type: none;
			}

	</style>
</head>
<body>

<?php if(isset($_GET['changed'])){ ?>
	<div class="success">
		Data Saved.
	</div>
<?php } ?>
	<?php

	if(isset($_GET['signout'])){
			$_SESSION['admin'] = 0;
	}
		if(!isset($_SESSION['admin']) || $_SESSION['admin'] === 0 ){

	?>
	<div class="login">
		<span class="title">Log In</span>
		<div class="pad">
			<form method="post" action="login.php">
				<fieldset>
					<label for="username">Username</label>
					<input type="text" name="username" id="username">
				</fieldset>
				<fieldset>
					<label for="password">Password</label>
					<input type="password" name="password" id="password">
				</fieldset>
				<fieldset>
					<input type="submit" value="Log In">
				</fieldset>
			</form>
		</div>
	</div>
<?php } elseif($_SESSION['admin'] === 1 ) { ?>
	<div class="sign-out">
		<a href="?signout=1">Sign Out</a>
	</div>
	<div class="sidebar">
		<span class="title">Forms</span>
	<?php include 'panel.php' ?>
	</div>
	<?php include 'show.php' ?>

<?php } ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
	<script src="js/script.js"></script>
</body>
</html>

<?php
if(!isset($_SESSION['admin'])){
	session_start();
}
// echo $_SESSION['admin'];
// echo SID;
// die();
include 'config.php';
error_reporting(E_ALL);

if(
isset($_POST['username']) &
isset($_POST['password']) &
$_POST['username'] != '' &
$_POST['password'] != ''


){
	$username_f = $_POST['username'];
	$password_f = md5($_POST['password']);

	// var_dump($username_f);
	// var_dump($password_f);

//var_dump($_SESSION['admin']);

$_SESSION['admin'] = '';

	$db = new mysqli($config['server']['host'], $config['server']['user'], $config['server']['pass'], $config['server']['data']);
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}

$stmt = $db->prepare("SELECT user, pass FROM vs_user WHERE user = ? AND pass= ?");
$stmt->bind_param("ss", $username_f, $password_f);
$stmt->execute();
$stmt->bind_result($user, $pass);
  while ($stmt->fetch()) {
  	$username = $user;
  	$password = $pass;
        //printf("%s %s\n", $user, $pass);
    }
$stmt->close();
$db->close();
// var_dump($user);
// var_dump($pass);
	if($password === NULL){
		$_SESSION['admin'] = 0;
		header("Location: /677b0138ef0087abb7a1cba1dd5b2978/");
		die();
	}else{
		$_SESSION['admin'] = 1;
		header("Location: /677b0138ef0087abb7a1cba1dd5b2978/?form=1&id=1");
		die();
	}
}else{
		echo "Error on the previous page.";
		session_unset();
		session_destroy();
	}

?>
<?php
include 'config.php';
error_reporting(E_ALL);
var_dump($_SESSION['admin']);

if(
isset($_POST['username']) &
isset($_POST['password']) &
$_POST['username'] != '' &
$_POST['password'] != ''


){
	$username = $_POST['username'];
	$password = md5($_POST['password']);

session_start();

$_SESSION['admin'] = '';

	$db = new mysqli('localhost', $username, $password, 'arifleet');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connet_error);
			exit();
		}

$stmt = $mysqli->prepare("SELECT username, password FROM meta_users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->bind_result($result);
var_dump($result);
	if($result != true){
		$_SESSION['admin'] = 0;
		Header('Location:http://www.arifleet.com/madmin/');
		die();
	}else{
		$_SESSION['admin'] = 1;
		Header('Location:http://www.arifleet.com/madmin/');
		die();
	}

?>
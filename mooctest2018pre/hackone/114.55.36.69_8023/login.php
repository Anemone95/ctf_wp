<?php
require_once('init.php');
header("Content-type: text/html; charset=utf-8");

if(isset($_SESSION['username'])){
	header('location: ./');
	exit;
}

if(isset($_POST['submit'])){
	if(!z_validate_captcha()){
		die('INCORRECT CAPTCHA');
	}
	$userObj = new zUser();
	$username = isset($_POST['username'])?trim($_POST['username']):'';
	$password = isset($_POST['password'])?trim($_POST['password']):'';
	if($username == false || $password == false){
		die('INCORRECT USERNAME OR PASSWORD');
	}
	if(!$userObj->auth($username, $password)){
		die('INCORRECT USERNAME OR PASSWORD');
	}
	$userObj->login($username, $password);
	$_SESSION['token'] = get_salt();
	header('location: ./main.php?token='.$_SESSION['token']);
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Ambulong">
<title>Typical Multiple Users</title>
<link rel="stylesheet" href="./style.css" />
</head>
<body>
<div class="title">
	<a href="./"><h1>LOGIN</h1></a>
</div>
<div class="main">
	<div class="search">
		<form action="./login.php" method="post">
			<div class="form-item">
				<h3>USERNAME: </h3>
				<input type="text" name="username" autocomplate="off"/>
			</div>
			<div class="form-item">
				<h3>PASSWORD: </h3>
				<input type="password" name="password" autocomplate="off"/>
			</div>
			<div class="form-item captcha">
				<h3>CAPTCHA: </h3>
				<input type="text" name="captcha" />
				<img src="./captcha.php" onclick="this.src = './captcha.php?' + Math.random();">
			</div>
			<div class="form-item">
				<input name="submit" type="submit" value="LOGIN" />
				<span>&nbsp;&nbsp;</span>
				<a href="./register.php">CREATE A NEW ACCOUNT</a>
			</div>
		</form>
	</div>
</div>
</body>
</html>

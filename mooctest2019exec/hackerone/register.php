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
	$email = isset($_POST['email'])?trim($_POST['email']):'';
	if($username == false || $password == false || $email == false){
		die('INVALID INPUT');
	}
	if(!$userObj->register($username, $email, $password)){
		die('FAILED');
	}
	$userObj->login($username, $password);
	$_SESSION['token'] = get_salt();
	header('location: ./index.php');
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
	<a href="./"><h1>REGISTER</h1></a>
</div>
<div class="main">
	<div class="search">
		<form action="./register.php" method="post">
			<div class="form-item">
				<h3>USERNAME: </h3>
				<input type="text" name="username" autocomplate="off" value="admin"/>
			</div>
			<div class="form-item">
				<h3>PASSWORD: </h3>
				<input type="password" name="password" autocomplate="off" value="***"/>
			</div>
			<div class="form-item">
				<h3>E-MAIL: </h3>
				<input type="email" name="email" autocomplate="off" value="ambulong@vulnspy.com"/>
			</div>
			<div class="form-item captcha">
				<h3>CAPTCHA: </h3>
				<input type="text" name="captcha" />
				<img src="./captcha.php" onclick="this.src = './captcha.php?' + Math.random();">
			</div>
			<div class="form-item">
				<input name="submit" type="submit" value="LOGIN" />
				<span>&nbsp;&nbsp;</span>
				<a href="./login.php">ALREALY HAVE AN ACCOUNT</a>
			</div>
		</form>
	</div>
</div>
</body>
</html>

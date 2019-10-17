<?php
require_once('init.php');
header("Content-type: text/html; charset=utf-8");

$userObj = new zUser();

if(isset($_GET['token']) && isset($_GET['username'])){
	$token = isset($_GET['token'])?trim($_GET['token']):'';
	$username = isset($_GET['username'])?trim($_GET['username']):'';
	if($token == false || $username == false){
		die('INVALID INPUT');
	}
	if($userObj->verify_email($username, $token)){
		$userObj->login($username);
		header('location: ./');
		exit;
	}
	
	die('INVALID TOKEN OR USERNAME');
}

if(!isset($_SESSION['username'])){
	header('location: ./');
	exit;
}

if($userObj->is_verify($_SESSION['username'])){
	header('location: ./');
	exit;
}

if(isset($_POST['submit'])){
	if(!z_validate_captcha()){
		die('INCORRECT CAPTCHA');
	}
	if($userObj->send_email_verify($_SESSION['username'])){
		die('EMAIL ADDRESS VERIFICATION LINK HAVE BEEN SENT TO YOUR EMAIL.');
	}else{
		die('SEND FAILED');
	}
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
	<a href="./"><h1>EMAIL ADDRESS VERIFICATION</h1></a>
</div>
<div class="main">
	<div class="search">
		<form action="./verify.php" method="post">
			<div class="form-item">
				<h3>USERNAME: </h3>
				<input type="text" readonly="readonly" name="email" autocomplate="off" value="<?php echo $_SESSION['username'];?>"/>
			</div>
			<div class="form-item captcha">
				<h3>CAPTCHA: </h3>
				<input type="text" name="captcha" />
				<img src="./captcha.php" onclick="this.src = './captcha.php?' + Math.random();">
			</div>
			<div class="form-item">
				<input name="submit" type="submit" value="SEND" />
			</div>
		</form>
	</div>
</div>
</body>
</html>

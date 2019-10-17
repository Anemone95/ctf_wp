<?php
require_once('init.php');
if(!isset($_SESSION['username'])){
	header('location: ./');
	exit;
}

header("Content-type: text/html; charset=utf-8");
$userObj = new zUser();
if($userObj->is_admin($_SESSION['username'])){
	die('FORBIDDEN');
}

if(isset($_POST['submit'])){
	if(!chktoken()){
		die('INVALID REQUEST');
	}
	$email = isset($_POST['email'])?trim($_POST['email']):'';
	if($userObj->chg_email($_SESSION['username'], $email))
		die('SUCCESS');
	else
		die('FAILED');
	
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
	<a href="./"><h1>RESET MY EMAIL</h1></a>
</div>
<div class="main">
	Hello, <?php echo htmlspecialchars($_SESSION['username']);?>
	<form action="./chgemail.php?token=<?php echo $_SESSION['token'];?>" method="post">
		<div class="form-item">
			<h3>E-MAIL: </h3>
			<input type="email" name="email" />
		</div>
		<div class="form-item">
			<input name="submit" type="submit" value="Submit" />
		</div>
	</form>
</div>
</body>
</html>

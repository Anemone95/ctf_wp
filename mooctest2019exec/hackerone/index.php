<?php
require_once('init.php');
header("Content-type: text/html; charset=utf-8");

if(!isset($_SESSION['username'])){
	header('location: ./login.php');
	exit;
}
$userObj = new zUser();
$user = zUserFile::get_attrs($_SESSION['username']);
$flag = "";
if($userObj->is_admin($_SESSION['username']) && file_exists(FLAGFILE)){
	$flag = "WELL DONE! ".file_get_contents(FLAGFILE);
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
	<a href="./"><h1>MAIN</h1></a>
</div>
<div class="main">
	<div class="search">
		<?php if($userObj->is_verify($_SESSION['username'])):?>
		<p><a href="./switch.php">SWITCH ACCOUNTS</a></p>
		<?php endif;?>
		<p><a href="./chgemail.php">RESET MY EMAIL</a></p>
		<p>HELLO, <?php echo $_SESSION['username'];?><p>
		<p style="color: red;"><?php echo $flag;?></p>
		<?php if($userObj->is_verify($_SESSION['username'])):?>
		<p>E-MAIL: <span class="email-verified"><?php echo $user['email'];?></span><p>
		<?php else:?>
		<p>E-MAIL: <span class="email-unverified"><?php echo $user['email'];?></span><p>
		<p style="color: grey;">You need to verify you email address: <a href="./verify.php" style="text-decoration: underline;">SEND EMAIL ADDRESS VERIFICATION LINK</a></p>
		<?php endif;?>
	</div>
</div>
</body>
</html>

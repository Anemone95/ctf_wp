<?php
require_once('init.php');
header("Content-type: text/html; charset=utf-8");

if(!isset($_SESSION['username'])){
	header('location: ./login.php');
	exit;
}
$userObj = new zUser();
$user = zUserFile::get_attrs($_SESSION['username']);
$users = zUserFile::get_relate_users($_SESSION['username']);
$username = isset($_GET['username'])?trim($_GET['username']):'';
if($username != false && zUserFile::is_exists($username)){
	$to_user = zUserFile::get_attrs($username);
	if($user['email_verify'] === 1 && $to_user['email_verify'] === 1 && $user['email'] === $to_user['email']){
		$userObj->login2($username);
		header('Location: ./');
		exit;
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
	<a href="./"><h1>SWITCH ACCOUNTS</h1></a>
</div>
<div class="main">
	<div class="search">
		<p>The following are the accounts related to the email: <?php echo $user['email'];?></p>
		<ul>
			<?php
			foreach($users as $username){
				echo '<li><a href="./switch.php?username='.$username.'">'.$username.'</a></li>';
			}
			?>
		</ul>
	</div>
</div>
</body>
</html>

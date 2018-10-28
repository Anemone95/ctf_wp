<?php
define('DBFILE', '/var/www/typicalc.db');
define('FLAGFILE', '/var/www/flag.txt');
define('SMTP_HOST', 'smtp.exmail.qq.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'demo@vulnspy.com');
define('SMTP_PASSWORD', 'ABCLIOEKCJIE');
define('TABLE_NAME', 'users');

set_time_limit(20);
session_start();
require_once('functions.php');
require_once('phpmailer/Exception.php');
require_once('phpmailer/OAuth.php');
require_once('phpmailer/PHPMailer.php');
require_once('phpmailer/POP3.php');
require_once('phpmailer/SMTP.php');
require_once('class.zcaptcha.php');
require_once('class.mail.php');
require_once('class.user.php');

if(!file_exists(DBFILE)){
	$dbchk = file_put_contents(DBFILE, json_encode(array()));
}else{
	$dbchk = is_writable(DBFILE);
}

if($dbchk === false){
	die("ERROR 1");
}

if(!file_exists(FLAGFILE) || !is_readable(FLAGFILE)){
	die("ERROR 2");
}

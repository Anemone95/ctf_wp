<?php
require_once('init.php');
require_once('class.zcaptcha.php');

$zCaptchaObj = new zCaptcha(80,30,4);
 
$zCaptchaObj->showImg();

$_SESSION['captcha'] = $zCaptchaObj->getCaptcha();

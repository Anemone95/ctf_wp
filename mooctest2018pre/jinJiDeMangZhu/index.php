
<!DOCTYPE HTML>
<html>
<head>
<title>乌云后台登录</title>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="后台登录" />

</head>
<body>

<?php

function dbconnection()
{
        @$con = mysql_connect("localhost","root","c2FkZmFnZGZkc3Nm");
        // Check connection
        if (!$con)
        {
                echo "Failed to connect to MySQL: " . mysql_error();
        }
        @mysql_select_db("blindsql",$con) or die ( "Unable to connect to the database");
        mysql_query("SET character set 'UTF8'");
}
function waf($id)
{
if(preg_match("/\(|\)|\\\\/", $id))
	return True;
else
	return False;
}

if(isset($_POST['username'])&&isset($_POST['password']))
{
		$hit = '';
        dbconnection();
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(waf($username))
		{
			$hit = "illegal character";
		}
		else{
			$sql="SELECT * FROM admin WHERE username='".$username."'" ;
			$result=mysql_query($sql);
			@$row = mysql_fetch_array($result);
			#$name = $row['username'];
			if(isset($row)&&$row['username']!="admin"){
				$hit = "username error!";
			}else{
				if ($row['password']===md5($password)){
					$hit = '没啥用哦，还是到数据库里拿数据吧。';
				}else{
					$hit = "password error!";
				}
			}
		}
        mysql_close();
}
?>
<!--header start here-->
<div class="login-form">
			<div class="top-login">
				<span><img src="images/group.png" alt=""/></span>
			</div>
			<h1>登录</h1>
			<div class="login-top">
			<form method="post" action="index.php" id="slick-login">
				<?php if(isset($hit))echo "<font color='#FFE7BA'><p align='center'>$hit</p></font>";?>
				<div class="login-ic">
					<i ></i>
					<input type="text" name="username" class="placeholder" placeholder="username">
					<div class="clear"> </div>
				</div>
				<div class="login-ic">
					<i class="icon"></i>
					<input type="password" name="password" class="placeholder" placeholder="password">
					<div class="clear"> </div>
				</div>
			
				<div class="log-bwn">
					<input type="submit"  value="Login" >
				</div>
				</form>
			</div>
			<p class="copy">? 安恒</p>
</div>		
<!--header start here-->
</body>
</html>
<?php
class zUser{
	private $file = DBFILE;
	private $users = array("users"=>array(), "emails"=>array(), "attrs"=>array());
	private $dbhash = null;
	
	public function get_relate_users($username){
		return zUserFile::get_relate_users($username);
	}
	
	public function is_admin($username){
		if(!zUserFile::validate_username($username)){
			return false;
		}
		$user = zUserFile::get_attrs($username);
		if($user['is_admin'] === 1)
			return true;
		return false;
	}
	
	public function verify_email($username, $token){
		if(!zUserFile::is_exists($username)){
			return false;
		}
		$token = trim($token);
		if($token == false){
			return false;
		}
		$user = zUserFile::get_attrs($username);
		$real_token = $user["token"];
		if(md5($real_token) !== md5($token)){
			return false;
		}
#FIXME
		zUserFile::update_attr($username, 'token', '');
		zUserFile::update_attr($username, 'email_verify', 1);
		return true;
	}
	
	public function chg_email($username, $email){
		if(!zUserFile::is_exists($username)){
			return false;
		}
		if($email == false || !zUserFile::validate_email($email)){
			return false;
		}
		$user = zUserFile::get_attrs($username);
		$old_email = $user['email'];
		$emails = zUserFile::get_emails();
		if(isset($emails[$old_email])){
			$emails[$old_email] = array_diff($emails[$old_email], array($username));
			if($emails[$old_email] == false){
				unset($emails[$old_email]);
			}
		}
		zUserFile::update_attr($username, 'email_verify', 0);
		zUserFile::update_attr($username, 'email', $email);
		zUserFile::update_attr($username, 'token', '');
		$us = @is_array($emails[$email])?$emails[$email]:array();
		$emails[$email] = array_merge($us, array($username));
		return zUserFile::update_emails($emails);
	}
	
	public function send_email_verify($username){
		if(!zUserFile::is_exists($username)){
			return false;
		}
		$user = zUserFile::get_attrs($username);
		$email = $user['email'];
		$token = get_salt(32);
		zUserFile::update_attr($username, 'token', $token);
		zUserFile::update_attr($username, 'email_verify', 0);
#FIXME
		$verify_url = 'http://demo.vulnspy.com/verify.php?token='.$token.'&username='.$username;
		$mail = new zMail();
		$mail->setTo($email);
		$mail->setSubject('VULNSPY EMAIL ADDRESS VERIFICATION');
		$mail->setContent($verify_url);
		return $mail->send();
	}
	
	public function is_verify($username){
		if(!zUserFile::is_exists($username)){
			return false;
		}
		$user = zUserFile::get_attrs($username);
		if($user['email_verify'] === 1)
			return true;
		return false;
	}
	
	public function auth($username, $password){
		$username = trim($username);
		if($username == false){
			return false;
		}
		if(!zUserFile::is_exists($username)){
			return false;
		}
		if(zUserFile::get_password($username) === md5($password)){
			return true;
		}
		return false;
	}
	
	public function login($username, $password){
		$username = trim($username);
		if(!zUserFile::validate_username($username)){
			return false;
		}
		if($this->auth($username, $password) === true){
			$_SESSION['username'] = $username;
			return true;
		}
		return false;
	}
	
	public function login2($username){
		$username = trim($username);
		if(!zUserFile::validate_username($username)){
			return false;
		}
		$_SESSION['username'] = $username;
		return true;
	}
	
	public function register($username, $email, $password){
		if($email == false || !zUserFile::validate_email($email)){
			return false;
		}
		if(zUserFile::is_exists($username)){
			return false;
		}
		$users = zUserFile::get_all_users();
		$users['users'][$username] = md5($password);
		$us = is_array($users['emails'][$email])?$users['emails'][$email]:array();
		$users['emails'][$email] = array_merge($us, array($username));
		$users['attrs'][$username] = array("email" => $email, "is_admin" => 0, "email_verify" => 0, "token" => "");
		return zUserFile::update_all_users($users);
	}
	
}

class zUserFile{
	public static function get_all_users(){
		$users = array();
		if(file_exists(DBFILE)){
			$c = file_get_contents(DBFILE);
			$users = json_decode($c, 1);
			if($users == false)
				$users = array();
		}
		return $users;
	}
	
	public static function update_all_users($users){
		$c = json_encode($users);
		return file_put_contents(DBFILE, $c);
	}
	
	public static function update_emails($emails){
		$users = zUserFile::get_all_users();
		$users['emails'] = $emails;
		$c = json_encode($users);
		return file_put_contents(DBFILE, $c);
	}
	
	public static function get_emails(){
		$users = zUserFile::get_all_users();
		return $users['emails'];
	}
	
	public static function update_attr($username, $key, $value){
		$users = zUserFile::get_all_users();
		if(!zUserFile::is_exists($username)){
			return false;
		}
		$users['attrs'][$username][$key] = $value;
		$c = json_encode($users);
		return file_put_contents(DBFILE, $c);
	}
	
	public static function validate_email($email){
		if(strlen($email) > 100)
			return false;
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
	public static function validate_username($username){
		if(strlen($username) > 100)
			return false;
		if (preg_match('/^[_\.\-0-9a-zA-Z]+$/i', $username)) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function get_password($username){
		$users = zUserFile::get_all_users();
		if(!zUserFile::is_exists($username)){
			return false;
		}
		return $users['users'][$username];
	}
	
	public static function is_exists($username){
		$users = zUserFile::get_all_users();
		if(!zUserFile::validate_username($username)){
			return false;
		}
		if($username == false){
			return false;
		}
		return isset($users['users'][$username]);
	}
	
	public static function get_attrs($username){
		$users = zUserFile::get_all_users();
		if(!zUserFile::is_exists($username)){
			return false;
		}
		return $users['attrs'][$username];
	}
	
	public static function get_relate_users($username){
		$users = zUserFile::get_all_users();
		if(!zUserFile::validate_username($username)){
			return false;
		}
		$user = zUserFile::get_attrs($username);
		if($user['email_verify'] !== 1){
			return array($username);
		}
		$email = $user['email'];
		return $users['emails'][$email];
	}
}

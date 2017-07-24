<?php

class User{
	protected $UserName;
	protected $Password;
	protected $Email;


	function __construct($usrName, $psswrd, $Eml){
		$this->UserName = $usrName;
		$this->Password = $psswrd;
		$this->Email = $Eml;
	}

	public function insertUser($db){
		$sql = "insert into User (UserName, Password, Email) values ('$this->UserName', '$this->Password', '$this->Email')";
		$result = $db->query($sql);
	}

	public static function checkUser($db, $usrName){
		$sql = "select UserName from User where UserName = '$usrName'";
		$result = $db->query($sql);
		$row = $result->fetch();
		return $row;
	}

	public static function checkEmail($db, $email){
		$sql = "select Email from User where Email = '$email'";
		$result = $db->query($sql);
		$row = $result->fetch();
		return $row;
	}

	public static function getPassword($db, $usrName){
		$sql = "select Password from User where UserName = '$usrName'";
		$result = $db->query($sql);
		$row = $result->fetch();
		return $row['Password'];
	}

	public static function displayUser($db){

		session_save_path('./');
		session_start();

		$uname = $_SESSION['userName'];
		echo 'you are logged in as ' . $uname ;
				
	}
}


?>
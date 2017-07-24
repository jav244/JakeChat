<?php
include_once('User.php');
include_once('MySQLDB.php');
require('db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	try {
		//validate username
		$userName = filter_input(INPUT_POST, 'registerUsrName');
		$userNameCheck = User::checkUser($db, $userName);
		if (!$userName) {
			throw new Exception("enter a user name");
		}
		if($userNameCheck){
			throw new Exception("User name '$userName' already exists, choose another");
		}

	//validate email
	$email = filter_input(INPUT_POST, 'registerEmail', FILTER_VALIDATE_EMAIL);
	if (!$email){
		throw new Exception('invalid email');
	}

	//validate password
	$password = filter_input(INPUT_POST, 'registerPassword');
	if(!$password || strlen($password) < 8){
		throw new Exception('Password must contain 8+ characters' . strlen($password));
	}

	//create a password hash
	$passwordHash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
	if ($passwordHash === false){
		throw new Exception('Password hash failed');
	}

	// create user account 
	$user = new User($userName, $passwordHash, $email);
	$user->insertUser($db);

	session_save_path('./');
    session_start();

    //save login to session
    $_SESSION['userName'] = $userName;

	//redirect to login page 
	header('HTTP/1.1 302 Redirect');
	header('Location: index.html');
	} catch(Exception $e) {
		//report error
		header('index.html');
		echo $e->getMessage();
		//echo $userName . $password . $email;
}
}



?>
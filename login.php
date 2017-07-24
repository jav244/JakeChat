<?php
include_once 'MYSQLDB.php';
require 'db.php';
require 'User.php';

session_save_path('./');
session_start();
session_unset();
session_destroy();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    if($_SERVER['QUERY_STRING']){
  try{

    // get user name from request body
    $userName = filter_input(INPUT_POST, 'loginUsrName');

    //get password from request body
    $password = filter_input(INPUT_POST, 'loginPassword');

    //find account with user name
    $user = User::getPassword($db, $userName);

    if(password_verify($password, $user) == false){
      throw new Exception ('not a valid username, password combination');
    }

    session_save_path('./');
    session_start();

    //save login to session
    $_SESSION['user_logged_in'] = TRUE;
    $_SESSION['userName'] = $userName;

    //redirect
    header('HTTP?1.1 302 Redirect');
    header('Location: index.html');
  } catch ( Exception $e){
    //header('HTTP/1.1 401 Unauthorized');
    echo $e->getMessage();
  }

} 
?>

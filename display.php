<?php
include_once('Message.php');
require('MySQLDB.php');
require('db.php');

$db->selectDatabase();

    session_save_path('./');
    session_start();

    $userName = '';

    if(isset($_SESSION['userName'])){
    	$userName = $_SESSION['userName'];
    }
	
  //$html = new getHtml($locale, $db, $userName);

	Message::displayMessages($db, $userName);

?>
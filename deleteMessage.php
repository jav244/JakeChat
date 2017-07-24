<?php
include_once('MySQLDB.php');
include_once('db.php');
include_once('Message.php');

    //session_save_path('./');
    //session_start();

	//$userName = $_SESSION['userName'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   	$msgId = filter_input(INPUT_POST, 'msgId');

	Message::deleteMessage($db, $msgId);

}



?>
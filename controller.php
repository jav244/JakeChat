<?php
include_once('MySQLDB.php');
include_once('db.php');
include_once('Message.php');
include_once('getHtml.php');

    session_save_path('./');
    session_start();

    $userName = '';

    if(isset($_SESSION['userName'])){
    	$userName = $_SESSION['userName'];
    } 



    if(isset($_SESSION['locale'])){
        $locale = $_SESSION['locale'];
    } else {
        $locale = 'en';
    }
    
	
    $badWords = array(
        "fuck" => "f***", 
        "shit" => "s***",
        "bitch" => "b****"
        );


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = filter_input(INPUT_POST, 'id');

    if ($id == "init"){
        $html = new getHtml($locale, $db, $userName);
        echo $html->HtmlStructure();
    }
    else if($id = "msg"){
        $newMsg = filter_input(INPUT_POST, 'msg');

        if($newMsg != '')
        {
            $cleanMsg = strtr($newMsg, $badWords);

            $msgObj = new Message($cleanMsg, $userName, $db);
            $msgObj->insertMessage();
        }
    }
}


//Message::displayMessages($db, $userName);
//$messages = getMessages($db);
//$messages->fetch();
//echo $messages;




?>
<?php

interface IMessage
{
    public function insertMessage();
    public static function deleteMessage($db, $msgId);
    public static function displayMessages($db, $usrName);
}


?>
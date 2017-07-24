<?php

interface IUser
{
   public function insertUser($db);
    public static function checkUser($db, $usrName);
    public static function checkEmail($db, $email);
    public static function getPassword($db, $usrName);
}


?>
<?php
$host = 'localhost' ;
$dbUser ='root';
$dbPass ='';
$dbName ='JakeChat';
 
$db = new MySQL( $host, $dbUser, $dbPass, $dbName ) ;
$db->selectDatabase();
?>

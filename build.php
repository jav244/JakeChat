<?php
include_once 'MySQLDB.php';
require 'db.php';

//  drop database
$db->dropDatabase();
//  create the database again
$db->createDatabase();
// select the database
$db->selectDatabase();

// drop the tables
$sql = "drop table if exists User";
$result = $db->query($sql);

$sql = "drop table if exists Message";
$result = $db->query($sql);


// create the tables
$sql = "create table User(
  UserName varchar(10),
  Password varchar(255),
  Email varchar(320) unique,
  primary key(UserName)
) engine = innodb;";

$result = $db->query($sql);
if ( $result )
{
    echo 'the User table was added<br>';
}
else
{
    echo 'the User table was not added<br>';
}

$sql = "create table Message(
  MessageId int not null auto_increment,
  UserName varchar(10),
  Message text not null,
  Time datetime not null default now(),
  foreign key(UserName) references User(UserName),
  primary key(MessageId)
) engine = innodb;";
							 
//  execute the sql query
$result = $db->query($sql);
if ( $result )
{
   echo 'the Message table was added<br>';
}
else
{
   echo 'the Message table was not added<br>';
}

?>
<html>

<a href="index.html">back home</a>
</html>

<?php
include_once('IMessage.php');

class Message implements IMessage
	{
	protected $Message;
	protected $UserName;
	protected $db;


	function __construct($msg, $usrName, $db){
		$this->Message = urldecode($msg);
		$this->UserName = $usrName;
		$this->db = $db;
	}

	function insertMessage(){
		$sql = "INSERT into Message (UserName, Message) values ('$this->UserName', '$this->Message')";
		$result = $this->db->query($sql);
	}

	public static function deleteMessage($db, $msgId){
		$sql = "DELETE FROM `message` WHERE `message`.`MessageId` = '$msgId'";
		$result = $db->query($sql);
		//echo 'hey';
	}

	public static function displayMessages($db, $usrName){

		$sql = "SELECT messageId, time(time) as Time, date(time) as Date, UserName, Message from Message 
				WHERE date(time) >= CURDATE() - 1
				order by date ASC, time ASC";
		$result = $db->query($sql);
		global $date;


		if ($result) {
			while ($row = $result->fetch()) {

				$user = $row['UserName'];
				$msg = $row['Message'];
				$time = $row['Time'];
				$messageId = $row['messageId'];
				
				if($date != $row['Date'])
				{
					$date = $row['Date'];
					echo '<div id="date">' . $date . ' &#x21E9;</div>';
				}

				echo '<div class = "msgDiv" id="' . $messageId . ' ' . $user . '"> <div class = "time">' . $time;
				if($user == $usrName){
					echo '<button id = "' .$messageId. '" class="btn btn-danger btn-xs"> x </button>';
				}
				echo '</div><div class="msg">';
				echo '<b>' . $user . '</b>';
				echo ': ';
				echo $msg;
				echo '</div></div><br>';

			}
			if($usrName != ''){
					echo '<div id = "loginName"> Logged in as ' . $usrName . '<?div>';
				}
		}
	}
}

?>
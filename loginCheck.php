<?php

header ('Content-Type: application/json');



if(isset($_POST['action']) && $_POST['action'] == 'session'){

	
	  session_save_path('./');
	  session_start();

	  

	  if(isset($_SESSION['userName'])){

	  	$isLoggedIn = true;

	  	$status = ["logStatus" => $isLoggedIn];

	  	echo json_encode($status);
	  	//return json_encode(array("sessionvalue" => $_SESSION['userName']))
	    
	}
	

}



?>
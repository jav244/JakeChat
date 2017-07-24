<?php

session_save_path('./');
session_start();

$locale = 'en';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$locale = filter_input(INPUT_POST, 'localeId');
	$_SESSION['locale'] = $locale;
}


?>
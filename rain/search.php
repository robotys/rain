<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	include('lib/functions.php');


	// redirect to real link
	if($_SERVER['REQUEST_URI'] == '/search' AND array_key_exists('phrase', $_POST) !== FALSE){
		$url = '/search/'.$_POST['phrase'];

		header('Location: '.$url);
	}

	$settings = settings();
	include('theme/'.$settings['theme'].'/index.php');
?>
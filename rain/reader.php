<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	include('lib/functions.php');

	$settings = settings();
	$_SESSION['post_slug'] = str_replace('/read/', '', $_SERVER['REQUEST_URI']);
	include('theme/'.$settings['theme'].'/single.php');
?>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	include('lib/functions.php');

	$settings = settings();
	include('theme/'.$settings['theme'].'/index.php');
?>
<?php
	require_once "class/Connect.php";
  	require_once "class/User.php";

  	$user = new User($db);
  	
  	$user->logout();

    // Redirect ke login
    header('location: index.php');
?>
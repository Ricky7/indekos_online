<?php  
  
    require_once "../class/Connect.php";
   	require_once "../class/Seller.php";

  	$seller = new Seller($db);

    $seller->logout();

    // Redirect ke login
    header('location: lapak_login.php');
 ?>
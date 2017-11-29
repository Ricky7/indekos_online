<?php  
  
    require_once "../class/Connect.php";
  	require_once "../class/Admin.php";

  	$admin = new Admin($db);

    $admin->logout();

    // Redirect ke login
    header('location: adm_login.php');
 ?>
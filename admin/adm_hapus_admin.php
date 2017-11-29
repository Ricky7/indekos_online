<?php

  require_once "../class/Connect.php";
  require_once "../class/Admin.php";

  $admin = new Admin($db);
  $datas = $admin->getAdmin();

  $admin->cekLogin();
    
  if(isset($_REQUEST['id'])) {

  	echo $id = $_REQUEST['id'];

      try {
          $admin->delAdmin($id);
          header("Location: adm_data_admin.php");
      } catch (Exception $e) {
          die($e->getMessage());
      }
  }
    
?>
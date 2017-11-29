<?php

  require_once "../class/Connect.php";
  require_once "../class/Seller.php";
  require_once "../class/Indekos.php";

  $seller = new Seller($db);
  $datas = $seller->getSeller();
  $getID = $datas['id_seller'];

  $seller->cekSellerLogin();

  $indekos = new Indekos($db);
    
    if(isset($_REQUEST['id'])) {

    	echo $id = $_REQUEST['id'];

        try {
            $indekos->hapusIndekos($id);
            header("Location: lapak_list_indekos.php");
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
?>
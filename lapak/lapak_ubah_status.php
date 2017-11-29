<?php

  require_once "../class/Connect.php";
  require_once "../class/Seller.php";
  require_once "../class/Indekos.php";

  $seller = new Seller($db);
  $datas = $seller->getSeller();
  $getID = $datas['id_seller'];

  $seller->cekSellerLogin();

  $indekos = new Indekos($db);
    
    if(isset($_REQUEST['id']) && isset($_REQUEST['stat'])) {

        $id = $_REQUEST['id'];
        $stat = $_REQUEST['stat'];

        if($stat == 0) {
          $x = 1;
        } else {
          $x = 0;
        }

        try {
            $indekos->ubahStatus($id, $x);
            header("Location: lapak_info_indekos.php?id=$id");
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
?>
<?php

    require_once "class/Connect.php";
    require_once "class/User.php";
    require_once "class/Indekos.php";
    require_once "class/Booking.php";

    $user = new User($db);
    $datas = $user->getUser();

    $user->cekUserLogin();

    $indekos = new Indekos($db);
    $booking = new Booking($db);
    
    if(isset($_REQUEST['id'])) {

    	echo $id = $_REQUEST['id'];

        try {
            $booking->hapusCart($id);
            header("Location: cart.php");
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
?>
<?php

  require_once "../class/Connect.php";
  require_once "../class/Admin.php";
  require_once "../class/Booking.php";

  $admin = new Admin($db);
  $datas = $admin->getAdmin();

  $admin->cekLogin();

  $booking = new Booking($db);
    
  if(isset($_REQUEST['id'])) {

  	  $id = $_REQUEST['id'];

      try {
          $booking->hapusBooking($id);
          header("Location: adm_booking_unpaid.php");
      } catch (Exception $e) {
          die($e->getMessage());
      }
  }
    
?>
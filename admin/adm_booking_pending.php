<?php

  require_once "../class/Connect.php";
  require_once "../class/Admin.php";
  require_once "../class/Booking.php";

  $admin = new Admin($db);
  $datas = $admin->getAdmin();

  $admin->cekLogin();

  $booking = new Booking($db);

?>

<?php
  include "adm_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li class="active">Daftar Booking Pending</li>
    </ol>
    <div class="col-md-12">
      <h4 align="center">Daftar Booking yang sudah dibayar</h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <th>Judul Iklan</th>
            <th>Waktu Booking</th>
            <th>Biaya Booking</th>
            <th>Status</th>
          </thead>
          <tbody>
            <?php
              $query = "SELECT * FROM tbl_booking INNER JOIN tbl_indekos
              ON (tbl_booking.id_indekos=tbl_indekos.id_indekos) WHERE tbl_booking.status_booking = 'PENDING'";       
              $records_per_page=10;
              $newquery = $booking->paging($query,$records_per_page);
              $booking->daftarBookingPending($newquery);
             ?>
             <tr>
                <td colspan="4" align="center">
              <div class="pagination-wrap">
                    <?php $booking->paginglink($query,$records_per_page); ?>
                  </div>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


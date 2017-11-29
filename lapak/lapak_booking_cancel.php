<?php

  require_once "../class/Connect.php";
  require_once "../class/Seller.php";
  require_once "../class/Indekos.php";
  require_once "../class/Booking.php";

  $seller = new Seller($db);
  $datas = $seller->getSeller();
  $getID = $datas['id_seller'];

  $seller->cekSellerLogin();

  $indekos = new Indekos($db);
  $booking = new Booking($db);

?>
<?php
  include "lapak_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="lapak_booking_paid.php">Segera Konfirmasi</a></li>
      <li><a href="lapak_booking_confirmed.php">Request Pembayaran</a></li>
      <li><a href="lapak_booking_process.php">Sedang diproses</a></li>
      <li><a href="lapak_booking_completed.php">Selesai</a></li>
      <li class="active">Cancel/Gagal</li>
    </ol>
    <div class="col-md-12">
      <div class="panel panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Cancel/Gagal</h3>
        </div>

          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Uang Muka</th>
                <th>Status</th>
              </thead>
              <tbody>
                <?php
                  $query = "SELECT * FROM tbl_booking INNER JOIN tbl_indekos ON (tbl_booking.id_indekos=tbl_indekos.id_indekos) 
                  WHERE (tbl_booking.id_penjual, tbl_booking.status_booking) IN (({$getID}, 'CANCEL'), ({$getID}, 'FAILED'))";       
                  $records_per_page=10;
                  $newquery = $booking->paging($query,$records_per_page);
                  $booking->daftarBookingSeller($newquery);
                 ?>
                 <tr>
                    <td colspan="8" align="center">
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
</div>

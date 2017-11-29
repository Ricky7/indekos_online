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
<link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li class="active">Daftar Booking Unpaid</li>
    </ol>
    <div class="col-md-12">
      <h4 align="center">Daftar Booking yang belum dibayar</h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <th>Judul Iklan</th>
            <th>Waktu Booking</th>
            <th>Biaya Booking</th>
            <th>Opsi</th>
          </thead>
          <tbody>
            <?php
              $query = "SELECT * FROM tbl_booking INNER JOIN tbl_indekos
              ON (tbl_booking.id_indekos=tbl_indekos.id_indekos) WHERE tbl_booking.status_booking = 'UNPAID'
              ORDER BY tbl_booking.tgl_booking desc";       
              $records_per_page=10;
              $newquery = $booking->paging($query,$records_per_page);
              $booking->daftarBookingUnpaid($newquery);
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
<!-- Modal Delete -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
        
            <div class="modal-body">
                <p>Apakah anda yakin?</p>
                <!-- <p class="debug-url"></p>
 -->            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-warning btn-ok">Hapus</a>
            </div>
        </div>
    </div>
</div>
<!-- diletak dibawah agar tidak bentrok -->
<script type="text/javascript">
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    
    $('.debug-url').html('Alamat ID: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');

});
</script>

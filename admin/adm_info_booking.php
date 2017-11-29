<?php

  require_once "../class/Connect.php";
  require_once "../class/Admin.php";
  require_once "../class/Booking.php";

  $admin = new Admin($db);
  $datas = $admin->getAdmin();

  $admin->cekLogin();

  $booking = new Booking($db);

  if(isset($_REQUEST['id'])) {

    $id_booking = $_REQUEST['id'];
    extract($booking->getBookingByID($id_booking));
  }


  $jumlah_desimal = "0";
  $pemisah_desimal = ",";
  $pemisah_ribuan = ".";

  if(isset($_POST['submit'])) {

      try {
        $booking->setStatus($_POST['status'], $id_booking);
        header("Location: adm_booking_pending.php");
      } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  if(isset($_POST['bayar'])) {

      try {
        $booking->setStatus($_POST['status'], $id_booking);
        header("Location: adm_booking_process.php");
      } catch (Exception $e) {
      die($e->getMessage());
    }
  }
?>

<?php
  include "adm_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="adm_booking_pending.php">Daftar Booking Pending</a></li>
      <li class="active">Informasi Booking</li>
    </ol>
    <div class="col-md-6">
      <h4 align="center">Informasi Booking</h4>
      <table class="table table-hover">
        <thead>
          <th>Judul</th>
          <th>Isi</th>
        </thead>
        <tbody>
          <tr>
            <td>Waktu Booking</td>
            <td><?php echo $tgl_booking ?></td>
          </tr>
          <tr>
            <td>Durasi Sewa</td>
            <td><?php echo $durasi.' Bulan' ?></td>
          </tr>
          <tr>
            <td>Biaya Booking</td>
            <td><?php print('Rp. '.number_format($biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
          </tr>
          <tr>
            <td>Total Biaya</td>
            <td><?php print('Rp. '.number_format($total_biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
          </tr>
          <tr>
            <td>Pajak 10%</td>
            <td><?php print('Rp. '.number_format($pajak,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
          </tr>
          <tr>
            <td>Nama Bank</td>
            <td><?php echo $nama_bank ?></td>
          </tr>
          <tr>
            <td>Nama Rekening</td>
            <td><?php echo $nama_rek ?></td>
          </tr>
          <tr>
            <td>No Rekening</td>
            <td><?php echo $no_rek ?></td>
          </tr>
          <tr>
            <td>Nilai Transfer</td>
            <td><?php print('Rp. '.number_format($nilai,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
          </tr>
          <tr>
            <td>Note Transfer</td>
            <td><?php echo $note_transfer ?></td>
          </tr>
          <tr>
            <td>Status Booking</td>
            <td>
              <?php
                switch ($status_booking) {
                  case 'PENDING':
                    ?>
                      <font color="BLUE"><?php echo $status_booking ?></font>
                    <?php
                    break;
                  
                   case 'PROCESS':
                    ?>
                      <font color="BLUE">MENUNGGU PEMBAYARAN</font>
                    <?php
                    break;
                }
              ?>
              
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <h4 align="center">Informasi Indekos</h4>
      <table class="table table-hover">
        <thead>
          <th>Judul</th>
          <th>Isi</th>
        </thead>
        <tbody>
          <tr>
            <td>Gambar</td>
            <td><img src="../assets/img_indekos/<?php echo $gambar ?>" class="img-responsive" width="40%" height="40%"></td>
          </tr>
          <tr>
            <td>Judul Iklan</td>
            <td><?php echo $judul ?></td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td><?php echo $kelas ?></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td><?php print('Rp. '.number_format($harga,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td><?php echo $alamat ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <?php
      switch ($status_booking) {
        case 'PENDING':
          ?>
            <div class="col-md-4 col-md-offset-4" style="padding-bottom:50px;">
              <h4 align="center">Konfirmasi Booking</h4>
              <form method="post">
                <div class="form-group" align="center" style="width:360px;">
                  <select class="form-control" name="status" required>
                    <option></option>
                    <option value="PENDING">Dibatalkan</option>
                    <option value="PAID">Disetujui</option>
                  </select>
                </div>

                <center>
                  <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </center>
              </form>  
            </div>
          <?php
          break;

        case 'PROCESS':
          ?>
            <div class="col-md-4 col-md-offset-4" style="padding-bottom:50px;">
              <h4 align="center">Teruskan Pembayaran</h4>
              <form method="post">
                <div class="form-group" align="center" style="width:360px;">
                  <select class="form-control" name="status" required>
                    <option></option>
                    <option value="PAYING">Bayar</option>
                  </select>
                </div>

                <center>
                  <button type="submit" name="bayar" class="btn btn-success">Submit</button>
                </center>
              </form>  
            </div>
          <?php
          break;
        
      }
    ?>
    
  </div>
</div>


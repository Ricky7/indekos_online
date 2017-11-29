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

  if(isset($_REQUEST['id'])) {

    $id_booking = $_REQUEST['id'];
    extract($booking->getBookingByID($id_booking));
    extract($booking->getBuyerByID($id_pembeli));
  }

  $jumlah_desimal = "0";
  $pemisah_desimal = ",";
  $pemisah_ribuan = ".";

  if(isset($_POST['submit'])) {

      try {
        $booking->setStatus($_POST['status'], $id_booking);
        header("Location: lapak_booking_paid.php");
      } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  if(isset($_POST['request'])) {

      try {
        $booking->setKode($_POST['kode'], $id_booking);
        //header("Location: lapak_booking_confirmed.php");
      } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  if(isset($_POST['paying'])) {

      try {
        $booking->setStatus($_POST['status'], $id_booking);
        header("Location: lapak_booking_completed.php");
      } catch (Exception $e) {
      die($e->getMessage());
    }
  }

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
      <li><a href="lapak_booking_cancel.php">Cancel/Gagal</a></li>
      <li class="active">Informasi Booking</li>
    </ol>

    <div class="col-md-12">
      <div class="panel panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Informasi Indekos</h3>
        </div>
        
        <div class="col-md-4 col-md-offset-4" style="padding-bottom:10px;padding-top:20px;">
          <center>
            <img src="../assets/img_indekos/<?php echo $gambar ?>" class="img-responsive">
          </center>
        </div>

        <div class="col-md-2 col-md-offset-3">
          <center>
            <img src="../assets/img_indekos/<?php echo $gambar_1 ?>" class="img-responsive">
          </center>
        </div>

        <div class="col-md-2">
          <center>
            <img src="../assets/img_indekos/<?php echo $gambar_2 ?>" class="img-responsive">
          </center>
        </div>

        <div class="col-md-2">
          <center>
            <img src="../assets/img_indekos/<?php echo $gambar_3 ?>" class="img-responsive">
          </center>
        </div>

        <div class="col-md-5 col-md-offset-1" style="padding-top:30px;">
          <div class="panel-heading" style="background:#026466;">
            <h3 class="panel-title" style="color:#fff;">Informasi Indekos</h3>
          </div>

          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Judul</td>
                  <td><?php echo $judul ?></td>
                </tr>
                <tr>
                  <td>Kelas</td>
                  <td><?php echo $kelas ?></td>
                </tr>
                <tr>
                  <td>Biaya</td>
                  <td><?php echo number_format($harga,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan).' / bulan'; ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td><?php echo $alamat ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="panel-heading" style="background:#026466;">
            <h3 class="panel-title" style="color:#fff;">Informasi Booking</h3>
          </div>

          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Nama Pemesan</td>
                  <td><?php echo $nama ?></td>
                </tr>
                <tr>
                  <td>No Kontak</td>
                  <td><?php echo $no_hp ?></td>
                </tr>
                <tr>
                  <td>Tanggal Booking</td>
                  <td><?php echo $tgl_booking ?></td>
                </tr>
                <tr>
                  <td>Biaya Booking</td>
                  <td><?php echo number_format($biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                </tr>
                <tr>
                  <td>Pajak 10%</td>
                  <td><?php echo number_format($pajak,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                </tr>
                <tr>
                  <td>Durasi Sewa</td>
                  <td><?php echo $durasi.' / bulan' ?></td>
                </tr>
                <tr>
                  <td>Total Biaya</td>
                  <td><?php echo number_format($total_biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        

        <?php
          switch ($status_booking) {
            case 'PAID':
              ?>
                <div class="col-md-5 col-md-offset-1" style="padding-top:30px;">
                  <div class="panel-heading" style="background:#026466;">
                    <h3 class="panel-title" style="color:#fff;">Konfirmasi Ketersediaan</h3>
                  </div>

                  <form method="post">
                    <div class="col-md-12" style="padding-top:30px;">
                      <select class="form-control" name="status" required>
                        <option></option>
                        <option value="CANCEL">Batalkan</option>
                        <option value="CONFIRMED">Setujui</option>
                      </select>
                    </div>

                    <div class="col-md-12" style="padding-top:20px;">
                      <center>
                        <button type="submit" name="submit" class="btn" style="background:#026466;color:#fff;">Submit</button><br>
                      </center>
                    </div>
                  </form>
                </div>
              <?php
              break;
            
            case 'CONFIRMED':
              ?>
                <div class="col-md-5 col-md-offset-1" style="padding-top:30px;">
                  <div class="panel-heading" style="background:#026466;">
                    <h3 class="panel-title" style="color:#fff;">Request Pembayaran</h3>
                  </div>

                  <form method="post">
                    <div class="col-md-12" style="padding-top:30px;">
                      <small>Masukkan Kode Booking disini</small>
                      <input type="text" class="form-control" name="kode" required>
                    </div>

                    <div class="col-md-12" style="padding-top:20px;">
                      <center>
                        <button type="submit" name="request" class="btn" style="background:#026466;color:#fff;">Submit</button><br>
                      </center>
                    </div>
                  </form>
                </div>
              <?php
              break;

            case 'PAYING':
              ?>
                <div class="col-md-5 col-md-offset-1" style="padding-top:30px;">
                  <div class="panel-heading" style="background:#026466;">
                    <h3 class="panel-title" style="color:#fff;">Ditransfer Melalui Rekening</h3>
                  </div>
                  <table class="table table-hover">
                    <thead>
                      <th>Nama Bank</th>
                      <th>Atas Nama</th>
                      <th>No Rekening</th>
                    </thead>
                    <tbody>
                      <tr>
                          <td>BRI</td>
                          <td>Masran Pratama</td>
                          <td>0857674655747</td>
                      </tr>
                      <tr>
                          <td>BNI</td>
                          <td>Masran Pratama</td>
                          <td>8576947594747</td>
                      </tr>
                      <tr>
                          <td>BCA</td>
                          <td>Masran Pratama</td>
                          <td>4795650365464</td>
                      </tr>
                      <tr>
                          <td>CIMB</td>
                          <td>Masran Pratama</td>
                          <td>8425834624845</td>
                      </tr>
                      <tr>
                          <td>MANDIRI</td>
                          <td>Masran Pratama</td>
                          <td>7678846635355</td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="panel-heading" style="background:#026466;">
                    <h3 class="panel-title" style="color:#fff;">Konfirmasi Pembayaran</h3>
                  </div>

                  <form method="post">
                    <div class="col-md-12" style="padding-top:30px;">
                      <select class="form-control" name="status" required>
                        <option></option>
                        <option value="COMPLETED">Lunas, Transaksi Selesai</option>
                      </select>
                    </div>

                    <div class="col-md-12" style="padding-top:20px;">
                      <center>
                        <button type="submit" name="paying" class="btn" style="background:#026466;color:#fff;">Submit</button><br>
                      </center>
                    </div>
                  </form>
                </div>
              <?php
              break;
          }
        ?>
          

      </div>
    </div>
  </div>
</div>

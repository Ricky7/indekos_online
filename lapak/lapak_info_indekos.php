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

    $id_indekos = $_REQUEST['id'];
    extract($indekos->getProdukID($id_indekos));
  }

  $jumlah_desimal = "0";
  $pemisah_desimal = ",";
  $pemisah_ribuan = ".";
?>
<?php
  include "lapak_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="lapak_list_indekos.php">Daftar Indekos</a></li>
      <li><a href="lapak_input_indekos.php">Input Indekos</a></li>
      <li class="active">Informasi Indekos</li>
    </ol>
    <div class="col-md-12">
      <div class="panel panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Informasi Indekos</h3>
        </div>
        <!-- Buka/Tutup Toko -->
          <?php
            if($status == 0) {

              ?>
                <div class="col-md-12" style="padding-top:20px;">
                  <center>
                    <h3><?php echo $judul; ?></h3>
                  </center>
                </div>

                <div class="col-md-4 col-md-offset-4" style="padding-bottom:10px;">
                  <center>
                    <img src="../assets/images/close-icon.png" class="img-responsive">
                  </center>
                </div>

                <div class="col-md-6 col-md-offset-3">
                  <center>
                    <a href="lapak_ubah_status.php?id=<?php echo $id_indekos; ?>&stat=<?php echo $status; ?>" class="btn" style="background:#026466;color:#fff;" onclick="return confirm('Apa anda yakin ?');">Buka Iklan</a>
                  </center>
                </div>
              <?php
            } else {

              ?>
                <div class="col-md-4 col-md-offset-4" style="padding-bottom:10px;padding-top:20px;">
                  <center>
                    <img src="../assets/img_indekos/<?php echo $gambar ?>" class="img-responsive">
                  </center>
                </div>
                <!-- Cek ada tidaknya gambar pendukung -->
                <?php
                  if($gambar_1 == NULL && $gambar_2 == NULL && $gambar_3 == NULL) {
                    ?>
                      <div class="col-md-6 col-md-offset-3">
                        <center>
                          <a href="lapak_tambah_foto.php?id=<?php echo $id_indekos ?>" class="btn" style="background:#026466;color:#fff;">Tambah Foto</a>
                        </center>
                      </div>
                    <?php
                  } else {
                    ?>
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

                      <div class="col-md-6 col-md-offset-3">
                        <center>
                          <a href="lapak_tambah_foto.php?id=<?php echo $id_indekos ?>" class="btn" style="background:#026466;color:#fff;padding-top:10px;">Ubah Foto</a>
                        </center>
                      </div>
                    <?php
                  }
                ?>
                <div class="col-md-5 col-md-offset-1" style="padding-top:30px;">
                  <div class="panel-heading" style="background:#026466;">
                    <h3 class="panel-title" style="color:#fff;">Informasi</h3>
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
                        <tr>
                          <td colspan="2">
                            <center>
                              <a href="lapak_ubah_status.php?id=<?php echo $id_indekos; ?>&stat=<?php echo $status; ?>" class="btn" style="background:#026466;color:#fff;" onclick="return confirm('Apa anda yakin ?');">Tutup Iklan</a>
                            </center>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-md-5" style="padding-top:30px;">
                  <div class="panel-heading" style="background:#026466;">
                    <h3 class="panel-title" style="color:#fff;">Deskripsi</h3>
                  </div>
                  <p><?php echo $deskripsi ?></p>
                </div>
                    <?php
                  }
                ?>
          

        </div>
    </div>
  </div>
</div>

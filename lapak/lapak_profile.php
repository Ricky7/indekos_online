<?php

  require_once "../class/Connect.php";
  require_once "../class/Seller.php";

  $seller = new Seller($db);
  $datas = $seller->getSeller();
  $getID = $datas['id_seller'];

  $seller->cekSellerLogin();

  if(isset($_POST['submit'])) {

      try {
        $seller->updateSeller(array(
          'nama' => $_POST['nama'],
          'no_hp' => $_POST['no_hp'],
          'alamat' => htmlspecialchars($_POST['alamat'], ENT_QUOTES),
          'no_rek' => $_POST['no_rek'],
          'nama_rek' => $_POST['nama_rek'],
          'bank_rek' => $_POST['bank_rek'],
          'koor_lat' => $_POST['koor_lat'],
          'koor_long' => $_POST['koor_long']
        ),$getID);
        header("Refresh:0");
      } catch (Exception $e) {
      die($e->getMessage());
    }
  }

?>
<?php
  include "lapak_header.php";
?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="../assets/dist/jquery.addressPickerByGiro.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7zVeusOAU0YBF9JtwV97OXVM9dowacso&sensor=false&language=en"></script>
<link href="../assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li class="active">Profil Saya</li>
      <li><a href="lapak_ubah_pass.php">Ganti Password</a></li>
    </ol>
    <div class="col-md-4">
      <div class="panel panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Data Profil</h3>
        </div>

        <!-- Table -->
        <table class="table">
          <thead>
            <th>Judul</th>
            <th>Isi</th>
          </thead>
          <tbody>
            <tr>
              <td>Nama</td>
              <td><?php echo $datas['nama'] ?></td>
            </tr>
            <tr>
              <td>Username</td>
              <td><?php echo $datas['username'] ?></td>
            </tr>
            <tr>
              <td>No Handphone</td>
              <td><?php echo $datas['no_hp'] ?></td>
            </tr>
            <tr>
              <td>No Rekening</td>
              <td><?php echo $datas['no_rek'] ?></td>
            </tr>
            <tr>
              <td>Nama Rekening</td>
              <td><?php echo $datas['nama_rek'] ?></td>
            </tr>
            <tr>
              <td>Bank Rekening</td>
              <td><?php echo $datas['bank_rek'] ?></td>
            </tr>
            <tr>
              <td>Tanggal Join</td>
              <td><?php echo $datas['tgl_registrasi'] ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td><?php echo $datas['alamat'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-8">
      <div class="panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Edit Profil</h3>
        </div>

        <form method="post">
          <div class="form-group col-md-4">
            <small>Nama</small>
            <input type="text" class="form-control" value="<?php echo $datas['nama'] ?>" name="nama" required>
          </div>
          <div class="form-group col-md-4">
            <small>No Handphone</small>
            <input type="text" class="form-control" value="<?php echo $datas['no_hp'] ?>" name="no_hp" required>
          </div>
          <div class="form-group col-md-4">
            <small>No Rekening</small>
            <input type="text" class="form-control" value="<?php echo $datas['no_rek'] ?>" name="no_rek" required>
          </div>
          <div class="form-group col-md-4">
            <small>Nama Rekening</small>
            <input type="text" class="form-control" value="<?php echo $datas['nama_rek'] ?>" name="nama_rek" required>
          </div>
          <div class="form-group col-md-4">
            <small>Bank Rekening</small>
            <select class="form-control" name="bank_rek" required>
              <option value="<?php echo $datas['bank_rek'] ?>"><?php echo $datas['bank_rek'] ?></option>
              <option value="BCA">BCA</option>
              <option value="BNI">BNI</option>
              <option value="BRI">BRI</option>
              <option value="MANDIRI">MANDIRI</option>
            </select>

            <input type="hidden" name="koor_lat" class="form-control latitude" id="latitude" value="<?php echo $datas['x_lat']; ?>" required>
            <input type="hidden" name="koor_long" class="form-control longitude" id="longitude" value="<?php echo $datas['x_long']; ?>" required>
          </div>

          <div class="form-group col-md-12">
            <div class="span9">
            <div class="row-fluid">
              <small>Alamat</small>
              <div class="controls">
                <input type="text" name="alamat" class="inputAddress input-xxlarge form-control" value="<?php echo $datas['alamat'] ?>" autocomplete="off" placeholder=" Cth : Medan, Medan City, North Sumatra, Indonesia">
              </div>
            </div>
            </div>  
          </div>

          <div class="form-group col-md-12">
            <center>
              <button type="submit" name="submit" class="btn" style="background:#026466;color:#fff;">Submit</button><br>
            </center>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $('.inputAddress').addressPickerByGiro({
      distanceWidget: true,
      boundElements: {
          'latitude': '.latitude',
          'longitude': '.longitude'
      }
  });
</script>

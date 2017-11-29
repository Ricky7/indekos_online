<?php

  require_once "../class/Connect.php";
  require_once "../class/Seller.php";

  $seller = new Seller($db);
  $datas = $seller->getSeller();
  $getID = $datas['id_seller'];

  $seller->cekSellerLogin();

?>
<?php
  include "lapak_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="lapak_profile.php">Profil Saya</a></li>
      <li class="active">Ganti Password</li>
    </ol>
    <div class="col-md-4">
      <div class="panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Ganti Password</h3>
        </div>
        <?php
          if(isset($_POST['submit'])) {
  
              try {
                  $seller->ubahPassword($getID, $_POST['old_pass'], $_POST['new_pass']);
                  header("refresh: 5");
                } catch (Exception $e) {
                  die($e->getMessage());

                }
            }
        ?>
        <form method="post">
          <div class="form-group col-md-12">
          <small>Password Lama</small>
          <input type="password" class="form-control" name="old_pass" placeholder="Password Lama" required>
          </div>
          <div class="form-group col-md-12">
          <small>Password Baru</small>
          <input type="password" class="form-control" name="new_pass" placeholder="Password Baru" required>
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

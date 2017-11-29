<?php

  require_once "../class/Connect.php";
  require_once "../class/Admin.php";

  $admin = new Admin($db);
  $datas = $admin->getAdmin();
  $getID = $datas['id_admin'];

  $admin->cekLogin();

?>

<?php
  include "adm_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li class="active">Ganti Password</li>
      <li><a href="adm_data_admin.php">Daftar Admin</a></li>
      <li><a href="adm_tambah_admin.php">Tambah Admin</a></li>
    </ol>
    <div class="col-md-4">
      <h4 align="center">Ganti Password</h4>
      <?php
          if(isset($_POST['submit'])) {
  
              try {
                  $admin->ubahPassword($getID, $_POST['old_pass'], $_POST['new_pass']);
                  header("refresh: 5");
                } catch (Exception $e) {
                  die($e->getMessage());

                }
            }
        ?>
      <form method="post">
        <div class="form-group" >
          <label>Password Lama</label>
          <input type="password" class="form-control" name="old_pass" placeholder="Password Lama">
        </div>
        <div class="form-group">
          <label>Password Baru</label>
          <input type="password" class="form-control" name="new_pass" placeholder="Password Baru">
        </div>
        <center>
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </center>
      </form>
    </div>
  </div>
</div>

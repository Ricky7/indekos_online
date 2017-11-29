<?php

  require_once "../class/Connect.php";
  require_once "../class/Admin.php";

  $admin = new Admin($db);
  $datas = $admin->getAdmin();

  $admin->cekLogin();
  if(isset($_POST['submit'])) {

      try {
        $admin->tambahAdmin(array(
          'nama' => $_POST['nama'],
          'username' => $_POST['username'],
          'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
          'session' => 'admin'
        ));
        //header("location: my_order.php");
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
      <li><a href="adm_ubah_pass.php">Ganti Password</a></li>
      <li><a href="adm_data_admin.php">Daftar Admin</a></li>
      <li class="active">Tambah Admin</li>
    </ol>
    <div class="col-md-4">
      <h4 align="center">Tambah Admin</h4>
      <form method="post">
        <div class="form-group" >
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" placeholder="Nama">
        </div>
        <div class="form-group" >
          <label>Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <center>
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </center>
      </form>
    </div>
  </div>
</div>

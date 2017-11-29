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
      <li class="active">Laporan</li>
    </ol>
    <div class="col-md-4">
      <h4 align="center">Laporan Pemesanan</h4>
      <form method="post" action="laporan_booking.php">
        <div class="form-group" >
          <label>Dari</label>
          <input type="date" class="form-control" name="from">
        </div>
        <div class="form-group">
          <label>Hingga</label>
          <input type="date" class="form-control" name="to">
        </div>
        <center>
          <button type="submit" name="submit" class="btn btn-success">Lihat</button>
        </center>
      </form>
    </div>
    <div class="col-md-4">
      <h4 align="center">Laporan Keuntungan</h4>
      <form method="post" action="laporan_pajak.php">
        <div class="form-group" >
          <label>Dari</label>
          <input type="date" class="form-control" name="from">
        </div>
        <div class="form-group">
          <label>Hingga</label>
          <input type="date" class="form-control" name="to">
        </div>
        <center>
          <button type="submit" name="submit" class="btn btn-success">Lihat</button>
        </center>
      </form>
    </div>
  </div>
</div>

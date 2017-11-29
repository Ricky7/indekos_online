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
      <li class="active">Laporan</li>
    </ol>
    <div class="col-md-4">
      <div class="panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Input Tanggal</h3>
        </div>
        <form method="post" action="lapak_laporan_pdf.php">
          <div class="form-group col-md-12">
          <small>Dari</small>
          <input type="date" class="form-control" name="from" required>
          <input type="hidden" name="id" value="<?php echo $getID; ?>">
          </div>
          <div class="form-group col-md-12">
          <small>Hingga</small>
          <input type="date" class="form-control" name="to" required>
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

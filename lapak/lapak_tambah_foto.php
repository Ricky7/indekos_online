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
    //extract($indekos->getProdukID($id_indekos));
  }

  if(isset($_POST['submit'])) {

    $total = count($_FILES['gambar']['name']);
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

    if($total == 3) {

      for($i=0; $i<$total; $i++) {

        $imgFile[] = $_FILES['gambar']['name'][$i];
        $tmpFilePath = $_FILES['gambar']['tmp_name'][$i];
        $imgSize[] = $_FILES['gambar']['size'][$i];
        $imgExt[] = strtolower(pathinfo($imgFile[$i],PATHINFO_EXTENSION));
        $userpic[] = rand(1000,1000000).".".$imgExt[$i];
        $newFilePath = "../assets/img_indekos/";

        if(in_array($imgExt[$i], $valid_extensions)) {

          if($imgSize[$i] < 5000000) {

            move_uploaded_file($tmpFilePath,$newFilePath.$userpic[$i]);

          } else {

            echo "Ukuran tidak boleh lebih dari 5MB";
            header("refresh: 5");
          }
        } else {
          $error = "Hanya ekstensi jpeg, jpg, png, gif";
          header("refresh: 5");
        }


      }
      //$images = implode(",",$userpic);

      try {
        $indekos->editIndekos(array(
          'gambar_1' => $userpic[0],
          'gambar_2' => $userpic[1],
          'gambar_3' => $userpic[2]
        ), $id_indekos);
        header("location: lapak_info_indekos.php?id=$id_indekos");
      } catch (Exception $e) {
      die($e->getMessage());
      }

    } else {

      $error = "Foto tidak boleh lebih/kurang dari 3 buah";
      header("refresh: 5");
    }

  }



?>
<?php
  include "lapak_header.php";
?>

<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="lapak_list_indekos.php">Daftar Indekos</a></li>
      <li><a href="lapak_input_indekos.php">Input Indekos</a></li>
      <li class="active">Tambah Foto</li> 
    </ol>
    <div class="col-md-4">
      <div class="panel panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Input Foto Tambahan</h3>
        </div>

          <form method="post" enctype="multipart/form-data" style="padding-top:10px;">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error ?>
                </div>
             <?php endif; ?>
            <div class="form-group col-md-10">
              <small>Foto Utama</small>
              <input type="file" class="form-control" name="gambar[]" multiple required>
            </div>

            <div class="form-group col-md-10">
              <center>
                <button type="submit" name="submit" class="btn" style="background:#026466;color:#fff;">Submit</button><br>
              </center>
            </div>

          </form>

        </div>
    </div>
  </div>
</div>
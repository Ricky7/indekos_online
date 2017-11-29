<?php

  require_once "../class/Connect.php";
  require_once "../class/Seller.php";
  require_once "../class/Indekos.php";

  $seller = new Seller($db);
  $datas = $seller->getSeller();
  $getID = $datas['id_seller'];

  $seller->cekSellerLogin();

  $indekos = new Indekos($db);

  if(isset($_POST['submit'])) {

      $imgFile = $_FILES['gambar']['name'];
      $tmp_dir = $_FILES['gambar']['tmp_name'];
      $imgSize = $_FILES['gambar']['size'];


      if(empty($imgFile)) {
        $errMsg = "Please select image File..";
      } else {
        $upload_dir = '../assets/img_indekos/'; // upload directory
 
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
      
        // rename uploading image
        $userpic = rand(1000,1000000).".".$imgExt;

        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){   
            // Check file size '5MB'
            if($imgSize < 5000000)    {
              move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            } else {
              $errMSG = "Sorry, your file is too large.";
            }
        } else {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
        }
      }

      
      if(!isset($errMsg)) {

          try {
            $indekos->inputIndekos(array(
              'id_seller' => $getID,
              'judul' => $_POST['judul'],
              'kelas' => $_POST['kelas'],
              'gambar' => $userpic,
              'harga' => $_POST['harga'],
              'alamat' => $_POST['alamat'],
              'deskripsi' => $_POST['deskripsi'],
              'status' => 1
            ));
            header("location: lapak_list_indekos.php");
          } catch (Exception $e) {
          die($e->getMessage());
          }
      }

      
  }

?>
<?php
  include "lapak_header.php";
?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    relative_urls : false, // agar url tidak disingkat
    height: 500,
    theme: 'modern',
    plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
    image_advtab: true,
    templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
    ],
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'
    ]
   });
</script>
<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="lapak_list_indekos.php">Daftar Indekos</a></li>
      <li class="active">Input Indekos</li> 
    </ol>
    <div class="col-md-12">
      <div class="panel panel">
        <div class="panel-heading" style="background:#026466;">
          <h3 class="panel-title" style="color:#fff;">Input Indekos</h3>
        </div>

          <form method="post" enctype="multipart/form-data" style="padding-top:10px;">
            <div class="form-group col-md-12">
              <small>Judul</small>
              <input type="text" class="form-control" name="judul" required>
            </div>

            <div class="form-group col-md-4">
              <small>Kelas</small>
              <select class="form-control" name="kelas" required>
                <option></option>
                <option value="Ekonomi">Ekonomi</option>
                <option value="VIP">VIP</option>
                <option value="Eksekutif">Eksekutif</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <small>Foto Utama</small>
              <input type="file" class="form-control" name="gambar" required>
            </div>

            <div class="form-group col-md-4">
              <small>Biaya Bulanan</small>
              <input type="number" class="form-control" name="harga" required>
            </div>

            <div class="form-group col-md-12">
              <small>Alamat lokasi Indekos</small>
              <input type="text" class="form-control" name="alamat" required>
            </div>

            <div class="form-group col-md-12">
              <small>Deskripsi</small>
              <textarea name="deskripsi"></textarea>
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
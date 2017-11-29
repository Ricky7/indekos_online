<?php
	  require_once "class/Connect.php";
  	require_once "class/User.php";
  	require_once "class/Indekos.php";
  	require_once "class/Booking.php";

  	$user = new User($db);
  	$datas = $user->getUser();
  	$data = $datas['session'];

  	$user->cekUserLogin();

  	$indekos = new Indekos($db);
  	$booking = new Booking($db);

    if(isset($_REQUEST['id'])) {

      $id_booking = $_REQUEST['id'];
      extract($booking->getBookingByID($id_booking));
    }

    if(isset($_POST['submit'])) {

          try {
            $booking->Bayar(array(
              'no_rek' => $_POST['no_rek'],
              'nama_rek' => $_POST['nama_rek'],
              'nama_bank' => $_POST['nama_bank'],
              'nilai' => $_POST['nilai'],
              'note_transfer' => $_POST['note'],
              'status_booking' => 'PENDING'
            ),$datas['id_user'], $id_booking);
            header("Location: bayar_booking.php");
          } catch (Exception $e) {
          die($e->getMessage());
        }
    }

    $jumlah_desimal = "0";
    $pemisah_desimal = ",";
    $pemisah_ribuan = ".";
?>
<?php
	include "header.php";
?>
<!---->
<div class="cart_main">
	 <div class="container">
		 <ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			  <li class="active">Pembayaran</li>
		 </ol>			
		 <div class="registration">
       <div class="registration_left">
         <h2>Form Pembayaran</h2>
         <div class="registration_form">
         <!-- Form -->
          <form method="post">
            <div>
              <label>
                <small>Jenis Bank</small>
                <select name="nama_bank" required>
                  <option></option>
                  <option value="BRI">BRI</option>
                  <option value="BNI">BNI</option>
                  <option value="BCA">BCA</option>
                  <option value="CIMB">CIMB</option>
                  <option value="MANDIRI">MANDIRI</option>
                </select>
              </label>
            </div>
            <div>
              <label>
                <small>Nama Rekening</small>
                <input name="nama_rek" type="text" tabindex="2" required autofocus>
              </label>
            </div>
            <div>
              <label>
                <small>No Rekening</small>
                <input name="no_rek" type="text" tabindex="3" required>
              </label>
            </div>        
            <div>
              <label>
                <small>Nilai Transfer</small>
                <input name="nilai" type="text" tabindex="4" required>
              </label>
            </div>
            <div>
              <label>
                <small>Note Transfer</small>
                <textarea name="note"></textarea>
              </label>
            </div>          
            <div>
              <input type="submit" name="submit" value="Kirim" id="register-submit">
            </div>
          </form>
          <!-- /Form -->
         </div>
       </div>

       <div class="registration_left">
         <h2>No Rekening Admin</h2>
         <div class="registration_form">
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
         </div>
         <div class="clearfix"></div>

         <div class="cart-header">
           <div class="cart-sec">
              <div class="cart-item cyc">
                 <img src="assets/img_indekos/<?php print($gambar) ?>"/>
              </div>
               <div class="cart-item-info">
                 <h3><?php print($judul) ?><span><?php print($kelas) ?></span></h3>
                 <h4><span>Total Biaya : <?php print('Rp. '.number_format($total_biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span></h4><br>
                 <h4><span>Biaya Booking : <?php print('Rp. '.number_format($biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span></h4>
               </div>
               <div class="clearfix"></div>           
            </div>
         </div>
       </div>
       <div class="clearfix"></div>
     </div>
		 
	 </div>
</div>
<!---->
<?php
	include "footer.php";
?>
<!---->
</body>
</html>
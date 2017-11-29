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

  	if(isset($_REQUEST['slug'])) {

  		$id_cart = $_REQUEST['slug'];
  		extract($booking->getCartByID($id_cart));
  		extract($indekos->getProdukID($id_indekos));
  	}

  	date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d H:i:s');

	if(isset($_POST['submit'])) {

		$biaya_booking = ($biaya * 30)/100;
		$pajak = ($biaya_booking * 10)/100;

		$kode = time().rand(1000,9999);

	      try {
	        $booking->insertBooking(array(
	          'id_pembeli' => $datas['id_user'],
	          'id_penjual' => $id_penjual,
	          'id_indekos' => $id_indekos,
	          'biaya' => $biaya_booking,
	          'total_biaya' => $biaya,
	          'durasi' => $durasi,
	          'tgl_booking' => $tanggal,
	          'kode_booking' => $kode,
	          'status_booking' => 'UNPAID',
	          'pajak' => $pajak
	        ), $datas['id_user'], $id_penjual);
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
			  <li class="active">Booking</li>
			 </ol>			
		 <div class="cart-items">
			 <h2>Pesanan Sementara</h2>
			 <div class="col-md-8 cart-header">
				 <div class="cart-sec">
						<div class="cart-item cyc">
							 <img src="assets/img_indekos/<?php echo $gambar ?>"/>
						</div>
					   <div class="cart-item-info">
							 <h3><?php echo $judul ?><span><?php echo $kelas ?></span></h3>
							 <h4><span>Total Biaya : <?php print('Rp. '.number_format($biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span></h4><br>
							 <h4><span>Biaya Booking : <?php print('Rp. '.number_format(($biaya*30)/100,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span></h4>
					   </div>
					   <div class="clearfix"></div>					
				  </div>
			 </div>		
		 </div>
		 
		 <div class="col-md-4 cart-total">
			 <center>
			 	<form method="post">
				 <button type="submit" name="submit" class="btn" style="background:#026466;color:#fff;height:50px;width:200px;padding-bottom:10px;">Booking Sekarang</button>
				</form>
			 </center>
			 <div class="price-details">
				 <h3>Detail Biaya</h3>
				 <span>Total</span>
				 <span class="total"><?php print('Rp. '.number_format($biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span>
				 <span>Lainnya</span>
				 <span class="total">---</span>
				 <span>Persen</span>
				 <span class="total">30 %</span>
				 <div class="clearfix"></div>				 
			 </div>	
			 <h4 class="last-price">Biaya Booking</h4>
			 <span class="total final"><?php print('Rp. '.number_format(($biaya*30)/100,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span>
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
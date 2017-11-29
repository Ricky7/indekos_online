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
      extract($booking->getSellerByID($id_penjual));
    }

    $jumlah_desimal = "0";
    $pemisah_desimal = ",";
    $pemisah_ribuan = ".";
?>
<?php
	include "header.php";
?>
<!---->
<!-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
 --><script src="assets/dist/jquery.addressPickerByGiro.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7zVeusOAU0YBF9JtwV97OXVM9dowacso&sensor=false&language=en"></script>
<link href="assets/dist/jquery.addressPickerByGiro.css" rel="stylesheet" media="screen">
<div class="cart_main">
	 <div class="container">
			 <ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			  <li class="active">Informasi Booking</li>
			 </ol>			
		 <div class="cart-items">
		 	<div class="panel panel">
		        <div class="panel-heading" style="background:#026466;">
		          <h3 class="panel-title" style="color:#fff;">Peta Lokasi Indekos</h3>
		        </div>

		        <div class="form-group col-md-12">
		            <div class="span9">
		            <div class="row-fluid">
		              <div class="controls" style="padding-top:10px;">
		                <input type="text" name="alamat" class="inputAddress input-xxlarge" value="<?php echo $alamat ?>" autocomplete="off" style="width:1100px;padding-top:5px;padding-bottom:5px;" disabled>
		              </div>
		            </div>
		            </div>  
		        </div>

		        <div class="col-md-6" style="padding-top:30px;">
		          <div class="panel-heading" style="background:#026466;">
		            <h3 class="panel-title" style="color:#fff;">Informasi Indekos</h3>
		          </div>

		          <div class="table-responsive">
		            <table class="table table-hover">
		              <tbody>
		                <tr>
		                  <td>Judul</td>
		                  <td><?php echo $judul ?></td>
		                </tr>
		                <tr>
		                  <td>Kelas</td>
		                  <td><?php echo $kelas ?></td>
		                </tr>
		                <tr>
		                  <td>Biaya</td>
		                  <td><?php echo number_format($harga,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan).' / bulan'; ?></td>
		                </tr>
		                <tr>
		                  <td>Alamat</td>
		                  <td><?php echo $alamat ?></td>
		                </tr>
		              </tbody>
		            </table>
		          </div>
		        </div>

		        <div class="col-md-6" style="padding-top:30px;">
		        	<div class="panel-heading" style="background:#026466;">
		            <h3 class="panel-title" style="color:#fff;">Informasi Booking</h3>
		          </div>

		          <div class="table-responsive">
		            <table class="table table-hover">
		              <tbody>
		                <tr>
		                  <td>Nama Pemilik Indekos</td>
		                  <td><?php echo $nama ?></td>
		                </tr>
		                <tr>
		                  <td>No Kontak</td>
		                  <td><?php echo $no_hp ?></td>
		                </tr>
		                <tr>
		                  <td>Tanggal Booking</td>
		                  <td><?php echo $tgl_booking ?></td>
		                </tr>
		                <tr>
		                  <td>Biaya Booking</td>
		                  <td><?php echo number_format($biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		                </tr>
		                <tr>
		                  <td>Durasi Sewa</td>
		                  <td><?php echo $durasi.' / bulan' ?></td>
		                </tr>
		                <tr>
		                  <td>Total Biaya</td>
		                  <td><?php echo number_format($total_biaya,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan); ?></td>
		                </tr>
		                <tr>
		                  <td>Kode Booking</td>
		                  <td><?php echo $kode_booking ?></td>
		                </tr>
		              </tbody>
		            </table>
		          </div>
		        </div>

	        </div>
		 </div>
		  
	 </div>
</div>
<!---->
<?php
	include "footer.php";
?>
<!---->
</body>
<script>
  $('.inputAddress').addressPickerByGiro({
      distanceWidget: true,
      boundElements: {
          'latitude': '.latitude',
          'longitude': '.longitude'
      }
  });
</script>
</html>
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

  		$id_indekos = $_REQUEST['slug'];
  		extract($indekos->getProdukID($id_indekos));
  	}

  	if(isset($_POST['submit'])) {

 		$total_harga = $harga * $_POST['durasi'];
 		try {
	    	$booking->addtoCart(array(
	    		'id_indekos' => $id_indekos,
	    		'id_penjual' => $id_seller,
	    		'id_pembeli' => $datas['id_user'],
	    		'harga' => $total_harga,
	    		'durasi' => $_POST['durasi']
	    	));
	    	//header("refresh:0");
	    	header("location: cart.php");
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
<!--etalage-->
<link rel="stylesheet" href="assets/css/etalage.css">
<script src="assets/js/jquery.etalage.min.js"></script>
<script>
	jQuery(document).ready(function($){

		$('#etalage').etalage({
			thumb_image_width: 300,
			thumb_image_height: 300,
			source_image_width: 900,
			source_image_height: 1200,
			show_hint: true,
			click_callback: function(image_anchor, instance_id){
				alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
			}
		});

	});
</script>
<div class="product-model">	 
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Single</li>
		</ol>
		<h2 align="center">Detail Indekos</h2>
		<!-- start content -->	
		<div class="col-md-12 det">
			 <!-- slider -->
			  <div class="single_left">
				 <div class="grid images_3_of_2">
					 <ul id="etalage">
						<li>
							<a href="optionallink.html">
								<img class="etalage_thumb_image" src="assets/img_indekos/<?php echo $gambar ?>" class="img-responsive" />
								<img class="etalage_source_image" src="assets/img_indekos/<?php echo $gambar ?>" class="img-responsive" title="" />
							</a>
						</li>
						<li>
							<img class="etalage_thumb_image" src="assets/img_indekos/<?php echo $gambar_1 ?>" class="img-responsive" />
							<img class="etalage_source_image" src="assets/img_indekos/<?php echo $gambar_1 ?>" class="img-responsive" title="" />
						</li>							
					    <li>
							<img class="etalage_thumb_image" src="assets/img_indekos/<?php echo $gambar_2 ?>" class="img-responsive"  />
							<img class="etalage_source_image" src="assets/img_indekos/<?php echo $gambar_2 ?>"class="img-responsive"  />
						</li>
						<li>
							<img class="etalage_thumb_image" src="assets/img_indekos/<?php echo $gambar_3 ?>" class="img-responsive"  />
							<img class="etalage_source_image" src="assets/img_indekos/<?php echo $gambar_3 ?>"class="img-responsive"  />
						</li>
					 </ul>
					 <div class="clearfix"></div>		
			      </div>
			  </div>
			  <!-- //slider -->
			  <!-- spencer -->
			  <div class="single-right">
				 <h3><?php echo $judul ?></h3>
				 <div class="id"><h4></h4></div>
				  
				  <div class="cost">
					 <div class="prdt-cost">
					 	<form method="post">
						 <ul>
						 	 <li>Kelas:</li>
							 <li class="active"><?php echo $kelas ?></li>							 
							 <li>Biaya Bulanan:</li>
							 <li class="active"><?php print('Rp. '.number_format($harga,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></li>

							 <li><input type="number" name="durasi" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "2" value="1" required></li>
							 <button type="submit" name="submit" class="btn" style="background:#026466;color:#fff;">BOOKING NOW</button>
						 </ul>
						</form>
					 </div>
					
					 <div class="clearfix"></div>
				  </div>

				  <div class="single-bottom1">
					<h6>Note</h6>
					<p class="prod-desc">Biaya Booking 30% dari total Biaya.</p>
				 </div>	
				  <div class="single-bottom1">
					<h6>Alamat</h6>
					<p class="prod-desc"><?php echo $alamat ?></p>
				 </div>					 
			  </div>
			  <!-- //spencer -->
			  <div class="clearfix"></div>
			  <div class="sofaset-info">
				 <h4>Deskripsi</h4>
				 <p><?php echo $deskripsi ?></p>
			  </div>				  					
	    </div>
	    <!-- content -->
		<div class="rsidebar span_1_of_left">
		</div>

	</div>
</div>	

<?php
	include "footer.php";
?>
<!---->
</body>
</html>
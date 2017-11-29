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
?>
<?php
	include "header.php";
?>
<!---->
<div class="cart_main">
	 <div class="container">
		 <ol class="breadcrumb">
			  <li><a href="index.php">Home</a></li>
			  <li class="active">Keranjang</li>
		 </ol>			
		 <div class="cart-items">
			 <h2>Pesanan Sementara</h2>
			 <?php
            $query = "SELECT *, tbl_cart.harga as total FROM tbl_cart INNER JOIN tbl_indekos ON (tbl_cart.id_indekos=tbl_indekos.id_indekos)";       
            $records_per_page=4;
            $newquery = $booking->paging($query,$records_per_page);
            $booking->cartIndekos($newquery);
       ?>
        <center>
            <div class="pagination-wrap col-md-12">
            <?php $booking->paginglink($query,$records_per_page); ?>
            </div>
        </center>
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
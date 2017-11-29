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
		  <li class="active">Bayar Booking</li>
		</ol>
		<div class="col-md-12">
	      	<div class="panel panel">
		        <div class="panel-heading" style="background:#026466;">
		          <h3 class="panel-title" style="color:#fff;">Booking Belum Bayar</h3>
		        </div>

	          <div class="table-responsive">
	            <table class="table table-hover">
	              <thead>
	                <th>Judul</th>
	                <th>Kelas</th>
	                <th>Biaya Booking</th>
	                <th>Status</th>
	              </thead>
	              <tbody>
	                <?php
	                  $query = "SELECT * FROM tbl_booking INNER JOIN tbl_indekos ON (tbl_booking.id_indekos=tbl_indekos.id_indekos) 
	                  WHERE (tbl_booking.id_pembeli, tbl_booking.status_booking) IN (({$datas['id_user']}, 'UNPAID'), ({$datas['id_user']}, 'PENDING')) 
	                  ORDER BY tbl_booking.status_booking desc";       
	                  $records_per_page=10;
	                  $newquery = $booking->paging($query,$records_per_page);
	                  $booking->daftarBooking($newquery);
	                 ?>
	                 <tr>
	                    <td colspan="4" align="center">
	                  <div class="pagination-wrap">
	                        <?php $booking->paginglink($query,$records_per_page); ?>
	                      </div>
	                    </td>
	                </tr>
	              </tbody>
	            </table>
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
</html>
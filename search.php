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
		  <li class="active">Pencarian</li>
		</ol>
		<h2 align="center">Hasil Pencarian</h2>	
		
		<div class="col-md-12 product-model-sec">
			<?php

	            if(isset($_GET['search'])){

            		$param = $_GET['search'];
            		$query = "SELECT * FROM tbl_indekos WHERE judul LIKE '%{$param}%' AND status=1";
            		$records_per_page=8;
                    $newquery = $indekos->paging($query,$records_per_page);
                    $indekos->indexIndekos($newquery);
            	}
	            
	        ?>
            <center>
                <div class="pagination-wrap col-md-12">
                <?php $indekos->paginglink($query,$records_per_page); ?>
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
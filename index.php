<?php
	require_once "class/Connect.php";
  	require_once "class/User.php";
  	require_once "class/Indekos.php";

  	$user = new User($db);
  	$datas = $user->getUser();
  	$data = $datas['session'];

  	$indekos = new Indekos($db);
?>
<?php
	include "header.php";
?>
<div class="product-model">	 
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active"></li>
		</ol>
		<h2 align="center">INDEKOS</h2>

		<div class="col-md-12 product-model-sec">
			<?php

	            if(isset($_GET['kelas']) && !empty($_GET['kelas'])) {

	                $kelas = $_GET['kelas'];

	                $query = "SELECT * FROM tbl_indekos WHERE kelas='{$kelas}'";

	                $records_per_page=8;
	                $newquery = $indekos->paging($query,$records_per_page);
	                $indekos->indexIndekos($newquery);

	            } else {
	                $query = "SELECT * FROM tbl_indekos";       
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

<?php
	include "footer.php";
?>
<!---->
</body>
</html>
<?php

    class Booking
    {
        private $db; 
        private $error; 

        function __construct($db_conn)
        {
            $this->db = $db_conn;

        }

        public function getCartByID($id) {

	        $stmt = $this->db->prepare("SELECT *, harga as biaya FROM tbl_cart WHERE id_cart=:id");
	        $stmt->execute(array(":id"=>$id));
	        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	        return $editRow;
	    }

        public function getBookingByID($id) {

            $stmt = $this->db->prepare("SELECT * FROM tbl_booking INNER JOIN tbl_indekos
            ON (tbl_booking.id_indekos=tbl_indekos.id_indekos) WHERE tbl_booking.id_booking=:id");
            $stmt->execute(array(":id"=>$id));
            $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
            return $editRow;
        }

        public function getBuyerByID($id) {

            $stmt = $this->db->prepare("SELECT * FROM tbl_user WHERE id_user=:id");
            $stmt->execute(array(":id"=>$id));
            $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
            return $editRow;
        }

        public function getSellerByID($id) {

            $stmt = $this->db->prepare("SELECT * FROM tbl_seller WHERE id_seller=:id");
            $stmt->execute(array(":id"=>$id));
            $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
            return $editRow;
        }

        public function addtoCart($datas = array()) {

	        $keys = array_keys($datas);

	        $values = "'" . implode( "','", $datas ) . "'";

	        $id_pembeli = $datas['id_pembeli'];
	        $id_indekos = $datas['id_indekos'];

	        // Cek Jika Produk tersebut sudah ada di table cart dengan id sesi yg sama
	        $stmt = $this->db->prepare("SELECT * FROM tbl_cart WHERE id_pembeli=:id_pembeli AND id_indekos=:id_indekos");
	        $stmt->execute(array(":id_pembeli"=>$id_pembeli, ":id_indekos"=>$id_indekos));
	        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	        
	        // jika ada
	        if($stmt->rowCount()>0) {

	            $harga = $datas['harga']; //replace
	            $durasi = $datas['durasi']; //replace

	            $sql = "UPDATE tbl_cart SET harga={$harga}, durasi={$durasi}  WHERE id_indekos = {$id_indekos} AND id_pembeli = {$id_pembeli}";


	            if ($this->db->prepare($sql)) {
	                if ($this->db->exec($sql)) {
	                    return true;
	                }
	            }
	            
	            return false;


	        } else {

	            $sql = "INSERT INTO tbl_cart (`" . implode('`,`', $keys) . "`) VALUES ({$values})";

	            if ($this->db->prepare($sql)) {
	                if ($this->db->exec($sql)) {
	                    return true;
	                }
	            }

	            return false;
	        }

	        return true;

	    }

	    public function cartIndekos($query) {

	    	$jumlah_desimal = "0";
	        $pemisah_desimal = ",";
	        $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                    	<div class="cart-header">
							 <a href="del_cart.php?id=<?php print($row['id_cart']) ?>" class="close1"></a>
							 <div class="cart-sec">
									<div class="cart-item cyc">
										 <a href="single.php?slug=<?php print($row['id_cart']) ?>"><img src="assets/img_indekos/<?php print($row['gambar']) ?>"/>
									</div>
								   <div class="cart-item-info">
										 <h3><?php print($row['judul']) ?><span><?php print($row['kelas']) ?></span></h3>
										 <h4><span>Total Biaya : <?php print('Rp. '.number_format($row['total'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span></h4><br>
										 <h4><span>Biaya Booking : <?php print('Rp. '.number_format(($row['total']*30)/100,$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span></h4>
								   </div>
								   <div class="clearfix"></div>
									<div class="delivery">
										 <a class="continue" href="booking.php?slug=<?php print($row['id_cart']) ?>" style="width:200px;">Booking Sekarang</a>
							        </div>						
							  </div>
						 </div>	
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ditemukan....</td>
                </tr>
                <?php
            }

        }

        public function insertBooking($fields = array(), $id_pembeli, $id_penjual) {

	        $keys = array_keys($fields);

	        $values = "'" . implode( "','", $fields ) . "'";

	        $sql = "INSERT INTO tbl_booking (`" . implode('`,`', $keys) . "`) VALUES ({$values})";

	        if ($this->db->prepare($sql)) {

	            if ($this->db->exec($sql)) {

	                $delCart = $this->db->prepare("DELETE FROM tbl_cart WHERE id_pembeli=:id_pembeli AND id_penjual=:id_penjual");
                    $delCart->bindparam(":id_pembeli",$id_pembeli);
                    $delCart->bindparam(":id_penjual",$id_penjual);
                    $delCart->execute();
                    return true;
	            }
	        }

	        return false;
	    }

	    public function daftarBooking($query) {

	    	$jumlah_desimal = "0";
	        $pemisah_desimal = ",";
	        $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>

                    <tr>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['kelas']); ?></td>
                        <td><?php print(number_format($row['biaya'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td>
                            <?php
                                switch ($row['status_booking']) {
                                    case 'UNPAID':
                                        ?>
                                            <a href="pembayaran.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                                        <?php
                                        break;

                                    case 'PENDING':
                                        ?>
                                            <a href="pembayaran.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                                        <?php
                                        break;

                                    case 'PAID':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;

                                    case 'CONFIRMED':
                                        ?>
                                            <a href="informasi_booking.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                                        <?php
                                        break;
                                    
                                    case 'PROCESS':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;

                                    case 'PAYING':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;

                                    case 'COMPLETED':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                    
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ditemukan....</td>
                </tr>
                <?php
            }

        }

        public function daftarBookingSeller($query) {

            $jumlah_desimal = "0";
            $pemisah_desimal = ",";
            $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>

                    <tr>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['tgl_booking']); ?></td>
                        <td><?php print(number_format($row['biaya'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td>
                            <?php
                                switch ($row['status_booking']) {
                                    case 'PAID':
                                        ?>
                                            <a href="lapak_info_booking.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                                        <?php
                                        break;

                                    case 'CONFIRMED':
                                        ?>
                                            <a href="lapak_info_booking.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                                        <?php
                                        break;
                                    
                                    case 'PROCESS':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;

                                    case 'PAYING':
                                        ?>
                                            <a href="lapak_info_booking.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                                        <?php
                                        break;

                                    case 'COMPLETED':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;

                                    case 'CANCEL':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;

                                    case 'FAILED':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                    
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ditemukan....</td>
                </tr>
                <?php
            }

        }

        public function hapusCart($id) {
			$stmt = $this->db->prepare("DELETE FROM tbl_cart WHERE id_cart=:id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;
		}

        public function Bayar($fields = array(), $id_user, $id_booking) {

            $set = '';
            $x = 1;

            foreach ($fields as $name => $value) {
                $set .= "{$name} = '{$value}'";
                if($x < count($fields)) {
                    $set .= ', ';
                }
                $x++;
            }

            //var_dump($set);
            $sql = "UPDATE tbl_booking SET {$set} WHERE id_pembeli={$id_user} AND id_booking={$id_booking}";

            if ($this->db->prepare($sql)) {
                if ($this->db->exec($sql)) {
                    return true;
                }
            }

            return false;
        }

        public function daftarBookingPending($query) {

            $jumlah_desimal = "0";
            $pemisah_desimal = ",";
            $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>

                    <tr>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['tgl_booking']); ?></td>
                        <td><?php print(number_format($row['biaya'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td>
                        <a href="adm_info_booking.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ada booking terbaru....</td>
                </tr>
                <?php
            }

        }

        public function daftarBookingPaid($query) {

            $jumlah_desimal = "0";
            $pemisah_desimal = ",";
            $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>

                    <tr>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['tgl_booking']); ?></td>
                        <td><?php print(number_format($row['biaya'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td><?php print($row['status_booking']); ?></td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ada booking terbaru....</td>
                </tr>
                <?php
            }

        }

        public function daftarBookingProcess($query) {

            $jumlah_desimal = "0";
            $pemisah_desimal = ",";
            $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>

                    <tr>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['tgl_booking']); ?></td>
                        <td><?php print(number_format($row['biaya'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td>
                            <?php
                                switch ($row['status_booking']) {
                                    case 'PROCESS':
                                        ?>
                                            <a href="adm_info_booking.php?id=<?php print($row['id_booking']); ?>"><?php print($row['status_booking']); ?></a>
                                        <?php
                                        break;
                                        
                                    case 'PAYING':
                                        ?>
                                            <?php print($row['status_booking']); ?>
                                        <?php
                                        break;
                                }
                            ?>
                            
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ada booking terbaru....</td>
                </tr>
                <?php
            }

        }

        public function daftarBookingUnpaid($query) {

            $jumlah_desimal = "0";
            $pemisah_desimal = ",";
            $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>

                    <tr>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['tgl_booking']); ?></td>
                        <td><?php print(number_format($row['biaya'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td>
                            <a href="#" data-href="adm_hapus_booking.php?id=<?php print($row['id_booking']); ?>" data-toggle="modal" data-target="#confirm-delete" class="hapus"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ada booking terbaru....</td>
                </tr>
                <?php
            }

        }

        public function daftarBookingCompleted($query) {

            $jumlah_desimal = "0";
            $pemisah_desimal = ",";
            $pemisah_ribuan = ".";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>

                    <tr>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['tgl_booking']); ?></td>
                        <td><?php print(number_format($row['biaya'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td><?php print($row['status_booking']); ?></td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                <td>Tidak ada booking terbaru....</td>
                </tr>
                <?php
            }

        }

        public function hapusBooking($id) {

            $stmt = $this->db->prepare("DELETE FROM tbl_booking WHERE id_booking=:id");
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
        }

        public function setStatus($status, $id_booking) {

            //var_dump($set);
            $sql = "UPDATE tbl_booking SET status_booking='{$status}' WHERE id_booking={$id_booking}";

            if ($this->db->prepare($sql)) {
                if ($this->db->exec($sql)) {
                    return true;
                }
            }

            return false;
        }

        public function setKode($kode, $id_booking) {

            
            $stmt = $this->db->prepare("SELECT kode_booking FROM tbl_booking WHERE id_booking={$id_booking}");
            $stmt->execute(array(":id"=>$id_booking));
            $kodeRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($kode == $kodeRow['kode_booking']) {

                $sql = "UPDATE tbl_booking SET status_booking='PROCESS' WHERE id_booking={$id_booking}";

                if ($this->db->prepare($sql)) {
                    if ($this->db->exec($sql)) {
                        header("Location: lapak_booking_process.php");
                        return true;
                    }
                }

                return false;

            } else {

                ?>
                    <script>
                        var error = "Kode Salah, Coba Sekali Lagi";
                        alert(error);
                    </script>
                <?php
                return true;
            }

            return true;
        }

        public function paging($query,$records_per_page)
        {
            $starting_position=0;
            if(isset($_GET["page_no"]))
            {
                $starting_position=($_GET["page_no"]-1)*$records_per_page;
            }
            $query2=$query." limit $starting_position,$records_per_page";
            return $query2;
        }

        public function paginglink($query,$records_per_page)
        {
            
            $self = $_SERVER['PHP_SELF'];
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            $total_no_of_records = $stmt->rowCount();
            
            if($total_no_of_records > 0)
            {
                ?><ul class="pagination"><?php
                $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
                $current_page=1;
                if(isset($_GET["page_no"]))
                {
                    $current_page=$_GET["page_no"];
                }
                if($current_page!=1)
                {
                    $previous =$current_page-1;
                    echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                    echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
                }
                for($i=1;$i<=$total_no_of_pages;$i++)
                {
                    if($i==$current_page)
                    {
                        echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                    }
                    else
                    {
                        echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                    }
                }
                if($current_page!=$total_no_of_pages)
                {
                    $next=$current_page+1;
                    echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
                }
                ?></ul><?php
            }
        }
    }
?>
<?php

    class Indekos
    {
        private $db; 
        private $error; 

        function __construct($db_conn)
        {
            $this->db = $db_conn;

        }

        public function getProdukID($id) {

	        $stmt = $this->db->prepare("SELECT * FROM tbl_indekos WHERE id_indekos=:id");
	        $stmt->execute(array(":id"=>$id));
	        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	        return $editRow;
	    }

        public function inputIndekos($fields = array()) {

	        $keys = array_keys($fields);

	        $values = "'" . implode( "','", $fields ) . "'";

	        $sql = "INSERT INTO tbl_indekos (`" . implode('`,`', $keys) . "`) VALUES ({$values})";

	        if ($this->db->prepare($sql)) {
	            if ($this->db->exec($sql)) {
	                return true;
	            }
	        }

	        return false;

	    }

	    public function daftarIndekos($query) {

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
                        <td><?php print($row['id_indekos']); ?></td>
                        <td><?php print($row['judul']); ?></td>
                        <td><?php print($row['kelas']); ?></td>
                        <td><?php print(number_format($row['harga'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></td>
                        <td>
                        	<?php
                        		if($row['status'] == 1){
                        			print('Tersedia');
                        		} else {
                        			print('Tidak Tersedia');
                        		}
                        	?>
                        </td>
                        <td>
                        <a href="lapak_edit_indekos.php?id=<?php print($row['id_indekos']); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                        </td>
                        <td>
                        <a href="lapak_info_indekos.php?id=<?php print($row['id_indekos']); ?>"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
                        </td>
                        <td>
                        <a href="#" data-href="lapak_hapus_indekos.php?id=<?php print($row['id_indekos']); ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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

        public function editIndekos($fields = array(), $id) {

	        //$set = "ekor = 'bulu',";
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

	        $sql = "UPDATE tbl_indekos SET {$set} WHERE id_indekos = {$id}";

	        if ($this->db->prepare($sql)) {
	            if ($this->db->exec($sql)) {
	                return true;
	            }
	        }

	        return false;

	    }

	    public function ubahStatus($id, $value) {


	        $sql = "UPDATE tbl_indekos SET status={$value} WHERE id_indekos = {$id}";

	        if ($this->db->prepare($sql)) {
	            if ($this->db->exec($sql)) {
	                return true;
	            }
	        }

	        return false;

	    }

        public function hapusIndekos($id) {
			$stmt = $this->db->prepare("DELETE FROM tbl_indekos WHERE id_indekos=:id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;
		}

		public function indexIndekos($query) {

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
                    	<a href="single.php?slug=<?php print($row['id_indekos']) ?>"><div class="product-grid love-grid">
							<div class="more-product"><span> </span></div>						
							<div class="product-img b-link-stripe b-animate-go  thickbox">
								<img src="assets/img_indekos/<?php print($row['gambar']) ?>" width="290px" height="150px"/>
								<div class="b-wrapper">
									<h4 class="b-animate b-from-left  b-delay03">							
										<button class="btns"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Quick View</button>
									</h4>
								</div>
							</div>					
							<div class="product-info simpleCart_shelfItem">
								<div class="product-info-cust prt_name">
									<center>
										<h4><?php print($row['judul']) ?></h4>
										<p><?php print($row['kelas']) ?></p>
										<span class="item_price"><?php print(number_format($row['harga'],$jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)); ?></span><br>					
										<input type="button" class="item_add items" value="ADD">
									</center>
								</div>													
								<div class="clearfix"> </div>
							</div>
						</div></a>
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
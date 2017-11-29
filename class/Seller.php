<?php

    class Seller
    {
        private $db; 
        private $error; 

        function __construct($db_conn)
        {
            $this->db = $db_conn;

            session_start();
        }

        public function register($nama, $no_hp, $username, $password)
        {
            try
            {
                // buat hash dari password yang dimasukkan
                $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
                //$tgl_reg = date('Y-m-d H:i:s');

                //Masukkan user baru ke database
                $query = $this->db->prepare("INSERT INTO tbl_seller(nama, no_hp, username, password, tgl_registrasi, session) VALUES(:nama, :no_hp, :username, :pass, NOW(), 'seller')");
                $query->bindParam(":nama", $nama);
                $query->bindParam(":no_hp", $no_hp);
                $query->bindParam(":username", $username);
                $query->bindParam(":pass", $hashPasswd);
                //$query->bindParam(":tgl", $tgl_reg);
                $query->execute();

                return true;
            }catch(PDOException $e){
                // Jika terjadi error
                if($e->errorInfo[0] == 23000){
                    //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
                    //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique
                    $this->error = "Username sudah digunakan!";
                    return false;
                }else{
                    echo $e->getMessage();
                    return false;
                }
            }
        }

        public function login($username, $password)
        {
            try
            {
                // Ambil data dari database
                $query = $this->db->prepare("SELECT * FROM tbl_seller WHERE username = :username");
                $query->bindParam(":username", $username);
                $query->execute();
                $data = $query->fetch();

                // Jika jumlah baris > 0
                if($query->rowCount() > 0){
                    // jika password yang dimasukkan sesuai dengan yg ada di database
                    if(password_verify($password, $data['password'])){
                        $_SESSION['user_session'] = $data['id_seller'];
                        $_SESSION['user_role'] = $data['session'];
                        return true;
                    }else{
                        $this->error = "Username atau Password Salah";
                        return false;
                    }
                }else{
                    $this->error = "Akun tidak ada";
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        // Cek apakah Admin sudah login
        public function isSellerLoggedIn(){
            // Apakah user_session sudah ada di session
            if(isset($_SESSION['user_session']))
            {
                if($_SESSION['user_role'] == 'seller') 
                {
                    return true;
                }
            }
        }

        public function cekSellerLogin() {

            if(!self::isSellerLoggedIn()){
                header("location: lapak_login.php");
            }
        }

        // Ambil data admin yang sudah login
        public function getSeller(){
            // Cek apakah sudah login
            if(!$this->isSellerLoggedIn()){
                return false;
            }

            try {
                // Ambil data Pengurus dari database
                $query = $this->db->prepare("SELECT * FROM tbl_seller WHERE id_seller = :id");
                $query->bindParam(":id", $_SESSION['user_session']);
                $query->execute();
                return $query->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function updateSeller($fields = array(), $id_seller) {

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
            $sql = "UPDATE tbl_seller SET {$set} WHERE id_seller={$id_seller}";
            $this->db->quote($sql);
            if ($this->db->prepare($sql)) {
                if ($this->db->exec($sql)) {
                    return true;
                }
            }

            return false;
        }

        // Logout Admin
        public function logout(){
            // Hapus session
            session_destroy();
            // Hapus user_session
            unset($_SESSION['user_session']);
            return true;
        }

        public function ubahPassword($id, $old, $new) {

            // cek old password

            $cek = "SELECT password FROM tbl_seller WHERE id_seller=:id";
            $stmt = $this->db->prepare($cek);
            $stmt->execute(array(":id"=>$id));
            $pass=$stmt->fetch(PDO::FETCH_ASSOC);

            $newPass = password_hash($new, PASSWORD_DEFAULT);

            if($stmt->rowCount()>0) {

                if(password_verify($old, $pass['password'])) {

                    // update new password
                    $new = "UPDATE tbl_seller SET password='{$newPass}' WHERE id_seller={$id}";

                    $stmtC = $this->db->prepare($new);
                    $stmtC->execute();

                    ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong>
                        </div>
                    <?php
                    
                    return true;
                } else {

                    ?>
                        <div class="alert alert-danger">
                            <strong>Gagal!</strong> Password Lama Salah
                        </div>
                    <?php
                }
            }
            
        }

        public function getLastError(){
            return $this->error;
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
<?php

    class User
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
                $query = $this->db->prepare("INSERT INTO tbl_user(nama, no_hp, username, password, tgl_registrasi, session) VALUES(:nama, :no_hp, :username, :pass, NOW(), 'user')");
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

        public function loginUser($username, $password)
        {
            try
            {
                // Ambil data dari database
                $query = $this->db->prepare("SELECT * FROM tbl_user WHERE username = :username");
                $query->bindParam(":username", $username);
                $query->execute();
                $data = $query->fetch();

                // Jika jumlah baris > 0
                if($query->rowCount() > 0){
                    // jika password yang dimasukkan sesuai dengan yg ada di database
                    if(password_verify($password, $data['password'])){
                        $_SESSION['user_session'] = $data['id_user'];
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

        public function logout(){
            // Hapus session
            session_destroy();
            // Hapus user_session
            unset($_SESSION['user_session']);
            return true;
        }

        public function updateUser($fields = array(), $id_user) {

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
            $sql = "UPDATE tbl_user SET {$set} WHERE id_user={$id_user}";

            if ($this->db->prepare($sql)) {
                if ($this->db->exec($sql)) {
                    return true;
                }
            }

            return false;
        }

        public function ubahPassUser($id, $old, $new) {

            // cek old password

            $cek = "SELECT password FROM tbl_user WHERE id_user=:id";
            $stmt = $this->db->prepare($cek);
            $stmt->execute(array(":id"=>$id));
            $pass=$stmt->fetch(PDO::FETCH_ASSOC);

            $newPass = password_hash($new, PASSWORD_DEFAULT);

            if($stmt->rowCount()>0) {

                if(password_verify($old, $pass['password'])) {

                    // update new password
                    $new = "UPDATE tbl_user SET password='{$newPass}' WHERE id_user={$id}";

                    $stmtC = $this->db->prepare($new);
                    $stmtC->execute();

                    ?>
                        <div class="alert alert-success">
                            <strong>Password berhasil diganti!!</strong>
                        </div>
                    <?php
                    
                    return true;
                } else {

                    ?>
                        <div class="alert alert-danger">
                            <strong>Gagal mengubah password!</strong>
                        </div>
                    <?php
                }
            }
            
        }

        // Cek apakah User sudah login
        public function isUserLoggedIn(){
            // Apakah user_session sudah ada di session
            if(isset($_SESSION['user_session']))
            {
                if($_SESSION['user_role'] == 'user') 
                {
                    return true;
                }
            }
        }

        public function cekUserLogin() {

            if(!self::isUserLoggedIn()){
                header("location: login.php");
            }
        }

        // Ambil data user yang sudah login
        public function getUser(){
            // Cek apakah sudah login
            if(!$this->isUserLoggedIn()){
                return false;
            }

            try {
                // Ambil data Pengurus dari database
                $query = $this->db->prepare("SELECT * FROM tbl_user WHERE id_user = :id");
                $query->bindParam(":id", $_SESSION['user_session']);
                $query->execute();
                return $query->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getLastError(){
            return $this->error;
        }
    }
?>
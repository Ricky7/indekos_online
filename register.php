<?php
	require_once "class/Connect.php";
  	require_once "class/User.php";

  	$user = new User($db);
  	$datas = $user->getUser();
  	$data = $datas['session'];

  	if($user->isUserLoggedIn()){
      
      	switch ($data) {
        	case 'user':
	          header("location: index.php");
	          break;
	        
        	default:
	          header("location: login.php");
	          break;
      	}
  	}

  	if(isset($_POST['login'])){
	      $username = $_POST['username'];
	      $password = $_POST['password'];

	      // Proses login user
	      if($user->loginUser($username, $password)){
	          
	        switch ($data) {
	          case 'user':
	            header("location: index.php");
	            break;
	          
	          default:
	            header("location: login.php");
	            break;
	        }

	      }else{
	          // Jika login gagal, ambil pesan error
	          $error = $user->getLastError();
	      }
	  }

  	if(isset($_POST['submit'])){

  		$nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Proses register user
        if($user->register($nama, $no_hp, $username, $password)){
        	$success = true;
            //header("location: index.php");
        }else{
            // Jika register gagal, ambil pesan error
            $error = $user->getLastError();
        }
    }
?>
<?php
	include "header.php";
?>
<!---->
<div class="container">
	  <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Register</li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2>Belum Daftar? <span> Buat akun disini </span></h2>
			 <div class="registration_form">
			 <!-- Form -->
				<form method="post">
					<?php if (isset($error)): ?>
		              <div class="alert alert-danger">
		                  <?php echo $error ?>
		              </div>
			        <?php endif; ?>
			        <?php if (isset($success)): ?>
		              <div class="alert alert-success">
		                  Berhasil mendaftar. Silakan login!
		              </div>
			        <?php endif; ?>
					<div>
						<label>
							<input placeholder="Nama Anda" name="nama" type="text" tabindex="1" required autofocus>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="No HP" name="no_hp" type="text" tabindex="2" required autofocus>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="Username" name="username" type="text" tabindex="3" required>
						</label>
					</div>				
					<div>
						<label>
							<input placeholder="password" name="password" type="password" tabindex="4" required>
						</label>
					</div>						
					<div>
						<input type="submit" name="submit" value="create an account" id="register-submit">
					</div>
				</form>
				<!-- /Form -->
			 </div>
		 </div>
		 <div class="registration_left">
			 <h2>Sudah Register sebelumnya?</h2>
			 <div class="registration_form">
			 <!-- Form -->
				<form id="registration_form" method="post">
					<?php if (isset($error)): ?>
		              <div class="alert alert-danger">
		                  <?php echo $error ?>
		              </div>
			        <?php endif; ?>
					<div>
						<label>
							<input placeholder="Username" name="username" type="text" tabindex="3" required>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="Password" name="password" type="password" tabindex="4" required>
						</label>
					</div>						
					<div>
						<input type="submit" name="login" value="sign in" id="register-submit">
					</div>
				</form>
			 <!-- /Form -->
			 </div>
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>
<!-- end registration -->
<?php
	include "footer.php";
?>
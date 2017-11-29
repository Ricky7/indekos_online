<?php
	require_once "class/Connect.php";
  	require_once "class/User.php";
  	error_reporting(0);

  	$user = new User($db);
  	$datas = $user->getUser();
  	$data = $datas['session'];

  	$user->cekUserLogin();

  	if(isset($_POST['submit'])) {

      try {
        $user->updateUser(array(
          'nama' => $_POST['nama'],
          'no_hp' => $_POST['no_hp']
        ),$datas['id_user']);
        $success = true;
        header("Refresh:1");
      } catch (Exception $e) {
      die($e->getMessage());
      $error = true;
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
		  <li class="active">Profil</li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2>Profil Saya</h2>
			 <div class="registration_form">
			 <!-- Form -->
				<form method="post">
					<?php if (isset($error)): ?>
		              <div class="alert alert-danger">
		                  Gagal Update!
		              </div>
			        <?php endif; ?>
			        <?php if (isset($success)): ?>
		              <div class="alert alert-success">
		                  Berhasil Update!
		              </div>
			        <?php endif; ?>
					<div>
						<label>
							<input placeholder="Nama Anda" value="<?php echo $datas['nama'] ?>" name="nama" type="text" tabindex="1" required autofocus>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="No HP" value="<?php echo $datas['no_hp'] ?>" name="no_hp" type="text" tabindex="2" required autofocus>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="Username" value="<?php echo $datas['username'] ?>" name="username" type="text" tabindex="3" disabled>
						</label>
					</div>										
					<div>
						<input type="submit" name="submit" value="update profil" id="register-submit">
					</div>
				</form>
				<!-- /Form -->
			 </div>
		 </div>
		 <div class="registration_left">
			 <h2>Ubah Password</h2>
			 <div class="registration_form">
			 <!-- Form -->
				<form id="registration_form" method="post">
					<?php
			          if(isset($_POST['ubah'])) {
			  
			              try {
			                  $user->ubahPassUser($datas['id_user'], $_POST['pass_lama'], $_POST['pass_baru']);
			                  header("refresh: 5");
			                } catch (Exception $e) {
			                  die($e->getMessage());

			                }
			            }
			        ?>
					<div>
						<label>
							<input placeholder="Password Lama" name="pass_lama" type="password" tabindex="5" required>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="Password Baru" name="pass_baru" type="password" tabindex="6" required>
						</label>
					</div>						
					<div>
						<input type="submit" name="ubah" value="sign in" id="register-submit">
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
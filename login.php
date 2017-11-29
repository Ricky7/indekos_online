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

  	if(isset($_POST['submit'])){
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
?>
<?php
	include "header.php";
?>
<!---->
<div class="login_sec">
	 <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Login</li>
		 </ol>
		 <h2>Login</h2>
		 <div class="col-md-6 log">			 
			 <p>Selamat Datang, Silahkan Login terlebih dahulu.</p>
			 <form method="post">
			 	 <?php if (isset($error)): ?>
	              <div class="alert alert-danger">
	                  <?php echo $error ?>
	              </div>
		         <?php endif; ?>
				 <h5>User Name:</h5>	
				 <input type="text" name="username">
				 <h5>Password:</h5>
				 <input type="password" name="password">					
				 <input type="submit" name="submit" value="Login">
			 </form>				 
		 </div>
		  <div class="col-md-6 login-right">
			  	<h3>REGISTRASI BARU</h3>
				<p>Dengan membuat akun di marketplace kami, anda dapat melakukan pembookingan indekos. Dan bagi anda pemilik indekos, ini media yang bagus buat mempromosikannya.</p>
				<a class="acount-btn" href="register.php">Buat Akun</a>
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
<?php
	include "footer.php";
?>
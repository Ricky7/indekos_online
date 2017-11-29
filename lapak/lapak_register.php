
<?php

	require_once "../class/Connect.php";
  	require_once "../class/Seller.php";

  	$seller = new Seller($db);
  	$datas = $seller->getSeller();
  	$data = $datas['session'];

  	if($seller->isSellerLoggedIn()){
      
      	switch ($data) {
        	case 'seller':
	          header("location: lapak_index	.php");
	          break;
	        
        	default:
	          header("location: lapak_login.php");
	          break;
      	}
  	}

  	if(isset($_POST['submit'])){

  		$nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Proses login seller
        if($seller->register($nama, $no_hp, $username, $password)){
        	$success = true;
            //header("location: index.php");
        }else{
            // Jika login gagal, ambil pesan error
            $error = $seller->getLastError();
        }
    }

?>
<html>
<head>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Pengiklan</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width"/>

    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
</head>

<body style="background:#026466;">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3" style="padding-top:10px;">
				<h3 align="center" style="color:#fff;">Sistem Informasi Booking Indekos</h3>
				<center>
					<img src="../assets/images/indekos.jpg" width="500px" height="180px">
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4" style="padding-top:10px;">
				<h4 align="center" style="color:#fff;">Register Pengiklan</h4>
				<?php if (isset($error)): ?>
	              <div class="alert alert-danger">
	                  <?php echo $error ?>
	              </div>
		          <?php endif; ?>
		          <?php if (isset($success)): ?>
		              <div class="alert alert-success">
		                  <center>Berhasil mendaftar. Silakan <a href="lapak_login.php">masuk</a></center>
		              </div>
		          <?php endif; ?>
				<form method="post">
					<div class="form-group" >
				    <label style="color:#fff;">Nama</label>
				    <input type="text" class="form-control" name="nama" placeholder="Nama">
				  </div>
				  <div class="form-group" >
				    <label style="color:#fff;">No Hp</label>
				    <input type="text" class="form-control" name="no_hp" placeholder="No Handphone">
				  </div>
				  <div class="form-group" >
				    <label style="color:#fff;">Username</label>
				    <input type="text" class="form-control" name="username" placeholder="Username">
				  </div>
				  <div class="form-group">
				    <label style="color:#fff;">Password</label>
				    <input type="password" class="form-control" name="password" placeholder="Password">
				  </div>
				  <center>
				  	<button type="submit" name="submit" class="btn btn-success">Submit</button><br>
				  	<small style="color:#fff;">Sudah punya akun? masuk <a href="lapak_login.php">disini</a></small>
				  </center>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>
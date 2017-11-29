
<?php

	require_once "../class/Connect.php";
  	require_once "../class/Admin.php";

  	$admin = new Admin($db);
  	$datas = $admin->getAdmin();
  	$data = $datas['session'];

  	if($admin->isAdminLoggedIn()){
      
      	switch ($data) {
        	case 'admin':
	          header("location: adm_booking_pending.php");
	          break;
	        
        	default:
	          header("location: adm_login.php");
	          break;
      	}
  	}

  	if(isset($_POST['submit'])){
	      $username = $_POST['username'];
	      $password = $_POST['password'];

	      // Proses login admin
	      if($admin->login($username, $password)){
	          
	        switch ($data) {
	          case 'admin':
	            header("location: adm_booking_pending.php");
	            break;
	          
	          default:
	            header("location: adm_login.php");
	            break;
	        }

	      }else{
	          // Jika login gagal, ambil pesan error
	          $error = $admin->getLastError();
	      }
	  }

?>
<html>
<head>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Administrator</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
</head>

<body style="background:#8e4745;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4" style="padding-top:40px;">
				<center>
					<img src="../assets/images/admin-logo.png" width="250px" height="250px">
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4" style="padding-top:30px;">
				<h4 align="center" style="color:#fff;">Login Administrator</h4>
				<form method="post">
				  <div class="form-group" >
				    <label style="color:#fff;">Username</label>
				    <input type="text" class="form-control" name="username" placeholder="Username">
				  </div>
				  <div class="form-group">
				    <label style="color:#fff;">Password</label>
				    <input type="password" class="form-control" name="password" placeholder="Password">
				  </div>
				  <center>
				  	<button type="submit" name="submit" class="btn btn-success">Submit</button>
				  </center>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>
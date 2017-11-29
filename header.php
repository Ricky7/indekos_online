<!DOCTYPE HTML>
<html>
<head>
<title>Indekos Market</title>
<link href="assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary JavaScript plugins) -->
<script type='text/javascript' src="assets/js/jquery-1.11.1.min.js"></script>
<!-- Custom Theme files -->
<link href="assets/css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Furnyish Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Montserrat|Raleway:400,200,300,500,600,700,800,900,100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Aladin' rel='stylesheet' type='text/css'>
<!-- start menu -->
<link href="assets/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="assets/js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="assets/js/menu_jquery.js"></script>

<link href="assets/css/form.css" rel="stylesheet" type="text/css" media="all" />

  
</head>
<body>
<!-- header -->
<div class="top_bg">
	<div class="container">
		<div class="header_top-sec">
			<div class="top_right">
				<ul>
					<li>
						<?php
		                    if(!$user->isUserLoggedIn()){

		                        ?>
		                            <p>Guest</p>
		                        <?php
		                    } else {

		                        ?>
		                            <p><a href="#"><?php echo $datas['nama'] ?></a></p>
		                        <?php
		                    }
		                ?>
					</li>|
					
				</ul>
			</div>
			<div class="top_left">
				<ul>
					<li class="top_link">Email: <a href="#">indekos(at)Marketplace.com</a></li>|
					<li class="top_link"><a href="profil.php">Akun Saya</a></li>|
					<li class="top_link"><a href="cart.php"><img src="assets/images/bag.png" alt=""></a></li>|						
				</ul>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="header_top">
	 <div class="container">
		 <div class="logo col-md-2">
		 	<a href="index.php"><img src="assets/images/home-icon.png" alt="" width="50px" height="120px"/></a>			 
		 </div>
		 <div class="col-md-10">
		 	<br><br>
		 	<marquee><font color="blue">Ini Tulisan Berjalan Hahahahahahahaha LOL!!</font></marquee>
		 </div>
		 
		  <div class="clearfix"></div>	
	 </div>
</div>
<!--cart-->
	 
<!------>
<div class="mega_nav">
	<div class="container">
		<div class="menu_sec">
			<!-- start header menu -->
			<ul class="megamenu skyblue">
				<li class="grid"><a class="color6" href="index.php">Home</a></li>
				<li class="grid"><a class="color6" href="index.php?kelas=Ekonomi">Ekonomi</a></li>
				<li><a class="color6" href="index.php?kelas=VIP">VIP</a></li>				
				<li><a class="color6" href="index.php?kelas=Eksekutif">Eksekutif</a></li>
				<?php
                    if(!$user->isUserLoggedIn()){

                        ?>
                            <li><a class="color6" href="login.php">Login/Register</a></li>
                            <li><a class="color6" href="lapak/lapak_login.php">Pengiklan</a></li>
                        <?php
                    } else {

                        ?>  
							<li class="grid"><a class="color6" href="#">Booking</a>
								<div class="megapanel">
									<div class="row">
										<div class="col-md-3 col1">
											<div class="h_nav">
												<ul>
													<li><a href="bayar_booking.php">Bayar Booking</a></li>
													<li><a href="proses_booking.php">Proses Booking</a></li>
													<li><a href="selesai_booking.php">Selesai Booking</a></li>
												</ul>	
											</div>							
										</div>
										
									</div>
				    			</div>
							</li>
							<li><a class="color6" href="logout.php">Logout</a></li>
                        <?php
                    }
                ?>
				
				
			</ul> 
		    <div class="search">
			    <form action="search.php" method="get">
					<input type="text" name="search" placeholder="Search...">
					<input type="submit" value="">
				</form>
		    </div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!---->
<!--header//-->
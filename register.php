<?php 
	require_once 'config/config.php';
	require_once 'config/common.php';


	 if ($_POST) {
      if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['address']) || empty($_POST['password']) || strlen($_POST['password']) < 4  ) {
        if (empty($_POST['name'])) {
          $nameError = 'Name cannot be empty !';
        }
        if (empty($_POST['email'])) {
          $emailError = 'Email cannot be empty !';
        }
        if (empty($_POST['phone'])) {
          $phoneError = 'phone cannot be empty !';
        }
        if (empty($_POST['address'])) {
          $addressError = 'address cannot be empty !';
        }
        if (empty($_POST['password'])) {
          $passwordError = 'Password cannot be empty !';
        }
        if (strlen($_POST['password'] ) < 4  ) {
          $passwordError = 'Password must be at least 5 chararcter ! ';
        }
              }
      else{
      	 $name = $_POST['name'];
		 $email = $_POST['email'];
		 $phone = $_POST['phone'];
		 $address = $_POST['address'];
		 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		 $stmt = $pdo -> prepare("SELECT * FROM users WHERE email=:email");
		 $result = $stmt -> execute(array(
		 		   ':email' => $email
		 		));

		 $user = $stmt->fetchAll();

		 if ($user) {
		 	echo "<script>alert('user already existed!')</script>";
		 }
		 else{
		 $stmt = $pdo -> prepare("INSERT INTO users(name,email,phone,address,password) VALUES(:name,:email,:phone,:address,:password)");
		 $result = $stmt -> execute(array(
		 		':name' => $name , ':email' => $email, ':phone' => $phone , ':address' => $address, 
		 		':password' => $password
		 ));
		 if ($result) {
		 	echo "<script>alert('Register Success!');window.location.href='login.php'</script>";
		   }
		  		
		}
	}

       }    
    


 ?>




<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>

	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Login/Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">				
				<div class="col-lg-12">
					<div class="login_form_inner">
						<h3>Register</h3>
						<form class="row login_form" action="register.php" method="post" id="contactForm" novalidate="novalidate">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" 
								style="<?php echo empty($nameError) ? ''  : 'border: 1px solid red;'?>" 
								placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">

								<input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>">
							</div>
							<p class="text-danger  text-uppercase font-weight-bold ml-3"><?php echo empty($nameError) ? '' : $nameError; ?> </p>

							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="email"
								style="<?php echo empty($emailError) ? ''  : 'border: 1px solid red;'?>"
								 placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<p class="text-danger  text-uppercase font-weight-bold ml-3"><?php echo empty($emailError) ? '' : $emailError; ?> </p>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="phone" 
								style="<?php echo empty($phoneError) ? ''  : 'border: 1px solid red;'?>"
								placeholder="Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<p class="text-danger  text-uppercase font-weight-bold ml-3"><?php echo empty($phoneError) ? '' : $phoneError; ?> </p>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="address" 
								style="<?php echo empty($addressError) ? ''  : 'border: 1px solid red;'?>"
								placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<p class="text-danger  text-uppercase font-weight-bold ml-3"><?php echo empty($addressError) ? '' : $addressError; ?> </p>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="name" name="password" 
								style="<?php echo empty($passwordError) ? ''  : 'border: 1px solid red;'?>"
								placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>	
							<p class="text-danger  text-uppercase font-weight-bold ml-3"><?php echo empty($passwordError) ? '' : $passwordError; ?> </p>						
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Register</button>
								<a href="login.php"  value= "Back" class="btn btn-danger text-white"> Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
							magna aliqua.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
													<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
												</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>  Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->


	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
<?php
include "../instance/instace.php";
include "../Class/vehicul.php";
include "../Class/rate.php";
$vehicul = new vehicul($pdo);
$rate = new rate($pdo);
$car = $vehicul->singleVehicul()["result"][0];
$myrate = $rate->getMyReview($_COOKIE["userID"], $_GET["VID"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="home.php">Car<span>Book</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
				aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu">Menu</span>
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
					<li class="nav-item"><a href="myReservations.php" class="nav-link">MyReservation</a></li>
					<li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>
					<li class="nav-item active"><a href="car.php" class="nav-link">Cars</a></li>
					<li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
					<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
				<div class="col-md-9 ftco-animate pb-5">
					<p class="breadcrumbs"><span class="mr-2"><a href="home.php">Home <i
									class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i
								class="ion-ios-arrow-forward"></i></span></p>
					<h1 class="mb-3 bread">Car Details</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-car-details">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="car-details">
						<div class="img rounded" style="background-image: url(<?php echo $car["vehiculImage"] ?>);">
						</div>
						<div class="text text-center">
							<span class="subheading"><?php echo $car["vehiclesName"] ?></span>
							<h2><?php echo $car["vehiclestype"] ?></h2>
						</div>
					</div>
				</div>
			</div>

			<!-- Review Form -->
			<div class="row mt-5">
				<div class="col-md-8 offset-md-2">
					<h3 class="mb-4">Add Your Review</h3>
					<form method="POST" action="../controllers/addrating.php">
						<div class="form-group">
							<label for="rating">Rating (1-5)</label>
							<input type="number" name="user_id" hidden value="<?php echo $_COOKIE["userID"]; ?>">
							<input type="number" name="car_id" hidden value="<?php echo $_GET["VID"]; ?>">
							<input type="number" class="form-control" id="rating" name="rating" min="1" max="5"
								required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit Review</button>
						</div>
					</form>

					<!-- Display Rating Section -->
					<div class="mt-4">
						<h4>Your Rating:</h4>
						<?php 
						if ($myrate['status']==1){
							echo  "<p id='rating-display'>No rating submitted yet.</p>";
						}else{
							echo  "<p id='rating-display'>".$myrate["message"]."/5</p>";
						}
						?>
					</div>
				</div>
			</div>

		</div>
	</section>

	<footer class="ftco-footer ftco-bg-dark ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<p>Copyright &copy;
						<script>document.write(new Date().getFullYear());</script> All rights reserved | Template by
						Colorlib
					</p>
				</div>
			</div>
		</div>
	</footer>
</body>

</html>
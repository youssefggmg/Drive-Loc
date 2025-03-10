<?php
include "../Class/vehicul.php";
include "../instance/instace.php";
include "../Class/roleValidation.php";
include "../Class/catigory.php";

$roleValidation = new roleValidation();
$roleValidation->isUser();
$vehicul = new vehicul($pdo);
$catigory = new catigory($pdo);
$allcatigorys = $catigory->getAllCategories()["categories"];
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$totalRows = $vehicul->totleCars();
$rowsPerPage = 5;
$totalPages = ceil($totalRows / $rowsPerPage);
$allcars = $vehicul->allVehiculs($page);

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
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="home.php">Car<span>Book</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
				aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="myReservations.php" class="nav-link">MyReservation</a></li>
					<li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>
					<li class="nav-item active"><a href="car.php" class="nav-link">Cars</a></li>
					<li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
					<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->

	<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
				<div class="col-md-9 ftco-animate pb-5">
					<p class="breadcrumbs"><span class="mr-2"><a href="home.php">Home <i
									class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i
								class="ion-ios-arrow-forward"></i></span></p>
					<h1 class="mb-3 bread">Choose Your Car</h1>
				</div>
			</div>
		</div>
	</section>


	<section class="ftco-section bg-light">
		<select id="categorySelect" name="categorySelect" onchange="changeContent(this)"
			class="block w-40 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none float-right ">
			<?php
			foreach ($allcatigorys as $catigory) {
				echo "<option value='" . htmlspecialchars($catigory["catigoryName"]) . "'>" . htmlspecialchars($catigory["catigoryName"]) . "</option>";
			}
			?>
		</select>


		<div class="container">
			<div class="row" id="carsList">
				<?php
				foreach ($allcars['allVehicules'] as $car) {
					echo "<div class='col-md-4'>
        <div class='car-wrap rounded ftco-animate'>
            <div class='img rounded d-flex align-items-end'
                style='background-image: url(" . $car['vehiculImage'] . ");'>
            </div>
            <div class='text'>
                <h2 class='mb-0'><a href='car-single.php'>" . $car['vehiclesName'] . "</a></h2>
                <div class='d-flex mb-3'>
                    <span class='cat'>" . $car['vehiclestype'] . "</span>
                    <p class='price ml-auto'>" . $car['rent'] . "<span>/day</span></p>
                </div>
                <p class='d-flex mb-0 d-block'><a href='car-single.php?VID=" . $car['vehiclesID'] . "' class='btn btn-primary py-2 mr-1'>details</a>
                    <a href='reservation.php?VID=" . $car['vehiclesID'] . "' class='btn btn-secondary py-2 ml-1'>book</a>
                </p>
            </div>
        </div>
    </div>";
				}
				?>
			</div>

			<div class="row mt-5">
				<div class="col text-center">
					<div class="block-27">
						<ul>
							<?php for ($i = 1; $i <= $totalPages; $i++): ?>
								<li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
							<?php endfor; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>


	<footer class="ftco-footer ftco-bg-dark ftco-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2"><a href="#" class="logo">Car<span>book</span></a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
							there live the blind texts.</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Information</h2>
						<ul class="list-unstyled">
							<li><a href="#" class="py-2 d-block">About</a></li>
							<li><a href="#" class="py-2 d-block">Services</a></li>
							<li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
							<li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
							<li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Customer Support</h2>
						<ul class="list-unstyled">
							<li><a href="#" class="py-2 d-block">FAQ</a></li>
							<li><a href="#" class="py-2 d-block">Payment Option</a></li>
							<li><a href="#" class="py-2 d-block">Booking Tips</a></li>
							<li><a href="#" class="py-2 d-block">How it works</a></li>
							<li><a href="#" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain
										View, San Francisco, California, USA</span></li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929
											210</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span
											class="text">info@yourdomain.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;
						<script>document.write(new Date().getFullYear());</script> All rights reserved | This template
						is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a
							href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</footer>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" />
		</svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/jquery.timepicker.min.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>
	<script>
		const carsList = document.querySelector("#carsList");
		async function changeContent(select) {
			const theValue = select.value;
			const data = await fetch(`../controllers/filteredcars.php?name=${theValue}`);
			const response = await data.json();
			carsList.innerHTML = "";
			response.map((car) => {
				console.log(car.vehiculImage);
				
				carsList.innerHTML += `<div class='col-md-4'>
							<div class='car-wrap rounded ftco-animate'>
								<div class='img rounded d-flex align-items-end'
									style='background-image: url(  ${car.vehiculImage} );'>
								</div>
								<div class='text'>
									<h2 class='mb-0'><a href='car-single.php'> fhsjkdfhjsdhfkjsdhfkjsdhf  </a></h2>
									<div class='d-flex mb-3'>
										<span class='cat'>  fhsjkdhfjksdhfkjs  </span>
										<p class='price ml-auto'>  hfudhsfsduif  <span>/day</span></p>
									</div>
									<p class='d-flex mb-0 d-block'><a href='car-single.php?VID= ${car.vehiclesID}' class='btn btn-primary py-2 mr-1'>details</a>
										<a href='reservation.php?VID=  ${car.vehiclesID}' class='btn btn-secondary py-2 ml-1'>book</a>
									</p>
								</div>
							</div>
						</div>`
			})
		}
	</script>

</body>

</html>
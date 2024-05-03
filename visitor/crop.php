<?php
session_start();
require "../functions/connections.php";
require "../functions/functions.php";
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travis | Crops</title>

	<!-- BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<!-- font awesome kit -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

	<!-- LEAFLET -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<!-- CUSTOM CSS -->
	<!-- global -->
	<link rel="stylesheet" href="../css/global-declarations.css">
	<!-- landing.css -->
	<link rel="stylesheet" href="css/crop.css?v=1.0">
</head>

<body class="bg-light">
	<!-- NAVBAR -->
	<?php require "../nav/nav.php" ?>

	<!-- FILTER -->
	<?php // require "filter/filter.php" 
	?>

	<!-- LIST -->
	<?php // require "list/list.php" 
	?>

	<!-- CATEGORY FILTER -->
	<div class="modal fade" id="categ-filter-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h1 class="modal-title mx-auto fs-6 fw-bold" id="staticBackdropLabel">Choose Category</h1>
				</div>

				<div class="modal-body d-flex justify-content-around">

					<!-- corn -->
					<a href="corn.php" class="card categ-card w-25 link-underline link-underline-opacity-0">
						<div class="card-body d-flex flex-column justify-content-center align-items-center">
							<img class="categ-card-icon mb-2" src="img/black-corn.svg" alt="" srcset="">
							<div class="fw-bold fs-5">Corn</div>
						</div>
					</a>

					<!-- rice -->
					<a href="rice.php" class="card categ-card w-25 link-underline link-underline-opacity-0">
						<div class="card-body d-flex flex-column justify-content-center align-items-center">
							<img class="categ-card-icon mb-2" src="img/black-rice.svg" alt="" srcset="">
							<div class="fw-bold fs-5">Rice</div>
						</div>
					</a>

					<!-- root -->
					<a href="root.php" class="card categ-card w-25 link-underline link-underline-opacity-0">
						<div class="card-body d-flex flex-column justify-content-center align-items-center">
							<img class="categ-card-icon mb-2" src="img/black-root.svg" alt="" srcset="">
							<div class="fw-bold fs-5">Root</div>
						</div>
					</a>

				</div>
			</div>
		</div>
	</div>

	<!-- SCRIPT -->
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<!-- bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<!-- custom -->
	<script src="js/nav.js"></script>
	<script src="js/crop.js"></script>

</body>

</html>
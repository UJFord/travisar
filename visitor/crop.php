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
	<!-- icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
	<div class="container h-75">
		<div class="row h-100 d-flex justify-content-center align-items-center">
			<div class="col-7 p-0">

				<div class="d-flex justify-content-center">
					<span class="fw-bold mb-2">Choose Category</span>
				</div>
				<div class="col-12 border rounded-4 overflow-hidden filter-h">
					<div class="row h-100 p-0">
						<div class="col p-0">

							<a href="" id="all-crop-link" class="h-100 w-100 d-flex justify-content-end align-items-end icon-link icon-link-hover link-underline link-underline-opacity-0 p-0 pb-2 border-3 border-end link-light">
								<span>All Crops</span>
								<i class="bi bi-arrow-right fs-3 me-2"></i>
							</a>

						</div>
						<div class="col d-flex flex-column align-items-stretch p-0 m-0">

							<a href="" id="corn-link" class=" d-flex justify-content-end align-items-end icon-link icon-link-hover filter-item link-underline link-underline-opacity-0 p-0 m-0 pb-2 border-3 border-bottom link-light">
								<span class="me-4">Corn</span>
								<i class="bi bi-arrow-right fs-3 me-4"></i>
							</a>

							<a href="" id="rice-link" class=" d-flex justify-content-end align-items-end icon-link icon-link-hover filter-item link-underline link-underline-opacity-0 p-0 m-0 pb-2 border-3 border-bottom link-light">
								<span class="me-4">Rice</span>
								<i class="bi bi-arrow-right fs-3 me-4"></i>
							</a>

							<a href="" id="root-link" class=" d-flex justify-content-end align-items-end icon-link icon-link-hover filter-item link-underline link-underline-opacity-0 p-0 m-0 pb-2 link-light">
								<span class="me-4">Root</span>
								<i class="bi bi-arrow-right fs-3 me-4"></i>
							</a>
						</div>
					</div>
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
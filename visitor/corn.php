<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travis | Corn</title>

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
    <link rel="stylesheet" href="css/crop.css">
</head>

<body class="bg-light">
    <!-- NAVBAR -->
    <?php require "../nav/nav.php" ?>

    <div class="container-fluid border-bottom mt-">
        <div class="container">
            <div class="row">

                <!-- category filter -->
                <a href="#" class="col-1 bar-filter-categ border-bottom border-success border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                    <img class="categ-link-img" src="img/corn-svgrepo-com.svg" alt="" srcset="">
                    <div class="fw-bold">Corn</div>
                </a>
                <a href="rice.php" class="col-1 bar-filter-categ border-bottom border-light border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                    <img class="categ-link-img" src="img/rice-grain-svgrepo-com.svg" alt="" srcset="">
                    <div class="fw-bold">Rice</div>
                </a>
                <a href="root.php" class="col-1 bar-filter-categ border-bottom border-light border-5 link-opacity-50-hover link-dark py-2 px-4 d-flex flex-column justify-content-center align-items-center  link-underline link-underline-opacity-0">
                    <img class="categ-link-img" src="img/carrot-svgrepo-com.svg" alt="" srcset="">
                    <div class="fw-bold">Root</div>
                </a>

                <!-- divider -->
                <div class="col"></div>

                <!-- view type -->
                <div class="col-1 d-flex justify-content-center alight-items-center">
                    <button class="btn btn-light border m-2 px-3 py-0" type="button">
                        <i class="fa-solid fa-grip fs-4 text-body"></i>
                    </button>
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
</body>

</html>
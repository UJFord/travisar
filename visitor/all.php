<?php
require "../functions/connections.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travis | Corn</title>

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
    <link rel="stylesheet" href="css/crop.css">
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body class="bg-light vh-100 pb-5">
    <!-- NAVBAR -->
    <?php require "../nav/nav.php" ?>

    <!-- CATEGORY FILTER -->
    <?php require "filter/categ-filter.php" ?>

    <div class="container my-4">
        <div class="row">

            <!-- FILTER -->
            <?php require "filter/side-filter.php" ?>

            <!-- LIST -->
            <div id="crop-list-container" class="col">

                <!-- table -->
                <?php require "list/table-list.php" ?>

                <!-- grid -->
                <?php require "list/grid-list.php" ?>

                <!-- map -->
                <div id="crop-list-map" class="overflow-y-auto row d-none">
                    <div id="mapList" class="col rounded"></div>
                </div>

            </div>
        </div>

        <!-- pagination -->
        <div class="row mt-2">
            <nav class=" d-flex justify-content-end">
                <ul class="pagination ">
                    <li class="page-item">
                        <a class="page-link bg-light small-font link-dark fw-semibold" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link bg-light small-font link-dark fw-semibold" href="#">1</a></li>
                    <li class="page-item"><a class="page-link bg-light small-font link-dark fw-semibold" href="#">2</a></li>
                    <li class="page-item"><a class="page-link bg-light small-font link-dark fw-semibold" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link bg-light small-font link-dark fw-semibold" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Add pagination links -->
        <?php // generatePaginationLinks($total_pages, $current_page, 'page'); 
        ?>
    </div>

    <!-- map toggler -->
    <button role="button" id="map-toggler" class="fixed-bottom rounded-pill bg-dark bg-gradient py-2 mb-5 text-light d-flex justify-content-center align-item-center  link-underline link-underline-opacity-0">
        <span class="map-toggle"><i class="fa-solid fa-map me-2"></i>Map View</span>
        <span class="list-toggle d-none"><i class="fa-solid fa-list me-2"></i>List View</span>
    </button>

    <!-- SCRIPT -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom -->
    <script src="js/nav.js"></script>
    <script src="js/sideFilter.js"></script>
    <script src="js/list.js"></script>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | Crops</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- CUSTOM CSS -->
    <!-- global -->
    <link rel="stylesheet" href="../css/global-declarations.css?v=1.0">
    <!-- landing.css -->
    <link rel="stylesheet" href="css/landing.css?v=1.0">
</head>

<body class="bg-light">
    <!-- NAVBAR -->
    <?php require "nav/nav.php" ?>

    <!-- FILTER -->
    <?php require "filter/filter.php" ?>

    <!-- LIST -->
    <div class="container my-4">
        <!-- result counter -->
        <div class="row">
            <div class="container small-font fw-semibold mb-2 ms-2">
                Showing Results <span class="text-primary">1-10</span> out of <span class="text-primary">254</span>
            </div>
        </div>
        <div class="row">
            <!-- Crop List Table -->
            <div class="col-3">
                <div class="border rounded">
                    <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <!-- header -->
                        <thead>
                            <tr class="">
                                <th scope="col" class="list-head col-3 small-font fw-semibold text-secondary">Category</th>
                                <th scope="col" class="list-head col-auto small-font fw-semibold text-secondary">Variety</th>
                            </tr>
                        </thead>
                        <!-- crops -->
                        <tbody id="crop-list-tbody">

                            <tr class="" latlng="5.993051, 124.902595">
                                <td class="text-secondary category">Corn</td>
                                <td class="fw-bold overflow-x-auto variety">Sweet Corn</td>
                            </tr>

                            <tr class="" latlng="6.044417, 125.068459">
                                <td class="text-secondary category">Rice</td>
                                <td class="fw-bold overflow-x-auto variety">Sinandomeng</td>
                            </tr>

                            <tr class="" latlng="5.918100, 124.976681">
                                <td class="text-secondary category">Root</td>
                                <td class="fw-bold overflow-x-auto variety">Kamote</td>
                            </tr>

                            <tr class="" latlng="5.929157, 125.358780">
                                <td class="text-secondary category">Root</td>
                                <td class="fw-bold overflow-x-auto variety">Carrot</td>
                            </tr>
                            </tr>

                            <tr class="" latlng="6.096458, 125.383249">
                                <td class="text-secondary category">Root</td>
                                <td class="fw-bold overflow-x-auto variety">Malunggay</td>
                            </tr>
                            </tr>

                            <tr class="" latlng="6.216882, 125.270079">
                                <td class="text-secondary category">Corn</td>
                                <td class="fw-bold overflow-x-auto variety">Mais</td>
                            </tr>
                            </tr>

                            <tr class="" latlng="6.123091, 125.131409">
                                <td class="text-secondary category">Rice</td>
                                <td class="fw-bold overflow-x-auto variety">RC-160</td>
                            </tr>
                            </tr>

                            <tr class="" latlng="5.943503, 125.217926">
                                <td class="text-secondary category">Root</td>
                                <td class="fw-bold overflow-x-auto variety">Gabi</td>
                            </tr>
                            </tr>

                            <tr class="" latlng="5.877253, 125.234406">
                                <td class="text-secondary category">Rice</td>
                                <td class="fw-bold overflow-x-auto variety">Bordagol</td>
                            </tr>
                            </tr>

                            <tr class="" latlng="6.063304, 125.092239">
                                <td class="text-secondary category">Corn</td>
                                <td class="fw-bold overflow-x-auto variety">Bulad</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- pagination -->
                <nav class="d-flex justify-content-end py-2" aria-label="">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link small-font text-dark fw-semibold btn-light" href="#" aria-label="Previous">
                                <span aria-hidden="true"><i class="fa-solid fa-arrow-left-long"></i></span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link small-font text-dark fw-semibold" href="#">1</a></li>
                        <li class="page-item"><a class="page-link small-font text-dark fw-semibold" href="#">2</a></li>
                        <li class="page-item"><a class="page-link small-font text-dark fw-semibold" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link small-font text-dark fw-semibold btn-light" href="#" aria-label="Next">
                                <span aria-hidden="true"><i class="fa-solid fa-arrow-right-long"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div id="map" class="col-9 border rounded">

            </div>
        </div>
    </div>


    <!-- SCRIPT -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom -->
    <script src="js/crop.js"></script>
</body>

</html>
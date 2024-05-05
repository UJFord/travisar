<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travis | Crops</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/travis-light.svg">
    <!-- CSS -->
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- font awesome kit -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- CUSTOM CSS -->
    <!-- global -->
    <link rel="stylesheet" href="../css/global-declarations.css">
    <link rel="stylesheet" href="css/view.css">
    <!-- script for access control -->
    <script src="../js/access-control.js"></script>
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
    </script>
</head>

<body class="bg-light">


    <!-- NAVBAR -->
    <?php require "../nav/nav.php" ?>

    <!-- CROP TITLE -->
    <div class="container-fluid bg-white">
        <div class="title row py-4 mb-4">
            <h2 class="info-title text-center">Sinandomeng</h2>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <!-- INFORMATION -->
            <h4 class="info-title col-12">General</h4>
            <div class="col-6">
                <!-- GENERAL TABLE -->
                <div class="table-container border rounded oveflow-hidden mb-4">

                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Category</th>
                                <td id="crop-categ" class="w-75 fw-semibold">Rice</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Variety</th>
                                <td class="w-75 fw-semibold">Sinandomeng</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Local Name</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Meaning of Name</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Terrain</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Description</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="latlng-container text-secondary w-25 fw-normal" latlng="5.911948, 125.072803">Location</th>
                                <td id="addr" class="w-75 fw-semibold"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <!-- MORPHOLOGY TABLE -->
                <h4 class="info-title col-12">Morphological Traits</h4>
                <div class="table-container border rounded oveflow-hidden mb-4">

                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Plant Height</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Size</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Meaning of Name</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Yield Capacity</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Size</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Shape</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Color</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <!-- SENSORY TRAITS -->
                <h4 class="info-title col-12">Sensory Traits</h4>
                <div class="table-container border rounded oveflow-hidden mb-4">

                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Aroma</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Quality of Cooked Rice</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Quality of Leftover Rice</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Volume Expansion</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Glutinousity</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Hardness</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <!-- AGRONOMIC -->
                <h4 class="info-title col-12">Agronomic Traits</h4>
                <div class="table-container border rounded oveflow-hidden mb-4">

                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Pest Resistance</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Disease Resistance</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Resistance to Abiotic Stress</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <!-- IMPORTANCE -->
                <h4 class="info-title col-12">Utilization and Cultural Importance</h4>
                <div class="table-container border rounded oveflow-hidden mb-4">

                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Significance</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Use</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Indigenous Utilization</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Remarkable Feature</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <!-- REFERENCE -->
                <h4 class="info-title col-12">References</h4>
                <div class="table-container border rounded oveflow-hidden mb-4">

                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Links</th>
                                <td class="w-75 fw-semibold w-75">
                                    <ul class="list-unstyled">
                                        <li><a href="http://google.com">http://google.com</a></li>
                                        <li><a href="http://outube.com">http://outube.com</a></li>
                                        <li><a href="http://leid.com">http://leid.com</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="col-6 ps-4">
                <div class="row mb-4">
                    <!-- MAP -->
                    <div id="map" class="w-100 rounded"></div>
                </div>

                <!-- IMAGES -->
                <!-- SEED -->
                <div class="row mb-4">
                    <h5 class="info-title ps-0">Seed</h5>
                    <div class="image-carousel d-flex rounded px-0">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1563760836797-bf5d5f9d2243?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1542990253-a781e04c0082?q=80&w=1994&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src=https://plus.unsplash.com/premium_photo-1678652878787-e3d721cb50f5?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                    </div>
                </div>

                <!-- VEGETATIVE -->
                <div class="row mb-4">
                    <h5 class="info-title ps-0">Vegetative State</h5>
                    <div class="image-carousel d-flex rounded px-0">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1516684732162-798a0062be99?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1592997572594-34be01bc36c7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1610663711502-35f870cfaea2?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1613758235256-43a7bdc21d82?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1589646937766-872f1d9a30a4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                    </div>
                </div>

                <!-- REPRODUCTIVE -->
                <div class="row mb-4">
                    <h5 class="info-title ps-0">Reproductive State</h5>
                    <div class="image-carousel d-flex rounded px-0">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1590779033100-9f60a05a013d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1597362925123-77861d3fbac7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1540420773420-3366772f4999?q=80&w=1968&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://plus.unsplash.com/premium_photo-1675798983878-604c09f6d154?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                        <img class="rounded m-2 ms-0" src="https://images.unsplash.com/photo-1533321942807-08e4008b2025?q=80&w=1959&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
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
    <script src="js/view.js"></script>
</body>

</html>
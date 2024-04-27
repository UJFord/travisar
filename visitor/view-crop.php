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
    <!-- NAVBAR -->
    <?php require "view-tab/crop.php" ?>

    <!-- CROP -->
    <div class="container">
        <div class="row p-5">
            <!-- Info -->
            <div class="col-6">
                <!-- General -->
                <h5 class="fw-semibold">General</h5>
                <div class="border rounded  mb-5">
                    <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Crop Category</th>
                                <td class="w-75 fw-semibold w-75">Rice</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Variety</th>
                                <td class="w-75 fw-semibold">Upland</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Local Name</th>
                                <td class="w-75 fw-semibold">Sinandomeng</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Meanig of Name</th>
                                <td class="w-75 fw-semibold">Mahusay</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Terrain</th>
                                <td class="w-75 fw-semibold">Flat</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Description</th>
                                <td class="w-75 fw-semibold"></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Image</th>
                                <td class="w-auto fw-semibold">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded" alt="" srcset="">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Vegetative Stage Image</th>
                                <td class="w-75 fw-semibold">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded m-1" alt="" srcset="">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded m-1" alt="" srcset="">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded m-1" alt="" srcset="">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded m-1" alt="" srcset="">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded m-1" alt="" srcset="">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded m-1" alt="" srcset="">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded m-1" alt="" srcset="">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Reproductive Stage Image</th>
                                <td class="w-75 fw-semibold">
                                    <img src="https://plus.unsplash.com/premium_photo-1669689974101-55f9aea22158?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="view-crop-image rounded" alt="" srcset="">
                                </td>
                            </tr>
                            <tr>
                                <th id="latlng-container" scope="row" class="text-secondary w-25 fw-normal" latlng="6.022699, 125.061098">Location</th>
                                <td class="w-75 fw-semibold">
                                    Sitio, Barangay, Municipaly, City, Sarangani
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Morphology -->
                <h5 class="fw-semibold">Morphological Traits</h5>
                <div class="border rounded mb-5">
                    <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Plant Height</th>
                                <td class="w-75 fw-semibold w-75">110 cm</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Width</th>
                                <td class="w-75 fw-semibold">4 cm</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Length</th>
                                <td class="w-75 fw-semibold">23cm</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Meaning of Name</th>
                                <td class="w-75 fw-semibold">Mahusay</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Yield Capacity</th>
                                <td class="w-75 fw-semibold">1 on per Month</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Length</th>
                                <td class="w-75 fw-semibold">2cm</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Width</th>
                                <td class="w-75 fw-semibold">234cm</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Shape</th>
                                <td class="w-75 fw-semibold">Oblong</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Color</th>
                                <td class="w-75 fw-semibold">Fuishia</td>
                            </tr>
                        </tbody>
                    </table>
                </div>




                <!-- Sensory -->
                <h5 class="fw-semibold">Sensory Traits</h5>
                <div class="border rounded mb-5">
                    <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Aroma</th>
                                <td class="w-75 fw-semibold w-75">Sour</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Quality of Cooked Rice</th>
                                <td class="w-75 fw-semibold w-75">Soft</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Quality of Leftover Rice</th>
                                <td class="w-75 fw-semibold w-75">Soft</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Volumne Expansion</th>
                                <td class="w-75 fw-semibold w-75">Rises</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Glutinousty</th>
                                <td class="w-75 fw-semibold w-75">Yes</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Hardess</th>
                                <td class="w-75 fw-semibold w-75">Soft</td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <!-- Agronomy -->
                <h5 class="fw-semibold">Agronomic Traits</h5>
                <div class="border rounded mb-5">
                    <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Pest Resistance</th>
                                <td class="w-75 fw-semibold w-75">Ants, Birds, Earworms, Hoppers</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Disease Resistance</th>
                                <td class="w-75 fw-semibold w-75">Viral</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Resistance to Abiotic Stress</th>
                                <td class="w-75 fw-semibold w-75">Drought, Heat, Other</td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <!-- Importance -->
                <h5 class="fw-semibold">Importance</h5>
                <div class="border rounded mb-5">
                    <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Significance</th>
                                <td class="w-75 fw-semibold w-75">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, impedit eveniet totam doloribus in maxime at ullam. Iure asperiores sapiente quos temporibus assumenda corrupti itaque.</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Use</th>
                                <td class="w-75 fw-semibold w-75">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae soluta eaque dolor ad! Sit delectus velit, quaerat dolorum omnis et veritatis quia nam, voluptate obcaecati inventore architecto ipsam dolore? Eum quas corrupti odio molestias!</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Indegenous Utilization</th>
                                <td class="w-75 fw-semibold w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias hic dolores ullam iusto, commodi vel adipisci accusamus explicabo aut doloribus voluptate numquam amet rem et! Vero in, blanditiis illum repudiandae voluptates recusandae dolorem saepe.</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary w-25 fw-normal">Remarkable Features</th>
                                <td class="w-75 fw-semibold w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni ab voluptatem delectus, nam illo earum recusandae repudiandae odit quo cupiditate, praesentium iure reiciendis veritatis ipsum? Eaque repellat consequatur sint aspernatur suscipit quos quisquam exercitationem?</td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <!-- References -->
                <h5 class="fw-semibold">References</h5>
                <div class="border rounded mb-5">
                    <table id="crop-list-box" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                        <thead>
                        </thead>
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
            <!-- Map -->
            <div class="col-6">
                <div id="map" class="rounded"></div>
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
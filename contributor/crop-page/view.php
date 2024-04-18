<?php
require "../../functions/connections.php";
require "../../functions/functions.php";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banay-Banay</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        .nav-link.active {
            color: #f5f5f5 !important;
            background: #016A70 !important;
            /* Change 'green' to your desired success color */
        }

        .nav-link:hover {
            background: #709091;
            color: #f5f5f5 !important;
        }

        .small-font {
            font-size: 0.8rem;
        }

        /* smaller size scrollbar */
        .custom-scrollbar {
            scrollbar-width: thin;
        }

        /* limit image sizes */

        .image-container-size {
            min-height: 5rem !important;
        }

        .img-plant {
            min-width: 5rem;
            max-width: 8rem;
        }

        /* map styling */
        .map-style {
            height: 20rem;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <nav id="navbar" class="h-100 flex-column align-items-stretch pe-4 border-end">
                    <nav class="nav nav-pills flex-column sticky-top pt-5">
                        <!-- general -->
                        <a class="nav-link text-dark fw-semibold" href="#general">General</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#gen-info">General Information</a>
                            <a class="nav-link ms-3 text-dark" href="#image">Images</a>
                            <a class="nav-link ms-3 text-dark" href="#loc-info">Location</a>
                        </nav>
                        <!-- morphology -->
                        <a class="nav-link text-dark fw-semibold" href="#morph">Morphology</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#morph-veg">Vegetative State</a>
                            <a class="nav-link ms-3 text-dark" href="#morph-rep">Reproductive State</a>
                        </nav>
                        <!-- sensory -->
                        <a class="nav-link text-dark fw-semibold" href="#sensory">Sensory</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#sensory-traits">Traits</a>
                        </nav>
                        <!-- agronomy -->
                        <a class="nav-link text-dark fw-semibold" href="#agro">Agronomy</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#pest-resist">Pest Resistance</a>
                            <a class="nav-link ms-3 text-dark" href="#disease-resist">Disease Resistance</a>
                            <a class="nav-link ms-3 text-dark" href="#stress-resist">Resistance to Abiotic Stress</a>
                        </nav>
                        <!-- importance -->
                        <a class="nav-link text-dark fw-semibold" href="#importance">Importance</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#pest-resist">Utilization and Cultural Importance</a>
                        </nav>
                        <!-- reference -->
                        <a class="nav-link text-dark fw-semibold" href="#reference">References</a>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 text-dark" href="#links">Links </a>
                        </nav>
                    </nav>
                </nav>
            </div>

            <div class="col pt-5">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">

                    <?php
                    if (isset($_GET['crop_id'])) {
                        $crop_id = pg_escape_string($conn, $_GET['crop_id']);

                        $queryCrop = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
                        on crop_location.location_id = location.location_id left join users on crop.user_id = users.user_id left join barangay
                        on crop_location.barangay_id = barangay.barangay_id left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
                        left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
                        left join \"references\" on \"references\".crop_id = crop.crop_id
                        where crop.crop_id = $1";
                        $query_runCrop = pg_query_params($conn, $queryCrop, array($crop_id));
                        if (pg_num_rows($query_runCrop) > 0) {
                            $crops = pg_fetch_assoc($query_runCrop);

                            // general info
                            $category_name = $crops['category_name'];
                            $category_variety_name = $crops['category_variety_name'];
                            $crop_variety = $crops['crop_variety'];
                            $crop_description = $crops['crop_description'];
                            $input_date = $crops['input_date'];
                            $unique_code = $crops['unique_code'];
                            $meaning_of_name = $crops['meaning_of_name'];
                            $terrain_name = $crops['terrain_name'];

                            // Images
                            $crop_seed_image = $crops['crop_seed_image'];
                            $crop_vegetative_image = $crops['crop_vegetative_image'];
                            $crop_reproductive_image = $crops['crop_reproductive_image'];

                            // location
                            $province_name = $crops['province_name'];
                            $municipality_name = $crops['municipality_name'];
                            $barangay_name = $crops['barangay_name'];
                            $coordinates = $crops['coordinates'];

                            // Utilization and Cultural Importance
                            $use = $crops['use'];
                            $significance = $crops['significance'];
                            $indigenous_utilization = $crops['indigenous_utilization'];
                            $remarkable_features = $crops['remarkable_features'];

                            // References
                            $link = $crops['link'];

                    ?>
                            <!-- general -->
                            <div id="general" class="mb-5">
                                <!-- general information -->
                                <div id="gen-info">
                                    <h5>General Information</h5>
                                    <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                        <table class="table mb-0">
                                            <tbody>
                                                <!-- category -->
                                                <tr>
                                                    <th scope="row" class="w-25 fw-normal">Category</th>
                                                    <td><?= $category_name; ?></td>
                                                </tr>
                                                <!-- variety -->
                                                <tr>
                                                    <th scope="row" class=" fw-normal">Variety</th>
                                                    <td><?= $category_variety_name; ?></td>
                                                </tr>
                                                <!-- Local/Variety Name -->
                                                <tr>
                                                    <th scope="row" class=" fw-normal">Local/Variety Name</th>
                                                    <td><?= $crop_variety; ?></td>
                                                </tr>
                                                <!-- Meaning of Name -->
                                                <tr>
                                                    <th scope="row" class=" fw-normal">Meaning of Name</th>
                                                    <td><?= $meaning_of_name; ?></td>
                                                </tr>
                                                <!-- Terrain -->
                                                <tr>
                                                    <th scope="row" class=" fw-normal">Terrain</th>
                                                    <td><?= $terrain_name; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- images for stages -->
                                <div id="image">
                                    <h5>Images</h5>
                                    <div class="border border-bottom-0 rounded my-3 overflow-hidden">
                                        <table class="table mb-0">
                                            <tbody>
                                                <!-- seed -->
                                                <tr>
                                                    <th scope="row" class="w-25  fw-normal">Seed</th>
                                                    <td class="d-flex align-items-center flex-wrap ">
                                                        <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                            <?php
                                                            if ($crop_seed_image != "") {
                                                                // Split the image names by comma
                                                                $imageNamesSeed = explode(',', $crop_seed_image);
                                                                // Display each image
                                                                foreach ($imageNamesSeed as $imageNameSeed) {
                                                            ?>
                                                                    <img src="modals/img/<?php echo trim($imageNameSeed); ?>" class="img-thumbnail img-plant">
                                                            <?php
                                                                }
                                                            } else {
                                                                // display message
                                                                echo "Image not added";
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- vegetative -->
                                                <tr>
                                                    <th scope="row" class="w-25  fw-normal">Vegetative</th>
                                                    <td class="d-flex align-items-center flex-wrap ">
                                                        <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                            <?php
                                                            if ($crop_vegetative_image != "") {
                                                                // Split the image names by comma
                                                                $imageNamesVeg = explode(',', $crop_vegetative_image);
                                                                // Display each image
                                                                foreach ($imageNamesVeg as $imageNameVeg) {
                                                            ?>
                                                                    <img src="modals/img/<?php echo trim($imageNameVeg); ?>" class="img-thumbnail img-plant">
                                                            <?php
                                                                }
                                                            } else {
                                                                // display message
                                                                echo "Image not added";
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- reproductive -->
                                                <tr>
                                                    <th scope="row" class="w-25  fw-normal">Reproductive</th>
                                                    <td class="d-flex align-items-center flex-wrap ">
                                                        <div class="image-container-size me-2 d-flex align-tems-center justify-content-center">
                                                            <?php
                                                            if ($crop_reproductive_image != "") {
                                                                // Split the image names by comma
                                                                $imageNamesReproductive = explode(',', $crop_reproductive_image);
                                                                // Display each image
                                                                foreach ($imageNamesReproductive as $imageNameReproductive) {
                                                            ?>
                                                                    <img src="modals/img/<?php echo trim($imageNameReproductive); ?>" class="img-thumbnail img-plant">
                                                            <?php
                                                                }
                                                            } else {
                                                                // display message
                                                                echo "Image not added";
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- location -->
                                <div id="loc-info">
                                    <h5>Location</h5>
                                    <div class="border border-bottom-0 rounded my-3 overflow-hidden">
                                        <table class="table mb-0">
                                            <tbody>
                                                <!-- province -->
                                                <tr>
                                                    <th scope="row" class="w-25 fw-normal">Province</th>
                                                    <td><?= $province_name; ?></td>
                                                </tr>
                                                <!-- municipality -->
                                                <tr>
                                                    <th scope="row" class="fw-normal">Municipality</th>
                                                    <td><?= $municipality_name; ?></td>
                                                </tr>
                                                <!-- Sitio -->
                                                <tr>
                                                    <th scope="row" class="fw-normal">Sitio</th>
                                                    <td><?= $barangay_name; ?></td>
                                                </tr>
                                                <!-- Coordinates -->
                                                <tr>
                                                    <th scope="row" class="fw-normal">Coordinates</th>
                                                    <td><?= $coordinates; ?></td>
                                                </tr>
                                                <!-- Map -->
                                                <tr>
                                                    <th scope="row" class="fw-normal">Map</th>
                                                    <td>
                                                        <div id="map-view" class="map-style rounded"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    <?php

                            // for the data that are specific for that specific category
                            // get category name
                            $get_name = "SELECT category_name FROM crop left join category on crop.category_id = category.category_id where crop.crop_id = $1";
                            $query_run_get_name = pg_query_params($conn, $get_name, array($crop_id));

                            if ($query_run_get_name) {
                                $row_categoryName = pg_fetch_assoc(($query_run_get_name));
                                $get_category_name = $row_categoryName['category_name'];
                            } else {
                                $_SESSION['message'] = "No category available, incomplete data";
                                header("location: ../../../crop.php");
                                exit();
                            }

                            if ($get_category_name === 'Corn') {
                                // Fetch data from the crop table and join with crop_location
                                $queryCorn = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
                                on crop_location.location_id = location.location_id left join users on crop.user_id = users.user_id left join barangay
                                on crop_location.barangay_id = barangay.barangay_id left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
                                left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
                                left join corn_traits on crop.crop_id = corn_traits.crop_id left join vegetative_state_corn on corn_traits.vegetative_state_corn_id = vegetative_state_corn.vegetative_state_corn_id
                                left join reproductive_state_corn on corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
                                left join pest_resistance_corn on corn_traits.pest_resistance_corn_id = pest_resistance_corn.pest_resistance_corn_id
                                left join disease_resistance on corn_traits.disease_resistance_id = disease_resistance.disease_resistance_id
                                left join abiotic_resistance on corn_traits.abiotic_resistance_id = abiotic_resistance.abiotic_resistance_id
                                left join seed_traits on seed_traits.seed_traits_id = reproductive_state_corn.seed_traits_id
                                left join \"references\" on \"references\".crop_id = crop.crop_id
                                WHERE crop.crop_id = $1";
                                $query_runCorn = pg_query_params($conn, $queryCorn, array($crop_id));

                                if (pg_num_rows($query_runCorn) > 0) {
                                    $crops_corn = pg_fetch_assoc($query_runCorn);
                                }
                            } elseif ($get_category_name === 'Rice') {
                                // Fetch data from the crop table and join with crop_location
                                $queryCorn = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
                                on crop_location.location_id = location.location_id left join users on crop.user_id = users.user_id left join barangay
                                on crop_location.barangay_id = barangay.barangay_id left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
                                left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
                                left join rice_traits on crop.crop_id = rice_traits.crop_id left join vegetative_state_rice on rice_traits.vegetative_state_rice_id = vegetative_state_rice.vegetative_state_rice_id
                                left join reproductive_state_rice on rice_traits.reproductive_state_rice_id = reproductive_state_rice.reproductive_state_rice_id
                                left join pest_resistance_rice on rice_traits.pest_resistance_rice_id = pest_resistance_rice.pest_resistance_rice_id
                                left join disease_resistance on rice_traits.disease_resistance_id = disease_resistance.disease_resistance_id
                                left join abiotic_resistance_rice on rice_traits.abiotic_resistance_rice_id = abiotic_resistance_rice.abiotic_resistance_rice_id
                                left join seed_traits on seed_traits.seed_traits_id = reproductive_state_rice.seed_traits_id
                                left join panicle_traits_rice on panicle_traits_rice.panicle_traits_rice_id = reproductive_state_rice.panicle_traits_rice_id
                                left join flag_leaf_traits_rice on flag_leaf_traits_rice.flag_leaf_traits_rice_id = reproductive_state_rice.flag_leaf_traits_rice_id
                                LEFT JOIN sensory_traits_rice ON sensory_traits_rice.sensory_traits_rice_id = rice_traits.sensory_traits_rice_id
                                WHERE crop.crop_id = $1";
                                $query_runRice = pg_query_params($conn, $queryCorn, array($crop_id));

                                if (pg_num_rows($query_runRice) > 0) {
                                    $crops_rice = pg_fetch_assoc($query_runRice);
                                }
                            } elseif ($get_category_name === 'Root Crop') {
                                // Fetch data from the crop table and join with crop_location
                                $query_rootCrop = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
                                on crop_location.location_id = location.location_id left join users on crop.user_id = users.user_id left join barangay
                                on crop_location.barangay_id = barangay.barangay_id left join category_variety on crop.category_variety_id = category_variety.category_variety_id left join terrain on terrain.terrain_id = crop.terrain_id
                                left join category on category.category_id = crop.category_id left join utilization_cultural_importance on  crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
                                left join root_crop_traits on crop.crop_id = root_crop_traits.crop_id left join vegetative_state_rootcrop on root_crop_traits.vegetative_state_rootcrop_id = vegetative_state_rootcrop.vegetative_state_rootcrop_id
                                left join pest_resistance_rootcrop on root_crop_traits.pest_resistance_rootcrop_id = pest_resistance_rootcrop.pest_resistance_rootcrop_id
                                left join disease_resistance on root_crop_traits.disease_resistance_id = disease_resistance.disease_resistance_id
                                left join abiotic_resistance on root_crop_traits.abiotic_resistance_id = abiotic_resistance.abiotic_resistance_id
                                left join rootcrop_traits on rootcrop_traits.rootcrop_traits_id = root_crop_traits.rootcrop_traits_id
                                WHERE crop.crop_id = $1";
                                $query_run_rootCrop = pg_query_params($conn, $query_rootCrop, array($crop_id));

                                if (pg_num_rows($query_run_rootCrop) > 0) {
                                    $crops_rootCrop = pg_fetch_assoc($query_run_rootCrop);
                                }
                            } else {
                                // Handle other categories or invalid category names
                                // For example, set a default category or display an error message
                                $_SESSION['message'] = "Crop does not exist or broken file";
                                header("location: ../crop.php");
                                die();
                            }
                        }
                    } else {
                        $_SESSION['message'] = "Crop does not exist";
                        header("location: ../crop.php");
                        die();
                    }
                    ?>

                    <!-- morphology -->
                    <div id="morph" class="mb-5">
                        <!-- vegetative -->
                        <div id="morph-veg">
                            <h5>Vegetative State</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- plant height -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Plant Height</th>
                                            <td>Typical</td>
                                        </tr>
                                        <!-- leaf width -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Leaf Length</th>
                                            <td>Average</td>
                                        </tr>
                                        <!-- leaf length -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Leaf Width</th>
                                            <td>Long</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- reproductive -->
                        <div id="morph-rep">
                            <h5>Reproductve State</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- yield capacity -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Yield Capacity</th>
                                            <td>Typical</td>
                                        </tr>
                                        <!-- lenght -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Length</th>
                                            <td>10 inch</td>
                                        </tr>
                                        <!-- width -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Width</th>
                                            <td>5 cm</td>
                                        </tr>
                                        <!-- shape -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Shape</th>
                                            <td>Elongated</td>
                                        </tr>
                                        <!-- color -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Seed Color</th>
                                            <td>Fuichsa</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- sensory -->
                    <div id="sensory">
                        <!-- sensory traits -->
                        <div id="sensory-traits">
                            <h5>Sensory Traits</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- Aroma -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Aroma</th>
                                            <td>Smelly</td>
                                        </tr>
                                        <!-- Quality of Cooked Rice -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Quality of Cooked Rice</th>
                                            <td>Soft</td>
                                        </tr>
                                        <!-- Quality of Leftover Rice -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Quality of Leftover Rice</th>
                                            <td>Mushy</td>
                                        </tr>
                                        <!-- Volume Expansion -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Volume Expansion</th>
                                            <td>It rises</td>
                                        </tr>
                                        <!-- Glutinousity -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Glutinousity</th>
                                            <td>yes</td>
                                        </tr>
                                        <!-- Hardness -->
                                        <tr>
                                            <th scope="row" class=" fw-normal">Hardness</th>
                                            <td>Soft</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- agronomy -->
                    <div id="agro" class="my-5">
                        <!-- pest -->
                        <div id="pest-resist">
                            <h5>Pest Resistance</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- resistance -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">List</th>
                                            <td>Borers, Grasshoppers, Ants, Birds</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- disease -->
                        <div id="disease-resist">
                            <h5>Disease Resistance</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- resistance -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">List</th>
                                            <td>Bacterial, Viral</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- stress -->
                        <div id="stress-resist">
                            <h5>Resistance to Abiotic Stress</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- list -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">List</th>
                                            <td>Drought, Salinity</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- importance -->
                    <div id="importance" class="my-5">
                        <!-- util and cultural -->
                        <div id="util-n-culture">
                            <h5>Utilization and Cultural Importance</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- Significance -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Significance</th>
                                            <td><?= $significance; ?></td>
                                        </tr>
                                        <!-- Use -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Use</th>
                                            <td><?= $use; ?>
                                            </td>
                                        </tr>
                                        <!-- Indegenous Utilization -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Indegenous Utilization</th>
                                            <td><?= $indigenous_utilization; ?></td>
                                        </tr>
                                        <!-- Remarkable Features -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Remarkable Features</th>
                                            <td><?= $remarkable_features; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- references -->
                    <div id="reference" class="my-5" style="margin-bottom: 500px !important;">
                        <div id="links">
                            <h5>References</h5>
                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                <table class="table mb-0">
                                    <tbody>
                                        <!-- Links -->
                                        <tr>
                                            <th scope="row" class="w-25 fw-normal">Links</th>
                                            <td>
                                                <ul class="list-unstyled">
                                                    <?php
                                                    // Check if the URL is absolute
                                                    if (filter_var($link, FILTER_VALIDATE_URL) === false) {
                                                        // If not, prepend "http://"
                                                        $link = "http://" . $link;
                                                    }
                                                    ?>
                                                        <li><a href="<?= $link ?>"><?= $link ?></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Script for the map -->
    <script>
        // Initialize the map
        const map = L.map('map-view').setView([5.867019, 124.943390], 9);
        // Declare marker globally
        let marker = null;

        // Add OpenStreetMap tiles to the map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            // tilesize
            tileSize: 512,
            // maxzoom
            maxZoom: 18,
            // i dont what this does but some says before different tile providers handle zoom differently
            zoomOffset: -1,
            minZoom: 9,
            // copyright claim, because openstreetmaps require them
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            // i dont know what this does
            crossOrigin: true
        }).addTo(map);

        // Define a function to add a marker to the map
        function addMarker(lat, lng) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng], {
                icon: myIcon
            }).addTo(map);
        }

        // Define the marker icon
        const myIcon = L.icon({
            iconUrl: '../img/location-pin-svgrepo-com.svg',
            iconSize: [32, 48],
            iconAnchor: [16, 32],
            popupAnchor: [0, -40]
        });

        // Retrieve coordinates from PHP
        const coordinates = '<?= $coordinates; ?>';
        if (coordinates) {
            const [lat, lng] = coordinates.split(',').map(parseFloat);
            if (!isNaN(lat) && !isNaN(lng)) {
                addMarker(lat, lng);
            }
        }
    </script>
</body>

</html>
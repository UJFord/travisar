<?php
require "../../functions/connections.php";
require "../../functions/functions.php";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View</title>
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

                                    //* Morphological traits
                                    // vegetative state
                                    $corn_plant_height = $crops_corn['corn_plant_height'];
                                    $corn_leaf_length = $crops_corn['corn_leaf_length'];
                                    $corn_leaf_width = $crops_corn['corn_leaf_width'];

                                    // Reproductive state
                                    $corn_yield_capacity = $crops_corn['corn_yield_capacity'];
                                    $seed_length = $crops_corn['seed_length'];
                                    $seed_width = $crops_corn['seed_width'];
                                    $seed_color = $crops_corn['seed_color'];
                                    $seed_shape = $crops_corn['seed_shape'];

                                    //* Agronomic Traits
                                    // Pest resistance
                                    $pest_resistance = [];
                                    $corn_borers = $crops_corn['corn_borers'] ? true : false;
                                    $earworms = $crops_corn['earworms'] ? true : false;
                                    $spider_mites = $crops_corn['spider_mites'] ? true : false;
                                    $corn_black_bug = $crops_corn['corn_black_bug'] ? true : false;
                                    $corn_army_worms = $crops_corn['corn_army_worms'] ? true : false;
                                    $leaf_aphid = $crops_corn['leaf_aphid'] ? true : false;
                                    $corn_cutworms = $crops_corn['corn_cutworms'] ? true : false;
                                    $corn_birds = $crops_corn['corn_birds'] ? true : false;
                                    $corn_ants = $crops_corn['corn_ants'] ? true : false;
                                    $corn_rats = $crops_corn['corn_rats'] ? true : false;
                                    $corn_others = $crops_corn['corn_others'] ? true : false;
                                    $corn_others_desc = $crops_corn['corn_others_desc'];

                                    if ($corn_borers) {
                                        $pest_resistance[] = 'Borers';
                                    }
                                    if ($earworms) {
                                        $pest_resistance[] = 'Earworms';
                                    }
                                    if ($spider_mites) {
                                        $pest_resistance[] = 'Spider Mites';
                                    }
                                    if ($corn_black_bug) {
                                        $pest_resistance[] = 'Black Bug';
                                    }
                                    if ($corn_army_worms) {
                                        $pest_resistance[] = 'Army Worms';
                                    }
                                    if ($leaf_aphid) {
                                        $pest_resistance[] = 'Leaf Aphid';
                                    }
                                    if ($corn_cutworms) {
                                        $pest_resistance[] = 'Cutworms';
                                    }
                                    if ($corn_birds) {
                                        $pest_resistance[] = 'Birds';
                                    }
                                    if ($corn_ants) {
                                        $pest_resistance[] = 'Ants';
                                    }
                                    if ($corn_rats) {
                                        $pest_resistance[] = 'Rats';
                                    }
                                    if ($corn_others) {
                                        $pest_resistance[] = $corn_others_desc;
                                    }

                                    // combine all pest resistance into a single line
                                    $pest_list = implode(', ', $pest_resistance);

                                    // disease resistance
                                    $disease_resistance = [];
                                    $bacterial = $crops_corn['bacterial'] ? true : false;
                                    $viral = $crops_corn['viral'] ? true : false;
                                    $fungus = $crops_corn['fungus'] ? true : false;

                                    if ($bacterial) {
                                        $disease_resistance[] = 'Bacterial';
                                    }
                                    if ($viral) {
                                        $disease_resistance[] = 'Viral';
                                    }
                                    if ($fungus) {
                                        $disease_resistance[] = 'Fungus';
                                    }
                                    // combine all disease resistance into a single line
                                    $disease_list = implode(', ', $disease_resistance);

                                    // Abiotic Resistance
                                    $abiotic_resistance = [];
                                    $drought = $crops_corn['drought'];
                                    $salinity = $crops_corn['salinity'];
                                    $heat = $crops_corn['heat'];
                                    $abiotic_other = $crops_corn['abiotic_other'];
                                    $abiotic_other_desc = $crops_corn['abiotic_other_desc'];

                                    if ($drought) {
                                        $disease_resistance[] = 'Drought';
                                    }
                                    if ($salinity) {
                                        $disease_resistance[] = 'Salinity';
                                    }
                                    if ($heat) {
                                        $disease_resistance[] = 'Heat';
                                    }
                                    if ($abiotic_other) {
                                        $abiotic_resistance[] = $abiotic_other_desc;
                                    }
                                    $abiotic_list = implode(', ', $abiotic_resistance);

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
                                                            <td><?= $corn_plant_height; ?></td>
                                                        </tr>
                                                        <!-- leaf width -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Leaf Length</th>
                                                            <td><?= $corn_leaf_length; ?></td>
                                                        </tr>
                                                        <!-- leaf length -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Leaf Width</th>
                                                            <td><?= $corn_leaf_width; ?></td>
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
                                                            <td><? $corn_yield_capacity; ?></td>
                                                        </tr>
                                                        <!-- lenght -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Length</th>
                                                            <td><? $seed_length; ?></td>
                                                        </tr>
                                                        <!-- width -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Width</th>
                                                            <td><? $seed_width; ?></td>
                                                        </tr>
                                                        <!-- shape -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Shape</th>
                                                            <td><? $seed_shape; ?></td>
                                                        </tr>
                                                        <!-- color -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Color</th>
                                                            <td><? $seed_color; ?></td>
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
                                                            <td>
                                                                <?php
                                                                if ($pest_list > 0) {
                                                                    echo $pest_list;
                                                                } else {
                                                                    echo "There is no Pest list available";
                                                                }
                                                                ?>
                                                            </td>
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
                                                            <td>
                                                                <?php
                                                                if ($disease_list > 0) {
                                                                    echo $disease_list;
                                                                } else {
                                                                    echo "There is no Disease list available";
                                                                }
                                                                ?>
                                                            </td>
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
                                                            <td>
                                                                <?php
                                                                if ($abiotic_list > 0) {
                                                                    echo $abiotic_list;
                                                                } else {
                                                                    echo "There is no Disease list available";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } elseif ($get_category_name === 'Rice') {
                                // Fetch data from the crop table and join with crop_location
                                $queryRice = "SELECT * FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join location 
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
                                $query_runRice = pg_query_params($conn, $queryRice, array($crop_id));

                                if (pg_num_rows($query_runRice) > 0) {
                                    $crops_rice = pg_fetch_assoc($query_runRice);

                                    //* Morphological Traits
                                    // Vegetative
                                    $rice_plant_height = $crops_rice['rice_plant_height'];
                                    $rice_leaf_length = $crops_rice['rice_leaf_length'];
                                    $rice_leaf_width = $crops_rice['rice_leaf_width'];
                                    $rice_tillering_ability = $crops_rice['rice_tillering_ability'];
                                    $rice_maturity_time = $crops_rice['rice_maturity_time'];
                                    // Reproductive
                                    $rice_yield_capacity = $crops_rice['rice_yield_capacity'];
                                    $seed_length = $crops_rice['seed_length'];
                                    $seed_width = $crops_rice['seed_width'];
                                    $seed_shape = $crops_rice['seed_shape'];
                                    $seed_color = $crops_rice['seed_color'];

                                    //* Sensory Traits
                                    $aroma = $crops_rice['aroma'];
                                    $quality_cooked_rice = $crops_rice['quality_cooked_rice'];
                                    $quality_leftover_rice = $crops_rice['quality_leftover_rice'];
                                    $volume_expansion = $crops_rice['volume_expansion'];
                                    $glutinous = $crops_rice['glutinous'];
                                    $hardness = $crops_rice['hardness'];

                                    //* Agronomy
                                    // Pest Resistance
                                    $pest_resistances = [];
                                    $rice_borers = $crops_rice['rice_borers'] ? true : false;
                                    $rice_snail = $crops_rice['rice_snail'] ? true : false;
                                    $hoppers = $crops_rice['hoppers'] ? true : false;
                                    $rice_black_bug = $crops_rice['rice_black_bug'] ? true : false;
                                    $leptocorisa = $crops_rice['leptocorisa'] ? true : false;
                                    $leaf_folder = $crops_rice['leaf_folder'] ? true : false;
                                    $rice_birds = $crops_rice['rice_birds'] ? true : false;
                                    $rice_ants = $crops_rice['rice_ants'] ? true : false;
                                    $rice_rats = $crops_rice['rice_rats'] ? true : false;
                                    $rice_army_worms = $crops_rice['rice_army_worms'] ? true : false;
                                    $rice_others = $crops_rice['rice_others'] ? true : false;
                                    $rice_others_desc = $crops_rice['rice_others_desc'];
                                    if ($rice_borers) {
                                        $pest_resistances[] = 'Borers';
                                    }
                                    if ($rice_snail) {
                                        $pest_resistances[] = 'Snail';
                                    }
                                    if ($hoppers) {
                                        $pest_resistances[] = 'Hoppers';
                                    }
                                    if ($rice_black_bug) {
                                        $pest_resistances[] = 'Black Bug';
                                    }
                                    if ($leptocorisa) {
                                        $pest_resistances[] = 'Leptocorisa';
                                    }
                                    if ($leaf_folder) {
                                        $pest_resistances[] = 'Leaf Folder';
                                    }
                                    if ($rice_ants) {
                                        $pest_resistances[] = 'Ants';
                                    }
                                    if ($rice_rats) {
                                        $pest_resistances[] = 'Rats';
                                    }
                                    if ($rice_army_worms) {
                                        $pest_resistances[] = 'Army Worms';
                                    }
                                    if ($rice_rats) {
                                        $pest_resistances[] = 'Rats';
                                    }
                                    if ($rice_others) {
                                        $pest_resistances[] = $rice_others_desc;
                                    }

                                    // Combine the pest resistances into a single string
                                    $pest_list = implode(', ', $pest_resistances);

                                    // disease Resistance
                                    $disease_resistances = [];
                                    $bacterial = $crops_rice['bacterial'] ? true : false;
                                    $viral = $crops_rice['viral'] ? true : false;
                                    $fungus = $crops_rice['fungus'] ? true : false;

                                    if ($bacterial) {
                                        $disease_resistances[] = 'Bacterial';
                                    }
                                    if ($viral) {
                                        $disease_resistances[] = 'Viral';
                                    }
                                    if ($fungus) {
                                        $disease_resistances[] = 'Fungus';
                                    }

                                    // Combine the disease resistances into a single string
                                    $disease_list = implode(', ', $disease_resistances);

                                    // Abiotic Resistance
                                    $abiotic_resistances = [];
                                    $rice_drought = $crops_rice['rice_drought'] ? true : false;
                                    $rice_salinity = $crops_rice['rice_salinity'] ? true : false;
                                    $rice_heat = $crops_rice['rice_heat'] ? true : false;
                                    $harmful_radiation = $crops_rice['harmful_radiation'] ? true : false;
                                    $rice_abiotic_other = $crops_rice['rice_abiotic_other'] ? true : false;
                                    $rice_abiotic_other_desc = $crops_rice['rice_abiotic_other_desc'];

                                    if ($rice_drought) {
                                        $abiotic_resistances[] = 'Drought';
                                    }
                                    if ($rice_salinity) {
                                        $abiotic_resistances[] = 'Salinity';
                                    }
                                    if ($rice_heat) {
                                        $abiotic_resistances[] = 'Heat';
                                    }
                                    if ($harmful_radiation) {
                                        $abiotic_resistances[] = 'Harmful Radiation';
                                    }
                                    if ($rice_abiotic_other) {
                                        $abiotic_resistances[] = $rice_abiotic_other_desc;
                                    }


                                    // Combine the abiotic resistances into a single string
                                    $abiotic_list = implode(', ', $abiotic_resistances);

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
                                                            <td><?= $rice_plant_height; ?></td>
                                                        </tr>
                                                        <!-- leaf width -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Leaf Length</th>
                                                            <td><?= $rice_leaf_length; ?></td>
                                                        </tr>
                                                        <!-- leaf Width -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Leaf Width</th>
                                                            <td><?= $rice_leaf_width; ?></td>
                                                        </tr>
                                                        <!-- Tillering Ability -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Tillering Ability</th>
                                                            <td><?= $rice_tillering_ability; ?></td>
                                                        </tr>
                                                        <!-- Maturity Time -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Maturity Time</th>
                                                            <td><?= $rice_maturity_time; ?></td>
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
                                                            <td><?= $rice_yield_capacity; ?></td>
                                                        </tr>
                                                        <!-- lenght -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Length</th>
                                                            <td><?= $seed_length; ?></td>
                                                        </tr>
                                                        <!-- width -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Width</th>
                                                            <td><?= $seed_width; ?></td>
                                                        </tr>
                                                        <!-- shape -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Shape</th>
                                                            <td><?= $seed_shape; ?></td>
                                                        </tr>
                                                        <!-- color -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Seed Color</th>
                                                            <td><?= $seed_color; ?></td>
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
                                                            <td><?= $aroma; ?></td>
                                                        </tr>
                                                        <!-- Quality of Cooked Rice -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Quality of Cooked Rice</th>
                                                            <td><?= $quality_cooked_rice; ?></td>
                                                        </tr>
                                                        <!-- Quality of Leftover Rice -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Quality of Leftover Rice</th>
                                                            <td><?= $quality_leftover_rice; ?></td>
                                                        </tr>
                                                        <!-- Volume Expansion -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Volume Expansion</th>
                                                            <td><?= $volume_expansion; ?></td>
                                                        </tr>
                                                        <!-- Glutinousity -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Glutinousity</th>
                                                            <td><?= $glutinous; ?></td>
                                                        </tr>
                                                        <!-- Hardness -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Hardness</th>
                                                            <td><?= $hardness; ?></td>
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
                                                            <td>
                                                                <?php
                                                                if ($pest_list > 0) {
                                                                    echo $pest_list;
                                                                } else {
                                                                    echo "There is no Pest list available";
                                                                }
                                                                ?>
                                                            </td>
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
                                                            <td>
                                                                <?php
                                                                if ($disease_list > 0) {
                                                                    echo $disease_list;
                                                                } else {
                                                                    echo "There is no Disease list available";
                                                                }
                                                                ?>
                                                            </td>
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
                                                            <td>
                                                                <?php
                                                                if ($abiotic_list > 0) {
                                                                    echo $abiotic_list;
                                                                } else {
                                                                    echo "There is no Abiotic Resistance list available";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
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

                                    //* Morphological Traits
                                    // vegetative state
                                    $rootcrop_plant_height = $crops_rootCrop['rootcrop_plant_height'];
                                    $rootcrop_leaf_length = $crops_rootCrop['rootcrop_leaf_length'];
                                    $rootcrop_leaf_width = $crops_rootCrop['rootcrop_leaf_width'];

                                    // Root Crop Traits
                                    $eating_quality = $crops_rootCrop['eating_quality'];
                                    $rootcrop_color = $crops_rootCrop['rootcrop_color'];
                                    $sweetness = $crops_rootCrop['sweetness'];
                                    $rootcrop_remarkable_features = $crops_rootCrop['rootcrop_remarkable_features'];

                                    //* Agronomic Traits
                                    // Pest Resistance
                                    $pest_resistance = [];
                                    $root_aphids = $crops_rootCrop['root_aphids'] ? true : false;
                                    $root_knot_nematodes = $crops_rootCrop['root_knot_nematodes'] ? true : false;
                                    $rootcrop_cutworms = $crops_rootCrop['rootcrop_cutworms'] ? true : false;
                                    $white_grubs = $crops_rootCrop['white_grubs'] ? true : false;
                                    $termites = $crops_rootCrop['termites'] ? true : false;
                                    $weevils = $crops_rootCrop['weevils'] ? true : false;
                                    $flea_beetles = $crops_rootCrop['flea_beetles'] ? true : false;
                                    $rootcrop_snails = $crops_rootCrop['rootcrop_snails'] ? true : false;
                                    $rootcrop_ants = $crops_rootCrop['rootcrop_ants'] ? true : false;
                                    $rootcrop_rats = $crops_rootCrop['rootcrop_rats'] ? true : false;
                                    $rootcrop_others = $crops_rootCrop['rootcrop_others'] ? true : false;
                                    $rootcrop_others_desc = $crops_rootCrop['rootcrop_others_desc'];

                                    if ($root_aphids) {
                                        $pest_resistance[] = 'Aphids';
                                    }

                                    if ($root_knot_nematodes) {
                                        $pest_resistance[] = 'Knot Nematodes';
                                    }

                                    if ($rootcrop_cutworms) {
                                        $pest_resistance[] = 'Cutworms';
                                    }

                                    if ($white_grubs) {
                                        $pest_resistance[] = 'White Grubs';
                                    }

                                    if ($termites) {
                                        $pest_resistance[] = 'Termites';
                                    }

                                    if ($weevils) {
                                        $pest_resistance[] = 'Weevils';
                                    }

                                    if ($flea_beetles) {
                                        $pest_resistance[] = 'Flea Beetles';
                                    }

                                    if ($rootcrop_snails) {
                                        $pest_resistance[] = 'Snails';
                                    }

                                    if ($rootcrop_ants) {
                                        $pest_resistance[] = 'Ants';
                                    }

                                    if ($rootcrop_rats) {
                                        $pest_resistance[] = 'Rats';
                                    }

                                    if ($rootcrop_others) {
                                        $pest_resistance[] = $rootcrop_others_desc;
                                    }

                                    $pest_list = implode(", ", $pest_resistance);

                                    // Disease Resitance
                                    $disease_resistance = [];
                                    $bacterial = $crops_rootCrop['bacterial'] ? true : false;
                                    $viral = $crops_rootCrop['viral'] ? true : false;
                                    $fungus = $crops_rootCrop['fungus'] ? true : false;

                                    if ($bacterial) {
                                        $disease_resistance[] = 'Bacterial';
                                    }
                                    if ($viral) {
                                        $disease_resistance[] = 'Viral';
                                    }
                                    if ($fungus) {
                                        $disease_resistance[] = 'Fungus';
                                    }

                                    $disease_list = implode(", ", $disease_resistance);

                                    // Abiotic Resistance
                                    $abiotic_resistance = [];
                                    $drought = $crops_rootCrop['drought'] ? true : false;
                                    $salinity = $crops_rootCrop['salinity'] ? true : false;
                                    $heat = $crops_rootCrop['heat'] ? true : false;
                                    $abiotic_other = $crops_rootCrop['abiotic_other'] ? true : false;
                                    $abiotic_other_desc = $crops_rootCrop['abiotic_other_desc'] ? true : false;

                                    if ($drought) {
                                        $abiotic_resistance[] = 'Drought';
                                    }
                                    
                                    if ($salinity) {
                                        $abiotic_resistance[] = 'Salinity';
                                    }
                                    
                                    if ($heat) {
                                        $abiotic_resistance[] = 'Heat';
                                    }
                                    
                                    if ($abiotic_other) {
                                        $abiotic_resistance[] = $abiotic_other_desc;
                                    }
                                    
                                    $abiotic_list = implode(", ", $abiotic_resistance);
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
                                                            <td><?= $rootcrop_plant_height; ?></td>
                                                        </tr>
                                                        <!-- leaf width -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Leaf Length</th>
                                                            <td><?= $rootcrop_leaf_length; ?></td>
                                                        </tr>
                                                        <!-- leaf length -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Leaf Width</th>
                                                            <td><?= $rootcrop_leaf_width; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Root Crop Traits -->
                                    <div id="sensory">
                                        <!-- sensory traits -->
                                        <div id="sensory-traits">
                                            <h5>Crop Traits</h5>
                                            <div class="border border-bottom-0 rounded my-3  overflow-hidden">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <!-- Aroma -->
                                                        <tr>
                                                            <th scope="row" class="w-25 fw-normal">Eating Quality</th>
                                                            <td><?= $eating_quality; ?></td>
                                                        </tr>
                                                        <!-- Color -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Color</th>
                                                            <td><?= $rootcrop_color; ?></td>
                                                        </tr>
                                                        <!-- Sweetness -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Sweetness</th>
                                                            <td><?= $sweetness; ?></td>
                                                        </tr>
                                                        <!-- Other Remarkable Features -->
                                                        <tr>
                                                            <th scope="row" class=" fw-normal">Other Remarkable Features</th>
                                                            <td><?= $rootcrop_remarkable_features; ?></td>
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
                                                            <td>
                                                                <?php
                                                                if ($pest_list > 0) {
                                                                    echo $pest_list;
                                                                } else {
                                                                    echo "There is no Pest list available";
                                                                }
                                                                ?>
                                                            </td>
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
                                                            <td>
                                                                <?php
                                                                if ($disease_list > 0) {
                                                                    echo $disease_list;
                                                                } else {
                                                                    echo "There is no Disease list available";
                                                                }
                                                                ?>
                                                            </td>
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
                                                            <td>
                                                                <?php
                                                                if ($abiotic_list > 0) {
                                                                    echo $abiotic_list;
                                                                } else {
                                                                    echo "There is no abiotic list available";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
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
                                                    if ($link != "null") {
                                                        // Check if the URL is absolute
                                                        if (filter_var($link, FILTER_VALIDATE_URL) === false) {
                                                            // If not, prepend "http://"
                                                            $link = "http://" . $link;
                                                        }
                                                        // Display the link
                                                    ?>
                                                        <li><a href="<?= $link ?>"><?= $link ?></a></li>
                                                    <?php
                                                    } else {
                                                        // Display a message if no link is available
                                                        echo "There are no links available";
                                                    }
                                                    ?>

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
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
    <div class="title container-fluid bg-white">
        <div class="container py-4 mb-4">
            
            <!-- back to previous page -->
            <a id="return-btn" onclick="goBack()" class="btn btn-link float-start p-0 my-1"><i class="fa-solid fa-circle-arrow-left fs-2"></i></a>
            <h2 class="info-title text-center p-0 m-0">

                <?php
                if (isset($_GET['crop_id'])) {
                    $crop_id = $_GET['crop_id'];
                    $query_name = "SELECT crop_variety FROM crop WHERE crop_id = $1";
                    $query_nameRun = pg_query_params($conn, $query_name, array($crop_id));
                    if (pg_num_rows($query_nameRun)) {
                        $row_name = pg_fetch_assoc($query_nameRun);
                        $crop_variety = $row_name['crop_variety'];
                        echo $crop_variety;
                    }
                }
                ?>
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- INFORMATION -->
            <h4 class="info-title col-12">General Information</h4>
            <?php
            if (isset($_GET['crop_id'])) {

                $crop_id = $_GET['crop_id'];
                $query = "SELECT * FROM crop
                LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id
                LEFT JOIN municipality ON crop_location.municipality_id = municipality.municipality_id
                LEFT JOIN users ON crop.user_id = users.user_id
                LEFT JOIN barangay ON crop_location.barangay_id = barangay.barangay_id
                LEFT JOIN province ON province.province_id = municipality.province_id
                LEFT JOIN category_variety ON crop.category_variety_id = category_variety.category_variety_id
                LEFT JOIN terrain ON terrain.terrain_id = crop.terrain_id
                LEFT JOIN category ON category.category_id = crop.category_id
                LEFT JOIN utilization_cultural_importance ON crop.utilization_cultural_id = utilization_cultural_importance.utilization_cultural_id
                LEFT JOIN \"references\" ON \"references\".crop_id = crop.crop_id
                left join \"status\" on \"status\".status_id = crop.status_id
                WHERE crop.crop_id = $1";
                $query_run = pg_query_params($conn, $query, array($crop_id));

                if (pg_num_rows($query_run) > 0) {
                    $crops = pg_fetch_assoc($query_run);
            ?>
                    <div class="col-6">
                        <!-- GENERAL TABLE -->
                        <div class="table-container border rounded oveflow-hidden mb-4">
                            <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Category</th>
                                        <td id="crop-categ" class="w-75 fw-semibold"><?= $crops['category_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Variety</th>
                                        <td class="w-75 fw-semibold"><?= $crops['category_variety_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Local Name</th>
                                        <td class="w-75 fw-semibold"><?= $crops['crop_variety'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Meaning of Name</th>
                                        <td class="w-75 fw-semibold"><?= $crops['meaning_of_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Terrain</th>
                                        <td class="w-75 fw-semibold"><?= $crops['terrain_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Description</th>
                                        <td class="w-75 fw-semibold"><?= $crops['crop_description'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="latlng-container text-secondary w-25 fw-normal" latlng="<?php
                                                                                                                        // Check if crop coordinates exist
                                                                                                                        if (!empty($crops['coordinates'])) {
                                                                                                                            // Use crop coordinates
                                                                                                                            echo $crops['coordinates'];
                                                                                                                        } else {
                                                                                                                            // Use barangay coordinates as fallback
                                                                                                                            echo $crops['barangay_coordinates'];
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                        ">Location</th>
                                        <td id="addr" class="w-75 fw-semibold"><?php
                                                                                if (!empty($crops['sitio_name'])) {
                                                                                    echo $crops['sitio_name'] . ', ' . $crops['barangay_name'] . ', ' . $crops['municipality_name'] . ', ' . $crops['province_name'];
                                                                                } else {
                                                                                    echo $crops['barangay_name'] . ', ' . $crops['municipality_name'] . ', ' . $crops['province_name'];
                                                                                }
                                                                                ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                            $queryCorn = "SELECT DIStinct crop.*, corn_traits.*, reproductive_state_corn.*, vegetative_state_corn.*, corn_pest_resistance_other.*, corn_abiotic_resistance_other.*, seed_traits.*,
                            ARRAY(SELECT DISTINCT corn_pest_resistance.pest_resistance_id FROM corn_pest_resistance WHERE corn_pest_resistance.corn_traits_id = corn_traits.corn_traits_id) AS pest_resistances,
                            ARRAY(SELECT DISTINCT corn_disease_resistance.disease_resistance_id FROM corn_disease_resistance WHERE corn_disease_resistance.corn_traits_id = corn_traits.corn_traits_id) AS disease_resistances,
                            ARRAY(SELECT DISTINCT corn_abiotic_resistance.abiotic_resistance_id FROM corn_abiotic_resistance WHERE corn_abiotic_resistance.corn_traits_id = corn_traits.corn_traits_id) AS abiotic_resistances
                            from crop
							left join corn_traits on crop.crop_id = corn_traits.crop_id left join vegetative_state_corn on corn_traits.vegetative_state_corn_id = vegetative_state_corn.vegetative_state_corn_id
                            left join reproductive_state_corn on corn_traits.reproductive_state_corn_id = reproductive_state_corn.reproductive_state_corn_id
                            left join corn_pest_resistance on corn_pest_resistance.corn_traits_id = corn_traits.corn_traits_id
                            left join corn_disease_resistance on corn_disease_resistance.corn_traits_id = corn_traits.corn_traits_id
                            left join corn_abiotic_resistance on corn_abiotic_resistance.corn_traits_id = corn_traits.corn_traits_id
                            left join corn_pest_resistance_other on corn_pest_resistance_other.corn_pest_other_id = corn_traits.corn_pest_other_id
                            left join corn_abiotic_resistance_other on corn_abiotic_resistance_other.corn_abiotic_other_id = corn_traits.corn_abiotic_other_id
                            left join seed_traits on seed_traits.seed_traits_id = reproductive_state_corn.seed_traits_id
                            WHERE crop.crop_id = $1";
                            $query_runCorn = pg_query_params($conn, $queryCorn, array($crop_id));
                            if (pg_num_rows($query_runCorn) > 0) {
                                $crops_corn = pg_fetch_assoc($query_runCorn);
                                $pest_resistances = $crops_corn['pest_resistances'];
                                $pest_names = [];

                                // get the pest resistance
                                if (isset($pest_resistances)) {
                                    // Split the string into an array of integers
                                    $pest_resistances_arr = explode(',', substr($pest_resistances, 1, -1));

                                    // Loop through the submitted pest resistance IDs
                                    foreach ($pest_resistances_arr as $pest_id) {
                                        if (!empty($pest_id)) {
                                            $queryPest = "SELECT pest_name FROM pest_resistance WHERE pest_resistance_id = $1";
                                            $queryPest_run = pg_query_params($conn, $queryPest, array($pest_id));

                                            if (pg_num_rows($queryPest_run) > 0) {
                                                $pest_name = pg_fetch_assoc($queryPest_run)['pest_name'];
                                                $pest_names[] = $pest_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }

                                $disease_resistances = $crops_corn['disease_resistances'];
                                $disease_name = [];

                                // get the disease resistance
                                if (isset($disease_resistances)) {
                                    // Split the string into an array of integers
                                    $disease_resistances_arr = explode(',', substr($disease_resistances, 1, -1));

                                    // Loop through the submitted disease resistance IDs
                                    foreach ($disease_resistances_arr as $disease_id) {
                                        if (!empty($disease_id)) {
                                            $queryDisease = "SELECT disease_name FROM disease_resistance WHERE disease_resistance_id = $1";
                                            $queryDisease_run = pg_query_params($conn, $queryDisease, array($disease_id));

                                            if (pg_num_rows($queryDisease_run) > 0) {
                                                $disease_name = pg_fetch_assoc($queryDisease_run)['disease_name'];
                                                $disease_names[] = $disease_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }

                                $abiotic_resistances = $crops_corn['abiotic_resistances'];
                                $abiotic_name = [];

                                // get the abiotic resistance
                                if (isset($abiotic_resistances)) {
                                    // Split the string into an array of integers
                                    $abiotic_resistances_arr = explode(',', substr($abiotic_resistances, 1, -1));
                                    // Loop through the submitted abiotic resistance IDs
                                    foreach ($abiotic_resistances_arr as $abiotic_id) {
                                        if (!empty($abiotic_id)) {
                                            $queryAbiotic = "SELECT abiotic_name FROM abiotic_resistance WHERE abiotic_resistance_id = $1";
                                            $queryAbiotic_run = pg_query_params($conn, $queryAbiotic, array($abiotic_id));

                                            if (pg_num_rows($queryAbiotic_run) > 0) {
                                                $abiotic_name = pg_fetch_assoc($queryAbiotic_run)['abiotic_name'];
                                                $abiotic_names[] = $abiotic_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }
                        ?>
                                <!-- MORPHOLOGY TABLE -->
                                <h4 class="info-title col-12">Morphological Traits</h4>
                                <div class="table-container border rounded oveflow-hidden mb-4">
                                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Plant Height</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['corn_plant_height'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Width</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['corn_leaf_width'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Length</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['corn_leaf_length'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Meaning of Name</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['meaning_of_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Yield Capacity</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['corn_yield_capacity'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Width</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['seed_width'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Length</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['seed_length'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Shape</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['seed_shape'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Color</th>
                                                <td class="w-75 fw-semibold"><?= $crops_corn['seed_color'] ?></td>
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
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($pest_names)) {
                                                        echo "";
                                                    } else {
                                                        $pest_names_str = ''; // Initialize an empty string
                                                        foreach ($pest_names as $name) {
                                                            $pest_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $pest_names_str = rtrim($pest_names_str, ', ');
                                                        echo $pest_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Disease Resistance</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($disease_names)) {
                                                        echo "";
                                                    } else {
                                                        $disease_names_str = ''; // Initialize an empty string
                                                        foreach ($disease_names as $name) {
                                                            $disease_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $disease_names_str = rtrim($disease_names_str, ', ');
                                                        echo $disease_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Resistance to Abiotic Stress</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($abiotic_names)) {
                                                        echo "";
                                                    } else {
                                                        $abiotic_names_str = ''; // Initialize an empty string
                                                        foreach ($abiotic_names as $name) {
                                                            $abiotic_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $abiotic_names_str = rtrim($abiotic_names_str, ', ');
                                                        echo $abiotic_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            <?php
                            }
                        } else if ($get_category_name === 'Rice') {
                            // Fetch data from the rice table
                            $queryRice = "SELECT DISTINCT crop.*, rice_traits.*, vegetative_state_rice.*, reproductive_state_rice.*,
                            ARRAY(SELECT DISTINCT rice_pest_resistance.pest_resistance_id FROM rice_pest_resistance WHERE rice_pest_resistance.rice_traits_id = rice_traits.rice_traits_id) AS pest_resistances,
                            ARRAY(SELECT DISTINCT rice_disease_resistance.disease_resistance_id FROM rice_disease_resistance WHERE rice_disease_resistance.rice_traits_id = rice_traits.rice_traits_id) AS disease_resistances,
                            ARRAY(SELECT DISTINCT rice_abiotic_resistance.abiotic_resistance_id FROM rice_abiotic_resistance WHERE rice_abiotic_resistance.rice_traits_id = rice_traits.rice_traits_id) AS abiotic_resistances,
                            rice_pest_resistance_other.*, rice_abiotic_resistance_other.*, seed_traits.*, panicle_traits_rice.*, flag_leaf_traits_rice.*, sensory_traits_rice.*
                            FROM crop 
                            left join rice_traits on crop.crop_id = rice_traits.crop_id left join vegetative_state_rice on rice_traits.vegetative_state_rice_id = vegetative_state_rice.vegetative_state_rice_id
                            left join reproductive_state_rice on rice_traits.reproductive_state_rice_id = reproductive_state_rice.reproductive_state_rice_id
                            left join rice_pest_resistance on rice_traits.rice_traits_id = rice_pest_resistance.rice_traits_id left join pest_resistance on pest_resistance.pest_resistance_id = rice_pest_resistance.pest_resistance_id
                            left join rice_disease_resistance on rice_traits.rice_traits_id = rice_disease_resistance.rice_traits_id left join disease_resistance on disease_resistance.disease_resistance_id = rice_disease_resistance.disease_resistance_id
                            left join rice_abiotic_resistance on rice_traits.rice_traits_id = rice_abiotic_resistance.rice_traits_id left join abiotic_resistance on abiotic_resistance.abiotic_resistance_id = rice_abiotic_resistance.abiotic_resistance_id
                            left join rice_pest_resistance_other on rice_pest_resistance_other.rice_pest_other_id = rice_traits.rice_pest_other_id
                            left join rice_abiotic_resistance_other on rice_abiotic_resistance_other.rice_abiotic_other_id = rice_traits.rice_abiotic_other_id
                            left join seed_traits on seed_traits.seed_traits_id = reproductive_state_rice.seed_traits_id
                            left join panicle_traits_rice on panicle_traits_rice.panicle_traits_rice_id = reproductive_state_rice.panicle_traits_rice_id
                            left join flag_leaf_traits_rice on flag_leaf_traits_rice.flag_leaf_traits_rice_id = reproductive_state_rice.flag_leaf_traits_rice_id
                            LEFT JOIN sensory_traits_rice ON sensory_traits_rice.sensory_traits_rice_id = rice_traits.sensory_traits_rice_id
                            WHERE crop.crop_id = $1";
                            $queryRice_run = pg_query_params($conn, $queryRice, array($crop_id));

                            if (pg_num_rows($queryRice_run) > 0) {
                                $crops_rice = pg_fetch_assoc($queryRice_run);

                                $pest_resistances = $crops_rice['pest_resistances'];
                                $pest_names = [];

                                // get the pest resistance
                                if (isset($pest_resistances)) {
                                    // Split the string into an array of integers
                                    $pest_resistances_arr = explode(',', substr($pest_resistances, 1, -1));

                                    // Loop through the submitted pest resistance IDs
                                    foreach ($pest_resistances_arr as $pest_id) {
                                        if (!empty($pest_id)) {
                                            $queryPest = "SELECT pest_name FROM pest_resistance WHERE pest_resistance_id = $1";
                                            $queryPest_run = pg_query_params($conn, $queryPest, array($pest_id));

                                            if (pg_num_rows($queryPest_run) > 0) {
                                                $pest_name = pg_fetch_assoc($queryPest_run)['pest_name'];
                                                $pest_names[] = $pest_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }

                                $disease_resistances = $crops_rice['disease_resistances'];
                                $disease_name = [];

                                // get the disease resistance
                                if (isset($disease_resistances)) {
                                    // Split the string into an array of integers
                                    $disease_resistances_arr = explode(',', substr($disease_resistances, 1, -1));

                                    // Loop through the submitted disease resistance IDs
                                    foreach ($disease_resistances_arr as $disease_id) {
                                        if (!empty($disease_id)) {
                                            $queryDisease = "SELECT disease_name FROM disease_resistance WHERE disease_resistance_id = $1";
                                            $queryDisease_run = pg_query_params($conn, $queryDisease, array($disease_id));

                                            if (pg_num_rows($queryDisease_run) > 0) {
                                                $disease_name = pg_fetch_assoc($queryDisease_run)['disease_name'];
                                                $disease_names[] = $disease_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }

                                $abiotic_resistances = $crops_rice['abiotic_resistances'];
                                $abiotic_name = [];

                                // get the abiotic resistance
                                if (isset($abiotic_resistances)) {
                                    // Split the string into an array of integers
                                    $abiotic_resistances_arr = explode(',', substr($abiotic_resistances, 1, -1));
                                    // Loop through the submitted abiotic resistance IDs
                                    foreach ($abiotic_resistances_arr as $abiotic_id) {
                                        if (!empty($abiotic_id)) {
                                            $queryAbiotic = "SELECT abiotic_name FROM abiotic_resistance WHERE abiotic_resistance_id = $1";
                                            $queryAbiotic_run = pg_query_params($conn, $queryAbiotic, array($abiotic_id));

                                            if (pg_num_rows($queryAbiotic_run) > 0) {
                                                $abiotic_name = pg_fetch_assoc($queryAbiotic_run)['abiotic_name'];
                                                $abiotic_names[] = $abiotic_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }

                            ?>
                                <!-- MORPHOLOGY TABLE -->
                                <h4 class="info-title col-12">Morphological Traits</h4>
                                <div class="table-container border rounded oveflow-hidden mb-4">

                                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Plant Height</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['rice_plant_height'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Width</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['rice_leaf_width'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Length</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['rice_leaf_length'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Meaning of Name</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['meaning_of_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Yield Capacity</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['rice_yield_capacity'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Width</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['seed_width'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Length</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['seed_length'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Shape</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['seed_shape'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Seed Color</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['seed_color'] ?></td>
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
                                                <td class="w-75 fw-semibold"><?= $crops_rice['aroma'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Quality of Cooked Rice</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['quality_cooked_rice'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Quality of Leftover Rice</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['quality_leftover_rice'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Volume Expansion</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($crops_rice['volume_expansion'])) {
                                                        echo "It does not rise";
                                                    } else {
                                                        echo "It rises";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Glutinousity</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($crops_rice['glutinous'])) {
                                                        echo "It is glutinous";
                                                    } else {
                                                        echo "It is glutinous";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Hardness</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($crops_rice['hardness'])) {
                                                        echo "Soft";
                                                    } else {
                                                        echo "Hard";
                                                    }
                                                    ?>
                                                </td>
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
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($pest_names)) {
                                                        echo "";
                                                    } else {
                                                        $pest_names_str = ''; // Initialize an empty string
                                                        foreach ($pest_names as $name) {
                                                            $pest_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $pest_names_str = rtrim($pest_names_str, ', ');
                                                        echo $pest_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Disease Resistance</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($disease_names)) {
                                                        echo "";
                                                    } else {
                                                        $disease_names_str = ''; // Initialize an empty string
                                                        foreach ($disease_names as $name) {
                                                            $disease_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $disease_names_str = rtrim($disease_names_str, ', ');
                                                        echo $disease_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Resistance to Abiotic Stress</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($abiotic_names)) {
                                                        echo "";
                                                    } else {
                                                        $abiotic_names_str = ''; // Initialize an empty string
                                                        foreach ($abiotic_names as $name) {
                                                            $abiotic_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $abiotic_names_str = rtrim($abiotic_names_str, ', ');
                                                        echo $abiotic_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Panicle TRAITS -->
                                <h4 class="info-title col-12">Panicle Traits</h4>
                                <div class="table-container border rounded oveflow-hidden mb-4">

                                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Panicle Length</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['panicle_length'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Panicle Width</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['panicle_width'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Panicle Enclosed by</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['panicle_enclosed_by'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Panicle Remarkable Features</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['panicle_remarkable_features'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Flag Leaf TRAITS -->
                                <h4 class="info-title col-12">Flag Leaf Traits</h4>
                                <div class="table-container border rounded oveflow-hidden mb-4">

                                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Flag Length</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['flag_length'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Flag Width</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['flag_width'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Purplish Stripes</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (!empty($crops_rice['purplish_stripes'])) {
                                                        echo "Purple stripes present";
                                                    } else {
                                                        echo "Not present";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Pubescence</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['pubescence'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Other Remarkable Features</th>
                                                <td class="w-75 fw-semibold"><?= $crops_rice['flag_remarkable_features'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            <?php
                            }
                        } else if ($get_category_name === 'Root Crop') {
                            // Fetch data from the crop table and join with crop_location
                            $query = "SELECT DISTINCT crop.*, root_crop_traits.*, vegetative_state_rootcrop.*, rootcrop_traits.*, 
                            ARRAY(SELECT DISTINCT rootcrop_pest_resistance.pest_resistance_id FROM rootcrop_pest_resistance WHERE rootcrop_pest_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS pest_resistances,
                            ARRAY(SELECT DISTINCT rootcrop_disease_resistance.disease_resistance_id FROM rootcrop_disease_resistance WHERE rootcrop_disease_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS disease_resistances,
                            ARRAY(SELECT DISTINCT rootcrop_abiotic_resistance.abiotic_resistance_id FROM rootcrop_abiotic_resistance WHERE rootcrop_abiotic_resistance.root_crop_traits_id = root_crop_traits.root_crop_traits_id) AS abiotic_resistances,
                            rootcrop_pest_resistance_other.*, rootcrop_abiotic_resistance_other.*
                            from crop
                            left join root_crop_traits on crop.crop_id = root_crop_traits.crop_id left join vegetative_state_rootcrop on root_crop_traits.vegetative_state_rootcrop_id = vegetative_state_rootcrop.vegetative_state_rootcrop_id
                            left join rootcrop_pest_resistance on root_crop_traits.root_crop_traits_id = rootcrop_pest_resistance.root_crop_traits_id left join pest_resistance on pest_resistance.pest_resistance_id = rootcrop_pest_resistance.pest_resistance_id
                            left join rootcrop_disease_resistance on root_crop_traits.root_crop_traits_id = rootcrop_disease_resistance.root_crop_traits_id left join disease_resistance on disease_resistance.disease_resistance_id = rootcrop_disease_resistance.disease_resistance_id
                            left join rootcrop_abiotic_resistance on root_crop_traits.root_crop_traits_id = rootcrop_abiotic_resistance.root_crop_traits_id left join abiotic_resistance on abiotic_resistance.abiotic_resistance_id = rootcrop_abiotic_resistance.abiotic_resistance_id
                            left join rootcrop_pest_resistance_other on rootcrop_pest_resistance_other.rootcrop_pest_other_id = root_crop_traits.rootcrop_pest_other_id
                            left join rootcrop_abiotic_resistance_other on rootcrop_abiotic_resistance_other.rootcrop_abiotic_other_id = root_crop_traits.rootcrop_abiotic_other_id
                            left join rootcrop_traits on rootcrop_traits.rootcrop_traits_id = root_crop_traits.rootcrop_traits_id
                            WHERE crop.crop_id = $1";
                            $query_run = pg_query_params($conn, $query, array($crop_id));

                            if (pg_num_rows($query_run) > 0) {
                                $crops_root = pg_fetch_assoc($query_run);

                                $pest_resistances = $crops_root['pest_resistances'];
                                $pest_names = [];

                                // get the pest resistance
                                if (isset($pest_resistances)) {
                                    // Split the string into an array of integers
                                    $pest_resistances_arr = explode(',', substr($pest_resistances, 1, -1));

                                    // Loop through the submitted pest resistance IDs
                                    foreach ($pest_resistances_arr as $pest_id) {
                                        if (!empty($pest_id)) {
                                            $queryPest = "SELECT pest_name FROM pest_resistance WHERE pest_resistance_id = $1";
                                            $queryPest_run = pg_query_params($conn, $queryPest, array($pest_id));

                                            if (pg_num_rows($queryPest_run) > 0) {
                                                $pest_name = pg_fetch_assoc($queryPest_run)['pest_name'];
                                                $pest_names[] = $pest_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }

                                $disease_resistances = $crops_root['disease_resistances'];
                                $disease_name = [];

                                // get the disease resistance
                                if (isset($disease_resistances)) {
                                    // Split the string into an array of integers
                                    $disease_resistances_arr = explode(',', substr($disease_resistances, 1, -1));

                                    // Loop through the submitted disease resistance IDs
                                    foreach ($disease_resistances_arr as $disease_id) {
                                        if (!empty($disease_id)) {
                                            $queryDisease = "SELECT disease_name FROM disease_resistance WHERE disease_resistance_id = $1";
                                            $queryDisease_run = pg_query_params($conn, $queryDisease, array($disease_id));

                                            if (pg_num_rows($queryDisease_run) > 0) {
                                                $disease_name = pg_fetch_assoc($queryDisease_run)['disease_name'];
                                                $disease_names[] = $disease_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }

                                $abiotic_resistances = $crops_root['abiotic_resistances'];
                                $abiotic_name = [];

                                // get the abiotic resistance
                                if (isset($abiotic_resistances)) {
                                    // Split the string into an array of integers
                                    $abiotic_resistances_arr = explode(',', substr($abiotic_resistances, 1, -1));
                                    // Loop through the submitted abiotic resistance IDs
                                    foreach ($abiotic_resistances_arr as $abiotic_id) {
                                        if (!empty($abiotic_id)) {
                                            $queryAbiotic = "SELECT abiotic_name FROM abiotic_resistance WHERE abiotic_resistance_id = $1";
                                            $queryAbiotic_run = pg_query_params($conn, $queryAbiotic, array($abiotic_id));

                                            if (pg_num_rows($queryAbiotic_run) > 0) {
                                                $abiotic_name = pg_fetch_assoc($queryAbiotic_run)['abiotic_name'];
                                                $abiotic_names[] = $abiotic_name; // Append the name to the array
                                            }
                                        }
                                    }
                                }
                            ?>
                                <!-- MORPHOLOGY TABLE -->
                                <h4 class="info-title col-12">Morphological Traits</h4>
                                <div class="table-container border rounded oveflow-hidden mb-4">

                                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Plant Height</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['rootcrop_plant_height'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Width</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['rootcrop_leaf_width'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Leaf Length</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['rootcrop_leaf_length'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Meaning of Name</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['meaning_of_name'] ?></td>
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
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($pest_names)) {
                                                        echo "";
                                                    } else {
                                                        $pest_names_str = ''; // Initialize an empty string
                                                        foreach ($pest_names as $name) {
                                                            $pest_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $pest_names_str = rtrim($pest_names_str, ', ');
                                                        echo $pest_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Disease Resistance</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($disease_names)) {
                                                        echo "";
                                                    } else {
                                                        $disease_names_str = ''; // Initialize an empty string
                                                        foreach ($disease_names as $name) {
                                                            $disease_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $disease_names_str = rtrim($disease_names_str, ', ');
                                                        echo $disease_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Resistance to Abiotic Stress</th>
                                                <td class="w-75 fw-semibold">
                                                    <?php
                                                    if (empty($abiotic_names)) {
                                                        echo "";
                                                    } else {
                                                        $abiotic_names_str = ''; // Initialize an empty string
                                                        foreach ($abiotic_names as $name) {
                                                            $abiotic_names_str .= $name . ', '; // Concatenate each name with a comma and space
                                                        }
                                                        // Remove the trailing comma and space
                                                        $abiotic_names_str = rtrim($abiotic_names_str, ', ');
                                                        echo $abiotic_names_str; // Output the concatenated string
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Root Crop TABLE -->
                                <h4 class="info-title col-12">Root Crop Traits</h4>
                                <div class="table-container border rounded oveflow-hidden mb-4">

                                    <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Eating Quality</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['eating_quality'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Color</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['rootcrop_color'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Sweetness</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['sweetness'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-secondary w-25 fw-normal">Remarkable Features</th>
                                                <td class="w-75 fw-semibold"><?= $crops_root['rootcrop_remarkable_features'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                        <?php
                            }
                        }
                        ?>

                        <!-- IMPORTANCE -->
                        <h4 class="info-title col-12">Utilization and Cultural Importance</h4>
                        <div class="table-container border rounded oveflow-hidden mb-4">

                            <table id="" class="table table-borderless table-hover table-light rounded overflow-hidden mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Significance</th>
                                        <td class="w-75 fw-semibold"><?= $crops['significance'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Use</th>
                                        <td class="w-75 fw-semibold"><?= $crops['use'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Indigenous Utilization</th>
                                        <td class="w-75 fw-semibold"><?= $crops['indigenous_utilization'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-secondary w-25 fw-normal">Remarkable Feature</th>
                                        <td class="w-75 fw-semibold"><?= $crops['remarkable_features'] ?></td>
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
                                                <?php
                                                if ($crops['link'] != "") {
                                                    // Split the image names by comma
                                                    $links = explode(',', $crops['link']);
                                                    // Display each image
                                                    foreach ($links as $link) {
                                                        // Check if the link starts with "http://" or "https://"
                                                        if (!preg_match('/^https?:\/\//i', $link)) {
                                                            // If not, prepend "http://"
                                                            $link = "http://" . $link;
                                                        }
                                                ?>
                                                        <li>
                                                            <a href="<?= $link; ?>"><?= $link; ?></a>
                                                        </li>
                                                <?php
                                                    }
                                                } else {
                                                    // Display message or handle the case when $crops['link'] is empty
                                                    echo "";
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

                    <dic class="col-6 ps-4">
                        <div class="row mb-4">
                            <!-- MAP -->
                            <div id="map" class="w-100 rounded"></div>
                        </div>

                        <!-- SEED -->
                        <div class="row mb-4">
                            <h5 class="info-title ps-0">Seed</h5>
                            <div class="image-carousel d-flex rounded px-0">
                                <?php
                                if ($crops['crop_seed_image'] != "") {
                                    // Split the image names by comma
                                    $imageNamesSeed = explode(',', $crops['crop_seed_image']);
                                    // Display each image
                                    foreach ($imageNamesSeed as $imageNameSeed) {
                                ?>
                                        <img src="../contributor/crop-page/modals/img/<?php echo trim($imageNameSeed); ?>" class="view-crop-image rounded">
                                <?php
                                    }
                                } else {
                                    // display message
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- VEGETATIVE -->
                        <div class="row mb-4">
                            <h5 class="info-title ps-0">Vegetative State</h5>
                            <div class="image-carousel d-flex rounded px-0">
                                <?php
                                if ($crops['crop_vegetative_image'] != "") {
                                    // Split the image names by comma
                                    $imageNamesVeg = explode(',', $crops['crop_vegetative_image']);
                                    // Display each image
                                    foreach ($imageNamesVeg as $imageNameVeg) {
                                ?>
                                        <img src="../contributor/crop-page/modals/img/<?php echo trim($imageNameVeg); ?>" class="view-crop-image rounded">
                                <?php
                                    }
                                } else {
                                    // display message
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- REPRODUCTIVE -->
                        <div class="row mb-4">
                            <h5 class="info-title ps-0">Reproductive State</h5>
                            <div class="image-carousel d-flex rounded px-0">
                                <?php
                                if ($crops['crop_reproductive_image'] != "") {
                                    // Split the image names by comma
                                    $imageNamesRepro = explode(',', $crops['crop_reproductive_image']);
                                    // Display each image
                                    foreach ($imageNamesRepro as $imageNameRepro) {
                                ?>
                                        <img src="../contributor/crop-page/modals/img/<?php echo trim($imageNameRepro); ?>" class="view-crop-image rounded">
                                <?php
                                    }
                                } else {
                                    // display message
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>
                    </dic>
            <?php

                }
            }

            ?>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- custom -->
    <script src="js/view.js"></script>
    <script src="js/nav.js"></script>
</body>

</html>
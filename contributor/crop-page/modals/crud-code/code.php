<?php
session_start();
require "../../../../functions/connections.php";

if (isset($_POST['save']) && $_SESSION['rank'] == 'Curator' || $_SESSION['rank'] == 'Admin') {
    // Begin the database transaction
    pg_query($conn, "BEGIN");
    try {
        // Function to handle empty values
        function handleEmpty($value)
        {
            return empty($value) ? 'Empty' : $value;
        }
        // get all the data in the form
        // gen.php
        $crop_variety = handleEmpty($_POST['crop_variety']);
        $category_variety_id = $_POST['category_variety_id'];
        $crop_description = handleEmpty($_POST['crop_description']);
        $terrain_id = handleEmpty($_POST['terrain_id']);
        $category_id = $_POST['category_id'];

        // loc.php
        $province_name = $_POST['province'];
        $municipality_name = $_POST['municipality'];
        $meaning_of_name = handleEmpty($_POST['meaning_of_name']);
        $coordinates = handleEmpty($_POST['coordinates']);
        $barangay_name = $_POST['barangay'];

        $user_id = $_POST['user_id'];
        $status = 'approved';

        // disease resistance
        $bacterial = isset($_POST['bacterial']) ? true : false;
        $viral = isset($_POST['viral']) ? true : false;
        $fungus = isset($_POST['fungus']) ? true : false;

        // abiotic resistance
        $drought = isset($_POST['drought']) ? true : false;
        $salinity = isset($_POST['salinity']) ? true : false;
        $heat = isset($_POST['heat']) ? true : false;
        $abiotic_other = isset($_POST['abiotic_other']) ? true : false;
        $abiotic_other_desc = isset($_POST['abiotic_other_desc']) ? handleEmpty($_POST['abiotic_other_desc']) : "Empty";

        // Utilization Cultural Importance
        $significance = isset($_POST['significance']) ? handleEmpty($_POST['significance']) : "Empty";
        $use = isset($_POST['use']) ? handleEmpty($_POST['use']) : "Empty";
        $indigenous_utilization = isset($_POST['indigenous_utilization']) ? handleEmpty($_POST['indigenous_utilization']) : "Empty";
        $remarkable_features = isset($_POST['remarkable_features']) ? handleEmpty($_POST['remarkable_features']) : "Empty";

        //* morphological Traits Corn
        // Vegetative state corn
        $corn_plant_height = isset($_POST['corn_plant_height']) ? handleEmpty($_POST['corn_plant_height']) : "Empty";
        $corn_leaf_width = isset($_POST['corn_leaf_width']) ? handleEmpty($_POST['corn_leaf_width']) : "Empty";
        $corn_leaf_length = isset($_POST['corn_leaf_length']) ? handleEmpty($_POST['corn_leaf_length']) : "Empty";
        $corn_maturity_time = isset($_POST['corn_maturity_time']) ? handleEmpty($_POST['corn_maturity_time']) : "Empty";

        // Reproductive state corn
        $corn_yield_capacity = isset($_POST['corn_yield_capacity']) ? handleEmpty($_POST['corn_yield_capacity']) : "Empty";

        // seed traits corn
        $seed_length = isset($_POST['seed_length']) ? handleEmpty($_POST['seed_length']) : "Empty";
        $seed_width = isset($_POST['seed_width']) ? handleEmpty($_POST['seed_width']) : "Empty";
        $seed_shape = isset($_POST['seed_shape']) ? handleEmpty($_POST['seed_shape']) : "Empty";
        $seed_color = isset($_POST['seed_color']) ? handleEmpty($_POST['seed_color']) : "Empty";

        // Pest resistance corn
        echo $corn_borers = isset($_POST['corn_borers']) ? true : false;
        echo $earworms = isset($_POST['earworms']) ? true : false;
        echo $spider_mites = isset($_POST['spider_mites']) ? true : false;
        echo $corn_black_bug = isset($_POST['corn_black_bug']) ? true : false;
        echo $corn_army_worms = isset($_POST['corn_army_worms']) ? true : false;
        echo $leaf_aphid = isset($_POST['leaf_aphid']) ? true : false;
        echo $corn_cutWorms = isset($_POST['corn_cutWorms']) ? true : false;
        echo $corn_birds = isset($_POST['corn_birds']) ? true : false;
        echo $corn_ants = isset($_POST['corn_ants']) ? true : false;
        echo $corn_rats = isset($_POST['corn_rats']) ? true : false;
        echo $corn_others = isset($_POST['corn_others']) ? true : false;

        //* morphological Traits rice
        // Vegetative state rice
        $rice_plant_height = isset($_POST['rice_plant_height']) ? handleEmpty($_POST['rice_plant_height']) : "Empty";
        $rice_leaf_width = isset($_POST['rice_leaf_width']) ? handleEmpty($_POST['rice_leaf_width']) : "Empty";
        $rice_leaf_length = isset($_POST['rice_leaf_length']) ? handleEmpty($_POST['rice_leaf_length']) : "Empty";
        $rice_tillering_ability = isset($_POST['rice_tillering_ability']) ? handleEmpty($_POST['rice_tillering_ability']) : "Empty";
        $rice_maturity_time = isset($_POST['rice_maturity_time']) ? handleEmpty($_POST['rice_maturity_time']) : "Empty";

        // Reproductive state rice
        $rice_yield_capacity = isset($_POST['rice_yield_capacity']) ? handleEmpty($_POST['rice_yield_capacity']) : "Empty";
        // Panicle traits
        $panicle_length = isset($_POST['panicle_length']) ? handleEmpty($_POST['panicle_length']) : "Empty";
        $panicle_width = isset($_POST['panicle_width']) ? handleEmpty($_POST['panicle_width']) : "Empty";
        $panicle_enclosed_by = isset($_POST['panicle_enclosed_by']) ? handleEmpty($_POST['panicle_enclosed_by']) : "Empty";
        $panicle_remarkable_features = isset($_POST['panicle_remarkable_features']) ? handleEmpty($_POST['panicle_remarkable_features']) : "Empty";
        // Flag Leaf traits rice
        $flag_length = isset($_POST['flag_length']) ? handleEmpty($_POST['flag_length']) : "Empty";
        $flag_width = isset($_POST['flag_width']) ? handleEmpty($_POST['flag_width']) : "Empty";
        $purplish_stripes = isset($_POST['purplish_stripes']) ? handleEmpty($_POST['purplish_stripes']) : "Empty";
        $pubescence = isset($_POST['pubescence']) ? handleEmpty($_POST['pubescence']) : "Empty";
        $flag_remarkable_features = isset($_POST['flag_remarkable_features']) ? handleEmpty($_POST['flag_remarkable_features']) : "Empty";

        // Sensory traits rice
        $aroma = isset($_POST['aroma']) ? handleEmpty($_POST['aroma']) : "Empty";
        $quality_cooked_rice = isset($_POST['quality_cooked_rice']) ? handleEmpty($_POST['quality_cooked_rice']) : "Empty";
        $quality_leftover_rice = isset($_POST['quality_leftover_rice']) ? handleEmpty($_POST['quality_leftover_rice']) : "Empty";
        $volume_expansion = isset($_POST['volume_expansion']) ? handleEmpty($_POST['volume_expansion']) : "Empty";
        $glutinous = isset($_POST['glutinous']) ? handleEmpty($_POST['glutinous']) : "Empty";
        $hardness = isset($_POST['hardness']) ? handleEmpty($_POST['hardness']) : "Empty";

        // abiotic resistance rice
        $rice_drought = isset($_POST['rice_drought']) ? true : false;
        $rice_salinity = isset($_POST['rice_salinity']) ? true : false;
        $rice_heat = isset($_POST['rice_heat']) ? true : false;
        $harmful_radiation = isset($_POST['harmful_radiation']) ? true : false;
        $rice_abiotic_other = isset($_POST['rice_abiotic_other']) ? true : false;

        // Pest resistance rice
        $rice_borers = isset($_POST['rice_borers']) ? true : false;
        $rice_snail = isset($_POST['rice_snail']) ? true : false;
        $hoppers = isset($_POST['hoppers']) ? true : false;
        $rice_black_bug = isset($_POST['rice_black_bug']) ? true : false;
        $leptocorisa = isset($_POST['leptocorisa']) ? true : false;
        $leaf_folder = isset($_POST['leaf_folder']) ? true : false;
        $rice_birds = isset($_POST['rice_birds']) ? true : false;
        $rice_ants = isset($_POST['rice_ants']) ? true : false;
        $rice_rats = isset($_POST['rice_rats']) ? true : false;
        $rice_army_worms = isset($_POST['rice_army_worms']) ? true : false;
        $rice_others = isset($_POST['rice_others']) ? true : false;

        //* morphological Traits rootcrop
        // Vegetative state rootcrop
        $rootcrop_plant_height = isset($_POST['rootcrop_plant_height']) ? handleEmpty($_POST['rootcrop_plant_height']) : "Empty";
        $rootcrop_leaf_width = isset($_POST['rootcrop_leaf_width']) ? handleEmpty($_POST['rootcrop_leaf_width']) : "Empty";
        $rootcrop_leaf_length = isset($_POST['rootcrop_leaf_length']) ? handleEmpty($_POST['rootcrop_leaf_length']) : "Empty";
        $rootcrop_stem_leaf_desc = isset($_POST['rootcrop_stem_leaf_desc']) ? handleEmpty($_POST['rootcrop_stem_leaf_desc']) : "Empty";
        $rootcrop_maturity_time = isset($_POST['rootcrop_maturity_time']) ? handleEmpty($_POST['rootcrop_maturity_time']) : "Empty";

        // Pest resistance rootcrop
        $root_aphids = isset($_POST['root_aphids']) ? true : false;
        $root_knot_nematodes = isset($_POST['root_knot_nematodes']) ? true : false;
        $rootcrop_cutworms = isset($_POST['rootcrop_cutworms']) ? true : false;
        $white_grubs = isset($_POST['white_grubs']) ? true : false;
        $termites = isset($_POST['termites']) ? true : false;
        $weevils = isset($_POST['weevils']) ? true : false;
        $flea_beetles = isset($_POST['flea_beetles']) ? true : false;
        $rootcrop_snails = isset($_POST['rootcrop_snails']) ? true : false;
        $rootcrop_ants = isset($_POST['rootcrop_ants']) ? true : false;
        $rootcrop_rats = isset($_POST['rootcrop_rats']) ? true : false;
        $rootcrop_others = isset($_POST['rootcrop_others']) ? true : false;
        $rootcrop_others_desc = isset($_POST['rootcrop_others_desc']) ? handleEmpty($_POST['rootcrop_others_desc']) : "Empty";

        // rootcrop traits
        $eating_quality = isset($_POST['eating_quality']) ? handleEmpty($_POST['eating_quality']) : "Empty";
        $rootcrop_color = isset($_POST['rootcrop_color']) ? handleEmpty($_POST['rootcrop_color']) : "Empty";
        $sweetness = isset($_POST['sweetness']) ? handleEmpty($_POST['sweetness']) : "Empty";
        $rootcrop_remarkable_features = isset($_POST['rootcrop_remarkable_features']) ? handleEmpty($_POST['rootcrop_remarkable_features']) : "Empty";

        // Validate the form data
        if (empty($crop_variety) || empty($category_variety_id) || empty($category_id) || empty($terrain_id) || empty($province_name) || empty($municipality_name) || empty($barangay_name)) {
            throw new Exception("All fields are required.");
        }

        // Array to store uploaded image names
        $imageNamesArray = [];

        // Check if the image is selected
        // if (isset($_FILES['crop_image']['name']) && is_array($_FILES['crop_image']['name'])) {
        //     $extension = array('jpg', 'jpeg', 'png', 'gif');

        //     foreach ($_FILES['crop_image']['name'] as $key => $value) {
        //         $filename = $_FILES['crop_image']['name'][$key];
        //         $filename_tmp = $_FILES['crop_image']['tmp_name'][$key];
        //         $destination_path = "../img/" . $filename;
        //         $ext = pathinfo($filename, PATHINFO_EXTENSION);

        //         $finalimg = '';

        //         if (in_array($ext, $extension)) {
        //             // Auto rename image
        //             $image = "Crop_image_" . rand(000, 999) . '.' . $ext;

        //             // Check if the image name already exists in the database
        //             while (true) {
        //                 $query = "SELECT crop_image FROM crop WHERE crop_image = $1";
        //                 $result = pg_query_params($conn, $query, array($image));

        //                 if ($result === false) {
        //                     break;
        //                 }

        //                 $count = pg_num_rows($result);

        //                 if ($count == 0) {
        //                     break;
        //                 } else {
        //                     // If the image name exists, generate a new one
        //                     $image = "Crop_image_" . rand(000, 999) . '.' . $ext;
        //                 }
        //             }

        //             $source_path = $_FILES['crop_image']['tmp_name'][$key];
        //             $destination_path = "../img/" . $image;

        //             // Upload the image
        //             $upload = move_uploaded_file($source_path, $destination_path);

        //             // Check whether the image is uploaded or not
        //             if (!$upload) {
        //                 echo "wala na upload ang image";
        //                 echo "Error: " . pg_last_error($conn);
        //                 die();
        //             }

        //             $finalimg = $image;
        //             $imageNamesArray[] = $finalimg; // Add image name to the array
        //         } else {
        //             // Display error message for invalid file format
        //             echo "invalid ang file format image";
        //             echo "Error: " . pg_last_error($conn);
        //             die();
        //         }
        //     }
        // } else {
        //     // Don't upload image and set the image value as blank
        //     echo "wala image na select";
        //     echo "Error: " . pg_last_error($conn);
        //     die();
        // }

        // $imageNamesString = implode(',', $imageNamesArray);

        // for creating a unique code for each crops
        // Get the latest unique_code from the crop table
        $queryLatestCode = "SELECT category_name FROM category WHERE category_id = $1";
        $resultLatestCode = pg_query_params($conn, $queryLatestCode, array($category_id));

        if ($resultLatestCode) {
            $latestCodeRow = pg_fetch_assoc($resultLatestCode);
            $latestCode = $latestCodeRow['category_name'];

            // Extract the first letter of each word in the category name
            $prefix = '';
            $words = explode(' ', $latestCode);
            foreach ($words as $word) {
                $prefix .= strtoupper(substr($word, 0, 1));
            }

            // Fetch all existing unique codes from the crop table
            $queryUniqueCodes = "SELECT unique_code FROM crop WHERE unique_code LIKE '$prefix%'";
            $resultUniqueCodes = pg_query($conn, $queryUniqueCodes);

            // Extract the highest number from the existing codes
            $existingNumbers = [];
            while ($row = pg_fetch_assoc($resultUniqueCodes)) {
                preg_match('/(\d+)$/', $row['unique_code'], $matches);
                if (isset($matches[1])) {
                    $existingNumbers[] = intval($matches[1]);
                }
            }

            if (empty($existingNumbers)) {
                // If no existing codes, set the current number to 0
                $currentNumber = 0;
            } else {
                $currentNumber = max($existingNumbers);
            }

            // Generate the new unique code
            $newUniqueCode = $prefix . 'V' . ($currentNumber + 1);
        }

        //insert into utilization cultural table
        $query_utilCultural = "INSERT INTO utilization_cultural_importance (significance, \"use\", indigenous_utilization, remarkable_features)
            VALUES ($1, $2, $3, $4) RETURNING utilization_cultural_id";

        $value_utilCultural = array($significance, $use, $indigenous_utilization, $remarkable_features);
        $query_run_utilCultural = pg_query_params($conn, $query_utilCultural, $value_utilCultural);

        if ($query_run_utilCultural) {
            $row_utilCultural = pg_fetch_row($query_run_utilCultural);
            $utilization_cultural_id = $row_utilCultural[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //insert into crop table
        $queryCrop = "INSERT INTO crop (crop_variety, crop_description, status, unique_code,
        meaning_of_name, category_id, user_id, category_variety_id, terrain_id, utilization_cultural_id)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10) RETURNING crop_id";

        $valueCrops = array(
            $crop_variety, $crop_description, $status, $newUniqueCode,
            $meaning_of_name, $category_id, $user_id, $category_variety_id, $terrain_id, $utilization_cultural_id
        );
        $query_run_Crop = pg_query_params($conn, $queryCrop, $valueCrops);

        if ($query_run_Crop) {
            $row_crop = pg_fetch_row($query_run_Crop);
            $crop_id = $row_crop[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Location Table
        // Get the location id
        $queryLoc = "SELECT location_id from location where province_name = $1 and municipality_name = $2";
        $query_run_loc = pg_query_params($conn, $queryLoc, array($province_name, $municipality_name));

        if ($query_run_loc) {
            $row_loc = pg_fetch_row(($query_run_loc));
            $location_id = $row_loc[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // Barangay Tab
        // get the barangay id
        $querybrgy = "SELECT barangay_id from barangay where barangay_name = $1";
        $query_run_brgy = pg_query_params($conn, $querybrgy, array($barangay_name));

        if ($query_run_brgy) {
            $row_brgy = pg_fetch_row(($query_run_brgy));
            $barangay_id = $row_brgy[0];
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        // save into Crop Location Table
        $query_CropLoc = "INSERT into crop_location (crop_id, location_id, barangay_id, coordinates) VALUES ($1, $2, $3, $4) RETURNING crop_location_id";
        $query_run_CropLoc = pg_query_params($conn, $query_CropLoc, array($crop_id, $location_id, $barangay_id, $coordinates));

        if ($query_run_CropLoc) {
            // Check if any rows were affected
            if (pg_affected_rows($query_run_CropLoc) > 0) {
                $row_CropLoc = pg_fetch_row($query_run_CropLoc);
                $crop_location_id = $row_CropLoc[0];
            } else {
                echo "Error: No rows affected";
                exit(0);
            }
        } else {
            echo "Error: " . pg_last_error($conn);
            exit(0);
        }

        //* for saving the morphological traits depending on the category selected
        // get category_name
        $get_categoryName = "SELECT category_name from category where category_id = $1";
        $query_run_categoryName = pg_query_params($conn, $get_categoryName, array($category_id));

        if ($query_run_categoryName) {
            $row_categoryName = pg_fetch_assoc(($query_run_categoryName));
            $get_category_name = $row_categoryName['category_name'];
        } else {
            $_SESSION['message'] = "No category selected";
            header("location: ../../../crop.php");
            exit();
        }

        // Check the category name and perform actions accordingly
        if ($get_category_name === 'Corn') {
            // Handle corn category traits
            // abiotic resistance
            $query_abioticRes = "INSERT into abiotic_resistance (drought, salinity, heat, abiotic_other) values ($1, $2, $3, $4) returning abiotic_resistance_id";
            $query_run_abioticRes = pg_query_params($conn, $query_abioticRes, array($drought, $salinity, $heat, $abiotic_other));
            if ($query_run_abioticRes) {
                $row_abioticRes = pg_fetch_row($query_run_abioticRes);
                $abiotic_resistance_id = $row_abioticRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // disease resistance
            $query_diseaseRes = "INSERT into disease_resistance (bacterial, viral, fungus) values ($1, $2, $3) returning disease_resistance_id";
            $query_run_diseaseRes = pg_query_params($conn, $query_diseaseRes, array($bacterial, $viral, $fungus));
            if ($query_run_diseaseRes) {
                $row_diseaseRes = pg_fetch_row($query_run_diseaseRes);
                $disease_resistance_id = $row_diseaseRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // pest resistance corn
            $query_pestRes = "INSERT into pest_resistance_corn (corn_borers, earworms, spider_mites, corn_black_bug, corn_army_worms, leaf_aphid, corn_cutWorms, corn_birds, 
            corn_ants, corn_rats, corn_others) values ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11) returning pest_resistance_corn_id";
            $query_run_pestRes = pg_query_params($conn, $query_pestRes, array(
                $corn_borers, $earworms, $spider_mites, $corn_black_bug, $corn_army_worms,
                $leaf_aphid, $corn_cutWorms, $corn_birds, $corn_ants, $corn_rats, $corn_others
            ));
            if ($query_run_pestRes) {
                $row_pestRes = pg_fetch_row($query_run_pestRes);
                $pest_resistance_corn_id = $row_pestRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // seed traits
            $query_seedTraits = "INSERT into seed_traits (seed_length, seed_width, seed_shape, seed_color) values ($1, $2, $3, $4) returning seed_traits_id";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color));
            if ($query_run_seedTraits) {
                $row_seedTraits = pg_fetch_row($query_run_seedTraits);
                $seed_traits_id = $row_seedTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state corn
            $query_reproductiveState = "INSERT into reproductive_state_corn (corn_yield_capacity, seed_traits_id) values ($1, $2) returning reproductive_state_corn_id";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($corn_yield_capacity, $seed_traits_id));
            if ($query_run_reproductiveState) {
                $row_reproductiveState = pg_fetch_row($query_run_reproductiveState);
                $reproductive_state_corn_id = $row_reproductiveState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state corn
            $query_vegetativeState = "INSERT into vegetative_state_corn (corn_plant_height, corn_leaf_width, corn_leaf_length, corn_maturity_time) values ($1, $2, $3, $4) returning vegetative_state_corn_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($corn_plant_height, $corn_leaf_width, $corn_leaf_length, $corn_maturity_time));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_corn_id = $row_vegetativeState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // corn traits
            $query_cornTraits = "INSERT into corn_traits (crop_id, vegetative_state_corn_id, reproductive_state_corn_id, pest_resistance_corn_id, 
            disease_resistance_id, abiotic_resistance_id) values ($1, $2, $3, $4, $5, $6) returning corn_traits_id";
            $query_run_cornTraits = pg_query_params($conn, $query_cornTraits, array(
                $crop_id, $vegetative_state_corn_id, $reproductive_state_corn_id,
                $pest_resistance_corn_id, $disease_resistance_id, $abiotic_resistance_id
            ));
            if ($query_run_cornTraits) {
                $row_cornTraits = pg_fetch_row($query_run_cornTraits);
                $corn_traits_id = $row_cornTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }
        } elseif ($get_category_name === 'Rice') {
            // Handle rice category
            // abiotic resistance rice
            $query_abioticRes = "INSERT into abiotic_resistance_rice (rice_drought, rice_salinity, rice_heat, harmful_radiation, rice_abiotic_other) values ($1, $2, $3, $4, $5) returning abiotic_resistance_rice_id";
            $query_run_abioticRes = pg_query_params($conn, $query_abioticRes, array($rice_drought, $rice_salinity, $rice_heat, $harmful_radiation, $rice_abiotic_other));
            if ($query_run_abioticRes) {
                $row_abioticRes = pg_fetch_row($query_run_abioticRes);
                $abiotic_resistance_rice_id = $row_abioticRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // disease resistance
            $query_diseaseRes = "INSERT into disease_resistance (bacterial, viral, fungus) values ($1, $2, $3) returning disease_resistance_id";
            $query_run_diseaseRes = pg_query_params($conn, $query_diseaseRes, array($bacterial, $viral, $fungus));
            if ($query_run_diseaseRes) {
                $row_diseaseRes = pg_fetch_row($query_run_diseaseRes);
                $disease_resistance_id = $row_diseaseRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // pest resistance rice
            $query_pestRes = "INSERT into pest_resistance_rice (rice_borers, rice_snail, hoppers, rice_black_bug, leptocorisa, leaf_folder, rice_birds, rice_ants, 
                        rice_rats, rice_army_worms, rice_others) values ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11) returning pest_resistance_rice_id";
            $query_run_pestRes = pg_query_params($conn, $query_pestRes, array(
                $rice_borers, $rice_snail, $hoppers, $rice_black_bug, $leptocorisa,
                $leaf_folder, $rice_birds, $rice_ants, $rice_rats, $rice_army_worms, $rice_others
            ));
            if ($query_run_pestRes) {
                $row_pestRes = pg_fetch_row($query_run_pestRes);
                $pest_resistance_rice_id = $row_pestRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // seed traits
            $query_seedTraits = "INSERT into seed_traits (seed_length, seed_width, seed_shape, seed_color) values ($1, $2, $3, $4) returning seed_traits_id";
            $query_run_seedTraits = pg_query_params($conn, $query_seedTraits, array($seed_length, $seed_width, $seed_shape, $seed_color));
            if ($query_run_seedTraits) {
                $row_seedTraits = pg_fetch_row($query_run_seedTraits);
                $seed_traits_id = $row_seedTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // panicle traits
            $query_panicleTraits = "INSERT into panicle_traits_rice (panicle_length, panicle_width, panicle_enclosed_by, panicle_remarkable_features) values ($1, $2, $3, $4) returning panicle_traits_rice_id";
            $query_run_panicleTraits = pg_query_params($conn, $query_panicleTraits, array($panicle_length, $panicle_width, $panicle_enclosed_by, $panicle_remarkable_features));
            if ($query_run_panicleTraits) {
                $row_panicleTraits = pg_fetch_row($query_run_panicleTraits);
                $panicle_traits_rice_id = $row_panicleTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // flag traits
            $query_flagLeaf = "INSERT into flag_leaf_traits_rice (flag_length, flag_width, purplish_stripes, pubescence, flag_remarkable_features) values ($1, $2, $3, $4, $5) returning flag_leaf_traits_rice_id";
            $query_run_flagLeaf = pg_query_params($conn, $query_flagLeaf, array($flag_length, $flag_width, $purplish_stripes, $pubescence, $flag_remarkable_features));
            if ($query_run_flagLeaf) {
                $row_flagLeaf = pg_fetch_row($query_run_flagLeaf);
                $flag_leaf_traits_rice_id = $row_flagLeaf[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // reproductive state rice
            $query_reproductiveState = "INSERT into reproductive_state_rice (rice_yield_capacity, seed_traits_id, panicle_traits_rice_id, flag_leaf_traits_rice_id) values ($1, $2, $3, $4) returning reproductive_state_rice_id";
            $query_run_reproductiveState = pg_query_params($conn, $query_reproductiveState, array($rice_yield_capacity, $seed_traits_id, $panicle_traits_rice_id, $flag_leaf_traits_rice_id));
            if ($query_run_reproductiveState) {
                $row_reproductiveState = pg_fetch_row($query_run_reproductiveState);
                $reproductive_state_rice_id = $row_reproductiveState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rice
            $query_vegetativeState = "INSERT into vegetative_state_rice (rice_plant_height, rice_leaf_width, rice_leaf_length, rice_tillering_ability, rice_maturity_time) values ($1, $2, $3, $4, $5) returning vegetative_state_rice_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rice_plant_height, $rice_leaf_width, $rice_leaf_length, $rice_tillering_ability, $rice_maturity_time));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_rice_id = $row_vegetativeState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // sensory traits rice
            $query_sensoryTraits = "INSERT into sensory_traits_rice (aroma, quality_cooked_rice, quality_leftover_rice, volume_expansion, glutinous, hardness) values ($1, $2, $3, $4, $5, $6) returning sensory_traits_rice_id";
            $query_run_sensoryTraits = pg_query_params($conn, $query_sensoryTraits, array($aroma, $quality_cooked_rice, $quality_leftover_rice, $volume_expansion, $glutinous, $hardness));
            if ($query_run_sensoryTraits) {
                $row_sensoryTraits = pg_fetch_row($query_run_sensoryTraits);
                $sensory_traits_rice_id = $row_sensoryTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // rice traits
            $query_riceTraits = "INSERT into rice_traits (crop_id, vegetative_state_rice_id, reproductive_state_rice_id, sensory_traits_rice_id, pest_resistance_rice_id, 
            disease_resistance_id, abiotic_resistance_rice_id) values ($1, $2, $3, $4, $5, $6, $7) returning rice_traits_id";
            $query_run_riceTraits = pg_query_params($conn, $query_riceTraits, array(
                $crop_id, $vegetative_state_rice_id, $reproductive_state_rice_id, $sensory_traits_rice_id,
                $pest_resistance_rice_id, $disease_resistance_id, $abiotic_resistance_rice_id
            ));
            if ($query_run_riceTraits) {
                $row_riceTraits = pg_fetch_row($query_run_riceTraits);
                $rice_traits_id = $row_riceTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }
        } elseif ($get_category_name === 'Root Crop') {
            // Handle root crops category
            // abiotic resistance
            $query_abioticRes = "INSERT into abiotic_resistance (drought, salinity, heat, abiotic_other, abiotic_other_desc) values ($1, $2, $3, $4, $5) returning abiotic_resistance_id";
            $query_run_abioticRes = pg_query_params($conn, $query_abioticRes, array($drought, $salinity, $heat, $abiotic_other, $abiotic_other_desc));
            if ($query_run_abioticRes) {
                $row_abioticRes = pg_fetch_row($query_run_abioticRes);
                $abiotic_resistance_id = $row_abioticRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // disease resistance
            $query_diseaseRes = "INSERT into disease_resistance (bacterial, viral, fungus) values ($1, $2, $3) returning disease_resistance_id";
            $query_run_diseaseRes = pg_query_params($conn, $query_diseaseRes, array($bacterial, $viral, $fungus));
            if ($query_run_diseaseRes) {
                $row_diseaseRes = pg_fetch_row($query_run_diseaseRes);
                $disease_resistance_id = $row_diseaseRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // pest resistance rootcrop
            $query_pestRes = "INSERT into pest_resistance_rootcrop (root_aphids, root_knot_nematodes, rootcrop_cutworms, white_grubs, termites, weevils, flea_beetles, rootcrop_snails, 
                        rootcrop_ants, rootcrop_rats, rootcrop_others, rootcrop_others_desc) values ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12) returning pest_resistance_rootcrop_id";
            $query_run_pestRes = pg_query_params($conn, $query_pestRes, array(
                $root_aphids, $root_knot_nematodes, $rootcrop_cutworms, $white_grubs, $termites,
                $weevils, $flea_beetles, $rootcrop_snails, $rootcrop_ants, $rootcrop_rats, $rootcrop_others, $rootcrop_others_desc
            ));
            if ($query_run_pestRes) {
                $row_pestRes = pg_fetch_row($query_run_pestRes);
                $pest_resistance_rootcrop_id = $row_pestRes[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // rootcrop traits
            $query_rootcropTraits = "INSERT into rootcrop_traits (eating_quality, rootcrop_color, sweetness, rootcrop_remarkable_features) values ($1, $2, $3, $4) returning rootcrop_traits_id";
            $query_run_rootcropTraits = pg_query_params($conn, $query_rootcropTraits, array($eating_quality, $rootcrop_color, $sweetness, $rootcrop_remarkable_features));
            if ($query_run_rootcropTraits) {
                $row_rootcropTraits = pg_fetch_row($query_run_rootcropTraits);
                $rootcrop_traits_id = $row_rootcropTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // vegetative state rootcrop
            $query_vegetativeState = "INSERT into vegetative_state_rootcrop (rootcrop_plant_height, rootcrop_leaf_width, rootcrop_leaf_length, rootcrop_stem_leaf_desc, rootcrop_maturity_time) values ($1, $2, $3, $4, $5) returning vegetative_state_rootcrop_id";
            $query_run_vegetativeState = pg_query_params($conn, $query_vegetativeState, array($rootcrop_plant_height, $rootcrop_leaf_width, $rootcrop_leaf_length, $rootcrop_stem_leaf_desc, $rootcrop_maturity_time));
            if ($query_run_vegetativeState) {
                $row_vegetativeState = pg_fetch_row($query_run_vegetativeState);
                $vegetative_state_rootcrop_id = $row_vegetativeState[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }

            // root crop traits
            $query_root_CropTraits = "INSERT into root_crop_traits (crop_id, vegetative_state_rootcrop_id, rootcrop_traits_id, pest_resistance_rootcrop_id, disease_resistance_id, abiotic_resistance_id) values ($1, $2, $3, $4, $5, $6) returning root_crop_traits_id";
            $query_run_root_CropTraits = pg_query_params($conn, $query_root_CropTraits, array(
                $crop_id, $vegetative_state_rootcrop_id, $rootcrop_traits_id, $pest_resistance_rootcrop_id, $disease_resistance_id, $abiotic_resistance_id
            ));
            if ($query_run_root_CropTraits) {
                $row_root_CropTraits = pg_fetch_row($query_run_root_CropTraits);
                $root_Crop_traits_id = $row_root_CropTraits[0];
            } else {
                echo "Error: " . pg_last_error($conn);
                exit(0);
            }
        } else {
            // Handle other categories or invalid category names
            // For example, set a default category or display an error message
        }

        // Commit the transaction if everything is successful
        $_SESSION['message'] = "Crop Created Successfully";
        pg_query($conn, "COMMIT");
        header("Location: ../../../crop.php");
        exit(0);
    } catch (Exception $e) {
        // message for error
        $_SESSION['message'] = 'Crop not Saved';
        // Rollback the transaction if an error occurs
        pg_query($conn, "ROLLBACK");
        // Log the error message
        error_log("Error: " . $e->getMessage());
        // Handle the error
        echo "Error: " . $e->getMessage();
        // Display the error message
        echo "<script>document.getElementById('error-container').innerHTML = '" . $e->getMessage() . "';</script>";
        exit(0);
    }
}
